<?php
echo '<tr>';
//echo "<td class = 'nome'> $cont</td>";
echo "<td class = 'nome'> $nome </td>";
//Portugues//Portugues//Portugues
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '4'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
//$nota = $linhaConsulta2['nota'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<th class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano' AND `id_recuperacao_final_disciplina` = '4' ");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '4' AND `ano` = '$ano'");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        // $nota = $linhaConsulta2['media'];
        $nota = str_replace(".", ",", $linhaConsulta2['media']);

        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
// História         // História
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '8'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano' AND `id_recuperacao_final_disciplina` = '8' ");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '8' AND `ano` = '$ano'");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        //
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
//Geografia         Geografia
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '7'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano' AND `id_recuperacao_final_disciplina` = '7' ");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '7' AND `ano` = '$ano'");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        //
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
//Matematica            //Matematica
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '6'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);
if ($aprovado == "SIM") {
    echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano' AND `id_recuperacao_final_disciplina` = '6' ");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '6' AND `ano` = '$ano'");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        //
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
//Ciencias
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '2'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);
if ($aprovado == "SIM") {
    echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano' AND `id_recuperacao_final_disciplina` = '2' ");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '2' AND `ano` = '$ano'");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        //
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
////
//
//ARTE      //ARTE      //ARTE
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '9'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);
//
if ($aprovado == "SIM") {
    echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano' AND `id_recuperacao_final_disciplina` = '9' ");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '9' AND `ano` = '$ano'");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        //
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
//RELIGIAO               RELIGIAO                          RELIGIAO
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '12'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);
//
if ($aprovado == "SIM") {
    echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano' AND `id_recuperacao_final_disciplina` = '12' ");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '12' AND `ano` = '$ano'");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        //
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
//EDUCAÇÃO FISICA       //EDUCAÇÃO FISICA
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '3'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);
//
if ($aprovado == "SIM") {
    echo "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano' AND `id_recuperacao_final_disciplina` = '3' ");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '3' AND `ano` = '$ano'");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        //
        echo "<td class = 'nome' style = 'text-align: center;font-size:12px;'> $nota</td>";
    } else {
        echo "<td class = 'nome' style = 'text-align: center;font-size:12px;'> $nota</td>";
    }
}
//
//RESULTADO FINAL       //RESULTADO FINAL
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
//    
$horas = $linhaConsulta2['aluno'];
echo "<th style = 'font-size: 12px;'>$horas</th>";
//
$frequencia = $linhaConsulta2['frequencia'];
echo "<th style = 'font-size: 12px;'> $frequencia %</th>";
//
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
echo "<td  style = 'text-align: center; font-size:12px; padding-left: 4px; padding-right: 4px;'>RECUPERAÇÃO</td>";
echo "<td  style = 'text-align: center; font-size:12px; padding-left: 4px; padding-right: 4px; '>$nota</td>";
