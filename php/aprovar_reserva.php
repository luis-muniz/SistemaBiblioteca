<?php
	session_start();
    include_once('select.php');
    include_once('insert.php');
    include_once('update.php');
    include_once('delete.php');

    $reservaID = $_GET["aprovarID"];

    $reserva = consultarReservaID($reservaID);
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
    }

?>