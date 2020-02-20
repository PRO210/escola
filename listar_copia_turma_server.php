<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$Msg = "";
$M = "";

if ($Recebe_id == "1") {
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Alterações Gravadas com Sucesso! </div>";
    $M = "1";
} elseif ($Recebe_id == "2") {
    $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ops! Alguma Coisa Deu errado Tente de Novo ou Entre em Contato com o Administrador </div>";
    $M = "1";
}
?>
<html lang="pt-br">
    <head>
        <title>TURMAS SALVAS</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <style>
            .vermelho{
                color: red;
            }
            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                padding: 4px !important;
                font-size: 14px !important;
            }
            input[type="checkbox"]{
                display: inline-block;
            }
        </style>
    </head>   
    <body> 
        <?php
        include_once './menu.php';
        ?>  
        <div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo $Msg;
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div> 
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="css/pesquisar_no_banco.css" rel="stylesheet" type="text/css"/>  
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/pesquisar_turmas_server.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <?php
        if ($M == "1") {
            echo"<script type='text/javascript'>
                $(document).ready(function () {
                    $('#exemplomodal').modal('show');                    
                       });
            </script>";
            echo"<script type='text/javascript'>                           
                    var intervalo = window.setInterval(fechar, 4000);
                        function fechar() {                      
                            $('#exemplomodal').modal('hide');
                       }                 
            </script>";
        }
        ?>
        <div class="container-fluid">           
            <div class="row">  
                <div class="col-sm-12">                 
                    <?php
                    $ConsultaV = mysqli_query($Conexao, "SELECT turma_backup.*,turmas.turma,turmas.unico FROM `turma_backup`,turmas WHERE turma_backup.id_turma = turmas.id ORDER BY `turmas`.`ano` DESC,turmas.turma ASC,turmas.unico ASC");
                    $rowV = mysqli_num_rows($ConsultaV);

                    if ($rowV > 0) {
                        echo "<form method= 'post' action='listar_copia_turma_server2.php' name = 'form' onsubmit ='return validaCheckbox()' > ";
                        ?>
                        <!-- Modal -->          <!-- Modal -->   <!-- Modal -->          <!-- Modal -->
                        <div class="modal fade " id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg ">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Comparação</h4>
                                    </div>                    
                                    <div class="modal-body">                     
                                        <div class="row">
                                            <div class="form-group col-sm-12">                               
                                                <label for="" class="col-sm-4 control-label" id="">Ano Anterior</label>
                                                <div class="col-sm-8">                                    
                                                    <?php
                                                    $Consulta_historico = mysqli_query($Conexao, "SELECT * FROM `bimestre_i`  GROUP BY `ano`");
                                                    $Linha_historico = mysqli_num_rows($Consulta_historico);
                                                    if ($Linha_historico > 0) {
                                                        ?>
                                                        <select class='form-control' name='ano_Anterior' style="width: 100% !important" id="">   
                                                            <?php
                                                            echo "<option  selected = '' value = ''>Escolha o Ano Para Visualizar</option>";
                                                            while ($registro = mysqli_fetch_array($Consulta_historico, MYSQLI_BOTH)) {
                                                                $ano = $registro['ano'];
                                                                echo "<option>$ano</option>";
                                                            }
                                                            ?>
                                                        </select> 
                                                        <?php
                                                    } else {
                                                        
                                                    }
                                                    ?>
                                                </div>
                                            </div>  
                                        </div><br>
                                        <div class="row">
                                            <div class="form-group col-sm-12">                               
                                                <label for="" class="col-sm-4 control-label" id="">Ano Atual</label>
                                                <div class="col-sm-8">                                    
                                                    <?php
                                                    $Consulta_historico = mysqli_query($Conexao, "SELECT * FROM `bimestre_i` GROUP BY `ano`");
                                                    $Linha_historico = mysqli_num_rows($Consulta_historico);
                                                    if ($Linha_historico > 0) {
                                                        ?>
                                                        <select class='form-control' name='ano_Atual' style="width: 100% !important" id="">   
                                                            <?php
                                                            echo "<option  selected = '' value = ''>Escolha o Ano Para Visualizar</option>";
                                                            while ($registro = mysqli_fetch_array($Consulta_historico, MYSQLI_BOTH)) {
                                                                $ano = $registro['ano'];
                                                                echo "<option>$ano</option>";
                                                            }
                                                            ?>
                                                        </select> 
                                                        <?php
                                                    } else {
                                                        
                                                    }
                                                    ?>
                                                </div>
                                            </div>  
                                        </div><br>
                                        <button type="submit" name ="botao" value="comparar"  class="btn btn-success btn-block" onclick="" >Enviar Solicitação </button> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Continuar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h3 style = 'text-align:center;'>TURMAS SALVAS</h3>            
                            <div class="col-sm-3">
                                <a href="pesquisar_turmas_server.php" ><button type="button" class="btn btn-large btn-block btn-primary" style="margin-bottom: 12px !important">Voltar Para A Página Anterior</button></a>
                            </div> 
                            <div class="col-sm-3">
                                <button type="submit" name="botao" value="atualizar_status" class="btn btn-large btn-block btn-success" style="margin-bottom: 12px !important">Atualizar o Status</button>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" value="atualizar" name="botao" id="" class="btn btn-warning btn-block" >Atualizar Turmas </button>                                    
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" value="retirar" name="botao" id="retirar" class="btn btn-danger btn-block " disabled="" title="Só é Possível Retirar 5 alunos por Vez!">Retirar Aluno(a)(s)da Ata </button>                                    
                            </div>
                        </div>  
                        <?php
                        echo "<table class='table table-striped table-bordered' id='matutino'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th style = 'min-width:64px;'>"
                        . "<div class='dropdown'>"
                        . "<input type = 'checkbox' class = 'selecionar'/>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><a><button type ='submit' disabled = ''  value = 'manha' name = 'botao' class='btn btn-link ata2' title = 'Marque Pelo Menos Uma Das Caixinhas Para Liberar A Impressão:)'><span class='glyphicon glyphicon-print btn-lg verde ' aria-hidden='true'></span></button>Impressão Em Excel</a></li>"
                        . "<li><a><button type ='submit' disabled = ''  value = 'ata' name = 'botao' class='btn btn-link ata1' title = 'Marque Pelo Menos Uma Das Caixinhas Para Liberar A Impressão:)' style='text-decoration: none;color: black;'><span class='glyphicon glyphicon-print btn-lg verde ' aria-hidden='true'></span>Ata Em Texto</button></a></li>"
                        . "<li><a><button type ='submit' disabled = ''   value = 'ata_2' name = 'botao' class='btn btn-link ata' title = 'Marque Pelo Menos Uma Das Caixinhas Para Liberar A Impressão:)' style='text-decoration: none;color: black;'><span class='glyphicon glyphicon-print btn-lg verde ' aria-hidden='true'></span>Ata Em Excel</button></a></li>"
                        . "<li><a><button type ='button'   value = '' name = '' data-toggle='modal' data-target='#myModal' class='btn btn-link' title = '' style='text-decoration: none;color: black;'><span class='glyphicon glyphicon-print btn-lg verde ' aria-hidden='true'></span>Comparar</button></a></li>"
                        . "</ul>"
                        . "</div>"
                        . "</th>";
                        echo "<th style = 'width:200px;'>TURMA</th>";
                        echo "<th>PRONTA</th>";
                        echo "<th>MAT.</th>";
                        echo "<th style = 'width:5%;'>TRANF.</th>";
                        echo "<th>A.AD</th>";
                        // echo "<th>DESIST.</th>";
                        echo "<th style = 'width:95px;'>CURSANDO</th>";
                        echo "<th style = 'width:5%;'>ANO</th>";
                        echo "<th style = 'width: 350px !important;'>PROFESSOR(A)</th>";
                        echo "<th>ALUNOS</th>";
                        echo "</tr>";
                        echo "</thead>";
                        //
                        echo "<tfoot>";
                        echo "<tr>";
                        echo "<th>  </th>";
                        echo "<th>TURMA</th>";
                        echo "<th>PRONTA</th>";
                        echo "<th>MAT.</th>";
                        echo "<th>TRANF.</th>";
                        echo "<th>A.AD</th>";
                        //   echo "<th>DESIST.</th>";
                        echo "<th>CURSANDO</th>";
                        echo "<th>ANO </th>";
                        echo "<th>PROFESSOR(A)</th>";
                        echo "<th>ALUNOS</th>";
                        echo "</tr>";
                        echo "</tfoot>";
                        echo "<tbody>";
                        //

                        while ($linhaV = mysqli_fetch_array($ConsultaV)) {
                            //                           
                            $idV = $linhaV['id_turma'];
                            $status = $linhaV['pronta'];
                            //
                            $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$idV'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
                            $ano_turma = substr($Linha_turma["ano"], 0, -6);
                            $nome_turma = $Linha_turma["turma"];
                            $turno_turma = $Linha_turma["turno"];
                            //
                            if ($ano_turma == "2018") {
                                $unico_turma = "";
                            } else {
                                $unico_turma = $Linha_turma["unico"];
                            }
                            //
                            $turmaf = "$nome_turma $unico_turma ($turno_turma)";
                            //       
                            //Selecionar todos os itens da tabela 
                            $nome_professores = '';
                            $nome_aux = '';
                            //
                            $Consulta = mysqli_query($Conexao, "SELECT * FROM turma_backup WHERE id_turma = '$idV'");
                            $linha = mysqli_fetch_array($Consulta);
                            //       
                            $nome_professores = 'Titular: ' . $linha['prof'] . " <br> " . $linha['prof_aux'] . " ";
                            //
                            $nomes = "";
                            $ContLinhas = 0;
                            $ids = $linhaV['ids'];
                            $Consulta = mysqli_query($Conexao, "SELECT * FROM alunos WHERE `id` IN($ids) ORDER BY nome ");
                            if ($Consulta) {
                                $ContLinhas = mysqli_num_rows($Consulta);
                                while ($Linha = mysqli_fetch_array($Consulta)) {
                                    $nome = $Linha['nome'];
                                    $id = $Linha['id'];
                                    $check = " <div class='dropdown' style = 'margin-bottom: -18px;'>"
                                            . " <input type = 'checkbox' name='aluno_selecionado[]' value = '$id' class = '$idV' style = 'display:none;'>"
                                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                            . "<li><a href='cadastrar_historico.php?id=" . base64_encode($id) . "' target='_blanck' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>"
                                            . "<li><a href='alunos_retirar_ata.php?id=" . base64_encode($id) . "/$idV' target='_self' title='Retirar o Aluno da Ata'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Retirar o Aluno da Ata</a></li>"
                                            . "</ul>"
                                            . "&nbsp;&nbsp;$nome"
                                            . "</div>";
                                    $nomes .= " $check  " . "<br>";
                                }
                            }
                            //                           
                            $am = $linhaV['matriculados'];
                            $at = $linhaV['transferidos'];
                            $ad = $linhaV['admitidos'];
                            $adesis = $linhaV['desistentes'];
                            $ac = $linhaV['cursando'];
                            $ano = $linhaV['ano'];
                            echo "<tr>";
                            echo "<td>"
                            . "<input type='checkbox' name='turma_selecionada[]' class = 'turma' value='$idV' >"
                            . "</td>";
                            //
                            echo "<td>"
                            . "<button type ='button' value = '$idV' class='btn btn-link btmais'  style='text-decoration: none;margin-left: -12px;'><span class='glyphicon glyphicon-plus-sign text-success ' aria-hidden='true'id = '$idV' ></span></button>"
                            . "" . $turmaf
                            . "</td>\n";
                            //
                            if ($status == "SIM") {
                                echo "<td>   "
                                . "<select name='status[]' class='status_$idV form-control status' disabled = '' id='status_$idV' >"
                                . "<option selected= '' value='SIM' >SIM</option>"
                                . "<option  value='NAO' >NÃO</option>"
                                . "</select>"
                                . "     </td>\n";
                            } else {
                                echo "<td>   "
                                . "<select name='status[]' class='status_$idV form-control status' disabled = '' id='status_$idV' >"
                                . "<option value='SIM' >SIM</option>"
                                . "<option selected= '' value='NAO' >NÃO</option>"
                                . "</select>"
                                . "     </td>\n";
                            }
                            echo "<td>" . $am . "</td>\n";
                            echo "<td class = 'text-danger'>" . $at . "</td>\n";
                            echo "<td>" . $ad . "</td>\n";
                            //   echo "<td>" . $adesis . "</td>\n";
                            echo "<td class = 'text-success'>" . $ac . "</td>\n";
                            echo "<td>" . $ano . "</td>\n";
                            if ($nome_professores == "") {
                                $nome_professores = "Nº de Profº : $ContLinhasProf";
                            }
                            echo "<td style = 'white-space: nowrap;'>" . $nome_professores . "</td>\n";
                            echo "<th style = 'white-space: nowrap; ' > <span class = '$idV' style = 'display:none;'> $nomes </span> <span class = '$idV' style = 'display:block;'>Nº de Aluno(s): $ContLinhas </span></th>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</form>";
                    } else {
                        echo "Nada enconrado.";
                    }
                    ?>  
                </div>     
                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".turma").click(function () {
                            var teste = $('.turma').is(':checked');
                            var status = $(this).val();

                            if (teste == true) {
                                $("#status_" + status).removeAttr('disabled');
                            } else {
                                $("#status_" + status).attr('disabled', 'disabled');
                            }
                        });
                    });
                </script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".selecionar").click(function () {
                            var teste = $('.selecionar').is(':checked');

                            if (teste == true) {
                                $(".turma").each(function () {
                                    this.checked = true;
                                    $('input:checkbox').prop("checked", true);
                                    $(".status").removeAttr('disabled');

                                });
                            } else {
                                $(".turma").each(function () {
                                    this.checked = false;
                                    $('input:checkbox').prop("checked", false);
                                    $(".status").attr('disabled', 'disabled');
                                });
                            }
                            ;
                        });
                    });
                </script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".btmais").click(function () {
                            var valor = $(this).val();
                            $("." + valor + "").toggle();
                            //                          
                            var verde = $("#" + valor + "").hasClass("text-success");
                            if (verde) {

                                $("#" + valor + "").removeClass("text-success");
                                $("#" + valor + "").addClass("vermelho");
                                $("#" + valor + "").removeClass("glyphicon glyphicon-plus-sign");
                                $("#" + valor + "").addClass("glyphicon glyphicon-minus-sign");
                                $("." + valor + "").each(function () {
                                    this.checked = true;
                                    $(".status_" + valor).removeAttr('disabled');
                                });
                            } else {
                                $("#" + valor + "").removeClass("vermelho");
                                $("#" + valor + "").addClass("text-success");
                                $("#" + valor + "").removeClass("glyphicon glyphicon-minus-sign");
                                $("#" + valor + "").addClass("glyphicon glyphicon-plus-sign");
                                $("." + valor + "").each(function () {
                                    this.checked = false;
                                    $(".status_" + valor).attr('disabled', 'disabled');
                                });
                            }

                        });
                    });
                </script>                
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $('input[type="checkbox"][name="turma_selecionada[]"]').on('change', function () {
            //                          
            var total = $('input[type="checkbox"][name="turma_selecionada[]"]:checked').length;
            //alert($(this).val());                                                         
            if (total === 1) {
                $('.ata').removeAttr('disabled');
                $('.ata1').removeAttr('disabled');

                $("." + $(this).val() + "").each(function () {
                    this.checked = true;
                });
            } else if (total > 1) {
                $('.ata1').attr('disabled', 'disabled');
                $('.ata').removeAttr('disabled');
                alert('Para Gerar Uma Ata Marque Somente Uma Das Caixinhas:)');
            } else if (total < 1) {
                $('.ata1').attr('disabled', 'disabled');
            }
            //
            if (total >= 1) {
                $('.ata2').removeAttr('disabled');
            } else if (total < 1) {
                $('.ata2').attr('disabled', 'disabled');
            }
            //
            if (total === 0) {
                $('.ata').removeAttr('disabled');
                $("." + $(this).val() + "").each(function () {
                    this.checked = false;
                });
            }
        });
    </script>
    <script type="text/javascript">
        $('input[type="checkbox"][name="aluno_selecionado[]"]').on('change', function () {
            //                       
            var total2 = $('input[type="checkbox"][name="aluno_selecionado[]"]:checked').length;
            //alert($(this).val());                                                         
            if (total2 > 0 && total2 < 6) {
                $('#retirar').removeAttr('disabled');
            } else {
                $('#retirar').attr('disabled', 'disabled');
                //alert('Só é Possível Retirar 5 alunos por Vez!)');
            }

        });
    </script>

    <!--INÍCIO DO MATUTINO-->
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#matutino tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');
            });
            // Data Table
            var table = $('#matutino').DataTable({
                "columnDefs": [{
                        "targets": [0, 1, 2, 3, 4, 5, 6],
                        "orderable": false
                    }],

                "lengthMenu": [[6, 8, 9, 10, 15, 20, 25, 35, 70, 100, -1], [6, 8, 9, 10, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": "Turmas por Página _MENU_ <?php
                    echo ""
                    . "&nbsp;&nbsp;"
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
    <script type='text/javascript'>
        var intervalo = window.setInterval(fechar, 4000);
        function fechar() {
            $('.modal_msg').modal('hide');
        }
    </script> 

</html>
