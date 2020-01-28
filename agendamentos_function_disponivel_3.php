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
$resto3 = 0;
$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
while ($Registro = mysqli_fetch_array($Consultas)) {

    $id_consulta3 = $Registro['id'];
    $id_material = $Registro['id_material'];
    $id_material2 = $Registro['id_material2'];
    $id_material3 = $Registro['id_material3'];

    $materiais = array("", "$id_material", "$id_material2", "$id_material3");
    $procura = array_search("$Editmaterial99", $materiais);
    //
    if ($procura) {
        //
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$materiais[$procura]'");
        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
        $quantidade_arq3 = $Registro['quantidade'];
        $nome3 = $Registro['nome'];

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
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id_consulta3' ");
        $Registro = mysqli_fetch_array($Consulta);
        $quantidades = $Registro[$txt_qtd];
        $resto3 += $quantidades;
    }
}
$Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id' ");
$Registro = mysqli_fetch_array($Consulta);
$quantidades = $Registro['quantidade3'];
$resto31 = $quantidades;
//
$html3 = $quantidade_arq3 - $resto3 + $resto31;
//echo "arquivado = $quantidade_arq" . "<br>";
//echo "Consulta de outros = $resto3" . "<br>";
//echo "Subrtração = $html3" . "<br>";
//
//echo "valor pedido $Editquantidade99" . "<br>";
//echo "Eu tenho $resto31" . "<br>";

$msg3 = "";
if ($Editquantidade99 > $html3) {
    $Editquantidade99 = $html3;
    //echo "possivel = $Editquantidade99" . "<br>";
    $msg3 = "Porém o Material $nome3 não Tinha o nº Suficiente,";
}
//echo "final $Editquantidade" . "<br>";
