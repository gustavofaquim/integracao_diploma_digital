<?php



// Bsuca de documentos atraves da busca avançada
function abaris_getDocumentBySearch($auth,$tipoDoc, $excecoes,$tipoIndice){
    // Inicia o CURL
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/document/advanced-search';

    //Cabecalhos
    $headers = [
        'x-api-key:'.$auth,
        'Content-Type: application/json'
    ];

    
    $indice = array();
    $indice[] = array("nome" => "Tipo de Documentos","operador" => "=","valor" => $tipoIndice);
    
    
    foreach($excecoes as $ex){
        $indice[] = array("nome" => "CPF", "operador" => "<>", "valor" => $ex["CPF"]);    
    }
  
   $post = [
       "nomes_tipodocumento" => [$tipoDoc],
       "resultados_pagina" => 15000,
       "resultado_inicial" => 0,
       "dataDe" => "2023-04-01",
       //"dataAte" => "2023-05-01T13:22:39.933Z",
       "indiceBusca" =>  $indice
   ];

   $json = json_encode($post);

   
    curl_setopt_array($curl,[
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $json
    ]);
    
     // Executa a requisição
     $response = curl_exec($curl);

     // Fecha a conexão
     curl_close($curl);

     // Imprime o resultado da requisição
  
     return $response;   
} 



// Busuca de documentos atraves da busca avançada, passando o CPF 
function abaris_getDocumentBySearchCPF($auth,$tipoDoc, $excecoes,$tipoIndice, $cpf){
    // Inicia o CURL
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/document/advanced-search';

    //Cabecalhos
    $headers = [
        'x-api-key:'.$auth,
        'Content-Type: application/json'
    ];

    
    $indice = array();
    $indice[] = array("nome" => "Tipo de Documentos","operador" => "=","valor" => $tipoIndice);
    $indice[] = array("nome" => "CPF", "operador" => "=", "valor" => $cpf); 
    
    
   /*foreach($excecoes as $ex){
        $indice[] = array("nome" => "CPF", "operador" => "<>", "valor" => $ex["CPF"]);    
    }*/
  
   $post = [
       "nomes_tipodocumento" => [$tipoDoc],
       "resultados_pagina" => 15000,
       "resultado_inicial" => 0,
       "dataDe" => "2023-04-01",
       //"dataAte" => "2023-05-01T13:22:39.933Z",
       "indiceBusca" =>  $indice
   ];


   $json = json_encode($post);


    curl_setopt_array($curl,[
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $json
    ]);
    
     // Executa a requisição
     $response = curl_exec($curl);


     // Fecha a conexão
     curl_close($curl);


     // Imprime o resultado da requisição
  
     return $response;   
}   


function api_abaris_getDocumentByID($auth, $id){
    // Inicia o CURL
    $curl = curl_init();
    set_time_limit(0);
    $url = 'https://documents.abaris.com.br/api/v1/document/'.$id.'/view';

    //Cabecalhos
    $headers = [
        'x-api-key:'.$auth
    ];
    
    curl_setopt_array($curl,[
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    ]);

     // Executa a requisição
     $response = curl_exec($curl);

     // Fecha a conexão
     curl_close($curl);

     // Imprime o resultado da requisição
  
     return $response;   
}



// Em desenvolvimento...

function abaris_novoDocumento($auth, $diretorioArquivo, $nomeArquivo, $diplomaAluno){
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/document';




    //Cabecalhos
    $headers = [
        'x-api-key:'.$auth,
        "cache-control: no-cache",
        'Content-Type: multipart/form-data'
    ];

    $nomeAluno = json_decode($diplomaAluno)[0]->aluno_nome;
    $matriculaAluno = json_decode($diplomaAluno)[0]->aluno_id;
    $cpfAluno = json_decode($diplomaAluno)[0]->aluno_cpf;
    $aluno_id = json_decode($diplomaAluno)[0]->aluno_id;

    

    $IdDocType = "122";
    $nameDocType = 'Documentos Pessoais - Registro';
    $jsonIndex = json_encode(array("Tipo de Documentos" => "XML do Diplomado", "Sigla Instituição" => "Faculdade CONSAE", "NOME" => $nomeAluno, "MATRICULA" => $aluno_id, "CPF" => $cpfAluno));
    $file = new CURLFile($diretorioArquivo, 'application/json', $nomeArquivo); 


    $data = array(
        "IdDocType" =>   $IdDocType,
        'nameDocType' => $nameDocType,
        'jsonIndex' => $jsonIndex,
        'File' => $file
    );

    

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $data
    ]);



     // Executa a requisição
     $response = curl_exec($curl);


     // Fecha a conexão
     curl_close($curl);

     unlink($diretorioArquivo);

 
     // Imprime o resultado da requisição
     return $response;

}


function api_abaris_teste(){

    // Inicia o CURL
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/ping';

   
    curl_setopt_array($curl,[
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true
    ]);

    // Executa a requisição
    $response = curl_exec($curl);

    // Fecha a conexão
    curl_close($curl);

    // Imprime o resultado da requisição
    return $response;
}


function verifica_se_documento_existe($auth, $cpf, $tipoIndice){

    $excecoes = array();

    $lista_abaris = json_decode(abaris_getDocumentBySearch($auth, 'Documentos Pessoais - Registro', $excecoes, $tipoIndice));
    $lista_documentos = $lista_abaris->documentos;

    $array_cpf = array();


    foreach($lista_documentos as $list){
        array_push($array_cpf ,$list->documentoIndice[4]->valor);
    }

   
    if(in_array($cpf, $array_cpf)){
        return true;
    }else{
        return false;
    }

   // return $array_cpf;

}


function abaris_getDocumentBySearch_ArrayTable($inicio, $qnt_result_pag,$auth,$tipoDoc, $excecoes,$tipoIndice, $string){
    
    include '../db/database.php';

    // Inicia o CURL
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/document/advanced-search';

    //Cabecalhos
    $headers = [
        'x-api-key:'.$auth,
        'Content-Type: application/json'
    ];

    
    $indice = array();
    $indice[] = array("nome" => "Tipo de Documentos","operador" => "=","valor" => $tipoIndice);

    if(isset($string)){
        $indice[] = array("nome" => "NOME", "operador" => "*A*", "valor" => $string); 
    }
    
    
    foreach($excecoes as $ex){
        $indice[] = array("nome" => "CPF", "operador" => "<>", "valor" => $ex["CPF"]);    
    }
    
    $post = [
        "nomes_tipodocumento" => [$tipoDoc],
        "resultados_pagina" => $qnt_result_pag,
        "resultado_inicial" => $inicio,
        "dataDe" => "2023-04-01",
        //"dataAte" => "2023-05-01T13:22:39.933Z",
        "indiceBusca" =>  $indice
    ];

    $json = json_encode($post);

    
    curl_setopt_array($curl,[
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $json
    ]);
    
    // Executa a requisição
    $response = curl_exec($curl);


    // Fecha a conexão
    curl_close($curl);

    // Imprime o resultado da requisição
    
    $search = json_decode($response);   

    //$search = json_decode(abaris_getDocumentBySearch($auth, 'Documentos Pessoais - Registro', $excecoes,'XML Documentação Acadêmica'));
    $res = array();
    $docs = $search->documentos;

  
    
    foreach($docs as $doc){
        $dado = [];
       

        // Pega os indexadores do documento e adiciona no array.
        $dado += array('id' => $doc->id);
        $dado += array('data_import' => $doc->dataImportacao);
      
        foreach($doc->documentoIndice as $indexador){

           
            if($indexador->nomeIndice == "CPF" OR $indexador->nomeIndice == "NOME" OR  $indexador->nomeIndice == "MATRICULA" OR $indexador->nomeIndice == "Sigla Instituição"){
                $dado += array(str_replace(" ", "_",strtolower(str_replace("ç", "c",str_replace("ã","a",$indexador->nomeIndice)))) => $indexador->valor);
            }
                        
            if($indexador->nomeIndice == "MATRICULA"){
                
                $retorno_lyceum = lista_integrados(1, $indexador->valor);
               
                if(count($retorno_lyceum) >= 1){
                   // print_r($retorno_lyceum);
                    $retorno = json_decode($retorno_lyceum[0]['MSG']);
                    //$retorno = json_decode($retorno_lyceum[0]['MSG'])->titulo;
                }else{
                    $retorno = 'Sem retorno';
                }
         
               
                //var_dump($retorno);
               // var_dump(json_decode($retorno_lyceum[0]['MSG'])->titulo . '<br><br>');
                
                $dado += array('retorno_lyceum' =>  $retorno);
            }            
        }
        
        $res[] = $dado;
    }



    return $res;
}