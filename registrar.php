<?php
	require_once "classes/conexao.php";
	$obj = new conectar();
	$conexao = $obj->conexao();

	$sql = "SELECT count(*) from usuarios";
	$result = mysqli_query($conexao, $sql);

	$validar = 0;
	if(mysqli_num_rows($result) > 0){
		header("location:index.php");
	}

	session_start();
	if(isset($_SESSION['usuario'])){

?>


 <!DOCTYPE html>
<html>
<head>
	<title>Sistema de Gestão - Laboratório</title>
	<link rel="shortcut icon" href="img/kdebecker.png">
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="js/funcoes.js"></script>
	

</head>
<body style="background-color: #B0C4DE">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div align="center" class="panel panel-heading">CADASTRAR NOVO USUÁRIO</div>
					<div class="panel panel-body">
						<form id="frmRegistro">
							<label>Nome</label>
							<input type="text" class="form-control input-sm" name="nome" id="nome">
							<label>Usuário</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Email</label>
							<input type="text" class="form-control input-sm" name="email" id="email">
							<label>Senha</label>
							<input type="password" class="form-control input-sm" name="senha" id="senha">
							<p></p>
							<span class="btn btn-primary" id="registro">Registrar</span>
							<a href="index.php" class="btn btn-danger">Tela Login</a>
							<a href="view/inicio.php" class="btn btn-success">Home</a>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>

<?php 
} else{
	header("location:index.php");
}

?>




<script type="text/javascript">
	$(document).ready(function(){
		$('#registro').click(function(){

			vazios=validarFormVazio('frmRegistro');

			if(vazios > 0){
				alert("Preencha todos os Campos!");
				return false;
			}

			dados=$('#frmRegistro').serialize();
			
			$.ajax({
				type:"POST",
				data:dados,
				url:"procedimentos/login/registrarUsuario.php",
				success:function(r){
					//alert(r);

					if(r==1){
						alert("Inserido com Sucesso!");
					}else{
						alert("Erro ao Inserir!");
					}
				}
			});
		});
	});
</script>
