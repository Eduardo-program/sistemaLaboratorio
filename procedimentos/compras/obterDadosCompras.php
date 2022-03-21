<?php 

require_once "../../classes/conexao.php";
require_once "../../classes/compras.php";


$obj = new compras();

echo json_encode($obj->obterDadosCompra($_POST['idcompra']));


 ?>

