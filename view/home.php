<?php
include '../src/auth.php';
$auth = abaris_autenticacao();

//$retorno_lyceum = dispara_registro_lyceum();
?>


<div class='home'>

    <div>
        <h1>Página Inicial</h1>
        <?php 
            if($auth){
                echo "<h3 id='icon-ativa'><i class='fa-solid fa-plug-circle-check'></i> Integração com os sistemas ativa.</h3>";
               // echo "<h5>Autenticação da Sessão: ".$auth."</h5>";
            }
            else{
                echo "<h3 id='icon-off'><i class='fa-solid fa-plug-circle-minus'></i> Poxa, parece que houve algum problema.</h3>";
            }
        ?>
    </div>


    <div class="container-integracoes">
    
        <div class="row">
        <h3> Integração em Lote </h3>
        <div class="col-sm-6">
            <div class="card" id='card-lyceum'>
            <div class="card-body">
                <h5 class="card-title">Lyceum-Ábaris</h5>
                <p class="card-text">Inicia  o processo que consulta o XML dos documentos no Ábaris e faz o upload no Lyceum.</p>
                <form id='dispara-lyceum'>
                    <button class="btn btn-primary btn-integracao" name='lyceum' id='btn-lyceum'><i class="fa-solid fa-play" id='btn-icon-lyceum'></i></button>
                    <button id="loading-lyceum" disabled style="display: none;"></button>
                </form>
               
            </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card" id="card-abaris">
            <div class="card-body">
                <h5 class="card-title">Ábaris-Lyceum</h5>
                <p class="card-text">Inicia o processo que busca o XML dos documentos assinados no Lyceum e realiza o upload no Ábaris.  </p>
                <form id='dispara-abaris'>
                    <button class="btn btn-primary btn-integracao" name='abaris' id='btn-abaris'><i class="fa-solid fa-play" id='btn-icon-abaris'></i></button>
                    <button id="loading-abaris" disabled style="display: none;"></button>
                </form>
            </div>
            </div>
        </div>
        </div>

        <div class="alert" id="msg"> </div>
        
    </div>
    </div>
</div>


