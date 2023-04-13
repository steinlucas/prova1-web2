<?php
    include_once '../base.php';
    include_once DIR_BASE.'/dao/respostaDAO.php';
    include_once DIR_BASE.'/model/resposta.php';
    
    $idContato = $_POST['idContato'];
    $mensagem = $_POST['resposta'];
    
    $msg = new Resposta();
    $msg->setCodigo($idContato);
    $msg->setDescricao($mensagem);
    
    $msgDAO = new RespostaDAO();
    $resultado = $msgDAO->inserirResposta($msg);
          
    session_start();
    $_SESSION['msg'] = "Erro ao salvar mensagem!";
    $_SESSION['tipo'] = 'erro'; 

    if($resultado == true) {
        $_SESSION['msg'] = "Mensagem enviada com Sucesso!";
        $_SESSION['tipo'] = 'sucesso'; 
    }

    header('location: '.URL_BASE.'/views/paginaFaleConosco.php');