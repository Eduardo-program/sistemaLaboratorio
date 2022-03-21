<?php 

require_once "../../classes/conexao.php"; 

$i = 1000;
$x = 9999;

$c = new conectar();
$conexao=$c->conexao();

while($i <= $x){
    $sql = "INSERT into estoque_produto (id_produto, quantidade) VALUES ($i, 0)";

    mysqli_query($conexao, $sql);

    $i++;
}
?>