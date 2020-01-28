<?php
include_once 'valida_cookies.inc'; //
include_once './inc.conf.php';
//
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$ano = "";
$ano = filter_input(INPUT_POST, "id", FILTER_DEFAULT);
//
$Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `ano` LIKE '%$ano%' ORDER BY turma ASC");
//
while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    $turma = $Registro["turma"];
    $turno = $Registro["turno"];
    $id_turma = $Registro["id"];
    $ano_turma = substr($Registro["ano"], 0, -6);
   
    echo "<td id = 'teste'><input type = 'checkbox' class = 'checkboxM' name = 'turma[]' value = '$id_turma' >&nbsp;&nbsp;$turma</td>";
}
                                    

