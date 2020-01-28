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
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($Recebe_id == "1") {
    echo "<script type=\"text/javascript\">
		alert(\"Documentos Gravados com Sucesso! \");
                </script>
                ";
} elseif ($Recebe_id == "2") {
    echo "<script type=\"text/javascript\">
		alert(\"Falha no Procedimento! \");
                </script>
                ";
} elseif ($Recebe_id == "3") {
    echo "<script type='text/javascript'>
                alert('Por favor indique se existe ou não Substituto');
          </script>
     ";
} elseif ($Recebe_id == "4") {
    echo "<script type='text/javascript'>
                alert('Essa Substiuição já foi consta no Bando de Dados. Por Favor Verifique!');
          </script>
     ";
} elseif ($Recebe_id == "5") {
    echo "<script type='text/javascript'>
                alert('Substituição(es) Excluída(s) com Sucesso');
          </script>
     ";
} elseif ($Recebe_id == "6") {
    echo "<script type='text/javascript'>
                alert('Substituição(es) Excluída(s) com Sucesso');
          </script>
     ";
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title>SUBSTITUIÇÕES</title>
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
                    <h3 style="text-align: center">SUBSTITUIÇÕES</h3>
                    <?php
                    $Consultaf = mysqli_query($Conexao, "SELECT * FROM substituicoes WHERE `excluido` = 'N' ORDER BY `inicio` DESC, `servidor` ASC ");
                    $rowf = mysqli_num_rows($Consultaf);

                    echo "<form method= 'post'  action='cadastrar_update_substituicao_em_bloco.php' name = 'form1' onsubmit = 'return validaCheckbox()'>";
                    echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                    echo "<thead>";
                    echo "<tr>";
                    //echo "<th> ID </th>";
                    if ($rowf > 0) {
                         echo "<th>"
                    . "<div class='dropdown'>"
                    . "<input type='checkbox'  class = 'selecionar' />"
                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                    . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
                    . "<li><a><button type ='submit' name ='exclui' value = '' onclick = 'return confirmarExclusao()' class = 'btn btn-link' title = 'Exclui' ><span title= 'Exclui' class='glyphicon glyphicon-remove  vermelho' aria-hidden='true'></span></button>Exclui Vários</a></li>"
                    . "</ul>"
                    . "</div>"
                    . "</th>";
                    } else {
                         echo "<th>"
                    . "<div class='dropdown'>"
                    . "<input type='checkbox'  class = 'selecionar' disabled = ''/>"
                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                    . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
                    . "<li><a><button type ='submit' name ='exclui' value = '' onclick = 'return confirmarExclusao()' class = 'btn btn-link' title = 'Exclui' ><span title= 'Exclui' class='glyphicon glyphicon-remove  vermelho' aria-hidden='true'></span></button>Exclui Vários</a></li>"
                    . "</ul>"
                    . "</div>"
                    . "</th>";
                    }
                   
                    echo "<th> SERVIDOR </th>";
                    echo "<th> FUNÇÃO </th>";
                    echo "<th> SUBSTITUTO </th>";
                    echo "<th> TEMPO </th>";
                    echo "<th> INÍCIO </th>";
                    echo "<th> REMUNERADO </th>";
                    //echo "<th> ENVIADO </th>";
                    echo "<th> ENVIO EM </th>";
                    echo "</tr>";

                    echo "</thead>";
                    //
                    echo "<tfoot>";
                    echo "<tr>";
                    echo "<th> ------- </th>";
                    echo "<th> SERVIDOR </th>";
                    echo "<th> FUNÇÃO </th>";
                    echo "<th> SUBSTITUTO </th>";
                    echo "<th> TEMPO </th>";
                    echo "<th> INÍCIO </th>";
                    echo "<th> REMUNERADO </th>";
                    // echo "<th> ENVIADO </th>";
                    echo "<th> ENVIO EM </th>";
                    echo "</tr>";
                    echo "</tfoot>";
                    //
                    echo "<tbody>";

                    while ($linhaf = mysqli_fetch_array($Consultaf)) {

                        $id = $linhaf['id'];
                        $nome = $linhaf['servidor'];
                        $substituto = $linhaf['substituto'];
                        $funcao = $linhaf['funcao'];
                        $tempo = $linhaf['tempo'];
                        $inicio = new DateTime($linhaf["inicio"]);
                        $inicio_convertida = date_format($inicio, 'd/m/Y');
                        $remunerado = $linhaf['remuneracao'];
                        $enviado = $linhaf['enviado'];
                        $data_envio = $linhaf['data_envio'];
                        $data_envio_convertida = "";

                        if ($data_envio == "0000-00-00") {
                            $data_envio_convertida = "- - - - - - - - ";
                        } else {
                            $data_envio = new DateTime($linhaf['data_envio']);
                            $data_envio_convertida = date_format($data_envio, 'd/m/Y');
                        }

                        echo "<td>"
                        . "<div class='dropdown'>"
                        . "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id'>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><a href='cadastrar_update_substituicoes.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                        . "<li><a href='exclui_substituicao.php?id=" . base64_encode($id) . "' target='_self' onclick = 'return confirmarExclusao()' title='Exclui'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true' >&nbsp;</span>Exclui</a></li>"
                        . "</div>"
                        . "</u>"
                        . "</td>";
                        echo "<td>" . $nome . "</td>\n";
                        echo "<td>" . $funcao . "</td>\n";
                        echo "<td>" . $substituto . "</td>\n";
                        echo "<td>" . $tempo . "</td>\n";
                        echo "<td>" . $inicio_convertida . "</td>\n";
                        echo "<td>" . $remunerado . "</td>\n";
                        // echo "<td>" . $enviado . "</td>\n";
                        echo "<td>" . $data_envio_convertida . "</td>\n";

                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</form>";
                    ?>
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
                            alert("Nenhum Servidor foi selecionado!");
                            return false;
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
                    echo "<input type='submit' value='Editar em Bloco'<a href='?none= none' target='_blank' class='btn btn-primary' onclick= 'return validaCheckbox()'>"
                    . "&nbsp;&nbsp;<a href='cadastrar_substituicoes.php' target='_self' class='btn btn-success'>Nova Substiuição</a>"
                    ;
                    ?> ",
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
