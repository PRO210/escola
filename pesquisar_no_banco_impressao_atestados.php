<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
        $Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
        $Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
        $inep = $Registro["inep"];
        $escola_nome = $Registro["nome"];
// Definimos o nome do arquivo que será exportado
        $arquivo = 'Atestados.xls';

// Criamos uma tabela HTML com o formato da planilha
        if (empty($_POST['servidor_selecionado'])) {
            header("LOCATION: montar_relatorio_atestados_etc.php?id=2");
        }
        $html = '';
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<td colspan = "3" ><b>ATESTADOS DOS SERVIDORES</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>PERÍODO/DATA</b></td>';
        $html .= '<td><b>Nº DE DIAS</b></td>';
        // $html .= '<td><b>HORA/AULA</b></td>';
        // $html .= '<td><b>TOTAL DE AULAS</b></td>';
        $html .= '<td><b>NOME DO SUBSTITUTO</b></td>';
        $html .= '<td><b>MOTIVO DA SUBSTITUIÇÃO</b></td>';
        $html .= '<td><b>NOME DO FUNCIONÁRIO</b></td>';
        $html .= '<td><b>FUNÇÃO</b></td>';
        $html .= '<td><b>ESCOLA</b></td>';
        $html .= '<td><b>DIAS LETIVOS</b></td>';
        $html .= '<td><b>REMUNERADO</b></td>';

        $html .= '</tr>';

//Selecionar todos os itens da tabela 
        foreach (($_POST['servidor_selecionado']) as $lista_id) {

            $SQL_Consulta = " SELECT * FROM atestados_servidor WHERE `id` = '$lista_id' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {

                $html .= '<tr>';
                $inicio = new DateTime($row_Consulta["inicio"]);
                $inicio = date_format($inicio, "d/m/Y");
                $fim = new DateTime($row_Consulta["fim"]);
                $fim = date_format($fim, "d/m/Y");
                if ($row_Consulta["tempo"] == "1") {
                    $fim = "";
                    $as = '';
                } else {
                    $as = ' à';
                }
                // $html .= '<td>' . $inicio . $as . '<br>' . $fim . '</td>';
                $html .= '<td>' . $inicio . $as . $fim . '</td>';
                //
                $inicio2 = $row_Consulta["inicio"];
                $fim2 = $row_Consulta["fim"];
                $cont_tempo = 0;
                $cont_inicio = 1;
                $result = mysqli_query($Conexao, "SELECT * FROM `dia_mes_ano` WHERE `d_m_a` >= '$inicio2' AND d_m_a <= '$fim2'");
                while ($linhas = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                    $dia_nome = $linhas['dias_nome'];
                    if ($dia_nome !== "sabado" && $dia_nome !== "domingo") {
                        $cont_tempo = $cont_inicio++;
                    }
                }

                $html .= '<td>' . $row_Consulta['tempo'] . '</td>';
                //$html .= '<td>' . $row_Consulta["hora_aula"] . '</td>';
                //
                $inputSeg = $row_Consulta["seg"];
                $inputTer = $row_Consulta["ter"];
                $inputQua = $row_Consulta["qua"];
                $inputQui = $row_Consulta["qui"];
                $inputSex = $row_Consulta["sex"];
                $Contseg = 0;
                $Contter = 0;
                $Contqua = 0;
                $Contqui = 0;
                $Contsex = 0;
                //
                if ($row_Consulta["hora_aula"] == "SIM") {
                    //
                    $inicio = $row_Consulta["inicio"];
                    $fim = $row_Consulta["fim"];
                    $sql = "SELECT * FROM `dia_mes_ano` WHERE `d_m_a` >= '$inicio' AND d_m_a <= '$fim'";

                    $result = mysqli_query($Conexao, $sql);
                    $cont_linhas = mysqli_num_rows($result);

                    if ($cont_linhas > 0) {
                        $quant = 1;
                        $seg = 1;
                        $ter = 1;
                        $qua = 1;
                        $qui = 1;
                        $sex = 1;
                        //
                        while ($colunas = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            //                       
                            $dia_nome = $colunas['dias_nome'];
                            //$dia_numero = $colunas['dias_numero'];
                            $mes = $colunas['m'];
                            $ano = $colunas['ano'];
                            //
                            $quant2 = $quant++;
                            //
                            if ($dia_nome == "seg") {
                                $Contseg = $seg++;
                                //
                            } elseif ($dia_nome == "ter") {
                                $Contter = $ter++;
                                //
                            } elseif ($dia_nome == "qua") {
                                $Contqua = $qua++;
                                //
                            } elseif ($dia_nome == "qui") {
                                $Contqui = $qui++;
                            } elseif ($dia_nome == "sex") {
                                $Contsex = $sex++;
                            }
                        }
                    }
                    //
                    $Total = $Contseg * $inputSeg + $Contter * $inputTer + $Contqua * $inputQua + $Contqui * $inputQui + $Contsex * $inputSex;
                    //$html .= '<td>' . $Contseg . '-' . $Contter . '-' . $Contqua . '-' . $Contqui . '-' . $Contsex . 'Total = '.$Total.'</td>';
                    //  $html .= '<td>' . $Total . '</td>';
                    //
                } else {
                    //  $html .= '<td>----</td>';
                }

                $html .= '<td>' . $row_Consulta["substituto"] . '</td>';
                if ($row_Consulta["tipo"] == "OUTROS") {
                    $tipo = $row_Consulta["outros"];
                } else {
                    $tipo = $row_Consulta["tipo"];
                }
                $html .= '<td>' . $tipo . '</td>';
                $html .= '<td>' . $row_Consulta["servidor"] . '</td>';
                $recebido = new DateTime($row_Consulta["recebido"]);
                $recebido = date_format($recebido, "d/m/Y");
                $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                $escola_nome = "ESC. MUN. TABELIÃO RAUL GAL. SOBRINHO";
                $html .= '<td>' . $escola_nome . '</td>';
                $html .= '<td>' . $cont_tempo . '</td>';
                $html .= '<td>' . $row_Consulta['remuneracao'] . '</td>';

                $html .= '</tr>';
            }
        }
        $html .= '<tr>';
        $html .= '<td colspan = "7" >Responsável pela Informação: </td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan = "7" >Data: </td>';
        $html .= '</tr>';
        $html .= '</table>';
// Configurações header para forçar o download
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment;filename = \"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
// Envia o conteúdo do arquivo
        echo $html;
        exit;
        ?>
    </body>
</html>