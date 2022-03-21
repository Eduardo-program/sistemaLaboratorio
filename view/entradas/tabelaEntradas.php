
<?php 


	require_once "../../classes/conexao.php";
	$c = new conectar();
		$conexao=$c->conexao();
	$sql = "SELECT fis.id_entrada, 
					fis.observacao, 
					fis.quantidade,
					pro.descricao
	from entradas as fis 
	inner join produtos as pro on fis.id_produto=pro.id_produto";

	$result = mysqli_query($conexao, $sql);





?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<input class="btn btn-success btn-sm" type="button" value="Imprimir" onClick="self.print();" />
	<p></p>
	<tr>
	 		<td>Produto</td>
	 		<td>Quantidade</td>
	 		<td>Observação</td>
			<td>Excluir</td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[3]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td><?php echo $mostrar[1]; ?></td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarEntrada('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>


<?php endWhile; ?>
</table>