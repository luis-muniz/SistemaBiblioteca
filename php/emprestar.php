<?php
session_start();
include_once('select.php');
include_once('insert.php');
include_once('update.php');
include_once('delete.php');
include("../mpdf60/mpdf.php");

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
       // header("Location: ../view/realizar_emprestimo.php");

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

    ///*
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
}

?>