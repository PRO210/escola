<?php

ob_start();

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$botao = filter_input(INPUT_POST, 'botao', FILTER_DEFAULT);
$mensalidade = filter_input(INPUT_POST, 'mensalidade', FILTER_DEFAULT);
$bolsista = filter_input(INPUT_POST, 'bolsista', FILTER_DEFAULT);
$bolsista_valor = filter_input(INPUT_POST, 'bolsista_valor', FILTER_DEFAULT);
$pagameto = explode('-', filter_input(INPUT_POST, 'previsao_pagamento', FILTER_DEFAULT));
//
$turma_id = filter_input(INPUT_POST, 'turma_id', FILTER_DEFAULT);
$Consulta_turma = mysqli_query($Conexao, " SELECT * FROM `turmas` WHERE `id` = '$turma_id'");
$Linha_turma = mysqli_fetch_array($Consulta_turma);
$turma = $Linha_turma["turma"] . '  ' . $Linha_turma["unico"] . ' (' . $Linha_turma["turno"] . ') - ' . substr($Linha_turma["ano"], 0, -6);
//
$aluno_id = filter_input(INPUT_POST, 'aluno_id', FILTER_DEFAULT);
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id = " . base64_decode($aluno_id) . "");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
$nome = $Registro['nome'];
//
//
if ($botao == "criar") {
    $hoje_mes = date('m');
    $mes_soma = '';
    $hoje = date('Y-m-d');
    $i = 1;
    $data_pagamento = '';
    $codigo = uniqid();

    while ($i < 13 - $hoje_mes) {
//
        $mes_soma = $hoje_mes + $i;
        $data_pagamento = date($pagameto[0] . '-' . "$mes_soma" . '-' . $pagameto[2]);
        $sql = mysqli_query($Conexao, "INSERT INTO `alunos_pagamentos` (`aluno_id`, `turma_id`, `pago`, `mensalidade`,`bolsista`, `bolsista_valor`, `codigo`, `data_pagamento`,`created`) "
                . "VALUES (" . base64_decode($aluno_id) . ", '$turma_id', 'NAO', '$mensalidade', '$bolsista', '$bolsista_valor', '$codigo', '$data_pagamento',NOW())");
        $i++;
    }
//
    if ($sql) {
        $SQL_logar = "INSERT INTO alunos_log (`usuario`, `aluno_id`,`acao`,`acao_resumo`,`data`) "
                . "VALUES ( '$usuario_logado','" . base64_decode($aluno_id) . "','Gerou  o(s) boletos(s) para a turma $turma','CRIAR',now())";
        $Consulta2 = mysqli_query($Conexao, $SQL_logar);
//
        session_start();
        $_SESSION['msg'] = "1";
        header("LOCATION: cadastrar_boleto.php?id=$aluno_id");
    } else {
        session_start();
        $_SESSION['msg'] = "2";
        header("LOCATION: cadastrar_boleto.php?id=$aluno_id");
    }
//
//
} elseif ($botao == "Atualizar") {
    //
    $campo = "";
    $fevereiro = "";
    $março = "";
    $abril = "";
    $maio = "";
    $junho = "";
    $julho = "";
    $agosto = "";
    $setembro = "";
    $outubro = "";
    $novembro = "";
    $dezembro = "";
//
    foreach (($_POST['aluno_selecionado']) as $key => $lista_id) {
        $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM alunos_pagamentos WHERE id= '$lista_id'");
        $Registro_backup = mysqli_fetch_array($Consulta_backup);
//
//        $mensalidade = str_replace(',', '.', str_replace('.', '', $Registro_backup['mensalidade']));
//        $multa = str_replace(',', '.', str_replace('.', '', $_POST['multa'][$key]));
//        $desconto = str_replace(',', '.', str_replace('.', '', $_POST['desconto'][$key]));
//        $mensalidade_corrigida = number_format($mensalidade + $multa - $desconto, 2, ',', '.');
//
        $SQL_matricular = "UPDATE `alunos_pagamentos` SET `pago` = '" . $_POST['pago'][$key] . "', `desconto` = '" . $_POST['desconto'][$key] . "', "
                . "`multa` = '" . $_POST['multa'][$key] . "', `pago_em` = '" . $_POST['pago_em'][$key] . "', `bolsista` = '" . $_POST['bolsista'][$key] . "',"
                . "`bolsista_valor` = '" . $_POST['bolsista_valor'][$key] . "', `mensalidade` = '" . $_POST['mensalidade'][$key] . "', updated = now() WHERE id= $lista_id";
        $sql = mysqli_query($Conexao, $SQL_matricular);
//
        $Consulta_up = mysqli_query($Conexao, "SELECT * FROM alunos_pagamentos WHERE id= '$lista_id'");
        $Registro_up = mysqli_fetch_array($Consulta_up);
//
        $result = array_diff_assoc($Registro_up, $Registro_backup);
//
        foreach ($result as $nome_campo => $valor) {
            if (!is_numeric($nome_campo)) {
                //
                if ($Registro_backup[$nome_campo] == "") {
                    $Registro_backup[$nome_campo] = "Vazio";
                }
                //
                if ($valor == "") {
                    $valor = "Vazio";
                }
                //
                if (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "2") {
                    $fevereiro .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "3") {
                    $março .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "4") {
                    $abril .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "5") {
                    $maio .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "6") {
                    $junho .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "7") {
                    $julho .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "8") {
                    $setembro .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "9") {
                    $agosto .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "10") {
                    $outubro .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "11") {
                    $novembro .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                } elseif (date_format(date_create($Registro_backup['data_pagamento']), 'm') == "12") {
                    $dezembro .= "  " . " $nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
                }
            }
        }
    }
    $campo = " Em: Fevereiro => " . $fevereiro . " Março => " . $março . " Abril => " . $abril . " Maio =>  " . $maio . "  Junho => " . $junho . "  Julho => " . $julho . ""
            . " Agosto =>  " . $agosto . "  Setembro => " . $setembro . "  Outubro => " . $outubro . "  Novembro => " . $novembro . " Dezembro => " . $dezembro . "";
//    exit();
    if ($sql) {
//Logar na Tabela alunos_log
        $SQL_logar = "INSERT INTO alunos_log (`usuario`, `aluno_id`,`acao`,`acao_resumo`,`data`) "
                . "VALUES ( '$usuario_logado','" . base64_decode($aluno_id) . "','Atualizou o(s) boletos(s) da turma $turma  $campo','ALTERAR',now())";
        $Consulta2 = mysqli_query($Conexao, $SQL_logar);
//
        session_start();
        $_SESSION['msg'] = "1";
        header("LOCATION: cadastrar_boleto.php?id=$aluno_id");
    } else {
        session_start();
        $_SESSION['msg'] = "2";
        header("LOCATION: cadastrar_boleto.php?id=$aluno_id");
    }
//
//Impressao
} elseif ($botao == "excel") {
//
    include 'cadastrar_boleto_excel.php';
    exit();
//
} else {
//
    foreach (($_POST['aluno_selecionado']) as $key => $lista_id) {
        $SQL_matricular = "DELETE FROM `alunos_pagamentos`  WHERE id= $lista_id";
        $sql = mysqli_query($Conexao, $SQL_matricular);
    }
//
    if ($sql) {
//Logar na Tabela alunos_log
        $SQL_logar = "INSERT INTO alunos_log (`usuario`, `aluno_id`,`acao`,`acao_resumo`,`data`) "
                . "VALUES ( '$usuario_logado' , '" . base64_decode($aluno_id) . "' , 'Excluíu o(s) boletos(s) da turma $turma', 'EXCLUIR' , now())";
        $Consulta2 = mysqli_query($Conexao, $SQL_logar);
//
        session_start();
        $_SESSION['msg'] = "1";
        header("LOCATION: cadastrar_boleto.php?id=$aluno_id");
    } else {
        session_start();
        $_SESSION['msg'] = "2";
        header("LOCATION: cadastrar_boleto.php?id=$aluno_id");
    }
//
//
}

