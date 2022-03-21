<?php 
	require_once "../../classes/conexao.php";
	require_once "../../classes/saidas.php";

	$objv= new saidas();


	$c= new conectar();
	$conexao=$c->conexao();
	$idsaida=$_GET['idsaida'];

	$sql="SELECT fis.id_saida,
				fis.datasaida,
				fis.quantidade,
				ewq.numero_loja,
				ewq.cidade,
				ewq.cnpj
				from saidas as fis
				inner join lojas as ewq on fis.id_loja=ewq.id_loja
				and fis.id_saida='$idsaida'";

	$result=mysqli_query($conexao,$sql);

	$ver=mysqli_fetch_row($result);

?>	

 	

 	<link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.css">
 			<h1 align="center"> COMPROVATE DE SAIDA DE PRODUTO </h1>
 			<h2 align="center"> LABORATORIO DE INFORMATICA </h2>
 		<table class="table">
 			<tr>
 				<td>Data: <?php echo date("d/m/Y", strtotime($ver[1])) ?> </td>
 			</tr>
 			<tr>
 				<td>Comprovante: <?php echo $ver[0] ?></td>
 			</tr>
 			<tr>
 				<td>Filial: <?php echo $ver[3]." - ".$ver[4]."    CNPJ:".$ver[5] ?></td>
 			</tr>
 		</table>


 		<table class="table">
 			<tr>
 				<td>Codigo Protheus</td>
 				<td>Produto</td>
 				<td>Quantidade</td>
 			</tr>

 			<?php 
 			$sql="SELECT ve.id_saida,
 						ve.quantidade,
				        pro.descricao,
				        pro.codigo_protheus
					from saidas as ve 
					inner join produtos as pro on ve.id_produto=pro.id_produto
					and ve.id_saida='$idsaida'";

			$result=mysqli_query($conexao,$sql);
			$total=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

 			<tr>
 				<td><?php echo $mostrar[3] ?></td>
 				<td><?php echo $mostrar[2] ?></td>
 				<td><?php echo $mostrar[1] ?></td>
 			</tr>
 			<?php
 			endwhile;
 			 ?>
 		</table>
