<?php

session_start();

include_once("../constante.php");
include_once("../service/conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['cliente_id'])) {

        $_SESSION['mensagem'] = "Cliente não identificado!";
        $_SESSION['cor'] = 'alert-danger';

        header("Location: " . ROOT_PATH . "auth/cliente/cadastro.php");
        exit;
    }

    $cliente_id = $_SESSION['cliente_id'];

    try {

        /*
        |--------------------------------------------------------------------------
        | CADASTRO DO INDICADOR
        |--------------------------------------------------------------------------
        */

        if ($_POST['text'] === 'indicador') {

            if (empty($_POST['indicador'])) {

                $_SESSION['mensagem'] = "Informe o indicador!";
                $_SESSION['cor'] = 'alert-danger';

                header(
                    "Location: " . ROOT_PATH . "auth/cliente/indicadores/segunda.php");
                exit;
            }

            $indicador = filter_input(INPUT_POST, "indicador", FILTER_SANITIZE_SPECIAL_CHARS);

            $sql = "INSERT INTO indicadores_saude (cliente_id, indicador) VALUES (:cliente_id, :indicador)";

            $insert = $conexao->prepare($sql);

            $insert->bindParam(":cliente_id", $cliente_id);
            $insert->bindParam(":indicador", $indicador);

            if ($insert->execute()) {

                $_SESSION['mensagem'] = "Indicador cadastrado com sucesso!";
                $_SESSION['cor'] = 'alert-success';
                header("Location: " . ROOT_PATH . "auth/cliente/indicadores/terceira.php");
                exit;
            }
        }

        if ($_POST['tipo'] === 'pressao') {

            if (empty($_POST['pressao'])) {
                $_SESSION['mensagem'] = "Informe a pressão arterial!";
                $_SESSION['cor'] = 'alert-danger';
                header(
                    "Location: " .ROOT_PATH ."auth/cliente/indicadores/terceira.php");
                exit;
            }

            $pressao = filter_input(INPUT_POST, "pressao", FILTER_SANITIZE_SPECIAL_CHARS);

            $sql = "INSERT INTO indicadores_saude (cliente_id, pressao) VALUES (:cliente_id, :pressao)";

            $insert = $conexao->prepare($sql);
            $insert->bindParam(":cliente_id", $cliente_id);
            $insert->bindParam(":pressao", $pressao);

            if ($insert->execute()) {
                $_SESSION['mensagem'] = "Pressão cadastrada com sucesso!";
                $_SESSION['cor'] = 'alert-success';

                header("Location: " . ROOT_PATH . "auth/cliente/indicadores/quarta.php");
                exit;
            }
        }

    } catch (Exception $e) {

        $_SESSION['mensagem'] = "Ocorreu um erro ao cadastrar!";
        $_SESSION['cor'] = 'alert-danger';

        header("Location: " . ROOT_PATH . "auth/cliente/indicadores/terceira.php");
        exit;
    }
}