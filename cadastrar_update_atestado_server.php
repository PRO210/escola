<?php

ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de cadastrar_atestado (Método POST)
$servidor = filter_input(INPUT_POST, 'inputServidor', FILTER_DEFAULT);
$substitutoAtual = filter_input(INPUT_POST, 'inputSubstitutoAtual', FILTER_DEFAULT);
$substituto_I = filter_input(INPUT_POST, 'inputSubstituto_I', FILTER_DEFAULT);
$substituto_II = filter_input(INPUT_POST, 'inputSubstituto_II', FILTER_DEFAULT);
$turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
$horaAulaSim = filter_input(INPUT_POST, 'inputAulasSim', FILTER_DEFAULT);
$inputTextArea = filter_input(INPUT_POST, 'inputTextArea', FILTER_DEFAULT);
$seg = filter_input(INPUT_POST, 'seg', FILTER_DEFAULT);
$ter = filter_input(INPUT_POST, 'ter', FILTER_DEFAULT);
$qua = filter_input(INPUT_POST, 'qua', FILTER_DEFAULT);
$qui = filter_input(INPUT_POST, 'qui', FILTER_DEFAULT);
$sex = filter_input(INPUT_POST, 'sex', FILTER_DEFAULT);

if ($substitutoAtual == "" && $substituto_I == "" && $substituto_II == "") {
    header("Location: pesquisar_atestado.php?id=3");
} else {
    $funcao = filter_input(INPUT_POST, 'inputFuncao', FILTER_DEFAULT);
    $recebido = filter_input(INPUT_POST, 'inputRecebido', FILTER_DEFAULT);
    //$recebido = substr($recebido, 6, 4) . '-' . substr($recebido, 3, 2) . '-' . substr($recebido, 0, 2);
    $tipo = filter_input(INPUT_POST, 'inputTipo', FILTER_DEFAULT);
    $outros = filter_input(INPUT_POST, 'inputTextArea2', FILTER_DEFAULT);
    $tempo = filter_input(INPUT_POST, 'inputTempo', FILTER_DEFAULT);
    $tempo2 = filter_input(INPUT_POST, 'inputTempo', FILTER_DEFAULT) - 1;
    $data_inicial = filter_input(INPUT_POST, 'inputDataInicial', FILTER_DEFAULT);

    $dataFinalCalculada = date("Y-m-d", strtotime($data_inicial . "+$tempo2 days"));

    $remunerado = filter_input(INPUT_POST, 'InputRemunerado', FILTER_DEFAULT);
    $enviado = filter_input(INPUT_POST, 'InputEnviado', FILTER_DEFAULT);
    $data_envio01 = filter_input(INPUT_POST, 'inputDataEnvio', FILTER_DEFAULT);
    //$data_envio01 = substr($data_envio01, 6, 4) . '-' . substr($data_envio01, 3, 2) . '-' . substr($data_envio01, 0, 2);

    $id = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);

    $data_envio = "";
    if ($enviado !== "SIM") {
        $data_envio = "";
    } else {
        $data_envio = "$data_envio01";
    }
//Arquivos capturados para o LOG
    $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM atestados_servidor WHERE id= '$id'");
    $Registro_backup = mysqli_fetch_array($Consulta_backup);
//
    $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM atestados_servidor WHERE id= '$id'");
    $Registro_backup2 = mysqli_fetch_array($Consulta_backup2, MYSQLI_BOTH);
    $servidorbackup = $Registro_backup2['servidor'];
//
    $SQL_matricular = "UPDATE `atestados_servidor` SET servidor = '$servidor', funcao = '$funcao' ,substituto = '" . $substitutoAtual . "" . $substituto_I . "" . $substituto_II . "', "
            . "recebido = '$recebido', turno = '$turno' , tipo = '$tipo', outros = '$outros', tempo = '$tempo', inicio = '$data_inicial', fim = '$dataFinalCalculada', remuneracao = '$remunerado',"
            . " enviado = '$enviado', data_envio = '$data_envio', hora_aula = '$horaAulaSim', seg = '$seg', ter = '$ter', qua = '$qua', qui = '$qui', sex = '$sex', obs = '$inputTextArea'  WHERE id= $id ";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);
//
    $Consulta_final = mysqli_query($Conexao, "SELECT * FROM `atestados_servidor` WHERE `id`= $id ");
    $row_final = mysqli_fetch_array($Consulta_final);
    $result = array_diff_assoc($row_final, $Registro_backup);
    $campo = "";
//
    foreach ($result as $nome_campo => $valor) {
        //echo "$nome_campo = $valor<br>";
        if (!is_numeric($nome_campo)) {
            // echo "$nome_campo = $valor<br>";
            $campo .= "$nome_campo = $valor / ";
            //echo "$campo";
        }
    }
//Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou os campos do Atestado de $servidorbackup em: $campo', now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar);
//echo "$SQL_logar";       

    if ($Consulta && $Consulta2) {
        header("Location: pesquisar_atestado.php?id=1");
    } else {
        header("Location: pesquisar_atestado.php?id=2");
    }
} 
