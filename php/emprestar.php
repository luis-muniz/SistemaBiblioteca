<?php
	session_start();
    include_once('select.php');
    include_once('insert.php');
    include_once('update.php');
    include_once('delete.php');

    $userID = $_POST["id-usuario"];
    $exemID = $_POST["id-exemplar"];

    //verificar usuario e exemplar
    $exemplar = consultarExemplarAux($exemID);
    $usuario = consultarUsuariosID($userID);

    if(($exemplar == false) || ($usuario == false)){
        $_SESSION["noticia"] = "Dados Incorretos!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/realizar_emprestimo.php");
    }else if($exemplar["disponivel"] == false){
        $_SESSION["noticia"] = "Exemplar Indisponível!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/realizar_emprestimo.php");
    }else {
        $verEmpr = verificarEmprestimoUser($userID,$exemplar["livro_id"]);
        if($verEmpr == true){
            $_SESSION["noticia"] = "O Usuário Já Possui Um Emprestimo Desse Livro!";       
            $_SESSION["alerta"] = "warning";
            header("Location: ../view/realizar_emprestimo.php");
        }else{
            addEmprestimo($usuario);
            indisExemplar($exemplar["exemplar_id"]);
            addEmprestimoO($exemplar["exemplar_id"],$usuario["usuario_id"]);

            $_SESSION["noticia"] = "Emprestimo Realizado!";       
            $_SESSION["alerta"] = "sucess";
            header("Location: ../view/realizar_emprestimo.php");
        }
    }

    /*$reserva = consultarReservaID($reservaID);
    $exemplar = buscarExemplar($reserva["livro_id"]);

    if($exemplar == true){
    	 aprovarReserva($exemplar["exemplar_id"],$reserva["usuario_id"]);
    	 $usuario = consultarUsuariosID($reserva["usuario_id"]);
    	 addEmprestimo($usuario);
    	 indisExemplar($exemplar["exemplar_id"]);
    	 deletarReserva($reserva["reserva_id"]);
    	 $_SESSION["noticia"] = "Emprestimo Realizado!";       
        $_SESSION["alerta"] = "sucess";
        header("Location: ../view/home_funcionario.php");
    }else{
    	$_SESSION["noticia"] = "Livro Indisponível!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/home_funcionario.php");
    }*/

?>