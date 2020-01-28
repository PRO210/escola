<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>  
    </head>
    <body>
        <?php
        $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
        $id_exclusao = base64_decode($id);
        //echo "$id_exclusao";
        //Log no sistema
        $Consuta_backup = mysqli_query($Conexao, "SELECT * FROM disciplinas WHERE id = '$id_exclusao' ");
        $row_backup = mysqli_fetch_array($Consuta_backup);
        $nomebackup = $row_backup['disciplina'];
//
        $Consulta3 = mysqli_query($Conexao, "UPDATE `disciplina_professor2` SET excluido = 'S' WHERE `id_disciplina` = '$id_exclusao' ");
        $Consultaf = mysqli_query($Conexao, "UPDATE `disciplinas` SET `excluido` = 'S' WHERE `disciplinas`.`id` = '" . $id_exclusao . "'");
        //Exclui a disciplina da tabela disciplias_professor
        if ($Consultaf && $Consulta3) {
//
            $SQL_logar2 = "INSERT INTO log (`usuario`, `acao`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Excluiu a Disciplina: $nomebackup  ' , now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar2);
            header("location: pesquisar_disciplinas_server.php");
        } else {
            echo "Deculpa ocorreu um erro";
        }
        ?>
    </body>
</html>