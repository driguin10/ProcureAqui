<?php
	include_once("../model/dao.php");
	
	class CategoriaModel {
		
		protected $id_categoria;
    protected $categoria;

    protected function pesquisarId(){
			$query = "SELECT * FROM categoria WHERE idCategoria='".$this->getId_categoria()."'";
			return Dao::getInstancia()->executeS($query);
		}

		protected function listaCategorias(){
			$query = "SELECT * FROM categoria";
			return Dao::getInstancia()->executeS($query);
		}
	}
?>