<?php

include_once 'valida_cookies.inc';

include_once './inc.conf.php';

$Conexao = mysqli_connect('127.0.0.1', $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, 'utf8');
//
$SQL_consulta_id = 'SELECT * FROM `alunos` WHERE `id` = 109';
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

ob_start();
$html = ob_get_clean();





 
 
 

 $html = "
 <fieldset>
 <h1>Comprovante de Recibo</h1>
 <p class='center sub-titulo'>
 Nº <strong>0001</strong> - 
 VALOR <strong>R$ 700,00</strong>
 </p>
 <p>Recebi(emos) de <strong>Ebrahim Paula Leite</strong></p>
 <p>a quantia de <strong>Setecentos Reais</strong></p>
 <p>Correspondente a <strong>Serviços prestados ..<strong></p>
 <p>e para clareza firmo(amos) o presente.</p>
 <p class='direita'>Itapeva, 11 de Julho de 2017</p>
 <p>Assinatura ......................................................................................................................................</p>
 <p>Nome <strong>Alberto Nascimento Junior</strong> CPF/CNPJ: <strong>222.222.222-02</strong></p>
 <p>Endereço <strong>Rua Doutor Pinheiro, 144 - Centro, Itapeva - São Paulo</strong></p>
 </fieldset>
 <div class='creditos'>
 <p><a href='https://www.webcreative.com.br/artigo/gerar-pdf-com-php-e-html-usando-a-biblioteca-mpdf' target='_blank'>Aprenda como gerar PDF com PHP e HTML usando a biblioteca MPDF aqui</a></p>
 </div>
 ";
 
 include_once'/opt/lampp/htdocs/Escola/Classes/gerando-pdf-com-mpdf/mpdf60/mpdf.php';

 $mpdf=new mPDF(); 
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output();

 exit();

