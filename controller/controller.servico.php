<?php
	include_once("../model/model.servico.php");

	
	
	class ServicoController extends ServicoModel {
		
		
		public function __construct(){}
				
		public function setId_servico($id_servico) {
			$this->idServico = $id_servico;
		}

		public function getId_servico() {
			return $this->idServico;
		}

		public function setId_prestador($id_prestador) {
			$this->id_prestador = $id_prestador;
		}

		public function getId_prestador() {
			return $this->id_prestador;
		}
		
		public function setTitulo($titulo) {
			$this->titulo = $titulo;
		}

		public function getTitulo() {
			return $this->titulo;
		}
   
    public function setDescricao($descricao) {
			$this->descricao = $descricao;
		}

		public function getDescricao() {
			return $this->descricao;
		}
        
    public function setCategoria($categoria) {
			$this->categoria = $categoria;
		}
		public function getCategoria() {
			return $this->categoria;
		}
           
    public function setDataPub($DataPub) {
			$this->DataPub = $DataPub;
		}

		public function getDataPub() {
			return $this->DataPub;
		}

		public function setQtVisualizacao($qtVisualizacao) {
			$this->qtVisualizacao = $qtVisualizacao;
		}

		public function getQtVisualizacao() {
			return $this->qtVisualizacao;
		}
        
    public function setImagem($imagem) {
			$this->imagem = $imagem;
		}

		public function getImagem() {
			return $this->imagem;
		}


		 public function setFirst($first) {
			$this->first = $first;
		}

		public function getFirst() {
			return $this->first;
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

			public function getFirstId() {
			return parent::getFirstId();
		}

		public function alteraVisivel1() {	
			return parent::alteraVisivel1();
		}

		public function deletar() {
			return parent::deletar();
		}

		public function deletarPrestador() {
			return parent::deletarPrestador();
		}

		public function pesquisaPessoa(){
			return parent::pesquisaPessoa();
		}
		
		public function pesquisaId(){
			return parent::pesquisaId();
		}

		public function addVisualizacao(){
			return parent::addVisualizacao();
		}

		
	}
?>