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
        <link href="css/cadastrar.css" rel="stylesheet" type="text/css"/>
        <title>Página para cadastro de Atualizações da Turma</title>
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
        // echo "$id";
        $Consulta = mysqli_query($Conexao, "SELECT * FROM turmas WHERE id = '$id' ");
        $linha = mysqli_fetch_array($Consulta);
        $turma = $linha['turma'];
        //echo "$turma<br>";
        $turno = $linha['turno'];
        //echo "$turno<br>";
        $categoria = $linha['categoria'];
        //echo "$categoria<br>";
        $status = $linha['status'];
        //echo "$status";
        // exit();


        $Consulta1 = mysqli_query($Conexao, "SELECT `$turma ($turno)` FROM `turmas_professor` WHERE `id` = '1' ");
        $LinhaConsulta1 = mysqli_fetch_array($Consulta1);
        $P1 = $LinhaConsulta1["$turma ($turno)"];
        //echo "$P1";
        $Consulta2 = mysqli_query($Conexao, "SELECT `$turma ($turno)` FROM `turmas_professor` WHERE `id` = '2' ");
        $LinhaConsulta2 = mysqli_fetch_array($Consulta2);
        $P2 = $LinhaConsulta2["$turma ($turno)"];
        //echo "$P2";
        $Consulta3 = mysqli_query($Conexao, "SELECT `$turma ($turno)` FROM `turmas_professor` WHERE `id` = '3' ");
        $LinhaConsulta3 = mysqli_fetch_array($Consulta3);
        $P3 = $LinhaConsulta3["$turma ($turno)"];
        //echo "$P3";
        ?>
        <div class="row">
            <div class="container">
                <div class="starter-template">
                    <h3 style="text-align: center">Cadastro de Atualizações da Turma</h3>
                    <form name="cadastrar" action="cadastrar_update_turma_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                        <div class="form-group">
                            <label for="inputTurma" class="col-sm-3 control-label">Nome da Turma</label>
                            <div class="col-sm-6">
                                <input type="text" placeholder="DIGITE O NOME DA TURMA" class="form-control" id="inputTurma" name="inputTurma" onkeyup="maiuscula(this)" value="<?php echo "$turma"; ?>">
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
                                            echo "<option selected> $categoria </option>";
                                        } else {
                                            echo "<option> $categoria_categoria </option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
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
                            <label for="inputTurma" class="col-sm-3 control-label">Professor Atual</label>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="" name="" value="<?php echo "$P1"; ?>">
                            </div>
                        </div>   
                        <div class="form-group">  
                            <label for="P1" class="col-sm-3 control-label">Novo Professor(a)</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="P1" id="P1" >
                                    <?php
                                    $ConsultaProfessor = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' ORDER BY nome");
                                    echo "<option value = '----------'>ESCOLHA O NOVO PROFESSOR</option>";
                                    echo "<option>----------</option>";
                                    while ($RegistroProfessor = mysqli_fetch_array($ConsultaProfessor, MYSQLI_BOTH)) {
                                        $servidor = $RegistroProfessor['nome'];
                                        if ($P1 == "$servidor") {
                                            echo "<option selected>$servidor</option>";
                                        } else {
                                            echo "<option>$servidor</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="P2" class="col-sm-3 control-label">Professor Atual</label>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="" name="" value="<?php echo "$P2"; ?>">
                            </div>
                        </div>   
                        <div class="form-group">  
                            <label for="P2" class="col-sm-3 control-label">Novo Professor(a)</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="P2" id="P2" >
                                    <?php
                                    $ConsultaProfessor2 = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' ORDER BY nome");
                                    echo "<option value = '----------'>ESCOLHA O NOVO PROFESSOR</option>";
                                    echo "<option>----------</option>";
                                    while ($RegistroProfessor2 = mysqli_fetch_array($ConsultaProfessor2, MYSQLI_BOTH)) {
                                        $servidor2 = $RegistroProfessor2['nome'];
                                        if ($P2 == "$servidor2") {
                                            echo "<option selected>$servidor2</option>";
                                        } else {
                                            echo "<option>$servidor2</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                          
                        <div class="form-group">
                            <label for="P3" class="col-sm-3 control-label">Professor Atual</label>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="P3" name="P3" value="<?php echo "$P3"; ?>">
                            </div>
                        </div>   
                        <div class="form-group">  
                            <label for="P3" class="col-sm-3 control-label">Novo Professor(a)</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="P3" id="P3">
                                    <?php
                                    $ConsultaProfessor3 = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' ORDER BY nome");
                                    echo "<option value = '----------'>ESCOLHA O NOVO PROFESSOR</option>";
                                    echo "<option>----------</option>";
                                    while ($RegistroProfessor3 = mysqli_fetch_array($ConsultaProfessor3, MYSQLI_BOTH)) {
                                        $servidor3 = $RegistroProfessor3['nome'];
                                        if ($P3 == "$servidor3") {
                                            echo "<option selected>$servidor3</option>";
                                        } else {
                                            echo "<option>$servidor3</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                  
                        <div class="form-group">
                            <label  for="inputId" class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" value="cadastrar_turma" name="cadastrar_turma" class="btn btn-success" onclick=" return confirmarAtualização()">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
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
    </body>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#turmas').hide();
            $('#turmas2').hide();
            $('#inputFuncao').change(function () {

                if ($('#inputFuncao').val() == '') {

                } else if ($('#inputFuncao').val() == '2') {
                    $('#turmas').show();
                    $('#turmas2').show();
                    $('#turno').hide();
                } else if ($('#inputFuncao').val() == '3') {
                    $('#turmas').show();
                    $('#turmas2').show();
                    $('#turno').hide();
                } else {
                    $('#turmas').hide();
                    $('#turmas2').hide();
                    $('#turno').show();
                }
            });
        });
    </script>  
</html>
