<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
	 	<title>Sistema de Gestão - Laboratório</title>
 	 	<link rel="shortcut icon" href="../img/kdebecker.png">
		<?php require_once "menu.php"; ?>
		<?php require_once "../classes/conexao.php"; 
		$c= new conectar();
		$conexao=$c->conexao();
		$sql="SELECT id_produto,descricao
		from produtos";
		$result=mysqli_query($conexao,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Entradas Avulsas</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmEntradas">
						<label>Observação</label>
						<input type="text" class="form-control input-sm" id="observacao" name="observacao">
						<label>Produto</label>
						<select class="form-control input-sm" id="produtoSelect" name="produtoSelect">
							<option value="A">Selecionar Produto</option>
							<?php while($mostrar=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Quantidade</label>
						<input type="text" class="form-control input-sm" id="quantidade" name="quantidade">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarEntrada">Adicionar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaEntradasLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalEntradasUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Entrada</h4>
					</div>
					<div class="modal-body">
						<form id="frmEntradasU">
							<input type="text" hidden="" id="identradaU" name="identradaU">
						<label>Observação</label>
						<input type="text" class="form-control input-sm" id="observacaoU" name="observacaoU">
						<label>Produto</label>
						<select class="form-control input-sm" id="produtoSelectU" name="produtoSelectU">
							<option value="A">Selecionar Produto</option>
							<?php while($mostrar=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Quantidade</label>
						<input type="text" class="form-control input-sm" id="quantidadeU" name="quantidadeU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarEntradaU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>


	<script type="text/javascript">
		function adicionarDado(identrada){

			$.ajax({
				type:"POST",
				data:"identrada=" + identrada,
				url:"../procedimentos/entradas/obterDadosEntrada.php",
				success:function(r){

					dado=jQuery.parseJSON(r);


					$('#identradaU').val(dado['id_entrada']);
					$('#produtoSelectU').val(dado['id_produto']);
					$('#observacaoU').val(dado['observacao']);
					$('#quantidadeU').val(dado['quantidade']);

				}
			});
		}

		function eliminarEntrada(identrada){
			alertify.confirm('Deseja Estornar este lançamento?', function(){ 
				$.ajax({
					type:"POST",
					data:"identrada=" + identrada,
					url:"../procedimentos/entradas/eliminarEntradas.php",
					success:function(r){


						if(r==1){
							$('#tabelaEntradasLoad').load("entradas/tabelaEntradas.php");
							alertify.success("Estorno realizado, estoque recalculado!!");
						}else{
							alertify.error("Não foi possível excluir");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaEntradasLoad').load("entradas/tabelaEntradas.php");

			$('#btnAdicionarEntrada').click(function(){

				vazios=validarFormVazio('frmEntradas');

				if(vazios > 0){
					alertify.alert("Preencha todos os Campos!!");
					return false;
				}

				dados=$('#frmEntradas').serialize();

				$.ajax({
					
					type:"POST",
					data:dados,
					url:"../procedimentos/entradas/adicionarEntradas.php",
					success:function(r){

						if(r==1){
							$('#frmEntradas')[0].reset();
							$('#tabelaEntradasLoad').load("entradas/tabelaEntradas.php");
							alertify.success("Entrada Avulsa Lançada");
						}else{
							alertify.error("Não foi possível Lançar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAdicionarEntradaU').click(function(){
				dados=$('#frmEntradasU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/entradas/atualizarEntradas.php",
					success:function(r){



						if(r==1){
							$('#frmEntradas')[0].reset();
							$('#tabelaEntradasLoad').load("entradas/tabelaEntradas.php");
							alertify.success("Entrada atualizada com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>