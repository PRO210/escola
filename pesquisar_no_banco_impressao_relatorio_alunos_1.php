<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RELATÓRIO DE ALUNOS </title>
    </head>
    <body>
        <?php
        //Contagem dos Alunos
        if (empty($_POST['aluno_selecionado'])) {
            header("LOCATION: montar_relatorio.php?id=2");
        }
        $quant2 = 0;
        foreach (($_POST['aluno_selecionado']) as $lista_id) {
            $SQL_Consulta = " SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos WHERE `id` = '$lista_id' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $quant = 1;
                $quant2 += $quant;
            }
        }
        // Definimos o nome do arquivo que será exportado
        $arquivo = 'alunos.xls';
        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<td colspan = "4">ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>ALAGOINHA</tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= "<td >Quantidade de Alunos:" . $quant2 . "</tr>";
        $html .= '</tr>';


        $html .= '<tr>';
        // $html .= '<td><b>INEP</b></td>';
        $html .= '<td><b>FONE</b></td>';
        $html .= '<td><b>FONE-2</b></td>';
        $html .= '<td><b>Turma</b></td>';
        $html .= '<td><b>Nome</b></td>';
        $html .= '<td><b>NASCIDO</b></td>';
        $html .= '<td><b>IDADE</b></td>';
        $html .= '<td><b>MÃE</b></td>';
        // $html .= '<td><b>PROFISSÃO DA MÃE</b></td>';
        $html .= '<td><b>PAI</b></td>';
        // $html .= '<td><b>PROFISSÃO DO PAI</b></td>';
        $html .= '<td><b>NIS</b></td>';
        $html .= '<td><b>BOLSA FAMÍLIA</b></td>';
        $html .= '<td><b>SUS</b></td>';
        //  $html .= '<td><b>MODELO DA CERTIDÃO</b></td>';
        //  $html .= '<td><b>MATRICULA DA CERTIDÃO</b></td>';
        //  $html .= '<td><b>CERTIDÃO</b></td>';
        //  $html .= '<td><b>DADOS DA CERTIDÃO</b></td>';
        //  $html .= '<td><b>EXPEDIÇÃO </b></td>';
        //  $html .= '<td><b>NATURALIDADE</b></td>';
        //  $html .= '<td><b>ESTADO</b></td>';
        //   $html .= '<td><b>NACIONALIDADE</b></td>';
        $html .= '<td><b>SEXO</b></td>';
        $html .= '<td><b>ENDEREÇO</b></td>';
        // $html .= '<td><b>CIDADE</b></td>';
        //  $html .= '<td><b>ESTADO</b></td>';
        $html .= '<td><b>NECESSIDADES  ESPECIAIS</b></td>';
        $html .= '<td><b>TRANSPORTE</b></td>';
        $html .= '<td><b>URBANO</b></td>';
        $html .= '<td><b>PONTO DE ÔNIBUS</b></td>';
        $html .= '<td><b>MOTORISTA</b></td>';
        $html .= '<td><b>MOTORISTA II</b></td>';
        // $html .= '<td><b>MATRICULA</b></td>';
        //  $html .= '<td><b>RENOVAÇÃO DA MATRICULA</b></td>';
        $html .= '<td><b>DECLARAÇÃO</b></td>';
        $html .= '<td><b>DATA DECLARAÇÃO</b></td>';
        $html .= '<td><b>RESPONSÁVEL PELA DECLARAÇÃO</b></td>';
        $html .= '<td><b>TRANSFERÊNCIA</b></td>';
        $html .= '<td><b>DATA TRANSFERÊNCIA</b></td>';
        $html .= '<td><b>RESPONSÁVEL PELA TRANSFERÊNCIA</b></td>';
        $html .= '<td><b>OBS</b></td>';
        $html .= '<td><b>STATUS</b></td>';
        $html .= '<td><b>RESULTADO</b></td>';

        $html .= '</tr>';

        //Selecionar todos os itens da tabela 
        if (empty($_POST['aluno_selecionado'])) {
            header("LOCATION: montar_relatorio.php?id=2");
        }
        foreach (($_POST['aluno_selecionado']) as $lista_id) {
            $SQL_Consulta = " SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos WHERE `id` = '$lista_id' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $html .= '<tr>';
                $html .= '<td>' . $row_Consulta["fone"] . '</td>';
                $html .= '<td>' . $row_Consulta["fone2"] . '</td>';
                $turmaf = $row_Consulta["turma"];
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                //
                $ano_turma = substr($Linha_turma["ano"], 0, -6);
                $nome_turma = $Linha_turma["turma"];
                $turno_unico = $Linha_turma["unico"];
                $turno_turma = $Linha_turma["turno"];
                $turmaf = "$nome_turma $turno_unico ($turno_turma)";
                //
                $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano_turma'");
                $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                $linhaTeste = mysqli_num_rows($Consulta2);
                if ($linhaTeste > 0) {
                    $bimetre_status = $linhaConsulta2['status_bimestre_media'];

                    switch ($bimetre_status) {
                        case 1: $txt_bimetre_status = "CURSANDO";
                            break;
                        case 3: $txt_bimetre_status = "TRANSFERIDO";
                            break;
                        case 4: $txt_bimetre_status = "DESISTENTE";
                            break;
                        case 5: $txt_bimetre_status = "APROVADO";
                            break;
                        case 6: $txt_bimetre_status = "REPROVADO";
                            break;
                    }
                } else {
                    $txt_bimetre_status = "EM BRANCO";
                }
                //
                $html .= '<td>' . $turmaf . '</td>';
                $html .= '<td>' . $row_Consulta["nome"] . '</td>';
                $nascimento = date('d/m/Y ', strtotime($row_Consulta["data_nascimento"]));
                $html .= '<td>' . $nascimento . '</td>';
                $html .= '<td>' . $row_Consulta["idade"] . '</td>';
                $html .= '<td>' . $row_Consulta["mae"] . '</td>';
                //$html .= '<td>' . $row_Consulta["profissao_mae"] . '</td>';
                $html .= '<td>' . $row_Consulta["pai"] . '</td>';
                // $html .= '<td>' . $row_Consulta["profissao_pai"] . '</td>';
                $html .= '<td>' . $row_Consulta["nis"] . '</td>';
                $html .= '<td>' . $row_Consulta["bolsa_familia"] . '</td>';
                $html .= '<td>' . $row_Consulta["sus"] . '</td>';
//                $html .= '<td>' . $row_Consulta["modelo_certidao"] . '</td>';
//                $html .= '<td>' . $row_Consulta["matricula_certidao"] . '</td>';
//                $html .= '<td>' . $row_Consulta["tipos_de_certidao"] . '</td>';
//                $html .= '<td>' . $row_Consulta["certidao_civil"] . '</td>';
//                $html .= '<td>' . $row_Consulta["data_expedicao"] . '</td>';
//                $html .= '<td>' . $row_Consulta["naturalidade"] . '</td>';
//                $html .= '<td>' . $row_Consulta["estado"] . '</td>';
//                $html .= '<td>' . $row_Consulta["nacionalidade"] . '</td>';
                $html .= '<td>' . $row_Consulta["sexo"] . '</td>';
                $html .= '<td>' . $row_Consulta["endereco"] . '</td>';
//                $html .= '<td>' . $row_Consulta["cidade"] . '</td>';
//                $html .= '<td>' . $row_Consulta["estado_cidade"] . '</td>';
                $html .= '<td>' . $row_Consulta["necessidades"] . '</td>';
                $html .= '<td>' . $row_Consulta["transporte"] . '</td>';
                $html .= '<td>' . $row_Consulta["urbano"] . '</td>';
                $html .= '<td>' . $row_Consulta["ponto_onibus"] . '</td>';
                $html .= '<td>' . $row_Consulta["motorista"] . '</td>';
                $html .= '<td>' . $row_Consulta["motorista2"] . '</td>';
//                $matricula = date('d/m/Y ', strtotime($row_Consulta["Data_matricula"]));
//                $html .= '<td>' . $matricula . '</td>';
//                $renovacao_matricula = date('d/m/Y ', strtotime($row_Consulta["data_renovacao_matricula"]));
//                $html .= '<td>' . $renovacao_matricula . '</td>';
                $html .= '<td>' . $row_Consulta["declaracao"] . '</td>';
                $data_declaracao = date('d/m/Y ', strtotime($row_Consulta["data_declaracao"]));
                $html .= '<td>' . $data_declaracao . '</td>';
                $html .= '<td>' . $row_Consulta["responsavel_declaracao"] . '</td>';
                $html .= '<td>' . $row_Consulta["transferencia"] . '</td>';
                $data_tranferencia = date('d/m/Y ', strtotime($row_Consulta["data_transferencia"]));
                $html .= '<td>' . $data_tranferencia . '</td>';
                $html .= '<td>' . $row_Consulta["responsavel_transferencia"] . '</td>';
                $html .= '<td>' . $row_Consulta["obs"] . '</td>';
                $html .= '<td>' . $row_Consulta["status"] . '</td>';
                $html .= '<td>' . $txt_bimetre_status . '</td>';
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