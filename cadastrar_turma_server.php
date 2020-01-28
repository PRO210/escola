<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
$turma = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
$turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
$categoria = filter_input(INPUT_POST, 'inputCategoria', FILTER_DEFAULT);
$extra = filter_input(INPUT_POST, 'select_turma_extra', FILTER_DEFAULT);
$unico = filter_input(INPUT_POST, 'inputUnico', FILTER_DEFAULT);
$ano_recebe = filter_input(INPUT_POST, 'inputAno', FILTER_DEFAULT);
$idade_turma = filter_input(INPUT_POST, 'inputIdade', FILTER_DEFAULT);
$ano = substr($ano_recebe, 0,-6);
//
$Consuta_duplicidade = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma` LIKE '$turma' AND `unico` = '$unico' AND `ano` LIKE '$ano%' ");
$rowDuplicidade = mysqli_num_rows($Consuta_duplicidade);
//
if ($rowDuplicidade > 0) {
    header("Location: pesquisar_turmas_server.php?id=3");
} else {
//
    $Cadastrar_turma = "INSERT INTO turmas (`turma`, `categoria`,`turno`,`turma_extra`,`unico`,`ano`,`idade_turma`) VALUES ( '$turma', '$categoria' , '$turno', '$extra','$unico','$ano_recebe','$idade_turma')";
    $Consulta_turma = mysqli_query($Conexao, $Cadastrar_turma);
//
    if ($Consulta_turma) {
//
        $Consuta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma` LIKE '$turma' AND `turno` LIKE '$turno'");
        $row = mysqli_fetch_array($Consuta, MYSQLI_BOTH);
        $id_turma = $row['id'];

        $Nomes_professores = "";
        foreach (($_POST['servidor_selecionado']) as $lista_id) {

            $Registrar = "INSERT INTO turmas_professor2 (`id_turma`, `id_professor` )"
                    . "VALUES ( '$id_turma', '$lista_id' )";
            $Consulta_Registrar = mysqli_query($Conexao, $Registrar);
            /////
            $Consulta_professor = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `id` = '$lista_id' ");
            $row_professor = mysqli_fetch_array($Consulta_professor);
            $professores = $row_professor['nome'];
            $Nomes_professores .= "$professores,";
        }
        $Nomes_professores_pronto = substr($Nomes_professores, 0, -1);
        //Logar no sistema
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                . "VALUES ( '$usuario_logado', 'Criou a turma do $turma e vínculou esse(s) professor(es): $Nomes_professores_pronto' , now())";
        $Consulta = mysqli_query($Conexao, $SQL_logar);
        //
        if ($Registrar) {
            header("Location: pesquisar_turmas_server.php?id=1");
        } elseif($SQL_logar) {
            header("Location: pesquisar_turmas_server.php?id=2");
        }
    } else {
        echo mysqli_error($Consulta_turma);
    }
}
     
