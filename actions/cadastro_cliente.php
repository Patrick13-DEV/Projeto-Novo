<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

use App\Controllers\AuthController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: /InovaVida/auth/cliente/cadastro.php');
	exit;
}

(new AuthController())->registrarCliente($_POST);
