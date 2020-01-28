<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário (Método POST)
$idUpdate = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);
$nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$inep = filter_input(INPUT_POST, 'inputInep', FILTER_DEFAULT);
$cadastro = filter_input(INPUT_POST, 'inputCadastro', FILTER_DEFAULT);
$cnpj = filter_input(INPUT_POST, 'inputCnpj', FILTER_DEFAULT);
$do = filter_input(INPUT_POST, 'inputDo', FILTER_DEFAULT);
$ato = filter_input(INPUT_POST, 'inputAto', FILTER_DEFAULT);
$endereco = filter_input(INPUT_POST, 'inputEndereco', FILTER_DEFAULT);
$cidade = filter_input(INPUT_POST, 'inputCidade', FILTER_DEFAULT);
$estado = filter_input(INPUT_POST, 'inputEstado', FILTER_DEFAULT);
$cep = filter_input(INPUT_POST, 'inputCep', FILTER_DEFAULT);
$email = filter_input(INPUT_POST, 'inputEmail', FILTER_DEFAULT);
$data_censo = filter_input(INPUT_POST, 'inputDateCenso', FILTER_DEFAULT);
$data_matricula_valida = filter_input(INPUT_POST, 'inputDateMatriculaValida', FILTER_DEFAULT);
//
//$SQL_matricular = "INSERT INTO escola (`nome`,`inep`,`cadastro`,`cnpj`,`endereco`,`email`,`create_update` ) "
//        . "VALUES ( '$nome','$inep', '$cadastro', '$cnpj', '$endereco', '$email',now())";
//$Consulta = mysqli_query($Conexao, $SQL_matricular);
//Arquivos capturados para o LOG
$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '$idUpdate'");
$Registro_backup = mysqli_fetch_array($Consulta_backup);
//
if ($Registro_backup) {
    //
    $SQL_matricular = "UPDATE escola SET inep = '$inep', nome = '$nome', cadastro = '$cadastro',cnpj = '$cnpj',endereco = '$endereco', cidade = '$cidade', "
          . "do = '$do',ato = '$ato',estado = '$estado',cep = '$cep',email = '$email',data_censo = '$data_censo' ,data_matricula_valida = '$data_matricula_valida',create_update = now()"
          . " WHERE id= $idUpdate ";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);
//
    if ($Consulta) {
        //
        $Consulta_final = mysqli_query($Conexao, "SELECT * FROM `escola` WHERE `id`= $idUpdate ");
        $row_final = mysqli_fetch_array($Consulta_final);
        $result = array_diff_assoc($row_final, $Registro_backup);
        $campo = "";
        
//
        foreach ($result as $nome_campo => $valor) {
            //echo "$nome_campo = $valor<br>";
            if (!is_numeric($nome_campo)) {
                // echo "$nome_campo = $valor<br>";
                $campo .= "$nome_campo = $valor / ";
            }
        }
        //Logar no sistema
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
              . "VALUES ( '$usuario_logado', 'Alterou os Dados da Escola em: $campo', now())";
        $Consulta2 = mysqli_query($Conexao, $SQL_logar);
        //
        if ($Consulta2) {
            header("LOCATION: dados_escola.php?id=massa");
        }
    } else {
        header("LOCATION: dados_escola.php?id=erro");
    }
} else {
    header("LOCATION: dados_escola.php?id=erro");
}



