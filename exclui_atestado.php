<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id = base64_decode(filter_input(INPUT_GET, 'id', FILTER_DEFAULT));
//
$Consuta_backup = mysqli_query($Conexao, "SELECT * FROM `atestados_servidor` WHERE id = $id");
$row_backup = mysqli_fetch_array($Consuta_backup, MYSQLI_BOTH);
$nomebackup = $row_backup['servidor'];
//
$Consultaf = mysqli_query($Conexao, "UPDATE `atestados_servidor` SET `excluido` = 'S' WHERE `id` = '$id' ");
//
if ($Consultaf) {
    //Logar no sistema
    $SQL_logar2 = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
            . "VALUES ( '$usuario_logado', 'Excluiu o Atestado/Licença/Declaração do Servidor $nomebackup','SIM',now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar2);
//
      header("Location: pesquisar_atestado.php?id=6");
} else {
    //
 header("Location: pesquisar_atestado.php?id=2");
 //
}
         