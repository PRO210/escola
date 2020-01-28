<?php
ob_start();
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>       
        <meta charset="UTF-8">
    </head>
    <?php
    if ($txt_option == "manha") {
        // Definimos o nome do arquivo que será exportado
        $arquivo = 'turmas.xls';
        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border = 1>';
        $html .= '<tr>';
        $html .= '<td>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>ALAGOINHA</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>TURMA</b></td>';
        $html .= '<td><b>TURNO</b></td>';
        $html .= '<td><b>ANO</b></td>';
        $html .= '<td><b>MATRICULADOS</b></td>';
        $html .= '<td><b>TRANSFERIDOS</b></td>';
        $html .= '<td><b>ADMITIDO DEPOIS</b></td>';
        $html .= '<td><b>DESISTENTES</b></td>';
        $html .= '<td><b>CURSANDO</b></td>';
        $html .= '<td><b>PROFESSORES</b></td>';
        $html .= '</tr>';

        //Selecionar todos os itens da tabela 
        $ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas WHERE turno = 'MATUTINO' ORDER BY turma ");

        while ($linhaV = mysqli_fetch_array($ConsultaV)) {
            $idV = $linhaV['id'];
            $turmaV = $linhaV['turma'];
            $turnoV = $linhaV['turno'];
            $turma = $linhaV['id'];
            $unicoV = $linhaV['unico'];
            $anoV = substr($linhaV["ano"], 0, -6);
            //$professorV = $linhaV['professor'];

            $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $turma . "' AND excluido = 'N'");
            $rowqtd = mysqli_fetch_array($ConsultaQtd);
            $am = $rowqtd['AM'];
            $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'TRANSFERIDO' AND excluido = 'N' ");
            $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
            $at = $rowqtd1['AT'];
            $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'ADIMITIDO DEPOIS' AND excluido = 'N' ");
            $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
            $ad = $rowqtd2['AD'];
            $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $turma . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ");
            $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
            $ac = $rowqtd3['AC'];
            $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'DESISTENTE' AND excluido = 'N' ");
            $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
            $adesis = $rowqtd4['D'];
            //       
            $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$idV' AND `turmas_professor2`.id_professor = servidores.id";
            $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);

            $nome_professores = "";
            $ContLinhasProf = mysqli_num_rows($Consulta_professor);
            //
            while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
                $nome_professor = $Linha_Professor["nome"];
                $funcao_professor = $Linha_Professor["funcao"];
                $nome_professores .= "$nome_professor - $funcao_professor" . " / ";
            }
            //
            $html .= '<tr>';
            $html .= '<td>' . $turmaV . '-' . $unicoV . '</td>';
            $html .= '<td>' . $turnoV . '</td>';
            $html .= '<td>' . $anoV . '</td>';
            $html .= '<td>' . $am . '</td>';
            $html .= '<td>' . $at . '</td>';
            $html .= '<td>' . $ad . '</td>';
            $html .= '<td>' . $adesis . '</td>';
            $html .= '<td>' . $ac . '</td>';
            $html .= '<td>' . $nome_professores . '</td>';
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
    } elseif ($txt_option == "tarde") {
        // Definimos o nome do arquivo que será exportado
        $arquivo = 'turmas.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border = 1>';
        $html .= '<tr>';
        $html .= '<td colspan = "4" >ESCOLA MUNICIPAL LUIZ CELSO GALINDO</tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>ALAGOINHA</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>TURMA</b></td>';
        $html .= '<td><b>TURNO</b></td>';
        $html .= '<td><b>ANO</b></td>';
        $html .= '<td><b>MATRICULADOS</b></td>';
        $html .= '<td><b>TRANSFERIDOS</b></td>';
        $html .= '<td><b>ADMITIDO DEPOIS</b></td>';
        $html .= '<td><b>DESISTENTES</b></td>';
        $html .= '<td><b>CURSANDO</b></td>';
        $html .= '<td><b>PROFESSOR(A)</b></td>';
        $html .= '</tr>';

        //Selecionar todos os itens da tabela 
        $ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas WHERE turno = 'VESPERTINO' ORDER BY turma ");

        while ($linhaV = mysqli_fetch_array($ConsultaV)) {
            $idV = $linhaV['id'];
            $turmaV = $linhaV['turma'];
            $turnoV = $linhaV['turno'];
            $turma = $linhaV['id'];
            $unicoV = $linhaV['unico'];
            $anoV = substr($linhaV["ano"], 0, -6);
            //$professorV = $linhaV['professor'];

            $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $turma . "' AND excluido = 'N'");
            $rowqtd = mysqli_fetch_array($ConsultaQtd);
            $am = $rowqtd['AM'];
            $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'TRANSFERIDO' AND excluido = 'N' ");
            $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
            $at = $rowqtd1['AT'];
            $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'ADIMITIDO DEPOIS' AND excluido = 'N' ");
            $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
            $ad = $rowqtd2['AD'];
            $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $turma . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ");
            $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
            $ac = $rowqtd3['AC'];
            $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'DESISTENTE' AND excluido = 'N' ");
            $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
            $adesis = $rowqtd4['D'];
            //       
            $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$idV' AND `turmas_professor2`.id_professor = servidores.id";
            $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
            $nome_professores = "";
            $aux_professores = "";
            $ContLinhasProf = mysqli_num_rows($Consulta_professor);
            //
            while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
                $nome_professor = $Linha_Professor["nome"];
                $funcao_professor = $Linha_Professor["funcao"];
                $nome_professores .= "$nome_professor - $funcao_professor" . " / ";
            }
            //
            $html .= '<tr>';
            $html .= '<td>' . $turmaV . '-' . $unicoV . '</td>';
            $html .= '<td>' . $turnoV . '</td>';
            $html .= '<td>' . $anoV . '</td>';
            $html .= '<td>' . $am . '</td>';
            $html .= '<td>' . $at . '</td>';
            $html .= '<td>' . $ad . '</td>';
            $html .= '<td>' . $adesis . '</td>';
            $html .= '<td>' . $ac . '</td>';
            $html .= '<td>' . $nome_professores . '</td>';
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
    } elseif ($txt_option == "todos_turnos") {
        // Definimos o nome do arquivo que será exportado
        $arquivo = 'turmas.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border = 1>';
        $html .= '<tr>';
        $html .= '<td>ESCOLA MUNICIPAL LUIZ CELSO GALINDO</tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>ALAGOINHA</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>TURMA</b></td>';
        $html .= '<td><b>TURNO</b></td>';
        $html .= '<td><b>ANO</b></td>';
        $html .= '<td><b>MATRICULADOS</b></td>';
        $html .= '<td><b>TRANSFERIDOS</b></td>';
        $html .= '<td><b>ADMITIDO DEPOIS</b></td>';
        $html .= '<td><b>DESISTENTES</b></td>';
        $html .= '<td><b>CURSANDO</b></td>';
        $html .= '<td><b>PROFESSORES</b></td>';
        $html .= '<td><b>AUX.PROFESSOR(R)</b></td>';
        $html .= '</tr>';

        //Selecionar todos os itens da tabela 
        $ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas ORDER BY turma ");

        while ($linhaV = mysqli_fetch_array($ConsultaV)) {
            $idV = $linhaV['id'];
            $turmaV = $linhaV['turma'];
            $unicoV = $linhaV['unico'];
            $turnoV = $linhaV['turno'];
            $anoV = substr($linhaV["ano"], 0, -6);
            $turma = $linhaV['id'];
            //$professorV = $linhaV['professor'];
            $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $turma . "' AND excluido = 'N'");
            $rowqtd = mysqli_fetch_array($ConsultaQtd);
            $am = $rowqtd['AM'];
            $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'TRANSFERIDO' AND excluido = 'N' ");
            $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
            $at = $rowqtd1['AT'];
            $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'ADIMITIDO DEPOIS' AND excluido = 'N' ");
            $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
            $ad = $rowqtd2['AD'];
            $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $turma . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ");
            $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
            $ac = $rowqtd3['AC'];
            $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'DESISTENTE' AND excluido = 'N' ");
            $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
            $adesis = $rowqtd4['D'];
            //       
            $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$idV' AND `turmas_professor2`.id_professor = servidores.id";
            $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
            //
            $nome_professores = "";
            $aux_professores = "";
            $ContLinhasProf = mysqli_num_rows($Consulta_professor);
            //
            while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
                $nome_professor = $Linha_Professor["nome"];
                $funcao_professor = $Linha_Professor["funcao"];
                //
                $teste_folga = "";
                $teste_nome = $Linha_Professor['nome'];
                $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                if ($ContLinhasAtestados > 0) {
                    $dias = intval($linha_atestados['dias']);
                    if ($dias >= 0) {
                        $teste_folga = " /Está de Atestado; ";
                    }
                }
                if ($funcao_professor == "PROFESSOR(A)") {
                    $nome_professor = $Linha_Professor["nome"];
                    $nome_professores .= "$nome_professor" . " $teste_folga" . "  /  ";
                } else {
                    $nome_aux_professor = $Linha_Professor["nome"];
                    $aux_professores .= "$nome_aux_professor" . " $teste_folga " . "/ ";
                }
            }
            //
            $html .= '<tr>';
            $html .= '<td>' . $turmaV . ' - ' . $unicoV . '</td>';
            $html .= '<td>' . $turnoV . '</td>';
            $html .= '<td>' . $anoV . '</td>';
            $html .= '<td>' . $am . '</td>';
            $html .= '<td>' . $at . '</td>';
            $html .= '<td>' . $ad . '</td>';
            $html .= '<td>' . $adesis . '</td>';
            $html .= '<td>' . $ac . '</td>';
            $html .= '<td>' . $nome_professores . '</td>';
            $html .= '<td>' . $aux_professores . '</td>';
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
    } else {
        // Definimos o nome do arquivo que será exportado
        $arquivo = 'turmas.xls';

        // Criamos uma tabela HTML com o formato da planilha
        $html = '';
        $html .= '<table border = 1>';
        $html .= '<tr>';
        $html .= '<td colspan = "4" >ESCOLA MUNICIPAL LUIZ CELSO GALINDO</tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>ALAGOINHA</tr>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>TURMA</b></td>';
        $html .= '<td><b>TURNO</b></td>';
        $html .= '<td><b>ANO</b></td>';
        $html .= '<td><b>MATRICULADOS</b></td>';
        $html .= '<td><b>TRANSFERIDOS</b></td>';
        $html .= '<td><b>ADMITIDO DEPOIS</b></td>';
        $html .= '<td><b>DESISTENTES</b></td>';
        $html .= '<td><b>CURSANDO</b></td>';
        $html .= '<td><b>PROFESSORES</b></td>';
        $html .= '</tr>';

        //Selecionar todos os itens da tabela 
        $ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas WHERE turno = 'NOTURNO' ORDER BY turma ");

        while ($linhaV = mysqli_fetch_array($ConsultaV)) {
            $idV = $linhaV['id'];
            $turmaV = $linhaV['turma'];
            $unicoV = $linhaV['unico'];
            $turnoV = $linhaV['turno'];
            $turma = $linhaV['id'];
            $anoV = substr($linhaV["ano"], 0, -6);
            //$professorV = $linhaV['professor'];

            $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $turma . "' AND excluido = 'N'");
            $rowqtd = mysqli_fetch_array($ConsultaQtd);
            $am = $rowqtd['AM'];
            $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'TRANSFERIDO' AND excluido = 'N' ");
            $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
            $at = $rowqtd1['AT'];
            $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'ADIMITIDO DEPOIS' AND excluido = 'N' ");
            $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
            $ad = $rowqtd2['AD'];
            $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $turma . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ");
            $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
            $ac = $rowqtd3['AC'];
            $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $turma . "' AND status = 'DESISTENTE' AND excluido = 'N' ");
            $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
            $adesis = $rowqtd4['D'];
//       
            $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$idV' AND `turmas_professor2`.id_professor = servidores.id";
            $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);

            $nome_professores = "";
            $ContLinhasProf = mysqli_num_rows($Consulta_professor);
            //
            while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
                $nome_professor = $Linha_Professor["nome"];
                $funcao_professor = $Linha_Professor["funcao"];
                $nome_professores .= "$nome_professor - $funcao_professor" . " / ";
            }
            //
            $html .= '<tr>';
            $html .= '<td>' . $turmaV . '-' . $unicoV . '</td>';
            $html .= '<td>' . $turnoV . '</td>';
            $html .= '<td>' . $anoV . '</td>';
            $html .= '<td>' . $am . '</td>';
            $html .= '<td>' . $at . '</td>';
            $html .= '<td>' . $ad . '</td>';
            $html .= '<td>' . $adesis . '</td>';
            $html .= '<td>' . $ac . '</td>';
            $html .= '<td>' . $nome_professores . '</td>';
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
</html>