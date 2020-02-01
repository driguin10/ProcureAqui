<?php
include_once("../model/dao.php");
	
	class usuarioModel {
	
		protected $id_usuario;
    protected $email;
    protected $senha;

	
		protected function incluir() 
    {
			$query = "INSERT INTO usuario (email,senha)
            		VALUES (		
                '".$this->getEmail()."',
								'".$this->getSenha()."')";
			return Dao::getInstancia()->execute($query);
		}
		
		
		protected function alterar() 
		{
			$query = "UPDATE usuario SET
							email =	'".$this->getEmail()."',
              senha = '".$this->getSenha()."'
							WHERE idUsuario = '".$this->getId_usuario()."'";	
			return Dao::getInstancia()->execute($query);
		}
		
		
		protected function deletar() 
		{
			$query = "DELETE FROM usuario 
					  		WHERE idUsuario = '".$this->getId_usuario()."'";
			return Dao::getInstancia()->execute($query);
		}
        
    protected function busca()
    {
			$query = "SELECT * FROM usuario WHERE idUsuario='".$this->getId_usuario()."'";
			return Dao::getInstancia()->executeS($query);
		}
        
        
    protected function retornaUsuario()
    {
			$query = "SELECT idUsuario, email FROM usuario WHERE email='".$this->getEmail()."' AND senha='".$this->getSenha()."'";
			return Dao::getInstancia()->executeS($query);
		}
        
    protected function verificaEmail()
    {
			$query = "SELECT email FROM usuario WHERE email='".$this->getEmail()."'";
			return Dao::getInstancia()->executeS($query);
		}
	}
?>