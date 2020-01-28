<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$material = $_POST['id'];
$start = $_POST['start'];
$end = $_POST['end'];
////
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
$Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` BETWEEN '$start_sem_barra' AND '$end_sem_barra' OR `end` BETWEEN '$start_sem_barra' AND '$end_sem_barra' ");
//$Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
//$Registro = mysqli_fetch_array($Consulta);
$linhas = mysqli_num_rows($Consulta);
//
if ($linhas > 0) {

    $resto1 = 0;
    $Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` BETWEEN '$start_sem_barra' AND '$end_sem_barra' OR `end` BETWEEN '$start_sem_barra' AND '$end_sem_barra' ");
//    $Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
    while ($Registro = mysqli_fetch_array($Consultas)) {

        $id = $Registro['id'];
        $id_material = $Registro['id_material'];
        $id_material2 = $Registro['id_material2'];
        $id_material3 = $Registro['id_material3'];

        $materiais = array("", "$id_material", "$id_material2", "$id_material3");
        $procura = array_search("$material", $materiais);
        //
        if ($procura) {

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
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id' ");
            $Registro = mysqli_fetch_array($Consulta);
            $quantidades = $Registro[$txt_qtd];

            $resto1 += $quantidades;
        } else {
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$material'");
            $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
            $quantidade_arq = $Registro['quantidade'];
        }
    }
    $html['resto1'] = $quantidade_arq - $resto1;
    print_r(json_encode($html));
    //
} else {
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$material'");
    $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
    $quantidade_arq = $Registro['quantidade'];
    $html['resto1'] = $quantidade_arq;
    print_r(json_encode($html));
}

    //

