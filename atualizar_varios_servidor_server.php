<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Atualizar Turmasservidores
if (isset($_POST['atualizar'])) {
    $turma_update = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
    $todos = "";
    //
    foreach (($_POST['servidor_selecionado']) as $lista_id) {
        //
        $turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
        $SQL = "SELECT * FROM `servidores` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
        //
        $SQL_matricular = "UPDATE servidores SET turma = '$turma_update', data_matricula_update = now() WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
    //Logar no sistema para gravar Log           
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
          . "VALUES ( '$usuario_logado', 'Alterou a turma do Funcionário(as): $todos_nomes para $turma_update', now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    if ($Consulta) {
        header("Location: servidores.php?id=1");
    } else {
        header("Location: servidores.php?id=2");
    }
    //Atualizar Vínculo
} elseif (isset($_POST['atualizar_Vinculo'])) {

    $vinculo = filter_input(INPUT_POST, 'inputVinculo', FILTER_DEFAULT);
    $todos = "";
    //
    foreach (($_POST['servidor_selecionado']) as $lista_id) {
//
        $SQL = "SELECT * FROM `servidores` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
        ////               
        $SQL_matricular = "UPDATE servidores SET data_matricula_update = now(), vinculo = '$vinculo' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
    //Logar no sistema para gravar Log           
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
          . "VALUES ( '$usuario_logado', 'Alterou o Vínculo do servidore(as): $todos_nomes para $vinculo', now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    if ($Consulta) {
        header("Location: servidores.php?id=1");
    } else {
        header("Location: servidores.php?id=2");
    }

    // Atualizar Função
} elseif (isset($_POST['atualizar_Funcao'])) {
    //
    $todos = "";
    $funcao = filter_input(INPUT_POST, 'inputFuncao', FILTER_DEFAULT);
    $resumo_funcao = filter_input(INPUT_POST, 'inputResumoFuncao', FILTER_DEFAULT);

    //
    foreach (($_POST['servidor_selecionado']) as $lista_id) {
        //
        $SQL = "SELECT * FROM `servidores` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
        //        
        $SQL_matricular = "UPDATE servidores SET data_matricula_update = now(), funcao = '$funcao' , resumo_funcao = '$resumo_funcao' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
    //Logar no sistema para gravar Log    
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`, `data`) "
          . "VALUES ( '$usuario_logado', ' Alterou a Função dos servidores(as): $todos_nomes para $funcao / Resumo da Função: $resumo_funcao', now() )";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    if ($Consulta) {
        header("Location: servidores.php?id=1");
    } else {
        header("Location: servidores.php?id=2");
    }
    //
    // Atualizar Turno      // Atualizar Turno          
} elseif (isset($_POST['atualizar_Turno'])) {
    //
    $todos = "";
    $turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
    //
    foreach (($_POST['servidor_selecionado']) as $lista_id) {
        //
        $SQL = "SELECT * FROM `servidores` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
        //
        $SQL_matricular = "UPDATE servidores SET data_matricula_update = now(), turno = '$turno' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        //
    }
    //Logar no sistema para gravar Log    
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`, `data`) "
          . "VALUES ( '$usuario_logado', ' Alterou o Turno dos servidores(as): $todos_nomes para $turno', now() )";
    $Consulta4 = mysqli_query($Conexao, $SQL_logar);
    if ($Consulta) {
        header("Location: servidores.php?id=1");
    } else {
        header("Location: servidores.php?id=2");
    }
    //Imprimir
} elseif (isset($_POST['Imprimir em Bloco'])) {
    include_once './pesquisar_no_banco_impressao_serividores.php';
    exit();
    //
} 


