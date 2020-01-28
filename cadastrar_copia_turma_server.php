<?php

ob_start();
$ano = date('Y');
$Delete = mysqli_query($Conexao, "DELETE FROM `turma_backup` WHERE `ano` = '$ano'");
// 
$turnos = ['MATUTINO', 'VESPERTINO', 'NOTURNO'];
foreach ($turnos as $turno) {

    $ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas WHERE turno = '$turno' AND `ano` LIKE '$ano%'  ORDER BY turma ");
    $rowV = mysqli_num_rows($ConsultaV);
//
    while ($linhaV = mysqli_fetch_array($ConsultaV)) {
        $idV = $linhaV['id'];
        $turmaV = $linhaV['turma'];
        $turnoV = $linhaV['turno'];
        $turma = "$turmaV ($turnoV)";
        //
        $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $idV . "' AND `status_ext` NOT LIKE 'SIM' ");
        $rowqtd = mysqli_fetch_array($ConsultaQtd);
        $am = $rowqtd['AM'];
        //
        $ids = "";
        $Consulta = mysqli_query($Conexao, "SELECT * FROM alunos WHERE turma LIKE '$idV' AND `status_ext` NOT LIKE 'SIM' ORDER BY nome ");
        while ($Linha = mysqli_fetch_array($Consulta)) {
            $id = $Linha['id'];
            $ids .= "$id,";
        }
        $todos_ids = substr($ids, 0, -1);
        //
        $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'TRANSFERIDO'  ");
        $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
        $at = $rowqtd1['AT'];
        $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'ADIMITIDO DEPOIS' AND `excluido` = 'N' ");
        $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
        $ad = $rowqtd2['AD'];
        $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $idV . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND `excluido` = 'N' ");
        $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
        $ac = $rowqtd3['AC'];
        $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'DESISTENTE'  ");
        $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
        $adesis = $rowqtd4['D'];
        //   
        $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$idV' AND `turmas_professor2`.id_professor = servidores.id  ";
        $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
        //
        $nome_professores = "";
        $nome_professores2 = "";
        $nome_professores3 = "";
        $nome_professores_fisica = "";
        $aux_professores = "";
        $aux_professores2 = "";
        //
        while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
            //
            $teste_nome = $Linha_Professor["nome"];
            $nome_professor = $Linha_Professor["nome"];
            $funcao_professor = $Linha_Professor["funcao"];
            $substituta = $Linha_Professor["substituta"];
            $projeto = $Linha_Professor["projeto"];
            //
            $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
            $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
            $ContLinhasAtestados = mysqli_num_rows($query_atestados);

            if ($ContLinhasAtestados > 0) {
                $dias = intval($linha_atestados['dias']);
                if ($dias >= 0) {
                    $teste_folga = " / Está de Atestado; ";
                }
            }
            //
            if ($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] != 127) {

                if ($substituta == "NAO" && $projeto == "NAO") {
                    $nome_professor = $Linha_Professor["nome"];
                    $nome_professores .= "$nome_professor";
                    //
                } elseif ($substituta == "SIM") {
                    $nome_professor = $Linha_Professor["nome"];
                    $nome_professores2 .= "$nome_professor";
                    //
                } elseif ($projeto == "SIM") {
                    $nome_professor = $Linha_Professor["nome"];
                    $nome_professores3 .= "$nome_professor";
                }
                //
            } elseif (($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] = 127)) {
                $nome_professor = $Linha_Professor["nome"];
                $nome_professores_fisica .= "$nome_professor";
            } else {
                if ($substituta == "SIM") {
                    $nome_aux_professor = $Linha_Professor["nome"];
                    $nome_professores2 .= "$nome_aux_professor";
                    //
                } elseif ($projeto == "SIM") {
                    $nome_professor = $Linha_Professor["nome"];
                    $nome_professores3 .= "$nome_professor";
                    //
                } else {
                    $nome_aux_professor = $Linha_Professor["nome"];
                    $aux_professores2 .= "$nome_aux_professor ,";
                }
            }
        }
        $Cadastrar_turma = "INSERT INTO turma_backup (`id_turma`, `matriculados`, `transferidos`, `admitidos`, `desistentes`, `cursando`, `ano`,`ids`,`prof`,`prof_aux`,`prof_subs`,`prof_proj`) "
                . "VALUES (  '$idV' , '$am', '$at','$ad','$adesis','$ac','$ano','$todos_ids','$nome_professores','$aux_professores2','$nome_professores2','$nome_professores3')";
        $Consulta_turma = mysqli_query($Conexao, $Cadastrar_turma);
    }
}

////
////Turmas do Turno Vespertino
//$ano = date('Y');
//$ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas WHERE turno = 'VESPERTINO' AND `ano` LIKE '$ano%' ORDER BY turma ");
//$rowV = mysqli_num_rows($ConsultaV);
////
//while ($linhaV = mysqli_fetch_array($ConsultaV)) {
//    $idV = $linhaV['id'];
//    $turmaV = $linhaV['turma'];
//    $turnoV = $linhaV['turno'];
//    $turma = "$turmaV ($turnoV)";
//    //
//    $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $idV . "' AND `status_ext` NOT LIKE 'SIM'");
//    $rowqtd = mysqli_fetch_array($ConsultaQtd);
//    $am = $rowqtd['AM'];
//    //
//    $ids = "";
//    $Consulta = mysqli_query($Conexao, "SELECT * FROM alunos WHERE turma LIKE '$idV' AND `status_ext` NOT LIKE 'SIM' ORDER BY nome ");
//    while ($Linha = mysqli_fetch_array($Consulta)) {
//
//        $id = $Linha['id'];
//        $ids .= "$id,";
//    }
//    $todos_ids = substr($ids, 0, -1);
//    //
//    $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'TRANSFERIDO'  ");
//    $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
//    $at = $rowqtd1['AT'];
//    $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'ADIMITIDO DEPOIS' AND `excluido` = 'N' ");
//    $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
//    $ad = $rowqtd2['AD'];
//    $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $idV . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND `excluido` = 'N' ");
//    $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
//    $ac = $rowqtd3['AC'];
//    $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'DESISTENTE'  ");
//    $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
//    $adesis = $rowqtd4['D'];
//    //
//    $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$idV' AND `turmas_professor2`.id_professor = servidores.id AND servidores.excluido = 'N'";
//    $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
//    //
//    $nome_professores = "";
//    $nome_professores2 = "";
//    $nome_professores3 = "";
//    $nome_professores_fisica = "";
//    $aux_professores = "";
//    $aux_professores2 = "";
//    //
//    while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
//        //
//        $nome_professor = $Linha_Professor["nome"];
//        $funcao_professor = $Linha_Professor["funcao"];
//        $substituta = $Linha_Professor["substituta"];
//        $projeto = $Linha_Professor["projeto"];
//        //
//        $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
//        $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
//        $ContLinhasAtestados = mysqli_num_rows($query_atestados);
//
//        if ($ContLinhasAtestados > 0) {
//            $dias = intval($linha_atestados['dias']);
//            if ($dias >= 0) {
//                $teste_folga = " / Está de Atestado; ";
//            }
//        }
//        //
//        if ($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] != 127) {
//
//            if ($substituta == "NAO" && $projeto == "NAO") {
//                $nome_professor = $Linha_Professor["nome"];
//                $nome_professores .= "$nome_professor";
//                //
//            } elseif ($substituta == "SIM") {
//                $nome_professor = $Linha_Professor["nome"];
//                $nome_professores2 .= "$nome_professor";
//                //
//            } elseif ($projeto == "SIM") {
//                $nome_professor = $Linha_Professor["nome"];
//                $nome_professores3 .= "$nome_professor";
//            }
//            //
//        } elseif (($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] = 127)) {
//            $nome_professor = $Linha_Professor["nome"];
//            $nome_professores_fisica .= "$nome_professor";
//        } else {
//            if ($substituta == "SIM") {
//                $nome_aux_professor = $Linha_Professor["nome"];
//                $nome_professores2 .= "$nome_aux_professor";
//                //
//            } elseif ($projeto == "SIM") {
//                $nome_professor = $Linha_Professor["nome"];
//                $nome_professores3 .= "$nome_professor";
//                //
//            } else {
//                $nome_aux_professor = $Linha_Professor["nome"];
//                $aux_professores2 .= "$nome_aux_professor ";
//            }
//        }
//    }
//    $Cadastrar_turma = "INSERT INTO turma_backup (`id_turma`, `matriculados`, `transferidos`, `admitidos`, `desistentes`, `cursando`, `ano`,`ids`,`prof`,`prof_aux`,`prof_subs`,`prof_proj`) "
//            . "VALUES (  '$idV' , '$am', '$at','$ad','$adesis','$ac','$ano','$todos_ids','$nome_professores','$aux_professores2','$nome_professores2','$nome_professores3')";
//    $Consulta_turma = mysqli_query($Conexao, $Cadastrar_turma);
//}
////
////Turmas do Turno Noturno
//$ano = date('Y');
//$ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas WHERE turno = 'NOTURNO' AND `ano` LIKE '$ano%' ORDER BY turma ");
//$rowV = mysqli_num_rows($ConsultaV);
////
//while ($linhaV = mysqli_fetch_array($ConsultaV)) {
//    $idV = $linhaV['id'];
//    $turmaV = $linhaV['turma'];
//    $turnoV = $linhaV['turno'];
//    $turma = "$turmaV ($turnoV)";
//    //
//    $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $idV . "' AND `status_ext` NOT LIKE 'SIM'");
//    $rowqtd = mysqli_fetch_array($ConsultaQtd);
//    $am = $rowqtd['AM'];
//    //
//    $ids = "";
//    $Consulta = mysqli_query($Conexao, "SELECT * FROM alunos WHERE turma LIKE '$idV' AND `status_ext` NOT LIKE 'SIM'  ORDER BY nome ");
//    while ($Linha = mysqli_fetch_array($Consulta)) {
//
//        $id = $Linha['id'];
//        $ids .= "$id,";
//    }
//    $todos_ids = substr($ids, 0, -1);
//    //
//    $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'TRANSFERIDO'  ");
//    $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
//    $at = $rowqtd1['AT'];
//    $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'ADIMITIDO DEPOIS' AND `excluido` = 'N'");
//    $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
//    $ad = $rowqtd2['AD'];
//    $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $idV . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND `excluido` = 'N'");
//    $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
//    $ac = $rowqtd3['AC'];
//    $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'DESISTENTE'  ");
//    $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
//    $adesis = $rowqtd4['D'];
//    //
//    $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$idV' AND `turmas_professor2`.id_professor = servidores.id ";
//    $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
//    $nome_professores = "";
//    while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
//        $funcao_professor = $Linha_Professor["funcao"];
//        $nome_professor = $Linha_Professor["nome"];
//        //
//        $substituta = $Linha_Professor["substituta"];
//        $teste_folga = "";
//        $teste_nome = $Linha_Professor['nome'];
//        $projeto = $Linha_Professor["projeto"];
//        //
//        $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
//        $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
//        $ContLinhasAtestados = mysqli_num_rows($query_atestados);
//
//        if ($ContLinhasAtestados > 0) {
//            $dias = intval($linha_atestados['dias']);
//            if ($dias >= 0) {
//                $teste_folga = " / Está de Atestado; ";
//            }
//        }
//        if ($substituta == "SIM") {
//            $substituta = " - Substituto(a)";
//        } else {
//            $substituta = "";
//        }
//        //
//        if ($projeto == "SIM") {
//            $projeto_nome = " - " . $Linha_Professor["projeto_nome"];
//        } else {
//            $projeto_nome = "";
//        }
//        if ($funcao_professor == "PROFESSOR(A)") {
//            $nome_professores .= "$nome_professor" . $teste_folga . $substituta . $projeto_nome . " <br> ";
//        } else {
//            $nome_aux .= "$nome_professor" . $teste_folga . $substituta . " <br> ";
//        }
//    }
//    $Cadastrar_turma = "INSERT INTO turma_backup (`id_turma`, `matriculados`, `transferidos`, `admitidos`, `desistentes`, `cursando`, `ano`,`ids`,`prof`,`prof_aux`) "
//            . "VALUES (  '$idV' , '$am', '$at','$ad','$adesis','$ac','$ano','$todos_ids','$nome_professores','$nome_aux')";
//    $Consulta_turma = mysqli_query($Conexao, $Cadastrar_turma);
//}
//
//Logar no sistema
$SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
        . "VALUES ( '$usuario_logado', 'Atualizou a Cópia da(s) turma(s) do Ano $ano' ,'SIM',now())";
$Consulta = mysqli_query($Conexao, $SQL_logar);
//
if ($Consulta) {
    header("Location: listar_copia_turma_server.php?id=1");
} elseif ($SQL_logar) {
    header("Location: pesquisar_turmas_server.php?id=5");
}
    //
