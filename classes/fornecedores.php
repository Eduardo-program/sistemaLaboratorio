<?php 

class fornecedores{
	public function adicionar($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "INSERT into fornecedores (razao_social, endereco, email_for, telefone, cnpj_for) VALUES ('$dados[1]', '$dados[2]', 
		   '$dados[3]',
		   '$dados[4]',
			'$dados[5]')";



		return mysqli_query($conexao, $sql);
	}




	public function obterDados($id){
		$c = new conectar();
		$conexao=$c->conexao();

		$sql = "SELECT id_fornecedor, razao_social, endereco, email_for, telefone, cnpj_for from fornecedores where id_fornecedor='$id' ";

			$result = mysqli_query($conexao, $sql);
			$mostrar = mysqli_fetch_row($result);


			$dados = array(
				'id_fornecedor' => $mostrar[0],
				'razao_social' => $mostrar[1],
				'endereco' => $mostrar[2],
				'email_for' => $mostrar[3],
				'telefone' => $mostrar[4],
				'cnpj_for' => $mostrar[5],
			);

			return $dados;

	}


	public function atualizar($dados){
		$c = new conectar();
		$conexao=$c->conexao();

		

		$sql = "UPDATE fornecedores SET razao_social = '$dados[1]', endereco = '$dados[2]',email_for = '$dados[3]',telefone = '$dados[4]',cnpj_for = '$dados[5]' where id_fornecedor = '$dados[0]'";

		
		echo mysqli_query($conexao, $sql);
	}


	public function excluir($id){
		$c = new conectar();
		$conexao=$c->conexao();
		

		$sql = "DELETE from fornecedores where id_fornecedor = '$id' ";

		return mysqli_query($conexao, $sql);
	}

}

?>