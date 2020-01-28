<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_exclusao = base64_decode($id);
//
$Consuta_backup = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE id = $id_exclusao ");
$row_backup = mysqli_fetch_array($Consuta_backup, MYSQLI_BOTH);
$nomebackup = $row_backup['nome'];
$excluidobackup = $row_backup['excluido'];
//
$Consultaf = mysqli_query($Conexao, "DELETE FROM `usuarios` WHERE `id` = '$id_exclusao' ");

if ($Consultaf) {
    //Logar no sistema

    $SQL_logar2 = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Excluiu o Usuario $nomebackup de id $id_exclusao ' , now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar2);

    //echo "O usuario $nomebackup foi excluído com sucesso";
    header("Location: pesquisar_usuario_server.php");
} else {
    echo "Deculpa ocorreu um erro, reinici o navegador e tente de novo  ";
}
       
                      