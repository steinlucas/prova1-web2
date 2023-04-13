<?php
include_once '../base.php';
@include_once DIR_BASE."/dao/conexao.php";
@include_once DIR_BASE."/model/contato.php";
@include_once DIR_BASE."/model/resposta.php";

class RespostaDAO
{
	protected $conn;

	function __construct()
	{
		$conexao = new conexao();

		$this->conn = $conexao->getConexao();
	}

	public function buscarTodasMensagens(){
		$comandoSQL = 'select contato.*, resposta.id as id_resposta, resposta.descricao as descricao_resposta from contato left join resposta on resposta.id_contato = contato.id order by resposta.descricao is null desc, contato.id asc';

		$resultado = $this->conn->query ($comandoSQL);
		
		$arrayMsgs = array();
		foreach ($resultado as $umRegistro) {
			$msg = new Contato();
			$msg->setCodigo($umRegistro['id']);
			$msg->setNome($umRegistro['nome']);
			$msg->setEmail($umRegistro['email']);
			$msg->setTelefone($umRegistro['telefone']);
			$msg->setMensagem($umRegistro['mensagem']);
			$resposta = new Resposta();
			$resposta->setCodigo($umRegistro['id_resposta']);
			$resposta->setDescricao($umRegistro['descricao_resposta']);
			$msg->setResposta($resposta);
			array_push($arrayMsgs, $msg);
		}
		return $arrayMsgs;
	}

	public function inserirResposta($msg){
		try{
			$this->conn->beginTransaction();

			$comandoSQL='insert into resposta (descricao, id_contato)
			VALUES (:descricao, :idContato)';

			$stmt = $this->conn->prepare($comandoSQL);
			
            $resultado=$stmt->execute(array(
				':descricao' => $msg->getDescricao(),
			    ':idContato' => $msg->getCodigo()));

			$this->conn->commit();
		}catch(PDOException $e){
			$this->conn->rollback();
			return false;
		}
		return true;
	}

	public function excluirResposta($id){
		try{

			$comandoSQL='delete from resposta where id = :id';

			$stmt = $this->conn->prepare($comandoSQL);

			$resultado=$stmt->execute(array(
				':id' => $id->getCodigo()));

		}catch(PDOException $e){
			return false;
		}
		return true;
	}
}

?>
