<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/servidores_procurar_server.css" rel="stylesheet" type="text/css"/>
        <div class="container-fluid"><br>
            <div class="row">
                <div class="col-sm-12">
                    <h1>Usuários</h1>
                    <?php
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `usuarios`");
                    $row = mysqli_num_rows($Consulta);

                    if ($row > 0) {

                        echo "<form method = '' action = ''>";
                        echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th> ID </th>";
                        echo "<th> <input type='checkbox' name = 'turma_selecionadoa' class = 'selecionar'/></th>";
                        echo "<th> USUÁRIO </th>";
                        echo "<th> SENHA </th>";
                        echo "<th> NOME COMPLETO </th>";
                        echo "<th> TIPO </th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        while ($linha = mysqli_fetch_array($Consulta)) {
                            $id = $linha['id'];
                            $usuario = $linha['usuario'];
                            $senha = $linha['senha'];
                            $nome = $linha['nome'];

                            $tipo = $linha['tipo'];
                            $txt_option = "";
                            if ($tipo == 0) {
                                $txt_option = "ADMIN";
                            } else {
                                $txt_option = "USUÁRIO";
                            }
                            echo "<tr>";
                            echo "<td>" . $id . "</td>\n";
                            echo "<td><input type='checkbox' name='turma_selecionada[]' class = 'checkbox' value='$id'>"
                            . "&nbsp;&nbsp;<a href='cadastrar_update_usuario.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil laranja' aria-hidden='true' ></span></a>"
                            . "&nbsp;&nbsp;<a href='excluir_usuario.php?id=" . base64_encode($id) . "' onclick='return confirmarExclusao()'  target='_self' title='Alterar'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true' ></span></a></td>\n";
                            echo "<td>" . $usuario . "</td>\n";
                            echo "<td>" . $senha . "</td>\n";
                            echo "<td>" . $nome . "</td>\n";
                            echo "<td>" . $txt_option . "</td>\n";
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
                        "lengthMenu": "Turmas por Página _MENU_ <?php
                    echo "<a href='cadastrar_usuario.php' target='_self' class='btn btn-success' >Cadastrar</a>"
                    ;
                    ?>",
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
