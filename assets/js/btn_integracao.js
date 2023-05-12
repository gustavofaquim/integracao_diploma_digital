$(".btn-integracao").click(function(event){
    
    let sistema = $(this).attr('name');
    
   // let dados = JSON.stringify(sistema)
    let x = 'geral-' + sistema
    let dados = {"sistema": x}
    console.log(dados)


    let button = $('#btn-'+sistema)
    let loadingButton = $('#loading-'+sistema);
    
    loadingButton.addClass('loading')  // Adiciona a classe .loading ao botão
    
    $("#msg").hide();
    $("#msg").empty()


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
    dados.sistema = 'lyceum'
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
            loadingButton.hide(); // Esconde o botão de carregamento
            button.show();
            $('#btn'+id).removeClass('removeDisplay');  
        },
        success: function(result){
            console.log(result['retorno_lyceum'])
            $('#btn'+id).attr('onclick', 'chamaModal('+ result['retorno_lyceum'] +');')    
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown)
            $('#btn'+id).attr('onclick', 'chamaModal('+ errorThrown +');')   
        }
    })
    
}

function integracao_individual_abaris(d,btnId){
    
    let id = btnId
    let dados = d
    dados.sistema = 'abaris'

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
            createAlert('','Sucesso!',result,'success',true,true,'pageMessages')       
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown)
            createAlert('','Erro!',errorThrown,'danger',true,true,'pageMessages') 
        }
    })
    
}


function createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId) {
    var iconMap = {
      info: "fa fa-info-circle",
      success: "fa fa-thumbs-up",
      warning: "fa fa-exclamation-triangle",
      danger: "fa ffa fa-exclamation-circle"
    };
  
    var iconAdded = false;
  
    var alertClasses = ["alert", "animated", "flipInX"];
    alertClasses.push("alert-" + severity.toLowerCase());
  
    if (dismissible) {
      alertClasses.push("alert-dismissible");
    }
  
    var msgIcon = $("<i />", {
      "class": iconMap[severity] // you need to quote "class" since it's a reserved keyword
    });
  
    var msg = $("<div />", {
      "class": alertClasses.join(" ") // you need to quote "class" since it's a reserved keyword
    });
  
    if (title) {
      var msgTitle = $("<h4 />", {
        html: title
      }).appendTo(msg);
      
      if(!iconAdded){
        msgTitle.prepend(msgIcon);
        iconAdded = true;
      }
    }
  
    if (summary) {
      var msgSummary = $("<strong />", {
        html: summary
      }).appendTo(msg);
      
      if(!iconAdded){
        msgSummary.prepend(msgIcon);
        iconAdded = true;
      }
    }
  
    if (details) {
      var msgDetails = $("<p />", {
        html: details
      }).appendTo(msg);
      
      if(!iconAdded){
        msgDetails.prepend(msgIcon);
        iconAdded = true;
      }
    }
    
  
    if (dismissible) {
      var msgClose = $("<span />", {
        "class": "close", // you need to quote "class" since it's a reserved keyword
        "data-dismiss": "alert",
        html: "<i class='fa fa-times-circle'></i>"
      }).appendTo(msg);
    }
    
    $('#' + appendToId).prepend(msg);
    
    if(autoDismiss){
      setTimeout(function(){
        msg.addClass("flipOutX");
        setTimeout(function(){
          msg.remove();
        },1000);
      }, 5000);
    }
  }
  