<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>    
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title>SERVIDORES</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .a_bt{
                margin-left: 8px;color: green;
            }
        </style>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" >
                    <h3 style="text-align: center">SERVIDORES</h3>
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
                    <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <script src="js/cadastrar_validar.js" type="text/javascript"></script>
                    <link href="css/servidores_procurar_server.css" rel="stylesheet" type="text/css"/>
                    <?php
                    $turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
                    $buscar_vinculo = filter_input(INPUT_POST, 'inputvinculo', FILTER_DEFAULT);
                    $buscarf = "";

                    if ($buscar_vinculo == "") {
                        $buscarf = filter_input(INPUT_POST, 'inputbuscarf', FILTER_DEFAULT);
                        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `nome` LIKE '%" . $buscarf . "%' AND `vinculo` LIKE '%" . $buscar_vinculo . "%' AND `turno` LIKE '%" . $turno . "%' AND `excluido` = 'N' ORDER BY nome");
                        $rowf = mysqli_num_rows($Consultaf);

                        if ($rowf > 0) {

                            echo "<form method = 'post' action='atualizar_varios_servidor.php' name = 'form1' >";
                            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                            echo "<thead>";
                            echo "<tr>";
                            // echo "<th> ID </th>";
                            echo "<th>"
                            . "<div class='dropdown'>"
                            . "<input type='checkbox' name='servidor_selecionado[]' class = 'selecionar'/>"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><button type='submit' value='imprimir' name = 'imprimir'  class='btn btn-link btn-lg verde' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão</li>"
                            . "</th>";
                            // echo "<th> MATRICULA </th>";
                            echo "<th> VÍNCULO </th>";
                            echo "<th> FUNÇÃO </th>";
                            echo "<th> TURNO </th>";
                            echo "<th> NOME </th>";
                            echo "<th> NASCIDO </th>";
                            echo "<th> CPF </th>";
                            echo "<th> CELULAR </th>";
                            //  echo "<th> EMAIL </th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while ($Registro = mysqli_fetch_array($Consultaf)) {

                                $id = $Registro["id"];
                                $matricula = $Registro["matricula"];
                                $vinculo = $Registro["vinculo"];
                                $funcao = $Registro["funcao"];
                                $turno = $Registro["turno"];
                                $nome = $Registro["nome"];
                                $nascimento = new DateTime($Registro["nascimento"]);
                                $data_nascimento_convertida = date_format($nascimento, 'd/m/Y');
                                $cpf = $Registro["cpf"];
                                $celular = $Registro["celular"];
                                // $email = $Registro["email"];

                                echo "<tr>";
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='cadastrar_update_servidor.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil laranja' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href='mostrar_cadastro_servidor.php?id=" . base64_encode($id) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                                . "<li><a href='excluir_servidor_server.php?id=" . base64_encode($id) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Excluir</a></li>"
                                . "<li><button style = 'border:none;' type = 'submit' class = 'btn btn-default bt_default' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print  a_bt' aria-hidden='true'>&nbsp;</span>Recadastramento da Prefeitura</button></li>"
                                . "</td>";
                                // echo "<td>" . $matricula . "</td>\n";
                                echo "<td>" . $vinculo . "</td>\n";
                                echo "<td>" . $funcao . "</td>\n";
                                echo "<td>" . $turno . "</td>\n";
                                echo "<td>" . $nome . "</td>\n";
                                echo "<td>" . $data_nascimento_convertida . "</td>\n";
                                echo "<td>" . $cpf . "</td>\n";
                                echo "<td>" . $celular . "</td>\n";
                                // echo "<td>" . $email . "</td>\n";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</form>";
                        } else {
                            echo "Nada enconrado.";
                        }
                        //Professores
                    } elseif ($buscar_vinculo == "PROFESSOR(A)") {
                        $turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
                        $buscar_vinculo = filter_input(INPUT_POST, 'inputvinculo', FILTER_DEFAULT);
                        $buscarf = filter_input(INPUT_POST, 'inputbuscarf', FILTER_DEFAULT);
                        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `nome` LIKE '%" . $buscarf . "%' AND `funcao` LIKE '%" . $buscar_vinculo . "%' AND `turno` LIKE '%" . $turno . "%'  AND `excluido` = 'N' ORDER BY nome");
                        $rowf = mysqli_num_rows($Consultaf);
                        if ($rowf > 0) {

                            echo "<form method = 'post' action='atualizar_varios_servidor.php' name = 'form1' >";
                            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                            echo "<thead>";
                            echo "<tr>";
                            // echo "<th> ID </th>";
                            echo "<th>"
                            . "<div class='dropdown'>"
                            . "<input type='checkbox' name='servidor_selecionado[]' class = 'selecionar'/>"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><button type= 'submit' value='imprimir' name = 'imprimir' class='btn btn-success' onclick= 'return validaCheckbox()' >Impressão</button></li>"
                            . "</th>";
                            //echo "<th> MATRICULA </th>";
                            echo "<th> VÍNCULO </th>";
                            echo "<th> FUNÇÃO </th>";
                            echo "<th> TURNO </th>";
                            echo "<th> NOME </th>";
                            echo "<th> NASCIDO </th>";
                            echo "<th> CPF </th>";
                            echo "<th> CELULAR </th>";
                            //echo "<th> EMAIL </th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($Registro = mysqli_fetch_array($Consultaf)) {

                                $id = $Registro["id"];
                                $matricula = $Registro["matricula"];
                                $vinculo = $Registro["vinculo"];
                                $funcao = $Registro["funcao"];
                                $turno = $Registro["turno"];
                                $nome = $Registro["nome"];
                                $nascimento = new DateTime($Registro["nascimento"]);
                                $data_nascimento_convertida = date_format($nascimento, 'd/m/Y');
                                $cpf = $Registro["cpf"];
                                $celular = $Registro["celular"];
                                //  $email = $Registro["email"];

                                echo "<tr>";
                                // echo "<td>" . $id . "</td>\n";
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='cadastrar_update_servidor.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil laranja' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href='mostrar_cadastro_servidor.php?id=" . base64_encode($id) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                                . "<li><a href='excluir_servidor_server.php?id=" . base64_encode($id) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Excluir</a></li>"
                                . "</td>";
// echo "<td>" . $matricula . "</td>\n";
                                echo "<td>" . $vinculo . "</td>\n";
                                echo "<td>" . $funcao . "</td>\n";
                                echo "<td>" . $turno . "</td>\n";
                                echo "<td>" . $nome . "</td>\n";
                                echo "<td>" . $data_nascimento_convertida . "</td>\n";
                                echo "<td>" . $cpf . "</td>\n";
                                echo "<td>" . $celular . "</td>\n";
                                //echo "<td>" . $email . "</td>\n";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            //  echo "<input type='submit' value='Editar em Bloco' <a href='atualizar_varios_servidor.php' target='_blank' class='btn btn-success'>";
                            echo "</form>";
                        } else {
                            echo "Nenhum resultado encontrado";
                        }

                        //Por Vínculo Específico
                    } else {
                        $turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
                        $buscar_vinculo = filter_input(INPUT_POST, 'inputvinculo', FILTER_DEFAULT);
                        $buscarf = filter_input(INPUT_POST, 'inputbuscarf', FILTER_DEFAULT);

                        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `nome` LIKE '%" . $buscarf . "%' AND `vinculo` LIKE '%" . $buscar_vinculo . "%' AND `turno` LIKE '%" . $turno . "%'  AND `excluido` = 'N' ORDER BY nome");
                        $rowf = mysqli_num_rows($Consultaf);
                        if ($rowf > 0) {

                            echo "<form method = 'post' action='atualizar_varios_servidor.php' name = 'form1' >";
                            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                            echo "<thead>";
                            echo "<tr>";
                            // echo "<th> ID </th>";
                            echo "<th>"
                            . "<div class='dropdown'>"
                            . "<input type='checkbox' name='servidor_selecionado[]' class = 'selecionar'/>"
                            . "&nbsp;<span class='glyphicon glyphicon-cog btn-lg text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><button type='submit' value='imprimir'  name = 'imprimir' class='btn btn-success' onclick= 'return validaCheckbox()' >Impressão</button></li>"
                            . ""
                            . "</th>";
                            //echo "<th> MATRICULA </th>";
                            echo "<th> VÍNCULO </th>";
                            echo "<th> FUNÇÃO </th>";
                            echo "<th> TURNO </th>";
                            echo "<th> NOME </th>";
                            echo "<th> NASCIDO </th>";
                            echo "<th> CPF </th>";
                            echo "<th> CELULAR </th>";
                            //echo "<th> EMAIL </th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($Registro = mysqli_fetch_array($Consultaf)) {

                                $id = $Registro["id"];
                                $matricula = $Registro["matricula"];
                                $vinculo = $Registro["vinculo"];
                                $funcao = $Registro["funcao"];
                                $turno = $Registro["turno"];
                                $nome = $Registro["nome"];
                                $nascimento = new DateTime($Registro["nascimento"]);
                                $data_nascimento_convertida = date_format($nascimento, 'd/m/Y');
                                $cpf = $Registro["cpf"];
                                $celular = $Registro["celular"];
                                //  $email = $Registro["email"];

                                echo "<tr>";
                                // echo "<td>" . $id . "</td>\n";
                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='cadastrar_update_servidor.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil laranja' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "<li><a href='mostrar_cadastro_servidor.php?id=" . base64_encode($id) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                                . "<li><a href='excluir_servidor_server.php?id=" . base64_encode($id) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Excluir</a></li>"
                                . "</td>";
// echo "<td>" . $matricula . "</td>\n";
                                echo "<td>" . $vinculo . "</td>\n";
                                echo "<td>" . $funcao . "</td>\n";
                                echo "<td>" . $turno . "</td>\n";
                                echo "<td>" . $nome . "</td>\n";
                                echo "<td>" . $data_nascimento_convertida . "</td>\n";
                                echo "<td>" . $cpf . "</td>\n";
                                echo "<td>" . $celular . "</td>\n";
                                //echo "<td>" . $email . "</td>\n";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            //  echo "<input type='submit' value='Editar em Bloco' <a href='atualizar_varios_servidor.php' target='_blank' class='btn btn-success'>";
                            echo "</form>";
                        }
                    }
                    ?>
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
                    <script>
                        $(document).ready(function () {
                            $('#tbl_alunos_lista').DataTable({
                                "columnDefs": [{
                                        "targets": 0,
                                        "orderable": false
                                    }],
                                "lengthMenu": [[10, 15, 20, 25, 35, 70, 100, -1], [10, 15, 20, 25, 35, 70, 100, "All"]],
                                "language": {
                                    "lengthMenu": "Alunos por Página _MENU_ <?php
                    echo "<input type='submit' value='Editar em Bloco' <a href='atualizar_varios_servidor.php' target='_blank' class='btn btn-primary' onclick= 'return validaCheckbox()'>"
                    . "&nbsp;&nbsp;<a href='cadastrar_servidores.php' target='_self' class='btn btn-success' >Cadastrar Servidor</a>"
                    ?>",
                                    "zeroRecords": "Nenhum Servidor Encontrado",
                                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                                    "infoEmpty": "Sem registros",
                                    "search": "Busca:",
                                    "infoFiltered": "(filtrado de _MAX_ total de Servidores)",
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
                            alert("Nenhum Servidor foi selecionado!");
                            return false;
                        }
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>
