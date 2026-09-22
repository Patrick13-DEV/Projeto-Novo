<?php

include_once("../../../constante.php");
include_once("../../../service/conexao.php");
include_once("../../../service/auth.php");

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
$temAgendamentoConfirmado = count($agendamentosConfirmados) > 0;?>

<!doctype html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../../src/output.css" rel="stylesheet"/>
    <title>Inova Vida Tech</title>
</head>

<body>
<div class="min-h-screen bg-sky-300 px-3 py-4 sm:px-4 lg:px-8 flex items-end md:items-center">

    <div class="mx-auto flex w-full max-w-6xl flex-col overflow-hidden rounded-[2rem] bg-white shadow-[0_20px_60px_rgba(2,132,199,0.2)]">

        <div class="bg-sky-800 px-6 py-8 text-white sm:px-8 lg:px-10">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="max-w-3xl">
                    <h1 class="text-2xl font-poppins font-semibold sm:text-3xl">
                        Seja Bem-vindo, <?= htmlspecialchars($_SESSION['nomeUser']) ?>!
                    </h1>
                    <h2 class="mt-2 text-lg font-poppins text-sky-300 sm:text-xl">
                        O que você está procurando?
                    </h2>
                </div>


                <div class="flex flex-wrap gap-2 self-start">

                    <a href="../usuario/perfil.php" class="inline-flex items-center justify-center rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-sky-800 transition duration-300 hover:bg-sky-100" >
                        Perfil
                    </a>

                    <a href="../../../actions/logout.php" class="inline-flex items-center justify-center rounded-full bg-red-500 px-5 py-2.5 text-sm font-semibold text-white transition duration-300 hover:bg-red-600">
                        Sair
                    </a>

                </div>
            </div>

            <div class="mt-6 flex items-center rounded-2xl bg-white px-4 py-3 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mr-3 h-5 w-5 text-gray-400" >
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.04 6.04a7.5 7.5 0 0 0 10.61 10.61Z"/>
                </svg>
                <p class="font-poppins text-gray-500">
                    Pesquisar Paciente
                </p>
            </div>
        </div>


        <div class="bg-white px-6 py-8 sm:px-8 lg:px-10">

            <div class="mx-auto flex max-w-4xl flex-col overflow-hidden rounded-[1.5rem] border-1 border-gray-400  shadow-sm sm:flex-row">
                <img class="h-48 w-full object-cover sm:h-auto sm:w-[45%]" src="../../../assets/img/Doutor.png" alt="Profissional"/>
                <div class="flex flex-1 flex-col px-5 py-6">
                    <div class="w-full">
                        <?php if ($temAgendamentoConfirmado): ?>
                            <?php foreach ($agendamentosConfirmados as $agendamento): ?>
                                <?php $dataAgendamento = new DateTime($agendamento['data']); $dataFormatada = $dataAgendamento->format('d/m/Y'); $horaAgendamento = $dataAgendamento->format('H:i');?>
                                <div class="mb-2 flex items-center justify-between gap-3 rounded-xl border border-gray-800 bg-white px-3.5 py-2.5">
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-slate-800 font-poppins">
                                            Agendamento Confirmado
                                        </p>

                                        <p class="text-xs text-sky-600 font-poppins">
                                            <?= $dataFormatada ?>
                                            às
                                            <?= $horaAgendamento ?>
                                        </p>
                                    </div>

                                    <a href="./agendamento.php" class="shrink-0 rounded-lg bg-sky-500 px-3 py-2 text-xs font-semibold text-white transition hover:bg-sky-600">
                                        Ver mais
                                    </a>
                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-sm font-semibold font-poppins text-sky-600">
                                Sem Agendamentos
                            </p>
                            <p class="mt-2 text-sm text-gray-600 font-poppins">
                                Você ainda não possui pedidos de agendamento no momento.
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="mt-auto pt-5 flex justify-center">

                        <div class="flex items-center justify-center gap-4">

                            <a href="./agendamento.php"class="relative inline-flex items-center justify-center rounded-full bg-sky-800 px-5 py-2.5 text-sm font-semibold text-white transition duration-300 hover:bg-sky-700">
                                Ver Pedidos
                                <?php if ($temAgendamentoPendente): ?>
                                    <span class="absolute -right-1 -top-1 flex h-3 w-3">
                                        <span
                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"
                                        ></span>
                                        <span
                                            class="relative inline-flex h-3 w-3 rounded-full border-2 border-white bg-red-500"
                                        ></span>
                                    </span>
                                <?php endif; ?>
                            </a>
                            <a href="./historico.php" class="inline-flex items-center justify-center rounded-full border border-sky-800 bg-white px-5 py-2.5 text-sm font-semibold text-sky-800 transition duration-300 hover:bg-sky-50">
                                Histórico
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>