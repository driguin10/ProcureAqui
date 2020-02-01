<?php
include_once("../model/dao.php");
	
	class BuscaModel {
			
		protected $SQL;
		
    protected function busca(){
			$query = $this->getSQL();
			return Dao::getInstancia()->executeS($query);
		}
	}
?>