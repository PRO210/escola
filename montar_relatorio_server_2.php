<?php
ob_start();
include_once 'valida_cookies.inc';
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
//Impressão
if (isset($_POST['tudo']) && $_POST['tudo'] == "tudo") {
    include_once './pesquisar_no_banco_impressao_relatorio_alunos.php';
    ob_flush();
    exit();
} elseif ($_POST['tudo'] == "basica") {
    include_once './pesquisar_no_banco_impressao_relatorio_alunos_1.php';
    ob_flush();
    exit();
} elseif ($_POST['tudo'] == "personalizada") {
    include_once './pesquisar_no_banco_impressao_relatorio_alunos_2.php';
    ob_flush();
    exit();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo "kkkkkkkkkkkkkkkkkk";
        ?>
    </body>
</html>
