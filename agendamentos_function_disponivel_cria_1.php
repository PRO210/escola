<?php

$data = explode(" ", $start);
list($date, $hora) = $data;
$data_sem_barra = array_reverse(explode("/", $date));
$data_sem_barra = implode("-", $data_sem_barra);
$start_sem_barra = $data_sem_barra . " " . $hora;
//
$data = explode(" ", $end);
list($date, $hora) = $data;
$data_sem_barra = array_reverse(explode("/", $date));
$data_sem_barra = implode("-", $data_sem_barra);
$end_sem_barra = $data_sem_barra . " " . $hora;
//
$resto1 = 0;
$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` BETWEEN '$start_sem_barra' AND '$end_sem_barra' OR `end` BETWEEN '$start_sem_barra' AND '$end_sem_barra' ");
//$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
$Linhas = mysqli_num_rows($Consultas);
if ($Linhas > 0) {
    while ($Registro = mysqli_fetch_array($Consultas)) {

        $id_consulta = $Registro['id'];
        $id_material = $Registro['id_material'];
        $id_material2 = $Registro['id_material2'];
        $id_material3 = $Registro['id_material3'];

        $materiais = array("", "$id_material", "$id_material2", "$id_material3");
        $procura = array_search("$material", $materiais);
        //
        if ($procura) {
            //
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$materiais[$procura]'");
            $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
            $quantidade_arq = $Registro['quantidade'];
            $qdt_material = $nome = $Registro['nome'];
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
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id_consulta' ");
            $Registro = mysqli_fetch_array($Consulta);
            $quantidades = $Registro[$txt_qtd];
            $resto1 += $quantidades;
        } else {
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$material'");
            $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
            $quantidade_arq = $Registro['quantidade'];
            $qdt_material = $nome = $Registro['nome'];
        }
    }
} else {
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$material'");
    $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
    $quantidade_arq = $Registro['quantidade'];
    $qdt_material = $nome = $Registro['nome'];
}
$html = $quantidade_arq - $resto1;
//echo "arquivado = $quantidade_arq" . "<br>";
//echo "Consulta de outros = $resto1" . "<br>";
//echo "Subrtração = $html" . "<br>";
//echo "valor pedido $quantidade11" . "<br>";

$msg1 = "";
if ($quantidade11 > $html) {
    $quantidade11 = $html;
    //echo "possivel = $quantidade11" . "<br>";
    $msg1 = "O Item $nome não Tinha o Suficiente,";
}
//echo "final $quantidade11" . "<br>";
