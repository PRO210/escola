<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id_recebido = $_POST['id'];
$start = $_POST['start'];
$end = $_POST['end'];
//
$Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id` = '$id_recebido' ");
$Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
//$start = $Registro['start'];
//$end = $Registro['end'];
//$title = $Registro['title'];
$color = $Registro['color'];
$id_servidor = $Registro['id_servidor'];
$id_material = $Registro['id_material'];
$id_material2 = $Registro['id_material2'];
$id_material3 = $Registro['id_material3'];
$quantidade = $Registro['quantidade'];
$quantidade2 = $Registro['quantidade2'];
$quantidade3 = $Registro['quantidade3'];
$id_material22 = $Registro['id_material2'];
$quantidade22 = $Registro['quantidade2'];
$id_material33 = $Registro['id_material3'];
$quantidade33 = $Registro['quantidade3'];
$inputTextArea = $Registro['obs'];
if ($quantidade33 == "0") {
    $quantidade33 = "";
}
if ($quantidade22 == "0") {
    $quantidade22 = "";
}

$quantidades = "$quantidade" . " , " . "$quantidade22" . " , " . "$quantidade33";

////    //
$Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `id` = $id_servidor");
$Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$servidor = $Registro['nome'];
////Para a visualização dos dados
$materias = "";
$Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id IN ($id_material,$id_material2,$id_material3) order by nome");
while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    $material = $Registro['nome'];
    $materias .= "$material" . ",";
}
//$quantidade_total = $Registro['quantidade'];
////    
////  
$html['start'] = "$start";
$html['end'] = "$end";
//$html['title'] = "$title";
$html['color'] = "$color";
$html['nome_servidor'] = "$servidor";
$html['id_servidor'] = "$id_servidor";
$html['nome_material'] = substr($materias, 0, -1);
$html['id_material'] = $id_material;
$html['quantidade'] = "$quantidade";
$html['quantidades'] = "$quantidades";
$html['id_material22'] = $id_material22;
$html['quantidade22'] = "$quantidade22";
$html['id_material33'] = $id_material33;
$html['quantidade33'] = "$quantidade33";
$html['obs_json'] = "$inputTextArea";
//
$html['id_recebido'] = "$id_recebido";
//    $html['dte'] = new DateTime($Registro['data_entregue']);
//    $html['dte'] = date_format($html['dte'], 'Y-m-d');
//
//Material Um   //Material Um   //Material Um
//
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

$resto1 = 0;
$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` BETWEEN '$start_sem_barra' AND '$end_sem_barra' OR `end` BETWEEN '$start_sem_barra' AND '$end_sem_barra' ");
//$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
while ($Registro = mysqli_fetch_array($Consultas)) {

    $id = $Registro['id'];
    $id_materia01 = $Registro['id_material'];
    $id_material02 = $Registro['id_material2'];
    $id_material03 = $Registro['id_material3'];

    $materiais = array("", "$id_materia01", "$id_material02", "$id_material03");
    $procura = array_search("$id_material", $materiais);
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
        //
    } else {
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$id_material'");
        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
        $quantidade_arq = $Registro['quantidade'];
    }
}
$html['resto1'] = $quantidade_arq - $resto1;
//
//Material Dois  //Material Dois   //Material Dois
//
$resto2 = 0;
$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` BETWEEN '$start_sem_barra' AND '$end_sem_barra' OR `end` BETWEEN '$start_sem_barra' AND '$end_sem_barra' ");
//$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
while ($Registro = mysqli_fetch_array($Consultas)) {

    $id = $Registro['id'];
    $id_materia01 = $Registro['id_material'];
    $id_material02 = $Registro['id_material2'];
    $id_material03 = $Registro['id_material3'];

    $materiais = array("", "$id_materia01", "$id_material02", "$id_material03");
    $procura = array_search("$id_material2", $materiais);
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
        $resto2 += $quantidades;
        //
    } else {
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$id_material2'");
        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
        $quantidade_arq = $Registro['quantidade'];
    }
}
$html['resto2'] = $quantidade_arq - $resto2;
//
//Material três  //Material três   //Material três
//
$resto3 = 0;
$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` BETWEEN '$start_sem_barra' AND '$end_sem_barra' OR `end` BETWEEN '$start_sem_barra' AND '$end_sem_barra' ");
//$Consultas = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` = '$start_sem_barra' AND `end` = '$end_sem_barra'");
while ($Registro = mysqli_fetch_array($Consultas)) {

    $id = $Registro['id'];
    $id_materia01 = $Registro['id_material'];
    $id_material02 = $Registro['id_material2'];
    $id_material03 = $Registro['id_material3'];

    $materiais = array("", "$id_materia01", "$id_material02", "$id_material03");
    $procura = array_search("$id_material3", $materiais);
    //
    if ($procura) {

        $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$materiais[$procura]'");
        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
        $quantidade_arq3 = $Registro['quantidade'];
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
        $quantidades3 = $Registro[$txt_qtd];
        $resto3 += $quantidades3;
        //
    } else {
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id = '$id_material3'");
        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
        $quantidade_arq3 = $Registro['quantidade'];
    }
}
$html['resto3'] = $quantidade_arq3 - $resto3;

print_r(json_encode($html));



