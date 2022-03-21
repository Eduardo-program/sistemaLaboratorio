<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/compras.php";




$idusuario = $_SESSION['iduser'];



$obj = new compras();



$dados=array(
	$idusuario,
	$_POST['produto'],
	$_POST['prazo'],
	$_POST['statuss'],
	$_POST['quantidade']
);

echo $obj->adicionarCompra($dados);

 ?>