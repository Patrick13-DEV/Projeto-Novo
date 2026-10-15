<?php
// Controller: application state and data preparation.
require_once __DIR__ . "/../service/format.php";
include_once(__DIR__ . "/../constante.php");
include_once(__DIR__ . "/../service/conexao.php");
include_once(__DIR__ . "/../service/auth.php");


$idUser = $_SESSION['idUser'];
$porPagina = 6;
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
if ($pagina < 1) {$pagina = 1;}
$inicio = ($pagina - 1) * $porPagina;

$sqlTotal = "SELECT COUNT(*) FROM agendamentos WHERE profissional_id = :profissional_id AND status = 'pendente'";
$stmtTotal = $conexao->prepare($sqlTotal);
$stmtTotal->bindValue(':profissional_id', $idUser,PDO::PARAM_INT);
$stmtTotal->execute();
$totalAgendamentos = (int) $stmtTotal->fetchColumn();

$totalPaginas = ceil($totalAgendamentos / $porPagina);
$agendamentos = [];

if ($totalAgendamentos > 0) {
    $sql = "SELECT agendamentos.id, agendamentos.data, agendamentos.descricao, clientes.nome AS cliente FROM agendamentos
            INNER JOIN clientes ON agendamentos.cliente_id = clientes.id WHERE agendamentos.profissional_id = :profissional_id AND agendamentos.status = 'pendente'
            ORDER BY agendamentos.data ASC
            LIMIT :inicio, :porPagina";

    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':profissional_id', $idUser,PDO::PARAM_INT);
    $stmt->bindValue(':inicio', $inicio,PDO::PARAM_INT);
    $stmt->bindValue(':porPagina', $porPagina, PDO::PARAM_INT);
    $stmt->execute();
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$diasSemana = [
    'Sunday' => 'Domingo',
    'Monday' => 'Segunda-feira',
    'Tuesday' => 'Terça-feira',
    'Wednesday' => 'Quarta-feira',
    'Thursday' => 'Quinta-feira',
    'Friday' => 'Sexta-feira',
    'Saturday' => 'Sábado'
];
