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
        <title>Criação de Turmas</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <div class="row">
            <div class="container">
                <div class="starter-template">
                    <h3 style="text-align: center">Criação de Turmas</h3>
                    <form name="cadastrar_turma" action="cadastrar_turma_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                        <div class="form-group">
                            <label for="inputTurma" class="col-sm-3 control-label">Nome da Turma</label>
                            <div class="col-sm-6">
                                <input type="text" name="inputTurma" id="inputTurma" class="form-control" placeholder="DIGITE O NOME DA TURMA" onkeyup="maiuscula(this)" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCategoria" class="col-sm-3 control-label">Categoria</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="inputCategoria" id="inputCategoria" >
                                    <?php
                                    $ConsultaT = mysqli_query($Conexao, "SELECT * FROM `categorias`");
                                    while ($RegistroT = mysqli_fetch_array($ConsultaT, MYSQLI_BOTH)) {
                                        $categoriaT = $RegistroT["categoria"];
                                        echo "<option>$categoriaT</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTurno" class="col-sm-3 control-label">Turno</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="inputTurno" id="inputTurno" >
                                    <?php
                                    $ConsultaTurno = mysqli_query($Conexao, "SELECT * FROM `turnos`");
                                    while ($RegistroTurno = mysqli_fetch_array($ConsultaTurno, MYSQLI_BOTH)) {
                                        $Turno = $RegistroTurno["turno"];
                                        echo "<option>$Turno</option>";
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">  
                            <label for="P1" class="col-sm-3 control-label">Professor(a)</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="P1" id="P1" >
                                    <?php
                                    $ConsultaProfessor = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' ORDER BY nome");
                                    echo "<option value = '----------'>ESCOLHA O NOVO PROFESSOR</option>";
                                    echo "<option>----------</option>";
                                    while ($RegistroProfessor = mysqli_fetch_array($ConsultaProfessor, MYSQLI_BOTH)) {
                                        $servidor = $RegistroProfessor['nome'];
                                        $servidor = $RegistroProfessor['nome'];
                                        echo "<option>$servidor</option>";
                                    }
                                    ?>
                                    "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id'>"

                                </select>
                            </div>
                        </div>  
                        <div class="form-group">  
                            <label for="P2" class="col-sm-3 control-label">Professor(a)</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="P2" id="P2" >
                                    <?php
                                    $ConsultaProfessor = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' ORDER BY nome");
                                    echo "<option value = '----------'>ESCOLHA O NOVO PROFESSOR</option>";
                                    echo "<option>----------</option>";
                                    while ($RegistroProfessor = mysqli_fetch_array($ConsultaProfessor, MYSQLI_BOTH)) {
                                        $servidor = $RegistroProfessor['nome'];
                                        echo "<option>$servidor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">  
                            <label for="P3" class="col-sm-3 control-label">Professor(a)</label>
                            <div class="col-sm-6">
                                <select class="form-control " name="P3" id="P3" >
                                    <?php
                                    $ConsultaProfessor = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' ORDER BY nome");
                                    echo "<option value = '----------'>ESCOLHA O NOVO PROFESSOR</option>";
                                    echo "<option>----------</option>";
                                    while ($RegistroProfessor = mysqli_fetch_array($ConsultaProfessor, MYSQLI_BOTH)) {
                                        $servidor = $RegistroProfessor['nome'];
                                        echo "<option>$servidor</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" value="cadastrar_turma" class="btn btn-success" name="cadastrar_turma" >Cadastrar</button>
                                <button type="reset" class="btn btn-danger">Limpar</button>
                            </div>
                        </div>              
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function confirmarAtualizacao() {
                var r = confirm("Realmente deseja atualizar todos?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <script type="text/javascript">
            function validar() {
                if (document.cadastrar_turma.inputTurma.value == "" || document.cadastrar_turma.inputTurma.value.length < 3)
                {
                    alert("O campo Nome não pode está vazio ou ter menos de 3 Caracteres");
                    document.cadastrar_turma.inputTurma.focus();
                    return false;
                }

            }
        </script>
        <script type="text/javascript">
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
        </script>

    </body>
</html>
