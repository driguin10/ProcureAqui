$(".bt-favoritos").click(function(){  
  
  var idCompleto = $(this).attr('id');
  var contId = idCompleto.split('-');

  var idpessoa = contId[0];
  
  var dados = {opcao:"listar",idPessoa:idpessoa};
    jQuery.ajax({
      type: "POST",
      url: "manutencaoFavorito",
      data: dados,
      success: function(data)
      { 
        var conteudo = data.split('*');
        conteudo[0] = conteudo[0].replace("\n","");
        conteudo[0] = conteudo[0].replace("\r","");
         
        if(conteudo[0] == "")
        {
          $(".campo-favoritos").html("");
          $(".campo-favoritos").html("<p class='sem-favoritos'>NÃO HÁ FAVORITOS !!</p>");
          //$(".campo-favoritos").html("");
          $("#a-bt-favoritos").html("Favoritos ");
          $("#a-bt-favoritos").append(0); 
        }
        else
        {
          $(".campo-favoritos").html("");
          for(var i=0;i<conteudo.length; i++)
            {
              if(conteudo[i]!="")
              {
                
                $("#a-bt-favoritos").html("Favoritos ");
                $("#a-bt-favoritos").append(conteudo.length-1);

                var favs = conteudo[i].split('-');
                var htmlPagina ="<div class='col-md-2 col-sm-6 col-xs-12'>"+
                  "<div class='thumbnail thumbnail-AdmFavoritos'>"+
                      "<div class='caption'>"+
                          "<h5 id='caption-box'>"+favs[2]+"</h5>"+
                          "<p class='acoesBt'>"+
                          "<a href='/procureaqui/exibir/"+favs[0] +"/" + favs[1]+ "' class='btn btn-primary bt-verOferta' role='button'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a>"+
                          "<a href='#' onclick='excluirFavorito(this.id)' id="+ favs[3]+" class='btn btn-danger bt-deletarOferta' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>"+
                          "</p>"+
                      "</div>"+
                  "</div>"+
              "</div>";
              $(".campo-favoritos").append(htmlPagina);     
            }
          }
        }
      }
  }); 
});

function excluirFavorito(Id){
 swal({
      title: "Excluir Favorito?",
      text: "Esta operação irá excluir este favorito",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Sim, excluir favorito!",
      closeOnConfirm: false
      }, function()
        {     
          var dados = {opcao:"excluir",id:Id}; 
          jQuery.ajax({
            type: "POST",
            url: "manutencaoFavorito",
            data: dados,
            success: function(data)
            { 
              //console.log(data);
              $(".bt-favoritos").trigger("click");
              swal(
                  'Atenção!',
                  'Favorito deletada!!',
                  'success'
                )
            }
          });
        });
};




