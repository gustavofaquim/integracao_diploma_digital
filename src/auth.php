<?php

//namespace IntegracaoDiplomaDigital;

function abaris_autenticacao(){


    $autenticacao = json_decode(file_get_contents('../conf/conf.json'));
    
    $user = $autenticacao->user;
    $pass = $autenticacao->password;


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
        'userName' => $user,
        'password' => $pass
    ];
    
    $json = json_encode($post);
    
    // Define as configurações  
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
    
    return json_decode($response)->rsaKey;
}

