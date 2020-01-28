<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($Recebe_id == "1") {
    echo "<script type=\"text/javascript\">
		alert(\"Operações(s) Gravada(s) com Sucesso! \");
                </script>
                ";
} elseif ($Recebe_id == "2") {
    echo "<script type=\"text/javascript\">
		alert(\"Falta Adicionar os professores! \");
                </script>
                ";
} elseif ($Recebe_id == "3") {
    echo "<script type='text/javascript'>
                alert('Essa Turma já existe!');
          </script>
     ";
} elseif ($Recebe_id == "4") {
    echo "<script type='text/javascript'>
                alert('Turma(s) Atualizada(s) Com Sucesso!');
          </script>
     ";
} elseif ($Recebe_id == "5") {
    echo "<script type='text/javascript'>
                alert('Ops! Falha na Operação:)');
          </script>
     ";
}
?>
<html lang="pt-br">
    <head>
        <title>TURMAS</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="css/pesquisar_no_banco.css" rel="stylesheet" type="text/css"/>  
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/pesquisar_turmas_server.css" rel="stylesheet" type="text/css"/>
        <?php
        $ano = date('Y');
        $ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
        //
        $ConsultaV = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma_extra` LIKE 'NAO' AND `turno` LIKE 'MATUTINO' AND `status` LIKE 'OCUPADA' ORDER BY `ano` DESC,`turma` ASC ");
        $rowV = mysqli_num_rows($ConsultaV);
        echo "<form method= 'post' action='cadastrar_update_turma.php' name = 'form' onsubmit ='return validaCheckbox()' > ";
        ?>
        <div class="container-fluid">   
            <h3 style="text-align: center">Turmas Criadas</h3>
            <div class="row">
                <div class="col-sm-12">                        
                    <div class="col-sm-3">
                        <input type="checkbox" id="copiar" style="display: none" checked="">
                        <button type="submit" value="copiar" name="copiar" id="btcopiar" class="btn btn-primary btn-block" >Copiar/Atualizar Turmas </button>                                    
                    </div>
                    <div class="col-sm-3">                               
                        <button type="submit" value="listar" name="listar" id="btcopiar" class="btn btn-warning btn-block" >Listar Turmas Salvas</button>                                    
                    </div>
                    <div class="col-sm-3">                               
                        <button type="submit" value="todos_turnos" name="todos_turnos" id="btcopiar" class="btn btn-success btn-block" >Impressão Geral Em Excel</button>                                    
                    </div>
                </div>                             
            </div>
            <div class="container-fluid">           
                <div class="row">
                    <div class="col-sm-12" > 
                        <?php
                        echo" <h3>MATUTINO</h3>";
                        echo "<table class='table table-striped table-bordered' id='matutino'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>"
                        . "<div class='dropdown'>"
                        . "<input type='checkbox'  class = 'selecionar1'/>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><a><button type ='submit' value = 'manha' name = 'manha' class='btn btn-link' title = 'Impressão Manhã'><span class='glyphicon glyphicon-print btn-lg verde ' aria-hidden='true'></span></button>Impressão</a></li>"
                        . "<li><a><button type ='submit' name ='exclui_varias_turmas' value = '' onclick = 'return confirmarExclusao()' class = 'btn btn-link' title = 'Exclui Varias Turmas' ><span title= 'Exclui Varias Turmas' class='glyphicon glyphicon-remove btn-lg vermelho' aria-hidden='true'></span></button>Exclui varias Turmas</a></li>"
                        . "</ul>"
                        . "</div>"
                        . "</th>";
                        echo "<th> TURMA </th>";
                        echo "<th> MATRICULADOS </th>";
                        echo "<th> TRANFERIDOS </th>";
                        echo "<th> A.AD </th>";
                        echo "<th> DESISTENTES </th>";
                        echo "<th> CURSANDO </th>";
                        echo "<th> ANO </th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        if ($rowV > 0) {
                            while ($linhaV = mysqli_fetch_array($ConsultaV)) {
                                $idV = $linhaV['id'];
                                $ano_turma = date_format(new DateTime($linhaV['ano']), 'Y');
                                $turmaV = $linhaV['turma'];
                                $turnoV = $linhaV['turno'];
                                if ($ano_turma == "2018") {
                                    $unicoV = "";
                                } else {
                                    $unicoV = $linhaV['unico'];
                                }
                                //
                                $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $idV . "' AND excluido = 'N'");
                                $rowqtd = mysqli_fetch_array($ConsultaQtd);
                                $am = $rowqtd['AM'];
                                $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'TRANSFERIDO' AND excluido = 'N' ");
                                $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
                                $at = $rowqtd1['AT'];
                                $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'ADIMITIDO DEPOIS' AND excluido = 'N' ");
                                $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
                                $ad = $rowqtd2['AD'];
                                $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $idV . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ");
                                $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
                                $ac = $rowqtd3['AC'];
                                $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'DESISTENTE' AND excluido = 'N' ");
                                $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
                                $adesis = $rowqtd4['D'];
                                echo "<tr>";
                                //  echo "<td>" . $idV . "</td>\n";
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='turma_selecionada[]' class = 'checkbox1' value='$idV'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='cadastrar_turma.php?id=" . base64_encode($idV) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-plus verde' aria-hidden='true' >&nbsp;</span>Copiar a Turma</a></li>"
                                . "<li><a href='cadastrar_update_turma.php?id=" . base64_encode($idV) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href='excluir_turmas.php?id=" . base64_encode($idV) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Excluir</a></li>"
                                . "</td>";
                                echo "<td>" . $turmaV . " - " . $unicoV . "</td>\n";
                                echo "<td>" . $am . "</td>\n";
                                echo "<td class = 'text-danger'>" . $at . "</td>\n";
                                echo "<td>" . $ad . "</td>\n";
                                echo "<td>" . $adesis . "</td>\n";
                                echo "<td class = 'text-success'>" . $ac . "</td>\n";
                                echo "<td>" . $ano_turma . "</td>\n";
                                echo "</tr>";
                            }
                        } else {
                            echo "Nada enconrado.";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        ?>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" >
                        <h3>VESPERTINO</h3>
                        <?php
                        //  $ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas WHERE turno = 'VESPERTINO' AND `ano` LIKE '$ano%' ORDER BY turma ");
                        $ConsultaV = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma_extra` LIKE 'NAO' AND `turno` LIKE 'VESPERTINO' ORDER BY `ano` DESC,`turma` ASC ");
                        $rowV = mysqli_num_rows($ConsultaV);
                        //
                        echo "<form method= 'post' action='cadastrar_update_turma.php' name = 'form2' onsubmit ='return validaCheckbox2()'>";
                        echo "<table class='table table-striped table-bordered' id='vespertino'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>"
                        . "<div class='dropdown'>"
                        . "<input type='checkbox'  class = 'selecionar2'/>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><a><button type ='submit' value='tarde' name = 'tarde' class='btn btn-link' title = 'Impressão'><span class='glyphicon glyphicon-print btn-lg verde ' aria-hidden='true'></span></button>Impressão</a></li>"
                        . "<li><a><button type ='submit' name ='exclui_varias_turmas' value = '' onclick = 'return confirmarExclusao()' class = 'btn btn-link' title = 'Exclui Varias Turmas' ><span title= 'Exclui Varias Turmas' class='glyphicon glyphicon-remove btn-lg vermelho' aria-hidden='true'></span></button>Exclui varias Turmas</a></li>"
                        . "</ul>"
                        . "</div>"
                        . "</th>";
                        echo "<th> TURMA </th>";
                        echo "<th> MATRICULADOS </th>";
                        echo "<th> TRANFERIDOS </th>";
                        echo "<th> A.AD </th>";
                        echo "<th> DESISTENTES </th>";
                        echo "<th> CURSANDO </th>";
                        echo "<th> ANO </th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        if ($rowV > 0) {
                            while ($linhaV = mysqli_fetch_array($ConsultaV)) {
                                $idV = $linhaV['id'];
                                $ano_turma = date_format(new DateTime($linhaV['ano']), 'Y');
                                $turmaV = $linhaV['turma'];
                                $turnoV = $linhaV['turno'];
                                if ($ano_turma == "2018") {
                                    $unicoV = "";
                                } else {
                                    $unicoV = $linhaV['unico'];
                                }
                                //
                                $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $idV . "' AND excluido = 'N' ");
                                $rowqtd = mysqli_fetch_array($ConsultaQtd);
                                $am = $rowqtd['AM'];
                                $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'TRANSFERIDO' AND excluido = 'N' ");
                                $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
                                $at = $rowqtd1['AT'];
                                $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'ADIMITIDO DEPOIS' AND excluido = 'N' ");
                                $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
                                $ad = $rowqtd2['AD'];
                                $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $idV . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ");
                                $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
                                $ac = $rowqtd3['AC'];
                                $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'DESISTENTE' AND excluido = 'N' ");
                                $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
                                $adesis = $rowqtd4['D'];
                                echo "<tr>";
                                //  echo "<td>" . $idV . "</td>\n";
                                echo "<td>"
                                . "<div class = 'dropdown'>"
                                . "<input type = 'checkbox' name = 'turma_selecionada[]' class = 'checkbox2' value = '$idV'>"
                                . "&nbsp;&nbsp;<span class = 'glyphicon glyphicon-cog text-success' id = 'dropdownMenu1' data-toggle = 'dropdown' aria-haspopup = 'true' aria-expanded = 'true'></span>"
                                . "<ul class = 'dropdown-menu' aria-labelledby = 'dropdownMenu1'>"
                                . "<li><a href='cadastrar_turma.php?id=" . base64_encode($idV) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-plus verde' aria-hidden='true' >&nbsp;</span>Copiar a Turma</a></li>"
                                . "<li><a href = 'cadastrar_update_turma.php?id=" . base64_encode($idV) . "' target = '_self' title = 'Alterar'><span class = 'glyphicon glyphicon-pencil amarelo' aria-hidden = 'true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href = 'excluir_turmas.php?id=" . base64_encode($idV) . "' onclick ='return confirmarExclusao()' target = '_self' title = 'Excluir'><span class = 'glyphicon glyphicon-remove vermelho' aria-hidden = 'true'>&nbsp;</span>Excluir</a></li>"
                                . "</td>";
                                echo "<td>" . $turmaV . " - " . $unicoV . "</td>\n";
                                echo "<td>" . $am . "</td>\n";
                                echo "<td class = 'text-danger'>" . $at . "</td>\n";
                                echo "<td>" . $ad . "</td>\n";
                                echo "<td>" . $adesis . "</td>\n";
                                echo "<td class = 'text-success'>" . $ac . "</td>\n";
                                echo "<td>" . $ano_turma . "</td>\n";
                                echo "</tr>";
                            }
                        } else {
                            echo "Nada enconrado.";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        ?>   
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" >
                        <h3>NOTURNO</h3>
                        <?php
                        $ConsultaV = mysqli_query($Conexao, "SELECT * FROM turmas WHERE turno = 'NOTURNO' AND `status` LIKE 'OCUPADA' ORDER BY `ano` DESC,`turma` ASC ");
                        $rowV = mysqli_num_rows($ConsultaV);
                        //
                        echo "<form method= 'post' action='cadastrar_update_turma.php' name = 'form3' onsubmit ='return validaCheckbox3()' >";
                        echo "<table class='table table-striped table-bordered' id='noturno'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>"
                        . "<div class='dropdown'>"
                        . "<input type='checkbox'  class = 'selecionar3'/>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><a><button type ='submit' value='noite' name = 'noite' class='btn btn-link' title = 'Impressão'><span class='glyphicon glyphicon-print btn-lg verde ' aria-hidden='true'></span></button>Impressão</a></li>"
                        . "<li><a><button type ='submit' name ='exclui_varias_turmas' value = '' onclick = 'return confirmarExclusao()' class = 'btn btn-link' title = 'Exclui Varias Turmas' ><span title= 'Exclui Varias Turmas' class='glyphicon glyphicon-remove btn-lg vermelho' aria-hidden='true'></span></button>Exclui varias Turmas</a></li>"
                        . "</ul>"
                        . "</div>"
                        . "</th>";
                        echo "<th> TURMA </th>";
                        echo "<th> MATRICULADOS </th>";
                        echo "<th> TRANFERIDOS </th>";
                        echo "<th> A.AD </th>";
                        echo "<th> DESISTENTES </th>";
                        echo "<th> CURSANDO </th>";
                        echo "<th>  ANO</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        if ($rowV > 0) {
                            while ($linhaV = mysqli_fetch_array($ConsultaV)) {
                                $idV = $linhaV['id'];
                                $ano_turma = date_format(new DateTime($linhaV['ano']), 'Y');
                                $turmaV = $linhaV['turma'];
                                $unicoV = $linhaV['unico'];
                                //
                                $ConsultaQtd = mysqli_query($Conexao, "SELECT COUNT(*) AS AM FROM alunos WHERE turma LIKE '" . $idV . "' AND excluido = 'N' ");
                                $rowqtd = mysqli_fetch_array($ConsultaQtd);
                                $am = $rowqtd['AM'];
                                $ConsultaQtd1 = mysqli_query($Conexao, "SELECT COUNT(*) AS AT FROM alunos WHERE turma LIKE '" . $idV . "%' AND status = 'TRANSFERIDO' AND excluido = 'N' ");
                                $rowqtd1 = mysqli_fetch_array($ConsultaQtd1);
                                $at = $rowqtd1['AT'];
                                $ConsultaQtd2 = mysqli_query($Conexao, "SELECT COUNT(*) AS AD FROM alunos WHERE turma LIKE '" . $idV . "%' AND status = 'ADIMITIDO DEPOIS' AND excluido = 'N' ");
                                $rowqtd2 = mysqli_fetch_array($ConsultaQtd2);
                                $ad = $rowqtd2['AD'];
                                $ConsultaQtd3 = mysqli_query($Conexao, "SELECT COUNT(*) AS AC FROM alunos WHERE turma LIKE '" . $idV . "' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ");
                                $rowqtd3 = mysqli_fetch_array($ConsultaQtd3);
                                $ac = $rowqtd3['AC'];
                                $ConsultaQtd4 = mysqli_query($Conexao, "SELECT COUNT(*) AS D FROM alunos WHERE turma LIKE '" . $idV . "' AND status = 'DESISTENTE' AND excluido = 'N' ");
                                $rowqtd4 = mysqli_fetch_array($ConsultaQtd4);
                                $adesis = $rowqtd4['D'];
                                echo "<tr>";
                                //  echo "<td>" . $idV . "</td>\n";
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='turma_selecionada[]' class = 'checkbox3' value='$idV'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='cadastrar_turma.php?id=" . base64_encode($idV) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-plus verde' aria-hidden='true' >&nbsp;</span>Copiar a Turma</a></li>"
                                . "<li><a href='cadastrar_update_turma.php?id=" . base64_encode($idV) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href='excluir_turmas.php?id=" . base64_encode($idV) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Excluir</a></li>"
                                . "</td>";
                                echo "<td>" . $turmaV . " - " . $unicoV . "</td>\n";
                                echo "<td>" . $am . "</td>\n";
                                echo "<td class = 'text-danger'>" . $at . "</td>\n";
                                echo "<td>" . $ad . "</td>\n";
                                echo "<td>" . $adesis . "</td>\n";
                                echo "<td class = 'text-success'>" . $ac . "</td>\n";
                                echo "<td>" . $ano_turma . "</td>\n";
                                echo "</tr>";
                            }
                        } else {
                            echo "Nada enconrado.";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</form>";
                        ?>   
                    </div>
                </div>  
            </div>
        </div>
    </body>
    <!--INÍCIO DO MATUTINO-->
    <script>
        $(document).ready(function () {
            $('#matutino').DataTable({
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],
                "lengthMenu": [[7, 15, 20, 25, 35, 70, 100, -1], [7, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": "Turmas por Página _MENU_ <?php
                        echo ""
                        . "&nbsp;&nbsp;<a href='cadastrar_turma.php' target='_self' class='btn btn-success' >NOVA TURMA</a>"
                        ?>",
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
        });
    </script>
    <script>
        //Marcar ou Desmarcar todos os checkbox
        $(document).ready(function () {

            $('.selecionar1').click(function () {
                if (this.checked) {
                    $('.checkbox1').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox1').each(function () {
                        this.checked = false;
                    });
                }
            });

        });
    </script>
    <!-- VALIDA CHECKBOX-->
    <script language="javascript">
        function validaCheckbox() {
            var frm = document.form;
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
            alert("Nenhuma Turma foi Selecionada!");
            return false;
        }
    </script>
    <script>
        //Confimrar Exclusão
        function confirmarExclusaoTodos() {
            var r = confirm("Realmente deseja excluir Todas as Turmas?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>  
    <!--FIM DO MATUTINO-->
    <!--VESPERTINO-->
    <script>
        $(document).ready(function () {
            $('#vespertino').DataTable({
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],

                "lengthMenu": [[7, 15, 20, 25, 35, 70, 100, -1], [7, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": "Turmas por Página _MENU_ <?php echo "&nbsp;&nbsp;<a href='cadastrar_turma.php' target='_self' class='btn btn-success' >NOVA TURMA</a>" ?> ",
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
        });
    </script>
    <!--Marcar ou Desmarcar todos os checkbox-->    
    <script>
        $(document).ready(function () {

            $('.selecionar2').click(function () {
                if (this.checked) {
                    $('.checkbox2').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox2').each(function () {
                        this.checked = false;
                    });
                }
            });

        });
    </script>
    <!-- VALIDA CHECKBOX-->
    <script language="javascript">
        function validaCheckbox2() {
            var frm = document.form2;
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
            alert("Nenhuma Turma foi Selecionada!");
            return false;
        }
    </script>
    <!--FIM DO VESPERTINO-->
    <!--NOTURNO-->
    <script>
        $(document).ready(function () {
            $('#noturno').DataTable({
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],

                "lengthMenu": [[10, 15, 20, 25, 35, 70, 100, -1], [10, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": "Turmas por Página _MENU_ <?php echo "&nbsp;&nbsp;<a href='cadastrar_turma.php' target='_self' class='btn btn-success' >NOVA TURMA</a>" ?> ",
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
        });
    </script>
    <script>
        //Marcar ou Desmarcar todos os checkbox
        $(document).ready(function () {

            $('.selecionar3').click(function () {
                if (this.checked) {
                    $('.checkbox3').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox3').each(function () {
                        this.checked = false;
                    });
                }
            });

        });
    </script>
    <!-- VALIDA CHECKBOX-->
    <script language="javascript">
        function validaCheckbox3() {
            var frm = document.form3;
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
            alert("Nenhuma Turma foi Selecionada!");
            return false;
        }
    </script>    
</html>
