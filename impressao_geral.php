<?php

include_once 'valida_cookies.inc';

include_once './inc.conf.php';

$Conexao = mysqli_connect('127.0.0.1', $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, 'utf8');
//
$Recebe_id = filter_input($_GET, 'id', FILTER_DEFAULT);
$SQL_consulta_id = "SELECT * FROM `alunos` WHERE `id` = $Recebe_id";
$Consulta = mysqli_query($Conexao, $SQL_consulta_id);
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);

//Recebi a data do banco
$modelo_novo = '';
$modelo_velho = '';
$modelo_certidao = $Linha['modelo_certidao'];
$matricula = $Linha['matricula_certidao'];
$displayV = '';
$displayN = '';
if ($modelo_certidao == 'NOVO') {
    $modelo_novo = 'X';
    $displayV = 'display: none';
    $displayN = '';
} else {
    $modelo_velho = 'X';
    $displayV = '';
    $displayN = 'display: none';
}
//
$nascimento = new DateTime($Linha['data_nascimento']);
$data_matricula = new DateTime($Linha['Data_matricula']);

$certidao_civil = $Linha['certidao_civil'];
//Escolha do Grau
$ano = '';
$infantil = '';
$eja = '';

if ($Linha['turma'] == '1 ANO A (MATUTINO)') {
    $ano = 'X';
} elseif ($Linha['turma'] == '2 ANO A (MATUTINO)') {
    $ano = 'X';
} elseif ($Linha['turma'] == '2 ANO B (MATUTINO)') {
    $ano = 'X';
} elseif ($Linha['turma'] == '1 ANO B (VESPERTINO)') {
    $ano = 'X';
} elseif ($Linha['turma'] == '3 ANO (VESPERTINO)') {
    $ano = 'X';
} elseif ($Linha['turma'] == 'EJA I (NOTURNO)') {
    $eja = 'X';
} elseif ($Linha['turma'] == 'EJA II (NOTURNO)') {
    $eja = 'X';
} elseif ($Linha['turma'] == 'EJA III (NOTURNO)') {
    $eja = 'X';
} elseif ($Linha['turma'] == 'EJA IV (NOTURNO)') {
    $eja = 'X';
} else {
    
}

if ($ano == 'X') {
    $infantil = '1° Grau';
} elseif ($eja == 'X') {
    $infantil = '1° Grau';
} else {
    $infantil = 'Educação Infantil';
}
//Escolha do Tipo de Certidão
$certidao_nascimento = '';
$certidao_casamento = '';
$certidao_rg = '';
if ($Linha['tipos_de_certidao'] == 'NASCIMENTO') {
    $certidao_nascimento = 'X';
} elseif ($Linha['tipos_de_certidao'] == 'CASAMENTO') {
    $certidao_casamento = 'X';
} else {
    $certidao_rg = 'X';
}

//Escolha do Sexo
$sexo = '';
if ($Linha['sexo'] == 'M') {
    $sexo = 'MASCULINO';
} else {
    $sexo = 'FEMININO';
}
$nis = $Linha['nis'];
$sus = $Linha['sus'];

//
$html = "
   

<html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <title>REQUERIMENTO DE MATRICULA</title>        
       
       <style ='text/css'>
body{
    height: 27cm;     width: 19cm;     margin: 0cm auto;   border: solid black thin;   
}
img{                width: 19cm; height: 3cm;            }
.caixaInicial{
    width: 19cm; text-align: center; 
}

.caixa{
    width: 19cm; font-size: 12px;
}
.e1F,.d1F{
    float: left; height: 25px; padding-left: 4px;
}
.e2F{
    float: left; height: 25px; min-width: 8cm;
}
</style>
    </head>
    <body>
       
        <div class='caixaInicial'>
            <h3>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</h3>
            <p style='margin-top: -16px; font-size: 10px;'>Identificação Única INEP:26049716 CADASTRO ESCOLAR:M500028</p>
        </div>
        <h4 style= ' text-align: center'> Requerimento de Matrícula</h4>
        <div class='caixa p'>
            <p> Requeiro a matrícula no  ".$Linha['turma'].",do curso de <b> ".$infantil."</b>, declarando aceitar as disposições expressas no requerimento 
                e me responsabilizando pela autenticidade dos documentos entregues neste ato.</p>  
        </div>
        <h5 style= ' text-align: center'> DADOS PESSOAIS DO ALUNO</h5>
        <div class='caixa'>
            <div class='e1F'> <p>NIS:</p></div><div class='e2F border'><p>&nbsp; ".$Linha['nis']."</p></div>
            
           
          
        </div>
    </body>
</html>";

use dompdf\dompdf;

include_once '/opt/lampp/htdocs/Escola/Classes/dompdf/dompdf/autoload.inc.php';

$dompdf = new \Dompdf\Dompdf();

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream(
      'Relatório dos alunos', array(
   'Attachment' => FALSE
      )
);
