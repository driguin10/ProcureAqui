<?php
include_once("../model/dao.php");
include_once("../controller/controller.usuario.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

//--------- cifra a senha do usuario----------------
include_once("../controller/cripto.php");
$Cifra = new Cifra();
$senha= $Cifra->cifrar($senha,3);
//--------------------------------------------------

$tipoConta = 1;
$pAcesso = 1;
// verificar se ja tem email
$obj_usuario = new usuarioController();
$obj_usuario->setEmail($email);
$retornoVerifica = $obj_usuario->verificaEmail();

if($retornoVerifica)
{
  echo "email-cadastrado";
}
else
{
  $obj_usuario = new usuarioController();
  $obj_usuario->setEmail($email);
  $obj_usuario->setSenha($senha);
  $retornoUsuario = $obj_usuario->incluir();

  if($retornoUsuario)
  {
    $obj_usuario = new usuarioController();
    $obj_usuario->setEmail($email);
    $obj_usuario->setSenha($senha);
    $retornoIDusuario = $obj_usuario->retornaUsuario();

    if($retornoIDusuario)
    {
      foreach($retornoIDusuario as $dados) 
      {
        $id = $dados->idUsuario;
      }
      include_once("../controller/controller.pessoa.php");
      $obj_pessoa = new pessoaController();
      $obj_pessoa->setId_usuario($id);
      $obj_pessoa->setPacesso($pAcesso);
      $obj_pessoa->setNome($nome);
      $retornoPessoa = $obj_pessoa->primeiroAcesso();
     
      if($retornoPessoa)
      {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d');
        include_once("../controller/controller.assinatura.php");
        $obj_assinatura = new AssinaturaController();
        $obj_assinatura->setId_pessoa($id);
        $obj_assinatura->setId_conta(1); // conta basica
        $obj_assinatura->setDataAssinatura($date);
        $retornoAssinatura = $obj_assinatura->incluir();
        if($retornoAssinatura)
        {
          echo "salvo";
        }   
      }
      else
      {
        echo "erro ao salvar pessoa";  
      }       
    }
    else
    {
      echo "erro2";
    }
  }
  else
  {
    echo "erro3";
  }
}
?>