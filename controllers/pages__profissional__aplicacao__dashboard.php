<?php
// Controller: application state and data preparation.
require_once __DIR__ . "/../service/format.php";
include_once(__DIR__ . "/../constante.php");
include_once(__DIR__ . "/../service/conexao.php");
include_once(__DIR__ . "/../service/auth.php");

$idUser = $_SESSION['idUser'];

$sql = "SELECT COUNT(*) AS total FROM agendamentos WHERE profissional_id = :profissional_id AND status = 'pendente'";

$stmt = $conexao->prepare($sql);
$stmt->bindParam(":profissional_id", $idUser, PDO::PARAM_INT);
$stmt->execute();

$notificacoes = $stmt->fetch(PDO::FETCH_ASSOC);
$temAgendamentoPendente = $notificacoes['total'] > 0;

$sql = "SELECT agendamentos.id, agendamentos.data, agendamentos.descricao, clientes.nome AS cliente FROM agendamentos INNER JOIN clientes ON agendamentos.cliente_id = clientes.id WHERE agendamentos.profissional_id = :profissional_id AND agendamentos.status = 'confirmado' ORDER BY agendamentos.data ASC";

$stmt = $conexao->prepare($sql);
$stmt->bindParam(":profissional_id", $idUser, PDO::PARAM_INT);
$stmt->execute();

$agendamentosConfirmados = $stmt->fetchAll(PDO::FETCH_ASSOC);
$temAgendamentoConfirmado = count($agendamentosConfirmados) > 0;
