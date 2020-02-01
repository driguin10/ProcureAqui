<?php
// adiciona reputação para prestador
	$qt = $_POST['QT'];
	$id = $_POST['ID'];

	include_once("../model/dao.php");
	include_once("controller.prestador.php");

	$obj_prestador = new PrestadorController();
	$obj_prestador->setId_prestador($id);
	$obj_prestador->setReputacao($qt);
	$retornoPrestador = $obj_prestador->addReputacao(); 
	if($retornoPrestador)
	{
		echo "add";
	}

?>