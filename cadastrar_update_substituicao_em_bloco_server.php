<?php

include_once 'valida_cookies.inc';
?>
<?php

include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php

$enviado = filter_input(INPUT_POST, 'inputEnviado', FILTER_DEFAULT);
//$enviado = substr($enviado, 6, 4) . '-' . substr($enviado, 3, 2) . '-' . substr($enviado, 0, 2);

foreach (($_POST['servidor_selecionado']) as $lista_id) {

    $SQL_matricular = "UPDATE substituicoes SET data_envio = '$enviado', enviado = 'SIM' WHERE id= '$lista_id' ";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);
    //Logar no sistema para gravar Log           
    $SQL_Pesquisa = mysqli_query($Conexao, "SELECT * FROM `substituicoes` WHERE id = '$lista_id' ");
    $SQL_Resultado = mysqli_fetch_array($SQL_Pesquisa);
    $servidor = $SQL_Resultado['servidor'];
    
    $servidor2 .= "$servidor,";     
    
    
}
$servidor3 = substr($servidor2, 0,-1);

$SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
        . "VALUES ( '$usuario_logado', 'Enviou os Substiuições de Servidor: $servidor3 ', now())";
$Consulta1 = mysqli_query($Conexao, $SQL_logar);

if ($Consulta) {
    header("Location: pesquisar_substituicoes.php?id=1");
} else {
    header("Location: pesquisar_substituicoes.php?id=2");
}
  
  