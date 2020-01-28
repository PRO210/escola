<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RELATÓRIO DE ALUNOS </title>
        <style>
            td{
                border: black thin solid;
            }
            th{
                border: black thin solid;
            }
            table{
                border-collapse: collapse;
            }
        </style>           
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
        //
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
        $html .= "<td>Quantidade de Alunos:" . $quant2 . "</tr>";
        $html .= '</tr>';
        //
        $html .= '<tr>';
        $html .= '<td><b>Turma</b></td>';
        $html .= '<td><b>Nome</b></td>';
        $html .= '<td><b>NASCIDO</b></td>';
        $html .= '<td><b>IDADE</b></td>';
        if (!empty($_POST['titulos'])) {
            foreach (($_POST['titulos']) as $titulo) {
                if ($titulo == "inep") {
                    $html .= '<td>INEP</td>';
                } elseif ($titulo == "mae") {
                    $html .= '<td>MÃE</td>';
                } elseif ($titulo == "profissao_mae") {
                    $html .= '<td><b>PROFISSÃO DA MÃE</b></td>';
                } elseif ($titulo == "pai") {
                    $html .= '<td><b>PAI</b></td>';
                } elseif ($titulo == "profissao_pai") {
                    $html .= '<td><b>PROFISSÃO DA PAI</b></td>';
                } elseif ($titulo == "nis") {
                    $html .= '<td><b>NIS</b></td>';
                } elseif ($titulo == "bolsa_familia") {
                    $html .= '<td><b>BOLSA FAMÍLIA</b></td>';
                } elseif ($titulo == "sus") {
                    $html .= '<td><b>SUS</b></td>';
                } elseif ($titulo == "modelo_certidao") {
                    $html .= '<td><b>MODELO DA CERTIDÃO</b></td>';
                } elseif ($titulo == "matricula_certidao") {
                    $html .= '<td><b>MATRICULA DA CERTIDÃO</b></td>';
                } elseif ($titulo == "tipos_de_certidao") {
                    $html .= '<td><b>TIPOS DE CERTIDÃO</b></td>';
                } elseif ($titulo == "certidao_civil") {
                    $html .= '<td><b>CERTIDÃO</b></td>';
                } elseif ($titulo == "data_expedicao") {
                    $html .= '<td><b>EXPEDICÃO</b></td>';
                } elseif ($titulo == "naturalidade") {
                    $html .= '<td><b>NATURALIDADE</b></td>';
                    //
                } elseif ($titulo == "estado") {
                    $html .= '<td><b>ESTADO</b></td>';
                    //
                } elseif ($titulo == "nacionalidade") {
                    $html .= '<td><b>NACIONALIDADE</b></td>';
                    //
                } elseif ($titulo == "sexo") {
                    $html .= '<td><b>SEXO</b></td>';
                    //
                } elseif ($titulo == "endereco") {
                    $html .= '<td><b>ENDEREÇO</b></td>';
                    //
                } elseif ($titulo == "cidade") {
                    $html .= '<td><b>CIDADE ONDE MORA</b></td>';
                    //
                } elseif ($titulo == "estado_cidade") {
                    $html .= '<td><b>ESTADO ONDE MORA</b></td>';
                    //
                } elseif ($titulo == "necessidades") {
                    $html .= '<td><b>NECESSIDADES ESPECIAIS</b></td>';
                    //
                } elseif ($titulo == "especificidades") {
                    $html .= '<td><b>ESPECIFICIDADES</b></td>';
                    //
                } elseif ($titulo == "transporte") {
                    $html .= '<td><b>TRANSPORTE</b></td>';
                    //
                } elseif ($titulo == "urbano") {
                    $html .= '<td><b>URBANO</b></td>';
                    //
                } elseif ($titulo == "ponto_onibus") {
                    $html .= '<td><b>PONTO DE ÔNIBUS</b></td>';
                    //
                } elseif ($titulo == "motorista") {
                    $html .= '<td><b>MOTORISTA</b></td>';
                    //
                } elseif ($titulo == "motorista2") {
                    $html .= '<td><b>MOTORISTA 2</b></td>';
                    //
                } elseif ($titulo == "Data_matricula") {
                    $html .= '<td>DATA MATRICULA</td>';
                    //
                } elseif ($titulo == "data_renovacao_matricula") {
                    $html .= '<td><b>RENOVAÇÃO DA MATRICULA</b></td>';
                    //
                } elseif ($titulo == "declaracao") {
                    $html .= '<td><b>DECLARAÇÃO</b></td>';
                    //
                } elseif ($titulo == "data_declaracao") {
                    $html .= '<td><b>DATA DECLARAÇÃO</b></td>';
                    //
                } elseif ($titulo == "responsavel_declaracao") {
                    $html .= '<td><b>RESPONSÁVEL PELA DECLARAÇÃO</b></td>';
                    //
                } elseif ($titulo == "transferencia") {
                    $html .= '<td><b>TRANSFERÊNCIA</b></td>';
                    //
                } elseif ($titulo == "data_transferencia") {
                    $html .= '<td><b>DATA TRANSFERÊNCIA</b></td>';
                    //
                } elseif ($titulo == "responsavel_transferencia") {
                    $html .= '<td><b>TRANSFERÊNCIA PELA DECLARAÇÃO</b></td>';
                    //
                } elseif ($titulo == "obs") {
                    $html .= '<td><b>OBS</b></td>';
                    //
                } elseif ($titulo == "status") {
                    $html .= '<td><b>STATUS</b></td>';
                    //
                } elseif ($titulo == "resultado") {
                    $html .= '<td><b>RESULTADO</b></td>';
                    //
                } elseif ($titulo == "fone") {
                    $html .= '<td><b>FONE</b></td>';
                    //
                } elseif ($titulo == "fone2") {
                    $html .= '<td><b>FONE Nº2</b></td>';
                    //
                } elseif ($titulo == "professor") {
                    $html .= '<td><b>PROFESSOR(A)</b></td>';
                    $html .= '<td><b>PROFESSOR(A) EDU. FÍSICA</b></td>';
                } elseif ($titulo == "professor_aux") {
                    $html .= '<td><b>PROFESSOR(A) AUXILIAR</b></td>';
                    //
                } elseif ($titulo == "status_ext") {
                    $html .= '<td><b>OUVINTE</b></td>';
                    //
                } elseif ($titulo == "turma") {
                    $html .= '<td><b>TURMA</b></td>';
                    //
                } elseif ($titulo == "unico") {
                    $html .= '<td><b>ÚNICO</b></td>';
                    //
                } elseif ($titulo == "turno") {
                    $html .= '<td><b>TURNO</b></td>';
                }
            }
        } else {
            $html .= '<td><b>STATUS</b></td>';
        }
        //
        $html .= '</tr>';

        //Selecionar todos os itens da tabela 
        if (empty($_POST['aluno_selecionado'])) {
            header("LOCATION: montar_relatorio.php?id=2");
        }
        foreach (($_POST['aluno_selecionado']) as $lista_id) {
            $SQL_Consulta = " SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos WHERE `id` = '$lista_id' ORDER BY `nome` ASC ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $html .= '<tr>';
                //  $html .= '<td>' . $row_Consulta["inep"] . '</td>';
                $turmaf = $row_Consulta["turma"];
                $id_turma = $row_Consulta["turma"];
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                //
                $ano_turma = substr($Linha_turma["ano"], 0, -6);
                $nome_turma = $Linha_turma["turma"];
                $turno_turma = $Linha_turma["turno"];
                $turno_unico = $Linha_turma["unico"];
                $turmaf = "$nome_turma $turno_unico ($turno_turma)";
                //
                $html .= '<td>' . $turmaf . '</td>';
                $html .= '<td>' . $row_Consulta["nome"] . '</td>';
                $nascimento = date('d/m/Y ', strtotime($row_Consulta["data_nascimento"]));
                $html .= '<td>' . $nascimento . '</td>';
                $html .= '<td>' . $row_Consulta["idade"] . '</td>';
//              
                if (!empty($_POST['titulos'])) {
                    foreach (($_POST['titulos']) as $titulo) {

                        if ($titulo == "Data_matricula") {
                            $matricula = date('d/m/Y ', strtotime($row_Consulta["Data_matricula"]));
                            $html .= '<td>' . $matricula . '</td>';
                            //
                        } elseif ($titulo == "data_renovacao_matricula") {
                            $renovacao_matricula = date('d/m/Y ', strtotime($row_Consulta["data_renovacao_matricula"]));
                            $html .= '<td>' . $renovacao_matricula . '</td>';
                        } elseif ($titulo == "data_declaracao") {
                            $data_declaracao = date('d/m/Y ', strtotime($row_Consulta["data_declaracao"]));
                            $html .= '<td>' . $data_declaracao . '</td>';
                            //
                        } elseif ($titulo == "data_transferencia") {
                            $data_tranferencia = date('d/m/Y ', strtotime($row_Consulta["data_transferencia"]));
                            $html .= '<td>' . $data_tranferencia . '</td>';
                            //
                        } elseif ($titulo == "resultado") {
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
                            $html .= '<td> ' . $txt_bimetre_status . ' </td>';
                            //
                        } elseif ($titulo == "professor") {
                            $turmaf2 = $row_Consulta["turma"];
                            //
                            $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$turmaf2' AND `turmas_professor2`.id_professor = servidores.id";
                            $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
//
                            $nome_professores = "";
                            $nome_professores_fisica = "";
                            $aux_professores = "";
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
                                if ($ContLinhasAtestados > 0) {
                                    $dias = intval($linha_atestados['dias']);
                                    if ($dias >= 0) {
                                        $teste_folga = " Está de Atestado ";
                                    }
                                }
                                if ($substituta == "SIM") {
                                    $substituta = " - Substituto(a)";
                                } else {
                                    $substituta = "";
                                }
                                if ($projeto == "SIM") {
                                    $projeto_nome = " - " . $Linha_Professor["projeto_nome"];
                                } else {
                                    $projeto_nome = "";
                                }

                                //
                                if ($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] != 127) {
                                    $nome_professor = $Linha_Professor["nome"];
                                    $nome_professores .= "$nome_professor   " . $teste_folga . " " . $substituta . " " . $projeto_nome."; ";
                                    //
                                } elseif (($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] = 127)) {
                                    $nome_professor = $Linha_Professor["nome"];
                                    $nome_professores_fisica .= "$nome_professor   " . $teste_folga . " " . $substituta . " " . $projeto_nome."; ";
                                } else {
                                    $nome_aux_professor = $Linha_Professor["nome"];
                                    $aux_professores .= "$nome_aux_professor  " . $teste_folga . " " . $substituta . " " . $projeto_nome."; ";
                                }
                            }
                            $html .= '<td>' . $nome_professores . '</td>';
                            $html .= '<td>' . $nome_professores_fisica . '</td>';
                            $html .= '<td>' . $aux_professores . '</td>';
                            //
                        } elseif ($titulo == "turma") {
                            $html .= '<td>' . $nome_turma . '</td>';
                            //
                        } elseif ($titulo == "professor_aux") {
                            
                        } elseif ($titulo == "turma") {
                            $html .= '<td>' . $nome_turma . '</td>';
                            //
                        } elseif ($titulo == "unico") {
                            $html .= '<td>' . $turno_unico . '</td>';
                            //
                        } elseif ($titulo == "turno") {
                            $html .= '<td>' . $turno_turma . '</td>';
                            //
                        } else {
                            $html .= '<td>' . $row_Consulta["$titulo"] . '</td>';
                        }
                    }
                    //
                    $html .= '</tr>';
                } else {
                    $html .= '<td>' . $row_Consulta["status"] . '</td>';
                }
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
