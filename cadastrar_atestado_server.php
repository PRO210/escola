<?php

ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de cadastrar_atestado (Método POST)
$servidor = filter_input(INPUT_POST, 'inputServidor', FILTER_DEFAULT);
$funcao = filter_input(INPUT_POST, 'inputFuncao', FILTER_DEFAULT);
$substituto = "";
$substituto = filter_input(INPUT_POST, 'inputSubstituto', FILTER_DEFAULT);
$substituto2 = filter_input(INPUT_POST, 'inputSubstituto2', FILTER_DEFAULT);
$turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
$inputTextArea = filter_input(INPUT_POST, 'inputTextArea', FILTER_DEFAULT);

//
if ($substituto == "" && $substituto2 == "") {
//
    header("Location: pesquisar_atestado.php?id=3");
//
} elseif ($substituto == "" && $substituto2 !== "") {
    //   
    $tipo = filter_input(INPUT_POST, 'inputTipo', FILTER_DEFAULT);
    $tempo = filter_input(INPUT_POST, 'inputTempo', FILTER_DEFAULT);
    $tempo2 = filter_input(INPUT_POST, 'inputTempo', FILTER_DEFAULT) - 1;
    $recebido = filter_input(INPUT_POST, 'inputRecebido', FILTER_DEFAULT);
    $data_inicial = filter_input(INPUT_POST, 'inputDataInicial', FILTER_DEFAULT);
//$data_inicial = substr($data_inicial, 6, 4) . '-' . substr($data_inicial, 3, 2) . '-' . substr($data_inicial, 0, 2);
//$data_final = filter_input(INPUT_POST, 'inputDataFinal', FILTER_DEFAULT);
//$data_final = substr($data_final, 6, 4) . '-' . substr($data_final, 3, 2) . '-' . substr($data_final, 0, 2);
    $dataFinalCalculada = date("Y-m-d", strtotime($data_inicial . "+$tempo2 days"));
    $horaAulaSim = filter_input(INPUT_POST, 'inputAulasSim', FILTER_DEFAULT);
    $seg = filter_input(INPUT_POST, 'seg', FILTER_DEFAULT);
    $ter = filter_input(INPUT_POST, 'ter', FILTER_DEFAULT);
    $qua = filter_input(INPUT_POST, 'qua', FILTER_DEFAULT);
    $qui = filter_input(INPUT_POST, 'qui', FILTER_DEFAULT);
    $sex = filter_input(INPUT_POST, 'sex', FILTER_DEFAULT);
    //
    $remunerado = filter_input(INPUT_POST, 'InputRemunerado', FILTER_DEFAULT);
    $enviado = filter_input(INPUT_POST, 'InputEnviado', FILTER_DEFAULT);
    $data_envio01 = filter_input(INPUT_POST, 'inputDataEnvio', FILTER_DEFAULT);
    // $data_envio01 = substr($data_envio01, 6, 4) . '-' . substr($data_envio01, 3, 2) . '-' . substr($data_envio01, 0, 2);
    $data_envio = "";
    if ($enviado !== "SIM") {
        $data_envio = "";
    } else {
        $data_envio = "$data_envio01";
    }
    //Cadastra no banco de dados
    $SQL_matricular = "INSERT INTO atestados_servidor (`servidor`, `funcao`, `hora_aula`,`seg`,`ter`,`qua`,`qui`,`sex`,`substituto`, `recebido`, `turno` , `tipo` , `tempo`,    `data_envio`, `inicio`, `fim`,`remuneracao`, `enviado`,`obs`) "
            . "VALUES ('$servidor', '$funcao' , '$horaAulaSim', '$seg',' $ter', '$qua','$qui' , '$sex','" . $substituto . "" . $substituto2 . "', '$recebido', '$turno', '$tipo', '$tempo', '$data_envio' ,'$data_inicial', '$dataFinalCalculada', '$remunerado', '$enviado','$inputTextArea')";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
            . "VALUES ( '$usuario_logado', 'Inseriu o Atestado/Licença/Declaração/de $servidor ', 'SIM',now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta) {
        header("Location: pesquisar_atestado.php?id=1");
    } else {
        header("Location: pesquisar_atestado.php?id=2");
    }
    //
} elseif ($substituto !== "" && $substituto2 !== "") {
    //   
    header("Location: pesquisar_atestado.php?id=5");
    //
} elseif ($substituto !== "" && $substituto2 == "") {
    //
    $tipo = filter_input(INPUT_POST, 'inputTipo', FILTER_DEFAULT);
    $outros = filter_input(INPUT_POST, 'inputTextArea2', FILTER_DEFAULT);
    $tempo = filter_input(INPUT_POST, 'inputTempo', FILTER_DEFAULT);
    $tempo2 = filter_input(INPUT_POST, 'inputTempo', FILTER_DEFAULT) - 1;
    $recebido = filter_input(INPUT_POST, 'inputRecebido', FILTER_DEFAULT);
    $data_inicial = filter_input(INPUT_POST, 'inputDataInicial', FILTER_DEFAULT);
    $inputTextArea = filter_input(INPUT_POST, 'inputTextArea', FILTER_DEFAULT);
//$data_inicial = substr($data_inicial, 6, 4) . '-' . substr($data_inicial, 3, 2) . '-' . substr($data_inicial, 0, 2);
//$data_final = filter_input(INPUT_POST, 'inputDataFinal', FILTER_DEFAULT);
//$data_final = substr($data_final, 6, 4) . '-' . substr($data_final, 3, 2) . '-' . substr($data_final, 0, 2);
    $dataFinalCalculada = date("Y-m-d", strtotime($data_inicial . "+$tempo2 days"));
    $remunerado = filter_input(INPUT_POST, 'InputRemunerado', FILTER_DEFAULT);
    $enviado = filter_input(INPUT_POST, 'InputEnviado', FILTER_DEFAULT);
    $data_envio01 = filter_input(INPUT_POST, 'inputDataEnvio', FILTER_DEFAULT);
    $turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
    $horaAulaSim = filter_input(INPUT_POST, 'inputAulasSim', FILTER_DEFAULT);
    $seg = filter_input(INPUT_POST, 'seg', FILTER_DEFAULT);
    $ter = filter_input(INPUT_POST, 'ter', FILTER_DEFAULT);
    $qua = filter_input(INPUT_POST, 'qua', FILTER_DEFAULT);
    $qui = filter_input(INPUT_POST, 'qui', FILTER_DEFAULT);
    $sex = filter_input(INPUT_POST, 'sex', FILTER_DEFAULT);
    //
    $data_envio = "";
    if ($enviado !== "SIM") {
        $data_envio = "";
    } else {
        $data_envio = "$data_envio01";
    }
//Procura por duplicidade
    $Consulta_duplicidade = mysqli_query($Conexao, "SELECT * FROM `atestados_servidor` WHERE `servidor` LIKE '$servidor' AND `inicio` = '$data_inicial'");
//Cadastra no banco de dados
    if (mysqli_num_rows($Consulta_duplicidade) > 0) {
        header("Location: pesquisar_atestado.php?id=4");
    } else {
        $SQL_matricular = "INSERT INTO atestados_servidor (`servidor`, `funcao`, `hora_aula`,`seg`,`ter`,`qua`,`qui`,`sex`, `substituto`,`recebido`, `tipo`, `outros`, `turno`  ,`tempo`,`data_envio`, `inicio`, `fim`,`remuneracao`, `enviado`,`obs`) "
                . "VALUES ('$servidor', '$funcao' , '$horaAulaSim', '$seg',' $ter', '$qua','$qui' , '$sex', '" . $substituto . "" . $substituto2 . "','$recebido', '$tipo', '$outros' ,'$turno' ,'$tempo', '$data_envio' ,'$data_inicial', '$dataFinalCalculada', '$remunerado', '$enviado','$inputTextArea')";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        //Logar no sistema
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
                . "VALUES ( '$usuario_logado', 'Inseriu o Atestado/Licença/Declaração/de $servidor ','SIM',now())";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
//
        if ($Consulta) {
            header("Location: pesquisar_atestado.php?id=1");
        } else {
            header("Location: pesquisar_atestado.php?id=2");
        }
    }
}

