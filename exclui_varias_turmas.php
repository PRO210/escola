<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
 $nomes = "";
foreach (($_POST['turma_selecionada']) as $lista_id) {

    $Consuta_backup = mysqli_query($Conexao, "SELECT * FROM turmas WHERE id = '$lista_id' ");
    
    while ($row_backup = mysqli_fetch_array($Consuta_backup)) {
       
        $nomebackup = $row_backup['turma'];
        $nomes .= $nomebackup . ",";
        $nomes2 = substr($nomes, 0, -1);
    }
}
//EXCLUI AS TURMAS DA TABELA TURMA_PROFESSOR E TURMAS
foreach ($_POST['turma_selecionada'] as $lista_id) {

    $Consulta = mysqli_query($Conexao, "DELETE FROM `turmas_professor2` WHERE `id_turma` = '$lista_id' ");
    $Consulta2 = mysqli_query($Conexao, "DELETE FROM `turmas` WHERE `turmas`.`id` = '" . $lista_id . "'");
}
if ($Consulta && $Consulta2) {

    $SQL_logar2 = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
            . "VALUES ( '$usuario_logado', 'Excluiu a(s) Turmas(s): $nomes2 e os seus respectivos professores ','SIM',now())";
    $Consulta3 = mysqli_query($Conexao, $SQL_logar2);

    header("location: pesquisar_turmas_server.php?id=1");
    //
} else {
    header("location: pesquisar_turmas_server.php?id=5");

}
 