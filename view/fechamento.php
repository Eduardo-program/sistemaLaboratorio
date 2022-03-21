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
    $toDay = date('d-m-Y');

    $dbhost =   "localhost";
    $dbuser =   "root";
    $dbpass =   "";
    $dbname =   "estoque";

    exec("mysqldump --user=$dbuser --password='$dbpass' --host=$dbhost $dbname > ../bd/".$toDay."_database.sql");
?>


</body>
</html>

<?php 
} else{
	header("location:../index.php");
}

 ?>