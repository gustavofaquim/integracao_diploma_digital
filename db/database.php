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


function lista_integrados($pagina, $dados){
    try{
        //$Conexao = Conexao::getConnection();
        $con = new Database();
        
        //$query = $Conexao->query("SELECT CPF, nome_aluno FROM  integracao i INNER JOIN retorno_lyceum r ON i.idintegracao = r.idintegracao WHERE i.tentar_novamente <> 'S' --AND MSG NOT LIKE '%não cadastrada%' ");
        
        $limite = 15;
        $inicio = ($pagina * $limite) - $limite;

        if($dados != 'null'){
            $result = $con->executeQuery("SELECT TOP 1 i.idintegracao, sigla_instituicao, CPF, nome_aluno, data, msg FROM  integracao i INNER JOIN retorno_lyceum r ON i.idintegracao = r.idintegracao WHERE i.matricula ='".$dados."' ORDER BY i.idintegracao --AND MSG NOT LIKE '%não cadastrada%' ");
        }else{
            $result = $con->executeQuery("SELECT i.idintegracao, sigla_instituicao, CPF, nome_aluno, data, msg FROM  integracao i INNER JOIN retorno_lyceum r ON i.idintegracao = r.idintegracao ORDER BY i.idintegracao DESC OFFSET " . $inicio . " ROWS FETCH NEXT ". $limite ." ROWS ONLY  --AND MSG NOT LIKE '%não cadastrada%' ");
        }
      

        $query_count  = $result->rowCount(PDO::FETCH_ASSOC);
        $qtdPag = ceil($query_count/$limite);

        $result = $result->fetchAll(PDO::FETCH_OBJ);

        $lista = [];


        foreach($result as $id => $objeto){
            $list = [];

            $list += ['ID' => $objeto->idintegracao];
            $list += ['SIGLA' => $objeto->sigla_instituicao];
            $list += ['CPF' => $objeto->CPF];
            $list += ['NOME' => $objeto->nome_aluno];
            $list += ['DATA' => (new \DateTimeImmutable($objeto->data))->format('d/m/y')];
            $list += ['MSG' => $objeto->msg];

            $lista[] = $list;
        }

        $response = $lista;

    }catch(Exception $e){
        // echo $e->getMessage();
         $response =  $e->getMessage();
    }

    return $response;
}

function lista_diplomas_finalizados(){
    try{
        //$Conexao = Conexao::getConnection();
        $con = new Database();

        //$query = $Conexao->query("SELECT CPF, nome_aluno FROM  integracao i INNER JOIN retorno_lyceum r ON i.idintegracao = r.idintegracao WHERE i.tentar_novamente <> 'S' --AND MSG NOT LIKE '%não cadastrada%' ");
        
        $result = $con->executeQuery("SELECT ALUNO_ID, ALUNO_CPF FROM [LYCEUM].[DBO].[LY_DIPLOMA_DIGITAL] WHERE TENANT = 'Lyceum Externa'");

        $result = $result->fetchAll(PDO::FETCH_OBJ);

        $lista = [];

        foreach($result as $id => $objeto){
            $list = [];

            $list += ['aluno' => $objeto->ALUNO_ID];
            $list += ['cpf' => $objeto->ALUNO_CPF];

            $lista[] = $list;
        }

        $response = $lista;

        

    }catch(Exception $e){
    
        // echo $e->getMessage();
         $response =  $e->getMessage();
    
      }

      return $response;
}