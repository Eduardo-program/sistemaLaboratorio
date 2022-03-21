<?php 

class servicos{
	public function adicionarServico($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		$sqlU = "SELECT nome from usuarios where id='$dados[0]' ";
		$result = mysqli_query($conexao, $sqlU);
		$mostrarr = mysqli_fetch_row($result);
		$nome = $mostrarr[0];

		$sql = "INSERT into servicos (tecnico, id_loja, datainicio, datafim, observacao ) VALUES ('$nome', '$dados[1]', 
		   '$dados[2]',
		   '$dados[3]',
			'$dados[4]')";



		return mysqli_query($conexao, $sql);
	}




	public function obterDadosServico($idservico){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_servico, id_loja, datainicio, datafim, observacao from servicos where id_servico='$idservico' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_servico' => $mostrar[0],
				'id_loja' => $mostrar[1],
				'datainicio' => $mostrar[2],
				'datafim' => $mostrar[3],
				'observacao' => $mostrar[4],
			);

			return $dados;

	}


	public function atualizarServico($dados){
		$c = new conectar();
		$conexao=$c->conexao();


		$sql = "UPDATE servicos SET id_loja = '$dados[1]', datainicio = '$dados[2]', datafim = '$dados[3]', observacao = '$dados[4]' where id_servico = '$dados[0]'";

		echo mysqli_query($conexao, $sql);
	}


	public function excluirServico($id){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from servicos where id_servico = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>