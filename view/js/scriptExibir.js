$(".form-avalia").submit(function(e) {
         e.preventDefault();
      });




$('.bt-avaliacao').click(function(){
	var dados = $('.form-avalia').serialize();
	var info = dados.split('&');
	var id= info[0].split('=');
	var valor = info[1].split('=');

	var dados = {ID: id[1], QT:valor[1]};
	  jQuery.ajax({
	    type: "POST",
	    url: "/procureaqui/avalia",
	    data: dados,
	    success: function(data)
	    { 
	    	if(data == "add")
	    	{
				swal({
	              title: "Obrigado por avaliar este Prestador !!",
	              timer: 2000,
	              type: "success",
	              showConfirmButton: true
	            });
	    	}
	    }
	 });

});

