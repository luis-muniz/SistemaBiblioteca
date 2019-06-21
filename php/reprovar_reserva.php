<?php
//iniciando sessao
	session_start();
    include_once('select.php');
    include_once('insert.php');
    include_once('update.php');
    include_once('delete.php');

    $reservaID = $_GET["reprovarID"];

    $reserva = consultarReservaID($reservaID);

    if($reserva == true){
    	deletarReserva($reserva["reserva_id"]);
    	$_SESSION["noticia"] = "Reserva Reprovada!";       
        $_SESSION["alerta"] = "sucess";
        header("Location: ../view/home_funcionario.php");
    }else{
    	$_SESSION["noticia"] = "Reserva Não Existe!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/home_funcionario.php");
    }

?>