<?php

ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$ano = date('Y');
//
require_once 'fpdf181/fpdf.php';
require_once 'rotation.php';

class PDF extends PDF_Rotate {

    // Page header
    function Header() {
        // Logo
        $this->Image('img/timbre.jpg', 90, 5, 120, 35);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(110, 20, '', 0, 1);
        $this->Cell(110);
        // Title
        $this->Cell(60, 10, 'SECRETARIA MUNICIPAL DE EDUCAÇÃO', 0, 1, 'C');
        // Line break
        $this->Ln(0);
    }

    // Page footer
    function Footer() {
        //
        include 'valida_cookies.inc';
        include './inc.conf.php';
        $Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
        mysqli_set_charset($Conexao, "utf8");
        //Traz os Dados da Escola
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
        // Position at 1.5 cm from bottom
        $this->SetY(-18);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 8);
        // Page number
//        $pagina = $this->PageNo();
        //
        $this->Cell(0, 3, "$escola_endereco " . ' CNPJ:' . " $cnpj ", 0, 1, 'C');
        $this->Cell(0, 3, 'CNPJ:' . " $cnpj", 0, 1, 'C');
        $this->Cell(0, 3, 'Email:' . " $email", 0, 1, 'C');
//        $this->Rect(10, 187, 277, 15);
    }

    //
    function RotatedText($x, $y, $txt, $angle) {
        $txt = utf8_decode($txt);
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

    //
}

// Instanciation of inherited class
//$pdf = new PDF('P', 'mm', 'A4');
$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetLeftMargin(10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 9);
// 
$pdf->Cell(270, 1, '', 0, 1);
$pdf->RotatedText(130, 43, ' Informativo Gerencial ' . $ano, 0);

$pdf->Cell(270, 4, '', 0, 1);
$pdf->Cell(60, 35, "", 1, 0, 'C');
$pdf->RotatedText(36, 63, 'NOME', 0);

$pdf->Cell(20, 35, "", 1, 0, 'C');
$pdf->RotatedText(75, 63, 'CPF', 0);

$pdf->Cell(18, 35, "", 1, 0, 'C');
$pdf->RotatedText(96, 63, 'RG', 0);

$pdf->Cell(10, 35, "", 1, 0, 'C');
$pdf->RotatedText(115, 76, 'Órgão Expedidor', 90);

$pdf->Cell(10, 35, "", 1, 0, 'C');
$pdf->RotatedText(125, 76, 'Matricula', 90);

$pdf->Cell(40, 35, "", 1, 0, 'C');
$pdf->RotatedText(141, 63, 'EMAIL', 0);

$pdf->Cell(20, 35, "", 1, 0, 'C');
$pdf->RotatedText(171, 63, 'Função', 0);

$pdf->Cell(14, 35, "", 1, 0, 'C');
$pdf->RotatedText(197, 76, 'Turma', 90);

$pdf->Cell(14, 35, "", 1, 0, 'C');
$pdf->RotatedText(208, 76, 'Ano de Estudo', 90);

$pdf->Cell(22, 35, "", 1, 0, 'C');
$pdf->RotatedText(223, 76, 'Disciplina', 90);

$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(8, 35, "", 1, 0, 'C');
$pdf->RotatedText(239, 50, 'C/H', 0);
$pdf->RotatedText(242, 76, 'TOTAL', 90);

$pdf->Cell(15, 35, "", 1, 0, 'C');
$pdf->RotatedText(248, 50, 'Turno', 0);
$pdf->RotatedText(249, 76, 'M', 90);
$pdf->RotatedText(254, 76, 'T', 90);
$pdf->RotatedText(259, 76, 'N', 90);

$pdf->Cell(8, 35, "", 1, 0, 'C');
$pdf->RotatedText(266, 76, 'Efetivo', 90);
//
$pdf->Cell(8, 35, "", 1, 0, 'C');
$pdf->RotatedText(274, 76, 'Contratado', 90);
//
$pdf->Cell(8, 35, "", 1, 0, 'C');
$pdf->RotatedText(281, 76, 'Amigos da Escola', 90);

//Escreve M T N pois eles são segunda linha 
$pdf->Cell(10, 7, "", 0, 1, 'C');
$pdf->Cell(228, 10, "", 0, 0, 'C');
$pdf->Cell(8, 28, "", 1, 0, 'C');
$pdf->Cell(5, 28, "", 1, 0, 'C');
$pdf->Cell(5, 28, "", 1, 0, 'C');
$pdf->Cell(5, 28, "", 1, 1, 'C');
//Pula a linha para a tabela iniciar
$pdf->Cell(10, 0, "", 0, 1, 'C');

$pdf->SetFont('Arial', '', 7.5);
//Toma conta das contagem antecipadas dos servidores não  professores,motoristas e prestadores
$qtd = 0;
foreach ($_POST['servidor_selecionado'] as $id) {
    $SQL_Consulta = "SELECT * FROM `servidores` WHERE `id` = '$id' AND `funcao` NOT LIKE '%professor(a)%' AND `funcao` NOT LIKE '%MOTORISTA%' AND `vinculo` NOT LIKE '%PRESTADOR DE SERVIÇOS%' AND excluido = 'N'  ORDER BY nome ASC ";
    $Consulta = mysqli_query($Conexao, $SQL_Consulta);
    $Linha = mysqli_num_rows($Consulta);
    if ($Linha > 0) {
        $qtd++;
    }
}
//Toma conta das contagem antecipadas dos servidores não  professores,motoristas e prestadores
$qtd2 = 0;
//Selecionar todos os itens da tabela   
foreach ($_POST['servidor_selecionado'] as $id) {
    $pagina = $pdf->PageNo();
    //
    $SQL_Consulta = "SELECT * FROM `servidores` WHERE id = '$id' AND `funcao` NOT LIKE '%professor(a)%' AND `funcao` NOT LIKE '%MOTORISTA%' AND `vinculo` NOT LIKE '%PRESTADOR DE SERVIÇOS%' AND `excluido` = 'N' ";
    $Consulta = mysqli_query($Conexao, $SQL_Consulta);
    //     
    while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
        //
        $qtd2++;
        $m = "";
        $t = "";
        $n = "";
        $e = "";
        $c = "";
        $ae = "";
        //
        if ($row_Consulta["turno"] == "MATUTINO") {
            $m = "X";
        } elseif ($row_Consulta["turno"] == "VESPERTINO") {
            $t = "X";
        } elseif ($row_Consulta["turno"] == "NOTURNO") {
            $n = "X";
        } elseif ($row_Consulta["turno"] == "MATUTINO/VESPERTINO") {
            $m = "X";
            $t = "X";
        } elseif ($row_Consulta["turno"] == "MATUTINO/NOTURNO") {
            $m = "X";
            $n = "X";
        } elseif ($row_Consulta["turno"] == "MATUTINO/VESPERTINO/NOTURNO") {
            $m = "X";
            $t = "X";
            $n = "X";
        } elseif ($row_Consulta["turno"] == "VESPERTINO/NOTURNO") {
            $t = "X";
            $n = "X";
        }
        //
        if ($row_Consulta["vinculo"] == "EFETIVO(A)") {
            $e = "X";
        } elseif ($row_Consulta["vinculo"] == "CONTRATADO(A)") {
            $c = "X";
        } elseif ($row_Consulta["vinculo"] == "AMIGOS DA ESCOLA") {
            $ae = "X";
        }
        //
        $result = strlen('' . $row_Consulta["nome"] . '');
        if ($result > 31) {
            $pdf->SetFont('Arial', '', 6.5);
            $pdf->Cell(60, 5.5, $row_Consulta["nome"], 1, 0, 'L');
        } else {
            $pdf->SetFont('Arial', '', 7.5);
            $pdf->Cell(60, 5.5, $row_Consulta["nome"], 1, 0, 'L');
        }
        $pdf->Cell(20, 5.5, $row_Consulta["cpf"], 1, 0, 'C');
        $pdf->Cell(18, 5.5, $row_Consulta["dados_certidao"], 1, 0, 'C');
        $pdf->Cell(10, 5.5, $row_Consulta["orgao_expedidor"], 1, 0, 'C');
        $pdf->Cell(10, 5.5, $row_Consulta["matricula"], 1, 0, 'C');
        $pdf->Cell(40, 5.5, $row_Consulta["email"], 1, 0, 'C');
        $pdf->Cell(20, 5.5, $row_Consulta["resumo_funcao"] . '' . $row_Consulta["resumo_funcao_2"], 1, 0, 'C');
        $pdf->Cell(14, 5.5, '', 1, 0, 'L');
        $pdf->Cell(14, 5.5, '', 1, 0, 'L');
        $pdf->Cell(22, 5.5, '', 1, 0, 'L');
        $pdf->Cell(8, 5.5, $row_Consulta["carga_horaria"], 1, 0, 'L');
        $pdf->Cell(5, 5.5, $m, 1, 0, 'C');
        $pdf->Cell(5, 5.5, $t, 1, 0, 'C');
        $pdf->Cell(5, 5.5, $n, 1, 0, 'C');
        $pdf->Cell(8, 5.5, $e, 1, 0, 'C');
        $pdf->Cell(8, 5.5, $c, 1, 0, 'C');
        $pdf->Cell(8, 5.5, $ae, 1, 1, 'C');
        //
    }
}
//
$cont = 0;
foreach ($_POST['servidor_selecionado'] as $id) {
    $SQL_Consulta22 = "SELECT servidores.*,turmas_professor2.id_turma,turmas_professor2.id_professor,turmas.* FROM `servidores`,`turmas_professor2`,`turmas` WHERE `funcao` LIKE '%professor(a)%' AND servidores.id = turmas_professor2.id_professor AND servidores.id = '$id' AND turmas.id = turmas_professor2.id_turma AND servidores.excluido = 'N' AND turmas.ano LIKE '%$ano%' GROUP BY servidores.id ORDER BY nome ASC";
    $Consulta22 = mysqli_query($Conexao, $SQL_Consulta22);
    $LinTotal = mysqli_num_rows($Consulta22);
    if ($LinTotal > 0) {
        $cont++;
    }
}
//
$cont2 = 0;
foreach ($_POST['servidor_selecionado'] as $id) {
    $SQL_Consulta2 = "SELECT servidores.*,turmas_professor2.id_turma,turmas_professor2.id_professor,turmas.* FROM `servidores`,`turmas_professor2`,`turmas` WHERE `funcao` LIKE '%professor(a)%' AND servidores.id = turmas_professor2.id_professor AND servidores.id = '$id' AND turmas.id = turmas_professor2.id_turma AND servidores.excluido = 'N' AND turmas.ano LIKE '%$ano%' GROUP BY servidores.id ORDER BY nome ASC";
    $Consulta2 = mysqli_query($Conexao, $SQL_Consulta2);
    $Linha = mysqli_num_rows($Consulta2);
    //   
    if ($Linha > 0) {
        $cont2++;
        $pagina = $pdf->PageNo();
        while ($Linha2 = mysqli_fetch_array($Consulta2)) {
            //
            $id_professor = $Linha2['id_professor'];
            //
            $m2 = "";
            $t2 = "";
            $n2 = "";
            $e2 = "";
            $c2 = "";
            $ae2 = "";
            //
            $SQL_Consulta3 = "SELECT servidores.turno FROM `servidores` WHERE id = '$id_professor'";
            $Consulta3 = mysqli_query($Conexao, $SQL_Consulta3);
            $Linha3 = mysqli_fetch_array($Consulta3);
            if ($Linha3["turno"] == "MATUTINO") {
                $m2 = "X";
            } elseif ($Linha3["turno"] == "VESPERTINO") {
                $t2 = "X";
            } elseif ($Linha3["turno"] == "NOTURNO") {
                $n2 = "X";
            } elseif ($Linha3["turno"] == "MATUTINO/VESPERTINO") {
                $m2 = "X";
                $t2 = "X";
            } elseif ($Linha3["turno"] == "MATUTINO/VESPERTINO/NOTURNO") {
                $m2 = "X";
                $t2 = "X";
                $n2 = "X";
            } elseif ($Linha3["turno"] == "MATUTINO/NOTURNO") {
                $m2 = "X";
                $n2 = "X";
            } elseif ($Linha3["turno"] == "VESPERTINO/NOTURNO") {
                $t2 = "X";
                $n2 = "X";
            }
            //
            if ($Linha2["vinculo"] == "EFETIVO(A)") {
                $e2 = "X";
            } elseif ($Linha2["vinculo"] == "CONTRATADO(A)") {
                $c2 = "X";
            } elseif ($Linha2["vinculo"] == "AMIGOS DA ESCOLA") {
                $ae2 = "X";
            }
            // Controla a altura no caso do professor lecionar em várias turmas e anos precisando de duas linhas
            if ($Linha2["resumo_turmas_sim"] == "SIM") {
                $h = 6;
            } else {
                $h = 5.5;
            }
//
            $result = strlen('' . $Linha2["nome"] . '');
            if ($result > 31) {
                $pdf->SetFont('Arial', '', 6.5);
                $pdf->Cell(60, $h, $Linha2["nome"], 1, 0, 'L');
            } else {
                $pdf->Cell(60, $h, $Linha2["nome"], 1, 0, 'L');
            }
            $pdf->SetFont('Arial', '', 7.5);
            $pdf->Cell(20, $h, $Linha2["cpf"], 1, 0, 'C');
            $pdf->Cell(18, $h, $Linha2["dados_certidao"], 1, 0, 'C');
            $pdf->Cell(10, $h, $Linha2["orgao_expedidor"], 1, 0, 'C');
            $pdf->Cell(10, $h, $Linha2["matricula"], 1, 0, 'C');
            $pdf->Cell(40, $h, $Linha2["email"], 1, 0, 'C');
            $pdf->Cell(20, $h, $Linha2["resumo_funcao"] . '' . $Linha2["resumo_funcao_2"], 1, 0, 'C');
            //
            if ($Linha2["resumo_turmas_sim"] == "SIM") {
                //
                $anos = $Linha2["resumo_anos"] . $Linha2["resumo_anos_2"];
                if (strlen($anos) > 7) {
                    $pdf->SetFont('Arial', '', 5.5);
                    $x = $pdf->GetX();
                    $y = $pdf->GetY();
                    $pdf->SetXY($x, $y);
                    $pdf->Cell(14, $h, '', 1, 0, 'L');
                    $pdf->RotatedText($x + 1, $y + 2.5, $Linha2["resumo_anos"], 0);
                    $pdf->RotatedText($x + 1, $y + 5, $Linha2["resumo_anos_2"], 0);
                } else {
                    $pdf->SetFont('Arial', '', 7.5);
                    $pdf->Cell(14, $h, $anos, 1, 0, 'L');
                }
                  $pdf->SetFont('Arial', '', 7.5);
                //
            } else {
                $anos = $Linha2["turma"];
                $pdf->Cell(14, $h, $anos, 1, 0, 'L');
            }
              $pdf->SetFont('Arial', '', 7.5);
            //
            //
            if ($Linha2["resumo_turmas_sim"] == "SIM") {
                $turmas = $Linha2["resumo_turmas"] . $Linha2["resumo_turmas_2"];
                $pdf->Cell(14, $h, $turmas, 1, 0, 'L');
            } else {
                $turmas = $Linha2["unico"];
                $pdf->Cell(14, $h, $turmas, 1, 0, 'L');
            }
            //
            //
            if ($Linha2["resumo_turmas_sim"] == "SIM") {
                $disciplinas = $Linha2["resumo_disciplinas"];
            } else {
                $disciplinas = "POLIVALENTE";
            }
//
            $pdf->Cell(22, $h, $disciplinas, 1, 0, 'L');
            $pdf->Cell(8, $h, $Linha2["carga_horaria"], 1, 0, 'L');
            $pdf->Cell(5, $h, $m2, 1, 0, 'L');
            $pdf->Cell(5, $h, $t2, 1, 0, 'L');

            $pdf->Cell(5, $h, $n2, 1, 0, 'L');
            $pdf->Cell(8, $h, $e2, 1, 0, 'L');

            $pdf->Cell(8, $h, $c2, 1, 0, 'L');
            $pdf->Cell(8, $h, $ae2, 1, 1, 'L');
        }
    }
    $linha = ['60', '20', '18', '10', '10', '40', '20', '14', '14', '22', '8', '5', '5', '5', '8', '8', '8'];
    $i3 = $qtd + $cont;
    //
    if ($qtd + $cont == $qtd2 + $cont2) {
        if ($pagina == 3) {
            while ($i3 < 66) {
                for ($index = 0; $index < count($linha); $index++) {
                    $pdf->Cell($linha[$index], 6, '', 1, 0, 'L');
                    if ($index == 16) {
                        $pdf->Ln();
                    }
                }
                $i3++;
            }
        }
    }
    //
    //
}
















//$pdf->Output(utf8_decode('Gerencial.pdf'), 'I');
$pdf->Output(utf8_decode('Gerencial.pdf'), 'D');

