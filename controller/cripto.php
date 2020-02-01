<?php
/**
Criado por Rodrido lOL
**/
class Cifra {
	
		function cifrar($palavra,$chave)
		{
			$cifra = $palavra;
			for($i = 0 ; $i<$chave ; $i++)
			{
				$cifra = base64_encode($cifra);
			}
			return $cifra;
		}

		function decifrar($palavra,$chave)
		{
			$cifra = $palavra;
			for($i = 0 ; $i<$chave ; $i++)
			{
				$cifra = base64_decode($cifra);
			}
			return $cifra;
		}
}

?>