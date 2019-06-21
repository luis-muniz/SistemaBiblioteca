<?php
    
     //iniciando sessao
    session_start();
    //arquivo php para realizar conexao
    include('conexao.php');
    //recebendo o PDO usando um metodo do arquivo
    $pdo = conectarBD();
    //recebendo os dados dos formularios
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    //preparando para a consulta para autenticação
    $teste = $pdo->prepare("SELECT * FROM usuario WHERE email = :email and senha = :senha");
    $teste->bindValue(':email',$email); 
    $teste->bindValue(':senha',$senha);
    $teste->execute();
    //recebendo a consulta 
    $rows = $teste->fetch(PDO::FETCH_ASSOC);
    //verificando se existe o usuario no BD
    if($rows == false){
        //retorna para a index caso não encontre
        $_SESSION["noticia"] = "Login ou Senha incorretos!";       
        $_SESSION["alerta"] = "warning";
        header("Location: ../view/index.php");
    }else{
        //caso encontre, cria as variaveis de sessao e o direciona para a home page
        $_SESSION["autenticado"] = TRUE;
        $_SESSION["user"] = $rows["usuario_id"];
        $_SESSION["nivel"] = $rows["tipo"];
        if($rows["tipo"] == "f"){
            header("Location: ../view/home_funcionario.php");
        }else{
            header("Location: ../view/home_usuario.php");
        }
        
    }
?>