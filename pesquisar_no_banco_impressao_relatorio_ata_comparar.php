<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ATA EM EXCEL</title>   
    </head>
    <body>
        <?php
        //Consulta O Nome da Escola
        $Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
        $Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
        $inep = $Registro["inep"];
        $escola_nome = $Registro["nome"];
        $escola_cidade = $Registro["cidade"];
        //
        $ids = "";
        $ConsultaV = mysqli_query($Conexao, "SELECT turma_backup.*,turmas.turma,turmas.unico FROM `turma_backup`,turmas WHERE turma_backup.id_turma = turmas.id AND turma_backup.ano ='$ano_anterior' ORDER BY `turmas`.`turma` ASC,`turmas`.`unico` ASC ");
        while ($linhaV = mysqli_fetch_array($ConsultaV)) {
            $ids .= $linhaV['ids'] . ",";
        }
        $id = explode(",", $ids);
        $Qarray_Antigo = array();
        foreach ($id as $value) {
            $Qarray_Antigo [] = $value;
        }
        echo "<br>";
        $idsAtual = "";
        $ConsultaV = mysqli_query($Conexao, "SELECT turma_backup.*,turmas.turma,turmas.unico FROM `turma_backup`,turmas WHERE turma_backup.id_turma = turmas.id AND turma_backup.ano ='$ano' ORDER BY `turmas`.`turma` ASC,`turmas`.`unico` ASC");
        while ($linhaV = mysqli_fetch_array($ConsultaV)) {
            $idsAtual .= $linhaV['ids'] . ",";
        }
        $idAtual = explode(",", $idsAtual);
        $Qarray_Atual = array();
        foreach ($idAtual as $value) {
            $Qarray_Atual [] = $value;
        }
        $result = array_intersect($Qarray_Antigo, $Qarray_Atual);
        //  print_r($Qarray_Antigo) . "<br>";
        echo "<br>";
        echo "<br>";
        // print_r($Qarray_Atual) . "<br>";
        echo "<br>";
        echo "<br>";
        // print_r($result) . "<br>";

        echo "<br>";

        // exit();
        // Definimos o nome do arquivo que será exportado
        $arquivo = 'alunos.xls';
        // Criamos uma tabela HTML com o formato da planilha  
        $html = '';

        $html .= '<table>';       
        $html .= '<tr>';
        $html .= "<td colspan = '12'><p>Analise Comparativa de Resultados Finais do Rendimento Escolar Referente aos Anos Letivos de " . $ano_anterior . " e " . "$ano" . "</p></tr>";
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= "<td colspan = '12'></tr>";
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= "<th> NOMES</th>";
        //
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `arf` = 'S' ORDER BY arf_ord");
        //
        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
            //
            $disciplina = $linha['disciplina'];
            $id = $linha['id'];
            if ($disciplina == "PORTUGUÊS") {
                $html .= "<th> $disciplina </th>";
            } elseif ($disciplina == "INGLÊS") {
                //$disciplina = "INGLÊS OU<br>ESPANHOL";
            } elseif ($disciplina == "ED. FÍSICA") {
                $html .= "<th> $disciplina </th>";
            } elseif ($disciplina == "RELIGIÃO") {
                $html .= "<th> $disciplina </th>";
            } elseif ($disciplina == "DIREITO DA<br>CIDADANIA") {
                // $disciplina = "DIREITO DA <br>CIDADANIA";
            } elseif ($disciplina == "INFORMÁTICA") {
                // $disciplina = "DIREITO DA <br>CIDADANIA";
            } elseif ($disciplina == "REDAÇÃO") {
                // $disciplina = "DIREITO DA <br>CIDADANIA";
            } elseif ($disciplina == "DHC") {
                // $disciplina = "DIREITO DA <br>CIDADANIA";
            } elseif ($disciplina == "MATEMÁTICA") {
                $html .= "<th> $disciplina </th>";
            } elseif ($disciplina == "HISTÓRIA") {
                $html .= "<th> $disciplina </th>";
            } elseif ($disciplina == "GEOGRAFIA") {
                $html .= "<th> $disciplina </th>";
            } elseif ($disciplina == "CIÊNCIAS") {
                $html .= "<th> $disciplina </th>";
            } elseif ($disciplina == "ARTE") {
                $html .= "<th> $disciplina </th>";
            }
        }
        $html .= "<th> TOTAL DE HORAS <BR> LETIVAS</th>";
        $html .= "<th> FREQUÊNCIA <BR>DO ALUNO </th>";
        $html .= "<th> RESULTADO<BR>FINAL </th>";
        $html .= "<th> RESULTADO<BR>FINAL APÓS<BR> RECUPERAÇÃO</th>";
        $html .= '</tr>';
        //Selecionar todos os itens da tabela 
        $cont = 0;
        foreach ($result as $lista_id) {

            $Consulta3 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND disciplinas.id = `id_bimestre_media_disciplina` AND `arf` = 'S' ORDER BY arf_ord ");
            $ContLinhas3 = mysqli_num_rows($Consulta3);
            $linhaConsulta3 = mysqli_fetch_array($Consulta3, MYSQLI_BOTH);
            $recupera = $linhaConsulta3['bimestre_recupera'];
            //
            $Consulta = mysqli_query($Conexao, "SELECT nome FROM `alunos` WHERE `id` = '$lista_id' ");
            $linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
            $nome = $linhaConsulta['nome'];
            //
            if ($ContLinhas3 > 0) {
                //
                if ($recupera == "N") {
                    //No caso dos alunos passarem por média
                    $html .= "<td class = 'nome'> $nome </td>";
                    //
                    $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND disciplinas.id = `id_bimestre_media_disciplina` AND `arf` = 'S' ORDER BY arf_ord ");
                    $ContLinhas = mysqli_num_rows($Consulta2);
                    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                        //
                        if ($linhaConsulta2['disciplina'] == ("DHC" ) || $linhaConsulta2['disciplina'] == ("EDUCAÇÃO ARTÍSTICA" )) {
                            //$html . = "<th class = 'nome'>  </th>";
                        } elseif ($linhaConsulta2['disciplina'] == ("DIREITO DA CIDADANIA") || $linhaConsulta2['disciplina'] == ("INFORMÁTICA" )) {
                            // $html . = "<th class = 'nome'>---</th>";
                        } elseif ($linhaConsulta2['disciplina'] == ("REDAÇÃO")) {
                            //
                            $horas = $linhaConsulta2['aluno'];
                            $html .= "<th class = 'nome'> $horas </th>";
                            $frequencia = $linhaConsulta2['frequencia'];
                            $html .= "<th class = 'nome'> $frequencia %</th>";
                            $nota = $linhaConsulta2['status_bimestre_media'];
                            //     
                            if ($nota == "3") {
                                $nota = "TRANSFERIDO";
                            } elseif ($nota == "4") {
                                $nota = "DESISTENTE";
                            } elseif ($nota == "5") {
                                $nota = "APROVADO";
                            } elseif ($nota == "6") {
                                $nota = "REPROVADO";
                            } else {
                                $nota = "CURSANDO";
                            }
                            $html .= "<th class = 'nome'> $nota </th>";
                            //
                        } elseif ($linhaConsulta2['disciplina'] == ("INGLÊS")) {
                            $nota = str_replace(".", ",", $linhaConsulta2['nota']);
                            // $html . = "<th class = 'nome'> $nota </th>";
                        } else {
                            $nota = str_replace(".", ",", $linhaConsulta2['nota']);
                            $html .= "<th class = 'nome'> $nota </th>";
                        }
                    }
                    $html .= "<th class = 'nome'>  </th>"; //Necessário para completar a tabela
                    //
                } else {
                    //No caso dos alunos irem para recuperação
                    $html .= '<tr>';
                    $html .= "<td class = 'nome'> $nome </td>";

//Portugues//Portugues//Portugues
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano_anterior' AND `id_bimestre_media_disciplina` = '4'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                    $aprovado = $linhaConsulta2['aprovado'];
//$nota = $linhaConsulta2['nota'];
                    $nota = str_replace(".", ",", $linhaConsulta2['nota']);

                    if ($aprovado == "SIM") {
                        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota </td>";
                    } else {
                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND `id_recuperacao_final_disciplina` = '4' ");
                        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                        $aprovado2 = $linhaConsulta2['aprovado'];
                        //
                        if ($aprovado2 == "SIM") {
                            $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '4' AND `ano` = '$ano_anterior'");
                            $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                            // $nota = $linhaConsulta2['media'];
                            $nota = str_replace(".", ",", $linhaConsulta2['media']);

                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota </td>";
                        } else {
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota </td>";
                        }
                    }
//
// História         // História
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano_anterior' AND `id_bimestre_media_disciplina` = '8'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                    $aprovado = $linhaConsulta2['aprovado'];
                    $nota = str_replace(".", ",", $linhaConsulta2['nota']);

                    if ($aprovado == "SIM") {
                        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                    } else {
                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND `id_recuperacao_final_disciplina` = '8' ");
                        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                        $aprovado2 = $linhaConsulta2['aprovado'];
                        //
                        if ($aprovado2 == "SIM") {
                            $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '8' AND `ano` = '$ano_anterior'");
                            $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                            $nota = str_replace(".", ",", $linhaConsulta2['media']);
                            //
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        } else {
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        }
                    }
//
//Geografia         Geografia
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano_anterior' AND `id_bimestre_media_disciplina` = '7'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                    $aprovado = $linhaConsulta2['aprovado'];
                    $nota = str_replace(".", ",", $linhaConsulta2['nota']);

                    if ($aprovado == "SIM") {
                        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                    } else {
                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND `id_recuperacao_final_disciplina` = '7' ");
                        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                        $aprovado2 = $linhaConsulta2['aprovado'];
                        //
                        if ($aprovado2 == "SIM") {
                            $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '7' AND `ano` = '$ano_anterior'");
                            $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                            $nota = str_replace(".", ",", $linhaConsulta2['media']);
                            //
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        } else {
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        }
                    }
//
//Matematica            //Matematica
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano_anterior' AND `id_bimestre_media_disciplina` = '6'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                    $aprovado = $linhaConsulta2['aprovado'];
                    $nota = str_replace(".", ",", $linhaConsulta2['nota']);
                    if ($aprovado == "SIM") {
                        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                    } else {
                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND `id_recuperacao_final_disciplina` = '6' ");
                        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                        $aprovado2 = $linhaConsulta2['aprovado'];
                        //
                        if ($aprovado2 == "SIM") {
                            $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '6' AND `ano` = '$ano_anterior'");
                            $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                            $nota = str_replace(".", ",", $linhaConsulta2['media']);
                            //
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        } else {
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        }
                    }
                    //
                    //Ciencias                      //Ciencias
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano_anterior' AND `id_bimestre_media_disciplina` = '2'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                    $aprovado = $linhaConsulta2['aprovado'];
                    $nota = str_replace(".", ",", $linhaConsulta2['nota']);
                    if ($aprovado == "SIM") {
                        $html .= "<td class = 'nome'> $nota</td>";
                    } else {
                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND `id_recuperacao_final_disciplina` = '2' ");
                        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                        $aprovado2 = $linhaConsulta2['aprovado'];
                        //
                        if ($aprovado2 == "SIM") {
                            $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '2' AND `ano` = '$ano_anterior'");
                            $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                            $nota = str_replace(".", ",", $linhaConsulta2['media']);
                            //
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        } else {
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        }
                    }
                    //
                    //ARTE      //ARTE      //ARTE
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano_anterior' AND `id_bimestre_media_disciplina` = '9'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                    $aprovado = $linhaConsulta2['aprovado'];
                    $nota = str_replace(".", ",", $linhaConsulta2['nota']);
                    //
                    if ($aprovado == "SIM") {
                        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                    } else {
                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND `id_recuperacao_final_disciplina` = '9' ");
                        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                        $aprovado2 = $linhaConsulta2['aprovado'];
                        //
                        if ($aprovado2 == "SIM") {
                            $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '9' AND `ano` = '$ano_anterior'");
                            $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                            $nota = str_replace(".", ",", $linhaConsulta2['media']);
                            //
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        } else {
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        }
                    }
                    //
                    //RELIGIAO               RELIGIAO                          RELIGIAO
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano_anterior' AND `id_bimestre_media_disciplina` = '12'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                    $aprovado = $linhaConsulta2['aprovado'];
                    $nota = str_replace(".", ",", $linhaConsulta2['nota']);
                    //
                    if ($aprovado == "SIM") {
                        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                    } else {
                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND `id_recuperacao_final_disciplina` = '12' ");
                        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                        $aprovado2 = $linhaConsulta2['aprovado'];
                        //
                        if ($aprovado2 == "SIM") {
                            $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '12' AND `ano` = '$ano_anterior'");
                            $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                            $nota = str_replace(".", ",", $linhaConsulta2['media']);
                            //
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        } else {
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        }
                    }
                    //
                    //EDUCAÇÃO FISICA       //EDUCAÇÃO FISICA
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND  `ano` = '$ano_anterior' AND `id_bimestre_media_disciplina` = '3'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                    $aprovado = $linhaConsulta2['aprovado'];
                    $nota = str_replace(".", ",", $linhaConsulta2['nota']);
                    //
                    if ($aprovado == "SIM") {
                        $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                    } else {
                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `ano` = '$ano_anterior' AND `id_recuperacao_final_disciplina` = '3' ");
                        $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                        $aprovado2 = $linhaConsulta2['aprovado'];
                        //
                        if ($aprovado2 == "SIM") {
                            $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `recuperacao_final` WHERE `id_recuperacao_final_aluno` = '$lista_id' AND `id_recuperacao_final_disciplina` = '3' AND `ano` = '$ano_anterior'");
                            $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
                            $nota = str_replace(".", ",", $linhaConsulta2['media']);
                            //
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        } else {
                            $html .= "<td class = 'nome' style = 'text-align: center;font-weight: bold;'> $nota</td>";
                        }
                    }
                    //RESULTADO FINAL       //RESULTADO FINAL
                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano_anterior'");
                    $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
//    
                    $horas = $linhaConsulta2['aluno'];
                    $html .= "<th> <p style = 'font-size: 12px;'>$horas</p> </th>";
//
                    $frequencia = $linhaConsulta2['frequencia'];
                    $html .= "<th> <p style = 'font-size: 12px;'>$frequencia %</p></th>";
//
                    $nota = $linhaConsulta2['status_bimestre_media'];
//
                    if ($nota == "3") {
                        $nota = "TRANSFERIDO";
                    } elseif ($nota == "4") {
                        $nota = "DESISTENTE";
                    } elseif ($nota == "5") {
                        $nota = "APROVADO";
                    } elseif ($nota == "6") {
                        $nota = "REPROVADO";
                    } else {
                        $nota = "CURSANDO";
                    }
                    $html .= "<td  class = 'nome' style = 'text-align: center;font-weight: bold;'><b>RECUPERAÇÃO</b> </td>";
                    $html .= "<td class = 'nome'><p style = 'text-align: center; '><b>$nota</b></p></td>";
                }
                //
                $html .= '</tr>';
            } else {
                //No caso do aluno não ter histórico
                $html .= '<tr>';
                // $html . = "<td class = 'nome'> $cont</td>";
                $html .= "<td class = 'nome'> $nome </td>";
                //
                for ($i = 1; $i < 13; $i++) {
                    $html .= "<th></th>";
                }
                $html .= '</tr>';
            }
        }
        //
        //
//        if ($quant2 == $cont) {
//            //
//            $Consulta = mysqli_query($Conexao, "SELECT * FROM `tb_cidades` where id = '$escola_cidade'");
//            while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
//                //
//                $cidade_nome = strtoupper($Registro["nome"]);
//                $id_cidade = $Registro["id"];
//                $uf_cidade = $Registro["uf"];
//            }
//               include_once 'funcao_data_atual.php';
//            $html .= '<tr>';
//            $html .= "<th COLSPAN = '9'></th>";
//            $html .= "<th COLSPAN = '3'>$cidade_nome, $dia de $mes2 de $ano_anterior</th>";
//            $html .= '</tr>';
//            $html .= '<tr>';
//            $html .= "<th COLSPAN = '12'></th>";
//            $html .= '</tr>';
//            $html .= '<tr>';
//            $html .= "<th COLSPAN = '4'>___________________________</th>";
//            $html .= "<th></th>";
//            $html .= "<th COLSPAN = '4'>___________________________</th>";
//            $html .= "<th COLSPAN = ''></th>";
//            $html .= "<th COLSPAN = '3'>___________________________</th>";
//            $html .= '</tr>';
//            $html .= '<tr>';
//            $html .= "<th COLSPAN = '4'>Assinatura do Gestor</th>";
//            $html .= "<th></th>";
//            $html .= "<th COLSPAN = '4'>Assinatura do Coordenador Pedagógico</th>";
//            $html .= "<th></th>";
//            $html .= "<th COLSPAN = '3'>Assinatura do professor(a)</th>";
//            $html .= '</tr>';
//        }

        $html .= '</table>';
        //Configurações header para forçar o download        
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/x-msexcel");
        header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
        header("Content-Description: PHP Generated Data");
        // Envia o conteúdo do arquivo
        echo $html;
        // exit;
        ?>
    </body>
</html>