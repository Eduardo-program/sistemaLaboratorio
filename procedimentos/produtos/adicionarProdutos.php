<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/produtos.php";




$idusuario = $_SESSION['iduser'];



$obj = new produtos();



$dados=array(
	$idusuario,
	$_POST['categoriaSelect'],
	$_POST['descricao'],
	$_POST['quantidade'],
	$_POST['preco'],
	$_POST['codigo_protheus']
);

echo $obj->adicionarProduto($dados);

 ?>