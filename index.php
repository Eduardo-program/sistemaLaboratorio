<?php
	require_once "classes/conexao.php";
	
	$obj = new conectar();
	$conexao = $obj->conexao();

	$sql = "SELECT * from usuarios where email='admin@admin.com'";
	$result = mysqli_query($conexao, $sql);

	$validar = 0;
	if(mysqli_num_rows($result) > 0){
		$validar = 1;
	}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Gestão - Laboratório</title>
	<link rel="shortcut icon" href="img/kdebecker.png">
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="lib/alertifyjs/css/alertify.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="js/funcoes.js"></script>
	<script src="lib/alertifyjs/alertify.js"></script>
</head>
<body style="background-color: #B0C4DE">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div align="center" class="panel panel-heading"><b>LABORATORIO DE INFORMÁTICA</b></div>
					<div class="panel panel-body">
						<p>
							<img src="img/cdbkr.jpg"  width="100%">
						</p>
						<form id="frmLogin">
							<label>Email</label>
							<input type="email" class="form-control input-sm" name="email" id="email">
							<label>Senha</label>
							<input type="password" name="senha" id="senha" class="form-control input-sm">
							<p></p>
							<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
	<div align="center">
		<b> Desenvolvido por Eduardo v2.0.0 </b>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){

		vazios=validarFormVazio('frmLogin');

			if(vazios > 0){
				alertify.alert("Login","Preencha todos os campos!");
				return false;
			}

		dados=$('#frmLogin').serialize();
		$.ajax({
			type:"POST",
			data:dados,
			url:"procedimentos/login/login.php",
			success:function(r){
				//alert(r);
				if(r==1){
					window.location="view/inicio.php";
				}else{
					alertify.alert("Login","Acesso Negado, usuário ou senha inválidos!");
				}
			}
		});
	});
	});
</script>