<?php
include_once 'valida_cookies.inc';

include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");

function retorna($inputServidor, $Conexao){
	$result_aluno = "SELECT * FROM servidores WHERE nome = '$inputServidor' LIMIT 1";
	$resultado_aluno = mysqli_query($Conexao, $result_aluno);
	if($resultado_aluno->num_rows){
		$row_aluno = mysqli_fetch_assoc($resultado_aluno);
		$valores['inputFuncao'] = $row_aluno['funcao'];		
	}else{
		$valores['inputFuncao'] = 'Aluno não encontrado';
	}
	return json_encode($valores);
}

if(isset($_GET['inputServidor'])){
	echo retorna($_GET['inputServidor'], $Conexao);
}