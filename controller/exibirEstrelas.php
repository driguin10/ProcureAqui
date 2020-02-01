<?php

class Estrela 
{
	private $valor;

	public function setValor($val)
	{
		$this->valor = $val;
	}

function media()
{
	$resultado = $this->valor/5;
	if($resultado <= 0)
	{
		return array("","","","","");
	}
	elseif($resultado ==1)
	{
		return array("checked","","","","");
	}
	elseif($resultado ==2)
	{
		return array("","checked","","","");
	}
	elseif($resultado ==3)
	{
		return array("","","checked","","");
	}
	elseif($resultado ==4)
	{
		return array("","","","checked","");
	}
	elseif($resultado >=5)
	{
		return array("","","","","checked");
	}
}

}

?>