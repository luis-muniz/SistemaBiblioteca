<?php
    include_once('conexao.php');

    function buscarNomeUsuario(){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM usuario WHERE usuario_id = :usuario_id");
        $teste->bindValue(':usuario_id',$_SESSION['user']);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetchAll(PDO::FETCH_ASSOC);
    }

    function consultarUsuarios(){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM usuario");
        $teste->execute();
        //recebendo a consulta 
         return $teste->fetchAll(PDO::FETCH_ASSOC);
    }
    function consultarUsuariosID($id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM usuario WHERE usuario_id = :id");
        $teste->bindValue(':id',$id);
        $teste->execute();
        //recebendo a consulta 
         return $teste->fetch();
    }

    function buscarLivros(){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM livro");
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarExemplar($livroID){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM exemplar WHERE livro_id=:livro_id and disponivel=true");
        $teste->bindValue(':livro_id',$livroID);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetch();
    }

    function quantidadeExemplar($livro_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT count(*) as quantidade FROM exemplar WHERE livro_id = :livro_id and disponivel=true");
         $teste->bindValue(':livro_id',$livro_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetch();
    }

    function consultarReservas($usuario_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM reserva as r join livro as l on r.livro_id = l.livro_id WHERE r.usuario_id = :usuario_id");
         $teste->bindValue(':usuario_id',$usuario_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetchAll(PDO::FETCH_ASSOC);
    }

    function verificarReserva($usuario_id,$livro_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM reserva WHERE usuario_id = :usuario_id and livro_id = :livro_id");
        $teste->bindValue(':usuario_id',$usuario_id);
        $teste->bindValue(':livro_id',$livro_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetch();
    }

     function consultarTodasReservas(){
       $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM reserva as r join livro as l on r.livro_id = l.livro_id");
        //$teste->bindValue(':usuario_id',$usuario_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetchAll(PDO::FETCH_ASSOC);
    }

    function consultarReservaID($reserva_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM reserva WHERE reserva_id=:reserva_id");
        $teste->bindValue(':reserva_id',$reserva_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetch();
    }

    function consultarEmprestimos($usuario_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare('SELECT * FROM (emprestimo as em join exemplar as ex on em.exemplar_id = ex.exemplar_id) join livro as li on ex.livro_id = li.livro_id WHERE usuario_id=:usuario_id and situacao <> "DEVOLVIDO"');
        $teste->bindValue(':usuario_id',$usuario_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetchAll(PDO::FETCH_ASSOC);
    }

    function verificarEmprestimoUser($usuario_id,$livro_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare('SELECT * FROM emprestimo as em join exemplar as ex on em.exemplar_id = ex.exemplar_id WHERE usuario_id=:usuario_id and livro_id = :livro_id and situacao <> "DEVOLVIDO"');
        $teste->bindValue(':usuario_id',$usuario_id);
        $teste->bindValue(':livro_id',$livro_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetch();
    }

    function consultarEmprestimoID($emprestimo_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare('SELECT * FROM emprestimo WHERE emprestimo_id=:emprestimo_id');
        $teste->bindValue(':emprestimo_id',$emprestimo_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetch();
    }

    function consultarExemplarAux($exemplar_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM exemplar WHERE exemplar_id = :exemplar_id");
         $teste->bindValue(':exemplar_id',$exemplar_id);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetch();
    }

    function consultarEmail($email){
        $pdo = conectarBD();
        $teste = $pdo->prepare("SELECT * FROM usuario WHERE email= :email");
         $teste->bindValue(':email',$email);
        $teste->execute();
        //recebendo a consulta 
        return $teste->fetch();
    }

?>