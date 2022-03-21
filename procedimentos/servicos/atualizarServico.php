<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/servicos.php";



$obj = new servicos();



$dados=array(
	$_POST['idservicoU'],
	$_POST['lojaU'],
	$_POST['datainiU'],
	$_POST['datafimU'],
	$_POST['descricaoU']
	

);

echo $obj->atualizarServico($dados);

 ?>