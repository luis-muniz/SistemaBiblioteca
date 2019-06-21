<?php
session_start();
//arquivo para verificar se o usuario fez login
require("../php/verificar_autenticacao.php");
verificarUsuario();
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

    <title>:: Area Usuario ::</title>
</head>

<body>

    <header>
        <div class="row container">
            <div class="col s12 m7 l6">
                <nav class="center blue">
                    <div class="center">
                        <ul  class="center">
                            <li><a href="home_usuario.php">Reservar Livros</a></li>
                            <li><a href="minhas_reservas.php">Minhas Reservas</a></li>
                            <li><a href="meus_emprestimos.php">Meus Empréstimos</a></li>
                        </ul>
                    </div>
                </nav>                
            </div>
            <div class="col s12 m5 l6">
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
        <div class="col s12 m12 l12">
           <table class="bordered highlight centered">
            <thead>
              <tr>
                  <th>ID RESERVA</th>
                  <th>ID LIVRO</th>
                  <th>TÍTULO</th>
                  <th>SITUAÇÃO</th>
              </tr>
          </thead>

        <tbody>
            <?php 
                $linhas = consultarReservas($_SESSION['user']);
                foreach ($linhas as $linha) {
                    if($linha["ativo"] == true){
                    echo '<tr>'
                            .'<td>'.$linha["reserva_id"].'</td>'
                            .'<td>'.$linha["livro_id"].'</td>'
                            .'<td>'.$linha["titulo"].'</td>'
                            .'<td>'.$linha["situacao"].'</td>'
                        .'</tr>';
                    }
                }
            ?>
        </tbody>
    </table>
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