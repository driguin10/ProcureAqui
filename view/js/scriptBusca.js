var Usuario;
$(function(){
	verStar($('.bt-AreaAdm').attr('id'));
	Usuario= $('#navbarCabecalho').find('.Fav').attr('id');
	var tempo_espera;
	tempo_espera = setTimeout(function() 
	{ 
	  $('.bt-carregaServ').trigger('click');
	}, 500);
 
});


$('.form-pesquisaOfServ').on('submit', function (e) {
	e.preventDefault();// não deixa atualizar a pagina
	ContadorObjetosServico = 0;
	$('.BuscaServ').html("");
	ContadorObjetosOferta = 0;
	$('.BuscaOfert').html("");
	$('.bt-carregaServ').trigger('click');
});



var Bpalavra ="";
var Bcategoria = "";
var Bestado = "";
var Bcidade = "";
var ContadorObjetosServico = 0;
var MaximoObjetosServico = 8;
var ContadorObjetosOferta = 0;
var MaximoObjetosOferta = 8;
var SFim = ContadorObjetosServico + MaximoObjetosServico;
var OFim = ContadorObjetosOferta + MaximoObjetosOferta;

function AtualizaCampos()
{
 	 formu = $(".form-pesquisaOfServ");
   Bpalavra = formu.find("#InputPalavra").val();
   Bcategoria = formu.find("#cbCategoria").val();
   Bestado = formu.find("#cbEstado").find("option:selected").val();
   Bcidade = formu.find("#cbCidade").val();
}

var conteudoFavoritos ="";
function verStar(Usuario){
	var dados = {opcao:"listar",idPessoa:Usuario};
		jQuery.ajax({
      type: "POST",
      url: "manutencaoFavorito",
      data: dados,
      success: function(data)
      {
          conteudoFavoritos = data.split('*'); 
      }
		});
	
}




$('.bt-carregaServ').click(function(){

	if(ContadorObjetosServico == 0)
	{
		AtualizaCampos();
	  var dados = {type:"servico", PosInicio:0, PosFim:MaximoObjetosServico, palavra:Bpalavra, estado:Bestado, cidade:Bcidade, categoria:Bcategoria};
	  $.post('buscaCarregaMais',dados, function(data){

	  	if(data.dados != "nada")
			{
				//var i=0;
				//while(i<data.dados.length)
				for (var i = 0;  i < data.dados.length; i++ ) 
				{
					var idServico = data.dados[i].idServico;
					var favOn = "";
					var thumbnail = 
		    		"<div class=	'col-xd-12 col-sm-6 col-md-3'>" + 
		      		"<div class='thumbnail'>" +
		        		"<img class='img-corte'  src='"+data.dados[i].imagem+"' >" +
		        		"<div class='caption'>" +
		          		"<h4 id='caption-box'><b>"+ data.dados[i].titulo +"</b></h4>" +
		        		"</div>"+
			        	"<div class='row thumbnail-botoes-busca'>"+
				          "<div class='col-md-7 col-sm-7 col-xs-7 bts'>"+
				            "<p ><a href='/procureaqui/exibir/servico/"+ idServico+"' class='btn btn-primary bt-verOferta' role='button'>Ver Serviço</a></p>"+
				          "</div>"+
				          "<div class='col-md-3 col-sm-3 col-xs-3 bts'>"+
				          	"<button onclick='addFav(this.id)' class='addFav btn btn-default active bt-addfavorito'  role='button' ";
				          	if(Usuario)
				          	{
				          		thumbnail+= "id='servico-"+Usuario+"-"+idServico+"' "+
				          		 "data-toggle='popover-logado-"+idServico+"' data-container='body' data-placement='bottom'  data-trigger='focus' data-content='salvo!!'> ";
				          
											for(var y = 0; y<conteudoFavoritos.length-1; y++)
											{
												var conteudo2 = conteudoFavoritos[y].split('-');
												if(idServico == conteudo2[1])
												{
													favOn = " star-fav";
												}
											}
				          	}
                    else
                    {
                      thumbnail+= "data-toggle='popover' data-container='body' data-placement='bottom'  data-trigger='focus' title='Atenção' data-content='É necessario estar logado para adicionar aos favoritos!!'>";
                    }
                    thumbnail+= "<span class='glyphicon glyphicon-star"+favOn+" ' aria-hidden='true'></span></button>";
				          "</div>"+
			          "</div>"+
		        	"</div>"+
		    		"</div>";
		    		
 
  				$('[data-toggle="popover"]').popover();
					$(thumbnail).appendTo(".BuscaServ").hide().fadeToggle("slow");
					
				}
			}
			else
			{
				$('#bt-carregaMais-serv').html("Não há mais serviços!");
			}
			},"json");
	  ContadorObjetosServico = MaximoObjetosServico;
	}
});






$('#bt-carregaMais-serv').click(function(){
		carregaMaisServ();
});


function carregaMaisServ()
{
	//var Usuario= $('#navbarCabecalho').find('.Fav').attr('id');

	var favOn = "";
		var dados = {type:"servico", PosInicio:ContadorObjetosServico, PosFim:SFim, palavra:Bpalavra, estado:Bestado, cidade:Bcidade, categoria:Bcategoria};
		$.post('buscaCarregaMais',dados, function(data){
		if(data.dados != "nada")
		{
				//var i=0;
				//while(i<data.dados.length)
				for (var i = 0;  i < data.dados.length; i++ ) 
				{
					var idServico = data.dados[i].idServico;
					var favOn = "";
					var thumbnail = 
		    		"<div class=	'col-xd-12 col-sm-6 col-md-3'>" + 
		      		"<div class='thumbnail'>" +
		        		"<img class='img-corte'  src='"+data.dados[i].imagem+"' >" +
		        		"<div class='caption'>" +
		          		"<h4 id='caption-box'><b>"+ data.dados[i].titulo +"</b></h4>" +
		        		"</div>"+
			        	"<div class='row thumbnail-botoes-busca'>"+
				          "<div class='col-md-7 col-sm-7 col-xs-7 bts'>"+
				            "<p ><a href='/procureaqui/exibir/servico/"+ idServico+"' class='btn btn-primary bt-verOferta' role='button'>Ver Serviço</a></p>"+
				          "</div>"+
				          "<div class='col-md-3 col-sm-3 col-xs-3 bts'>"+
				          	"<button onclick='addFav(this.id)' class='addFav btn btn-default active bt-addfavorito'  role='button' ";
				          	if(Usuario)
				          	{
				          		thumbnail+= "id='servico-"+Usuario+"-"+idServico+"' "+
				          		 "data-toggle='popover-logado-"+idServico+"' data-container='body' data-placement='bottom'  data-trigger='focus' data-content='salvo!!'> ";
				          
											for(var y = 0; y<conteudoFavoritos.length-1; y++)
											{
												var conteudo2 = conteudoFavoritos[y].split('-');
												if(idServico == conteudo2[1])
												{
													favOn = " star-fav";
												}
											}
				          	}
                    else
                    {
                      thumbnail+= "data-toggle='popover' data-container='body' data-placement='bottom'  data-trigger='focus' title='Atenção' data-content='É necessario estar logado para adicionar aos favoritos!!'>";
                    }
                    thumbnail+= "<span class='glyphicon glyphicon-star"+favOn+" ' aria-hidden='true'></span></button>";
				          "</div>"+
			          "</div>"+
		        	"</div>"+
		    		"</div>";
		    		
 
  				$('[data-toggle="popover"]').popover();
					$(thumbnail).appendTo(".BuscaServ").hide().fadeToggle("slow");
					//i++;
					ContadorObjetosServico++;
				}
		}
		else
			{
				$('#bt-carregaMais-serv').html("Não há mais serviços!");
			}

		},"json");
}





$('.bt-carregaOf').click(function(){
	if(ContadorObjetosOferta == 0)
	{
		AtualizaCampos();
  var dados = {type:"oferta", PosInicio:0, PosFim:MaximoObjetosOferta, palavra:Bpalavra, estado:Bestado, cidade:Bcidade, categoria:Bcategoria};
  $.post('buscaCarregaMais',dados, function(data){
			if(data.dados != "nada")
			{

					for (var i = 0;  i < data.dados.length; i++ ) 
				{
					var idOferta = data.dados[i].idOferta;
					var favOn = "";
					var thumbnail = 
		    		"<div class=	'col-xd-12 col-sm-6 col-md-3'>" + 
		      		"<div class='thumbnail'>" +
		        		"<img class='img-corte'  src='"+data.dados[i].imagem+"' >" +
		        		"<div class='caption'>" +
		          		"<h4 id='caption-box'><b>"+ data.dados[i].titulo +"</b></h4>" +
		        		"</div>"+
			        	"<div class='row thumbnail-botoes-busca'>"+
				          "<div class='col-md-7 col-sm-7 col-xs-7 bts'>"+
				            "<p ><a href='/procureaqui/exibir/oferta/"+ idOferta+"' class='btn btn-primary bt-verOferta' role='button'>Ver Oferta</a></p>"+
				          "</div>"+
				          "<div class='col-md-3 col-sm-3 col-xs-3 bts'>"+
				          	"<button onclick='addFav(this.id)' class='addFav btn btn-default active bt-addfavorito'  role='button' ";
				          	if(Usuario)
				          	{
				          		thumbnail+= "id='oferta-"+Usuario+"-"+idOferta+"' "+
				          		 "data-toggle='popover-logado-"+idOferta+"' data-container='body' data-placement='bottom'  data-trigger='focus' data-content='salvo!!'> ";
				          
											for(var y = 0; y<conteudoFavoritos.length-1; y++)
											{
												var conteudo2 = conteudoFavoritos[y].split('-');
												if(idOferta == conteudo2[1])
												{
													favOn = " star-fav";
												}
											}
				          	}
                    else
                    {
                      thumbnail+= "data-toggle='popover' data-container='body' data-placement='bottom'  data-trigger='focus' title='Atenção' data-content='É necessario estar logado para adicionar aos favoritos!!'>";
                    }
                    thumbnail+= "<span class='glyphicon glyphicon-star"+favOn+" ' aria-hidden='true'></span></button>";
				          "</div>"+
			          "</div>"+
		        	"</div>"+
		    		"</div>";
		    		
 
  				$('[data-toggle="popover"]').popover();
					$(thumbnail).appendTo(".BuscaOfert").hide().fadeToggle("slow");
					//i++;
				}
			}
			else
			{
				$('#bt-carregaMais-ofert').html("Não há mais ofertas!");
			}


		},"json");
  ContadorObjetosOferta = MaximoObjetosOferta;
}
});



	
$('#bt-carregaMais-ofert').click(function(){
		carregaMaisOfert();
	});

function carregaMaisOfert()
{
		var dados = {type:"oferta", PosInicio:ContadorObjetosOferta, PosFim:OFim, palavra:Bpalavra, estado:Bestado, cidade:Bcidade, categoria:Bcategoria};
		$.post('buscaCarregaMais',dados, function(data){
		if(data.dados != "nada")
		{
					for (var i = 0;  i < data.dados.length; i++ ) 
				{
					var idOferta = data.dados[i].idOferta;
					var favOn = "";
					var thumbnail = 
		    		"<div class=	'col-xd-12 col-sm-6 col-md-3'>" + 
		      		"<div class='thumbnail'>" +
		        		"<img class='img-corte'  src='"+data.dados[i].imagem+"' >" +
		        		"<div class='caption'>" +
		          		"<h4 id='caption-box'><b>"+ data.dados[i].titulo +"</b></h4>" +
		        		"</div>"+
			        	"<div class='row thumbnail-botoes-busca'>"+
				          "<div class='col-md-7 col-sm-7 col-xs-7 bts'>"+
				            "<p ><a href='/procureaqui/exibir/oferta/"+ idOferta+"' class='btn btn-primary bt-verOferta' role='button'>Ver Serviço</a></p>"+
				          "</div>"+
				          "<div class='col-md-3 col-sm-3 col-xs-3 bts'>"+
				          	"<button onclick='addFav(this.id)' class='addFav btn btn-default active bt-addfavorito'  role='button' ";
				          	if(Usuario)
				          	{
				          		thumbnail+= "id='oferta-"+Usuario+"-"+idOferta+"' "+
				          		 "data-toggle='popover-logado-"+idOferta+"' data-container='body' data-placement='bottom'  data-trigger='focus' data-content='salvo!!'> ";
				          
											for(var y = 0; y<conteudoFavoritos.length-1; y++)
											{
												var conteudo2 = conteudoFavoritos[y].split('-');
												if(idOferta == conteudo2[1])
												{
													favOn = " star-fav";
												}
											}
				          	}
                    else
                    {
                      thumbnail+= "data-toggle='popover' data-container='body' data-placement='bottom'  data-trigger='focus' title='Atenção' data-content='É necessario estar logado para adicionar aos favoritos!!'>";
                    }
                    thumbnail+= "<span class='glyphicon glyphicon-star"+favOn+" ' aria-hidden='true'></span></button>";
				          "</div>"+
			          "</div>"+
		        	"</div>"+
		    		"</div>";
		    		
 
  				$('[data-toggle="popover"]').popover();
					$(thumbnail).appendTo(".BuscaOfert").hide().fadeToggle("slow");
					//i++;
					ContadorObjetosOferta++;
				}
					
				
		}
		else
			{
				$('#bt-carregaMais-ofert').html("Não há mais ofertas!");
			}

		},"json");
}
	

              




             