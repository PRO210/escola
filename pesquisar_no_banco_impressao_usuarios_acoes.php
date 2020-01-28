
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $quant2 = 0;
        if ($txt_option == 1) {

            foreach (($_POST['usuario_selecionado']) as $lista_id) {

                $SQL_Consulta = " SELECT * FROM log WHERE `id` = '$lista_id' ";
                $Consulta = mysqli_query($Conexao, $SQL_Consulta);

                while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                    $quant = 1;
                    $quant2 += $quant;
                }
            }
        } elseif ($txt_option == 2) {

            $SQL_Consulta = " SELECT * FROM log ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $quant = 1;
                $quant2 += $quant;
            }
        }
        ?>
        <?php
        if ($txt_option == 1) {
// Definimos o nome do arquivo que será exportado
            $arquivo = 'Ações dos Usuários.xls';

// Criamos uma tabela HTML com o formato da planilha
            $html = '';
            $html .= '<table border = 1>';
            $html .= '<tr>';
            $html .= '<td colspan = "2">ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</tr>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>ALAGOINHA</tr>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= "<td colspan = '2'>Quantidade de Alunos:" . $quant2 . "</tr>";
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><b>USUÁRIO</b></td>';
            $html .= '<td><b>AÇÃO</b></td>';
            $html .= '<td><b>DATA</b></td>';

            $html .= '</tr>';

//Selecionar todos os itens da tabela 
            foreach (($_POST['usuario_selecionado']) as $lista_id) {

                $SQL_Consulta = " SELECT * FROM log WHERE `id` = '$lista_id' ";
                $Consulta = mysqli_query($Conexao, $SQL_Consulta);

                while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {

                    $html .= '<tr>';
                    //  $html .= '<td>' . $row_Consulta["id"] . '</td>';
                    $html .= '<td>' . $row_Consulta["usuario"] . '</td>';
                    $html .= '<td>' . $row_Consulta["acao"] . '</td>';
                    $nascimento = date('d/m/Y ', strtotime($row_Consulta["data"]));
                    $html .= '<td>' . $nascimento . '</td>';

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
        } elseif ($txt_option == 2) {
            // Definimos o nome do arquivo que será exportado
            $arquivo = 'Ações dos Usuários.xls';

// Criamos uma tabela HTML com o formato da planilha
            $html = '';
            $html .= '<table border = 1>';
            $html .= '<tr>';
            $html .= '<td colspan = "2" >ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td>ALAGOINHA</td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= "<td colspan = '2'>Quantidade de Alunos:" . $quant2 . "</tr>";
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td><b>USUÁRIO</b></td>';
            $html .= '<td><b>AÇÃO</b></td>';
            $html .= '<td><b>DATA</b></td>';
            $html .= '</tr>';

//Selecionar todos os itens da tabela 

            $SQL_Consulta = " SELECT * FROM log ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $html .= '<tr>';
                //  $html .= '<td>' . $row_Consulta["id"] . '</td>';
                $html .= '<td>' . $row_Consulta["usuario"] . '</td>';
                $html .= '<td>' . $row_Consulta["acao"] . '</td>';
                $nascimento = date('d/m/Y ', strtotime($row_Consulta["data"]));
                $html .= '<td>' . $nascimento . '</td>';

                $html .= '</tr>';
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
        }
        ?>
    </body>
</html>
