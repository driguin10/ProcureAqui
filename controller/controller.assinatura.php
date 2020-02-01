<?php
	include_once("../model/model.assinatura.php");

	class AssinaturaController extends AssinaturaModel {
		
	public function __construct(){}
				     
	public function setId_assinatura($id_assinatura) {
		$this->id_assinatura = $id_assinatura;
	}
	
	public function getId_assinatura() {
		return $this->id_assinatura;
	}
      
	public function setId_pessoa($id_pessoa) {
		$this->id_pessoa = $id_pessoa;
	}

	public function getId_pessoa() {
		return $this->id_pessoa;
	}
	
  public function setId_conta($id_conta) {
		$this->id_conta = $id_conta;
	}

	public function getId_conta() {
		return $this->id_conta;
	}
      
  public function setDataAssinatura($DataAssinatura) {
		$this->DataAssinatura = $DataAssinatura;
	}
	public function getDataAssinatura() {
		return $this->DataAssinatura;
	}

	public function setDataVencimento($DataVencimento) {
		$this->DataVencimento = $DataVencimento;
	}

	public function getDataVencimento() {
		return $this->DataVencimento;
	}

	public function setPago($pago) {
		$this->pago = $pago;
	}

	public function getPago() {
		return $this->pago;
	}
 
	public function incluir() {
		
		return parent::incluir();
	}

	public function deletar() {
		return parent::deletar();
	}
	public function alterar() {
		return parent::alterar();
	}

	public function alterarConta() {
		return parent::alterarConta();
	}

	public function pesquisa(){
		return parent::pesquisa();
	}

	public function pagar(){
		return parent::pagar();
	}
}
	

?>