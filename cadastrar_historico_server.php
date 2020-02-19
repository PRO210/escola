<?php

ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de matrícula (Método POST)
$id = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);
$id_envia = base64_encode($id);
$ano = filter_input(INPUT_POST, 'inputAno', FILTER_DEFAULT);
$ano_turma = filter_input(INPUT_POST, 'ano_turma', FILTER_DEFAULT);
$ano_pesquisa = filter_input(INPUT_POST, 'inputAno1', FILTER_DEFAULT);
$escola = filter_input(INPUT_POST, 'inputEscola', FILTER_DEFAULT);
$cidade = filter_input(INPUT_POST, 'inputCidade', FILTER_DEFAULT);
$uf = filter_input(INPUT_POST, 'inputUf', FILTER_DEFAULT);
$turma = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
$turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
$unica = filter_input(INPUT_POST, 'inputUnica', FILTER_DEFAULT);
$solicitante = filter_input(INPUT_POST, 'inputSolicitante', FILTER_DEFAULT);
$data = filter_input(INPUT_POST, 'inputData', FILTER_DEFAULT);
//echo"$ano";
$botao = filter_input(INPUT_POST, 'botao', FILTER_DEFAULT);
//exit();
$Consultabackup = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$id' ");
$Linha = mysqli_fetch_array($Consultabackup);
$nome = $Linha['nome'];
//
if ($botao == "pesquisar") {
    //
    session_start();
    $_SESSION['inputAno'] = "$ano_pesquisa";
    header("LOCATION: cadastrar_update_historico.php?id=$id_envia");
    //
} elseif ($botao == "criar") {
   
    //
    if ($ano == "") {
        //
        session_start();
        $_SESSION['erro'] = "2";
        header("LOCATION: cadastrar_historico.php?id=$id_envia");
        //
    } else {
        //
        $ConsultaTeste = mysqli_query($Conexao, "SELECT * FROM `bimestre_i` WHERE `id_bimestreI_aluno` = '$id' AND `ano` LIKE '$ano'");
        $LinhaTeste = mysqli_num_rows($ConsultaTeste);
//        echo "SELECT * FROM `bimestre_i` WHERE `id_bimestreI_aluno` = '$id' AND `ano` = '$ano'";
//        echo $LinhaTeste;
//        exit();
        
        //
        if ($LinhaTeste == "0") {
            //
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` ORDER BY id");
            while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
//
                $idD = $linha['id'];
                $SQLConsulta = "INSERT INTO `bimestre_i`(`id_bimestre_I`, `ano`, `id_bimestreI_aluno`, `id_bimestre_I_disciplina`, `nota`,`faltas`,`id_bimestre_I_status_alunos`,`escola`,`cidade`,`uf`) "
                        . "VALUES (NULL, '$ano', '$id', '$idD', '','','1','$escola','$cidade','$uf')";
                $SQLExecuta1 = mysqli_query($Conexao, $SQLConsulta);

                $SQLConsulta = "INSERT INTO `bimestre_ii` (`id_bimestre_II`, `ano`, `id_bimestre_II_aluno`, `id_bimestre_II_disciplina`, `nota`,`faltas`,`id_bimestre_II_status_alunos`,`escola`,`cidade`,`uf`) "
                        . "VALUES (NULL, '$ano', '$id', '$idD', '','','1','$escola','$cidade','$uf')";
                $SQLExecuta = mysqli_query($Conexao, $SQLConsulta);
//
                $SQLConsulta = "INSERT INTO `bimestre_iii` (`id_bimestre_III`, `ano`, `id_bimestre_III_aluno`, `id_bimestre_III_disciplina`, `nota`,`faltas`,`id_bimestre_III_status_alunos`,`escola`,`cidade`,`uf`) "
                        . "VALUES (NULL, '$ano', '$id', '$idD', '','','1','$escola','$cidade','$uf')";
                $SQLExecuta = mysqli_query($Conexao, $SQLConsulta);
//
                $SQLConsulta = "INSERT INTO `bimestre_iv` (`id_bimestre_IV`, `ano`, `id_bimestre_IV_aluno`, `id_bimestre_IV_disciplina`, `nota`,`faltas`,`id_bimestre_IV_status_alunos`,`escola`,`cidade`,`uf`) "
                        . "VALUES (NULL, '$ano', '$id', '$idD', '','','1','$escola','$cidade','$uf')";
                $SQLExecuta = mysqli_query($Conexao, $SQLConsulta);
//
                $SQLConsulta = "INSERT INTO `bimestre_media` (`id_bimestre_media`, `ano`, `ano_turma`,`id_bimestre_media_aluno`, `id_bimestre_media_disciplina`, `nota`,`faltas`,`escola`,`aluno`,`aluno_dias`,`frequencia`,`status_bimestre_media`,`escola_media`,`cidade_media`,`uf`,`bimestre_turma`,`bimestre_turno`,`bimestre_unico`) "
                        . "VALUES (NULL, '$ano', '$ano_turma' ,'$id', '$idD', '','','','','','','1','$escola','$cidade','$uf','$turma','$turno','$unica')";
                $SQLExecuta = mysqli_query($Conexao, $SQLConsulta);
//
                $SQLConsulta = "INSERT INTO `recuperacao_final` (`id_recuperacao_final`, `ano`, `id_recuperacao_final_aluno`, `id_recuperacao_final_disciplina`, `nota`,`media`,`id_recuperacao_final_status_alunos`,`escola`,`cidade`,`uf`) "
                        . "VALUES (NULL, '$ano', '$id', '$idD','','','1','$escola','$cidade','$uf')";
                $SQLExecuta_final = mysqli_query($Conexao, $SQLConsulta);
                //
            }
            if ($SQLExecuta_final == "1") {
                //Logar no sistema
                $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
                        . "VALUES ( '$usuario_logado', 'Montou o Histórico aluno(a) $nome para o ano de $ano" . " ' , 'SIM',now())";
                $Consulta1 = mysqli_query($Conexao, $SQL_logar);
                //
                session_start();
                $_SESSION['inputAno'] = "$ano";
                header("LOCATION: cadastrar_update_historico.php?id=$id_envia");
                //
            }
        } else {
            //
            session_start();
            $_SESSION['erro'] = "1";
            header("LOCATION: cadastrar_historico.php?id=$id_envia");
            //
        }
    }
} elseif ($botao == "montar") {
    //    
    header("LOCATION: montar_transferencia.php?id=$id_envia");
    //
} elseif ($botao == "montar_notas") {
    //       
    header("LOCATION: montar_transferencia_notas.php?id=$id_envia");
    //
} elseif ($botao == "pedir") {
    //Solicitação de Transferencia    
    //
    $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_aluno_solicitacao` = '$id' AND `entregue` = 'N' ");

    if (mysqli_num_rows($Consulta_backup) > 0) {
        //
        session_start();
        $_SESSION['erro'] = "5";
        header("LOCATION: cadastrar_historico.php?id=$id_envia");
    } else {
        //
        if ($data == "") {
            $data = date('Y-m-d');
        }
        $Consulta_up = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id = $id");
        $Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
        //
        $turma = $Registro["turma"];
        $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turma'";
        $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
        $Linha_turma = mysqli_fetch_array($Consulta_turma);
        //
        $ano_turma = substr($Linha_turma["ano"], 0, -6);
        $nome_turma = $Linha_turma["turma"];
        $turno_turma = $Linha_turma["turno"];
        $unico_turma = $Linha_turma["unico"];
        $turma = "$nome_turma $unico_turma ($turno_turma) - $ano_turma ";
        //
        $status = $Registro["status"];
        //
        $SQL_logar = "INSERT INTO alunos_solicitacoes (`id_aluno_solicitacao`,`id_turma`,`id_status`,`solicitante`,`data_solicitacao`) VALUES ( '$id', '$turma','$status','$solicitante','$data')";
        $Consulta = mysqli_query($Conexao, $SQL_logar);
        //
        if ($Consulta) {
            //
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Deu Entrada no Pedido de Transferência do aluno(a) $nome', 'SIM',now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            header("LOCATION: solicitacao_transferencia.php?id=$id_envia");
            //            
        } else {
            header("LOCATION: cadastrar_historico.php?id=$id_envia");
        }
    }
    // Solicitação de Tranferência   
} elseif ($botao == "consultar") {
    //
    header("LOCATION: solicitacao_transferencia.php?id=$id_envia");
    //
} elseif ($botao == "exclui_historico") {
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
                . "VALUES ( '$usuario_logado', 'Excluiu o Histórico aluno(a) $nome do $ano_pesquisa' , 'SIM',now())";
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
//SELECT * FROM `bimestre_i` WHERE `ano` LIKE '2018' AND `id_bimestreI_aluno` = 160 
////
//ALTER TABLE `bimestre_ii` CHANGE `ano` `ano` VARCHAR(255) NOT NULL; 
////
//ALTER TABLE `bimestre_iii` CHANGE `ano` `ano` VARCHAR(255) NOT NULL; 
////
//ALTER TABLE `bimestre_iv` CHANGE `ano` `ano` VARCHAR(255) NOT NULL; 
////
//ALTER TABLE `bimestre_media` CHANGE `ano` `ano` VARCHAR(255) NOT NULL; 
////
//ALTER TABLE `recuperacao_final` CHANGE `ano` `ano` VARCHAR(255) NOT NULL; 

