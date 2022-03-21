<?php 

require_once "../../classes/conexao.php";
require_once "../../classes/notas.php";


$obj = new notas();

echo json_encode($obj->obterDadosNota($_POST['idnota']));


 ?>

