<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$enviado = filter_input(INPUT_POST, 'inputEnviado', FILTER_DEFAULT);
//$enviado = substr($enviado, 6, 4) . '-' . substr($enviado, 3, 2) . '-' . substr($enviado, 0, 2);
foreach (($_POST['servidor_selecionado']) as $lista_id) {

    $SQL_matricular = "UPDATE atestados_servidor SET data_envio = '$enviado', enviado = 'SIM' WHERE id= '$lista_id' ";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);
    //Logar no sistema para gravar Log           
    $SQL_Pesquisa = mysqli_query($Conexao, "SELECT * FROM `atestados_servidor` WHERE id = '$lista_id' ");
    $SQL_Resultado = mysqli_fetch_array($SQL_Pesquisa);
    $servidor = $SQL_Resultado['servidor'];

    $servidor2 .= "$servidor,";
}
//
$servidor3 = substr($servidor2, 0, -1);
//
$SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
        . "VALUES ( '$usuario_logado', 'Enviou o(s) Atestado/Licença/Declaração do(s) Servidor(es): $servidor3 ', now())";
$Consulta1 = mysqli_query($Conexao, $SQL_logar);
///
if ($Consulta) {
    header("Location: pesquisar_atestado.php?id=1");
} else {
    header("Location: pesquisar_atestado.php?id=2");
}
  
  