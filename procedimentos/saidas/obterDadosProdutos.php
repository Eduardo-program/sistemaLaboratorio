<?php 
	
	require_once "../../classes/conexao.php";
	require_once "../../classes/saidas.php";

	$obj= new saidas();

	echo json_encode($obj->obterDadosProduto($_POST['idproduto']));

 ?>