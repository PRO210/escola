<!DOCTYPE html>
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
         <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid" >     
            <div class="row">
                <div class="starter-template">
                     <h3 style="text-align: center">SERVIDORES</h3>
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
                    <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <script src="js/cadastrar_validar.js" type="text/javascript"></script>
                    <link href="css/pesquisar_no_banco.css" rel="stylesheet" type="text/css"/> 
                    <h3 style="text-align: center">Procurar Cadastros de Funcionários por Vínculo:</h3>
                    <form name="pesquisar" method="post" action="servidores_procurar_server.php" class="form-horizontal" >
                        <div class="form-group">
                          <label for="inputvinculo" class="col-sm-3 control-label"></label>
                            <div class="col-sm-4 col-sm-offset-1">
                                <select class="form-control" name="inputvinculo" id="inputvinculo">
                                    <option value = "">SEM DISTINÇÃO</option>
                                    <option value = "PROFESSOR(A)">PROFESSOR(A)</option>
                                    <?php
                                    $Consulta_vinculo = mysqli_query($Conexao, "SELECT * FROM `vinculos`");
                                
                                    while ($Registro_vinculo = mysqli_fetch_array($Consulta_vinculo, MYSQLI_BOTH)) {
                                        $linha_vinculo = $Registro_vinculo["vinculo"];
                                        echo "<option>$linha_vinculo</option>";
                                    }
                                    ?>
                                </select><br>
                                <input type="text"  name="inputbuscarf" placeholder="Digite o Nome do Servidor" size="35"/>
                                <button type="submit" value="" class="btn btn-success">Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
