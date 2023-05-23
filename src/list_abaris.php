<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../src/auth.php';
$auth = abaris_autenticacao();

include '../src/abaris.php';

$pagina = intval((isset($_GET['pagina']))? $_GET['pagina'] : 1); 
$string_busca = (isset($_GET['busca'])) ? $_GET['busca'] : '';


// calcular o inicio da vizualização
$qnt_result_pag = 20; // Quantidade de registros por página
$inicio = ($pagina * $qnt_result_pag) - $qnt_result_pag;

$lista_excecoes = array();

$lista_abaris = abaris_getDocumentBySearch_ArrayTable($inicio, $qnt_result_pag, $auth, 'Documentos Pessoais - Registro', $lista_excecoes,'XML Documentação Acadêmica', $string_busca);


$qnt_retorno = count($lista_abaris);

$dados = "<table class='table table-striped table-responsive'>
            <thead class='thead-dark'>
            <tr class='text-center bg-primary text-white'>
                <th scope='col'>ID</th>
                <th scope='col'>IES</th>
                <th scope='col'>CPF</th>
                <th scope='col'>MATRICULA</th>
                <th scope='col'>NOME</th>
                <th scope='col'>LOG</th>
                <th scope='col'>INTEGRAR</th>
            </tr>
            </thead>
            <tbody>";

foreach($lista_abaris as $dado){
    if($dado['retorno_lyceum'] <> 'Sem retorno'){
        //$estilizacao = "style='color:#3CB371; border: 1px solid #3CB371'; ";
        $estilizacao = "";
    }else{
        $estilizacao = "removeDisplay";
    }
    $dados.= "<tr>
                <th scope='row'>".$dado['id']."</th>
                <td>".$dado['sigla_instituicao']."</td>
                <td>".$dado['cpf']."</td>
                <td>".$dado['matricula']."</td>
                <td id='nome'>".$dado['nome']."</td>
                <td id='log'>
                    <button type='button' id='btn".$dado['id']."' name='btnModal' onclick='chamaModal(".json_encode($dado['retorno_lyceum']).")' class=' ".$estilizacao." btn btn-outline-secondary btn-sm' data-toggle='modal' data-target='#modalExemplo'>
                        <i class='fa-regular fa-file-lines'></i>
                    </button>
                </td>
                </td>
                <td> 
                    <form id='dispara-abaris'>
                        <button class='btn btn-primary btn-teste' type='button' name='abaris'  onclick='integracao_individual_lyceum(".json_encode($dado).",".$dado['id'].")'  id='btn-abaris-".$dado['id']."'><i class='fa-solid fa-play' id='btn-icon-abaris'></i></button>
                        <button class='loading-abaris' id='loading-abaris-".$dado['id']."' disabled style='display: none;'></button>
                    </form>
                </td>
            </tr>";
}

$dados .= "</tbody></table>";



$dados .= '<nav id="paginacao" aria-label="Navegação de página"> <ul class="pagination justify-content-center">';

if($pagina <= 1){
    $dados .= '<li class="page-item disabled"> <a class="page-link"  href="#" onclick="listarDocumentos('.(($pagina - 1) >= 1 ? ($pagina - 1) : 1 ).')" tabindex="-1">Anterior</a></li>';
}else{
    $dados .= '<li class="page-item"> <a class="page-link"  href="#" onclick="listarDocumentos('.(($pagina - 1) >= 1 ? ($pagina - 1) : 1 ).')" tabindex="-1">Anterior</a></li>';
}
$dados .= '<li class="page-item active" ><a class="page-link" href="#">'.$pagina.'</a></li>';
if($qnt_retorno < $qnt_result_pag){
    $dados .= '<li class="page-item disabled"> <a class="page-link" href="#" onclick="listarDocumentos('.($pagina + 1).')">Próximo</a>';   
}else{
    $dados .= '<li class="page-item"> <a class="page-link" href="#" onclick="listarDocumentos('.($pagina + 1).')">Próximo</a>';   
}
$dados .= '</li> </ul> </nav> ';





echo $dados;
