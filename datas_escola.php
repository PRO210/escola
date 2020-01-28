<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>    

<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>

<html>
    <head>
        <?php
        include_once './head.php';
        ?>
        <title></title>

        <link href="css/pesquisar_no_banco.css" rel="stylesheet" type="text/css"/>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">       
                    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <script src="js/cadastrar_validar.js" type="text/javascript"></script>
                    <?php
                    $Consultaf_nis = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,data_valida_matricula) AS idade FROM alunos WHERE excluido = 'N' AND `status` = 'cursando' ORDER BY nome");
                    $rowf_nis = mysqli_num_rows($Consultaf_nis);

                    if ($rowf_nis > 0) {

                        echo "<form method=post action='datas_escola_cliente.php' name = 'form1'>";
                        echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                        echo "<thead>";
                        echo "<tr>";
                        // echo "<th> ID </th>";
                        echo "<th> <input type='checkbox' class = 'selecionar'/></th>";
                        echo "<th> NOME </th>";
                        echo "<th> NACIMENTO </th>";
                        echo "<th> IDADE </th>";
                        echo "<th> MATRICULA </th>";
                        echo "<th> CENSO </th>";
                        echo "<th> TURMA </th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "";

                        while ($linhaf_nis = mysqli_fetch_array($Consultaf_nis)) {

                            $nomef_nis = $linhaf_nis['nome'];
                            $data_nascimentof_nis = new DateTime($linhaf_nis["data_nascimento"]);
                            $nascimentof_nis = date_format($data_nascimentof_nis, 'd/m/Y');
                            $idade_nis = $linhaf_nis['idade'];
                            $dmp_nis = new DateTime($linhaf_nis['data_valida_matricula']);
                            $dmp_nis_convertida = date_format($dmp_nis, 'd/m/Y');
                            $data_censo_nis = new DateTime($linhaf_nis['data_censo']);
                            $data_censo_nis_convertida = date_format($data_censo_nis, 'd/m/Y');
                            $nisf_nis = $linhaf_nis['nis'];
                            $idf_nis = $linhaf_nis['id'];
                            $turmaf_nis = $linhaf_nis['turma'];

                            echo "<tr>";
                            // echo "<td>" . $idf_nis . "</td>\n";
                            echo "<td><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf_nis'></td>\n";
                            echo "<td>" . $nomef_nis . "</td>\n";
                            echo "<td>" . $nascimentof_nis . "</td>\n";
                            echo "<td>" . $idade_nis . "</td>\n";
                            echo "<td>" . $dmp_nis_convertida . "</td>\n";
                            echo "<td>" . $data_censo_nis_convertida . "</td>\n";
                            echo "<td>" . $turmaf_nis . "</td>\n";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // echo "<input type='submit' value='Editar em Bloco' <a href='datas_escola_cliente.php' target='_blank' class='btn btn-success'>";
                        echo "</form>";
                    } else {
                        echo "Nada enconrado.";
                    }
                    ?>

                    <script>
                        $(document).ready(function () {
                            $('#tbl_alunos_lista').DataTable({
                                "language": {
                                    "lengthMenu": " Total de Alunos por Página _MENU_<?php echo "<input type='submit' value='Editar em Bloco' target='_blank' class='btn btn-primary' onclick= 'return validaCheckbox()'>"; ?>",
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
                                //Verifica se o elemento do formulário corresponde a um checkbox e se é o checkbox desejado
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
            </div>
        </div>
    </body>
</html>
