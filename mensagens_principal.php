<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");


$id_recebido = $_POST['id'];

$hoje = date('Y-m-d');
//$hoje = date('2019-04-22');
$Consultas_agendamentos = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` LIKE '%$hoje%'");
$Linhas_agendamentos = mysqli_num_rows($Consultas_agendamentos);
//
if ($Linhas_agendamentos > 0) {
    //echo "kkkkkkkkkkkkkkk" . "<br>";
    $msg_agendamentos = "";

    while ($Registro = mysqli_fetch_array($Consultas_agendamentos)) {
        //
        
        $item = "";
        $i = 0;
        $id_servidor = $Registro['id_servidor'];
        $start = substr($Registro['start'],10);
        $end = substr($Registro['end'],10);
        //
        $Consulta_servidor = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE id = '$id_servidor'");
        $Registro_servidor = mysqli_fetch_array($Consulta_servidor, MYSQLI_BOTH);
        $nome_servidor = $Registro_servidor['nome'];
        //
        $id_material = $Registro['id_material'];
        $qtd_material = $Registro['quantidade'];
        $id_material2 = $Registro['id_material2'];
        $qtd_material2 = $Registro['quantidade2'];
        $id_material3 = $Registro['id_material3'];
        $qtd_material3 = $Registro['quantidade3'];

        $qtds_materiais = array("$qtd_material", "$qtd_material2", "$qtd_material3");
        //
        $Consulta_material = mysqli_query($Conexao, "SELECT * FROM `materiais` WHERE id IN($id_material,$id_material2,$id_material3)");
        
        while ($Registro_material = mysqli_fetch_array($Consulta_material, MYSQLI_BOTH)) {
            $nome_material = $Registro_material['nome'];
            $item .= "$qtds_materiais[$i] $nome_material, ";
            $i++;
        }
        $msg_agendamentos .= "$nome_servidor Agendou => $item; De $start às $end    / ";
    }
    $html['msg_agendamentos'] = $msg_agendamentos . "Para Hoje!";
    $html['msg_sim'] = "sim";
} else {
    $html['msg_sim'] = "nao";
}
//
//
$html['id_devolve'] = $id_recebido;
print_r(json_encode($html));



