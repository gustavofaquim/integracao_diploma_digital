


function  buscar(){
 
    let busca = $('#buscar').val();
    console.log('Search: ' + busca)

     
    const listarDocumentos = async (busca) =>{
        const dados = await fetch("../src/list_abaris.php?busca=" + busca)
        const resposta = await dados.text()
        tbody.innerHTML = resposta
    }

    listarDocumentos(busca)
}