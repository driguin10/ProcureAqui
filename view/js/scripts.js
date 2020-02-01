


$(document).ready(function () {
    
   
  
    $.post('categorias', {type:"listar"}, function(response){  
        
        $('#cbCategoria').text(""); // limpa o campo
        $('#cbCategoria').append("<option value=''>NENHUM</option>");
        $('#cbCategoria').append("<option data-divider='true'></option>");
        $('#cbCategoria').append(response); // preenche
        $('.cbCategoria').selectpicker('refresh'); // atualiza o campo
        
    });


    $('.carousel').carousel({
      interval: 6000
    })
    
    var velocidadeT = 1000;

    $('.ofertas').click(function () {

        $('html, body').animate({
            scrollTop: ($("#ofertas").offset().top - 75) + 'px'
        }, velocidadeT);
        return false;
    });


    $('.topPrestadores').click(function () {
        $('html, body').animate({
            scrollTop: ($("#topPrestadores").offset().top - 75) + 'px'
        }, velocidadeT);
        return false;
    });

    $('.irTopo').click(function () {
        $('html, body').animate({
            scrollTop: '0px'
        }, velocidadeT);
        return false;
    });
    
    var cpPesquisa = -75;
    
    $('#InputPalavra').click(function () {
        $('html, body').animate({
            scrollTop: ($(".pesquisa").offset().top + cpPesquisa) + 'px'
        }, velocidadeT);
        return false;
    });
    
    
    
    $('.cbCategoria').on('show.bs.select', function (e) {
        $('html, body').animate({
                scrollTop: ($(".pesquisa").offset().top + cpPesquisa) + 'px'
            }, velocidadeT);
            return false;
    });
    
    
     $('.cbEstado').on('show.bs.select', function (e) {
        $('html, body').animate({
                scrollTop: ($(".pesquisa").offset().top + cpPesquisa) + 'px'
            }, velocidadeT);
            return false;
     });
    
    $('.cbCidade').on('show.bs.select', function (e) {
        $('html, body').animate({
                scrollTop: ($(".pesquisa").offset().top + cpPesquisa) + 'px'
            }, velocidadeT);
            return false;
     });

    $('.retorno').css("top", ($(window).height() - 100) + "px");
    
    //campos de pesquisa----------------------------------
    $('.cbEstado').selectpicker('deselectAll');

     $(".cbEstado").change(function(){  
         $.post('municipios', {opcao:"listaCidades", uf:$("#cbEstado").val()}, function(response){  
                $('#cbCidade').text(""); // limpa o campo
                $('#cbCidade').append("<option value=''>NENHUM</option>");
                $('#cbCidade').append("<option data-divider='true'></option>");
                $('#cbCidade').append(response); // preenche
                $('.cbCidade').selectpicker('refresh'); // atualiza o campo
            });
         
     });

    /* $('.cbEstado').on('changed.bs.select', function (e) {
  $.post('municipios', {opcao:"listaCidades", uf:$("#cbEstado").val()}, function(response){  
                $('#cbCidade').text(""); // limpa o campo
                $('#cbCidade').append(response); // preenche
                $('.cbCidade').selectpicker('render');
                $('.cbCidade').selectpicker('refresh'); // atualiza o campo
            });
});*/
    //----------------------------------------------------------------------------


        

   }); 
// responsavel por adicionar aos favoritos
function addFav(id){
    

    var ids = id.split('-');
    console.log(id);

    if(ids[0]=="oferta"){
       var dados = {opcao:"cadastro",idPessoa:ids[1],idServOferta:ids[2],tipo:"oferta"};
          jQuery.ajax({
            type: "POST",
            url: "manutencaoFavorito",
            data: dados,
            success: function(data)
            { 
                var retorno = data.split('-');
                 if(retorno[0] == "salvo")
                 {
                     //$('[data-toggle="popover-logado-'+ids[2]+'"]').popover('show');
                     $('[data-toggle="popover-logado-'+ids[2]+'"]').find('span').addClass('star-fav');

                 }
                 else
                  if(retorno[0] == "possui")
                  {

                   var dados = {opcao:"excluir",id:retorno[1]};
                    jQuery.ajax({
                        type: "POST",
                        url: "manutencaoFavorito",
                        data: dados,
                        success: function(data)
                        { 
                                if(data == "deletado")
                                {
                                  $('[data-toggle="popover-logado-'+ids[2]+'"]').find('span').removeClass('star-fav');  
                                }
                        }
                      });
                  }    
            }
          });
        
    }
    else
          if(ids[0]=="servico"){
            
            var dados = {opcao:"cadastro",idPessoa:ids[1],idServOferta:ids[2],tipo:"servico"};
          jQuery.ajax({
            type: "POST",
            url: "manutencaoFavorito",
            data: dados,
            success: function(data)
            { 
                var retorno = data.split('-');
                 if(retorno[0] == "salvo")
                 {
                     //$('[data-toggle="popover-logado-'+ids[2]+'"]').popover('show');
                     $('[data-toggle="popover-logado-'+ids[2]+'"]').find('span').addClass('star-fav');

                 }
                 else
                  if(retorno[0] == "possui")
                  {

                   var dados = {opcao:"excluir",id:retorno[1]};
                    jQuery.ajax({
                        type: "POST",
                        url: "manutencaoFavorito",
                        data: dados,
                        success: function(data)
                        { 
                                if(data == "deletado")
                                {
                                  $('[data-toggle="popover-logado-'+ids[2]+'"]').find('span').removeClass('star-fav');  
                                }
                        }
                      });
                  }    
            }
          });
        
    }

}

$('.addFav').click(function(){
   

    var ids = this.id.split('-');

    if(ids[0]=="oferta"){
       var dados = {opcao:"cadastro",idPessoa:ids[1],idServOferta:ids[2],tipo:"oferta"};
          jQuery.ajax({
            type: "POST",
            url: "manutencaoFavorito",
            data: dados,
            success: function(data)
            { 
                var retorno = data.split('-');
                 if(retorno[0] == "salvo")
                 {
                     //$('[data-toggle="popover-logado-'+ids[2]+'"]').popover('show');
                     $('[data-toggle="popover-logado-'+ids[2]+'"]').find('span').addClass('star-fav');

                 }
                 else
                    if(retorno[0] == "possui")
                    {

                         var dados = {opcao:"excluir",id:retorno[1]};
                          jQuery.ajax({
                                type: "POST",
                                url: "manutencaoFavorito",
                                data: dados,
                                success: function(data)
                                { 
                                        if(data == "deletado")
                                        {
                                          $('[data-toggle="popover-logado-'+ids[2]+'"]').find('span').removeClass('star-fav');  
                                        }
                                }
                            });
                    }

                 
            }
          });
        
    }
 

});
   

$(window).resize(function () {
    $('.retorno').css("top", ($(window).height() - 100) + "px");
});
/*
$(function () {

    $('.nav a').on('click', function () {

        if(!$(this).find('.dropdown-toggle'))
            {
                
                if ($('.navbar-toggle').css('display') != 'none') {
                    $(".navbar-toggle").trigger("click");
                }
            }
    });
});
*/
$(function () {
  $('[data-toggle="popover"]').popover();

});

/*
//----------------------- testes ------------------------

        $("#test-circle2").circliful({
            animation: 0,
            animationStep: 6,
            foregroundBorderWidth: 5,
            backgroundColor: "none",
            fillColor: '#eee',
            percent: 50,
            iconColor: '#3498DB',
            icon: 'f206',
            iconSize: '40',
            iconPosition: 'middle'
        });

        $("#test-circle3").circliful({
            animation: 1,
            animationStep: 6,
            foregroundBorderWidth: 5,
            backgroundBorderWidth: 1,
            percent: 88,
            iconColor: '#3498DB',
            icon: 'f004',
            iconSize: '40',
            iconPosition: 'middle'
        });

        $("#test-circle4").circliful({
            animation: 1,
            animationStep: 1,
            target: 10,
            start: 2,
            showPercent: 1,
            backgroundColor: '#000',
            foregroundColor: '#A8C64A',
            fontColor: '#000',
            iconColor: '#000',
            icon: 'f0a0',
            iconSize: '40',
            iconPosition: 'middle',
            multiPercentage: 1,
            text: 'No Kids'
        });

        $("#test-circle5").circliful({
            animationStep: 5,
            foregroundBorderWidth: 5,
            backgroundBorderWidth: 15,
            percent: 80,            
            icon: 'f0a0',
            iconPosition: 'middle',
            text: 'Space Left',            
            textBelow: true
        });
    
       
});



function updateData(){
  
    var numer = Math.floor(Math.random() * 100) + 1 
    //console.log(numer);
    teste(numer);
    setTimeout(updateData,5000);
  
}
//updateData();



function teste(perc){
    var num = parseInt(perc);
     $("#test-circle").empty();
     $("#test-circle").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
            percent: num,
            textSize: 28,
            textStyle: 'font-size: 12px;',
            textColor: '#666',
            multiPercentage: 1,
            percentages: [10, 20, 30]
        });
}
*/



/*
var posicaoInicial = $('#na').position().top;
$(document).scroll(function () { // oscultador de scroll
    var posicaoScroll = $(document).scrollTop(); // obtem a quantidade de scroll no momento
    
     if (posicaoInicial < posicaoScroll) 
    {
        $("#na").css({'background-color': 'rgba(255,255,255,0.95)'});
        $(".navegador .nav>li>.menu").css({'color': '#000'});
    }
    else
        {
        $("#na").css({'background-color': 'rgba(8,8,8,0.25)'});
            $(".navegador .nav>li>.menu").css({'color': '#fff'});
        }
})*/







// definir numero maximo de exibições

$('.Fav').click(function(){
   var id = this.id;
    $(".drop-fav").html("");
    var dados = {opcao:"listar",idPessoa:id};
          jQuery.ajax({
            type: "POST",
            url: "/procureaqui/manutencaoFavorito",
            data: dados,
            success: function(dados)
            { 
                var favs = dados.split('*');
                if(favs[0] != "")
                {
                    for(var i=0; favs.length>i && i<5 ;i++)
                    {
                        if(favs[i] != "")
                        {
                            var favs2 = favs[i].split('-');
                            favs2[0] = favs2[0].replace("\t","");       
                            var op = "";
                            if(favs2[0] == "servico")
                            {
                                op = "wrench";
                            }
                            else
                            if(favs2[0] == "oferta")
                            {
                                op = "fire";
                            }

                          $(".drop-fav").append("<li><a href='/procureaqui/exibir/"+favs2[0]+"/"+favs2[1]+"'><span class='glyphicon glyphicon-"+op+"' aria-hidden='true'></span>     "+favs2[2]+"</a></li>");
                        }
                    }
                    $(".drop-fav").append("<li role='separator' class='divider'></li>");
                    $(".drop-fav").append("<li><a href='favoritos'><span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> ver todos favoritos</a></li>");
                }      
                else
                {
                    $(".drop-fav").append("<li>Não há favoritos aqui !!</li>");
                }          
            }
          });
});




           

                      





