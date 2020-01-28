<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RELATÓRIOS ALUNOS</title>
        <style>
            th{
                text-align: center !important;
            }
        </style>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <div class="container-fluid">
            <script src="js/bootstrap.js" type="text/javascript"></script>
            <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
            <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="js/montar_relatorio.js" type="text/javascript"></script>          
            <h1 style="text-align: center">Montar Relatório</h1>
            <form name="form1" class="form-horizontal" method="post" action= "montar_relatorio_server.php"> 
                <div class ="row">
                    <div class="col-sm-3">
                        <?php
                        echo "<table class='table table-striped table-bordered' id=''>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th><input type = 'checkbox' class = 'selecionar_status'>&nbsp;&nbsp;STATUS</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `status_alunos` WHERE `relatorio` = 'S' ORDER BY status_aluno");
                        //                        
                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                            echo "<tr>";
                            $id_status = $Registro["id"];
                            $status_aluno = $Registro["status_aluno"];
                            echo "<td id = 'teste'>&nbsp;&nbsp&nbsp;&nbsp<input type='checkbox' name='status_selecionado[]' id = 'status_selecionado' class = 'checkbox_status' value = '$id_status'/>&nbsp;&nbsp;$status_aluno</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        ?>
                    </div> 
                    <div class="col-sm-3">                       
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>BOLSA FAMÍLIA</th></tr>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="inputBolsaFamilia" value="TODOS" checked="">INDEPENDENTE DO BOLSA FAMÍLIA</td>
                                </tr>
                                <tr>                                   
                                    <td><input type="radio" name="inputBolsaFamilia" value="SIM">ALUNOS QUE RECEBEM O BENEFÍCIO</td>
                                </tr>
                                <tr>                                    
                                    <td><input type="radio" name="inputBolsaFamilia" value="NÃO">ALUNOS QUE NÃO RECEBEM O BENEFÍCIO</td>
                                </tr>
                            </tbody>
                        </table>          
                    </div> 
                    <div class="col-sm-3">
                        <table class=" table table-striped table-bordered">
                            <thead>
                                <tr><th>IDADE</th></tr>                                
                            </thead>
                            <tbody>                                  
                                <tr>
                                    <td><input type="text" placeholder="IDADE INICIAL EM NÚMEROS" class="form-control" name="inputIdadeInicial"  maxlength="2" pattern="[0-9]+$" ></td>
                                </tr>
                                <tr>
                                    <td style=" text-align: center">ENTRE</td>
                                </tr>
                                <tr>                                   
                                    <td><input type="text" placeholder="IDADE FINAL EM NÚMEROS" class="form-control" name="inputIdadeFinal"  maxlength="2" pattern="[0-9]+$" ></td>
                                </tr>

                            </tbody>
                        </table>   
                    </div>      
                    <div class="col-sm-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>SEXO</th></tr>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type = 'radio' name='sexo_selecionado' value = '' checked>&nbsp;TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='sexo_selecionado' value = 'F'>&nbsp;FEMININO</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='sexo_selecionado'  value = 'M'/>&nbsp;MASCULINO</td>
                                </tr>
                            </tbody>
                        </table>   
                    </div> 
                </div>
                <div class ="row">
                    <div class="col-sm-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>ALUNOS COM NECESSIDADES <br> ESPECIAIS</th></tr>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type = 'radio' name='necessidades_selecionado' value = '' checked>&nbsp;TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='necessidades_selecionado' value = 'SIM'>&nbsp;SIM</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='necessidades_selecionado'  value = 'NÃO'/>&nbsp;NÃO</td>
                                </tr>
                            </tbody>
                        </table>                         
                    </div>
                    <div class="col-sm-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>ALUNOS ADMITIDOS COMO <br>OUVINTES</th></tr>                                
                            </thead>
                            <tbody>  
                                <tr>                                   
                                    <td><input type = 'radio' name='inputOuvinte' value = '' >TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='inputOuvinte' value = 'SIM'>&nbsp;SIM</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='inputOuvinte'  value = 'NAO'/>&nbsp;NÃO</td>
                                </tr>
                            </tbody>
                        </table>                         
                    </div> 
                    <div class="col-sm-3 ">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>TRANSPORTE</th></tr>                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type = 'radio' name='transporte_selecionado' value = '' checked>&nbsp;TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='transporte_selecionado' value = 'SIM'>&nbsp;SIM</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='transporte_selecionado'  value = 'NÃO'/>&nbsp;NÃO</td>
                                </tr>
                            </tbody>
                        </table>   
                    </div>
                    <div class="col-sm-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr><th>URBANO</th></tr>                                
                            </thead>
                            <tbody>  
                                <tr>                                   
                                    <td><input type = 'radio' name='inputUrbano' value = '' >TODOS</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='inputUrbano' value = 'SIM'>&nbsp;SIM</td>
                                </tr>
                                <tr>                                   
                                    <td><input type = 'radio' name='inputUrbano'  value = 'NAO'/>&nbsp;NÃO</td>
                                </tr>
                            </tbody>
                        </table>                         
                    </div> 
                </div>                                   
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-4" style=" margin-bottom: 12px; ">                    
                        <button type="submit" value="inputNome" class="btn btn-success btn-block" id="inputNome" onclick="return validaCheckbox()">Gerar Relatório</button>  
                    </div>
                    <div class="col-sm-4" >                        
                        <button type="reset" class="btn btn-danger btn-block">Limpar os Campos</button>
                    </div>
                </div>   
                <div class="row">
                    <div class = "col-sm-12">
                        <?php
                        $ano_atual = date('Y');
                        //                     
                        echo "<table class='table table-striped table-bordered'id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th><input type = 'checkbox' class = 'selecionarM'>&nbsp;&nbsp;TURMAS </th>";
                        echo"<th>TURNO</th>";
                        echo"<th>CATEGORIA</th>";
                        echo"<th>ANO</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tfoot>";
                        echo "<tr>";
                        echo"<th>TURMAS</th>";
                        echo"<th>TURNO</th>";
                        echo"<th>CATEGORIA</th>";
                        echo"<th>ANO</th>";
                        echo "</tfoot>";
                        echo "</tr>";
                        echo "<tbody>";
                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `status` = 'OCUPADA' ORDER BY `turmas`.`ano` DESC, `turmas`.`turma` ASC");
                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                            echo "</tr>";
                            $id_manha = $Registro["id"];
                            $turma = $Registro["turma"];                         
                            //$ano = date_format(new DateTime($Registro["ano"]), 'Y');
                            $ano_turma = substr($Registro["ano"], 0, -6);

                            if ($ano_turma == "2018") {
                                $unico_turma = "";
                            } else {
                                $unico_turma = $Registro["unico"];
                            }
                            $ano = date('Y');
                            $ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
                            $ano_futuro = date('Y', strtotime('+362 days', strtotime($ano)));
                            //
                            echo "<td><input type = 'checkbox' class = 'checkboxM' name = 'turma[]' value = '$id_manha'>&nbsp;&nbsp;$turma $unico_turma</td>";
                            echo "<td>" . $Registro["turno"] . "</td>";
                            echo "<td>" . $Registro["categoria"] . "</td>";
                            //
                            if ($ano_turma == "$ano_futuro") {
                                echo "<td>" . $ano_futuro . ' - Ano  Futuro' . "</td>";
                            } elseif ($ano_turma == "$ano") {
                                echo "<td>" . $ano . ' - Ano Presente' . "</td>";
                            } else {
                                echo "<td>" . $ano_passado . ' - Ano Passado' . "</td>";
                            }
                        }
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";
                        ?>                   
                    </div>
                </div>
            </form>          
            <script>
                $(document).ready(function () {
                    // Setup - add a text input to each footer cell
                    $('#tbl_alunos_lista tfoot th').each(function () {
                        var title = $(this).text();
                        $(this).html('<input type="text" placeholder="' + title + '" />');
                    });
                    // Data Table
                    var table = $('#tbl_alunos_lista').DataTable({
                        //Desativa a ordenação
                        "ordering": false,
                        //DEsativa a ordenação por coluna especifíca
                        "columnDefs": [{
                                "targets": [0],
                                "orderable": false
                            }],
                        "lengthMenu": [[7, 10, 20, 30, 40, 50, 70, 100, -1], [7, 10, 20, 30, 40, 50, 70, 100, "All"]],
                        "language": {
                            "lengthMenu": " _MENU_ ",
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
//                        "aria": {
//                           // "sortAscending": ": ative a ordenação cressente",
//                           // "sortDescending": ": ative a ordenação decressente"
//                        }

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
        </div>               
    </body>
</html>
