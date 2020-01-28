<?php
include_once 'valida_cookies.inc';
?>
<?php
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DOCUMENTOS EMPRESTADOS</title>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            .verde{color: green;}.vermelho{color: red;}.amarelo{color: orange;}.azul{  color: blue; }
            .checkbox{
                display: inline-block;
            }
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;}                        
            table.dataTable thead th, table.dataTable thead td {
                padding: 0px 8px !important;

            }
            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                padding: 8px !important;
            }
            #ocultar{display: none}
            @media (max-width: 500px) {#ocultar{display: block;}   
            } 

        </style> 
    </head>
    <body>
        <?php
        include_once 'menu.php';
        ?>
        <div class="container-fluid">
            <link href="Tabela_Responsiva/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
            <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
            <link href="Tabela_Responsiva/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css"/>
            <script src="Tabela_Responsiva/jquery-1.12.4.js" type="text/javascript"></script>
            <script src="Tabela_Responsiva/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script>
            <script src="Tabela_Responsiva/dataTables.rowReorder.min.js" type="text/javascript"></script>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
           
            <h4 style="text-align: center">ALUNOS CURSANDO</h4>
            <?php
            echo "<form method= 'post'  action='atualizar_varios.php' name = 'form1' >";
            ?>
            <!-- Modal Turmas-->
            <div class="modal fade" id="myModal_Turmas" role="dialog" >
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" style="">
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
            echo "<table id='example' class='display table-bordered'  width='100%' cellspacing='0'>";
            echo "<thead>";

            echo "<tr>";
            echo "<th>"
            . "&nbsp;&nbsp;<div class='dropdown hidden-xs '>"
            . "<input type='checkbox'  class = 'selecionar'/>"
            . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-print text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
            . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
            . "<li><a><button type='submit' value='tudo' name = 'tudo' class='btn btn-link verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Todos os alunos</a></li>"
            . "</ul>"
            . "</div>"
            . "&nbsp;&nbsp;<div class='dropdown visible-xs '>"
            . "<input type='checkbox'  class = 'selecionar'/>"
            . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-print text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
            . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
            . "<li><a><button type='submit' value='tudo' name = 'tudo' class='btn btn-link verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Todos os alunos</a></li>"
            . "</ul>"
            . "&nbsp;&nbsp;&nbsp;&nbsp; NOMES" .
            "</div>"
            . "</th>";

            echo "<th> NOME </th>";
            echo "<th> INEP </th>";
            echo "<th> TURMA </th>";
            echo "<th> NASCIDO </th>";
            echo "<th> IDADE </th>";
            echo "<th> MÃE </th>";
            echo "<th> PROFISSÃO MÃE </th>";

            echo "</tr>";
            echo "</thead>";
//
            echo "<tfoot>";
            echo "<tr>";
            echo "<th> </th>";
            echo "<th>NOME </th>";
            echo "<th> INEP </th>";
            echo "<th> TURMA </th>";
            echo "<th> NASCIDO </th>";
            echo "<th> IDADE </th>";
            echo "<th> MÃE </th>";
            echo "<th> PROFISSÃO MÃE </th>";

            echo "</tr>";
            echo "</tfoot>";
//
            echo "<tbody>";
            //
            $buscarf_nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
            $Consultaf = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,data_valida_matricula) AS idade FROM alunos WHERE (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N'  ORDER BY `nome` ASC");

            while ($linhaf = mysqli_fetch_array($Consultaf)) {
                $inep = $linhaf['inep'];
                $nomef = $linhaf['nome'];
                $data_nascimentof = new DateTime($linhaf["data_nascimento"]);
                $nascimento = date_format($data_nascimentof, 'd/m/Y');
                $idade = $linhaf['idade'];
                $maef = $linhaf['mae'];
                $profmaef = $linhaf['profissao_mae'];
                $pai = $linhaf['pai'];
                $turmaf = $linhaf['turma'];
                $idf = $linhaf['id'];

                echo "<td>"
                . "<div id = 'ocultar'>"
                . "$nomef"
                . "</div>"
                . "</td>\n";

                echo "<td nowrap>"
                . "<div class='dropdown'>"
                . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                . "<li><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar dados Cadastrais</a></li>"
                . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar dados Cadastrais</a></li>"
                . "<li><a href='cadastrar_historico.php?id=" . base64_encode($idf) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferência</a></li>"
                . "</ul>"
                . "&nbsp;&nbsp;$nomef"
                . "</div>"
                . "</td>";
                echo "<td>$inep</td>\n";
                echo "<td>" . $turmaf . "</td>\n";
                echo "<td > " . $nascimento . " </td>\n";
                echo "<td > " . $idade . " </td>\n";
                echo "<td >" . $maef . "</td>\n";
                echo "<td >" . $profmaef . "</td>\n";

                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</form>";
            ?>
            <script>
                $(document).ready(function () {
                    //
                    // Setup - add a text input to each footer cell
                    $('#example tfoot th').each(function () {
                        var title = $(this).text();
                        $(this).html('<input type="text" placeholder="' + title + '" />');
                    });
                    //
                    var table = $('#example').DataTable({

                        "columnDefs": [{
                                "targets": 0,
                                "orderable": false
                            }],
                        "lengthMenu": [[8, 16, 24, 32, 40, 50, 100, -1], [8, 16, 24, 32, 40, 50, 100, "All"]],
                        "language": {
                            "lengthMenu": "Nº de Alunos _MENU_ <?php
            echo "&nbsp;&nbsp;<a href='cadastrar.php' target='_self' class = 'btn btn-success hidden-xs' >Cadastrar Novato</a></span>"
            . "&nbsp;<a href='cadastrar_transferido.php' target='_self' class = 'btn btn-warning hidden-xs'>Cadastrar Transferido</a>"
            . "<button type='button' style='margin-top: 6px;'class=' btn btn-success  visible-xs' data-toggle='modal' data-target='#myModal_Turmas' id = 'esconder_list'>&nbsp;&nbsp;&nbsp;&nbsp;Opções Extras </button>"
            . "&nbsp;<input type='submit' value='Editar em Bloco' class = 'btn btn-primary hidden-xs'onclick= 'return validaCheckbox()'>"
            . ""
            ;
            ?> ",
                            "zeroRecords": "Nenhuma Pessoa Encontrada",
                            "info": "Mostrando pagina _PAGE_ de _PAGES_",
                            "infoEmpty": "Sem registros",
                            "search": "Busca:",
                            "infoFiltered": "(filtrado de _MAX_ total de Pessoas)",
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
                        rowReorder: {
//                            selector: "td:nth-child(2)"
                            selector: true
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
            <script type="text/javascript">
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
        </div>      
    </body>
</html>
