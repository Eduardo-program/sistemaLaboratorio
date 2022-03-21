<?php 

class ordens{
	public function adicionarOrdem($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$data = date('Y-m-d');

		$sql = "INSERT into ordens (id_cliente, id_produto, id_usuario, observacao, prazo, status, dataabertura) VALUES ('$dados[1]', '$dados[2]', 
		   '$dados[0]',
		   '$dados[4]',
			'$dados[3]',
			'$dados[5]',
			'$data')";



		return mysqli_query($conexao, $sql);
	}




	public function obterDadosOrdem($idordem){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_ordem, id_cliente, id_produto, prazo, observacao, status from ordens where id_ordem='$idordem' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_ordem' => $mostrar[0],
				'id_cliente' => $mostrar[1],
				'id_produto' => $mostrar[2],
				'prazo' => $mostrar[3],
				'observacao' => $mostrar[4],
				'status' => $mostrar[5],
			);

			return $dados;

	}


	public function atualizarOrdem($dados){
		$c = new conectar();
		$conexao=$c->conexao();


		$sql = "UPDATE ordens SET id_cliente = '$dados[1]', id_produto = '$dados[2]', prazo = '$dados[3]', observacao = '$dados[4]', status = '$dados[5]' where id_ordem = '$dados[0]'";

		echo mysqli_query($conexao, $sql);
	}


	public function excluirOrdem($id){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from ordens where id_ordem = '$id' ";

		return mysqli_query($conexao, $sql);
	}

	public function encerrarOrdem($id){
		$c = new conectar();
		$conexao=$c->conexao();
		
		$final = "Finalizado";

		$sql = "UPDATE ordens SET status = '$final' where id_ordem = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>