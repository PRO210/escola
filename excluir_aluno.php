<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id = base64_decode($Recebe_id);
$Consulta = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR, data_nascimento, now()) AS idade FROM alunos WHERE `id` = '$id' ");
$linha = mysqli_fetch_array($Consulta);
$nome = $linha['nome'];
//
//Apaga o Histórico de Notas
//
$SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_i` WHERE `id_bimestreI_aluno` = '$id'");
//
$SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_ii` WHERE `id_bimestre_II_aluno` = '$id' ");
//
$SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_iii` WHERE `id_bimestre_III_aluno` = '$id' ");
//
$SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_iv` WHERE `id_bimestre_IV_aluno` = '$id' ");
//
$SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id' ");
//
$SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$id' ");
//
//Apaga da Tabela Solicitações
$sql_delete = mysqli_query($Conexao, "DELETE FROM `alunos_solicitacoes` WHERE `alunos_solicitacoes`.`id_solicitacao` = '$id'");
//
//Apaga os Registros
$sql_delete2 = mysqli_query($Conexao, "DELETE FROM `alunos` WHERE `alunos`.`id` = $id");
//
if ($sql_delete2) {
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
          . "VALUES ( '$usuario_logado', 'Excluiu Todos os Dados do aluno(a) $nome','SIM',now())";
    $Consulta = mysqli_query($Conexao, $SQL_logar);
    //
    header("LOCATION: alunos_geral.php?id=sucesso");
}
//




