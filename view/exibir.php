<?php

// por para contar visualização
	include_once("cabecalho-principal.php");
	$tipo = $_GET['type'];
	$id= $_GET['id'];

	include_once("../model/dao.php");
	

	if($tipo == "servico")
	{
		include_once("../controller/controller.servico.php");
  	$obj_serv = new ServicoController();             
    $obj_serv->setId_servico($id);
    $retornoServ = $obj_serv->pesquisaId();
    if($retornoServ) 
    {
        foreach($retornoServ as $dadosServ) 
        {    
        	$idPrestador = $dadosServ->idPrestador;
        	$titulo = $dadosServ->titulo;
        	$descricao = $dadosServ->descricao;
        	$dataPub=$dadosServ->dataPublicacao;
        	$dataTerm="";
        	$imagem = $dadosServ->imagem;
				}

				$obj_serv->addVisualizacao();

				include_once("../controller/controller.prestador.php");
        $obj_prestador = new PrestadorController();
        $obj_prestador->setId_prestador($idPrestador);
        $retornoPrestador = $obj_prestador->busca();
        if($retornoPrestador)
        {
          foreach ($retornoPrestador as $dadosPrest) 
          {
	        	$idPessoa = $dadosPrest->idPessoa;
	        	
	        	include_once("../controller/controller.pessoa.php");
				    $obj_pessoa = new pessoaController();
				    $obj_pessoa->setId_pessoa($idPessoa);           
				    $retornoPessoa = $obj_pessoa->busca();

				     if($retornoPessoa)
				    {       
			        foreach($retornoPessoa as $dadosPes) 
			        {
			        	$idUsuario = $dadosPes->idUsuario;
			        	include_once("../controller/controller.usuario.php");
			          $obj_usuario = new usuarioController();
						    $obj_usuario->setId_usuario($idUsuario);
						    $retornoUsuario = $obj_usuario->busca();
						    if($retornoUsuario)
						    {
					        foreach($retornoUsuario as $dadosUser) 
					        {
					            $email = $dadosUser->email;
					        }	
						    }	 

		            $telefone = $dadosPes->telefone;
		            $idUsuario = $dadosPes->idUsuario;
		            $estado = $dadosPes->estado;
		            $cidade = $dadosPes->cidade;
		            $endereco = $dadosPes->endereco;
		            $numero = $dadosPes->numero;
		            $cep = $dadosPes->cep;

		          }
		        }

	          $nome=$dadosPrest->nomeFantasia;
	          $razaoSocial=$dadosPrest->razaoSocial;
	          $cnpj=$dadosPrest->cnpj;
	          
	          $reputacao=$dadosPrest->reputacao;
        	}
      	}//fim retornoPrestador   
    }// fim retornoServ
	}//fim servico
	elseif($tipo == "oferta")
	{
			include_once("../controller/controller.oferta.php");
			$obj_oferta = new OfertaController();
			$obj_oferta->setId_oferta($id);
		    $retornoOferta = $obj_oferta->busca();
		    if($retornoOferta) 
		    {
		        foreach($retornoOferta as $dados) 
		        {           
	            $titulo = $dados->titulo;
	            $descricao = $dados->descricao;
	            $dataPub = $dados->dataPublicacao;
	            $dataP = explode("-", $dataPub);
	            $dataPub = $dataP[2]."/".$dataP[1]."/".$dataP[0];
	            $dataTerm = $dados->dataTermino;
	            $imagem=$dados->imagem;
	            if(!is_null($dataTerm))
	            {
	            	$dataT = explode("-", $dataTerm);
	            	$dataTerm = $dataT[2]."/".$dataT[1]."/".$dataT[0];
	        		}
		        	else
		        	{
		        		$dataTerm = "Termino indefinido !";
		        	}
		        	$qtVisualizacao = $dados->qtVisualizacao;

		        	$obj_oferta = new OfertaController();
							$obj_oferta->setId_oferta($id);
				    	$retorno = $obj_oferta->addVisualizacao();
				    
		        	$imagem = $dados->imagem;
						}

	        	$idServico = $dados->idServico;
	        	include_once("../controller/controller.servico.php");
	        	$obj_serv = new ServicoController();             
				    $obj_serv->setId_servico($idServico);
				    $retornoServ = $obj_serv->pesquisaId();
				    if($retornoServ) 
				    {
				        foreach($retornoServ as $dados) 
				        {    
				        	$idPrestador = $dados->idPrestador;
								}

								include_once("../controller/controller.prestador.php");
				        $obj_prestador = new PrestadorController();
				        $obj_prestador->setId_prestador($idPrestador);
				        $retornoPrestador = $obj_prestador->busca();
				        if($retornoPrestador)
				        {
				          foreach ($retornoPrestador as $dadosPrest) 
				          {
					        	$idPessoa = $dadosPrest->idPessoa;
					        	
					        	include_once("../controller/controller.pessoa.php");
								    $obj_pessoa = new pessoaController();
								    $obj_pessoa->setId_pessoa($idPessoa);           
								    $retornoPessoa = $obj_pessoa->busca();

								     if($retornoPessoa)
								    {       
							        foreach($retornoPessoa as $dadosPes) 
							        {
							        	$idUsuario = $dadosPes->idUsuario;
							        	include_once("../controller/controller.usuario.php");
							          $obj_usuario = new usuarioController();
										    $obj_usuario->setId_usuario($idUsuario);
										    $retornoUsuario = $obj_usuario->busca();
										    if($retornoUsuario)
										    {
									        foreach($retornoUsuario as $dadosUser) 
									        {
									            $email = $dadosUser->email;
									        }	
										    }	 

						            $telefone = $dadosPes->telefone;
						            $idUsuario = $dadosPes->idUsuario;
						            $estado = $dadosPes->estado;
						            $cidade = $dadosPes->cidade;
						            $endereco = $dadosPes->endereco;
						            $numero = $dadosPes->numero;
						            $cep = $dadosPes->cep;
						          }
						        }

					          $nome=$dadosPrest->nomeFantasia;
					          $razaoSocial=$dadosPrest->razaoSocial;
					          $cnpj=$dadosPrest->cnpj;
					          
					          $reputacao=$dadosPrest->reputacao;
				        	}
				      	}//fim retornoPrestador   
		        }// fim retornoServ
					}// fim retornoOferta
	      }
elseif($tipo == "prestador")
{
				include_once("../controller/controller.prestador.php");
        $obj_prestador = new PrestadorController();
        $obj_prestador->setId_prestador($id);
        $retornoPrestador = $obj_prestador->busca();
        if($retornoPrestador)
        {
          foreach ($retornoPrestador as $dadosPrest) 
          {
	        	$idPessoa = $dadosPrest->idPessoa;
	        	
	        	include_once("../controller/controller.pessoa.php");
				    $obj_pessoa = new pessoaController();
				    $obj_pessoa->setId_pessoa($idPessoa);           
				    $retornoPessoa = $obj_pessoa->busca();

				     if($retornoPessoa)
				    {       
			        foreach($retornoPessoa as $dadosPes) 
			        {
			        	$idUsuario = $dadosPes->idUsuario;
			        	include_once("../controller/controller.usuario.php");
			          $obj_usuario = new usuarioController();
						    $obj_usuario->setId_usuario($idUsuario);
						    $retornoUsuario = $obj_usuario->busca();
						    if($retornoUsuario)
						    {
					        foreach($retornoUsuario as $dadosUser) 
					        {
					            $email = $dadosUser->email;
					        }	
						    }	 

		            $telefone = $dadosPes->telefone;
		            $idUsuario = $dadosPes->idUsuario;
		            $estado = $dadosPes->estado;
		            $cidade = $dadosPes->cidade;
		            $endereco = $dadosPes->endereco;
		            $numero = $dadosPes->numero;
		            $cep = $dadosPes->cep;
		          }
		        }

	          $nome=$dadosPrest->nomeFantasia;
	          $razaoSocial=$dadosPrest->razaoSocial;
	          $cnpj=$dadosPrest->cnpj;
	          $imagem=$dadosPrest->imagem;
	          $reputacao=$dadosPrest->reputacao;
        	}
      }
}

?>
<link href="/procureaqui/view/css/stilo-pesquisa.css" rel="stylesheet" media="all">

<?php


if($tipo != "prestador")
{
	include_once("exibirServOferta.php");
}
else
{
	include_once("exibirPrestador.php");
}

?>


 <script src="/procureaqui/view/frameworks/bootstrap/js/jquery.min.js"></script>
 <script src="/procureaqui/view/frameworks/bootstrap/js/bootstrap.min.js"></script>
 <script src="/procureaqui/view/frameworks/sweetalert-master/dist/sweetalert.min.js"></script>
 <script src="/procureaqui/view/frameworks/bootstrap-select/js/bootstrap-select.min.js"></script>
 <script src="/procureaqui/view/js/scripts.js"></script>
 <script src="/procureaqui/view/js/scriptExibir.js"></script>

<?php
//include_once("rodape-principal.php");
?>