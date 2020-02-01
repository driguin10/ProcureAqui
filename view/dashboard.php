<?php
    include_once("dashboard-cabecalho.php");

    date_default_timezone_set('America/Sao_Paulo');
    $dataHoje = date('Y-m-d');	

	if($Pacesso == 1)
	{
	    include_once("dashboard-bemvindo.php");
	}
	else
	{
		if($assinatura ==  1 && $pago == 1)
		{
			include_once("dashboard-principal.php");
		}
		else
		{
			if( strtotime($dataHoje) > strtotime($dataVencimento))
			{	
				include_once("../controller/controller.assinatura.php"); 
				$obj_assinatura = new AssinaturaController();
        $obj_assinatura->setId_pessoa($id_pessoa);
        $obj_assinatura->setId_conta(1); // conta basica
        $obj_assinatura->setPago(0);
        $retornoo = $obj_assinatura->alterarConta();

        include_once("../controller/controller.servico.php");
        $obj_servico = new ServicoController();
				$obj_servico->setId_prestador($idPrestador);
				$retornoServico = $obj_servico->pesquisaPessoa();
				if($retornoServico)
				{
			    foreach ($retornoServico as $dadosServico) 
			    {
			    	include_once("../controller/controller.oferta.php");
            $obj_oferta = new OfertaController();
            $obj_oferta->setId_servico($dadosServico->idServico);
            $retonoOferta = $obj_oferta->buscaServico();
            if($retonoOferta)
            {
              foreach ($retonoOferta as $dadosOferta) 
              {
                $obj_oferta->setId_oferta($dadosOferta->idOferta);
            		$obj_oferta->alteraVisivel0();    
              }
            }
	           
            $obj_servico->setId_servico($dadosServico->idServico);
            $servFirst = $obj_servico->getFirstId();
         			if($servFirst)
         			{
            		foreach ($servFirst as $dat) {
            			$idFirst = $dat->idServico;
            		}
         			}
            
            $obj_servico->setFirst($idFirst);
						$teste = $obj_servico->alteraVisivel0();	
			    }
			  }

				$obj_prestador = new PrestadorController();
				$obj_prestador->setId_prestador($idPrestador);
				$obj_prestador->alteraVisivel0();
				$FlagVencimento="Atenção !! sua licença está vencida";
				include_once("dashboard-principal.php");
			}
			elseif ( strtotime($dataHoje) == strtotime($dataVencimento)) 
			{
				$FlagVencimento = "Atenção !! sua conta vence amanhã";
				include_once("dashboard-principal.php");
			}	
			else
			{
				include_once("dashboard-principal.php");
			}		
		}
	}
	//include_once("dashboard-rodape.php");
?>
