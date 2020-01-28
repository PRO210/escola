<?php

$Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `arf` = 'S' ORDER BY arf_ord");
//
while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    //
    $disciplina = $linha['disciplina'];
    $id = $linha['id'];
    if ($disciplina == "PORTUGUÊS") {
        $disciplina = "PORTUGUESA";
        echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2cm; font-size: 12px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
    } elseif ($disciplina == "INGLÊS") {
        $disciplina = "ESPANHOL <br>INGLÊS OU";
        //echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2cm; font-size: 8px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
    } elseif ($disciplina == "ED. FÍSICA") {
        $disciplina = "EDUCAÇÃO FÍSICA";
        echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 3cm; font-size: 11px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
        //
    } elseif ($disciplina == "RELIGIÃO") {
        $disciplina = "RELIGIÃO";
        echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 3cm; font-size: 12px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
        //
    } elseif ($disciplina == "DIREITO DA CIDADANIA") {
        $disciplina = "CIDADANIA <br>DIREITO DA ";
        // echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2cm; font-size: 8px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
    } elseif ($disciplina == "HISTÓRIA") {
        echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2cm; font-size: 12px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
        //
    } elseif ($disciplina == "MATEMÁTICA") {
        echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2cm; font-size: 12px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
        //
    } elseif ($disciplina == "INFORMÁTICA") {
        //echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2cm; font-size: 8px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
    } elseif ($disciplina == "GEOGRAFIA" || $disciplina == "CIÊNCIAS" || $disciplina == "ARTE") {
        echo "<th class = 'thDisciplina'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2cm; font-size: 12px !important;' ><p class ='pDisciplina' >" . $disciplina . "</p></div></th>";
    }
}
echo "<th class = ''><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 3.2cm; min-width: 1cm ;font-size: 11px !important;' ><p class ='pDisciplina' > LETIVAS<BR>TOTAL DE HORAS</p></div></th>";
echo "<th class = ''><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 3.2cm; min-width: 1cm ;font-size: 11px !important;' ><p class ='pDisciplina' > DO ALUNO<BR>FREQUÊNCIA </p></div></th>";

echo "<th class = 'thDisciplina'><div style='font-size: 12px !important;' ><p class ='pDisciplina' >FINAL <BR> RESULTADO</p></div></th>";
echo "<th  style = 'border: solid  black thin;font-size: 12px !important;' class = 'nome'>RESULTADO FINAL <br>APÓS <br>RECUPERAÇÃO</th>";
echo "</tr>";
