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
	</head>
	<body>
		<div class="container">
			<h1>Fornecedores</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmFornecedores">
						<label>Razão Social</label>
						<input type="text" class="form-control input-sm" id="razao_social" name="razao_social">
						<label>Endereço</label>
						<input type="text" class="form-control input-sm" id="endereco" name="endereco">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">
						<label>Telefone</label>
						<input type="text" class="form-control input-sm" id="telefone" name="telefone">
						<label>CPNJ</label>
						<input type="text" class="form-control input-sm" id="cnpj" name="cnpj">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarFornecedores">Salvar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaFornecedoresLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalFornecedoresUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Fornecedor</h4>
					</div>
					<div class="modal-body">
						<form id="frmFornecedoresU">
							<input type="text" hidden="" id="idfornecedorU" name="idfornecedorU">
							<label>Razão Social</label>
							<input type="text" class="form-control input-sm" id="razaosocialU" name="razaosocialU">
							<label>Endereço</label>
							<input type="text" class="form-control input-sm" id="enderecoU" name="enderecoU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>Telefone</label>
							<input type="text" class="form-control input-sm" id="telefoneU" name="telefoneU">
							<label>CNPJ</label>
							<input type="text" class="form-control input-sm" id="cnpjU" name="cnpjU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarFornecedorU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idfornecedor){

			$.ajax({
				type:"POST",
				data:"idfornecedor=" + idfornecedor,
				url:"../procedimentos/fornecedores/obterDadosFornecedores.php",
				success:function(r){



					dado=jQuery.parseJSON(r);


					$('#idfornecedorU').val(dado['id_fornecedor']);
					$('#razaosocialU').val(dado['razao_social']);
					$('#enderecoU').val(dado['endereco']);
					$('#emailU').val(dado['email_for']);
					$('#telefoneU').val(dado['telefone']);
					$('#cnpjU').val(dado['cnpj_for']);



				}
			});
		}

		function eliminar(idfornecedor){
			alertify.confirm('Deseja Excluir este fornecedor?', function(){ 
				$.ajax({
					type:"POST",
					data:"idfornecedor=" + idfornecedor,
					url:"../procedimentos/fornecedores/eliminarFornecedores.php",
					success:function(r){



						if(r==1){
							$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php");
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

			$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php");

			$('#btnAdicionarFornecedores').click(function(){

				vazios=validarFormVazio('frmFornecedores');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmFornecedores').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/fornecedores/adicionarFornecedores.php",
					success:function(r){

						if(r==1){
							$('#frmFornecedores')[0].reset();
							$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php");
							alertify.success("Fornecedor Adicionado");
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
			$('#btnAdicionarFornecedorU').click(function(){
				dados=$('#frmFornecedoresU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/fornecedores/atualizarFornecedores.php",
					success:function(r){

						
						if(r==1){
							$('#frmFornecedores')[0].reset();
							$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php");
							alertify.success("Fornecedor atualizado com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar fornecedor");
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