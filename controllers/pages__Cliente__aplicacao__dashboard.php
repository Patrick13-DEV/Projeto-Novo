<?php
// Controller: application state and data preparation.
include_once(__DIR__ . "/../constante.php");
include_once(__DIR__ . "/../service/conexao.php");
include_once(__DIR__ . "/../service/auth.php");

$sql = "SELECT indicador, pressao FROM indicadores_saude WHERE cliente_id = :cliente_id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":cliente_id", $idUser);
$stmt->execute();
$dadosSaude = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT agendamentos.id, agendamentos.data, agendamentos.descricao, agendamentos.status, profissionais.nome AS profissional FROM agendamentos
        INNER JOIN profissionais ON agendamentos.profissional_id = profissionais.id
        WHERE agendamentos.cliente_id = :cliente_id AND agendamentos.status IN ('pendente', 'confirmado')
        ORDER BY CASE WHEN agendamentos.status = 'confirmado' THEN 0 WHEN agendamentos.status = 'pendente' THEN 1 ELSE 2 END, agendamentos.data ASC";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":cliente_id", $idUser);
$stmt->execute();
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
