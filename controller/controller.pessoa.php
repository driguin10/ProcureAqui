<?php
	include_once("../model/model.pessoa.php");

	class pessoaController extends pessoaModel {
		
		public function __construct(){}
				
		public function setId_pessoa($id_pessoa) {
			$this->id_pessoa = $id_pessoa;
		}

		public function getId_pessoa() {
			return $this->id_pessoa;
		}

		public function setId_usuario($id_usuario) {
			$this->id_usuario = $id_usuario;
		}

		public function getId_usuario() {
			return $this->id_usuario;
		}
		    
    public function setEstado($estado) {
			$this->estado = $estado;
		}

		public function getEstado() {
			return $this->estado;
		}
           
    public function setCidade($cidade) {
			$this->cidade = $cidade;
		}

		public function getCidade() {
			return $this->cidade;
		}
        
    public function setNome($nome) {
			$this->nome = $nome;
		}

		public function getNome() {
			return $this->nome;
		}
            
    public function setCpf($cpf) {
			$this->cpf = $cpf;
		}

		public function getCpf() {
			return $this->cpf;
		}

		public function setTelefone($telefone) {
			$this->telefone = $telefone;
		}

		public function getTelefone() {
			return $this->telefone;
		}

		public function setEndereco($endereco) {
			$this->endereco = $endereco;
		}

		public function getEndereco() {
			return $this->endereco;
		}

		public function setCep($cep) {
			$this->cep = $cep;
		}

		public function getCep() {
			return $this->cep;
		}

		public function setNumero($numero) {
			$this->numero = $numero;
		}

		public function getNumero() {
			return $this->numero;
		}

    public function setPacesso($Pacesso) {
			$this->Pacesso = $Pacesso;
		}

		public function getPacesso() {
			return $this->Pacesso;
		}
        
        //--------------- funções -------------
        
		public function incluir() {
			return parent::incluir();
		}
		
		public function alterar() {
			return parent::alterar();
		}

		public function alterarPrest() {
			return parent::alterarPrest();
		}

		public function deletar() {
			return parent::deletar();
		}
        
    public function primeiroAcesso() {
			return parent::primeiroAcesso();
		}
           
    public function buscaPessoaPuser() {
			return parent::buscaPessoaPuser();
		}

    public function busca() {
			return parent::busca();
		} 
	}
?>