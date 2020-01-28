<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
require './Excel/vendor/autoload.php'; //autoload do projeto
//

use PhpOffice\PhpSpreadsheet\Spreadsheet; //classe responsável pela manipulação da planilha
//
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //classe que salvará a planilha em .xlsx
//
use PhpOffice\PhpSpreadsheet\IOFactory; //classe responsável por ler uma planilha

//
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$ano = date('Y');

$colunas = array('id', 'inep', 'turma', 'turma_extra_aluno', 'status_extra_aluno', 'nome', 'data_nascimento', 'modelo_certidao', 'matricula_certidao', 'tipos_de_certidao',
    'certidao_civil', 'data_expedicao', 'naturalidade', 'estado', 'nacionalidade', 'sexo', 'nis', 'bolsa_familia', 'sus', 'pai', 'profissao_pai', 'mae', 'profissao_mae',
    'endereco', 'cidade', 'estado_cidade', 'transporte', 'urbano', 'ponto_onibus', 'motorista', 'motorista2', 'Data_matricula', 'data_renovacao_matricula',
    'data_matricula_update', 'declaracao', 'data_declaracao', 'responsavel_declaracao', 'transferencia', 'data_transferencia', 'responsavel_transferencia', 'data_censo',
    'data_valida_matricula', 'status', 'status_ext', 'excluido', 'ap_pasta', 'fone', 'fone2', 'obs', 'cor_raca', 'necessidades', 'especificidades');
//
$alfabetos = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AC',
    'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY');
$alfabetos_conts = array('AZ','BA', 'BB', 'BC');
$alfabetos_conts_prof = array('BD', 'BE', 'BF', 'BG','BH');
$alfabetos_tudo = array_merge($alfabetos, $alfabetos_conts, $alfabetos_conts_prof);
//Dimensiona as células na largura automática
foreach ($alfabetos_tudo as $value) {
    $sheet->getColumnDimension($value)->setAutoSize(true);
}
$spreadsheet->getActiveSheet()->getColumnDimension('AV')->setAutoSize(false);
$spreadsheet->getActiveSheet()->getColumnDimension('AY')->setAutoSize(false);


//
$ano = date('Y');
$query = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ORDER BY `alunos`.`turma` ASC, `alunos`.`nome` ASC");
$row = mysqli_num_rows($query);

$cont = 2;
while ($row = mysqli_fetch_array($query)) {

    foreach ($alfabetos as $key => $alfabeto) {

        $sheet->setCellValue($alfabeto . '1', $colunas[$key]);

        $coluna = $colunas[$key];
        if ($coluna == "data_nascimento" || $coluna == 'Data_matricula' || $coluna == 'data_matricula_update' || $coluna == 'data_declaracao' || $coluna == 'data_transferencia') {
            $sheet->setCellValue($alfabeto . $cont, date_format(new DateTime($row["$coluna"]), 'd/m/Y'));
        } elseif ($coluna == "turma") {
            $turmaf = $row['turma'];
            $Consulta_turma = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` = '$turmaf'");
            $Linha_turma = mysqli_fetch_array($Consulta_turma);
            $nome_turma = $Linha_turma["turma"];
            $turno_turma = $Linha_turma["turno"];
            $unico_turma = $Linha_turma["unico"];
            $turmaf = "$nome_turma $unico_turma ($turno_turma) ";
            //
            $sheet->setCellValue($alfabeto . $cont, $turmaf);
        } else {
            $sheet->setCellValue($alfabeto . $cont, $row["$coluna"]);
        }
    }
    //Turma separada //Turma separada//Turma separada
    foreach ($alfabetos_conts as $key2 => $alfabetos_cont) {

        $turmaf = $row['turma'];
        $Consulta_turma = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` = '$turmaf'");
        $Linha_turma = mysqli_fetch_array($Consulta_turma);
        $turma_titulo = array('TURMA', 'UNICO', 'TURNO', 'ANO');
        $turma = array($Linha_turma["turma"], $Linha_turma["unico"], $Linha_turma["turno"], date_format(new DateTime($Linha_turma["ano"]), 'Y'));
        //
        $sheet->setCellValue($alfabetos_cont . '1', $turma_titulo["$key2"]);
        $sheet->setCellValue($alfabetos_cont . $cont, $turma["$key2"]);
    }
    //Professores das respectivas turmas //Professores das respectivas turmas
    $turmaf2 = $row['turma'];
    //
    $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$turmaf2' AND `turmas_professor2`.id_professor = servidores.id";
    $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
//
    $nome_professores = "";
    $nome_professores2 = "";
    $nome_professores3 = "";
    $nome_professores_fisica = "";
    $aux_professores = "";
    $aux_professores2 = "";
    $ContLinhasProf = mysqli_num_rows($Consulta_professor);
//
    while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
        $nome_professor = $Linha_Professor["nome"];
        $funcao_professor = $Linha_Professor["funcao"];
        //
        $substituta = $Linha_Professor["substituta"];
        $projeto = $Linha_Professor["projeto"];
        $teste_folga = "";
        $teste_nome = $nome_professor;
        $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
        $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
        $ContLinhasAtestados = mysqli_num_rows($query_atestados);
//        if ($ContLinhasAtestados > 0) {
//            $dias = intval($linha_atestados['dias']);
//            if ($dias >= 0) {
//                $teste_folga = " Está de Atestado ";
//            }
//        }
//        if ($substituta == "SIM") {
//            $substituta = " - Substituto(a)";
//        } else {
//            $substituta = "";
//        }
//        if ($projeto == "SIM") {
//            $projeto_nome = " - " . $Linha_Professor["projeto_nome"];
//        } else {
//            $projeto_nome = "";
//        }
        //
        if ($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] != 127) {

            if ($substituta == "NAO" && $projeto == "NAO") {
                $nome_professor = $Linha_Professor["nome"];
                $nome_professores .= "$nome_professor";
                $sheet->setCellValue('BD' . $cont, $nome_professores);
                //
            } elseif ($substituta == "SIM") {
                $nome_professor = $Linha_Professor["nome"];
                $nome_professores2 .= "$nome_professor";
                $sheet->setCellValue('BG' . $cont, $nome_professores2);
                //
            } elseif ($projeto == "SIM") {
                $nome_professor = $Linha_Professor["nome"];
                $nome_professores3 .= "$nome_professor";
                $sheet->setCellValue('BH' . $cont, $nome_professores3);
            }
            //
        } elseif (($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] = 127)) {
            $nome_professor = $Linha_Professor["nome"];
            $nome_professores_fisica .= "$nome_professor";
            $sheet->setCellValue('BE' . $cont, $nome_professores_fisica);
        } else {
            if ($substituta == "SIM") {
                $nome_aux_professor = $Linha_Professor["nome"];
                $aux_professores .= "$nome_aux_professor";
                $sheet->setCellValue('BG' . $cont, $aux_professores);
                //
            } elseif ($projeto == "SIM") {
                $nome_professor = $Linha_Professor["nome"];
                $nome_professores3 .= "$nome_professor";
                $sheet->setCellValue('BH' . $cont, $nome_professores3);
                //
            } else {
                $nome_aux_professor = $Linha_Professor["nome"];
                $aux_professores2 .= "$nome_aux_professor ";
                $sheet->setCellValue('BF' . $cont, $aux_professores2);
            }
        }
        
        
        
    }
//
    $cont++;
}

$spreadsheet->getActiveSheet()->getStyle('BD1')->getAlignment()->setTextRotation(90);
$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(100);

$styleArray = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,        
       // 'textRotation' => 90,
        
    ],
];
$spreadsheet->getActiveSheet()->getStyle('A1:BH1')->applyFromArray($styleArray);
////$spreadsheet->getActiveSheet()->getStyle('A1:BE1')
////    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


$sheet->setCellValue('BD1', 'PROFESSOR(A)');
$sheet->setCellValue('BE1', 'PROFESSOR(A) EDU.FÍSICA');
$sheet->setCellValue('BF1', 'PROFESSOR(A) AUX.');
$sheet->setCellValue('BG1', 'PROFESSOR(A) SUBST.');
$sheet->setCellValue('BH1', 'PROFESSOR(A) PROJETO.');
////Border nas células
$styleArray2 = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '#000000'],
        ],
    ],
];
//Border nas células
for ($index = 1; $index <= $cont; $index++) {
    foreach ($alfabetos_tudo as $value) {
        $spreadsheet->getActiveSheet()->getStyle($value . $index)->applyFromArray($styleArray2);
    }
}

$filename = 'Alunos' . '.xlsx';
//
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
//
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//ob_end_clean();
$writer->save('php://output');
