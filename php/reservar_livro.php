<?php
//iniciando sessao
	session_start();
    include_once('select.php');
    include_once('insert.php');
    include_once('update.php');

    //recebendo o PDO usando um metodo do arquivo

    $livroID = $_GET["livroID"];

    $qntEx =  quantidadeExemplar($livroID);
    if ($qntEx["quantidade"]>0) {
    	$user = consultarUsuariosID($_SESSION["user"]);
    	if($user["total_emprestimos"] <10){
    		$verResUser = verificarReserva($_SESSION["user"],$livroID);
            $verEmpUser =verificarEmprestimoUser($_SESSION["user"],$livroID);
   	    	if ($verResUser==false) {
                if ($verEmpUser == false) {
                //addEmprestimo($user);
                $exemplar = buscarExemplar($livroID);
                addReserva($livroID);
                //indisExemplar($exemplar["exemplar_id"]);
                $_SESSION["noticia"] = "Livro Reservado Com Sucesso!";       
                $_SESSION["alerta"] = "sucess";
                header("Location: ../view/home_usuario.php");
                }else{
                    $_SESSION["noticia"] = "Você já possui um empréstimo com esse livro!";       
                    $_SESSION["alerta"] = "warning";
                    header("Location: ../view/home_usuario.php");
                }	    		
	    	}else{
	    		$_SESSION["noticia"] = "Você já reservou esse livro!";       
		        $_SESSION["alerta"] = "warning";
		        header("Location: ../view/home_usuario.php");
	    	}	    	
    	}else{
    		$_SESSION["noticia"] = "Você atingiu o limite de reservas";       
	        $_SESSION["alerta"] = "warning";
	        header("Location: ../view/home_usuario.php");
    	}
    	
    }else{

    	$_SESSION["noticia"] = "Livro Indisponível!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/home_usuario.php");
    }
  	
	
?>