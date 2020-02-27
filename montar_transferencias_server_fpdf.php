<?php

ob_start();
include 'valida_cookies.inc';
include './inc.conf.php';
//
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
require_once 'fpdf181/fpdf.php';
require_once 'rotation.php';

class PDF extends PDF_Rotate {

//    Page footer
    function Footer() {
// Position at 1.5 cm from bottom
        $this->SetY(-14);
// Arial italic 8
        $this->SetFont('Arial', 'B', 7);
// Page number
//        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->Cell(0, 5, $this->PageNo(), 0, 0, 'R');
    }

    function RotatedText($x, $y, $txt, $angle) {
        $txt = utf8_decode($txt);
//Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

}

$array_alunos [] = "";
$id_turma = "";
foreach (($_POST['aluno_selecionado']) as $lista_id) {
    $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$lista_id' ");
    $rowf = mysqli_fetch_array($Consultaf);
    array_push($array_alunos, $rowf['id_aluno_solicitacao']);
}
array_shift($array_alunos);
//
// Instanciation of inherited class
$pdf = new PDF();
//$_POST = array(102, 102, 102);
//$_POST['id_alunos']
foreach ($array_alunos as $id_aluno) {

    $ano1 = "";
    $ano2 = "";
    $ano3 = "";
    $ano4 = "";
    $ano5 = "";
    $eja1 = "";
    $eja2 = "";

    $sql05 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE id_bimestre_media_aluno = '$id_aluno'  AND  status_bimestre_media = '5'  GROUP BY ano ORDER BY `bimestre_media`.`ano` ASC");
    $rows = mysqli_num_rows($sql05);
    while ($row05 = mysqli_fetch_array($sql05)) {
        $ano_turma = $row05['ano_turma'];

//     
        if ($ano_turma == "1 ANO") {
            $ano1 = $row05['ano'];
        } elseif ($ano_turma == "2 ANO") {
            $ano2 = $row05['ano']; //           
        } elseif ($ano_turma == "3 ANO") {
            $ano3 = $row05['ano'];
            //
        } elseif ($ano_turma == "EJA I") {
            $eja1 = $row05['ano'];
        } elseif ($ano_turma == "EJA II") {
            $eja2 = $row05['ano'];
        }
    }
    if ($rows < 1) {
        $Consulta_aluno = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id = '$id_aluno' ");
        $Linha_aluno = mysqli_fetch_array($Consulta_aluno, MYSQLI_BOTH);
        $nome = $Linha_aluno['nome'];
        //      
        $pdf->SetAutoPageBreak(true);
        $pdf->AddPage();
        $pdf->Image('img/montar_transferencias_bloco.PNG', 0, 0, 210, 290);
        $pdf->Cell(190, 190, '', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 24);
        $pdf->Cell(190, 5, "$nome", 0, 1, 'C');
    } else {
        //
        $frequencia = "";
        $escola_horas = "";
        $marcar = "";
        $optradio1 = 'NAO';
        $ano1_conv = "";
//
        if (!$ano1 == "") {
            $marcar = "X";
        }
        if (strlen($ano1) !== 4) {
            $ano1_conv = substr($ano1, 0, -2);
        } else {
            $ano1_conv = $ano1;
        }
        $marcar2 = "";
        $optradio2 = 'NAO';
        $ano2_conv = "";

        if (!$ano2 == "") {
            $marcar2 = "X";
        }
        if (strlen($ano2) !== 4) {
            $ano2_conv = substr($ano2, 0, -2);
        } else {
            $ano2_conv = $ano2;
        }
//
        $marcar3 = "";
        $ano3_conv = "";
        $optradio3 = 'NAO';

        if (!$ano3 == "") {
            $marcar3 = "X";
        }
        if (strlen($ano3) !== 4) {
            $ano3_conv = substr($ano3, 0, -2);
        } else {
            $ano3_conv = $ano3;
        }
//
        $marcar4 = "";
        $ano4_conv = "";
        $optradio4 = '';
        if (!$ano4 == "") {
            $marcar4 = "X";
        }
        if (strlen($ano4) !== 4) {
            $ano4_conv = substr($ano4, 0, -2);
        } else {
            $ano4_conv = $ano4;
        }
//
        $marcar5 = "";
        $ano5_conv = '';
        $optradio5 = '';
        if (!$ano5 == "") {
            $marcar5 = "X";
        }
        if (strlen($ano5) !== 4) {
            $ano5_conv = substr($ano5, 0, -2);
        } else {
            $ano5_conv = $ano5;
        }
//
        //EJAS       //EJAS      //EJAS
        $eja1_conv = "";
        $optradioEja1 = "";
//       $eja1 = "2020";
        if ($eja1 == "") {
            $marcareja1 = "";
        } else {
            $marcareja1 = "X";
        }
        if (strlen($eja1) !== 4) {
            $eja1_conv = substr($eja1, 0, -2);
        } else {
            $eja1_conv = $eja1;
        }


        $eja2_conv = "";

        if ($eja2 == "") {
            $marcareja2 = "";
        } else {
            $marcareja2 = "X";
        }
        if (strlen($eja2) !== 4) {
            $eja2_conv = substr($eja2, 0, -2);
        } else {
            $eja2_conv = $eja2;
        }

//
        $ano6 = "";
        $ano7 = "";
        $ano8 = "";
        $ano9 = "";
        $eja3 = "";
//
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
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
// Instanciation of inherited class
        $pdf->SetLeftMargin(10);
        $pdf->SetAutoPageBreak(true);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->RotatedText(70, 9, 'HISTÓRICO ESCOLAR DO ENSINO FUNDAMENTAL', 0);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(20, 30, '', 1, 0, 'L');
        $pdf->RotatedText(15, 35, 'COMPONENTES  ', 90);
        $pdf->RotatedText(20, 35, 'CURRICULARES', 90);
        for ($i = 0; $i < 5; $i++) {
            $pdf->Cell(10, 30, '', 1, 0, 'L');
        }
        $pdf->RotatedText(36, 39, 'LÍNGUA PORTUGUESA', 90);
        $pdf->RotatedText(44, 39, 'ESTUDOS SOCIAIS', 90);
        $pdf->RotatedText(56, 39, 'HISTÓRIA', 90);
        $pdf->RotatedText(66, 39, 'GEOGRAFIA', 90);
        $pdf->RotatedText(76, 39, 'CIÊNCIAS', 90);
        $pdf->Cell(15, 30, '', 1, 0, 'L');
        $pdf->RotatedText(86, 39, 'CIÊNCIAS FISÍCAS BIO.', 90);
        $pdf->RotatedText(89, 39, 'E PROGRAMAS', 90);
        $pdf->RotatedText(92, 39, 'DE SAÚDE', 90);
        for ($i = 0; $i < 5; $i++) {
            $pdf->Cell(10, 30, '', 1, 0, 'L');
        }
        $pdf->RotatedText(102, 39, 'ARTE', 90);
        $pdf->RotatedText(112, 39, 'EDUCAÇÃO ARTISTÍCA', 90);
        $pdf->RotatedText(122, 39, 'EDUCAÇÃO FÍSICA', 90);
        $pdf->RotatedText(132, 39, 'ENSINO RELIGIOSO', 90);
        $pdf->RotatedText(142, 39, 'MATEMÁTICA', 90);
        $pdf->Cell(15, 30, '', 1, 0, 'L');
        $pdf->RotatedText(150, 39, 'LINGUA ESTRANGEIRA', 90);
        $pdf->RotatedText(154, 39, 'MODERNA INGLÊS', 90);
        $pdf->Cell(10, 30, '', 1, 0, 'L');
        $pdf->RotatedText(165, 39, 'REDAÇÃO', 90);
        $pdf->Cell(15, 30, '', 1, 0, 'L');
        $pdf->RotatedText(175, 39, 'ELEMENTOS DE', 90);
        $pdf->RotatedText(178, 39, 'DESENHOS', 90);
        $pdf->RotatedText(181, 39, 'GEOMETRICOS', 90);
        $pdf->Cell(15, 30, '', 1, 1, 'L');
        $pdf->RotatedText(193, 39, 'DHC', 90);
//
        $pdf->Cell(10, 20, '', 1, 0, 'L');
        $pdf->RotatedText(15, 57, "1° ANO ( $marcar )", 90);
        $pdf->RotatedText(18, 57, "1° SERIE (  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
//
        $escola_horas = "";
        $frequencia = "";
        $dias = "";
        $escola = "";
        $cidade = "";
        $uf = "";
//          No caso dos alunos irem para recuperação
        include 'montar_transferencia_server_1ano_final.php';

        $pdf->Cell(10, 4, "", 0, 0, 'C');
        $pdf->Cell(10, 4, "CH", 1, 0, 'C');
        $pdf->Cell(10, 4, "   $dias", 1, 0, 'C');
        $pdf->Cell(10, 4, "   D", 1, 0, 'C');
        $pdf->Cell(10, 4, "   I", 1, 0, 'C');
        $pdf->Cell(10, 4, "   A", 1, 0, 'C');
        $pdf->Cell(10, 4, "   S", 1, 0, 'C');
        $pdf->Cell(15, 4, " -----", 1, 0, 'C');
        $pdf->Cell(10, 4, "   L", 1, 0, 'C');
        $pdf->Cell(10, 4, "   E", 1, 0, 'C');
        $pdf->Cell(10, 4, "   T", 1, 0, 'C');
        $pdf->Cell(10, 4, "   I", 1, 0, 'C');
        $pdf->Cell(10, 4, "   V", 1, 0, 'C');
        $pdf->Cell(15, 4, "   O", 1, 0, 'C');
        $pdf->Cell(10, 4, "   S", 1, 0, 'C');
        $pdf->Cell(15, 4, " -----", 1, 0, 'C');
        $pdf->Cell(15, 4, " -----", 1, 1, 'C');
        $pdf->Cell(10, 4, " ", 0, 0, 'C');
        $pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Estabelecimento: $escola", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Ano:  $ano1_conv                   Cidade:   $cidade                         Estado:  $uf", 1, 1, 'L');
//    
// <!--2 ano-->      <!--2 ano-->       <!--2 ano-->     <!--2 ano-->         <!--2 ano-->                
// <!--EJA-->      <!--EJA-->       <!--EJA-->     <!--EJA-->         <!--EJA-->                
        $pdf->Cell(10, 24, '', 1, 0, 'L');
        $pdf->RotatedText(13, 77, "2° ANO (  $marcar2 )", 90);
        $pdf->RotatedText(16, 77, "2° SERIE (   )", 90);
        $pdf->RotatedText(19, 77, "I FASE ( $marcareja1  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
        $escola_horas = "";
        $frequencia = "";
        $dias = "";
        $escola = "";
        $cidade = "";
        $uf = "";
        $recupera = "";
        if (!$ano2 == "") {
            //No caso dos alunos irem para recuperação
            include 'montar_transferencia_server_2ano_final_1.php';
        } elseif (!$eja1 == "") {
            //No caso dos alunos irem para recuperação
            include 'montar_transferencia_server_eja1_final_1.php';
        } else {
            $i = 0;
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
            while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                $i++;
                $disciplina = $linha['disciplina'];
                $id = $linha['id'];
                if ($i == "15") {
                    $pdf->Cell(15, 4, '', 1, 1, 'L');
                } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
                    $pdf->Cell(15, 4, '', 1, 0, 'L');
                } else {
                    $pdf->Cell(10, 4, '', 1, 0, 'L');
                }
            }
        }
        $pdf->Cell(10, 4, "", 0, 0, 'L');
        $pdf->Cell(10, 4, "CH", 1, 0, 'L');
        $pdf->Cell(10, 4, "   $dias", 1, 0, 'L');
        $pdf->Cell(10, 4, "   D", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   A", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "   L", 1, 0, 'L');
        $pdf->Cell(10, 4, "   E", 1, 0, 'L');
        $pdf->Cell(10, 4, "   T", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   V", 1, 0, 'L');
        $pdf->Cell(15, 4, "   O", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Ano:  $ano2_conv  $eja1_conv                  Cidade:   $cidade                   Estado:  $uf", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//            <!--2 ano fim-->
//            <!--3 ano--> <!--3 ano--> <!--3 ano--> <!--3 ano--> <!--3 ano-->
        $pdf->Cell(10, 24, '', 1, 0, 'L');
        $pdf->RotatedText(15, 101, "3° ANO ( $marcar3 )", 90);
        $pdf->RotatedText(18, 101, "3° SERIE (  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
        $escola_horas = "";
        $frequencia = "";
        $dias = "";
        $escola = "";
        $cidade = "";
        $uf = "";
        if (!$ano3 == "") {
            //No caso dos alunos irem para recuperação
            include 'montar_transferencia_server_3ano_final_1.php';
        } else {
            $i = 0;
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
            while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                $i++;
                $disciplina = $linha['disciplina'];
                $id = $linha['id'];
                if ($i == "15") {
                    $pdf->Cell(15, 4, '', 1, 1, 'L');
                } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
                    $pdf->Cell(15, 4, '', 1, 0, 'L');
                } else {
                    $pdf->Cell(10, 4, '', 1, 0, 'L');
                }
            }
        }
        $pdf->Cell(10, 4, "", 0, 0, 'L');
        $pdf->Cell(10, 4, "CH", 1, 0, 'L');
        $pdf->Cell(10, 4, "   $dias", 1, 0, 'L');
        $pdf->Cell(10, 4, "   D", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   A", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "   L", 1, 0, 'L');
        $pdf->Cell(10, 4, "   E", 1, 0, 'L');
        $pdf->Cell(10, 4, "   T", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   V", 1, 0, 'L');
        $pdf->Cell(15, 4, "   O", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Ano:  $ano3_conv                   Cidade:   $cidade                     Estado:  $uf", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//<!--3 ano fim-->
//            <!--4 ano -->               <!--4 ano -->                   <!--4 ano -->                   <!--4 ano -->
        $pdf->Cell(10, 24, '', 1, 0, 'L');
        $pdf->RotatedText(13, 126, "4° ANO ( $marcar4  )", 90);
        $pdf->RotatedText(16, 126, "4° SERIE (   )", 90);
        $pdf->RotatedText(19, 126, "II FASE ( $marcareja2  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
        $escola_horas = "";
        $frequencia = "";
        $dias = "";
        $escola = "";
        $cidade = "";
        $uf = "";
        $recupera = "";
        if (!$ano4 == "") {
            //No caso dos alunos irem para recuperação
            include 'montar_transferencia_server_4ano_final_1.php';
        } elseif (!$eja2 == "") {
            //No caso dos alunos irem para recuperação
            include 'montar_transferencia_server_eja2_final_1.php';
        } else {
            $i = 0;
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
            while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                $i++;
                $disciplina = $linha['disciplina'];
                $id = $linha['id'];
                if ($i == "15") {
                    $pdf->Cell(15, 4, '', 1, 1, 'L');
                } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
                    $pdf->Cell(15, 4, '', 1, 0, 'L');
                } else {
                    $pdf->Cell(10, 4, '', 1, 0, 'L');
                }
            }
        }
        $pdf->Cell(10, 4, "", 0, 0, 'L');
        $pdf->Cell(10, 4, "CH", 1, 0, 'L');
        $pdf->Cell(10, 4, " $dias", 1, 0, 'L');
        $pdf->Cell(10, 4, "   D", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   A", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "   L", 1, 0, 'L');
        $pdf->Cell(10, 4, "   E", 1, 0, 'L');
        $pdf->Cell(10, 4, "   T", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   V", 1, 0, 'L');
        $pdf->Cell(15, 4, "   O", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Ano:  $ano4_conv $eja2_conv                 Cidade:   $cidade                   Estado:  $uf", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//<!--4 ano fim-->
//            <!--5 ano -->                     <!--5 ano -->                       <!--5 ano -->                     <!--5 ano -->                 <!--5 ano -->
        $pdf->Cell(10, 24, '', 1, 0, 'L');
        $pdf->RotatedText(15, 150, "5° ANO ( $marcar5 )", 90);
        $pdf->RotatedText(18, 150, "5° SERIE (  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
        $escola_horas = "";
        $frequencia = "";
        $dias = "";
        $escola = "";
        $cidade = "";
        $uf = "";
        $recupera = "";
        if (!$ano5 == "") {
            //No caso dos alunos irem para recuperação
            include 'montar_transferencia_server_5ano_final_1.php';
        } else {
            $i = 0;
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
            while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                $i++;
                $disciplina = $linha['disciplina'];
                $id = $linha['id'];
                if ($i == "15") {
                    $pdf->Cell(15, 4, '', 1, 1, 'L');
                } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
                    $pdf->Cell(15, 4, '', 1, 0, 'L');
                } else {
                    $pdf->Cell(10, 4, '', 1, 0, 'L');
                }
            }
        }
        $pdf->Cell(10, 4, "", 0, 0, 'L');
        $pdf->Cell(10, 4, "CH", 1, 0, 'L');
        $pdf->Cell(10, 4, "    ", 1, 0, 'L');
        $pdf->Cell(10, 4, "   D", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   A", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "   L", 1, 0, 'L');
        $pdf->Cell(10, 4, "   E", 1, 0, 'L');
        $pdf->Cell(10, 4, "   T", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   V", 1, 0, 'L');
        $pdf->Cell(15, 4, "   O", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Ano: $ano5_conv                       Cidade:  $cidade                           Estado: $uf  ", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
// <!--5 ano fim-->
//            <!--6 ano-->                  <!--6 ano fim-->              <!--6 ano fim-->                 <!--6 ano fim-->
        $pdf->Cell(10, 24, '', 1, 0, 'L');
        $pdf->RotatedText(13, 174, "6° ANO (  )", 90);
        $pdf->RotatedText(16, 174, "6° SERIE (  )", 90);
        $pdf->RotatedText(19, 174, "III FASE (  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
        $i = 0;
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
            $i++;
            $disciplina = $linha['disciplina'];
            $id = $linha['id'];
            if ($i == "15") {
                $pdf->Cell(15, 4, '', 1, 1, 'L');
            } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
                $pdf->Cell(15, 4, '', 1, 0, 'L');
            } else {
                $pdf->Cell(10, 4, '', 1, 0, 'L');
            }
        }

        $pdf->Cell(10, 4, "", 0, 0, 'L');
        $pdf->Cell(10, 4, "CH", 1, 0, 'L');
        $pdf->Cell(10, 4, "   ", 1, 0, 'L');
        $pdf->Cell(10, 4, "   D", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   A", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "   L", 1, 0, 'L');
        $pdf->Cell(10, 4, "   E", 1, 0, 'L');
        $pdf->Cell(10, 4, "   T", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   V", 1, 0, 'L');
        $pdf->Cell(15, 4, "   O", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Horas Letivas:                  Frequencia:                          Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Estabelecimento: ", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Ano:                               Cidade:                              Estado:          ", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
// <!--6 ano fim-->
//            <!--7 ano -->                                        <!--7 ano -->                                           <!--7 ano --> 
        $pdf->Cell(10, 24, '', 1, 0, 'L');
        $pdf->RotatedText(15, 200, "7° ANO (  )", 90);
        $pdf->RotatedText(18, 200, "7° SERIE (  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
        $i = 0;
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
            $i++;
            $disciplina = $linha['disciplina'];
            $id = $linha['id'];
            if ($i == "15") {
                $pdf->Cell(15, 4, '', 1, 1, 'L');
            } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
                $pdf->Cell(15, 4, '', 1, 0, 'L');
            } else {
                $pdf->Cell(10, 4, '', 1, 0, 'L');
            }
        }

        $pdf->Cell(10, 4, "", 0, 0, 'L');
        $pdf->Cell(10, 4, "CH", 1, 0, 'L');
        $pdf->Cell(10, 4, " ", 1, 0, 'L');
        $pdf->Cell(10, 4, "   D", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   A", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "   L", 1, 0, 'L');
        $pdf->Cell(10, 4, "   E", 1, 0, 'L');
        $pdf->Cell(10, 4, "   T", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   V", 1, 0, 'L');
        $pdf->Cell(15, 4, "   O", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Horas Letivas:                  Frequencia:                          Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Ano:                     Cidade:                       Estado:  ", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//Fim do 7 ano  
//<!--8 ano--> <!--8 ano--> <!--8 ano--> <!--8 ano--> 
        $pdf->Cell(10, 24, '', 1, 0, 'L');
        $pdf->RotatedText(13, 220, "8° ANO (  )", 90);
        $pdf->RotatedText(16, 220, "8° SERIE (  )", 90);
        $pdf->RotatedText(19, 220, "IV FASE (  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
        $i = 0;
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
            $i++;
            $disciplina = $linha['disciplina'];
            $id = $linha['id'];
            if ($i == "15") {
                $pdf->Cell(15, 4, '', 1, 1, 'L');
            } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
                $pdf->Cell(15, 4, '', 1, 0, 'L');
            } else {
                $pdf->Cell(10, 4, '', 1, 0, 'L');
            }
        }

        $pdf->Cell(10, 4, "", 0, 0, 'L');
        $pdf->Cell(10, 4, "CH", 1, 0, 'L');
        $pdf->Cell(10, 4, "   ", 1, 0, 'L');
        $pdf->Cell(10, 4, "   D", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   A", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "   L", 1, 0, 'L');
        $pdf->Cell(10, 4, "   E", 1, 0, 'L');
        $pdf->Cell(10, 4, "   T", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   V", 1, 0, 'L');
        $pdf->Cell(15, 4, "   O", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Horas Letivas:                  Frequencia:                          Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Estabelecimento: ", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Ano:                               Cidade:                                        Estado:          ", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//Fim do 8 ano 
//  9 ano 9ano 9ano 9ano  
        $pdf->Cell(10, 20, '', 1, 0, 'L');
        $pdf->RotatedText(15, 245, "9° ANO (  )", 90);
        $pdf->RotatedText(18, 245, "9° SERIE (  )", 90);
        $pdf->Cell(10, 4, "Notas", 1, 0, 'L');
        $i = 0;
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
            $i++;
            $disciplina = $linha['disciplina'];
            $id = $linha['id'];
            if ($i == "15") {
                $pdf->Cell(15, 4, '', 1, 1, 'L');
            } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
                $pdf->Cell(15, 4, '', 1, 0, 'L');
            } else {
                $pdf->Cell(10, 4, '', 1, 0, 'L');
            }
        }

        $pdf->Cell(10, 4, "", 0, 0, 'L');
        $pdf->Cell(10, 4, "CH", 1, 0, 'L');
        $pdf->Cell(10, 4, "   ", 1, 0, 'L');
        $pdf->Cell(10, 4, "   D", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   A", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(10, 4, "   L", 1, 0, 'L');
        $pdf->Cell(10, 4, "   E", 1, 0, 'L');
        $pdf->Cell(10, 4, "   T", 1, 0, 'L');
        $pdf->Cell(10, 4, "   I", 1, 0, 'L');
        $pdf->Cell(10, 4, "   V", 1, 0, 'L');
        $pdf->Cell(15, 4, "   O", 1, 0, 'L');
        $pdf->Cell(10, 4, "   S", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 0, 'L');
        $pdf->Cell(15, 4, " -----", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, "Horas Letivas:                  Frequencia:                          Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Estabelecimento: ", 1, 1, 'L');
        $pdf->Cell(10, 4, " ", 0, 0, 'L');
        $pdf->Cell(180, 4, " Ano:                               Cidade:                              Estado:          ", 1, 1, 'L');
        $pdf->Cell(190, 6, "REGISTRO DA PROGRESSÃO PARCIAL E EXAME ESPECIAL", 0, 1, 'C');
        $pdf->Cell(23.7, 4, "ANO", 1, 0, 'C');
        $pdf->Cell(23.7, 4, "SÉRIE", 1, 0, 'C');
        $pdf->Cell(35.7, 4, "DISCIPLINA", 1, 0, 'C');
        $pdf->Cell(23.7, 4, "NOTA", 1, 0, 'C');
        $pdf->Cell(23.7, 4, "RESULTADO", 1, 0, 'C');
        $pdf->Cell(59.1, 4, "UNIDADE DE ENSINO", 1, 1, 'C');

        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(35.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(59.1, 3, "", 1, 1, 'C');
//
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(35.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(59.1, 3, "", 1, 1, 'C');
//
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(35.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(59.1, 3, "", 1, 1, 'C');
//
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(35.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(23.7, 3, "", 1, 0, 'C');
        $pdf->Cell(59.1, 3, "", 1, 1, 'C');
//
        $pdf->Cell(190, 4, "Alagoinha, $dia de $mes de $ano .", 0, 1, 'C');
        $pdf->Cell(190, 4, "", 0, 1, 'C');
        $pdf->Cell(190, 4, "", 0, 1, 'C');
        $pdf->Cell(85, 8, "Secretario - Registro ou Matricula", 0, 0, 'C');
        $pdf->Line(15, 281, 85, 281);
        $pdf->Cell(85, 8, "Diretor(a) - Registro ou Matricula", 0, 0, 'C');
        $pdf->Line(100, 281, 180, 281);
    }
    ///
    ///
}

$pdf->Output(utf8_decode('Histórico Escolar.pdf'), 'D');
//$pdf->Output(utf8_decode('Histórico Escolar.pdf'), 'I');
