<?php




function lyceum_listaDiplomaPorAluno($aluno, $cpf){
    $curl = curl_init();

    $url = 'http://172.16.16.106:8080/api/diploma-digital/diplomas-digitais?aluno-id='.$aluno.'&cpf='.$cpf.'&status=Finalizado';

    $headers = [
        'Authorization: Basic YXBpdXNlcjphcGl1c2VyQDEyMw=='
    ];

    curl_setopt_array($curl,[
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers
    ]);

    $response = curl_exec($curl);

  
    curl_close($curl);

    return $response;

}


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



