<?php
include_once("../model/dao.php");
	
	class FavoritoModel {
	
		protected $id_favorito;
    protected $id_pessoa;
    protected $id_servOferta;
    protected $tipo;
      
		protected function incluir() 
        {
			$query = "INSERT INTO favorito (idPessoa,idServOferta,tipo)
            		VALUES (
								'".$this->getId_pessoa()."',
                '".$this->getId_servOferta()."',
								'".$this->getTipo()."')";
			return Dao::getInstancia()->execute($query);
		}
		
		protected function deletar() {
			$query = "DELETE FROM favorito 
					  		WHERE idFavorito = '".$this->getId_favorito()."'";
			return Dao::getInstancia()->execute($query);
		}

		protected function deletarPessoa() {
			$query = "DELETE FROM favorito 
					  	WHERE idPessoa = '".$this->getId_pessoa()."'";
			return Dao::getInstancia()->execute($query);
		}
		
		protected function pesquisa(){
			$query = "SELECT * FROM favorito where idPessoa='".$this->getId_pessoa()."'";     
			return Dao::getInstancia()->executeS($query);
		}
	}
?>