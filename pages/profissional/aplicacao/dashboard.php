<?php require_once __DIR__ . '/../../../service/access.php'; exigirUsuario('profissional'); ?>
<?php require_once __DIR__ . '/../../../controllers/pages__profissional__aplicacao__dashboard.php'; ?>
<?php require_once __DIR__ . '/../../../includes/header.php'; ?>


<main class="flex-1 bg-sky-300 px-3 py-4 sm:px-4 lg:px-8 flex items-end md:items-center">

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

                    <a href="../usuario/perfil.php" class="inline-flex items-center justify-center rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-sky-800 transition duration-300 hover:bg-sky-100">
                        Perfil
                    </a>

                    <a href="../../../actions/logout.php" class="inline-flex items-center justify-center rounded-full bg-red-500 px-5 py-2.5 text-sm font-semibold text-white transition duration-300 hover:bg-red-600">
                        Sair
                    </a>

                </div>

            </div>

            <div class="mt-6 flex items-center rounded-2xl bg-white px-4 py-3 shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mr-3 h-5 w-5 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.04 6.04a7.5 7.5 0 0 0 10.61 10.61Z" />
                </svg>

                <p class="font-poppins text-gray-500">
                    Pesquisar Paciente
                </p>

            </div>

        </div>

        <div class="bg-white px-6 py-8 sm:px-8 lg:px-10">

            <div class="mx-auto flex max-w-4xl flex-col overflow-hidden rounded-[1.5rem] border border-gray-400 shadow-sm sm:flex-row">

                <img class="h-48 w-full object-cover sm:h-auto sm:w-[45%]" src="../../../assets/img/Doutor.png" alt="Profissional">

                <div class="flex flex-1 flex-col px-5 py-6">

                    <div class="w-full">

                        <?php if ($temAgendamentoConfirmado): ?>

                            <?php foreach ($agendamentosConfirmados as $agendamento): ?>

                                <?php
                                [$dataFormatada, $horaAgendamento] = dataHoraAgendamento($agendamento['data']);
                                ?>

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

                                    <button
                                        type="button"
                                        class="abrir-modal-agendamento shrink-0 rounded-lg bg-sky-500 px-3 py-2 text-xs font-semibold text-white transition hover:bg-sky-600"
                                        data-id="<?= (int) $agendamento['id'] ?>"
                                        data-status="confirmado"
                                        data-cliente="<?= htmlspecialchars($agendamento['cliente'], ENT_QUOTES, 'UTF-8') ?>"
                                        data-data="<?= htmlspecialchars($dataFormatada, ENT_QUOTES, 'UTF-8') ?>"
                                        data-hora="<?= htmlspecialchars($horaAgendamento, ENT_QUOTES, 'UTF-8') ?>"
                                        data-descricao="<?= htmlspecialchars($agendamento['descricao'] ?? 'Nenhuma descrição informada.', ENT_QUOTES, 'UTF-8') ?>">
                                        Ver mais
                                    </button>

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

                            <a href="./agendamento.php" class="relative inline-flex items-center justify-center rounded-full bg-sky-800 px-5 py-2.5 text-sm font-semibold text-white transition duration-300 hover:bg-sky-700">

                                Ver Pedidos

                                <?php if ($temAgendamentoPendente): ?>

                                    <span class="absolute -right-1 -top-1 flex h-3 w-3">

                                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>

                                        <span class="relative inline-flex h-3 w-3 rounded-full border-2 border-white bg-red-500"></span>

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

</main>


<!-- MODAL -->

<div id="modalAgendamento" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 px-4 backdrop-blur-sm">

    <div id="cardModalAgendamento" class="w-full max-w-lg scale-95 transform overflow-hidden rounded-3xl bg-white opacity-0 shadow-2xl transition-all duration-300">

        <div class="flex items-center justify-between bg-sky-800 px-6 py-5 text-white">

            <div>
                <div class="flex items-center gap-2">
                    <p class="text-xs font-semibold uppercase tracking-wider text-sky-300 font-poppins">
                        Detalhes
                    </p>

                    <span
                        id="modalId"
                        class="text-xs font-semibold text-sky-300/70 font-poppins"></span>
                </div>

                <h2 class="text-xl font-semibold font-poppins">
                    Agendamento
                </h2>
            </div>

            <button
                type="button"
                id="fecharModalAgendamento"
                class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20"
                aria-label="Fechar">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>

            </button>

        </div>


        <div class="px-6 py-6">

            <div id="modalStatus" class="mb-6 flex items-center justify-between gap-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">

                <div class="flex items-center gap-3">

                    <div id="modalStatusIcon" class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                        </svg>

                    </div>

                    <p id="modalStatusText" class="font-poppins text-base font-bold text-emerald-700">
                        Agendamento confirmado
                    </p>

                </div>

                <span id="modalStatusBadge" class="rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-bold text-emerald-700">
                    CONFIRMADO
                </span>

            </div>


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                        Cliente
                    </p>

                    <p id="modalProfissional" class="truncate text-sm font-semibold text-gray-700 font-poppins">
                        -
                    </p>

                </div>


                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                        Identificação
                    </p>

                    <p id="modalIdentificacao" class="text-sm font-semibold text-gray-700 font-poppins">
                        AG-00000
                    </p>

                </div>


                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                        Data
                    </p>

                    <p id="modalData" class="text-sm font-semibold text-gray-700 font-poppins">
                        -
                    </p>

                </div>


                <div class="rounded-2xl bg-slate-50 p-4">

                    <p class="mb-1 text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                        Horário
                    </p>

                    <p id="modalHora" class="text-sm font-semibold text-gray-700 font-poppins">
                        -
                    </p>

                </div>

            </div>


            <div class="mt-4 rounded-2xl bg-slate-50 p-4">

                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                    Descrição
                </p>

                <p id="modalDescricao" class="max-h-32 overflow-y-auto text-sm leading-relaxed text-gray-600 font-poppins">
                    Nenhuma descrição informada.
                </p>

            </div>

        </div>


        <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">

            <button
                type="button"
                id="fecharModalAgendamentoBottom"
                class="w-full rounded-xl bg-sky-800 px-4 py-3 text-sm font-semibold text-white transition duration-300 hover:bg-sky-700 font-poppins">
                Fechar
            </button>

        </div>

    </div>

</div>

<script src="<?= ROOT_PATH ?>assets/script.js" defer></script>