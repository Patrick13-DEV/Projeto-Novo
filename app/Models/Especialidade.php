<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

final class Especialidade
{
    public function all(): array
    {
        $stmt = Database::connection()->query('SELECT id, nome, descricao FROM especialidades ORDER BY nome');

        return $stmt->fetchAll();
    }

    public function exists(int $id): bool
    {
        $stmt = Database::connection()->prepare('SELECT id FROM especialidades WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);

        return (bool) $stmt->fetchColumn();
    }
}