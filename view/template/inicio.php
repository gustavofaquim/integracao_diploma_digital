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