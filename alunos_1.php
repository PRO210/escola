<div class="container-fluid" >       
    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="js/cadastrar_validar.js" type="text/javascript"></script>
    <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script>
    <style>
        .verde{color: green; padding-bottom: 12px; font-size: 16px;}
        .vermelho{ color: red; padding-bottom: 12px;  }
        .amarelo{  color: orange;  padding-bottom: 12px;}
        .azul{ color: blue; padding-bottom: 12px;}
        .rosa{ color: pink; padding-bottom: 12px;}

        tfoot input {width: 100%;padding: 3px;box-sizing: border-box;}

        #esconder_list{display: none; }
        #esconder_bt{display: inline-block; }
        @media (max-width: 1000px) { #esconder_list{ display: inline;}
        }  
        @media (max-width: 1000px) {#esconder_bt{display: none;}
        }                 
        @media (max-width: 1000px) {#ocultar{display: none;}
        }  
        .vbt{ background-color: transparent; border: none;        }                
        .vbtv{ background-color: transparent; border: none;                 
        }
        .esc{ display: none;  }
        #thNome{
            white-space: nowrap;
        }
        @media (max-width: 850px) {#thNome{white-space: normal;}
        }
    </style>    
    <script>
        $(document).ready(function () {
            $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
        });
    </script>
    <?php
    $buscarf_nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
    $Consultaf = mysqli_query($Conexao, "SELECT * FROM alunos  ORDER BY `nome` ASC");
    $rowf = mysqli_num_rows($Consultaf);
    if ($rowf > 0) {
        $disabled = "";
    } else {
        $disabled = "disabled";
    }
    ?>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <!-- Modal Turmas-->
    <div class="modal fade" id="myModal_Turmas2" role="dialog" >
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="">
                <div class="modal-header">
                    <button type="button btn-lg" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title" style="text-align: center">Opções Referente aos Alunos</h5>
                </div>
                <div class="modal-body">
                    <?php
                    echo " <a><input style='margin-bottom: 6px;' type='submit' value='Editar em Bloco' class = 'form-control btn btn-primary' onclick= 'return validaCheckbox()'></a>";
                    echo " <a href='cadastrar_transferido.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;'>Cadastrar Aluno(a)</a>";
                    ?>
                    <div class="modal-footer"></div>                            
                </div>                       
            </div>
        </div>
    </div>        
    <?php
    echo "<form method= 'post'  action='atualizar_varios.php' name = 'form1' >";
    echo "<table class='nowrap table table-striped table-bordered ' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>"
    . "<div class='dropdown'>"
    . "<input type='checkbox'  class = 'selecionar' />"
    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success ch' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
    . "<li><a><button $disabled type='submit' value='basica' name = 'basica' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
    . "<li><a><button $disabled type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
    . "</ul>"
    . "</div>"
    . "</th>";
    echo "<th style = ' white-space: normal;'> NOME </th>";
    echo "<th >  ARQUIVO</th>";
    echo "<th> STATUS </th>";
    echo "<th > TURMA </th>";
    echo "<th > MÃE </th>";
    //echo "<th> ENDEREÇO </th>";
    echo "<th> FONES :  </th>";
    echo "</tr>";
    echo "</thead>";
//
    echo "<tfoot>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th style = ' white-space: normal;'> NOME </th>";
    echo "<th >  ARQUIVO</th>";
    echo "<th> STATUS </th>";
    echo "<th > TURMA </th>";
    echo "<th > MÃE </th>";
    // echo "<th> ENDEREÇO </th>";
    echo "<th> FONES:  </th>";
    echo "</tr>";
    echo "</tfoot>";
    echo "<tbody>";
//
    if ($rowf > 0) {
        //
        while ($linhaf = mysqli_fetch_array($Consultaf)) {
            //
            $nomef = $linhaf['nome'];
            $maef = $linhaf['mae'];
            // $endereco = $linhaf['endereco'];
            $transporte = $linhaf['transporte'];
            $fone = $linhaf['fone'];
            $fone2 = $linhaf['fone2'];
            $turmaf = $linhaf['turma'];
            //
            $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
            $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
            $nome_turma = $Linha_turma["turma"];
            $turno_turma = $Linha_turma["turno"];
            $ano_turma = substr($Linha_turma["ano"], 0, -6);

            if ($ano_turma == "2018") {
                $unico_turma = "";
            } else {
                $unico_turma = $Linha_turma["unico"];
            }
            //
            $turmaf = "$nome_turma $unico_turma ($turno_turma)  $ano_turma  ";
            $excluido = $linhaf['excluido'];

            $display = "";
            $display2 = "";
            $display3 = "";
            $display4 = "";
            //
            if ($excluido == "S") {
                $status = "ARQUIVADO";
                $ap = $linhaf['ap_pasta'];
                $display2 = "style= 'display:none'";
                $display3 = "style= 'display:block'";
                $display4 = "style= 'display:none'";
                $turmaf = "----";
            } else {
                $status = $linhaf['status'];
                $ap = "-----";
                $display3 = "style= 'display:none'";
                //
                if ($status == "TRANSFERIDO" || $status == "DESISTENTE" || $status == "NÃO RENOVADO") {
                    $display4 = "style= 'display:block'";
                    $display2 = "style= 'display:none'";
                } else {
                    $display4 = "style= 'display:none'";
                }
            }
            //
            if ($status == "TRANSFERIDO") {
                $display = "style= 'display:block'";
            } else {
                $display = "style= 'display:none'";
            }
            //
            $status_ext = $linhaf['status_ext'];
            //
            if ($status_ext == "SIM") {
                $status_ext = "ALUNO: OUVINTE";
            } else {
                $status_ext = "";
            }
            $idf = $linhaf['id'];
            $obs = $linhaf['obs'];


            echo "<td ></td>";
            echo "<td id = 'thNome' style = 'padding-right:0px;'>"
            . "<div class='dropdown'>"
            . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
            . "<li><a href='folha_re_matricula.php?id=$idf' target='_blank' title='Imprimir Folha de Ré Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de ReMatrícula</a></li>"
            . "<li $display2><a href='declaracoes_bolsa_familia.php?id=$idf' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>"
            . "<li $display><a href='impressao_transferencia_provisoria_tratamento.php?id=$idf' target='_blank' title='Imprimir Declaração de Transferência'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Transferência</a></li>"
            . "<li><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>"
            . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_blanc' title='Mostrar'><span class='glyphicon glyphicon-user rosa' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>"
            . "<li><a href='cadastrar_historico.php?id=" . base64_encode($idf) . "' target='_self' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>"
            . "<li><a href='pesquisar_no_banco.php?id=" . base64_encode($idf) . "' target='_self' title='Possível Caso de Duplicidade'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Possível Caso de Duplicidade</a></li>"
            . "<li $display3><a href='alunos_arquivo_passivo.php?id=" . base64_encode($idf) . "' target='_self' title='Retirar do Arquivo Passivo'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'>&nbsp;</span>Retirar do Arquivo Passivo</a></li>"
            . "<li $display4><a><button type ='submit' onclick= 'validaCheckbox2();return validaCheckbox()' name = 'turma_transferidos' value = '$idf' class='btn btn-link arquivo' title = 'Mover para Arquivo Passivo' style='text-decoration: none;color: black;margin-left: -12px;'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></button>Mover para o Arquivo Passivo</a></li>"
            . "<li><a href='cadastrar_boleto.php?id=" . base64_encode($idf) . "' target='_blank' title='Boleto'><span class='glyphicon glyphicon-piggy-bank' aria-hidden='true'>&nbsp;</span>Boletos</a></li>"
            . "</ul>"
            . "&nbsp;&nbsp;$nomef"
            . "</div>"
            . "</td>\n";
            echo "<td> " . $ap . "</td>\n";
            echo "<td>" . $status . "<br>" . $status_ext . "</td>\n";
            echo "<td>" . $turmaf . "</td>\n";
            echo "<td style = 'font-size:12px'>" . $maef . "</td>\n";
            //  echo "<td >" . $endereco . "</td>\n";
            echo "<td >" . $fone . " / " . $fone2 . "</td>\n";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</form>";
    } else {
        echo "Nada enconrado.";
    }
    ?>          
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#tbl_alunos_lista tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');
            });
            // Data Table
            var table = $('#tbl_alunos_lista').DataTable({
                //
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],
                "lengthMenu": [[7, 10, 15, 20, 25, 30, 35, 40, 50, 70, 100, -1], [7, 10, 15, 20, 25, 30, 35, 40, 50, 70, 100, "All"]],
                "language": {
                    "lengthMenu": " _MENU_ <?php
//    echo "&nbsp;&nbsp;<a href='cadastrar.php' target='_self' class = 'btn btn-success' id = 'esconder_bt'>Novato</a></span>"
    echo "&nbsp;<a href='cadastrar_transferido.php' target='_self' class = 'btn btn-success' id = 'esconder_bt'>Cadastrar</a>"
    . "<button type='button' class='btn btn-link btn-lg verde glyphicon glyphicon-cog ' data-toggle='modal' data-target='#myModal_Turmas2' id = 'esconder_list'></button>"
    . "&nbsp;<input $disabled type='submit' value='Editar em Bloco' class = 'btn btn-primary' id = 'esconder_bt' onclick= 'return validaCheckbox()'>"
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

                },
                responsive: true
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
            //
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
    <script language="javascript">
        function validaCheckbox2() {
            var id = $('.arquivo').val();
            //alert(id);
            var total = $('input[type="checkbox"][name="turma_selecionada[]"]:checked').length;
            //alert($(this).val());
        }
    </script>
</div>
