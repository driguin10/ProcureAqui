<?php
  include_once("cabecalho-principal.php");
  if($_POST['palavra'] != "")
  {
    $palavra = str_replace("'", "", $_POST['palavra']); 
  }
  else
  $palavra = "";

  if($_POST['categoria'] != "")
  {
    $categoria = str_replace("'", "", $_POST['categoria']);
  }
  else
  $categoria = "";

  if($_POST['estado'] != "")
  {
    $estado = str_replace("'", "", $_POST['estado']);
  }
  else
  $estado = "";

  if($_POST['cidade'] != "")
  {
    $cidade = str_replace("'", "", $_POST['cidade']);
  }
  else
  $cidade = "";

?>
<link rel="stylesheet" type="text/css" href="/procureaqui/view/css/busca.css">
<div class="panel panel-default painel">
  <div class="panel-body painel-pesquisa">
    <form method="post" class="form-pesquisaOfServ">
      <div class="form-group pesquisa container">
        <div class="row">

          <div class="col-md-6 col-md-offset-1 col-sm-6 col-xs-12">
            <label id="lbPesquisa" for="exampleInputEmail1">PALAVRA DA PESQUISA</label>
            <input type="text" name="palavra" class="form-control" id="InputPalavra" placeholder="Pesquisa">
          </div>

          <div class="col-sm-2 col-md-1 col-xs-4 btAvancado">
            <button class="btn btn-default btn-lg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Filtrar
            </button>
          </div>
        

          <div class="col-sm-2 col-md-2 col-xs-8 btPesquisa">
              <button type="submit" class="btn btn-default btn-lg btPesquisar">
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar
              </button>
          </div>

        </div>
      </div>
       
      <div class="collapse" id="collapseExample">
          <div class="well">
            <div class="row filtros-index">
                <div class="col-sm-12 col-md-3 col-md-offset-1 categoria">
                    <label for="exampleInputEmail1">CATEGORIA</label>
                    <select id="cbCategoria" name="categoria" class="selectpicker cbCategoria" data-live-search="true" data-widt="50px" title="ESCOLHA">
                       
                    </select>
                </div>

                    <div class="col-sm-12 col-md-3   SelEstado">
                        <label for="exampleInputEmail1">ESTADO</label>
                        <select id="cbEstado" name="estado" class="selectpicker cbEstado" data-live-search="true" title="ESCOLHA" data-size="3" > 
                            <option value= "" >NENHUM</option> 
                            <option data-divider="true"></option>
                            <option value= "AC" >ACRE</option> 
                            <option value= "AL" >ALAGOAS</option> 
                            <option value= "AP" >AMAPA</option> 
                            <option value= "AM" >AMAZONAS</option>                              
                            <option value= "BA" >BAHIA</option>                               
                            <option value= "CE" >CEARA</option>                               
                            <option value= "DF" >DISTRITO FEDERAL</option>                           
                            <option value= "ES" >ESPIRITO SANTO</option>                           
                            <option value= "RR" >RORAIMA</option>                                
                            <option value= "GO" >GOIAS</option>                                
                            <option value= "MA" >MARANHAO</option>                                
                            <option value= "MT" >MATO GROSSO</option>                                
                            <option value= "MS" >MATO GROSSO DO SUL</option>                
                            <option value= "MG">MINAS GERAIS</option>                               
                            <option value= "PA" >PARA</option>                               
                            <option value= "PB" >PARAIBA</option>                              
                            <option value= "PR" >PARANA</option>                              
                            <option value= "PE" >PERNAMBUCO</option>                               
                            <option value= "PI" >PIAUI</option>                               
                            <option value= "RJ" >RIO DE JANEIRO</option>                            
                            <option value= "RN" >RIO GRANDE DO NORTE</option>                        
                            <option value= "RS" >RIO GRANDE DO SUL</option>                          
                            <option value= "RO" >RONDONIA</option>                               
                            <option value= "TO" >TOCANTINS</option>                                
                            <option value= "SC" >SANTA CATARINA</option>                             
                            <option value= "SP" >SAO PAULO</option>                               
                            <option value= "SE" >SERGIPE</option>                          
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-3  SelCidade">
                        <label for="exampleInputEmail1">CIDADE</label>
                        <select id="cbCidade" name="cidade" class="selectpicker cbCidade"  data-live-search="true" data-size="3" title="ESCOLHA">           
                        </select>
                    </div>
                </div>
            </div>
        </div>


    </form>
  </div> 
</div>

<section>



  <!-- Nav tabs -->
  <ul class="nav nav-tabs centered" role="tablist">
    <li role="presentation" class="active"><a href="#servico" class="bt-carregaServ" aria-controls="servico" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> SERVIÇOS</a></li>
    <li role="presentation"><a href="#oferta" aria-controls="oferta" class="bt-carregaOf" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span> OFERTAS</a></li>
  </ul>





<!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="servico">
      <div class="container">
        <div class="row">
          <div class="BuscaServ">
                    
          </div>
        </div>
      </div>

        <div class="row bt-mais">
          <div class="col-md-6 col-md-offset-3">
            <button class="btn btn-primary" id="bt-carregaMais-serv">Carregar Mais Serviços</button>
          </div>
        </div>
    </div>

<div role="tabpanel" class="tab-pane" id="oferta">

  <div class="container">
        <div class="row">
          <div class="BuscaOfert">
                    
          </div>
        </div>
      </div>
      
   <div class="row bt-mais">
          <div class="col-md-6 col-md-offset-3">
            <button class="btn btn-primary" id="bt-carregaMais-ofert">Carregar Mais Ofertas</button>
          </div>
        </div>




</div>



</div>












</section>


  	<script src="/procureaqui/view/frameworks/bootstrap/js/jquery.min.js"></script>
    <script src="/procureaqui/view/frameworks/bootstrap/js/bootstrap.min.js"></script>
    <script src="/procureaqui/view/frameworks/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="/procureaqui/view/frameworks/sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="/procureaqui/view/js/scripts.js"></script>
    

    

		<script type="text/javascript">
		    $(document).ready(function () {
		        $('#InputPalavra').val(<?php  echo '"'.$palavra.'"'; ?>);
		        $('.painel-pesquisa').find('.cbEstado').val(<?php  echo '"'.$estado.'"'; ?>);
		        $('.painel-pesquisa').find('.cbEstado').selectpicker('render');
		        $('.painel-pesquisa').find('.cbEstado').selectpicker('refresh');
		        $('.painel-pesquisa').find('.cbEstado').change();
		        var tempo_espera;
		        tempo_espera = setTimeout(function() { 
		            $('.painel-pesquisa').find('.cbCategoria').val(<?php  echo '"'.$categoria.'"'; ?>);
		            $('.painel-pesquisa').find('.cbCategoria').selectpicker('render');
		            $('.painel-pesquisa').find('.cbCategoria').selectpicker('refresh');
		            $('.painel-pesquisa').find('.cbCidade').val(<?php  echo '"'.$cidade.'"'; ?>);
		            $('.painel-pesquisa').find('.cbCidade').selectpicker('render');
		            $('.painel-pesquisa').find('.cbCidade').selectpicker('refresh');     
		        }, 500);
		    });
		</script>
    <script src="/procureaqui/view/js/scriptBusca.js"></script>
<?php    
include_once("rodape-principal.php");
?>