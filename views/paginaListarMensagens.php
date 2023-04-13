<?php
include '../base.php';
include_once DIR_BASE.'/dao/contatoDAO.php';
include_once DIR_BASE.'/model/contato.php';
$msgDAO = new ContatoDAO();
$lista = $msgDAO->buscarTodasMensagens();


session_start();
$mensagem = null;
$tipo_alerta = null;
if(isset($_SESSION['msg'])){
	$mensagem = $_SESSION['msg'];
	unset($_SESSION['msg']);

	if ($_SESSION['tipo'] == 'sucesso'){
		$tipo_alerta = "alert-success";
	} else{
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
   	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
   	<link rel="stylesheet" href="../css/styles.css">
   	<title>Sistema</title>
</head>
<body>

<div id='cssmenu'>
<ul>
    <li id="opcaoHome"><a href="javascript:window.location='<?php echo URL_BASE.'/views/index.php';?>'"><span>Home</span></a></li>
   <li id="opcaoProdutos"> <a href="javascript:window.location='<?php echo URL_BASE.'/views/paginaProdutos.php';?>'" ><span>Produtos</span></a></li>
   <li  id="opcaoEmpresa"><a href="javascript:window.location='<?php echo URL_BASE.'/views/paginaEmpresa.php';?>'"><span>Empresa</span></a></li>
   <li  id="opcaoContato" class='last'><a href="javascript:window.location='<?php echo URL_BASE.'/views/paginaFaleConosco.php';?>'"><span>Fale Conosco</span></a></li>
   <li class='active' id="opcaoListarMensagens" class='last'><a href="javascript:window.location='<?php echo URL_BASE.'/views/paginaListarMensagens.php';?>'"><span>Listar Mensagens</span></a></li>
   
</ul>
</div>

<div id="mainContent" style="text-align: center;">
	<h2 class="sub-header" style="padding: 20px;">Lista de Mensagens</h2>
	<br>
	<div class="table-responsive" id="listagem">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome pessoa</th>
					<th>E-mail</th>
					<th>Mensagem</th>
					<th>Resposta</th>
					<th>Operações</th>
				</tr>
			</thead>
			<tbody>
			
			<?php


			for($i=0;$i<count($lista);$i++){
				$contato=$lista[$i];
			?>
			<tr>
				<td><?=$contato->getCodigo()?></td>
				<td><?=$contato->getNome()?></td>
				<td><?=$contato->getEmail()?></td>	
				<td><?=$contato->getMensagem()?></td>
				<td><?=$contato->getResposta()->getDescricao()?></td>
				<?php
					if ($contato->getResposta()->getDescricao() == ""){
						?>
						<td colspan="1" style="text-align: center"><a href="paginaResponder.php?idContato=<?=$contato->getCodigo()?>&nome=<?=$contato->getNome()?>&email=<?=$contato->getEmail()?>&mensagem=<?=$contato->getMensagem()?>">Responder</a></td>	
						<?php
					} else {
						?>
						<td colspan="1" style="text-align: center"><a href="<?php echo URL_BASE.'/controller/excluirResposta.php'?>?idResposta=<?=$contato->getResposta()->getCodigo()?>">Excluir resposta</a></td>
						<?php
					}
				?>
				<td></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>
		<?php
			if($mensagem){
				?>
				<div class="alert <?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
				 <?php echo $mensagem; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

				<?php
			}
		?>


</div>
</div>
</body>
</html>
