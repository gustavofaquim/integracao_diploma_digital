<?php 

include '../db/database.php';

$pagina = (isset($_GET['p']))? $_GET['p'] : 1; 

$integrados = lista_integrados($pagina, 'null');


?>

<div class='listagem'>
<div id='table'>
  <table class="table table-striped table-responsive">
    <thead class="thead-dark">
      <tr class="text-center bg-primary text-white">
        <th scope="col">#</th>
        <th scope="col">IES</th>
        <th scope="col">CPF</th>
        <th scope="col">NOME</th>
        <th scope="col">DATA</th>
        <th scope="col">LOGS</th>
      </tr>
    </thead>
    <tbody></tbody>
    <?php 
   
    $cont = 0;
    foreach($integrados as $dado){
      echo"<tr>";
        echo"<th scope='row'>".$dado['ID']."</th>";
        echo"<td>".$dado['SIGLA']."</td>";
        echo"<td>".$dado['CPF']."</td>";
        echo"<td id='nome'>".$dado['NOME']."</td>";
        echo"<td>".$dado['DATA']."</td>";
        echo "<td> 
        <button type='button' id='btn".$dado['ID']."' name='btnModal' onclick='chamaModal(".$dado['MSG'].")' class='btn btn-outline-secondary btn-sm' data-toggle='modal' data-target='#modalExemplo'>
          <i class='fa-regular fa-file-lines'></i>
        </button> </td>";
        //echo"<td id='msg'>".$dado['MSG']."</td>";
      echo"</tr>";
    }
    ?>  
    </tbody>
  </table>

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


<!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"  tabindex="-1" role="dialog">
    <div class="modal-content" id="modal-lyceum">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="exampleModalLabel" >Retorno Lyceum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <i class="fa-solid fa-circle-xmark"></i>
        </button>
      </div>
      <div class="modal-body">
        <div id="modal-conteudo">

        </div>
       
       
      </div>
    </div>
  </div>
</div>


