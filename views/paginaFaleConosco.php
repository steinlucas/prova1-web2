<?php 
include '../base.php';

session_start();
$mensagem = null;
$tipo_alerta = null;

if(isset($_SESSION['msg'])) {
    $mensagem = $_SESSION['msg'];
    unset($_SESSION['msg']);

    if ($_SESSION['tipo'] == 'sucesso') {
        $tipo_alerta = "alert-success";
    } else {
        $tipo_alerta = "alert-danger";
    }
    unset($_SESSION['tipo']);
}
?>

<!doctype html>
<html lang=''>
<head>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <title>Sistema</title>
</head>
<body>
    <div id='cssmenu'>
        <ul>
            <li id="opcaoHome"><a href="javascript:window.location='<?php echo URL_BASE.'/views/index.php';?>'"><span>Home</span></a></li>
            <li id="opcaoProdutos"><a href="javascript:window.location='<?php echo URL_BASE.'/views/paginaProdutos.php';?>'"><span>Produtos</span></a></li>
            <li id="opcaoEmpresa"><a href="javascript:window.location='<?php echo URL_BASE.'/views/paginaEmpresa.php';?>'"><span>Empresa</span></a></li>
            <li class='active' id="opcaoContato" class='last'><a href="javascript:window.location='<?php echo URL_BASE.'/views/paginaFaleConosco.php';?>'"><span>Fale Conosco</span></a></li>
            <li id="opcaoListarMensagens" class='last'><a href="javascript:window.location='<?php echo URL_BASE.'/views/paginaListarMensagens.php';?>'"><span>Listar Mensagens</span></a></li>
        </ul>
    </div>
    <div id="mainContent">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 mt-4">
                    <h1 class="text-center">Fale Conosco</h1>
                    <form id="formFaleConosco" name="formFaleConosco" class="form-horizontal" method="post" action="<?php echo URL_BASE.'/controller/salvarMensagem.php';?>">
                        <div class="form-group">
                            <label for="bine">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Ex: José da Silva" required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="exemplo@exemplo.com" required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="number" id="telefone" name="telefone" class="form-control" placeholder="(00) 00000-0000" required/>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="mensagem">Mensagem</label>
                            <textarea rows="3" id="mensagem" name="mensagem" class="form-control" placeholder="Mensagem" required></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" id="btnEnviar" class="btn btn-outline-success btn-block pull-right" value="Enviar"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if($mensagem) { ?>
                <div class="alert <?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert"><?php echo $mensagem; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php } ?>
    </div>
</body>
</html>