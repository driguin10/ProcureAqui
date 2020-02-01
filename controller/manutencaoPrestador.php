<?php

include_once("../model/dao.php");
include_once("controller.prestador.php");
include_once("controller.pessoa.php");
$opcao = $_POST['opcao'];
$caminho = '/procureaqui/view/imgFILES/';//caminho onde será salvo as imagens
if($opcao == 'editar')
{

	$idPrestador = str_replace("'", "",$_POST['idPrestador']);
	$idPessoa = str_replace("'", "",$_POST['idPessoa']);
	$nomeFantasia = str_replace("'", "",$_POST['nomeFantasia']);
	$razao = str_replace("'", "",$_POST['razao']);
	$nomeP = str_replace("'", "",$_POST['nome']);
	$cpf = str_replace("'", "",$_POST['cpf']);
	$cnpj = str_replace("'", "",$_POST['cnpj']);
	$endereco = str_replace("'", "",$_POST['endereco']);
	$cep = str_replace("'", "",$_POST['cep']);
	$estado = str_replace("'", "",$_POST['estado']);
	$cidade = str_replace("'", "",$_POST['cidade']);
	$telefone = str_replace("'", "",$_POST['telefone']);
	//$tipoConta = $_POST['tipoConta'];
	$ImgAntiga =$_POST['imagemAntiga'];
	$numero=str_replace("'", "",$_POST['numero']);


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
				{/*excluido	*/}		
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
		//$destino = $caminho.'imgNull/imgNull.png';
	}


	$obj_prestador = new PrestadorController();
	$obj_prestador->setId_prestador($idPrestador);
	$obj_prestador->setCnpj($cnpj);
	$obj_prestador->setRazaoSocial($razao);
	$obj_prestador->setNomeFantasia($nomeFantasia);
	$obj_prestador->setImagem($destino);
	$retornoPrestador=$obj_prestador->alterar();
	if($retornoPrestador)
	{
		 
	}

	$obj_pessoa = new pessoaController();
	$obj_pessoa->setId_pessoa($idPessoa); 
	$obj_pessoa->setEstado($estado);
	$obj_pessoa->setCidade($cidade);
	$obj_pessoa->setNome($nomeP);
	$obj_pessoa->setCpf($cpf);
	$obj_pessoa->setTelefone($telefone);
	$obj_pessoa->setEndereco($endereco);
	$obj_pessoa->setCep($cep);
	$obj_pessoa->setNumero($numero);
	$retornoPessoa = $obj_pessoa->alterarPrest();
	if($retornoPessoa)
	{
		echo "salvo";
		
	}

}
elseif($opcao == "editarUser")
{
	$idUser = str_replace("'", "",$_POST['usuario']);
	$email = str_replace("'", "",$_POST['email']);
	$senha = str_replace("'", "",$_POST['senha']);

	//--------- cifra a senha do usuario----------------
	include_once("../controller/cripto.php");
	$Cifra = new Cifra();
	$senha= $Cifra->cifrar($senha,3);
	//--------------------------------------------------

	include_once("controller.usuario.php");
	$obj_usuario = new usuarioController();
	$obj_usuario->setId_usuario($idUser);
	$getSenha = $obj_usuario->busca();
	if($getSenha)
	{
		foreach ($getSenha as $dadosSenha) {
			$senhaAntiga = $dadosSenha->senha;
		}
		if($senha == "")
		$senha = $senhaAntiga;
	}

	$obj_usuario->setEmail($email);
	$obj_usuario->setSenha($senha);
  $retornoUsuario = $obj_usuario->alterar();
  if($retornoUsuario)
  {
  	echo "salvo";
  }
}
?>