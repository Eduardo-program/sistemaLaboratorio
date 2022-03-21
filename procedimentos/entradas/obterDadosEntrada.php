<?php 

require_once "../../classes/conexao.php";
require_once "../../classes/entradas.php";


$obj = new entradas();

echo json_encode($obj->obterDadosEntrada($_POST['identrada']));


 ?>

