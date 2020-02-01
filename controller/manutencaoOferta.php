<?php
include_once("../model/dao.php");
include_once("controller.oferta.php");
include_once("../controller/controller.servico.php");
include_once("../controller/config.php");
$config = new config();

$opcao = $_POST['type'];
$caminho = '/procureaqui/view/imgFILES/';//caminho onde será salvo as imagens
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d');

if($opcao == "cadastra")
{
	$idServico = $_POST['servico'];
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$dataTermino = $_POST['dataTermino'];
	
	

	if(isset($_FILES['imagem']['name']) && $_FILES["imagem"]["error"] == 0)
	{
		$arquivo_tmp = $_FILES['imagem']['tmp_name'];
		$nome = $_FILES['imagem']['name'];
		$extensao = strrchr($nome, '.');
		$extensao = strtolower($extensao);
		if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
		{
			$novoNome = md5(microtime()). $extensao;
			$destino = '../view/imgFILES/'.$novoNome; 
			if(@move_uploaded_file($arquivo_tmp,$destino))
			{
				$destino = $caminho.$novoNome;// já atribui o link da imagem padrao caso não salve uma imagem
			}	
		}	
	}
	else
	{
		$destino = $caminho.'imgNull/imgNull.png';// já atribui o link da imagem padrao caso não salve uma imagem
	}
	
	$obj_oferta = new OfertaController();
	$obj_oferta->setId_servico($idServico);
	$obj_oferta->setTitulo($titulo);
	$obj_oferta->setDescricao($descricao);
	$obj_oferta->setData_pub($date);
	$obj_oferta->setData_ter($dataTermino);
	$obj_oferta->setQt_visualizacao(0);
	$obj_oferta->setImagem($destino);
	$retornoOferta = $obj_oferta->incluir();
	if($retornoOferta)
	{
	//header("Refresh:0; url=/procureaqui/dashboard#ofertas");
		echo "salvoo";
	}
	else
	{
		echo $retornoOferta;	
		echo "erro";
	}
}
elseif($opcao=="deletar")
{
	$idOferta = $_POST["id"];
	$obj_oferta = new OfertaController();
	$obj_oferta->setId_oferta($idOferta);
	$retornoOferta = $obj_oferta->busca();
	if($retornoOferta)
	{
		foreach ($retornoOferta as $dados) {
			$pathIMG = $dados->imagem;
		}
	
		$retornoOferta = $obj_oferta->deletar();
		if($retornoOferta)
		{
			$cam = $config->pathImagem($pathIMG);
			/*$cam = trim($pathIMG,"/procureaqui");
			$cam = trim($cam,"view");
			$cam = trim($cam,"/");*/

			if($cam !="imgFILES/imgNull/imgNull.png")
				if (file_exists("../view/$cam")) 
				{
					unlink("../view/$cam");
				}
		}
		
	}

}
elseif ($opcao == "pesquisa") 
{
	
	$conteudo = "";
	$idPrestador = $_POST['idPrestador'];
	$obj_serv = new ServicoController();             
  $obj_serv->setId_prestador($idPrestador);
  $retorno = $obj_serv->pesquisaPessoa();
  if($retorno) 
  {
	  foreach($retorno as $dados) 
	  {    
			$obj_oferta = new OfertaController();
			$obj_oferta->setId_servico($dados->idServico);
		  $retorno = $obj_oferta->buscaServico();
		  if($retorno) 
		  {
        foreach($retorno as $dados) 
        {    
            $idOferta = $dados->idOferta;
            $titulo = $dados->titulo;
            $visivel = $dados->visivel;
            $dataTerm = $dados->dataTermino;
            $Vencido = 0;
            $qtVisualizacao = $dados->qtVisualizacao;

            if( strtotime($date) > strtotime($dataTerm) && $dataTerm != NULL)
						{	
							$Vencido = 1;
						}


            if( $conteudo== "")
            {
            	$conteudo.=$idOferta."-".$titulo."-".$visivel."-".$Vencido."-".$qtVisualizacao;
            }
            else
            {
            	$conteudo.="-".$idOferta."-".$titulo."-".$visivel."-".$Vencido."-".$qtVisualizacao;
            }
            
        }
		  }
		}
	}
echo $conteudo;    
}
elseif($opcao == "pesquisaId")
{
	$idOferta = $_POST["id"];
	$obj_oferta = new OfertaController(); 
	$obj_oferta->setId_oferta($idOferta);
  $retorno = $obj_oferta->busca();
  
  if($retorno)
  {
  	foreach($retorno as $dados) 
    {    	
    	$idServico = $dados->idServico;
			$obj_serv = new ServicoController();  
			$obj_serv->setId_servico($idServico);
		  	$retornoServico = $obj_serv->pesquisaId();
		  if($retornoServico)
		  {
		  	foreach($retornoServico as $dados2) 
		    {   	
		    	$ServicoTitulo = $dados2->titulo;
		    	$categoria = $dados2->categoria;
		    }
		  } 	
			$varOferta= $idServico."*".$ServicoTitulo."*".$categoria."*".$dados->titulo."*".$dados->descricao."*".$dados->dataTermino."*".$dados->imagem;
		}
		echo $varOferta;
  }
}
elseif($opcao=="editar")
{
	$idOferta = $_POST['oferta'];
	$idServico = $_POST['servico'];
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$dataTermino = $_POST['dataTermino'];
	$ImgAntiga = $_POST['imagemAntiga'];
	date_default_timezone_set('America/Sao_Paulo');
	$date = date('Y-m-d');

	if(isset($_FILES['imagem']['name']) && $_FILES["imagem"]["error"] == 0)
	{
		/*$cam = trim($ImgAntiga,"/procureaqui");
		$cam = trim($cam,"view");
		$cam = trim($cam,"/");*/

		$cam = $config->pathImagem($ImgAntiga);

		if($cam !="imgFILES/imgNull/imgNull.png")
		{
			if (file_exists("../view/$cam")) 
			{
				if(unlink("../view/$cam"))
				{
					//excluido
				}		
			}			
		}

		$arquivo_tmp = $_FILES['imagem']['tmp_name'];
		$nome = $_FILES['imagem']['name'];
		$extensao = strrchr($nome, '.');
		$extensao = strtolower($extensao);
		if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
		{
			$novoNome = md5(microtime()). $extensao;
			$destino = '../view/imgFILES/'.$novoNome; 
			if(@move_uploaded_file($arquivo_tmp,$destino))
			{
				$destino = $caminho.$novoNome;// já atribui o link da imagem padrao caso não salve uma imagem
			}	
		}	
	}
	else
	{		
		$destino = $ImgAntiga;
	}

	$obj_oferta = new OfertaController();
	$obj_oferta->setId_oferta($idOferta);
	$obj_oferta->setId_servico($idServico);
	$obj_oferta->setTitulo($titulo);
	$obj_oferta->setDescricao($descricao);
	$obj_oferta->setData_pub($date);
	$obj_oferta->setData_ter($dataTermino);
	$obj_oferta->setQt_visualizacao(0);
	$obj_oferta->setImagem($destino);
	$retornoOferta = $obj_oferta->alterar();
	if($retornoOferta)
		echo $retornoOferta;
	else
		echo $retornoOferta;
}
elseif($opcao == "visivel")
{
	$idOferta = $_POST['idOferta'];
	$visivel = $_POST['visivel'];
	$obj_oferta = new OfertaController();
	$obj_oferta->setId_oferta($idOferta);
	if($visivel == 1)
	$retornoOferta = $obj_oferta->alteraVisivel1();
 	else
	$retornoOferta = $obj_oferta->alteraVisivel0();	

	if($retornoOferta)
	{
		echo "salvo";
	}


}

?>