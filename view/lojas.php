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
			<h1>Cadastrar Loja</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmLojas">
						<label>Número Loja</label>
						<input type="text" class="form-control input-sm" id="numloja" name="numloja">
						<label>Cidade / Nome</label>
						<input type="text" class="form-control input-sm" id="cidade" name="cidade">
                    	<div class="form-group">
                      		<label>Tipo de Loja</label>
                      		<select name="tipoloja" id="tipoloja" class="form-control">
	                        	<option>Selecione::</option>
	                        	<option>Depósito</option>
	                        	<option>Loja</option>
                      		</select>
                    	</div>
                    	<div class="form-group">
                      		<label>Centro de Distribuição</label>
                      		<select name="cdatendimento" id="cdatendimento" class="form-control">
	                        	<option>Selecione::</option>
	                        	<option>DEP-111</option>
	                        	<option>DEP-010</option>
	                        	<option>DEP-211</option>
                      		</select>
                    	</div>
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">
						<label>CNPJ / CPF</label>
						<input type="text" class="form-control input-sm" id="cnpj" name="cnpj">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarLoja">Salvar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaLojasLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalLojasUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Cadastro</h4>
					</div>
					<div class="modal-body">
						<form id="frmLojasU">
							<input type="text" hidden="" id="idlojaU" name="idlojaU">
							<label>Número Loja</label>
							<input type="text" class="form-control input-sm" id="numlojaU" name="numlojaU">
							<label>Cidade</label>
							<input type="text" class="form-control input-sm" id="cidadeU" name="cidadeU">
							<div class="form-group">
								<label>Tipo de Loja</label>
                      			<select name="tplojaU" id="tplojaU" class="form-control">
	                        	<option>Selecione::</option>
	                        	<option>Depósito</option>
	                        	<option>Loja</option>
	                        	</select>
							</div>
							<div class="form-group">
                      		<label>Centro de Distribuição</label>
                      		<select name="cdatendimentoU" id="cdatendimentoU" class="form-control">
	                        	<option>Selecione::</option>
	                        	<option>DEP-111</option>
	                        	<option>DEP-010</option>
	                        	<option>DEP-211</option>
                      		</select>
                    		</div>
							<p></p>
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>CNPJ</label>
							<input type="text" class="form-control input-sm" id="cnpjU" name="cnpjU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarLojaU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idloja){

			$.ajax({
				type:"POST",
				data:"idloja=" + idloja,
				url:"../procedimentos/lojas/obterDadosLoja.php",
				success:function(r){

					dado=jQuery.parseJSON(r);


					$('#idlojaU').val(dado['id_loja']);
					$('#numlojaU').val(dado['numero_loja']);
					$('#cidadeU').val(dado['cidade']);
					$('#tplojaU').val(dado['tipo_loja']);
					$('#cdatendimentoU').val(dado['cdatendimento']);
					$('#emailU').val(dado['email']);
					$('#cnpjU').val(dado['cnpj']);



				}
			});
		}

		function eliminarLoja(idloja){
			alertify.confirm('Deseja Excluir esta loja?', function(){ 
				$.ajax({
					type:"POST",
					data:"idloja=" + idloja,
					url:"../procedimentos/lojas/eliminarLojas.php",
					success:function(r){


						if(r==1){
							$('#tabelaLojasLoad').load("lojas/tabelaLojas.php");
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

			$('#tabelaLojasLoad').load("lojas/tabelaLojas.php");

			$('#btnAdicionarLoja').click(function(){

				vazios=validarFormVazio('frmLojas');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmLojas').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/lojas/adicionarLojas.php",
					success:function(r){

						if(r==1){
							$('#frmLojas')[0].reset();
							$('#tabelaLojasLoad').load("lojas/tabelaLojas.php");
							alertify.success("Loja Adicionada");
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
			$('#btnAdicionarLojaU').click(function(){
				dados=$('#frmLojasU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/lojas/atualizarLojas.php",
					success:function(r){



						if(r==1){
							$('#frmLojas')[0].reset();
							$('#tabelaLojasLoad').load("lojas/tabelaLojas.php");
							alertify.success("Loja atualizada com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar essa Loja");
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