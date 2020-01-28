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
//Turma
$turmaf = $Linha['turma'];
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
    $categoria = "Educação Infantil";
} else {
    $categoria = "1° Grau";
}
// leitura das datas automaticamente
include_once 'funcao_data_atual.php';
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
        <title>DECLARAÇÃO BOLSA FAMÍLIA</title>
        <link href="css/declaracoes_bolsa_familia.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
       <!--// <img src="img/timbre.jpg" alt=""/>-->
        <img src="data:image/jpg;base64,<?php echo base64_encode($imagem->blob_imagem) ?>" style="margin-top: 0cm"/>
        <div class="caixaInicial">
            <h2><?php echo "$escola_nome" ?></h2>
            <p style="margin-top: -16px; font-size: 10px;">Identificação Única INEP:<?php echo "$inep" ?> CADASTRO ESCOLAR: <?php echo "$cadastro" ?></p>
        </div>
        <h3 style= " text-align: center; padding: 1cm;"> DECLARAÇÃO DE FREQUÊNCIA ESCOLAR</h3>
        <div class="caixa p1">
            <p>
                Declaro para os devidos fins de direito que o aluno(a) <?php echo"$nome"; ?>, nascido(a) em &nbsp;&nbsp;<?php echo $nascimento ?>
                na cidade de &nbsp;&nbsp;<?php echo"$naturalidade"; ?>, filho(a) de &nbsp;&nbsp;<?php echo"$mae"; ?><?php echo"$pai_e  $pai"; ?>
                residente em Alagoinha, Estado de Pernambuco, encontra-se matriculado(a) na Escola Municipal Tabeliao Raul Galindo Sobrinho - Alagoinha/PE, e 
                frequenta regularmente as aulas , cursando o  <?php echo"$nome_turma" ?> &nbsp;do&nbsp; <?php echo"$categoria" ?>
            </p>
        </div>
        <div class="caixa_2">
            <p> Alagoinha, <?php echo "$dmy"; ?></p>
        </div>
        <div class="caixa_3">
            <p>____________________________________________</p>
            <p>RESPONSÁVEL PELA INFORMAÇÃO</p>
        </div>
        <div class="rodape">
            <p>C.N.P.J.:<?php echo "$cnpj" ?></p>
            <p style="margin-top: -6px">End.:<?php echo "$escola_endereco" ?>, - <?php echo "$escola_cidade" ?> -<?php echo "$escola_estado" ?>, CEP.:<?php echo "$cep" ?>, 
                - email.:<?php echo "$email" ?>
        </div>
    </body>
</html>
