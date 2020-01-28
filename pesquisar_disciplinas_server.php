<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
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
} elseif ($idcerto == 3) {
    echo "<script type=\"text/javascript\">
		alert(\"Ops! Essa Disciplina já Consta no Base) \");
                </script>
                ";
}
?>
<html lang="pt-br">
    <head>
        <title>DISCIPLINAS</title>        
        <style>
            input[type="checkbox"]{
                display: inline-block !important;
            }
        </style>
       
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
        <script>
            $(document).ready(function () {
                $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
            });
        </script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12" >
                    <h3>Disciplinas</h3>

                    <?php
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` ORDER BY disciplina");
                    $row = mysqli_num_rows($Consulta);

                    echo "<form name = 'form1' method = 'post' action = 'cadastrar_update_disciplina.php' onsubmit ='return confirmarExclusao()'>";
                    echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                    echo "<thead>";
                    echo "<tr>";
                    // echo "<th> ID </th>";
                    echo "<th> <input type='checkbox' name = 'turma_selecionadoa' class = 'selecionar'/>"
                    . "<a href = 'cadastrar_disciplina.php' <span title='Cadastrar Nova Disciplina'class='glyphicon glyphicon-plus btn-lg text-success' aria-hidden='true'></span></a>"
                    //  . "<button type ='submit' name ='exclui_disciplinas' value = 'exclui_disciplinas' onclick='return validaCheckbox()' class = 'btn btn-link' title = 'Exclui Varias Disciplinas' ><span title= 'Exclui Varias Disciplinas' class='glyphicon glyphicon-remove btn-lg vermelho' aria-hidden='true'></span></button>"
                    . "</th>";

                    echo "<th>DISCIPLINAS </th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    if ($row > 0) {

                        while ($linha = mysqli_fetch_array($Consulta)) {

                            $id = $linha['id'];
                            $disciplina = $linha['disciplina'];

                            echo "<tr>";
                            // echo "<td>" . $id . "</td>\n";
                            echo "<td><input type='checkbox' name='turma_selecionada[]' class = 'checkbox' value='" . $id . "'>"
                            . "&nbsp;&nbsp;<a href='cadastrar_update_disciplina.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true'></span></a>"
                            // . "&nbsp;&nbsp;<a href='excluir_disciplina.php?id=" . base64_encode($id) . "' onclick='return confirmarExclusao()'  target='_self' title='Excluir'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true' ></span></a>"
                            . "</td>";
                            echo "<td>" . $disciplina . "</td>\n";

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
        <script>
            $(document).ready(function () {
                $('#tbl_alunos_lista').DataTable({
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
        <!--INICIO FUNÇÃO DE MASCARA MAIUSCULA-->
        <script type="text/javascript">
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
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
                alert("Nenhuma Turma Selecionada!");
                return false;
            }
        </script> 
    </body>
</html>
