<?php

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");


require './Excel/vendor/autoload.php'; //autoload do projeto

use PhpOffice\PhpSpreadsheet\Spreadsheet; //classe responsável pela manipulação da planilha
//
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //classe que salvará a planilha em .xlsx
//
use PhpOffice\PhpSpreadsheet\IOFactory; //classe responsável por ler uma planilha

//
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$hoje = date('Y-m-d');
//
$colunas = array('turma_id', 'pago', 'mensalidade', 'desconto', 'multa', 'bolsista', 'bolsista_valor', 'data_pagamento', 'pago_em');
//
$alfabetos = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I');
//
$ids = "";
foreach (($_POST['aluno_selecionado']) as $value) {
    $ids .= $value . ',';
}
$id = substr($ids, 0, -1);
//$query = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ORDER BY `alunos`.`turma` ASC, `alunos`.`nome` ASC");
$query = mysqli_query($Conexao, "SELECT * FROM `alunos_pagamentos` WHERE `id` IN ($id)");
$row = mysqli_num_rows($query);
$row_aluno_id = mysqli_fetch_array($query);
$aluno_id  = $row_aluno_id['aluno_id'];
//
$query_alunos = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` IN ($aluno_id)");
$row_alunos = mysqli_fetch_array($query_alunos);
$nome = $row_alunos['nome'];

//Dimensiona as células na largura automática
foreach ($alfabetos as $value) {
    $sheet->getColumnDimension($value)->setAutoSize(true);
}
//
$styleArray = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    // 'textRotation' => 90,
    ],
];
$spreadsheet->getActiveSheet()->getStyle('A2:I100')->applyFromArray($styleArray);

//
foreach ($alfabetos as $key => $alfabeto) {
    $sheet->setCellValue($alfabeto . '2', $colunas[$key]);
}
//
$sheet->setCellValue('A1', $nome);
$spreadsheet->getActiveSheet()->mergeCells('A1:B1');
$spreadsheet->getActiveSheet()->getStyle('A1:B1')->applyFromArray($styleArray);
//
$cont = 3;
while ($row = mysqli_fetch_array($query)) {
//
    foreach ($alfabetos as $key => $alfabeto) {
//        $sheet->setCellValue($alfabeto . '1', $colunas[$key]);
        $coluna = $colunas[$key];
        if ($coluna == "data_pagamento" || $coluna == 'pago_em') {
            //
            if ($row["$coluna"] == "0000-00-00") {
                $sheet->setCellValue($alfabeto . $cont, '00-00-0000');
            } else {
                $sheet->setCellValue($alfabeto . $cont, date_format(new DateTime($row["$coluna"]), 'd-m-Y'));
            }
            //
        } elseif ($coluna == "turma_id") {
            $turmaf = $row['turma_id'];
            $Consulta_turma = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` = '$turmaf'");
            $Linha_turma = mysqli_fetch_array($Consulta_turma);
            $nome_turma = $Linha_turma["turma"];
            $turno_turma = $Linha_turma["turno"];
            $unico_turma = $Linha_turma["unico"];
            $ano_turma = substr($Linha_turma["ano"], 0, -6);
            $turmaf = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
            //
            $sheet->setCellValue($alfabeto . $cont, $turmaf);
        } else {
            $sheet->setCellValue($alfabeto . $cont, $row["$coluna"]);
        }
    }
    //
    $cont++;
}
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
for ($index = 2; $index < $cont; $index++) {
    foreach ($alfabetos as $value) {
        $spreadsheet->getActiveSheet()->getStyle($value . $index)->applyFromArray($styleArray2);
    }
}
//
$filename = 'Boletos' . '.xlsx';
//
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
//
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//ob_end_clean();
$writer->save('php://output');
