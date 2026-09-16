<?php
// arquivo de conexao ao banco de dados
include_once("../constante.php");
include_once("../service/conexao.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['descricao'])) {

        $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);

        try {
            $sql = "INSERT INTO POSTS (descricao) VALUES (:descricao)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(":descricao", $descricao);

            if ($insert->execute() && $insert->rowCount() > 0){
                $_SESSION['mensagem'] = "Cadastrado com Sucesso!";
                $_SESSION['cor'] = 'alert-success';
                header("Location: " . ROOT_PATH . "pages/Cliente/aplicacao/dashboard.php");
                exit;

            } else {
                throw new Exception("Ocorreu um erro ao cadastrar!");
            }

        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro" . $e;
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "pages/Cliente/aplicacao/agendamento.php");
            exit;

        } finally {
            unset($conexao);
        }

    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "pages/Cliente/aplicacao/agendamento.php");
        exit;
    }
}


?>