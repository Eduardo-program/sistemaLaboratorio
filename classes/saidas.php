<?php 

class saidas{
	public function obterDadosProduto($idproduto){
		$c= new conectar();
		$conexao=$c->conexao();

		$sql="SELECT fis.descricao, 
					isf.quantidade
		from produtos as fis 
		inner join estoque_produto as isf on fis.id_produto=isf.id_produto
		where fis.id_produto='$idproduto'";
		$result=mysqli_query($conexao,$sql);
		$ver=mysqli_fetch_row($result);
	$dados=array(
			'descricao' => $ver[0],
			'quantidade' => $ver[1]
		);		
		return $dados;
	}

	public function criarSaida(){
		$c= new conectar();
		$conexao=$c->conexao();

		$data=date('Y-m-d');
		$idsaida=self::criarComprovante();
		$dados=$_SESSION['tabelaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i < count($dados) ; $i++) { 
			$d=explode("||", $dados[$i]);

			$sqlX = "SELECT quantidade from estoque_produto where id_produto = '$d[0]' ";
			$result = mysqli_query($conexao, $sqlX);
			$mostrar = mysqli_fetch_row($result);
			$quantt = $mostrar[0];

			$quantNw = $quantt - $d[4];

			$sqlNew = "UPDATE estoque_produto SET quantidade=$quantNw where id_produto='$d[0]' ";
			$result = mysqli_query($conexao, $sqlNew);

			$sql="INSERT into saidas (id_saida,
										id_loja,
										id_produto,
										id_usuario,
										quantidade,
										datasaida)
							values ('$idsaida',
									'$d[5]',
									'$d[0]',
									'$idusuario',
									'$d[4]',
									'$data')";

			
			$r=$r + $result=mysqli_query($conexao,$sql);



		}

		return $r;
	}

	public function criarComprovante(){
		$c= new conectar();
		$conexao=$c->conexao();

		$sql="SELECT id_saida from saidas group by id_saida desc";

		$resul=mysqli_query($conexao,$sql);
		$mostrar = mysqli_fetch_row($resul);
		$id=$mostrar[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
}

?>