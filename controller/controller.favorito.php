<?php
	include_once("../model/model.favorito.php");

	
	
	class FavoritoController extends FavoritoModel {
		
		
		public function __construct(){}
				
    public function setId_favorito($id_favorito) {
			$this->id_favorito = $id_favorito;
		}
		public function getId_favorito() {
			return $this->id_favorito;
		}
        
		public function setId_pessoa($id_pessoa) {
			$this->id_pessoa = $id_pessoa;
		}

		public function getId_pessoa() {
			return $this->id_pessoa;
		}

		public function setId_servOferta($id_servOferta) {
			$this->id_servOferta = $id_servOferta;
		}

		public function getId_servOferta() {
			return $this->id_servOferta;
		}
		
    public function setTipo($tipo) {
			$this->tipo = $tipo;
		}

		public function getTipo() {
			return $this->tipo;
		}
		
		public function incluir() {
			return parent::incluir();
		}
		
		public function deletar() {
			return parent::deletar();
		}

		public function deletarPessoa() {
			return parent::deletarPessoa();
		}

		public function pesquisa(){
			return parent::pesquisa();
		}
	}
?>