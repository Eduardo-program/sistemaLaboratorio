<?php 

require_once "../../classes/conexao.php";
require_once "../../classes/lojas.php";


$obj = new lojas();

echo json_encode($obj->obterDadosLoja($_POST['idloja']));


 ?>

