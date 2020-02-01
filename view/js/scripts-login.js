
$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

    $("input").on('focus', function () {
    var pos = $(this).offset();
    $(document).scrollTop(pos.top);
});
 
});


$("#register-submit").click(function(){ 
if(!$(this).hasClass("disabled"))// verifica se tem a classe  
{
    swal({
      title: "Aguarde...",
      showConfirmButton: false,
        imageUrl: "/procureaqui/view/img/carregando.gif"
    });

    // pega os valores dos campos
    var formu = $(".register-form");
    var Rnome = formu.find(".register-nome");
    var Remail = formu.find(".register-email");
    var Rsenha = formu.find(".register-senha");
    var RCsenha = formu.find(".register-confirm");

    
     var dados = {nome:Rnome.val(),email:Remail.val(),senha:Rsenha.val()};
      jQuery.ajax({
        type: "POST",
        url: "cadUsuarios",
        data: dados,
        success: function(data)
        { 
            if (data=="salvo")
            { 
                swal({
                      title: "Salvo com sucesso !!",
                      timer: 2000,
                      showConfirmButton: true
                    });
                $(".login-form").find(".login-email").val(Remail.val()); // pega email cadastrado e joga no campo de login
                Remail.val("");
                Rnome.val("");
                Rsenha.val("");
                RCsenha.val("");
                $('#login-form-link').trigger("click");// volta para tela de login
                $(".login-form").find(".login-email").focus(); // posiciona o mouse no campo email
            }
            else
            if(data == "email-cadastrado")
            {
                swal("Atenção !!", "Este email já está cadastrado no sistema..", "error");
                Remail.focus();
                Remail.val("");//limpa o campo
            }
            else
            {
                swal("erro");
               
            }
        }
     
           
        });
}


         
     });


// usado para o formulario de cadastro nao enviar submit
$(".register-form").submit(function(e) {
         e.preventDefault();//evito o submit do form ao apetar o enter..
      });