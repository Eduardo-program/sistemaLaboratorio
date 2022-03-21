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
		$sql="SELECT id_loja, numero_loja, cidade
		from lojas";
		$result=mysqli_query($conexao,$sql);
		$sql="SELECT id_loja, numero_loja, cidade
		from lojas";
		$result1=mysqli_query($conexao,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Serviços Realizados</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmServico">
						<label>Loja</label>
						<select class="form-control input-sm" id="loja" name="loja">
						<option value="A">Selecionar Loja</option>
						<?php while($mostrar=mysqli_fetch_row($result)): ?>
						<option value="<?php echo $mostrar[0] ?>">Loja - <?php echo $mostrar[1]." ".$mostrar[2] ?></option>
						<?php endwhile; ?>
						</select>
						<label>Data Inicio</label>
						<input type="date" class="form-control input-sm" id="dataini" name="dataini">
						<label>Data Fim</label>
						<input type="date" class="form-control input-sm" id="datafim" name="datafim">
						<label>Descrição do Serviço</label>
                      	<textarea id="descricao" name="descricao" class="form-control" rows="3"></textarea>
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarServico">Adicionar</span>
					</form>
				</div>
			<!--	<div class="col-sm-8">
					<div id="tabelaServicoLoad"></div>
				</div> -->
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalServicoUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Lançamento</h4>
					</div>
					<div class="modal-body">
						<form id="frmServicoU">
						<input type="text" hidden="" id="idservicoU" name="idservicoU">
						<label>Loja</label>
						<select class="form-control input-sm" id="lojaU" name="lojaU">
						<option value="A">Selecionar Loja</option>
						<?php while($mostrar=mysqli_fetch_row($result)): ?>
						<option value="<?php echo $mostrar[0] ?>">Loja - <?php echo $mostrar[1]." ".$mostrar[2] ?></option>
						<?php endwhile; ?>
						</select>
						<label>Data Inicio</label>
						<input type="date" class="form-control input-sm" id="datainiU" name="datainiU">
						<label>Data Fim</label>
						<input type="date" class="form-control input-sm" id="datafimU" name="datafimU">
						<label>Descrição do Serviço</label>
                      	<textarea id="descricaoU" name="descricaoU" class="form-control" rows="3"></textarea>
						<p></p>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarServicoU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idservico){

			$.ajax({
				type:"POST",
				data:"idservico=" + idservico,
				url:"../procedimentos/servicos/obterDadosServico.php",
				success:function(r){

					dado=jQuery.parseJSON(r);

					$('#idservicoU').val(dado['id_servico']);
					$('#lojaU').val(dado['id_loja']);
					$('#datainiU').val(dado['datainicio']);
					$('#datafimU').val(dado['datafim']);
					$('#descricaoU').val(dado['observacao']);


				}
			});
		}

		function eliminarServico(idservico){
			alertify.confirm('Deseja Excluir este lançamento?', function(){ 
				$.ajax({
					type:"POST",
					data:"idservico=" + idservico,
					url:"../procedimentos/servicos/eliminarServico.php",
					success:function(r){


						if(r==1){
							$('#tabelaServicoLoad').load("servicos/tabelaServico.php");
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

			$('#tabelaServicoLoad').load("servicos/tabelaServico.php");

			$('#btnAdicionarServico').click(function(){

				vazios=validarFormVazio('frmServico');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmServico').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/servicos/adicionarServico.php",
					success:function(r){

						if(r==1){
							$('#frmServico')[0].reset();
							$('#tabelaServicoLoad').load("servicos/tabelaServico.php");
							alertify.success("Serviço Adicionado");
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
			$('#btnAdicionarServicoU').click(function(){
				dados=$('#frmServicoU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/servicos/atualizarServico.php",
					success:function(r){



						if(r==1){
							$('#frmServico')[0].reset();
							$('#tabelaServicoLoad').load("servicos/tabelaServico.php");
							alertify.success("Atualizado com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar!");
						}
					}
				});
			})
		})
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#loja').select2();
	});
</script>


	<?php 
}else{
	header("location:../index.php");
}
?>