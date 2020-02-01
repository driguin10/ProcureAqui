<?php

$tipoConta = $_POST['tipoConta'];
$id_pessoa = $_POST['idPessoa'];
$idPrestador = $_POST['idPrestador'];
date_default_timezone_set('America/Sao_Paulo');
$dataHoje = date('Y-m-d');
$dataVencimento = date('Y-m-d', strtotime("+1 month", strtotime($dataHoje)));	

include_once("../controller/controller.assinatura.php");			    
$obj_assinatura = new AssinaturaController();
$obj_assinatura->setId_pessoa($id_pessoa);
$obj_assinatura->setId_conta($tipoConta);
$obj_assinatura->setDataAssinatura($dataHoje); 
$obj_assinatura->setDataVencimento($dataVencimento); 
$obj_assinatura->setPago(1);
$retornoo = $obj_assinatura->alterar();

include_once("../controller/controller.servico.php");
$obj_servico = new ServicoController();
$obj_servico->setId_prestador($idPrestador);
$retornoServico = $obj_servico->pesquisaPessoa();
if($retornoServico)
{
  foreach ($retornoServico as $dadosServico) 
  {
  	include_once("../controller/controller.oferta.php");
    $obj_oferta = new OfertaController();
    $obj_oferta->setId_servico($dadosServico->idServico);
    $retonoOferta = $obj_oferta->buscaServico();
    if($retonoOferta)
    {
      foreach ($retonoOferta as $dadosOferta) 
      {
      	$obj_oferta->setId_oferta($dadosOferta->idOferta);
  			$obj_oferta->alteraVisivel1();    
      }
    }
    $obj_servico->setId_servico($dadosServico->idServico);
		$obj_servico->alteraVisivel1();
  }
}
include_once("../controller/controller.prestador.php");
$obj_prestador = new PrestadorController();
$obj_prestador->setId_prestador($idPrestador);
$obj_prestador->alteraVisivel1();

header("location:/procureaqui/dashboard");
?>