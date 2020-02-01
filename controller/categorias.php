<?php
//retorna as categorias do sistema
	include_once("../model/dao.php");
  include_once("controller.categoria.php");

  $opcao = $_POST['type'];

  if($opcao == "listar")
  {
    $obj_categoria = new CategoriaController();
    $retornoCategoria = $obj_categoria->listaCategorias();
    $conteudo = "";
    if($retornoCategoria)
    {
    	foreach ($retornoCategoria as $dados) {
    		$conteudo.="<option value='$dados->categoria'>". $dados->categoria."</option> \n";
    	}
    	echo utf8_encode($conteudo);
    }
	}
?>