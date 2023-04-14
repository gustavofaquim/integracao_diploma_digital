<?php 


echo '<h1>Página de teste</h1> <br><br><br><br>';


include '../src/auth.php';

include '../src/integracao.php';



$auth = abaris_autenticacao();

$lista_excecoes = array();

//var_dump($lista_excecoes);

//$retorno = abaris_getDocumentBySearch($auth,'Documentos Pessoais - Registro', $lista_excecoes,"XML do Diplomado");

$r = dispara_upload_abaris($auth);

var_dump($r);
?>