<?php

function verificarUsuarioLogado(){
	//usuario
	if(isset($_SESSION["autenticado"]) && isset($_SESSION["user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "u") 
	{            
		header("Location: ../view/home_usuario.php"); 
		exit();
    //funcionario
	}else if(isset($_SESSION["autenticado"]) && isset($_SESSION["user"]) && isset($_SESSION["nivel"]) && $_SESSION["nivel"] == "f") 
	{            
		header("Location: ../view/home_funcionario.php"); 
		exit(); 
	}
}
?>