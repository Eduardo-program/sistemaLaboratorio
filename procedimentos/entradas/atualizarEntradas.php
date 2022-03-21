<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/notas.php";



$obj = new notas();



$dados=array(
	$_POST['idnotaU'],
	$_POST['numeronotaU'],
	$_POST['produtoSelectU'],
	$_POST['fornecedorSelectU'],
	$_POST['quantidadeU'],
	$_POST['precoU']
	

);

echo $obj->atualizarNota($dados);

 ?>