<?php
include_once("../model/dao.php");
include_once("controller.favorito.php");
$opcao = $_POST['opcao'];
$favorito = false;

if($opcao=="cadastro")
{
  $idPessoa = $_POST['idPessoa'];
  $idServOferta = $_POST['idServOferta'];
  $tipo = $_POST['tipo'];
  $obj_favorito = new FavoritoController();
  $obj_favorito->setId_pessoa($idPessoa);   
  $retornoFavorito = $obj_favorito->pesquisa();

  if($retornoFavorito)
  {
    foreach ($retornoFavorito as $dados) 
    {
     if($dados->idServOferta == $idServOferta && $dados->tipo == $tipo)
     {
        $favorito = true;
        $idFavorito = $dados->idFavorito;
     }  
    }
  }

  if($favorito == false)
  {
    $idServOferta = $_POST['idServOferta'];
    $obj_favorito = new FavoritoController();
    $obj_favorito->setId_pessoa($idPessoa);   
    $obj_favorito->setId_servOferta($idServOferta);
    $obj_favorito->setTipo($tipo);
    $retornoFavorito = $obj_favorito->incluir();

    if($retornoFavorito)
    {
      echo "salvo";
    }
    else
    {
      echo "erro";
    }
  }
  else
  {
    echo "possui-$idFavorito";
  }
}
elseif($opcao=="listar")
{
    $idPessoa = $_POST['idPessoa'];
    $info = "";
    $obj_favorito = new FavoritoController();
    $obj_favorito->setId_pessoa($idPessoa); 
    $retornoFavorito = $obj_favorito->pesquisa();
    if($retornoFavorito)
    {
      foreach($retornoFavorito as $dadosFav) 
      { 
        if($dadosFav->tipo == "oferta")
        {
           include_once("../controller/controller.oferta.php");
           $obj_oferta = new OfertaController();
           $obj_oferta->setId_oferta($dadosFav->idServOferta);
           $retornoOferta = $obj_oferta->busca();
           if($retornoOferta)
            {
              foreach ($retornoOferta as $dadosOferta) {
                  $info.= "oferta-".$dadosOferta->idOferta."-".$dadosOferta->titulo."-".$dadosFav->idFavorito."*";
              }
            }
        }
        elseif($dadosFav->tipo == "servico")
        {
          include_once("../controller/controller.servico.php");
          $obj_serv = new servicoController();             
          $obj_serv->setId_servico($dadosFav->idServOferta);
          $retornoServico = $obj_serv->pesquisaId();
          if($retornoServico)
           {
              foreach ($retornoServico as $dadosServico) {
                $info.= "servico-".$dadosServico->idServico."-".$dadosServico->titulo."-".$dadosFav->idFavorito."*";
              }
           }
        }
      }
    echo $info;    
    }
}
elseif($opcao == "excluir")
{
  $idFavorito = $_POST["id"];
  $obj_favorito = new FavoritoController();
  $obj_favorito->setId_favorito($idFavorito); 
  $retornoFavorito = $obj_favorito->deletar();
  if($retornoFavorito)
  {
    echo "deletado";
  }
}
?>