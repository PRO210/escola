<?php

//Portugues//Portugues//Portugues
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$ano2' AND `id_bimestre_media_disciplina` = '4'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
//
$frequencia = $linhaConsulta2['frequencia'];
$dias = $linhaConsulta2['escola'];
$escola_horas = $linhaConsulta2['aluno'];
$escola = $linhaConsulta2['escola_media'];
$cidade = $linhaConsulta2['cidade_media'];
$uf = $linhaConsulta2['uf'];
//
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '4' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '4' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
        //
    } else {
        //
        if ($optradio2 == "sim") {
            $pdf->Cell(10, 4, "  C", 1, 0, 'C');
        } else {
            $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
        }
        //
    }
}
//
// História      // História
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$ano2' AND `id_bimestre_media_disciplina` = '8'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $pdf->Cell(10, 4, " -----", 1, 0, 'C');
    $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '8' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '8' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);

        $pdf->Cell(10, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "  $nota", 1, 0, 'L');
    } else {
        //
        if ($optradio2 == "sim") {
            $pdf->Cell(10, 4, "U", 1, 0, 'C');
            $pdf->Cell(10, 4, "R", 1, 0, 'C');
        } else {
            $pdf->Cell(10, 4, " -----", 1, 0, 'C');
            $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
        }
        //       
    }
}
//
// Geografia      // Geografia
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$ano2' AND `id_bimestre_media_disciplina` = '7'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '7' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '7' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
    } else {
        //
        if ($optradio2 == "sim") {
            $pdf->Cell(10, 4, "S", 1, 0, 'C');
        } else {
            $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
        }
        //
    }
}

// Ciencias      // Ciencias
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$ano2' AND `id_bimestre_media_disciplina` = '2'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '2' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '2' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        echo "<th > $nota</th>";
    } else {
        //
        if ($optradio2 == "sim") {
            $pdf->Cell(10, 4, "  A", 1, 0, 'C');
        } else {
            $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
        }
        //       
    }
}

// Arte      // Arte
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$ano2' AND `id_bimestre_media_disciplina` = '9'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $pdf->Cell(15, 4, " -----", 1, 0, 'C');
    $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '9' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '9' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        $pdf->Cell(10, 4, " -----", 1, 0, 'C');
        $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
    } else {
        //
        if ($optradio2 == "sim") {
            $pdf->Cell(15, 4, " N", 1, 0, 'C');
            $pdf->Cell(10, 4, "  D", 1, 0, 'C');
        } else {
            $pdf->Cell(15, 4, " -----", 1, 0, 'C');
            $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
        }
        //
    }
}

// Educação Fisíca      // Educação Fisíca
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$ano2' AND `id_bimestre_media_disciplina` = '3'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $pdf->Cell(10, 4, " -----", 1, 0, 'C');
    $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '3' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '3' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        $pdf->Cell(10, 4, " -----", 1, 0, 'C');
        $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
    } else {
        //
        if ($optradio2 == "sim") {
            $pdf->Cell(10, 4, "  O", 1, 0, 'C');
            $pdf->Cell(10, 4, "  ", 1, 0, 'C');
        } else {
            $pdf->Cell(10, 4, " -----", 1, 0, 'C');
            $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
        }
        //
    }
}

// Educação Religiosa      // Educação Religiosa
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$ano2' AND `id_bimestre_media_disciplina` = '12'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '12' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '12' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);

        $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
    } else {
        $pdf->Cell(10, 4, "  $nota", 1, 0, 'C');
    }
}

// MATEMATICA      // MATEMATICA
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$ano2' AND `id_bimestre_media_disciplina` = '6'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    $pdf->Cell(10, 4, "   $nota", 1, 0, 'C');
    $pdf->Cell(15, 4, "  ----", 1, 0, 'C');
    $pdf->Cell(10, 4, "  ----", 1, 0, 'C');
    $pdf->Cell(15, 4, "  ----", 1, 0, 'C');
    $pdf->Cell(15, 4, "  ----", 1, 1, 'C');
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '6' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano2' AND `id_recuperacao_final_disciplina` = '6' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);

        $pdf->Cell(10, 4, "   $nota", 1, 0, 'C');
        $pdf->Cell(15, 4, "  ----", 1, 0, 'C');
        $pdf->Cell(10, 4, "  ----", 1, 0, 'C');
        $pdf->Cell(15, 4, "  ----", 1, 0, 'C');
        $pdf->Cell(15, 4, "  ----", 1, 1, 'C');
    } else {
        $pdf->Cell(10, 4, "   $nota", 1, 0, 'C');
        $pdf->Cell(15, 4, "  ----", 1, 0, 'C');
        $pdf->Cell(10, 4, "  ----", 1, 0, 'C');
        $pdf->Cell(15, 4, "  ----", 1, 0, 'C');
        $pdf->Cell(15, 4, "  ----", 1, 1, 'C');
    }
}
