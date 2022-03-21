<?php 

class notas{
	public function adicionarNota($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$sqlU = "SELECT quantidade from estoque_produto where id_produto='$dados[1]' ";
		$result = mysqli_query($conexao, $sqlU);
		$mostrar = mysqli_fetch_row($result);
		$quantS = $mostrar[0];
		$quantN = $dados[3];
		$quantNew = $quantS + $quantN;

		$sqlN = "UPDATE estoque_produto SET quantidade=$quantNew where id_produto='$dados[1]' ";
		$result = mysqli_query($conexao, $sqlN);

		$data = date('Y-m-d');

		$sql = "INSERT into notas_fiscais ( numero_nota, id_produto, id_fornecedor, quantidade, preco, dataentrada ) VALUES ('$dados[0]', '$dados[1]', 
		   '$dados[2]',
		   '$quantN',
			'$dados[4]',
			'$data')";



		return mysqli_query($conexao, $sql);
	}




	public function obterDadosNota($idnota){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_nota, numero_nota, id_produto, id_fornecedor, quantidade, preco from notas_fiscais where id_nota='$idnota' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_nota' => $mostrar[0],
				'numero_nota' => $mostrar[1],
				'id_produto' => $mostrar[2],
				'id_fornecedor' => $mostrar[3],
				'quantidade' => $mostrar[4],
				'preco' => $mostrar[5],
			);

			return $dados;

	}


	public function atualizarNota($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE notas_fiscais SET numero_nota = '$dados[1]', id_produto = '$dados[2]',id_fornecedor = '$dados[3]',quantidade = '$dados[4]',preco = '$dados[5]' where id_nota = '$dados[0]'";


		echo mysqli_query($conexao, $sql);
	}


	public function excluirNota($id){
		$c = new conectar();
		$conexao=$c->conexao();

		$sqlV = "SELECT quantidade from notas_fiscais where id_nota = '$id' ";
		$result = mysqli_query($conexao, $sqlV);
		$mostrar = mysqli_fetch_row($result);
		$quantP = $mostrar[0];

		$sqlT = "SELECT id_produto from notas_fiscais where id_nota = '$id' ";
		$result = mysqli_query($conexao, $sqlT);
		$mostrar = mysqli_fetch_row($result);
		$idproduto = $mostrar[0];

		$sqlX = "SELECT quantidade from estoque_produto where id_produto = '$idproduto' ";
		$result = mysqli_query($conexao, $sqlX);
		$mostrar = mysqli_fetch_row($result);
		$quantt = $mostrar[0];

		$quantNw = $quantt - $quantP;

		$sqlNew = "UPDATE estoque_produto SET quantidade=$quantNw where id_produto='$idproduto' ";
		$result = mysqli_query($conexao, $sqlNew);
		

		$sql = "DELETE from notas_fiscais where id_nota = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>