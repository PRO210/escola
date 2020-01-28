<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once 'valida_cookies.inc';
?>
<?php
//include_once'./matricular.php';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$SQL_consulta_id = "SELECT * FROM `alunos` WHERE `id` = $id";
$Consulta = mysqli_query($Conexao, $SQL_consulta_id);
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$nome = $Linha["nome"];
$turma = $Linha["turma"];
?>
<?php
if($turma == "MATERNAL (MATUTINO)"){  
    $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    include_once 'impressao_transferencia_educacao_infantil.php';    
}elseif ($turma == "PRE I (MATUTINO)") {
    $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    include_once 'impressao_transferencia_educacao_infantil.php';    
}elseif ($turma == "PRE II (VESPERTINO)") {
    $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    include_once 'impressao_transferencia_educacao_infantil.php'; 
}else{
    $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    include_once 'impressao_transferencia_provisoria_tratamento.php';
}
