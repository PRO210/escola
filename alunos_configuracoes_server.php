<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
if (($_POST['botao']) == "excluir_turmas") {             
       //CONSULTA BACKUP
    $nomes = "";
    foreach (($_POST['selecionado']) as $lista_id) {
        //
        $Consuta_backup = mysqli_query($Conexao, "SELECT * FROM `alunos_transporte` WHERE `alunos_transporte`.`id` = '$lista_id' ");
        //
        while ($row_backup = mysqli_fetch_array($Consuta_backup)) {

            $nomebackup = $row_backup['ponto_onibus'];
            $nomes .= $nomebackup . ",";
            $nomes2 = substr($nomes, 0, -1);
        }
    }
    //EXCLUI OS PONTOS DE ÔNIBUS
    foreach ($_POST['selecionado'] as $lista_id) {
        //
        $Consulta = mysqli_query($Conexao, "DELETE FROM `alunos_transporte` WHERE `alunos_transporte`.`id` = '" . $lista_id . "'");
    }
    //ESCREVER O LOG
    if ($Consuta_backup && $Consulta) {
        //
        $SQL_logar2 = "INSERT INTO log (`usuario`, `acao`,`data`) "
              . "VALUES ( '$usuario_logado', 'Excluiu o(s) Ponto(s) de Ônibus: $nomes2' , now())";
        $Consulta2 = mysqli_query($Conexao, $SQL_logar2);
        //
        header("location: alunos_configuracoes.php?id=sucesso");
    } else {
        echo "Deculpa ocorreu um erro";
    }
    //
} elseif (($_POST['botao']) == "cadastrar_ponto") {
    //Consulta Duplicidade
    $nome = filter_input(INPUT_POST, 'inputPontoAluno', FILTER_DEFAULT);
    $Consuta_duplicidade = mysqli_query($Conexao, "SELECT * FROM `alunos_transporte` WHERE `alunos_transporte`.`ponto_onibus` = '$nome' ");
    //
    if (mysqli_num_rows($Consuta_duplicidade) > 0) {
        header("location: alunos_configuracoes.php?id=erro");
    } else {
        //
        $SQL_matricular = "INSERT INTO alunos_transporte (`ponto_onibus`) "
              . "VALUES ('$nome')";
        $Consulta_matricular = mysqli_query($Conexao, $SQL_matricular);
        //
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
              . "VALUES ( '$usuario_logado', 'Cadastrou  o Ponto de Ônibus: $nome' , now())";
        $Consulta = mysqli_query($Conexao, $SQL_logar);
        //
        if ($Consulta_matricular && $Consulta) {
            header("location: alunos_configuracoes.php?id=sucesso");
        } else {
            header("location: alunos_configuracoes.php?id=erro");
        }
    }
}

