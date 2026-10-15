<?php require_once __DIR__ . '/../../../service/access.php'; exigirUsuario('cliente'); ?>
<?php require_once __DIR__ . '/../../../controllers/pages__Cliente__aplicacao__dashboard.php'; ?>
<?php require_once __DIR__ . '/../../../includes/header.php'; ?>



<main class="flex-1 bg-sky-300">
    <div class="flex w-full justify-center items-center py-35">
        <div class="bg-white w-full md:max-w-2xl items-center lg:max-w-7xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden">
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

                        <a href="./categorias.php" class="bg-sky-400 rounded-xl border-1 h-40 flex flex-col justify-center items-center shadow-lg hover:bg-sky-500 duration-300">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-20 stroke-white"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                                />
                            </svg>
                            <p class="text-white text-2xl font-bold font-poppins">
                                Agendamentos
                            </p>
                        </a>

                        <div class="bg-gray-100 rounded-xl border-1 h-56 flex flex-col justify-start items-center shadow-lg">
                            <?php if (!empty($agendamentos)) { ?>
                                <div class="w-full px-4 py-3 flex flex-col gap-2 overflow-y-auto">
                                    <?php foreach ($agendamentos as $agendamento) { ?>
                                        <?php $confirmado = $agendamento['status'] === 'confirmado';?>

                                        <div class="bg-white rounded-lg border-1 px-4 py-3 flex items-center justify-between gap-3">
                                            <div class="font-poppins">
                                                <h3 class="font-semibold text-gray-700">
                                                    <?php if ($confirmado) { ?>
                                                        Agendamento Confirmado
                                                    <?php } else { ?>
                                                        Agendamento Pendente
                                                    <?php } ?>
                                                </h3>
                                                <p class="text-sm text-gray-500">
                                                    <?= date('d/m/Y', strtotime($agendamento['data'])) ?>
                                                    às
                                                    <?= date('H:i', strtotime($agendamento['data'])) ?>
                                                </p>
                                            </div>


                                            <button type="button" class="abrir-modal-agendamento bg-sky-400 text-white px-3 py-2 rounded-lg font-poppins text-sm font-semibold hover:bg-sky-500 duration-300 whitespace-nowrap"
                                                data-id="<?= (int) $agendamento['id'] ?>"
                                                data-status="<?= htmlspecialchars($agendamento['status'], ENT_QUOTES, 'UTF-8') ?>"
                                                data-profissional="<?= htmlspecialchars($agendamento['profissional'], ENT_QUOTES,'UTF-8') ?>"
                                                data-data="<?= htmlspecialchars(date('d/m/Y', strtotime($agendamento['data'])), ENT_QUOTES, 'UTF-8') ?>"
                                                data-hora="<?= htmlspecialchars(date('H:i', strtotime($agendamento['data'])), ENT_QUOTES, 'UTF-8') ?>"
                                                data-descricao="<?= htmlspecialchars($agendamento['descricao'] ?? 'Nenhuma descrição informada.', ENT_QUOTES, 'UTF-8') ?>"
                                            >
                                                Ver mais
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>

                            <?php } else { ?>


                                <div class="flex flex-col justify-center items-center h-full">
                                    <div class="bg-sky-400 w-24 h-24 rounded-full flex items-center justify-center">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="size-16 stroke-white"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 1-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                                            />
                                        </svg>
                                    </div>
                                    <p class="mt-5 font-poppins font-medium text-gray-700">
                                        Nenhum Agendamento
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
                            <a href="<?= ROOT_PATH ?>pages/Cliente/aplicacao/usuario/perfil.php" class="w-full bg-sky-400 text-center text-xl rounded-full py-4 font-semibold text-white transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500">
                                Ver Perfil
                            </a>
                            <a href="<?= ROOT_PATH ?>actions/logout.php" class="w-full max-w-xs bg-sky-400 text-center text-xl rounded-full py-4 font-semibold text-white transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-red-600">
                                Sair
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<div id="modalAgendamento" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/70 backdrop-blur-sm px-4 py-6">
    <div id="cardModalAgendamento" class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-white rounded-3xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
        <div class="relative overflow-hidden rounded-t-3xl bg-gradient-to-br from-sky-500 via-sky-500 to-cyan-500 p-6 sm:p-7">
            <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-16 -left-10 h-36 w-36 rounded-full bg-white/10"></div>
            <div class="relative flex items-start justify-between gap-4">
                <div>
                    <span class="font-poppins text-[11px] font-bold uppercase tracking-[0.2em] text-white/70">
                        Detalhes do agendamento
                    </span>
                    <h2 class="mt-1 font-poppins text-2xl sm:text-3xl font-bold text-white">
                        Agendamento
                        <span id="modalId">
                            #--
                        </span>
                    </h2>
                    <p class="mt-1 font-poppins text-sm text-white/80">
                        Aiiin Marcelinho
                    </p>
                </div>

                <button type="button" id="fecharModalAgendamento" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/15 text-white transition-all duration-300 hover:bg-white/25 hover:rotate-90" aria-label="Fechar modal">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>


        <div class="p-5 sm:p-7">
            <div id="modalStatus" class="mb-6 flex items-center justify-between gap-4 rounded-2xl border p-4">
                <div class="flex items-center gap-3">
                    <div id="modalStatusIcon" class="flex h-11 w-11 items-center justify-center rounded-xl">
                    </div>
                    <div>
                        <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-gray-400">
                            Status
                        </p>
                        <p id="modalStatusText" class="font-poppins text-base font-bold">
                            --
                        </p>
                    </div>
                </div>
                <span id="modalStatusBadge" class="rounded-full px-3 py-1.5 text-xs font-bold">
                    --
                </span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                                />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-gray-400">
                                Profissional
                            </p>
                            <p id="modalProfissional" class="mt-1 font-poppins font-semibold text-gray-800 break-words">
                                --
                            </p>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3.75 9h16.5M5.25 5.25h13.5A1.5 1.5 0 0 1 20.25 6.75v12A1.5 1.5 0 0 1 18.75 20.25H5.25a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5Z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-gray-400">
                                Data
                            </p>
                            <p id="modalData" class="mt-1 font-poppins font-semibold text-gray-800">
                                --
                            </p>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 6v6l4 2.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-gray-400">
                                Horário
                            </p>
                            <p id="modalHora" class="mt-1 font-poppins font-semibold text-gray-800">
                                --
                            </p>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                    <div class="flex items-start gap-3">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.8"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h4m5.25-9.75v11.25A2.25 2.25 0 0 1 16 19.75H8A2.25 2.25 0 0 1 5.75 17.5V6.5A2.25 2.25 0 0 1 8 4.25h5.75L18.25 8v8.25M13.75 4.5V8h3.5"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-gray-400">
                                Identificação
                            </p>
                            <p id="modalIdentificacao" class="mt-1 font-poppins font-semibold text-gray-800">
                                --
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="rounded-2xl border border-gray-200 overflow-hidden">
                    <div class="border-b border-gray-200 bg-gray-50 px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8.25 6.75h7.5M8.25 10.5h7.5M8.25 14.25h4.5M6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75Z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <p class="font-poppins font-semibold text-gray-800">
                                    Descrição do atendimento
                                </p>
                                <p class="font-poppins text-xs text-gray-400">
                                    Informações fornecidas durante o agendamento
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-5">
                        <p id="modalDescricao" class="font-poppins text-sm leading-7 text-gray-600 whitespace-pre-line">
                            --
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" id="fecharModalAgendamentoBottom" class="w-full sm:w-auto rounded-xl bg-gray-900 px-6 py-3 font-poppins text-sm font-semibold text-white transition-all duration-200 hover:bg-gray-800 active:scale-95">
                    Fechar
                </button>
            </div>
        </div>
    </div>

</div>

<script src="<?= ROOT_PATH ?>assets/script.js" defer></script>
