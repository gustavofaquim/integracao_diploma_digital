<?php

include 'error.php';

include 'auth.php';

include 'lyceum.php';
include 'abaris.php';


$auth = abaris_autenticacao();
echo "<br><h1>Página Inicial </h1><br>";



/** Ainda testar... */
//$xmlLyceum = lyceum_obterXmlDiploma('1364.384.1d29b6b66f78');
//var_dump($xmlLyceum. '<br>');

//$diplomaExterno = lyceum_registraDiplomaExterno($idExterno, $lote, $tenant, $xml)

/* Testado ok */
//$search = json_decode(abaris_getDocumentBySearch($auth, 'Documentos Pessoais - Registro'));
//var_dump($search);


/* Testado ok */
//$file = json_decode(api_abaris_getDocumentByID($auth,'245532'));
//var_dump($file);


/** Ainda testar... */
//lyceum_executar($auth);





$novoDoc = abaris_novoDocumento($auth,$xml);
var_dump($novoDoc);









//var_dump(abaris_novoDocumento($auth,base64_encode($xmlLyceum)));



//$file = json_decode(api_abaris_getDocumentByID($auth,'245771'));


//var_dump($file);

//echo "<a href='".base64_decode($file->file)."' download='".$file->name."'>Download</a> <br><br><br>";
//echo base64_decode($file->file);



//echo lyceum_listaDiplomas('1710050', '02870706111', '1', 'Finalizado');

//echo lyceum_registraDiplomaExterno('1','1','Lyceum Externa', $file->file);

// Voltar arquivo finalizado para o Ábaris