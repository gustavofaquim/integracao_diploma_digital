<?php
include '../src/auth.php';
$auth = abaris_autenticacao();
?>


<div class='home'>

    <div>
        <h1>Página Inicial</h1>
        <h4>Código de Autenticação Ábaris: <?= $auth  ?></h4>
    </div>


    <div class="container-integracoes">
        <div class="row">
        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lyceum-Ábaris</h5>
                <p class="card-text">Inicia  o processo que consulta o XML dos documentos no Ábaris e faz o upload no Lyceum.</p>
                <a href="#" class="btn btn-primary"><i class="fa-solid fa-play"></i></a>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
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




