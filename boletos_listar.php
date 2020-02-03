<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");

?>









<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todos os Boletos</title>       
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>  
         <style>
            .dropdown-menu{font-size: 14px !important;}
        </style>
        <div class="container-fluid" >    
            <h3 style="text-align: center;">TODOS OS BOLETOS</h3>
            
            
            
        </div>
    </body>
</html>
