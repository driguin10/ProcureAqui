<?php
include_once("../model/dao.php");
include_once("controller.pessoa.php");
include_once("controller.prestador.php");
include_once("controller.assinatura.php");

$caminho = '/procureaqui/view/imgFILES/';//caminho onde será salvo as imagens
$idPessoa = $_POST['idPessoa'];
$idUsuario = $_POST['idUsuario'];

if(isset($_FILES['cadprestador-imagem']['name']) && $_FILES["cadprestador-imagem"]["error"] == 0)
{
	$arquivo_tmp = $_FILES['cadprestador-imagem']['tmp_name'];
	$nome = $_FILES['cadprestador-imagem']['name'];
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


$tipoConta = $_POST['tipoConta'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$endereco =$_POST['endereco'];
$cep =$_POST['cep'];
$numero= $_POST['numero'];
$razao = $_POST['razao'];
$Nfantasia = $_POST['nomeFantasia'];
$cnpj = $_POST['cnpj'];

$obj_pessoa = new pessoaController();
$obj_pessoa->setId_usuario($idUsuario);
$obj_pessoa->setId_pessoa($idPessoa); 
$obj_pessoa->setEstado($estado);
$obj_pessoa->setCidade($cidade);
$obj_pessoa->setNome($nome);
$obj_pessoa->setCpf($cpf);
$obj_pessoa->setTelefone($telefone);
$obj_pessoa->setEndereco($endereco);
$obj_pessoa->setCep($cep);
$obj_pessoa->setNumero($numero);
$obj_pessoa->setPacesso(0);
$retornoPessoa = $obj_pessoa->alterar();

if($retornoPessoa)
{
	$obj_prestador = new PrestadorController();
	$obj_prestador->setId_pessoa($idPessoa);
	$obj_prestador->setCnpj($cnpj);
	$obj_prestador->setRazaoSocial($razao);
	$obj_prestador->setNomeFantasia($Nfantasia);
	$obj_prestador->setReputacao(0);
	$obj_prestador->setImagem($destino);
	$retornoPrestador = $obj_prestador->incluir();
	if($retornoPrestador)
	{	
		date_default_timezone_set('America/Sao_Paulo');
    $dataHoje = date('Y-m-d');	
    $dataVencimento = date('Y-m-d', strtotime("+1 month", strtotime($dataHoje)));	// data de vencimento recebe o prazo de um mes da data atual
		include_once("../controller/controller.assinatura.php");
    $obj_assinatura = new AssinaturaController();
    $obj_assinatura->setId_pessoa($idPessoa);
    $obj_assinatura->setId_conta($tipoConta); // conta basica
    $obj_assinatura->setDataAssinatura($dataHoje);
    $obj_assinatura->setDataVencimento($dataVencimento);
    $obj_assinatura->setPago(1);
    $retornoAssinatura = $obj_assinatura->alterar();
    if($retornoAssinatura)
    {
       header("location:/procureaqui/dashboard");
    }
	}	
}
?>