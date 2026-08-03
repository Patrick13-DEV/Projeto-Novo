<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/Controllers/PerfilController.php';

use App\Controllers\PerfilController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: /InovaVida/index.php');
	exit;
}

(new PerfilController())->atualizar($_POST);
