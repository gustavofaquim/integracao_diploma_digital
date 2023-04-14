<?php



include 'lyceum.php';
include 'abaris.php';
include '../db/database.php';

header('Content-Type: text/html; charset=utf-8');

/**
 *  O método dispara_registro_lyceum chama todos os outros metodos necessários para o fluxo inicial da integração:
 *      1º. Realiza a busca de todos os documetnos do tipo 'XML Documentação Acadêmica' no Ábaris; 
 *      2º. Chama o método de vizualização de documentos do Ábaris e passa o ID de cada documento obtido no método anterior (retorna o XML em base 64 do documento);
 *      3º. Passa o XML obtido do Ábaris para o Lyceum  (retorna a mensagem do Lyceum, que deve ser gravada no banco);
 */
function dispara_registro_lyceum($auth){

    // Lista dos documentos que já foram integrados no Lyceum
    $lista_excecoes = lista_integrados();
    

    $search = json_decode(abaris_getDocumentBySearch($auth, 'Documentos Pessoais - Registro', $lista_excecoes,'XML Documentação Acadêmica'));
    $reponse = array();
    $docs = $search->documentos;
    foreach($docs as $doc){
        $dado = [];
       
        $file = json_decode(api_abaris_getDocumentByID($auth,$doc->id));

        // Pega os indexadores do documento e adiciona no array.
        foreach($doc->documentoIndice as $indexador){
            if($indexador->nomeIndice == "CPF" OR $indexador->nomeIndice == "NOME" OR  $indexador->nomeIndice == "MATRICULA" OR $indexador->nomeIndice == "Sigla Instituição"){
                $dado += array(str_replace(" ", "_",strtolower(str_replace("ç", "c",str_replace("ã","a",$indexador->nomeIndice)))) => $indexador->valor);
            }
        }
        
        $dado += array('retorno_lyceum' => lyceum_registraDiplomaExterno('1','1','Lyceum Externa', $file->file));
        $response[] = $dado;

    
        $idretorno = insere_integracao($dado);
        
        insere_retorno($idretorno,$dado['retorno_lyceum']);
        
     }
    
    if(isset($response)){
        return $response;
    }
    else{
        return 'Sem dados para integrar no momento';
    }
    
}


/**
 *  O método dispara_upload_abaris chama todos os outros métodos necessários para o fluxo final da integração.
 *      1º. Chama o método do Lyceum para listar o diploma do aluno;
 *      2º. Chama o método do Lyceum para obter o XML do Diploma;
 *      3º. Com o XML, cria o arquivo .XML no diretório 'docs';
 *      4º. Chama o método do Ábaris que cria um novo documento;
 */
function dispara_upload_abaris($auth){

    $lista_diplomas_finalizados = lista_diplomas_finalizados();

    $excecoes = array();

    $lista_abaris = json_decode(abaris_getDocumentBySearch($auth, 'Documentos Pessoais - Registro', $excecoes,"XML do Diplomado"));
    
    $lista_documentos = $lista_abaris->documentos;

    foreach($lista_diplomas_finalizados as $diplomas){

        $verifica_doc_duplicado = verifica_se_documento_existe($auth, $diplomas['cpf'],'XML do Diplomado');
    
        if(!$verifica_doc_duplicado){
            
            $aluno = $diplomas['aluno'];
            $cpf = $diplomas['cpf'];
                
            $diplomaAluno = lyceum_listaDiplomaPorAluno($aluno, $cpf);

            $codValidacao = json_decode($diplomaAluno)[0]->cod_validacao;

            $xmlLyceum = lyceum_obterXmlDiploma($codValidacao);

            $diretorioArquivo = '../docs/'.(str_replace(" ","_",strtolower(json_decode($diplomaAluno)[0]->aluno_nome))).'.xml';
            $nomeArquivo = (str_replace(" ","_",strtolower(json_decode($diplomaAluno)[0]->aluno_nome))).'.xml';
            
            $arquivo = fopen($diretorioArquivo,'w+');

            fwrite($arquivo, $xmlLyceum);
            fclose($arquivo);


            $novoDoc = abaris_novoDocumento($auth, $diretorioArquivo, $nomeArquivo, $diplomaAluno);
            $response[] = $novoDoc;
        }     
    }
    if(isset($response)){
        return $response;
    }
    else{
        return 'Sem dados para integrar no momento';
    }
 
   // print_r($lista_documentos);
    //exit();


    /*echo "<pre>";
        var_dump($lista_diplomas_finalizados);
    echo "</pre>";

    echo "<br><br> ----------------------------------------------------------------------------------------------- <br><br>";

    echo "<pre>";
        var_dump($lista_documentos);
    echo "</pre>";

    exit();*/
   
   /* $reponse = array();
    foreach($lista_diplomas_finalizados as $diplomas){
        
        $aluno = $diplomas['aluno'];
        $cpf = $diplomas['cpf'];
            
        $diplomaAluno = lyceum_listaDiplomaPorAluno($aluno, $cpf);

        $codValidacao = json_decode($diplomaAluno)[0]->cod_validacao;

        $xmlLyceum = lyceum_obterXmlDiploma($codValidacao);

        $diretorioArquivo = '../docs/'.(str_replace(" ","_",strtolower(json_decode($diplomaAluno)[0]->aluno_nome))).'.xml';
        $nomeArquivo = (str_replace(" ","_",strtolower(json_decode($diplomaAluno)[0]->aluno_nome))).'.xml';
        
        $arquivo = fopen($diretorioArquivo,'w+');

        fwrite($arquivo, $xmlLyceum);
        fclose($arquivo);


        $novoDoc = abaris_novoDocumento($auth, $diretorioArquivo, $nomeArquivo, $diplomaAluno);
        $response[] = $novoDoc;
            
    }

    if(isset($response)){
        return $response;
    }
    else{
        return 'Sem dados para integrar no momento';
    }*/
    
}

