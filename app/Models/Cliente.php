<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

final class Cliente
{
    public function findByUsuarioId(int $usuarioId): ?array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM clientes WHERE usuario_id = :usuario_id LIMIT 1');
        $stmt->execute(['usuario_id' => $usuarioId]);
        $cliente = $stmt->fetch();

        return $cliente ?: null;
    }

    public function create(int $usuarioId, array $dados = []): int
    {
        $stmt = Database::connection()->prepare(
            'INSERT INTO clientes (usuario_id, cpf, telefone, data_nascimento, sexo, peso, altura, tipo_sanguineo, cidade, estado, endereco, cep)
             VALUES (:usuario_id, :cpf, :telefone, :data_nascimento, :sexo, :peso, :altura, :tipo_sanguineo, :cidade, :estado, :endereco, :cep)'
        );

        $stmt->execute([
            'usuario_id' => $usuarioId,
            'cpf' => $dados['cpf'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'sexo' => $dados['sexo'] ?? null,
            'peso' => $dados['peso'] ?? null,
            'altura' => $dados['altura'] ?? null,
            'tipo_sanguineo' => $dados['tipo_sanguineo'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
            'estado' => $dados['estado'] ?? null,
            'endereco' => $dados['endereco'] ?? null,
            'cep' => $dados['cep'] ?? null,
        ]);

        return (int) Database::connection()->lastInsertId();
    }

    public function updateByUsuarioId(int $usuarioId, array $dados): bool
    {
        $stmt = Database::connection()->prepare(
            'UPDATE clientes SET cpf = :cpf, telefone = :telefone, data_nascimento = :data_nascimento, sexo = :sexo, peso = :peso, altura = :altura, tipo_sanguineo = :tipo_sanguineo, cidade = :cidade, estado = :estado, endereco = :endereco, cep = :cep WHERE usuario_id = :usuario_id'
        );

        return $stmt->execute([
            'usuario_id' => $usuarioId,
            'cpf' => $dados['cpf'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'sexo' => $dados['sexo'] ?? null,
            'peso' => $dados['peso'] ?? null,
            'altura' => $dados['altura'] ?? null,
            'tipo_sanguineo' => $dados['tipo_sanguineo'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
            'estado' => $dados['estado'] ?? null,
            'endereco' => $dados['endereco'] ?? null,
            'cep' => $dados['cep'] ?? null,
        ]);
    }
}