
//------------------------quando clica no tab serviços atualiza dados da tela de serviços -----
$(".bt-servicos").click(function(){ 
  $(".add-Serv").css({'display':'block'});
  $("#a-bt-servicos").html("");// apaga oque ta escrito botao do tab
  $("#a-bt-servicos").append("Serviços ");// atribui ao tab serviços

  var contId = $(this).attr('id').split('-');
  var idPrest = contId[0];
  var Assinatura = contId[1];

  var dados = {type:"pesquisa",idPrestador:idPrest};
    jQuery.ajax({
      type: "POST",
      url: "manutencaoServico",
      data: dados,
      success: function(data)
      { 
        var conteudo = data.split('-');
        conteudo[0] = conteudo[0].replace("\n","");
        conteudo[0] = conteudo[0].replace("\r","");
         
        if(conteudo[0] == "")
        {
          if(Assinatura == 1) //basic
          {
            $("#a-bt-servicos").append("0/1");// joga a quantidade maxima no tab
          }
          if(Assinatura == 2) //basic
          {
            $("#a-bt-servicos").append("0/3");// joga a quantidade maxima no tab
          }
          if(Assinatura == 3) //basic
          {
            $("#a-bt-servicos").append("0");// joga a quantidade maxima no tab
          }
        
          $(".campo-servicos").html("");
          $(".campo-servicos").html("<p class='sem-servico'>NÃO HÁ SERVIÇOS !!</p>"); 
          $(".add-Ofert").css({'display':'none'});
          $(".add-Serv").css({'display':'block'});
        }
        else
        {
        
          $("#a-bt-servicos").append(conteudo.length / 4);//joga quantidade de serviços cadastrado na tab
          if(Assinatura == 1) //basic
          {
            $("#a-bt-servicos").append("/1");// joga a quantidade maxima no tab
              if(conteudo.length >= 4)
              {
                $(".add-Serv").css({'display':'none'});  
              }
          }
          else
          if(Assinatura == 2) //premium
          {
            $("#a-bt-servicos").append("/3");
            if(conteudo.length >= 12)
            {
              $(".add-Serv").css({'display':'none'});
            }
          }

          $(".add-Ofert").css({'display':'block'});
          $(".campo-servicos").html("");

          for(var i=0;i<conteudo.length;)
          {
            
            var classeVisivel = "";
            var ativaBotoes ="";
            if(conteudo[i+2]==0)
            {
              classeVisivel= "visivel0";
            }
            else
            {
              ativaBotoes ="<a href='/procureaqui/exibir/servico/" + conteudo[i]+ "' class='btn btn-primary bt-verServico  ixii' role='button'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a>"+
              "<a href='#' onclick='editarServico(this.id)' id="+ conteudo[i]+" class='btn btn-success bt-editarServico' role='button'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span></a>";
            }

            var htmlPagina ="<div class='col-md-2 col-sm-6 col-xs-12'>"+
              "<div class='thumbnail thumbnail-AdmServico "+  classeVisivel+" '>"+
                "<div class='caption'>"+
                    "<h5 id='caption-box'>"+conteudo[i+1]+"</h5>"+
                    "<p class='acoesBt'>"+
                    ativaBotoes +
                    "<a href='#' onclick='excluirServico(this.id)' id="+ conteudo[i]+" class='btn btn-danger bt-deletarServico' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>"+
                    "</p>"+
                    "<div class='badge-servico'>Visualizações <span class='badge '>"+conteudo[i+3]+"</span></div>"+
                  "</div>"+
                "</div>"+
              "</div>";
            $(".campo-servicos").append(htmlPagina);      
            i = i+4;
          }
        }
      }
  });
  
});

//---------------- quando salvar cadastro----------------------
$('.cadservico-form').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) { 
    //quando os campos for **invalido** pelo bootstrap
    console.log("invalido");
  } else {
    //quando os campos for **valido** pelo bootstrap
    var formu = $(".cadservico-form");
    var FPrestador = formu.find("input.cadservico-prestador");
    var Ftype = formu.find("input.cadservico-type");
    var Fcategoria = formu.find(".cadservico-categoria").find("option:selected").val();
    var Ftitulo = formu.find(".cadservico-titulo");
    var Fdescricao = formu.find(".cadservico-descricao");
    var Fimagem = formu.find(".cadservico-imagem");

    var form_data = new FormData();
    form_data.append('type',Ftype.val());
    form_data.append('idPrestador',FPrestador.val());
    form_data.append('categoria',Fcategoria);
    form_data.append('titulo',Ftitulo.val());
    form_data.append('descricao',Fdescricao.val());
    form_data.append('imagem',Fimagem.prop('files')[0]);

    $.ajax({
      url: 'manutencaoServico', // caminho para o script que vai processar os dados
      type: 'POST',
      data: form_data,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response) {
        $(".bt-servicos").trigger("click");//clica no botao ofertas para atualizar tela
        $('#modal-cadastro-servico').modal('hide');//fecha tela de cadastro
      },
      error: function(xhr, status, error) {
          alert(xhr.responseText);
      }
    });
        
        //formu[0].reset();
  }
  e.preventDefault();// não deixa atualizar a pagina
  });
//-----------------------------------------------------------------------------


//-------------- função mostra imagem selecionada----------------------
function readURLcadservicos(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.image-upload-wrap-cadservico').hide();
      $('.file-upload-image-cadservico').attr('src', e.target.result);
      $('.file-upload-content-cadservico').show();
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    removeUpload();
  }
};
function removeUploadcadservicos() {
  $(".cadservico-form").validator('destroy');
  $(".cadservico-form").validator('update');
  $('.file-upload-input-cadservico').replaceWith($('.file-upload-input-cadservico').clone());
  $('.file-upload-input-cadservico').replaceWith($('.file-upload-input-cadservico').clone());
  $('.file-upload-content-cadservico').hide();
  $('.image-upload-wrap-cadservico').show();
};
$('.image-upload-wrap-cadservico').bind('dragover', function () {
    $('.image-upload-wrap-cadservico').addClass('image-dropping');
  });
  $('.image-upload-wrap-cadservico').bind('dragleave', function () {
    $('.image-upload-wrap-cadservico').removeClass('image-dropping');
});
//--------------------------------------------------------------------------


//------------ volta o modal ao normal ao fechar ----------------------------
$('#modal-cadastro-servico').on('hidden.bs.modal', function (e) {
  $('#modal-cadastro-servico').find('.cadservico-categoria').val('');
  $('#modal-cadastro-servico').find('.cadservico-categoria').selectpicker('render');
  $('#modal-cadastro-servico').find('.cadservico-categoria').selectpicker('refresh');
  $('#modal-cadastro-servico').find('.cadservico-titulo').val('');
  $('#modal-cadastro-servico').find('.cadservico-descricao').val('');
  $('#modal-cadastro-servico').find(".submit-cadservico").attr('id',"");
  $('#modal-cadastro-servico').find('.file-upload-image-cadservico').attr('src',"");
  $('#modal-cadastro-servico').find('.file-upload-image-cadservico-antiga').attr('src',"");
  $(".cadservico-form")[0].reset();
  $(".cadservico-form").validator('destroy');
  $(".cadservico-form").validator('update');
  removeUploadcadservicos();

})
//-----------------------------------------------------------------






//**************************** EDITAR ****************************************

//-----------------quando clicar no botao editar serviço------------------------------------------------
function editarServico(Id){
$(".EditServico-form").validator('destroy');
$(".EditServico-form").validator('update');

var dados = {type:"pesquisaId",id:Id};
  jQuery.ajax({
    type: "POST",
    url: "manutencaoServico",
    data: dados,
    success: function(data)
    { 
      var dados = data.split('-');
      var titulo = dados[0];
      var descricao = dados[1];
      var categoria = dados[2];
      var imagem = dados[3];
      $('#modal-editar-servico').find('.editservico-categoria').val(categoria);
      $('#modal-editar-servico').find('.editservico-categoria').selectpicker('render');
      $('#modal-editar-servico').find('.editservico-categoria').selectpicker('refresh');
      $('#modal-editar-servico').find('.editservico-titulo').val(titulo);
      $('#modal-editar-servico').find('.editservico-descricao').val(descricao);

      $('.image-upload-wrap-editservico').hide();
      $('.file-upload-image-editservico').attr('src',imagem);
      $('.file-upload-image-editservico-antiga').attr('src',imagem);
      $('.file-upload-content-editservico').show();

      $('#modal-editar-servico').find(".submit-editservico").attr('id',Id);
      $('#modal-editar-servico').modal('show');//abre o modal
      $('#modal-editar-servico').find('.editservico-categoria').focus();
    }
  });
};



$('.editservico-form').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) { 
    //quando os campos for **invalido** pelo bootstrap
    console.log("invalido");
  } else 
  {
    var formu = $(".editservico-form");
    var idServico = formu.find(".submit-editservico").attr('id');
    var FPrestador = formu.find("input.editservico-prestador");
    var Ftype = formu.find("input.editservico-type");
    var Fcategoria = formu.find(".editservico-categoria").find("option:selected").val();
    var Ftitulo = formu.find("input.editservico-titulo");
    var Fdescricao = formu.find(".editservico-descricao");
    var Fimagem = formu.find('.file-upload-input-editservico');
    var caminhoIMG = formu.find(".file-upload-image-editservico-antiga").attr('src');

    var form_data = new FormData();
    form_data.append('idServico',idServico);
    form_data.append('type',Ftype.val());
    form_data.append('idPrestador',FPrestador.val());
    form_data.append('categoria',Fcategoria);
    form_data.append('titulo',Ftitulo.val());
    form_data.append('descricao',Fdescricao.val());
    form_data.append('imagemAntiga',caminhoIMG);

    if(Fimagem.prop('files')[0]) 
      form_data.append('imagem',Fimagem.prop('files')[0]);
  
    $.ajax({
      url: 'manutencaoServico', // caminho para o script que vai processar os dados
      type: 'POST',
      data: form_data,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response) 
      {
        //console.log(response);
        $('#modal-editar-servico').modal('hide');//fecha tela de cadastro
        $(".bt-servicos").trigger("click");//clica no botao ofertas para atualizar tela
      },
      error: function(xhr, status, error)
      {
        alert(xhr.responseText);
      }
    });
    //formu[0].reset();
  }
  e.preventDefault();// não deixa atualizar a pagina
});
//--------------------------------------------------------



//------------ volta o modal ao normal ao fechar ----------------------------
$('#modal-editar-servico').on('hidden.bs.modal', function (e) {
  $('#modal-editar-servico').find('.editservico-categoria').val('');
  $('#modal-editar-servico').find('.editservico-categoria').selectpicker('render');
  $('#modal-editar-servico').find('.editservico-categoria').selectpicker('refresh');
  $('#modal-editar-servico').find('.editservico-titulo').val('');
  $('#modal-editar-servico').find('.editservico-descricao').val('');
  $('#modal-editar-servico').find(".submit-editservico").attr('id',"");
  $('#modal-editar-servico').find('.file-upload-image-servico').attr('src',"");
  $('#modal-editar-servico').find('.file-upload-image-servico-antiga').attr('src',"");
  removeUploadeditservicos();
  $(".editservico-form")[0].reset();
  $(".editservico-form").validator('destroy');
  $(".editservico-form").validator('update');
});
//-----------------------------------------------------------------

//------------ quando clicar no botao excluir serviço--------------
function excluirServico(Id){
  swal({
      title: "Excluir Serviço?",
      text: "Esta operação irá excluir ofertas que estão ligada a este serviço",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Sim, excluir serviço!",
      closeOnConfirm: false
    },
    function()
    {     
        var dados = {type:"deletar",id:Id}; 
      jQuery.ajax({
        type: "POST",
        url: "manutencaoServico",
        data: dados,
        success: function(data)
        { 
          //console.log(data);
          $(".bt-servicos").trigger("click");
          swal(
              'Atenção!',
              'Serviço deletado!!',
              'success'
            )
        }
      });
    }
    );
};


//-------------- função mostra imagem selecionada----------------------
function readURLeditservicos(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.image-upload-wrap-editservico').hide();
      $('.file-upload-image-editservico').attr('src', e.target.result);
      $('.file-upload-content-editservico').show();
      //$('.image-title-servico').html(input.files[0].name);

    };
    reader.readAsDataURL(input.files[0]);
    
  } else {
    removeUpload();
  }
};
function removeUploadeditservicos() {
 $(".editservico-form").validator('destroy');
  $(".editservico-form").validator('update');
  $('.file-upload-input-editservico').replaceWith($('.file-upload-input-editservico').clone());
  $('.file-upload-input-editservico').replaceWith($('.file-upload-input-editservico').clone());
  $('.file-upload-content-editservico').hide();
  $('.image-upload-wrap-editservico').show();
};
$('.image-upload-wrap-editservico').bind('dragover', function () {
    $('.image-upload-wrap-editservico').addClass('image-dropping');
  });
  $('.image-upload-wrap-editservico').bind('dragleave', function () {
    $('.image-upload-wrap-editservico').removeClass('image-dropping');
});
//--------------------------------------------------------------------------