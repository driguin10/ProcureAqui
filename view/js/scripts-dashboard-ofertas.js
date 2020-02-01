
// atualiza tela com ofertas cadastradas
$(".bt-ofertas").click(function(){  
  $(".add-Ofert").css({'display':'block'});
  $("#a-bt-ofertas").html("");// apaga oque ta escrito botao do tab
  $("#a-bt-ofertas").append("Ofertas ");// atribui ao tab ofertas

  var contId = $(this).attr('id').split('-');
  var idPrest = contId[0];
  var Assinatura = contId[1];

  var status = $(this).hasClass('disabled');
  $.post('manutencaoServico', {type:"pesquisaServico",idPrestador:$(".bt-servicos").attr("id")}, function(response){  
          $('#cadoferta-servico').text(""); // limpa o campo
          $('#cadoferta-servico').append(response); // preenche
          $('.cadoferta-servico').selectpicker('refresh'); // atualiza o campo  
          $('.cadoferta-servico').selectpicker('render');
        });
  
    var dados = {type:"pesquisa",idPrestador:$(this).attr('id')};
          jQuery.ajax({
            type: "POST",
            url: "manutencaoOferta",
            data: dados,
            success: function(data)
            { 
              var conteudo = data.split('-');
              conteudo[0] = conteudo[0].replace("\n","");
              conteudo[0] = conteudo[0].replace("\r","");

              
              
              if(conteudo[0].trim() == "")
              {

                if(Assinatura == 2) //basic
                {
                  $("#a-bt-ofertas").append("0/3");// joga a quantidade maxima no tab
                }
                if(Assinatura == 3) //basic
                {
                  $("#a-bt-ofertas").append("0");// joga a quantidade maxima no tab
                }

                $(".add-Ofert").css({'display':'block'});
                $(".campo-ofertas").html("");
                $(".campo-ofertas").html("<p class='sem-oferta'>NÃO HÁ OFERTAS !!</p>");  
              }
              else
              {
                $("#a-bt-ofertas").append(conteudo.length / 5);//joga quantidade de ofertas cadastrado na tab
                if(Assinatura == 2) //premium
                {
                  $("#a-bt-ofertas").append("/3");
                  if(conteudo.length >= 15)
                  {
                    $(".add-Ofert").css({'display':'none'});
                  }
                }

                $(".campo-ofertas").html("");
                for(var i=0;i<conteudo.length;)
                    {

                      var Vencido = "";
                      var info="";
                      if(conteudo[i+3] == 1)
                      {
                        Vencido = "vencido1";

                        var dados = {type:"visivel",idOferta:conteudo[i],visivel:0};
                        jQuery.ajax({
                          type: "POST",
                          url: "manutencaoOferta",
                          data: dados,
                          success: function(data)
                          {
                            if(data == "salvo")
                            console.log("invisivel");
                            
                          }
                        }); 
                        // por o visivel desta oferta como 0 
                        info = "<label>Oferta vencida !!</label>"
                      }


                      var htmlPagina ="<div class='col-md-2 col-sm-6 col-xs-12'>"+
                      "<div class='thumbnail thumbnail-AdmOfertas "+Vencido+"'>"+
                          "<div class='caption'>"+
                              "<h5 id='caption-box'>"+conteudo[i+1]+"</h5>"+
                              "<p class='acoesBt'>"+
                              "<a href='/procureaqui/exibir/oferta/" + conteudo[i]+ "' class='btn btn-primary bt-verOferta' role='button'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a>"+
                              "<a href='#' onclick='editarOferta(this.id)' id="+ conteudo[i]+" class='btn btn-success bt-editaroferta' role='button'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span></a>"+
                              "<a href='#' onclick='excluirOferta(this.id)' id="+ conteudo[i]+" class='btn btn-danger bt-deletarOferta' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>"+
                              info +
                              "</p>"+
                              "<div class='badge-servico'>Visualizações <span class='badge '>"+conteudo[i+4]+"</span></div>"+
                          "</div>"+
                      "</div>"+
                  "</div>";
                  $(".campo-ofertas").append(htmlPagina);     
                i = i+5;
                }
              }
            }
        });  
});



function excluirOferta(Id){
 swal({
          title: "Excluir Oferta?",
          text: "Esta operação irá excluir esta oferta",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sim, excluir oferta!",
          closeOnConfirm: false
        },
        function()
        {     
            var dados = {type:"deletar",id:Id}; 
          jQuery.ajax({
            type: "POST",
            url: "manutencaoOferta",
            data: dados,
            success: function(data)
            { 
              
               $(".bt-ofertas").trigger("click");

              swal(
                  'Atenção!',
                  'Oferta deletada!!',
                  'success'
                )
             
            }
          });

        });
};

//******************************* CADASTRAR OFERTAS *************************************


$('.cadoferta-form').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) { 
    //quando os campos for **invalido** pelo bootstrap
    
  } else  {
      var formu = $(".cadoferta-form");
      var Ftype = formu.find(".cadoferta-type");
      var FServico = formu.find(".cadoferta-servico").find("option:selected").val();
      var Ftitulo = formu.find(".cadoferta-titulo");
      var Fdescricao = formu.find(".cadoferta-descricao");
      var FdataTermino = formu.find(".cadoferta-data-termino");
      var Fimagem = formu.find(".file-upload-input-cadoferta");

      var form_data = new FormData();
      form_data.append('type',Ftype.val());
      form_data.append('servico',FServico);
      form_data.append('titulo',Ftitulo.val());
      form_data.append('descricao',Fdescricao.val());
      form_data.append('dataTermino',FdataTermino.val());

      if(Fimagem.prop('files')[0]) 
        form_data.append('imagem',Fimagem.prop('files')[0]);
      
      $.ajax({
        url: 'manutencaoOferta', // caminho para o script que vai processar os dados
        type: 'POST',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
          $(".bt-ofertas").trigger("click");//clica no botao ofertas para atualizar tela
          $('#modal-cadoferta').modal('hide');//fecha tela de cadastro
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
      });
         
          //formu[0].reset();
    }
    e.preventDefault();// não deixa atualizar a pagina
});



$('#modal-cadoferta').on('hidden.bs.modal', function (e) {
  $(".cadoferta-form")[0].reset();
  $('#modal-cadoferta').find('.cadoferta-servico').val("");
  $('#modal-cadoferta').find('.cadoferta-servico').selectpicker('render');
  $('#modal-cadoferta').find('.cadoferta-servico').selectpicker('refresh');
  
  //$('#modal-cadoferta').find('.cadoferta-categoria').val("");
 // $('#modal-cadoferta').find('.cadoferta-categoria').selectpicker('render');
  //$('#modal-cadoferta').find('.cadoferta-categoria').selectpicker('refresh');

  $('#modal-cadoferta').find('.cadoferta-titulo').val('');
  $('#modal-cadoferta').find('.cadoferta-descricao').val('');
  $('#modal-cadoferta').find('.cadoferta-data-termino').val('');
  $('#modal-cadoferta').find(".submit-cadoferta").attr('id',"");
  $('#modal-cadoferta').find('.file-upload-image-cadoferta').attr('src',"");
  $('#modal-cadoferta').find('.file-upload-image-cadoferta-antiga').attr('src',"");
  removeUploadcadoferta();
  
  $(".cadoferta-form").validator('destroy');
  $(".cadoferta-form").validator('update');
});



function readURLcadoferta(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.image-upload-wrap-cadoferta').hide();
      $('.file-upload-image-cadoferta').attr('src', e.target.result);
      $('.file-upload-content-cadoferta').show();
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    removeUploadcadofertas();
  }
}

function removeUploadcadoferta() {
  $(".cadoferta-form").validator('destroy');
  $(".cadoferta-form").validator('update');
  $('.file-upload-input-cadoferta').replaceWith($('.file-upload-input-cadoferta').clone());
  $('.file-upload-input-cadoferta').replaceWith($('.file-upload-input-cadoferta').clone());
  $('.file-upload-content-cadoferta').hide();
  $('.image-upload-wrap-cadoferta').show();
}
$('.image-upload-wrap-cadoferta').bind('dragover', function () {
    $('.image-upload-wrap-cadoferta').addClass('image-dropping');
  });
  $('.image-upload-wrap-cadoferta').bind('dragleave', function () {
    $('.image-upload-wrap-cadoferta').removeClass('image-dropping');
});


//************************* EDITAR OFERTAS **************************************************

$('.editoferta-form').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) { 
    //quando os campos for **invalido** pelo bootstrap
    
  } else  {
      var formu = $(".editoferta-form");
      var Ftype = formu.find(".editoferta-type");
      var Foferta = formu.find(".submit-editoferta").attr('id');
      var FServico = formu.find(".editoferta-servico-label").attr('id');
      var Ftitulo = formu.find(".editoferta-titulo");
      var Fdescricao = formu.find(".editoferta-descricao");
      var FdataTermino = formu.find(".editoferta-data-termino");
      var Fimagem = formu.find(".file-upload-input-editoferta");
      var caminhoIMG = formu.find(".file-upload-image-editoferta-antiga").attr('src');

      var form_data = new FormData();
      form_data.append('type',Ftype.val());
      form_data.append('oferta',Foferta);
      form_data.append('servico',FServico);
      form_data.append('titulo',Ftitulo.val());
      form_data.append('descricao',Fdescricao.val());
      form_data.append('dataTermino',FdataTermino.val());
      form_data.append('imagemAntiga',caminhoIMG);

      if(Fimagem.prop('files')[0]) 
        form_data.append('imagem',Fimagem.prop('files')[0]);
      
      $.ajax({
        url: 'manutencaoOferta', // caminho para o script que vai processar os dados
        type: 'POST',
        data: form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
          $('#modal-editofertas').modal('hide');//fecha tela de cadastro
          $(".bt-ofertas").trigger("click");//clica no botao ofertas para atualizar tela
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
      });
         
          //formu[0].reset();
    }
    e.preventDefault();// não deixa atualizar a pagina
});


function editarOferta(Id){
  $(".editoferta-form").validator('destroy');
  $(".editoferta-form").validator('update');

  var dados = {type:"pesquisaId",id:Id};
    jQuery.ajax({
      type: "POST",
      url: "manutencaoOferta",
      data: dados,
      success: function(data)
      { 
        //console.log(data);
        var dados = data.split('*');
       


        var idServico = dados[0].trim();
        var servico = dados[1];
        var categoria = dados[2];
        var titulo = dados[3];
        var descricao = dados[4];
        var dataTermino = dados[5];
        var imagem = dados[6];
        
        $('#modal-editofertas').find('.editoferta-titulo').val(titulo);
        $('#modal-editofertas').find('.editoferta-descricao').val(descricao);
        $('#modal-editofertas').find('.editoferta-data-termino').val(dataTermino);
       
        $('.image-upload-wrap-editoferta').hide();
        $('.file-upload-image-editoferta').attr('src',imagem);
        $('.file-upload-image-editoferta-antiga').attr('src',imagem);
        $('.file-upload-content-editoferta').show();

        $('#modal-editofertas').find('.editoferta-servico').selectpicker('hide');
        $('#modal-editofertas').find('.editoferta-servico-label').css({'display':'block'});
        $('#modal-editofertas').find('.editoferta-servico-label').val("Serviço vinculado = " + servico);
       
        $('#modal-editofertas').modal('show');//abre o modal
        
        
        //$('#modal-editofertas').find('.editoferta-categoria').focus();
        $('#modal-editofertas').find(".submit-editoferta").attr('id',Id);
        $('#modal-editofertas').find(".editoferta-servico-label").attr('id',idServico);
       // $('#modal-editofertas').find('.editoferta-categoria').val(categoria);
        //$('#modal-editofertas').find('.editoferta-categoria').selectpicker('render');
        //$('#modal-editofertas').find('.editoferta-categoria').selectpicker('refresh');
      }
    });
};

$('#modal-editofertas').on('hidden.bs.modal', function (e) {
 // $('#modal-editofertas').find('.editoferta-categoria').val("");
 // $('#modal-editofertas').find('.editoferta-categoria').selectpicker('refresh');
 // $('#modal-editofertas').find('.editoferta-categoria').selectpicker('render');
  $('#modal-editofertas').find('.editoferta-titulo').val('');
  $('#modal-editofertas').find('.editoferta-descricao').val('');
  $('#modal-editofertas').find('.editoferta-data-termino').val('');
  $('#modal-editofertas').find(".submit-editoferta").attr('id',"");
  $('#modal-editofertas').find('.file-upload-image-editoferta').attr('src',"");
  $('#modal-editofertas').find('.file-upload-image-editoferta-antiga').attr('src',"");
  removeUploadeditoferta();
  $(".editoferta-form")[0].reset();
  $(".editoferta-form").validator('destroy');
  $(".editoferta-form").validator('update');
});



  function readURLeditoferta(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.image-upload-wrap-editoferta').hide();
      $('.file-upload-image-editoferta').attr('src', e.target.result);
      $('.file-upload-content-editoferta').show();
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    removeUploadcadofertas();
  }
}

function removeUploadeditoferta() {
  $(".editoferta-form").validator('destroy');
  $(".editoferta-form").validator('update');
  $('.file-upload-input-editoferta').replaceWith($('.file-upload-input-editoferta').clone());
  $('.file-upload-input-editoferta').replaceWith($('.file-upload-input-editoferta').clone());
  $('.file-upload-content-editoferta').hide();
  $('.image-upload-wrap-editoferta').show();
}
$('.image-upload-wrap-editoferta').bind('dragover', function () {
    $('.image-upload-wrap-editoferta').addClass('image-dropping');
  });
  $('.image-upload-wrap-editoferta').bind('dragleave', function () {
    $('.image-upload-wrap-editoferta').removeClass('image-dropping');
});









