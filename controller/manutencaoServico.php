
<?php
include_once("../model/dao.php");
include_once("controller.servico.php");

$opcao = $_POST['type'];
$caminho = '/procureaqui/view/imgFILES/';//caminho onde será salvo as imagens

if($opcao == "cadastra")
{
	$idPrestador = str_replace("'", "",$_POST['idPrestador']);
	$categoria = str_replace("'", "",$_POST['categoria']);
	$titulo = str_replace("'", "",$_POST['titulo']);
	$descricao = str_replace("'", "",$_POST['descricao']);
	date_default_timezone_set('America/Sao_Paulo');
	$date = date('Y-m-d');
	if(isset($_FILES['imagem']['name']) && $_FILES["imagem"]["error"] == 0)
	{
		$arquivo_tmp = $_FILES['imagem']['tmp_name'];
		$nome = $_FILES['imagem']['name'];
		$extensao = strrchr($nome, '.');
		$extensao = strtolower($extensao);
		if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
		{
			$novoNome = md5(microtime()) . $extensao;
			$destino = '../view/imgFILES/'.$novoNome; 
			if(@move_uploaded_file($arquivo_tmp,$destino))
			{
				$destino = $caminho.$novoNome;// já atribui o link da imagem padrao caso não salve uma imagem
			}	
		}	
	}
	else
	{
		$destino = $caminho.'imgNull/imgNull.png';
	}
	$obj_servico = new ServicoController();
	$obj_servico->setId_prestador($idPrestador);
	$obj_servico->setCategoria($categoria);
	$obj_servico->setTitulo($titulo);
	$obj_servico->setDescricao($descricao);
	$obj_servico->setDataPub($date);
	$obj_servico->setQtVisualizacao(0);
	$obj_servico->setImagem($destino);
	$retornoOferta = $obj_servico->incluir();
	if($retornoOferta)
	{
		echo "salvoo";
	}
	else
	{
		echo $retornoOferta;	
	}
}
elseif($opcao=="deletar")
{
	include_once("../controller/controller.oferta.php");
	$idServico = str_replace("'", "",$_POST["id"]);
	$obj_oferta = new OfertaController();
	$obj_oferta->setId_servico($idServico);
	$retornoOferta = $obj_oferta->buscaServico();
	if($retornoOferta)
	{
		foreach ($retornoOferta as $dados) 
		{
			$pathIMG = $dados->imagem;
			$cam = trim($pathIMG,"/procureaqui");
			$cam = trim($cam,"view");
			$cam = trim($cam,"/");
			if($cam !="imgFILES/imgNull/imgNull.png")
				if (file_exists("../view/$cam")) 
				{
					unlink("../view/$cam");
				}
		}
	}
	$obj_oferta = new OfertaController();
  $obj_oferta->setId_servico($idServico);
  $retonoOferta = $obj_oferta->deletarServico();
  if($retonoOferta)
  {    
  	$obj_servico = new ServicoController();
		$obj_servico->setId_servico($idServico);
		$retornoServico = $obj_servico->pesquisaId();
		if($retornoServico)
		{
			foreach ($retornoServico as $dados) 
			{
				$pathIMG = $dados->imagem;
				$cam = trim($pathIMG,"/procureaqui");
				$cam = trim($cam,"view");
				$cam = trim($cam,"/");
				if($cam !="imgFILES/imgNull/imgNull.png")
					if (file_exists("../view/$cam"))
					{
						unlink("../view/$cam");
					}
			}
		}
	  $obj_servico = new ServicoController();
		$obj_servico->setId_servico($idServico);
		$retornoServico = $obj_servico->deletar();
		if($retornoServico)
		{
			echo "excluido";
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
    	$titulo = $dados->titulo;
    	$idServico = $dados->idServico;
    	$visivel = $dados->visivel;
    	$qtVisualizacao = $dados->qtVisualizacao;
			if( $conteudo == "")
      {
      	$conteudo.= $idServico."-".$titulo."-".$visivel."-".$qtVisualizacao;
      }
      else
      {
      	$conteudo.= "-".$idServico."-".$titulo."-".$visivel."-".$qtVisualizacao;
      }
		}
	}
	echo $conteudo; // se tiver retorna        
}
elseif($opcao == "pesquisaServico")
{
	$idPrestador = str_replace("'", "",$_POST['idPrestador']);
	$obj_serv = new ServicoController();             
  $obj_serv->setId_prestador($idPrestador);
  $retorno = $obj_serv->pesquisaPessoa();
  $varServico = "";
  if($retorno) 
  {
    foreach($retorno as $dados) 
    {    	
	 		$varServico .= "<option value='$dados->idServico'>".$dados->titulo."</option> \n";
		}
		echo $varServico;
	}
}
elseif($opcao == "pesquisaId")
{
	$idServico = str_replace("'", "",$_POST["id"]);
	$obj_serv = new ServicoController();  
	$obj_serv->setId_servico($idServico);
  $retorno = $obj_serv->pesquisaId();
  $varServico = ""; 
  if($retorno)
  {
  	foreach($retorno as $dados) 
    {    	
			$varServico .=$dados->titulo."-".$dados->descricao."-".$dados->categoria."-".$dados->imagem;
		}
		echo $varServico;
  }
}
elseif($opcao =="editar")
{
	$idServico = str_replace("'", "",$_POST['idServico']);
	$idPrestador = str_replace("'", "",$_POST['idPrestador']);
	$categoria = str_replace("'", "",$_POST['categoria']);
	$titulo = str_replace("'", "",$_POST['titulo']);
	$descricao = str_replace("'", "",$_POST['descricao']);
	$ImgAntiga = str_replace("'", "",$_POST['imagemAntiga']);
	date_default_timezone_set('America/Sao_Paulo');
	$date = date('Y-m-d');

	if(isset($_FILES['imagem']['name']) && $_FILES["imagem"]["error"] == 0)
	{
		$cam = trim($ImgAntiga,"/procureaqui");
		$cam = trim($cam,"view");
		$cam = trim($cam,"/");
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
			$novoNome = md5(microtime()) . $extensao;
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

	$obj_servico = new ServicoController();
	$obj_servico->setId_servico($idServico);
	$obj_servico->setId_prestador($idPrestador);
	$obj_servico->setCategoria($categoria);
	$obj_servico->setTitulo($titulo);
	$obj_servico->setDescricao($descricao);
	$obj_servico->setDataPub($date);
	$obj_servico->setImagem($destino);
	$retornoServico = $obj_servico->alterar();
	if($retornoServico)
	{
		echo "salvo";
	}
	else
	{
		echo $retornoServico;
	}	
}

?>
