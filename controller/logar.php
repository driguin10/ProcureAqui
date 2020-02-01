<?php
include_once("../model/dao.php");
include_once("controller.usuario.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

//--------- cifra a senha do usuario----------------
include_once("../controller/cripto.php");
$Cifra = new Cifra();
$senha= $Cifra->cifrar($senha,3);
//--------------------------------------------------


$obj_usuario = new usuarioController();
$obj_usuario->setEmail($email);
$obj_usuario->setSenha($senha);
$retornoUsuario = $obj_usuario->retornaUsuario();

if($retornoUsuario)
{
  foreach($retornoUsuario as $dados) 
  {
      $id = $dados->idUsuario;
  }
  session_start();
  $_SESSION['email'] = $email;
  $_SESSION['senha'] = $senha;
  $_SESSION['idUsuario'] = $id;
  $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
  header("Location:/procureaqui/"); 
}
else
{
  header("Location:/procureaqui/login");
}
// verifica se possui o email no banco e se email ja foi confirmado
?>