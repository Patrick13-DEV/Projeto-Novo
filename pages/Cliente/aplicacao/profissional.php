<?php

include_once("../../../constante.php");
include_once("../../../service/conexao.php");
include_once("../../../service/auth.php");


$categoria = $_GET['categoria'] ?? '';

$categoria = trim($categoria);


$porPagina = 6;

$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

if ($pagina < 1) {
    $pagina = 1;
}

$inicio = ($pagina - 1) * $porPagina;

$totalProfissionais = 0;

if ($categoria !== '') {

    $sqlTotal = "SELECT COUNT(*)
                 FROM profissionais
                 WHERE especialidade = :especialidade";

    $stmtTotal = $conexao->prepare($sqlTotal);

    $stmtTotal->bindValue(
        ':especialidade',
        $categoria,
        PDO::PARAM_STR
    );

    $stmtTotal->execute();

    $totalProfissionais = (int) $stmtTotal->fetchColumn();
}

$totalPaginas = ceil($totalProfissionais / $porPagina);


$profissionais = [];

if ($categoria !== '' && $totalProfissionais > 0) {

    $sql = "SELECT id, nome, especialidade
            FROM profissionais
            WHERE especialidade = :especialidade
            ORDER BY nome ASC
            LIMIT :inicio, :porPagina";

    $stmt = $conexao->prepare($sql);

    $stmt->bindValue(
        ':especialidade',
        $categoria,
        PDO::PARAM_STR
    );

    $stmt->bindValue(
        ':inicio',
        $inicio,
        PDO::PARAM_INT
    );

    $stmt->bindValue(
        ':porPagina',
        $porPagina,
        PDO::PARAM_INT
    );

    $stmt->execute();

    $profissionais = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!doctype html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../../../src/output.css" rel="stylesheet">

    <title>Profissionais</title>

</head>

<body>

    <div class="min-h-screen bg-sky-300 md:px-6 flex items-end md:items-center justify-center">

        <div class="bg-white w-full md:max-w-6xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden">

            <div class="p-6 md:p-10">

                <h1 class="text-3xl md:text-4xl font-poppins font-semibold mb-2">

                    <?= htmlspecialchars($categoria) ?>

                </h1>


                <p class="text-gray-500 font-poppins mb-8">
                    Escolha um profissional para realizar seu agendamento.
                </p>

                <?php if ($categoria === ''): ?>

                    <div class="flex items-center justify-center py-16">

                        <p class="text-gray-500 font-poppins text-lg">

                            Nenhuma especialidade selecionada.

                        </p>

                    </div>

                <?php elseif ($totalProfissionais === 0): ?>

                    <div class="flex items-center justify-center py-16">

                        <p class="text-gray-500 font-poppins text-lg">

                            Nenhum especialista encontrado

                        </p>

                    </div>
                <?php else: ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">


                        <?php foreach ($profissionais as $profissional): ?>


                            <a
                                href="./agendamento.php?profissional=<?= $profissional['id'] ?>"
                                class="border rounded-xl p-5 flex flex-col
                                    hover:shadow-md hover:border-sky-400
                                    transition duration-200">

                                <div class="flex items-center gap-4">


                                    <div
                                        class="w-14 h-14 bg-sky-400 rounded-full
                                               flex items-center justify-center
                                               shrink-0">

                                        <span class="text-white text-xl font-semibold">

                                            <?= strtoupper(substr($profissional['nome'], 0, 1)) ?>

                                        </span>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-semibold font-poppins truncate">

                                            <?= htmlspecialchars($profissional['nome']) ?>

                                        </p>


                                        <p class="text-sm text-sky-500 font-poppins">

                                            <?= htmlspecialchars($profissional['especialidade']) ?>

                                        </p>

                                    </div>

                                </div>


                                <!-- Botão -->

                                <div class="mt-5">

                                    <span
                                        class="block text-center bg-sky-400
                                               text-white rounded-lg py-2
                                               font-poppins text-sm
                                               hover:bg-sky-500 transition">

                                        Agendar

                                    </span>

                                </div>

                            </a>


                        <?php endforeach; ?>


                    </div>


                    <!-- ================================================= -->
                    <!-- Paginação -->
                    <!-- ================================================= -->

                    <?php if ($totalPaginas > 1): ?>

                        <div class="flex justify-center items-center gap-2 mt-10">


                            <!-- Página anterior -->

                            <?php if ($pagina > 1): ?>

                                <a
                                    href="?categoria=<?= urlencode($categoria) ?>&pagina=<?= $pagina - 1 ?>"
                                    class="px-4 py-2 border rounded-lg
                                           font-poppins text-sm
                                           hover:bg-sky-100 transition">

                                    Anterior

                                </a>

                            <?php endif; ?>


                            <!-- Números -->

                            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>

                                <a
                                    href="?categoria=<?= urlencode($categoria) ?>&pagina=<?= $i ?>"
                                    class="
                                        px-4 py-2 rounded-lg
                                        font-poppins text-sm
                                        transition

                                        <?= $i == $pagina
                                            ? 'bg-sky-400 text-white'
                                            : 'border hover:bg-sky-100'
                                        ?>
                                    ">

                                    <?= $i ?>

                                </a>

                            <?php endfor; ?>


                            <!-- Próxima página -->

                            <?php if ($pagina < $totalPaginas): ?>

                                <a
                                    href="?categoria=<?= urlencode($categoria) ?>&pagina=<?= $pagina + 1 ?>"
                                    class="px-4 py-2 border rounded-lg
                                           font-poppins text-sm
                                           hover:bg-sky-100 transition">

                                    Próxima

                                </a>

                            <?php endif; ?>


                        </div>

                    <?php endif; ?>


                <?php endif; ?>


            </div>

        </div>

    </div>

</body>

</html>