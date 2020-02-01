<?php
include_once("../model/dao.php");
	
	class PessoaModel {
		
		protected $id_pessoa;
    protected $id_usuario;
    protected $estado;
    protected $cidade;
    protected $nome;
    protected $cpf;
    protected $telefone;
    protected $endereco;
    protected $cep;
    protected $numero;
    protected $Pacesso;
	
		protected function incluir() 
    {
			$query = "INSERT INTO pessoa (idUsuario,estado,cidade,nome,cpf,telefone,endereco,cep,numero,pAcesso)
            		VALUES (
												'".$this->getId_usuario()."',
                        '".$this->getEstado()."',
                        '".$this->getCidade()."',
                        '".$this->getNome()."',
                        '".$this->getCpf()."',
                        '".$this->getTelefone()."',
                        '".$this->getEndereco()."',
                        '".$this->getCep()."',
                        '".$this->getNumero()."',
												'".$this->getPacesso()."')";
			return Dao::getInstancia()->execute($query);
		}
		
		protected function alterar() 
		{
				$query = "UPDATE pessoa SET	
									idUsuario = '".$this->getId_usuario()."',
	                estado ='".$this->getEstado()."',
	                cidade = '".$this->getCidade()."',
	                nome = '".$this->getNome()."',
	                cpf = '".$this->getCpf()."',
					    		telefone = '".$this->getTelefone()."',
									endereco = '".$this->getEndereco()."',
									cep = '".$this->getCep()."',
									numero = '".$this->getNumero()."',
									pAcesso = '".$this->getPacesso()."'
									WHERE idPessoa = '".$this->getId_pessoa()."'";	
				return Dao::getInstancia()->execute($query);
			}

			protected function alterarPrest() 
			{
				$query = "UPDATE pessoa SET	
	                    estado ='".$this->getEstado()."',
	                    cidade = '".$this->getCidade()."',
	                    nome = '".$this->getNome()."',
	                    cpf = '".$this->getCpf()."',
									    telefone = '".$this->getTelefone()."',
											endereco = '".$this->getEndereco()."',
											cep = '".$this->getCep()."',
											numero = '".$this->getNumero()."'
											WHERE idPessoa = '".$this->getId_pessoa()."'";
				return Dao::getInstancia()->execute($query);
			}

			protected function deletar() 
			{
				$query = "DELETE FROM pessoa 
						  		WHERE idPessoa = '".$this->getId_pessoa()."'";  
				return Dao::getInstancia()->execute($query);
			}
	        
        
      protected function primeiroAcesso() 
      {
				$query = "INSERT INTO pessoa (idUsuario,nome,pAcesso) VALUES ('".$this->getId_usuario()."','".$this->getNome()."','".$this->getPacesso()."')";
				return Dao::getInstancia()->execute($query);
			}
         
      protected function buscaPessoaPuser()
      {
				$query = "SELECT * FROM pessoa WHERE idUsuario='".$this->getId_usuario()."'";
				return Dao::getInstancia()->executeS($query);
			}

			protected function busca()
			{
				$query = "SELECT * FROM pessoa WHERE idPessoa='".$this->getId_pessoa()."'";
				return Dao::getInstancia()->executeS($query);
			}
	}
?>