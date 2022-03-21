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
		$sql="SELECT id_fornecedor,razao_social
		from fornecedores";
		$result1=mysqli_query($conexao,$sql);
		$sql="SELECT id_produto,descricao
		from produtos";
		$result3=mysqli_query($conexao,$sql);
		$sql="SELECT id_fornecedor,razao_social
		from fornecedores";
		$result4=mysqli_query($conexao,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Notas Fiscais</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmNotas">
						<label>Número da Nota</label>
						<input type="text" class="form-control input-sm" id="numeronota" name="numeronota">
						<label>Produto</label>
						<select class="form-control input-sm" id="produtoSelect" name="produtoSelect">
							<option value="A">Selecionar Produto</option>
							<?php while($mostrar=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Fornecedor</label>
						<select class="form-control input-sm" id="fornecedorSelect" name="fornecedorSelect">
							<option value="A">Selecionar Fornecedor</option>
							<?php while($mostrar=mysqli_fetch_row($result1)): ?>
							<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
						<?php endwhile; ?>
						</select>
						<label>Quantidade</label>
						<input type="text" class="form-control input-sm" id="quantidade" name="quantidade">
						<label>Valor Unitário</label>
						<input type="text" class="form-control input-sm" id="preco" name="preco">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarNota">Lançar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaNotasLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalNotasUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Nota</h4>
					</div>
					<div class="modal-body">
						<form id="frmNotasU">
							<input type="text" hidden="" id="idnotaU" name="idnotaU">
							<label>Número da Nota</label>
							<input type="text" class="form-control input-sm" id="numeronotaU" name="numeronotaU">
							<label>Produto</label>
							<select readonly="" class="form-control input-sm" id="produtoSelectU" name="produtoSelectU">
							<option value="A">Selecionar Produto</option>
							<?php while($mostrar=mysqli_fetch_row($result3)): ?>
							<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
							</select>
							<label>Fornecedor</label>
							<select class="form-control input-sm" id="fornecedorSelectU" name="fornecedorSelectU">
							<option value="A">Selecionar Fornecedor</option>
							<?php while($mostrar=mysqli_fetch_row($result4)): ?>
							<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
							</select>
							<label>Quantidade</label>
							<input readonly="" type="text" class="form-control input-sm" id="quantidadeU" name="quantidadeU">
							<label>Valor Unitário</label>
							<input type="text" class="form-control input-sm" id="precoU" name="precoU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarNotaU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>


	<script type="text/javascript">
		function adicionarDado(idnota){

			$.ajax({
				type:"POST",
				data:"idnota=" + idnota,
				url:"../procedimentos/notas/obterDadosNota.php",
				success:function(r){

					dado=jQuery.parseJSON(r);


					$('#idnotaU').val(dado['id_nota']);
					$('#numeronotaU').val(dado['numero_nota']);
					$('#produtoSelectU').val(dado['id_produto']);
					$('#fornecedorSelectU').val(dado['id_fornecedor']);
					$('#quantidadeU').val(dado['quantidade']);
					$('#precoU').val(dado['preco']);

				}
			});
		}

		function eliminarNota(idnota){
			alertify.confirm('Deseja Estornar este lançamento?', function(){ 
				$.ajax({
					type:"POST",
					data:"idnota=" + idnota,
					url:"../procedimentos/notas/eliminarNotas.php",
					success:function(r){


						if(r==1){
							$('#tabelaNotasLoad').load("notas/tabelaNotas.php");
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

			$('#tabelaNotasLoad').load("notas/tabelaNotas.php");

			$('#btnAdicionarNota').click(function(){

				vazios=validarFormVazio('frmNotas');

				if(vazios > 0){
					alertify.alert("Preencha todos os Campos!!");
					return false;
				}

				dados=$('#frmNotas').serialize();

				$.ajax({
					
					type:"POST",
					data:dados,
					url:"../procedimentos/notas/adicionarNotas.php",
					success:function(r){

						if(r==1){
							$('#frmNotas')[0].reset();
							$('#tabelaNotasLoad').load("notas/tabelaNotas.php");
							alertify.success("Nota Lançada");
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
			$('#btnAdicionarNotaU').click(function(){
				dados=$('#frmNotasU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/notas/atualizarNotas.php",
					success:function(r){



						if(r==1){
							$('#frmNotas')[0].reset();
							$('#tabelaNotasLoad').load("notas/tabelaNotas.php");
							alertify.success("Nota atualizada com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar nota");
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