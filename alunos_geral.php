<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
include_once 'funcao.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe = "";
$Recebe = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$Msg = "";
$M = "";
if ($Recebe == "sucesso") {
    // echo "<script type=\"text/javascript\">
    // alert(\"Documentos Gravados com Sucesso! \");
    // </script>
    // ";
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Alterações Gravadas com Sucesso! </div>";
    $M = "1";
}
?>
<html lang="pt-br">    
    <head>
        <?php
        include_once 'head.php';
        ?>              
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/principal.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>        
        <style>
            #avisos{
                background-color:rgb(204,119,0); min-height: 400px;
                padding-bottom: 6px;
                margin-bottom: 12px;            
            }
            @media only screen and (max-width: 500px){
                #avisos{
                    height: 256px; 
                    height: auto;   
                    margin-bottom: 12px;
                }
            }           
        </style>        
        <!-- <link href="css/pace-theme-flash.css" rel="stylesheet" type="text/css"/>
        <script src="js/pace.min.js" type="text/javascript"></script> -->
    </head>
    <body id="body">
        <?php
        include_once 'mensagem_sucesso.php';
        //
        include_once 'menu.php';
        ?>
        <div class="container-fluid col-sm-12"><br>        
            <!--Busca por Alunos-->      <!--Busca por Alunos-->         <!--Busca por Alunos-->
            <div class="col-sm-12">                 
                <div class="row" style=" margin-top: 24px" id="alunos_1">
                    <?php
                    include_once 'alunos_1.php';
                    ?>
                </div>                
            </div>           
        </div>
    </body>   
</html>
