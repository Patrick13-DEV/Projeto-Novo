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

        // CADASTRO DO INDICADOR
if (isset($_POST['tipo']) && $_POST['tipo'] === 'indicador') {

    if (empty($_POST['indicador'])) {
        $_SESSION['mensagem'] = "Informe alguma observação!";
        $_SESSION['cor'] = 'alert-danger';

        header("Location: " . ROOT_PATH . "auth/cliente/indicadores/segunda.php");
        exit;
    }

    $indicador = filter_input(
        INPUT_POST,
        "indicador",
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    $sql = "INSERT INTO indicadores_saude
            (cliente_id, indicador)
            VALUES (:cliente_id, :indicador)";

    $insert = $conexao->prepare($sql);

    $insert->bindParam(":cliente_id", $cliente_id);
    $insert->bindParam(":indicador", $indicador);

    if ($insert->execute()) {

        $indicador_id = $conexao->lastInsertId();

        $_SESSION['indicador_id'] = $indicador_id;

        $_SESSION['mensagem'] = "Informações cadastradas com sucesso!";
        $_SESSION['cor'] = 'alert-success';

        header("Location: " . ROOT_PATH . "auth/cliente/indicadores/terceira.php");
        exit;

    } else {

        throw new Exception("Erro ao cadastrar as informações!");
    }
}

        if (isset($_POST['tipo']) && $_POST['tipo'] === 'pressao') {

            if (empty($_POST['pressao'])) {

                $_SESSION['mensagem'] = "Informe a pressão!";
                $_SESSION['cor'] = 'alert-danger';

                header("Location: " . ROOT_PATH . "auth/cliente/indicadores/terceira.php");
                exit;
            }

            if (!isset($_SESSION['indicador_id'])) {

                $_SESSION['mensagem'] = "Indicador não identificado!";
                $_SESSION['cor'] = 'alert-danger';

                header("Location: " . ROOT_PATH . "auth/cliente/indicadores/segunda.php");
                exit;
            }

            $pressao = filter_input(
                INPUT_POST,
                "pressao",
                FILTER_SANITIZE_SPECIAL_CHARS
            );

            $indicador_id = $_SESSION['indicador_id'];

            $sql = "UPDATE indicadores_saude
                    SET pressao = :pressao WHERE id = :indicador_id AND cliente_id = :cliente_id";

            $update = $conexao->prepare($sql);

            $update->bindParam(":pressao", $pressao);
            $update->bindParam(":indicador_id", $indicador_id);
            $update->bindParam(":cliente_id", $cliente_id);

            if ($update->execute()) {

                $_SESSION['mensagem'] = "Pressão cadastrada com sucesso!";
                $_SESSION['cor'] = 'alert-success';

                header("Location: " . ROOT_PATH . "auth/cliente/indicadores/quarta.php");
                exit;

            } else {

                throw new Exception("Erro ao atualizar a pressão!");
            }
        }

    } catch (Exception $e) {

        $_SESSION['mensagem'] = "Ocorreu um erro: " . $e->getMessage();
        $_SESSION['cor'] = 'alert-danger';

        header("Location: " . ROOT_PATH . "auth/cliente/indicadores/segunda.php");
        exit;
    }


if (isset($_POST['tipo']) && $_POST['tipo'] === 'peso_altura') {

    if (empty($_POST['peso']) || empty($_POST['altura'])) {

        $_SESSION['mensagem'] = "Informe o peso e a altura!";
        $_SESSION['cor'] = 'alert-danger';

        header("Location: " . ROOT_PATH . "auth/cliente/indicadores/quarta.php");
        exit;
    }

$peso = filter_input(INPUT_POST, "peso", FILTER_SANITIZE_SPECIAL_CHARS);
$altura = filter_input(INPUT_POST, "altura", FILTER_SANITIZE_SPECIAL_CHARS);

$peso = str_replace('kg', '', $peso);
$altura = str_replace(['m', 'cm'], '', $altura);

$peso = trim($peso);
$altura = trim($altura);

$altura = str_replace(',', '.', $altura);

$sql = "UPDATE clientes
        SET peso = :peso,
            altura = :altura
        WHERE id = :cliente_id";

$update = $conexao->prepare($sql);

$update->bindParam(":peso", $peso);
$update->bindParam(":altura", $altura);
$update->bindParam(":cliente_id", $cliente_id);

    if ($update->execute()) {

        $_SESSION['mensagem'] = "Peso e altura cadastrados com sucesso!";
        $_SESSION['cor'] = 'alert-success';

        // Próxima página
        header("Location: " . ROOT_PATH . "auth/cliente/indicadores/conclusao.php");
        exit;

    } else {

        throw new Exception("Erro ao atualizar peso e altura!");
    }
}
}
