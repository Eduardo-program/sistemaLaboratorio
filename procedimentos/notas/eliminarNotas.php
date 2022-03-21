<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/notas.php";

$id = $_POST['idnota'];

$obj = new notas();
echo $obj->excluirNota($id);

?>