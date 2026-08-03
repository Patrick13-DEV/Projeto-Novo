<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

final class Usuario
{
    public function findByEmail(string $email): ?array
    {
        $stmt = Database::connection()->prepare('SELECT id, nome, email, senha, tipo, ativo, criado_em FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = Database::connection()->prepare('SELECT id, nome, email, tipo, ativo, criado_em FROM usuarios WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $usuario = $stmt->fetch();

        return $usuario ?: null;
    }

    public function emailExists(string $email): bool
    {
        $stmt = Database::connection()->prepare('SELECT id FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);

        return (bool) $stmt->fetchColumn();
    }

    public function create(array $dados): int
    {
        $stmt = Database::connection()->prepare(
            'INSERT INTO usuarios (nome, email, senha, tipo, ativo) VALUES (:nome, :email, :senha, :tipo, :ativo)'
        );

        $stmt->execute([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => $dados['senha'],
            'tipo' => $dados['tipo'],
            'ativo' => $dados['ativo'] ?? 1,
        ]);

        return (int) Database::connection()->lastInsertId();
    }

    public function authenticate(string $email, string $senha): ?array
    {
        $usuario = $this->findByEmail($email);

        if ($usuario === null || (int) $usuario['ativo'] !== 1) {
            return null;
        }

        if (!password_verify($senha, $usuario['senha'])) {
            return null;
        }

        return $usuario;
    }
}