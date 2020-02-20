<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>  
        <?php
        if ($_POST['botao'] == "manha") {
            // Definimos o nome do arquivo que será exportado
            $arquivo = 'Turmas Salvas.xls';
            // Criamos uma tabela HTML com o formato da planilha
            $html = '';
            $html .= '<table>';
            $html .= '<tr>';
            $html .= '<td><b>TURMA</b></td>';
//            $html .= '<td><b>MATRICULADOS</b></td>';
//            $html .= '<td><b>TRANSFERIDOS</b></td>';
//            $html .= '<td><b>ADMITIDO DEPOIS</b></td>';
//            $html .= '<td><b>DESISTENTES</b></td>';
//            $html .= '<td><b>CURSANDO</b></td>';
            $html .= '<td><b>ALUNOS</b></td>';
            $html .= '<td><b>PORTUGUÊS</b></td>';
            $html .= '<td><b>HISTÓRIA</b></td>';
            $html .= '<td><b>GEOGRAFIA</b></td>';
            $html .= '<td><b>MATEMÁTICA</b></td>';
            $html .= '<td><b>CIÊNCIAS</b></td>';
            $html .= '<td><b>ARTE</b></td>';
            $html .= '<td><b>RELIGIÃO</b></td>';
            $html .= '<td><b>ED. FÍSICA</b></td>';
            $html .= '<td><b>TOTAL DE HORAS</b></td>';
            $html .= '<td><b>FREQUÊNCIA</b></td>';
            $html .= '<td><b>RESULTADO</b></td>';
            $html .= '<td><b>RECUPERAÇÃO</b></td>';
            $html .= '<td><b>PROFESSOR(S)</b></td>';
            $html .= '<td><b>PROFESSOR(S) AUX</b></td>';
            $html .= '<td><b>PROFESSOR(S) SUBSTITUTO</b></td>';
            $html .= '<td><b>PROFESSOR(S) PROJETO</b></td>';
            $html .= '</tr>';
//
            foreach (($_POST['turma_selecionada']) as $lista_ids) {
                //Selecionar todos os itens da tabela 
                $nome_professores = '';
                $nome_professores2 = '';
                $nome_professores3 = '';
                $nome_aux = '';
                //
                $ConsultaV = mysqli_query($Conexao, "SELECT * FROM turma_backup WHERE id_turma = '$lista_ids'");
                //
                while ($linhaV = mysqli_fetch_array($ConsultaV)) {
                    //
                    $idV = $linhaV['id_turma'];
                    $ids = $linhaV['ids'];
                    //
                    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$idV'";
                    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                    $Linha_turma = mysqli_fetch_array($Consulta_turma);
                    //
                    $ano_turma = substr($Linha_turma["ano"], 0, -6);
                    $ano = substr($Linha_turma["ano"], 0, -6);
                    $unico_turma = $Linha_turma["unico"];
                    $nome_turma = $Linha_turma["turma"];
                    $turno_turma = $Linha_turma["turno"];
                    $categoria_turma = $Linha_turma["categoria"];
                    if ($ano_turma == "2018") {
                        $unico_turma = "";
                    }
                    $turmaf = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
                    //       
                    $nome_professores .= $linhaV['prof'] . " <br> ";
                    $nome_aux .= $linhaV['prof_aux'] . " <br> ";
                    $nome_professores2 = $linhaV['prof_subs'];
                    $nome_professores3 = $linhaV['prof_proj'];
                    //
                    $nomes = "";
                    $ids = $linhaV['ids'];
                    if ($ids !== "") {
                        $Consulta = mysqli_query($Conexao, "SELECT * FROM alunos WHERE `id` IN($ids) ORDER BY nome ");

                        if ($categoria_turma == "EDUCAÇÃO INFANTIL") {
                            while ($Linha = mysqli_fetch_array($Consulta)) {
                                $nome = $Linha['nome'];
                                $lista_id = $Linha['id'];

                                $html .= '<tr>';

                                $html .= '<td>' . $turmaf . '</td>';
                                $html .= '<td>' . $nome . '</td>';
                                //
                                include './pesquisar_no_banco_impressao_relatorio_todas_atas_infantil.php';

                                $html .= '</tr>';
                            }
                        } else {
                            while ($Linha = mysqli_fetch_array($Consulta)) {
                                $nome = $Linha['nome'];
                                $lista_id = $Linha['id'];

                                $html .= '<tr>';

                                $html .= '<td>' . $turmaf . '</td>';
                                $html .= '<td>' . $nome . '</td>';
                                //
                                include './pesquisar_no_banco_impressao_relatorio_todas_atas.php';

                                $html .= '</tr>';
                            }
                        }
                    } else {
                        $html .= '<tr>';
                        $html .= '<td>' . $turmaf . '</td>';
                        $html .= '</tr>';
                    }

                    //
//                    $am = $linhaV['matriculados'];
//                    $at = $linhaV['transferidos'];
//                    $ad = $linhaV['admitidos'];
//                    $adesis = $linhaV['desistentes'];
//                    $ac = $linhaV['cursando'];
//                    $ano = $linhaV['ano'];
//                    //
//                    $html .= '<tr>';
//                    $html .= '<td>' . $turmaf . '</td>';
//                    $html .= '<td>' . $am . '</td>';
//                    $html .= '<td>' . $at . '</td>';
//                    $html .= '<td>' . $ad . '</td>';
//                    $html .= '<td>' . $adesis . '</td>';
//                    $html .= '<td>' . $ac . '</td>';
//                    $html .= '<td>' . $nomes . '</td>';
//                    $html .= '<td>' . $nome_professores . '</td>';
//                    $html .= '<td>' . $nome_aux . '</td>';
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
            exit();
            //
            //
        } elseif ($_POST['botao'] == "ata") {
            //
            foreach (($_POST['turma_selecionada']) as $turmaf) {
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                //
                $categoria_turma = $Linha_turma["categoria"];
                $nome_turma = $Linha_turma["turma"];
                $turno_turma = $Linha_turma["turno"];
                $ano = substr($Linha_turma["ano"], 0, -6);
                //         
                if ($categoria_turma == "EDUCAÇÃO INFANTIL") {
                    include 'ata.php';
                } else {
                    include 'ata_2.php';
                }
            }
        } elseif ($_POST['botao'] == "ata_2") {
            foreach (($_POST['turma_selecionada']) as $turmaf) {
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                //
                $categoria_turma = $Linha_turma["categoria"];
                $nome_turma = $Linha_turma["turma"];
                $turno_turma = $Linha_turma["turno"];
                $ano = substr($Linha_turma["ano"], 0, -6);
                //
                include 'pesquisar_no_banco_impressao_relatorio_ata.php';
                break;
            }
        } elseif ($_POST['botao'] == "atualizar") {
            //
            include_once 'cadastrar_copia_turma_server.php';
            //
        } elseif ($_POST['botao'] == "retirar") {
            //
            include_once 'alunos_retirar_ata.php';
            //
        } elseif ($_POST['botao'] == "comparar") {
            //
            $ano = filter_input(INPUT_POST, 'ano_Atual', FILTER_DEFAULT);
            $ano_anterior = filter_input(INPUT_POST, 'ano_Anterior', FILTER_DEFAULT);
            include 'pesquisar_no_banco_impressao_relatorio_ata_comparar.php';
            //
            //Atualiza o status da atas     //Atualiza o status da atas     //Atualiza o status da atas 
        } elseif ($_POST['botao'] == "atualizar_status") {
            $turma = "";
            $status = "";
            foreach (($_POST['turma_selecionada']) as $key => $turmaf) {
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                //               
                $turma .= $Linha_turma["turma"] . " " . $Linha_turma["unico"] . " - " . $Linha_turma["turno"] . " ( " . substr($Linha_turma["ano"], 0, -6) . ") ,";
                $status .= $_POST['status'][$key] . ", ";
//
                $SQL_matricular = "UPDATE turma_backup SET pronta = '" . $_POST['status'][$key] . "' WHERE id_turma= '$turmaf'";
                $Consulta = mysqli_query($Conexao, $SQL_matricular);
            }
            if ($Consulta) {
                //Logar na Tabela log
                $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                        . "VALUES ( '$usuario_logado', 'Alterou o Status da(s) turma(s) : $turma para $status ', 'SIM', now())";
                $Consulta1 = mysqli_query($Conexao, $SQL_logar);
                //
                header("LOCATION: listar_copia_turma_server.php?id=1");
            } else {
                header("LOCATION: listar_copia_turma_server.php?id=2");
            }
            //
            //
        }
        ?>
    </body>
</html>