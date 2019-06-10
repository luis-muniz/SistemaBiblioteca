<?php
	session_start();
    include_once('select.php');
    include_once('insert.php');
    include_once('update.php');
    include_once('delete.php');

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $user = consultarEmail($email);

    if ($user == false) {
    	 addUsuario($nome,$senha,$email);
    	 $_SESSION["noticia"] = "Usuário Cadastrado!";       
         $_SESSION["alerta"] = "sucess";
         header("Location: ../view/cadastro.php");
    }else{
    	$_SESSION["noticia"] = "Este email já está sendo utilizado!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/cadastro.php");
    }
?>