<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/lojas.php";



$obj = new lojas();



$dados=array(
	$_POST['idlojaU'],
	$_POST['numlojaU'],
	$_POST['cidadeU'],
	$_POST['tplojaU'],
	$_POST['emailU'],
	$_POST['cnpjU'],
	$_POST['cdatendimentoU']
	

);

echo $obj->atualizarLoja($dados);

 ?>