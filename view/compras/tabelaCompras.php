
<?php 


require_once "../../classes/conexao.php";
	$c = new conectar();
	$conexao=$c->conexao();

	$sql = "SELECT isf.id_compra, 
					isf.id_user, 
					isf.id_produto, 
					isf.quantidade,
					isf.data_recebimento,
					isf.prazo,
					isf.data_lancamento, 
					isf.status,  
					orp.descricao,
					qwe.nome
	from compras as isf 
	inner join produtos as orp on isf.id_produto=orp.id_produto
	inner join usuarios as qwe on isf.id_user=qwe.id
	";

	$result = mysqli_query($conexao, $sql);

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Lista de Compras</label></caption>
	<tr>
			<td>Nº Ordem</td>
	 		<td>Data Abertura</td>
	 		<td>Produto</td>
	 		<td>Prazo</td>
	 		<td>Quant</td>
	 		<td>Status</td>
	 		<td>Editar</td>
			<td>Excluir</td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[0]; ?></td>
		<td><?php echo $mostrar[6]; ?></td>
		<td><?php echo $mostrar[8]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[3]; ?></td>
		<td><?php echo $mostrar[7]; ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalCompraUpdate" onclick="adicionarDado('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarCompra('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>


<?php endWhile; ?>
</table>