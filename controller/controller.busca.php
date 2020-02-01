<?php
	include_once("../model/model.busca.php");

	class BuscaController extends BuscaModel {

	public function __construct(){}
			 
  public function setSQL($SQL) {
		$this->SQL = $SQL;
	}

	public function getSQL() {
		return $this->SQL;
	}
	
	public function busca(){
		return parent::busca();
	}
}

?>