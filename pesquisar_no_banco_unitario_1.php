<?php
include_once 'valida_cookies.inc';
?>
<?php
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<!Recebe o id de pesquisar_no_banco>
<?php
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
//echo base64_Decode($Recebe_id);

$Consulta_up = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '" . base64_Decode($Recebe_id) . "'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);

$inep = $Registro["inep"];
$turma = $Registro["turma"];
$nome = $Registro["nome"];
//Recebi a data do banco
$data_nascimento = new DateTime($Registro["data_nascimento"]);
//$data_nascimento_convertida = date_format($data_nascimento, 'd/m/Y');
$fone = $Registro["fone"];
$modelo_certidao = $Registro["modelo_certidao"];
$matricula = $Registro["matricula_certidao"];
$tipos_de_certidao = $Registro["tipos_de_certidao"];
$certidao = $Registro["certidao_civil"];
$expedicao = $Registro["data_expedicao"];
$naturalidade = $Registro["naturalidade"];
$estado = $Registro["estado"];
$nacionalidade = $Registro["nacionalidade"];
$sexo = $Registro["sexo"];
$nis = $Registro["nis"];
$bolsa_familia = $Registro["bolsa_familia"];
$sus = $Registro["sus"];
$pai = $Registro["pai"];
$profissao_pai = $Registro["profissao_pai"];
$mae = $Registro["mae"];
$profissao_mae = $Registro["profissao_mae"];
$endereco = $Registro["endereco"];
$cidade = $Registro["cidade"];
$estado_cidade = $Registro["estado_cidade"];
$transporte = $Registro["transporte"];
$motorista = $Registro["motorista"];
$motorista2 = $Registro["motorista2"];
$declaracao = $Registro["declaracao"];
$data_declaracao = new DateTime($Registro["data_declaracao"]);
$data_declaracao_convertida = date_format($data_declaracao, 'd/m/Y');
$responsavel_declacao = $Registro["responsavel_declaracao"];
$transferencia = $Registro["transferencia"];
//Recebi a data do banco
$data_transferencia = new DateTime($Registro["data_transferencia"]);
$data_transferencia_convertida = date_format($data_transferencia, 'd/m/Y');
$responsavel_transferencia = $Registro["responsavel_transferencia"];
$inputMatricula = new DateTime($Registro["Data_matricula"]);
$data_renovacao_matricula = $Registro["data_renovacao_matricula"];
//$data_renovacao_matricula_convertida = date_format($data_renovacao_matricula,'d/m/Y');
$status = $Registro["status"];
$inputTextArea = $Registro["obs"];
$historico = $_SERVER['HTTP_REFERER'];
//echo "$historico";
?>
<html lang="pt-br" style="background-color: cadetblue">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script> 
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>      
        <div class="row" id="geral">
            <div class="container-fluid">
                <form class="form-horizontal" >
                    <h3 style="text-align: center">Aluno Escolhido</h3>
                    <div class="row" id="um">
                        <div class="form-group col-sm-12">
                            <label for="inputTurma" class="col-sm-2 control-label">Turma</label>
                            <div class="col-sm-4">
                                <input type="text"  class="form-control" value="<?php echo $turma ?>">
                            </div>
                            <label for="inputstatus" class="col-sm-2 control-label col-sm-offset-2">Status</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" value="<?php echo $status ?>">
                            </div>                        
                        </div>
                    </div>
                    <div class="row" id="dois">
                        <div class="form-group col-sm-12">
                            <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputNome" name="inputNome" value="<?php echo $nome; ?>">
                            </div>
                            <label for="inputNascimento"  class="col-sm-1 control-label">Nascimento</label>
                            <div class="col-sm-2">
                                <input id="inputNascimento" type="text" class="form-control" name="inputNascimento" value="<?php echo date_format($data_nascimento, 'd/m/Y'); ?>">
                            </div>                                              
                            <label for="inputFone" class="col-sm-1 control-label">Fone</label>
                            <div class="col-sm-2">
                                <script type="text/javascript">
                                    $(function () {
                                        $("#inputFone").mask("99-99999-9999");
                                    });
                                </script>
                                <input id="inputFone" type="text" class="form-control" name="inputFone" value="<?php echo $fone; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputInep" class="col-sm-2 control-label">Nº INEP</label>
                        <div class="col-sm-4">                            
                            <input id="inputInep" type="number" min= '0'  max = '999999999999' step= "1" pattern="[0-9]+$"  class="form-control" name="inputInep" placeholder="Use Somente Números" value="<?php echo $inep; ?>">
                        </div >              
                        
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
                            <label for="inputMatricula" class="col-sm-1 col-sm-offset-3 control-label">Matricula</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputMatricula").mask("999999.99.99.9999.9.99999.999.9999999.99");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputMatricula" name="inputMatricula" value="<?php echo "$matricula"; ?>" >
                            </div>
                        </div>
                    </div>          
                    <div class="row" id="tres">
                        <div class="form-group col-sm-12">                                                      
                            <label for="inputTiposCertidao" class="col-sm-2 control-label">Certidão Civil</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputCertidao" name="inputCertidao" value="<?php echo $tipos_de_certidao ?>" onkeyup="maiuscula(this)">
                            </div>                         
                            <label for="inputCertidao" class="col-sm-1 control-label">Dados</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="inputCertidao" name="inputCertidao" value="<?php echo $certidao ?>" onkeyup="maiuscula(this)">
                            </div>                    
                            <label for="inputExpedicao" class="col-sm-1 col-sm-offset-1 control-label">Expedição</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputExpedicao" name="inputExpedicao" value="<?php echo $expedicao ?>">
                            </div>                             
                        </div>
                    </div>
                    <div class="row" id="quatro">
                        <div class="form-group col-sm-12">                            
                            <label for="inputNaturalidade" class="col-sm-2 control-label">Naturalidade</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputNaturalidade" name="inputNaturalidade" value="<?php echo $naturalidade ?>" onkeyup="maiuscula(this)">
                            </div>                         
                            <label for="inputEstado" class="col-sm-1  col-lg-offset-5 control-label">Estado</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputEstado" name="inputEstado" value="<?php echo $estado ?>" onkeyup="maiuscula(this)">
                            </div>                  
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputNacionalidade" class="col-sm-2 control-label">Nacionalidade</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputNacionalidade" name="inputNacionalidade" value="<?php echo $nacionalidade ?>" onkeyup="maiuscula(this)">
                            </div>                  
                            <label for="inputSexo" class="col-sm-1 control-label col-sm-offset-5">Sexo</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputSexo" name="inputSexo" value="<?php echo $sexo ?>" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="cinco">
                        <div class="form-group col-sm-12"> 
                            <label for="inputNIS" class="col-sm-2 control-label">NIS</label>
                            <div class="col-sm-2">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputNIS").mask("999.9999.9999", {reverse: true});
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputNIS" name="inputNIS" value="<?php echo $nis ?>">
                            </div>
                            <label for="inputBolsaFamilia" class="col-sm-1 control-label">Bolsa Família</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="inputBolsaFamilia" name="inputBolsaFamilia" value="<?php echo $bolsa_familia ?>">
                            </div>
                            <label for="inputSUS" class="col-sm-1 control-label col-sm-offset-1">SUS</label>
                            <div class="col-sm-2">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputSUS").mask("999.9999.9999.9999");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputSUS" name="inputSUS" value="<?php echo $sus ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="cinco">
                        <div class="form-group col-sm-12">                          
                            <label for="inputPai" class="col-sm-2 control-label">Nome do Pai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputPai" name="inputPai" value="<?php echo $pai ?>" onkeyup="maiuscula(this)">
                            </div>               
                            <label for="inputProfissaoPai" class="col-sm-2 col-sm-offset-1 control-label">Profissão do Pai</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="inputProfissaoPai" name="inputProfissaoPai" value="<?php echo $profissao_pai ?>" onkeyup="maiuscula(this)">

                            </div>               
                        </div>
                    </div>
                    <div class="row" id="seis">
                        <div class="form-group col-sm-12">      
                            <label for="inputMae" class="col-sm-2 control-label">Nome da Mãe</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputMae" name="inputMae" value="<?php echo $mae ?>" onkeyup="maiuscula(this)">
                            </div>
                            <label for="inputProfissaoMae" class="col-sm-2 col-sm-offset-1 control-label">Profissão da Mãe</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="inputProfissaoMae" name="inputProfissaoMae" value="<?php echo $profissao_mae ?>" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="">
                        <div class="form-group col-sm-12"> 
                            <label for="inputEndereco" class="col-sm-2 control-label">Endereço</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="inputEndereco" name="inputEndereco" value="<?php echo $endereco ?>" >
                            </div>                             
                        </div>
                    </div>
                    <div class="row" >
                        <div class="form-group col-sm-12"> 
                            <label for="inputCidade" class="col-sm-2 control-label">Cidade</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputCidade" name="inputCidade" value="<?php echo $cidade ?>" >
                            </div>             
                            <label for="inputEstado_Cidade" class="col-sm-2  col-lg-offset-3  control-label">Estado</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="inputEstado_Cidade" name="inputEstado_Cidade" value="<?php echo $estado_cidade; ?>" onkeyup="maiuscula(this)">
                            </div>   
                        </div>
                    </div>  
                    <div class="row" id="oito">
                        <div class="form-group col-sm-12"> 
                            <label for="inputDeclaracao" class="col-sm-2 control-label">Declaracao</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="" name="" value="<?php echo $declaracao ?>">
                            </div>       
                            <label for="inputResponsavel" class="col-sm-1 control-label">Responsável</label>
                            <div class="col-sm-3">
                                <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputNome" name="inputResponsavel" value="<?php echo $responsavel_declacao ?>">
                            </div>
                            <label for="inputDataDeclaracao" class="col-sm-1 col-sm-offset-1 control-label">Data</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputDataDeclaracao" name="inputDataDeclaracao" value="<?php echo $data_declaracao_convertida ?>">
                            </div>
                        </div>
                    </div>                    
                    <div class="row" id="nove">
                        <div class="form-group col-sm-12"> 
                            <label for="inputTransferencia" class="col-sm-2 control-label">Transferência</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputDataTr" name="inputDataTransferencia" value="<?php echo $transferencia ?>">
                            </div>               
                            <label for="inputResponsavel" class="col-sm-1 control-label">Responsável</label>
                            <div class="col-sm-3">
                                <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputNome" name="inputResponsavel" value="<?php echo $responsavel_transferencia ?>">
                            </div>
                            <label for="inputDataTransferencia" class="col-sm-1 col-sm-offset-1 control-label">Data</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputDataTransferencia" name="inputDataTransferencia" value="<?php echo $data_transferencia_convertida ?>">
                            </div>
                            
                        </div>
                    </div>
                    <div class="row" id="dez">
                        <div class="form-group col-sm-12"> 
                            <label for="inputTransporte" class="col-sm-2 control-label">Transporte</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputTransporte" name="inputTransporte" value="<?php echo $transporte ?>" >
                            </div>
                            <label for="inputMotorista" class="col-sm-1  control-label">Motorista</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="inputMotorista" name="inputMotorista" value="<?php echo $motorista ?>" >
                            </div>
                            <label for="inputMotorista2" class="col-sm-1 control-label">Motorista II</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="inputMotorista2" name="inputMotorista2" value="<?php echo $motorista2 ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row" id="onze">
                        <div class="form-group col-sm-12">
                            <label for="inputDataRenovacaoMatricula" class="col-sm-2 control-label">Renovação da Matricula</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputDataRenovacaoMatricula" name="inputDataRenovacaoMatricula" value="<?php echo $data_renovacao_matricula ?>">
                            </div>
                            <label for="inputMatricula" class="col-sm-2 col-sm-offset-4 control-label">Data da Matricula</label>
                            <div class="col-sm-2">
                                <input disabled="" type="text" class="form-control" id="inputExpedicao" name="inputMatricula" value="<?php echo date_format($inputMatricula, 'd/m/Y') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputTextArea" class=" control-label col-sm-2">Observações:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" id="inputTextArea" name="inputTextArea"><?php echo "$inputTextArea"; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="doze">
                        <div class="form-group col-sm-12">
                            <div class="col-sm-2 col-sm-offset-2">
                                <a href="javascript:history.back()" class="btn btn-primary">Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html> 