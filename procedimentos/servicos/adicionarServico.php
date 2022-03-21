<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/servicos.php";




$idusuario = $_SESSION['iduser'];



$obj = new servicos();



$dados=array(
	$idusuario,
	$_POST['loja'],
	$_POST['dataini'],
	$_POST['datafim'],
	$_POST['descricao']
);

echo $obj->adicionarServico($dados);

 ?>