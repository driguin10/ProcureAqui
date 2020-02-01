<?php
	include_once("../model/model.ofertaSemana.php");

	class OfertaSemanaController extends OfertaSemanaModel {
		
		public function __construct(){}


		public function setIdOferta($Oferta){
			$this->idOferta = $Oferta;
		}

		public function getIdOferta(){
			return $this->idOferta;
		}



			public function setQtRegistros($qtRegistros){
			$this->qtRegistros = $qtRegistros;
		}

		public function getQtRegistros(){
			return $this->qtRegistros;
		}


		

		
        //--------------- funções -------------

		public function alterar() {
			return parent::alterar();
		}
        
		public function buscaIniFim() {
			return parent::buscaIniFim();
		}

		public function buscaOferta() {
			return parent::buscaOferta();
		}



	
	}
?>