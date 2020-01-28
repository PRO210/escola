<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <title>AÇÕES PASSADAS</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="css/usuarios_acoes.css" rel="stylesheet" type="text/css"/>
        <link href="css/tabela_atestado.css" rel="stylesheet" type="text/css"/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="text-align: center">Movimentações</h3>
                    <?php
                    $Consultaf_nis = mysqli_query($Conexao, "SELECT * FROM `log` ORDER BY data DESC");
                    $rowf_nis = mysqli_num_rows($Consultaf_nis);
//
                    if ($rowf_nis > 0) {
                        $echo = 'selecionar';
                    } else {
                        $echo = "selecionar' disabled = ''";
                    }
                    echo "<form method= 'post'  action='atualizar_varios.php' name = 'form1' >";
                    echo "<table class='table table-striped table-bordered' id='example' width='100%' cellspacing='0'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>"
                    . "<div class='dropdown'>"
                    . "<input type='checkbox'  class = $echo />"
                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                    . "<li><a><button type='submit' value='acoes' name = 'acoes' class='btn btn-link btn-sm verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Selecionados</a></li>"
                    . "<li><a><button type='submit' value='acoes_tudo' name = 'acoes_tudo' class='btn btn-link btn-lg verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Tudo o Banco</a></li>"
                    . "</ul>"
                    . "</div>"
                    . "</th>";
                    echo "<th> USUÁRIO </th>";
                    echo "<th> AÇÃO </th>";
                      echo "<th> CADASTRAR </th>";
                    echo "<th> ALTERAR </th>";
                    echo "<th> EXCLUIR </th>";                   
                    echo "<th> DATA </th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tfoot>";
                    echo "<tr>";
                    echo "<th> ---- </th>";
                    echo "<th> USUÁRIO </th>";
                    echo "<th> AÇÃO </th>";
                    echo "<th> CADASTRAR </th>";
                    echo "<th> ALTERAR </th>";
                    echo "<th> EXCLUIR </th>";                  
                    echo "<th> DATA </th>";
                    echo "</tr>";
                    echo "</tfoot>";
                    echo "<tbody>";
                    //
                    if ($rowf_nis > 0) {
                        //
                        while ($linhaf_nis = mysqli_fetch_array($Consultaf_nis)) {
                            //
                            $id_nis = $linhaf_nis['id'];
                            $nomef_nis = $linhaf_nis['usuario'];
                            $idade_nis = $linhaf_nis['acao'];
                            $data_nascimentof = new DateTime($linhaf_nis['data']);
                            $data_nascimentof_nis = date_format($data_nascimentof, 'd/m/Y');

                            echo "<tr>";
                            echo "<td> <input type='checkbox' name='usuario_selecionado[]'class = 'checkbox' value = '$id_nis'/> </td>\n";
                            echo "<td>" . $nomef_nis . "</td>\n";
                            echo "<td>" . $idade_nis . "</td>\n";
                            echo "<td>" . $linhaf_nis['cadastrar'] . "</td>\n";
                            echo "<td>" . $linhaf_nis['alterar'] . "</td>\n";
                            echo "<td>" . $linhaf_nis['excluir'] . "</td>\n";
                            echo "<td>" . $data_nascimentof_nis . "</td>\n";
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
            </div>
        </div>
    </body>   
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
            alert("Nenhum Usuário foi Selecionado!");
            return false;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder=" ' + title + '" />');
            });
            // DataTable
            var table = $('#example').DataTable({

                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],

                "lengthMenu": [[5, 10, 15, 20, 25, 35, 70, 100, -1], [5, 10, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": "Alunos por Página _MENU_ ",
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
    <script type="text/javascript">
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
</html>
