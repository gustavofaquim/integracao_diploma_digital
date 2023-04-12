<?php
include '../src/auth.php';
$auth = abaris_autenticacao();

//$retorno_lyceum = dispara_registro_lyceum();
?>


<div class='home'>

    <div>
        <h1>Página Inicial</h1>
        <h4>Código de Autenticação Ábaris: <?= $auth  ?></h4>
    </div>


    <div class="container-integracoes">
        <div class="row">
        <div class="col-sm-6">
            <div class="card" id='card-lyceum'>
            <div class="card-body">
                <h5 class="card-title">Lyceum-Ábaris</h5>
                <p class="card-text">Inicia  o processo que consulta o XML dos documentos no Ábaris e faz o upload no Lyceum.</p>
                <form id='dispara-lyceum'>
                    <button class="btn btn-primary" onclick="dispara_lyceum()"><i class="fa-solid fa-play"></i></button>
                </form>
               
            </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card" id="card-abaris">
            <div class="card-body">
                <h5 class="card-title">Ábaris-Lyceum</h5>
                <p class="card-text">Inicia o processo que bsuca o XML assinado no Lyceum e realiza o upload no Ábaris.</p>
                <a href="#" class="btn btn-primary"><i class="fa-solid fa-play"></i></a>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>


<?php

   
    var_dump($_POST);
    

?>



