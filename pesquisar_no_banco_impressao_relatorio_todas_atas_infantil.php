<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Consulta4 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` AND `arf` = 'S' ORDER BY arf_ord ");
$ContLinhas4 = mysqli_num_rows($Consulta4);
//
$Consulta4 = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$lista_id' ");
$linhaConsulta4 = mysqli_fetch_array($Consulta4, MYSQLI_BOTH);
$status = $linhaConsulta4['status'];

//
if ($ContLinhas4 > 0) {
    //
    //include 'ata_bimestre_media_infantil.php';
    //
} else {
    //No caso do aluno não ter histórico
    if ($status == "ADIMITIDO DEPOIS" || $status == "CURSANDO") {
        $status = "APROVADO";
    }
    // echo "<td class = 'nome'> $cont</td>";
    //
    for ($i = 1; $i < 11; $i++) {
        $html .= "<td class = 'nome'><p style = 'text-align: center; '><b>-----</b></td>";
    }

    $html .= "<td class = 'nome'><p style = 'text-align: center; '><b>$status</b></td>";
    $html .= '<td></td>';
    $html .= '<td>' . $nome_professores . '</td>';
    $html .= '<td>' . $nome_aux . '</td>';
    $html .= '<td>' . $nome_professores2 . '</td>';
    $html .= '<td>' . $nome_professores3 . '</td>';
}

                
