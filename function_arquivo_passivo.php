<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");

$conexao = new PDO("mysql:host=localhost;dbname=$Base", "$Usuario", "$Senha");
$conexao->exec('SET CHARACTER SET utf8');

$pasta = substr($_POST['id'], 0, 1);
$pegaCidades = $conexao->prepare("SELECT * FROM pastas_arquivo_passivo WHERE pasta LIKE '%" . $pasta . "%'");
$pegaCidades->execute();

$fetchAll = $pegaCidades->fetchAll();
foreach ($fetchAll as $cidades) {
    //
    $Consulta = mysqli_query($Conexao, "SELECT alunos.ap_pasta,pastas_arquivo_passivo.pasta,pastas_arquivo_passivo.cheio,COUNT(*) AS cont FROM alunos, pastas_arquivo_passivo WHERE pasta LIKE '%" . $cidades['pasta'] . "%' AND alunos.ap_pasta LIKE '%" . $cidades['pasta'] . "%' GROUP BY ap_pasta");
    $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
    $cont = $Registro['cont'];
    $cheio = $Registro['cheio'];
    //
    if ($cheio == "SIM") {
        $cheio = "Arquivo Físico Cheio! Por Favor Verifique:";
    } else {
        $cheio = "";
    }
    $p = "";
    if ($cont == "") {
        $p = "Zero";
    }
    $txt = " A pasta " . $cidades['pasta'] . " Já tem $cont  $p Registros: - $cheio)";
    echo '<option value = ' . $cidades['pasta'] . '>' . $txt . '</option>';
}