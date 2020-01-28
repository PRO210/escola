<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Turmas Professor</title>        
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/alunos_transferidos.css" rel="stylesheet" type="text/css"/>
        <style>
            td{font-size: 12px !important;
            }
        </style>
        <div class="container-fluid"><br>
            <div class="row">
                <div class="col-sm-12">
                    <form method="post" action="atualizar_varios.php" name="form1" >
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <h3 style="text-align: center">Manhã</h3>
                            <tr>
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'MATUTINO' ORDER BY turma");
                                while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $turma = $ColConsulta['turma'];
                                    echo "<th> " . $turma . " </th>";
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                echo "<tr>";

                                $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `turmas_professor` WHERE `id` BETWEEN 1 AND 3");
                                while ($linhaConsulta = mysqli_fetch_array($Consulta2)) {

                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'MATUTINO' ORDER BY turma");
                                    while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $turma = $ColConsulta['turma'];
                                        $turno = $ColConsulta['turno'];
                                        $tt = "$turma ($turno)";

                                        echo "<td>" . $linhaConsulta[$tt] . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table> 
                        <!--Tarde-->
                        <div class="row">
                            <h3 style="text-align: center">Tarde</h3>
                            <div class="col-md-12" >
                                <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <?php
                                            $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'VESPERTINO' ORDER BY turma");
                                            while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                $turma = $ColConsulta['turma'];
                                                echo "<th> " . $turma . " </th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        echo "<tr>";
                                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `turmas_professor` WHERE `id` BETWEEN 1 AND 3");
                                        while ($linhaConsulta = mysqli_fetch_array($Consulta2)) {

                                            $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'VESPERTINO' ORDER BY turma");
                                            while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                $turma = $ColConsulta['turma'];
                                                $turno = $ColConsulta['turno'];
                                                $tt = "$turma ($turno)";

                                                echo "<td>" . $linhaConsulta[$tt] . "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        <!--NOITE-->
                        <div class="row">
                            <h3 style="text-align: center">Noite</h3>
                            <div class="col-md-12" >
                                <table id="example3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <?php
                                            $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'NOTURNO' ORDER BY turma");
                                            while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                $turma = $ColConsulta['turma'];
                                                echo "<th> " . $turma . " </th>";
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        echo "<tr>";
                                        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `turmas_professor` WHERE `id` BETWEEN 1 AND 3");
                                        while ($linhaConsulta = mysqli_fetch_array($Consulta2)) {

                                            $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'NOTURNO' ORDER BY turma");
                                            while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                $turma = $ColConsulta['turma'];
                                                $turno = $ColConsulta['turno'];
                                                $tt = "$turma ($turno)";

                                                echo "<td>" . $linhaConsulta[$tt] . "</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</body>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
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
    //Confimrar Exclusão
    function confirmarExclusao() {
        var r = confirm("Realmente deseja excluir?");
        if (r == true) {
            return true;
        } else {
            return false;
        }
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
<script>
    $(document).ready(function () {
        $('#example2').DataTable({
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
    });
</script>
<script>
    $(document).ready(function () {
        $('#example3').DataTable({
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
    });
</script>
</html>
