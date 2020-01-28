<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once 'valida_cookies.inc';
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
if (isset($_POST['basica'])) {
    include_once 'pesquisar_no_banco_impressao_substituicao.php';
}elseif (isset($_POST['exclui'])) {   
    include_once 'exclui_substituicoes.php';
}else{
    
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title>SUBSTITUIÇÕES ENVIADAS EM BLOCO</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>
        <div class="container-fluid">
            <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
            <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="text-align: center">EMVIAR SUBSTITUIÇÕES EM BLOCO</h3>
                    <form name="cadastrar" action="cadastrar_update_substituicao_em_bloco_server.php" method="post" class="form-horizontal" >
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="inputEnviado" class="col-sm-2 col-sm-offset-3 control-label ">ENVIADO EM:</label>
                                <div class=" col-sm-2">                                    
                                    <input type="date" class="form-control" id="inputEnviado" name="inputEnviado" required="">
                                </div> 
                                <div class="col-sm-2">
                                    <button type="submit" value="Enviar" class="btn btn-success" onclick="return confirmarAtualizacao()">ENVIAR</button>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th> SELEÇÃO</th>";
                        echo "<th> SERVIDOR</th>";
                        echo "<th> SUBSTITUITO</th>";
                        echo "<th> INICÍO</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach (($_POST['servidor_selecionado']) as $buscar_id) {
                            $Consultaf = mysqli_query($Conexao, "SELECT * FROM substituicoes WHERE id = '$buscar_id' ORDER BY servidor");
                            $rowf = mysqli_num_rows($Consultaf);

                            if ($rowf > 0) {

                                while ($linhaf = mysqli_fetch_array($Consultaf)) {

                                    $idf = $linhaf['id'];
                                    $servidor = $linhaf['servidor'];
                                     $substituto = $linhaf['substituto'];
                                    $inicio = new DateTime($linhaf['inicio']);
                                    $inicio = date_format($inicio, 'd/m/Y');

                                    echo "<tr>";
                                    echo "<td><input type='checkbox' name='servidor_selecionado[]' class='marcar' value='$idf' checked ></td>\n";
                                    echo "<td>" . $servidor . "</td>\n";
                                      echo "<td>" . $substituto . "</td>\n";
                                    echo "<td>" . $inicio . "</td>\n";

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
        </div>
        <script>
            $(document).ready(function () {
                $('#tbl_alunos_lista').DataTable({
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
        <script type="text/javascript">
        function confirmarAtualizacao() {
            var r = confirm("Posso Enviar?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    </body>    
</html>
