<?php 

session_start();
require_once "../../classes/conexao.php";
require_once "../../classes/notas.php";


$obj = new notas();



$dados=array(
	$_POST['numeronota'],
	$_POST['produtoSelect'],
	$_POST['fornecedorSelect'],
	$_POST['quantidade'],
	$_POST['preco']

);



echo $obj->adicionarNota($dados);

 ?>