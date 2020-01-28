<?php

include_once 'valida_cookies.inc';
//
include_once './inc.conf.php';
//
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");

//
$id_estado = "";
$id_estado = filter_input(INPUT_POST, "id", FILTER_DEFAULT);
if ($id_estado == "") {
    $id_estado = "%%";
}
$Consulta = mysqli_query($Conexao, "SELECT * FROM `tb_cidades` WHERE `estado` LIKE '$id_estado' ");


while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    $cidade = $Registro["nome"];

    echo '<option>' . strtoupper($cidade) . '</option>';
}


