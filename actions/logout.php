<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

(new App\Controllers\AuthController())->logout();