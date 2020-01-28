<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//                        //
//////Portugues//Portugues//Portugues
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '4'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$resultado = $linhaConsulta2['status_bimestre_media'];
//
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota </td>";
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

        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota </td>";
    } else {
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota </td>";
    }
}
//
// História         // História
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '8'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
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
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
////
//Geografia         Geografia
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '7'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
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
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
//Matematica            //Matematica
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '6'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);
if ($aprovado == "SIM") {
    $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
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
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
//Ciencias                      //Ciencias
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '2'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);
if ($aprovado == "SIM") {
    $html .= "<td class = 'nome'> $nota</td>";
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
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//
//ARTE      //ARTE      //ARTE
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano' AND `id_bimestre_media_disciplina` = '9'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);
//
if ($aprovado == "SIM") {
    $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
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
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
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
    $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
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
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
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
    $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
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
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    } else {
        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
    }
}
//RESULTADO FINAL       //RESULTADO FINAL
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
//    
$horas = $linhaConsulta2['aluno'];
$html .= "<th> <p style = 'font-size: 12px;'>$horas</p> </th>";
//
$frequencia = $linhaConsulta2['frequencia'];
$html .= "<th> <p style = 'font-size: 12px;'>$frequencia %</p></th>";
//
$nota = $linhaConsulta2['status_bimestre_media'];
//
$Consulta3 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` AND `arf` = 'S' ORDER BY arf_ord ");
$ContLinhas3 = mysqli_num_rows($Consulta3);
$linhaConsulta3 = mysqli_fetch_array($Consulta3, MYSQLI_BOTH);
$recupera = $linhaConsulta3['bimestre_recupera'];
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
if ($recupera == "N") {
    $html .= "<td class = 'nome'><p style = 'text-align: center; '><b>$nota</b></p></td>";
     $html .= "<td> </td>";
     $html .= '<td>' . $nome_professores . '</td>';
    $html .= '<td>' . $nome_aux . '</td>';
    $html .= '<td>' . $nome_professores2 . '</td>';
    $html .= '<td>' . $nome_professores3 . '</td>';
} else {

    $html .= "<td  class = 'nome' style = 'text-align: center;font-weight: bold;'><b>RECUPERAÇÃO</b> </td>";
    $html .= "<td class = 'nome'><p style = 'text-align: center; '><b>$nota</b></p></td>";
    $html .= '<td>' . $nome_professores . '</td>';
    $html .= '<td>' . $nome_aux . '</td>';
     $html .= '<td>' . $nome_professores2 . '</td>';
    $html .= '<td>' . $nome_professores3 . '</td>';
}



