<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/lojas.php";




$idusuario = $_SESSION['iduser'];



$obj = new lojas();



$dados=array(
	$idusuario,
	$_POST['numloja'],
	$_POST['cidade'],
	$_POST['tipoloja'],
	$_POST['email'],
	$_POST['cnpj'],
	$_POST['cdatendimento']
);

echo $obj->adicionarLoja($dados);

 ?>