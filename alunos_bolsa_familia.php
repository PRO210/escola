<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>    
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid">
            <script src="js/bootstrap.js" type="text/javascript"></script>
            <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <div class="col-md-3">
                <form name="pesquisar" method="get" action="alunos_bolsa_familia_server.php">
                    <h3>Procurar Cadastros:</h3>
                    <input type="text" id="inputNome" name="inputNome" placeholder="Digite o Nome do Aluno" size="30"/>
                    <div class="form-group">
                        <div class="btn-group btn-group-sm">
                            <button type="submit" class="btn btn-success">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
    </body> 
</html>
