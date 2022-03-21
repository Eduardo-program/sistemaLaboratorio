<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/ordens.php";

$id = $_POST['idordem'];

$obj = new ordens();
echo $obj->encerrarOrdem($id);

?>