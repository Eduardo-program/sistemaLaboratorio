<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/produtos.php";

$id = $_POST['idproduto'];

$obj = new produtos();
echo $obj->excluirProduto($id);

?>