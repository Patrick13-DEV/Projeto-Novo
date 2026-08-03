<?php

declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

function auth_user(): ?array
{
	return $_SESSION['auth_user'] ?? null;
}

function auth_is_logged_in(): bool
{
	return auth_user() !== null;
}

function auth_login(array $user): void
{
	$_SESSION['auth_user'] = [
		'id' => (int) $user['id'],
		'nome' => $user['nome'],
		'email' => $user['email'],
		'tipo' => $user['tipo'],
	];

	if (isset($user['cliente_id'])) {
		$_SESSION['cliente_id'] = (int) $user['cliente_id'];
	}

	if (isset($user['profissional_id'])) {
		$_SESSION['profissional_id'] = (int) $user['profissional_id'];
	}
}

function auth_logout(): void
{
	$_SESSION = [];

	if (ini_get('session.use_cookies')) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
	}

	session_destroy();
}

function auth_require_login(array $tiposPermitidos = []): void
{
	$usuario = auth_user();

	if ($usuario === null) {
		header('Location: /InovaVida/index.php');
		exit;
	}

	if ($tiposPermitidos !== [] && !in_array($usuario['tipo'], $tiposPermitidos, true)) {
		header('Location: /InovaVida/index.php');
		exit;
	}
}

function flash_set(string $tipo, string $mensagem): void
{
	$_SESSION['flash'] = [
		'tipo' => $tipo,
		'mensagem' => $mensagem,
	];
}

function flash_get(): ?array
{
	if (!isset($_SESSION['flash'])) {
		return null;
	}

	$flash = $_SESSION['flash'];
	unset($_SESSION['flash']);

	return $flash;
}
