<?php

function verificarUsuario(){
    if(!isset($_SESSION["autenticado"]) || !isset($_SESSION["user"]) || !isset($_SESSION["nivel"]) || $_SESSION["nivel"] != "u") 
    {            
        header("Location: ../view/index.php"); 
        exit(); 
    }
}

function verificarFuncionario(){
    if(!isset($_SESSION["autenticado"]) || !isset($_SESSION["user"]) || !isset($_SESSION["nivel"]) || $_SESSION["nivel"] != "f") 
    {            
        header("Location: ../view/index.php"); 
        exit(); 
    }
}
    
?>
