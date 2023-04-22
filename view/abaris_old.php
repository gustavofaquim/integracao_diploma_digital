<?php 

include '../src/auth.php';
$auth = abaris_autenticacao();

include '../src/abaris.php';


?>

<div class='listagem'>
    <h2>XML Documentação Acadêmica</h2>
<div id='table'>
  <table class="table table-striped table-responsive">
    <thead class="thead-dark">
      <tr class="text-center bg-primary text-white">
        <th scope="col">#</th>
        <th scope="col">IES</th>
        <th scope="col">CPF</th>
        <th scope="col">MATRICULA</th>
        <th scope="col">NOME</th>
        <th scope="col">integração</th>
      </tr>
    </thead>
    <tbody>
    <?php 
   
    $cont = 0;
    
    foreach($lista_abaris as $dado){
      //var_dump($dado);

      echo"<tr>";
        echo"<th scope='row'>".$dado['id']."</th>";
        echo"<td>".$dado['sigla_instituicao']."</td>";
        echo"<td>".$dado['cpf']."</td>";
        echo"<td>".$dado['matricula']."</td>";
        echo"<td id='nome'>".$dado['nome']."</td>";
        echo "<td> 
        <form id='dispara-abaris'>
            <button class='btn btn-primary btn-teste' type='button' onclick='integracao_individual_lyceum(".json_encode($dado).")' name='abaris-individual' id='".$dado['id']."'><i class='fa-solid fa-play' id='btn-icon-abaris'></i></button>
            <button id='loading-abaris' disabled style='display: none;'></button>
        </form>
        </td>";
        /*echo "<td> 
        <button type='button' id='btn".$dado['ID']."' name='btnModal' onclick='chamaModal(".$dado['MSG'].")' class='btn btn-outline-secondary btn-sm' data-toggle='modal' data-target='#modalExemplo'>
          <i class='fa-regular fa-file-lines'></i>
        </button> </td>"; */
        //echo"<td id='msg'>".$dado['MSG']."</td>";
      echo"</tr>";
    }
    ?>  
    </tbody>
  </table>

<div>
  <button id="anterior" disabled>&lsaquo; Anterior</button>
  <span id="numeracao"></span>
  <button id="proximo" disabled>Próximo &rsaquo;</button>
</div>


</div>




<!-- <div class='paginador'>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


</div> -->


</div>




