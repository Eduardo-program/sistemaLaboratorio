<?php 

class produtos{
	public function adicionarProduto($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "INSERT into produtos (id_usuario, id_categoria, descricao, quantidade, preco, codigo_protheus) VALUES ('$dados[0]', '$dados[1]', 
		   '$dados[2]',
		   '$dados[3]',
			'$dados[4]',
			'$dados[5]')";

		return mysqli_query($conexao, $sql);
	}


	public function obterDadosProduto($idproduto){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_produto, id_categoria, descricao, quantidade, preco, codigo_protheus from produtos where id_produto='$idproduto' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_produto' => $mostrar[0],
				'id_categoria' => $mostrar[1],
				'descricao' => $mostrar[2],
				'quantidade' => $mostrar[3],
				'preco' => $mostrar[4],
				'codigo_protheus' => $mostrar[5],
			);

			return $dados;

	}


	public function atualizarProduto($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE produtos SET id_categoria = '$dados[1]', descricao = '$dados[2]',quantidade = '$dados[3]',preco = '$dados[4]',codigo_protheus = '$dados[5]' where id_produto = '$dados[0]'";


		echo mysqli_query($conexao, $sql);
	}


	public function excluirProduto($id){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from produtos where id_produto = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>