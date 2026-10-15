<?php require_once __DIR__ . '/../../../service/access.php'; exigirUsuario('profissional'); ?>
<?php require_once __DIR__ . '/../../../controllers/pages__profissional__aplicacao__agendamento.php'; ?>


<!doctype html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="<?= ROOT_PATH ?>assets/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../src/output.css" rel="stylesheet">
    <title>Agendamentos</title>
</head>

<body>
    <div class="min-h-screen bg-sky-300 flex items-end md:items-center px-3 py-4 sm:px-4 lg:px-8">
        <div class="mx-auto flex w-full max-w-6xl flex-col overflow-hidden rounded-[2rem] bg-white shadow-[0_20px_60px_rgba(2,132,199,0.2)]">
            <div class="bg-white px-6 py-6 sm:px-8 lg:px-10">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <h1 class="text-2xl font-poppins font-semibold text-slate-800">
                        Agendamentos
                    </h1>
                    <a href="./dashboard.php" class="inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-600 shadow-sm transition hover:bg-sky-50">
                        Voltar
                    </a>
                </div>

                <?php if ($totalAgendamentos === 0): ?>

                    <div class="flex items-center justify-center py-16">
                        <p class="text-gray-500 font-poppins text-lg text-center">
                            Nenhum agendamento pendente
                        </p>
                    </div>

                <?php else: ?>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        <?php foreach ($agendamentos as $agendamento): ?>
                            <?php [$diaSemana, $dataFormatada, $horaInicio] = dataCompletaAgendamento($agendamento['data'], $diasSemana);
                            ?>

                            <div class="rounded-[1.25rem] border border-gray-200 bg-white p-4 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-sky-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="white" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0"/>
                                        </svg>
                                    </div>


                                    <div class="min-w-0 flex-1">
                                        <p class="font-poppins font-semibold text-slate-800 truncate">
                                            <?= htmlspecialchars($agendamento['cliente']) ?>
                                        </p>
                                        <p class="text-sm text-blue-500 underline cursor-pointer">
                                            Ver Perfil
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 space-y-1 text-sm font-semibold text-gray-700">
                                    <p>
                                        Data:<?= $dataFormatada ?>
                                    </p>
                                    <p>
                                        Dia da Semana:<?= $diaSemana ?>
                                    </p>
                                    <p>
                                        Horário: <?= $horaInicio ?>
                                    </p>

                                    <?php if (!empty($agendamento['descricao'])): ?>
                                        <p class="pt-2 font-normal text-gray-500">
                                            <?= htmlspecialchars($agendamento['descricao']) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-4 flex justify-end gap-3">
                                    <form action="<?= ROOT_PATH ?>actions/aprovacao.php" method="POST" class="form-agendamento">
                                        <input type="hidden" name="agendamento" value="<?= $agendamento['id'] ?>">
                                        <input type="hidden" name="status" value="confirmado">
                                        <button type="button" data-acao-agendamento="confirmado" data-mensagem="Tem certeza que deseja aceitar este agendamento?" class="rounded-md border border-green-500 px-3 py-1.5 text-sm font-semibold text-green-600 transition hover:bg-green-500 hover:text-white">
                                            Aceitar
                                        </button>
                                    </form>

                                    <form action="<?= ROOT_PATH ?>actions/alterar_status_agendamento.php" method="POST" class="form-agendamento">
                                        <input type="hidden" name="agendamento" value="<?= $agendamento['id'] ?>">
                                        <input type="hidden" name="status" value="cancelado">
                                        <button type="button" data-acao-agendamento="cancelado" data-mensagem="Tem certeza que deseja recusar este agendamento?" class="rounded-md border border-red-500 px-3 py-1.5 text-sm font-semibold text-red-600 transition hover:bg-red-500 hover:text-white">
                                            Recusar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($totalPaginas > 1): ?>
                        <div class="flex justify-center items-center gap-2 mt-10">
                            <?php if ($pagina > 1): ?>
                                <a href="?pagina=<?= $pagina - 1 ?>" class="px-4 py-2 border rounded-lg font-poppins text-sm hover:bg-sky-100 transition">
                                    Anterior
                                </a>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                <a href="?pagina=<?= $i ?>" class="px-4 py-2 rounded-lg font-poppins text-sm transition <?= $i == $pagina ? 'bg-sky-400 text-white' : 'border hover:bg-sky-100' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>

                            <?php if ($pagina < $totalPaginas): ?>
                                <a href="?pagina=<?= $pagina + 1 ?>" class="px-4 py-2 border rounded-lg font-poppins text-sm hover:bg-sky-100 transition">
                                    Próxima
                                </a>
                            <?php endif; ?>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="toastConfirmacao" class="fixed bottom-6 right-6 z-50 hidden w-[350px] max-w-[calc(100%-2rem)] rounded-2xl bg-white p-5 shadow-2xl border border-gray-200">
        <p id="toastMensagem" class="text-sm font-poppins text-gray-700"></p>
        <div class="mt-4 flex justify-end gap-2">
            <button type="button" id="btnFecharToast" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-gray-100">
                Cancelar
            </button>

            <button type="button" id="btnConfirmarToast"class="rounded-lg px-4 py-2 text-sm font-semibold text-white transition">
                Confirmar
            </button>
        </div>
    </div>

</body>
    <script src="<?= ROOT_PATH ?>assets/script.js" defer></script>

</html>