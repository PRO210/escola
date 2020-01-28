<?php
echo '<tr>';
//echo "<td class = 'nome'> $cont</td>";
echo "<td class = 'nome'> $nome </td>";
//
$Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` AND `arf` = 'S' ORDER BY arf_ord ");
$ContLinhas = mysqli_num_rows($Consulta2);
while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
    //
    if ($linhaConsulta2['disciplina'] == ("DHC" ) || $linhaConsulta2['disciplina'] == ("EDUCAÇÃO ARTÍSTICA" )) {
        //echo "<th class = 'nome'>  </th>";
    } elseif ($linhaConsulta2['disciplina'] == ("DIREITO DA CIDADANIA") || $linhaConsulta2['disciplina'] == ("INFORMÁTICA" )) {
        // echo "<th class = 'nome'>---</th>";
    } elseif ($linhaConsulta2['disciplina'] == ("REDAÇÃO")) {
        //
        $horas = $linhaConsulta2['aluno'];
        echo "<th  style='font-size: 12px;'> $horas </th>";
        $frequencia = $linhaConsulta2['frequencia'];
        echo "<th  style='font-size: 12px;'> $frequencia %</th>";
        $nota = $linhaConsulta2['status_bimestre_media'];
        //     
        if ($nota == "3") {
            $nota = "TRANSFERIDO";
        } elseif ($nota == "4") {
            $nota = "DESISTENTE";
        } elseif ($nota == "5") {
            $nota = "APROVADO";
        } elseif ($nota == "6") {
            $nota = "REPROVADO";
        } else {
            $nota = "CURSANDO";
        }
        echo "<th style='font-size: 12px; padding-left: 4px; padding-right: 4px; font-weight: normal;'> $nota  </th>";
        //
    } elseif ($linhaConsulta2['disciplina'] == ("INGLÊS")) {
        $nota = str_replace(".", ",", $linhaConsulta2['nota']);
        // echo "<th class = 'nome'> $nota </th>";
    } else {       
        $nota = str_replace(".", ",", $linhaConsulta2['nota']);
        echo "<th class = 'nome'> $nota </th>";
    }
}
echo "<th class = 'nome'>  </th>"; //Necessário para completar a tabela
