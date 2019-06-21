<?php
//iniciando sessao
session_start();

include_once('select.php');
include_once('insert.php');
include_once('update.php');
include_once('delete.php');
include("../mpdf60/mpdf.php");

$emprestimoID = $_POST["id-emprestimo"];

$emp = consultarEmprestimoID($emprestimoID);

if ($emp == false) {
	$_SESSION["noticia"] = "ID do emprétimo inválido";
	$_SESSION["alerta"] = "warning";
	header("Location: ../view/devolucao.php");
}else if($emp["situacao"] != "DEVOLVIDO"){
	devolverEmprestimo($emp["emprestimo_id"]);
	$data_devolucao = date('Y-m-d');
	$data_vencimento = $emp["data_vencimento"];

	$cont = 0;
	while ($data_vencimento <= $data_devolucao) {
		$cont++;
		$data_vencimento = date('Y-m-d', strtotime("+1 day",strtotime($data_vencimento)));
	}

	addDevolucao($emprestimoID,$cont*0.3);
	disExemplar($emp["exemplar_id"]);    

	$user = consultarUsuariosID($emp["usuario_id"]);
    diminuirEmprestimo($user);
    
    $exem = consultarExemplarAux($emp["exemplar_id"]);
    $livro = consultarLivro($exem["livro_id"]);
	 

    $html = "
    <fieldset>
    <h1>Comprovante de Devolução</h1>
    <p class='center sub-titulo'>
    ID EMPRESTIMO <strong>".$emprestimoID."</strong> - 
    MULTA <strong> R$ ".$cont*0.3."</strong>
    </p>
    <p>A cliente <strong>".$user["nome"]." - ID ".$user["usuario_id"]."</strong></p>
    <p>devolveu o exemplar <strong>".$livro["titulo"]."</strong></p>
    <p>Correspondente ao codigo <strong>".$exem["exemplar_id"]."<strong></p>
    <p>em perfeitas condições.</p>
    <p class='direita'> DATA DE DEVOLUÇÃO: ".$data_devolucao."</p>
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

    ///*
    $_SESSION["noticia"] = "Devoulacao Realizada!";
	$_SESSION["alerta"] = "sucess";
	header("Location: ../view/devolucao.php");
}else{
	$_SESSION["noticia"] = "Esse empréstimo já foi devolvido!";
	$_SESSION["alerta"] = "warning";
	header("Location: ../view/devolucao.php");
}
?>
