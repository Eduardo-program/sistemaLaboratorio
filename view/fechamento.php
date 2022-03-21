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
<body style="background-color: #B0C4DE">

	
	<?php
	require_once "../classes/conexao.php";

	$date = date('m-d-Y');

	$command = "mysqldump -uroot estoque > ../bd/database_$date.sql";
	exec($command,$result, $output);

	if($output != 0) {
		echo 'Erro ao realizar backup';
	}else {
		echo 'Database salva com sucesso';
	}

	?>





</body>
</html>

<?php 
} else{
	header("location:../index.php");
}

 ?>