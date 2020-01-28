<?php

ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
# descomentar para testar resposta com falha
//header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500); exit();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tabeliao";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
die("Connection failed: " . $mysqli->connect_error);
}

$sql = "TRUNCATE teste;";

for ($i = 1; $i <= 1200; $i++) {
    $sql .= "INSERT INTO `teste` (`title`,`slug`,`text`) VALUES ('".md5($i)."','".sha1($i)."','text$i');";
}

if (mysqli_multi_query($mysqli, $sql)) {
    do {
        if ($result = mysqli_store_result($mysqli)) {
            header($_SERVER['SERVER_PROTOCOL'], true, 200);
            exit();
        }
    } while (mysqli_next_result($mysqli) && mysqli_more_results($mysqli));
}
mysqli_close($mysqli);