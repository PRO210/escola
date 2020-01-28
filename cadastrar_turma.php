<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
if (!empty(filter_input(INPUT_GET, 'id', FILTER_DEFAULT))) {
    //Recebe os valores de pesquisar turmas server (Método Get)
    $id_recebido = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    //echo "$id_recebido";
    $id = base64_decode($id_recebido);
    //echo "$id";
    $Consulta = mysqli_query($Conexao, "SELECT * FROM turmas WHERE id = '$id' ");
    $linha = mysqli_fetch_array($Consulta);
    $turma = $linha['turma'];
    //echo "$turma";
    $turno = $linha['turno'];
    $categoria = $linha['categoria'];
    $status = $linha['status'];
    $turma_extra = $linha['turma_extra'];
    $unico = $linha['unico'];
    $idade_turma = $linha['idade_turma'];
} else {
    $turma = "";
    $unico = "";
}
$ano = date('Y-m-d')
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>        
        <title>CRIANDO TURMAS</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <div class="container-fluid">
            <div class="row">
                <div class="starter-template">
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
                    <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <style>
                        tfoot input {
                            width: 100%;
                            padding: 3px;
                            box-sizing: border-box;
                        }
                    </style>
                    <h3 style="text-align: center">Criação de Turmas</h3>
                    <form name="cadastrar_turma" action="cadastrar_turma_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                        <div class="form-group">
                            <label for="inputTurma" class="col-sm-3 control-label">Nome da Turma</label>
                            <div class="col-sm-6">
                                <input type="text" name="inputTurma" id="inputTurma" value="<?php echo "$turma"; ?>"class="form-control" placeholder="DIGITE O NOME DA TURMA" onkeyup="maiuscula(this)" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCategoria" class="col-sm-3 control-label">Categoria</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="inputCategoria" id="inputCategoria" >
                                    <?php
                                    if (!empty(filter_input(INPUT_GET, 'id', FILTER_DEFAULT))) {
                                        $ConsultaT = mysqli_query($Conexao, "SELECT * FROM `categorias`");
                                        while ($RegistroT = mysqli_fetch_array($ConsultaT, MYSQLI_BOTH)) {
                                            $categoriaT = $RegistroT["categoria"];
                                            if ($categoria == "$categoriaT") {
                                                echo "<option selected>$categoriaT</option>";
                                            } else {
                                                echo "<option>$categoriaT</option>";
                                            }
                                        }
                                    } else {
                                        $ConsultaT = mysqli_query($Conexao, "SELECT * FROM `categorias`");
                                        while ($RegistroT = mysqli_fetch_array($ConsultaT, MYSQLI_BOTH)) {
                                            $categoriaT = $RegistroT["categoria"];
                                            echo "<option>$categoriaT</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row" >
                            <label for="" class="col-sm-2 control-label col-sm-offset-1" >Adicionar Como Extra</label> 
                            <div class="col-sm-6">
                                <select class="form-control" id="select_turma_extra" name="select_turma_extra" required="">
                                    <?php
                                    if (!empty(filter_input(INPUT_GET, 'id', FILTER_DEFAULT))) {
                                        //
                                        if ($turma_extra == "NÃO") {
                                            echo '<option value="NÃO" selected>NÃO</option>';
                                            echo '<option value="SIM">SIM</option>';
                                        } else {
                                            echo '<option value="NÃO">NÃO</option>';
                                            echo '<option value="SIM">SIM</option>';
                                        }
                                    } else {
                                        echo '<option value="NÃO">NÃO</option>';
                                        echo '<option value="SIM">SIM</option>';
                                    }
                                    ?>                                    
                                </select>
                            </div>      
                        </div><br>
                        <div class="form-group">
                            <label for="inputTurno" class="col-sm-3 control-label">Turno</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="inputTurno" id="inputTurno" >
                                    <?php
                                    if (!empty(filter_input(INPUT_GET, 'id', FILTER_DEFAULT))) {
                                        //
                                        $ConsultaTurno = mysqli_query($Conexao, "SELECT * FROM `turnos`");
                                        while ($RegistroTurno = mysqli_fetch_array($ConsultaTurno, MYSQLI_BOTH)) {
                                            $Turno = $RegistroTurno["turno"];
                                            //
                                            if ($turno == "$Turno") {
                                                echo "<option selected>$Turno</option>";
                                            } else {
                                                echo "<option>$Turno</option>";
                                            }
                                        }
                                    } else {
                                        $ConsultaTurno = mysqli_query($Conexao, "SELECT * FROM `turnos`");
                                        while ($RegistroTurno = mysqli_fetch_array($ConsultaTurno, MYSQLI_BOTH)) {
                                            $Turno = $RegistroTurno["turno"];
                                            echo "<option>$Turno</option>";
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="inputUnico" class="col-sm-3 control-label">Única</label>
                            <div class="col-sm-6">
                                <input type="text" name="inputUnico" id="inputUnico" value="<?php echo "$unico"; ?>" class="form-control" placeholder="Se for Única escreva Unica. Se não escreva: A , B ou etc." onkeyup="maiuscula(this)" required="">
                            </div>
                        </div> 
                        <div class="form-group">                           
                            <div class="cos-sm-6">
                                <label for="inputIdade" class="col-sm-3 control-label">IDADE MÍNIMA</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" id="" min="3" step="1" name="inputIdade" value="<?php echo "$idade_turma"; ?>" placeholder="QUAL A IDADE MÍNIMA PARA FREQUENTAR A TURMA">
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">                           
                            <div class="cos-sm-6">
                                <label for="inputAno" class="col-sm-3 control-label">ANO CORRENTE</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="" value="" name="inputAno" >
                                </div> 
                            </div>
                        </div>    
                        <div class="form-group ">
                            <div class="col-sm-offset-3 col-sm-2">
                                <button type="submit" value="cadastrar_turma" class="btn btn-success btn-block" name="cadastrar_turma" onclick= "return validaCheckbox()" >Cadastrar</button>                              
                            </div>
                            <div class="col-sm-offset-2 col-sm-2">                               
                                <button type="reset" class="btn btn-danger btn-block">Limpar</button>
                            </div>
                        </div>  
                        <div class="form-group"> 
                            <h4 style="text-align: center">PROFESSORES(A)</h4>
                            <div class="col-sm-6 col-sm-offset-3 ">
                                <?php
                                $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' OR `funcao` LIKE 'MONITOR'  ORDER BY nome");
                                $rowf = mysqli_num_rows($Consultaf);

                                if ($rowf > 0) {

                                    echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    // echo "<th> ID </th>";
                                    echo "<th>"
                                    . "<div class='dropdown'>"
                                    . "<input type='checkbox' name='servidor_selecionado[]' class = 'selecionar'/>"
                                    . "</th>";
                                    echo "<th> NOME </th>";
                                    echo "<th> FUNÇÂO </th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tfoot>";
                                    echo "<tr>";
                                    echo "<th>  </th>";
                                    echo "<th> NOME </th>";
                                    echo "<th> FUNÇÃO </th>";
                                    echo "</tr>";
                                    echo "</tfoot>";
                                    echo "<tbody>";

                                    while ($Registro = mysqli_fetch_array($Consultaf)) {

                                        $id = $Registro["id"];
                                        $nome = $Registro["nome"];
                                        $funcao = $Registro["funcao"];

                                        echo "<tr>";
                                        echo "<td>"
                                        . "<div class='dropdown'>"
                                        . "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id'>"
                                        . "</td>";

                                        echo "<td>" . $nome . "</td>\n";
                                        echo "<td>" . $funcao . "</td>\n";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "Nada enconrado.";
                                }
                                ?>
                            </div>
                        </div>                                  
                    </form>                
                </div>
            </div>
        </div>
        <script language="javascript">
            function validaCheckbox() {
                var frm = document.cadastrar_turma;
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
                return true;
            }
        </script>
        <script type="text/javascript">
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
        </script>      
        <script type="text/javascript">
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
                        "lengthMenu": "Alunos por Página _MENU_ ",
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
        <script type="text/javascript">
            $('input').on("input", function (e) {
                $(this).val($(this).val().replace('"', ""));
                $(this).val($(this).val().replace("'", ""));
                $(this).val($(this).val().replace(".", ""));
                $(this).val($(this).val().replace("º", ""));
                $(this).val($(this).val().replace("°", ""));
            });
        </script>
    </body> 
</html>
