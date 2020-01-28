<?php
ob_start();

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
    $certidao_civil = "Termo Nº __________ Fls:________ Livros:_________";
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
$querySelecionaPorCodigo = "SELECT * FROM imagens";
$resultado = mysqli_query($Conexao, $querySelecionaPorCodigo);
$imagem = mysqli_fetch_object($resultado);

require_once 'fpdf181/fpdf.php';
require_once 'rotation.php';

class PDF extends PDF_Rotate {

// Page header
    function Header() {
        // Logo
        $this->Image('img/timbre.jpg', 45, 5, 120, 35);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        // $this->Cell(30, 10, 'Title', 1, 0, 'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        // $this->SetFont('Arial', '', 8);
        // Page number
        //  $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function RotatedText($x, $y, $txt, $angle) {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

    function RotatedImage($file, $x, $y, $w, $h, $angle) {
        //Image rotated around its upper-left corner
        $this->Rotate($angle, $x, $y);
        $this->Image($file, $x, $y, $w, $h);
        $this->Rotate(0);
    }
}
// Instanciation of inherited class
$pdf = new PDF();
$pdf->SetLeftMargin(15);
$pdf->SetAutoPageBreak(false);
$pdf->AliasNbPages();
$pdf->AddPage();
//
$pdf->Cell(190, 5, "", '', 1, 'C');
//$pdf->Image("data:image/jpg;base64,base64_encode($imagem->blob_imagem)", 45, 5, 120, 35);
$pdf->Image('img/timbre.jpg', 45, 5, 120, 35);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 5, "", '', 1, 'C');
$pdf->Cell(190, 10, "$escola_nome", '', 1, 'C');
//
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 0, "Identificação Única INEP: $inep CADASTRO ESCOLAR: $cadastro", '', 1, 'C');
//
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 20, "Requerimento de Matrícula", '', 1, 'C');
//
$pdf->SetFont('Arial', '', 12);
$txt = "          Requeiro a matrícula no(a)  $nome_turma série/ano/fase do curso de  $infantil, turno $turno_turma, declarando aceitar as disposições expressas no requerimento e me responsabilizando pela autenticidade dos documentos entregues neste ato.";
$pdf->MultiCell(0, 7, $txt, '', 'J');
//
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 15, "Dados Pessoais do Aluno(a)", '', 1, 'C');
//
$pdf->SetFont('Arial', '', 12);
//NIS e SUS
$pdf->Cell(10, 7, 'Nis:', 0, 0, 'L');
$pdf->Cell(90, 7, "$nis", 0, 0, 'L');
$pdf->Line(25, 112, 110, 112);
$pdf->Cell(10, 7, 'Sus:', 0, 0, 'L');
$pdf->Cell(90, 7, "$sus", 0, 1, 'L');
$pdf->Line(125, 112, 195, 112);
//
//NOME
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(15, 7, 'Nome:', 0, 0, 'L');
$pdf->Cell(90, 7, $Linha['nome'], 0, 1, 'L');
$pdf->Line(30, 119, 195, 119);
//ENDEREÇO
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(22, 7, 'Endereço:', 0, 0, 'L');
$pdf->Cell(90, 7, $Linha['endereco'], 0, 1, 'L');
$pdf->Line(36, 126, 195, 126);
//MUNICÍPIO e ESTADO
$pdf->Cell(25, 7, 'MUNICÍPIO:', 0, 0, 'L');
$pdf->Cell(75, 7, $Linha["cidade"], 0, 0, 'L');
$pdf->Line(40, 132.5, 110, 132.5);
$pdf->Cell(20, 7, 'ESTADO:', 0, 0, 'L');
$pdf->Cell(60, 7, $Linha["estado_cidade"], 0, 1, 'L');
$pdf->Line(135, 132.5, 195, 132.5);
//DATA DE NASCIMENTO
$pdf->Cell(55, 7, 'DATA DE NASCIMENTO:', 0, 0, 'L');
$pdf->Cell(20, 7, "$dia" . "     DE", 0, 0, 'L');
$pdf->Line(66, 139.5, 80, 139.5);
//DATA DE NASCIMENTO MÊS
$pdf->Cell(30, 7, "$mes" . "    DE", 0, 0, 'L');
$pdf->Line(89, 139.5, 108, 139.5);
//DATA DE NASCIMENTO ANO
$pdf->Cell(4, 7, "", 0, 0, 'L');
$pdf->Cell(10, 7, " $ano_nascimento  .", 0, 1, 'L');
$pdf->Line(124, 139.5, 138, 139.5);
//CERTIDAO DE NASCIMENTO
$pdf->Cell(55, 7, 'CERTIDÃO CIVIL:', 0, 1, 'L');
$pdf->Cell(40, 7, "NASCIMENTO ( " . "$certidao_nascimento" . " )", 0, 0, 'L');
$pdf->Cell(35, 7, "CASAMENTO( " . " $certidao_casamento" . " )", 0, 0, 'L');
if ($Linha["certidao_civil"] !== "") {
    $pdf->Cell(27, 7, $certidao_civil, 0, 1, 'L');
} else {
    $pdf->Cell(45, 7, 'TERMO N°:', 0, 0, 'L');
    $pdf->Line(115, 153, 135, 153);
    $pdf->Cell(27, 7, 'LIVRO:', 0, 0, 'L');
    $pdf->Line(150, 153, 163, 153);
    $pdf->Cell(27, 7, 'FOLHA:', 0, 1, 'L');
    $pdf->Line(180, 153, 195, 153);
}
//DTA De EXPEDIÇAO
$pdf->Cell(47, 7, 'DATA DE EXPEDIÇÃO:', 0, 0, 'L');
$pdf->Cell(27, 7, $expedicao, 0, 1, 'L');
//NOME DO PAI
$pdf->Cell(32, 7, 'NOME DO PAI:', 0, 0, 'L');
$pdf->Cell(27, 7, $Linha["pai"], 0, 1, 'L');
$pdf->Line(48, 168, 195, 168);
$pdf->Cell(47, 7, 'PROFISSAO DO PAI:', 0, 0, 'L');
$pdf->Cell(27, 7, $Linha["profissao_pai"], 0, 1, 'L');
$pdf->Line(60, 175, 195, 175);
//NOME DA MÃE
$pdf->Cell(32, 7, 'NOME DA MÃE:', 0, 0, 'L');
$pdf->Cell(27, 7, $Linha["mae"], 0, 1, 'L');
$pdf->Line(48, 182, 195, 182);
$pdf->Cell(47, 7, 'PROFISSAO DA MÃE:', 0, 0, 'L');
$pdf->Cell(27, 7, $Linha["profissao_mae"], 0, 1, 'L');
$pdf->Line(60, 189, 195, 189);
//NATURAL  ESTADO
$pdf->Cell(30, 7, 'NATURAL DE:', 0, 0, 'L');
$pdf->Cell(75, 7, $Linha["naturalidade"], 0, 0, 'L');
$pdf->Line(45, 196, 110, 196);
$pdf->Cell(20, 7, 'ESTADO:', 0, 0, 'L');
$pdf->Cell(60, 7, $Linha["estado"], 0, 1, 'L');
$pdf->Line(140, 196, 195, 196);
//NACIONALIDADE
$pdf->Cell(38, 7, 'NACIONALIDADE:', 0, 0, 'L');
$pdf->Cell(90, 7, $Linha['nacionalidade'], 0, 1, 'L');
$pdf->Line(53, 203, 195, 203);
//SEXO E COR
$pdf->Cell(15, 7, 'SEXO:', 0, 0, 'L');
$pdf->Cell(90, 7, $sexo, 0, 0, 'L');
$pdf->Line(30, 210, 120, 210);
$pdf->Cell(25, 7, 'COR/RAÇA:', 0, 0, 'L');
$pdf->Cell(90, 7, $cor, 0, 1, 'L');
$pdf->Line(145, 210, 195, 210);
//NECESSIDADES EDUCACIONAIS ESPECIAIS
$pdf->Cell(94, 7, 'NECESSIDADES EDUCACIONAIS ESPECIAIS:', 0, 0, 'L');
$pdf->Cell(90, 7, $necessidades, 0, 1, 'L');
$pdf->Line(109, 217, 195, 217);
//DATA DE MATRICULA
$pdf->Cell(47, 7, 'DATA DE MATRICULA:', 0, 0, 'L');
$pdf->Cell(90, 7, date_format($data_matricula, 'd/m/Y'), 0, 1, 'L');
$pdf->Line(62, 224, 195, 224);
$pdf->Cell(47, 7, '', 0, 1, 'L');
//RESPONSAVEL
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(180, 7, 'Assinatura do Responsável', 0, 1, 'C');
$pdf->Line(35, 233, 165, 233);
//SECRETARIA
$pdf->Cell(180, 14, 'SECRETARIA', 0, 1, 'C');
$pdf->Line(35, 244, 165, 244);
//DESPACHO
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(55, 0, 'DESPACHO:', 0, 0, 'L');
$pdf->Line(42, 255, 70, 255);
$pdf->Cell(35, 0, 'ALAGOINHA,                             DE                    DE', 0, 1, 'L');
$pdf->Line(98, 255, 130, 255);
$pdf->Line(138, 255, 160, 255);
$pdf->Line(168, 255, 195, 255);
//DIRETORA
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(180, 10, '', 0, 1, 'C');
$pdf->Cell(180, 10, 'DIRETOR(A)', 0, 1, 'C');
$pdf->Line(35, 266, 165, 266);
//DIRETORA

$pdf->SetFont('Arial', '', 6);
$pdf->Cell(20, 6, '', 0, 1, 'L');
$pdf->Cell(20, 3, "CNPJ:" . " $cnpj", 0, 1, 'L');
$pdf->Cell(180, 3, "End.:" . "$escola_endereco - " . "$escola_cidade", 0, 1, 'L');

//for ($i = 1; $i <= 10; $i++)
//    $pdf->Cell(100, 10, 'Printing line number ' . $i, 0, 1);
$pdf->AddPage();
//$pdf->Image('img/timbre.jpg', 45, 5, 120, 35);
//
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(180, 25, 'RENOVAÇÃO DE MATRICULA', 0, 1, 'C');
$pdf->Cell(180, 220, '', 0, 1, 'C');
//
$pdf->Image('img/folha_re_matricula.jpeg', 10, 45, 190, 235);
//
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(20, 6, '', 0, 1, 'L');
$pdf->Cell(20, 3, "CNPJ:" . " $cnpj", 0, 1, 'L');
$pdf->Cell(180, 3, "End.:" . "$escola_endereco - " . "$escola_cidade", 0, 1, 'L');
//

$pdf->Output(utf8_decode($Linha["nome"]), 'I');








