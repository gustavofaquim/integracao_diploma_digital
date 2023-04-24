$(".btn-integracao").click(function(event){
    
    let sistema = $(this).attr('name');
    let dados = JSON.stringify(sistema)

    let button = $('#btn-'+sistema)
    let loadingButton = $('#loading-'+sistema);
    
    loadingButton.addClass('loading')  // Adiciona a classe .loading ao botão
    
    $("#msg").hide();
    $("#msg").empty()


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

                $("#msg").toggleClass('div-success')
                $("#msg").append("<strong>Sucesso!</strong> " + result)
                $("#msg").fadeTo(2000, 500).slideUp(500, function(){
                    $("#msg").slideUp(500);
                })             
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(errorThrown)

                $("#msg").toggleClass('div-success')
                $("#msg").append("<strong>Error!</strong> " +  errorThrown)
                $("#msg").fadeTo(2000, 500).slideUp(500, function(){
                    $("#msg").slideUp(500);
                }); 
            }
        }) 
        
        $("#test").click(function showAlert() {
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
            });   
        });

    event.preventDefault()
});  



function integracao_individual_lyceum(d,btnId){
    
    let id = btnId
    let dados = d
    let sistema = 'abaris'


    let button = $('#btn-abaris-' + id)

    let loadingButton = $('#loading-'+sistema+'-'+id)
    
    loadingButton.addClass('loading') 

    $.ajax({
        url: '../src/dispara_integracao.php',
        type: 'POST',
        dataType: "json",
        data: {data: dados},
        beforeSend: function(){
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
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown)
        }
    })
    
}

