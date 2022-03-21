<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/ordens.php";




$idusuario = $_SESSION['iduser'];



$obj = new ordens();



$dados=array(
	$idusuario,
	$_POST['cliente'],
	$_POST['produto'],
	$_POST['prazo'],
	$_POST['observacao'],
	$_POST['statuss']
);

echo $obj->adicionarOrdem($dados);

 ?>