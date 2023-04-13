<?php
    include_once '../base.php';
    include_once DIR_BASE.'/dao/contatoDAO.php';
    include_once DIR_BASE.'/model/contato.php';
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['mensagem'];
    
    $msg = new Contato();
    $msg->setNome($nome);
    $msg->setEmail($email);
    $msg->setTelefone($telefone);
    $msg->setMensagem($mensagem);
    
    $msgDAO = new ContatoDAO();
    $resultado = $msgDAO->inserirContato($msg);
          
    session_start();
    $_SESSION['msg'] = "Erro ao salvar mensagem!";
    $_SESSION['tipo'] = 'erro'; 

    if($resultado == true) {
        $_SESSION['msg'] = "Mensagem enviada com Sucesso!";
        $_SESSION['tipo'] = 'sucesso'; 
    }

    header('location: '.URL_BASE.'/views/paginaFaleConosco.php');