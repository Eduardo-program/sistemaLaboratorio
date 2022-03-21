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
		$sql="SELECT id_produto, descricao
		from produtos";
		$result=mysqli_query($conexao,$sql);

		$sql="SELECT id_produto, descricao
		from produtos";
		$result2=mysqli_query($conexao,$sql);

		?>
	</head>
	<body>
		<div class="container">
			<h1>Gerenciador de Ordens de Compra</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCompra">
						<label>Produto</label>
						<select class="form-control input-sm" id="produto" name="produto">
						<option value="A">Selecionar Produto</option>
						<?php while($mostrar=mysqli_fetch_row($result)): ?>
						<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1] ?></option>
						<?php endwhile; ?>
						</select>
                    	<div class="form-group">
                      	<label>Prazo Compra</label>
                      		<select name="prazo" id="prazo" class="form-control">
	                        	<option>Selecione</option>
	                        	<option>Compra Urgente</option>
	                        	<option>Compra Sem Urgência</option>
	                        	<option>Cotação de Valores</option>
                      	</select>
                    	</div>
                    	<div class="form-group">
                      	<label>Status</label>
                      		<select name="statuss" id="statuss" class="form-control">
								<option>Nova Ordem</option>
	                        	<option>Confirma Orçamento</option>
	                        	<option>Confirma Compra</option>
	                        	<option>Confirma Recebimento</option>
                      	</select>
                    	</div>
						<label>Quantidade</label>
						<input type="text" class="form-control input-sm" id="quantidade" name="quantidade">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarCompra">Adicionar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaCompraLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalCompraUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Lançamento</h4>
					</div>
					<div class="modal-body">
						<form id="frmCompraU">
						<input type="text" hidden="" id="idcompraU" name="idcompraU">
						<label>Produto</label>
						<select class="form-control input-sm" id="produtoU" name="produtoU">
						<option value="A">Selecionar Produto</option>
						<?php while($mostrar=mysqli_fetch_row($result2)): ?>
						<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1] ?></option>
						<?php endwhile; ?>
						</select>
                    	<div class="form-group">
                      	<label>Prazo Compra</label>
                      		<select name="prazoU" id="prazoU" class="form-control">
	                        	<option>Selecione</option>
	                        	<option>Compra Urgente</option>
	                        	<option>Compra Sem Urgência</option>
	                        	<option>Cotação de Valores</option>
                      	</select>
                    	</div>
                    	<div class="form-group">
                      	<label>Status</label>
                      		<select name="statussU" id="statussU" class="form-control">
								<option>Nova Ordem</option>
	                        	<option>Confirma Orçamento</option>
	                        	<option>Confirma Compra</option>
	                        	<option>Confirma Recebimento</option>
                      	</select>
                    	</div>
						<label>Quantidade</label>
						<input type="text" class="form-control input-sm" id="quantidadeU" name="quantidadeU">
						<p></p>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarCompraU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idcompra){

			$.ajax({
				type:"POST",
				data:"idcompra=" + idcompra,
				url:"../procedimentos/compras/obterDadosCompras.php",
				success:function(r){

					dado=jQuery.parseJSON(r);

					$('#idcompraU').val(dado['id_compra']);
					$('#produtoU').val(dado['id_produto']);
					$('#statussU').val(dado['status']);
					$('#prazoU').val(dado['prazo']);
					$('#quantidadeU').val(dado['quantidade']);
					
				}
			});
		}

		function eliminarCompra(idcompra){
			alertify.confirm('Deseja Excluir esta ordem de compra?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcompra=" + idcompra,
					url:"../procedimentos/compras/eliminarCompras.php",
					success:function(r){


						if(r==1){
							$('#tabelaCompraLoad').load("compras/tabelaCompras.php");
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

			$('#tabelaCompraLoad').load("compras/tabelaCompras.php");

			$('#btnAdicionarCompra').click(function(){

				vazios=validarFormVazio('frmCompra');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmCompra').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/compras/adicionarCompras.php",
					success:function(r){

						if(r==1){
							$('#frmCompra')[0].reset();
							$('#tabelaCompraLoad').load("compras/tabelaCompras.php");
							alertify.success("Ordem de Compra Adicionada");
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
			$('#btnAdicionarCompraU').click(function(){
				dados=$('#frmCompraU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/compras/atualizarCompras.php",
					success:function(r){



						if(r==1){
							$('#frmCompra')[0].reset();
							$('#tabelaCompraLoad').load("compras/tabelaCompras.php");
							alertify.success("Ordem de compra atualizada com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar essa Ordem de compra");
						}
					}
				});
			})
		})
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#produto').select2();
	});
</script>


	<?php 
}else{
	header("location:../index.php");
}
?>