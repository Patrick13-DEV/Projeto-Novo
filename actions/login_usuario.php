<?php
// arquivo de conexao ao banco de dados
include_once("../constante.php");
include_once("../config/conexao.php");


if ($_SERVER['REQUEST_METHOD']==="POST"){
    if(!empty($_POST['email']) && !empty($_POST['senha'])){
    try {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

            //CONSULTA AO BANCO DE DADOS VERIFICAR EMAIL
            $sql = "SELECT email, senha FROM clientes WHERE email = :email";
            $select = $conexao->prepare($sql);
            $select->bindParam(':email', $email);
            if ($select->execute() && $select->rowCount()>0){
                $login = $select->fetch(PDO::FETCH_ASSOC);

                if (password_verify($senha, $login['senha'])){
                    $_SESSION['logado'] = TRUE;
                    $_SESSION['idUser'] = $login['id'];
                    $_SESSION['nomeUser'] = $login['nome'];
                    $_SESSION['mensagem'] = "Login realizado com sucesso!";
                    $_SESSION['cor'] = 'alert-success';
                    header("Location: " . ROOT_PATH . "pages/cliente/aplicacao/dashboard.php");
                    exit;
                }
            }
            $_SESSION['mensagem'] = "Usuario/Senha Invalidos!";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "auth/cliente/login.php");
            exit;

    } catch (\Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro no Banco de Dados";
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "auth/cliente/login.php");
            exit;
    } finally {
        unset($conexao);
    }

    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "auth/cliente/login.php");
        exit;
    }
}

?>