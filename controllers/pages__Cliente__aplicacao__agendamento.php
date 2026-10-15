<?php
// Controller: application state and data preparation.
include_once(__DIR__ . "/../constante.php");
include_once(__DIR__ . "/../service/conexao.php");
include_once(__DIR__ . "/../service/auth.php");

$profissionalId = isset($_GET['profissional']) ? (int) $_GET['profissional'] : 0;
$profissional = null;
if ($profissionalId > 0) {
    $sql = "SELECT id, nome, especialidade FROM profissionais WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':id', $profissionalId, PDO::PARAM_INT);
    $stmt->execute();
    $profissional = $stmt->fetch(PDO::FETCH_ASSOC);
}

$dataAtual = new DateTime();
$dias = [];
$nomesDias = [
    'Sunday'    => 'Domingo',
    'Monday'    => 'Segunda',
    'Tuesday'   => 'Terça',
    'Wednesday' => 'Quarta',
    'Thursday'  => 'Quinta',
    'Friday'    => 'Sexta',
    'Saturday'  => 'Sábado'
];

for ($i = 0; $i < 7; $i++) {
    $data = clone $dataAtual;
    $data->modify("+{$i} days");
    $diaSemana = $nomesDias[$data->format('l')];
    $dias[] = [
        'nome'   => $diaSemana,
        'numero' => $data->format('d'),
        'data'   => $data->format('Y-m-d')
    ];
}
