<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/saidas.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$obj= new saidas();

	$sql="SELECT fis.id_saida,
				fis.datasaida,
				fis.quantidade,
				pro.descricao,
				qwe.nome,
				ewq.numero_loja,
				ewq.cidade
				from saidas as fis
				inner join produtos as pro on fis.id_produto=pro.id_produto
				inner join usuarios as qwe on fis.id_usuario=qwe.id
				inner join lojas as ewq on fis.id_loja=ewq.id_loja";
	$result=mysqli_query($conexao,$sql); 
?>


<div class="row">
	<div class=""></div>
	<div class="">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				<p></p>
				
				<p></p>
				<tr>
					<td>Código</td>
					<td>Loja</td>
					<td>Data Saída</td>
					<td>Operador</td>
					<td>Produto</td>
					<td>Quantidade</td>
					<td>Comprovante</td>
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td><?php echo $ver[6]."-".$ver[5] ?></td>
					<td><?php echo date("d/m/Y", strtotime($ver[1])) ?></td>
					<td><?php echo $ver[4] ?></td>
					<td><?php echo $ver[3] ?></td>
					<td><?php echo $ver[2] ?></td>
					<td>
						<a href="../procedimentos/saidas/criarRelatorioPdf.php?idsaida=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Comprovante <span class="glyphicon glyphicon-file"></span>
						</a>	
					</td>
				</tr>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>