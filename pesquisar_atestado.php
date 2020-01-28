<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$Msg = "";
$M = "";

if ($Recebe_id == "1") {
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Documentos Gravados com Sucesso! </div>";
    $M = "1";
} elseif ($Recebe_id == "2") {
//    echo "<script type=\"text/javascript\">
//		alert(\"Falha no Procedimento! \");
//                </script>
//                ";
    $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ops! Alguma Coisa Deu errado Tente de Novo ou Entre em Contato com o Administrador </div>";
    $M = "2";
} elseif ($Recebe_id == "3") {
    echo "<script type='text/javascript'>
                alert('Por favor indique se existe ou não um Substituto!');
          </script>
     ";
} elseif ($Recebe_id == "4") {
    echo "<script type=\"text/javascript\">
		    alert('Esse Atestado já foi consta no Bando de Dados. Por Favor Verifique!');
                </script>
                ";
} elseif ($Recebe_id == "5") {
    echo "<script type=\"text/javascript\">
		    alert('Atenção! Somente pode haver um Substituto.');
                </script>
                ";
} elseif ($Recebe_id == "6") {
    echo "<script type='text/javascript'>
                alert('Atestado(s) Excluído(s) com Sucesso');
          </script>
     ";
}
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <title>ATESTADOS</title>
    </head>   
    <body>
        <div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="gridSystemModalLabel">Avisos</h5>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo $Msg;
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div> 
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid"><br>  
            <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>            
            <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
            <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>            
            <script src="js/cadastrar_validar.js" type="text/javascript"></script>
            <link href="css/tabela_atestado.css" rel="stylesheet" type="text/css"/>
            <h3 style="text-align: center;">Atestados dos Servidores</h3>
            <?php
            if ($M == "1") {
                echo"<script type='text/javascript'>

                $(document).ready(function () {
                    $('#exemplomodal').modal('show');
                });
            </script>";
            } elseif ($M == "2") {
                echo"<script type='text/javascript'>

                $(document).ready(function () {
                    $('#exemplomodal').modal('show');
                });
            </script>";
            }
            ?>
            <?php
            $Consultaf = mysqli_query($Conexao, "SELECT * FROM atestados_servidor WHERE `excluido` = 'N' ORDER BY `recebido` DESC");
            $rowf = mysqli_num_rows($Consultaf); //

            echo "<form method= 'post' action='cadastrar_update_atestado_em_bloco.php' name = 'form1' onsubmit ='return validaCheckbox()' >";
            echo "<table class='table table-striped table-bordered' id='example' width='100%' cellspacing='0' >";
            echo "<thead>";
            echo "<tr>";
            if ($rowf > 0) {
                echo "<th>"
                . "<div class='dropdown'>"
                . "<input type='checkbox'  class = 'selecionar'/>"
                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                . "<li><a><button type='submit' value='' name = 'basica' class='btn btn-link verde' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão Básica</a></li>"
                . "<li><a><button type='submit' value='' name = 'detalhada' class='btn btn-link verde' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão Hora/Aula</a></li>"
                . "<li><a><button type ='submit' name ='exclui' value = '' onclick = 'return confirmarExclusao()' class = 'btn btn-link' title = 'Exclui Vários' ><span title= 'Exclui' class='glyphicon glyphicon-remove  vermelho' aria-hidden='true'></span></button>Exclui Vários</a></li>"
                . "</ul>"
                . "</div>"
                . "</th>";
            } else {
                echo "<th>"
                . "<div class='dropdown'>"
                . "<input type='checkbox'  class = 'selecionar' disabled = ''/>"
                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link verde' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
                . "<li><a><button type ='submit' name ='exclui' value = '' onclick = 'return confirmarExclusao()' class = 'btn btn-link' title = 'Exclui Vários' ><span title= 'Exclui' class='glyphicon glyphicon-remove  vermelho' aria-hidden='true'></span></button>Exclui Vários</a></li>"
                . "</ul>"
                . "</div>"
                . "</th>";
            }

            echo "<th> SERVIDOR </th>";
            echo "<th> SUBSTITUTO </th>";
            echo "<th> TURNO </th>";
            echo "<th> INÍCIO/FIM </th>";
            echo "<th> TEMPO </th>";
            echo "<th> REMUNERADO </th>";
            echo "<th> ENVIO EM </th>";
            echo "</tr>";
            echo "</thead>";
            //
            echo "<tfoot>";
            echo "<tr>";
            echo "<th>  </th>";
            echo "<th> SERVIDOR </th>";
            echo "<th> SUBSTITUTO </th>";
            echo "<th> TURNO </th>";
            echo "<th> INÍCIO/FIM </th>";
            echo "<th> TEMPO </th>";
            echo "<th> REMUNERADO </th>";
            echo "<th> ENVIO EM </th>";
            echo "</tr>";
            echo "</tfoot>";
            //
            echo "<tbody>";
            //
            if ($rowf > 0) {
                //
                while ($linhaf = mysqli_fetch_array($Consultaf)) {

                    $id = $linhaf['id'];
                    $nome = $linhaf['servidor'];
                    $substituto = $linhaf['substituto'];
                    $turno_recebe = $linhaf['turno'];
                    $turno = "";
                    if ($turno_recebe == "M") {
                        $turno = "MANHÃ";
                    } elseif ($turno_recebe == "T") {
                        $turno = "TARDE";
                    } elseif ($turno_recebe == "N") {
                        $turno = "NOITE";
                    } else {
                        $turno = "-----";
                    }
                    $recebido = new DateTime($linhaf["recebido"]);
                    $recebido_convertida = date_format($recebido, 'd/m/Y');
                    $tipo = $linhaf["tipo"];
                    $tempo = $linhaf['tempo'];
                    $inicio = new DateTime($linhaf["inicio"]);
                    $inicio_convertida = date_format($inicio, 'd/m/Y');
                    $fim = new DateTime($linhaf['fim']);
                    $fim_convertida = date_format($fim, 'd/m/Y');
                    if ($tempo == "1") {
                        $fim_convertida = "";
                        $as = '';
                    } else {
                        $inicio_convertida = date_format($inicio, 'd/m');
                        $as = ' à ';
                    }
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
                    . "<li><a href='cadastrar_update_atestado.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                    . "<li><a href='exclui_atestado.php?id=" . base64_encode($id) . "' target='_self' onclick = 'return confirmarExclusao()' title='Exclui'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true' >&nbsp;</span>Exclui</a></li>"
                    . "</div>"
                    . "</u>"
                    . "</td>";
                    echo "<td>" . $nome . "</td>\n";
                    echo "<td> " . $substituto . " </td>\n";
                    echo "<td> " . $turno . " </td>\n";
                    echo "<td>" . $inicio_convertida . $as . $fim_convertida . "</td>\n";
                    echo "<td>" . $tempo . "</td>\n";
                    echo "<td>" . $remunerado . "</td>\n";
                    // echo "<td>" . $enviado . "</td>\n";
                    echo "<td>" . $data_envio_convertida . "</td>\n";

                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</form>";
            } else {
                echo "Nada enconrado.";
            }
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    // Setup - add a text input to each footer cell
                    $('#example tfoot th').each(function () {
                        var title = $(this).text();
                        $(this).html('<input type="text" placeholder=" ' + title + '" />');
                    });
                    // DataTable
                    var table = $('#example').DataTable({

                        "columnDefs": [{
                                "targets": 0,
                                "orderable": false
                            }],
                        "lengthMenu": [[7, 15, 20, 25, 35, 70, 100, -1], [7, 15, 20, 25, 35, 70, 100, "All"]],
                        "language": {
                            "lengthMenu": "Alunos por Página _MENU_ <?php
            echo "<input type='submit' value='Editar em Bloco' name = 'varios'<a href='' target='_blank' class='btn btn-primary' onclick= 'return validaCheckbox()'>"
            . "&nbsp;&nbsp;<a href='cadastrar_atestado.php' target='_self' class='btn btn-success'>Novo Atestado</a>"
            ;
            ?> ",
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
                    $('table th input[type=checkbox]').on('click', function (event) {
                        event.stopPropagation ? event.stopPropagation() : event.returnValue = false;
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
                //Confimrar Exclusão
                function confirmarExclusaoTodos() {
                    var r = confirm("Realmente deseja excluir o(s) Atestado(s)?");
                    if (r == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>                        
        </div>           
    </body>
</html>
