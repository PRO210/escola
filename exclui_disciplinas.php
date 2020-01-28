<?php

include_once 'valida_cookies.inc';
?>
<?php
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
 $nomes = "";
foreach (($_POST['turma_selecionada']) as $lista_id) {

    $Consuta_backup = mysqli_query($Conexao, "SELECT * FROM disciplinas WHERE id = '$lista_id' ");
    
    while ($row_backup = mysqli_fetch_array($Consuta_backup)) {
       
        $nomebackup = $row_backup['disciplina'];
        $nomes .= $nomebackup . ",";
        $nomes2 = substr($nomes, 0, -1);
    }
}
//Update DAS DISCIPLINAS DA TABELA DISCIPLINA_PROFESSOR E DISCIPLINAS

foreach ($_POST['turma_selecionada'] as $lista_id) {

    $Consulta = mysqli_query($Conexao, "UPDATE `disciplina_professor2` SET = excluido = 'S' WHERE `id_disciplina` = '$lista_id' ");
    $Consulta2 = mysqli_query($Conexao, "UPDATE `disciplinas` SET `excluido` = 'S' WHERE `disciplinas`.`id` = '" . $lista_id . "'");
}


if ($Consulta && $Consulta2) {

    $SQL_logar2 = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Excluiu a(s) Disciplina(s): $nomes2 e os seus respectivos professores ' , now())";
    $Consulta3 = mysqli_query($Conexao, $SQL_logar2);

    header("location: pesquisar_disciplinas_server.php");
} else {
    echo "Deculpa ocorreu um erro";
}
 