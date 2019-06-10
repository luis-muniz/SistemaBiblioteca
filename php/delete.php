<?php
    include_once('conexao.php');

    function deletarReserva($reserva_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("UPDATE reserva SET ativo = false WHERE reserva_id = :reserva_id");
        $teste->bindValue(':reserva_id',$reserva_id);
        $teste->execute();
    }
?>