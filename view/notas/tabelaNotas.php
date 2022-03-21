
<?php 


	require_once "../../classes/conexao.php";
	$c = new conectar();
		$conexao=$c->conexao();
	$sql = "SELECT fis.id_nota, 
					fis.numero_nota, 
					fis.quantidade, 
					fis.preco, 
					pro.descricao,
					qwe.razao_social,
					fis.dataentrada
	from notas_fiscais as fis 
	inner join produtos as pro on fis.id_produto=pro.id_produto
	inner join fornecedores as qwe on fis.id_fornecedor=qwe.id_fornecedor";

	$result = mysqli_query($conexao, $sql);





?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Notas Lançadas</label></caption>
	<tr>
			<td>Data</td>
			<td>Número da NF</td>
	 		<td>Fornecedor</td>
	 		<td>Produto</td>
	 		<td>Quantidade</td>
	 		<td>Valor Produto</td>
	 		<td>Editar</td>
			<td>Excluir</td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo date("d/m/Y", strtotime($mostrar[6])) ?></td>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td>R$ <?php echo $mostrar[3]; ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalNotasUpdate" onclick="adicionarDado('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarNota('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>


<?php endWhile; ?>
</table>