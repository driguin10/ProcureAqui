<?php
include_once("../model/dao.php");
include_once("controller.favorito.php");

$opcao = $_POST['type'];

if($opcao=="deletar")
{
	$idOferta = $_POST["id"];
	$obj_favorito = new FavoritoController();
	$obj_favorito->setId_favorito($idOferta);
	$retornoFavorito = $obj_favorito->deletar();
	if($retornoFavorito)
	{
		
	}
}

?>