<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
$ano = filter_input(INPUT_POST, 'inputAno', FILTER_DEFAULT);
$Recebe_id = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$id_aluno = base64_decode($Recebe_id);

$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE id = '$id_aluno' ");
$Linha = mysqli_fetch_array($Consulta_backup, MYSQLI_BOTH);
$nome = $Linha['nome'];
//echo "$id_aluno";
$disciplina = filter_input(INPUT_POST, 'inputDisciplina', FILTER_DEFAULT);
$nota = filter_input(INPUT_POST, 'inputDisciplinaNota', FILTER_DEFAULT);
//
$disciplina_2 = filter_input(INPUT_POST, 'inputDisciplina_2', FILTER_DEFAULT);
$nota_2 = filter_input(INPUT_POST, 'inputDisciplinaNota_2', FILTER_DEFAULT);
//
$disciplina_3 = filter_input(INPUT_POST, 'inputDisciplina_3', FILTER_DEFAULT);
$nota_3 = filter_input(INPUT_POST, 'inputDisciplinaNota_3', FILTER_DEFAULT);
//
$disciplina_4 = filter_input(INPUT_POST, 'inputDisciplina_4', FILTER_DEFAULT);
$nota_4 = filter_input(INPUT_POST, 'inputDisciplinaNota_4', FILTER_DEFAULT);
//
$disciplina_5 = filter_input(INPUT_POST, 'inputDisciplina_5', FILTER_DEFAULT);
$nota_5 = filter_input(INPUT_POST, 'inputDisciplinaNota_5', FILTER_DEFAULT);
//
$disciplina_6 = filter_input(INPUT_POST, 'inputDisciplina_6', FILTER_DEFAULT);
$nota_6 = filter_input(INPUT_POST, 'inputDisciplinaNota_6', FILTER_DEFAULT);
//
$disciplina_7 = filter_input(INPUT_POST, 'inputDisciplina_7', FILTER_DEFAULT);
$nota_7 = filter_input(INPUT_POST, 'inputDisciplinaNota_7', FILTER_DEFAULT);
//
$disciplina_8 = filter_input(INPUT_POST, 'inputDisciplina_8', FILTER_DEFAULT);
$nota_8 = filter_input(INPUT_POST, 'inputDisciplinaNota_8', FILTER_DEFAULT);
//
$bimestre = filter_input(INPUT_POST, 'inputBimestre', FILTER_DEFAULT);

//echo"$bimestre";
//exit();

$aluno = filter_input(INPUT_POST, 'inputAluno', FILTER_DEFAULT);
$escola = filter_input(INPUT_POST, 'inputEscola', FILTER_DEFAULT);
$frequencia = filter_input(INPUT_POST, 'inputFrequencia', FILTER_DEFAULT);
$faltas = filter_input(INPUT_POST, 'inputFalta1', FILTER_DEFAULT);
$faltas2 = filter_input(INPUT_POST, 'inputFalta2', FILTER_DEFAULT);
$faltas3 = filter_input(INPUT_POST, 'inputFalta3', FILTER_DEFAULT);
$faltas4 = filter_input(INPUT_POST, 'inputFalta4', FILTER_DEFAULT);
$faltasM = filter_input(INPUT_POST, 'inputFaltaM', FILTER_DEFAULT);
//exit();
//
//
$Consulta0 = ("UPDATE `bimestre_media` SET `escola` = '$escola',`aluno` = '$aluno', `frequencia` = '$frequencia' WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
$SQL_Consulta0 = mysqli_query($Conexao, $Consulta0);

//
if ($bimestre == "B1") {
    $Consulta = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_I_disciplina` ORDER BY disciplina ");
//
    $Consulta2 = ("UPDATE `bimestre_i` SET `faltas` = '$faltas' WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    //
    while ($linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $notaBackup = $linhaConsulta['nota'];
        //
    }

    if ($nota !== "" && $disciplina !== "") {
        $Consulta22 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina' ORDER BY disciplina ");
        $Linha22 = mysqli_fetch_array($Consulta22, MYSQLI_BOTH);
        $nd22 = $Linha22['disciplina'];
        //
        $Consulta2 = ("UPDATE `bimestre_i` SET `nota` = '$nota' WHERE `id_bimestre_I_disciplina` = '$disciplina' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    } else {

        $_SESSION["erro1"] = "1";
    }
    if ($nota_2 !== "" && $disciplina_2 !== "") {
        $Consulta_22 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_2' ORDER BY disciplina ");
        $Linha_22 = mysqli_fetch_array($Consulta_22, MYSQLI_BOTH);
        $nd_22 = $Linha_22['disciplina'];
        //
        $Consulta_2 = ("UPDATE `bimestre_i` SET `nota` = '$nota_2'  WHERE `id_bimestre_I_disciplina` = '$disciplina_2' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_2 = mysqli_query($Conexao, $Consulta_2);
    } else {
        $_SESSION["erro_12"] = "1";
    }
    if ($nota_3 !== "" && $disciplina_3 !== "") {
        $Consulta_33 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_3' ORDER BY disciplina ");
        $Linha_33 = mysqli_fetch_array($Consulta_33, MYSQLI_BOTH);
        $nd_33 = $Linha_33['disciplina'];
        //
        $Consulta_3 = ("UPDATE `bimestre_i` SET `nota` = '$nota_3' WHERE `id_bimestre_I_disciplina` = '$disciplina_3' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_3 = mysqli_query($Conexao, $Consulta_3);
    } else {
        $_SESSION["erro_13"] = "1";
    }
    if ($nota_4 !== "" && $disciplina_4 !== "") {
        $Consulta_44 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_4' ORDER BY disciplina ");
        $Linha_44 = mysqli_fetch_array($Consulta_44, MYSQLI_BOTH);
        $nd_44 = $Linha_44['disciplina'];
        //
        $Consulta_4 = ("UPDATE `bimestre_i` SET `nota` = '$nota_4' WHERE `id_bimestre_I_disciplina` = '$disciplina_4' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_4 = mysqli_query($Conexao, $Consulta_4);
    } else {
        $_SESSION["erro_14"] = "1";
    }
    if ($nota_5 !== "" && $disciplina_5 !== "") {
        $Consulta_55 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_5' ORDER BY disciplina ");
        $Linha_55 = mysqli_fetch_array($Consulta_55, MYSQLI_BOTH);
        $nd_55 = $Linha_55['disciplina'];
        //
        $Consulta_5 = ("UPDATE `bimestre_i` SET `nota` = '$nota_5'  WHERE `id_bimestre_I_disciplina` = '$disciplina_5' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_5 = mysqli_query($Conexao, $Consulta_5);
    } else {
        $_SESSION["erro_15"] = "1";
    }
    if ($nota_6 !== "" && $disciplina_6 !== "") {
        $Consulta_66 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_6' ORDER BY disciplina ");
        $Linha_66 = mysqli_fetch_array($Consulta_66, MYSQLI_BOTH);
        $nd_66 = $Linha_66['disciplina'];
        //
        $Consulta_6 = ("UPDATE `bimestre_i` SET `nota` = '$nota_6' WHERE `id_bimestre_I_disciplina` = '$disciplina_6' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_6 = mysqli_query($Conexao, $Consulta_6);
    } else {
        $_SESSION["erro_16"] = "1";
    }
    if ($nota_7 !== "" && $disciplina_7 !== "") {
        $Consulta_77 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_7' ORDER BY disciplina ");
        $Linha_77 = mysqli_fetch_array($Consulta_77, MYSQLI_BOTH);
        $nd_77 = $Linha_77['disciplina'];
        //
        $Consulta_7 = ("UPDATE `bimestre_i` SET `nota` = '$nota_7'  WHERE `id_bimestre_I_disciplina` = '$disciplina_7' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_7 = mysqli_query($Conexao, $Consulta_7);
    } else {
        $_SESSION["erro_17"] = "1";
    }
    if ($nota_8 !== "" && $disciplina_8 !== "") {
        $Consulta_88 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_8' ORDER BY disciplina ");
        $Linha_88 = mysqli_fetch_array($Consulta_88, MYSQLI_BOTH);
        $nd_88 = $Linha_88['disciplina'];
        //
        $Consulta_8 = ("UPDATE `bimestre_i` SET `nota` = '$nota_8' WHERE `id_bimestre_I_disciplina` = '$disciplina_8' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' ");
        $SQL_Consulta_8 = mysqli_query($Conexao, $Consulta_8);
    } else {
        $_SESSION["erro_18"] = "1";
    }
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou a(s) Notas do(a) aluno(a) $nome Bimestre I  em: $nd22 = $nota, $nd_22 = $nota_2, $nd_33 = $nota_3, $nd_44 = $nota_4,"
            . "$nd_55 = $nota_5, $nd_66 = $nota_6, $nd_77 = $nota_7, $nd_88 = $nota_8' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);

    if ($Consulta1) {
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
    //
} elseif ($bimestre == "B2") {
    $Consulta = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_II_disciplina` ORDER BY disciplina ");
//
    $Consulta2 = ("UPDATE `bimestre_ii` SET `faltas` = '$faltas2' WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    //
    while ($linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $notaBackup = $linhaConsulta['nota'];
        //
    }
    if ($nota !== "") {
        $Consulta22 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina' ORDER BY disciplina ");
        $Linha22 = mysqli_fetch_array($Consulta22, MYSQLI_BOTH);
        $nd22 = $Linha22['disciplina'];
        //
        $Consulta2 = ("UPDATE `bimestre_ii` SET `nota` = '$nota' WHERE `id_bimestre_II_disciplina` = '$disciplina' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    } else {
        $_SESSION["erro_21"] = "1";
        print_r($_SESSION["erro_21"]);
    }
    if ($nota_2 !== "") {
        $Consulta_22 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_2' ORDER BY disciplina ");
        $Linha_22 = mysqli_fetch_array($Consulta_22, MYSQLI_BOTH);
        $nd_22 = $Linha_22['disciplina'];
        //
        $Consulta_2 = ("UPDATE `bimestre_ii` SET `nota` = '$nota_2' WHERE `id_bimestre_II_disciplina` = '$disciplina_2' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_2 = mysqli_query($Conexao, $Consulta_2);
    } else {
        $_SESSION["erro_22"] = "1";
    }
    if ($nota_3 !== "") {
        $Consulta_33 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_3' ORDER BY disciplina ");
        $Linha_33 = mysqli_fetch_array($Consulta_33, MYSQLI_BOTH);
        $nd_33 = $Linha_33['disciplina'];
        //
        $Consulta_3 = ("UPDATE `bimestre_ii` SET `nota` = '$nota_3' WHERE `id_bimestre_II_disciplina` = '$disciplina_3' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_3 = mysqli_query($Conexao, $Consulta_3);
    } else {
        $_SESSION["erro_23"] = "1";
        print_r($_SESSION["erro_23"]);
    }
    if ($nota_4 !== "") {
        $Consulta_44 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_4' ORDER BY disciplina ");
        $Linha_44 = mysqli_fetch_array($Consulta_44, MYSQLI_BOTH);
        $nd_44 = $Linha_44['disciplina'];
        //
        $Consulta_4 = ("UPDATE `bimestre_ii` SET `nota` = '$nota_4' WHERE `id_bimestre_II_disciplina` = '$disciplina_4' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_4 = mysqli_query($Conexao, $Consulta_4);
    }
    if ($nota_5 !== "") {
        $Consulta_55 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_5' ORDER BY disciplina ");
        $Linha_55 = mysqli_fetch_array($Consulta_55, MYSQLI_BOTH);
        $nd_55 = $Linha_55['disciplina'];
        //
        $Consulta_5 = ("UPDATE `bimestre_ii` SET `nota` = '$nota_5' WHERE `id_bimestre_II_disciplina` = '$disciplina_5' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_5 = mysqli_query($Conexao, $Consulta_5);
    }
    if ($nota_6 !== "") {
        $Consulta_66 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_6' ORDER BY disciplina ");
        $Linha_66 = mysqli_fetch_array($Consulta_66, MYSQLI_BOTH);
        $nd_66 = $Linha_66['disciplina'];
        //
        $Consulta_6 = ("UPDATE `bimestre_ii` SET `nota` = '$nota_6' WHERE `id_bimestre_II_disciplina` = '$disciplina_6' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_6 = mysqli_query($Conexao, $Consulta_6);
    }
    if ($nota_7 !== "") {
        $Consulta_77 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_7' ORDER BY disciplina ");
        $Linha_77 = mysqli_fetch_array($Consulta_77, MYSQLI_BOTH);
        $nd_77 = $Linha_77['disciplina'];
        //
        $Consulta_7 = ("UPDATE `bimestre_ii` SET `nota` = '$nota_7' WHERE `id_bimestre_II_disciplina` = '$disciplina_7' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_7 = mysqli_query($Conexao, $Consulta_7);
    }
    if ($nota_8 !== "") {
        $Consulta_88 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_8' ORDER BY disciplina ");
        $Linha_88 = mysqli_fetch_array($Consulta_88, MYSQLI_BOTH);
        $nd_88 = $Linha_88['disciplina'];
        //
        $Consulta_8 = ("UPDATE `bimestre_ii` SET `nota` = '$nota_8' WHERE `id_bimestre_II_disciplina` = '$disciplina_8' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_8 = mysqli_query($Conexao, $Consulta_8);
    }
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou a(s) Notas do(a) aluno(a) Bimestre II $nome em: $nd22 = $nota, $nd_22 = $nota_2, $nd_33 = $nota_3, $nd_44 = $nota_4,"
            . "$nd_55 = $nota_5, $nd_66 = $nota_6, $nd_77 = $nota_7, $nd_88 = $nota_8' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);

    if ($Consulta1) {
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
} elseif ($bimestre == "B3") {
    $Consulta = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_III_disciplina` ORDER BY disciplina ");
//
    $Consulta2 = ("UPDATE `bimestre_iii` SET `faltas` = '$faltas3' WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    //
    while ($linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $notaBackup = $linhaConsulta['nota'];
        //
    }
    if ($nota !== "") {
        $Consulta22 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina' ORDER BY disciplina ");
        $Linha22 = mysqli_fetch_array($Consulta22, MYSQLI_BOTH);
        $nd22 = $Linha22['disciplina'];
        //
        $Consulta2 = ("UPDATE `bimestre_iii` SET `nota` = '$nota' WHERE `id_bimestre_III_disciplina` = '$disciplina' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    if ($nota_2 !== "") {
        $Consulta_22 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_2' ORDER BY disciplina ");
        $Linha_22 = mysqli_fetch_array($Consulta_22, MYSQLI_BOTH);
        $nd_22 = $Linha_22['disciplina'];
        //
        $Consulta_2 = ("UPDATE `bimestre_iii` SET `nota` = '$nota_2' WHERE `id_bimestre_III_disciplina` = '$disciplina_2' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_2 = mysqli_query($Conexao, $Consulta_2);
    }
    if ($nota_3 !== "") {
        $Consulta_33 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_3' ORDER BY disciplina ");
        $Linha_33 = mysqli_fetch_array($Consulta_33, MYSQLI_BOTH);
        $nd_33 = $Linha_33['disciplina'];
        //
        $Consulta_3 = ("UPDATE `bimestre_iii` SET `nota` = '$nota_3' WHERE `id_bimestre_III_disciplina` = '$disciplina_3' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_3 = mysqli_query($Conexao, $Consulta_3);
    }
    if ($nota_4 !== "") {
        $Consulta_44 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_4' ORDER BY disciplina ");
        $Linha_44 = mysqli_fetch_array($Consulta_44, MYSQLI_BOTH);
        $nd_44 = $Linha_44['disciplina'];
        //
        $Consulta_4 = ("UPDATE `bimestre_iii` SET `nota` = '$nota_4' WHERE `id_bimestre_III_disciplina` = '$disciplina_4' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_4 = mysqli_query($Conexao, $Consulta_4);
    }
    if ($nota_5 !== "") {
        $Consulta_55 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_5' ORDER BY disciplina ");
        $Linha_55 = mysqli_fetch_array($Consulta_55, MYSQLI_BOTH);
        $nd_55 = $Linha_55['disciplina'];
        //
        $Consulta_5 = ("UPDATE `bimestre_iii` SET `nota` = '$nota_5' WHERE `id_bimestre_III_disciplina` = '$disciplina_5' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_5 = mysqli_query($Conexao, $Consulta_5);
    }
    if ($nota_6 !== "") {
        $Consulta_66 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_6' ORDER BY disciplina ");
        $Linha_66 = mysqli_fetch_array($Consulta_66, MYSQLI_BOTH);
        $nd_66 = $Linha_66['disciplina'];
        //
        $Consulta_6 = ("UPDATE `bimestre_iii` SET `nota` = '$nota_6' WHERE `id_bimestre_III_disciplina` = '$disciplina_6' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_6 = mysqli_query($Conexao, $Consulta_6);
    }
    if ($nota_7 !== "") {
        $Consulta_77 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_7' ORDER BY disciplina ");
        $Linha_77 = mysqli_fetch_array($Consulta_77, MYSQLI_BOTH);
        $nd_77 = $Linha_77['disciplina'];
        //
        $Consulta_7 = ("UPDATE `bimestre_iii` SET `nota` = '$nota_7' WHERE `id_bimestre_III_disciplina` = '$disciplina_7' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_7 = mysqli_query($Conexao, $Consulta_7);
    }
    if ($nota_8 !== "") {
        $Consulta_88 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_8' ORDER BY disciplina ");
        $Linha_88 = mysqli_fetch_array($Consulta_88, MYSQLI_BOTH);
        $nd_88 = $Linha_88['disciplina'];
        //
        $Consulta_8 = ("UPDATE `bimestre_iii` SET `nota` = '$nota_8' WHERE `id_bimestre_III_disciplina` = '$disciplina_8' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_8 = mysqli_query($Conexao, $Consulta_8);
    }
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou a(s) Notas do(a) aluno(a) $nome do Bimestre III em: $nd22 = $nota, $nd_22 = $nota_2, $nd_33 = $nota_3, $nd_44 = $nota_4,"
            . "$nd_55 = $nota_5, $nd_66 = $nota_6, $nd_77 = $nota_7, $nd_88 = $nota_8' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);

    if ($Consulta1) {
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
} elseif ($bimestre == 'B4') {
    $Consulta = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_IV_disciplina` ORDER BY disciplina ");
//
    $Consulta2 = ("UPDATE `bimestre_iv` SET `faltas` = '$faltas' WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    //
    while ($linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $notaBackup = $linhaConsulta['nota'];
        //
    }
    if ($nota !== "") {
        $Consulta22 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina' ORDER BY disciplina ");
        $Linha22 = mysqli_fetch_array($Consulta22, MYSQLI_BOTH);
        $nd22 = $Linha22['disciplina'];
        //
        $Consulta2 = ("UPDATE `bimestre_iv` SET `nota` = '$nota' WHERE `id_bimestre_IV_disciplina` = '$disciplina' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    if ($nota_2 !== "") {
        $Consulta_22 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_2' ORDER BY disciplina ");
        $Linha_22 = mysqli_fetch_array($Consulta_22, MYSQLI_BOTH);
        $nd_22 = $Linha_22['disciplina'];
        //
        $Consulta_2 = ("UPDATE `bimestre_iv` SET `nota` = '$nota_2' WHERE `id_bimestre_IV_disciplina` = '$disciplina_2' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_2 = mysqli_query($Conexao, $Consulta_2);
    }
    if ($nota_3 !== "") {
        $Consulta_33 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_3' ORDER BY disciplina ");
        $Linha_33 = mysqli_fetch_array($Consulta_33, MYSQLI_BOTH);
        $nd_33 = $Linha_33['disciplina'];
        //
        $Consulta_3 = ("UPDATE `bimestre_iv` SET `nota` = '$nota_3' WHERE `id_bimestre_IV_disciplina` = '$disciplina_3' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_3 = mysqli_query($Conexao, $Consulta_3);
    }
    if ($nota_4 !== "") {
        $Consulta_44 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_4' ORDER BY disciplina ");
        $Linha_44 = mysqli_fetch_array($Consulta_44, MYSQLI_BOTH);
        $nd_44 = $Linha_44['disciplina'];
        //
        $Consulta_4 = ("UPDATE `bimestre_iv` SET `nota` = '$nota_4' WHERE `id_bimestre_IV_disciplina` = '$disciplina_4' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_4 = mysqli_query($Conexao, $Consulta_4);
    }
    if ($nota_5 !== "") {
        $Consulta_55 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_5' ORDER BY disciplina ");
        $Linha_55 = mysqli_fetch_array($Consulta_55, MYSQLI_BOTH);
        $nd_55 = $Linha_55['disciplina'];
        //
        $Consulta_5 = ("UPDATE `bimestre_iv` SET `nota` = '$nota_5' WHERE `id_bimestre_IV_disciplina` = '$disciplina_5' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_5 = mysqli_query($Conexao, $Consulta_5);
    }
    if ($nota_6 !== "") {
        $Consulta_66 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_6' ORDER BY disciplina ");
        $Linha_66 = mysqli_fetch_array($Consulta_66, MYSQLI_BOTH);
        $nd_66 = $Linha_66['disciplina'];
        //
        $Consulta_6 = ("UPDATE `bimestre_iv` SET `nota` = '$nota_6' WHERE `id_bimestre_IV_disciplina` = '$disciplina_6' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_6 = mysqli_query($Conexao, $Consulta_6);
    }
    if ($nota_7 !== "") {
        $Consulta_77 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_7' ORDER BY disciplina ");
        $Linha_77 = mysqli_fetch_array($Consulta_77, MYSQLI_BOTH);
        $nd_77 = $Linha_77['disciplina'];
        //
        $Consulta_7 = ("UPDATE `bimestre_iv` SET `nota` = '$nota_7' WHERE `id_bimestre_IV_disciplina` = '$disciplina_7' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_7 = mysqli_query($Conexao, $Consulta_7);
    }
    if ($nota_8 !== "") {
        $Consulta_88 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_8' ORDER BY disciplina ");
        $Linha_88 = mysqli_fetch_array($Consulta_88, MYSQLI_BOTH);
        $nd_88 = $Linha_88['disciplina'];
        //
        $Consulta_8 = ("UPDATE `bimestre_iv` SET `nota` = '$nota_8' WHERE `id_bimestre_IV_disciplina` = '$disciplina_8' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_8 = mysqli_query($Conexao, $Consulta_8);
    }
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou a(s) Notas do(a) aluno(a) do Bimestre IV $nome em: $nd22 = $nota, $nd_22 = $nota_2, $nd_33 = $nota_3, $nd_44 = $nota_4,"
            . "$nd_55 = $nota_5, $nd_66 = $nota_6, $nd_77 = $nota_7, $nd_88 = $nota_8' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta1) {
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
    //
} elseif ($bimestre == "Bmedia") {
    $Consulta = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` ORDER BY disciplina ");
//
    $Consulta2 = ("UPDATE `bimestre_media` SET `faltas` = '$faltas' WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    //
    while ($linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $notaBackup = $linhaConsulta['nota'];
        //
    }
    if ($nota !== "") {
        $Consulta22 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina' ORDER BY disciplina ");
        $Linha22 = mysqli_fetch_array($Consulta22, MYSQLI_BOTH);
        $nd22 = $Linha22['disciplina'];
        //
        $Consulta2 = ("UPDATE `bimestre_media` SET `nota` = '$nota' WHERE `id_bimestre_media_disciplina` = '$disciplina' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    if ($nota_2 !== "") {
        $Consulta_22 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_2' ORDER BY disciplina ");
        $Linha_22 = mysqli_fetch_array($Consulta_22, MYSQLI_BOTH);
        $nd_22 = $Linha_22['disciplina'];
        //
        $Consulta_2 = ("UPDATE `bimestre_media` SET `nota` = '$nota_2' WHERE `id_bimestre_media_disciplina` = '$disciplina_2' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_2 = mysqli_query($Conexao, $Consulta_2);
    }
    if ($nota_3 !== "") {
        $Consulta_33 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_3' ORDER BY disciplina ");
        $Linha_33 = mysqli_fetch_array($Consulta_33, MYSQLI_BOTH);
        $nd_33 = $Linha_33['disciplina'];
        //
        $Consulta_3 = ("UPDATE `bimestre_media` SET `nota` = '$nota_3' WHERE `id_bimestre_media_disciplina` = '$disciplina_3' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_3 = mysqli_query($Conexao, $Consulta_3);
    }
    if ($nota_4 !== "") {
        $Consulta_44 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_4' ORDER BY disciplina ");
        $Linha_44 = mysqli_fetch_array($Consulta_44, MYSQLI_BOTH);
        $nd_44 = $Linha_44['disciplina'];
        //
        $Consulta_4 = ("UPDATE `bimestre_media` SET `nota` = '$nota_4' WHERE `id_bimestre_media_disciplina` = '$disciplina_4' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_4 = mysqli_query($Conexao, $Consulta_4);
    }
    if ($nota_5 !== "") {
        $Consulta_55 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_5' ORDER BY disciplina ");
        $Linha_55 = mysqli_fetch_array($Consulta_55, MYSQLI_BOTH);
        $nd_55 = $Linha_55['disciplina'];
        //
        $Consulta_5 = ("UPDATE `bimestre_media` SET `nota` = '$nota_5' WHERE `id_bimestre_media_disciplina` = '$disciplina_5' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_5 = mysqli_query($Conexao, $Consulta_5);
    }
    if ($nota_6 !== "") {
        $Consulta_66 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_6' ORDER BY disciplina ");
        $Linha_66 = mysqli_fetch_array($Consulta_66, MYSQLI_BOTH);
        $nd_66 = $Linha_66['disciplina'];
        //
        $Consulta_6 = ("UPDATE `bimestre_media` SET `nota` = '$nota_6' WHERE `id_bimestre_media_disciplina` = '$disciplina_6' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_6 = mysqli_query($Conexao, $Consulta_6);
    }
    if ($nota_7 !== "") {
        $Consulta_77 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_7' ORDER BY disciplina ");
        $Linha_77 = mysqli_fetch_array($Consulta_77, MYSQLI_BOTH);
        $nd_77 = $Linha_77['disciplina'];
        //
        $Consulta_7 = ("UPDATE `bimestre_media` SET `nota` = '$nota_7' WHERE `id_bimestre_media_disciplina` = '$disciplina_7' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_7 = mysqli_query($Conexao, $Consulta_7);
    }
    if ($nota_8 !== "") {
        $Consulta_88 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_8' ORDER BY disciplina ");
        $Linha_88 = mysqli_fetch_array($Consulta_88, MYSQLI_BOTH);
        $nd_88 = $Linha_88['disciplina'];
        //
        $Consulta_8 = ("UPDATE `bimestre_media` SET `nota` = '$nota_8' WHERE `id_bimestre_media_disciplina` = '$disciplina_8' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_8 = mysqli_query($Conexao, $Consulta_8);
    }
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou a(s) Notas do(a) aluno(a) do Bimestre Média Final $nome em: $nd22 = $nota, $nd_22 = $nota_2, $nd_33 = $nota_3, $nd_44 = $nota_4,"
            . "$nd_55 = $nota_5, $nd_66 = $nota_6, $nd_77 = $nota_7, $nd_88 = $nota_8' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    //
    if ($Consulta1) {
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
    //
} elseif ($bimestre == "recuperacao") {
    $Consulta = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_recuperacao_final_disciplina` ORDER BY disciplina ");

    while ($linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $notaBackup = $linhaConsulta['nota'];
        //
    }
    if ($nota !== "") {
        $Consulta22 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina' ORDER BY disciplina ");
        $Linha22 = mysqli_fetch_array($Consulta22, MYSQLI_BOTH);
        $nd22 = $Linha22['disciplina'];
        //
        $Consulta2 = ("UPDATE `recuperacao_final` SET `nota` = '$nota' WHERE `id_recuperacao_final_disciplina` = '$disciplina' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    if ($nota_2 !== "") {
        $Consulta_22 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_2' ORDER BY disciplina ");
        $Linha_22 = mysqli_fetch_array($Consulta_22, MYSQLI_BOTH);
        $nd_22 = $Linha_22['disciplina'];
        //
        $Consulta_2 = ("UPDATE `recuperacao_final` SET `nota` = '$nota_2' WHERE `id_recuperacao_final_disciplina` = '$disciplina_2' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_2 = mysqli_query($Conexao, $Consulta_2);
    }
    if ($nota_3 !== "") {
        $Consulta_33 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_3' ORDER BY disciplina ");
        $Linha_33 = mysqli_fetch_array($Consulta_33, MYSQLI_BOTH);
        $nd_33 = $Linha_33['disciplina'];
        //
        $Consulta_3 = ("UPDATE `recuperacao_final` SET `nota` = '$nota_3' WHERE `id_recuperacao_final_disciplina` = '$disciplina_3' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_3 = mysqli_query($Conexao, $Consulta_3);
    }
    if ($nota_4 !== "") {
        $Consulta_44 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_4' ORDER BY disciplina ");
        $Linha_44 = mysqli_fetch_array($Consulta_44, MYSQLI_BOTH);
        $nd_44 = $Linha_44['disciplina'];
        //
        $Consulta_4 = ("UPDATE `recuperacao_final` SET `nota` = '$nota_4' WHERE `id_recuperacao_final_disciplina` = '$disciplina_4' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_4 = mysqli_query($Conexao, $Consulta_4);
    }
    if ($nota_5 !== "") {
        $Consulta_55 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_5' ORDER BY disciplina ");
        $Linha_55 = mysqli_fetch_array($Consulta_55, MYSQLI_BOTH);
        $nd_55 = $Linha_55['disciplina'];
        //
        $Consulta_5 = ("UPDATE `recuperacao_final` SET `nota` = '$nota_5' WHERE `id_recuperacao_final_disciplina` = '$disciplina_5' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_5 = mysqli_query($Conexao, $Consulta_5);
    }
    if ($nota_6 !== "") {
        $Consulta_66 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_6' ORDER BY disciplina ");
        $Linha_66 = mysqli_fetch_array($Consulta_66, MYSQLI_BOTH);
        $nd_66 = $Linha_66['disciplina'];
        //
        $Consulta_6 = ("UPDATE `recuperacao_final` SET `nota` = '$nota_6' WHERE `id_recuperacao_final_disciplina` = '$disciplina_6' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_6 = mysqli_query($Conexao, $Consulta_6);
    }
    if ($nota_7 !== "") {
        $Consulta_77 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_7' ORDER BY disciplina ");
        $Linha_77 = mysqli_fetch_array($Consulta_77, MYSQLI_BOTH);
        $nd_77 = $Linha_77['disciplina'];
        //
        $Consulta_7 = ("UPDATE `recuperacao_final` SET `nota` = '$nota_7' WHERE `id_recuperacao_final_disciplina` = '$disciplina_7' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_7 = mysqli_query($Conexao, $Consulta_7);
    }
    if ($nota_8 !== "") {
        $Consulta_88 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_8' ORDER BY disciplina ");
        $Linha_88 = mysqli_fetch_array($Consulta_88, MYSQLI_BOTH);
        $nd_88 = $Linha_88['disciplina'];
        //
        $Consulta_8 = ("UPDATE `recuperacao_final` SET `nota` = '$nota_8' WHERE `id_recuperacao_final_disciplina` = '$disciplina_8' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_8 = mysqli_query($Conexao, $Consulta_8);
    }
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou a(s) Notas do(a) aluno(a) da Recuperação Final $nome em: $nd22 = $nota, $nd_22 = $nota_2, $nd_33 = $nota_3, $nd_44 = $nota_4,"
            . "$nd_55 = $nota_5, $nd_66 = $nota_6, $nd_77 = $nota_7, $nd_88 = $nota_8' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    //
    if ($Consulta1) {
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
    //
} elseif ($bimestre == "recuperacao_media") {
    $Consulta = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_recuperacao_final_disciplina` ORDER BY disciplina ");

    while ($linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $notaBackup = $linhaConsulta['media'];
        //
    }
    if ($nota !== "") {
        $Consulta22 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina' ORDER BY disciplina ");
        $Linha22 = mysqli_fetch_array($Consulta22, MYSQLI_BOTH);
        $nd22 = $Linha22['disciplina'];
        //
        $Consulta2 = ("UPDATE `recuperacao_final` SET `media` = '$nota' WHERE `id_recuperacao_final_disciplina` = '$disciplina' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    if ($nota_2 !== "") {
        $Consulta_22 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_2' ORDER BY disciplina ");
        $Linha_22 = mysqli_fetch_array($Consulta_22, MYSQLI_BOTH);
        $nd_22 = $Linha_22['disciplina'];
        //
        $Consulta_2 = ("UPDATE `recuperacao_final` SET `media` = '$nota_2' WHERE `id_recuperacao_final_disciplina` = '$disciplina_2' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_2 = mysqli_query($Conexao, $Consulta_2);
    }
    if ($nota_3 !== "") {
        $Consulta_33 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_3' ORDER BY disciplina ");
        $Linha_33 = mysqli_fetch_array($Consulta_33, MYSQLI_BOTH);
        $nd_33 = $Linha_33['disciplina'];
        //
        $Consulta_3 = ("UPDATE `recuperacao_final` SET `media` = '$nota_3' WHERE `id_recuperacao_final_disciplina` = '$disciplina_3' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_3 = mysqli_query($Conexao, $Consulta_3);
    }
    if ($nota_4 !== "") {
        $Consulta_44 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_4' ORDER BY disciplina ");
        $Linha_44 = mysqli_fetch_array($Consulta_44, MYSQLI_BOTH);
        $nd_44 = $Linha_44['disciplina'];
        //
        $Consulta_4 = ("UPDATE `recuperacao_final` SET `media` = '$nota_4' WHERE `id_recuperacao_final_disciplina` = '$disciplina_4' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_4 = mysqli_query($Conexao, $Consulta_4);
    }
    if ($nota_5 !== "") {
        $Consulta_55 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_5' ORDER BY disciplina ");
        $Linha_55 = mysqli_fetch_array($Consulta_55, MYSQLI_BOTH);
        $nd_55 = $Linha_55['disciplina'];
        //
        $Consulta_5 = ("UPDATE `recuperacao_final` SET `media` = '$nota_5' WHERE `id_recuperacao_final_disciplina` = '$disciplina_5' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_5 = mysqli_query($Conexao, $Consulta_5);
    }
    if ($nota_6 !== "") {
        $Consulta_66 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_6' ORDER BY disciplina ");
        $Linha_66 = mysqli_fetch_array($Consulta_66, MYSQLI_BOTH);
        $nd_66 = $Linha_66['disciplina'];
        //
        $Consulta_6 = ("UPDATE `recuperacao_final` SET `media` = '$nota_6' WHERE `id_recuperacao_final_disciplina` = '$disciplina_6' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_6 = mysqli_query($Conexao, $Consulta_6);
    }
    if ($nota_7 !== "") {
        $Consulta_77 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_7' ORDER BY disciplina ");
        $Linha_77 = mysqli_fetch_array($Consulta_77, MYSQLI_BOTH);
        $nd_77 = $Linha_77['disciplina'];
        //
        $Consulta_7 = ("UPDATE `recuperacao_final` SET `media` = '$nota_7' WHERE `id_recuperacao_final_disciplina` = '$disciplina_7' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_7 = mysqli_query($Conexao, $Consulta_7);
    }
    if ($nota_8 !== "") {
        $Consulta_88 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = '$disciplina_8' ORDER BY disciplina ");
        $Linha_88 = mysqli_fetch_array($Consulta_88, MYSQLI_BOTH);
        $nd_88 = $Linha_88['disciplina'];
        //
        $Consulta_8 = ("UPDATE `recuperacao_final` SET `media` = '$nota_8' WHERE `id_recuperacao_final_disciplina` = '$disciplina_8' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta_8 = mysqli_query($Conexao, $Consulta_8);
    }
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou a(s) medias do(a) aluno(a) da Recuperação Final $nome em: $nd22 = $nota, $nd_22 = $nota_2, $nd_33 = $nota_3, $nd_44 = $nota_4,"
            . "$nd_55 = $nota_5, $nd_66 = $nota_6, $nd_77 = $nota_7, $nd_88 = $nota_8' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    //
    if ($Consulta1) {      //       
        session_start();
        $_SESSION['inputAno'] = "$ano";
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
}


