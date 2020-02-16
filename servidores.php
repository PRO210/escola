<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$idcerto = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($idcerto == 1) {
    echo "<script type=\"text/javascript\">
    alert(\"Alterações Realizadas com Sucesso! \");
    </script>
    ";
} elseif ($idcerto == 2) {
    echo "<script type=\"text/javascript\">
    alert(\"Ops! Falha na Operação:) \");
    </script>
    ";
} elseif ($idcerto == 3) {
    echo "<script type=\"text/javascript\">
    alert(\"Alterações Realizadas com Sucesso!! \");
    </script>
    ";
} elseif ($idcerto == 4) {
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
        <title>SERVIDORES</title>
        <style>               
            tfoot input {
                width: 100%;
                padding: 3px;
                box-sizing: border-box;
            }             
            input[type="checkbox"]{
                display: inline-block !important;               
            }
            .rosa{ color: pink; padding-bottom: 12px;
            }
            .a_bt{
                margin-left: 8px;color: green;
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
        <script>
            $(document).ready(function () {
                $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
            });
        </script>
        <div class="container-fluid"><br>
            <div class="row">
                <div class="col-sm-12" >
                    <?php
                    $buscarf = "";
                    $buscarf = filter_input(INPUT_POST, 'inputbuscarf', FILTER_DEFAULT);
                    $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `nome` LIKE '%" . $buscarf . "%' AND `excluido` = 'N' ORDER BY nome");
                    $rowf = mysqli_num_rows($Consultaf);

                    if ($rowf > 0) {

                        echo "<form method = 'post' action='atualizar_varios_servidor.php' name = 'form1' >";
                        echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                        echo "<thead>";
                        echo "<tr>";
                        // echo "<th> ID </th>";
                        echo "<th>"
                        . "<div class='dropdown'>"
                        . "<input type='checkbox' name='' class = 'selecionar'/>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><button type='submit' value='imprimir' name = 'imprimir'  class='btn btn-link  verde' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</li>"
                        . "<li><button type='submit' value='' name = 'imprimir_funcao'  class='btn btn-link  verde' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral por Funcão</li>"
                        . "<li><button type='submit' value='imprimir_pdf' name = 'imprimir_pdf'  class='btn btn-link verde ' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Recad. Pref</li>"
                        . "<li><button type='submit' value='' name = 'imprimir_gerencial'  class='btn btn-link  verde' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Gerencial Excel &nbsp;&nbsp;</li>"
                        . "<li><button type='submit' value='' name = 'imprimir_gerencial_texto'  class='btn btn-link  verde' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Gerencial Texto&nbsp;&nbsp;</li>"
                        . "<li><button type='submit' value='' name = 'imprimir_gerencial_pdf'  class='btn btn-link  verde' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Gerencial PDF&nbsp;&nbsp;</li>"
                        . "</th>";

                        echo "<th> NOME </th>";
                        echo "<th> FUNÇÃO </th>";
                        echo "<th> VÍNCULO </th>";
                        echo "<th> TURNO </th>";
                        echo "<th> CPF </th>";
                        echo "<th> CELULAR </th>";
                        echo "</tr>";
                        echo "</thead>";
                        //
                        echo "<tfoot>";
                        echo "<tr>";
                        echo "<th>  </th>";
                        echo "<th> NOME </th>";
                        echo "<th> FUNÇÃO </th>";
                        echo "<th> VÍNCULO </th>";
                        echo "<th> TURNO </th>";
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
                            $substituta = $Registro["substituta"];
                            $projeto = $Registro["projeto"];
                            $comissionado = "";
                            if ($Registro["comissionado"] == "SIM") {
                                $comissionado = "Comissionado";
                            }
                            $teste_folga = "";
                            $teste_nome = $nome;
                            $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                            $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                            $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                            if ($ContLinhasAtestados > 0) {
                                $dias = intval($linha_atestados['dias']);
                                if ($dias >= 0) {
                                    $teste_folga = " /Está de Atestado; ";
                                }
                            }
                            if ($substituta == "SIM") {
                                $substituta = " - Substituto(a)";
                            } else {
                                $substituta = "";
                            }
                            if ($projeto == "SIM") {
                                $projeto_nome = " - " . $Registro["projeto_nome"];
                            } else {
                                $projeto_nome = "";
                            }

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
                            . "<li><a href='mostrar_cadastro_servidor.php?id=" . base64_encode($id) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user rosa' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                            . "<li><button name = 'imprimir_pdf' value = 'imprimir_pdf' style = 'border:none;' type = 'submit' class = 'btn btn-default bt_default' onclick= 'return validaCheckbox()'><span class='glyphicon glyphicon-print  a_bt' aria-hidden='true'>&nbsp;</span>Recadastramento da Prefeitura</button></li>"
                            . "<li><a href='excluir_servidor_server.php?id=" . base64_encode($id) . "' onclick='return confirmarRemover()' target='_self' title='Mover Para O Arquivo Passivo'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'>&nbsp;</span>Mover Para O Arquivo Passivo</a></li>"
                            . "<li><a href='excluir_servidor_server_1.php?id=" . base64_encode($id) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir o Servidor'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Excluir o Servidor</a></li>"
                            . "</ul>"
                            . "</td>";
                            echo "<td>" . $nome . $teste_folga . $substituta .$projeto_nome. "</td>\n";
                            echo "<td>" . $funcao . " - " . $comissionado . "</td>\n";
                            echo "<td>" . $vinculo . "</td>\n";
                            echo "<td>" . $turno . "</td>\n";
                            echo "<td>" . $cpf . "</td>\n";
                            echo "<td>" . $celular . "</td>\n";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</form>";
                    } else {
                        echo "Nada enconrado.";
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
                        function confirmarRemover() {
                            var r = confirm("Realmente Deseja Remover");
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
                                "lengthMenu": [[7, 10, 15, 20, 25, 30, 35, 40, 50, 55, 70, 80, 100, -1], [7, 10, 15, 20, 25, 30, 35, 40, 50, 55, 70, 80, 100, "All"]],
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
