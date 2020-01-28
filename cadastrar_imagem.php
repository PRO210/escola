<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$Msg = "";
$M = "";

if ($Recebe_id == "12") {
    $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ops! O Arquivo Não é Do Tipo .jpg </div>";
//    echo "<script type=\"text/javascript\">
//		alert(\"Falha no Procedimento! \");
//               </script>
//                ";
    echo "$Recebe_id";
    $M = "1";
} elseif ($Recebe_id == "2") {
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Imagem Gravada com Sucesso $usuario_logado! </div>";
    $M = "1";
} elseif ($Recebe_id == "15") {
    $Msg = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ops! O Arquivo Não Foi Salvo ! </div>";
    $M = "1";
} elseif ($Recebe_id == "16") {
    $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Imagem Gravada com Sucesso $usuario_logado, mas O Histórico de Quem a Gravou Não! </div>";
    $M = "1";
}elseif ($Recebe_id == "3") {
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Imagens Excluídas com Sucesso $usuario_logado! </div>";
    $M = "1";
}
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>CADASTRAR IMAGENS</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        include_once 'head.php';
        ?>
        <style>
            @media (max-width: 825px) { .btmargin{ margin-top: 12px}
            }
        </style>
    </head>
    <body>        
        <!--Modal-->                <!--Modal-->            <!--Modal-->        
        <div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo $Msg;
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger " data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div> 
        <?php
        include_once './menu.php';
        ?>   
        <div class="container-fluid">
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
            <script src="js/bootstrap.min.js" type="text/javascript"></script> 
            <script>
                $(document).ready(function () {
                    $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
                });
            </script>
            <?php
            if ($M == "1") {
                echo"<script type='text/javascript'>
                $(document).ready(function () {
                   $('#exemplomodal').modal('show');
               });
                
            </script>";
            }
            ?>
            <h3 style="text-align: center">Cadastrar Imagens No sistema</h3>
            <form  method="post" class = "form-horizontal" action="cadastrar_imagem_server.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6 ">
                            <input type="text" name=""  class="form-control" value="O Arquivo Deve Ter o Nome e a extensão Dessa Forma: timbre.jpg">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Aperte o Botão Browse</label>
                        <div class="col-sm-6">
                            <input type="file" name="arquivo"  id="fileUpload" class="form-control" style="padding-bottom: 11mm;">
                        </div>                        
                    </div>                                       
                </div>         
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-2">
                            <button type="submit" value="timbre" name = "botao" class="btn btn-success btn-block btmargin" onclick="return confirmar()" >Salvar Imagem Do Timbre</button>
                        </div> 
                        <div class="col-sm-2">
                            <button type="submit" value="timbre_retirar" name = "botao" class="btn btn-danger btn-block btmargin" onclick="return confirmar2()" >Retirar A Imagem</button>
                        </div> 
                        <div class="col-sm-2">
                            <button type="reset" value="" name = "" class="btn btn-warning btn-block btmargin" onclick="window.location.reload()">Limpar</button>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Amostra de Imagem</label>
                        <div class="col-sm-6" >
                            <div id="wrapper " style="border:  black thin; border-radius: 12px; border-style: dashed" > 
                                <div id="image-holder">

                                </div>
                            </div>
                        </div>
                    </div>
                </div><br><br>
                <?php
                $querySelecionaPorCodigo = "SELECT * FROM imagens";
                $resultado = mysqli_query($Conexao, $querySelecionaPorCodigo);
                $linhas = mysqli_num_rows($resultado);
                if ($linhas > 0) {
                    ?>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Imagens Salvas</label>
                            <?php while ($imagem = mysqli_fetch_object($resultado)) { ?>
                                <div class="col-sm-3" >
                                    <div class=" thumbnail">
                                        <input type="checkbox" value="<?php echo $imagem->id ?>" name="imagens_selecionadas[]">
                                        <img src="data:image/jpg;base64,<?php echo base64_encode($imagem->blob_imagem) ?>" />
                                        <p class="caption">Nome :&nbsp;&nbsp;<?php echo $imagem->nome_imagem ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                <h3 style="text-align: center">Não Há Imagens Salvas no Banco:)</h3>
                <?php } ?>
            </form>
        </div>        
        <script type="text/javascript">
            $("#fileUpload").on('change', function () {

                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#image-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("Este navegador nao suporta FileReader.");
                }
            });
        </script>
        <script type="text/javascript">
            function confirmar() {
                var u = "<?php echo $usuario_logado ?>";
                var r = confirm("Posso Enviar a Imagem " + u + "? ");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <script type="text/javascript">
            function confirmar2() {
                var u = "<?php echo $usuario_logado ?>";
                var r = confirm("Posso Retirar a Imagem " + u + "? ");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    </body>
</html>
