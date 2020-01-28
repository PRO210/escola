<?php
//
$consulta = "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano3' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ";
$Consulta2 = mysqli_query($Conexao, $consulta);
while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
    $nota = $linhaConsulta2['nota'];
    $frequencia = $linhaConsulta2['frequencia'];
    $dias = $linhaConsulta2['escola'];
    $escola_horas = $linhaConsulta2['aluno'];
    $escola = $linhaConsulta2['escola_media'];
    $cidade = $linhaConsulta2['cidade_media'];
    $uf = $linhaConsulta2['uf'];
    //  
    $nota = str_replace(".", ",", $linhaConsulta2['nota']);
    echo "<th>" . "$nota" . "</th>";
}
//
$Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano3' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'N' ORDER BY ficha_descritiva ");
while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
    $nota = $linhaConsulta2['nota'];
    $frequencia = $linhaConsulta2['frequencia'];
    $escola_horas = $linhaConsulta2['aluno'];
    $dias = $linhaConsulta2['escola'];
    $escola = $linhaConsulta2['escola_media'];
    $cidade = $linhaConsulta2['cidade_media'];
    $uf = $linhaConsulta2['uf'];
    //  
    $nota = str_replace(".", ",", $linhaConsulta2['nota']);
    //
    echo "<th>" . "$nota" . "</th>";
    //
}    