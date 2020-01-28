<?php

include_once 'valida_cookies.inc';
?>
<?php

//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de matrícula (Método POST)
$nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$nascimento = filter_input(INPUT_POST, 'inputNascimento', FILTER_DEFAULT);
$nascimento = substr($nascimento, 6, 4) . '-' . substr($nascimento, 3, 2) . '-' . substr($nascimento, 0, 2);
$modelo_certidao = filter_input(INPUT_POST, 'inputModelo_certidao', FILTER_DEFAULT);
$matricula = filter_input(INPUT_POST, 'inputMatricula', FILTER_DEFAULT);
$tipos_de_certidao = filter_input(INPUT_POST, 'inputTiposCertidao', FILTER_DEFAULT);
$certidao = filter_input(INPUT_POST, 'inputCertidao', FILTER_DEFAULT);
$expedicao = filter_input(INPUT_POST, 'inputExpedicao', FILTER_DEFAULT);
$expedicao = substr($expedicao, 6, 4) . '-' . substr($expedicao, 3, 2) . '-' . substr($expedicao, 0, 2);
$cpf = filter_input(INPUT_POST, 'inputCpf', FILTER_DEFAULT);
$celular = filter_input(INPUT_POST, 'inputCel', FILTER_DEFAULT);
$documentos = filter_input(INPUT_POST, 'inputDocumentos', FILTER_DEFAULT);

$emprestado = filter_input(INPUT_POST, 'inputEmprestado', FILTER_DEFAULT);
$emprestado = substr($emprestado, 6, 4) . '-' . substr($emprestado, 3, 2) . '-' . substr($emprestado, 0, 2);

$devolucao = filter_input(INPUT_POST, 'inputDevolucao', FILTER_DEFAULT);
$devolucao = substr($devolucao, 6, 4) . '-' . substr($devolucao, 3, 2) . '-' . substr($devolucao, 0, 2);

$devolvido = filter_input(INPUT_POST, 'inputData', FILTER_DEFAULT);
$devolvido = substr($devolvido, 6, 4) . '-' . substr($devolvido, 3, 2) . '-' . substr($devolvido, 0, 2);

$devolvido_sim = filter_input(INPUT_POST, 'inputDevolvidoSim', FILTER_DEFAULT);
$id = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);

//Arquivos capturados para o LOG
$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM documentos_emprestados WHERE id= '$id'");
$Registro_backup = mysqli_fetch_array($Consulta_backup);
//
$Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM documentos_emprestados WHERE id= '$id'");
$Registro_backup2 = mysqli_fetch_array($Consulta_backup2, MYSQLI_BOTH);
$nomebackup = $Registro_backup2["nome"];

$SQL_matricular = "UPDATE documentos_emprestados SET nome = '$nome', nascimento = '$nascimento', modelo_certidao = '$modelo_certidao' , matricula_certidao = '$matricula' , tipos_de_certidao = '$tipos_de_certidao' , certidao = '$certidao' , expedicao = '$expedicao',cpf = '$cpf', celular = '$celular', documentos = '$documentos', emprestado = '$emprestado', devolucao = '$devolucao', devolvido = '$devolvido', devolvidosim = '$devolvido_sim' WHERE id = '$id' ";
$Consulta = mysqli_query($Conexao, $SQL_matricular);

if ($Consulta) {

    $Consulta_final = mysqli_query($Conexao, "SELECT * FROM `documentos_emprestados` WHERE `id`= $id ");
    $row_final = mysqli_fetch_array($Consulta_final);
    $result = array_diff_assoc($row_final, $Registro_backup);
    $campo = "";

    foreach ($result as $nome_campo => $valor) {
        //echo "$nome_campo = $valor<br>";
        if (!is_numeric($nome_campo)) {
            // echo "$nome_campo = $valor<br>";
            $campo .= "$nome_campo = $valor / ";
            //echo "$campo";
        }
    }
//Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou os campos de $nomebackup em: $campo', 'SIM',now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar);
    //echo "$SQL_logar";
    header("Location: pesquisar_documentos.php?id=1");
} else {
    header("Location: pesquisar_documentos.php?id=2");
    //echo mysqli_error($Conexao);
}