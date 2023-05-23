


function  buscar(){
 
    let busca = $('#buscar').val();
    
    const dados = ("../src/list_lyceum.php?busca=" + busca)
    const resposta =  dados.text()
    tbody.innerHTML = resposta
    
    //alert(busca);
}