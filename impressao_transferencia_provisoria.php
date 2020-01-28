<?php
include_once 'valida_cookies.inc';
//include_once'./matricular.php';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores da URL (Método GET)
$id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
$inputaprovacao = filter_input(INPUT_POST, 'inputaprovacao', FILTER_DEFAULT);
$turmaf = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
$transferencia = filter_input(INPUT_POST, 'inputTransferencia', FILTER_DEFAULT);
//echo "$turma";
//
$padding = "";
$display = "";
if ($transferencia == "NÃO") {
    $display = "none";
    $padding = "1.7cm;";
}
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
    $categoriaX = "";
    $categoriaXFase = "";
} elseif ($categoria_turma == "FASE") {
    $categoria = "1° Grau";
    $categoriaXFase = "X";
    $categoriaX = "";
} else {
    $categoria = "1° Grau";
    $categoriaX = "X";
    $categoriaXFase = "";
}
//
$aprovaçãoS = "";
$aprovaçãoN = "";
$aprovaçãoD = "";

if ($inputaprovacao == "SIM") {
    $aprovaçãoS = "X";
} elseif ($inputaprovacao == "NÃO") {
    $aprovaçãoN = "X";
} elseif ($inputaprovacao == "DESISTENTE") {
    $aprovaçãoD = "X";
} elseif ($inputaprovacao == "CURSANDO") {
    $aprovaçãoS = "X";
}
//
$SQL_consulta_id = "SELECT * FROM `alunos` WHERE `id` = $id";
$Consulta = mysqli_query($Conexao, $SQL_consulta_id);
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$nascimento = new DateTime($Linha["data_nascimento"]);

$status = "";
if ($Linha["status"] = '') {
    
}
//
$hoje = date('d/m/Y');
$hoje2 = new DateTime(date('Y/m/d'));
// leitura das datas automaticamente
$dia = date_format($hoje2, 'd');
//$mes = date('m');
$mes = date_format($hoje2, 'm');
$ano2 = date_format($hoje2, 'Y');
//$ano_nascimento = date_format($hoje, 'Y');
$semana = date('w');
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
$querySelecionaPorCodigo = "SELECT * FROM `imagens` ORDER BY `id`  DESC  LIMIT 1";
$resultado = mysqli_query($Conexao, $querySelecionaPorCodigo);
$imagem = mysqli_fetch_object($resultado);
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DECLARAÇÃO PROVISÓRIA DE TRANSFERÊNCIA</title>
        <link href="css/impressao_transferencia_provisoria.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="header">    
            <p>  
              <img src="data:image/jpg;base64,<?php echo base64_encode($imagem->blob_imagem) ?>" />
            </p>
            <h2 style="text-align: center"><?php echo "$escola_nome" ?></h2>
        </div>
        <div id="pos_header">        
            <h3>DECLARAÇÃO TRANSFERÊNCIA</h3>           
        </div>
        <div>
            <div id="declaracao">
                <p>
                    Declaro que <?php echo $Linha["nome"]; ?>, filho (a) de <?php echo $Linha["mae"]; ?> e <?php echo $Linha["pai"]; ?>, nascido(a) no dia <?php echo date_format($nascimento, 'd/m/Y'); ?>,
                    na cidade de <?php echo $Linha["naturalidade"]; ?>, Estado: <?php echo $Linha["estado"]; ?>.
                    Tem direito a matricular-se no <?php echo $turma; ?> do (  ) série ( <?php echo $categoriaX; ?> ) ano ( <?php echo $categoriaXFase; ?>  ) fase,
                    do curso de <b><?php echo $categoria; ?>.
                </p>
            </div>
            <div id="meio" >
                <p style="display:<?php echo $display; ?>">
                    Desde que obteve na série  anterior o seguinte resultado
                </p>            
            </div>
            <div id="meio_2">
                <p style="display:<?php echo $display; ?>">
                    ( <?php echo "$aprovaçãoS"; ?> )Aprovado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( <?php echo "$aprovaçãoN"; ?> )Reprovado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( <?php echo "$aprovaçãoD"; ?> )Desistente
                </p>                        
            </div>
            <div id="declaracao">
                <p style="display:<?php echo $display; ?> ">
                    O Diretor deste estabelecimento compromete-se a fornecer no prazo de 15 dias o Histórico Escolar do referido aluno, atendendo as exigências prescritas nos Artigos 23, 24 da Resolução 10/73 do Conselho Estadual de Pernambuco.
                </p>
            </div>  
            <br>          
            <h3 style="text-align: center; padding: <?php echo $padding; ?>">Alagoinha,&nbsp;<?php echo "$dia  de $mes  de $ano2"; ?>.</h3>
            <div id="meio">
                <p>___________________________________________________________</p>
            </div>          
            <div id="meio_3">
                <p>DIRETORA</p>
            </div>         
            <div class="footer" style="padding-top:<?php echo($padding) ?>">
                <div id="footer2"><p><?php echo "$escola_endereco" ?> <?php echo "$escola_cidade" ?> - <?php echo "$escola_estado" ?>, CEP:<?php echo "$cep" ?></p></div>
                <div id="footer2"><p>E-mail.:<?php echo "$email" ?></P></div>
            </div>
        </div>
    </body>
</html>
