<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
if (isset($_POST['imprimir'])) {
    include_once './pesquisar_no_banco_impressao_servidores.php';
    //
} elseif (isset($_POST['imprimir_gerencial'])) {
    include_once './pesquisar_no_banco_impressao_servidores_gerencial.php';
    //
} elseif (isset($_POST['imprimir_gerencial_texto'])) {
    include_once './pesquisar_no_banco_impressao_servidores_gerencial_texto.php';
    exit();
} elseif (isset($_POST['imprimir_pdf'])) {
    include_once './pesquisar_no_banco_impressao_servidores_pdf.php';
    exit();
} elseif (isset($_POST['imprimir_funcao'])) {
    include_once './pesquisar_no_banco_impressao_servidores_funcao.php';
    exit();
} else {
    include_once './pesquisar_no_banco_impressao_servidores_gerencial_pdf.php';
    exit();
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title></title>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/atualizar_varios.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <h1 style=" text-align: center;">Atualizar Vários Cadastros ao mesmo Tempo</h1>
        <div class="container">
            <div class="starter-template">
                <p>
                    <button id="btnMostrarEsconderBtnVinculo" class="btn btn-primary" >Vínculo</button>
                    <button id="btnMostrarEsconderFuncao" class="btn btn-danger" >Funções</button>
                    <button id="btnMostrarEsconderBtnTurno" class="btn btn-warning" >Turno</button>
                </p>
                <form name="cadastrar" action="atualizar_varios_servidor_server.php" method="post" class="form-horizontal" >
                    <!--Div Vinculo-->
                    <div id="divConteudoBtnVinculo" style="background-color: #286090; "><br>
                        <div class="form-group">
                            <label for="inputVinculo" class="col-sm-3 control-label">Vínculo</label>
                            <div class="col-sm-6" >
                                <select class="form-control" name="inputVinculo" id="inputVinculo">
                                    <?php
                                    $ConsultaVinculo = mysqli_query($Conexao, "SELECT * FROM `vinculos` ORDER BY vinculo");
                                    while ($RegistroVinculo = mysqli_fetch_array($ConsultaVinculo, MYSQLI_BOTH)) {
                                        $vinculo = $RegistroVinculo["vinculo"];
                                        echo "<option>$vinculo</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                                      
                        <div class="form-group" >
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="atualizar_Vinculo" value="atualizar_Vinculo" class="btn btn-success" onclick='return confirmarAtualizacao()' >Incluir Todos</button>
                            </div>
                        </div><br>
                    </div>
                    <!-- Div Funções-->
                    <div id="divConteudoFuncao">
                        <div id="" style="background-color: #C9302C; " ><br>
                            <div class="form-group">
                                <label for="inputFuncao" class="col-sm-3 control-label">Função</label>
                                <div class="col-sm-6" >
                                    <select class="form-control" name="inputFuncao" id="inputFuncao" required="">
                                        <?php
                                        echo "<option disabled selected>ESCOLHA UMA FUNÇÃO AQUI:)</option>";
                                        $Consultafuncao = mysqli_query($Conexao, "SELECT * FROM `funcoes` ORDER BY funcao");
                                        while ($Registrofuncao = mysqli_fetch_array($Consultafuncao, MYSQLI_BOTH)) {
                                            $funcao = $Registrofuncao["funcao"];
                                            echo "<option>$funcao</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>   
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Resumo das Funções</label>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="" class="form-control"  name= "inputResumoFuncao" >
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class= "col-sm-offset-3 col-sm-9" >
                                    <button type="submit"  name="atualizar_Funcao" value="atualizar_Funcao"class="btn btn-success" onclick='return confirmarAtualizacao()'>Incluir Todos</button>
                                </div>
                            </div><br>
                        </div>
                    </div>
                    <!-- Div Turno-->
                    <div id="divConteudoTurno">
                        <div id="" style="background-color: #cc7700; " ><br>
                            <div class="form-group">
                                <label for="inputTurno" class="col-sm-3 control-label">Turno</label>
                                <div class="col-sm-6" >
                                    <select class="form-control" name="inputTurno" id="inputTurno">
                                        <?php
                                        $ConsultaTurno = mysqli_query($Conexao, "SELECT * FROM `turnos` ORDER BY turno");
                                        while ($RegistroTurno = mysqli_fetch_array($ConsultaTurno, MYSQLI_BOTH)) {
                                            $turno = $RegistroTurno["turno"];
                                            echo "<option>$turno</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>                          
                            <div class="form-group" >
                                <div class= "col-sm-offset-3 col-sm-6" >
                                    <button type="submit"  name="atualizar_Turno" value="atualizar_Turno" class="btn btn-success btn-block" onclick='return confirmarAtualizacao()'>Incluir Todos</button>
                                </div>
                            </div><br>
                        </div>
                    </div>

                    <?php
                    echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                    echo "<thead>";
                    echo "<tr>";
//echo "<th> ID </th>";
                    echo "<th> SELEÇÃO</th>";
                    echo "<th> NOME </th>";
                    echo "<th> VINCULO </th>";
                    echo "<th> FUNÇÃO </th>";
//echo "<th> TURMA </th>";
                    echo "<th> TURNO </th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach (($_POST['servidor_selecionado']) as $buscar_id) {
                        $Consultaf = mysqli_query($Conexao, "SELECT * FROM servidores WHERE id = '$buscar_id' AND excluido = 'N' ORDER BY nome");
                        $rowf = mysqli_num_rows($Consultaf);

                        if ($rowf > 0) {

                            while ($linhaf = mysqli_fetch_array($Consultaf)) {
                                $nome = $linhaf['nome'];
                                $vinculo = $linhaf['vinculo'];
                                $funcao = $linhaf['funcao'];
                                // $turma = $linhaf['turma'];
                                $id = $linhaf['id'];
                                $turno = $linhaf['turno'];
                                echo "<tr>";
                                //  echo "<td>" . $id . "</td>\n";
                                echo "<td><input type='checkbox' name='servidor_selecionado[]' class='checkbox' value='$id' checked ></td>\n";
                                echo "<td>" . $nome . "</td>\n";
                                echo "<td>" . $vinculo . "</td>\n";
                                echo "<td>" . $funcao . "</td>\n";
                                // echo "<td>" . $turma . "</td>\n";
                                echo "<td>" . $turno . "</td>\n";
                                echo "</tr>";
                            }
                        }
                    }
                    echo "</tbody>";
                    echo "</table>";
                    ?>          
                </form>
            </div>
        </div>       
        <!-- Div Turno-->
        <script type = "text/javascript">
            $(document).ready(function () {
                $("#divConteudoTurno").hide();
                $("#btnMostrarEsconderBtnTurno").click(function () {
                    $("#divConteudoTurno").toggle(2500);
                });
            });
        </script>

        <!--Div Função-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoFuncao").hide();
                $("#btnMostrarEsconderFuncao").click(function () {
                    $("#divConteudoFuncao").toggle(2500);
                });
            });
        </script>

        <!--Div Vínculo-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoBtnVinculo").hide();
                $("#btnMostrarEsconderBtnVinculo").click(function () {
                    $("#divConteudoBtnVinculo").toggle(2500);
                });
            });
        </script>
    </body> 

</html>

