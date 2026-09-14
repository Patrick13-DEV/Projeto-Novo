<?php

include_once("../../../constante.php");
include_once("../../../service/conexao.php");
include_once("../../../service/auth.php");


// ============================================================
// PROFISSIONAL SELECIONADO
// ============================================================

$profissionalId = isset($_GET['profissional'])
    ? (int) $_GET['profissional']
    : 0;


// ============================================================
// BUSCAR PROFISSIONAL
// ============================================================

$profissional = null;

if ($profissionalId > 0) {

    $sql = "SELECT id, nome, especialidade
            FROM profissionais
            WHERE id = :id";

    $stmt = $conexao->prepare($sql);

    $stmt->bindValue(
        ':id',
        $profissionalId,
        PDO::PARAM_INT
    );

    $stmt->execute();

    $profissional = $stmt->fetch(PDO::FETCH_ASSOC);
}


// ============================================================
// DATA ATUAL
// ============================================================

$dataAtual = new DateTime();


// ============================================================
// DATAS DISPONÍVEIS
// Serão mostrados os próximos 60 dias,
// começando pelo dia atual.
// ============================================================

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

$nomesMeses = [
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
];


for ($i = 0; $i < 60; $i++) {

    $data = clone $dataAtual;

    $data->modify("+{$i} days");

    $diaSemana = $nomesDias[$data->format('l')];

    $dias[] = [
        'nome'   => $diaSemana,
        'numero' => $data->format('d'),
        'mes'    => $data->format('m'),
        'ano'    => $data->format('Y'),
        'mesNome'=> $nomesMeses[$data->format('m')],
        'data'   => $data->format('Y-m-d')
    ];
}

?>

<!doctype html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    />

    <link
        href="../../../src/output.css"
        rel="stylesheet"
    />

    <title>Inova Vida Tech</title>

</head>


<body>

    <div class="min-h-screen bg-sky-300 px-3 py-4 sm:px-4 md:px-6 lg:px-8 flex items-center justify-center">

        <div class="w-full max-w-6xl bg-white rounded-t-[2rem] sm:rounded-[2.5rem] shadow-lg overflow-hidden">

            <div class="p-4 sm:p-6 lg:p-8">

                <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">


                    <!-- ================================================= -->
                    <!-- LADO ESQUERDO -->
                    <!-- ================================================= -->

                    <div class="w-full lg:w-[55%] flex flex-col gap-4">


                        <!-- Título -->

                        <div class="flex items-center justify-between gap-3">

                            <h1 class="text-2xl sm:text-3xl font-poppins font-semibold">

                                Agendamento

                            </h1>


                            <a
                                href="./dashboard.php"
                                class="text-sm text-sky-600 hover:text-sky-700 font-poppins"
                            >

                                Voltar

                            </a>

                        </div>


                        <!-- ================================================= -->
                        <!-- PROFISSIONAL -->
                        <!-- ================================================= -->

                        <div class="border border-gray-200 rounded-xl p-4 shadow-sm">

                            <div class="flex items-center gap-4">


                                <div class="bg-sky-400 w-14 h-14 rounded-full shrink-0">
                                </div>


                                <div class="flex-1 min-w-0">

                                    <?php if ($profissional): ?>

                                        <p class="font-poppins font-semibold text-lg">

                                            <?= htmlspecialchars($profissional['nome']) ?>

                                        </p>


                                        <p class="font-poppins text-sm text-gray-500">

                                            <?= htmlspecialchars($profissional['especialidade']) ?>

                                        </p>

                                    <?php else: ?>

                                        <p class="font-poppins font-semibold text-lg">

                                            Profissional não encontrado

                                        </p>

                                    <?php endif; ?>

                                </div>


                                <div class="flex items-center gap-1 text-sm font-medium text-gray-700 shrink-0">

                                    <span>4,5</span>

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-5 stroke-green-500"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                                        />

                                    </svg>

                                </div>

                            </div>


                            <div class="flex justify-end mt-4">

                                <a
                                    href="../../profissional/usuario/perfil.php"
                                    class="font-poppins text-sm sm:text-base text-green-600 border border-green-500 rounded-md px-4 py-2 hover:bg-green-500 hover:text-white transition-colors"
                                >

                                    Ver Perfil

                                </a>

                            </div>

                        </div>


                        <!-- ================================================= -->
                        <!-- DATA E HORÁRIO -->
                        <!-- ================================================= -->

                        <div>

                            <h2 class="font-poppins text-xl font-semibold mb-4">

                                Selecione Dia e Tempo

                            </h2>


                            <!-- ================================================= -->
                            <!-- DROPDOWN DE DATA -->
                            <!-- ================================================= -->

                            <div class="mb-4">

                                <label
                                    for="dataAgendamento"
                                    class="block font-poppins text-sm font-medium text-gray-700 mb-2"
                                >

                                    Dia do agendamento

                                </label>


                                <select
                                    id="dataAgendamento"
                                    name="data"
                                    class="w-full bg-white border border-gray-200 rounded-lg py-3 px-4 text-center shadow-sm text-gray-700 outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-400 transition-colors"
                                >

                                    <option value="">

                                        Selecione uma data

                                    </option>


                                    <?php foreach ($dias as $dia): ?>

                                        <option
                                            value="<?= $dia['data'] ?>"
                                        >

                                            <?= $dia['numero'] ?>/<?= $dia['mes'] ?>/<?= $dia['ano'] ?>
                                            — <?= $dia['nome'] ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>


                            <!-- ================================================= -->
                            <!-- PERÍODO -->
                            <!-- ================================================= -->

                            <div
                                id="periodosAgendamento"
                                class="grid grid-cols-3 gap-3 mb-4"
                            >

                                <button
                                    type="button"
                                    class="periodo-agendamento bg-sky-400 text-white rounded-lg py-3 text-center shadow-sm"
                                    data-periodo="manha"
                                >

                                    Manhã

                                </button>


                                <button
                                    type="button"
                                    class="periodo-agendamento bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700 hover:border-sky-400"
                                    data-periodo="tarde"
                                >

                                    Tarde

                                </button>


                                <button
                                    type="button"
                                    class="periodo-agendamento bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700 hover:border-sky-400"
                                    data-periodo="noite"
                                >

                                    Noite

                                </button>

                            </div>


                            <!-- ================================================= -->
                            <!-- HORÁRIOS -->
                            <!-- ================================================= -->

                            <div
                                id="horariosAgendamento"
                                class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4"
                            >

                                <button
                                    type="button"
                                    class="horario-agendamento bg-sky-400 text-white rounded-lg py-3 text-center shadow-sm"
                                    data-horario="11:00 - 12:00"
                                >

                                    11:00 - 12:00

                                </button>


                                <button
                                    type="button"
                                    class="horario-agendamento bg-gray-200 text-gray-500 rounded-lg py-3 text-center shadow-sm cursor-not-allowed"
                                    data-horario="12:00 - 13:00"
                                    disabled
                                >

                                    12:00 - 13:00

                                </button>


                                <button
                                    type="button"
                                    class="horario-agendamento bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700 hover:border-sky-400"
                                    data-horario="13:00 - 14:00"
                                >

                                    13:00 - 14:00

                                </button>


                                <button
                                    type="button"
                                    class="horario-agendamento bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700 hover:border-sky-400"
                                    data-horario="14:00 - 15:00"
                                >

                                    14:00 - 15:00

                                </button>


                                <button
                                    type="button"
                                    class="horario-agendamento bg-gray-200 text-gray-500 rounded-lg py-3 text-center shadow-sm cursor-not-allowed"
                                    data-horario="15:00 - 16:00"
                                    disabled
                                >

                                    15:00 - 16:00

                                </button>


                                <button
                                    type="button"
                                    class="horario-agendamento bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700 hover:border-sky-400"
                                    data-horario="16:00 - 17:00"
                                >

                                    16:00 - 17:00

                                </button>

                            </div>

                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- LADO DIREITO -->
                    <!-- ================================================= -->

                    <div class="w-full lg:w-[45%] flex flex-col gap-4">


                        <div class="rounded-xl border border-gray-200 p-4 shadow-sm">

                            <label
                                for="sintomas"
                                class="block text-sm font-semibold font-poppins text-gray-700 mb-2"
                            >

                                Descrição dos sintomas

                            </label>


                            <textarea
                                id="sintomas"
                                rows="6"
                                class="w-full rounded-lg border border-gray-300 p-3 outline-none font-poppins text-sm italic resize-none"
                                placeholder="Faça uma descrição sobre seus sintomas"
                            ></textarea>

                        </div>


                        <button
                            type="button"
                            id="processarAgendamento"
                            class="flex justify-center items-center font-poppins bg-black text-base sm:text-lg text-white w-full h-12 rounded-lg hover:bg-gray-800 transition-colors"
                        >

                            Processar Agendamento

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ========================================================= -->
    <!-- SCRIPT -->
    <!-- ========================================================= -->

    <script src="../../../assets/script.js"></script>

</body>

</html>