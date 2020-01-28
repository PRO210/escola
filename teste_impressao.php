<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
//
$SQL_consulta_id = "SELECT * FROM `alunos` WHERE `id` = $Recebe_id";
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
$dia2 = date_format($nascimento, 'd');
//$mes = date('m');
$mes = date_format($nascimento, 'm');
//$ano = date('Y');
$ano_nascimento = date_format($nascimento, 'Y');
$semana = date('w');
$cidade = "Digite aqui sua cidade";
//
include_once 'funcao_data_atual.php';
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
$querySelecionaPorCodigo = "SELECT * FROM imagens";
$resultado = mysqli_query($Conexao, $querySelecionaPorCodigo);
$imagem = mysqli_fetch_object($resultado);
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{width: 18cm; height: 27cm; border:solid black thin; margin: 0 auto;}
            img{margin-left: 1.5cm;}
            .caixaInicial{
                width: 18cm; text-align: center;  margin-top: -5mm;
            }           
        </style>
        <link href="css/teste_impressao.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <img src="data:image/jpg;base64,<?php echo base64_encode($imagem->blob_imagem) ?>" />
        <div class="caixaInicial">          
            <h3 style="font-size: 22px;"><b><?php echo "$escola_nome" ?></b></h3>
            <p style="margin-top: -16px; font-size: 10px;">Identificação Única INEP:<?php echo "$inep" ?> CADASTRO ESCOLAR: <?php echo "$cadastro" ?></p>
        </div>
        <h4 style= "text-align: center"><b>Requerimento de Matrícula</b></h4>
        <div>
            <p style="font-size: 14px !important; text-indent: 2cm;text-align:justify;"> Requeiro a matrícula no <?php echo $nome_turma; ?>, série/ano/fase do curso de <?php echo $infantil; ?>, turno <?php echo $turno_turma ?>, declarando aceitar as disposições expressas no requerimento 
                e me responsabilizando pela autenticidade dos documentos entregues neste ato.</p>  
        </div>
        <h5 style= " text-align: center;margin-top: 0px;">DADOS PESSOAIS DO ALUNO</h5>
        <div id="linha_nis"><p id="nis">NIS :&nbsp;&nbsp;<?= $Linha["nis"] ?></p></div>
        <div id = "linha_nome"><p id="nome" ><b>NOME :&nbsp;<?= $Linha["nome"] ?></b></p></div>
        <div id = "linha_endereco"><p id="endereco" >ENDEREÇO :&nbsp;<?= $Linha["endereco"] ?></p></div>
        <div id="linha_cidade"><p id="cidade">CIDADE :&nbsp;<?= $Linha["cidade"] ?></p></div>
        <div id="linha_nascimento">
            <p id="dia">DATA NASACIMENTO :</p>
            <p id="dia_2"><?= $dia2 ?></p>          
        </div>
        <div id="linha_nascimento_2">           
            <p id="mes">DE</p>
            <p id="mes_2"><?= $mes2 ?></p>
        </div>
        <div id="linha_nascimento_3">           
            <p id="ano">DE</p>
            <p id="ano_2"><?= $ano_nascimento ?></p>
        </div>
         <div id="linha_certidao"><p id="certidao">CERTIDÃO CIVIL :</p></div>










    </body>
</html>
