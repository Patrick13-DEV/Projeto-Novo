<?php

declare(strict_types=1);

namespace App\Controllers;

require_once __DIR__ . '/../Models/Cliente.php';
require_once __DIR__ . '/../Models/Profissional.php';

use App\Models\Cliente;
use App\Models\Profissional;

final class PerfilController
{
    private Cliente $clientes;
    private Profissional $profissionais;

    public function __construct()
    {
        $this->clientes = new Cliente();
        $this->profissionais = new Profissional();
    }

    public function atualizar(array $dados): void
    {
        $usuario = \auth_user();

        if ($usuario === null) {
            header('Location: /InovaVida/index.php');
            exit;
        }

        $nome = trim((string) ($dados['nome'] ?? $usuario['nome']));
        $email = trim((string) ($dados['email'] ?? $usuario['email']));

        $stmt = \getPDO()->prepare('UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id');
        $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'id' => $usuario['id'],
        ]);

        if ($usuario['tipo'] === 'cliente') {
            $this->clientes->updateByUsuarioId((int) $usuario['id'], $dados);
        }

        if ($usuario['tipo'] === 'profissional') {
            $this->profissionais->updateByUsuarioId((int) $usuario['id'], $dados);
        }

        $_SESSION['auth_user']['nome'] = $nome;
        $_SESSION['auth_user']['email'] = $email;

        \flash_set('sucesso', 'Perfil atualizado com sucesso.');

        $redirect = $usuario['tipo'] === 'cliente'
            ? '/InovaVida/pages/Cliente/usuario/perfil.php'
            : '/InovaVida/pages/profissional/usuario/perfil.php';

        header('Location: ' . $redirect);
        exit;
    }
}