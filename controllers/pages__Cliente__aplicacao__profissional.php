<?php
// Controller: application state and data preparation.
include_once(__DIR__ . "/../constante.php");
include_once(__DIR__ . "/../service/conexao.php");
include_once(__DIR__ . "/../service/auth.php");


$categoria = $_GET['categoria'] ?? '';
$categoria = trim($categoria);
$porPagina = 6;
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
if ($pagina < 1) {
    $pagina = 1;
}
$inicio = ($pagina - 1) * $porPagina;
$totalProfissionais = 0;
if ($categoria !== '') {

    $sqlTotal = "SELECT COUNT(*) FROM profissionais WHERE especialidade = :especialidade";

    $stmtTotal = $conexao->prepare($sqlTotal);

    $stmtTotal->bindValue(
        ':especialidade',
        $categoria,
        PDO::PARAM_STR
    );

    $stmtTotal->execute();

    $totalProfissionais = (int) $stmtTotal->fetchColumn();
}

$totalPaginas = ceil($totalProfissionais / $porPagina);


$profissionais = [];

if ($categoria !== '' && $totalProfissionais > 0) {

    $sql = "SELECT id, nome, especialidade
            FROM profissionais
            WHERE especialidade = :especialidade
            ORDER BY nome ASC
            LIMIT :inicio, :porPagina";

    $stmt = $conexao->prepare($sql);

    $stmt->bindValue(
        ':especialidade',
        $categoria,
        PDO::PARAM_STR
    );

    $stmt->bindValue(
        ':inicio',
        $inicio,
        PDO::PARAM_INT
    );

    $stmt->bindValue(
        ':porPagina',
        $porPagina,
        PDO::PARAM_INT
    );

    $stmt->execute();

    $profissionais = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
