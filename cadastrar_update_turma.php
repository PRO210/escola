<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
session_start();
if (empty($_SESSION['acerto'])) {
    
} elseif ($_SESSION['acerto'] == 'S') {
    echo "<script type='text/javascript'>
    alert('Alteração Realizada com Sucesso!');
    </script>";
    session_destroy();
} elseif ($_SESSION['acerto'] == 'N') {
    echo "<script type='text/javascript'>
    alert('Falha na operação');
    </script>";
    session_destroy();
}
//
if (isset($_POST['exclui_varias_turmas'])) {
    //
    include_once 'exclui_varias_turmas.php';
    //
} elseif (isset($_POST['manha'])) {
    ob_start();
    $txt_option = "manha";
    include_once 'pesquisar_no_banco_impressao_turmas.php';
    ob_flush();
    exit();
} elseif (isset($_POST['tarde'])) {
    ob_start();
    $txt_option = "tarde";
    include_once 'pesquisar_no_banco_impressao_turmas.php';
    ob_flush();
    exit();
} elseif (isset($_POST['noite'])) {
    ob_start();
    $txt_option = "noite";
    include_once 'pesquisar_no_banco_impressao_turmas.php';
    ob_flush();
    exit();
} elseif (isset($_POST['todos_turnos'])) {
    ob_start();
    $txt_option = "todos_turnos";   
    include_once 'pesquisar_no_banco_impressao_turmas.php';
    ob_flush();
    exit();
} elseif (isset($_POST['copiar'])) {
    ob_start();
    $ano = filter_input(INPUT_POST, 'inputAnos', FILTER_DEFAULT);
    include_once 'cadastrar_copia_turma_server.php';
    exit();
} elseif (isset($_POST['listar'])) {
    ob_start();
    include_once 'listar_copia_turma_server.php';
    ob_flush();
    exit();
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>        
        <link href="css/cadastrar.css" rel="stylesheet" type="text/css"/>
        <title>cadastro de Atualizações da Turma</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <?php
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
        $ano = $linha['ano'];
        $idade_turma = $linha['idade_turma'];
        ?>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <div class="container">
            <div class="starter-template">
                <h3 style="text-align: center">Atualizações da Turma</h3>
                <form name="cadastrar" action="cadastrar_update_turma_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                    <div class="form-group">
                        <label for="inputTurma" class="col-sm-3 control-label">Nome da Turma</label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="DIGITE O NOME DA TURMA" class="form-control" id="inputTurma" name="inputTurma"  onkeyup="maiuscula(this)" value='<?php echo "$turma" ?>'>
                        </div>
                    </div>                
                    <div class="form-group">
                        <label for="inputCategoria" class="col-sm-3 control-label">Categoria</label>
                        <div class="col-sm-6">
                            <select class="form-control " name="inputCategoria" id="inputCategoria" >
                                <?php
                                $ConsultaCategoria = mysqli_query($Conexao, "SELECT * FROM `categorias`");
                                while ($RegistroCategoria = mysqli_fetch_array($ConsultaCategoria, MYSQLI_BOTH)) {
                                    $categoria_categoria = $RegistroCategoria["categoria"];

                                    if ($categoria == "$categoria_categoria") {
                                        echo "<option selected>$categoria_categoria</option>";
                                    } else {
                                        echo "<option>$categoria_categoria</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" >
                        <label for="" class="col-sm-2 control-label col-sm-offset-1" >Adcionar Como Extra</label> 
                        <div class="col-sm-6">
                            <select class="form-control" id="select_turma_extra" name="select_turma_extra">
                                <?php
                                if ($turma_extra == "SIM") {
                                    echo "<option selected>SIM</option>";
                                    echo "<option>NÃO</option>";
                                } else {
                                    echo "<option selected>NÃO</option>";
                                    echo "<option>SIM</option>";
                                }
                                ?>

                            </select>
                        </div>      
                    </div><br>
                    <div class="form-group">
                        <label for="inputTurno" class="col-sm-3 control-label">Turno</label>
                        <div class="col-sm-6">
                            <select class="form-control " name="inputTurno" id="inputCategoria" >
                                <?php
                                $ConsultaTurno = mysqli_query($Conexao, "SELECT * FROM `turnos`");

                                while ($RegistroTurno = mysqli_fetch_array($ConsultaTurno, MYSQLI_BOTH)) {
                                    $Turno = $RegistroTurno["turno"];
                                    if ($turno == "$Turno") {
                                        echo "<option selected>$turno</option>";
                                    } else {
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
                            <input type="text" placeholder="DIGITE A PALAVRA ÚNICA OU A LETRA REFERENTE À TURMA" class="form-control" id="inputUnica" name="inputUnico"  onkeyup="maiuscula(this)" value='<?php echo "$unico" ?>'>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-6">
                            <select class="form-control " name="inputStatus" id="inputStatus" >
                                <?php
                                $Consultastatus = mysqli_query($Conexao, "SELECT * FROM `status`");
                                while ($Registrostatus = mysqli_fetch_array($Consultastatus, MYSQLI_BOTH)) {
                                    $status2 = $Registrostatus["status_turmas"];

                                    if ($status == "$status2") {
                                        echo "<option selected>$status</option>";
                                    } else {
                                        echo "<option>$status2</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">                           
                        <div class="cos-sm-6">
                            <label for="inputAno" class="col-sm-3 control-label">ANO</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="" name="inputAno" value="<?php echo "$ano"; ?>">
                            </div> 
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
                        <h4 style="text-align: center">PROFESSORES(A) ATUAIS</h4>
                        <div class="col-sm-6 col-sm-offset-3 ">
                            <table class="table table-striped table-bordered" id="tbl_alunos_lista">
                                <tbody>
                                    <?php
                                    $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `turmas_professor2` WHERE `id_turma` = '$id' ");
                                    $LinhasConsulta2 = mysqli_num_rows($Consulta2); //
                                    $id_turma = "$id";
                                    $IdsProfessores = "";
                                    if ($LinhasConsulta2 > 0) {
                                        while ($row2 = mysqli_fetch_array($Consulta2)) {
                                            $id_professor = $row2['id_professor'];
                                            $IdsProfessores .= $id_professor . ",";
                                            // echo "$id_professor<br>";
                                            $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `id` = " . $id_professor . " ORDER BY nome");
                                            $Registro = mysqli_fetch_array($Consultaf);
                                            $nome = $Registro["nome"];
                                            $id_professor = $Registro["id"];

                                            echo "<tr>";
                                            echo "<td>"
                                            . "<div class='dropdown'>"
                                            . "<input type='checkbox' name='servidor_selecionado[]' class = '' value='$id_professor' checked >"
                                            . "</td>";
                                            echo "<td>" . $nome . "</td>\n";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td>"
                                        . "<div class='dropdown'>"
                                        . "<input type='checkbox' name='servidor_selecionado[]' class = '' value='' checked  disabled>"
                                        . "</td>";
                                        echo "<td>A Turma Não tem Nenhum Professor Cadastrado Ainda.</td>\n";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            $IdsProfessores = substr($IdsProfessores, 0, -1);
                            if ($IdsProfessores == "") {
                                $IdsProfessores = "''";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            <button type="submit" value="cadastrar_turma" name="cadastrar_turma" class="btn btn-success btn-block" onclick=" return confirmarAtualização()">Atualizar</button>
                        </div>
                        <div class="col-sm-3">
                            <a href="pesquisar_turmas_server.php" target="_self"> <button type="button" value="" name="" class="btn btn-primary btn-block" >Mostrar Todas As Turmas</button></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4 style="text-align: center">DEMAIS PROFESSORES(A)</h4>
                        <div class="col-sm-6 col-sm-offset-3 ">
                            <?php
                            $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE (`funcao` LIKE 'professor(a)%' OR `funcao` LIKE 'MONITOR') AND `id` NOT IN ($IdsProfessores) AND `excluido` = 'N' ORDER BY nome");
                            $rowf = mysqli_num_rows($Consultaf);

                            if ($rowf > 0) {

                                echo "<table class='table table-striped table-bordered' id='tbl_professores'>";
                                echo "<thead>";
                                echo "<tr>";
                                // echo "<th> ID </th>";
                                echo "<th>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='servidor_selecionado[]' class='selecionar'  />"
                                . "</th>";
                                echo "<th> NOME </th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while ($Registro = mysqli_fetch_array($Consultaf)) {

                                    $id = $Registro["id"];
                                    $nome = $Registro["nome"];
                                    ////
                                    $Consulta3 = mysqli_query($Conexao, "SELECT * FROM `turmas_professor2` WHERE `id_turma` = '$id_turma' ");

                                    while ($Registro3 = mysqli_fetch_array($Consulta3)) {
                                        $id_professor3 = $Registro3["id_professor"];
                                    }
                                    echo "<tr>";
                                    echo "<td>"
                                    . "<div class='dropdown'>"
                                    . "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id'>"
                                    . "</td>";
                                    echo "<td>" . $nome . "</td>\n";
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
                    <div class="form-group">
                        <label  for="inputId" class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                            <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id = base64_decode($id_recebido); ?> " >
                        </div>
                    </div>                       
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function confirmarAtualização() {
                var r = confirm("Realmente deseja Atualizar essa Turma?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>  
        <script type="text/javascript">
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
        </script>
        <script>
            $(document).ready(function () {
                $('#tbl_professores').DataTable({
                    "lengthMenu": [[5, 10, 15, 20, 25, 30, 40, 50, 70, 100, -1], [5, 10, 15, 20, 25, 30, 40, 50, 70, 100, "All"]],
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
    </body>
</html>
