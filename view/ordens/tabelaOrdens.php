
<?php 


require_once "../../classes/conexao.php";
	$c = new conectar();
	$conexao=$c->conexao();

	$sql = "SELECT isf.id_ordem, 
					isf.id_cliente, 
					isf.id_produto, 
					isf.id_usuario,
					isf.observacao,
					isf.prazo,
					isf.dataabertura, 
					isf.status,  
					orp.descricao,
					qwe.nome,
					asd.numero_loja
	from ordens as isf 
	inner join produtos as orp on isf.id_produto=orp.id_produto
	inner join usuarios as qwe on isf.id_usuario=qwe.id
	inner join lojas as asd on isf.id_cliente=asd.id_loja
	";

	$result = mysqli_query($conexao, $sql);

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Lista de Ordens</label></caption>
	<tr>
			<td>Ordem</td>
	 		<td>Cliente (Loja)</td>
	 		<td>Produto</td>
	 		<td>Prazo Final</td>
	 		<td>Operador</td>
	 		<td>Status</td>
	 		<td>Editar</td>
			<td>Excluir</td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[0]; ?></td>
		<td><?php echo $mostrar[10]; ?></td>
		<td><?php echo $mostrar[8]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[9]; ?></td>
		<td><?php echo $mostrar[7]; ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalOrdemUpdate" onclick="adicionarDado('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarOrdem('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>


<?php endWhile; ?>
</table>