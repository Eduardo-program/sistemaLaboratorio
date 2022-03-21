
<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Gestão - Laboratório</title>
  	<link rel="shortcut icon" href="../img/kdebecker.png">
	<?php 
	    $idusuario = $_SESSION['iduser'];
	    require_once "../classes/conexao.php"; 
	    $c= new conectar();
	    $conexao=$c->conexao();

	    $sql = "SELECT funcao from usuarios where id = '$idusuario'";
	    $result = mysqli_query($conexao, $sql);
	    $mostrar=mysqli_fetch_row($result);
		
		if( $mostrar[0] == "Técnico I"){
			require_once "menu_tecnico_i.php";
		}else{
			require_once "menu.php";
		}
	?>
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
		function encerrarOrdem(idordem){
			alertify.confirm('Deseja Finalizar esta ordem?', function(){ 
				$.ajax({
					type:"POST",
					data:"idordem=" + idordem,
					url:"../procedimentos/ordens/encerrarOrdens.php",
					success:function(r){


						if(r==1){
							$('#tabelaOrdemLoad').load("ordens/tabelaOrdens_encerrar.php");
							alertify.success("Finalizada com sucesso!!");
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

			$('#tabelaOrdemLoad').load("ordens/tabelaOrdens_encerrar.php");
		});
	</script>
<?php 
} else{
	header("location:../index.php");
}

 ?>
