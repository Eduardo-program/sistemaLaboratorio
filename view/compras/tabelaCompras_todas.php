<?php 


require_once "../../classes/conexao.php";
	$c = new conectar();
	$conexao=$c->conexao();

	$sql = "SELECT isf.id_compra, 
					isf.data_lancamento, 
					isf.data_cotacao, 
					isf.data_compra,
					isf.data_recebimento,
					isf.status,
					isf.prazo, 
					isf.id_produto,  
					isf.quantidade,
					isf.id_user,
					orp.descricao,
					qwe.nome
	from compras as isf 
	inner join produtos as orp on isf.id_produto=orp.id_produto
	inner join usuarios as qwe on isf.id_user=qwe.id
	where isf.status='Confirma Recebimento'";

	$result = mysqli_query($conexao, $sql);

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<input class="btn btn-success btn-sm" type="button" value="Imprimir" onClick="self.print();" />
	<p></p>
	<tr>
			<td><b>Nº Ordem</b></td>
	 		<td><b>Produto</b></td>
	 		<td><b>Quant.</b></td>
	 		<td><b>Data Abertura</b></td>
	 		<td><b>Data Cotação</b></td>
	 		<td><b>Data Compra</b></td>
	 		<td><b>Data Receb.</b></td>
	 		<td><b>Status</b></td>
	 		<td><b>Prazo</b></td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[0]; ?></td>
		<td><?php echo $mostrar[10]; ?></td>
		<td><?php echo $mostrar[8]; ?></td>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td><?php echo $mostrar[3]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[6]; ?></td>
	</tr>


<?php endWhile; ?>
</table>