<!DOCTYPE html>
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
} elseif ($idcerto == 5) {
    echo "<script type=\"text/javascript\">
    alert(\"Alterações Foram Realizadas com Sucesso, mas as Ações não Foram Gravadas! \");
    </script>
    ";
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title>SERVIDORES ARQUIVO PASSIVO</title>
        <style>               
            tfoot input {
                width: 100%;
                padding: 3px;
                box-sizing: border-box;
            }              
        </style>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="css/servidores_procurar_server.css" rel="stylesheet" type="text/css"/>
        <div class="container-fluid"><br>
            <div class="row">
                <div class="col-sm-12" >
                    <h3 style="text-align: center">SERVIDORES ARQUIVO PASSIVO</h3>
                    <?php
                    $buscarf = "";

                    $buscarf = filter_input(INPUT_POST, 'inputbuscarf', FILTER_DEFAULT);
                    $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `excluido` = 'S' ORDER BY nome");
                    $rowf = mysqli_num_rows($Consultaf);

                    echo "<form method = 'post' action='servidores_arquivo_passivo_server.php' name = 'form1' >";
                    echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                    echo "<thead>";
                    echo "<tr>";
                    // echo "<th> ID </th>";
                    if ($rowf > 0) {
                        echo "<th>"
                        . "<div class='dropdown'>"
                        . "<input type='checkbox' name='servidor_selecionado[]' class = 'selecionar'/>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><button type='submit' value='imprimir' name = 'imprimir'  class='btn btn-link btn-lg verde' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão</li>"
                        . "</th>";
                    } else {
                        echo "<th>"
                        . "<div class='dropdown'>"
                        . "<input type='checkbox' name='servidor_selecionado[]' class = 'selecionar' disabled = ''/>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><button type='submit' value='imprimir' name = 'imprimir'  class='btn btn-link btn-lg verde' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão</li>"
                        . "</th>";
                    }

                    // echo "<th> MATRICULA </th>";
                    echo "<th> NOME </th>";
                    echo "<th> VÍNCULO </th>";
                    echo "<th> FUNÇÃO </th>";
                    // echo "<th> TURMA </th>";
                    echo "<th> TURNO </th>";
                    //echo "<th> NASCIDO </th>";
                    echo "<th> CPF </th>";
                    echo "<th> CELULAR </th>";
                    //  echo "<th> EMAIL </th>";
                    echo "</tr>";
                    echo "</thead>";
                    //
                    echo "<tfoot>";
                    echo "<tr>";
                    echo "<th>  </th>";
                    echo "<th> VÍNCULO </th>";
                    echo "<th> FUNÇÃO </th>";
                    echo "<th> TURNO </th>";
                    echo "<th> NOME </th>";
                    echo "<th> CPF </th>";
                    echo "<th> CELULAR </th>";
                    echo "</tr>";
                    echo "</tfoot>";
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
                        . "<li><a href='excluir_servidor_server_1.php?id=" . base64_encode($id) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir o Servidor'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Excluir o Servidor</a></li>"
                        . "</td>";
                        // echo "<td>" . $matricula . "</td>\n";
                        echo "<td>" . $nome . "</td>\n";
                        echo "<td>" . $vinculo . "</td>\n";
                        echo "<td>" . $funcao . "</td>\n";
                        echo "<td>" . $turno . "</td>\n";
                        //echo "<td>" . $data_nascimento_convertida . "</td>\n";
                        echo "<td>" . $cpf . "</td>\n";
                        echo "<td>" . $celular . "</td>\n";
                        // echo "<td>" . $email . "</td>\n";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</form>";
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
                    echo "<button type='submit' value='retirar' name = 'retirar' class='btn btn-success btn-sm '  onclick= 'return validaCheckbox()'>Retirar do Arquivo</button>"
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
