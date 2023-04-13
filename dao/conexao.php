<?php
	class Conexao{
		private $_conn;
		
		function __construct() {
			$this->_conn = new PDO("mysql:host=localhost;dbname=faleconosco","root","");
			$this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		public function getConexao() {
			return $this->_conn;
		}
	}
?>