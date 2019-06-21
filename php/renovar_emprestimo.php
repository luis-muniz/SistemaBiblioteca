<?php
//iniciando sessao
	session_start();
    include_once('select.php');
    include_once('insert.php');
    include_once('update.php');

    //recebendo o PDO usando um metodo do arquivo

    $emprestimoID = $_GET["emprestimoID"];
    $emprestimo = consultarEmprestimoID($emprestimoID);
    $data = date('Y-m-d');
    if ($emprestimo["data_vencimento"] > $data) {
        $exemplar = consultarExemplarAux($emprestimo["exemplar_id"]);
        $verQtd = quantidadeExemplar($exemplar["livro_id"]);
        $verRes = consultarTodasReservas();
        $res = false;
        foreach ($verRes as $linha) {
            if($linha["livro_id"] == $exemplar["livro_id"]){
                $res = true;
                break;
            }
        }
        if ($verQtd["quantidade"] == 0 && $res == true) {
                $_SESSION["noticia"] = "Existe Reserva Para Esse Livro";       
                $_SESSION["alerta"] = "warning";
                header("Location: ../view/meus_emprestimos.php");
        }else{
            if($emprestimo["total_renovacoes"]<10){

                 renovarEmprestimo($emprestimo["emprestimo_id"],$emprestimo["data_vencimento"],$emprestimo["total_renovacoes"]);
                 $_SESSION["noticia"] = "Livro Renovado Com Sucesso!";       
                 $_SESSION["alerta"] = "sucess";
                 header("Location: ../view/meus_emprestimos.php");
            }else{
                $_SESSION["noticia"] = "Total de Renovacoes Atingidas";       
                $_SESSION["alerta"] = "warning";
                header("Location: ../view/meus_emprestimos.php");
            }      
        }
        
    }else{
        $_SESSION["noticia"] = "Livro Atrasado! Pague a multa para renová-lo!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/meus_emprestimos.php");
    }
	
?>