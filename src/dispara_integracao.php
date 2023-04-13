<?php 
    header('Content-Type: application/json');

    $retorno = '';

    if(isset($_POST['data'])){
        include 'auth.php';
        $auth = abaris_autenticacao();
        
        include 'integracao.php';

        $data = json_decode($_POST['data']);

        if($data == 'lyceum'){
            dispara_registro_lyceum($auth);
            $retorno = 'Integração Lyceum realizada :)';
        }
        else if($data == 'abaris'){
            dispara_upload_abaris($auth);
            $retorno = 'Integração Ábaris realizada :)';
        }
        
        
    }else{
        $retorno = 'Não Funcionou';
    }

    echo json_encode($retorno);

    
?>