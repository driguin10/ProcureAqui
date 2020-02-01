	<?php
include_once("../model/dao.php");
	
	class OfertaModel {
		
		
		protected $id_oferta;
    protected $id_servico;
    protected $titulo;
    protected $descricao;
    protected $data_pub;
    protected $data_ter;
    protected $qt_visualizacao;
    protected $imagem;

    protected $DataFim;
    protected $PosIni;
    protected $PosFim;
	
		protected function incluir() 
    {
			if($this->getData_ter()=="")
			{
				$query = "INSERT INTO oferta (idServico,titulo,descricao,dataPublicacao,dataTermino,qtVisualizacao,imagem)
            			VALUES (
										'".$this->getId_servico()."',
				            '".$this->getTitulo()."',
				            '".$this->getDescricao()."',
				            '".$this->getData_pub()."',
				            NULL,
				            '".$this->getQt_visualizacao()."',
										'".$this->getImagem()."')";
			}
			else
			{

				$query = "INSERT INTO oferta (idServico,titulo,descricao,dataPublicacao,dataTermino,qtVisualizacao,imagem)
            			VALUES (
										'".$this->getId_servico()."',
				          	'".$this->getTitulo()."',
				          	'".$this->getDescricao()."',
				          	'".$this->getData_pub()."',
				          	'".$this->getData_ter()."',
				          	'".$this->getQt_visualizacao()."',
										'".$this->getImagem()."')";
			}
			return Dao::getInstancia()->execute($query);
		}
		
		
		protected function alterar() {
			if($this->getData_ter()=="")
			{
				$query = "UPDATE oferta SET
									idServico =	'".$this->getId_servico()."',
					        titulo = '".$this->getTitulo()."',
					        descricao ='".$this->getDescricao()."',
					        dataPublicacao = '".$this->getData_pub()."',
					        dataTermino = NULL,
					        qtVisualizacao = '".$this->getQt_visualizacao()."',
									imagem = '".$this->getImagem()."'
									WHERE idOferta = '".$this->getId_oferta()."'";
				return Dao::getInstancia()->execute($query);
			}
			else
			{
				$query = "UPDATE oferta SET
									idServico =	'".$this->getId_servico()."',
					        titulo = '".$this->getTitulo()."',
					        descricao ='".$this->getDescricao()."',
					        dataPublicacao = '".$this->getData_pub()."',
					        dataTermino = '".$this->getData_ter()."',
					        qtVisualizacao = '".$this->getQt_visualizacao()."',
									imagem = '".$this->getImagem()."'
									WHERE idOferta = '".$this->getId_oferta()."'";
				return Dao::getInstancia()->execute($query);
			}
		}

		protected function alteraVisivel0() {
			$query = "UPDATE oferta SET              
				    		visivel = 0	WHERE idOferta = '".$this->getId_oferta()."'";
			return Dao::getInstancia()->execute($query);
		}

		protected function alteraVisivel1() {
			$query = "UPDATE oferta SET              
				    		visivel = 1	WHERE idOferta = '".$this->getId_oferta()."'";
			return Dao::getInstancia()->execute($query);
		}
		
		
		protected function deletar() {
			$query = "DELETE FROM oferta 
					  WHERE idOferta = '".$this->getId_oferta()."'";
					  echo $query;
			return Dao::getInstancia()->execute($query);
		}

		protected function deletarServico() {
			$query = "DELETE FROM oferta 
					  WHERE idServico = '".$this->getId_servico()."'";
			return Dao::getInstancia()->execute($query);
		}
		
		protected function top6(){
			$query = "SELECT idOferta,idServico, titulo ,dataTermino, imagem FROM oferta WHERE visivel = 1 LIMIT 8";
			return Dao::getInstancia()->executeS($query);
		}
        

    protected function buscaTodos(){
			$query = "SELECT * FROM oferta WHERE visivel = 1";
			return Dao::getInstancia()->executeS($query);
		}

    protected function busca(){
			$query = "SELECT * FROM oferta WHERE idOferta='".$this->getId_oferta()."'";
			return Dao::getInstancia()->executeS($query);
		}
/*
		protected function busca(){
			$query = "SELECT * FROM oferta WHERE idOferta='".$this->getId_oferta()."' AND visivel = 1";
			return Dao::getInstancia()->executeS($query);
		}*/

		protected function buscaServico(){
			$query = "SELECT * FROM oferta WHERE idServico='".$this->getId_servico()."'";
			return Dao::getInstancia()->executeS($query);
		}

		protected function addVisualizacao() {
			$query = "UPDATE oferta SET
                qtVisualizacao = qtVisualizacao + 1
								WHERE idOferta = '".$this->getId_oferta()."'";
			return Dao::getInstancia()->execute($query);
		}

}
?>