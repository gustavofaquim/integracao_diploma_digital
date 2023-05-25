<?php 


?>

<div class='listagem '>
  

  <div class="card card-titulo-info card-abaris">
    <div class="card-body">
      <i class="fa-regular fa-file-code"></i>
      <div> 
        <h4>XML Documentação Acadêmica</h4>
        <p> Documentos que foram armazenados no Ábaris para serem conferidos e enviados para o registro no Lyceum.</p>
      </div>
    </div>
  </div>
    
  <div class='barra-busca'>
    
    <input class="form-control mr-sm-2" type="search" name='buscar' id='buscar' placeholder="Pesquisar" aria-label="Pesquisar">
    <button class="btn btn-outline-primary my-2 my-sm-0" type='button' id='btn-busca' onclick='buscar()'>Buscar</button>
   
  </div>
    
  <div id='table'>
    
    <span class='listar-documentos'></span>

  </div>


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

