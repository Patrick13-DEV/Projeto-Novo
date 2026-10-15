<?php
require_once __DIR__ . '/access.php';
$logoDestino = usuarioAutenticado() ? dashboardUsuario() : ROOT_PATH . 'index.php';
