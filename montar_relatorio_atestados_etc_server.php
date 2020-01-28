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
        <title>MONTAR RELAT. ATESTADOS</title>
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
        <div class="container-fluid"><br>              
            <script src="js/bootstrap.js" type="text/javascript"></script>
            <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
            <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="css/montar_relatorio_atestados_server.css" rel="stylesheet" type="text/css"/>

            <?php
            echo "<form method= 'post'  action='cadastrar_update_atestado_em_bloco.php' name = 'form1' >";
                echo " <input type='text' hidden='' name='pesquisar_no_banco' >";
                echo "<table class='table table-striped table-bordered' id='example'>";
                echo "<thead>";
                echo "<tr>";
                //echo "<th> ID </th>";
                echo "<th>"
                . "<div class='dropdown'>"
                . "<input type='checkbox'  class = 'selecionar'/>"
                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                . "<li><a><button type='submit' value='' name = 'basica' class='btn btn-link verde' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão Básica</a></li>"
                . "<li><a><button type='submit' value='' name = 'detalhada' class='btn btn-link verde' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão Hora/Aula</a></li>"
                . "</ul>"
                . "</div>"
                . "</th>";
                echo "<th> SERVIDOR </th>";
                echo "<th> SUBSTITUTO </th>";
                echo "<th> TEMPO </th>";
                echo "<th> INÍCIO </th>";
                echo "<th> FIM </th>";
                echo "<th> REMUNERADO </th>";
                echo "<th> ENVIADO </th>";
                echo "<th> ENVIO EM </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tfoot>";
                echo "<tr>";
                echo "<th>  </th>";
                echo "<th> SERVIDOR </th>";
                echo "<th> SUBSTITUTO </th>";
                echo "<th> TEMPO </th>";
                echo "<th> INÍCIO </th>";
                echo "<th> FIM </th>";
                echo "<th> REMUNERADO </th>";
                echo "<th> ENVIADO </th>";
                echo "<th> ENVIO EM </th>";
                echo "</tr>";
                echo "</tfoot>";
                echo "<tbody>";
            //
            $hoje = date('Y-m-d');
            $enviado_II = "";
            $enviado = filter_input(INPUT_POST, 'inputEnviado', FILTER_DEFAULT);
            $fim = "";
            $inicio = "";
            $data_envio = "";
            if ($enviado == "SIM") {
                $enviado_II = "`enviado` LIKE 'SIM' AND";
                //
                $inicio = filter_input(INPUT_POST, 'inputDataInicio', FILTER_DEFAULT);
                $fim = filter_input(INPUT_POST, 'inputDataFIM', FILTER_DEFAULT);
                $data_envio = "AND `data_envio` BETWEEN '$inicio' AND '$fim'";
                //
            } elseif ($enviado == "NÃO") {
                $enviado_II = "`enviado` LIKE 'NÃO' AND";
                //
            } else {
                $enviado_II = "";
            }
            $remunerado = filter_input(INPUT_POST, 'inputRemunerado', FILTER_DEFAULT);
            //
            $encerrado = filter_input(INPUT_POST, 'inputEncerrado', FILTER_DEFAULT);
            if ($encerrado == "SIM") {
                $encerrado = "<= '$hoje'";
            } elseif ($encerrado == "NÃO") {
                $encerrado = "> '$hoje'";
            } elseif ($encerrado == "") {
                $encerrado = "";
            }
///
            $Consultaf = mysqli_query($Conexao, "SELECT * FROM atestados_servidor WHERE  " . $enviado_II . " `remuneracao` LIKE '%" . $remunerado . "%' AND  `fim` $encerrado  AND `excluido` = 'N' $data_envio ");
            $rowf = mysqli_num_rows($Consultaf);

            if ($rowf > 0) {                

                while ($linhaf = mysqli_fetch_array($Consultaf)) {

                    $id = $linhaf['id'];
                    $nome = $linhaf['servidor'];
                    $substituto = $linhaf['substituto'];
                    $recebido = new DateTime($linhaf["recebido"]);
                    $recebido_convertida = date_format($recebido, 'd/m/Y');
                    $tipo = $linhaf["tipo"];
                    $tempo = $linhaf['tempo'];
                    $inicio = new DateTime($linhaf["inicio"]);
                    $inicio_convertida = date_format($inicio, 'd/m/Y');
                    $fim = new DateTime($linhaf['fim']);
                    $fim_convertida = date_format($fim, 'd/m/Y');
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
                    . "</div>"
                    . "</u>"
                    . "</td>";
                    echo "<td>" . $nome . "</td>\n";
                    echo "<td> " . $substituto . " </td>\n";
                    echo "<td>" . $tempo . "</td>\n";
                    echo "<td>" . $inicio_convertida . "</td>\n";
                    echo "<td>" . $fim_convertida . "</td>\n";
                    echo "<td>" . $remunerado . "</td>\n";
                    echo "<td>" . $enviado . "</td>\n";
                    echo "<td>" . $data_envio_convertida . "</td>\n";

                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</form>";
            } else {
                echo "Nada a Listar.";
                                   
            }
            ?>
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');
            });

            //Data Table
            var table = $('#example').DataTable({

                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],

                "lengthMenu": [[10, 15, 20, 25, 35, 70, 100, -1], [10, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": "Por Página _MENU_",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros",
                    "search": "Busca:",
                    "infoFiltered": "(filtrado de _MAX_ total de )",
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
                //Verifica se o elemento do formulário corresponde a um checkbox 
                if (frm.elements[i].type == "checkbox") {
                    //Verifica se o checkbox foi selecionado
                    if (frm.elements[i].checked) {
                        //alert("Exite ao menos um checkbox selecionado!");
                        return true;
                    }
                }
            }
            alert("Nenhum Servidor(a) foi selecionado!");
            return false;
        }
    </script> 
    <!Marcar ou Desmarcar todos os checkbox-->
    <script type="text/javascript">
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
</html>
