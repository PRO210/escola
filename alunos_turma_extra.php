<?php
include_once 'valida_cookies.inc';
?>    
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
$idcerto = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($idcerto == 1) {
    echo "<script type=\"text/javascript\">
		alert(\"Cadastro Alterado com Sucesso! \");
                </script>
                ";
} elseif ($idcerto == 2) {
    echo "<script type=\"text/javascript\">
		alert(\"Ops! Falha na Operação:) \");
                </script>
                ";
}
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ALUNOS TURMA EXTRA</title>        
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid" >          
            <h3 style="text-align: center">ALUNOS TURMA EXTRA</h3>
            <script src="js/bootstrap.js" type="text/javascript"></script>
            <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
            <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="js/cadastrar_validar.js" type="text/javascript"></script>
            <link href="css/tabela_atestado.css" rel="stylesheet" type="text/css"/>
            <link href="css/pesquisar_no_banco.css" rel="stylesheet" type="text/css"/> 

            <?php
            $buscarf_nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
            // $data_nascimento = filter_input(INPUT_POST, 'inpuData_nascimento', FILTER_DEFAULT);
            //$nascimento = substr($data_nascimento, 6, 4) . '-' . substr($data_nascimento, 3, 2) . '-' . substr($data_nascimento, 0, 2);
            $Consultaf = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos WHERE status_extra_aluno = 'CURSANDO' AND(status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ORDER BY nome");
            $rowf = mysqli_num_rows($Consultaf);

            echo "<form method= 'post'  action='atualizar_varios.php' name = 'form1' >";
            echo " <input type='text' hidden='' name='pesquisar_no_banco' >";
            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
            echo "<thead>";
            echo "<tr>";
            //echo "<th> ID </th>";
            echo "<th>"
            . "<div class='dropdown'>"
            . "<input type='checkbox'  class = 'selecionar'/>"
            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link btn-sm verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
            . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
            . "<li><a><button type='submit' value='tudo' name = 'tudo' class='btn btn-link btn-lg verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Todos os alunos</a></li>"
            . "</ul>"
            . "</div>"
            . "</th>";
            echo "<th> NOME </th>";
            echo "<th> TURMA </th>";
            echo "<th> TURMA EXTRA </th>";
            echo "<th> CURSANDO </th>";
            echo "</tr>";
            echo "</thead>";
            //
            echo "<tfoot>";
            echo "<tr>";
            echo "<th>  </th>";
            echo "<th> NOME </th>";
            echo "<th> TURMA </th>";
            echo "<th> TURMA EXTRA </th>";
            echo "<th> CURSANDO </th>";
            echo "</tr>";
            echo "</tfoot>";
            //
            echo "<tbody>";
//
            if ($rowf > 0) {
//
                while ($linhaf = mysqli_fetch_array($Consultaf)) {
                    $nomef = $linhaf['nome'];
                    $data_nascimentof = new DateTime($linhaf["data_nascimento"]);
                    $nascimento = date_format($data_nascimentof, 'd/m/Y');
                    // $idade = $linhaf['idade'];
                    $maef = $linhaf['mae'];
                    $pai = $linhaf['pai'];
                    $turmaf = $linhaf['turma'];
                    $turma_extra = $linhaf['turma_extra_aluno'];
                    $idf = $linhaf['id'];
                    $statusf = $linhaf['status'];
                    $status_extra = $linhaf['status_extra_aluno'];

                    echo " <input type='text' hidden='' name='turma_extra' >";
                    echo "<td>"
                    . "<div class='dropdown'>"
                    . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                    . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir</a></li>"
                    . "<li><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                    . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                    . "</div>"
                    . "</u>"
                    . "</td>";
                    echo "<td>" . $nomef . "</td>\n";
                    echo "<td> " . $turmaf . " </td>\n";
                    //echo "<td>" . $idade . "</td>\n";
                    echo "<td>" . $turma_extra . "</td>\n";
                    echo "<td>" . $status_extra . "</td>\n";
                    // echo "<td>" . $statusf . "</td>\n";
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

                    //Data Table
                    var table = $('#tbl_alunos_lista').DataTable({

                        "columnDefs": [{
                                "targets": 0,
                                "orderable": false
                            }],

                        "lengthMenu": [[10, 15, 20, 25, 35, 70, 100, -1], [10, 15, 20, 25, 35, 70, 100, "All"]],
                        "language": {
                            "lengthMenu": "Alunos por Página _MENU_ <?php
            echo "<input type='submit' value='Editar em Bloco'<a href='atualizar_varios.php?none= none' target='_blank' class='btn btn-primary' onclick= 'return validaCheckbox()'>"
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
        </div>
    </body>
</html>
