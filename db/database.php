<?php

include 'conf/Conexao.php';
define('DB_HOST'        , "DES03");
define('DB_USER'        , "lyceum");
define('DB_PASSWORD'    , "teste");
define('DB_NAME'        , "Integracao_Diploma_Abaris");
define('DB_DRIVER'      , "sqlsrv");



function recuperar_id(){
    try{
        $Conexao = Conexao::getConnection();
        
        $query = $Conexao->query("SELECT IDENT_CURRENT('integracao')");
        $response = $query->fetchAll(PDO::FETCH_OBJ);


    }catch(Exception $e){
        //echo $e->getMessage();
        $response = 0;
        
      }
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
        $Conexao = Conexao::getConnection();
       
        $cpf = $dados['cpf'];
        $matricula = $dados['matricula'];
        $nome = $dados['nome'];
        $sigla = $dados['sigla_instituicao'];
        $msg = $dados['retorno_lyceum'];

        //var_dump($cpf, "<br>", $matricula, "<br>", $nome, "<br>", $sigla);
        //exit();

        $query = $Conexao->query("INSERT integracao (sigla_instituicao, cpf, matricula, nome_aluno,tentar_novamente, data) VALUES ('$sigla', '$cpf', '$matricula', '$nome', 'N', GETDATE())");
        $query->fetchAll();
        
        $response = "Deu certo :)";
        

    }catch(Exception $e){
    
        // echo $e->getMessage();
         $response =  $e->getMessage();
    
      }

      return $response;
}

function insere_retorno($id, $msg){
    try{
        $Conexao = Conexao::getConnection();
        
        //$msg = $dados->retorno_lyceum;
        $idintegracao = $id;
        
        $query = $Conexao->query("INSERT retorno_lyceum (idintegracao, msg) VALUES ($idintegracao, '$msg')");
        $query->fetchAll(PDO::FETCH_OBJ);
        $response = "Deu certo :)";
        
    }catch(Exception $e){
    
        // echo $e->getMessage();
        $response = $e->getMessage();
        
     
      }
      return $response;
}


function lista_integrados(){
    try{
        $Conexao = Conexao::getConnection();
       
        $query = $Conexao->query("SELECT CPF, nome_aluno FROM  integracao i INNER JOIN retorno_lyceum r ON i.idintegracao = r.idintegracao --WHERE MSG NOT LIKE '%Erro%' --AND MSG NOT LIKE '%não cadastrada%' ");
        
        
        $result =  $query->fetchAll(PDO::FETCH_OBJ);

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




