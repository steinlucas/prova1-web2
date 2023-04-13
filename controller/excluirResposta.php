<?php
    include_once '../base.php';
    include_once DIR_BASE.'/dao/respostaDAO.php';
    include_once DIR_BASE.'/model/resposta.php';
    
    $idResposta = $_GET['idResposta'];
    
    $resposta = new Resposta();
    $resposta->setCodigo($idResposta);
    
    $msgDAO = new RespostaDAO();
    $resultado = $msgDAO->excluirResposta($resposta);
          
    session_start();
    $_SESSION['msg'] = "Erro ao excluir resposta!";
    $_SESSION['tipo'] = 'erro'; 

    if($resultado == true){
        $_SESSION['msg'] = "Resposta excluída com Sucesso!";
    $_SESSION['tipo'] = 'sucesso'; 
    }

    header('location: '.URL_BASE.'/views/paginaFaleConosco.php');
