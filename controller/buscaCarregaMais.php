<?php 
// faz a busca dos serviços e ofertas
$type =  $_POST['type'];
$PosInicio =$_POST['PosInicio'];
$PosFim = $_POST['PosFim'];
$palavra = $_POST['palavra'];
$categoria = $_POST['categoria'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];


//SQL buca serviços-------------------------
  $queryServico = "SELECT s.idServico as idservico, ".
  "s.idServico as idServico, ".
  "ass.idConta as tipoConta, ".
  "pe.pAcesso as pAcesso, ".
  "s.categoria as categoria, ".
  "s.titulo as titulo, ".
  "s.descricao as descricao, ".
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

  //SQL busca ofertas-----------------------------------  
  $queryOferta = "SELECT of.idOferta as idOferta,".
  "of.idOferta as idOferta, ".
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

  if($palavra != "")
  {
  	$queryFiltroS = " AND s.titulo LIKE '%".$palavra."%' OR s.descricao LIKE '%".$palavra."%'"; // filtro de serviços
    //$queryFiltroS = " AND s.titulo LIKE '%".$palavra."%'"; // filtro de serviços
  	$queryFiltroO = " AND of.titulo LIKE '%".$palavra."%' OR of.descricao LIKE '%".$palavra."%'"; // filtro de ofertas
  }

  if($categoria != "")
  {
    $queryFiltroS.=" AND s.categoria = '".$categoria."'";
  	$queryFiltroO.=" AND s.categoria = '".$categoria."'";
  }

  if($estado != "")
  {
    $queryFiltroS.=" AND pe.estado = '".$estado."'";
  	$queryFiltroO.=" AND pe.estado = '".$estado."'";
  }

  if($cidade != "")
  {
    $queryFiltroS.=" AND pe.cidade = '".$cidade."'";
  	$queryFiltroO.=" AND pe.cidade = '".$cidade."'";
  }

  $queryFiltroS.=" ORDER BY ass.idConta DESC LIMIT ".$PosInicio.",".$PosFim;
  $queryFiltroO.=" ORDER BY ass.idConta DESC LIMIT ".$PosInicio.",".$PosFim;
  $queryServico.= $queryFiltroS;
  $queryOferta.= $queryFiltroO;

  $query ="";
  if($type=="servico")
  {
  	$query=$queryServico;
  }
  elseif ($type=="oferta") 
  {
  	$query=$queryOferta;
  }

 
  include_once("controller.busca.php");
  $obj_busca = new BuscaController();
  $obj_busca->setSQL($query);
  $obj_retornoBusca = $obj_busca->busca();
  if($obj_retornoBusca)
  {
   foreach ($obj_retornoBusca as $dados) 
   { 
    	$resultado_dados[] = $dados;
   }
    $resultado["dados"] = $resultado_dados;
  }
  else
  {
  	$resultado["dados"] = "nada";
  }
  echo json_encode($resultado);

?>