<?php
// Controller: application state and data preparation.
include_once(__DIR__ . "/../constante.php");
include_once(__DIR__ . "/../service/conexao.php");
include_once(__DIR__ . "/../service/auth.php");

$sql = "SELECT especialidade, COUNT(*) AS quantidade FROM profissionais WHERE especialidade IS NOT NULL AND especialidade != '' GROUP BY especialidade";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$profissionaisPorCategoria = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
