<?php
    include_once('conexao.php');

    function indisExemplar($exemplar_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("UPDATE exemplar SET disponivel=false WHERE exemplar_id = :exemplar_id");
        $teste->bindValue(':exemplar_id',$exemplar_id);
        $teste->execute();
    }

    function addEmprestimo($usuario_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("UPDATE usuario SET total_emprestimos=:total WHERE usuario_id = :usuario_id");
        $teste->bindValue(':total',$usuario_id["total_emprestimos"] + 1);
        $teste->bindValue(':usuario_id',$usuario_id["usuario_id"]);
        $teste->execute();
    } 

     function renovarEmprestimo($emprestimo_id,$data_vencimento,$total_renovacoes){
        $pdo = conectarBD();
        $teste = $pdo->prepare('UPDATE emprestimo SET data_vencimento = :data_vencimento, situacao = "RENOVADO", total_renovacoes = :total_renovacoes WHERE emprestimo_id = :emprestimo_id');
        $teste->bindValue(':data_vencimento',date('Y/m/d',strtotime('+30 days')));
         $teste->bindValue(':total_renovacoes',$total_renovacoes+1);
        $teste->bindValue(':emprestimo_id',$emprestimo_id);
        $teste->execute();
    }

     function devolverEmprestimo($emprestimo_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare('UPDATE emprestimo SET situacao = "DEVOLVIDO" WHERE emprestimo_id = :emprestimo_id');
        $teste->bindValue(':emprestimo_id',$emprestimo_id);
        $teste->execute();
    }

     function disExemplar($exemplar_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("UPDATE exemplar SET disponivel=true WHERE exemplar_id = :exemplar_id");
        $teste->bindValue(':exemplar_id',$exemplar_id);
        $teste->execute();
    }

     function diminuirEmprestimo($usuario_id){
        $pdo = conectarBD();
        $teste = $pdo->prepare("UPDATE usuario SET total_emprestimos=:total WHERE usuario_id = :usuario_id");
        $teste->bindValue(':total',$usuario_id["total_emprestimos"] - 1);
        $teste->bindValue(':usuario_id',$usuario_id["usuario_id"]);
        $teste->execute();
    } 
?>