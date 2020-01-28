<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Update de Turma
//Recebe os valores do furmulário de matrícula (Método POST)
$id = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);
$idEncode = base64_encode($id);
$turma = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
$turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
$unico = filter_input(INPUT_POST, 'inputUnico', FILTER_DEFAULT);
$categoria = filter_input(INPUT_POST, 'inputCategoria', FILTER_DEFAULT);
$status = filter_input(INPUT_POST, 'inputStatus', FILTER_DEFAULT);
$ano = filter_input(INPUT_POST, 'inputAno', FILTER_DEFAULT);
$idade_turma = filter_input(INPUT_POST, 'inputIdade', FILTER_DEFAULT);
$extra = filter_input(INPUT_POST, 'select_turma_extra', FILTER_DEFAULT);
//BACKUP PARA LOG
$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM turmas WHERE id = '$id' ");
$linha_backup = mysqli_fetch_array($Consulta_backup);
$turma_backup = $linha_backup['turma'];
//UPDATE DE TURMA
$SQL_Turma = "UPDATE turmas SET turma = '$turma', turno = '$turno', categoria = '$categoria', unico = '$unico' , status = '$status', turma_extra  = '$extra', ano = '$ano', idade_turma = '$idade_turma' "
        . "WHERE id = $id ";
$Consulta_Turma = mysqli_query($Conexao, $SQL_Turma);
//LIMPAR CADASTTROS ANTIGOS DOS PROFESSORES E A TURMA
$SQL_DELETA = mysqli_query($Conexao, "DELETE FROM `turmas_professor2` WHERE `turmas_professor2`.`id_turma` = '$id' ");
//INSERE A TURMA DO UPDATE
if (empty($_POST['servidor_selecionado'])) {
    $Consulta_Registrar = TRUE;
} else {
    foreach (($_POST['servidor_selecionado']) as $lista_id) {
        $Registrar = "INSERT INTO turmas_professor2 (`id_turma`, `id_professor` )"
                . "VALUES ( '$id', '$lista_id' )";
        $Consulta_Registrar = mysqli_query($Conexao, $Registrar);
        /////           
    }
}
//BACKUP PARA LOG
//LOG PARA OS PROFESSORES
$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `turmas_professor2` WHERE `id_turma` = '$id' ");
$IdsProfessores = "";
$nomes = "";
while ($row2 = mysqli_fetch_array($Consulta2)) {

    $id_professor = $row2['id_professor'];
    $IdsProfessores .= $id_professor . ",";
    $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `id` = " . $id_professor . "  ORDER BY nome");
    $Registro = mysqli_fetch_array($Consultaf);
    $nome = $Registro["nome"];
    $id_professor = $Registro["id"];

    $nomes .= "$nome,";
    $IdsProfessores_final = substr($nomes, 0, -1);
}
$Consulta_backup_final = mysqli_query($Conexao, "SELECT * FROM turmas WHERE id = '$id' ");
$linha_backup_final = mysqli_fetch_array($Consulta_backup_final);
$result = array_diff_assoc($linha_backup_final, $linha_backup);
$campo = "";

foreach ($result as $nome_campo => $valor) {
    //echo "$nome_campo = $valor<br>";
    if (!is_numeric($nome_campo)) {
        // echo "$nome_campo = $valor<br>";
        $campo .= "$nome_campo = De $linha_backup[$nome_campo] para $valor / ";
        //echo "$campo";
    }
}
 include_once 'cadastrar_copia_turma_server_2.php';
//Logar no sistema
$SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
        . "VALUES ( '$usuario_logado', 'Alterou os campos da Turma $turma_backup : $campo e vinculou a ela: $IdsProfessores_final ', 'SIM',now())";
$Consulta2 = mysqli_query($Conexao, $SQL_logar);
//
if ($Consulta_Turma && $Consulta_Registrar && $Consulta2) {
    session_start();
    $_SESSION['acerto'] = 'S';
    header("LOCATION: cadastrar_update_turma.php?id=$idEncode");
} else {
    session_start();
    $_SESSION['acerto'] = 'N';
    header("LOCATION: cadastrar_update_turma.php?id=$idEncode");
}
        