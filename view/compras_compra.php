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
			<h1 align="center" >Ordens de Compra Pendentes para Compra</h1>
			<div class="row">
				<div>
					<div id="tabelaCompraLoad"></div>
				</div>
			</div>
		</div>
	</body>
	</html>

	<script type="text/javascript">
		function compraCompra(idcompra){
			alertify.confirm('Deseja Confirmar Compra desta ordem?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcompra=" + idcompra,
					url:"../procedimentos/compras/compraCompras.php",
					success:function(r){


						if(r==1){
							$('#tabelaCompraLoad').load("compras/tabelaCompras_compra.php");
							alertify.success("Confirmado com sucesso!!");
						}else{
							alertify.error("Não foi possível finalizar");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaCompraLoad').load("compras/tabelaCompras_compra.php");
		});
	</script>
	<?php 
}else{
	header("location:../index.php");
}
?>