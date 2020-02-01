<?php
	include_once("../model/model.municipio.php");

	
	
	class MunicipioController extends MunicipioModel {
	
		public function __construct(){}
				
		public function setId_municipio($id_municipio) {
			$this->id_municipio = $id_municipio;
		}

		public function getId_municipio() {
			return $this->id_municipio;
		}

		public function setUf($uf) {
			$this->uf = $uf;
		}

		public function getUf() {
			return $this->uf;
		}
		
		public function setNome($nome) {
			$this->nome = $nome;
		}

		public function getNome() {
			return $this->nome;
		}

		public function incluir() {	
			return parent::incluir();
		}
		
		public function alterar() {
			return parent::alterar();
		}

		public function deletar() {
			return parent::deletar();
		}

		public function pesquisaUf(){
			return parent::pesquisaUf();
		}
}
?>