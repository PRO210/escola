<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_exclusao = base64_decode($id);
$Consulta = mysqli_query($Conexao, "SELECT * FROM turmas WHERE id = $id_exclusao ");
$linha = mysqli_fetch_array($Consulta);
$turma = $linha['turma'];
$turno = $linha['turno'];
$tt = "$turma ($turno)";
//EXCLUI A TURMA DA TABELA TURMAS/PROFESSOR
 $SQL_DELETA = mysqli_query($Conexao, "DELETE FROM `turmas_professor2` WHERE `turmas_professor2`.`id_turma` = '$id_exclusao' ");
 //Exclui a turma da tabela turmas
$Consulta2 = mysqli_query($Conexao, "DELETE FROM `turmas` WHERE `id` = '" . $id_exclusao . "' ");
//Logar no sistema
$SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
        . "VALUES ( '$usuario_logado', 'Excluíu a turma do $tt e os seus respectivos professores','SIM',now())";
$Consulta3 = mysqli_query($Conexao, $SQL_logar);
//
if ($Consulta2) {

    header("location: pesquisar_turmas_server.php");
} else {
    echo mysqli_error($Conexao);
}

