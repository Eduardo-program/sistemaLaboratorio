<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/compras.php";



$obj = new compras();



$dados=array(
	$_POST['idcompraU'],
	$_POST['produtoU'],
	$_POST['prazoU'],
	$_POST['statussU'],
	$_POST['quantidadeU']
	

);

echo $obj->atualizarCompra($dados);

 ?>