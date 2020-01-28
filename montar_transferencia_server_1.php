<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id_aluno = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);
$id_envia = base64_encode($id_aluno);
//
$frequencia = "";
$escola_horas = "";
$marcar = "";
$ano1 = "";
$ano1 = filter_input(INPUT_POST, 'inputAno1', FILTER_DEFAULT);
$optradio1 = filter_input(INPUT_POST, 'optradio1', FILTER_DEFAULT);
//
if (!$ano1 == "") {
    $marcar = "X";
}
$marcar2 = "";
$ano2 = "";
$ano2 = filter_input(INPUT_POST, 'inputAno2', FILTER_DEFAULT);
$optradio2 = filter_input(INPUT_POST, 'optradio2', FILTER_DEFAULT);
if (!$ano2 == "") {
    $marcar2 = "X";
}
//
$marcar3 = "";
$ano3 = "";
$ano3 = filter_input(INPUT_POST, 'inputAno3', FILTER_DEFAULT);
$optradio3 = filter_input(INPUT_POST, 'optradio3', FILTER_DEFAULT);

if (!$ano3 == "") {
    $marcar3 = "X";
}
//
$marcar4 = "";
$ano4 = "";
$ano4 = filter_input(INPUT_POST, 'inputAno4', FILTER_DEFAULT);
if (!$ano4 == "") {
    $marcar4 = "X";
}
//
$marcar5 = "";
$ano5 = "";
$ano5 = filter_input(INPUT_POST, 'inputAno5', FILTER_DEFAULT);
if (!$ano5 == "") {
    $marcar5 = "X";
}
//
$eja1 = "";
$eja1 = filter_input(INPUT_POST, 'inputEja1', FILTER_DEFAULT);
$optradioEja1 = filter_input(INPUT_POST, 'optradioEja1', FILTER_DEFAULT);
if ($eja1 == "") {
    $marcareja1 = "";
} else {
    $marcareja1 = "X";
}
$eja2 = "";
$eja2 = filter_input(INPUT_POST, 'inputEja2', FILTER_DEFAULT);
$optradioEja2 = filter_input(INPUT_POST, 'optradioEja2', FILTER_DEFAULT);

if ($eja2 == "") {
    $marcareja2 = "";
} else {
    $marcareja2 = "X";
}
$ano6 = "";
$ano7 = "";
$ano8 = "";
$ano9 = "";
$eja3 = "";
//
if (!$ano1 == "") {
    if (($ano1 == "$ano2") || ($ano1 == "$ano3") || ($ano1 == "$ano4") || ($ano1 == "$ano5") || ($ano1 == "$eja1") || ($ano1 == "$eja2")) {
        session_start();
        $_SESSION["erro1"] = "1";
        header("LOCATION: montar_transferencia_notas.php?id=$id_envia");
    }
}
if (!$ano2 == "") {
    if (($ano2 == "$ano3") || ($ano2 == "$ano4") || ($ano2 == "$ano5") || ($ano2 == "$eja1") || ($ano2 == "$eja2")) {
        session_start();
        $_SESSION["erro1"] = "1";
        header("LOCATION: montar_transferencia_notas.php?id=$id_envia");
    }
}
if (!$ano3 == "") {
    if (($ano3 == "$ano4") || ($ano3 == "$ano5") || ($ano3 == "$eja1") || ($ano3 == "$eja2")) {
        session_start();
        $_SESSION["erro1"] = "1";
        header("LOCATION: montar_transferencia_notas.php?id=$id_envia");
    }
}
if (!$ano4 == "") {
    if (($ano4 == "$ano5") || ($ano4 == "$eja1") || ($ano4 == "$eja2")) {
        session_start();
        $_SESSION["erro1"] = "1";
        header("LOCATION: montar_transferencia_notas.php?id=$id_envia");
    }
}
if (!$ano5 == "") {
    if (($ano5 == "$eja1") || ($ano5 == "$eja2")) {
        session_start();
        $_SESSION["erro1"] = "1";
        header("LOCATION: montar_transferencia_notas.php?id=$id_envia");
    }
}
if (!$eja1 == "") {
    if (($eja1 == "$eja2")) {
        session_start();
        $_SESSION["erro1"] = "1";
        header("LOCATION: montar_transferencia_notas.php?id=$id_envia");
    }
}
$dia = date('d');
$mes = date('m');
$ano = date('Y');
switch ($mes) {

    case 1: $mes = "Janeiro";
        break;
    case 2: $mes = "Fevereiro";
        break;
    case 3: $mes = "Março";
        break;
    case 4: $mes = "Abril";
        break;
    case 5: $mes = "Maio";
        break;
    case 6: $mes = "Junho";
        break;
    case 7: $mes = "Julho";
        break;
    case 8: $mes = "Agosto";
        break;
    case 9: $mes = "Setembro";
        break;
    case 10: $mes = "Outubro";
        break;
    case 11: $mes = "Novembro";
        break;
    case 12: $mes = "Dezembro";
        break;
}
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">             
        <title>TRANSFERÊNCIA NOTAS</title>
        <link href="css/montar_tranferencia.css" rel="stylesheet" type="text/css"/>
       
    </head>
    <!--    <body onload="window.print();window.close()">   -->
    <body>         
        <table width="100%" cellspacing="0" id="tb" style="border: solid black 1px; border-collapse: collapse;" >   
<!--            <tr>                  
                <th colspan="13">BASE NACIONAL COMUM</th>
                <th colspan="4">PARTE DIVERSIFICADA</th>
            </tr>-->
            <tr>                  
                <th colspan="2" style='border: solid black 1px; border-collapse: collapse;'>
                    <div class="disciplina" >
                        <p>COMPONENTES</p>
                        <p>CURRICULARES</p>                        
                    </div>                     
                </th>
                <?php
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `bnc` = 'S' ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
                    if ($disciplina == "PORTUGUÊS") {
                        $disciplina = "LINGUA PORTUGUESA";
                    } elseif ($disciplina == "INGLÊS") {
                        $disciplina = "MODERNA (INGLÊS) <BR>LÍNGUA ESTRANGEIRA";
                    } elseif ($disciplina == "ED. FÍSICA") {
                        $disciplina = "EDUCAÇÃO FÍSICA";
                    } elseif ($disciplina == "RELIGIÃO") {
                        $disciplina = "ENSINO RELIGIOSO";
                    } elseif ($disciplina == "CFBPS") {
                        $disciplina = "DE SÁUDE<br>E PROGRAMAS<br>CIÊNCIAS FÍSICA, BIO.";
                    }
                    //
                    echo "<th style='border: solid black 1px;'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2.7cm; font-size: 8.5px !important;' ><p>" . $disciplina . "</p></div></th>";
                }
                //
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `bnc` = 'N' ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
                    //
                    if ($disciplina == "INGLÊS") {
                        $disciplina = "MODERNA (INGLÊS)<br>LÍNGUA ESTRANGEIRA";
                    } elseif ($disciplina == "EDG") {
                        $disciplina = "GEOMÉTRICOS <br> DESENHOS<br>  ELEMENTOS DE";
                    }
                    echo "<th style='border: solid black 1px;'><div style=' writing-mode: vertical-lr; transform: rotate(180deg);  min-height: 2.7cm; font-size: 8.5px !important;'><p>" . $disciplina . "</p></div></th>";
                }
                ?> 
            </tr> 
            <tr>                  
                <th rowspan="6" >
                    <div class="disciplina margin_p" style="min-height: 18mm !important;">
                        <p> 1° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>
                        <p>1° ANO (&nbsp;<?php echo "$marcar"; ?>&nbsp;) </p>                         
                    </div>                     
                </th>
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";
                $escola = "";
                $cidade = "";
                $uf = "";
                if ($ano1 == "") {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                } else {

                    $consulta = "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano1' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ";
                    $Consulta2 = mysqli_query($Conexao, $consulta);
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $recupera = $linhaConsulta2['bimestre_recupera'];
                    }
                    if (!$recupera == "N") {
                        //No caso dos alunos passarem por média
                        include_once 'montar_transferencia_server_1ano.php';
                    } else {
                        //No caso dos alunos irem para recuperação
                        include_once 'montar_transferencia_server_1ano_final.php';
                    }
                }
                ?>
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Reprovado ( &nbsp;)
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento: <?php echo "$escola"; ?> </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo "$ano1"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade: <?php echo "$cidade"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Estado: <?php echo "$uf"; ?> </p></th> 
            </tr>
<!--            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL: ( )Plena&nbsp;&nbsp;&nbsp;&nbsp;Ano:</th> 
            </tr>       -->
            <!--2 ano-->      <!--2 ano-->       <!--2 ano-->     <!--2 ano-->         <!--2 ano-->                
            <tr>                  
                <th rowspan="7" style="font-size: 8.5px !important;" >
                    <div class="disciplina margin_p">
                        <p> I° FASE (&nbsp;<?php echo "$marcareja1"; ?>&nbsp;) </p>                     
                        <p> 2° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>
                        <p> 2° ANO (&nbsp;<?php echo "$marcar2"; ?>&nbsp;) </p>                      
                    </div>                     
                </th>
<!--                <th id="disciplina">%</th>-->
                <?php
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas`  ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
//                    echo "<th></th>";
                }
                ?>                  
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";
                $escola = "";
                $cidade = "";
                $uf = "";
                $recupera = "";
                if (!$ano2 == "") {
                    if ($recupera == "N") {

                        //No caso dos alunos passarem por média
                        include_once 'montar_transferencia_server_2ano.php';
                    } else {
                        //No caso dos alunos irem para recuperação
                        include_once 'montar_transferencia_server_2ano_final.php';
                    }
                } elseif (!$eja1 == "") {
                    if ($recupera == "N") {
                        //No caso dos alunos passarem por média
                        include_once 'montar_transferencia_server_eja1.php';
                    } else {
                        //No caso dos alunos irem para recuperação
                        include_once 'montar_transferencia_server_eja1_final.php';
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
                ?>
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Reprovado ( &nbsp;)
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento:<?php echo "$escola"; ?> </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo "$ano2  $eja1"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade:<?php echo "$cidade"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Estado:<?php echo "$uf"; ?> </p></th> 
            </tr>
            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL: </th> 
            </tr>

            <!--2 ano fim-->
            <!--3 ano-->     <!--3 ano-->    <!--3 ano-->    <!--3 ano-->    <!--3 ano-->
            <tr>                  
                <th rowspan="7">
                    <div class="disciplina margin_p">
<!--                        <p> I° FASE (&nbsp;&nbsp;) </p>-->
                        <p> 3° ANO (&nbsp;<?php echo "$marcar3"; ?>&nbsp;) </p>
                        <p> 3° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>

                    </div>                     
                </th>
<!--                <th id="disciplina">%</th>-->
                <?php
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas`  ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
//                    echo "<th></th>";
                }
                ?>                  
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";
                $escola = "";
                $cidade = "";
                $uf = "";
                if (!$ano3 == "") {
                    //                   
                    if ($recupera == "N") {
                        //No caso dos alunos passarem por média
                        include_once 'montar_transferencia_server_3ano.php';
                    } else {
                        //No caso dos alunos irem para recuperação
                        include_once 'montar_transferencia_server_3ano_final.php';
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
                //
                ?>
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Reprovado ( &nbsp;)
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento: <?php echo "$escola"; ?> </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo "$ano3"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade:<?php echo "$cidade"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Estado:<?php echo "$uf"; ?> </p></th> 
            </tr>
            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL: ( )Plena&nbsp;&nbsp;&nbsp;&nbsp;Ano:</th> 
            </tr>           
            <!--3 ano fim-->
            <!--4 ano -->               <!--4 ano -->                   <!--4 ano -->                   <!--4 ano -->
            <tr>                  
                <th rowspan="7" style="font-size: 8.5px !important;" >
                    <div class="disciplina margin_p">            
                        <p> II FASE (&nbsp;<?php echo "$marcareja2"; ?>&nbsp;) </p>
                        <p> 4° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>
                        <p> 4° ANO (&nbsp;<?php echo "$marcar4"; ?>&nbsp;) </p>
                    </div>                     
                </th>
<!--                <th id="disciplina">%</th>-->
                <?php
                $escola_horas = "";
                $frequencia = "";
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas`  ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
//                    echo "<th></th>";
                }
                ?>                  
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";
                $escola = "";
                $cidade = "";
                $uf = "";
                if (!$ano4 == "") {
                    if ($recupera == "N") {
                        //No caso dos alunos passarem por média
                        include_once 'montar_transferencia_server_4ano.php';
                    } else {
                        //No caso dos alunos irem para recuperação
                        include_once 'montar_transferencia_server_4ano_final.php';
                    }
                } elseif (!$eja2 == "") {
                    //
                    if ($recupera == "N") {
                        //No caso dos alunos passarem por média
                        include_once 'montar_transferencia_server_eja2.php';
                    } else {
                        //No caso dos alunos irem para recuperação
                        include_once 'montar_transferencia_server_eja2_final.php';
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
                ?>
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Reprovado ( &nbsp;)
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento:  <?php echo "$escola"; ?> </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo "$ano4"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade: <?php echo "$cidade"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Estado: <?php echo "$uf"; ?> </p></th> 
            </tr>
            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL: ( )Plena&nbsp;&nbsp;&nbsp;&nbsp;Ano:</th> 
            </tr>
            <!--4 ano fim-->
            <!--5 ano -->                     <!--5 ano -->                       <!--5 ano -->                     <!--5 ano -->                 <!--5 ano -->
            <tr>                  
                <th rowspan="7" >
                    <div class="disciplina margin_p">       
                        <p> 5° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>
                        <p> 5° ANO (&nbsp;<?php echo "$marcar5"; ?>&nbsp;) </p>
                    </div>                     
                </th>
<!--                <th id="disciplina">%</th>-->
                <?php
                $escola_horas = "";
                $frequencia = "";
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas`  ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
//                    echo "<th></th>";
                }
                ?>                  
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";
                $escola = "";
                $cidade = "";
                $uf = "";
                if ($ano5 == "") {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                } else {
                    $optradio5 = filter_input(INPUT_POST, 'optradio5', FILTER_DEFAULT);
                    //
                    if ($optradio5 == "NÃO") {
                        //
                        $consulta = "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano5' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ";
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

                            echo "<th>" . "$nota" . "</th>";
                        }
                        //
                        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano5' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'N' ORDER BY ficha_descritiva ");
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $nota = $linhaConsulta2['nota'];
                            $frequencia = $linhaConsulta2['frequencia'];
                            $escola_horas = $linhaConsulta2['aluno'];
                            $dias = $linhaConsulta2['escola'];
                            $escola = $linhaConsulta2['escola_media'];
                            $cidade = $linhaConsulta2['cidade_media'];
                            $uf = $linhaConsulta2['uf'];
                            //
                            //
                            echo "<th>" . "$nota" . "</th>";
                            //
                        }
                    } else {
                        $consulta = "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano5' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ";
                        $Consulta2 = mysqli_query($Conexao, $consulta);
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            //$nota = $linhaConsulta2['nota'];
                            $frequencia = $linhaConsulta2['frequencia'];
                            $dias = $linhaConsulta2['escola'];
                            $escola_horas = $linhaConsulta2['aluno'];
                            $escola = $linhaConsulta2['escola_media'];
                            $cidade = $linhaConsulta2['cidade_media'];
                            $uf = $linhaConsulta2['uf'];
                        }
                        $Consulta20 = "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano5' AND disciplinas.id = `id_recuperacao_final_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva";
                        $Consulta21 = mysqli_query($Conexao, $Consulta20);
                        while ($linhaConsulta21 = mysqli_fetch_array($Consulta21, MYSQLI_BOTH)) {
                            //$media = $linhaConsulta21['media'];
                            //
                            $media = str_replace(".", ",", $linhaConsulta21['media']);
                            echo "<th>" . "$media" . "</th>";
                            //
                        }
                        //
                        $Consulta20 = "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano5' AND disciplinas.id = `id_recuperacao_final_disciplina` AND `bnc` = 'N' ORDER BY ficha_descritiva";
                        $Consulta21 = mysqli_query($Conexao, $Consulta20);
                        while ($linhaConsulta21 = mysqli_fetch_array($Consulta21, MYSQLI_BOTH)) {
                            //$media = $linhaConsulta21['media'];
                            //
                            $media = str_replace(".", ",", $linhaConsulta21['media']);
                            echo "<th>" . "$media" . "</th>";
                            //
                        }
                    }
                }
//
                ?>
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Reprovado ( &nbsp;)
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento:  <?php echo "$escola"; ?> </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo "$ano5"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade: <?php echo "$cidade"; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <?php echo "$uf"; ?> </p></th> 
            </tr>
            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL: </th> 
            </tr>

            <!--5 ano fim-->
            <!--6 ano-->                  <!--6 ano fim-->              <!--6 ano fim-->                 <!--6 ano fim-->
            <tr>                  
                <th rowspan="7" style="font-size: 8.5px !important;">
                    <div class="disciplina margin_p">       
                        <p> III FASE(&nbsp;<?php echo ""; ?>&nbsp;) </p>
                        <p> 6° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>                       
                        <p> 6° ANO (&nbsp;<?php echo ""; ?>&nbsp;) </p>
                    </div>                     
                </th>
<!--                <th>%</th>-->
                <?php
                $escola_horas = "";
                $frequencia = "";
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas`  ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
//                    echo "<th></th>";
                }
                ?>                  
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";
                $escola = "";
                $cidade = "";
                $uf = "";
                if (!$ano6 == "") {

                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano6' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //

                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
//BNC = N
                if (!$ano5 == "") {
                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano6' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'N' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
                ?>
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento:  </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo ""; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade: 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Estado: </p></th> 
            </tr>
            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL:</th> 
            </tr>
            <!--6 ano fim-->
            <!--7 ano -->                                        <!--7 ano -->                                           <!--7 ano -->                                        <!--7 ano -->
            <tr>                  
                <th rowspan="7" >
                    <div class="disciplina margin_p">        
                        <p> 7° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>
                        <p> 7° ANO (&nbsp;<?php echo ""; ?>&nbsp;) </p>                       
                    </div>                     
                </th>
<!--                <th id="disciplina">%</th>-->
                <?php
                $escola_horas = "";
                $frequencia = "";
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas`  ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
//                    echo "<th></th>";
                }
                ?>                  
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";
                if (!$ano7 == "") {

                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        if ($nota == "0") {
                            $nota = "---";
                        }
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } elseif (!$eja3 == "") {
                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        if ($nota == "0") {
                            $nota = "---";
                        }
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
//BNC = N
                if (!$ano7 == "") {
                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'N' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        if ($nota == "0") {
                            $nota = "---";
                        }
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } elseif (!$eja3 == "") {
                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'N' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        if ($nota == "0") {
                            $nota = "---";
                        }
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
                ?>               
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Reprovado ( &nbsp;)
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento: </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo ""; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade: 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Estado: </p></th> 
            </tr>
            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL: </th> 
            </tr>
            <!--7 ano fim-->
            <!--8 ano--> 
            <tr>                  
                <th rowspan="7" >
                    <div class="disciplina margin_p" style="font-size: 8.5px !important;">      
                        <p> IV° FASE (&nbsp;<?php echo ""; ?>&nbsp;) </p> 
                        <p> 8° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>
                        <p> 8° ANO (&nbsp;<?php echo ""; ?>&nbsp;) </p> 
                    </div>                     
                </th>
<!--                <th id="disciplina">%</th>-->
                <?php
                $escola_horas = "";
                $frequencia = "";
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas`  ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
//                    echo "<th></th>";
                }
                ?>                  
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";
                if (!$ano8 == "") {

                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano8' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        if ($nota == "0") {
                            $nota = "---";
                        }
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
//BNC = N
                if (!$ano8 == "") {
                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano8' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'N' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        if ($nota == "0") {
                            $nota = "---";
                        }
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
                ?>               
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Reprovado ( &nbsp;)
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento:  </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo ""; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade: 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Estado: </p></th> 
            </tr>
            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL: </th> 
            </tr>           
            <!--8 ano fim--> 
            <!--9 ano -->                   <!--9 ano -->                 <!--9 ano -->                          <!--9 ano -->
            <tr>                  
                <th rowspan="6" >
                    <div class="disciplina margin_p">     
<!--                        <p> IV° FASE (&nbsp;<?php echo ""; ?>&nbsp;) </p>-->
                        <p> 9° ANO (&nbsp;<?php echo ""; ?>&nbsp;) </p>
<!--                        <p> 8° SÉRIE (&nbsp;&nbsp;&nbsp;) </p>-->
                    </div>                     
                </th>
<!--                <th id="disciplina">%</th>-->
                <?php
                $escola_horas = "";
                $frequencia = "";
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas`  ORDER BY ficha_descritiva");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    $disciplina = $linha['disciplina'];
                    $id = $linha['id'];
//                    echo "<th></th>";
                }
                ?>                  
            </tr> 
            <tr>               
                <th>Notas</th>
                <?php
                $escola_horas = "";
                $frequencia = "";
                $dias = "";

                if (!$ano9 == "") {

                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano9' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        if ($nota == "0") {
                            $nota = "---";
                        }
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
//BNC = N
                if (!$ano9 == "") {
                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano9' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'N' ORDER BY ficha_descritiva ");
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        $nota = $linhaConsulta2['nota'];
                        $frequencia = $linhaConsulta2['frequencia'];
                        $escola_horas = $linhaConsulta2['aluno'];
                        $dias = $linhaConsulta2['escola'];
                        //
                        if ($nota == "0") {
                            $nota = "---";
                        }
                        echo "<th>" . "$nota" . "</th>";
                        //
                    }
                } else {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'N' ORDER BY ficha_descritiva");
                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        echo "<th></th>";
                    }
                }
                ?>               
            </tr> 
            <tr>     
                <th>CH</th>
                <th id="numero"><?php echo "$dias"; ?></th>
                <th id="numero">D</th>
                <th id="numero">I</th>
                <th id="numero">A</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th id="numero">L</th>
                <th id="numero">E</th>
                <th id="numero">T</th>
                <th id="numero">I</th>
                <th id="numero">V</th>
                <th id="numero">O</th>
                <th id="numero">S</th>
                <th id="numero"></th>
                <th></th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Horas letivas:<?php echo "$escola_horas"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Frequência: <?php echo "$frequencia"; ?>%&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Progressão Plena(&nbsp; )                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Progressão Parcial( &nbsp;)                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Reprovado ( &nbsp;)
                </th>
            </tr>  
            <tr>
                <th colspan="16" class="texto">Estabelcimento: </th> 
            </tr>
            <tr>
                <th colspan="16" class="texto"><p id = "ano">Ano: <?php echo ""; ?> 
                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Cidade: 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Estado: </p></th> 
            </tr>
<!--            <tr>
                <th colspan="16" class="texto">RESULTADO APÓS PROGRESSÃO PARCIAL: ( )Plena&nbsp;&nbsp;&nbsp;&nbsp;Ano:</th> 
            </tr>-->
            <!--9 ano fim--> 
        </table>  
        <p style="text-align: center; margin: 0 auto;  margin-top: 6px; font-size: 10px" >REGISTRO DA PROGRESSÃO PARCIAL E EXAME ESPECIAL</p>
        <table width="100%" cellspacing="0" style="border: solid 1px black;">
            <tr>
                <th>ANO</th>
                <th>SÉRIE</th>
                <th>DISCIPLINA</th>
                <th>%</th>
                <th>NOTA</th>
                <th>RESULTADO</th>
                <th>UNIDADE DE ENSINO</th>
                <th>UNIDADE DE ENSINO</th>
            </tr>     
            <tr>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
                <td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>         
                <td> </td>         
            </tr>
            <tr>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>                 
                <td></td>                 
            </tr>
            <tr>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>                 
                <td></td>                 
            </tr>
            <tr>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>                 
                <td></td>                 
            </tr>
        </table>
        <p style="margin: auto; font-size: 12px;  text-align: center; ">Alagoinha,&nbsp;<?php echo "$dia" ?>&nbsp;de &nbsp;<?php echo "$mes" ?> de <?php echo "$ano" ?>.</p>       
        <div class = "rodape">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Secretário - Registro ou Matrícula
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </div>
        <div class= "rodape">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Diretor - Registro ou Matrícula
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </div>
    </body>
</html>
