<?php
  include_once("cabecalho-principal.php");

//query buca serviços-------------------------
  $queryServico = "SELECT s.idServico as idservico, ".
  "ass.idConta as tipoConta, ".
  "pe.pAcesso as pAcesso, ".
  "s.categoria as categoria, ".
  "s.titulo as titulo, ".
  "s.dataPublicacao as dataPub, ".
  "pe.cidade as cidade, ".
  "pe.estado as estado, ".
  "s.imagem as imagem, ".
  "prest.idPrestador as idPrestador ".
  "FROM servico as s ". 
  "INNER JOIN prestador as prest ON prest.idPrestador = s.idPrestador ".
  "INNER JOIN pessoa as pe ON pe.idPessoa = prest.idPessoa ".
  "INNER JOIN assinatura as ass ON ass.idPessoa = pe.idPessoa WHERE s.visivel = 1";
  //--------------------------------------------------------------------------------

  //query busca ofertas-----------------------------------  
  $queryOferta = "SELECT of.idOferta as idOferta,".
  "s.idServico as idServico, ".
  "ass.idConta as tipoConta, ".
  "s.categoria as categoria, ".
  "of.titulo as titulo, ".
  "of.descricao as descricao, ".
  "of.dataPublicacao as dataPublicacao, ".
  "of.dataTermino as dataTermino, ".
  "pe.cidade as cidade, ".
  "pe.estado as estado, ".
  "of.imagem as imagem, ".
  "prest.idPrestador as idPrestador ".
  "FROM oferta as of ".
  "INNER JOIN servico as s ON s.idServico = of.idServico ".
  "INNER JOIN prestador as prest ON prest.idPrestador = s.idPrestador ".
  "INNER JOIN pessoa as pe ON pe.idPessoa = prest.idPessoa ".
  "INNER JOIN assinatura as ass ON ass.idPessoa = pe.idPessoa WHERE of.visivel = 1";
  //----------------------------------------------------------------------------------


	$queryFiltroS = "";
  $queryFiltroO = "";

	if($_POST['palavra'] != "")
	{
	  $palavra = $_POST['palavra'];
	  $queryFiltroS = " AND s.titulo LIKE '%".$palavra."%'";
    $queryFiltroO = " AND of.titulo LIKE '%".$palavra."%'";
	}
	else
	$palavra = "";

	if($_POST['categoria'] != "")
	{
	  $categoria = $_POST['categoria'];
	  $queryFiltroS.=" AND s.categoria = '".$categoria."'";
    $queryFiltroO.=" AND s.categoria = '".$categoria."'";
	}
	else
	$categoria = "";

	if($_POST['estado'] != "")
	{
	  $estado = $_POST['estado'];
	  $queryFiltroS.=" AND pe.estado = '".$estado."'";
    $queryFiltroO.=" AND pe.estado = '".$estado."'";
	}
	else
	$estado = "";

	if($_POST['cidade'] != "")
	{
	  $cidade = $_POST['cidade'];
	  $queryFiltroS.=" AND pe.cidade = '".$cidade."'";
    $queryFiltroO.=" AND pe.cidade = '".$cidade."'";
	}
	else
	$cidade = "";

	if($queryFiltroS!="")
	{
	  $queryFiltroS.=" ORDER BY ass.idConta DESC";
	  $queryServico.= $queryFiltroS;
    $queryOferta.= $queryFiltroO;
	}
	else
	{
	  $query= "Preencha pelo menos um filtro";
	}
  //---------------------------------------------------




?>
<link rel="stylesheet" type="text/css" href="/procureaqui/view/css/busca.css">
<div class="panel panel-default painel">
  <div class="panel-body painel-pesquisa">
    <form method="post" action="busca">
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
          <div class="row">
            <div class="col-sm-12 col-md-2 categoria">
              <label for="exampleInputEmail1">CATEGORIA</label>
              <select id="cbCategoria" name="categoria" class="selectpicker cbCategoria cC" data-live-search="true" title="ESCOLHA" >
              </select>
            </div>

            <div class="col-sm-12 col-md-2 SelEstado">
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

            <div class="col-sm-12 col-md-2 SelCidade">
                <label for="exampleInputEmail1">CIDADE</label>
                <select id="cbCidade" name="cidade" class="selectpicker cbCidade"  data-live-search="true" data-size="3" title="ESCOLHA" >           
                </select>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div> 
</div>

<section>


<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs centered" role="tablist">
    <li role="presentation" class="active"><a href="#servico" aria-controls="servico" role="tab" data-toggle="tab">SERVIÇOS</a></li>
    <li role="presentation"><a href="#oferta" aria-controls="oferta" role="tab" data-toggle="tab">OFERTAS</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="servico">
      <?php 
  include_once("../controller/controller.busca.php");
  $obj_busca = new BuscaController();
  $obj_busca->setSQL($queryServico);
  $obj_retornoBusca = $obj_busca->busca();
  if($obj_retornoBusca)
  {
    foreach ($obj_retornoBusca as $dados) {  
  ?>
  <div class="container">
    <div class="col-xd-12 col-sm-6 col-md-3 ">
      <div class="thumbnail">
        <?php  echo "<img class='img-corte'  src='$dados->imagem' \>"; ?>
        <div class="caption">
          <h4 id="caption-box"><b><?php echo $dados->titulo; ?></b></h4>
        </div>

        <div class="row thumbnail-botoes">
          <div class="col-md-7 col-sm-7 col-xs-7 bts">
            <p ><a href="/procureaqui/exibir/servico/<?php echo $dados->idservico; ?>" class="btn btn-primary bt-verOferta" role="button">Ver Serviç</a></p>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3 bts">
            <button  class="addFav btn btn-default active bt-addfavorito"  role="button"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>
              </div>
            </div>
          </div>
        
      </div>
    </div>
  <?php
       }
      }
  ?> 
    </div>

    <div role="tabpanel" class="tab-pane" id="oferta">
      <div class="row">
            <?php 
  include_once("../controller/controller.busca.php");
  $obj_busca = new BuscaController();
  $obj_busca->setSQL($queryOferta);
  $obj_retornoBuscaOf = $obj_busca->busca();
  if($obj_retornoBuscaOf)
  {
    foreach ($obj_retornoBuscaOf as $dadosOf) {  
  ?>
  <div class="tt">
    <div class="col-md-3 ">
      <div class="thumbnail">
        <?php  echo "<img class='img-corte'  src='$dadosOf->imagem' \>"; ?>
        <div class="caption">
          <h4 id="caption-box"><b><?php echo $dadosOf->titulo; ?></b></h4>
        </div>

        <div class="row thumbnail-botoes">
          <div class="col-md-7 col-sm-7 col-xs-7 bts">
            <p ><a href="/procureaqui/exibir/servico/<?php echo $dadosOf->idOferta; ?>" class="btn btn-primary bt-verOferta" role="button">Ver Oferta</a></p>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3 bts">
            <button  class="addFav btn btn-default active bt-addfavorito"  role="button"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>
              </div>
            </div>
          </div>
      </div>
    </div>
  <?php
       }
      }
  ?> 
</div>
    </div>
   
  </div>



</div>


  
</section>


<section>


  <!-- Nav tabs -->
<ul class="nav nav-tabs centered" role="tablist">
  <li role="presentation" class="active"><a href="#servico" aria-controls="servico" role="tab" data-toggle="tab">SERVIÇOS</a></li>
  <li role="presentation"><a href="#oferta" aria-controls="oferta" role="tab" data-toggle="tab">OFERTAS</a></li>
</ul>



  <!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane fade in active" id="servico">
    <div class="container">
      <div class="row">
           <?php 
            include_once("../controller/controller.busca.php");
            $obj_busca = new BuscaController();
            $obj_busca->setSQL($queryServico);
            $obj_retornoBusca = $obj_busca->busca();
            if($obj_retornoBusca)
            {
              foreach ($obj_retornoBusca as $dados) {  
            ?>

          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
               <?php  echo "<img class='img-corte'  src='$dados->imagem' \>"; ?>
              <div class="caption">
                <h4 id="caption-box"><b><?php echo $dados->titulo; ?></b></h4>
              </div>
            </div>
          </div>

          <?php
               }
              }
          ?> 
      </div>
    </div>
  </div>

  <div role="tabpanel" class="tab-pane fade" id="oferta">
    <div class="container">
      <div class="row">
           <?php 
            include_once("../controller/controller.busca.php");
            $obj_busca = new BuscaController();
            $obj_busca->setSQL($queryOferta);
            $obj_retornoBusca = $obj_busca->busca();
            if($obj_retornoBusca)
            {
              foreach ($obj_retornoBusca as $dados) {  
            ?>

          <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
               <?php  echo "<img class='img-corte'  src='$dados->imagem' \>"; ?>
              <div class="caption">
                <h4 id="caption-box"><b><?php echo $dados->titulo; ?></b></h4>
              </div>
            </div>
          </div>

          <?php
               }
              }
          ?> 
      </div>
    </div>
  </div>

      
        <div class="row bt-mais">
          <div class="col-md-6 col-md-offset-3">
            <button class="btn btn-primary" id="bt-carregaMais" onclick="carrega()">Carregar Mais</button>
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
<?php    
include_once("rodape-principal.php");
?>