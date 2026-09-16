<?php

include_once("../../../constante.php");
include_once("../../../service/conexao.php");
include_once("../../../service/auth.php");

$sql = "SELECT indicador, pressao FROM indicadores_saude WHERE cliente_id = :cliente_id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":cliente_id", $idUser);
$stmt->execute();

$dadosSaude = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT agendamentos.id, agendamentos.data, agendamentos.descricao, profissionais.nome AS profissional FROM agendamentos INNER JOIN profissionais ON agendamentos.profissional_id = profissionais.id WHERE agendamentos.cliente_id = :cliente_id AND agendamentos.status = 'pendente' ORDER BY agendamentos.data ASC";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":cliente_id", $idUser);
$stmt->execute();
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech</title>
</head>

<body>
    <div class="min-h-screen bg-sky-300 md:px-6 flex items-end md:items-center justify-center">
        <div class="w-full max-w-7xl bg-white md:rounded-[2.5rem] shadow-lg overflow-hidden">
            <div class="p-4 sm:p-6 lg:p-4">
                <div class="flex flex-col md:flex-row gap-6 lg:gap-8">
                    <div class="w-full md:w-3/5 flex flex-col gap-4">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div>
                                <h1 class="text-2xl md:text-xl lg:text-3xl font-poppins font-semibold">
                                    Seja Bem-vindo, <?= htmlspecialchars($nomeUser) ?>!
                                </h1>
                                <h2 class="text-xl text-sky-500 mt-3 font-poppins">
                                    Como posso ajudar você hoje?
                                </h2>
                            </div>
                        </div>

                        <a href="./categorias.php"
                            class="bg-sky-400 rounded-xl border-1 h-40 flex flex-col justify-center items-center shadow-lg hover:bg-sky-500 duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-20 stroke-white">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>

                            <p class="text-white text-2xl font-bold font-poppins">

                                Agendamentos

                            </p>

                        </a>


                        <div class="bg-gray-100 rounded-xl border-1 h-56 flex flex-col justify-start items-center shadow-lg">

                            <?php if (!empty($agendamentos)) { ?>

                                <div class="w-full px-4 py-3 flex flex-col gap-2 overflow-y-auto">

                                    <?php foreach ($agendamentos as $agendamento) { ?>

                                        <div class=" bg-white rounded-lg border-1 px-4 py-3 flex items-center justify-between gap-3">

                                            <div class="font-poppins">

                                                <h3 class="font-semibold text-gray-700">

                                                    Agendamento Pendente

                                                </h3>

                                                <p class="text-sm text-gray-500">

                                                    <?= date('d/m/Y', strtotime($agendamento['data'])) ?>

                                                    às

                                                    <?= date('H:i', strtotime($agendamento['data'])) ?>

                                                </p>

                                            </div>


                                            <a href="./agendamento_detalhes.php?id=<?= $agendamento['id'] ?>"
                                                class="bg-sky-400 text-white px-3 py-2 rounded-lg font-poppins text-sm font-semibold hover:bg-sky-500 duration-300 whitespace-nowrap">

                                                Ver mais

                                            </a>

                                        </div>

                                    <?php } ?>

                                </div>


                            <?php } else { ?>

                                <div class="flex flex-col justify-center items-center h-full">

                                    <div class="bg-sky-400 w-24 h-24 rounded-full flex items-center justify-center">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-16 stroke-white">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />

                                        </svg>

                                    </div>

                                    <p class="mt-5 font-poppins font-medium text-gray-700">

                                        Nenhum Agendamento Pendente

                                    </p>

                                </div>

                            <?php } ?>

                        </div>

                    </div>


                    <div class="lg:w-3/5 gap-3 p-8 flex items-center flex-col justify-center">

                        <div class="w-full rounded-xl border-1 overflow-hidden shadow-lg">

                            <div class="bg-sky-400 p-4">

                                <h3 class="text-white font-semibold font-poppins text-md">

                                    Pressão Arterial

                                </h3>

                            </div>


                            <div class="bg-white p-4 border-b">

                                <ul class="list-disc ps-5 font-poppins text-gray-600">

                                    <?php foreach ($dadosSaude as $dado) { ?>

                                        <?php if (!empty($dado['pressao'])) { ?>

                                            <li>

                                                Pressão Arterial:

                                                <strong>

                                                    <?= htmlspecialchars($dado['pressao']) ?>

                                                </strong>

                                            </li>

                                        <?php } ?>

                                    <?php } ?>

                                </ul>

                            </div>


                            <div class="bg-sky-400 p-2">

                                <h3 class="text-white font-semibold font-poppins text-md">

                                    Quais são os Indicadores de Saúde?

                                </h3>

                            </div>


                            <div class="bg-white divide-y">

                                <?php foreach ($dadosSaude as $dado) { ?>

                                    <?php if (!empty($dado['indicador'])) { ?>

                                        <div class="p-4">

                                            <ul class="list-disc ps-5 font-poppins text-gray-600">

                                                <li>

                                                    <?= htmlspecialchars($dado['indicador']) ?>

                                                </li>

                                            </ul>

                                        </div>

                                    <?php } ?>

                                <?php } ?>

                            </div>

                        </div>


                        <div class="flex gap-5 w-full max-w-lg">

                            <a href="<?= ROOT_PATH ?>pages/Cliente/aplicacao/usuario/perfil.php"
                                class="w-full bg-sky-400 text-center text-xl rounded-full py-4 font-semibold text-white transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500">

                                Ver Perfil

                            </a>


                            <a href="<?= ROOT_PATH ?>actions/logout.php"
                                class="w-full max-w-xs bg-sky-400 text-center text-xl rounded-full py-4 font-semibold text-white transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-red-600">

                                Sair

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
```
