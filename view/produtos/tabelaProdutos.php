
<?php 


require_once "../../classes/conexao.php";
	$c = new conectar();
		$conexao=$c->conexao();

	$sql="SELECT pro.id_produto, pro.descricao, pro.quantidade, pro.preco, pro.codigo_protheus, cat.nome_categoria from produtos as pro inner join categorias as cat on pro.id_categoria=cat.id_categoria";
	$result = mysqli_query($conexao, $sql);

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Produtos Cadastrados</label></caption>
	<tr>
			<td>Descrição</td>
	 		<td>Código Protheus</td>
	 		<td>Categoria</td>
	 		<td>Estoque Ideal</td>
	 		<td>Preço</td>
	 		<td>Editar</td>
			<td>Excluir</td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td> R$ <?php echo $mostrar[3]; ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalProdutosUpdate" onclick="adicionarDado('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarProduto('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>


	<?php endWhile; ?>
</table>