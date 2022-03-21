<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/entradas.php";


$obj = new entradas();



$dados=array(
	$_POST['observacao'],
	$_POST['produtoSelect'],
	$_POST['quantidade']

);



echo $obj->adicionarEntrada($dados);

 ?>