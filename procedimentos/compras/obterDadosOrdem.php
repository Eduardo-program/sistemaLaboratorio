<?php 

require_once "../../classes/conexao.php";
require_once "../../classes/ordens.php";


$obj = new ordens();

echo json_encode($obj->obterDadosOrdem($_POST['idordem']));


 ?>

