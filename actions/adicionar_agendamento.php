<?php

include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../service/auth.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ( !empty($_POST['profissional']) && !empty($_POST['data']) && !empty($_POST['hora']) && !empty($_POST['descricao']) ) {

        $clienteId = $_SESSION['idUser'];
        $profissionalId = filter_input(INPUT_POST, "profissional", FILTER_VALIDATE_INT);
        $data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_SPECIAL_CHARS);
        $hora = filter_input(INPUT_POST, "hora", FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

        $horaInicio = substr($hora, 0, 5);

        $dataAgendamento = $data . ' ' . $horaInicio . ':00';

        try {$sql = "INSERT INTO agendamentos (cliente_id, profissional_id, data, descricao, status) VALUES (:cliente_id, :profissional_id, :data, :descricao, :status)";

            $insert = $conexao->prepare($sql);
            $insert->bindValue(':cliente_id', $clienteId, PDO::PARAM_INT);
            $insert->bindValue(':profissional_id', $profissionalId, PDO::PARAM_INT);
            $insert->bindValue(':data', $dataAgendamento);
            $insert->bindValue(':descricao', $descricao);
            $insert->bindValue(':status', 'pendente');

            if ($insert->execute()) {
                $_SESSION['mensagem'] = "Agendamento realizado com sucesso!";
                $_SESSION['cor'] = 'alert-success';
                header("Location: " . ROOT_PATH . "pages/Cliente/aplicacao/dashboard.php");
                exit;
            } else {

                throw new Exception("Ocorreu um erro ao realizar o agendamento!");
            }
        } catch (Exception $e) {

            $_SESSION['mensagem'] =
                "Ocorreu um erro ao realizar o agendamento.";

            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "pages/Cliente/aplicacao/agendamento.php?profissional=" . $profissionalId);
            exit;
        } finally {

            unset($conexao);
        }
    } else {

        $_SESSION['mensagem'] =
            "Obrigatório preencher todos os campos";

        $_SESSION['cor'] =
            'alert-danger';

        header("Location: " . ROOT_PATH . "pages/Cliente/aplicacao/agendamento.php");
        exit;
    }
}

?>