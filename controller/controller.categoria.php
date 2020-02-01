<?php
	include_once("../model/model.categoria.php");

	class CategoriaController extends CategoriaModel {
		
		public function __construct(){}
				
		public function setId_categoria($id_categoria) {
			$this->id_categoria = $id_categoria;
		}

		public function getId_categoria() {
			return $this->id_categoria;
		}
		
		public function setCategoria($categoria){
			$this->categoria = $categoria;
		}

		public function getCategoria(){
			return $this->categoria;
		}
		
        //--------------- funções -------------
        
		public function pesquisarId() {
			
			return parent::pesquisarId();
		}

		public function listaCategorias() {
			
			return parent::listaCategorias();
		}
	}
?>