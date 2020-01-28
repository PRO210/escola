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
        <title>HISTÓRICO</title>        
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid" >          
            <h3 style="text-align: center">HISTÓRICO</h3>
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
            <style>

            </style>

            <?php
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` ORDER BY disciplina");
            //
            echo "<form method = 'post' action = '#'>";
            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>BIMESTRE</th>";
            while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                // $id = $linha['id'];
                $disciplina = $linha['disciplina'];
                $id = $linha['id'];
                // array_push($arrayDisciplinas, $linha['id']);

                echo "<th>" . $disciplina . "</th>";
            }
            echo "</thead>";
            echo "</tr>";
            echo "<tbody>";
            echo "<tr>";
            $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_I.*,disciplinas.disciplina FROM `bimestre_I`,`disciplinas` WHERE `id_bimestreI_aluno` = 19 AND disciplinas.id = `id_bimestre_I_disciplina` ORDER BY disciplina ");
            //
            echo "<th>I</th>";
            while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                $nota = $linhaConsulta2['nota'];
                //

                echo "<th>" . $nota . "</th>";
                //
            }
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            echo "</form>";
//
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` ORDER BY disciplina");
            //
            echo "<form method = 'post' action = '#'>";
            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>BIMESTRE</th>";
            while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                // $id = $linha['id'];
                $disciplina = $linha['disciplina'];
                $id = $linha['id'];
                // array_push($arrayDisciplinas, $linha['id']);

                echo "<th>" . $disciplina . "</th>";
            }
            echo "</thead>";
            echo "</tr>";
            echo "<tbody>";
            echo "<tr>";
            //
            $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_I.*,disciplinas.disciplina FROM `bimestre_I`,`disciplinas` WHERE `id_bimestreI_aluno` = 18  AND `ano` = '2017' AND disciplinas.id = `id_bimestre_I_disciplina` ORDER BY disciplina ");
            //
            echo "<th>II</th>";
            while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                $nota = $linhaConsulta2['nota'];
                //
                echo "<th>" . $nota . "</th>";
                //
            }
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            echo "</form>";
//
            ?>
            <script>
                $(document).ready(function () {

                // Setup - add a text input to each footer cell
                $('#tbl_alunos_lista tfoot th').each(function () {

                //Data Table
                var table = $('#tbl_alunos_lista').DataTable({

                "columnDefs": [{
                "targets": 0,
                        "orderable": false
                }],
                        "lengthMenu": [[10, 15, 20, 25, 35, 70, 100, - 1], [10, 15, 20, 25, 35, 70, 100, "All"]],
                        "language": {
                        "lengthMenu": "Alunos por Página _MENU_ ,
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

        </div>
    </body>
</html>
