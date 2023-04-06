<?php

include 'error.php';

include 'auth.php';

include 'lyceum.php';
include 'abaris.php';



echo "<br><h1>Página Inicial </h1><br>";
$auth = abaris_autenticacao();
echo "<br><br><br>";


/* Testado ok */
//xmlLyceum = lyceum_obterXmlDiploma('1364.384.1d29b6b66f78');
//var_dump($xmlLyceum. '<br>');

//$diplomaExterno = lyceum_registraDiplomaExterno($idExterno, $lote, $tenant, $xml)

/* Testado ok */
//$search = json_decode(abaris_getDocumentBySearch($auth, 'Documentos Pessoais - Registro'));
//var_dump($search);


/* Testado ok */
//$file = json_decode(api_abaris_getDocumentByID($auth,'245532'));
//var_dump($file);


/* Testado ok */
//lyceum_executar($auth);



$xmlLyceum = lyceum_obterXmlDiploma('1364.384.1d29b6b66f78');
//var_dump($xmlLyceum);
//exit();

$arquivo = fopen('xml_diplomado.xml','w');
fwrite($arquivo, $xmlLyceum);
fclose($arquivo);


echo "<a href='xml_diplomado.xml' download='xml_diplomado.xml'> Download</a><br>";

$novoDoc = abaris_novoDocumento($auth,$xmlLyceum);
var_dump($novoDoc);









//var_dump(abaris_novoDocumento($auth,base64_encode($xmlLyceum)));



//$file = json_decode(api_abaris_getDocumentByID($auth,'245771'));


//var_dump($file);

//echo "<a href='".base64_decode($file->file)."' download='".$file->name."'>Download</a> <br><br><br>";
//echo base64_decode($file->file);



//echo lyceum_listaDiplomas('1710050', '02870706111', '1', 'Finalizado');

//echo lyceum_registraDiplomaExterno('1','1','Lyceum Externa', $file->file);

// Voltar arquivo finalizado para o Ábaris