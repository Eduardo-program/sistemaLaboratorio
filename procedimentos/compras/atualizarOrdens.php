<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/ordens.php";



$obj = new ordens();



$dados=array(
	$_POST['idordemU'],
	$_POST['clienteU'],
	$_POST['produtoU'],
	$_POST['prazoU'],
	$_POST['observacaoU'],
	$_POST['statussU']
	

);

echo $obj->atualizarOrdem($dados);

 ?>