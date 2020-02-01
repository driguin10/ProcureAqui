<?php
include_once("../model/dao.php");
	
	class AssinaturaModel {
	
		protected $id_assinatura;
    protected $id_pessoa;
    protected $id_conta;
    protected $DataAssinatura;
    protected $DataVencimento;
  	protected $pago;
	
		protected function incluir() 
    {
			$query = "INSERT INTO assinatura (idPessoa,idConta,dataAssinatura)
            		VALUES (
                    '".$this->getId_pessoa()."',
                    '".$this->getId_conta()."',
										'".$this->getDataAssinatura()."')";	
			return Dao::getInstancia()->execute($query);
		}

		protected function alterar() {
			$query = "UPDATE assinatura SET	
								idConta = '".$this->getId_conta()."',
								dataAssinatura = '".$this->getDataAssinatura()."',
								dataVencimento = '".$this->getDataVencimento()."',
								pago = '".$this->getPago()."'
								WHERE idPessoa = '".$this->getId_pessoa()."'";
				return Dao::getInstancia()->execute($query);
			}

			protected function alterarConta() {
				$query = "UPDATE assinatura SET	
									idConta = '".$this->getId_conta()."',
									pago = '".$this->getPago()."'
									WHERE idPessoa = ".$this->getId_pessoa();
				return Dao::getInstancia()->execute($query);
			}

		protected function deletar(){
			$query = "DELETE FROM assinatura 
					  		WHERE idPessoa = '".$this->getId_pessoa()."'";
			return Dao::getInstancia()->execute($query);
		}

		protected function pesquisa(){
			$query = "SELECT * FROM assinatura where idPessoa='".$this->getId_pessoa()."'";     
			return Dao::getInstancia()->executeS($query);
		}

		protected function pagar(){
			$query = "UPDATE assinatura SET	
							pago = '".$this->getPago()."',
							dataAssinatura = '".$this->getDataAssinatura()."',
							dataVencimento = '".$this->getDataVencimento()."',
							WHERE idConta = '".$this->getId_conta()."'";
			return Dao::getInstancia()->executeS($query);
		}
	}
?>