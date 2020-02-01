<?php
include_once("../model/dao.php");
	
	class OfertaSemanaModel {
	
	
    protected $idOferta;
    protected $qtRegistros;



      protected function buscaIniFim(){
			$query = "SELECT * FROM ofertasemana";
			return Dao::getInstancia()->executeS($query);
		}

    /*protected function buscaOferta(){
			$query = "SELECT idOferta,idServico, titulo ,dataTermino, imagem FROM oferta WHERE visivel = 1  LIMIT ".$this->getPosIni().",".$this->getPosFim();
			return Dao::getInstancia()->executeS($query);
		}*/

		 protected function buscaOferta(){
			$query = "SELECT idOferta,idServico, titulo ,dataTermino, imagem FROM oferta WHERE visivel = 1 AND idOferta >".$this->getIdOferta()." LIMIT ".$this->getQtRegistros();
			return Dao::getInstancia()->executeS($query);
		}

		 protected function alterar(){
			$query = "UPDATE ofertasemana SET
									posIni =	'".$this->getIdOferta()."'";
			return Dao::getInstancia()->execute($query);
		}

  }

?>