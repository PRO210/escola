<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
    </head>
    <body>
        <?php
        //CONTA OS ALUNOS
        $quant2 = 0;
        foreach (($_POST['aluno_selecionado']) as $lista_id) {
            $SQL_Consulta = "SELECT alunos.*,alunos_solicitacoes.* FROM `alunos`,`alunos_solicitacoes` WHERE id_solicitacao = '$lista_id' AND id_aluno_solicitacao = alunos.id ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $quant = 1;
                $quant2 += $quant;
            }
        }
        // Definimos o nome do arquivo que será exportado
        $arquivo = 'Solicitações de Transferência.xls';
        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border = 1>';
        $html .= '<tr>';
        $html .= '<td colspan="2">ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>ALAGOINHA</tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= "<td>Quantidade de Alunos:" . $quant2 . "</tr>";
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>TURMA</b></td>';
        $html .= '<td><b>NOME</b></td>';
        $html .= '<td><b>NASCIDO</b></td>';
        $html .= '<td><b>SOLICITANTE</b></td>';
        $html .= '<td><b>SOLICITAÇÃO</b></td>';
        $html .= '<td><b>STATUS DA TRANSFERÊNCIA</td>';
        $html .= '<td><b>ENTREGUE/PRONTA</b></td>';
        $html .= '<td><b>DECLARAÇÃO</b></td>';
        $html .= '<td><b>DATA DECLARAÇÃO</b></td>';
        $html .= '<td><b>RESPONSÁVEL PELA DECLARAÇÃO</b></td>';
        $html .= '<td><b>TRANSFERÊNCIA</b></td>';
        $html .= '<td><b>DATA TRANSFERÊNCIA</b></td>';
        $html .= '<td><b>RESPONSÁVEL PELA TRANSFERÊNCIA</b></td>';
      //  $html .= '<td><b>OBS</b></td>';
        $html .= '<td><b>STATUS DO ALUNO</b></td>';

        $html .= '</tr>';

        //Selecionar todos os itens da tabela 
        foreach (($_POST['aluno_selecionado']) as $lista_id) {
            $SQL_Consulta = "SELECT alunos.*,alunos_solicitacoes.* FROM `alunos`,`alunos_solicitacoes` WHERE id_solicitacao = '$lista_id' AND id_aluno_solicitacao = alunos.id ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $html .= '<tr>';
                //
                $turmaf = $row_Consulta["turma"];
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                //
                $unico_turma = $Linha_turma["unico"];
                $nome_turma = $Linha_turma["turma"];
                $turno_turma = $Linha_turma["turno"];
                $turma = "$nome_turma $unico_turma ($turno_turma)";
                $html .= '<td>' . $turma . '</td>';
                $html .= '<td>' . $row_Consulta["nome"] . '</td>';
                $nascimento = date('d/m/Y ', strtotime($row_Consulta["data_nascimento"]));
                $html .= '<td>' . $nascimento . '</td>';
                $html .= '<td>' . $row_Consulta["solicitante"] . '</td>';
                $solicitacao = date('d/m/Y ', strtotime($row_Consulta["data_solicitacao"]));
                $html .= '<td>' . $solicitacao . '</td>';
//
                if ($entregue == "N") {
                    $entregue = "PENDENTE";
                    $html .= "<td>$entregue</td>\n";
                } elseif ($entregue == "S") {
                    $entregue = "ENTREGUE";
                    $html .= "<td>$entregue</td>\n";
                } else {
                    $entregue = "PRONTA";
                    $html .= "<td>$entregue</td>\n";
                }
                //
                 $data_entregue = date('d/m/Y ', strtotime($row_Consulta["data_entregue"]));
                $html .= '<td>' . $data_entregue . '</td>';
                $html .= '<td>' . $row_Consulta["declaracao"] . '</td>';
                $data_declaracao = date('d/m/Y ', strtotime($row_Consulta["data_declaracao"]));
                $html .= '<td>' . $data_declaracao . '</td>';
                $html .= '<td>' . $row_Consulta["responsavel_declaracao"] . '</td>';
                $html .= '<td>' . $row_Consulta["transferencia"] . '</td>';
                $data_tranferencia = date('d/m/Y ', strtotime($row_Consulta["data_transferencia"]));
                $html .= '<td>' . $data_tranferencia . '</td>';
                $html .= '<td>' . $row_Consulta["responsavel_transferencia"] . '</td>';
                //$html .= '<td>' . $row_Consulta["obs"] . '</td>';
                $html .= '<td>' . $row_Consulta["status"] . '</td>';

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
        header('Content-Disposition: attachment; filename=\"{$arquivo}"');
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        exit;
        ?>
    </body>
</html>