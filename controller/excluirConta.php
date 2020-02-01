<?php
 include_once("../model/dao.php");
 include_once("controller.favorito.php");
 include_once("controller.assinatura.php");
 include_once("controller.oferta.php");
 include_once("controller.prestador.php");
 include_once("controller.pessoa.php");
 include_once("controller.usuario.php");
 include_once("controller.servico.php");

$idPessoa = $_POST['id'];


//-----------------pega id do prestador e apaga imagem--------------------------------
$obj_Prestador = new PrestadorController();
$obj_Prestador->setId_pessoa($idPessoa);
$retornoPrestador = $obj_Prestador->pesquisaPessoa();
if($retornoPrestador) 
{
  foreach($retornoPrestador as $dados) 
  {
    $idPrestador = $dados->idPrestador;
    $pathIMG = $dados->imagem;
    $cam = trim($pathIMG,"/procureaqui");
    $cam = trim($cam,"view");
    $cam = trim($cam,"/");

    if($cam !="imgFILES/imgNull/imgNull.png")
      if (file_exists("../view/$cam")) 
      {
        unlink("../view/$cam");
      } 
  }
}

//----------------------pega id do usuario---------------------------------------
$obj_pessoa = new PessoaController();
$obj_pessoa->setId_pessoa($idPessoa);
$retornoPessoa = $obj_pessoa->busca();
if($retornoPessoa)
{
  foreach ($retornoPessoa as $dados) {
    $idUsuario = $dados->idUsuario;
  }
}

//------------------------deleta favoritos -----------------------------------
   
$obj_favorito = new FavoritoController();
$obj_favorito->setId_pessoa($idPessoa);   
$retornoFavorito = $obj_favorito->deletarPessoa();

//--------------------deleta ofertas e apaga imagem--------------------------------------       
$obj_servico = new ServicoController();
$obj_servico->setId_prestador($idPrestador);
$retornoServico = $obj_servico->pesquisaPessoa();
if($retornoServico)
{
  foreach ($retornoServico as $dados) 
  {
    $pathIMG = $dados->imagem;
    $cam = trim($pathIMG,"/procureaqui");
    $cam = trim($cam,"view");
    $cam = trim($cam,"/");

    if($cam !="imgFILES/imgNull/imgNull.png")
      if (file_exists("../view/$cam")) 
      {
        unlink("../view/$cam");
      }

      $obj_oferta = new OfertaController();
      $obj_oferta->setId_servico($dados->idServico);
      $retonoOferta = $obj_oferta->buscaServico();
      if($retonoOferta)
      {
        foreach ($retonoOferta as $dados) {
          $pathIMG = $dados->imagem;
          $cam = trim($pathIMG,"/procureaqui");
          $cam = trim($cam,"view");
          $cam = trim($cam,"/");

          if($cam !="imgFILES/imgNull/imgNull.png")
            if (file_exists("../view/$cam")) 
            {
                unlink("../view/$cam");
            }
          }
      }
      $retonoOferta = $obj_oferta->deletarServico();
  }    
}


//--------------------deleta prestador------------------------------------------
$retornoServico = $obj_servico->deletarPrestador();

//------------------------deleta assinatura-----------------------------
$obj_assinatura = new AssinaturaController();
$obj_assinatura->setId_pessoa($idPessoa);
$retornoAssinatura = $obj_assinatura->deletar();

//--------------------deleta prestador------------
$retornoPrestador = $obj_Prestador->deletarPessoa();

//-------------------deleta pessoa----------------
$retornoPessoa = $obj_pessoa->deletar();

//----------------------deleta usuario----------
$obj_usuario = new UsuarioController();
$obj_usuario->setId_usuario($idUsuario);
$retornoUsuario = $obj_usuario->deletar();

//---------------------------------

?>