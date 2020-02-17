<?php

ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
require_once 'fpdf181/fpdf.php';
$pdf = new FPDF('P', 'mm', 'A4');
//$_POST['servidor_selecionado'] = [1];
foreach ($_POST['servidor_selecionado'] as $lista_id) {
//
    $SQL_Consulta = "SELECT * FROM servidores WHERE `id` = $lista_id ";
    $Consulta = mysqli_query($Conexao, $SQL_Consulta);

    while ($row_Consulta = mysqli_fetch_array($Consulta)) {

        //$pdf->Rect(9, 30, 190, 29);
        $pdf->SetAutoPageBreak(true);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetLeftMargin(5);
        $pdf->Image('img/Anexo_Formulário_1.jpg', 7, 20, 193, 250);


        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Cell(210, 59, "", 0, 1, 'L');

        $pdf->Cell(162, 8, "", 0, 0, 'L');
        $pdf->Cell(20, 5.5, $row_Consulta["matricula"], 0, 1, 'L');
        $pdf->Cell(190, 8, "", 0, 1, 'L');
        $pdf->Cell(17, 7, "", 0, 0, 'L');
        $pdf->Cell(147, 7, $row_Consulta["nome"], 0, 0, 'L');
        //    
        $data = $row_Consulta["nascimento"];
        if ($data == "0000-00-00" || $data == "") {
            $pdf->Cell(10, 7, '', 0, 0, 'L');
            $pdf->Cell(8, 7, '', 0, 0, 'L');
            $pdf->Cell(7, 7, '', 0, 1, 'L');
        } else {
            $data = new DateTime($row_Consulta["nascimento"]);
            $pdf->Cell(10, 7, $data->format('d'), 0, 0, 'L');
            $pdf->Cell(8, 7, $data->format('m'), 0, 0, 'L');
            $pdf->Cell(7, 7, $data->format('Y'), 0, 1, 'L');
        }
        //       
        $pdf->Cell(25, 7, "", 0, 0, 'L');
        $pdf->Cell(107, 7, $row_Consulta["endereco"], 0, 0, 'L');
        $pdf->Cell(21, 7, $row_Consulta["numero"], 0, 0, 'L');
        $pdf->Cell(20, 7, $row_Consulta["cep"], 0, 1, 'L');
        //
        $pdf->Cell(25, 7, "", 0, 0, 'L');
        $pdf->Cell(50, 7, $row_Consulta["municipio"], 0, 0, 'L');
        $pdf->Cell(35, 7, $row_Consulta["estado"], 0, 0, 'L');
        $pdf->Cell(20, 7, $row_Consulta["bairro"], 0, 0, 'L');
        if ($row_Consulta["sexo"] == "MASCULINO") {
            $pdf->Cell(18.5, 7, '', 0, 0, 'L');
        } else {
            $pdf->Cell(40.5, 7, '', 0, 0, 'L');
        }
        $pdf->Cell(10, 7, 'X', 0, 1, 'L');
        //        
        $pdf->Cell(30, 5, "", 0, 0, 'L');
        $pdf->Cell(68, 6, $row_Consulta["naturalidade"], 0, 0, 'L');
        $pdf->Cell(37, 6, $row_Consulta["estado_naturalidade"], 0, 0, 'L');
        $pdf->Cell(50, 6, $row_Consulta["nacionalidade"], 0, 1, 'L');
        //     
        $pdf->SetFont('Arial', 'B', 7);
        if ($row_Consulta["cor"] == "BRANCA") {
            $Larg = "22.8";
        } elseif ($row_Consulta["cor"] == "PRETA") {
            $Larg = "39.7";
        } elseif ($row_Consulta["cor"] == "AMARELA") {
            $Larg = "54";
        } elseif ($row_Consulta["cor"] == "PARDA") {
            $Larg = "73";
        } elseif ($row_Consulta["cor"] == "INDIGENA") {
            $Larg = "87.3";
        } else {
            $Larg = "106";
        }
        $pdf->Cell("$Larg", 8, "", 0, 0, 'L');
        $pdf->Cell(20, 8, "X", 0, 1, 'L');
        //
        if ($row_Consulta["deficiente"] == "SIM") {
            $Larg2 = "25";
        } else {
            $Larg2 = "35.2";
        }
        $pdf->Cell("$Larg2", 5, "", 0, 0, 'L');
        $pdf->Cell(45, 5, "X", 0, 0, 'L');
        $pdf->Cell(68, 6, $row_Consulta["tipo_deficiencia"], 0, 0, 'L');
        //
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(190, 5.5, "", 0, 1, 'L');
        if ($row_Consulta["estado_civil"] == "SOLTEIRO(A)") {
            $pdf->Cell(27.5, 7.2, "", 0, 0, 'L');
        } elseif ($row_Consulta["estado_civil"] == "CASADO(A)") {
            $pdf->Cell(51, 7.2, "", 0, 0, 'L');
        } elseif ($row_Consulta["estado_civil"] == "DIVORCIADO(A)") {
            $pdf->Cell(72, 7.2, "", 0, 0, 'L');
        } elseif ($row_Consulta["estado_civil"] == "VIÚVO(A)") {
            $pdf->Cell(124, 7.2, "", 0, 0, 'L');
        } else {
            $pdf->Cell(142, 7.2, "", 0, 0, 'L');
        }
        $pdf->Cell(190, 7.2, "X", 0, 1, 'L');
        $pdf->Cell(25, 7, "", 0, 0, 'L');
        //
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(110, 6, $row_Consulta["conjuge"], 0, 0, 'L');
        $pdf->Cell(20, 6, $row_Consulta["conjuge_cpf"], 0, 1, 'L');
        //
        $pdf->Cell(25, 7, "", 0, 0, 'L');
        $pdf->Cell(60, 6, $row_Consulta["celular"], 0, 0, 'L');
        $pdf->Cell(95, 6, $row_Consulta["email"], 0, 0, 'L');
        $pdf->Cell(50, 7, $row_Consulta["tipo_sangue"], 0, 1, 'L');
        //
        $pdf->Cell(40, 6, "", 0, 0, 'L');
        $pdf->Cell(60, 6, $row_Consulta["pai"], 0, 1, 'L');
        $pdf->Cell(40, 6, "", 0, 0, 'L');
        $pdf->Cell(95, 6, $row_Consulta["mae"], 0, 1, 'L');
        //
        $pdf->Cell(180, 7, "", 0, 1, 'L');
        $pdf->Cell(40, 6, "", 0, 0, 'L');
        if ($row_Consulta["grau_intrucao_completo"] == "SIM") {
            $pdf->Cell(117, 7, $row_Consulta["grau_intrucao"], 0, 0, 'L');
            $pdf->Cell(170, 7, "X", 0, 1, 'L');
        } else {
            $pdf->Cell(128, 7, $row_Consulta["grau_intrucao"], 0, 0, 'L');
            $pdf->Cell(170, 7, "X", 0, 1, 'L');
        }
        //
        $pdf->Cell(113, 6, "", 0, 0, 'L');
        $pdf->Cell(40, 6, $row_Consulta["registro_numero"], 0, 0, 'L');

        $data = $row_Consulta["registro_data"];
        if ($data == "0000-00-00" || $data == "") {
            $pdf->Cell(11, 6, '', 0, 0, 'L');
            $pdf->Cell(11, 6, '', 0, 0, 'L');
            $pdf->Cell(7, 6, '', 0, 1, 'L');
        } else {
            $data = new DateTime($row_Consulta["registro_data"]);
            $pdf->Cell(11, 6, $data->format('d'), 0, 0, 'L');
            $pdf->Cell(11, 6, $data->format('m'), 0, 0, 'L');
            $pdf->Cell(7, 6, $data->format('Y'), 0, 1, 'L');
        }
        //       
        $pdf->Cell(180, 7.5, "", 0, 1, 'L');
        $pdf->Cell(12, 6, "", 0, 0, 'L');
        $pdf->Cell(70, 6, $row_Consulta["dados_certidao"], 0, 0, 'L');
        $pdf->Cell(32, 6, $row_Consulta["orgao_expedidor"], 0, 0, 'L');
        $pdf->Cell(40, 6, $row_Consulta["estado_expedidor"], 0, 0, 'L');
        $data = $row_Consulta["data_expedicao"];
        if ($data == "0000-00-00" || $data == "") {
            $pdf->Cell(11, 7, '', 0, 0, 'L');
            $pdf->Cell(11, 7, '', 0, 0, 'L');
            $pdf->Cell(7, 7, '', 0, 1, 'L');
        } else {
            $data = new DateTime($row_Consulta["data_expedicao"]);
            $pdf->Cell(11, 6, $data->format('d'), 0, 0, 'L');
            $pdf->Cell(11, 6, $data->format('m'), 0, 0, 'L');
            $pdf->Cell(7, 6, $data->format('Y'), 0, 0, 'L');
            $pdf->Cell(7, 7, '', 0, 1, 'L');
        }
        //
        $pdf->Cell(16, 8, "", 0, 0, 'L');
        $pdf->Cell(81, 6, $row_Consulta["cpf"], 0, 0, 'L');
        $pdf->Cell(40, 6, $row_Consulta["pis"], 0, 1, 'L');
        //
        $pdf->Cell(37, 6, '', 0, 0, 'L');
        $pdf->Cell(41, 6, $row_Consulta["titulo"], 0, 0, 'L');
        $pdf->Cell(30, 6, $row_Consulta["zona"], 0, 0, 'L');
        $pdf->Cell(37, 6, $row_Consulta["secao"], 0, 0, 'L');
        $pdf->Cell(38, 6, $row_Consulta["titulo_municipio"], 0, 0, 'L');
        $pdf->Cell(40, 7, $row_Consulta["titulo_uf"], 0, 1, 'L');
        //
        $pdf->Cell(19, 7, '', 0, 0, 'L');
        $pdf->Cell(65, 6, $row_Consulta["banco"], 0, 0, 'L');
        $pdf->Cell(38, 6, $row_Consulta["agencia"], 0, 0, 'L');
        $pdf->Cell(40, 6, $row_Consulta["conta"], 0, 1, 'L');
        //
        $pdf->Cell(180, 7, '', 0, 1, 'L');
        $pdf->Cell(16, 7, '', 0, 0, 'L');
        if ($row_Consulta["depen_sexo_1"] == "MASCULINO") {
            $pdf->Cell(142.5, 7, $row_Consulta["depen_nome_1"], 0, 0, 'L');
            $pdf->Cell(65, 7, "X", 0, 1, 'L');
        } elseif ($row_Consulta["depen_sexo_1"] == "FEMININO") {
            $pdf->Cell(156, 7, $row_Consulta["depen_nome_1"], 0, 0, 'L');
            $pdf->Cell(65, 7, "X", 0, 1, 'L');
        } else {
            $pdf->Cell(65, 7, "", 0, 1, 'L');
        }
        //
        $pdf->Cell(15, 7, '', 0, 0, 'L');
        $pdf->Cell(90, 6, $row_Consulta["depen_cpf_1"], 0, 0, 'L');
        $pdf->Cell(60, 6, $row_Consulta["depen_grau_1"], 0, 0, 'L');

        $data = $row_Consulta["depen_data_1"];
        if ($data == "0000-00-00" || $data == "") {
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(7, 6, '', 0, 1, 'L');
        } else {
            $data = new DateTime($row_Consulta["depen_data_1"]);
            $pdf->Cell(10, 6, $data->format('d'), 0, 0, 'L');
            $pdf->Cell(10, 6, $data->format('m'), 0, 0, 'L');
            $pdf->Cell(7, 6, $data->format('Y'), 0, 1, 'L');
        }
        $depen_univer_1 = $row_Consulta["depen_univer_1"];
//        $pdf->SetLineWidth(0.5);
//        if ($depen_univer_1 == "SIM") {
//            $pdf->Line(11.5, 233.3, 13.2, 231.9);
//        }
//        $depen_incapac_1 = $row_Consulta["depen_incapac_1"];
//        if ($depen_incapac_1 == "SIM") {
//            $pdf->Line(45.3, 233.5, 46.8, 231.9);
//        }
//        $depen_deficiente_1 = $row_Consulta["depen_deficiente_1"];
//        if ($depen_deficiente_1 == "SIM") {
//            $pdf->Line(172, 232.7, 173.5, 231.2);
//        } else {
//            $pdf->Line(182.3, 232.7, 183.7, 231.2);
//        }
        $pdf->Cell(180, 7, '', 0, 1, 'L');
        //
        if ($row_Consulta["depen_sexo_2"] == "MASCULINO") {
            $pdf->Cell(16, 7, '', 0, 0, 'L');
            $pdf->Cell(142.5, 7, $row_Consulta["depen_nome_2"], 0, 0, 'L');
            $pdf->Cell(65, 7, "X", 0, 1, 'L');
        } elseif ($row_Consulta["depen_sexo_2"] == "FEMININO") {
            $pdf->Cell(16, 7, '', 0, 0, 'L');
            $pdf->Cell(156, 7, $row_Consulta["depen_nome_2"], 0, 0, 'L');
            $pdf->Cell(65, 7, "X", 0, 1, 'L');
        } else {
            $pdf->Cell(65, 7, "", 0, 1, 'L');
        }

        $pdf->Cell(90, 6, $row_Consulta["depen_cpf_2"], 0, 0, 'L');
        $pdf->Cell(60, 6, $row_Consulta["depen_grau_2"], 0, 0, 'L');

        $data = $row_Consulta["depen_data_2"];
        if ($data == "0000-00-00" || $data == "") {
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(7, 6, '', 0, 1, 'L');
        } else {
            $data = new DateTime($row_Consulta["depen_data_2"]);
            $pdf->Cell(10, 6, $data->format('d'), 0, 0, 'L');
            $pdf->Cell(10, 6, $data->format('m'), 0, 0, 'L');
            $pdf->Cell(7, 6, $data->format('Y'), 0, 1, 'L');
        }
        //
        $pdf->Cell(180, 7, '', 0, 1, 'L');
        $pdf->Cell(16, 7, '', 0, 0, 'L');
        if ($row_Consulta["depen_sexo_3"] == "MASCULINO") {
            $pdf->Cell(142.5, 7, $row_Consulta["depen_nome_3"], 0, 0, 'L');
            $pdf->Cell(65, 7, "X", 0, 1, 'L');
        } elseif ($row_Consulta["depen_sexo_3"] == "FEMININO") {           
            $pdf->Cell(156, 7, $row_Consulta["depen_nome_3"], 0, 0, 'L');
            $pdf->Cell(65, 7, "X", 0, 1, 'L');
        } else {
            $pdf->Cell(65, 7, "", 0, 1, 'L');
        }

        $pdf->Cell(15, 7, '', 0, 0, 'L');
        $pdf->Cell(90, 6, $row_Consulta["depen_cpf_3"], 0, 0, 'L');
        $pdf->Cell(60, 6, $row_Consulta["depen_grau_3"], 0, 0, 'L');

        $data = $row_Consulta["depen_data_3"];
        if ($data == "0000-00-00" || $data == "") {
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(7, 6, '', 0, 1, 'L');
        } else {
            $data = new DateTime($row_Consulta["depen_data_3"]);
            $pdf->Cell(10, 6, $data->format('d'), 0, 0, 'L');
            $pdf->Cell(10, 6, $data->format('m'), 0, 0, 'L');
            $pdf->Cell(7, 6, $data->format('Y'), 0, 1, 'L');
        }
        //
        $pdf->SetAutoPageBreak(true);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetLeftMargin(5);
        $pdf->Image('img/Anexo_Formulário_2.jpg', 7, 20, 193, 131);
        $pdf->SetFont('Arial', 'B', 9);
        //
        $pdf->Cell(180, 20, '', 0, 1, 'L');
        $pdf->Cell(16, 7, '', 0, 0, 'L');
        $pdf->Cell(65, 7, '', 0, 1, 'L');
        $pdf->Cell(15, 7, '', 0, 0, 'L');
        $pdf->Cell(105, 6, '', 0, 0, 'L');
        $pdf->Cell(43, 6, '', 0, 0, 'L');

        $data = $row_Consulta["depen_data_3"];
        if ($data == "0000-00-00" || $data == "") {
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(7, 6, '', 0, 1, 'L');
        } else {
            $data = new DateTime($row_Consulta["depen_data_3"]);
            $pdf->Cell(10, 6, $data->format('d'), 0, 0, 'L');
            $pdf->Cell(10, 6, $data->format('m'), 0, 0, 'L');
            $pdf->Cell(7, 6, $data->format('Y'), 0, 1, 'L');
        }
        //
        $pdf->Cell(190, 33, '', 0, 1, 'L');
        $pdf->Cell(160, 7, '', 0, 0, 'L');
        $data = $row_Consulta["admissao"];
        if ($data == "0000-00-00" || $data == "") {
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(10, 6, '', 0, 0, 'L');
            $pdf->Cell(7, 7, '', 0, 1, 'L');
        } else {
            $data = new DateTime($row_Consulta["admissao"]);
            $pdf->Cell(10, 6, $data->format('d'), 0, 0, 'L');
            $pdf->Cell(10, 6, $data->format('m'), 0, 0, 'L');
            $pdf->Cell(7, 7, $data->format('Y'), 0, 1, 'L');
        }
        //            
        $pdf->Cell(60, 7, "", 0, 0, 'L');
        $comissionado = $row_Consulta["comissionado"];
        if ($comissionado == "SIM") {
            $comissionado = "SIM";
        } else {
            $comissionado = "NAO";
        }
        $pdf->Cell(95, 7, $row_Consulta["funcao"], 0, 0, 'L');

        $vinculo = $row_Consulta["vinculo"];
        if ($vinculo == "EFETIVO(A)") {
            $vinculo = "SIM";
        } else {
            $vinculo = "NAO";
        }
        $pdf->Cell(60, 7, "$vinculo", 0, 1, 'L');
        $pdf->Cell(26, 7, '', 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(81, 6, "SECRETARIA MUNICIPAL DE EDUCAÇÃO", 0, 0, 'L');
        $pdf->Cell(105, 7, $row_Consulta["lotacao"], 0, 1, 'L');
        $pdf->Cell(90, 7, '', 0, 0, 'L');
        $pdf->Cell(104, 6, $row_Consulta["unidade_escolar"], 0, 0, 'L');
    }
}
//$pdf->Output(utf8_decode('Servidor.pdf'), 'I');
$pdf->Output(utf8_decode('Servidor.pdf'), 'D');





