<?php
include_once 'valida_cookies.inc';
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<!Recebe o id de numero_de_servidors>
<?php
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
//echo base64_Decode($Recebe_id);

$Consulta_up = mysqli_query($Conexao, "SELECT * FROM servidores WHERE id= '" . base64_Decode($Recebe_id) . "'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);

$matricula = $Registro['matricula'];
$vinculo = $Registro['vinculo'];
$funcao = $Registro['funcao'];
$turno = $Registro["turno"];
$nome = $Registro["nome"];
$nascimento = new DateTime($Registro["nascimento"]);
$data_nascimento_convertida = date_format($nascimento, 'd/m/Y');
$pai = $Registro["pai"];
$mae = $Registro["mae"];
$cpf = $Registro["cpf"];
$modelo_certidao = $Registro["modelo_certidao"];
$matricula_certidao = $Registro["matricula_certidao"];
$tipos_de_certidao = $Registro["tipos_de_certidao"];
$dados_certidao = $Registro["dados_certidao"];
$orgao_expedidor = $Registro["orgao_expedidor"];
$estado_expedidor = $Registro["estado_expedidor"];
$data_expedicao = new DateTime($Registro["data_expedicao"]);
$data_expedicao_convertida = date_format($data_expedicao, 'd/m/Y');
$fone = $Registro["fone"];
$celular = $Registro["celular"];
$email = $Registro["email"];
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>        
        <link href="css/cadastrar.css" rel="stylesheet" type="text/css"/>
        <title>Registro do Servidor</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <div class="container-fluid">
            <div class="row">
                <script src="js/bootstrap.js" type="text/javascript"></script>
                <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>                   
                <script src="js/cadastrar_validar.js" type="text/javascript"></script>        
                <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
                <h3 style="text-align: center">Registro do Servidor</h3>
                <form name="cadastrar_servidores" action="cadastrar_update_servidor_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputTurno" class="col-sm-2 control-label" >Turno</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputTurno" id="inputTurno">
                                    <?php
                                    $Consulta_turno = mysqli_query($Conexao, "SELECT * FROM `turnos`");
                                    echo "<option>------</option>";
                                    while ($Registro_turno = mysqli_fetch_array($Consulta_turno, MYSQLI_BOTH)) {
                                        $turno_linha_turno = $Registro_turno['turno'];
                                        $turma_em_branco = "-------";
                                        if ($turno == $turno_linha_turno) {
                                            echo "<option selected>$turno_linha_turno</option>";
                                        } elseif ($turno == $turma_em_branco) {
                                            echo "<option selected>$turma_em_branco</option>";
                                        } else {
                                            echo "<option>$turno_linha_turno</option>";
                                        }
                                    }
                                    ?> 
                                </select>
                            </div>                                   
                            <label for="inputMatricula" class="col-sm-2 control-label">Matricula</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $matricula; ?>" class="form-control" id="inputMatricula" name="inputMatricula" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputFuncao" class="col-sm-2 control-label">Função</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputFuncao" id="inputFuncao">
                                    <?php
                                    $Consulta_funcao = mysqli_query($Conexao, "SELECT * FROM `funcoes`");
                                    while ($Registro_funcao = mysqli_fetch_array($Consulta_funcao, MYSQLI_BOTH)) {
                                        $funcao_funcao = $Registro_funcao["funcao"];
                                        if ($funcao == $funcao_funcao) {
                                            echo "<option selected>$funcao_funcao</option>";
                                        } else {
                                            echo "<option>$funcao_funcao</option>";
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>                                 
                            <label for="inputVinculo" class="col-sm-2 control-label">Vínculo</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputVinculo" id="inputVinculo">
                                    <?php
                                    $Consulta_vinculo = mysqli_query($Conexao, "SELECT * FROM `vinculos`");
                                    while ($Registro_vinculo = mysqli_fetch_array($Consulta_vinculo, MYSQLI_BOTH)) {
                                        $linha_vinculo = $Registro_vinculo["vinculo"];
                                        if ($vinculo == $linha_vinculo) {
                                            echo "<option selected>$linha_vinculo</option>";
                                        } else {
                                            echo "<option>$linha_vinculo</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>     
                    </div>                         
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="DIGITE O NOME DO SERVIDOR"  value="<?php echo$nome ?>" class="form-control" id="inputNome" name="inputNome" onkeyup="maiuscula(this)">
                            </div>
                            <label for="inputNascimento"  class="col-sm-2 control-label">Data de Nascimento</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputNascimento").mask("99/99/9999");
                                    });
                                </script>
                                <input id="inputNascimento" type="text" value=" <?php echo $data_nascimento_convertida ?> " class="form-control" name="inputNascimento">
                            </div>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputModelo_Certidao" class="col-sm-2  control-label">Modelo da Certidão</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="inputModelo_Certidao" id="inputModelo_Certidao">
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
                            <label for="inputMatricula_Certidao" class="col-sm-1 col-sm-offset-3 control-label">Matricula</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputMatricula_Certidao").mask("999999.99.99.9999.9.99999.999.9999999.99");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputMatricula_Certidao" name="inputMatricula_Certidao" value="<?php echo "$matricula_certidao"; ?>" >
                            </div>
                        </div>
                    </div>           
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputTiposCertidao" class="col-sm-2 control-label">Tipo de Certidão Civil</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputTiposCertidao" id="inputTiposCertidao">
                                    <?php
                                    $txt_option = "RG";
                                    $txt_option2 = "CASAMENTO";
                                    $txt_option3 = "------";
                                    if ($tipos_de_certidao == $txt_option) {
                                        echo "<option selected>$txt_option</option>";
                                        echo "<option>$txt_option2</option>";
                                        echo "<option>$txt_option3</option>";
                                    } elseif ($tipos_de_certidao == $txt_option2) {
                                        echo "<option selected>$txt_option2</option>";
                                        echo "<option>$txt_option</option>";
                                        echo "<option>$txt_option3</option>";
                                    } else {
                                        echo "<option selected>$txt_option3</option>";
                                        echo "<option>$txt_option</option>";
                                        echo "<option>$txt_option2</option>";
                                    }
                                    ?>   
                                </select>
                            </div>             
                            <label for="inputCertidao" class="col-sm-2 control-label">Número</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $dados_certidao ?>" class="form-control" id="inputCertidao" name="inputCertidao" onkeyup="maiuscula(this)">
                            </div>
                        </div>   
                    </div>
                     <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Orgão Expedidor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="" name="inputOxp"  value="<?php echo "$orgao_expedidor"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="" class="col-sm-2 control-label">Estado da Expedidor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="" name="inputExpdd" value="<?php echo "$estado_expedidor"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputExpedicao" class="col-sm-2 control-label">Data de Expedição</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputExpedicao").mask("99/99/9999");
                                    });
                                </script>
                                <input type="text" value="<?php echo "$data_expedicao_convertida"; ?>"  class="form-control" id="inputExpedicao" name="inputExpedicao" >
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputMae" class="col-sm-2 control-label">Mãe</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputMae" name="inputMae"  value="<?php echo "$mae"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="inputPai" class="col-sm-2 control-label">Pai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputPai" name="inputPai" value="<?php echo "$pai"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputCpf" class="col-sm-2 control-label">CPF</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputCpf").mask("999.999.999-99", {reverse: true});
                                    });
                                </script>
                                <input  class="form-control" id="inputCpf" name="inputCpf" value="<?php echo "$cpf"; ?>">
                            </div>                   
                            <label for="inputFone" class="col-sm-2 control-label">Fone</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputFone").mask("9999-9999");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputFone" name="inputFone" value="<?php echo $fone ?>">
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputCel" class="col-sm-2 control-label">CELULAR</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputCel").mask("(99) 9-9999-9999");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputCel" name="inputCel" value="<?php echo $celular ?>">
                            </div>
                            <label for="inputEmail" class="col-sm-2 control-label">EMAIL</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="DIGITE O EMAIL" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo $email ?>">
                            </div>
                        </div>   
                    </div>                
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <a href="javascript:history.back()" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
