<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>
<?php
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
$data_nascimento = new DateTime($Registro["data_nascimento"]);
$data_nascimento = date_format($data_nascimento, 'Y-m-d');
$fone = $Registro["fone"];
$fone2 = $Registro["fone2"];

$modelo_certidao = $Registro["modelo_certidao"];

$matricula = $Registro["matricula_certidao"];

$tipos_de_certidao = $Registro["tipos_de_certidao"];

$certidao = $Registro["certidao_civil"];

//echo"$modelo_certidao";
//
//echo"$tipos_de_certidao";
//
//echo"$matricula";
//
//echo"$certidao";

$expedicao = $Registro["data_expedicao"];
$naturalidade = $Registro["naturalidade"];
$estado = $Registro["estado"];
$nacionalidade = $Registro["nacionalidade"];
$sexo = $Registro["sexo"];
$nis = $Registro["nis"];
$bolsa_familia = $Registro["bolsa_familia"];
$sus = $Registro["sus"];
$necessidades = $Registro["necessidades"];
$pai = $Registro["pai"];
$profissao_pai = $Registro["profissao_pai"];
$mae = $Registro["mae"];
$profissao_mae = $Registro["profissao_mae"];
$endereco = $Registro["endereco"];
$cidade = $Registro["cidade"];
$estado_cidade = $Registro["estado_cidade"];
$transporte = $Registro["transporte"];
$cor = $Registro["cor_raca"];
$motorista = $Registro["motorista"];
$motorista2 = $Registro["motorista2"];
$declaracao = $Registro["declaracao"];
$data_declaracao = ($Registro["data_declaracao"]);
$data_declaracao_convertida = "";

if ($data_declaracao == "0000-00-00") {
    $data_declaracao_convertida = "- - - - - - - - ";
} else {
    $data_declaracao = new DateTime($Registro["data_declaracao"]);
    $data_declaracao_convertida = date_format($data_declaracao, 'd/m/Y');
}
$transferencia = $Registro["transferencia"];
$data_transferencia = new DateTime($Registro["data_transferencia"]);
$responsavel_declacao = $Registro["responsavel_declaracao"];
$responsavel_transferencia = $Registro["responsavel_transferencia"];
$inputTextArea = $Registro["obs"];
$inputMatricula = new DateTime($Registro["Data_matricula"]);
$data_renovacao_matricula = $Registro["data_renovacao_matricula"];
$status = $Registro["status"];
$excluido = $Registro["excluido"];
?>
<html lang = "pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title>UPDATE DE ALUNO</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="css/cadastrar.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>

        <h3 style="text-align: center;">ATUALIZAR O CADASTRO DE ALUNO</h3>
        <div class="container-fluid">
            <form name="cadastrar" action="matricular_update.php" method="post" class="form-horizontal" onsubmit="return validar()" onkeyup="maiuscula(this)">
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputTurma" class="col-sm-2 control-label">Turma</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputTurma" id="inputTurma">
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` ORDER BY turma");
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $turma_linha = $Registro["turma"];
                                    $turno_linha = $Registro["turno"];
                                    $txt_option = "$turma_linha ($turno_linha)";

                                    if ($turma == $txt_option) {
                                        echo "<option selected>$txt_option</option>";
                                    } else {
                                        echo "<option>$txt_option</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>                   
                        <label for="inputstatus" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputstatus" id="inputstatus">
                                <?php
                                $txt_option_status3 = "ADIMITIDO DEPOIS";
                                $txt_option_status = "CURSANDO";
                                $txt_option_status4 = "DESISTENTE";
                                $txt_option_status2 = "TRANSFERIDO";

                                if ($status == "CURSANDO") {
                                    echo "<option selected>$txt_option_status</option>";
                                    echo "<option>$txt_option_status2</option>";
                                    echo "<option>$txt_option_status3</option>";
                                    echo "<option>$txt_option_status4</option>";
                                } elseif ($status == "TRANSFERIDO") {
                                    echo "<option selected>$txt_option_status2</option>";
                                    echo "<option>$txt_option_status</option>";
                                    echo "<option>$txt_option_status3</option>";
                                    echo "<option>$txt_option_status4</option>";
                                } elseif ($status == "ADIMITIDO DEPOIS") {
                                    echo "<option selected>$txt_option_status3</option>";
                                    echo "<option>$txt_option_status</option>";
                                    echo "<option>$txt_option_status2</option>";
                                    echo "<option>$txt_option_status4</option>";
                                } else {
                                    echo "<option selected>$txt_option_status4</option>";
                                    echo "<option>$txt_option_status</option>";
                                    echo "<option>$txt_option_status2</option>";
                                    echo "<option>$txt_option_status3</option>";
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
                            <input type="text" class="form-control" id="inputNome" name="inputNome" value="<?php echo $nome ?>" onkeyup="maiuscula(this)">
                        </div>
                        <label for="inputNascimento" class="col-sm-2 control-label">Nascimento</label>
                        <div class="col-sm-4">
                            <script type="text/javascript">
                                $(function () {
                                    $("#").mask("99/99/9999");
                                });
                            </script>
                            <input id="inputNascimento" type="date" class="form-control" name="inputNascimento" value="<?php echo $data_nascimento; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputInep" class="col-sm-2 control-label">Nº INEP</label>
                        <div class="col-sm-4">                            
                            <input id="inputInep" type="number" min= '0'  max = '999999999999' step= "1" pattern="[0-9]+$"  class="form-control" name="inputInep" placeholder="Use Somente Números" value="<?php echo $inep; ?>">
                        </div >              
                        <label for="inputFone" class="col-sm-2 control-label">Fones</label>
                        <div class="col-sm-2">
                            <script type="text/javascript">
                                $(function () {
                                    $("#inputFone").mask("99-99999-9999");
                                });
                            </script>
                            <input id="inputFone" type="text" class="form-control" name="inputFone" placeholder="XX-XXXXX-XXXX" value="<?php echo $fone; ?>">
                        </div>
                        <div class="col-sm-2">                                   
                            <input id="inputFone2" type="text" class="form-control" name="inputFone2" placeholder="XX-XXXXX-XXXX" value="<?php echo $fone2; ?>">
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputTiposCertidao" class="col-sm-2 control-label">Tipos de Certidão Civil</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputTiposCertidao" id="inputTiposCertidao">
                                <?php
                                $txt_option = "NASCIMENTO";
                                $txt_option2 = "CASAMENTO";
                                $txt_option3 = "RG";

                                if ($tipos_de_certidao == $txt_option) {
                                    echo "<option selected>$txt_option</option>";
                                    echo "<option>$txt_option2</option>";
                                    echo "<option>$txt_option3<option>";
                                } elseif ($tipos_de_certidao == "$txt_option2") {
                                    echo "<option selected>$txt_option2</option>";
                                    echo "<option>$txt_option</option>";
                                    echo "<option>$txt_option3</option>";
                                } else {
                                    echo "<option selected>$txt_option3</option>";
                                    echo "<option>$txt_option</option>";
                                    echo "<option>$txt_option2 </option>";
                                }
                                ?>   
                            </select>
                        </div>
                        <div id = "matricula">
                            <label for="inputMatricula" class="col-sm-2 control-label">Matricula</label>
                            <div class="col-sm-4" id = "inputMatricula">
                                <input type="text" class="form-control" name="inputMatricula" placeholder="XXXXXXXXXX XXXX X XXXXX XXX XXXXXXX XX" value="<?php echo $matricula ?>">
                            </div>
                        </div>
                        <div id = "dados">
                            <label for="inputCertidao" class="col-sm-2 control-label">Dados da Certidão</label>
                            <div class="col-sm-4" id = "">
                                <input type="text" class="form-control" id="dados_nao_Rg" name="inputCertidao" onkeyup="maiuscula(this)" placeholder="Termo N°XXX, FLS:xxx, Livro: xx." value="<?php echo $certidao ?>">
                            </div>                                    
                        </div>
                        <div id = "dados_Rg">
                            <label for="inputCertidao" class="col-sm-2 control-label">Dados do RG</label>
                            <div class="col-sm-4" >
                                <input type="text" class="form-control" id="dados_Rg2" name="inputCertidao" onkeyup="maiuscula(this)" placeholder="N°/Órgão Emissor/UF" value="<?php echo $certidao ?>">
                            </div>                                    
                        </div>
                    </div>
                </div>                       
                <div class="row" id="dois">
                    <div class="form-group col-sm-12">
                        <label for="InputModelo_certidao" class="col-sm-2 control-label">Modelo da Certidão</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="InputModelo_certidao" id="InputModelo_certidao">
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
                            <select class="form-control" name="InputModelo_certidao" id="InputModelo_certidao_2">
                                <option value="VELHO"  >VELHO</option>
                            </select>
                        </div>                                
                        <label for="inputExpedicao" class="col-sm-2 control-label">Expedição</label>
                        <div class="col-sm-4">                                   
                            <input type="date" class="form-control" id="inputExpedicao" name="inputExpedicao" value="<?php echo $expedicao ?>">
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                       // $('#dados_Rg').hide();
                        $('#dados_Rg2').attr('disabled', 'disabled');
                        $('#dados').hide();
                        $('#InputModelo_certidao_2').hide();
                        $('#InputModelo_certidao_2').attr('disabled', 'disabled');

                        $('#inputTiposCertidao').change(function () {

                            if ($('#inputTiposCertidao').val() == 'RG') {

                                $('#matricula').hide();

                                $('#dados').hide();
                                $('#dados_nao_Rg').attr('disabled', 'disabled');

                                $('#dados_Rg').show();
                                $('#dados_Rg2').removeAttr('disabled')

                                $('#InputModelo_certidao').attr('disabled', 'disabled');
                                $('#InputModelo_certidao_2').removeAttr('disabled');
                                $('#InputModelo_certidao').hide();
                                $('#InputModelo_certidao_2').show();

                            } else {
                                $('#dados').hide();
                                $('#matricula').show();
                                $('#dados_Rg').hide();
                                $('#dados_Rg2').attr('disabled', 'disabled');

                                $('#dados_nao_Rg').removeAttr('disabled');

                                $('#InputModelo_certidao').removeAttr('disabled');
                                $('#InputModelo_certidao').show();
                                $('#InputModelo_certidao_2').hide();

                                limpa();
                            }
                        });
                    });
                </script>

                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputNaturalidade" class="col-sm-2 control-label">Naturalidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputNaturalidade" name="inputNaturalidade" value="<?php echo $naturalidade ?>" onkeyup="maiuscula(this)">
                        </div>
                        <label for="inputEstado" class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputEstado" name="inputEstado" value="<?php echo $estado ?>" onkeyup="maiuscula(this)">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputNacionalidade" class="col-sm-2 control-label">Nacionalidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputNacionalidade" name="inputNacionalidade" value="<?php echo $nacionalidade ?>" onkeyup="maiuscula(this)">
                        </div>                        
                        <label for="inputSexo" class="col-sm-2  control-label">Sexo</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputSexo" id="inputSexo">
                                <?php
                                $txt_option_sexo = "MASCULINO";
                                $txt_option_sexo2 = "FEMININO";

                                if ($sexo == "M") {
                                    echo "<option selected>$txt_option_sexo</option>";
                                    echo "<option>$txt_option_sexo2</option>";
                                } else {
                                    echo "<option selected>$txt_option_sexo2</option>";
                                    echo "<option>$txt_option_sexo</option>";
                                }
                                ?>     
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12" >
                        <label for="inputNIS" class="col-sm-2 control-label">NIS</label>
                        <div class="col-sm-4">
                            <script type="text/javascript" >
                                $(function () {
                                    $("#inputNIS").mask("999.9999.9999", {reverse: true});
                                });
                            </script>
                            <input type="text" class="form-control" id="inputNIS" name="inputNIS" value="<?php echo $nis ?>">
                        </div>                    
                        <label for="inputBolsa_familia" class="col-sm-2 control-label">Bolsa Família</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputBolsa_familia" id="inputSexo">
                                <?php
                                $txt_option_nis = "SIM";
                                $txt_option_nis2 = "NÃO";
                                $txt_option_nis3 = "---";

                                if ($bolsa_familia == "SIM") {
                                    echo "<option selected>$txt_option_nis</option>";
                                    echo "<option>$txt_option_nis2</option>";
                                    echo "<option>$txt_option_nis3</option>";
                                } elseif ($bolsa_familia == "NÃO") {
                                    echo "<option selected>$txt_option_nis2</option>";
                                    echo "<option>$txt_option_nis</option>";
                                    echo "<option>$txt_option_nis3</option>";
                                } else {
                                    echo "<option selected>$txt_option_nis3</option>";
                                    echo "<option>$txt_option_nis</option>";
                                    echo "<option>$txt_option_nis2</option>";
                                }
                                ?>     
                            </select>
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputSUS" class="col-sm-2 control-label">SUS</label>
                        <div class="col-sm-4">
                            <script type="text/javascript" >
                                $(function () {
                                    $("#inputSUS").mask("999.9999.9999.9999");
                                });
                            </script>
                            <input type="text" class="form-control" id="inputSUS" name="inputSUS" value="<?php echo $sus ?>">
                        </div>
                        <label for="inputNecessidades" class="col-sm-2 control-label">Necessidasdes Especiais</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputNecessidades" name="inputNecessidades" value="<?php echo $necessidades ?>" onkeyup="maiuscula(this)" >
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputPai" class="col-sm-2 control-label">Nome do Pai</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputPai" name="inputPai" value="<?php echo $pai ?>" onkeyup="maiuscula(this)">
                        </div>
                        <label for="inputProfissaoPai" class="col-sm-2 control-label">Profissão</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputProfissaoPai" name="inputProfissaoPai" value="<?php echo $profissao_pai ?>" onkeyup="maiuscula(this)">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputMae" class="col-sm-2 control-label">Nome da Mãe</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputMae" name="inputMae" value="<?php echo $mae ?>" onkeyup="maiuscula(this)">
                        </div>
                        <label for="inputProfissaoMae" class="col-sm-2 control-label">Profissão</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputProfissaoMae" name="inputProfissaoMae" value="<?php echo $profissao_mae ?>" onkeyup="maiuscula(this)">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputEndereco" class="col-sm-2 control-label">Endereço</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputEndereco" name="inputEndereco" value="<?php echo $endereco ?>" onkeyup="maiuscula(this)">
                        </div>                          
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputCidade" class="col-sm-2 control-label">Cidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputCidade" name="inputCidade" value="<?php echo $cidade ?>" onkeyup="maiuscula(this)">
                        </div>
                        <label for="inputEstado_Cidade" class="col-sm-2  control-label">Estado</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputEstado_Cidade" name="inputEstado_Cidade" value="<?php echo $estado_cidade; ?>" onkeyup="maiuscula(this)">
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputTransporte" class="col-sm-2 control-label">Transporte</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputTransporte" id="inputTransporte">
                                <?php
                                $txt_option_transporte = "SIM";
                                $txt_option_transporte2 = "NÃO";

                                if ($transporte == "SIM") {
                                    echo "<option selected>$txt_option_transporte</option>";
                                    echo "<option>$txt_option_transporte2</option>";
                                } else {
                                    echo "<option selected>$txt_option_transporte2</option>";
                                    echo "<option>$txt_option_transporte</option>";
                                }
                                ?>    
                            </select>
                        </div>
                        <label for="inputCor" class="col-sm-2 control-label">Cor/Raça</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputCor" name="inputCor" value="<?php echo $cor; ?>" onkeyup="maiuscula(this)" >
                        </div>  
                    </div>
                </div>
                <div class="row" id="motoristas">
                    <div class="form-group col-sm-12">
                        <label for="inputMotorista" class="col-sm-2 control-label">Motorista</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputMotorista" id="inputMotorista" >
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE funcao = 'MOTORISTA' AND excluido = 'N' ORDER BY nome");
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $motorista3 = $Registro["nome"];
                                    if ($motorista == $motorista3) {
                                        echo "<option selected>$motorista3</option>";
                                        // echo "<option>--------</option>";
                                    } elseif ($motorista == "--------") {
                                        echo "<option selected>--------</option>";
                                        echo "<option>$motorista3</option>";
                                    } else {
                                        echo "<option>--------</option>";
                                        echo "<option>$motorista3</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <label for="inputMotorista2" class="col-sm-2 control-label">Motorista II</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputMotorista2" id="inputMotorista2" >
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE funcao = 'MOTORISTA' AND excluido = 'N' ORDER BY nome");
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $motorista4 = $Registro["nome"];
                                    if ($motorista2 == $motorista4) {
                                        echo "<option selected>$motorista4</option>";
                                        // echo "<option>--------</option>";
                                    } elseif ($motorista2 == "--------") {
                                        echo "<option selected>--------</option>";
                                        echo "<option>$motorista4</option>";
                                    } else {
                                        echo "<option>--------</option>";
                                        echo "<option>$motorista4</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputDeclaracao" class="col-sm-2 control-label">Declaração</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputDeclaracao" id="inputDeclaracao">
                                <?php
                                $txt_option_declaracao = "SIM";
                                $txt_option_declaracao2 = "NÃO";
                                $txt_option_declaracao3 = "---";

                                if ($declaracao == "SIM") {
                                    echo "<option selected>$txt_option_declaracao</option>";
                                    echo "<option>$txt_option_declaracao2</option>";
                                    echo "<option>$txt_option_declaracao3</option>";
                                } elseif ($declaracao == "NÃO") {
                                    echo "<option selected>$txt_option_declaracao2</option>";
                                    echo "<option>$txt_option_declaracao</option>";
                                    echo "<option>$txt_option_nis3</option>";
                                } else {
                                    echo "<option selected>$txt_option_declaracao3</option>";
                                    echo "<option>$txt_option_declaracao</option>";
                                    echo "<option>$txt_option_declaracao2</option>";
                                }
                                ?>     
                            </select> 
                        </div>
                        <div id="data_declaracao">
                            <label for="inputDataDeclaracao" class="col-sm-2 control-label">Data</label>
                            <div class="col-sm-4">                            
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputDataDeclaracao").mask("99/99/9999");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputDataDeclaracao" name="inputDataDeclaracao"  value="<?php echo$data_declaracao_convertida ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="responsavel_declaracao">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputResponsavelDeclaracao" class="col-sm-2 control-label">Responsável pela Declaração</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputResponsavelDeclaracao" name="inputResponsavelDeclaracao" value="<?php echo $responsavel_declacao; ?>" onkeyup="maiuscula(this)">
                            </div>
                        </div>                   
                    </div>
                </div>
                <div class="row"> 
                    <div class="form-group col-sm-12">
                        <label for="inputTransferencia" class="col-sm-2 control-label">Transferência</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="inputTransferencia" id="inputTransferencia">
                                <?php
                                $txt_option_transferencia = "SIM";
                                $txt_option_transferencia2 = "NÃO";
                                $txt_option_transferencia3 = "---";

                                if ($transferencia == "SIM") {
                                    echo "<option selected>$txt_option_transferencia</option>";
                                    echo "<option>$txt_option_transferencia2</option>";
                                    echo "<option>$txt_option_transferencia3</option>";
                                } elseif ($transferencia == "NÃO") {
                                    echo "<option selected>$txt_option_transferencia2</option>";
                                    echo "<option>$txt_option_transferencia</option>";
                                    echo "<option>$txt_option_transferencia3</option>";
                                } else {
                                    echo "<option selected>$txt_option_transferencia3</option>";
                                    echo "<option>$txt_option_transferencia</option>";
                                    echo "<option>$txt_option_transferencia2</option>";
                                }
                                ?>     
                            </select>
                        </div>
                        <div id="data_transferencia">
                            <label for="inputDataTransferencia" class="col-sm-2  control-label">Data</label>
                            <div class="col-sm-4" >
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputDataTransferencia").mask("99/99/9999");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputDataTransferencia" name="inputDataTransferencia" value="<?php echo date_format($data_transferencia, 'd/m/Y'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="responsavel_transferencia">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputResponsavelTransferencia" class="col-sm-2 control-label">Responsável:Transferência</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputResponsavelTransferencia" name="inputResponsavelTransferencia" value="<?php echo "$responsavel_transferencia"; ?>" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputMatricula" class="col-sm-2  control-label">Data da Matricula</label>
                        <div class="col-sm-4">
                            <input disabled="" type="text" class="form-control" id="inputExpedicao" name="inputMatricula" value="<?php echo date_format($inputMatricula, 'd/m/Y') ?>">
                        </div>
                        <label for="inputDataRenovacaoMatricula" class="col-sm-2 control-label">Renovação da Matricula</label>
                        <div class="col-sm-4">
                            <script type="text/javascript">
                                $(function () {
                                    $("#inputDataRenovacaoMatricula").mask("99/99/9999");
                                });
                            </script>                         
                            <input type="text" class="form-control" id="inputDataRenovacaoMatricula" name="inputDataRenovacaoMatricula" value="<?php echo $data_renovacao_matricula ?>">
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
                <div class="row">
                    <div class="form-group col-sm-12">
                        <div class=" col-sm-4 col-sm-offset-2">
                            <button type="submit"  tipo class="btn btn-success" onclick="return confirmarAtualizacao()">Atualizar</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label  for="inputId" class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <input type="hidden" class="form-control" id="inputId" name="inputIdUpdate" value="<?php echo base64_Decode($Recebe_id) ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body> 
<script type="text/javascript">
    function limpa() {
        $('#InputModelo_certidao').val('NOVO');

    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        if ($('#inputstatus').val() == ('CURSANDO')) {
            $('#Arquivado').hide();
        } else if ($('#inputstatus').val() == ('ADIMITIDO DEPOIS')) {
            $('#Arquivado').hide();
        } else {
            $('#Arquivado').show();
        }
    });
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
<script type="text/javascript">
    //Esconder matricula no caso  de RG e mostra dados RG
    $(document).ready(function () {   

            if ($('#inputTiposCertidao').val() == 'RG') {
                  $('#dados_Rg').show();
                //$('#dados').show();
                $('#matricula').hide();
                $('#dados_Rg2').removeAttr('disabled')

            } else {
                $('#matricula').show();
                $('#dados_Rg').hide();
            }       
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        if ($('#inputTransporte').val() == 'SIM') {
            $('#motoristas').show();
        } else {
            $('#motoristas').hide();
        }
        $('#inputTransporte').change(function () {
            if ($('#inputTransporte').val() == 'SIM') {
                $('#motoristas').show();
            } else {
                $('#motoristas').hide();

            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        if ($('#inputDeclaracao').val() == 'SIM') {
            $('#data_declaracao').show();
            $('#responsavel_declaracao').show();
        } else {
            $('#data_declaracao').hide();
            $('#responsavel_declaracao').hide();
        }

        $('#inputDeclaracao').change(function () {
            if ($('#inputDeclaracao').val() == 'SIM') {
                $('#data_declaracao').show();
                $('#responsavel_declaracao').show();
            } else {
                $('#data_declaracao').hide();
                $('#responsavel_declaracao').hide();
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        if ($('#inputTransferencia').val() == 'SIM') {
            $('#data_transferencia').show();
            $('#responsavel_transferencia').show();
        } else {
            $('#data_transferencia').hide();
            $('#responsavel_transferencia').hide();
        }

        $('#inputTransferencia').change(function () {
            if ($('#inputTransferencia').val() == 'SIM') {
                $('#data_transferencia').show();
                $('#responsavel_transferencia').show();
            } else {
                $('#data_transferencia').hide();
                $('#responsavel_transferencia').hide();
            }
        });
    });
</script>
<script type="text/javascript">
    function confirmarAtualizacao() {
        var r = confirm("Realmente deseja atualizar os dados do Aluno?");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
<script type="text/javascript">
    $('input').on("input", function (e) {
        $(this).val($(this).val().replace('"', ""));
        $(this).val($(this).val().replace("'", ""));

    });
</script>
</html>
