<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

use App\Controllers\AuthController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: /InovaVida/auth/profissional/cadastro.php');
	exit;
}

$etapa = (string) ($_POST['etapa'] ?? '1');
$controller = new AuthController();

if ($etapa === '1') {
	$controller->prepararCadastroProfissional($_POST);
}

$controller->registrarProfissional($_POST);
