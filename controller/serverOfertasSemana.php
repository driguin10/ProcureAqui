<?php
include_once("../model/dao.php");
include_once("../controller/controller.ofertaSemana.php");
include_once("../controller/config.php");
$config = new config();
$idOferta = "";

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
if($retornoBusca)
{
	foreach ($retornoBusca as $dados1) {
		$idOferta = $dados1->idOferta;
	}
}



if(sizeof($retornoBusca)< $config->getQtRegistros())
{

     $obj_ofertaSemana->setIdOferta(0);
     $obj_ofertaSemana->setQtRegistros($config->getQtRegistros()-sizeof($retornoBusca));

      $retornoBuscaContinuacao =  $obj_ofertaSemana->buscaOferta();
      if ($retornoBuscaContinuacao) {
  
          foreach ($retornoBuscaContinuacao as $dados2) {
          	$id = $dados2->idOferta;
          }

          $idOferta = $id;
      }

}


//echo "ultimo id = ". $idOferta;
//var_dump(array_merge($retornoBusca,$retornoBuscaContinuacao));

$obj_ofertaSemana->setIdOferta($idOferta);
$retornoAlteracao = $obj_ofertaSemana->alterar();
if($retornoAlteracao)
{
	echo "mudou";
}













?>