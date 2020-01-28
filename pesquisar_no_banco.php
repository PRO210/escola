<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_procura = "";
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ALUNOS ENCONTRADOS</title>
        <style>
            .vermelho{color: red;}
            #esconder_list{display: none; }
            #esconder_bt{display: inline-block; }
            @media (max-width: 825px) { #esconder_list{ display: inline;}
            }  

            @media (max-width: 825px) {#esconder_bt{display: none;}
            }                 

            @media (max-width: 825px) {#ocultar{display: none;}
            }  
        </style>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid">            
            <div class="row">
                <div class="col-sm-12" >
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
                    <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <script src="js/cadastrar_validar.js" type="text/javascript"></script>
                    <link href="css/tabela_atestado.css" rel="stylesheet" type="text/css"/>                 

                    <?php
                    $buscar_turmas = filter_input(INPUT_POST, 'inputturmaf', FILTER_DEFAULT);
                    //
                    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$buscar_turmas'";
                    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                    $Linha_turma = mysqli_fetch_array($Consulta_turma);
                    //
                    $nome_turma = $Linha_turma["turma"];
                    $unico_turma = $Linha_turma["unico"];
                    $turno_turma = $Linha_turma["turno"];
                    $ano_turma = substr($Linha_turma["ano"], 0, -6);
                    $buscar_turmas2 = "$nome_turma($turno_turma)";

                    //
                    $buscarf_nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
                    $nis = filter_input(INPUT_POST, 'inputNis', FILTER_DEFAULT);
                    $naturalidade = filter_input(INPUT_POST, 'inputNaturalidade', FILTER_DEFAULT);
                    //
                    $estado = filter_input(INPUT_POST, 'inputEstado', FILTER_DEFAULT);
                    if ($estado == !"") {
                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `tb_estados` WHERE `id` LIKE '$estado' ");
                        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
                        $cidade = $Registro["nome"];
                        $estado = "$cidade";
                    }
//                    echo"$estado";
//                    echo"$naturalidade";                  
                    //
                    $status_recebe = filter_input(INPUT_POST, 'inputStatus', FILTER_DEFAULT);
                    $status = "";
                    if ($status_recebe == "cursando") {
                        $status = "(status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND";
                        //
                    } elseif ($status_recebe == "branco") {
                        $status = "";
                        //
                    } elseif ($status_recebe == "fora") {
                        $status = "(status = 'TRANSFERIDO' OR status = 'DESISTENTE') AND";
                        //
                    } else {
                        $status = "(status = '" . $status_recebe . "')AND";
                    }
                    // $data_nascimento = filter_input(INPUT_POST, 'inpuData_nascimento', FILTER_DEFAULT);
                    //$nascimento = substr($data_nascimento, 6, 4) . '-' . substr($data_nascimento, 3, 2) . '-' . substr($data_nascimento, 0, 2);
                    //
                    //Procurar o Aluno no caso de acontecido Suspeita deDuplicade
                    if ($Recebe_id == "") {
                        
                    } else {
                        $buscar_turmas = "3";
                        $id_procura = base64_decode($Recebe_id);
                        $Consulta = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR, data_nascimento, now()) AS idade FROM alunos WHERE `id` = '$id_procura' ");
                        $linha = mysqli_fetch_array($Consulta);
                        $nome = $linha['nome'];
                    }
                    //
                    if ($buscar_turmas == "") {
                        //
                        echo "<h3>TODAS AS TURMAS</h3>";
                        $Consultaf = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,now()) AS idade FROM alunos WHERE `nome` LIKE '%" . $buscarf_nome . "%' AND `turma` LIKE '%" . $buscar_turmas . "%' AND naturalidade LIKE '%" . $naturalidade . "%' AND estado LIKE '%" . $estado . "%' AND $status excluido = 'N' ORDER BY nome ASC");
                        $rowf = mysqli_num_rows($Consultaf);
                        //
                        if ($rowf > 0) {
                            echo "<form method= 'post'  action='atualizar_varios.php' name = 'form1' >";
                            ?>
                            <!-- Modal Turmas-->
                            <div class="modal fade" id="myModal_Turmas" role="dialog" >
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content" style="mar">
                                        <div class="modal-header">
                                            <button type="button btn-lg" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente aos Alunos</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            echo " <a><input style='margin-bottom: 6px;' type='submit' value='Editar em Bloco' class = 'form-control btn btn-primary' onclick= 'return validaCheckbox()'></a>";
                                            echo " <a href='cadastrar.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;' >Cadastrar Novato</a>";
                                            echo " <a href='cadastrar_transferido.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;'>Cadastrar Transferido</a>";
                                            ?>
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>        
                            <?php
                            echo " <input type='text' hidden='' name='pesquisar_no_banco' >";
                            //
                            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                            echo "<thead>";
                            echo "<tr>";

                            echo "<th>"
                            . "<div class='dropdown'>"
                            . "<input type='checkbox'  class = 'selecionar'/>"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link btn-sm verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print' aria-hidden='true'></span></button>Básica</a></li>"
                            . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
                            . "</ul>"
                            . "&nbsp;&nbsp;INEP"
                            . "</div>"
                            . "</th>";
                            echo "<th> NOME </th>";
                            echo "<th id = 'ocultar'> NASCIDO </th>";
                            echo "<th id = 'ocultar'> MÃE </th>";
                            echo "<th id = 'ocultar'> IDADE </th>";
                            echo "<th> TURMA </th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr>";
                            echo "<th> Nada </th>";
                            echo "<th> NOME </th>";
                            echo "<th id = 'ocultar'> NASCIDO </th>";
                            echo "<th id = 'ocultar'> MÃE </th>";
                            echo "<th id = 'ocultar'> IDADE </th>";
                            echo "<th> TURMA </th>";
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            //
                            while ($linhaf = mysqli_fetch_array($Consultaf)) {
                            //
                                $inep = $linhaf['inep'];
                                $nomef = $linhaf['nome'];
                                $data_nascimentof = new DateTime($linhaf["data_nascimento"]);
                                $nascimento = date_format($data_nascimentof, 'd/m/Y');
                                $maef = $linhaf['mae'];
                                $turmaf = $linhaf['turma'];
                                //
                                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                                //
                                $ano_turma = substr($Linha_turma["ano"], 0, -6);
                                $nome_turma = $Linha_turma["turma"];
                                $turno_turma = $Linha_turma["turno"];

                                if ($ano_turma == "2018") {
                                    $unico_turma = "";
                                } else {
                                    $unico_turma = $Linha_turma["unico"];
                                }
                                $turmaf = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
                                //
                                $idf = $linhaf['id'];
                                $statusf = $linhaf['status'];
                                $idade = $linhaf['idade'];
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                                . "<li><a href='declaracoes_bolsa_familia.php?id=$idf' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>"
                                . "<li><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                                . "<li><a href='cadastrar_historico.php?id=" . base64_encode($idf) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferência</a></li>"
                                . "</div>"
                                . "</u>"
                                . " " . $inep . " "
                                . "</td>";
                                echo "<td>" . $nomef . "</td>\n";
                                echo "<td id = 'ocultar'> " . $nascimento . " </td>\n";
                                echo "<td id = 'ocultar'>" . $maef . "</td>\n";
                                echo "<td id = 'ocultar'>" . $idade . "</td>\n";
                                echo "<td>" . $turmaf . "</td>\n";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</form>";
                        } else {
                            echo "Nada enconrado.";
                        }
                        //Buscar Por NIS
                    } elseif ($buscar_turmas == "2") {                        
                        $Consultaf_nis = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR, data_nascimento, now()) AS idade FROM alunos WHERE `nis` = '$nis ' AND $status excluido = 'N' ORDER BY nome");
                        $rowf_nis = mysqli_num_rows($Consultaf_nis);
                        echo "<h3>CONSULTA POR NIS</h3>";
                        if ($rowf_nis > 0) {
                            echo "<form method = 'post' action = 'atualizar_varios.php' name= 'form1' >";
                            echo " <input type='text' hidden='' name='pesquisar_no_banco' >";
                            ?>
                            <!-- Modal Turmas-->
                            <div class="modal fade" id="myModal_Turmas" role="dialog" >
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content" style="mar">
                                        <div class="modal-header">
                                            <button type="button btn-lg" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente aos Alunos</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            echo " <a><input style='margin-bottom: 6px;' type='submit' value='Editar em Bloco' class = 'form-control btn btn-primary' onclick= 'return validaCheckbox()'></a>";
                                            echo " <a href='cadastrar.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;' >Cadastrar Novato</a>";
                                            echo " <a href='cadastrar_transferido.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;'>Cadastrar Transferido</a>";
                                            ?>
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>        
                            <?php
                            echo "<table class = 'table table-striped table-bordered' id = 'tbl_alunos_lista'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>"
                            . "<div class='dropdown'>"
                            . "<input type='checkbox'  class = 'selecionar'/>"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog  text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><button type='submit' value='basica' name = 'basica' class='btn btn-success' onclick= 'return validaCheckbox()'>Impressão Básica</button></li>"
                            . "<li><button type='submit' value='geral' name = 'geral' class='btn btn-success' onclick= 'return validaCheckbox()'>Impressão Geral</button></li>"
                            . "</ul>"
                            . "</div>"
                            . "</th>"
                            ;
                            echo "<th> NOME </th>";
                            echo "<th id = 'ocultar'> NASCIDO </th>";
                            echo "<th id = 'ocultar'> IDADE </th>";
                            echo "<th id = 'ocultar'> MÃE </th>";
                            echo "<th> NIS </th>";
                            echo "<th> TURMA </th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr>";
                            echo "<th> Nada </th>";
                            echo "<th> NOME </th>";
                            echo "<th id = 'ocultar'> NASCIDO </th>";
                            echo "<th id = 'ocultar'> IDADE </th>";
                            echo "<th id = 'ocultar'> MÃE </th>";
                            echo "<th> NIS </th>";
                            echo "<th> TURMA </th>";
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            //
                            while ($linhaf_nis = mysqli_fetch_array($Consultaf_nis)) {
                                $nomef_nis = $linhaf_nis['nome'];
                                $data_nascimentof_nis = new DateTime($linhaf_nis["data_nascimento"]);
                                $nascimentof_nis = date_format($data_nascimentof_nis, 'd/m/Y');
                                $idade_nis = $linhaf_nis['idade'];
                                $maef_nis = $linhaf_nis['mae'];
                                $pai = $linhaf_nis['pai'];
                                $nisf_nis = $linhaf_nis['nis'];
                                $idf = $linhaf_nis['id'];
                                $turmaf_nis = $linhaf_nis['turma'];
                                //
                                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf_nis'";
                                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                                //
                                $ano_turma = substr($Linha_turma["ano"], 0, -6);
                                $nome_turma = $Linha_turma["turma"];
                                $turno_turma = $Linha_turma["turno"];

                                if ($ano_turma == "2018") {
                                    $unico_turma = "";
                                } else {
                                    $unico_turma = $Linha_turma["unico"];
                                }
                                $turmaf_nis = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
                                echo "<tr>";
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a  href='impressao.php?id=$idf' target='_blank' title='Imprimir'><span class='glyphicon glyphicon-print verde ' aria-hidden='true' >&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                                . "<li><a href='declaracoes_bolsa_familia.php?id=$idf' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>"
                                . "<li><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                                . "<li><a href='cadastrar_historico.php?id=" . base64_encode($idf) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferência</a></li>"
                                . "</ul>"
                                . "</div>"
                                . "</td>";
                                echo "<td>" . $nomef_nis . "</td>\n";
                                echo "<td id = 'ocultar'>" . $nascimentof_nis . "</td>\n";
                                echo "<td id = 'ocultar'>" . $idade_nis . "</td>\n";
                                echo "<td id = 'ocultar'>" . $maef_nis . "</td>\n";
                                echo "<td>" . $nisf_nis . "</td>\n";
                                echo "<td>" . $turmaf_nis . "</td>\n";

                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            //echo "<input type = 'submit' value = 'Editar em Bloco' <a href = 'atualizar_varios.php' target = '_blank' class = 'btn btn-success'>";
                            echo "</form>";
                        } else {
                            echo "Nada enconrado.";
                        }
                        //Procurar pelo Id do Aluno(a)
                    } elseif ($buscar_turmas == "3") {

                        echo "<h3>POSSÍVEL CASO DE DUPLICIDADE</h3>";
                        $Consultaf_nome = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR, data_nascimento, now()) AS idade FROM alunos WHERE `nome` LIKE '%$nome%' ");
                        $rowf = mysqli_num_rows($Consultaf_nome);
                        if ($rowf > 0) {
                            echo "<form method = 'post' action = 'atualizar_varios.php' name= 'form1'>";
                            echo " <input type='text' hidden='' name='pesquisar_no_banco' >";
                            ?>
                            <!-- Modal Turmas-->
                            <div class="modal fade" id="myModal_Turmas" role="dialog" >
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content" style="mar">
                                        <div class="modal-header">
                                            <button type="button btn-lg" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente aos Alunos</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            echo " <a><input style='margin-bottom: 6px;' type='submit' value='Editar em Bloco' class = 'form-control btn btn-primary' onclick= 'return validaCheckbox()'></a>";
                                            echo " <a href='cadastrar.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;' >Cadastrar Novato</a>";
                                            echo " <a href='cadastrar_transferido.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;'>Cadastrar Transferido</a>";
                                            ?>
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>        
                            <?php
                            echo "<table class = 'table table-striped table-bordered' id = 'tbl_alunos_lista'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>"
                            . "<div class='dropdown'>"
                            . "<input type='checkbox'  class = 'selecionar'/>"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link btn-sm verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print' aria-hidden='true'></span></button>Básica</a></li>"
                            . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
                            . "</ul>"
                            . "&nbsp;&nbsp;INEP"
                            . "</div>"
                            . "</th>";
                            echo "<th> ID </th>";
                            echo "<th> NOME </th>";
                            echo "<th> NASCIDO </th>";
                            echo "<th id = 'ocultar'> IDADE </th>";
                            echo "<th id = 'ocultar'> MÃE </th>";
                            echo "<th id = 'ocultar'> NIS </th>";
                            echo "<th id = 'ocultar'> STATUS </th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr>";
                            echo "<th> Nada </th>";
                            echo "<th> ID </th>";
                            echo "<th> NOME </th>";
                            echo "<th> NASCIDO </th>";
                            echo "<th id = 'ocultar'> IDADE </th>";
                            echo "<th id = 'ocultar'> MÃE </th>";
                            echo "<th id = 'ocultar'> NIS </th>";
                            echo "<th id = 'ocultar'> STATUS </th>";
                            //                       
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            //
                            while ($linhaf = mysqli_fetch_array($Consultaf_nome)) {
                                //
                                $inep = $linhaf['inep'];
                                $nomef = $linhaf['nome'];
                                $data_nascimentof = new DateTime($linhaf['data_nascimento']);
                                $nascimentof = date_format($data_nascimentof, 'd/m/Y');
                                $idade = $linhaf['idade'];
                                $maef = $linhaf['mae'];
                                $nisf = $linhaf['nis'];
                                $idf = $linhaf['id'];
                                $status = $linhaf['status'];
                                $excluido = $linhaf['excluido'];
                                //
                                $cor = "";
                                if ($excluido == "S") {
                                    $status = "ARQUIVADO";
                                    $cor = "style= 'color:red'";
                                }
                                if ($excluido == "N") {
                                    $excluido = $linhaf['excluido'];
                                    $cor = "style= 'color:green'";
                                }
                                echo "<tr>";
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir'><span class='glyphicon glyphicon-print verde ' aria-hidden='true' >&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                                . "<li><a href='declaracoes_bolsa_familia.php?id=$idf' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>"
                                . "<li><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                                . "<li><a href='cadastrar_historico.php?id=" . base64_encode($idf) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferência</a></li>"
                                . "<li><a href='excluir_aluno.php?id=" . base64_encode($idf) . "' target='_self' title='Excluir Aluno(a)' onclick='return confirmar()'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Excluir Aluno(a)</a></li>"
                                . "</ul>"
                                . " " . $inep . " "
                                . "</div>"
                                . "</td>";

                                echo "<td>" . $idf . "</td>\n";
                                echo "<td>" . $nomef . "</td>\n";
                                echo "<td>" . $nascimentof . "</td>\n";
                                echo "<td id = 'ocultar'>" . $idade . "</td>\n";
                                echo "<td id = 'ocultar'>" . $maef . "</td>\n";
                                echo "<td id = 'ocultar'>" . $nisf . "</td>\n";
                                echo "<td $cor>" . $status . "</td>\n";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</form>";
                        } else {
                            echo "Nada enconrado.";
                        }
                        // Turma Especifica                          // Turma Especifica 
                    } else {
                        echo "<h3>$buscar_turmas2 $unico_turma - $ano_turma </h3>";
                        $estado_3 = "";
                        if ($estado == "") {
                            $estado_3 = "";
                        } else {
                            $estado_3 = "AND `estado` LIKE '" . $estado . "'";
                        }
                        $naturalidade_3 = "";
                        if ($naturalidade == "") {
                            $naturalidade_3 = "";
                        } else {
                            $naturalidade_3 = "AND `naturalidade` LIKE '" . $naturalidade . "'";
                        }

                        $Consultaf_nome = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR, data_nascimento, now()) AS idade FROM alunos WHERE `nome` LIKE '%" . $buscarf_nome . "%' AND `turma` LIKE '%" . $buscar_turmas . "%' $naturalidade_3 $estado_3 AND $status excluido = 'N' ORDER BY `nome` ASC ");
                        $rowf = mysqli_num_rows($Consultaf_nome);
                        if ($rowf > 0) {
                            echo "<form method = 'post' action = 'atualizar_varios.php' name= 'form1'>";
                            echo " <input type='text' hidden='' name='pesquisar_no_banco' >";
                            ?>
                            <!-- Modal Turmas-->
                            <div class="modal fade" id="myModal_Turmas" role="dialog" >
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content" style="mar">
                                        <div class="modal-header">
                                            <button type="button btn-lg" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente aos Alunos</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            echo " <a><input style='margin-bottom: 6px;' type='submit' value='Editar em Bloco' class = 'form-control btn btn-primary' onclick= 'return validaCheckbox()'></a>";
                                            echo " <a href='cadastrar.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;' >Cadastrar Novato</a>";
                                            echo " <a href='cadastrar_transferido.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;'>Cadastrar Transferido</a>";
                                            ?>
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>        
                            <?php
                            echo "<table class = 'table table-striped table-bordered' id = 'tbl_alunos_lista'>";
                            echo "<thead>";
                            echo "<tr>";
                            // echo "<th> ID </th>";
                            echo "<th>"
                            . "<div class='dropdown'>"
                            . "<input type='checkbox'  class = 'selecionar'/>"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link btn-sm verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print' aria-hidden='true'></span></button>Básica</a></li>"
                            . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
                            . "</ul>"
                            . "&nbsp;&nbsp;INEP"
                            . "</div>"
                            . "</th>";
                            echo "<th> NOME </th>";
                            echo "<th> NASCIDO </th>";
                            echo "<th id = 'ocultar'> IDADE </th>";
                            echo "<th id = 'ocultar'> MÃE </th>";
                            echo "<th id = 'ocultar'> NIS </th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr>";
                            echo "<th> Nada </th>";
                            echo "<th> NOME </th>";
                            echo "<th> NASCIDO </th>";
                            echo "<th id = 'ocultar'> IDADE </th>";
                            echo "<th id = 'ocultar'> MÃE </th>";
                            echo "<th id = 'ocultar'> NIS </th>";
//                       
                            echo "</tr>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            //
                            while ($linhaf = mysqli_fetch_array($Consultaf_nome)) {
//
                                $inep = $linhaf['inep'];
                                $nomef = $linhaf['nome'];
                                $data_nascimentof = new DateTime($linhaf['data_nascimento']);
                                $nascimentof = date_format($data_nascimentof, 'd/m/Y');
                                $idade = $linhaf['idade'];
                                $maef = $linhaf['mae'];
                                $nisf = $linhaf['nis'];
                                $idf = $linhaf['id'];
                                $excluido = $linhaf['excluido'];
                                $status_ext = $linhaf['status_ext'];
                                $display2 = "";
                                $display3 = "";
                                if ($status == "TRANSFERIDO") {
                                    $display = "bloco";
                                } else {
                                    $display = "none";
                                }
                                if ($excluido == "S") {
                                    $status = "ARQUIVADO";
                                    $ap = $linhaf['ap_pasta'];
                                    $display2 = "none";
                                    $turmaf = "----";
                                } else {
                                    $status = $linhaf['status'];
                                    $ap = "-----";
                                    $display3 = "none";
                                }
                                echo "<tr>";
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                                . "<li><a href='folha_re_matricula.php?id=$idf' target='_blank' title='Imprimir Folha de Ré Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Ré Matricula</a></li>"
                                . "<li><a href='declaracoes_bolsa_familia.php?id=$idf' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>"
                                . "<li style = 'display :" . $display . "'><a href='impressao_transferencia_provisoria_tratamento.php?id=$idf' target='_blank' title='Imprimir Declaração de Transferência'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Transferência</a></li>"
                                . "<li style = 'display :" . $display2 . "'><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>"
                                . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_blanc' title='Mostrar'><span class='glyphicon glyphicon-user rosa' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>"
                                . "<li><a href='cadastrar_historico.php?id=" . base64_encode($idf) . "' target='_blank' title='Histórico' ><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>"
                                . "</ul>"
                                . " " . $inep . " "
                                . "</div>"
                                . "</td>";

                                echo "<td>" . $nomef . "</td>\n";
                                echo "<td>" . $nascimentof . "</td>\n";
                                echo "<td id = 'ocultar'>" . $idade . "</td>\n";
                                echo "<td id = 'ocultar'>" . $maef . "</td>\n";
                                echo "<td id = 'ocultar'>" . $nisf . "</td>\n";
                                //echo "<td>" . $status_extra . "</td>\n";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</form>";
                        } else {
                            echo "Nada enconrado.";
                        }
                    }
                    ?>
                    <script>
                        $(document).ready(function () {

                            // Setup - add a text input to each footer cell
                            $('#tbl_alunos_lista tfoot th').each(function () {
                                var title = $(this).text();
                                $(this).html('<input type="text" placeholder=" ' + title + '" />');
                            });

                            //Data Table
                            var table = $('#tbl_alunos_lista').DataTable({

                                "columnDefs": [{
                                        "targets": 0,
                                        "orderable": false
                                    }],

                                "lengthMenu": [[10, 15, 20, 25, 35, 70, 100, -1], [10, 15, 20, 25, 35, 70, 100, "All"]],
                                "language": {
                                    "lengthMenu": "Alunos _MENU_ <?php
                    echo ""
                    . "&nbsp;<a href='cadastrar_transferido.php' target='_self' class = 'btn btn-success' id = 'esconder_bt'>Cadastrar</a>"
                    . "<button type='button' class='btn btn-link btn-lg verde glyphicon glyphicon-cog ' data-toggle='modal' data-target='#myModal_Turmas' id = 'esconder_list'></button>"
                    . "&nbsp;<input type='submit' value='Editar em Bloco' class = 'btn btn-primary' id = 'esconder_bt' onclick= 'return validaCheckbox()'>";
                    ;
                    ?> ",
                                    "zeroRecords": "Nenhum aluno encontrado",
                                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                                    "infoEmpty": "Sem registros",
                                    "search": "Busca:",
                                    "infoFiltered": "(filtrado de _MAX_ total de alunos)",
                                    "paginate": {
                                        "first": "Primeira",
                                        "last": "Ultima",
                                        "next": "Proxima",
                                        "previous": "Anterior"
                                    },
                                    "aria": {
                                        "sortAscending": ": ative a ordenação cressente",
                                        "sortDescending": ": ative a ordenação decressente"
                                    }

                                }

                            });
                            // Apply the search
                            table.columns().every(function () {
                                var that = this;
                                $('input', this.footer()).on('keyup change', function () {
                                    if (that.search() !== this.value) {
                                        that
                                                .search(this.value)
                                                .draw();
                                    }
                                });
                            });
                        });

                    </script>                          
                    <script language="javascript">
                        function validaCheckbox() {
                            var frm = document.form1;
                            //Percorre os elementos do formulário
                            for (i = 0; i < frm.length; i++) {
                                //Verifica se o elemento do formulário corresponde a um checkbox 
                                if (frm.elements[i].type == "checkbox") {
                                    //Verifica se o checkbox foi selecionado
                                    if (frm.elements[i].checked) {
                                        //alert("Exite ao menos um checkbox selecionado!");
                                        return true;
                                    }
                                }
                            }
                            alert("Nenhum Aluno foi selecionado!");
                            return false;
                        }
                    </script>
                    <script>
                        //Marcar ou Desmarcar todos os checkbox
                        $(document).ready(function () {

                            $('.selecionar').click(function () {
                                if (this.checked) {
                                    $('.checkbox').each(function () {
                                        this.checked = true;
                                    });
                                } else {
                                    $('.checkbox').each(function () {
                                        this.checked = false;
                                    });
                                }
                            });

                        });
                    </script>
                    <script type="text/javascript">
                        function confirmar() {
                            var u = "<?php echo $usuario_logado ?>";
                            var r = confirm("Posso Enviar " + u + "? ");
                            if (r == true) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>
