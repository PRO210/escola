<?php
include_once 'valida_cookies.inc';
?>    
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
if (isset($_GET["id"]) == 2) {
    echo "<script type=\"text/javascript\">
		alert(\"Falha no Arquivamento! \");
                </script>
                ";
}
?>
<html>
    <head>
        <?php
        include_once 'head.php';
        ?>
        <title></title>
    </head>
    <body>
        <?php
        include_once 'menu.php';
        ?>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="text-align: center">Registrar os Documentos Emprestados</h3>
                    <form name="cadastrar" action="cadastrar_documentos_emprestados_server.php" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-3">
                                    <input type="text" placeholder="DIGITE O NOME DO REQUERENTE" class="form-control" id="" name="inputNome" required="" onkeyup="maiuscula(this)">
                                </div>
                                <label for="inputNascimento"  class="col-sm-1 col-sm-offset-4 control-label">Nascimento</label>
                                <div class="col-sm-2">                                    
                                    <input id="inputNascimento" type="date" class="form-control" name="inputNascimento">
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="InputModelo_certidao" class="col-sm-2  control-label">Modelo da Certidão</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="InputModelo_certidao" id="InputModelo_certidao">
                                        <option value="NOVO">NOVO</option>
                                        <option value="VELHO">VELHO</option>
                                    </select>
                                </div>  
                                <div id="matricula">
                                    <label for="inputMatricula" class="col-sm-1 col-sm-offset-3 control-label">Matricula</label>
                                    <div class="col-sm-4">                                      
                                        <input type="text" class="form-control" id="inputMatricula" name="inputMatricula"  placeholder="XXXXXXXXXX XXXX X XXXXX XXX XXXXXXX XX">
                                    </div>
                                </div>                         
                                <div id="dados">
                                    <label for="inputCertidao" class="col-sm-1 col-sm-offset-3 control-label">Dados</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="inputCertidao" name="inputCertidao" onkeyup="maiuscula(this)" placeholder="Termo N°XXX, FLS:xxx, Livro: xx.">
                                    </div>
                                </div>
                            </div>
                        </div>               
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputTiposCertidao" class="col-sm-2 control-label">Certidão Civil</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="inputTiposCertidao" id="">
                                        <option value="NASCIMENTO">NASCIMENTO</option>
                                        <option value="CASAMENTO">CASAMENTO</option>
                                        <option value="RG">RG</option>
                                        <option value="CNH">CNH</option>
                                    </select>
                                </div>                               
                                <label for="inputExpedicao" class="col-sm-1 col-sm-offset-5 control-label">Expedição</label>
                                <div class="col-sm-2">                                   
                                    <input type="date" class="form-control" id="inputExpedicao" name="inputExpedicao" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputCpf" class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputCpf").mask("999.999.999-99", {reverse: true});
                                        });
                                    </script>
                                    <input type="text" class="form-control" id="inputCpf" name="inputCpf">
                                </div> 
                                <label for="inputCel" class="col-sm-2 col-sm-offset-4 control-label">CELULAR</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputCel").mask("(99) 9-9999-9999");
                                        });
                                    </script>
                                    <input type="text" class="form-control" id="inputCel" name="inputCel" >
                                </div>
                            </div>
                        </div>                       
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputDocumentos" class=" control-label col-sm-2">Documentos:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" id="inputDocumentos" name="inputDocumentos" required="Esse Campo não pode ficar em Branco" onkeyup="maiuscula(this)" placeholder="OS DOCUMENTOS EMPRESTADOS DEVEM SER SEPARADOS POR VIRGULAS"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputEmprestado" class="col-sm-2 control-label">Emprestado</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" id="inputEmprestado" name="inputEmprestado" >
                                </div>                                	
                                <label for="inputDevolucao" class="col-sm-2 col-sm-offset-4  control-label">Data para Devolução</label>
                                <div class="col-sm-2">                                   
                                    <input type="date" class="form-control" id="inputDevolucao" name="inputDevolucao" >
                                </div>
                            </div>                         
                        </div>                     
                        <div class="row">
                            <div class="form-group col-sm-12">                               
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-success" onclick=" return confirmarArquivamento()">Arquivar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        // INICIO FUNÇÃO DE MASCARA MAIUSCULA
        function maiuscula(z) {
            v = z.value.toUpperCase();
            z.value = v;
        }
    </script>
    <script type="text/javascript">
        function confirmarArquivamento() {
            var r = confirm("Realmente deseja Arquivar?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dados').hide();
            $('#InputModelo_certidao').change(function () {

                if ($('#InputModelo_certidao').val() == 'VELHO') {
                    $('#dados').show();
                    $('#matricula').hide();

                } else {
                    $('#matricula').show();
                    $('#dados').hide();

                }
            });
        });
    </script>
</html>
