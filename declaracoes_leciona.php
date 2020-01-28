<?php
include_once 'valida_cookies.inc';
?>
<?php
//include_once'./matricular.php';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores da URL (Método GET)
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$SQL_consulta_id = "SELECT * FROM `alunos` WHERE `id` = $id";
$Consulta = mysqli_query($Conexao, $SQL_consulta_id);
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$nome = $Linha['nome'];
$data_nascimentof = new DateTime($Linha["data_nascimento"]);
$nascimento = date_format($data_nascimentof, 'd / m / Y');
$naturalidade = $Linha['naturalidade'];
$mae = $Linha['mae'];
$pai = $Linha['pai'];
if ($pai == "") {
    $pai_e = " ";
} else {
    $pai_e = " e ";
}
$turma = $Linha['turma'];
if ($Linha["turma"] == "1 ANO A (MATUTINO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "2 ANO A (MATUTINO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "2 ANO B (MATUTINO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "2 ANO C (VESPERTINO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "2 ANO D (VESPERTINO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "1 ANO B (VESPERTINO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "3 ANO (VESPERTINO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "EJA I (NOTURNO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "EJA II (NOTURNO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "EJA III (NOTURNO)") {
    $categoria = "1 GRAU.";
} elseif ($Linha["turma"] == "EJA IV (NOTURNO)") {
    $categoria = "1 GRAU.";
} else {
    $categoria = "EDUCAÇÃO INFANTIL.";
}
// leitura das datas automaticamente
$dia = date('d');
//$mes = date('m');
$mes = date('m');
//$ano = date('Y');
$ano = date('Y');
$semana = date('w');
switch ($mes) {
    case 1: $mes = "Janeiro";
        break;
    case 2: $mes = "Fevereiro";
        break;
    case 3: $mes = "Março";
        break;
    case 4: $mes = "Abril";
        break;
    case 5: $mes = "Maio";
        break;
    case 6: $mes = "Junho";
        break;
    case 7: $mes = "Julho";
        break;
    case 8: $mes = "Agosto";
        break;
    case 9: $mes = "Setembro";
        break;
    case 10: $mes = "Outubro";
        break;
    case 11: $mes = "Novembro";
        break;
    case 12: $mes = "Dezembro";
        break;
}
// configuração semana 
switch ($semana) {

    case 0: $semana = "Domingo";
        break;
    case 1: $semana = "Segunda Feira";
        break;
    case 2: $semana = "Terça Feira";
        break;
    case 3: $semana = "Quarta Feira";
        break;
    case 4: $semana = "Quinta Feira";
        break;
    case 5: $semana = "Sexta Feira";
        break;
    case 6: $semana = "Sábado";
        break;
}
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>DECLARAÇÃO BOLSA FAMÍLIA</title>
        <link href="css/declaracoes_bolsa_familia.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <img src="img/timbre.jpg" alt=""/>
        <div class="caixaInicial">
            <h2>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</h2>
            <p style="margin-top: -16px; font-size: 10px;">Identificação Única INEP:26049716 CADASTRO ESCOLAR:M500028</p>
        </div>
        <h3 style= " text-align: center; padding: 1cm;"> DECLARAÇÃO DE FREQUÊNCIA ESCOLAR</h3>
        <div class="caixa p1">
            <p>
                Declaro para os devidos fins de direito que o aluno(a) <?php echo"$nome"; ?>, nascido(a) em &nbsp;&nbsp;<?php echo $nascimento ?>
                na cidade de &nbsp;&nbsp;<?php echo"$naturalidade"; ?>, filho de &nbsp;&nbsp;<?php echo"$mae"; ?><?php echo"$pai_e  $pai"; ?>
                residente em Alagoinha, Estado de Pernambuco, encontra-se matriculado na Escola Municipal Tabeliao Raul Galindo Sobrinho - Alagoinha/PE, e 
                frequenta regularmente as aulas , cursando o  <?php echo"$turma" ?> &nbsp;do&nbsp; <?php echo"$categoria" ?>
            </p>
        </div>
        <div class="caixa_2">
            <p> Alagoinha, <?php echo"$dia" ?> de <?php echo"$mes" ?> de <?php echo"$ano" ?>.</p>
        </div>
        <div class="caixa_3">
            <p>____________________________________________</p>
            <p>RESPONSÁVEL PELA INFORMAÇÃO</p>
        </div>
        <div class="rodape">
            <p>C.N.P.J.:11.043.981/0001-70</p>
            <p style="margin-top: -6px">End.:Praça Barão do Rio Branco,153,Centro - Alagoinha-PE, CEP.:55.2600.000, Tel.: 
                (87)3839-1156 - email.:pma.pe@terra.com.br
        </div>
    </body>
</html>
