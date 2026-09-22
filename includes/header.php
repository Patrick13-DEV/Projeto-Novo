<?php 


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="./src/output.css" rel="stylesheet" />
    <title>InovaVida - SENAC</title>
</head>

<body>
    <header class="bg-white">
        <nav class="">
            <div class="">
                <ul class="flex items-center gap-4">
                    <li><a class="hover:text-gray-500 " href="<?= ROOT_PATH ?>index.php">InovaVida <?= $nomeUser ? " - $nomeUser" : "" ?></a></li>
                    <li><a class="hover:text-gray-500 " href="<?= ROOT_PATH ?>pages/escolha/cliente.php">Cliente</a></li>
                    <li><a class="hover:text-gray-500 " href="<?= ROOT_PATH ?>pages/escolha/profissional.php">Profissional da Saúde</a></li>
                </ul>
            </div>
            <div class="">
                <button class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">Sign In</button>
            </div>
        </nav>
    </header>