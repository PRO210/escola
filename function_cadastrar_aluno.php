<?php

include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$data = $_POST['data'];
$turma = $_POST['turma'];
//
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
$data_matricula_valida = $Registro["data_matricula_valida"];
//
$data1 = new DateTime($data_matricula_valida);
$data2 = new DateTime("$data");
$intervalo = $data1->diff($data2);
//echo "Intervalo é de {$intervalo->y} anos, {$intervalo->m} meses e {$intervalo->d} dias";
$idade = $intervalo->y;
$meses = $intervalo->m . "mese(s)";

//
$SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turma'";
$Consulta_turma = mysqli_query($Conexao, $SQL_turma);
$Linha_turma = mysqli_fetch_array($Consulta_turma);
//
$id_turma = $Linha_turma["id"];
$idade_turma = $Linha_turma["idade_turma"];
$nome_turma = $Linha_turma["turma"];
$turno_turma = $Linha_turma["turno"];
$turmaf = "$nome_turma($turno_turma)";
//
if ($idade < $idade_turma) {
    $html['msg'] = "O Aluno só tem $idade anos e $meses  logo muito novo para  o $turmaf!";
}
//
print_r(json_encode($html));
