<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/entradas.php";

$id = $_POST['identrada'];

$obj = new entradas();
echo $obj->excluirEntrada($id);

?>