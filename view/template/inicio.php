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

<!-- 
<script>
    function chamaModal(msg){
        document.getElementById("modal-conteudo").innerHTML = "<p>" + JSON.stringify(msg) + "</p>"     
};
</script> -->

<!-- 
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
</script> -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- 
<script>   

$(".btn-integracao").click(function(event){
    
    let sistema = $(this).attr('name');
    let dados = JSON.stringify(sistema)

    let button = $('#btn-'+sistema)
    let loadingButton = $('#loading-'+sistema);
    let msg = $('#msg');
    //$('#btn-icon-'+sistema).hide();
    loadingButton.addClass('loading')  // Adiciona a classe .loading ao botão
   

    $.ajax({
            url: '../src/dispara_integracao.php',
            //url: '../view/home.php',
            type: 'POST',
            dataType: "json",
            data: {data: dados},
            beforeSend: function(){
            // $('#btn-lyceum').css({'background-color':, '#FBB635', 'border':, '1px solid #FBB635'});
                $('#btn-'+sistema).css({
                    'background-color': '#FBB635',
                    'border': '1px solid #FBB635'
                });
                button.hide();
                loadingButton.show(); // Mostra o botão de carregamento
            },
            complete: function(){
                $('#btn-'+sistema).css({
                    'background-color': '',
                    'border': ''
                });
                button.removeClass('loading'); // Remove a classe .loading do botão
                //$('#btn-icon-'+sistema).show();
                loadingButton.hide(); // Esconde o botão de carregamento
                button.show();
            },
            success: function(result){
                console.log(result)
                /*msg.show();
                msg.addClass('div-success')
                msg.append("<i class='fa-regular fa-face-smile-wink'></i> ")
                msg.append(result);
                setTimeout(function () {
                    msg.fadeOut(3000);
                }, 10000) 
                msg.remove()*/
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown)
                /*msg.show();
                msg.addClass('div-success')
                msg.addClass('div-error')
                msg.append("<i class='fa-regular fa-face-sad-tear'></i>")
                msg.append(errorThrown)
                setTimeout(function () {
                    msg.fadeOut(3000);
                },10000)
                msg.remove()*/
            }
        }) 

    event.preventDefault()
});  
/*
function dispara(sistema){

    let dados = JSON.stringify(sistema)

    var frm = $('#dispara-'+sistema);
    
    frm.submit(function(ev){
        
        var button = $('#btn-'+sistema);
        button.addClass('loading');  // Adiciona a classe .loading ao botão
        
        $.ajax({
            url: '../src/dispara_integracao.php',
            //url: '../view/home.php',
            type: 'POST',
            dataType: "json",
            data: {data: dados},
            beforeSend: function(){
            // $('#btn-lyceum').css({'background-color':, '#FBB635', 'border':, '1px solid #FBB635'});
                $('#btn-'+sistema).css({
                    'background-color': '#FBB635',
                    'border': '1px solid #FBB635'
                });
            },
            complete: function(){
                $('#btn-'+sistema).css({
                    'background-color': '',
                    'border': ''
                });
                button.removeClass('loading'); // Remove a classe .loading do botão
            },
            success: function(result){
                console.log(result)
                //alert("Deuuu");
            },
            error: function(jqXHR, textStatus, errorThrown){
                //alert("Erro! " + errorThrown + jqXHR + textStatus );
                console.log(errorThrown)
            }
        }) 
        ev.preventDefault();
    })
    
}*/

</script> -->

<!--
<script>
$(function(){ // equivalente a $(document).ready(function(){
  $('.nav a').click(function(event) {
    event.preventDefault();
    $('.nav > li').removeClass('active');
    $(this).parent().addClass('active');
  });
});
</script> -->

<?php include "footer.php"; ?>