<?php
include_once("../model/dao.php");
	
	class ServicoModel {
		
		
		protected $idServico;
    protected $idPrestador;
    protected $titulo;
    protected $descricao;
    protected $categoria;
    protected $dataPublicacao;
    protected $qt_visualizacao;
    protected $imagem;

    protected $first;
	
		protected function incluir() 
    {
			$query = "INSERT INTO servico (idPrestador,titulo,descricao,categoria,dataPublicacao,qtVisualizacao,imagem)
        				VALUES (
								'".$this->getId_prestador()."',
                '".$this->getTitulo()."',
                '".$this->getDescricao()."',
                '".$this->getCategoria()."',
                '".$this->getDataPub()."',
                '".$this->getQtVisualizacao()."',
								'".$this->getImagem()."')";
			return Dao::getInstancia()->execute($query);
		}
		
		
	protected function alterar() 
	{
			$query = "UPDATE servico SET
								idPrestador =	'".$this->getId_prestador()."',
                titulo = '".$this->getTitulo()."',
                descricao ='".$this->getDescricao()."',
								categoria = '".$this->getCategoria()."',
                dataPublicacao = '".$this->getDataPub()."',
                imagem = '".$this->getImagem()."'
								WHERE idServico = '".$this->getId_servico()."'";	
			return Dao::getInstancia()->execute($query);
		}


		protected function alteraVisivel0() 
		{
			$query ="UPDATE servico SET visivel = 0	WHERE idServico = '".$this->getId_servico()."' AND idServico >'".$this->getFirst()."'";
			return Dao::getInstancia()->execute($query);
		}

		protected function getFirstId() 
		{
			$query ="SELECT idServico, titulo FROM servico WHERE idPrestador ='".$this->getId_prestador()."' ORDER BY idServico LIMIT 1";
			return Dao::getInstancia()->executeS($query);
		}

		protected function alteraVisivel1() 
		{
			$query = "UPDATE servico SET              
				    	visivel = 1	WHERE idServico = '".$this->getId_servico()."'";
			return Dao::getInstancia()->execute($query);
		}
		
		
		protected function deletar() 
		{
			$query = "DELETE FROM servico 
					  		WHERE idServico = '".$this->getId_servico()."'";			  
			return Dao::getInstancia()->execute($query);
		}

		protected function deletarPrestador() 
		{
			$query = "DELETE FROM servico 
					  		WHERE idPrestador = '".$this->getId_prestador()."'";			  
			return Dao::getInstancia()->execute($query);
		}
		   
		protected function pesquisaPessoa()
		{
			$query = "SELECT * FROM servico WHERE idPrestador = '".$this->getId_prestador()."'";
			return Dao::getInstancia()->executeS($query);
		}

    protected function pesquisaId()
    {
			$query = "SELECT * FROM servico WHERE idServico = '".$this->getId_servico()."'";
			return Dao::getInstancia()->executeS($query);
		}

			protected function addVisualizacao() {
			$query = "UPDATE servico SET
                qtVisualizacao = qtVisualizacao + 1
								WHERE idServico = '".$this->getId_servico()."'";
			return Dao::getInstancia()->execute($query);
		}
	}
?>