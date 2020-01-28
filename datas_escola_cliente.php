<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html>
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
        <h3 style=" text-align: center;">Alterar as Datas</h3>
        <div class="container">
            <div class="starter-template">
                <p>
                    <button id="btnMostrarEsconderBtnCenso" class="btn btn-warning" >Data Censo</button>
                    <button id="btnMostrarEsconderBtnMatricula" class="btn btn-primary" >Data Miníma para Matricula</button>

                </p>
                <form name="cadastrar" action="datas_escola_server.php" method="post" class="form-horizontal" >
                    <!-- Div Censo-->
                    <div id="divConteudoBtnCenso" style="background-color: #cc7700; "  >
                        <div class="form-group"><br>
                            <label for="inputCenso"  class="col-sm-3 control-label">Data do Censo</label>
                            <div class="col-sm-2" >
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputCenso").mask("99/99/9999");
                                    });
                                </script>
                                <input id="inputCenso" type="date" class="form-control" name="inputCenso"><br>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="trocar" value="trocar" class="btn btn-success" onclick='return confirmarAtualizacao()' >Atualizar Data</button>
                            </div>                     
                        </div><br>
                    </div>
                    <!-- Div Matricula-->
                    <div id="divConteudoBtnMatricula" style="background-color: #cc7700; "  >
                        <div class="form-group"><br>
                            <label for="inputMatricula"  class="col-sm-3 control-label">Data para Matricula</label>
                            <div class="col-sm-2" >
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputMatricula").mask("99/99/9999");
                                    });
                                </script>
                                <input id="inputMatricula" type="date" class="form-control" name="inputMatricula">
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" name="trocar_matricula" value="trocar_matricula" class="btn btn-success" onclick='return confirmarAtualizacao()' >Atualizar Data</button>
                            </div>                     
                        </div><br>
                    </div>
                    <?php
                    echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                    echo "<thead>";
                    echo "<tr>";
                    //echo "<th> ID </th>";
                    echo "<th> Selecionados</th>";
                    echo "<th> NOME </th>";
                    echo "<th> DATA DE NACIMENTO </th>";
                    echo "<th> MÃE </th>";
                    echo "<th> TURMA </th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    echo "";
                    echo "";
                    foreach (($_POST['aluno_selecionado']) as $buscar_id) {
                        $Consultaf = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id = '$buscar_id' AND excluido = 'N' ORDER BY nome");
                        $rowf = mysqli_num_rows($Consultaf);

                        if ($rowf > 0) {

                            while ($linhaf = mysqli_fetch_array($Consultaf)) {
                                $nomef = $linhaf['nome'];
                                $data_nascimentof = $linhaf['data_nascimento'];
                                $maef = $linhaf['mae'];

                                $idf = $linhaf['id'];
                                $turmaf = $linhaf['turma'];

                                echo "<tr>";
                                //echo "<td>" . $idf . "</td>\n";
                                echo "<td><input type='checkbox' name='aluno_selecionado[]' class='marcar' value='$idf' checked ></td>\n";
                                echo "<td>" . $nomef . "</td>\n";
                                echo "<td>" . $data_nascimentof . "</td>\n";
                                echo "<td>" . $maef . "</td>\n";

                                echo "<td>" . $turmaf . "</td>\n";
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

        <script type = "text/javascript">
            $(document).ready(function () {
                $("#divConteudoBtnCenso").hide();
                $("#btnMostrarEsconderBtnCenso").click(function () {
                    $("#divConteudoBtnCenso").toggle(2500);
                });
            });
        </script>
        <script type = "text/javascript">
            $(document).ready(function () {
                $("#divConteudoBtnMatricula").hide();
                $("#btnMostrarEsconderBtnMatricula").click(function () {
                    $("#divConteudoBtnMatricula").toggle(2500);
                });
            });
        </script>

    </body> 
</html>

