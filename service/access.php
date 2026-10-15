<?php
/** Controle centralizado de acesso por sessao e perfil. */
require_once __DIR__ . '/../constante.php';

function usuarioAutenticado(): bool
{
    return ($_SESSION['logado'] ?? false) === true
        && !empty($_SESSION['idUser'])
        && in_array($_SESSION['tipoUsuario'] ?? null, ['cliente', 'profissional'], true);
}

function dashboardUsuario(): string
{
    return ROOT_PATH . (($_SESSION['tipoUsuario'] ?? '') === 'profissional'
        ? 'pages/profissional/aplicacao/dashboard.php'
        : 'pages/Cliente/aplicacao/dashboard.php');
}

function redirecionarDashboard(): void
{
    header('Location: ' . dashboardUsuario(), true, 302);
    exit;
}

function somenteVisitantes(): void
{
    if (usuarioAutenticado()) {
        redirecionarDashboard();
    }
}

function exigirUsuario(?string $perfil = null): void
{
    if (!usuarioAutenticado()) {
        header('Location: ' . ROOT_PATH . 'index.php', true, 302);
        exit;
    }
    if ($perfil !== null && $_SESSION['tipoUsuario'] !== $perfil) {
        redirecionarDashboard();
    }
}
