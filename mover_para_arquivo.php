<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br" style="background-color:white;">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title>MOVER PARA O ARQUIVO</title>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/atualizar_varios.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <style>
            @media (max-width: 768px) {.botoes{width: -moz-available; margin-bottom: 6px;}
            } 
        </style>
        <style>
            @media (max-width: 384px) {#ocultar_2{display: none;}
            } 
        </style>
        <style>
            @media (max-width: 768px) {#ocultar{display: none;}
            } 
        </style>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <h3 style=" text-align: center;">Mover Aluno(a) Para o Arquivo Passivo</h3>
        <div class="container-fluid">                         
            <form name="cadastrar" action="atualizar_varios_server.php" method="post" class="form-horizontal" >                 
                <!-- Div Excluir-->
                <div id="divConteudoArquivo" style="background-color: #D9DBDA; "><br>
                    <div class="form-group">
                        <label for="inputPasta" class="col-sm-3 control-label">Escolha a Pasta</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="inputPasta" id="inputPasta" required="">
                                <option disabled= "" selected="">A,B,C, .....etc.  Por Favor Verifique se Ainda Existe Espaço na Pasta:)</option>
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `pastas_arquivo_passivo` ORDER BY `PASTA`");
                                while ($linha = mysqli_fetch_array($Consulta)) {
                                    $id = $linha['id'];
                                    $pasta = $linha['pasta'];
                                    $cheio = $linha['cheio'];
                                    if ($cheio == "SIM") {
                                        $cheio = "Arquivo Físico Cheio! Por Favor Verifique.";
                                    } else {
                                        $cheio = "";
                                    }
                                    //
                                    $sql = mysqli_query($Conexao, "SELECT *,COUNT(*) AS cont FROM `alunos` WHERE `excluido` LIKE 'S' AND ap_pasta LIKE '$pasta'");
                                    while ($result = mysqli_fetch_array($sql)) {
                                        $cont = $result['cont'];
                                        $txt = "Aluno(s)";
                                        //
                                    }
                                    //
                                    echo "<option value = '$pasta'>$pasta - $cont  $txt - $cheio</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9" >
                            <button type="submit"  name="Arquivo_Passivo" value="Arquivo_Passivo" class="btn btn-danger" onclick='return confirmarMover()' >Mover para a Pasta</button>
                        </div>
                    </div><br>                                
                </div>               
                <?php
                echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> SELEÇÃO</th>";
                echo "<th> NOME </th>";
                echo "<th> NASCIMENTO </th>";
                echo "<th id = 'ocultar_2'> MÃE </th>";
                echo "<th id = 'ocultar'> NIS </th>";
                echo "<th id = 'ocultar'> SUS </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                //
                $Consultaf = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id IN($id_recebe) AND excluido = 'N' ");
                $rowf = mysqli_num_rows($Consultaf);

                if ($rowf > 0) {

                    while ($linhaf = mysqli_fetch_array($Consultaf)) {
                        $nomef = $linhaf['nome'];
                        $data_nascimentof = new DateTime($linhaf['data_nascimento']);
                        $data_nascimentof = date_format($data_nascimentof, 'd/m/Y');
                        $maef = $linhaf['mae'];
                        $nis = $linhaf['nis'];
                        $idf = $linhaf['id'];
                        $susf = $linhaf['sus'];

                        echo "<tr>";
                        echo "<td><input type='checkbox' name='aluno_selecionado[]' class='marcar' value='$idf' checked ></td>\n";
                        echo "<td>" . $nomef . "</td>\n";
                        echo "<td>" . $data_nascimentof . "</td>\n";
                        echo "<td id = 'ocultar_2'>" . $maef . "</td>\n";
                        echo "<td id = 'ocultar'>" . $nis . "</td>\n";
                        echo "<td id = 'ocultar'>" . $susf . "</td>\n";
                        echo "</tr>";
                    }
                }
                echo "</tbody>";
                echo "</table>";
                ?>     
            </form>           
        </div>    
        <script type="text/javascript">
            function confirmarMover() {
                var r = confirm("Realmente deseja Mover esse Aluno?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body> 
</html>

