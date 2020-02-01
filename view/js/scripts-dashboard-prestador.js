$('.form-atualizaPrest').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) { 
    //quando os campos for **invalido** pelo bootstrap
    console.log("invalido");
  } else 
  {
  e.preventDefault();// não deixa atualizar a pagina
    var formu = $(".form-atualizaPrest");
    var Fopcao = formu.find("input.opcao");
    var FPrestador = formu.find("input.idPrestador");
    var FnomeFantasia = formu.find(".cadastro-nomeFantasia");
    var Frazao = formu.find(".cadastro-razao");
    var Fcnpj = formu.find(".cadastro-cnpj");
    var caminhoIMG = formu.find(".file-upload-image-prestador-antiga").attr('src');
    var Fimagem = formu.find(".file-upload-input-prestador");
    var Fnome = formu.find("#nome");
    var Fcpf = formu.find("#cpf");
    var Fendereco = formu.find("#endereco");
    var Fcep = formu.find("#cep");
    var Festado = formu.find("#cbEstado").find("option:selected").val();
    var Fcidade = formu.find("#cbCidade");
    var Ftelefone = formu.find("#telefone");
    var Fnumero = formu.find("#numero");
    var FPessoa = formu.find(".idPessoa");
   // console.log(Fopcao.val()+"\n"+FPrestador.val()+"\n"+ Fcnpj.val()+"\n"+FnomeFantasia.val()+"\n"+ Frazao.val()+"\n"+caminhoIMG);

    var form_data = new FormData();
    form_data.append('opcao',Fopcao.val());
    form_data.append('idPrestador',FPrestador.val());
    form_data.append('cnpj',Fcnpj.val());
    form_data.append('nomeFantasia',FnomeFantasia.val());
    form_data.append('razao',Frazao.val());
    form_data.append('imagemAntiga',caminhoIMG);

    form_data.append('nome',Fnome.val());
    form_data.append('cpf',Fcpf.val());
    form_data.append('endereco',Fendereco.val());
    form_data.append('cep',Fcep.val());
    form_data.append('estado',Festado);
    form_data.append('cidade',Fcidade.val());
    form_data.append('telefone',Ftelefone.val());
    form_data.append('numero',Fnumero.val());
     form_data.append('idPessoa',FPessoa.val());

    if(Fimagem.prop('files')[0]) 
    {
      form_data.append('imagem',Fimagem.prop('files')[0]);
    }

     $.ajax({
      url: 'manutencaoPrestador', // caminho para o script que vai processar os dados
      type: 'POST',
      data: form_data,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response) 
      {
        
        if(response == "salvo")
        {
           swal({
            title: "Alterações salva!!",
            timer: 2000,
            showConfirmButton: true
          },function(){
              $('#modal-edit-prestador').modal('hide');//fecha tela de cadastro
              window.location.href = "dashboard";
          });  


          
        }
        
        
      },
      error: function(xhr, status, error)
      {
        alert(xhr.responseText);
      }
    });
    //formu[0].reset();
  

  }

});



$('.form-atualizaUser').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) { 
    //quando os campos for **invalido** pelo bootstrap
    console.log("invalido");
  } else 
  {
  e.preventDefault();// não deixa atualizar a pagina




swal({
      title: "Aguarde...",
      showConfirmButton: false,
        imageUrl: "/procureaqui/view/img/carregando.gif"
    });

    // pega os valores dos campos
    var formu = $(".form-atualizaUser");
    var Remail = formu.find(".register-email");
    var Rsenha = formu.find(".register-senha");
    var RidUser = formu.find(".idUsuario");

    var form_data = new FormData();
    form_data.append('opcao',"editarUser");
    form_data.append('email',Remail.val());
    form_data.append('senha',Rsenha.val());
     form_data.append('usuario',RidUser.val());
    

    $.ajax({
      url: 'manutencaoPrestador', // caminho para o script que vai processar os dados
      type: 'POST',
      data: form_data,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response) 
      {
        
        console.log(response);
        var tempo_espera;
        tempo_espera = setTimeout(function() { 
        swal({
            title: "Usuario atualizado, Faça login novamente !!",
            timer: 2000,
            showConfirmButton: true
          },function(){
              $('#modal-edit-prestador').modal('hide');//fecha tela de cadastro
              window.location.href = "logout";
          });    
        }, 4000);  
      }
      });




}
  
});












$('#modal-edit-prestador').on('hidden.bs.modal', function (e) {
  $(".form-atualizaPrest")[0].reset();
  $(".form-atualizaUser")[0].reset();

  //removeUploadcadoferta();
  
  $(".form-atualizaPrest").validator('destroy');
  $(".form-atualizaPrest").validator('update');

  $(".form-atualizaUser").validator('destroy');
  $(".form-atualizaUser").validator('update');

  $('#modal-edit-prestador').find('.tabs-edit').find('.active').removeClass('active');
  $('#modal-edit-prestador').find('.tabs-content').find('.active').removeClass('active');


  $('#modal-edit-prestador').find('.tabs-edit').find('.first').addClass('active');
  $('#modal-edit-prestador').find('.tabs-content').find('.first').addClass('active');
  
});



$('#bt-modal-pagamento').click(function(){
  $('#modal-edit-prestador').modal('hide');
});

$('.cbPlano').change(function(){
  var progress = 0;
  if($(this).val()==1)
  {
    $('.bt-salvar').css({'display':'block'});
     $('.opPagamento').css({'display':'none'});
     progress = 1;
  }else
  {
     $('.opPagamento').css({'display':'block'});
      progress = 0;
       $('.bt-salvar').css({'display':'none'});
  }
 
});

$('.edit-cbPlano').change(function(){
  var progress = 0;
  if($(this).val()==1)
  {
    $('.bt-salvar-plano').css({'display':'block'});
     $('.opPagamento').css({'display':'none'});
     progress = 1;
  }else
  {
     $('.bt-salvar-plano').css({'display':'none'});
     $('.opPagamento').css({'display':'block'});
      progress = 0;
       $('.bt-salvar').css({'display':'none'});
  }
 
});



$('.bt-salvar').click(function(e){// da tela bemvindo
   
      swal({
      title: "Aguarde...",
      showConfirmButton: false,
        imageUrl: "/procureaqui/view/img/carregando.gif"
    });
      var tempo_espera;
      tempo_espera = setTimeout(function() { 
       swal.close();
              $('#finaliza-cad').submit();
             
        }, 3000); 
    

       e.preventDefault();// não deixa atualizar a pagina
});


$('.bt-salvar-plano').click(function(e){// da tela bemvindo
   e.preventDefault();// não deixa atualizar a pagina
      swal({
      title: "Aguarde...",
      showConfirmButton: false,
        imageUrl: "/procureaqui/view/img/carregando.gif"
    });
      var tempo_espera;
      tempo_espera = setTimeout(function() { 
       swal.close();
              $('#form-pagamento').submit();
             
        }, 3000); 
    

       
});

$('.opPagamento').find("input[name='options']").change(function(){
  var op = $(this).attr('id');
console.log(op);
});


$('.bt-pagar-cartao').click(function(e){
  e.preventDefault();// não deixa atualizar a pagina


  swal({
      title: "Aguarde...",
      showConfirmButton: false,
        imageUrl: "/procureaqui/view/img/carregando.gif"
    });
      var tempo_espera;
      tempo_espera = setTimeout(function() { 
       swal({
            title: "Pagamento Realizado com sucesso !!",
            timer: 2000,
            showConfirmButton: true
          },function(){
              $('#finaliza-cad').submit();
          });    
        }, 4000);  

});

$('.bt-pagar-cartao-2').click(function(e){
  e.preventDefault();// não deixa atualizar a pagina


  swal({
      title: "Aguarde...",
      showConfirmButton: false,
        imageUrl: "/procureaqui/view/img/carregando.gif"
    });
      var tempo_espera;
      tempo_espera = setTimeout(function() { 
       swal({
            title: "Pagamento Realizado com sucesso !!",
            timer: 2000,
            showConfirmButton: true
          },function(){
              $('#form-pagamento').submit();
          });    
        }, 4000);  

});


$('.bt-pagar-boleto').click(function(e){
  e.preventDefault();// não deixa atualizar a pagina

  swal({
      title: "Aguarde...",
      showConfirmButton: false,
        imageUrl: "/procureaqui/view/img/carregando.gif"
    });
      var tempo_espera;
      tempo_espera = setTimeout(function() { 
       swal({
            title: "Pagamento Realizado com sucesso !!",
            timer: 2000,
            showConfirmButton: true
          },function(){
              $('#finaliza-cad').submit();
          });    
        }, 1000);  
});

$('.bt-pagar-boleto-2').click(function(e){
  e.preventDefault();// não deixa atualizar a pagina

  swal({
      title: "Aguarde...",
      showConfirmButton: false,
        imageUrl: "/procureaqui/view/img/carregando.gif"
    });
      var tempo_espera;
      tempo_espera = setTimeout(function() { 
       swal({
            title: "Pagamento Realizado com sucesso !!",
            timer: 2000,
            showConfirmButton: true
          },function(){
              $('#form-pagamento').submit();
          });    
        }, 1000);  
});





$('.btn-group').change(function()
{
  var opcao = $(this).find('.active').children().attr('id');
  if(opcao== 'option1')
  {
    $('.PagamentoCartao').css({'display':'none'});
    $('.PagamentoBoleto').css({'display':'block'});
    $('.Metodo-pagamento').html("PAGAR COM BOLETO");
  }
  else
  {
    if(opcao == 'option2')
    {
      $('.Metodo-pagamento').html("PAGAR COM CARTÃO");
      $('.PagamentoCartao').css({'display':'block'});
      $('.PagamentoBoleto').css({'display':'none'});
    }
  }
});



function readURLPrestador(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap-prestador').hide();
      $('.file-upload-image-prestador').attr('src', e.target.result);
      $('.file-upload-content-prestador').show();
      //$('.image-title-prestador').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUploadPrestador();
  }
}

function removeUploadPrestador() {
  $(".form-atualizaPrest").validator('destroy');
  $(".form-atualizaPrest").validator('update');
  $('.file-upload-input-prestador').replaceWith($('.file-upload-input-prestador').clone());
  $('.file-upload-input-prestador').replaceWith($('.file-upload-input-prestador').clone());
  $('.file-upload-content-prestador').hide();
  $('.image-upload-wrap-prestador').show();
}
$('.image-upload-wrap-prestador').bind('dragover', function () {
    $('.image-upload-wrap-prestador').addClass('image-dropping');
  });
  $('.image-upload-wrap-prestador').bind('dragleave', function () {
    $('.image-upload-wrap-prestador').removeClass('image-dropping');
});



  