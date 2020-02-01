<?php  
ini_set( 'session.use_only_cookies', TRUE ); //força o PHP a gerenciar o ID da sessão somente com um cookie, para que seu script nunca considere $ _GET ['PHPSESSID'] como válido
ini_set( 'session.use_trans_sid', FALSE );// excluí explicitamente session.use_trans_sid, para evitar a fuga do ID da sessão em todas as URI retornadas na primeira resposta.

session_start(); 


// prevenção contra hijacking session 

if (isset($_SESSION['HTTP_USER_AGENT']))
{
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
    {
      session_regenerate_id(); // regenera a sessão do navegador
      session_destroy(); // Destrói a sessão limpando todos os valores salvos
      header("Location: /procureaqui/"); exit; // Redireciona o visitante
    }
}
else
{
    $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
}
//----------------------------------------------------------------------------

if((!isset ($_SESSION['email'])) and (!isset ($_SESSION['senha'])))
{
	unset($_SESSION['email']);
	unset($_SESSION['senha']);
  $logado=false;
  session_regenerate_id();
}
else
{
  include_once("../model/dao.php");
  include_once("../controller/controller.pessoa.php");
  $obj_pessoa = new pessoaController();
  $obj_pessoa->setId_usuario($_SESSION['idUsuario']);           
  $retornoPessoa = $obj_pessoa->buscaPessoaPuser();

   if($retornoPessoa)
  {        
    foreach($retornoPessoa as $dados) 
    {
      $nomeUsuario = $dados->nome;
      $idUsuario = $dados->idPessoa;
      $idPessoa = $dados->idPessoa;
    }  
    $nomeAbre =explode(" ", $nomeUsuario);
  }
  else
  {
    echo "erro ao pesquisar";                 
  } 
  $logado = true; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProcureAqui</title>
    <link href="/procureaqui/view/frameworks/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="/procureaqui/view/frameworks/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" media="all">
    <link href="/procureaqui/view/css/stilo.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/procureaqui/view/css/font-awesome.min.css">
    <link rel="stylesheet" href="/procureaqui/view/frameworks/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/procureaqui/view/frameworks/sweetalert-master/dist/sweetalert.css">
</head>

<body data-spy="scroll" data-target=".menu-navegacao" data-offset="80">
  <div class="navegador">
    <nav class="navbar navbar-inverse navbar-fixed-top" id="nav-new">
      <div class="container">
           
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarCabecalho">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                
                <?php  
                  if($logado)
                    echo "<span class='icon-bar'></span>"; 
                ?>
                <span class="icon-bar"></span>
            </button>   
            <a class="navbar-brand" href="/procureaqui/"><img src="/procureaqui/view/img/logo-topo.png" alt="Procure Aqui"></a>
          </div>
 
          <div id="navbarCabecalho" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a id="me" class="ofertas menu" href="/procureaqui/#ofertas"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span> Ofertas</a></li>

                  <li><a class="topPrestadores menu" href="/procureaqui/#topPrestadores"><span class="glyphicon glyphicon-oil" aria-hidden="true"></span> Prestadores</a></li>
            <?php  
              if($logado)
              {
                  echo "<li role='presentation' class='Fav dropdown' id='$idUsuario'>
                  <a class='dropdown-toggle menu' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-star' aria-hidden='true'></span> Favoritos<span class='caret'></span>
                  </a>
                  <ul class='drop-fav dropdown-menu'>    
                  </ul>
                </li>";
                  
                  echo "<li role='presentation' class='dropdown'>
                  <a class='dropdown-toggle menu menu-user' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-user' aria-hidden='true'></span>  $nomeUsuario<span class='caret'></span>
                  </a>
                  <ul class='dropdown-menu'>
                      <li><a href='/procureaqui/dashboard' id='".$idPessoa."' class='bt-AreaAdm'><span class='glyphicon glyphicon-briefcase' aria-hidden='true'></span> Área Administrativa</a></li>
                      
                       
                      <li role='separator' class='divider'></li>
                      <li><a href='/procureaqui/logout'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Sair</a></li>
                  </ul>
                </li>";
              }
              else
              {  
                echo "<li><a class='menu' href='/procureaqui/login'><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Área Administrativa</a></li>";  
              }
          ?>
            </ul>
          </div>
        </div>
    </nav>
</div>