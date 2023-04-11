<?php

include '../conf/Database.php';



function recuperar_id(){
    try{
        $Conexao = Conexao::getConnection();
        
        $query = $Conexao->query("SELECT IDENT_CURRENT('integracao')");
        $response = $query->fetchAll(PDO::FETCH_OBJ);


    }catch(Exception $e){
        //echo $e->getMessage();
        $response = 0;
        
    }
    var_dump($response[0]);
    exit();
    return intval($response[0][0]);
}




function listar(){
    try{
        $Conexao = Conexao::getConnection();
        $query = $Conexao->query("SELECT TOP 10 ALUNO FROM LY_ALUNO");
        $produtos = $query->fetchAll();
    
       // var_dump($produtos);
        $response = $produtos;
    
     }catch(Exception $e){
    
       // echo $e->getMessage();
        $response = $e->getMessage();
        exit;
    
     }

     return $response;
    
}


function insere_integracao($dados){
    
    try{
        $con = new Database();
        //$Conexao = Conexao::getConnection();
       
        $cpf = $dados['cpf'];
        $matricula = $dados['matricula'];
        $nome = $dados['nome'];
        $sigla = $dados['sigla_instituicao'];
        $msg = $dados['retorno_lyceum'];

        //var_dump($cpf, "<br>", $matricula, "<br>", $nome, "<br>", $sigla);
        //exit();

        //$query = $Conexao->query("INSERT integracao (sigla_instituicao, cpf, matricula, nome_aluno,tentar_novamente, data) VALUES ('$sigla', '$cpf', '$matricula', '$nome', 'N', GETDATE())");
        //$query->fetchAll();
        
        $query = "INSERT integracao (sigla_instituicao, cpf, matricula, nome_aluno,tentar_novamente, data) VALUES (:sigla, :cpf, :matricula, :nome, 'N', GETDATE())";
        $stmt = $con->prepare($query);

        $stmt->bindParam(':sigla', $sigla);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':nome', $nome);
        
        $result = $stmt->execute();
        
        $id = $con->lastInsertId();

        $response = $id;
        

    }catch(Exception $e){
    
        // echo $e->getMessage();
         $response =  $e->getMessage();
    
      }

      return $response;
}

function insere_retorno($id, $msg){
    try{
        //$Conexao = Conexao::getConnection();
        
        $con = new Database();

        //$msg = $dados->retorno_lyceum;
        $idintegracao = $id;
        
        //$query = $Conexao->query("INSERT retorno_lyceum (idintegracao, msg) VALUES ($idintegracao, '$msg')");
        
        $query = "INSERT retorno_lyceum (idintegracao, msg) VALUES (:idintegracao, :msg)";
        $stmt = $con->prepare($query);
        

        $stmt->bindParam(':idintegracao', $idintegracao);
        $stmt->bindParam(':msg', $msg);

        $result = $stmt->execute();
        $response = $result;
        
    }catch(Exception $e){
    
        // echo $e->getMessage();
        $response = $e->getMessage();
        
     
    }
    
    return $response;
}


function lista_integrados(){
    try{
        //$Conexao = Conexao::getConnection();
        $con = new Database();

        //$query = $Conexao->query("SELECT CPF, nome_aluno FROM  integracao i INNER JOIN retorno_lyceum r ON i.idintegracao = r.idintegracao WHERE i.tentar_novamente <> 'S' --AND MSG NOT LIKE '%não cadastrada%' ");
        
        $result = $con->executeQuery("SELECT CPF, nome_aluno FROM  integracao i INNER JOIN retorno_lyceum r ON i.idintegracao = r.idintegracao WHERE i.tentar_novamente <> 'S' --AND MSG NOT LIKE '%não cadastrada%' ");

        $result = $result->fetchAll(PDO::FETCH_OBJ);

        $lista = [];

        foreach($result as $id => $objeto){
            $list = [];

            $list += ['CPF' => $objeto->CPF];
            $list += ['NOME' => $objeto->nome_aluno];

            $lista[] = $list;
        }

        $response = $lista;

        

    }catch(Exception $e){
    
        // echo $e->getMessage();
         $response =  $e->getMessage();
    
      }

      return $response;
}




