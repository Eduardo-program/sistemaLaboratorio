<?php 

require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
?>


<h4>Baixa</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frmSaidasProdutos">
			<label>Selecionar Loja</label>
			<select class="form-control input-sm" id="clienteSaida" name="clienteSaida">
				<option value="A">Selecionar</option>
				<?php
				$sql="SELECT id_loja,numero_loja,cidade 
				from lojas";
				$result=mysqli_query($conexao,$sql);
				while ($cliente=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $cliente[0] ?>">Loja: <?php echo $cliente[1]." - ".$cliente[2] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Produto</label>
			<select class="form-control input-sm" id="produtoSaida" name="produtoSaida">
				<option value="A">Selecionar</option>
				<?php
				$sql="SELECT id_produto,
				descricao
				from produtos";
				$result=mysqli_query($conexao,$sql);

				while ($produto=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $produto[0] ?>"><?php echo $produto[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Quantidade Estoque</label>
			<input readonly="" type="text" class="form-control input-sm" id="quantEstoque" name="quantEstoque">
			<label>Quantidade Baixa</label>
			<input type="text" class="form-control input-sm" id="quantBaixa" name="quantBaixa">
			<p></p>
			<span class="btn btn-primary" id="btnAddSaida">Adicionar</span>
			<span class="btn btn-danger" id="btnLimparSaidas">Limpar Baixa</span>
		</form>
	</div>
	<div class="col-sm-4">
		<div id="tabelaSaidasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tabelaSaidasTempLoad').load("saidas/tabelaSaidasTemp.php");

		$('#produtoSaida').change(function(){

			$.ajax({
				type:"POST",
				data:"idproduto=" + $('#produtoSaida').val(),
				url:"../procedimentos/saidas/obterDadosProdutos.php",
				success:function(r){
					dado=jQuery.parseJSON(r);
					$('#quantEstoque').val(dado['quantidade']);
				}
			});
		});

		$('#btnAddSaida').click(function(){
			vazios=validarFormVazio('frmSaidasProdutos');
			
			quant = 0;
			quantidade = 1;

			/*quant = $('#quantBaixa').val();
			quantidade = $('#quantEstoque').val();*/




			if(quant > quantidade){
				alertify.alert("Quantidade é maior que estoque disponível.");
				quant = $('#quantEstoque').val("");
				return false;
			}else{
				quantidade = $('#quantBaixa').val();
			}

			if(vazios > 0){
				alertify.alert("Preencha os Campos!!");
				return false;
			}

			dados=$('#frmSaidasProdutos').serialize();
			$.ajax({
				type:"POST",
				data:dados,
				url:"../procedimentos/saidas/adicionarProdutoTemp.php",
				success:function(r){
					$('#tabelaSaidasTempLoad').load("saidas/tabelaSaidasTemp.php");
				}
			});
		});

		$('#btnLimparSaidas').click(function(){

		$.ajax({
			url:"../procedimentos/saidas/limparTemp.php",
			success:function(r){
				$('#tabelaSaidasTempLoad').load("saidas/tabelaSaidasTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">

	function editarP(dados){
		
		$.ajax({
			type:"POST",
			data:"dados=" + dados,
			url:"../procedimentos/saidas/editarEstoque.php",
			success:function(r){
				
				$('#tabelaSaidasTempLoad').load("saidas/tabelaSaidasTemp.php");
				alertify.success("Estoque Atualizado com Sucesso!!");
			}
		});
	}


	function fecharP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procedimentos/saidas/fecharProduto.php",
			success:function(r){
				$('#tabelaSaidasTempLoad').load("saidas/tabelaSaidasTemp.php");
				alertify.success("Produto Removido com Sucesso!!");
			}
		});
	}

	function criarSaida(){
		$.ajax({
			url:"../procedimentos/saidas/criarSaida.php",
			success:function(r){
				if(r > 0){
					$('#tabelaSaidasTempLoad').load("saidas/tabelaSaidasTemp.php");
					$('#frmSaidasProdutos')[0].reset();
					alertify.alert("Baixa Criada com Sucesso!");
				}else if(r==0){
					alertify.alert("Não possui lista de Baixa");
				}else{
					alertify.error("Baixa não efetuada");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteSaida').select2();
		$('#produtoSaida').select2();

	});
</script>