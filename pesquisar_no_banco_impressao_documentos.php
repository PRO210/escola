<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>    
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
// Definimos o nome do arquivo que será exportado
        $arquivo = 'Documentos Emprestados.xls';
// Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border = 1>';
        $html .= '<tr>';
        $html .= '<td colspan = "2" ><b>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>Documentos Emprestados</b></tr>';
        $html .= '<td colspan = "15" ><b></b></tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>NOME</b></td>';
        $html .= '<td><b>NASCIMENTO</b></td>';
        $html .= '<td><b>TIPOS DE CERTIDÃO</b></td>';
        $html .= '<td><b>CERTIDÃO</b></td>';
        $html .= '<td><b>EXPEDIÇÃO</b></td>';
        $html .= '<td><b>CPF</b></td>';
        $html .= '<td><b>CELULAR</b></td>';
        $html .= '<td><b>DOCUMENTOS</b></td>';
        $html .= '<td><b>EMPRESTADO</b></td>';
        $html .= '<td><b>DEVOLUÇÃO</b></td>';
        $html .= '<td><b>DEVOLVIDO</b></td>';
        $html .= '<td><b>DATA/DEVOLUÇÃO/ATRASADA</b></td>';

        $html .= '</tr>';

//Selecionar todos os itens da tabela 
        foreach (($_POST["pessoas_selecionadas"]) as $lista_id) {
            $SQL_Consulta = " SELECT * FROM documentos_emprestados WHERE `id` = '$lista_id' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $html .= '<tr>';

                $html .= '<td>' . $row_Consulta["nome"] . '</td>';
                $nascimento = date('d/m/Y ', strtotime($row_Consulta["nascimento"]));
                $html .= '<td>' . $nascimento . '</td>';
                $html .= '<td>' . $row_Consulta["tipos_de_certidao"] . '</td>';
                $html .= '<td>' . $row_Consulta["certidao"] . '</td>';
                $data_expedicao = date('d/m/Y ', strtotime($row_Consulta["expedicao"]));
                $html .= '<td>' . $data_expedicao . '</td>';
                $html .= '<td>' . $row_Consulta["cpf"] . '</td>';
                $html .= '<td>' . $row_Consulta["celular"] . '</td>';
                $html .= '<td>' . $row_Consulta["documentos"] . '</td>';

                $emprestado = date('d/m/Y ', strtotime($row_Consulta["emprestado"]));
                $html .= '<td>' . $emprestado . '</td>';

                $devolucao = date('d/m/Y ', strtotime($row_Consulta["devolucao"]));
                $html .= '<td>' . $devolucao . '</td>';

                $html .= '<td>' . $row_Consulta["devolvidosim"] . '</td>';

                $devolvido = date('d/m/Y ', strtotime($row_Consulta["devolvido"]));
                $html .= '<td>' . $devolvido . '</td>';

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