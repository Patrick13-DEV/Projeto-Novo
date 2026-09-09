<?php
include_once("../constante.php");
include_once("../service/conexao.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['txtTituloPost']) && !empty($_POST['txtResumoPost']) && !empty($_POST['txtConteudoPost'])) {

        $titulo = filter_input(INPUT_POST, "txtTituloPost", FILTER_SANITIZE_SPECIAL_CHARS);
        $resumo = filter_input(INPUT_POST, "txtResumoPost", FILTER_SANITIZE_SPECIAL_CHARS);
        $Descricao = filter_input(INPUT_POST, "txtConteudoPost", FILTER_SANITIZE_SPECIAL_CHARS);



        if (isset($_FILES["imgPost"]) && !empty($_FILES["imgPost"]["name"])) {
            $allowedTypes = ["image/png", "image/jpeg"];
            $fileType = mime_content_type($_FILES["imgPost"]["tmp_name"]);
            $ext = strtolower(pathinfo($_FILES["imgPost"]["name"], PATHINFO_EXTENSION));

            if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
                $nameFile = pathinfo($_FILES["imgPost"]["name"], PATHINFO_FILENAME);
                $imagem_url = hash("md5", $nameFile) . "." . $ext;
                $dir = DIR_PATH . "/img-posts/";
                move_uploaded_file($_FILES["imgPost"]["tmp_name"], $dir . $imagem_url);
            } else {
                $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
                 $_SESSION['cor'] = 'alert-danger';
                header("Location: " . ROOT_PATH . "screens/criarPost.php");
                exit;
            }
        } else {

            $imagem_url = "";
        }

        try {
            $sql = "INSERT INTO POSTS (titulo, resumo, Descricao, Imagem, idUsuario ) VALUES (:titulo, :resumo, :Descricao, :imagem_url, :idUser)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(":titulo", $titulo);
            $insert->bindParam(":resumo", $resumo);
            $insert->bindParam(":Descricao", $Descricao);
            $insert->bindParam(":imagem_url", $imagem_url);
            $insert->bindParam(":idUser", $idUser);

            if ($insert->execute() && $insert->rowCount() > 0){
                $_SESSION['mensagem'] = "Cadastrado com Sucesso!";
                $_SESSION['cor'] = 'alert-success';
                header("Location: " . ROOT_PATH . "/screens/postar.php");
                exit;

            } else {
                throw new Exception("Ocorreu um erro ao cadastrar!");
            }

        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro" . $e;
            $_SESSION['cor'] = 'alert-danger';
            header("Location: " . ROOT_PATH . "/screens/postar.php");
            exit;

        } finally {
            unset($conexao);
        }

    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos";
        $_SESSION['cor'] = 'alert-danger';
        header("Location: " . ROOT_PATH . "/screens/postar.php");
        exit;
    }
}


?>