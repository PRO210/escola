<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
if (isset($_POST['basica'])) {
    //
    include_once 'pesquisar_no_banco_impressao_atestados.php';
    //
} elseif (isset($_POST['exclui'])) {
    //
    include_once 'exclui_atestados.php';
    //
} elseif (isset($_POST['detalhada'])) {
    include_once 'pesquisar_no_banco_impressao_atestados_2.php';
} else {
    
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title>ATESTADOS ENVIADOS EM BLOCO</title>
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
                    <h3 style="text-align: center">EMVIAR ATESTADOS EM BLOCO</h3>
                    <form name="cadastrar" action="cadastrar_update_atestado_em_bloco_server.php" method="post" class="form-horizontal" >
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="inputEnviado" class="col-sm-2 col-sm-offset-3 control-label ">ENVIADO EM:</label>
                                <div class=" col-sm-2">                                  
                                    <input type="date" class="form-control" id="inputEnviado" name="inputEnviado" required="">
                                </div> 
                                <div class="col-sm-2">
                                    <button type="submit" value="Enviar" class="btn btn-success">ENVIAR</button>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th> SELEÇÃO</th>";
                        echo "<th> SERVIDOR</th>";
                        echo "<th> RECEBIDO </th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        foreach (($_POST['servidor_selecionado']) as $buscar_id) {
                            $Consultaf = mysqli_query($Conexao, "SELECT * FROM atestados_servidor WHERE id = '$buscar_id' ORDER BY servidor");
                            $rowf = mysqli_num_rows($Consultaf);

                            if ($rowf > 0) {

                                while ($linhaf = mysqli_fetch_array($Consultaf)) {

                                    $idf = $linhaf['id'];
                                    $servidor = $linhaf['servidor'];
                                    $recebido = new DateTime($linhaf['recebido']);
                                    $recebido = date_format($recebido, 'd/m/Y');

                                    echo "<tr>";
                                    echo "<td><input type='checkbox' name='servidor_selecionado[]' class='marcar' value='$idf' checked ></td>\n";
                                    echo "<td>" . $servidor . "</td>\n";
                                    echo "<td>" . $recebido . "</td>\n";

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
                    "lengthMenu": [[20, 25, 30, 40, 50, 70, 100, -1], [20, 25, 30, 40, 50, 70, 100, "All"]],

                    "language": {
                        "lengthMenu": "Servidores por Página _MENU_ ",
                        "zeroRecords": "Nenhum Servidor encontrado",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Sem registros",
                        "search": "Busca:",
                        "infoFiltered": "(filtrado de _MAX_ total de Servidores)",
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
    </body>    
</html>
