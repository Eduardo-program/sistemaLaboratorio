<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/compras.php";

$id = $_POST['idcompra'];

$obj = new compras();
echo $obj->recebeCompra($id);

?>