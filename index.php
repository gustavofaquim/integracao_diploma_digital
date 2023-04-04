<?php

echo "Ola mundo </br></br>";

function api_abaris_autenticacao(){

    // Inicia o CURL
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/login';

    //Cabecalhos
    $headers = [
        'Custom-Origin: aee.abaris.com.br',
        'Content-Type: application/json'
    ];

    //Post
    $post = [
        'userName' => '-----------',
        'password' => '-----------'
    ];

    $json = json_encode($post);

    // Define as configurações 
   /* curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST,'POST');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);*/
    
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
   // echo $response;

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

function api_abaris_getDocumentByID($auth, $id){
    // Inicia o CURL
    $curl = curl_init();

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
        "dataDe" => "2023-04-04T13:22:39.933Z",
        "dataAte" => "2023-04-04T13:22:39.933Z"
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

function lyceum_listaDiplomas($aluno,$cpf, $id,$status){
     
    // Inicia o CURL
    $curl = curl_init();

    $url = 'http://172.16.16.106:8080/api/diploma-digital/diplomas-digitais?aluno-id='.$aluno.'&cpf='.$cpf.'&lote='.$id.'&status='.$status;

    //Cabecalhos
    $headers = [
        'Authorization: Basic YXBpdXNlcjphcGl1c2VyQDEyMw=='
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

function lyceum_registraDiplomaExterno($idExterno, $lote, $tenant, $xml){
    
    // Inicia o CURL
    $curl = curl_init();

    $url = 'http://172.16.16.106:8080/api/diploma-digital/registrar-diploma';

    //Cabecalhos
    $headers = [
        'Authorization: Basic YXBpdXNlcjphcGl1c2VyQDEyMw==',
        'Content-Type: application/json'
    ];

    $post = [
        "idExterno" => $idExterno,
        "lote" => $lote,
        "tenant" => $tenant,
        "xmlDocumentacao" => $xml
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


$cod = json_decode(api_abaris_autenticacao());
echo $cod->rsaKey ."</br></br>";
//api_abaris_teste();
$file = json_decode(api_abaris_getDocumentByID($cod->rsaKey,'245771'));


//var_dump($file);

//echo "<a href='".base64_decode($file->file)."' download='".$file->name."'>Download</a> <br><br><br>";
//echo base64_decode($file->file);
//echo abaris_getDocumentBySearch($cod->rsaKey, 'CPF');


//echo lyceum_listaDiplomas('1710050', '02870706111', '1', 'Finalizado');

echo lyceum_registraDiplomaExterno('1','1','Lyceum Externa', $file->file);

// Voltar arquivo finalizado para o Ábaris