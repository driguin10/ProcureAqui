<?php
  include_once("../model/dao.php");
  include_once("controller.municipio.php");

  $opcao = $_POST['opcao'];
  $Uf = $_POST['uf'];

  if($opcao == "listaCidades")
  {
    $obj_municipio = new MunicipioController();
    $obj_municipio->setUf($Uf);
    $retorno = $obj_municipio->pesquisaUf();
    $varr = "";

    if($retorno) 
    {
      foreach($retorno as $dados) 
      {
        $varr .= "<option value='$dados->nome'>". $dados->nome."</option> \n";
      }
      echo $varr;  
    }
    else
    {
      //echo "cod E-01";
    }
  }
  elseif($opcao == "CompletaCad")
  {
    $obj_municipio = new MunicipioController();
    $obj_municipio->setUf($Uf);
    $retorno = $obj_municipio->pesquisaUf();
    $varr = "";

    if($retorno) 
    {
      foreach($retorno as $dados) 
      {
        $varr .= "<option value='$dados->nome'>". $dados->nome."</option> \n";
      }
      echo $varr;  
    }
    else
    {
      //echo "cod E-01";
    }
  }
?>
