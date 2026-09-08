<?php

session_start();

include_once("../constante.php");
include_once("../service/conexao.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['etapa']) && $_POST['etapa'] === 'cadastro') {

    if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['cpf']) && !empty($_POST['telefone']) && !empty($_POST['senha']) && !empty($_POST['confirmar_senha'])) {

        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);
        $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);

        // Senha não precisa de FILTER_SANITIZE_SPECIAL_CHARS
        $senha = $_POST['senha'];
        $confirmar_senha = $_POST['confirmar_senha'];


        // Verifica se as senhas são iguais
        if ($senha !== $confirmar_senha) {

            $_SESSION['mensagem'] = "As senhas não coincidem!";
            $_SESSION['cor'] = "alert-danger";

            header("Location: " . ROOT_PATH . "auth/profissional/cadastro.php");
            exit;
        }


        // Criptografa a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);


        try {

            $sql = "INSERT INTO profissionais
                    (nome, email, senha, cpf, telefone)
                    VALUES
                    (:nome, :email, :senha, :cpf, :telefone)";

            $insert = $conexao->prepare($sql);

            $insert->bindParam(":nome", $nome);
            $insert->bindParam(":email", $email);
            $insert->bindParam(":senha", $senhaCriptografada);
            $insert->bindParam(":cpf", $cpf);
            $insert->bindParam(":telefone", $telefone);


            if ($insert->execute()) {

                // Pega o ID do profissional recém-criado
                $profissional_id = $conexao->lastInsertId();

                // Guarda o ID para a segunda etapa
                $_SESSION['profissional_id'] = $profissional_id;

                $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
                $_SESSION['cor'] = "alert-success";


                // Vai para a segunda etapa
                header(
                    "Location: " .
                    ROOT_PATH .
                    "auth/profissional/cadastro2.php"
                );

                exit;

            } else {

                throw new Exception("Erro ao cadastrar profissional.");

            }


        } catch (Exception $e) {

            $_SESSION['mensagem'] =
                "Ocorreu um erro ao cadastrar / Usuário já cadastrado!";

            $_SESSION['cor'] = "alert-danger";

            header(
                "Location: " .
                ROOT_PATH .
                "auth/profissional/cadastro.php"
            );

            exit;
        }
    }


    // Campos obrigatórios
    $_SESSION['mensagem'] = "Preencha todos os campos!";
    $_SESSION['cor'] = "alert-danger";

    header(
        "Location: " .
        ROOT_PATH .
        "auth/profissional/cadastro.php"
    );

    exit;
}



/*
|--------------------------------------------------------------------------
| SEGUNDA ETAPA DO CADASTRO
| Especialidade + Estado + Cidade + Rua
|--------------------------------------------------------------------------
*/

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['etapa']) &&
    $_POST['etapa'] === 'dados_profissionais'
) {

    // Verifica se existe um profissional sendo cadastrado
    if (!isset($_SESSION['profissional_id'])) {

        $_SESSION['mensagem'] =
            "Sessão do profissional não encontrada.";

        $_SESSION['cor'] = "alert-danger";

        header(
            "Location: " .
            ROOT_PATH .
            "auth/profissional/cadastro.php"
        );

        exit;
    }


    // ID salvo na primeira etapa
    $profissional_id = $_SESSION['profissional_id'];


    // Recebe os dados
    $especialidade = filter_input(
        INPUT_POST,
        "especialidade",
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    $estado = filter_input(
        INPUT_POST,
        "estado",
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    $cidade = filter_input(
        INPUT_POST,
        "cidade",
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    $rua = filter_input(
        INPUT_POST,
        "rua",
        FILTER_SANITIZE_SPECIAL_CHARS
    );


    // Verifica campos
    if (
        empty($especialidade) ||
        empty($estado) ||
        empty($cidade) ||
        empty($rua)
    ) {

        $_SESSION['mensagem'] =
            "Preencha todos os campos!";

        $_SESSION['cor'] =
            "alert-danger";

        header(
            "Location: " .
            ROOT_PATH .
            "auth/profissional/cadastro2.php"
        );

        exit;
    }


    try {

        /*
        | Atualiza o MESMO profissional criado na etapa 1
        */

        $sql = "UPDATE profissionais
                SET especialidade = :especialidade,
                    estado = :estado,
                    cidade = :cidade,
                    rua = :rua
                WHERE id = :profissional_id";


        $update = $conexao->prepare($sql);

        $update->bindParam(
            ":especialidade",
            $especialidade
        );

        $update->bindParam(
            ":estado",
            $estado
        );

        $update->bindParam(
            ":cidade",
            $cidade
        );

        $update->bindParam(
            ":rua",
            $rua
        );

        $update->bindParam(
            ":profissional_id",
            $profissional_id
        );


        if ($update->execute()) {

            $_SESSION['mensagem'] =
                "Cadastro concluído com sucesso!";

            $_SESSION['cor'] =
                "alert-success";


            // Depois você pode trocar essa página
            // pela página inicial do profissional.
            header(
                "Location: " .
                ROOT_PATH .
                "auth/profissional/login.php"
            );

            exit;

        } else {

            throw new Exception(
                "Erro ao atualizar os dados."
            );

        }


    } catch (Exception $e) {

        $_SESSION['mensagem'] =
            "Erro ao salvar os dados do profissional!";

        $_SESSION['cor'] =
            "alert-danger";

        header(
            "Location: " .
            ROOT_PATH .
            "auth/profissional/cadastro2.php"
        );

        exit;
    }
}