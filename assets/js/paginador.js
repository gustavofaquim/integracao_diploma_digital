
function pegaElementoTable(){
    setTimeout(function(){
        console.log('carregou...')
        tbody = document.querySelector(".listar-documentos")
        // listarDocumentos(1,tbody,interval)
        listarDocumentos(1)
    },1000)
}

//let comparaComThisArrow = param => console.log(this === param)

const listarDocumentos = async (pagina) =>{
    const dados = await fetch("../src/list_abaris.php?pagina=" + pagina)
    const resposta = await dados.text()
    tbody.innerHTML = resposta
}



function pegaElementoTableLyceum(){
    setTimeout(function(){
        console.log('carregou...')
        tbody = document.querySelector(".listar-diplomas-registrados")
        // listarDocumentos(1,tbody,interval)
        listarDiplomasExternos(1)
    },1000)
}

//let comparaComThisArrow = param => console.log(this === param)

const listarDiplomasExternos = async (pagina) =>{
    const dados = await fetch("../src/list_lyceum.php?pagina=" + pagina)
    const resposta = await dados.text()
    tbody.innerHTML = resposta
}



