<?php 
	session_start();
	require_once "../../classes/conexao.php";
	require_once "../../classes/saidas.php";
	$c= new conectar();
	
	$obj= new saidas();

	

	if(count($_SESSION['tabelaComprasTemp'])==0){
		echo 0;
	}else{
		$result=$obj->criarSaida();
		unset($_SESSION['tabelaComprasTemp']);
		echo $result;
	}
 ?>