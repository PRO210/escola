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
        $Total_Nomes = "";
        $html = '';
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<td colspan = "3" ><b>ATESTADOS  DOS  PROFESSORES  HORA/AULA </b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>PERÍODO/DATA</b></td>';
        $html .= '<td><b>DIA DA SEMANA</b></td>';
        $html .= '<td><b>AULAS</b></td>';
        $html .= '<td><b>NOME DO SUBSTITUTO</b></td>';
        $html .= '<td><b>MOTIVO DA SUBSTITUIÇÃO</b></td>';
        $html .= '<td><b>NOME DO FUNCIONÁRIO</b></td>';
        $html .= '<td><b>FUNÇÃO</b></td>';
        $html .= '<td><b>ESCOLA</b></td>';

        //Selecionar todos os itens da tabela 
        foreach (($_POST['servidor_selecionado']) as $lista_id) {

            $SQL_Consulta = " SELECT * FROM atestados_servidor WHERE `id` = '$lista_id' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {

                $inicio = new DateTime($row_Consulta["inicio"]);
                $inicio = date_format($inicio, "d/m/Y");
                //$html .= '<td>' . $inicio . '</td>';
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
                    $substituto = $row_Consulta["substituto"];
                    $sql = "SELECT * FROM `dia_mes_ano` WHERE `d_m_a` >='$inicio' AND d_m_a <= '$fim'";

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
                            //  $dia_numero = $colunas['dias_numero'];
                            // $d_m_a =$colunas['d_m_a'];
                            $d_m_a = date_format(new DateTime($colunas['d_m_a']), "d/m/Y");
                            //$mes = $colunas['m'];
                            $ano = $colunas['ano'];
                            //
                            $quant2 = $quant++;
                            //
                            if ($dia_nome == "seg") {
                                $html .= '<tr>';
                                $Contseg = $seg++;
                                $dia_nome = "Segunda-Feira";
                                $html .= '<td>' . $d_m_a . '</td>';
                                $html .= '<td>' . $dia_nome . '</td>';
                                $html .= '<td>' . $inputSeg . '</td>';
                                $html .= '<td>' . $row_Consulta["substituto"] . '</td>';
                                //$html .= '<td>' . $row_Consulta["tipo"] . '</td>';
                                $html .= '<td>-----</td>';
                                $html .= '<td>' . $row_Consulta["servidor"] . '</td>';
                                $recebido = new DateTime($row_Consulta["recebido"]);
                                $recebido = date_format($recebido, "d/m/Y");
                                $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                                $html .= '<td>ESCOLA MUNICIPAL RAUL GALINDO SOBRINHO </td>';
                                $html .= '</tr>';
                                //
                            } elseif ($dia_nome == "ter") {
                                $Contter = $ter++;
                                $html .= '<tr>';
                                $dia_nome = "Terça-Feira";
                                $html .= '<td>' . $d_m_a . '</td>';
                                $html .= '<td>' . $dia_nome . '</td>';
                                $html .= '<td>' . $inputTer . '</td>';
                                $html .= '<td>' . $row_Consulta["substituto"] . '</td>';
                                //$html .= '<td>' . $row_Consulta["tipo"] . '</td>';
                                $html .= '<td>-----</td>';
                                $html .= '<td>' . $row_Consulta["servidor"] . '</td>';
                                $recebido = new DateTime($row_Consulta["recebido"]);
                                $recebido = date_format($recebido, "d/m/Y");
                                $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                                $html .= '<td>ESCOLA MUNICIPAL RAUL GALINDO SOBRINHO </td>';
                                $html .= '</tr>';
                                //
                            } elseif ($dia_nome == "qua") {
                                $Contqua = $qua++;
                                $html .= '<tr>';
                                $dia_nome = "Quarta-Feira";
                                $html .= '<td>' . $d_m_a . '</td>';
                                $html .= '<td>' . $dia_nome . '</td>';
                                $html .= '<td>' . $inputQua . '</td>';
                                $html .= '<td>' . $row_Consulta["substituto"] . '</td>';
                                //$html .= '<td>' . $row_Consulta["tipo"] . '</td>';
                                $html .= '<td>-----</td>';
                                $html .= '<td>' . $row_Consulta["servidor"] . '</td>';
                                $recebido = new DateTime($row_Consulta["recebido"]);
                                $recebido = date_format($recebido, "d/m/Y");
                                $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                                $html .= '<td>ESCOLA MUNICIPAL RAUL GALINDO SOBRINHO </td>';
                                $html .= '</tr>';
                                //
                            } elseif ($dia_nome == "qui") {
                                $Contqui = $qui++;
                                $html .= '<tr>';
                                $dia_nome = "Quinta-Feira";
                                $html .= '<td>' . $d_m_a . '</td>';
                                $html .= '<td>' . $dia_nome . '</td>';
                                $html .= '<td>' . $inputQui . '</td>';
                                $html .= '<td>' . $row_Consulta["substituto"] . '</td>';
                                //$html .= '<td>' . $row_Consulta["tipo"] . '</td>';
                                $html .= '<td>-----</td>';
                                $html .= '<td>' . $row_Consulta["servidor"] . '</td>';
                                $recebido = new DateTime($row_Consulta["recebido"]);
                                $recebido = date_format($recebido, "d/m/Y");
                                $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                                $html .= '<td>ESCOLA MUNICIPAL RAUL GALINDO SOBRINHO </td>';
                                $html .= '</tr>';
                            } elseif ($dia_nome == "sex") {
                                $Contsex = $sex++;
                                $html .= '<tr>';
                                $dia_nome = "Sexta-Feira";
                                $html .= '<td>' . $d_m_a . '</td>';
                                $html .= '<td>' . $dia_nome . '</td>';
                                $html .= '<td>' . $inputSex . '</td>';
                                $html .= '<td>' . $row_Consulta["substituto"] . '</td>';
                                // $html .= '<td>' . $row_Consulta["tipo"] . '</td>';
                                $html .= '<td>-----</td>';
                                $html .= '<td>' . $row_Consulta["servidor"] . '</td>';
                                $recebido = new DateTime($row_Consulta["recebido"]);
                                $recebido = date_format($recebido, "d/m/Y");
                                $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                                $html .= '<td>' . $escola_nome . '</td>';
                              
                                $html .= '</tr>';
                            }
                        }
                    }
                    //                  
                    $Total = $Contseg * $inputSeg + $Contter * $inputTer + $Contqua * $inputQua + $Contqui * $inputQui + $Contsex * $inputSex;
                    //$html .= '<td>' . $Contseg . '-' . $Contter . '-' . $Contqua . '-' . $Contqui . '-' . $Contsex . 'Total = '.$Total.'</td>';
                    $Total_Nomes .= $substituto . ' =  ' . $Total . '<br>';
                    //
                }
            }
        }
        $html .= '<tr>';
        $html .= '<td colspan="2">TOTAL DE AULAS</td>';
        $html .= '<td colspan="6"> ' . $Total_Nomes . '</td>';
        $html .= '</tr>';
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