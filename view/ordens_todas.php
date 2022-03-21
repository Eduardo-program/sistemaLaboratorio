<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Sistema de Gestão - Laboratório</title>
  		<link rel="shortcut icon" href="../img/kdebecker.png">
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1 align="center" >Ordens de Serviço Pendentes</h1>
			<div class="row">
				<div>
					<div id="tabelaOrdemLoad"></div>
				</div>
			</div>
		</div>
	</body>
	</html>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaOrdemLoad').load("ordens/tabelaOrdens_todas.php");
		});
	</script>
	<?php 
}else{
	header("location:../index.php");
}
?>