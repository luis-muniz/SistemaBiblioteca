<?php
session_start();
//arquivo para verificar se o usuario fez login
require("../php/verificar_autenticacao.php");
verificarUsuario();
include('../php/select.php');
?>

<html lang="pt-br">
<head>
    <!---->
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

    <div class="row blue container">
        <div class="col s12 m12 l12">
            <ul class="collection with-header">
                <li class="collection-header center blue"><h4>LIVROS</h4></li>

                <?php
                header("Content-type: text/html; charset=utf-8-general-ci");
                $livro = buscarLivros();
                foreach ($livro as $livros) {
                    $qtn = quantidadeExemplar($livros["livro_id"]);
                    if ($qtn["quantidade"]>0) {
                        echo '<li class="collection-item">'              
                        .'<div class="card horizontal z-depth-3">'
                        .'<div class="card-image">'
                        .'<img src="../img/'.$livros["livro_id"].'_img.jpg" class="">'
                        .'</div>'
                        .'<div class="card-stacked">'
                        .'<div class="card-content">'
                        .'<p><strong>Título: </strong>'.$livros["titulo"].'</p>'
                        .'<p><strong>Descrição:</strong> '.$livros["descricao"].'</p>'
                        .'<p><strong>Nº de Paginas:</strong> '.$livros["paginas"].'</p>'
                        .'<p><strong>Quantidade Disponível: </strong>'.$qtn["quantidade"].'</p>'
                        .'</div>'
                        .'<div class="card-action">'
                        .'<a class="btn" href="../php/reservar_livro.php?livroID='.$livros["livro_id"].'">Reservar Livro<i class="material-icons right">add_circle_outline</i></a>'
                        .'</div>'
                        .'</div>'
                        .'</div>'
                        .'</li>';
                    }else{
                       echo '<li class="collection-item">'              
                       .'<div class="card horizontal z-depth-3">'
                       .'<div class="card-image">'
                       .'<img src="../img/'.$livros["livro_id"].'_img.jpg" class="">'
                       .'</div>'
                       .'<div class="card-stacked">'
                       .'<div class="card-content">'
                       .'<p><strong>Título: </strong>'.$livros["titulo"].'</p>'
                       .'<p><strong>Descrição:</strong> '.$livros["descricao"].'</p>'
                       .'<p><strong>Nº de Paginas:</strong> '.$livros["paginas"].'</p>'
                       .'<p><strong>Quantidade Disponível: </strong>'.$qtn["quantidade"].'</p>'
                       .'</div>'
                       .'<div class="card-action">'
                       .'<a class="btn disabled" href="#">Indisponível<i class="material-icons right">blocked</i></a>'
                       .'</div>'
                       .'</div>'
                       .'</div>'
                       .'</li>';
                   }
               }                    
               ?>   
           </ul>
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