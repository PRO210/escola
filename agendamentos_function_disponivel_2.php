<?php

$data = explode(" ", $Editstart);
list($date, $hora) = $data;
$data_sem_barra = array_reverse(explode("/", $date));
$data_sem_barra = implode("-", $data_sem_barra);
$start_sem_barra = $data_sem_barra . " " . $hora;
//
$data = explode(" ", $Editend);
list($date, $hora) = $data;
$data_sem_barra = array_reverse(explode("/", $date));
$data_sem_barra = implode("-", $data_sem_barra);
$end_sem_barra = $data_sem_barra . " " . $hora;
//
$resto2 = 0;
$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
while ($Registro = mysqli_fetch_array($Consultas)) {

    $id_consulta2 = $Registro['id'];
    $id_material = $Registro['id_material'];
    $id_material2 = $Registro['id_material2'];
    $id_material3 = $Registro['id_material3'];

    $materiais = array("", "$id_material", "$id_material2", "$id_material3");
    $procura = array_search("$Editmaterial88", $materiais);
    //
    if ($procura) {
        //
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$materiais[$procura]'");
        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
        $quantidade_arq2 = $Registro['quantidade'];
        $nome2 = $Registro['nome'];
        //
        if ($procura == "1") {
            $txt_procura = "id_material";
            $txt_qtd = "quantidade";
        } elseif ($procura == "2") {
            $txt_procura = "id_material2";
            $txt_qtd = "quantidade2";
        } elseif ($procura == "3") {
            $txt_procura = "id_material3";
            $txt_qtd = "quantidade3";
        }
        //     
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id_consulta2' ");
        $Registro = mysqli_fetch_array($Consulta);
        $quantidades = $Registro[$txt_qtd];
        $resto2 += $quantidades;
    }
}
$Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id' ");
$Registro = mysqli_fetch_array($Consulta);
$quantidades = $Registro['quantidade2'];
$resto21 = $quantidades;
//
$html2 = $quantidade_arq2 - $resto2 + $resto21;
//echo "arquivado = $quantidade_arq" . "<br>";
//echo "Consulta de outros = $resto2" . "<br>";
//echo "Subrtração = $html2" . "<br>";
//
//echo "valor pedido $Editquantidade88" . "<br>";
//echo "Eu tenho $resto21" . "<br>";

$msg2 = "";
if ($Editquantidade88 > $html2) {
    $Editquantidade88 = $html2;
    //echo "possivel = $Editquantidade88" . "<br>";
    $msg2 = "Porém o Material $nome2 não Tinha o nº Suficiente,";
} 
//echo "final $Editquantidade" . "<br>";
