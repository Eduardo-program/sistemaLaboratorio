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
		$sql="SELECT id_loja, numero_loja, cidade
		from lojas";
		$result1=mysqli_query($conexao,$sql);
		$sql="SELECT id_produto, descricao
		from produtos";
		$result2=mysqli_query($conexao,$sql);
		$sql="SELECT id_loja, numero_loja, cidade
		from lojas";
		$result3=mysqli_query($conexao,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Gerenciador de Ordens de Serviço</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmOrdem">
						<label>Cliente</label>
						<select class="form-control input-sm" id="cliente" name="cliente">
						<option value="A">Selecionar Cliente</option>
						<?php while($mostrar=mysqli_fetch_row($result1)): ?>
						<option value="<?php echo $mostrar[0] ?>">Loja - <?php echo $mostrar[1]." ".$mostrar[2] ?></option>
						<?php endwhile; ?>
						</select>
						<label>Produto</label>
						<select class="form-control input-sm" id="produto" name="produto">
						<option value="A">Selecionar Produto</option>
						<?php while($mostrar=mysqli_fetch_row($result)): ?>
						<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1] ?></option>
						<?php endwhile; ?>
						</select>
                    	<div class="form-group">
                      	<label>Prazo</label>
                      		<select name="prazo" id="prazo" class="form-control">
	                        	<option>Selecione</option>
	                        	<option>Urgente</option>
	                        	<option>Até 3 dias</option>
	                        	<option>Até 5 dias</option>
	                        	<option>Até 7 dias</option>
                      	</select>
                    	</div>
                    	<div class="form-group">
                      	<label>Status</label>
                      		<select name="statuss" id="statuss" class="form-control">
                      			<option>Selecione</option>
	                        	<option>Aberto</option>
	                        	<option>Aguardando</option>
	                        	<option>Finalizado</option>
                      	</select>
                    	</div>
						<label>Observação</label>
						<input type="textarea" class="form-control input-sm" id="observacao" name="observacao">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarOrdem">Adicionar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaOrdemLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalOrdemUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Lançamento</h4>
					</div>
					<div class="modal-body">
						<form id="frmOrdemU">
							<input type="text" hidden="" id="idordemU" name="idordemU">
							<label>Cliente</label>
							<select class="form-control input-sm" id="clienteU" name="clienteU">
							<option value="A">Selecionar Cliente</option>
							<?php while($mostrar=mysqli_fetch_row($result3)): ?>
							<option value="<?php echo $mostrar[0] ?>">Loja - <?php echo $mostrar[1]." ".$mostrar[2] ?></option>
							<?php endwhile; ?>
							</select>
							<label>Produto</label>
							<select class="form-control input-sm" id="produtoU" name="produtoU">
							<option value="A">Selecionar Produto</option>
							<?php while($mostrar=mysqli_fetch_row($result2)): ?>
							<option value="<?php echo $mostrar[0] ?>"><?php echo $mostrar[1] ?></option>
							<?php endwhile; ?>
							</select>
	                    	<div class="form-group">
	                      	<label>Prazo</label>
	                      		<select name="prazoU" id="prazoU" class="form-control">
		                        	<option>Selecione::</option>
		                        	<option>Urgente</option>
		                        	<option>Até 3 dias</option>
		                        	<option>Até 5 dias</option>
		                        	<option>Até 7 dias</option>
	                      	</select>
	                    	</div>
							<label>Observação</label>
							<input type="textarea" class="form-control input-sm" id="observacaoU" name="observacaoU">
							<label>Status</label>
	                      		<select name="statussU" id="statussU" class="form-control">
		                        	<option>Selecione</option>
		                        	<option>Aberto</option>
		                        	<option>Aguardando</option>
		                        	<option>Finalizado</option>
	                      		</select>
							<p></p>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarOrdemU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idordem){

			$.ajax({
				type:"POST",
				data:"idordem=" + idordem,
				url:"../procedimentos/ordens/obterDadosOrdem.php",
				success:function(r){

					dado=jQuery.parseJSON(r);

					$('#idordemU').val(dado['id_ordem']);
					$('#clienteU').val(dado['id_cliente']);
					$('#produtoU').val(dado['id_produto']);
					$('#prazoU').val(dado['prazo']);
					$('#observacaoU').val(dado['observacao']);
					$('#statussU').val(dado['status']);
					


				}
			});
		}

		function eliminarOrdem(idordem){
			alertify.confirm('Deseja Excluir esta ordem?', function(){ 
				$.ajax({
					type:"POST",
					data:"idordem=" + idordem,
					url:"../procedimentos/ordens/eliminarOrdens.php",
					success:function(r){


						if(r==1){
							$('#tabelaOrdemLoad').load("ordens/tabelaOrdens.php");
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

			$('#tabelaOrdemLoad').load("ordens/tabelaOrdens.php");

			$('#btnAdicionarOrdem').click(function(){

				vazios=validarFormVazio('frmOrdem');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmOrdem').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/ordens/adicionarOrdens.php",
					success:function(r){

						if(r==1){
							$('#frmOrdem')[0].reset();
							$('#tabelaOrdemLoad').load("ordens/tabelaOrdens.php");
							alertify.success("Ordem Adicionada");
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
			$('#btnAdicionarOrdemU').click(function(){
				dados=$('#frmOrdemU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/ordens/atualizarOrdens.php",
					success:function(r){



						if(r==1){
							$('#frmOrdem')[0].reset();
							$('#tabelaOrdemLoad').load("ordens/tabelaOrdens.php");
							alertify.success("Ordem atualizada com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar essa Ordem");
						}
					}
				});
			})
		})
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#cliente').select2();
		$('#produto').select2();
	});
</script>


	<?php 
}else{
	header("location:../index.php");
}
?>