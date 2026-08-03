<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';

header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'success' => false,
    'message' => 'Fluxo de agendamento ainda não foi conectado ao backend.',
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);