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

//Recebi a data do banco
$cor = $Linha["cor_raca"];
$necessidades = $Linha["necessidades"];

$modelo_novo = "";
$modelo_velho = "";
$modelo_certidao = $Linha["modelo_certidao"];
$matricula = $Linha["matricula_certidao"];
$displayV = "";
$displayN = "";
if ($modelo_certidao == "NOVO") {
    //Para funcionar normal basta descomentar as linhas modelo_novo e etc.
    $modelo_velho = "X";
    $displayV = "";
    $displayN = "display: none";
    /* $modelo_novo = "X";
    $displayV = "display: none";
    $displayN = ""; */
} else {
    $modelo_velho = "X";
    $displayV = "";
    $displayN = "display: none";
}
$expedicao=$Linha["data_expedicao"];
//
$nascimento = new DateTime($Linha["data_nascimento"]);
//$nascimento = date_format($nascimento, 'dmY');

$data_matricula = new DateTime($Linha["Data_matricula"]);
// leitura das datas automaticamente
$dia = date_format($nascimento, 'd');
//$mes = date('m');
$mes = date_format($nascimento, 'm');
//$ano = date('Y');
$ano_nascimento = date_format($nascimento, 'Y');
$semana = date('w');
$cidade = "Digite aqui sua cidade";

// configuração mes 

switch ($mes){

case 1: $mes = "Janeiro"; break;
case 2: $mes = "Fevereiro"; break;
case 3: $mes = "Março"; break;
case 4: $mes = "Abril"; break;
case 5: $mes = "Maio"; break;
case 6: $mes = "Junho"; break;
case 7: $mes = "Julho"; break;
case 8: $mes = "Agosto"; break;
case 9: $mes = "Setembro"; break;
case 10: $mes = "Outubro"; break;
case 11: $mes = "Novembro"; break;
case 12: $mes = "Dezembro"; break;

}
// configuração semana 
switch ($semana) {

case 0: $semana = "Domingo"; break;
case 1: $semana = "Segunda Feira"; break;
case 2: $semana = "Terça Feira"; break;
case 3: $semana = "Quarta Feira"; break;
case 4: $semana = "Quinta Feira"; break;
case 5: $semana = "Sexta Feira"; break;
case 6: $semana = "Sábado"; break;
}
//Agora basta imprimir na tela...
//echo (" $dia de $mes de $ano");

$certidao_civil = $Linha["certidao_civil"];
//Escolha do Grau
$ano = "";
$infantil = "";
$eja = "";

if ($Linha["turma"] == "1 ANO A (MATUTINO)") {
    $ano = "X";
} elseif ($Linha["turma"] == "2 ANO A (MATUTINO)") {
    $ano = "X";
} elseif ($Linha["turma"] == "2 ANO B (MATUTINO)") {
    $ano = "X";
} elseif ($Linha["turma"] == "2 ANO C (VESPERTINO)") {
    $ano = "X";
} elseif ($Linha["turma"] == "2 ANO D (VESPERTINO)") {
    $ano = "X";
}elseif ($Linha["turma"] == "1 ANO B (VESPERTINO)") {
    $ano = "X";
} elseif ($Linha["turma"] == "3 ANO (VESPERTINO)") {
    $ano = "X";
} elseif ($Linha["turma"] == "EJA I (NOTURNO)") {
    $eja = "X";
} elseif ($Linha["turma"] == "EJA II (NOTURNO)") {
    $eja = "X";
} elseif ($Linha["turma"] == "EJA III (NOTURNO)") {
    $eja = "X";
} elseif ($Linha["turma"] == "EJA IV (NOTURNO)") {
    $eja = "X";
} else {
    
}

if ($ano == "X") {
    $infantil = "1° Grau";
} elseif ($eja == "X") {
    $infantil = "1° Grau";
} else {
    $infantil = "Educação Infantil";
}
//Escolha do Tipo de Certidão
$certidao_nascimento = "";
$certidao_casamento = "";
$certidao_rg = "";
if ($Linha["tipos_de_certidao"] == "NASCIMENTO") {
    $certidao_nascimento = "X";
} elseif ($Linha["tipos_de_certidao"] == "CASAMENTO") {
    $certidao_casamento = "X";
} else {
    $certidao_rg = "X";
}

//Escolha do Sexo
$sexo = "";
if ($Linha["sexo"] == "M") {
    $sexo = "MASCULINO";
} else {
    $sexo = "FEMININO";
}
$nis = $Linha["nis"];
$sus = $Linha["sus"];

?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>REQUERIMENTO DE MATRICULA</title>        
        <link href="css/pesquisar_impressao.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <img src="img/timbre.jpg" alt=""/>
        <div class="caixaInicial">
            <h3>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</h3>
            <p style="margin-top: -16px; font-size: 10px;">Identificação Única INEP:26049716 CADASTRO ESCOLAR:M500028</p>
        </div>
        <h4 style= " text-align: center"> Requerimento de Matrícula</h4>
        <div class="caixa p">
            <p> Requeiro a matrícula no <?php echo $Linha["turma"]; ?>,do curso de <b><?php echo $infantil; ?></b>, declarando aceitar as disposições expressas no requerimento 
                e me responsabilizando pela autenticidade dos documentos entregues neste ato.</p>  
        </div>
        <h5 style= " text-align: center"> DADOS PESSOAIS DO ALUNO</h5>
        <div class="caixa">
            <div class="e1F"> <p>NIS:</p></div><div class="e2F border"><p>&nbsp;<?php echo $Linha["nis"]; ?></p></div>
            <div class="d1F"> <p>N° CAD SUS:</p></div><div class="d2F border"><p>&nbsp;<?php echo $Linha["sus"]; ?></p></div>
            <div class="e1F"> <p>NOME:</p></div><div class="e2F border border_total"><p>&nbsp;<?php echo $Linha["nome"]; ?></p></div>
            <div class="e1F"> <p>ENDEREÇO:</p></div><div class="e2F border" style=" min-width: 16.50cm"><p>&nbsp;<?php echo $Linha["endereco"]; ?></p></div>
            <div class="e1F"> <p>MUNICÍPIO:</p></div><div class="e2F border" style=" min-width: 9cm"><p>&nbsp;<?php echo $Linha["cidade"]; ?></p></div>
            <div class="e1F"> <p>ESTADO:</p></div><div class="e2F border" style=" min-width: 5.90cm"><p>&nbsp;<?php echo $Linha["estado_cidade"]; ?></p></div>
            <div class="e1F"> <p>DATA DE NASCIMENTO:</p></div><div class="e2F border" style=" min-width: 2.5cm"><p style=" text-align: center;">&nbsp;<?php echo "$dia" ?></p></div>
            <div class="e1F"> <p>DE</p></div><div class="e2F border" style=" min-width: 7.5cm"><p style=" text-align: center;">&nbsp;<?php echo "$mes" ?></p></div>
            <div class="e1F"> <p>DE</p></div><div class="e2F border" style=" min-width: 3.2cm"><p style=" text-align: center;">&nbsp;<?php echo "$ano_nascimento" ?></p></div>
            <!--CERTIDÃO CIVIL--->
            <div class="e1F" style=" min-width: 8cm;"> <p>CERTIDÃO CIVIL: ANTIGO(&nbsp;<?php echo "$modelo_velho"; ?>&nbsp;) NOVO(&nbsp;<?php echo "$modelo_novo"; ?>&nbsp;)</p></div><div class="e2F " style=" min-width: 10cm"><p>&nbsp;<?php echo "" ?></p></div>
            <div class="caixa" style=" <?php echo $displayV ?>  ">
                <div class="e1F" > <p>Nascimento (&nbsp;<?php echo "$certidao_nascimento"; ?>&nbsp;) Casamento (&nbsp;<?php echo "$certidao_casamento"; ?>&nbsp;)&nbsp;&nbsp;&nbsp;</p></div> <div class="e2F border" style=" min-width: 18.7cm"><p>&nbsp;<?php echo "$certidao_civil" ?></p></div>            
<!--                <div class="e1F" > <p>&nbsp;:&nbsp;</p></div><div class="e2F" style=" min-width: 3.5cm"><p>&nbsp;<?php echo "" ?></p></div>
                <div class="e1F" > <p>&nbsp;:&nbsp;</p></div><div class="e2F" style=" min-width: 3.5cm"><p>&nbsp;<?php echo "" ?></p></div>
-->
            </div>
            <div class="caixa" style="<?php echo $displayN ?>">
                <div class="e1F"> <p>MATRICULA:&nbsp;</p></div><div class="e2F border " style=" min-width: 16.25cm"><p>&nbsp;<?php echo "$matricula" ?></p></div>
            </div>
            <div class="e1F"> <p>DATA DE EXPEDIÇÃO:</p></div><div class="e2F border" style=" min-width: 14.8cm"><p>&nbsp;<?php echo "$expedicao"; ?></p></div>
            <!---->
            <div class="e1F"> <p>NOME DO PAI:</p></div><div class="e2F border" style=" min-width: 16cm"><p>&nbsp;<?php echo $Linha["pai"]; ?></p></div>
            <div class="e1F"> <p>PROFISSÃO:</p></div><div class="e2F border" style=" min-width: 16.5cm"><p>&nbsp;<?php echo $Linha["profissao_pai"]; ?></p></div>
            <!---->
            <div class="e1F"> <p>NOME DO MÃE:</p></div><div class="e2F border" style=" min-width: 15.8cm"><p>&nbsp;<?php echo $Linha["mae"]; ?></p></div>
            <div class="e1F"> <p>PROFISSÃO:</p></div><div class="e2F border" style=" min-width: 16.5cm"><p>&nbsp;<?php echo $Linha["profissao_mae"]; ?></p></div>
            <!---->
            <div class="e1F"> <p>NATURAL DE:</p></div><div class="e2F border" style=" min-width: 8.8cm"><p>&nbsp;<?php echo $Linha["naturalidade"]; ?></p></div>
            <div class="e1F"> <p>ESTADO:</p></div><div class="e2F border" style=" min-width: 5.90cm"><p>&nbsp;<?php echo $Linha["estado"]; ?></p></div>
            <!---->
            <div class="e1F"> <p>NACIONALIDADE:</p></div><div class="e2F border" style=" min-width: 15.50cm"><p>&nbsp;<?php echo $Linha["nacionalidade"]; ?></p></div>
            <!---->
            <div class="e1F"> <p>SEXO:</p></div><div class="e2F border"><p>&nbsp;<?php echo $sexo; ?></p></div>
            <div class="e1F"> <p>COR/RAÇA:</p></div><div class="e2F border" style="min-width: 7.5cm;"><p>&nbsp;<?php echo "$cor"; ?></p></div>
            <!---->
            <div class="e1F"> <p>NECESSIDADES EDUCACIONAIS ESPECIAIS:</p></div><div class="e2F border" style="min-width: 11cm;" ><p>&nbsp;<?php echo "$necessidades"; ?></p></div>
            <!---->
            <div class="e1F"> <p>DATA DE MATRÍCULA:</p></div><div class="e2F border" style="min-width: 14.9cm;"><p>&nbsp;<?php echo date_format($data_matricula, 'd/m/Y') ?></p></div>
            <!---->
            <div class="e2F border" style="min-width: 13cm; margin-left: 2.5cm; margin-top: 24px" ><p></p></div>
            <div class="e2F" style="min-width: 13cm; margin-left: 2.5cm; margin-top: -10px; text-align: center;" ><p></p>Assinatura do Responsável ou Aluno Maior</div>
            <!---->
            <div class="e2F border" style="min-width: 8cm; margin-left: 5cm; margin-top: 12px" ><p></p></div>
            <div class="e2F" style="min-width: 17cm; margin-left: 0.5cm; margin-top: -10px; text-align: center;" ><p>SECRETARIA</p></div>
            <!---->
            <div class="e1F"> <p>DESPACHO:</p></div><div class="e2F border" style="min-width: 4cm"><p></p></div>
            <div class="e1F"> <p>ALAGOINHA,</p></div><div class="e2F border" style=" min-width: 3cm"><p></p></div>
            <div class="e1F"> <p>DE</p></div><div class="e2F border" style=" min-width: 3cm"><p></p></div>
            <div class="e1F"> <p>DE</p></div><div class="e2F border" style=" min-width: 3cm"><p></p></div>
            <!---->
            <div class="e2F border" style="min-width: 15cm; margin-left: 2.5cm; margin-top: 12px" ><p></p></div>
            <div class="e2F" style="min-width: 15.5cm; margin-left: 2cm; margin-top: -10px; text-align: center;" ><p>DIRETOR(A)</p></div>
            <div class="rodape">
                
                <p>C.N.P.J.:11.043.981/0001-70</p>
                <p style="margin-top: -6px">End.:Praça Barão do Rio Branco,153,Centro - Alagoinha-PE, CEP.:55.2600.000, Tel.: 
                    (87)3839-1156 - email.:pma.pe@terra.com.br
            </div>
        </div>
    </body>
</html>
