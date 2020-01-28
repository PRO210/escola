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
        $html .= '<td colspan = "3"><b>ESCOLA MUNICIPAL TABELIÃO RAUL GALINDO SOBRINHO</b></tr>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><b>Servidores</b></tr>';
        $html .= '<td colspan = "15" ><b></b></tr>';
        $html .= '</tr>';

        $html .= '<tr>';
// $html .= '<td><b>ID</b></td>';
        $html .= '<td><b>MATRICULA</b></td>';
        $html .= '<td><b>VÍNCULO</b></td>';
        $html .= '<td><b>FUNÇÃO</b></td>';
        $html .= '<td><b>RESUMO_FUNÇÃO</b></td>';
        $html .= '<td><b>TURMA</b></td>';
        $html .= '<td><b>TURNO</b></td>';
        $html .= '<td><b>NOME</b></td>';
        $html .= '<td><b>NASCIDO</b></td>';
        $html .= '<td><b>ANIVERSARIANTE</b></td>';
        $html .= '<td><b>CPF</b></td>';
        $html .= '<td><b>MODELO DA CERTIDÃO</b></td>';
        $html .= '<td><b>MATRICULA DA CERTIDÃO </b></td>';
        $html .= '<td><b>CERTIDÃO</b></td>';
        $html .= '<td><b>DADOS DA CERTIDÃO</b></td>';
        $html .= '<td><b>EXPEDIÇÃO</b></td>';
        $html .= '<td><b>ÓRGÃO EXPEDIDOR</b></td>';
        $html .= '<td><b>MÃE</b></td>';
        $html .= '<td><b>PAI</b></td>';
        $html .= '<td><b>FONE</b></td>';
        $html .= '<td><b>CELULAR</b></td>';
        $html .= '<td><b>EMAIL</b></td>';
        $html .= '<td><b>ENDEREÇO</b></td>';
        $html .= '<td><b>ESTADO CIVIL</b></td>';
        $html .= '<td><b>SOLTEIRO</b></td>';
        $html .= '<td><b>CASADO</b></td>';
        $html .= '<td><b>DIVORCIADO</b></td>';
        $html .= '<td><b>VIÚVO</b></td>';
        $html .= '<td><b>OUTROS</b></td>';

        $html .= '</tr>';

//Selecionar todos os itens da tabela 
        foreach (($_POST['servidor_selecionado']) as $lista_id) {
            $SQL_Consulta = " SELECT * FROM servidores WHERE `id` = '$lista_id' ";
            $Consulta = mysqli_query($Conexao, $SQL_Consulta);

            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
//
                if ($row_Consulta["funcao"] == "PROFESSOR(A)" || $row_Consulta["funcao"] == "PROFESSOR(A)/AUXILIAR") {
                    //
                    $SQL_Professor = "SELECT turmas_professor2.*,servidores.nome FROM `turmas_professor2`,servidores WHERE `turmas_professor2`.`id_professor` = '$lista_id' AND `turmas_professor2`.id_professor = servidores.id ORDER BY id DESC limit 1 ";
                    $Consulta_professor = mysqli_query($Conexao, $SQL_Professor);
                    $Linha_Professor = mysqli_fetch_array($Consulta_professor);
                    $id_turma = $Linha_Professor["id_turma"];
                    //
                    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$id_turma'";
                    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                    $Linha_turma = mysqli_fetch_array($Consulta_turma);
                    //                 
                    $nome_turma = $Linha_turma["turma"] . " - " . $Linha_turma["unico"];
                } else {
                    $nome_turma = "-------";
                }
                $html .= '<tr>';
                //  $html .= '<td>' . $row_Consulta["id"] . '</td>';
                $html .= '<td>' . $row_Consulta["matricula"] . '</td>';
                $html .= '<td>' . $row_Consulta["vinculo"] . '</td>';
                $html .= '<td>' . $row_Consulta["funcao"] . '</td>';
                $html .= '<td>' . $row_Consulta["resumo_funcao"] . '</td>';
                $html .= '<td>' . $nome_turma . '</td>';
                $html .= '<td>' . $row_Consulta["turno"] . '</td>';
                $html .= '<td>' . $row_Consulta["nome"] . '</td>';
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
                // $teste = date('d/m/Y', strtotime('+365 days', strtotime($row_Consulta["nascimento"])));
                $teste = $row_Consulta["nascimento"];
                if ($row_Consulta["nascimento"] == "0000-00-00" || $row_Consulta["nascimento"] == "0001-11-30") {
                    $nascimento = "";
                    $mes = "";
                }
                $html .= '<td>' . $nascimento . ' </td>';
                $html .= '<td>' . $mes . '</td>';
                $html .= '<td>' . $row_Consulta["cpf"] . '</td>';
                $html .= '<td>' . $row_Consulta["modelo_certidao"] . '</td>';
                $html .= '<td>' . $row_Consulta["matricula_certidao"] . '</td>';
                $html .= '<td>' . $row_Consulta["tipos_de_certidao"] . '</td>';
                $html .= '<td>' . $row_Consulta["dados_certidao"] . '</td>';
                $data_expedicao = date('d/m/y ', strtotime($row_Consulta["data_expedicao"]));
                $html .= '<td>' . $data_expedicao . '</td>';
                $html .= '<td>' . $row_Consulta["orgao_expedidor"] . '</td>';
                $html .= '<td>' . $row_Consulta["mae"] . '</td>';
                $html .= '<td>' . $row_Consulta["pai"] . '</td>';
                $html .= '<td>' . $row_Consulta["fone"] . '</td>';
                $html .= '<td>' . $row_Consulta["celular"] . '</td>';
                $html .= '<td>' . $row_Consulta["email"] . '</td>';
                $html .= '<td>' . $row_Consulta["endereco"] . '</td>';
                $html .= '<td>' . $row_Consulta["estado_civil"] . '</td>';
                $s = "";
                $c = "";
                $d = "";
                $v = "";
                $o = "";
                IF ($row_Consulta["estado_civil"] == "SOLTEIRO(A)") {
                    $s = "X";
                } elseif ($row_Consulta["estado_civil"] == "CASADO(A)") {
                    $c = "X";
                } elseif ($row_Consulta["estado_civil"] == "DIVORCIADO(A)") {
                    $d = "X";
                } elseif ($row_Consulta["estado_civil"] == "VIÚVO(A)") {
                    $v = "X";
                } elseif ($row_Consulta["estado_civil"] == "OUTROS") {
                    $o = "X";
                } 
                $html .= '<td>' . $s . '</td>';
                $html .= '<td>' . $c . '</td>';
                $html .= '<td>' . $d . '</td>';
                $html .= '<td>' . $v . '</td>';
                $html .= '<td>' . $o . '</td>';

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