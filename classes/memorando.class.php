<?php  

class Memorando{

	function cadMemorando($dados){
		//Cadastro de Memorando

		$c = new Conectar();
		$conexao = $c->conexao();

		$id_usuario = 1;
		$data = date("Y/m/d");
		//$emissor = "Emissor Memorando";
		$emissor = self::buscarFuncionario($id_usuario);

		$sql = "INSERT INTO tab_memorando(id_funcionario, id_usuario, id_local, emissor_memorando, data_memorando,destino_memorando, assunto_memorando, corpo_memorando) VALUES
		('$dados[0]','$id_usuario','$dados[1]','$emissor','$data','$dados[2]','$dados[3]','$dados[4]')";


		$result = mysqli_query($conexao, $sql);

		return $result;
	}

	function buscarFuncionario($id){
		//Buscar o nome do Funcionario de acordo com o usuario
		$c = new Conectar();
		$conexao = $c->conexao();

		$sql = "SELECT fun.nome_funcionario FROM tab_funcionario fun JOIN tab_usuario usu on fun.id_funcionario = usu.id_funcionario WHERE usu.id_usuario = '$id'";

		$result =  mysqli_query($conexao, $sql);

		$mostra = mysqli_fetch_row($result);

		return $mostra[0];

	}

	function getDadosMemorando($id_mem){
		//Selecionar Dados do Memorando

		$c = new Conectar();
		$conexao = $c->conexao();

		$sql = "SELECT mem.id_memorando, loc.nome_predio, mem.data_memorando, mem.assunto_memorando, mem.corpo_memorando FROM tab_memorando mem JOIN tab_local loc ON mem.id_local = loc.id_local WHERE id_memorando = '$id_mem'";

		$result =  mysqli_query($conexao, $sql);

		$mostra = mysqli_fetch_row($result);

		$dados = array(
			
			'idmemorando'   => $mostra[0],
			'nome_local'    => utf8_encode($mostra[1]),
			'data'          => $mostra[2],
			'assunto'       => utf8_encode($mostra[3]),
			'justificativa' => utf8_decode($mostra[4])

		);

		return $dados;

	}


	function updateMemorando($dados){
		//Atualizar Memorando

		$c = new Conectar();
		$conexao = $c->conexao();
		if ($dados[1] == "nulo") {
			$sql = "UPDATE tab_memorando SET data_memorando = '$dados[2]' , assunto_memorando = '$dados[3]', corpo_memorando = '$dados[4]' WHERE id_memorando = '$dados[0]';";
		}else{
			$sql = "UPDATE tab_memorando SET id_local = '$dados[1]', data_memorando = '$dados[2]' , assunto_memorando = '$dados[3]', corpo_memorando = '$dados[4]' WHERE id_memorando = '$dados[0]';";
		}

		$result =  mysqli_query($conexao, $sql);

		return $result;

	}


}

?>