<?php 
    header('Content-Type: application/json');

    $retorno = 'Não Funcionou';
    

    if(isset($_POST['data'])){

        include 'auth.php';
        $auth = abaris_autenticacao();
        
        include 'integracao.php';

        $data = $_POST['data'];
       // $data2 = json_decode($_POST['data']);

        if(gettype($data) == 'array'){
            
            if($data['sistema'] == 'abaris'){
                $retorno = dispara_upload_individual_abaris($auth, $data);
            }  
            else if($data['sistema'] == 'lyceum'){
                $retorno = dispara_registro_individual_lyceum($auth, $data);
            }
            else if($data['sistema'] == 'geral-lyceum'){
                dispara_registro_lyceum($auth);
                $retorno = 'Integração Lyceum realizada';
            }
            else if($data['sistema'] == 'geral-abaris'){
                dispara_upload_abaris($auth);
                $retorno = 'Integração Ábaris realizada';
            }      
          
        }
        
        
    }

    echo json_encode($retorno);

    
?>