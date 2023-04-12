<?php 

include '../db/database.php';

$integrados = lista_integrados();
?>

<div id='table'>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">CPF</th>
        <th scope="col">NOME</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $cont = 0;
    foreach($integrados as $dado){
      $cont++;
      echo"<tr>";
        echo"<th scope='row'>".$cont."</th>";
        echo"<td>".$dado['CPF']."</td>";
        echo"<td>".$dado['nome_aluno']."</td>";
      echo"</tr>";
    }
    ?>  
    </tbody>
  </table>
</div>
