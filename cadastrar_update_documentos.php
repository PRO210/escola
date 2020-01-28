<?php
include_once 'valida_cookies.inc';
?>
<?php
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
if (isset($_POST["documentos_emprestados"])) {
    echo "";
    include_once 'pesquisar_no_banco_impressao_documentos.php';
}
?>
<?php
$id = base64_decode($_GET["id"]);
//echo "$id";
$Consulta = mysqli_query($Conexao, "SELECT * FROM documentos_emprestados WHERE `id`= '$id' ");
$linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
//
$nome = $linha['nome'];
$data_nascimento = new DateTime($linha["nascimento"]);
$nascimento = date_format($data_nascimento, 'd/m/Y');
$modelo_certidao = $linha["modelo_certidao"];
$matricula = $linha["matricula_certidao"];
$tipos_de_certidao = $linha["tipos_de_certidao"];
$certidao = $linha["certidao"];
$expedicao = new DateTime($linha["expedicao"]);
$expedicao = date_format($expedicao, 'd/m/Y');
$cpf = $linha['cpf'];
$celular = $linha['celular'];
$documentos = $linha['documentos'];
$emprestado = new DateTime($linha['emprestado']);
$emprestado = date_format($emprestado, 'd/m/Y');
//
$devolucao = new DateTime($linha['devolucao']);
$devolucao = date_format($devolucao, 'd/m/Y');
//
$devolvido = new DateTime($linha['devolvido']);
$devolvido = date_format($devolvido, 'd/m/Y');
$devolvido_sim = $linha['devolvidosim'];
?>
<html>
    <head>
        <meta charset="UTF-8">
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
                    <h3 style="text-align: center">Registrar Atualizações nos Documentos Emprestados</h3>
                    <form name="cadastrar" action="cadastrar_update_documentos_server.php" method="post" class="form-horizontal">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-3">
                                    <input type="text" placeholder="DIGITE O NOME DO REQUERENTE" class="form-control" id="" name="inputNome" required="" onkeyup="maiuscula(this)" value="<?php echo$nome; ?>">
                                </div>
                                <label for="inputNascimento"  class="col-sm-1 col-sm-offset-4 control-label">Nascimento</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputNascimento").mask("99/99/9999");
                                        });
                                    </script>
                                    <input id="inputNascimento" type="text" class="form-control" name="inputNascimento" value="<?php echo$nascimento; ?>">
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputModelo_certidao" class="col-sm-2  control-label">Modelo da Certidão</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="inputModelo_certidao" id="inputModelo_certidao">
                                        <?php
                                        $txt_option = "NOVO";
                                        $txt_option2 = "VELHO";

                                        if ($modelo_certidao == $txt_option) {
                                            echo "<option selected> $txt_option </option>";
                                            echo "<option> $txt_option2 </option>";
                                        } else {
                                            echo "<option selected>$txt_option2</option>";
                                            echo "<option>$txt_option</option>";
                                        }
                                        ?>
                                    </select>                            
                                </div>   
                                <div id="matricula">
                                    <label for="inputMatricula" class="col-sm-1 col-sm-offset-3 control-label">Matricula</label>
                                    <div class="col-sm-4">                                       
                                        <input type="text" class="form-control" id="inputMatricula" name="inputMatricula" value="<?php echo "$matricula"; ?>" placeholder="XXXXXXXXXX XXXX X XXXXX XXX XXXXXXX XX" >
                                    </div>
                                </div>
                                <div id="dados">
                                    <label for="inputCertidao" class="col-sm-2 col-sm-offset-4 control-label">Dados</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="inputCertidao" name="inputCertidao" onkeyup="maiuscula(this)" value="<?php echo$certidao; ?>" placeholder="Termo N°XXX, FLS:xxx, Livro: xx.">
                                    </div>
                                </div>
                            </div>
                        </div>          
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputTiposCertidao" class="col-sm-2 control-label">Certidão Civil</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="inputTiposCertidao" id="">
                                        <?php
                                        $txt_option = "NASCIMENTO";
                                        $txt_option2 = "CASAMENTO";
                                        $txt_option3 = "RG";
                                        $txt_option4 = "CNH";

                                        if ($tipos_de_certidao == "$txt_option") {
                                            echo "<option selected>$txt_option</option>";
                                            echo "<option>$txt_option2</option>";
                                            echo "<option>$txt_option3</option>";
                                            echo "<option>$txt_option4</option>";
                                        } elseif ($tipos_de_certidao == "$txt_option2") {
                                            echo "<option selected>$txt_option2</option>";
                                            echo "<option>$txt_option</option>";
                                            echo "<option>$txt_option3</option>";
                                            echo "<option>$txt_option4</option>";
                                        } elseif ($tipos_de_certidao == "$txt_option3") {
                                            echo "<option selected>$txt_option3</option>";
                                            echo "<option>$txt_option</option>";
                                            echo "<option>$txt_option2</option>";
                                            echo "<option>$txt_option4</option>";
                                        } elseif ($tipos_de_certidao == "$txt_option4") {
                                            echo "<option selected>$txt_option4</option>";
                                            echo "<option>$txt_option</option>";
                                            echo "<option>$txt_option2</option>";
                                            echo "<option>$txt_option3</option>";
                                        }
                                        ?>                                                
                                    </select>
                                </div>                              
                                <label for="inputExpedicao" class="col-sm-2 col-sm-offset-4 control-label">Expedição</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputExpedicao").mask("99/99/9999");
                                        });
                                    </script>
                                    <input type="text" class="form-control" id="inputExpedicao" name="inputExpedicao" value="<?php echo$expedicao; ?>">
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
                                    <input type="text" class="form-control" id="inputCpf" name="inputCpf" value="<?php echo$cpf; ?>">
                                </div> 
                                <label for="inputCel" class="col-sm-2 col-sm-offset-4 control-label">CELULAR</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputCel").mask("(99) 9-9999-9999");
                                        });
                                    </script>
                                    <input type="text" class="form-control" id="inputCel" name="inputCel" value="<?php echo$celular; ?>">
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputDocumentos" class=" control-label col-sm-2">Documentos:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" id="inputDocumentos" name="inputDocumentos" required="Esse Campo não pode ficar em Branco" onkeyup="maiuscula(this)"><?php echo "$documentos"; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputEmprestado" class="col-sm-2 control-label">Emprestado</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputEmprestado").mask("99/99/9999");
                                        });
                                    </script>
                                    <input type="text" class="form-control" id="inputEmprestado" name="inputEmprestado" value="<?php echo$emprestado; ?>">
                                </div>                                	
                                <label for="inputDevolucao" class="col-sm-2 col-sm-offset-4  control-label">Data para Devolução</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputDevolucao").mask("99/99/9999");
                                        });
                                    </script>
                                    <input type="text" class="form-control" id="inputDevolucao" name="inputDevolucao" value="<?php echo$devolucao; ?>">
                                </div>
                            </div>                         
                        </div>                        
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputDevolvidoSim" class="col-sm-2 control-label">Devolvido</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="inputDevolvidoSim" id="inputDevolvidoSim">
                                        <?php
                                        $txt_option_devolvido_sim = "SIM";
                                        $txt_option_devolvido_sim2 = "NÃO";
                                        if ($devolvido_sim == "SIM") {
                                            echo "<option selected>$txt_option_devolvido_sim</option>";
                                            echo "<option>$txt_option_devolvido_sim2</option>";
                                        } else {
                                            echo "<option selected>$txt_option_devolvido_sim2</option>";
                                            echo "<option>$txt_option_devolvido_sim</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                                <div id="Data">
                                    <label for="inputData" class="col-sm-2 col-sm-offset-4 control-label">Data</label>
                                    <div class="col-sm-2">
                                        <script type="text/javascript" >
                                            $(function () {
                                                $("#inputData").mask("99/99/9999");
                                            });
                                        </script>
                                        <input type="text" class="form-control" id="inputData" name="inputData" value="<?php echo$devolvido; ?>">                                   
                                    </div> 
                                </div>                                
                            </div>
                        </div> 
                        <input type="hidden" class="form-control" id="" name="inputId" value="<?php echo$id; ?>">
                        <div class="row">
                            <div class="form-group col-sm-12">                               
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-success" onclick=" return confirmarArquivamento()">Atualizar Cadastro</button>
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
            var r = confirm("Realmente deseja Atualizar?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            if ($('#inputDevolvidoSim').val() == 'SIM') {
                $('#Data').show();
            } else {
                $('#Data').hide();
            }
            $('#inputDevolvidoSim').change(function () {
                if ($('#inputDevolvidoSim').val() == 'SIM') {
                    $('#Data').show();
                } else {
                    $('#Data').hide();
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            if ($('#inputModelo_certidao').val() == 'VELHO') {
                $('#dados').show();
                $('#matricula').hide();
            } else {
                $('#matricula').show();
                $('#dados').hide();

            }

            $('#inputModelo_certidao').change(function () {
                if ($('#inputModelo_certidao').val() == 'VELHO') {
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

