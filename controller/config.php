<?php //**************** configurações  ***************

	class Config
	{
		// quantidade de ofertas da semana na pagina inicial
		protected $qtRegistros = 4;
		function getQtRegistros()
		{
			return $this->qtRegistros;
		}//**************************************************


		
		function pathImagem($path)
		{
			$cam = trim($path,"/procureaqui");
	    $cam = trim($cam,"view");
	    $cam = trim($cam,"/");
	    return $cam;
		}


	}

?>