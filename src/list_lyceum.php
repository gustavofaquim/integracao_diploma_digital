<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);


include '../db/database.php';

$pagina = intval((isset($_GET['pagina']))? $_GET['pagina'] : 1); 

// calcular o inicio da vizualização
$qnt_result_pag = 20; // Quantidade de registros por página
$inicio = ($pagina * $qnt_result_pag) - $qnt_result_pag;


$lista_lyceum = lista_diplomas_finalizados();

//var_dump($lista_lyceum);
//exit();

$qnt_retorno = count($lista_lyceum);

$dados = "<table class='table table-striped table-responsive'>
            <thead class='thead-dark'>
            <tr class='text-center bg-primary text-white'>
                <th scope='col'>ID</th>
                <th scope='col'>IES</th>
                <th scope='col'>CPF</th>
                <th scope='col'>MATRICULA</th>
                <th scope='col'>NOME</th>
                <th scope='col'>STATUS</th>
                <th scope='col'>DT STATUS</th>
                <th scope='col'>INTEGRAR</th>
            </tr>
            </thead>
            <tbody>";

foreach($lista_lyceum as $dado){
    $dados.= "<tr>
                <th scope='row'>".$dado['id_diploma']."</th>
                <td class='coluna-grande'>".$dado['polo_nome']."</td>
                <td>".$dado['cpf']."</td>
                <td>".$dado['aluno']."</td>
                <td id='nome'>".$dado['aluno_nome']."</td>
                <td id='status'>".$dado['status_atual']."</td>
                <td id='status'>".$dado['dt_status']."</td>
                <td> 
                    <form id='dispara-abaris'>
                        <button class='btn btn-primary btn-teste' type='button' name='abaris'  onclick='integracao_individual_abaris(".json_encode($dado).",".$dado['id_diploma'].")'  id='btn-abaris-".$dado['id_diploma']."'><i class='fa-solid fa-play' id='btn-icon-abaris'></i></button>
                        <button class='loading-abaris' id='loading-abaris-".$dado['id_diploma']."' disabled style='display: none;'></button>
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
