<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_exclusao = base64_decode($id);
//$id_exclusao = "139";
$Consulta = mysqli_query($Conexao, "UPDATE `servidores` SET excluido = 'S' WHERE id= '$id_exclusao'");
//
if ($Consulta) {
    //
    $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `id` = '$id_exclusao'");
    $Registro = mysqli_fetch_array($Consultaf);
    $funcao = $Registro["funcao"];
    echo "$funcao" . "<br>";
    //
    if ($funcao == "PROFESSOR(A)" || $funcao == "PROFESSOR(A)/AUXILIAR" || $funcao == "MONITOR") {
        //
        $Consultaf1 = mysqli_query($Conexao, "SELECT servidores.id, turmas_professor2.* FROM servidores,turmas_professor2 WHERE servidores.id = turmas_professor2.id_professor AND servidores.id = '$id_exclusao' ");
        while ($Registro1 = mysqli_fetch_array($Consultaf1)) {
            $id_turma = $Registro1["id_turma"];
            echo "$id_turma" . "<br>";
            //
            $Consultaf2 = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` = '$id_turma'");
            $Registro2 = mysqli_fetch_array($Consultaf2);
            $ano = substr($Registro2["ano"], 0, 4);
            $ano_atual = date('Y');
            //echo "$ano" . "<br>";
            //
            if ($ano == "$ano_atual") {
                $Consultaf3 = mysqli_query($Conexao, "DELETE FROM `turmas_professor2` WHERE `id_turma` = '$id_turma' AND `id_professor` = '$id_exclusao'");
                echo "$ano" . "<br>";
                echo "DELETE FROM `turmas_professor2` WHERE `id_turma` = '$id_turma' AND `id_professor` = '$id_exclusao'" . "<br>";
                //               
            }
        }
        //
        include_once 'cadastrar_copia_turma_server_2.php';
        //
    } else {
        echo "não é a função" . "<br>";
    }
}
//exit();
//
if ($Consulta) {
//Logar no sistema
    $ConsultaLog = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE id = '$id_exclusao'");
    $RegistroLog = mysqli_fetch_array($ConsultaLog);
    $nome = $RegistroLog['nome'];
//
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', 'Moveu para o Aquivo o(a) Servidor(a) $nome','SIM',now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    header("location: servidores_arquivo_passivo.php?id=1");
//
} else {
    header("location: servidores.php?id=3");
}


