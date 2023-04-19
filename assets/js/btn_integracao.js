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