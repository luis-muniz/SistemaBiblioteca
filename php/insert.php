<?php
    include_once('conexao.php');

    function addReserva($livro_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("INSERT INTO reserva(usuario_id,livro_id,situacao,ativo) values (:usuario_id,:livro_id, 'AGUARDANDO',true)");
        $teste->bindValue(':usuario_id',$_SESSION["user"]); 
        $teste->bindValue(':livro_id',$livro_id);
        $teste->execute();
    }

    function aprovarReserva($exemplar_id,$usuario_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("INSERT INTO emprestimo(exemplar_id,usuario_id,data_emprestimo,data_vencimento,situacao) values (:exemplar_id,:usuario_id,:data_emprestimo,:data_vencimento, 'APROVADO')");
        $teste->bindValue(':usuario_id',$usuario_id); 
        $teste->bindValue(':exemplar_id',$exemplar_id);
        $teste->bindValue(':data_emprestimo',date('Y/m/d')); 
        $teste->bindValue(':data_vencimento',date('Y/m/d',strtotime('+30 days')));
        $teste->execute();
    }

    function addUsuario($nome,$senha,$email){
        $pdo = conectarBD();
        $teste = $pdo->prepare("INSERT INTO usuario(nome,senha,email,tipo) values (:nome,:senha,:email,'u')");
        $teste->bindValue(':nome',$nome); 
        $teste->bindValue(':senha',$senha); 
        $teste->bindValue(':email',$email);
        $teste->execute();
    }

    function addEmprestimoO($exemplar_id,$usuario_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("INSERT INTO emprestimo(exemplar_id,usuario_id,data_emprestimo,data_vencimento,situacao) values (:exemplar_id,:usuario_id,:data_emprestimo,:data_vencimento, 'APROVADO')");
        $teste->bindValue(':usuario_id',$usuario_id); 
        $teste->bindValue(':exemplar_id',$exemplar_id);
        $teste->bindValue(':data_emprestimo',date('Y/m/d')); 
        $teste->bindValue(':data_vencimento',date('Y/m/d',strtotime('+30 days')));
        $teste->execute();
    }

    function addDevolucao($emprestimo_id,$total_multa){
        $pdo = conectarBD();
        $teste = $pdo->prepare("INSERT INTO devolucao(emprestimo_id,data_devolucao,total_multa) values (:emprestimo_id,:data_devolucao,:total_multa)");
        $teste->bindValue(':emprestimo_id',$emprestimo_id); 
        $teste->bindValue(':data_devolucao',date('Y/m/d'));
        $teste->bindValue(':total_multa',$total_multa);
        $teste->execute();
    }
?>