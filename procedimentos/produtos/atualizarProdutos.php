<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/produtos.php";



$obj = new produtos();



$dados=array(
	$_POST['idprodutoU'],
	$_POST['categoriaSelectU'],
	$_POST['descricaoU'],
	$_POST['quantidadeU'],
	$_POST['precoU'],
	$_POST['codigo_protheusU']

);

echo $obj->atualizarProduto($dados);

 ?>