<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';

function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $host = defined('DB_HOST') ? DB_HOST : 'localhost';
    $database = defined('DB_NAME') ? DB_NAME : 'inovavida';
    $charset = defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4';
    $user = defined('DB_USER') ? DB_USER : 'root';
    $password = defined('DB_PASS') ? DB_PASS : '';

    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $host, $database, $charset);

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}

$pdo = getPDO();