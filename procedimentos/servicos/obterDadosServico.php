<?php 

require_once "../../classes/conexao.php";
require_once "../../classes/servicos.php";


$obj = new servicos();

echo json_encode($obj->obterDadosServico($_POST['idservico']));


 ?>

