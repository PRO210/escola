<?php
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
if (isset($_POST['exclui_disciplinas'])) {

    include_once 'exclui_disciplinas.php';
}
//<!Recebe o id de pesquisar_disciplinas_server>
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
//echo base64_Decode($Recebe_id);
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM disciplinas WHERE id= '" . base64_Decode($Recebe_id) . "'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
$disciplina = $Registro["disciplina"];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        include_once './head.php';
        ?>  
        <title>ATULIZAR DISCIPLINAS</title>
        
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
        <script>
            $(document).ready(function () {
                $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
            });
        </script>
        <div class="container-fluid">
            <div class="row">
                <div class="starter-template">
                    <h3 style="text-align: center">ATUALIZAR DADOS DA DISCIPLINA </h3>
                    <form method="post" action="cadastrar_update_disciplina_server.php" class="form-horizontal" >
                        <div class="form-group">
                            <label for="inputNome" class="col-sm-3 control-label">Disciplina:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="inputNome" value="<?php echo "$disciplina"; ?>" required="" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                        <div class="form-group"> 
                            <h4 style="text-align: center">PROFESSORES(A) ATUAIS</h4>
                            <div class="col-sm-6 col-sm-offset-3 ">
                                <?php
                                echo "<table class='table table-striped table-bordered' id='atuais_professores'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>VEMOVER</th>";
                                echo "<th> NOME </th>";
                                echo "<th> TURMA </th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                //
                                $Sql = "SELECT servidores.id,servidores.nome,turmas.id,turmas.turma,disciplina_professor2.* FROM servidores, turmas,`disciplina_professor2` WHERE `id_disciplina` ='" . base64_Decode($Recebe_id) . "' AND servidores.id = id_professor AND turmas.id = id_turma ORDER BY `servidores`.`nome` ASC,turmas.turma ASC ";
                                $Consulta2 = mysqli_query($Conexao, $Sql);
                                // $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `disciplina_professor2` WHERE `id_disciplina` = '" . base64_Decode($Recebe_id) . "' ");
                                $linhas = mysqli_num_rows($Consulta2);

                                $IdsProfessores = "";

                                if ($linhas > 0) {

                                    while ($row2 = mysqli_fetch_array($Consulta2)) {

                                        $id = $row2['id'];
                                        $id_turma = $row2['id_turma'];
                                        $id_professor = $row2['id_professor'];
                                        $IdsProfessores .= $id_professor . ",";
                                        $IdsProfessores = substr($IdsProfessores, 0, -1);
                                        //
                                        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `id` = " . $id_professor . "  ORDER BY nome");
                                        $Registro = mysqli_fetch_array($Consultaf);
                                        $nome = $Registro["nome"];
                                        //
                                        $Consultaf2 = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` = " . $id_turma . "  ORDER BY turma");
                                        $Registro2 = mysqli_fetch_array($Consultaf2);
                                        $turma = $Registro2["turma"];
                                        //
                                        echo "<tr>";
                                        echo "<td>"
                                        . "<div class='dropdown'>"
                                        . "<input type='checkbox' name='id_remove[]' class = 'checkboxP' value='$id' >"
                                        . "</td>";
                                        echo "<td>&nbsp;&nbsp;$nome"
                                        . "</td>";
                                        echo "<td>&nbsp;&nbsp;$turma"
                                        . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 style="text-align: center"> DEMAIS PROFESSORES(A)</h4>
                            <div class="col-sm-6 col-sm-offset-3 ">
                                <?php
                                echo "<table class='table table-striped table-bordered' id='demais_professores'>";
                                echo "<thead>";
                                echo "<tr>";
                                // echo "<th> ID </th>";
                                echo "<th>"
                                . "<div class='dropdown'>"
                                // . "<input type='checkbox' name='servidor_selecionado[]' class = 'selecionar'/>"
                                . "</th>";
                                echo "<th> NOME </th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                // echo "$IdsProfessores";
                                if ($IdsProfessores == "") {
                                    $id_exclui = "";
                                } else {
                                    $id_exclui = "AND id NOT IN($IdsProfessores)";
                                }
                                $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' AND `excluido` = 'N' ORDER BY nome");
                                $rowf = mysqli_num_rows($Consultaf);
                                //
                                if ($rowf > 0) {
                                    //
                                    while ($Registro = mysqli_fetch_array($Consultaf)) {

                                        $id_professor = $Registro["id"];
                                        $nome = $Registro["nome"];

                                        echo "<tr>";
                                        echo "<td>"
                                        . "<div class='dropdown'>"
                                        . "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id_professor'>"
                                        . "</td>";

                                        echo "<td>" . $nome . "</td>\n";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                ?>
                            </div>                            
                            <div class="col-sm-6 col-sm-offset-3 ">
                                <h4 style="text-align: center"> DEMAIS TURMAS</h4>
                                <?php
                                $ano_atual = date('Y');
                                //                     
                                echo "<table class='table table-striped table-bordered'id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th><input type = 'checkbox' class = 'selecionarM'>&nbsp;&nbsp;TURMAS </th>";
                                echo"<th>TURNO</th>";
                                echo"<th>CATEGORIA</th>";
                                echo"<th>ANO</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tfoot>";
                                echo "<tr>";
                                echo"<th>TURMAS</th>";
                                echo"<th>TURNO</th>";
                                echo"<th>CATEGORIA</th>";
                                echo"<th>ANO</th>";
                                echo "</tfoot>";
                                echo "</tr>";
                                echo "<tbody>";
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` ORDER BY `turmas`.`ano` DESC, `turmas`.`turma` ASC");
                                //
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    //
                                    echo "</tr>";
                                    $id_manha = $Registro["id"];
                                    $turma = $Registro["turma"];
                                    $ano = date_format(new DateTime($Registro["ano"]), 'Y');
                                    $ano_turma = substr($Registro["ano"], 0, -6);
                                    $atual = "";
                                    if ($ano_atual == "$ano_turma") {
                                        $atual = "(Atual)";
                                    }
                                    echo "<td><input type = 'checkbox' class = 'checkboxTurmas' name = 'turma[]' value = '$id_manha'>&nbsp;&nbsp;$turma $atual</td>";
                                    echo "<td>" . $Registro["turno"] . "</td>";
                                    echo "<td>" . $Registro["categoria"] . "</td>";
                                    echo "<td>$ano</td>";
                                }
                                echo "</tr>";
                                echo "</tbody>";
                                echo "</table>";
                                ?>                   
                            </div>
                        </div>
                        <input type="hidden" class="form-control"  name="inputId" value="<?php echo "$Recebe_id"; ?>">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit"  tipo class="btn btn-success">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        //Marcar ou Desmarcar todos os checkbox do Status
        $(document).ready(function () {
            $('.selecionarM').click(function () {
                if (this.checked) {
                    $('.checkboxTurmas').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkboxTurmas').each(function () {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
    <!--TABELA DE TURMAS-->
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#tbl_alunos_lista tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');
            });
            // Data Table
            var table = $('#tbl_alunos_lista').DataTable({
                //Desativa a ordenação
                "ordering": false,
                //DEsativa a ordenação por coluna especifíca
                "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                    }],
                "lengthMenu": [[7, 10, 20, 30, 40, 50, 70, 100, -1], [7, 10, 20, 30, 40, 50, 70, 100, "All"]],
                "language": {
                    "lengthMenu": " _MENU_ ",
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
//                        "aria": {
//                           // "sortAscending": ": ative a ordenação cressente",
//                           // "sortDescending": ": ative a ordenação decressente"
//                        }

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
    <!--INICIO FUNÇÃO DE MASCARA MAIUSCULA-->
    <script type="text/javascript">
        function maiuscula(z) {
            v = z.value.toUpperCase();
            z.value = v;
        }
    </script>
    <script type="text/javascript">
        function confirmarAtualização() {
            var r = confirm("Realmente deseja Atualizar essa Turma?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>  
    <!--     Marcar ou Desmarcar todos os checkbox
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
        </script>-->
    <script>
        $(document).ready(function () {
            $('#demais_professores').DataTable({
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],

                "lengthMenu": [[7, 15, 20, 25, 35, 70, 100, -1], [7, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": " _MENU_ ",
                    "zeroRecords": "Nenhum Professor(a) encontrado(a)",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros",
                    "search": "Busca:",
                    "infoFiltered": "(filtrado de _MAX_ total de Professores)",
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
        $(document).ready(function () {
            $('#atuais_professores').DataTable({
                
                    "lengthMenu": [[7, 15, 20, 25, 35, 70, 100, -1], [7, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                   "lengthMenu": " _MENU_ ",
                    "zeroRecords": "Nenhum Professor(a) encontrado(a)",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros",
                    "search": "Busca:",
                    "infoFiltered": "(filtrado de _MAX_ total de Professores)",
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
</html>
