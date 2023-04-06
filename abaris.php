<?php

// Bsuca de documentos atraves da bsuca avançada
function abaris_getDocumentBySearch($auth,$tipoDoc){
    // Inicia o CURL
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/document/advanced-search';

    //Cabecalhos
    $headers = [
        'x-api-key:'.$auth,
        'Content-Type: application/json'
    ];

    
   $post = [
       "nomes_tipodocumento" => [$tipoDoc],
       "resultados_pagina" => 15000,
       "resultado_inicial" => 0,
       "dataDe" => "2023-02-01T13:22:39.933Z",
       "dataAte" => "2023-05-01T13:22:39.933Z",
       "indiceBusca" => [
           [
              "nome" => "Tipo de Documentos", 
              "valor" => "XML Documentação Acadêmica" 
           ] 
       ], 
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

function abaris_novoDocumento($auth,$xml){
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/document';


    //Cabecalhos
    $headers = [
        'x-api-key:'.$auth,
        'Content-Type: multipart/form-data'
    ];


    $post = [
        "NameDocType" => "CPF",
        "jsonIndex" => ["MATRICULA" => "2310744", "NOME"=> "Luiz - Teste","CPF"=> "123123123","CODIGO SIGA" => "125.33 - GRADUAÇÃO", "MANTIDA" => "UNIEVANGELICA","RESPONSAVEL PELA DIGITALIZAÇÃO"=> "Gustavo"],
        //"jsonIndex" => ['MATRICULA': '2111287',  'NOME': 'Luiz - Teste', 'CPF': '123123123', 'CODIGO SIGA':'125.33 - GRADUAÇÃO', 'MANTIDA': 'UNIEVANGELICA', 'RESPONSAVEL PELA DIGITALIZAÇÃO': 'Gustavo '],
        "File" => $xml
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
    echo $response;
}