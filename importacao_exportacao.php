<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe = "";
$Recebe = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$Msg = "";
$M = "";
if (!empty($Recebe)) {
    if ($Recebe == "1") {
        $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Documentos Gravados com Sucesso! </div>";
        $M = "1";
    } elseif ($Recebe == "2") {
        $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "O Arquivo Que Voçê Enviou não é do Tipo: alunos.csv ! </div>";
        $M = "1";
    } elseif ($Recebe == "3") {
        $Msg = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ocorreu Algum Problema Durante a Atualização; Tente De Novo ou Contate o Administrador!  </div>";
        $M = "1";
    } elseif ($Recebe == "11") {
        $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "A Copia do Banco Foi Feita com Sucesso! O Arquivo Está em C:\Usuários\Public\' Com o Nome:backup_dos_dados.sql  </div>";
        $M = "1";
    } elseif ($Recebe == "12") {
        $Msg = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ocorreu Algum Problema Durante a Cópia; Tente De Novo ou Contate o Administrador!  </div>";
        $M = "1";
    } elseif ($Recebe == "31") {
        $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Banco de Dados Foi Atualizado com Sucesso! Talvez Seja Necessatio Atualizar a Págiana apertando F5.  </div>";
        $M = "1";
    }elseif ($Recebe == "3") {
        $Msg = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ocorreu Algum Problema Durante a Atualização; Tente De Novo ou Contate o Administrador!  </div>";
        $M = "1";
    }
}
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>IMPORTAÇÃO/EXPORTAÇÃO</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>        
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
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
        if ($M == "1") {
            echo"<script type='text/javascript'>
                $(document).ready(function () {
                   $('#exemplomodal').modal('show');
               });
                
            </script>";
        }
        ?>
        <div class="container-fluid">
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
            <h3 style="text-align: center">Importação e Exportação da Base de Dados</h3>
            <form  method="post" class = "form-horizontal" action="importacao_exportacao_server.php" enctype="multipart/form-data">

                <div class="row">
                    <div class="form-group col-sm-12">                       
                        <label for="" class="col-sm-2 control-label"> </label>
                        <div class="col-sm-6">
                            <h4>Importação de Dados para a Tabela Alunos</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <input type="text" name=""  class="form-control" value="O Arquivo Deve Ter o Nome e a extensão Dessa Forma: alunos.scv">
                        </div>                       
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Arquivo Exemplo</label>
                        <div class="col-sm-6">                          
                            <a href="alunos.csv" class="btn btn-primary btn-block"> Baixar</a>
                        </div>                       
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Aperte o Botão Browse</label>
                        <div class="col-sm-6">
                            <input type="file" name="arquivo_alunos"  id="" class="form-control" style="padding-bottom: 11mm;">
                        </div>                        
                    </div>                                       
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" value="alunos_up" name = "botao" class="btn btn-success btn-block btmargin" onclick="return confirmar()" >Atualizar a Tabela Alunos</button>
                        </div>                        
                        <div class="col-sm-3">
                            <button type="reset" value="" name = "" class="btn btn-warning btn-block btmargin" onclick="window.location.reload()">Limpar</button>
                        </div>  
                    </div>
                </div><br>
                <div class="row">
                    <div class="form-group col-sm-12">                       
                        <label for="" class="col-sm-2 control-label"> </label>
                        <div class="col-sm-6">
                            <h4>Copia do Banco de Dados</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <input type="text" name=""  class="form-control" value="O Backup do Banco Deve ser Feito ao menos Uma Vez por Dia e Preferencialmente Antes de uma Atualização:)">
                            <input type="text" name=""  class="form-control" value="Depois de Feito O Aqruivo Estará Disponível na Pasta 'C:\Usuários\Public\' Com o Nome:backup_dos_dados.sql ">
                        </div>                       
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Aperte o Botão Para Realizar A Cópia</label>
                        <div class="col-sm-6">                          
                            <a href="backup_do_banco.php" class="btn btn-primary btn-block">Copiar Todo o Banco De Dados</a>
                        </div>                       
                    </div>
                </div><br>                
                <div class="row">
                    <div class="form-group col-sm-12">                       
                        <label for="" class="col-sm-2 control-label"> </label>
                        <div class="col-sm-6">
                            <h4>Importação do Banco de Dados</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-6">
                            <input type="text" name=""  class="form-control" value="O Arquivo Deve Ter o Nome e a extensão Dessa Forma: backup_dos_dados.sql">
                        </div>                       
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Aperte o Botão Browse</label>
                        <div class="col-sm-6">
                            <input type="file" name="arquivo_banco"  id="" class="form-control" style="padding-bottom: 11mm;">
                        </div>                        
                    </div>                                       
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label"></label>
                        <div class="col-sm-3">
                            <button type="submit" value="banco_up" name = "botao" class="btn btn-success btn-block btmargin" onclick="return confirmar()" >Atualizar Todo Banco de Dados</button>
                        </div>                        
                        <div class="col-sm-3">
                            <button type="reset" value="" name = "" class="btn btn-warning btn-block btmargin" onclick="window.location.reload()">Limpar</button>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
