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
		$sql="SELECT id_categoria,nome_categoria
		from categorias";
		$result=mysqli_query($conexao,$sql);
		$sql="SELECT id_categoria,nome_categoria
		from categorias";
		$result1=mysqli_query($conexao,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Cadastro de Produtos</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmProdutos">
						<label>Categoria</label>
						<select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
						<option value="A">Selecionar Categoria</option>
						<?php while($mostrar=mysqli_fetch_row($result)): ?>
						<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
						<?php endwhile; ?>
						</select>
						<label>Descrição</label>
						<input type="text" class="form-control input-sm" id="descricao" name="descricao">
						<label>Estoque Ideal</label>
						<input type="number" class="form-control input-sm" id="quantidade" name="quantidade">
						<label>Valor Unitário</label>
						<input type="text" class="form-control input-sm" id="preco" name="preco">
						<label>Código Protheus</label>
						<input type="text" class="form-control input-sm" id="codigo_protheus" name="codigo_protheus">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarProduto">Salvar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaProdutosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalProdutosUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Cadastro</h4>
					</div>
					<div class="modal-body">
						<form id="frmProdutosU">
							<input type="text" hidden="" id="idprodutoU" name="idprodutoU">
							<label>Categoria</label>
							<select class="form-control input-sm" id="categoriaSelectU" name="categoriaSelectU">
							<option value="A">Selecionar Categoria</option>
							<?php while($mostrar=mysqli_fetch_row($result1)): ?>
							<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1]; ?></option>
							<?php endwhile; ?>
							</select>
							<label>Descrição</label>
							<input type="text" class="form-control input-sm" id="descricaoU" name="descricaoU">
							<label>Estoque Ideal</label>
							<input type="number" class="form-control input-sm" id="quantidadeU" name="quantidadeU">
							<label>Valor Unitário</label>
							<input type="text" class="form-control input-sm" id="precoU" name="precoU">
							<label>Código Protheus</label>
							<input type="text" class="form-control input-sm" id="codigo_protheusU" name="codigo_protheusU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarProdutoU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idproduto){

			$.ajax({
				type:"POST",
				data:"idproduto=" + idproduto,
				url:"../procedimentos/produtos/obterDadosProduto.php",
				success:function(r){

					dado=jQuery.parseJSON(r);


					$('#idprodutoU').val(dado['id_produto']);
					$('#categoriaSelectU').val(dado['id_categoria']);
					$('#descricaoU').val(dado['descricao']);
					$('#quantidadeU').val(dado['quantidade']);
					$('#precoU').val(dado['preco']);
					$('#codigo_protheusU').val(dado['codigo_protheus']);

				}
			});
		}

		function eliminarProduto(idproduto){
			alertify.confirm('Deseja Excluir este produto?', function(){ 
				$.ajax({
					type:"POST",
					data:"idproduto=" + idproduto,
					url:"../procedimentos/produtos/eliminarProdutos.php",
					success:function(r){


						if(r==1){
							$('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");
							alertify.success("Excluido com sucesso!!");
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

			$('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");

			$('#btnAdicionarProduto').click(function(){

				vazios=validarFormVazio('frmProdutos');

				if(vazios > 0){
					alertify.alert("Preencha todos os Campos!!");
					return false;
				}

				dados=$('#frmProdutos').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/produtos/adicionarProdutos.php",
					success:function(r){

						if(r==1){
							$('#frmProdutos')[0].reset();
							$('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");
							alertify.success("Produto Adicionado");
						}else{
							alertify.error("Não foi possível adicionar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAdicionarProdutoU').click(function(){
				dados=$('#frmProdutosU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/produtos/atualizarProdutos.php",
					success:function(r){



						if(r==1){
							$('#frmProdutos')[0].reset();
							$('#tabelaProdutosLoad').load("produtos/tabelaProdutos.php");
							alertify.success("Produto atualizado com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar produto");
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