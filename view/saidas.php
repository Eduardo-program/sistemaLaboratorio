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
		 <h1>Baixa de Estoque</h1>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<span class="btn btn-default" id="saidaProdutosBtn">Baixar Produto</span>
		 		<span class="btn btn-default" id="saidasFeitasBtn">Lista de Baixas</span>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<div id="saidaProdutos"></div>
		 		<div id="saidasFeitas">

		 			
<?php 

	
	//require_once "vendas/vendasRelatorios.php" 

	?>

		 		</div>
		 	</div>
		 </div>
	</div>
</body>
</html>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#saidaProdutosBtn').click(function(){
				esconderSessaoVenda();
				$('#saidaProdutos').load('saidas/saidasDeProdutos.php');
				$('#saidaProdutos').show();
			});
			$('#saidasFeitasBtn').click(function(){
				esconderSessaoVenda();
				$('#saidasFeitas').load('saidas/saidasRelatorios.php');
				$('#saidasFeitas').show();
			});
		});

		function esconderSessaoVenda(){
			$('#saidaProdutos').hide();
			$('#saidasFeitas').hide();
		}

	</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>