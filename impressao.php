<?php
include_once 'valida_cookies.inc';
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
$expedicao = $Linha["data_expedicao"];
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
//Agora basta imprimir na tela...
//echo (" $dia de $mes de $ano");

$certidao_civil = $Linha["certidao_civil"];
if ($certidao_civil == "") {
    $certidao_civil = "Termo Nº _____________ Fls:_____________ Livros:_______________";
}
//Escolha do Grau
$ano = "";
$infantil = "";
$eja = "";
$turnoT = "";
$turmaf = $Linha["turma"];
//
$SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
$Consulta_turma = mysqli_query($Conexao, $SQL_turma);
$Linha_turma = mysqli_fetch_array($Consulta_turma);
//
$nome_turma = $Linha_turma["turma"];
$turno_turma = $Linha_turma["turno"];
$categoria_turma = $Linha_turma["categoria"];
$turma = "$nome_turma";
//
if ($categoria_turma == "EDUCAÇÃO INFANTIL") {
    $infantil = "Educação Infantil";
} else {
    $infantil = "1° Grau";
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
//
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
$inep = $Registro["inep"];
$escola_nome = $Registro["nome"];
$cadastro = $Registro["cadastro"];
$cnpj = $Registro["cnpj"];
$escola_endereco = $Registro["endereco"];
$escola_cidade = $Registro["cidade"];
$escola_estado = $Registro["estado"];
$cep = $Registro["cep"];
$email = $Registro["email"];
//
$Consulta_up2 = mysqli_query($Conexao, "SELECT  * FROM `tb_cidades` WHERE id = '$escola_cidade'");
$Registro_up2 = mysqli_fetch_array($Consulta_up2, MYSQLI_BOTH);
$escola_cidade = strtoupper($Registro_up2["nome"]);
//
$Consulta_up3 = mysqli_query($Conexao, "SELECT  * FROM `tb_estados` WHERE id = '$escola_estado' ");
$Registro_up3 = mysqli_fetch_array($Consulta_up3, MYSQLI_BOTH);
$escola_estado = strtoupper($Registro_up3["uf"]);
//
$querySelecionaPorCodigo = "SELECT * FROM `imagens` ORDER BY `id` DESC LIMIT 1";
$resultado = mysqli_query($Conexao, $querySelecionaPorCodigo);
$imagem = mysqli_fetch_object($resultado);
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>REQUERIMENTO DE MATRICULA</title>    
        <link href="css/pesquisar_impressao.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="div" style="position: fixed;left: 0px;top: 24px; ">            
            <div class="bt">
<!--                <a href="folha_re_matricula.php" class="btn btn-info" >Ré Matricula</a>
                <br>
                <br>-->
                <a href="impressao_fpdf.php?id=<?php echo $id?>" class="btn btn-primary" >Salvar o PDF</a>                
            </div>                
        </div>          
           <!--<img src="img/timbre.jpg" alt=""/>-->
        <img src="data:image/jpg;base64,<?php echo base64_encode($imagem->blob_imagem) ?>" />
        <!--<P style="text-align: center;margin-top: -42px;font-size: 24px;"><b>SECRETARIA MUNICIPAL DE EDUCAÇÃO</b></p>-->
        <div class="caixaInicial">          
            <h3><b><?php echo "$escola_nome" ?></b></h3>
            <p style="margin-top: -16px; font-size: 10px;">Identificação Única INEP:<?php echo "$inep" ?> CADASTRO ESCOLAR: <?php echo "$cadastro" ?></p>
        </div>
        <h4 style= " text-align: center"><b> Requerimento de Matrícula</b></h4>
        <div class="caixa p">
            <p style="font-size: 14px !important;"> Requeiro a matrícula no(a) <?php echo $nome_turma; ?>, série/ano/fase do curso de <b><?php echo $infantil; ?></b>, turno <?php echo $turno_turma ?>, declarando aceitar as disposições expressas no requerimento 
                e me responsabilizando pela autenticidade dos documentos entregues neste ato.</p>  
        </div>
        <h5 style= " text-align: center"> DADOS PESSOAIS DO ALUNO</h5>
        <div class="caixa">
            <div class="e1F"> <p>NIS:</p></div><div class="e2F border"><p>&nbsp;<?php echo $Linha["nis"]; ?></p></div>
            <div class="d1F"> <p>N° CAD SUS:</p></div><div class="d2F border" style="min-width: 8cm"><p>&nbsp;<?php echo $Linha["sus"]; ?></p></div>
            <div class="e1F"> <b><p>NOME:</p></b></div><div class="e2F border border_total"> <b><p>&nbsp;<?php echo $Linha["nome"]; ?></p></b></div>
            <div class="e1F"> <p>ENDEREÇO:</p></div><div class="e2F border" style=" min-width: 16.80cm"><p>&nbsp;<?php echo $Linha["endereco"]; ?></p></div>
            <div class="e1F"> <p>MUNICÍPIO:</p></div><div class="e2F border" style=" min-width: 9cm"><p>&nbsp;<?php echo $Linha["cidade"]; ?></p></div>
            <div class="e1F"> <p>ESTADO:</p></div><div class="e2F border" style=" min-width: 6.3cm"><p>&nbsp;<?php echo $Linha["estado_cidade"]; ?></p></div>
            <div class="e1F"> <p>DATA DE NASCIMENTO:</p></div><div class="e2F border" style=" min-width: 2.5cm"><p style=" text-align: center;">&nbsp;<?php echo "$dia" ?></p></div>
            <div class="e1F"> <p>DE</p></div><div class="e2F border" style=" min-width: 7.5cm"><p style=" text-align: center; ">&nbsp;<?php echo "$mes" ?></p></div>
            <div class="e1F"> <p>DE</p></div><div class="e2F border" style=" min-width: 3.9cm"><p style=" text-align: center;">&nbsp;<?php echo "$ano_nascimento" ?></p></div>
            <!--CERTIDÃO CIVIL--->   <!--CERTIDÃO CIVIL--->
            <div class="e1F" style=" min-width: 8cm;"> <p>CERTIDÃO CIVIL: </p></div><div class="e2F " style=" min-width: 10cm"><p>&nbsp;<?php echo "" ?></p></div>

            <div class="e1F" style=" min-width: 16cm;"> <p>NASCIMENTO (&nbsp;<?php echo "$certidao_nascimento"; ?>&nbsp;) CASAMENTO (&nbsp;<?php echo "$certidao_casamento"; ?>&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$certidao_civil" ?></p></div>
<!--            <div class="e2F " style=" min-width: 8cm"><p>&nbsp;<?php echo "" ?></p></div>-->

    <!--            <div class="caixa" style=" <?php echo $displayV ?>  ">
                    <div class="e1F" > <p></p></div> <div class="e2F border" style=" min-width: 18.7cm"><p>NASCIMENTO (&nbsp;<?php echo "$certidao_nascimento"; ?>&nbsp;) CASAMENTO (&nbsp;<?php echo "$certidao_casamento"; ?>&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$certidao_civil" ?></p></div>            
                </div>-->

            <div class="caixa" style="<?php echo $displayN ?>">
                <div class="e1F"> <p>MATRICULA:&nbsp;</p></div><div class="e2F border " style=" min-width: 16.25cm"><p>&nbsp;<?php echo "$matricula" ?></p></div>
            </div>
            <div class="e1F"> <p>DATA DE EXPEDIÇÃO:</p></div><div class="e2F border" style=" min-width: 14.8cm"><p>&nbsp;<?php echo "$expedicao"; ?></p></div>
            <!---->
            <div class="e1F"> <p>NOME DO PAI:</p></div><div class="e2F border" style=" min-width: 16cm"><p>&nbsp;<?php echo $Linha["pai"]; ?></p></div>
            <div class="e1F"> <p>PROFISSÃO:</p></div><div class="e2F border" style=" min-width: 16.5cm"><p>&nbsp;<?php echo $Linha["profissao_pai"]; ?></p></div>
            <!---->
            <div class="e1F"> <p>NOME DA MÃE:</p></div><div class="e2F border" style=" min-width: 15.8cm"><p>&nbsp;<?php echo $Linha["mae"]; ?></p></div>
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
            <div class="e1F"> <p>NECESSIDADES EDUCACIONAIS ESPECIAIS:</p></div><div class="e2F border" style="min-width: 11.7cm;" ><p>&nbsp;<?php echo "$necessidades"; ?></p></div>
            <!---->
            <div class="e1F"> <p>DATA DE MATRÍCULA:</p></div><div class="e2F border" style="min-width: 14.9cm;"><p>&nbsp;<?php echo date_format($data_matricula, 'd/m/Y') ?></p></div>
            <!---->
            <div class="e2F border" style="min-width: 13cm; margin-left: 2.5cm; margin-top: 12px" ><p></p></div>
            <div class="e2F" style="min-width: 13cm; margin-left: 2.5cm; margin-top: -10px; text-align: center;" ><p></p>Assinatura do Responsável ou Aluno Maior</div>
            <!---->
            <div class="e2F border" style="min-width: 8cm; margin-left: 5cm; margin-top: 12px" ><p></p></div>
            <div class="e2F" style="min-width: 17cm; margin-left: 0.5cm; margin-top: -10px; text-align: center;" ><p>SECRETARIA</p></div>
            <!---->
            <div class="e1F"> <p>DESPACHO:</p></div><div class="e2F border" style="min-width: 4cm;margin-left: 3mm"><p></p></div>
            <div class="e1F"> <p>ALAGOINHA,</p></div><div class="e2F border" style=" min-width: 3cm"><p></p></div>
            <div class="e1F"> <p>DE</p></div><div class="e2F border" style=" min-width: 3cm"><p></p></div>
            <div class="e1F"> <p>DE</p></div><div class="e2F border" style=" min-width: 3cm"><p></p></div>
            <!---->
            <div class="e2F border" style="min-width: 15cm; margin-left: 2.5cm; margin-top: 12px" ><p></p></div>
            <div class="e2F" style="min-width: 15.5cm; margin-left: 2cm; margin-top: -10px; text-align: center;" ><p>DIRETOR(A)</p></div>
<!--            <div class="e2F" style="min-width: 15.5cm; margin-left: 2cm; margin-top:12px; text-align: center;" ><p>RENOVAÇÃO DE MATRÍCULA</p></div>-->

            <div class="e2F" style="min-width: 15.5cm;" >
                <!-- <div class="rodape" style="min-width: 15.5cm";> -->
                <p style = "font-size:8px; margin-top: 0.5cm;">C.N.P.J.:<?php echo "$cnpj" ?></p>
                <p style="margin-top: -6px; font-size:8px ">End.: <?php echo "$escola_endereco" ?> - <?php echo "$escola_cidade" ?> - <?php echo "$escola_estado" ?>, CEP.:<?php echo "$cep" ?>, 
                    - email.:<?php echo "$email" ?></p>
            </div>
        </div>
    </body>
</html>
