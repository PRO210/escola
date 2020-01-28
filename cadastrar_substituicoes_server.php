<?php

ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de cadastrar_substiuiçoes (Método POST)
$servidor = filter_input(INPUT_POST, 'inputServidor', FILTER_DEFAULT);
$funcao = filter_input(INPUT_POST, 'inputFuncao', FILTER_DEFAULT);
$substituto = "";
$substituto = filter_input(INPUT_POST, 'inputSubstituto', FILTER_DEFAULT);
$substituto2 = filter_input(INPUT_POST, 'inputSubstituto2', FILTER_DEFAULT);
$horaAulaSim = filter_input(INPUT_POST, 'inputAulasSim', FILTER_DEFAULT);
$seg = filter_input(INPUT_POST, 'seg', FILTER_DEFAULT);
$ter = filter_input(INPUT_POST, 'ter', FILTER_DEFAULT);
$qua = filter_input(INPUT_POST, 'qua', FILTER_DEFAULT);
$qui = filter_input(INPUT_POST, 'qui', FILTER_DEFAULT);
$sex = filter_input(INPUT_POST, 'sex', FILTER_DEFAULT);
//
if ($substituto == "") {
    $substituto = $substituto2;
}
//
$tempo = filter_input(INPUT_POST, 'inputTempo', FILTER_DEFAULT);
$remunerado = filter_input(INPUT_POST, 'InputRemunerado', FILTER_DEFAULT);
$inicio = filter_input(INPUT_POST, 'inputDataInicial', FILTER_DEFAULT);
$dataFinalCalculada = date("Y-m-d", strtotime($inicio . "+$tempo days"));

$enviado = filter_input(INPUT_POST, 'InputEnviado', FILTER_DEFAULT);
$data_envio01 = filter_input(INPUT_POST, 'inputDataEnvio', FILTER_DEFAULT);
//$data_envio01 = substr($data_envio01, 6, 4) . '-' . substr($data_envio01, 3, 2) . '-' . substr($data_envio01, 0, 2);
$data_envio = "";
if ($enviado !== "SIM") {
    $data_envio = "";
} else {
    $data_envio = "$data_envio01";
}
//Procura por duplicidade
$Consulta_duplicidade = mysqli_query($Conexao, "SELECT * FROM `substituicoes` WHERE `servidor` LIKE '$servidor' AND `inicio` = '$inicio'");
//
if (mysqli_num_rows($Consulta) > 0) {
    header("Location: pesquisar_substituicoes.php?id=4");
} else {
    //Cadastra no banco de dados
    $SQL_matricular = "INSERT INTO substituicoes (`servidor`, `substituto`, `funcao`, `hora_aula`,`seg`,`ter`,`qua`,`qui`,`sex`,`tempo`,`data_envio`, `inicio`, `fim`,`remuneracao`, `enviado`) "
          . "VALUES ('$servidor', '$substituto', '$funcao' , '$horaAulaSim', '$seg', ' $ter', '$qua', '$qui' , '$sex', '$tempo', '$data_envio' ,'$inicio', '$dataFinalCalculada', '$remunerado', '$enviado')";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);


         // exit();
//Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
          . "VALUES ( '$usuario_logado', 'Inseriu a Substiuição de $servidor por $substituto' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);

    if ($Consulta) {
        header("Location: pesquisar_substituicoes.php?id=1");
    } else {
        header("Location: pesquisar_substituicoes.php?id=2");
    }
}


   