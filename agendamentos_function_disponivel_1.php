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
$resto1 = 0;
$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` BETWEEN '$start_sem_barra' AND '$end_sem_barra' OR `end` BETWEEN '$start_sem_barra' AND '$end_sem_barra' ");
//$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
while ($Registro = mysqli_fetch_array($Consultas)) {

    $id_consulta = $Registro['id'];
    $id_material = $Registro['id_material'];
    $id_material2 = $Registro['id_material2'];
    $id_material3 = $Registro['id_material3'];

    $materiais = array("", "$id_material", "$id_material2", "$id_material3");
    $procura = array_search("$Editmaterial", $materiais);
    //
    if ($procura) {
        //
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$materiais[$procura]'");
        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
        $quantidade_arq = $Registro['quantidade'];
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
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id_consulta' ");
        $Registro = mysqli_fetch_array($Consulta);
        $quantidades = $Registro[$txt_qtd];
        $resto1 += $quantidades;
    }
}
$Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id' ");
$Registro = mysqli_fetch_array($Consulta);
$quantidades = $Registro['quantidade'];
$resto11 = $quantidades;
//
$html = $quantidade_arq - $resto1 + $resto11;
//echo "arquivado = $quantidade_arq" . "<br>";
//echo "Consulta de outros = $resto1" . "<br>";
//echo "Subrtração = $html" . "<br>";
//
//echo "valor pedido $Editquantidade" . "<br>";
//echo "Eu tenho $resto11" . "<br>";

if ($Editquantidade > $html) {
    $Editquantidade = $html;
    //echo "possivel = $Editquantidade" . "<br>";
} 
//echo "final $Editquantidade" . "<br>";
