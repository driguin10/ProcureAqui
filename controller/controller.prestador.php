<?php
	include_once("../model/model.prestador.php");

	class PrestadorController extends PrestadorModel {
		
		
		public function __construct(){}
				
		public function setId_prestador($id_prestador) {
			$this->id_prestador = $id_prestador;
		}

		public function getId_prestador() {
			return $this->id_prestador;
		}

		public function setId_pessoa($id_pessoa) {
			$this->id_pessoa = $id_pessoa;
		}

		public function getId_pessoa() {
			return $this->id_pessoa;
		}
		
		public function setCnpj($cnpj) {
			$this->cnpj = $cnpj;
		}

		public function getCnpj() {
			return $this->cnpj;
		}
 
    public function setRazaoSocial($razaoSocial) {
			$this->razaoSocial = $razaoSocial;
		}

		public function getRazaoSocial() {
			return $this->razaoSocial;
		}
         
    public function setNomeFantasia($nomeFantasia) {
			$this->nomeFantasia = $nomeFantasia;
		}

		public function getNomeFantasia() {
			return $this->nomeFantasia;
		}
        
    public function setReputacao($reputacao) {
			$this->reputacao = $reputacao;
		}

		public function getReputacao() {
			return $this->reputacao;
		}
         
    public function setImagem($imagem) {
			$this->imagem = $imagem;
		}

		public function getImagem() {
			return $this->imagem;
		}
  
		public function incluir() {
			return parent::incluir();
		}
		
		public function alterar() {
			return parent::alterar();
		}

		public function alteraVisivel0() {
			return parent::alteraVisivel0();
		}

		public function alteraVisivel1() {
			return parent::alteraVisivel1();
		}

		public function deletar() {	
			return parent::deletar();
		}

		public function deletarPessoa() {	
			return parent::deletarPessoa();
		}

		public function top6(){
			return parent::top6();
		}

		 public function busca(){
			return parent::busca();
		}
	
		public function pesquisaPessoa(){
			return parent::pesquisaPessoa();
		}

		public function addReputacao(){
			return parent::addReputacao();
		}
	}
?>