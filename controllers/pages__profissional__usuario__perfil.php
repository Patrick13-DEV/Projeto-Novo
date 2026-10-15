<?php
// Controller: application state and data preparation.
include_once(__DIR__ . "/../constante.php");
include_once(__DIR__ . "/../service/conexao.php");
include_once(__DIR__ . "/../service/auth.php");

$idUser = (int) $_SESSION['idUser'];

$mensagem = '';
$tipoMensagem = '';

/*
|--------------------------------------------------------------------------
| ATUALIZAR DADOS
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_perfil'])) {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $especialidade = trim($_POST['especialidade'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $estado = trim($_POST['estado'] ?? '');
    $cidade = trim($_POST['cidade'] ?? '');
    $rua = trim($_POST['rua'] ?? '');

    if (
        empty($nome) ||
        empty($email) ||
        empty($especialidade) ||
        empty($estado) ||
        empty($cidade) ||
        empty($rua)
    ) {
        $_SESSION['mensagem_perfil'] = 'Preencha todos os campos obrigatórios.';
        $_SESSION['tipo_mensagem_perfil'] = 'erro';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['mensagem_perfil'] = 'Informe um e-mail válido.';
        $_SESSION['tipo_mensagem_perfil'] = 'erro';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    try {

        /*
        |--------------------------------------------------------------------------
        | Verifica se o e-mail já pertence a outro profissional
        |--------------------------------------------------------------------------
        */

        $sql = "
            SELECT id
            FROM profissionais
            WHERE email = :email
            AND id != :id
            LIMIT 1
        ";

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $idUser, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->fetch()) {

            $_SESSION['mensagem_perfil'] = 'Este e-mail já está sendo utilizado por outro profissional.';
            $_SESSION['tipo_mensagem_perfil'] = 'erro';

            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Atualiza os dados
        |--------------------------------------------------------------------------
        */

        $sql = "
            UPDATE profissionais
            SET
                nome = :nome,
                email = :email,
                cpf = :cpf,
                especialidade = :especialidade,
                telefone = :telefone,
                estado = :estado,
                cidade = :cidade,
                rua = :rua
            WHERE id = :id
        ";

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindValue(':especialidade', $especialidade, PDO::PARAM_STR);
        $stmt->bindValue(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindValue(':rua', $rua, PDO::PARAM_STR);
        $stmt->bindValue(':id', $idUser, PDO::PARAM_INT);

        $stmt->execute();

        /*
        |--------------------------------------------------------------------------
        | Atualiza o nome da sessão
        |--------------------------------------------------------------------------
        */

        $_SESSION['nomeUser'] = $nome;

        $_SESSION['mensagem_perfil'] = 'Informações atualizadas com sucesso.';
        $_SESSION['tipo_mensagem_perfil'] = 'sucesso';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;

    } catch (PDOException $e) {

        $_SESSION['mensagem_perfil'] = 'Ocorreu um erro ao atualizar suas informações.';
        $_SESSION['tipo_mensagem_perfil'] = 'erro';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| MENSAGEM DA SESSÃO
|--------------------------------------------------------------------------
*/

if (isset($_SESSION['mensagem_perfil'])) {

    $mensagem = $_SESSION['mensagem_perfil'];
    $tipoMensagem = $_SESSION['tipo_mensagem_perfil'] ?? 'erro';

    unset($_SESSION['mensagem_perfil']);
    unset($_SESSION['tipo_mensagem_perfil']);
}

/*
|--------------------------------------------------------------------------
| BUSCAR PROFISSIONAL
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT
        id,
        nome,
        email,
        cpf,
        especialidade,
        telefone,
        estado,
        cidade,
        rua
    FROM profissionais
    WHERE id = :id
    LIMIT 1
";

$stmt = $conexao->prepare($sql);
$stmt->bindValue(':id', $idUser, PDO::PARAM_INT);
$stmt->execute();

$profissional = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$profissional) {
    echo '
        <main class="flex min-h-screen items-center justify-center bg-sky-300 px-4">
            <div class="rounded-2xl bg-white p-8 text-center shadow-xl">
                <h1 class="text-xl font-bold text-red-600">
                    Profissional não encontrado.
                </h1>
            </div>
        </main>
    ';
    exit;
}

$nome = $profissional['nome'];
$email = $profissional['email'];
$cpf = $profissional['cpf'];
$especialidade = $profissional['especialidade'];
$telefone = $profissional['telefone'];
$estado = $profissional['estado'];
$cidade = $profissional['cidade'];
$rua = $profissional['rua'];
