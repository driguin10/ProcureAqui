<?php
	include_once("../model/model.oferta.php");

	class OfertaController extends OfertaModel {
			
		public function __construct(){}
				
		public function setId_oferta($id_oferta) {
			$this->id_oferta = $id_oferta;
		}

		public function getId_oferta() {
			return $this->id_oferta;
		}

		public function setId_servico($id_servico) {
			$this->id_servico = $id_servico;
		}

		public function getId_servico() {
			return $this->id_servico;
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
        
    public function setData_pub($data_pub) {
			$this->data_pub = $data_pub;
		}

		public function getData_pub() {
			return $this->data_pub;
		}
        
    public function setData_ter($data_ter) {
			$this->data_ter = $data_ter;
		}

		public function getData_ter() {
			return $this->data_ter;
		}
        
    public function setQt_visualizacao($qt_visualizacao) {
			$this->qt_visualizacao = $qt_visualizacao;
		}

		public function getQt_visualizacao() {
			return $this->qt_visualizacao;
		}
             
    public function setImagem($imagem) {
			$this->imagem = $imagem;
		}

		public function getImagem() {
			return $this->imagem;
		}

		//----------------- gerenciar as ofertas da semana da tela inicial 

	 	public function setDataFim($DataFim) {
			$this->DataFim = $DataFim;
		}

		public function getDataFim() {
			return $this->DataFim;
		}

		public function setPosIni($PosIni) {
			$this->PosIni = $PosIni;
		}

		public function getPosIni() {
			return $this->PosIni;
		}

		public function setPosFim($PosFim) {
			$this->PosFim = $PosFim;
		}

		public function getPosFim() {
			return $this->PosFim;
		}
		 
    //--------------- funções -------------
        
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
        
    public function deletarServico() {
			return parent::deletarServico();
		}
        
		public function top6(){
			return parent::top6();
		}

    public function busca(){
			return parent::busca();
		}

		public function buscaTodos(){
			return parent::buscaTodos();
		}

		public function buscaServico(){
			return parent::buscaServico();
		}

		public function addVisualizacao(){
			return parent::addVisualizacao();
		}
	}
?>