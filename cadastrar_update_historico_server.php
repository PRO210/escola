<?php

ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$id_aluno = base64_decode($Recebe_id);
//
session_start();
session_destroy();
//
$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE id = '$id_aluno' ");
$Linha = mysqli_fetch_array($Consulta_backup, MYSQLI_BOTH);
$nome = $Linha['nome'];
//
$bimestre = filter_input(INPUT_POST, 'inputBimestre', FILTER_DEFAULT);
//Dados da Escola:dias,horas e ano.
$escola = filter_input(INPUT_POST, 'inputEscola', FILTER_DEFAULT);
$ano_turma = filter_input(INPUT_POST, 'ano_turma', FILTER_DEFAULT);
$escola_horas = filter_input(INPUT_POST, 'inputEscolaH', FILTER_DEFAULT);
$aluno_dias = filter_input(INPUT_POST, 'inputAlunoD', FILTER_DEFAULT);
$ano_atual = filter_input(INPUT_POST, 'inputAnoAtual', FILTER_DEFAULT);
$ano = filter_input(INPUT_POST, 'inputAno', FILTER_DEFAULT);
//
$frequencia = filter_input(INPUT_POST, 'inputFrequencia', FILTER_DEFAULT);
$bimestre_turma = filter_input(INPUT_POST, 'inputBimestreTurma', FILTER_DEFAULT);
$bimestre_turno = filter_input(INPUT_POST, 'inputBimestreTurno', FILTER_DEFAULT);
$bimestre_unico = filter_input(INPUT_POST, 'inputBimestreUnico', FILTER_DEFAULT);
$bimetre_status = filter_input(INPUT_POST, 'inputBimestreStatus', FILTER_DEFAULT);
$status = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);
$bimetre_recupera = filter_input(INPUT_POST, 'inputBimestreRecupera', FILTER_DEFAULT);
//
//Observações
$inputObs = filter_input(INPUT_POST, 'inputObs', FILTER_DEFAULT);
$inputObs2 = filter_input(INPUT_POST, 'inputObs2', FILTER_DEFAULT);
$inputObs3 = filter_input(INPUT_POST, 'inputObs3', FILTER_DEFAULT);
$inputObs4 = filter_input(INPUT_POST, 'inputObs4', FILTER_DEFAULT);
$inputObs5 = filter_input(INPUT_POST, 'inputObs5', FILTER_DEFAULT);
$inputObs6 = filter_input(INPUT_POST, 'inputObs6', FILTER_DEFAULT);
$inputObs7 = filter_input(INPUT_POST, 'inputObs7', FILTER_DEFAULT);
$inputObs8 = filter_input(INPUT_POST, 'inputObs8', FILTER_DEFAULT);
$inputObs9 = filter_input(INPUT_POST, 'inputObs9', FILTER_DEFAULT);
//Faltas                    Faltas                              Faltas
$faltas = filter_input(INPUT_POST, 'inputFalta1', FILTER_DEFAULT);
$faltas2 = filter_input(INPUT_POST, 'inputFalta2', FILTER_DEFAULT);
$faltas3 = filter_input(INPUT_POST, 'inputFalta3', FILTER_DEFAULT);
$faltas4 = filter_input(INPUT_POST, 'inputFalta4', FILTER_DEFAULT);
$faltasM = filter_input(INPUT_POST, 'inputFaltaM', FILTER_DEFAULT);
//
$escola_media = filter_input(INPUT_POST, 'inputEscola_media', FILTER_DEFAULT);
$cidade = filter_input(INPUT_POST, 'inputCidade', FILTER_DEFAULT);
$uf = filter_input(INPUT_POST, 'inputUf', FILTER_DEFAULT);
//Recebe as disciplinas
$todosdd[] = "";
foreach ($_POST['disciplina'] as $todosdd2) {
    //
    array_push($todosdd, $todosdd2);
}
array_shift($todosdd);
//
//Recebe os Ids das disciplinas
$todos[] = "";
$todos2[] = "";
$todos3[] = "";
$todos4[] = "";
$todosM[] = "";
$todosR[] = "";
$todosRM[] = "";
foreach ($_POST['dd'] as $dd) {
    //
    array_push($todos, $dd);
    array_push($todos2, $dd);
    array_push($todos3, $dd);
    array_push($todos4, $dd);
    array_push($todosM, $dd);
    array_push($todosR, $dd);
    array_push($todosRM, $dd);
}
array_shift($todos);
array_shift($todos2);
array_shift($todos3);
array_shift($todos4);
array_shift($todosM);
array_shift($todosR);
array_shift($todosRM);

//Consulta Backup para Bimestre Média
$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' ");
$Registro_backup = mysqli_fetch_array($Consulta_backup);
//
//
if ($status == "TRANSFERIDO") {
    $ConsultaStatus = ("UPDATE `alunos` SET `status` = 'TRANSFERIDO'  WHERE `id` = '$id_aluno'");
    $SQL_ConsultaStatus = mysqli_query($Conexao, $ConsultaStatus);
} elseif ($status == "CURSANDO") {
    $ConsultaStatus = ("UPDATE `alunos` SET `status` = 'CURSANDO'  WHERE `id` = '$id_aluno'");
    $SQL_ConsultaStatus = mysqli_query($Conexao, $ConsultaStatus);
} elseif ($status == "DESISTENTE") {
    $ConsultaStatus = ("UPDATE `alunos` SET `status` = 'DESISTENTE'  WHERE `id` = '$id_aluno'");
    $SQL_ConsultaStatus = mysqli_query($Conexao, $ConsultaStatus);
} elseif ($status == "ADIMITIDO DEPOIS") {
    $ConsultaStatus = ("UPDATE `alunos` SET `status` = 'ADIMITIDO DEPOIS'  WHERE `id` = '$id_aluno'");
    $SQL_ConsultaStatus = mysqli_query($Conexao, $ConsultaStatus);
}
//
$Consulta0 = ("UPDATE `bimestre_media` SET `escola` = '$escola',`aluno` = '$escola_horas', `aluno_dias` = '$aluno_dias' ,`frequencia` = '$frequencia' , `escola_media` = '$escola_media', `cidade_media` = '$cidade', `uf` = '$uf' , `status_bimestre_media` = '$bimetre_status', `bimestre_recupera` = '$bimetre_recupera', `bimestre_turma` = '$bimestre_turma' , `bimestre_turno` = '$bimestre_turno' , `bimestre_unico` = '$bimestre_unico' , `ano_turma` = '$ano_turma',"
        . " `obs_bimestre_media` = '$inputObs' , `obs_bimestre_media_ii` = '$inputObs2' , `obs_bimestre_media_iii` = '$inputObs3', `obs_bimestre_media_iv` = '$inputObs4' , `obs_bimestre_media_v` = '$inputObs5' , `obs_bimestre_media_vi` = '$inputObs6' , `obs_bimestre_media_vii` = '$inputObs7' , `obs_bimestre_media_viii` = '$inputObs8' , `obs_bimestre_media_ix` = '$inputObs9' WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' ");
$SQL_Consulta0 = mysqli_query($Conexao, $Consulta0);
$obs = "$inputObs $inputObs2 $inputObs3 $inputObs4 $inputObs5 $inputObs6 $inputObs7 $inputObs8 $inputObs9 .";
//
//Limpa as notas da media da recuperação final
if ($bimetre_recupera == "NAO") {
    //
    $Consulta2 = ("UPDATE `recuperacao_final` SET `media`= '', aprovado = 'NAO' WHERE id_recuperacao_final_aluno = 'id_aluno' AND ano = '$ano' ");
    $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
}
//
//
if ($SQL_Consulta0) {
    //
    $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' ");
    $row_final = mysqli_fetch_array($Consulta_backup2);
    $result = array_diff_assoc($row_final, $Registro_backup);
    $campo = "";

    foreach ($result as $nome_campo => $valor) {
        //echo "$nome_campo = $valor<br>";
        if (!is_numeric($nome_campo)) {
            // echo "$nome_campo = $valor<br>";
            if ($nome_campo == "status_bimestre_media") {
                //
                $SQL_turma = "SELECT * FROM `status_alunos` WHERE `id` = '$valor'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
                $nome_status = $Linha_turma["status_aluno"];
                $valor = "$nome_status ";
            }
            if ($Registro_backup[$nome_campo] == "") {
                $Registro_backup[$nome_campo] = "Vazio";
            }
            if ($valor == "") {
                $valor = "Vazio";
            }
//            $campo .= "$nome_campo = $valor / ";
            $campo .= "$nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
        }
    }
}
//
//
if ($bimestre == "B1" || $bimestre == "B2" || $bimestre == "B3" || $bimestre == "B4" || $bimestre == "Bmedia" || $bimestre == "recuperacao" || $bimestre == "recuperacao_media") {
    //Coloca as faltas
    $Consulta = ("UPDATE `bimestre_i` SET `faltas` = '$faltas' WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta = mysqli_query($Conexao, $Consulta);
    $Consulta = ("UPDATE `bimestre_ii` SET `faltas` = '$faltas2' WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta = mysqli_query($Conexao, $Consulta);
    $Consulta = ("UPDATE `bimestre_iii` SET `faltas` = '$faltas3' WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta = mysqli_query($Conexao, $Consulta);
    $Consulta = ("UPDATE `bimestre_iv` SET `faltas` = '$faltas4' WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta = mysqli_query($Conexao, $Consulta);
    $Consulta = ("UPDATE `bimestre_media` SET `faltas` = '$faltasM' WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
    $SQL_Consulta = mysqli_query($Conexao, $Consulta);

//Recebe as notas
    $amostratodos = "";
    foreach ($_POST['nn'] as $nn) {
//        $dd2 = array_shift($todosdd);
        $dd = array_shift($todos);
////        $amostra = "$dd2 = $nn,";
//        $amostratodos .= $amostra;
        //       
        $Consulta2 = ("UPDATE `bimestre_i` SET `nota` = '$nn' WHERE `id_bimestre_I_disciplina` = '$dd' AND `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    foreach ($_POST['nn2'] as $nn) {
        $dd22 = array_shift($todos2);
        $Consulta2 = ("UPDATE `bimestre_ii` SET `nota` = '$nn' WHERE `id_bimestre_II_disciplina` = '$dd22' AND `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    foreach ($_POST['nn3'] as $nn3) {
        $dd3 = array_shift($todos3);
        $Consulta2 = ("UPDATE `bimestre_iii` SET `nota` = '$nn3' WHERE `id_bimestre_III_disciplina` = '$dd3' AND `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    foreach ($_POST['nn4'] as $nn) {
        $dd4 = array_shift($todos4);
        $Consulta2 = ("UPDATE `bimestre_iv` SET `nota` = '$nn' WHERE `id_bimestre_IV_disciplina` = '$dd4' AND `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    foreach ($_POST['nnmedia'] as $nn) {
        $ddM = array_shift($todosM);
        $amostra = "$dd2 = $nn,";
        $amostratodos .= $amostra;
        if ($nn >= 6) {
            $aprovado = "SIM";
        } else {
            $aprovado = "NAO";
        }
        $Consulta2 = ("UPDATE `bimestre_media` SET `nota` = '$nn', `aprovado` = '$aprovado' WHERE `id_bimestre_media_disciplina` = '$ddM' AND `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    foreach ($_POST['recuperacao_nota'] as $nn) {
        $ddR = array_shift($todosR);
        $Consulta2 = ("UPDATE `recuperacao_final` SET `nota` = '$nn' WHERE `id_recuperacao_final_disciplina` = '$ddR' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
    foreach ($_POST['recuperacao_media'] as $nn) {
        $ddRM = array_shift($todosRM);
        if ($nn != '') {
            $aprovado = "SIM";
        } else {
            $aprovado = "NAO";
        }
        $Consulta2 = ("UPDATE `recuperacao_final` SET `media` = '$nn',`aprovado` = '$aprovado' WHERE `id_recuperacao_final_disciplina` = '$ddRM' AND `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano'");
        $SQL_Consulta2 = mysqli_query($Conexao, $Consulta2);
    }
//
//Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou os Dados do Histórico de $nome ', now())";
    $SQL_Consulta3 = mysqli_query($Conexao, $SQL_logar);

    if ($SQL_Consulta && $SQL_Consulta2 && $SQL_Consulta3) {
        session_start();
        $_SESSION['inputAno'] = "$ano";
        $_SESSION['msg'] = "certo";
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    } else {
        session_start();
        $_SESSION['inputAno'] = "$ano";
        $_SESSION['msg'] = "erro";
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
    //
    //
} elseif ($bimestre == "Bmedia2") {
    //
    if ($SQL_Consulta0) {
        //Logar no sistema
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', 'Alterou os Dados do(a) Histórico do(a) aluno(a) $nome em $campo', 'SIM',now())";
        $SQL_Consulta3 = mysqli_query($Conexao, $SQL_logar);
        //
        session_start();
        $_SESSION['inputAno'] = "$ano";
        $_SESSION['msg'] = "certo";
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
        //
    } else {
        session_start();
        $_SESSION['inputAno'] = "$ano";
        $_SESSION['msg'] = "erro";
        header("LOCATION: cadastrar_update_historico.php?id=$Recebe_id");
    }
} elseif ($bimestre == "exclui_historico") {
    //
    $SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_i` WHERE `id_bimestreI_aluno` = '$id' AND bimestre_i.`ano` = '$ano_pesquisa'");
//
    $SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_ii` WHERE `id_bimestre_II_aluno` = '$id' AND bimestre_ii.`ano` = '$ano_pesquisa'");
//
    $SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_iii` WHERE `id_bimestre_III_aluno` = '$id' AND bimestre_iii.`ano` = '$ano_pesquisa'");
//
    $SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_iv` WHERE `id_bimestre_IV_aluno` = '$id' AND bimestre_iv.`ano` = '$ano_pesquisa'");
    //
    $SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id' AND bimestre_media.`ano` = '$ano_pesquisa'");
//
    $SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$id' AND recuperacao_final.`ano` = '$ano_pesquisa'");
//
    if ($SQL_DELETE) {
        //Logar no sistema
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
                . "VALUES ( '$usuario_logado', 'Excluiu o Histórico aluno(a) $nome do $ano_pesquisa' ,'SIM',now())";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        //
        session_start();
        $_SESSION['erro'] = "3";
        header("LOCATION: cadastrar_update_historico.php?id=$id_envia");
        //
    } else {
        session_start();
        $_SESSION['erro'] = "4";
        header("LOCATION: cadastrar_update_historico.php?id=$id_envia");
    }
}



