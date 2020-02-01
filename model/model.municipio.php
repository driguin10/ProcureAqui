<?php
include_once("../model/dao.php");
	
	class MunicipioModel {
	
		protected $id_municipio;
    protected $uf;
    protected $nome;
	
		protected function incluir() 
    {
			$query = "INSERT INTO municipio (nome,uf)
            	VALUES (
							'".$this->getNome()."',
							'".$this->getUf()."')";
			return Dao::getInstancia()->execute($query);
		}
		
		protected function alterar() {
			$query = "UPDATE municipio SET
								nome = '".$this->getNome()."',
								uf = '".$this->getUf()."'	
							  WHERE idMunicipio = '".$this->getId_municipio()."'";
			return Dao::getInstancia()->execute($query);
		}
		
		
		protected function deletar() {
			$query = "DELETE FROM municipio 
					  		WHERE idMunicipio = '".$this->getId_municipio()."'";
			return Dao::getInstancia()->execute($query);
		}
		
		protected function pesquisaUf(){
			$query = "SELECT nome, uf FROM municipio where uf='".$this->getUf()."'";
			return Dao::getInstancia()->executeS($query);
		}
	}
?>