<?php 

	session_start();
	
 ?>

 <h4>Dados da Baixa</h4>
 <h4><strong><div id="nomeclienteSaida"></div></strong></h4>
 <table class="table table-bordered table-hover table-condensed" style="text-align: center;">
 	<caption>
 		<span class="btn btn-success" onclick="criarSaida()"> Efetivar
 			<span class="glyphicon glyphicon-ok"></span>
 		</span>
 	</caption>
 	<tr>
 		<td>Produto</td>
 		<td>Quantidade</td>
 		<td>Remover</td>
 	</tr>
 	<?php
 	$cliente=""; //nome cliente
 		if(isset($_SESSION['tabelaComprasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tabelaComprasTemp'] as $key) {

 				$d=explode("||", @$key);
 	 ?>

 	<tr>
 		<td><?php echo $d[1] ?></td>
 		<td><?php echo $d[4] ?></td>
 		<td>
			<span class="btn btn-danger btn-xs" onclick="fecharP('<?php echo $i; ?>'), editarP('<?php echo $d[0]; ?>, <?php echo $d[3]; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 <?php 
	$i++; 
 	$cliente=$d[2];
 	}
 	endif; 
 ?>
 </table>


 <script type="text/javascript">
 	$(document).ready(function(){
 		nome="<?php echo @$cliente ?>";
 		$('#nomeclienteSaida').text("Filial: " + nome);
 	});
 </script>