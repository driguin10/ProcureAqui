<?php
$palavra = $_POST['palavra'];
$categoria = $_POST['categoria'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];

include_once("../model/dao.php");
include_once("controller.servico.php");

$obj_servico = new ServicoController();
$obj_servico->setCategoria($categoria);
$obj_servico->setTitulo($titulo);
echo "$palavra - $categoria - $estado - $cidade";
?>