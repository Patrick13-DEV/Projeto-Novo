<?php
/** Cabeçalho visual reutilizável para páginas com <html>/<body> próprios. */
require_once __DIR__ . '/../service/navigation.php';
?>
<header class="w-full bg-white shadow-sm" role="banner">
<nav class="mx-auto max-w-7xl flex items-center justify-between px-5 py-4" aria-label="Navegação principal">
<a class="text-xl font-extrabold text-sky-600" href="<?= htmlspecialchars($logoDestino, ENT_QUOTES) ?>">InovaVida</a>
<?php if (usuarioAutenticado()): ?>
<a class="text-sm text-slate-600" href="<?= htmlspecialchars(dashboardUsuario(), ENT_QUOTES) ?>">Meu dashboard</a>
<?php else: ?>
<a class="text-sm text-slate-600" href="<?= ROOT_PATH ?>index.php">Início</a>
<?php endif; ?>
</nav></header>
