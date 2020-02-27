<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id_solicitacao = filter_input(INPUT_POST, 'id_solicitacao', FILTER_DEFAULT);
$inputConcluiu = filter_input(INPUT_POST, 'inputConcluiu', FILTER_DEFAULT);
//

$inputbs1 = filter_input(INPUT_POST, 't1', FILTER_DEFAULT);
$inputbs2 = filter_input(INPUT_POST, 't2', FILTER_DEFAULT);
$inputbs3 = filter_input(INPUT_POST, 't3', FILTER_DEFAULT);
$inputbs4 = filter_input(INPUT_POST, 't4', FILTER_DEFAULT);
$inputbs5 = filter_input(INPUT_POST, 't5', FILTER_DEFAULT);
$inputbs6 = filter_input(INPUT_POST, 't6', FILTER_DEFAULT);
$inputbs7 = filter_input(INPUT_POST, 't7', FILTER_DEFAULT);
//
$religiao = filter_input(INPUT_POST, 'religiao', FILTER_DEFAULT);
if ($religiao == "SIM") {
    $Xreligiao = 155;
    $Yreligiao = 194;
    $Mreligiao = "X";
} elseif ($religiao == "NAO") {
    $Xreligiao = 175;
    $Yreligiao = 194;
    $Mreligiao = "X";
} else {
    $Xreligiao = 155;
    $Yreligiao = 194;
    $Mreligiao = "";
}
$fisica = filter_input(INPUT_POST, 'fisica', FILTER_DEFAULT);
if ($fisica == "SIM") {
    $Xfisica = 155;
    $Yfisica = 208;
    $Mfisica = "X";
} elseif ($fisica == "NAO") {
    $Xfisica = 175;
    $Yfisica = 208;
    $Mfisica = "X";
} else {
    $Xfisica = 175;
    $Yfisica = 208;
    $Mfisica = "";
}

//
$sql = "UPDATE `alunos_solicitacoes` SET `t1` = '$inputbs1', `t2` = '$inputbs2', `t3` = '$inputbs3', `t4` = '$inputbs4',`t5` = '$inputbs5',`t6` = '$inputbs6', `t7` = '$inputbs7'  WHERE `id_solicitacao`IN ($id_solicitacao)";
$Consulta_sql = mysqli_query($Conexao, $sql);
//
require_once 'fpdf181/fpdf.php';
require_once 'rotation.php';

//
class PDF extends PDF_Rotate {

//
// Page footer
    function Footer() {
// Position at 1.5 cm from bottom
        $this->SetY(-14);
// Arial italic 8
        $this->SetFont('Arial', 'B', 7);
// Page number
//        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 5, $this->PageNo(), 0, 0, 'C');
    }

    //
    function RotatedText($x, $y, $txt, $angle) {
        $txt = utf8_decode($txt);
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

}

// Instanciation of inherited class
$pdf = new PDF();
//
$Consultaf = mysqli_query($Conexao, "SELECT alunos.id,alunos_solicitacoes.* FROM `alunos`,`alunos_solicitacoes` WHERE `id_solicitacao`IN($id_solicitacao) AND id_aluno_solicitacao = alunos.id");
//$rowf = mysqli_fetch_array($Consultaf);
while ($rowf = mysqli_fetch_array($Consultaf)) {


    $id_aluno = $rowf['id_aluno_solicitacao'];
    $t1 = $rowf['t1'];
    $t2 = $rowf['t2'];
    $t3 = $rowf['t3'];
    $t4 = $rowf['t4'];
    $t5 = $rowf['t5'];
    $t6 = $rowf['t6'];
    $t7 = $rowf['t7'];
//
    $ano = "";
    $ano_fase = "";
    $ano_fase_xs = "";
    $ano_fase_xn = "";
    $ano_edui = "";
//
    $Consulta3 = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE id = '$inputConcluiu'");
    $Linha = mysqli_fetch_array($Consulta3, MYSQLI_BOTH);
//
    if ($Linha['categoria'] == "EDUCAÇÃO INFANTIL") {
        $ano_edui = "PRE ESCOLAR II ";
//
    } elseif ($Linha['categoria'] == "FASE") {
        $ano_fase = $Linha['turma'];
        $ano_fase_xs = "X";
//
    } elseif ($Linha['categoria'] == "1 GRAU") {
//    $ano = substr($inputConcluiu, 0, -1);
        $ano = $Linha['turma'];
        $ano_fase_xn = "X";
//
    } else {
        $ano_letivo_turma = substr($Linha['ano'], 0, -6);
//
        if ($ano_letivo_turma == "2018") {
            $ano = substr($Linha['turma'], 0, -1);
            $ano_fase_xn = "checked";
        } else {
            $ano = $Linha['turma'];
            $ano_fase_xn = "checked";
        }
    }
//
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$id_aluno' ");
    $Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
    $nome = $Linha['nome'];
    $data_nascimento = new DateTime($Linha["data_nascimento"]);
    $data_nascimento = date_format($data_nascimento, 'd-m-Y');
    $naturalidade = $Linha['naturalidade'];
    $estado = $Linha['estado'];
    $nacionalidade = $Linha['nacionalidade'];
//
    $pai = $Linha['pai'];
    if ($pai == "") {
        $pai_e = " ";
    } else {
        $pai_e = " e ";
    }
    $mae = $Linha['mae'];
    $turma = $Linha['turma'];
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
    $ato = $Registro["ato"];
    $do = $Registro["do"];
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
//
    $pdf->SetAutoPageBreak(true);
    $pdf->AliasNbPages();
    $pdf->AddPage();
//
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(190, 10, "$escola_nome", 0, 1, 'C');
    $pdf->SetLeftMargin(15);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(190, 11, " Nome do Estabelecimento de Ensino", 0, 1, 'C');
    $pdf->Cell(85, 11, " $escola_endereco", 1, 0, 'L');
    $pdf->Cell(10, 11, "", 0, 0, 'L');
    $pdf->Cell(85, 11, " Cidade: $escola_cidade  UF: $escola_estado", 1, 1, 'L');
//
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(180, 5, "", 0, 1, 'C');
    $pdf->Cell(70, 10, " Ato de Funcionamento: $ato", 1, 0, 'L');
    $pdf->Cell(5, 10, "", 0, 0, 'L');
    $pdf->Cell(30, 10, " D.O de: $do", 1, 0, 'L');
    $pdf->Cell(5, 10, "", 0, 0, 'L');
    $pdf->Cell(70, 10, " Cadastro Escolar: $cadastro", 1, 1, 'L');
//
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(10, 12, "", 0, 0, 'L');
    $pdf->Cell(175, 13, "CERTIFICADO E HISTÓRICO ESCOLAR DO ENSINO FUNDAMENTAL", 0, 1, 'L');
//
    $pdf->SetFont('Arial', '', 11);
    $pdf->Rect(15, 67, 180, 60);
    $pdf->Cell(175, 1, " ", 0, 1, 'L');
    $pdf->Cell(175, 9.1, " Pelo presente Hitórico certifico que, $nome", 0, 1, 'L');
    $pdf->Line(80, 78, 190, 78);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(20, 9.1, " Filho(a) de:  ", 0, 0, 'L');
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(130, 9.1, "  $mae $pai_e $pai", 0, 1, 'L');
    $pdf->SetFont('Arial', '', 11);

    $pdf->Line(35, 87, 190, 87);
    $pdf->Cell(175, 9.1, " Nascido em  $data_nascimento     Cidade: $naturalidade     UF: $estado", 0, 1, 'L');
    $pdf->Cell(175, 9.1, " Nacionalidade: $nacionalidade      RG:__________________ Órgao Expeditor:___________________", 0, 1, 'L');
    $pdf->SetFont('Arial', '', 9.5);
    $pdf->Cell(175, 9.1, " Concluíu o: $ano_edui $ano $ano_fase série/ano/fase, ou ciclo do Ensino Fundamental, nos termos da Lei Federal 9.394/96,", 0, 1, 'L');
    $pdf->Cell(1.5, 9.1, "", 0, 0, 'L');
    $pdf->Cell(175, 9.1, "modificada pela Lei Federal n° 11.274/2006 DOU de 06/02/2006.", 0, 1, 'L');

    $pdf->Cell(180, 3, "", 0, 1, 'L');
//
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(180, 10, "INFORMAÇÕES COMPLEMENTARES", 0, 1, 'C');
    $pdf->Rect(15, 137, 180, 85);
    $pdf->SetFont('Arial', '', 11);

    $pdf->Cell(178, 3, " ", 0, 1, 'L');
    $pdf->Cell(1.5, 9.1, "", 0, 0, 'L');
    $pdf->Cell(178, 1, "Forma de Acesso: ", 0, 1, 'L');
    $pdf->Cell(15, 3.5, "", 0, 1, 'C');
    $pdf->Cell(15, 3.5, "", 0, 0, 'C');
    $pdf->Cell(80, 7.2, "CLASSIFICAÇÃO: ________________ ", 0, 0, 'L');
    $pdf->Cell(165, 7.2, "RECLASSIFICAÇÃO: ________________ ", 0, 1, 'L');
//
    $pdf->Cell(60, 7.2, "SÉRIE ", 0, 0, 'R');
    $pdf->Rect(75, 154, 5, 5);
    $pdf->Cell(60, 7.2, "ANO ", 0, 0, 'C');
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->RotatedText(111, 158, "$ano_fase_xn", 0);

    $pdf->SetFont('Arial', '', 11);
    $pdf->Rect(110, 154, 5, 5);
    $pdf->Cell(60, 7.2, "FASE", 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->RotatedText(150, 158, "$ano_fase_xs", 0);
    $pdf->Rect(149, 154, 5, 5);
//
    $pdf->SetFont('Arial', '', 11);
    $pdf->SetFont('Arial', '', 8.5);
    $pdf->Cell(10, 7.2, "1", 0, 0, 'C');
    $pdf->Cell(170, 7.2, "O mínimo exigido para promoção é:6,0 e 75% de frequência do total de horas letivas.", 0, 1, 'L');
//
    $pdf->Cell(10, 7.2, "2", 0, 0, 'C');
    $pdf->Cell(170, 7.2, "Em caso de Progressão Parcial informamos que o(a) aluno(a) nas(s) _______________ série(s) obteve Progressão Parcial", 0, 1, 'L');
    $pdf->Cell(10, 7.2, "", 0, 0, 'C');
    $pdf->Cell(170, 7.2, "na(s) disciplina(s)___________________________________________________________________________ de acordo", 0, 1, 'L');
    $pdf->Cell(10, 7.2, "", 0, 0, 'C');
    $pdf->Cell(170, 7.2, "com o Regimento desta Escola que Admiti o remige de Progress]ao Parcial em até 02 disciplinas por série.", 0, 1, 'L');
//
    $pdf->Cell(10, 7.2, "3", 0, 0, 'C');
    $pdf->Cell(120, 7.2, "Participante em Seminários de Ensino Religioso:", 0, 0, 'L');
    $pdf->Cell(20, 7.2, "SIM", 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->RotatedText($Xreligiao, $Yreligiao, $Mreligiao, 0);
    $pdf->Rect(154, 190, 5, 5);
    //
    $pdf->SetFont('Arial', '', 8.5);
    $pdf->Cell(30, 7.2, "NÃO", 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Rect(174, 190, 5, 5);
    $pdf->SetFont('Arial', '', 8.5);
    $pdf->Cell(10, 7.2, "", 0, 0, 'C');
    $pdf->Cell(120, 7.2, "Base Legal:Art.33 da Lei 9.394/96 modificado pela Lei 9.475 de 22/07/1996 DOU.", 0, 1, 'L');
//
    $pdf->Cell(10, 7.2, "4", 0, 0, 'C');
    $pdf->Cell(120, 7.2, "Dispensa de Educação Física:", 0, 0, 'L');
    $pdf->Cell(20, 7.2, "SIM", 0, 0, 'L');

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->RotatedText($Xfisica, $Yfisica, $Mfisica, 0);
    $pdf->Rect(154, 204, 5, 5);
    $pdf->SetFont('Arial', '', 8.5);
    $pdf->Cell(30, 7.2, "NÃO", 0, 1, 'L');
    $pdf->Rect(174, 204, 5, 5);
    $pdf->Cell(10, 7.2, "", 0, 0, 'C');
    $pdf->Cell(120, 7.2, "Base Legal:Lei 10.793 de 01/12/2003 DOU.", 0, 1, 'L');
//
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(180, 3, "", 0, 1, 'L');
    $pdf->Cell(180, 12, "OBSERVAÇÕES", 0, 1, 'C');
    $pdf->SetFont('Arial', '', 8.4);
//
    $pdf->Rect(15, 232, 180, 55);
    $pdf->Cell(5, 1, "", 0, 1, 'L');
    $pdf->Cell(4, 3, "", 0, 0, 'L');
    $pdf->Cell(150, 7.2, "$t1", 0, 1, 'L');
    $pdf->Line(20, 240, 190, 240);
    $pdf->Cell(4, 3, "", 0, 0, 'L');
    $pdf->Cell(150, 7.2, "$t2", 0, 1, 'L');
    $pdf->Line(20, 246.5, 190, 246.5);
    $pdf->Cell(4, 3, "", 0, 0, 'L');
    $pdf->Cell(150, 7.2, "$t3", 0, 1, 'L');
    $pdf->Line(20, 254.5, 190, 254.5);
    $pdf->Cell(4, 3, "", 0, 0, 'L');
    $pdf->Cell(150, 7.2, "$t4", 0, 1, 'L');
    $pdf->Line(20, 262, 190, 262);
    $pdf->Cell(4, 3, "", 0, 0, 'L');
    $pdf->Cell(150, 7.2, "$t5", 0, 1, 'L');
    $pdf->Line(20, 269, 190, 269);
    $pdf->Cell(4, 3, "", 0, 0, 'L');
    $pdf->Cell(150, 7.2, "$t6", 0, 1, 'L');
    $pdf->Line(20, 276, 190, 276);
    $pdf->Cell(4, 3, "", 0, 0, 'L');
    $pdf->Cell(150, 7.2, "$t7", 0, 1, 'L');
    $pdf->Line(20, 283, 190, 283);
}

$pdf->Output(utf8_decode($nome . ".pdf"), 'D');
//$pdf->Output(utf8_decode($nome . ".pdf"), 'I');



