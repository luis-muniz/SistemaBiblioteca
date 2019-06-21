<?php
session_start();
//arquivo para verificar se o usuario fez login
require("../php/verificar_autenticacao.php");
verificarFuncionario();
include('../php/select.php');
?>

<html lang="pt-br">
<head>
    <!--metas-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!--<meta http-equiv="X-UA-Compatible" content="ie=edge">-->
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

    <title>:: Area Funcionario ::</title>
</head>

<body>

    <header>
        <div class="row">
            <div class="col s12 m7 l7">
                <nav class="center blue">
                    <div class="center">
                        <ul  class="center">
                            <li><a href="home_funcionario.php">Aprovar Reservas</a></li>
                            <li><a href="cadastro.php">Cadastrar Usuário</a></li>
                            <li><a href="realizar_emprestimo.php">Realizar Empréstimo</a></li>
                            <li><a href="devolucao.php">Devolução</a></li>
                        </ul>
                    </div>
                </nav>                
            </div>
            <div class="col s12 m5 l5">
                <nav class="center blue">

                    <?php                    
                    $row = buscarNomeUsuario();
                    foreach($row as $linha){
                        echo $linha['nome'];
                        break;
                    }                                   
                    ?>
                    <a class="btn" href="../php/sair.php">SAIR</a>

                </nav>        
            </div>

        </div>
    </header>

    <div class="row container">
        <div class="row">
            <form class="col s12" method="post" action="../php/emprestar.php">
              <div class="row">
                <div class="input-field col l12">
                  <i class="material-icons prefix">account_circle</i>
                  <input name="id-usuario" id="first_name" type="text" class="validate" maxlength="30">
                  <label for="first_name">ID DO USUÁRIO</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col l12">
                  <i class="material-icons prefix">book</i>
                  <input name="id-exemplar" id="first_name" type="text" class="validate" maxlength="30">
                  <label for="first_name">ID DO EXEMPLAR</label>
                </div>
              </div>              
              <div class="row">
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light z-depth-2 btn-large" type="submit" name="emprestar">Realizar Empréstimo<i class="material-icons right">add_circle_outline</i>
                  </button>
                </div>
              </div>      
            </form>
        </div>
    </div>

    
    <main></main>
    <footer class="page-footer container blue">          
        <div class="footer-copyright">
            <div class="container center">
                © 2019 Todos os direitos reservados            
            </div>
        </div>
    </footer>

</body>

</html>

<?php
    if(isset($_SESSION["noticia"]) && $_SESSION["alerta"]){
        echo "<script>Swal.fire('','".$_SESSION["noticia"]."','".$_SESSION["alerta"]."')</script>";
        $_SESSION["noticia"] = null;
        $_SESSION["alerta"] = null;
    }
?>