$("#btn-integracao-individual").click(function(event){
    
    alert('teste 02')
    
    let sistema = $(this).attr('name');
    let cpf = $(this).attr('id');

    alert(cpf)

    let dados = JSON.stringify(sistema)

    $.ajax({
        url: '../src/dispadra_indtegracao.php',
        //url: '../view/home.php',
        type: 'POST',
        dataType: "json",
        data: {data: dados},
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
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown)
        }
    }) 

    event.preventDefault()

})