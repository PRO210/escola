<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
if (isset($_POST['boletos_atualizar'])) {
    //
    $todos = '';
    $todas_turmas = '';
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        //
        $campo = '';
        $mensalidade = filter_input(INPUT_POST, 'mensalidade', FILTER_DEFAULT);
        $desconto = filter_input(INPUT_POST, 'desconto', FILTER_DEFAULT);
        $multa = filter_input(INPUT_POST, 'multa', FILTER_DEFAULT);
        $bolsista = filter_input(INPUT_POST, 'bolsista', FILTER_DEFAULT);
        $bolsista_valor = filter_input(INPUT_POST, 'bolsista_valor', FILTER_DEFAULT);
        //$pagamento = substr(filter_input(INPUT_POST, 'previsao_pagamento', FILTER_DEFAULT), 0, -2);
        $pago_em = filter_input(INPUT_POST, 'pago_em', FILTER_DEFAULT);

        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_pagamentos` WHERE id = '$lista_id' ");
        $linhaf = mysqli_fetch_array($Consultaf);
        $aluno_id = $linhaf['aluno_id'];
        $pagamento = date_format(date_create($linhaf['data_pagamento']), 'd/m/Y');
//
        $Consulta_up = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id = '$aluno_id'");
        $Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
        $nome = $Registro['nome'];
        $turma_id = $Registro['turma'];
        $todos .= "$nome,";
        //
        $Consulta_turma = mysqli_query($Conexao, " SELECT * FROM `turmas` WHERE `id` = '$turma_id'");
        $Linha_turma = mysqli_fetch_array($Consulta_turma);
        $turma = $Linha_turma["turma"] . '  ' . $Linha_turma["unico"] . ' (' . $Linha_turma["turno"] . ') - ' . substr($Linha_turma["ano"], 0, -6);
//
//        $mensalidade = str_replace(',', '.', str_replace('.', '', $Registro_backup['mensalidade']));
//        $multa = str_replace(',', '.', str_replace('.', '', $_POST['multa'][$key]));
//        $desconto = str_replace(',', '.', str_replace('.', '', $_POST['desconto'][$key]));
//        $mensalidade_corrigida = number_format($mensalidade + $multa - $desconto, 2, ',', '.');
//
        $SQL_matricular = "UPDATE `alunos_pagamentos` SET `pago` = 'SIM', `desconto` = '$desconto', `multa` = '$multa', `pago_em` = '$pago_em', `bolsista` = '$bolsista',"
                . "`bolsista_valor` = '$bolsista_valor', `mensalidade` = '$mensalidade', updated = now() WHERE id = '$lista_id' ";
        $sql = mysqli_query($Conexao, $SQL_matricular);
        //
        if ($sql) {
            $campo = 'PAGO EM: ' . $pago_em . ' / DESCONTO: ' . $desconto . '/ MULTA:' . $multa . ' / BOLSISTA: ' . $bolsista . ' / VALOR DA BOLSA: ' . $bolsista_valor . ', MENSALIDADE:' . $mensalidade . ' / '
                    . 'PARA O MÊS:' . $pagamento;
            //Logar na Tabela alunos_log
            $SQL_logar = "INSERT INTO alunos_log (`usuario`, `aluno_id`,`acao`,`acao_resumo`,`data`) "
                    . "VALUES ( '$usuario_logado','$aluno_id','Atualizou o(s) boletos(s) da turma $turma / $campo','ALTERAR',now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
        }
        $todos_nomes = substr($todos, 0, -1);
    }
    if ($Consulta2) {
        //Logar no sistema
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', 'Atualizou  o(s) Boleto(s) de: $todos_nomes / $campo ' , 'SIM',now())";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
//      header("Location: boleto_listar.php?id=1");
        session_start();
        $_SESSION['msg'] = "1";
        header("LOCATION: boleto_listar.php");
    } else {
        session_start();
        $_SESSION['msg'] = "2";
        header("LOCATION: boleto_listar.php");
    }
    //
    //
}if (isset($_POST['boletos_excluir'])) {
    //
    $todos = '';
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        //
        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_pagamentos` WHERE id = '$lista_id' ");
        $linhaf = mysqli_fetch_array($Consultaf);
        $aluno_id = $linhaf['aluno_id'];
        $turma_id = $linhaf['turma_id'];
        $pagamento = date_format(date_create($linhaf['data_pagamento']), 'd/m/Y');
        //
        $Consulta_up = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id = '$aluno_id'");
        $Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
        $nome = $Registro['nome'];
        $todos .= "$nome,";
        //
        $Consulta_turma = mysqli_query($Conexao, " SELECT * FROM `turmas` WHERE `id` = '$turma_id'");
        $Linha_turma = mysqli_fetch_array($Consulta_turma);
        $turma = $Linha_turma["turma"] . '  ' . $Linha_turma["unico"] . ' (' . $Linha_turma["turno"] . ') - ' . substr($Linha_turma["ano"], 0, -6);
        //
        $SQL_matricular = "DELETE FROM `alunos_pagamentos` WHERE id= $lista_id";
        $sql = mysqli_query($Conexao, $SQL_matricular);
        //Logar na Tabela alunos_log
        $SQL_logar = "INSERT INTO alunos_log (`usuario`, `aluno_id`,`acao`,`acao_resumo`,`data`) "
                . "VALUES ( '$usuario_logado' , '$aluno_id' , 'Excluíu o(s) boletos(s) da turma $turma com data de pagamento: $pagamento ', 'EXCLUIR' , now())";
        $Consulta = mysqli_query($Conexao, $SQL_logar);
    }
    $todos_nomes = substr($todos, 0, -1);
    //
    if ($Consulta) {
        //Logar na Tabela alunos_log
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
                . "VALUES ( '$usuario_logado', 'Excluíu o(s) boletos(s) de: $todos_nomes  com data de pagamento: $pagamento' , 'SIM',now())";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        session_start();
        $_SESSION['msg'] = "1";
        header("LOCATION: boleto_listar.php");
    } else {
        session_start();
        $_SESSION['msg'] = "2";
        header("LOCATION: boleto_listar.php");
    }
}