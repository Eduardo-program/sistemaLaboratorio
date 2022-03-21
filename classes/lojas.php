<?php 

class lojas{
	public function adicionarLoja($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "INSERT into lojas (id_usuario, numero_loja, cidade, tipo_loja, email, cnpj, cdatendimento) VALUES ('$dados[0]', '$dados[1]', 
		   '$dados[2]',
		   '$dados[3]',
			'$dados[4]',
			'$dados[5]',
			'$dados[6]')";



		return mysqli_query($conexao, $sql);
	}




	public function obterDadosLoja($idloja){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_loja, tipo_loja, numero_loja, cidade, email, cnpj, cdatendimento from lojas where id_loja='$idloja' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_loja' => $mostrar[0],
				'tipo_loja' => $mostrar[1],
				'numero_loja' => $mostrar[2],
				'cidade' => $mostrar[3],
				'email' => $mostrar[4],
				'cnpj' => $mostrar[5],
				'cdatendimento' => $mostrar[6],
			);

			return $dados;

	}


	public function atualizarLoja($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE lojas SET tipo_loja = '$dados[3]', numero_loja = '$dados[1]',cidade = '$dados[2]',email = '$dados[4]',cnpj = '$dados[5]', cdatendimento = '$dados[6]' where id_loja = '$dados[0]'";


		echo mysqli_query($conexao, $sql);
	}


	public function excluirLoja($id){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from lojas where id_loja = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>