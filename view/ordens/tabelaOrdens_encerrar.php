
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
	where isf.status='Aberto'
	";

	$result = mysqli_query($conexao, $sql);

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<input class="btn btn-success btn-sm" type="button" value="Imprimir" onClick="self.print();" />
	<p></p>
	<tr>
			<td><b>Ordem</b></td>
	 		<td><b>Cliente (Loja)</b></td>
	 		<td><b>Produto</b></td>
	 		<td><b>Data Abertura</b></td>
	 		<td><b>Data Final</b></td>
	 		<td><b>Operador</b></td>
	 		<td><b>Observação</b></td>
	 		<td><b>Status</b></td>
	 		<td><b>Finalizar</b></td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[0]; ?></td>
		<td><?php echo $mostrar[10]; ?></td>
		<td><?php echo $mostrar[8]; ?></td>
		<td><?php echo date("d/m/Y", strtotime($mostrar[6])) ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[9]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[7]; ?></td>
		<td>
			<span class="btn btn-success btn-xs" onclick="encerrarOrdem('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-ok"></span>
			</span>
		</td>
	</tr>


<?php endWhile; ?>
</table>