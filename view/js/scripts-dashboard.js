$(document).ready(function () {

  $(".bt-servicos").trigger("click");
  $(".bt-ofertas").trigger("click");
  $(".bt-favoritos").trigger("click");

  $.post('categorias', {type:"listar"}, function(response){   
    $('#cadservico-categoria').text(""); // limpa o campo
    $('#cadservico-categoria').append(response); // preenche
    $('.cadservico-categoria').selectpicker('render'); // atualiza o campo
    $('.cadservico-categoria').selectpicker('refresh'); // atualiza o campo
    $('#editservico-categoria').text(""); // limpa o campo
    $('#editservico-categoria').append(response); // preenche
    $('.editservico-categoria').selectpicker('render'); // atualiza o campo
    $('.editservico-categoria').selectpicker('refresh'); // atualiza o campo

    $('#cadoferta-categoria').text(""); // limpa o campo
    $('#cadoferta-categoria').append(response); // preenche
    $('.cadoferta-categoria').selectpicker('render'); // atualiza o campo
    $('.cadoferta-categoria').selectpicker('refresh'); // atualiza o campo
    $('#editoferta-categoria').text(""); // limpa o campo
    $('#editoferta-categoria').append(response); // preenche
    $('.editoferta-categoria').selectpicker('render'); // atualiza o campo
    $('.editoferta-categoria').selectpicker('refresh'); // atualiza o campo
  });
});


$(".cbEstado").change(function(){  
   $.post('municipios', {opcao:"CompletaCad",uf:$("#cbEstado").val()}, function(response){  
      $('#cbCidade').text(""); // limpa o campo
      $('#cbCidade').append(response); // preenche
      $('.cbCidade').selectpicker('refresh'); // atualiza o campo
    });
});


$(".bt-encerraConta").click(function(){
	var idExcluir = $(this).attr('id');
 	swal({
	  title: "Encerrar Conta!!",
	  text: "Deseja realmente encerrar esta conta?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Sim, encerrar conta!",
	  closeOnConfirm: false
	},
	function()
	{			
    var dados = {id:idExcluir};
    jQuery.ajax({
      type: "POST",
      url: "excluirConta",
      data: dados,
      success: function(data)
      { 
      	window.location.href = "logout";
      }
    });
	}
	);
 });


$('.bt-planoBasico').click(function(){
  $('.pricing-basico').removeClass('pricing-active');
  $('.pricing-premium').removeClass('pricing-active');
  $('.pricing-enterprise').removeClass('pricing-active');
  $('.pricing-basico').addClass('pricing-active');


  $('.pricingH-basico').removeClass('pricing-head-active');
  $('.pricingH-premium').removeClass('pricing-head-active');
  $('.pricingH-enterprise').removeClass('pricing-head-active');
  $('.pricingH-basico').addClass('pricing-head-active');
  $('.cbPlano').val(1);
});

$('.bt-planoPremium').click(function(){
  $('.pricing-basico').removeClass('pricing-active');
  $('.pricing-premium').removeClass('pricing-active');
  $('.pricing-enterprise').removeClass('pricing-active');
  $('.pricing-premium').addClass('pricing-active');

  $('.pricingH-basico').removeClass('pricing-head-active');
  $('.pricingH-premium').removeClass('pricing-head-active');
  $('.pricingH-enterprise').removeClass('pricing-head-active');
  $('.pricingH-premium').addClass('pricing-head-active');
  $('.cbPlano').val(2);
});

$('.bt-planoEnterprise').click(function(){
  $('.pricing-basico').removeClass('pricing-active');
  $('.pricing-premium').removeClass('pricing-active');
  $('.pricing-enterprise').removeClass('pricing-active');
  $('.pricing-enterprise').addClass('pricing-active');

  $('.pricingH-basico').removeClass('pricing-head-active');
  $('.pricingH-premium').removeClass('pricing-head-active');
  $('.pricingH-enterprise').removeClass('pricing-head-active');
  $('.pricingH-enterprise').addClass('pricing-head-active');
  $('.cbPlano').val(3);
});










          








