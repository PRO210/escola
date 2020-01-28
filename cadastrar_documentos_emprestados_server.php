<?php

include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de matrícula (Método POST)
$nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$nascimento = filter_input(INPUT_POST, 'inputNascimento', FILTER_DEFAULT);
//$nascimento = substr($nascimento, 6, 4) . '-' . substr($nascimento, 3, 2) . '-' . substr($nascimento, 0, 2);
$modelo_certidao = filter_input(INPUT_POST, 'InputModelo_certidao', FILTER_DEFAULT);
$matricula = filter_input(INPUT_POST, 'inputMatricula', FILTER_DEFAULT);
$tipos_de_certidao = filter_input(INPUT_POST, 'inputTiposCertidao', FILTER_DEFAULT);
$certidao = filter_input(INPUT_POST, 'inputCertidao', FILTER_DEFAULT);
$expedicao = filter_input(INPUT_POST, 'inputExpedicao', FILTER_DEFAULT);
$cpf = filter_input(INPUT_POST, 'inputCpf', FILTER_DEFAULT);
$celular = filter_input(INPUT_POST, 'inputCel', FILTER_DEFAULT);
$documentos = filter_input(INPUT_POST, 'inputDocumentos', FILTER_DEFAULT);
$emprestado = filter_input(INPUT_POST, 'inputEmprestado', FILTER_DEFAULT);
//$emprestado = substr($emprestado, 6, 4) . '-' . substr($emprestado, 3, 2) . '-' . substr($emprestado, 0, 2);
$devolucao = filter_input(INPUT_POST, 'inputDevolucao', FILTER_DEFAULT);
//$devolucao = substr($devolucao, 6, 4) . '-' . substr($devolucao, 3, 2) . '-' . substr($devolucao, 0, 2);
//Inserir dados no banco
$SQL_matricular = "INSERT INTO `documentos_emprestados` (`nome`,`nascimento`,`modelo_certidao`,`matricula_certidao`,`tipos_de_certidao`,`certidao`,`expedicao`,`cpf`,`celular`,`documentos`,`emprestado`,`devolucao`)"
        . "VALUES ('$nome','$nascimento','$modelo_certidao', '$matricula','$tipos_de_certidao','$certidao','$expedicao','$cpf','$celular','$documentos','$emprestado','$devolucao')";
$Consulta = mysqli_query($Conexao, $SQL_matricular);
//Logar no sistema
$SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
        . "VALUES ( '$usuario_logado','Emprestou esse(s) documentos: $documentos a $nome', 'SIM',now())";
$Consulta2 = mysqli_query($Conexao, $SQL_logar);

if ($Consulta && $Consulta2) {
    header("Location: pesquisar_documentos.php?id=1");
} else {
    header("Location: cadastrar_documentos_empretados.php?id=2");
}