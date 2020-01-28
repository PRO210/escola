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
        $ids = "";
        foreach (($_POST['aluno_selecionado']) as $lista_id) {
            $SQL_Consulta = "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos WHERE `id` = '$lista_id' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                $quant = 1;
                $quant2 += $quant;
                $ids .= $lista_id . ",";
            }
        }
        $ids = substr($ids, 0, -1);
        // echo "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos WHERE id IN ($ids) ORDER BY`alunos`.`turma` ASC,`alunos`.`nome` ASC ";
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
        $html .= "<td colspan = '2'>Quantidade de Alunos:" . $quant2 . "</tr>";
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td><b>INEP</b></td>';
        $html .= '<td><b>Turma</b></td>';
        $html .= '<td><b>Nome</b></td>';
        $html .= '<td><b>NASCIDO</b></td>';
        $html .= '<td><b>IDADE</b></td>';
        $html .= '<td><b>FONE I</b></td>';
        $html .= '<td><b>FONE II</b></td>';
        $html .= '<td><b>MÃE</b></td>';
        $html .= '<td><b>PROFISSÃO DA MÃE</b></td>';
        $html .= '<td><b>PAI</b></td>';
        $html .= '<td><b>PROFISSÃO DO PAI</b></td>';
        $html .= '<td><b>NIS</b></td>';
        $html .= '<td><b>BOLSA FAMÍLIA</b></td>';
        $html .= '<td><b>SUS</b></td>';
        $html .= '<td><b>MODELO DA CERTIDÃO</b></td>';
        $html .= '<td><b>MATRICULA DA CERTIDÃO</b></td>';
        $html .= '<td><b>CERTIDÃO</b></td>';
        $html .= '<td><b>DADOS DA CERTIDÃO</b></td>';
        $html .= '<td><b>EXPEDIÇÃO </b></td>';
        $html .= '<td><b>NATURALIDADE</b></td>';
        $html .= '<td><b>ESTADO</b></td>';
        $html .= '<td><b>NACIONALIDADE</b></td>';
        $html .= '<td><b>SEXO</b></td>';
        $html .= '<td><b>ENDEREÇO</b></td>';
        $html .= '<td><b>CIDADE</b></td>';
        $html .= '<td><b>ESTADO</b></td>';
        $html .= '<td><b>NECESSIDADES  ESPECIAIS</b></td>';
        $html .= '<td><b>TRANSPORTE</b></td>';
        $html .= '<td><b>URBANO</b></td>';
        $html .= '<td><b>PONTO DE ÔNIBUS</b></td>';
        $html .= '<td><b>MOTORISTA</b></td>';
        $html .= '<td><b>MOTORISTA II</b></td>';
        $html .= '<td><b>MATRICULA</b></td>';
        $html .= '<td><b>RENOVAÇÃO DA MATRICULA</b></td>';
        $html .= '<td><b>DECLARAÇÃO</b></td>';
        $html .= '<td><b>DATA DECLARAÇÃO</b></td>';
        $html .= '<td><b>RESPONSÁVEL PELA DECLARAÇÃO</b></td>';
        $html .= '<td><b>TRANSFERÊNCIA</b></td>';
        $html .= '<td><b>DATA TRANSFERÊNCIA</b></td>';
        $html .= '<td><b>RESPONSÁVEL PELA TRANSFERÊNCIA</b></td>';
        $html .= '<td><b>OBS</b></td>';
        $html .= '<td><b>STATUS</b></td>';
        $html .= '<td><b>Turma</b></td>';
        $html .= '<td><b>Único</b></td>';
        $html .= '<td><b>Turno</b></td>';
        $html .= '<td><b>Professor(a)</b></td>';
        $html .= '<td><b>Professor(a) Educ. Física</b></td>';
        $html .= '<td><b>Professor(a) Auxiliar</b></td>';
        $html .= '<td><b>Professor(a) Substtituta</b></td>';
        $html .= '<td><b>Professor(a) de PROJETOS</b></td>';

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
                $html .= '<td>' . $row_Consulta["inep"] . '</td>';
                $turmaf = $row_Consulta["turma"];
                //
                $SQL_Professor = "SELECT turmas_professor2.*,servidores.* FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_turma` = '$turmaf' AND `turmas_professor2`.id_professor = servidores.id";
                $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
//
//                $nome_professores = "";
//                $nome_professores_fisica = "";
//                $aux_professores = "";
//                $subs_professores = "";
//                $proj_professores = "";
                $nome_professores = "";
                $nome_professores2 = "";
                $nome_professores3 = "";
                $nome_professores_fisica = "";
                $aux_professores = "";
                $aux_professores2 = "";
                $ContLinhasProf = mysqli_num_rows($Consulta_professor);
//
                while ($Linha_Professor = mysqli_fetch_array($Consulta_professor)) {
                    $nome_professor = $Linha_Professor["nome"];
                    $funcao_professor = $Linha_Professor["funcao"];
                    $substituta = $Linha_Professor["substituta"];
                    $projeto = $Linha_Professor["projeto"];
                    //
                    if ($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] != 127) {

                        if ($substituta == "NAO" && $projeto == "NAO") {
                            $nome_professor = $Linha_Professor["nome"];
                            $nome_professores .= "$nome_professor";                            
                            //
                        } elseif ($substituta == "SIM") {
                            $nome_professor = $Linha_Professor["nome"];
                            $nome_professores2 .= "$nome_professor";                         
                            //
                        } elseif ($projeto == "SIM") {
                            $nome_professor = $Linha_Professor["nome"];
                            $nome_professores3 .= "$nome_professor";                           
                        }
                        //
                    } elseif (($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] = 127)) {
                        $nome_professor = $Linha_Professor["nome"];
                        $nome_professores_fisica .= "$nome_professor";
                       
                    } else {
                        if ($substituta == "SIM") {
                            $nome_aux_professor = $Linha_Professor["nome"];
                            $nome_professores2 .= "$nome_aux_professor";                         
                            //
                        } elseif ($projeto == "SIM") {
                            $nome_professor = $Linha_Professor["nome"];
                            $nome_professores3 .= "$nome_professor";                           
                            //
                        } else {
                            $nome_aux_professor = $Linha_Professor["nome"];
                            $aux_professores .= "$nome_aux_professor"."<br>";                            
                        }
                    }
                }
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                //
                $nome_turma = $Linha_turma["turma"];
                $turno_unico = $Linha_turma["unico"];
                $turno_turma = $Linha_turma["turno"];
                $turmaf = "$nome_turma $turno_unico ($turno_turma)";
                //
                $html .= '<td>' . $turmaf . '</td>';
                $html .= '<td>' . $row_Consulta["nome"] . '</td>';
                $nascimento = date('d/m/Y ', strtotime($row_Consulta["data_nascimento"]));
                $html .= '<td>' . $nascimento . '</td>';
                $html .= '<td>' . $row_Consulta["idade"] . '</td>';
                $html .= '<td>' . $row_Consulta["fone"] . '</td>';
                $html .= '<td>' . $row_Consulta["fone2"] . '</td>';
                $html .= '<td>' . $row_Consulta["mae"] . '</td>';
                $html .= '<td>' . $row_Consulta["profissao_mae"] . '</td>';
                $html .= '<td>' . $row_Consulta["pai"] . '</td>';
                $html .= '<td>' . $row_Consulta["profissao_pai"] . '</td>';
                $html .= '<td>' . $row_Consulta["nis"] . '</td>';
                $html .= '<td>' . $row_Consulta["bolsa_familia"] . '</td>';
                $html .= '<td>' . $row_Consulta["sus"] . '</td>';
                $html .= '<td>' . $row_Consulta["modelo_certidao"] . '</td>';
                $html .= '<td>' . $row_Consulta["matricula_certidao"] . '</td>';
                $html .= '<td>' . $row_Consulta["tipos_de_certidao"] . '</td>';
                $html .= '<td>' . $row_Consulta["certidao_civil"] . '</td>';
                $html .= '<td>' . $row_Consulta["data_expedicao"] . '</td>';
                $html .= '<td>' . $row_Consulta["naturalidade"] . '</td>';
                $html .= '<td>' . $row_Consulta["estado"] . '</td>';
                $html .= '<td>' . $row_Consulta["nacionalidade"] . '</td>';
                $html .= '<td>' . $row_Consulta["sexo"] . '</td>';
                $html .= '<td>' . $row_Consulta["endereco"] . '</td>';
                $html .= '<td>' . $row_Consulta["cidade"] . '</td>';
                $html .= '<td>' . $row_Consulta["estado_cidade"] . '</td>';
                $html .= '<td>' . $row_Consulta["necessidades"] . '</td>';
                $html .= '<td>' . $row_Consulta["transporte"] . '</td>';
                $html .= '<td>' . $row_Consulta["urbano"] . '</td>';
                $html .= '<td>' . $row_Consulta["ponto_onibus"] . '</td>';
                $html .= '<td>' . $row_Consulta["motorista"] . '</td>';
                $html .= '<td>' . $row_Consulta["motorista2"] . '</td>';
                $matricula = date('d/m/Y ', strtotime($row_Consulta["Data_matricula"]));
                $html .= '<td>' . $matricula . '</td>';
                $renovacao_matricula = date('d/m/Y ', strtotime($row_Consulta["data_renovacao_matricula"]));
                $html .= '<td>' . $renovacao_matricula . '</td>';
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
                $html .= '<td>' . $nome_turma . '</td>';
                $html .= '<td>' . $turno_unico . '</td>';
                $html .= '<td>' . $turno_turma . '</td>';
                $html .= '<td>' . $nome_professores . '</td>';
                $html .= '<td>' . $nome_professores_fisica . '</td>';
                $html .= '<td>' . $aux_professores . '</td>';
                $html .= '<td>' . $nome_professores2 . '</td>';
                $html .= '<td>' . $nome_professores3 . '</td>';

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
<!--if ($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] != 127 && $substituta != "SIM" && $projeto !== "SIM") {
                        $nome_professor = $Linha_Professor["nome"];
                        $nome_professores .= "$nome_professor  ";
                        //
                    } elseif ($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] != 127 && $substituta == "SIM") {
                        $nome_professor = $Linha_Professor["nome"];
                        $subs_professores .= "$nome_professor  ";
                        //
                    } elseif (($funcao_professor == "PROFESSOR(A)" && $Linha_Professor["id_professor"] = 127)) {
                        $nome_professor = $Linha_Professor["nome"];
                        $nome_professores_fisica .= "$nome_professor  ";
                        //
                    } elseif (($funcao_professor == "PROFESSOR(A)/AUXILIAR" && $substituta == "SIM" && $projeto !== "SIM")) {
                        $nome_professor = $Linha_Professor["nome"];
                        $subs_professores .= "$nome_professor  ";
                        //
                    } elseif (($funcao_professor == "PROFESSOR(A)/AUXILIAR"  && $projeto !== "SIM")) {
                        $nome_professor = $Linha_Professor["nome"];
                        $proj_professores .= "$nome_professor  ";
                        //
                    } else {
                        $nome_aux_professor = $Linha_Professor["nome"];
                        $aux_professores .= "$nome_aux_professor  ";
                    }-->