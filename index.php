<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
?>
<html lang="pr-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/> 
        <style>
            body{
                background-image: url(img/index.jpg);
                background-repeat: no-repeat;      
                background-position: center; 
                background-attachment: fixed;   

            } 
            @media (max-width: 1200px) {#teste{margin-top: 300px !important;}
            }  
            @media screen and (min-width: 720px) and (orientation: landscape) {
                #teste{margin-top: 0px !important;}
            }
        </style>
    </head>
    <body>       
        <div class="container">  
            <div style="width:100%; height: 78px" id="teste"></div>
        </div>
        <div class="container">      
            <div class="row" style="" >
                <div class="col-md-12">
                    <div class="wrap">
                        <p class="form-title" style=" font-size: 36px; font-weight: bold; margin-left: 60px;">Começar</p><br>
                        <form class="login" method="post" action="login_servidor.php" autocomplete="" >
                            <div style=" margin-bottom: 12px; margin-top: 12px; ">
                                <input style=" font-size: 20px; font-weight: bold;border-radius: 4px; width: 130%" type="text" placeholder="Usuário" name="nome" required = ""/>
                            </div>
                            <input style="font-size: 24px; border-radius: 4px; width: 130%" type="password" placeholder="Senha" name="senha" id = "inputSenha" required="" >
                            <a href=""><p>Deseja Trocar de Senha? Click Aqui!</p></a>

                            <input style="width: 130%" type="submit" value="Enviar" class="btn btn-success btn-sm">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.forgot-pass').click(function (event) {
                $(".pr-wrap").toggleClass("show-pass-reset");
            });

            $('.pass-reset-submit').click(function (event) {
                $(".pr-wrap").removeClass("show-pass-reset");
            });
        });
    </script>
</html>

