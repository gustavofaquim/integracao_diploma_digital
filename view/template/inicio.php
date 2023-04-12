<?php 



include "header.php"; 
include '../src/error.php'; 

//include 'lyceum.php';
//include 'abaris.php';
include '../src/integracao.php';

?>


<div class="container">
    
<seciton id="conteudo">
    <?php include '../view/home.php' ?>
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

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    
    let x = {
        'op': 'true'
    }
    let dados = JSON.stringify(x)
    
    function dispara_lyceum(){

        var frm = $('#dispara-lyceum');

        frm.submit(function(ev){
            $.ajax({
                url: '../view/home.php',
                type: 'POST',
                dataType: "json",
                data: {data: dados},
                sucess: function(result){
                    console.log('Deu certooo')
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert("Erro! " + errorThrown + jqXHR + textStatus );
                    console.log(errorThrown)
                }
            }) 
            ev.preventDefault();
        })
    }

</script>

<?php include "footer.php"; ?>