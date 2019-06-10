<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">    
<head>
    <!---->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "shortcut icon" type = "image/x-icon" href="img/icon.png">
    <!--Iconces Google-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--CSS Materialize-->
    <link rel="stylesheet" href="../css/materialize.css">
    <!--CSS Custom-->
    <link href="../css/custom.css" rel="stylesheet" type = "text/css">
    <!--JQUERY-->
    <script src="../jquery/jquery-3.4.1.js"></script>
    <!--Js Materialize-->
    <script src="../js/materialize.js"></script>
    <!--Alertas Plugins CSS/JS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet" type = "text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
    <!--Titulo-->
    <title>:: Login ::</title>
</head>

<body>

    <div class="container ">
        <div class="row">
            <div class="col s0 m3 l3"></div>

            <div class="col s12 m6 l6 z-depth-3">
                <div class="card">
                    <div class="card-action blue lighten-2">
                        <h4 class="center-align">BIBLIOTECA + </h4>
                    </div>

                    <div class="card-content">
                        <form method="post" action="../php/autenticar.php">

                            <div class="input-field">
                                <i class="material-icons prefix ">email</i>
                                <input type="email" name="email" class="validate border-custom">
                                <label for="email">Digite seu e-mail</label>
                                
                            </div>

                            <div class="input-field">
                                <i class="material-icons prefix">https</i>                        
                                <input type="password" name="senha" maxlength="6">
                                <label for="senha">Digite sua senha</label>
                            </div>

                            <button class="btn waves-effect waves-light z-depth-2 btn-large" type="submit" name="entrar" >Entrar
                                 <i class="material-icons right">send</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>  

            <div class="col s0 m3 l3"></div>  
        </div>

        
    </div>
    
    <!--antigo     
        <div class="painel">
            <div class="login-form">
                <form method="POST" action="../php/autenticar.php">
                    <label>Email: <input type="text" name="email" placeholder="email" size="6" maxlength="30"></label>
                    <label>Senha: <input type="password" name="senha" placeholder="senha" size="6" maxlength="6"></label>
                    <button  type="submit">Entrar</button>
                    <button  type="submit" formaction="cadastro.php">Cadastrar</button>
                </form>
            </div>
            <div class="login-img"></div>
        </div>
    --> 
</body>

</html>

<?php
    //require("../php/verificar_se_ja_logou.php");

    //verificando alerta
    if(isset($_SESSION["noticia"]) && $_SESSION["alerta"]){
        echo "<script>Swal.fire('','".$_SESSION["noticia"]."','".$_SESSION["alerta"]."')</script>";
        $_SESSION["noticia"] = null;
        $_SESSION["alerta"] = null;
    }
?>