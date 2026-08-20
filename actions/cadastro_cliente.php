<?php
// arquivo de conexao ao banco de dados
include_once("../constante.php");
include_once("../service/conexao.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['cpf']) && !empty($_POST['telefone']) && !empty($_POST['senha'])) {

        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);
        $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);

        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

        // CODIGO PARA INSERT

        try {
            $sql = "INSERT INTO clientes (nome, email, senha, cpf, telefone) VALUES (:nome, :email, :senha, :cpf, :telefone)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(":nome", $nome);
            $insert->bindParam(":email", $email);
            $insert->bindParam(":senha", $senhaCriptografada);
            $insert->bindParam(":cpf", $cpf);
            $insert->bindParam(":telefone", $telefone);

            if ($insert->execute() && $insert->rowCount() > 0){
                $_SESSION['mensagem'] = "Cadastrado com Sucesso!";
                $_SESSION['cor'] = 'alert-success';
                header("Location: " . ROOT_PATH . "auth/cliente/indicadores/primeira.php");
                exit;

            } else {
                throw new Exception("Ocorreu um erro ao cadastrar!");
            }

        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro ao cadastrar / Usuario ja Cadastrado!";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "auth/cliente/cadastro.php");
            exit;

        } finally {
            unset($conexao);
        }

    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "auth/cliente/cadastro.php");
        exit;
    }
}
