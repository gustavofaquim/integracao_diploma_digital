<?php 



include "header.php"; 
include '../src/error.php'; 

//include 'lyceum.php';
//include 'abaris.php';
include '../src/integracao.php';

?>


<div class="container">
    
<seciton id="conteudo">
    
</seciton>
</div>

<!-- <script> Descomentar se o modal bugar

$('#meuModal').on('shown.bs.modal', function () {
  $('#meuInput').trigger('focus')
})

</script> --> 


<script>
    function chamaModal(msg){
        document.getElementById("modal-conteudo").innerHTML = "<p>" + JSON.stringify(msg) + "</p>"     
};
</script>

<script>
    document.querySelectorAll('a').forEach(link => {
        const conteudo = document.getElementById('conteudo')

        link.onclick = function(e){
            e.preventDefault()
            fetch(link.href)
                .then(resp => resp.text())
                .then(html => conteudo.innerHTML = html)
        }
    })
</script>

<?php include "footer.php"; ?>