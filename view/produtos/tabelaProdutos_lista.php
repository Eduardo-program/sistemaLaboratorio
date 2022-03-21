
<?php 


require_once "../../classes/conexao.php";
	$c = new conectar();
		$conexao=$c->conexao();

	$sql="SELECT pro.id_produto, pro.descricao, pro.quantidade, pro.preco, pro.codigo_protheus, cat.nome_categoria from produtos as pro inner join categorias as cat on pro.id_categoria=cat.id_categoria";
	$result = mysqli_query($conexao, $sql);
	/*$ver = mysqli_fetch_row($result)*/

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<input class="btn btn-success btn-sm" type="button" value="Imprimir" onClick="self.print();" />
	<p></p>
	<tr>
			<td><b>Código</b></td>
			<td><b>Descrição</b></td>
	 		<td><b>Código Protheus</b></td>
	 		<td><b>Categoria</b></td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[0]; ?></td>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
	</tr>


	<?php endWhile; ?>
</table>