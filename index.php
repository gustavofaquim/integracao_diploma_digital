<?php

echo "Ola mundo <br>";

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
        'userName' => '---------',
        'password' => '---------',
        'AuthenticationCode:' =>  '0'
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
    echo $response;
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

function api_abaris_getDocument($id){
    // Inicia o CURL
    $curl = curl_init();

    $url = 'https://documents.abaris.com.br/api/v1/document/{'.$id.'}';
    
}

api_abaris_autenticacao();
api_abaris_teste();
