<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

final class Profissional
{
    public function findByUsuarioId(int $usuarioId): ?array
    {
        $stmt = Database::connection()->prepare('SELECT * FROM profissionais WHERE usuario_id = :usuario_id LIMIT 1');
        $stmt->execute(['usuario_id' => $usuarioId]);
        $profissional = $stmt->fetch();

        return $profissional ?: null;
    }

    public function create(int $usuarioId, array $dados): int
    {
        $stmt = Database::connection()->prepare(
            'INSERT INTO profissionais (usuario_id, especialidade_id, crm, telefone, descricao, foto, valor_consulta)
             VALUES (:usuario_id, :especialidade_id, :crm, :telefone, :descricao, :foto, :valor_consulta)'
        );

        $stmt->execute([
            'usuario_id' => $usuarioId,
            'especialidade_id' => $dados['especialidade_id'],
            'crm' => $dados['crm'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'descricao' => $dados['descricao'] ?? null,
            'foto' => $dados['foto'] ?? null,
            'valor_consulta' => $dados['valor_consulta'] ?? null,
        ]);

        return (int) Database::connection()->lastInsertId();
    }

    public function updateByUsuarioId(int $usuarioId, array $dados): bool
    {
        $stmt = Database::connection()->prepare(
            'UPDATE profissionais SET especialidade_id = :especialidade_id, crm = :crm, telefone = :telefone, descricao = :descricao, foto = :foto, valor_consulta = :valor_consulta WHERE usuario_id = :usuario_id'
        );

        return $stmt->execute([
            'usuario_id' => $usuarioId,
            'especialidade_id' => $dados['especialidade_id'],
            'crm' => $dados['crm'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'descricao' => $dados['descricao'] ?? null,
            'foto' => $dados['foto'] ?? null,
            'valor_consulta' => $dados['valor_consulta'] ?? null,
        ]);
    }
}