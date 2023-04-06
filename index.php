<?php

include 'error.php';

include 'auth.php';

//include 'lyceum.php';
//include 'abaris.php';
include 'integracao.php';


define('DB_HOST'        , "DES03");
define('DB_USER'        , "lyceum");
define('DB_PASSWORD'    , "teste");
define('DB_NAME'        , "lyceum");
define('DB_DRIVER'      , "sqlsrv");

include 'conf/Conexao.php';


echo "<br><h1>Página Inicial </h1>";
$auth = abaris_autenticacao();
print_r('<h4>Código de Autenticação Ábaris: '. $auth.'</h4>');
echo "<br><br><br>";



try{

    $Conexao = Conexao::getConnection();
    $query = $Conexao->query("SELECT nome, preco, quantidade FROM produto");
    $produtos = $query->fetchAll();

 }catch(Exception $e){

    echo $e->getMessage();
    exit;

 }



//dispara_registro_lyceum($auth);


/* Testado ok */
//$xml_aluno = lyceum_listaDiplomaPorAluno("A7DA83FA-C626-4333-829F-C826491D4EC5", "06920662507");
//var_dump(json_decode($xml_aluno)[0]->cod_validacao);


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


/* Testado ok */
//$novoDoc = abaris_novoDocumento($auth,$xmlLyceum);
//var_dump($novoDoc);


//teste($auth,"A7DA83FA-C626-4333-829F-C826491D4EC5","06920662507");

//$xmlLyceum = lyceum_obterXmlDiploma('1364.384.1d29b6b66f78');
//var_dump($xmlLyceum);
//exit();


//echo "<a href='xml_diplomado.xml' download='xml_diplomado.xml'> Download</a><br>";

//$novoDoc = abaris_novoDocumento($auth,$xmlLyceum);
//var_dump($novoDoc);













//var_dump(abaris_novoDocumento($auth,base64_encode($xmlLyceum)));



//$file = json_decode(api_abaris_getDocumentByID($auth,'245771'));


//var_dump($file);

//echo "<a href='".base64_decode($file->file)."' download='".$file->name."'>Download</a> <br><br><br>";
//echo base64_decode($file->file);



//echo lyceum_listaDiplomas('1710050', '02870706111', '1', 'Finalizado');

//echo lyceum_registraDiplomaExterno('1','1','Lyceum Externa', $file->file);

// Voltar arquivo finalizado para o Ábaris