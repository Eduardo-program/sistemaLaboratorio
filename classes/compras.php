<?php 

class compras{
	public function adicionarCompra($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$data = date('d/m/Y');

		$sql = "INSERT into compras (id_user, id_produto, prazo, status, quantidade, data_lancamento) VALUES ('$dados[0]', '$dados[1]', 
		   '$dados[2]',
		   '$dados[3]',
			'$dados[4]',
			'$data')";



		return mysqli_query($conexao, $sql);
	}




	public function obterDadosCompra($idcompra){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_compra, id_produto, prazo, quantidade, status from compras where id_compra='$idcompra' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_compra' => $mostrar[0],
				'id_produto' => $mostrar[1],
				'prazo' => $mostrar[2],
				'quantidade' => $mostrar[3],
				'status' => $mostrar[4]
			);

			return $dados;

	}


	public function atualizarCompra($dados){
		$c = new conectar();
		$conexao=$c->conexao();


		$sql = "UPDATE compras SET id_produto = '$dados[1]', prazo = '$dados[2]', quantidade = '$dados[4]', status = '$dados[3]' where id_compra = '$dados[0]'";

		echo mysqli_query($conexao, $sql);
	}


	public function excluirCompra($id){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from compras where id_compra = '$id' ";

		return mysqli_query($conexao, $sql);
	}

	public function cotacaoCompra($id){
		$c = new conectar();
		$conexao=$c->conexao();
		
		$data = date('d/m/Y');
		$status = "Confirma Orçamento";

		$sql = "UPDATE compras SET status = '$status', data_cotacao = '$data'  where id_compra = '$id' ";

		return mysqli_query($conexao, $sql);
	}

	public function compraCompra($id){
		$c = new conectar();
		$conexao=$c->conexao();
		
		$data = date('d/m/Y');
		$status = "Confirma Compra";

		$sql = "UPDATE compras SET status = '$status', data_compra = '$data'  where id_compra = '$id' ";

		return mysqli_query($conexao, $sql);
	}

	public function recebeCompra($id){
		$c = new conectar();
		$conexao=$c->conexao();
		
		$data = date('d/m/Y');
		$status = "Confirma Recebimento";

		$sql = "UPDATE compras SET status = '$status', data_recebimento = '$data'  where id_compra = '$id' ";

		return mysqli_query($conexao, $sql);
	}
}

?>