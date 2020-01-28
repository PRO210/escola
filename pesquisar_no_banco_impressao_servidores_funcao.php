<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
// Definimos o nome do arquivo que será exportado
        $arquivo = 'Servidores.xls';
// Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border = 1>';
        $html .= '<tr>';
        $html .= '<td><b>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>Servidores</b></tr>';
        $html .= '<td><b></b></tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Nº</b></td>';
        $html .= '<td><b>TURMA</b></td>';
        $html .= '<td><b>TURNO</b></td>';
        $html .= '<td><b>NOME</b></td>';
        $html .= '<td><b>NASCIDO</b></td>';
        $html .= '<td><b>ANIVERSARIANTE</b></td>';
        $html .= '<td><b>CPF</b></td>';
        $html .= '<td><b>MATRICULA</b></td>';
        $html .= '<td><b>VÍNCULO</b></td>';
        $html .= '<td><b>FUNÇÃO</b></td>';
        $html .= '<td><b>RESUMO_FUNÇÃO</b></td>';
        $html .= '<td><b>MODELO DA CERTIDÃO</b></td>';
        $html .= '<td><b>MATRICULA DA CERTIDÃO </b></td>';
        $html .= '<td><b>CERTIDÃO</b></td>';
        $html .= '<td><b>DADOS DA CERTIDÃO</b></td>';
        $html .= '<td><b>EXPEDIÇÃO</b></td>';
        $html .= '<td><b>MÃE</b></td>';
        $html .= '<td><b>PAI</b></td>';
        $html .= '<td><b>FONE</b></td>';
        $html .= '<td><b>CELULAR</b></td>';
        $html .= '<td><b>EMAIL</b></td>';

        $html .= '</tr>';

        $ids = "";
        foreach (($_POST['servidor_selecionado']) as $lista_id) {
            $ids .= $lista_id . ",";
        }
        $ids = substr($ids, 0, -1);
//
        $contAmig = 0;
        $contAux = 0;
        $contCoo = 0;
        $contDir = 0;
        $contMer = 0;
        $contMot = 0;
        $contPor = 0;
        $contPro = 0;
        $contProf = 0;
        $contSer = 0;
        $contVic = 0;
        $contVig = 0;
//      Traz as funções
        $Consulta_funcao = mysqli_query($Conexao, "SELECT * FROM `funcoes` ORDER BY `funcoes`.`funcao` ASC ");
        while ($Registro_funcao = mysqli_fetch_array($Consulta_funcao, MYSQLI_BOTH)) {
            $funcao = $Registro_funcao["funcao"];
            // echo "$funcao" . "<br>";           
            //   echo "$SQL_Consulta" . "<br>";
            $Consulta = mysqli_query($Conexao, "SELECT * FROM servidores WHERE `id` IN($ids) AND `funcao` = '$funcao' ");
            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                if ($row_Consulta["funcao"] == "AMIGOS DA ESCOLA") {
                    $contAmig++;
                }
                if ($row_Consulta["funcao"] == "AUXILIAR ADMINISTRATIVO") {
                    $contAux++;
                }
                if ($row_Consulta["funcao"] == "COORDENADORA") {
                    $contCoo++;
                }
                if ($row_Consulta["funcao"] == "DIRETOR(A)") {
                    $contDir++;
                }
                if ($row_Consulta["funcao"] == "MERENDEIRA") {
                    $contMer++;
                }
                if ($row_Consulta["funcao"] == "MOTORISTA") {
                    $contMot++;
                }
                if ($row_Consulta["funcao"] == "PORTEIRO") {
                    $contPor++;
                }
                if ($row_Consulta["funcao"] == "PROFESSOR(A)") {
                    $contPro++;
                }
                if ($row_Consulta["funcao"] == "PROFESSOR(A)/AUXILIAR") {
                    $contProf++;
                }
                if ($row_Consulta["funcao"] == "SERVIÇOS GERAIS") {
                    $contSer++;
                }
                if ($row_Consulta["funcao"] == "VICE DIRETOR(A)") {
                    $contVic++;
                }
                if ($row_Consulta["funcao"] == "VIGIA") {
                    $contVig++;
                }
            }
        }
        $ContLinhas = "";
        $cont = 0;
        if ($contAmig > 0) {
            $html .= '<tr>';
            $html .= '<td colspan = "21">AMIGOS DA ESCOLA</td>';
            $html .= '</tr>';
        }
        $Consulta_funcao = mysqli_query($Conexao, "SELECT * FROM `funcoes` ORDER BY `funcoes`.`funcao` ASC ");
        while ($Registro_funcao = mysqli_fetch_array($Consulta_funcao, MYSQLI_BOTH)) {
            $funcao = $Registro_funcao["funcao"];


//      Selecionar todos os itens da tabela 
            foreach (($_POST['servidor_selecionado']) as $lista_id) {
                $Consulta = mysqli_query($Conexao, "SELECT * FROM servidores WHERE `id` = '$lista_id' AND `funcao` = '$funcao'");
                $ContLinhas = mysqli_num_rows($Consulta);
//
                if ($ContLinhas > 0) {
                    //echo "SELECT * FROM servidores WHERE `id` = '$lista_id' AND `funcao` = '$funcao'" . "<br>";
                    $cont++;

                    if ($cont == $contAmig + 1) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21" >' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + 1 && $contAux > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + 1 && $contCoo > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + 1 && $contDir > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + $contMer + 1 && $contMer > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + $contMer + $contMot + 1 && $contMot > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + $contMer + $contMot + $contPor + 1 && $contPor > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + $contMer + $contMot + + $contPor + $contPro + 1 && $contPro > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + $contMer + $contMot + + $contPor + $contPro + $contProf + 1 && $contProf > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21" >' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + $contMer + $contMot + + $contPor + $contPro + $contProf + $contSer + 1 && $contSer > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + $contMer + $contMot + + $contPor + $contPro + $contProf + $contSer + $contVic + 1 && $contVic > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }
                    if ($cont == $contAux + $contAmig + $contCoo + $contDir + $contMer + $contMot + + $contPor + $contPro + $contProf + $contSer + $contVic + $contVig + 1 && $contVig > 0) {
                        $html .= '<tr>';
                        $html .= '<td colspan = "21">' . $funcao . '</td>';
                        $html .= '</tr>';
                    }



                    while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
//
                        if ($row_Consulta["funcao"] == "PROFESSOR(A)" || $row_Consulta["funcao"] == "PROFESSOR(A)/AUXILIAR") {
                            //
                            $SQL_Professor = "SELECT turmas_professor2.*,servidores.nome,substituta,projeto,projeto_nome FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_professor` = '$lista_id' AND `turmas_professor2`.id_professor = servidores.id ORDER BY id DESC limit 1 ";
                            $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
                            $Linha_Professor = mysqli_fetch_array($Consulta_professor);
                            $id_turma = $Linha_Professor["id_turma"];
                            //
                            $substituta = $Linha_Professor['substituta'];
                            $projeto = $Linha_Professor['projeto'];

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



                            $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$id_turma'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma);
                            //                 
                            $nome_turma = $Linha_turma["turma"] . " - " . $Linha_turma["unico"];
                        } else {
                            $nome_turma = "-------";
                            $substituta = "";
                            $projeto_nome = "";
                        }
                        //
                        $teste_folga = "";
                        $teste_nome = $row_Consulta["nome"];
                        $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                        $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                        $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                        if ($ContLinhasAtestados > 0) {
                            $dias = intval($linha_atestados['dias']);
                            if ($dias >= 0) {
                                $teste_folga = " /Está de Atestado; ";
                            }
                        }





                        $html .= '<tr>';
                        $html .= '<td>' . $cont . '</td>';
                        $html .= '<td>' . $nome_turma . '</td>';
                        $html .= '<td>' . $row_Consulta["turno"] . '</td>';


                        $html .= '<td>' . $row_Consulta["nome"] . $teste_folga . $substituta . $projeto_nome . '</td>';
                        $nascimento = date('d/m/Y', strtotime($row_Consulta["nascimento"]));
                        $hoje = date('m');
                        $mes = date('m', strtotime($row_Consulta["nascimento"]));
                        if ($mes == "$hoje") {
                            $mes = "Aniversariante";
                        } elseif ($mes > $hoje) {
                            $mes = "Ainda Não Chegou";
                        } elseif ($mes < $hoje) {
                            $mes = "Já Passou";
                        }
                        $teste = $row_Consulta["nascimento"];
                        if ($row_Consulta["nascimento"] == "0000-00-00" || $row_Consulta["nascimento"] == "0001-11-30") {
                            $nascimento = "";
                            $mes = "";
                        }
                        $html .= '<td>' . $nascimento . '</td>';
                        $html .= '<td>' . $mes . '</td>';
                        $html .= '<td>' . $row_Consulta["cpf"] . '</td>';
                        $html .= '<td>' . $row_Consulta["matricula"] . '</td>';
                        $html .= '<td>' . $row_Consulta["vinculo"] . '</td>';
                        $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                        $html .= '<td>' . $row_Consulta["resumo_funcao"] . '</td>';
                        $html .= '<td>' . $row_Consulta["modelo_certidao"] . '</td>';
                        $html .= '<td>' . $row_Consulta["matricula_certidao"] . '</td>';
                        $html .= '<td>' . $row_Consulta["tipos_de_certidao"] . '</td>';
                        $html .= '<td>' . $row_Consulta["dados_certidao"] . '</td>';
                        $data_expedicao = date('d/m/y ', strtotime($row_Consulta["data_expedicao"]));
                        $html .= '<td>' . $data_expedicao . '</td>';
                        $html .= '<td>' . $row_Consulta["mae"] . '</td>';
                        $html .= '<td>' . $row_Consulta["pai"] . '</td>';
                        $html .= '<td>' . $row_Consulta["fone"] . '</td>';
                        $html .= '<td>' . $row_Consulta["celular"] . '</td>';
                        $html .= '<td>' . $row_Consulta["email"] . '</td>';
                        $html .= '</tr>';

                        if ($cont == $contAmig && $contAmig > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial:' . $contAmig . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux && $contAux > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contAux . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo && $contCoo > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contCoo . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir && $contDir > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contDir . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir + $contMer && $contMer > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contMer . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir + $contMer + $contMot && $contMot > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contMot . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir + $contMer + $contMot + $contPor && $contPor > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contPor . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir + $contMer + $contMot + $contPor + $contPro && $contPro > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contPro . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir + $contMer + $contMot + $contPor + $contPro + $contProf && $contProf > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contProf . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir + $contMer + $contMot + $contPor + $contPro + $contProf + $contSer && $contSer > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contSer . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir + $contMer + $contMot + $contPor + $contPro + $contProf + $contSer + $contVic && $contVic > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contVic . '</td>';
                            $html .= '</tr>';
                        }
                        if ($cont == $contAmig + $contAux + $contCoo + $contDir + $contMer + $contMot + $contPor + $contPro + $contProf + $contSer + $contVic + $contVig && $contVig > 0) {
                            $html .= '<tr>';
                            $html .= '<td colspan = "21">Somatório Parcial: ' . $contVig . '</td>';
                            $html .= '</tr>';
                        }
                    }
                }
            }
        }
        $html .= '<tr>';
        $html .= '<td colspan = "21">Somatório Total: ' . $cont . '</td>';
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