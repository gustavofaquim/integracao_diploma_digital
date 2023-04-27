

$(function(){ // equivalente a $(document).ready(function(){
  $('.nav a').click(function(event) {
    event.preventDefault();
    $('.nav > li').removeClass('active');
    $(this).parent().addClass('active');
    
    let pag = $(this).attr('id')

    if(pag == 'abaris'){
      console.log('entrouu...')
      pegaElementoTable()
    }else if(pag == 'lyceum'){
      console.log('entrouu...')
      pegaElementoTableLyceum()
    }
  //  pag == 'abaris' ? listarDocumentos(1) : 'null'
  
  })
})


document.querySelectorAll('[wm-nav]').forEach(link => {
    const conteudo = document.getElementById('conteudo') 
    
    link.onclick = function(e){
        e.preventDefault()
        fetch(link.getAttribute('wm-nav'))
            .then(resp => resp.text())
            .then(html => conteudo.innerHTML = html)
    }
})


