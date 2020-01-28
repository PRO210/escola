<?php

ob_start();

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
$inep = $Registro["inep"];
$cadastro = $Registro["cadastro"];
$cnpj = $Registro["cnpj"];
$escola_endereco = $Registro["endereco"];
$escola_estado = $Registro["estado"];
$cep = $Registro["cep"];
$email = $Registro["email"];
//
$Consulta_up2 = mysqli_query($Conexao, "SELECT  * FROM `tb_cidades` WHERE id = " . $Registro["cidade"] . "");
$Registro_up2 = mysqli_fetch_array($Consulta_up2, MYSQLI_BOTH);
$escola_cidade = strtoupper($Registro_up2["nome"]);
//
//$_POST['inputTurma'] = 78;
$Consulta_turma = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` = " . $_POST['inputTurma'] . "");
$Linha_turma = mysqli_fetch_array($Consulta_turma);
$marcar = '';
$marcar2 = '';
if ($Linha_turma["categoria"] == "1 GRAU") {
    $marcar = "X";
} else {
    $marcar2 = "X";
}
$Desistente = "";
$Aprovado = "";
$Reprovado = "";
$aprovado = filter_input(INPUT_POST, 'inputaprovacao', FILTER_DEFAULT);

if ($aprovado == "DESISTENTE") {
    $Desistente = "X";
} elseif ($aprovado == "SIM") {
    $Aprovado = "X";
} elseif ($aprovado == "NÃO") {
    $Reprovado = "X";
}
$aprovado = filter_input(INPUT_POST, 'inputaprovacao', FILTER_DEFAULT);

//
require_once 'fpdf181/fpdf.php';
$pdf = new FPDF('P', 'mm', 'A4');
//$ids = array("256", "1406", "155");
foreach ($_POST['aluno_selecionado'] as $lista_id) {
    //
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = $lista_id");
    $Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
    //
    if ($Linha['pai'] == "") {
        $pai = "";
    } else {
        $pai = ' e ' . $Linha['pai'];
    }
    $nascimento = date_format(new DateTime($Linha['data_nascimento']), 'd/m/Y');

    $texto = "          Declaro que " . $Linha['nome'] . ", filho (a) de " . $Linha['mae'] . " $pai, nascido(a) no dia $nascimento, na cidade de " . $Linha['naturalidade'] . ", Estado: " . $Linha['estado'] . ". "
            . "Tem direito a matricular-se no " . $Linha_turma['turma'] . " do ( ) série ( $marcar ) ano ( $marcar2) fase, do curso de 1° Grau. ";

// Instanciation of inherited class    
    $pdf->SetAutoPageBreak(true);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Image('img/timbre.jpg', 45, 5, 120, 35);
    $pdf->SetFont('Arial', '', 16);
    $pdf->Cell(190, 22, "", '', 1, 'C');
    $pdf->Cell(190, 5, 'Secretaria Municipal de Educação', '', 1, 'C');
    $pdf->SetFont('Arial', '', 18);
    $pdf->Cell(190, 24, $Registro["nome"], '', 1, 'C');
    $pdf->SetFont('Arial', '', 16);
    $pdf->Cell(190, 12, 'DECLARAÇÃO TRANSFERÊNCIA', '', 1, 'C');
    $pdf->Cell(190, 12, '', '', 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(190, 12, '', '', 1, 'C');
    $pdf->MultiCell(0, 10, $texto);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(190, 12, 'Desde que obteve na série anterior o seguinte resultado', 0, 1, 'C');
    $pdf->Cell(190, 24, '( ' . $Aprovado . ' ) Aprovado             ( ' . $Reprovado . ' )Reprovado              ( ' . $Desistente . ' )Desistente        ', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $texto2 = "             O Diretor deste estabelecimento compromete-se a fornecer no prazo de 15 dias o Histórico Escolar do referido aluno, atendendo as exigências prescritas nos Artigos 23, 24 da Resolução 10/73 do Conselho Estadual de Pernambuco. ";
    $pdf->MultiCell(0, 8, $texto2);
    include_once 'funcao_data_atual.php';
    $pdf->Cell(190, 24, $escola_cidade . ", " . $dmy, 0, 1, 'C');
    $pdf->Cell(190, 36, 'DIRETORA', 0, 1, 'C');
    $pdf->Line(35, 235, 165, 235);
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(180, 24, '', 0, 1, 'C');
    $pdf->Cell(180, 3, "CNPJ:" . " $cnpj", 0, 1, 'C');
    $pdf->Cell(180, 3, "End.:" . "$escola_endereco - " . "$escola_cidade", 0, 1, 'C');
}
$pdf->Output(utf8_decode('Servidor'), 'I');
