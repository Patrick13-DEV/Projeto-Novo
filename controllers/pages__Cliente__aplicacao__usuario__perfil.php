<?php
require_once __DIR__ . '/../service/cliente_perfil.php';
exigirUsuario('cliente');
$erroPerfil = null;
try {
    $perfil = perfilCliente($conexao, (int) $_SESSION['idUser']);
} catch (Throwable $e) {
    error_log('Erro ao carregar perfil: ' . $e->getMessage());
    $erroPerfil = 'Não foi possível carregar o perfil neste momento.';
    $perfil = [];
}
$sucessoPerfil = $_SESSION['perfil_sucesso'] ?? null;
unset($_SESSION['perfil_sucesso']);
function campoPerfil(array $perfil, string $campo): string {
    return htmlspecialchars((string)($perfil[$campo] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
