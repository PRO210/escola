<?php

ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de matrícula (Método POST)
$matricula = filter_input(INPUT_POST, 'inputMatricula', FILTER_DEFAULT);
$vinculo = filter_input(INPUT_POST, 'inputVinculo', FILTER_DEFAULT);
$funcao = filter_input(INPUT_POST, 'inputFuncao', FILTER_DEFAULT);

$resumo_funcao = filter_input(INPUT_POST, 'inputResumoFuncao', FILTER_DEFAULT);
$resumo_funcao2 = filter_input(INPUT_POST, 'inputResumoFuncao2', FILTER_DEFAULT);
$resumo_turmas = filter_input(INPUT_POST, 'inputResumoTurmas', FILTER_DEFAULT);
$resumo_turmas_sim = filter_input(INPUT_POST, 'inputResumoSim', FILTER_DEFAULT);
$resumo_disciplinas = filter_input(INPUT_POST, 'inputResumoDisciplinas', FILTER_DEFAULT);
$resumo_anos = filter_input(INPUT_POST, 'inputResumoAnos', FILTER_DEFAULT);
$resumo_anos2 = filter_input(INPUT_POST, 'inputResumoAnos2', FILTER_DEFAULT);

$carga_horaria = filter_input(INPUT_POST, 'inputCarga_Horaria', FILTER_DEFAULT);
$mae = filter_input(INPUT_POST, 'inputMae', FILTER_DEFAULT);
$pai = filter_input(INPUT_POST, 'inputPai', FILTER_DEFAULT);
$nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
$nascimento = filter_input(INPUT_POST, 'inputNascimento', FILTER_DEFAULT);
//$data_nascimento = substr($nascimento, 6, 4) . '-' . substr($nascimento, 3, 2) . '-' . substr($nascimento, 0, 2);
$modelo_certidao = filter_input(INPUT_POST, 'inputModelo_Certidao', FILTER_DEFAULT);
$matricula_certidao = filter_input(INPUT_POST, 'inputMatricula_Certidao', FILTER_DEFAULT);
$tipos_de_certidao = filter_input(INPUT_POST, 'inputTiposCertidao', FILTER_DEFAULT);
$dados_certidao = filter_input(INPUT_POST, 'inputCertidao', FILTER_DEFAULT);
$estado_expedidor = filter_input(INPUT_POST, 'inputExpdd', FILTER_DEFAULT);
$orgao_expedidor = filter_input(INPUT_POST, 'inputOxp', FILTER_DEFAULT);
$expedicao = filter_input(INPUT_POST, 'inputExpedicao', FILTER_DEFAULT);
//$data_expedicao = substr($expedicao, 8, 2) . '-' . substr($expedicao, 5, 2) . '-' . substr($expedicao, 0, 4);
$cpf = filter_input(INPUT_POST, 'inputCpf', FILTER_DEFAULT);
$fone = filter_input(INPUT_POST, 'inputFone', FILTER_DEFAULT);
$celular = filter_input(INPUT_POST, 'inputCel', FILTER_DEFAULT);
$email = filter_input(INPUT_POST, 'inputEmail', FILTER_DEFAULT);
//
$SQL_matricular = "INSERT INTO servidores (`matricula`,`vinculo`,`funcao`, `resumo_funcao`,`resumo_funcao_2`,`resumo_turmas`,`resumo_anos`,`resumo_anos_2`,`resumo_disciplinas`,`resumo_turmas_sim`,`carga_horaria`,`turno`,`nome`,`nascimento`, `mae` , `pai` ,`cpf` , `modelo_certidao` , `matricula_certidao` , `tipos_de_certidao`,`dados_certidao`,`orgao_expedidor`, `estado_expedidor`,`data_expedicao`,`fone`,`celular`,`email` ) "
      . "VALUES ( '$matricula','$vinculo','$funcao', '$resumo_funcao','$resumo_funcao2','$resumo_turmas','$resumo_anos','$resumo_anos2', '$resumo_disciplinas','$resumo_turmas_sim','$carga_horaria', '$turno' ,'$nome', '$nascimento', '$mae' , '$pai' , '$cpf', '$modelo_certidao' , '$matricula_certidao' ,'$tipos_de_certidao','$dados_certidao', '$orgao_expedidor', '$estado_expedidor','$expedicao','$fone','$celular','$email');";
$Consulta = mysqli_query($Conexao, $SQL_matricular);
//
if ($Consulta2) {
    $id_matricular = mysqli_insert_id($Conexao);
    // echo "<a href='impressao.php?id=$id_matricular' target='_blank'>Imprimir Matricula</a>";
} else {
    echo mysqli_error($Conexao);
}
//Logar no sistema
$SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
      . "VALUES ( '$usuario_logado', 'Cadastrou o Servidor $nome ' , 'SIM',now())";
$Consulta1 = mysqli_query($Conexao, $SQL_logar);
//
if ($Consulta) {
    header("Location: servidores.php?id=1");
} else {
    header("Location: servidores.php?id=2");
}

