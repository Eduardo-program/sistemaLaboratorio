<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/servicos.php";

$id = $_POST['idservico'];

$obj = new servicos();
echo $obj->excluirServico($id);

?>