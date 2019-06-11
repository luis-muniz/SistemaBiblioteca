<?php
session_start();
include_once('select.php');
include_once('insert.php');
include_once('update.php');
include_once('delete.php');
include("../mpdf60/mpdf.php");

$reservaID = $_GET["aprovarID"];

$reserva = consultarReservaID($reservaID);
$exemplar = buscarExemplar($reserva["livro_id"]);

if($exemplar == true){
    $verEmpr = verificarEmprestimoUser($reserva["usuario_id"],$exemplar["livro_id"]);
    if($verEmpr == true){
        $_SESSION["noticia"] = "O Usuário Já Possui Um Emprestimo Desse Livro!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/realizar_emprestimo.php");
    }else{
        aprovarReserva($exemplar["exemplar_id"],$reserva["usuario_id"]);
        $usuario = consultarUsuariosID($reserva["usuario_id"]);
        addEmprestimo($usuario);
        indisExemplar($exemplar["exemplar_id"]);
        deletarReserva($reserva["reserva_id"]);
        $_SESSION["noticia"] = "Emprestimo Realizado!";       
        $_SESSION["alerta"] = "sucess";
        //header("Location: ../view/home_funcionario.php");

        $livro = consultarLivro($exemplar["livro_id"]);
        $data = date('d/m/Y',strtotime('+30 days'));

        $html = "
        <fieldset>
        <h1>Comprovante de Empréstimo</h1>
        <p class='center sub-titulo'></p>
        <p>Foi emprestado para <strong>".$usuario["nome"]." - ID ".$usuario["usuario_id"]."</strong></p>
        <p>o exemplar <strong>".$livro["titulo"]."</strong></p>
        <p>correspondente ao codigo <strong>".$exemplar["exemplar_id"]."<strong></p>
        <p>em perfeitas condições.</p>
        <p class='direita'> DATA DE VNCIMENTO PRESVISTA: ".$data."</p>
        <p>Assinatura Funcionario: ..............................................................</p>
        <p></p>
        <p></p>
        </fieldset>    
        ";

        //*
        error_reporting(0);
        ini_set('display_errors', 0);

        $mpdf=new mPDF(); 
        $mpdf->SetDisplayMode('fullpage');
        $css = file_get_contents("../mpdf60/css/estilo.css");
        $mpdf->WriteHTML($css,1);
        $mpdf->WriteHTML($html);
        ob_clean();
        $mpdf->Output();
    }  
}else{
    $_SESSION["noticia"] = "Livro Indisponível!";       
    $_SESSION["alerta"] = "warning";
    header("Location: ../view/home_funcionario.php");
}

?>