<?php 
	session_start();
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$idcliente=$_POST['clienteSaida'];
	$idproduto=$_POST['produtoSaida'];
	$quantidade=$_POST['quantEstoque'];
	$quantV=$_POST['quantBaixa'];


	$sql="SELECT numero_loja,cidade 
			from lojas 
			where id_loja='$idcliente'";
	$result=mysqli_query($conexao,$sql);

	$c=mysqli_fetch_row($result);

	$ncliente=$c[1]."-".$c[0];

	$sql="SELECT descricao 
			from produtos
			where id_produto='$idproduto'";
	$result=mysqli_query($conexao,$sql);

	$nomeproduto=mysqli_fetch_row($result)[0];

	$produto=$idproduto."||".
				$nomeproduto."||".
				$ncliente."||".
				$quantidade."||".
				$quantV."||".
				$idcliente;

	$_SESSION['tabelaComprasTemp'][]=$produto;




	//ATUALIZAÇÃO DO ESTOQUE
	$quantNova = $quantidade - $quantV;
	$sqlU = "UPDATE produtos SET quantidade = '$quantNova' where id_produto = '$idproduto' ";
		mysqli_query($conexao,$sqlU);

 ?>