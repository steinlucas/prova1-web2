<?php
include_once '../base.php';
include_once DIR_BASE."/dao/conexao.php";
include_once DIR_BASE."/model/resposta.php";

class RespostaDAO {
	protected $conn;

	function __construct() {
		$conexao = new conexao();
		$this->conn = $conexao->getConexao();
	}

	public function inserirResposta($msg) {
		try{
			$this->conn->beginTransaction();

			$comandoSQL='insert into resposta (descricao, id_contato) VALUES (:descricao, :idContato)';
			$stmt = $this->conn->prepare($comandoSQL);
			
            $resultado=$stmt->execute(
				array(
					':descricao' => $msg->getDescricao(),
					':idContato' => $msg->getCodigo()
				)
			);

			$this->conn->commit();

		} catch(PDOException $e) {
			$this->conn->rollback();
			return false;
		}

		return true;
	}

	public function excluirResposta($id) {
		try{
			$comandoSQL='delete from resposta where id = :id';
			$stmt = $this->conn->prepare($comandoSQL);

			$resultado=$stmt->execute(
				array(
					':id' => $id->getCodigo()
				)
			);

		} catch(PDOException $e) {
			return false;
		}

		return true;
	}
}
?>