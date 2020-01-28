<?php
include_once 'valida_cookies.inc';
?>    
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
if (isset($_GET["id"]) == 1) {
    echo "<script type=\"text/javascript\">
		alert(\"Alterações Gravadas com Sucesso! \");
                </script>
                ";
} elseif (isset($_GET["id"]) == 2) {
    echo "<script type=\"text/javascript\">
		alert(\"Falha no procedimento! \");
                </script>
                ";
}
?>
<html lang="pt-br">
    <head>
        <title></title>
        <?php
        include_once './head.php';
        ?>  
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12" >
                    <h3>Disciplinas</h3>
                    <?php
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE excluido = 'N'ORDER BY disciplina");
                    $row = mysqli_num_rows($Consulta);
                    $conadorLinhas = 1;
                    $arrayDisciplinas[] = "";

                    echo "<form method = 'post' action = 'cadastrar_update_disciplina'>";
                    echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                    echo "<thead>";
                    echo "<tr>";

                    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                        // $id = $linha['id'];
                        $disciplina = $linha['disciplina'];
                        $id = $linha['id'];
                        array_push($arrayDisciplinas, $linha['id']);

                        echo "<th> "
                        . "<div class='dropdown'>"
                        . " $disciplina"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><a href='cadastrar_update_disciplina.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                        . "</ul>"
                        . "</div>"
                        . "</th>";
                        if ($conadorLinhas == 5) {
                            break;
                        }
                        $conadorLinhas++;
                    }
                    echo "</thead>";
                    echo "</tr>";
                    echo "<tbody>";
                    echo "<tr>";

                    array_shift($arrayDisciplinas);
                    foreach ($arrayDisciplinas as $idDisciplina) {

                        $Consulta2 = mysqli_query($Conexao, "SELECT s.nome FROM `disciplina_professor2` dp, servidores s WHERE id_disciplina = $idDisciplina  AND dp.id_professor = s.id GROUP BY nome");
                        echo "<td>";
                        $nomeProfessores = "";

                        while ($linhaConsulta = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $nomeProfessores .= $linhaConsulta['nome'] . '<br>';
                        }
                        echo $nomeProfessores;

                        echo "</td>";
                    }
                    echo "</tr>";
                    echo "</tbody>";
                    echo "</table>";
                    echo "</form>";

                    if ($row > 5) {

                        echo "<form method = 'post' action = 'cadastrar_update_disciplina'>";
                        echo "<table class='table table-striped table-bordered' id='tbl_disciplinas_prof'>";
                        echo "<thead>";
                        echo "<tr>";

                        $conadorLinhas = 1;
                        $arrayDisciplinas[] = "";


                        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                            // $id = $linha['id'];
                            $disciplina = $linha['disciplina'];
                            $id = $linha['id'];
                            array_push($arrayDisciplinas, $id);
                            echo "<th> "
                            . "<div class='dropdown'>"
                            . " $disciplina"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><a href='cadastrar_update_disciplina.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                            . "</ul>"
                            . "</div>"
                            . "</th>";
                            if ($conadorLinhas == 5) {
                                break;
                            }
                            $conadorLinhas++;
                        }

                        echo "</tr>";
                        echo "<tbody>";
                        echo "<tr>";

                        array_shift($arrayDisciplinas);
                        array_shift($arrayDisciplinas);
                        array_shift($arrayDisciplinas);
                        array_shift($arrayDisciplinas);
                        array_shift($arrayDisciplinas);
                        array_shift($arrayDisciplinas);

                        foreach ($arrayDisciplinas as $idDisciplina) {

                            $Consulta2 = mysqli_query($Conexao, "SELECT s.nome FROM `disciplina_professor2` dp, servidores s WHERE id_disciplina = $idDisciplina  AND dp.id_professor = s.id");
                            echo "<td>";
                            $nomeProfessores = "";

                            while ($linhaConsulta = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                                $nomeProfessores .= $linhaConsulta['nome'] . '<br>';
                            }
                            echo $nomeProfessores;

                            echo "</td>";
                        }

                        echo "</tr>";

                        echo "</tbody>";
                        echo "</table>";
                        echo "</form>";
                    }
                    ?>                     
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#').DataTable({
                    "language": {
                        "lengthMenu": "Turmas por Página _MENU_",
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
                $('#').DataTable({
                    "language": {
                        "lengthMenu": "Turmas por Página _MENU_",
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
            function confirmarExclusao() {
                var r = confirm("Realmente deseja excluir?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script> 
    </body>
</html>
