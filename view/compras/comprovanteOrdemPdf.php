<?php 
	require_once "../../classes/conexao.php";
	require_once "../../classes/ordens.php";

	$objv= new ordens();


	$c= new conectar();
	$conexao=$c->conexao();
	$idordem=$_GET['idordem'];

 $sql="SELECT ve.id_ordem,
		ve.dataabertura,
		ve.id_cliente,
		ve.id_produto,
		ve.observacao,
		pro.descricao,
		cli.numero_loja,
		cli.cdatendimento,
		cli.cidade
	from ordens as ve 
	inner join produtos as pro on ve.id_produto=pro.id_produto
	inner join lojas as cli on ve.id_cliente=cli.id_loja
	and ve.id_ordem='$idordem'";

	$result=mysqli_query($conexao,$sql);

	$ver=mysqli_fetch_row($result);

	$comp=$ver[0];
	$data=$ver[1];
	$idcliente=$ver[2];

 ?>	


 	<style type="text/css">
		
@page {
            margin-top: 0.3em;
            margin-left: 0.3em;
            margin-right: 0.3em;
            margin-bottom: 0.3em;
        }
    body{
    	font-size: xx-small;
    }
	</style>

 		
 		<p align="center" >LABORATORIO</p>
 		<p>#################################</p>
 		<p>
 			DATA: <?php echo date("d/m/Y", strtotime($data)) ?>
 		</p>
 		<p>
 			<?php echo $ver[7] ?>
 		</p>
 		<p>
 			ORDEM: <?php echo $ver[0] ?>
 		</p>
 		<p></p>
 		<p></p>
 		<p></p>
 		<p></p>
 		<p align="center">
 			                LOJA:: <?php echo $ver[6]  ?>
 		</p>
 		<p></p>
 		<p></p>
 		<p></p>
 		<p></p>
 		<p align="center">
 			<?php echo $ver[5] ?>
 		</p>
 		 <p>
 			<?php echo $ver[4] ?>
 		</p>

 		
 		

 		
