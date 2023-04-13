<?php

	class Conexao{
		
		private $_conn;
		
		function __construct(){
			//mysql://[USUARIO]:[PASSWORD]@[HOST]/[NOME DO BANCO]
			$this->_conn = new PDO("mysql:host=localhost;dbname=faleconosco","root","aluno");//	
			$this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		public function getConexao(){
			return $this->_conn;
		}
	}

	// TESTE DE CONEXAO, DEVE APARECER: object(PDO)#2 (0) { } 
	/* 
	$conexao = new Conexao();
	$con = $conexao->getConexao();
	die(var_dump($con));
	*/
	

?>
