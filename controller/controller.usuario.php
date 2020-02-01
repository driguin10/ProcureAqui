<?php
	include_once("../model/model.usuario.php");

	
	
	class usuarioController extends usuarioModel {
		
		
		public function __construct(){}
				
		public function setId_usuario($id_usuario) {
			$this->id_usuario = $id_usuario;
		}

		public function getId_usuario() {
			return $this->id_usuario;
		}

		public function setEmail($email) {
			$this->email = $email;
		}

		public function getEmail() {
			return $this->email;
		}
		
		public function setSenha($senha) {
			$this->senha = $senha;
		}

		public function getSenha() {
			return $this->senha;
		}
        
        //--------------- funções -------------
        
		public function incluir() {	
			return parent::incluir();
		}
		
		public function alterar() {	
			return parent::alterar();
		}

		public function deletar() {	
			return parent::deletar();
		}
		
    public function busca() {	
			return parent::busca();
		}
        
    public function retornaUsuario() {	
			return parent::retornaUsuario();
		}
        
    public function verificaEmail() {		
			return parent::verificaEmail();
		}
	}
?>