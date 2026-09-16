<?php

include_once("../../../constante.php");
include_once("../../../service/conexao.php");
include_once("../../../service/auth.php");

$sql = "SELECT especialidade, COUNT(*) AS quantidade FROM profissionais WHERE especialidade IS NOT NULL AND especialidade != '' GROUP BY especialidade";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$profissionaisPorCategoria = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../src/output.css" rel="stylesheet">
    <title>Categorias</title>
</head>

<body>

    <div class="min-h-screen bg-sky-300 md:px-6 flex items-end md:items-center justify-center">

        <div class="bg-white w-full md:max-w-6xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden">

            <div class="p-6 md:p-10">
                <h1 class="text-3xl md:text-4xl font-poppins font-semibold mb-6">
                    Seja Bem-vindo, <?= htmlspecialchars($nomeUser) ?>!
                </h1>

                <div id="listaCategorias" class="grid grid-cols-2 lg:grid-cols-4 gap-5">

                </div>

                <p id="nenhumaCategoria" class="hidden text-center text-gray-500 font-poppins mt-8">
                    Nenhuma categoria encontrada.
                </p>
            </div>

        </div>

    </div>


</body>
<script>const profissionaisPorCategoria =<?= json_encode($profissionaisPorCategoria, JSON_UNESCAPED_UNICODE) ?>;</script>
<script src="../../../assets/script.js"></script>
</html>