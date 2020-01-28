<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_exclusao = base64_decode($id);
$Consultaf = mysqli_query($Conexao, "UPDATE `alunos` SET bolsa_familia = 'NÃO' WHERE id=" . $id_exclusao . ";");
//
if ($Consultaf) {
    //Logar no sistema
    $Consuta_backup = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE id = $id_exclusao ");
    $row_backup = mysqli_fetch_array($Consuta_backup);
    $nomebackup = $row_backup['nome'];   
//
    $SQL_logar2 = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Retirou o aluno(a) $nomebackup do Bolsa Família' , now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar2);
 header("Location: alunos_bolsa_familia_relatorio.php");
    //echo "O Registro do $nomebackup foi alterado com Sucesso";
} else {
    echo "Deculpa ocorreu um erro, reinici o navegador e tente de novo  ";
}

