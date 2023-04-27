<?php 
    header('Content-Type: application/json');

    $retorno = '';

    if(isset($_POST['data'])){

        include 'auth.php';
        $auth = abaris_autenticacao();
        
        include 'integracao.php';

        $data = $_POST['data'];
       // $data2 = json_decode($_POST['data']);

       if(json_decode(gettype($data)) == 'string'){
        if(json_decode($data) == 'lyceum'){
            dispara_registro_lyceum($auth);
            $retorno = 'Integração Lyceum realizada';
        }
        else if(json_decode($data) == 'abaris'){
            dispara_upload_abaris($auth);
            $retorno = 'Integração Ábaris realizada';
        }
       }else if(gettype($data) == 'array'){
            
            if($data['sistema'] == 'abaris'){
                $retorno = dispara_upload_individual_abaris($auth, $data);
            } 
            else if($data['sistema'] == 'lyceum'){
                $retorno = dispara_registro_individual_lyceum($auth, $data);
            }   
          
        }
        
        
    }else{
        $retorno = 'Não Funcionou';
    }

    echo json_encode($retorno);

    
?>