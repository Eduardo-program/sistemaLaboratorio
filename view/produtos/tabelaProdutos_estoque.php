
<?php 


require_once "../../classes/conexao.php";
	$c = new conectar();
		$conexao=$c->conexao();

	$sql="SELECT pro.id_produto, 
	pro.descricao, 
	isf.quantidade, 
	pro.preco, 
	pro.codigo_protheus
	from produtos as pro 
	inner join estoque_prod as isf on pro.id_produto=isf.id_produto";
	$result = mysqli_query($conexao, $sql);

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<input class="btn btn-success btn-sm" type="button" value="Imprimir" onClick="self.print();" />
	<p></p>
	<tr>
			<td><b>Código</b></td>
	 		<td><b>Descrição</b></td>
	 		<td><b>Código Protheus</b></td>
	 		<td><b>Estoque Atual</b></td>
	 		<td><b>Preço</b></td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[0]; ?></td>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td> R$ <?php echo $mostrar[3]; ?></td>
	</tr>


	<?php endWhile; ?>
</table>