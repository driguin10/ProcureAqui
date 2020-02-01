<?php
include_once("../model/dao.php");
	
	class prestadorModel {
		
		
		protected $id_prestador;
    protected $id_pessoa;
    protected $cnpj;
    protected $razaoSocial;
    protected $nomeFantasia;
    protected $reputacao;
    protected $imagem;

		protected function incluir() 
    {
			$query = "INSERT INTO prestador (idPessoa,cnpj,razaoSocial,nomeFantasia,reputacao,imagem)
            		VALUES (
								'".$this->getId_pessoa()."',
                '".$this->getCnpj()."',
                '".$this->getRazaoSocial()."',
                '".$this->getNomeFantasia()."',
                '".$this->getReputacao()."',
								'".$this->getImagem()."')";
			return Dao::getInstancia()->execute($query);
		}

		protected function alteraVisivel0() 
		{
			$query = "UPDATE prestador SET              
				    	visivel = 0	WHERE idPrestador = '".$this->getId_prestador()."'";
			return Dao::getInstancia()->execute($query);
		}

		protected function alteraVisivel1() 
		{
			$query = "UPDATE prestador SET              
				    	visivel = 1	WHERE idPrestador = '".$this->getId_prestador()."'";
			return Dao::getInstancia()->execute($query);
		}
		
		protected function alterar() 
		{
			$query = "UPDATE prestador SET
                cnpj = '".$this->getCnpj()."',
                razaoSocial = '".$this->getRazaoSocial()."',
                nomeFantasia = '".$this->getNomeFantasia()."',
								imagem = '".$this->getImagem()."'
								WHERE idPrestador = '".$this->getId_prestador()."'";
			return Dao::getInstancia()->execute($query);
		}
		
		protected function deletar()
		{
			$query = "DELETE FROM prestador 
					  	WHERE idPrestador = '".$this->getId_prestador()."'";
			return Dao::getInstancia()->execute($query);
		}

		protected function deletarPessoa() 
		{
			$query = "DELETE FROM prestador 
					  	WHERE idPessoa = '".$this->getId_pessoa()."'";
			return Dao::getInstancia()->execute($query);
		}

		protected function busca()
		{
			$query = "SELECT * FROM prestador WHERE idPrestador='".$this->getId_prestador()."'";
			return Dao::getInstancia()->executeS($query);
		}


		protected function pesquisaPessoa()
		{
			$query = "SELECT * FROM prestador WHERE idPessoa='".$this->getId_pessoa()."'";
			return Dao::getInstancia()->executeS($query);
		}

		protected function top6()
		{
			$query = "SELECT * FROM prestador WHERE visivel = 1 order by reputacao DESC LIMIT 6";
			return Dao::getInstancia()->executeS($query);
		}

		protected function addReputacao() {
			$query = "UPDATE prestador SET
                reputacao = reputacao + '".$this->getReputacao()."'
								WHERE idPrestador = '".$this->getId_prestador()."'";
			return Dao::getInstancia()->execute($query);
		}
	}
?>