<?php


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
        'userName' => '---------------',
        'password' => '--------------'
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
   var_dump($response);

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



function lyceum_registraDiplomaExterno($idExterno, $lote, $tenant, $xml){
    
    // Inicia o CURL
    $curl = curl_init();

    $url = 'http://172.16.16.106:8080/api/diploma-digital/registrar-diploma';

    //Cabecalhos
    $headers = [
        'Authorization: Basic YXBpdXNlcjphcGl1c2VyQDEyMw==',
        //'Content-Type: multipart/form-data'
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


$auth = json_decode(api_abaris_autenticacao())->rsaKey;
echo $auth ."</br></br>";
//api_abaris_teste();




function executar_upload_lyceum($auth){
    $search = json_decode(abaris_getDocumentBySearch($auth, 'Documentos Pessoais - Registro'));
    
    $docs = $search->documentos;
   
    foreach($docs as $doc){
        
         $file = json_decode(api_abaris_getDocumentByID($auth,$doc->id));
         //var_dump($file->file);
         //exit();
         var_dump(lyceum_registraDiplomaExterno('1','1','Lyceum Externa', $file->file));
         echo "<br> <br>";
     
     }
     
}

// executar_upload_lyceum($auth);



function lyceum_obterXmlDiploma($codValidacao){

    // Inicia o CURL
    $curl = curl_init();

    $url = 'http://172.16.16.106:8080/api/diploma-digital/obter-arquivo-diplomado?cod-validacao='.$codValidacao.'&tipo=xml';

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

$xmlLyceum = lyceum_obterXmlDiploma('1364.384.1d29b6b66f78');

var_dump(abaris_novoDocumento($auth,base64_encode($xmlLyceum)));



//$file = json_decode(api_abaris_getDocumentByID($auth,'245771'));


//var_dump($file);

//echo "<a href='".base64_decode($file->file)."' download='".$file->name."'>Download</a> <br><br><br>";
//echo base64_decode($file->file);



//echo lyceum_listaDiplomas('1710050', '02870706111', '1', 'Finalizado');

//echo lyceum_registraDiplomaExterno('1','1','Lyceum Externa', $file->file);

// Voltar arquivo finalizado para o Ábaris