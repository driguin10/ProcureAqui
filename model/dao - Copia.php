<?php
	class Dao {
		private $servidor 	= "localhost";
		private $usuario 	= "root";
		private $senha 		= "3850";
		private $nome_banco = "procureaqui";
		private $conexao;
		private $resultado;
		private $sql;
		
		private function __construct() {}
		
		public function openConn() 
    {
			$this->conexao = new mysqli($this->servidor,$this->usuario, $this->senha, $this->nome_banco);
				
			if ($this->conexao->connect_errno) 
      {
				printf("E-BANCO", $this->conexao->connect_error);
				die;
			}
		}
        
		public function closeConn() {
			return $this->conexao->close();
		}
		
		public function execute($sql) {
			$this->openConn(); 
			$retorno = $this->conexao->query($sql);
			$this->closeConn(); 
			
			return $retorno;
		}
		
		public function executeS($sql) 
    {
			$this->openConn(); 
			$retorno = $this->conexao->query($sql); 
			
			if ($retorno) 
      { 
				$array_dados = array();
				while($objeto = $retorno->fetch_object()) 
        {
					$array_dados[] = $objeto;					
				}
				$this->closeConn();       
				return $array_dados;
			} 
      else 
      { 
				$this->closeConn();
				return false;
			}
		}

		public static function getInstancia() 
    {
			return new Dao();
		}
	}
	
?>