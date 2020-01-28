<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>SUBSTITUIÇÕES</title>
    </head>
    <body>
        <?php
// Definimos o nome do arquivo que será exportado
        $arquivo = 'Substituições.xls';

// Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<td colspan = "2"><b>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan = "2" ><b>Substituição dos Servidores</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan = "9"><b></b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';


        $html .= '<td><b>PERÍODO</b></td>';
        $html .= '<td><b>N° DE DIAS</b></td>';
        $html .= '<td><b>NOME DO SUBSTITUTO</b></td>';
        $html .= '<td><b>MOTIVO</b></td>';
        $html .= '<td><b>NOME DO SERVIDOR</b></td>';
        $html .= '<td><b>FUNÇÃO</b></td>';
        $html .= '<td><b>ESCOLA</b></td>';
        $html .= '<td><b>REMUNERADO</b></td>';
        $html .= '<td><b>ENVIADO</b></td>';
        $html .= '<td><b>ENVIADO EM</b></td>';

        $html .= '</tr>';

//Selecionar todos os itens da tabela 
        foreach (($_POST['servidor_selecionado']) as $lista_id) {
            $SQL_Consulta = " SELECT * FROM substituicoes WHERE `id` = '$lista_id' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {



                $html .= '<tr>';
                $inicio = new DateTime($row_Consulta["inicio"]);
                $inicio = date_format($inicio, "d/m/Y");
                $html .= '<td>' . $inicio . '</td>';
                $html .= '<td>' . $row_Consulta["tempo"] . '</td>';
                $html .= '<td>' . $row_Consulta["substituto"] . '</td>';
                $html .= '<td>  PESSOAL </td>';
                $html .= '<td>' . $row_Consulta["servidor"] . '</td>';
                $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                $html .= '<td> LUIZ CELSO GALINDO </td>';
                $html .= '<td>' . $row_Consulta["remuneracao"] . '</td>';
                $html .= '<td>' . $row_Consulta["enviado"] . '</td>';
                $data_envio = new DateTime($row_Consulta["data_envio"]);
                $data_envio = date_format($data_envio, "d/m/Y");
                $html .= '<td>' . $data_envio . '</td>';

                $html .= '</tr>';
            }
        }
        $html .= '</table>';
// Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
// Envia o conteúdo do arquivo
        echo $html;
        exit;
        ?>

    </body>
</html>