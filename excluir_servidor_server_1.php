<?php

ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_exclusao = base64_decode($id);
//
if (!empty($id_exclusao)) {
    //
    $Consulta = mysqli_query($Conexao, "SELECT * FROM servidores WHERE id = '$id_exclusao'");
    $Linha = mysqli_fetch_array($Consulta);
    $nome = $Linha["nome"];
    $todos .= "$nome,";
    $todos_nomes = substr($todos, 0, -1);
    //
    $sql = "DELETE FROM `servidores` WHERE `servidores`.`id` = '$id_exclusao'";
    $consulta = mysqli_query($Conexao, $sql);
    //
    if ($consulta) {
        //Logar no sistema para gravar Log           
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
              . "VALUES ( '$usuario_logado', 'Excluiu o(s) Servidor(es) : $todos_nomes ', 'SIM',now())";
        $Consulta2 = mysqli_query($Conexao, $SQL_logar);
        //
        if ($Consulta2) {
            header("Location: servidores.php?id=1");
        } else {
            header("Location: servidores.php?id=5");
        }
    } else {
        header("Location: servidores.php?id=2");
    }
}else{
    header("Location: servidores.php?id=2");
}



