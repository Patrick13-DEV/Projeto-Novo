<?php
include_once("../../../constante.php");
include_once("../../../service/conexao.php");
include_once("../../../service/auth.php");

$idUser = (int) $_SESSION['idUser'];

function escapar($valor)
{
    return htmlspecialchars((string) ($valor ?? ''), ENT_QUOTES, 'UTF-8');
}
function statusTexto($status)
{
    $statusNomes = [
        'pendente' => 'Pendente',
        'confirmado' => 'Confirmado',
        'concluido' => 'Concluído',
        'cancelado' => 'Cancelado'
    ];

    return $statusNomes[$status] ?? ucfirst((string) $status);
}
function statusClasse($status)
{
    switch ($status) {
        case 'confirmado':
            return 'bg-emerald-100 text-emerald-700';

        case 'concluido':
            return 'bg-blue-100 text-blue-700';

        case 'cancelado':
            return 'bg-red-100 text-red-700';

        default:
            return 'bg-amber-100 text-amber-700';
    }
}
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

include_once("../../../includes/header.php");
?>

<main class="flex-1 bg-sky-300 px-3 py-5 sm:px-4 lg:px-8">
    <div class="mx-auto w-full max-w-6xl overflow-hidden rounded-3xl bg-white shadow-xl">
        <div class="bg-sky-800 px-5 py-6 text-white sm:px-8 sm:py-7">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="mt-2 font-poppins text-2xl font-semibold sm:text-3xl">
                        Histórico de agendamentos
                    </h1>
                </div>
                <a
                    href="./dashboard.php"
                    class="inline-flex items-center justify-center gap-2 self-start rounded-xl bg-white/10 px-4 py-3 font-poppins text-sm font-semibold text-white transition hover:bg-white/20 sm:self-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Voltar
                </a>
            </div>
        </div>

        <div class="px-4 py-5 sm:px-8 sm:py-7">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="font-poppins text-lg font-semibold text-slate-800">
                        Seus atendimentos
                    </h2>
                </div>
                <div class="rounded-full bg-sky-100 px-4 py-2 font-poppins text-sm font-semibold text-sky-800">
                    <?= count($agendamentos) ?> registro(s)
                </div>
            </div>

            <form method="GET" class="mb-6 rounded-2xl bg-slate-50 p-4">
                <div class="grid gap-3 md:grid-cols-[1fr_210px_auto]">
                    <div>
                        <label for="pesquisa" class="mb-2 block font-poppins text-sm font-semibold text-slate-700">
                            Pesquisar paciente
                        </label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400">
                                <circle cx="10.5" cy="10.5" r="6.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16 16 5 5" />
                            </svg>
                            <input
                                type="search"
                                name="pesquisa"
                                id="pesquisa"
                                value="<?= escapar($pesquisa) ?>"
                                placeholder="Nome do paciente..."
                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-10 pr-4 font-poppins text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                        </div>
                    </div>
                    <div>
                        <label for="status" class="mb-2 block font-poppins text-sm font-semibold text-slate-700">
                            Status
                        </label>
                        <select
                            name="status"
                            id="status"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-3 font-poppins text-sm outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                            <option value="">Todos</option>
                            <option value="confirmado" <?= $statusFiltro === 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
                            <option value="concluido" <?= $statusFiltro === 'concluido' ? 'selected' : '' ?>>Concluído</option>
                            <option value="cancelado" <?= $statusFiltro === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                            <option value="pendente" <?= $statusFiltro === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button
                            type="submit"
                            class="flex-1 rounded-xl bg-sky-800 px-5 py-3 font-poppins text-sm font-semibold text-white transition hover:bg-sky-700 md:flex-none">
                            Filtrar
                        </button>
                        <a
                            href="./historico.php"
                            class="rounded-xl border border-slate-200 bg-white px-4 py-3 font-poppins text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                            Limpar
                        </a>
                    </div>
                </div>
            </form>

            <div class="overflow-hidden rounded-2xl border border-slate-200">
                <div class="border-b border-slate-200 bg-slate-50 px-4 py-3 sm:px-5">
                    <p class="font-poppins text-sm font-semibold text-slate-600">
                        Lista de agendamentos
                    </p>
                </div>
                <?php if (!empty($agendamentos)): ?>
                    <div class="grid grid-cols-1 gap-3 p-3 md:grid-cols-2">
                        <?php foreach ($agendamentos as $agendamento): ?>
                            <?php
                            $timestamp = strtotime($agendamento['data']);
                            $dataFormatada = date('d/m/Y', $timestamp);
                            $horaFormatada = date('H:i', $timestamp);
                            ?>
                            <div class="flex flex-col justify-between gap-3 rounded-xl border border-slate-200 bg-white p-4 transition hover:bg-slate-50">
                                <div class="flex min-w-0 items-start gap-3">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 4.5 1.122 9.6 9.6 0 0 0 2.25-.266 4.5 4.5 0 0 0-7.5-3.356M15 19.128v-.003a6.375 6.375 0 0 0-12.75 0v.003A12.3 12.3 0 0 0 8.625 21c2.3 0 4.44-.63 6.375-1.728ZM12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="break-words font-poppins text-base font-semibold text-slate-800">
                                            <?= escapar($agendamento['cliente']) ?>
                                        </h3>
                                        <div class="mt-2 flex flex-wrap gap-x-4 gap-y-2 font-poppins text-sm text-slate-500">
                                            <span class="inline-flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1-2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" />
                                                </svg>
                                                <?= $dataFormatada ?>
                                            </span>

                                            <span class="inline-flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2" />
                                                </svg>
                                                <?= $horaFormatada ?>
                                            </span>

                                            <span class="text-xs text-slate-400">
                                                AG-<?= str_pad((string) $agendamento['id'], 5, '0', STR_PAD_LEFT) ?>
                                            </span>

                                        </div>

                                        <div class="mt-3">
                                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold <?= statusClasse($agendamento['status']) ?>">
                                                <?= escapar(statusTexto($agendamento['status'])) ?>
                                            </span>
                                        </div>

                                    </div>

                                </div>

                                <button
                                    type="button"
                                    class="abrirDetalhesHistorico inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-sky-800 px-4 py-2.5 font-poppins text-sm font-semibold text-white transition hover:bg-sky-700"
                                    data-id="<?= (int) $agendamento['id'] ?>"
                                    data-cliente="<?= escapar($agendamento['cliente']) ?>"
                                    data-data="<?= escapar($dataFormatada) ?>"
                                    data-hora="<?= escapar($horaFormatada) ?>"
                                    data-status="<?= escapar(statusTexto($agendamento['status'])) ?>"
                                    data-descricao="<?= escapar($agendamento['descricao'] ?? 'Nenhuma descrição informada.') ?>">
                                    Ver mais
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" />
                                    </svg>
                                </button>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="px-5 py-14 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-100 text-sky-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="h-7 w-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 0 1-2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" />
                            </svg>
                        </div>

                        <h3 class="mt-4 font-poppins text-lg font-semibold text-slate-800">
                            Nenhum agendamento encontrado
                        </h3>

                        <p class="mt-2 font-poppins text-sm text-slate-500">
                            Tente alterar a pesquisa ou os filtros selecionados.
                        </p>

                        <?php if ($pesquisa !== '' || $statusFiltro !== ''): ?>
                            <a href="./historico.php" class="mt-4 inline-flex rounded-lg bg-sky-800 px-4 py-2.5 font-poppins text-sm font-semibold text-white hover:bg-sky-700">
                                Limpar filtros
                            </a>
                        <?php endif; ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</main>

<!-- MODAL -->

<div
    id="modalDetalhesHistorico"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm"
    role="dialog"
    aria-modal="true"
    aria-labelledby="tituloModalHistorico">
    <div
        id="cardDetalhesHistorico"
        class="max-h-[90vh] w-full max-w-2xl scale-95 overflow-y-auto rounded-3xl bg-white opacity-0 shadow-2xl transition-all duration-300">

        <div class="flex items-start justify-between gap-4 bg-sky-800 px-6 py-6 text-white sm:px-8">

            <div>
                <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-sky-200">
                    Área profissional
                </p>

                <h2 id="tituloModalHistorico" class="mt-1 font-poppins text-xl font-semibold sm:text-2xl">
                    Detalhes do agendamento
                </h2>

                <p id="historicoCodigo" class="mt-2 font-poppins text-sm text-sky-100"></p>
            </div>

            <button
                type="button"
                id="fecharModalHistorico"
                aria-label="Fechar modal"
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20">
                ✕
            </button>

        </div>

        <div class="space-y-5 px-6 py-6 sm:px-8 sm:py-8">

            <div class="rounded-2xl bg-slate-50 p-5">
                <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Paciente
                </p>

                <p id="historicoCliente" class="mt-2 break-words font-poppins text-lg font-semibold text-slate-800"></p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">

                <div class="rounded-xl border border-slate-200 p-4">
                    <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Data
                    </p>
                    <p id="historicoData" class="mt-2 font-poppins font-semibold text-slate-700"></p>
                </div>

                <div class="rounded-xl border border-slate-200 p-4">
                    <p class="font-poppins text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Horário
                    </p>
                    <p id="historicoHora" class="mt-2 font-poppins font-semibold text-slate-700"></p>
                </div>

            </div>

            <div>
                <p class="mb-2 font-poppins text-sm font-semibold text-slate-700">
                    Status
                </p>
                <span id="historicoStatus" class="inline-flex rounded-full px-3 py-1.5 text-sm font-bold"></span>
            </div>

            <div>
                <p class="mb-2 font-poppins text-sm font-semibold text-slate-700">
                    Descrição
                </p>
                <div id="historicoDescricao" class="min-h-24 whitespace-pre-wrap break-words rounded-xl border border-slate-200 bg-slate-50 p-4 font-poppins text-sm leading-6 text-slate-600"></div>
            </div>

        </div>

        <div class="flex justify-end border-t border-slate-100 px-6 py-5 sm:px-8">
            <button
                type="button"
                id="fecharModalHistoricoBottom"
                class="rounded-lg bg-sky-800 px-6 py-3 font-poppins text-sm font-semibold text-white transition hover:bg-sky-700">
                Fechar
            </button>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("modalDetalhesHistorico");
        const card = document.getElementById("cardDetalhesHistorico");
        const botoes = document.querySelectorAll(".abrirDetalhesHistorico");
        const fecharTopo = document.getElementById("fecharModalHistorico");
        const fecharBase = document.getElementById("fecharModalHistoricoBottom");

        const codigo = document.getElementById("historicoCodigo");
        const cliente = document.getElementById("historicoCliente");
        const data = document.getElementById("historicoData");
        const hora = document.getElementById("historicoHora");
        const status = document.getElementById("historicoStatus");
        const descricao = document.getElementById("historicoDescricao");

        function abrirModal(botao) {
            codigo.textContent = "Código: AG-" + String(botao.dataset.id).padStart(5, "0");
            cliente.textContent = botao.dataset.cliente || "Não informado";
            data.textContent = botao.dataset.data || "Não informada";
            hora.textContent = botao.dataset.hora || "Não informado";
            status.textContent = botao.dataset.status || "Não informado";
            descricao.textContent = botao.dataset.descricao || "Nenhuma descrição informada.";

            const classesStatus = {
                "Confirmado": "bg-emerald-100 text-emerald-700",
                "Concluído": "bg-blue-100 text-blue-700",
                "Cancelado": "bg-red-100 text-red-700",
                "Pendente": "bg-amber-100 text-amber-700"
            };

            status.className = "inline-flex rounded-full px-3 py-1.5 text-sm font-bold " +
                (classesStatus[status.textContent] || "bg-slate-100 text-slate-700");

            modal.classList.remove("hidden");
            modal.classList.add("flex");
            document.body.classList.add("overflow-hidden");

            requestAnimationFrame(function() {
                card.classList.remove("scale-95", "opacity-0");
                card.classList.add("scale-100", "opacity-100");
            });
        }

        function fecharModal() {
            card.classList.remove("scale-100", "opacity-100");
            card.classList.add("scale-95", "opacity-0");

            setTimeout(function() {
                modal.classList.remove("flex");
                modal.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            }, 300);
        }

        botoes.forEach(function(botao) {
            botao.addEventListener("click", function() {
                abrirModal(botao);
            });
        });

        fecharTopo.addEventListener("click", fecharModal);
        fecharBase.addEventListener("click", fecharModal);

        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                fecharModal();
            }
        });

        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape" && !modal.classList.contains("hidden")) {
                fecharModal();
            }
        });
    });
</script>