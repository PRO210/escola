<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
if (isset($_POST['retirar'])) {
//  
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
//
        $SQL_matricular = "UPDATE servidores SET excluido = 'N' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
//Logar no sistema para gravar Log           
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
          . "VALUES ( '$usuario_logado', 'Alterou o(s) o Cadastro do(s )Servidore(s) : $todos_nomes para Ativo.', now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta) {
        header("Location: servidores.php?id=1");
    } else {
        header("Location: servidores.php?id=2");
    }
//
} elseif (isset($_POST['imprimir'])) {
    //
    include_once './pesquisar_no_banco_impressao_servidores.php';
    //
}elseif (isset($_POST['excluir'])) {
    foreach (($_POST['servidor_selecionado']) as $lista_id) {
        //
        $Consulta = mysqli_query($Conexao, "SELECT * FROM servidores WHERE id = '$lista_id'");
        $Linha = mysqli_fetch_array($Consulta);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
        //
        $sql = "DELETE FROM `servidores` WHERE `servidores`.`id` = '$lista_id'";
        $consulta = mysqli_query($Conexao, $sql);
        //
        if ($consulta) {
            //Logar no sistema para gravar Log           
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                  . "VALUES ( '$usuario_logado', 'Excluiu o(s) Servidor(es) : $todos_nomes ', now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            //
            if ($Consulta2) {
                header("Location: servidores_arquivo_passivo.php?id=1");
            } else {
                header("Location:servidores_arquivo_passivo.php?id=5");
            }
        }else{
             header("Location: servidores_arquivo_passivo.php?id=2");
        }
    }
} 