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
     header("location:../procureaqui/");   
 }
else
{ 
    include_once("../model/dao.php");
    include_once("../controller/controller.usuario.php");
    include_once("../controller/controller.pessoa.php");
    include_once("../controller/controller.assinatura.php");
    $obj_usuario = new usuarioController();
    $obj_usuario->setEmail($_SESSION['email']);
    $obj_usuario->setSenha($_SESSION['senha']);
    $retornoUsuario = $obj_usuario->retornaUsuario();
    if($retornoUsuario)
    {
      
        foreach($retornoUsuario as $dados) 
        {
            $id = $dados->idUsuario; /// pega o id do usuario que esta logado para pegar os dados do cadastro 
            $email = $dados->email;
        }
        
        $obj_pessoa = new pessoaController();
        $obj_pessoa->setId_usuario($id);
        $retornoPessoa = $obj_pessoa->buscaPessoaPuser();

        if($retornoPessoa)
        {
            foreach($retornoPessoa as $dados) 
            {
                 $id_pessoa = $dados->idPessoa;
                 $id_usuario = $dados->idUsuario;
                 $estado = $dados->estado;
                 $cidade = $dados->cidade;
                 $nome = $dados->nome;
                 $cpf = $dados->cpf;
                 $telefone = $dados->telefone;
                 $endereco = $dados->endereco;
                 $cep = $dados->cep;
                 $numero = $dados->numero;
                 $Pacesso = $dados->pAcesso;

                  $obj_assinatura = new AssinaturaController();
                  $obj_assinatura->setId_pessoa($id_pessoa);
                  $retornoAssinatura = $obj_assinatura->pesquisa();
                  if($retornoAssinatura)
                  {
                    foreach ($retornoAssinatura as $dados) {
                      $assinatura = $dados->idConta;
                      $pago = $dados->pago;
                      $dataAssinatura = $dados->dataAssinatura;
                      $dataVencimento = $dados->dataVencimento;
                    }
                  }
            }
            
        }

        include_once("../controller/controller.prestador.php");
        $obj_prestador = new PrestadorController();
        $obj_prestador->setId_pessoa($id_pessoa);
        $retornoPrestador = $obj_prestador->pesquisaPessoa();
        if($retornoPrestador)
        {
          foreach ($retornoPrestador as $dados) {
            $idPrestador = $dados->idPrestador;
            $nomeFantasia=$dados->nomeFantasia;
            $razaoSocial=$dados->razaoSocial;
            $cnpj=$dados->cnpj;
            $imagem=$dados->imagem;
            $reputacao=$dados->reputacao;
          }
        }
    } 
    else
    {
     header("location:/procureaqui/");//caso não acha o usuario e senha redireciona para tela inicial
    }
}

?>


<!DOCTYPE html>

<html>
<head>
    
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscaPrest</title>
    <link href="/procureaqui/view/frameworks/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="/procureaqui/view/frameworks/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" media="all">
    <link href="/procureaqui/view/css/stilodashboard.css" rel="stylesheet" media="all">
   
    <link rel="stylesheet" href="/procureaqui/view/frameworks/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/procureaqui/view/frameworks/FormHelpers/dist/css/bootstrap-formhelpers.min.css">
    <link rel="stylesheet" type="text/css" href="/procureaqui/view/frameworks/sweetalert-master/dist/sweetalert.css">
    

    <script>
    function formatarCpf(mascara, documento){
      var i = documento.value.length;
      var saida = mascara.substring(0,1);
      var texto = mascara.substring(i)
  
      if (texto.substring(0,1) != saida){
        documento.value += texto.substring(0,1);
      }  
    }

    function formatarCnpj(mascara, documento){
      var i = documento.value.length;
      var saida = mascara.substring(0,1);
      var texto = mascara.substring(i)
  
      if (texto.substring(0,1) != saida){
        documento.value += texto.substring(0,1);
      }  
    }
  </script>
    
</head>


<body data-spy="scroll" data-target=".menu-navegacao" data-offset="80">
    <div class="navegador">
        <nav class="navbar navbar-inverse navbar-fixed-top" id="na">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      
                    </button>
                    <!-- 432x70-->
                    <a class="navbar-brand" href="/procureaqui/"><img src="/procureaqui/view/img/logo-topo.png" alt="Procure Aqui">
                    </a>
                </div>
                <div id="navbar3" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        
                        
                        
                        
                        <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle menu" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $nome; ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class='menu'  href='#' data-toggle='modal' data-target='#modal-edit-prestador'><span class='glyphicon glyphicon-user' aria-idden='true'></span> Meus dados</a></li>
                                    
                                    <!-- #modal-editBasico -->
                                    <li role="separator" class="divider"></li>
                                    <li><a class="bt-encerraConta" id=<?php echo "'$id_pessoa'"; ?> href="#"><span class='glyphicon glyphicon-trash' aria-idden='true'></span> Encerrar conta</a></li>
                                    <li><a href="/procureaqui/logout"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Sair</a></li>
                                </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>