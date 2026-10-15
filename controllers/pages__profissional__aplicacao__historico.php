<?php
// Controller: application state and data preparation.
include_once(__DIR__ . "/../constante.php");
include_once(__DIR__ . "/../service/conexao.php");
include_once(__DIR__ . "/../service/auth.php");

$idUser = (int) $_SESSION['idUser'];

require_once __DIR__ . '/../service/functions.php';
$pesquisa = trim($_GET['pesquisa'] ?? '');
$statusFiltro = trim($_GET['status'] ?? '');
$condicoes = ['agendamentos.profissional_id = :profissional_id', 'agendamentos.data < NOW()'];
$parametros = [ ':profissional_id' => $idUser];
if ($pesquisa !== '') {$condicoes[] = 'clientes.nome LIKE :pesquisa'; $parametros[':pesquisa'] = '%' . $pesquisa . '%';} $statusPermitidos = ['pendente', 'confirmado', 'concluido', 'cancelado'];
if (in_array($statusFiltro, $statusPermitidos, true)) { $condicoes[] = 'agendamentos.status = :status'; $parametros[':status'] = $statusFiltro;}
$sql = "SELECT agendamentos.id, agendamentos.data, agendamentos.descricao, agendamentos.status, clientes.nome AS cliente FROM agendamentos INNER JOIN clientes ON clientes.id = agendamentos.cliente_id WHERE " . implode(' AND ', $condicoes) . " ORDER BY agendamentos.data DESC";
$stmt = $conexao->prepare($sql);
foreach ($parametros as $chave => $valor) {
    $stmt->bindValue($chave, $valor);}
$stmt->execute();
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
