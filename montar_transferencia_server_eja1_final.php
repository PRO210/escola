<?php

//Portugues//Portugues//Portugues
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$eja1' AND `id_bimestre_media_disciplina` = '4'");
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
    echo "<th > $nota</th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '4' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '4' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);

        echo "<th > $nota</th>";
    } else {
        if ($optradioEja1 == "sim") {
            echo "<th style = 'color:red'>C</th>";
        } else {
            echo "<th > $nota</th>";
        }
    }
}
//
// História      // História
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$eja1' AND `id_bimestre_media_disciplina` = '8'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<th >----- </th>";
    echo "<th > $nota</th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '8' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '8' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);

        echo "<th >----- </th>";
        echo "<th > $nota</th>";
    } else {
        if ($optradioEja1 == "sim") {
            echo "<th style = 'color:red'>U</th>";
            echo "<th style = 'color:red'>R</th>";
        } else {
            echo "<th >----- </th>";
            echo "<th > $nota</th>";
        }
    }
}
//
// Geografia      // Geografia
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$eja1' AND `id_bimestre_media_disciplina` = '7'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<th > $nota</th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '7' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '7' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        echo "<th > $nota</th>";
    } else {
        if ($optradioEja1 == "sim") {
            echo "<th style = 'color:red'>S</th>";
        } else {
            echo "<th > $nota</th>";
        }
    }
}
//
// Ciencias      // Ciencias
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$eja1' AND `id_bimestre_media_disciplina` = '2'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<th > $nota</th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '2' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '2' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        echo "<th > $nota</th>";
    } else {
        if ($optradioEja1 == "sim") {
            echo "<th style = 'color:red'>A</th>";
        } else {
            echo "<th > $nota</th>";
        }
    }
}
//
// Arte      // Arte
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$eja1' AND `id_bimestre_media_disciplina` = '9'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<th >----- </th>";
    echo "<th > $nota</th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '9' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '9' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        echo "<th >----- </th>";
        echo "<th > $nota</th>";
    } else {
        if ($optradioEja1 == "sim") {
            echo "<th style = 'color:red'>N</th>";
            echo "<th style = 'color:red'>D</th>";
        } else {
            echo "<th >----- </th>";
            echo "<th > $nota</th>";
        }
    }
}
//
// Educação Fisíca      // Educação Fisíca
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$eja1' AND `id_bimestre_media_disciplina` = '3'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<th >----- </th>";
    echo "<th > $nota</th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '3' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '3' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);
        echo "<th >----- </th>";
        echo "<th > $nota</th>";
    } else {
        if ($optradioEja1 == "sim") {
            echo "<th style = 'color:red'>O</th>";
            echo "<th >----- </th>";
        } else {
            echo "<th >----- </th>";
            echo "<th > $nota</th>";
        }
    }
}
//
// Religião      // Religião
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$eja1' AND `id_bimestre_media_disciplina` = '12'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    // echo "<th >----- </th>";
    echo "<th > $nota</th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '12' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '12' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);

        echo "<th > $nota</th>";
    } else {

        echo "<th > $nota</th>";
    }
}
//
// Educação Fisíca      // Educação Fisíca
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND  `ano` = '$eja1' AND `id_bimestre_media_disciplina` = '6'");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
$aprovado = $linhaConsulta2['aprovado'];
$nota = str_replace(".", ",", $linhaConsulta2['nota']);

if ($aprovado == "SIM") {
    echo "<th > $nota</th>";
    echo "<th >----- </th>";
    echo "<th >----- </th>";
    echo "<th >----- </th>";
    echo "<th >----- </th>";
} else {
    $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '6' AND `bnc` = 'S' ORDER BY ficha_descritiva");
    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
    $aprovado2 = $linhaConsulta2['aprovado'];
    //
    if ($aprovado2 == "SIM") {
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$eja1' AND `id_recuperacao_final_disciplina` = '6' AND `bnc` = 'S' ORDER BY ficha_descritiva");
        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
        $nota = str_replace(".", ",", $linhaConsulta2['media']);

        echo "<th > $nota</th>";
        echo "<th >----- </th>";
        echo "<th >----- </th>";
        echo "<th >----- </th>";
        echo "<th >----- </th>";
    } else {
        echo "<th > $nota</th>";
        echo "<th >----- </th>";
        echo "<th >----- </th>";
        echo "<th >----- </th>";
        echo "<th >----- </th>";
    }
}
//