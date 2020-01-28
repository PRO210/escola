<?php

$Recebe_id_Get = "";
$Recebe_id_Get = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
if (!empty($Recebe_id_Get)) {
    //
    $Recebe_id = explode("/", $Recebe_id_Get);
    $id = base64_decode($Recebe_id[0]);
    echo "$id" . "<br>";
    $SQL = "SELECT * FROM `alunos` WHERE `id` = '$id'";
    $Consulta_nome = mysqli_query($Conexao, $SQL);
    $Linha = mysqli_fetch_array($Consulta_nome);
    $nome = $Linha["nome"];
    echo "$nome" . "<br>";
    //
    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$Recebe_id[1]'";
    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
    $Linha_turma = mysqli_fetch_array($Consulta_turma);
    $nome_turma = $Linha_turma["turma"];
    $turno_turma = $Linha_turma["turno"];
    $unico_turma = $Linha_turma["unico"];
    $ano_turma = substr($Linha_turma["ano"], 0, -6);
    $turma_backup = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
    echo "$Recebe_id[1]" . "<br>";
    echo "$turma_backup" . "<br>";
    echo "$ano_turma" . "<br>";

    //UPDATE `turma_backup` SET `matriculados` = '24' WHERE `turma_backup`.`id` = 38; 
    $sql = "SELECT * FROM `turma_backup` WHERE `id_turma` = '$Recebe_id[1]' ORDER BY `id_turma` ASC";
    $query = mysqli_query($Conexao, $sql);
    $row = mysqli_fetch_array($query);
    $stringCorrigida = str_replace($id . ',', '', $row['ids']);
    $ids = str_replace(',' . $id, '', $stringCorrigida);
    echo "$ids" . "<br>";
    $array = explode(',', $row['ids']);
    $cont = count($array) - 1;

    if ($ano_turma == date('Y')) {
        $SQL_matricular = "UPDATE alunos SET turma = '',status = 'NÃO RENOVADO', data_matricula_update = now() WHERE id= '$id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        if ($Consulta) {
            //
            include_once 'cadastrar_copia_turma_server_2.php';
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Retirou o(a) Estudante: $nome Da Ata da Turma: $turma_backup','SIM',now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            //
            header("Location: listar_copia_turma_server.php?id=1");
        } else {
            header("Location: listar_copia_turma_server.php?id=2");
        }
    } else {
        $SQL_matricular = "UPDATE `turma_backup` SET `matriculados` = '$cont',`ids` = '$ids' WHERE `id_turma` = '$Recebe_id[1]' ";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        if ($Consulta) {            
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Retirou o Estudante: $nome Da Ata da Turma: $turma_backup','SIM',now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            //
            header("Location: listar_copia_turma_server.php?id=1");
        } else {
            header("Location: listar_copia_turma_server.php?id=2");
        }
    }
   //
} else {
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        //
        $SQL = "SELECT * FROM `alunos` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $turma = $Linha["turma"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
        //
        $SQL_matricular = "UPDATE alunos SET turma = '', data_matricula_update = now() WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turma'";
    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
    $Linha_turma = mysqli_fetch_array($Consulta_turma);
    $nome_turma = $Linha_turma["turma"];
    $turno_turma = $Linha_turma["turno"];
    $unico_turma = $Linha_turma["unico"];
    $turma_backup = "$nome_turma $unico_turma ($turno_turma)";
//
    if ($Consulta) {
        //
        include_once 'cadastrar_copia_turma_server_2.php';
        //Logar no sistema
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
                . "VALUES ( '$usuario_logado', 'Retirou o(s) Estudante(s): $todos_nomes Da Ata da Turma: $turma_backup','SIM',now())";
        $Consulta2 = mysqli_query($Conexao, $SQL_logar);
        //
        header("Location: listar_copia_turma_server.php?id=1");
    } else {
        header("Location: listar_copia_turma_server.php?id=2");
    }
}


