
<?php

include_once("../constante.php");
include_once("../service/conexao.php");
include_once("../service/auth.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (!empty($_POST['agendamento']) && !empty($_POST['status'])) {
        $agendamentoId = filter_input(INPUT_POST, 'agendamento', FILTER_VALIDATE_INT); $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($status !== 'confirmado' && $status !== 'cancelado'
        ) {
            $_SESSION['mensagem'] = "Status inválido!";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "pages/profissional/aplicacao/dashboard.php");
            exit;
        }
        $profissionalId = $_SESSION['idUser'];

        try {
            $sql = "UPDATE agendamentos SET status = :status WHERE id = :agendamento_id AND profissional_id = :profissional_id AND status = 'pendente'";
            $update = $conexao->prepare($sql);
            $update->bindValue( ':status', $status, PDO::PARAM_STR);
            $update->bindValue(':agendamento_id', $agendamentoId, PDO::PARAM_INT);
            $update->bindValue( ':profissional_id', $profissionalId, PDO::PARAM_INT);

            if ($update->execute()) {
                if ($update->rowCount() > 0) {
                    if ($status === 'confirmado') {
                        $_SESSION['mensagem'] = "Agendamento confirmado com sucesso!";
                    } else {

                        $_SESSION['mensagem'] = "Agendamento cancelado com sucesso!";}
                        $_SESSION['cor'] = 'alert-success';
                } else {

                    $_SESSION['mensagem'] = "Agendamento não encontrado ou já foi processado.";
                    $_SESSION['cor'] = 'alert-danger';
                }
            } else {

                $_SESSION['mensagem'] = "Ocorreu um erro ao alterar o agendamento.";
                $_SESSION['cor'] = 'alert-danger';
            }
        } catch (Exception $e) {

            $_SESSION['mensagem'] = "Ocorreu um erro no Banco de Dados.";
            $_SESSION['cor'] = 'alert-danger';

        } finally {
            unset($conexao);}

        header( "Location: " . ROOT_PATH . "pages/profissional/aplicacao/dashboard.php");
        exit;

    } else {

        $_SESSION['mensagem'] = "Dados do agendamento não informados.";
        $_SESSION['cor'] = 'alert-danger';
        header( "Location: " . ROOT_PATH . "pages/profissional/aplicacao/dashboard.php");
        exit;
    }
}

?>