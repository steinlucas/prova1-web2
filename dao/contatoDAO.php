<?php
include_once '../base.php';
@include_once DIR_BASE."/dao/conexao.php";
@include_once DIR_BASE."/model/contato.php";

class ContatoDAO
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

	public function buscarContatoPorCodigo($codigo){
		$comandoSQL = 'select * from contato where codigo = :codigo';
		$stmt = $this->conn->prepare($comandoSQL);

		$resultado = $stmt->execute(array('codigo'=>$codigo));

		$contato = null;

		while ($umRegistro = $stmt->fetch()){
			$msg = new Contato();
			$msg->setCodigo($umRegistro['codigo']);
			$msg->setNome($umRegistro['nome']);
			$msg->setEmail($umRegistro['email']);
			$msg->setTelefone($umRegistro['telefone']);
			$msg->setMensagem($umRegistro['mensagem']);
		}

		return $msg;
	}

	public function inserirContato($msg){
		try{
			$this->conn->beginTransaction();

			$comandoSQL='insert into contato (nome, email, telefone, mensagem)
			VALUES (:nome, :email, :telefone, :mensagem)';
			$stmt = $this->conn->prepare($comandoSQL);
			$resultado=$stmt->execute(array(
				':nome' => $msg->getNome(),
			    ':email' => $msg->getEmail(),
			    ':telefone' => $msg->getTelefone(),
			    ':mensagem' => $msg->getMensagem()));
			$this->conn->commit();
		}catch(PDOException $e){
			$this->conn->rollback();
			
			return false;
		}
		return true;
	}

	public function excluirContato($id){
		try{

			$comandoSQL='delete from contato where codigo = :id';

			$stmt = $this->conn->prepare($comandoSQL);
			$resultado=$stmt->execute(array(
				':id' => $id));
		}catch(PDOException $e){
			return false;
		}
		return true;
	}


}

?>
