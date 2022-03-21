<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/lojas.php";

$id = $_POST['idloja'];

$obj = new lojas();
echo $obj->excluirLoja($id);

?>