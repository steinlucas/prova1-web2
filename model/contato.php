<?php
include_once '../base.php';
include_once DIR_BASE.'/model/resposta.php';

class Contato {
	private $codigo;
	private $nome;
	private $email;
	private $telefone;
	private $mensagem;
	private Resposta $resposta;

	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}

	public function getCodigo() {
		return $this->codigo;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}	

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}

	public function getTelefone() {
		return $this->telefone;
	}

	public function setMensagem($mensagem) {
		$this->mensagem = $mensagem;
	}

	public function getMensagem() {
		return $this->mensagem;
	}
	
	public function setResposta($resposta) {
		$this->resposta = $resposta;
	}

	public function getResposta() {
		return $this->resposta;
	}
}
?>