
<?php 


require_once "../../classes/conexao.php";
	$c = new conectar();
	$conexao=$c->conexao();

	$sql = "SELECT isf.id_servico, 
					isf.tecnico, 
					isf.datainicio,
					isf.datafim,
					isf.observacao,
					asd.cidade,
					asd.numero_loja
	from servicos as isf 
	inner join lojas as asd on isf.id_loja=asd.id_loja
	";

	$result = mysqli_query($conexao, $sql);

?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<input class="btn btn-success btn-sm" type="button" value="Imprimir" onClick="self.print();" />
	<p></p>
	<tr>
	 		<td>Loja</td>
	 		<td>Técnico</td>
	 		<td>Data Inicio</td>
	 		<td>Data Fim</td>
	 		<td>Descrição</td>
			<td>Excluir</td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>

	<tr>
		<td>Loja <?php echo $mostrar[6]."-".$mostrar[5]; ?></td>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo date("d/m/Y", strtotime($mostrar[2])) ?></td>
		<td><?php echo date("d/m/Y", strtotime($mostrar[3])) ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarServico('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>


<?php endWhile; ?>
</table>