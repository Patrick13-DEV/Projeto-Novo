<?php
/** Acesso aos dados do perfil, compatível com os dois esquemas SQL distribuídos. */
require_once __DIR__ . '/access.php';
require_once __DIR__ . '/conexao.php';

function perfilCliente(PDO $db, int $userId): array
{
    $cols = $db->query('SHOW COLUMNS FROM clientes')->fetchAll(PDO::FETCH_COLUMN);
    $novoEsquema = in_array('usuario_id', $cols, true);
    if ($novoEsquema) {
        $sql = 'SELECT c.*, u.nome, u.email, u.criado_em FROM clientes c JOIN usuarios u ON u.id=c.usuario_id WHERE u.id=:id AND u.tipo=\'cliente\'';
    } else {
        $sql = 'SELECT c.* FROM clientes c WHERE c.id=:id';
    }
    $st = $db->prepare($sql);
    $st->execute(['id' => $userId]);
    $dados = $st->fetch(PDO::FETCH_ASSOC);
    if (!$dados) { throw new RuntimeException('Perfil do cliente não encontrado.'); }
    $dados['_novo_esquema'] = $novoEsquema;
    return $dados;
}

function atualizarPerfilCliente(PDO $db, int $userId, array $campos): void
{
    $perfil = perfilCliente($db, $userId);
    $permitidos = ['nome','email','telefone','data_nascimento','sexo','peso','altura','cpf'];
    $campos = array_intersect_key($campos, array_flip($permitidos));
    $db->beginTransaction();
    try {
        $tabelaUsuario = $perfil['_novo_esquema'];
        $dadosPessoais = array_intersect_key($campos, array_flip(['nome','email']));
        $dadosCliente = array_diff_key($campos, $dadosPessoais);
        if (!$tabelaUsuario) { $dadosCliente = $campos; }
        if ($tabelaUsuario && $dadosPessoais) {
            $sets = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($dadosPessoais)));
            $st = $db->prepare("UPDATE usuarios SET $sets WHERE id=:id AND tipo='cliente'");
            $st->execute($dadosPessoais + ['id'=>$userId]);
        }
        if ($dadosCliente) {
            $sets = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($dadosCliente)));
            $key = $tabelaUsuario ? 'usuario_id' : 'id';
            $st = $db->prepare("UPDATE clientes SET $sets WHERE $key=:id");
            $st->execute($dadosCliente + ['id'=>$userId]);
        }
        $db->commit();
    } catch (Throwable $e) {
        $db->rollBack();
        throw $e;
    }
}
