<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>INFORMATIVO GERENCIAL</title>
    </head>
    <body>
        <?php
        $ano = date('Y');
        // Definimos o nome do arquivo que será exportado
        $arquivo = 'Informativo Gerencial.xls';
        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<td colspan = "2"><b>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td colspan = "2"><b>INFORMATIVO GERENCIAL</b></tr>';
        $html .= '</tr>';
//
        $html .= '<tr>';
        $html .= '<td><b>NOME</b></td>';
        $html .= '<td><b>CPF</b></td>';
        $html .= '<td><b>RG</b></td>';
        $html .= '<td><b>ÓRGÃO EXPEDIDOR</b></td>';
        $html .= '<td><b>MATRICULA</b></td>';
        $html .= '<td><b>EMAIL</b></td>';
        $html .= '<td><b>FUNÇÃO</b></td>';
     //   $html .= '<td><b>VINCULO</b></td>';
        $html .= '<td><b>ANO DE ESTUDO</b></td>';
        $html .= '<td><b>TURMA</b></td>';
        $html .= '<td><b>DISCIPLINA</b></td>';
        $html .= '<td><b>TOTAL | C\H </b></td>';
        $html .= '<td><b> M </b></td>';
        $html .= '<td><b> T </b></td>';
        $html .= '<td><b> N </b></td>';
        $html .= '<td><b>EFETIVO</b></td>';
        $html .= '<td><b>CONTRATADO</b></td>';
        $html .= '<td><b>AMIGOS DA ESCOLA</b></td>';
        $html .= '</tr>';
        //Selecionar todos os itens da tabela   
        foreach ($_POST['servidor_selecionado'] as $id) {

            $SQL_Consulta = "SELECT * FROM `servidores` WHERE id = '$id' AND `funcao` NOT LIKE '%professor(a)%' AND `funcao` NOT LIKE '%MOTORISTA%' AND `vinculo` NOT LIKE '%PRESTADOR DE SERVIÇOS%' AND `excluido` = 'N' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);
            //     
            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $m = "";
                $t = "";
                $n = "";
                $e = "";
                $c = "";
                $ae = "";
                //
                if ($row_Consulta["turno"] == "MATUTINO") {
                    $m = "X";
                } elseif ($row_Consulta["turno"] == "VESPERTINO") {
                    $t = "X";
                } elseif ($row_Consulta["turno"] == "NOTURNO") {
                    $n = "X";
                } elseif ($row_Consulta["turno"] == "MATUTINO/VESPERTINO") {
                    $m = "X";
                    $t = "X";
                } elseif ($row_Consulta["turno"] == "MATUTINO/NOTURNO") {
                    $m = "X";
                    $n = "X";
                } elseif ($row_Consulta["turno"] == "MATUTINO/VESPERTINO/NOTURNO") {
                    $m = "X";
                    $t = "X";
                    $n = "X";
                } elseif ($row_Consulta["turno"] == "VESPERTINO/NOTURNO") {
                    $t = "X";
                    $n = "X";
                }
                //
                if ($row_Consulta["vinculo"] == "EFETIVO(A)") {
                    $e = "X";
                } elseif ($row_Consulta["vinculo"] == "CONTRATADO(A)") {
                    $c = "X";
                } elseif ($row_Consulta["vinculo"] == "AMIGOS DA ESCOLA") {
                    $ae = "X";
                }
                $html .= '<tr>';
                $html .= '<td>' . $row_Consulta["nome"] . '</td>';
                $html .= '<td>' . $row_Consulta["cpf"] . '</td>';
                $html .= '<td>' . $row_Consulta["dados_certidao"] . '</td>';
                $html .= '<td>' . $row_Consulta["orgao_expedidor"] . '</td>';
                $html .= '<td>' . $row_Consulta["matricula"] . '</td>';
                $html .= '<td>' . $row_Consulta["email"] . '</td>';
                $html .= '<td>' . $row_Consulta["resumo_funcao"] . '' . $row_Consulta["resumo_funcao_2"] . '</td>';
              //  $html .= '<td>' . $row_Consulta["vinculo"] . '</td>';
                $html .= '<td></td>';
                $html .= '<td></td>';
                $html .= '<td></td>';
                $html .= '<td>' . $row_Consulta["carga_horaria"] . '</td>';
                $html .= '<td>' . $m . '</td>';
                $html .= '<td>' . $t . '</td>';
                $html .= '<td>' . $n . '</td>';
                $html .= '<td>' . $e . '</td>';
                $html .= '<td>' . $c . '</td>';
                $html .= '<td>' . $ae . '</td>';
                $html .= '</tr>';
            }
        }

        foreach ($_POST['servidor_selecionado'] as $id) {
            $SQL_Consulta2 = "SELECT servidores.*,turmas_professor2.id_turma,turmas_professor2.id_professor,turmas.* FROM `servidores`,`turmas_professor2`,`turmas` WHERE `funcao` LIKE '%professor(a)%' AND servidores.id = turmas_professor2.id_professor AND servidores.id = '$id' AND turmas.id = turmas_professor2.id_turma AND servidores.excluido = 'N' AND turmas.ano LIKE '%$ano%' GROUP BY servidores.id ORDER BY nome ASC";
            $Consulta2 = mysqli_query($Conexao, $SQL_Consulta2);
            $Linha = mysqli_num_rows($Consulta2);
            //   
            if ($Linha > 0) {
                while ($Linha2 = mysqli_fetch_array($Consulta2)) {
                    //
                    $id_professor = $Linha2['id_professor'];
                    //
                    $m2 = "";
                    $t2 = "";
                    $n2 = "";
                    $e2 = "";
                    $c2 = "";
                    $ae2 = "";
                    //
                    $SQL_Consulta3 = "SELECT servidores.turno FROM `servidores` WHERE id = '$id_professor'";
                    $Consulta3 = mysqli_query($Conexao, $SQL_Consulta3);
                    $Linha3 = mysqli_fetch_array($Consulta3);
                    if ($Linha3["turno"] == "MATUTINO") {
                        $m2 = "X";
                    } elseif ($Linha3["turno"] == "VESPERTINO") {
                        $t2 = "X";
                    } elseif ($Linha3["turno"] == "NOTURNO") {
                        $n2 = "X";
                    } elseif ($Linha3["turno"] == "MATUTINO/VESPERTINO") {
                        $m2 = "X";
                        $t2 = "X";
                    } elseif ($Linha3["turno"] == "MATUTINO/VESPERTINO/NOTURNO") {
                        $m2 = "X";
                        $t2 = "X";
                        $n2 = "X";
                    } elseif ($Linha3["turno"] == "MATUTINO/NOTURNO") {
                        $m2 = "X";
                        $n2 = "X";
                    } elseif ($Linha3["turno"] == "VESPERTINO/NOTURNO") {
                        $t2 = "X";
                        $n2 = "X";
                    }
                    //
                    if ($Linha2["vinculo"] == "EFETIVO(A)") {
                        $e2 = "X";
                    } elseif ($Linha2["vinculo"] == "CONTRATADO(A)") {
                        $c2 = "X";
                    } elseif ($Linha2["vinculo"] == "AMIGOS DA ESCOLA") {
                        $ae2 = "X";
                    }
                    //                        
                    $html .= '<tr>';
                    $html .= '<td>' . $Linha2["nome"] . '</td>';
                    $html .= '<td>' . $Linha2["cpf"] . '</td>';
                    $html .= '<td>' . $Linha2["dados_certidao"] . '</td>';
                    $html .= '<td>' . $Linha2["orgao_expedidor"] . '</td>';
                    $html .= '<td>' . $Linha2["matricula"] . '</td>';
                    $html .= '<td>' . $Linha2["email"] . '</td>';
                    $html .= '<td>' . $Linha2["resumo_funcao"] . '<br>' . $Linha2["resumo_funcao_2"] . '</td>';

                   // $html .= '<td>' . $Linha2["vinculo"] . '</td>';
                    //
                    if ($Linha2["resumo_turmas_sim"] == "SIM") {
                        $anos = $Linha2["resumo_anos"] . $Linha2["resumo_anos_2"];
                    } else {
                        $anos = $Linha2["turma"];
                    }
                    $html .= '<td>' . $anos . '</td>';
                    //
                    //
                    if ($Linha2["resumo_turmas_sim"] == "SIM") {
                        $turmas = $Linha2["resumo_turmas"] . $Linha2["resumo_turmas_2"];
                    } else {
                        $turmas = $Linha2["unico"];
                    }
                    $html .= '<td>' . $turmas . '</td>';
                    //
                    //
                    if ($Linha2["resumo_turmas_sim"] == "SIM") {
                        $disciplinas = $Linha2["resumo_disciplinas"];
                    } else {
                        $disciplinas = "POLIVALENTE";
                    }
                    $html .= '<td>' . $disciplinas . '</td>';
                    $html .= '<td>' . $Linha2["carga_horaria"] . '</td>';
                    $html .= '<td>' . $m2 . '</td>';
                    $html .= '<td>' . $t2 . '</td>';
                    $html .= '<td>' . $n2 . '</td>';
                    $html .= '<td>' . $e2 . '</td>';
                    $html .= '<td>' . $c2 . '</td>';
                    $html .= '<td>' . $ae2 . '</td>';
                    $html .= '</tr>';
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