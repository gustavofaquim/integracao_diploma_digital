

$(function(){ // equivalente a $(document).ready(function(){
  $('.nav a').click(function(event) {
    event.preventDefault();
    $('.nav > li').removeClass('active');
    $(this).parent().addClass('active');
  })
})


document.querySelectorAll('a').forEach(link => {
    const conteudo = document.getElementById('conteudo') 
    link.onclick = function(e){
        e.preventDefault()
        fetch(link.href)
            .then(resp => resp.text())
            .then(html => conteudo.innerHTML = html)
    }
})


