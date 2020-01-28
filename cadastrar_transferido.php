<?php
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores da URL (Método GET)
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$M = "";
$Msg = "";
$id_session = "";
if ($Recebe_id == "1") {
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Alterações Realizadas com Sucesso! </div>";
    $M = "1";
} elseif ($Recebe_id == "2") {
//
    session_start();
    $id_session = base64_encode($_SESSION['id']);
    $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "$usuario_logado! Esse aluno(a) já Consta na Base de Dados. </div>";
    $M = "2";
}
?>
<html lang="pt-br">
    <head>
        <title>CADASTRO DE ALUNOS)</title> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        include_once 'head.php';
        ?>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>          
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">  
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
                    <h3 style="text-align: center">CADASTRO DE ALUNO </h3>
                    <p style="text-align:center; margin-top:-12px;  color: orange">(Obs: Esses Formulário se Refere aos Documentos Que o Aluno(a) Fornece a Escola:)</p>
                    <!--MODAL MSG-->
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
                                    <a href="pesquisar_no_banco.php?id=<?php echo "$id_session"; ?>"><button type="button" class="btn btn-danger" >Ir para O Aluno Em Quetão?</button></a>
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Tentar Novamente</button>                                   
                                    <?php
                                    if ($Recebe_id == "2") {
                                        session_destroy();
                                    }
                                    ?>
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
                    } elseif ($M == "2") {
                        echo"<script type='text/javascript'>
                    $(document).ready(function () {
                    $('#exemplomodal').modal('show');
                     });
                              </script>";
                    }
                    ?>
                    <form name="cadastrar_transferido" action="cadastrar_transferido_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                        <div class="row" id="um">
                            <div class="form-group col-sm-12">
                                <label for="Turma" class="col-sm-2 control-label">Turma</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputTurma" id="inputTurma" required="Esse Campo não Pode Ficar em Branco!">
                                        <?php
                                        $ano = date('Y');
                                        $ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
                                        $ano_futuro = date('Y', strtotime('+362 days', strtotime($ano)));
                                        //
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma_extra` = 'NÃO' ORDER BY `turmas`.`ano` DESC,turma ASC ");
                                        $Linha = mysqli_num_rows($Consulta);
                                        if ($Linha > 0) {
                                            echo "<option disabled = '' selected = '' value = ''>SELECIONE A TURMA AQUI ! </option>";
                                            while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                //
                                                $turma = $Registro["turma"];
                                                $turno = $Registro["turno"];
                                                $id_turma = $Registro["id"];
                                                $unico_turma = $Registro["unico"];
                                                $ano_turma = substr($Registro["ano"], 0, -6);
                                                //
                                                $ConsultaCont = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = $id_turma  AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N' GROUP BY turmas.id ");
                                                $linhaCont = mysqli_fetch_array($ConsultaCont);
                                                $qtd = $linhaCont['qtd'];

                                                //
                                                if ($ano_turma == "2018") {
                                                    $unico_turma = "";
                                                } else {
                                                    $unico_turma = $Registro["unico"];
                                                }
                                                //
                                                if ($ano_turma == "$ano_futuro") {
                                                    echo "<option value = '$id_turma'>$turma $unico_turma ($turno) $ano_futuro - Ano Futuro; Matriculados : $qtd </option>";
                                                } elseif ($ano_turma == "$ano") {
                                                    echo "<option value = '$id_turma'>$turma $unico_turma ($turno)  $ano - Ano Presente; Matriculados : $qtd</option>";
                                                } else {
                                                    echo "<option value = '$id_turma' disabled = ''>$turma  $unico_turma ($turno) $ano_passado - Ano(s) Passado(s); Matriculados : $qtd</option>";
                                                }
                                            }
                                        } else {
                                            echo "<option disabled selected>NÃO EXISTE TURMA CRIADA PARA ESSE ANO LETIVO!</option>";
                                        }
                                        ?>
                                    </select>                                   
                                </div>                                
                                <label for="inputInep" class="col-sm-2 control-label">Nº INEP</label>
                                <div class="col-sm-4">                            
                                    <input id="inputInep" type="number" min= '0'  max = '9999999999999' step= "1" pattern="[0-9]+$"  class="form-control" name="inputInep" placeholder="Use Somente Números" value="<?php echo $inep; ?>">
                                </div > 
                            </div>
                        </div>    
                        <div class="row">
                            <div class="form-group col-sm-12"> 
                                <label for="" class="col-sm-2 control-label">Ouvinte</label>    
                                <div class="col-sm-4">                                                                  
                                    <label class="radio-inline"><input type="radio" name="optOuvinte"  value="SIM">SIM</label>                                   
                                    <label class="radio-inline"><input type="radio" name="optOuvinte" value="NÃO" checked = ""><b>NÃO</b></label>                       
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O NOME DO ESTUDANTE" class="form-control"  name= "inputNome" id= "inputNome"  required = ""  onkeyup="maiuscula(this)" onblur="nome()">
                                </div>
                                <label for="Nascimento"  class="col-sm-2 control-label">Nascimento</label>
                                <div class="col-sm-4">
                                    <input id="inputNascimento" type="date" class="form-control" onblur="idade()" name="inputNascimento" >                                  
                                </div>  
                            </div>
                        </div>                      
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputTiposCertidao" class="col-sm-2 control-label">Certidão Civil</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputTiposCertidao" id="inputTiposCertidao">
                                        <option value="NASCIMENTO">NASCIMENTO</option>
                                        <option value="CASAMENTO">CASAMENTO</option>                                    
                                    </select>
                                </div>   
                                <label for="inputMatricula" class="col-sm-2 control-label">Matricula da Certidão</label>
                                <div class="col-sm-4" id = "">
                                    <input type="text" class="form-control" name="inputMatricula" placeholder="XXXXXXXXXX  XXXX  X  XXXXX  XXX  XXXXXXX  XX" >
                                </div>                                                                                          
                            </div>
                        </div>        
                        <div class="row" id="tres">
                            <div class="form-group col-sm-12">                                                      
                                <label for="InputModelo_certidao" class="col-sm-2  control-label">Modelo da Certidão</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="InputModelo_certidao" id="InputModelo_certidao">
                                        <option value="NOVO">NOVO</option>
                                        <option value="VELHO">VELHO</option>
                                    </select>                                   
                                </div>                             
                                <label for="inputCertidao" class="col-sm-2 control-label">Dados da Certidão</label>
                                <div class="col-sm-4" id = "">
                                    <input type="text" class="form-control" id="" name="inputCertidao" onkeyup="maiuscula(this)" placeholder="Termo N° XXX,  FLS: xxx,  Livro: xx.">
                                </div>                        
                            </div>
                        </div>
                        <div class="row" id="tres">
                            <div class="form-group col-sm-12">                                                     
                                <label for="inputExpedicao" class="col-sm-2 control-label">Expedição</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="inputExpedicao" name="inputExpedicao" >
                                </div>                             
                            </div>
                        </div>
                        <div class="row" id="quatro">
                            <div class="form-group col-sm-12">                            
                                <label for="inputNaturalidade" class="col-sm-2 control-label ">Naturalidade</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputNaturalidade" name="inputNaturalidade" onkeyup="maiuscula(this)">
                                </div>                         
                                <label for="inputEstado" class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputEstado" name="inputEstado" onkeyup="maiuscula(this)">
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12"> 
                                <label for="inputNacionalidade" class="col-sm-2 control-label">Nacionalidade</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputNacionalidade" name="inputNacionalidade" onkeyup="maiuscula(this)" >
                                </div> 
                                <label for="inputSexo" class="col-sm-2  control-label">Sexo</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputSexo" id="inputSexo">
                                        <option value="M">MASCULINO</option>
                                        <option value="F">FEMININO</option>
                                    </select>
                                </div>      
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12"> 
                                <label for="inputNIS" class="col-sm-2 control-label">NIS</label>
                                <div class="col-sm-4">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputNIS").mask("999.9999.9999", {reverse: true});
                                        });
                                    </script>
                                    <input  class="form-control" id="inputNIS" name="inputNIS" >
                                </div>
                                <label for="inputBolsaFamilia" class="col-sm-2 control-label ">Bolsa Família</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputBolsaFamilia" id="inputBolsaFamilia">
                                        <option value="NÃO">---</option>
                                        <option>SIM</option>
                                        <option>NÃO</option>
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
                                    <input type="text" class="form-control" id="inputSUS" name="inputSUS" >
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">                          
                                <label for="inputNecessidades" class="col-sm-2 control-label">Necessidasdes Especiais</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="inputNecessidades" name="inputNecessidades" onkeyup="maiuscula(this)">
                                        <option value="NÃO">---</option>
                                        <option value="NÃO">NÃO</option>
                                        <option value="SIM">SIM</option>
                                    </select>  
                                </div>
                                <label for="" class="col-sm-2 control-label">Especificidades</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control"  name="especificidades" onkeyup="maiuscula(this)" >
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">                          
                                <label for="inputPai" class="col-sm-2 control-label">Nome do Pai</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputPai" name="inputPai" onkeyup="maiuscula(this)" >
                                </div> 
                                <label for="inputProfissaoPai" class="col-sm-2 control-label">Profissão do Pai</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputProfissaoPai" name="inputProfissaoPai" onkeyup="maiuscula(this)">
                                </div>               
                            </div>
                        </div>
                        <div class="row" id="seis">
                            <div class="form-group col-sm-12">      
                                <label for="inputMae" class="col-sm-2 control-label">Nome da Mãe</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputMae" name="inputMae" onkeyup="maiuscula(this)" >
                                </div>
                                <label for="inputProfissaoMae" class="col-sm-2 control-label">Profissão da Mãe</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputProfissaoMae" name="inputProfissaoMae" onkeyup="maiuscula(this)" >
                                </div>
                            </div>
                        </div>
                        <div class="row" id="sete">
                            <div class="form-group col-sm-12"> 
                                <label for="inputEndereco" class="col-sm-2 control-label">Endereço</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="inputEndereco" name="inputEndereco" onkeyup="maiuscula(this)" >
                                </div>                                
                                <div class="col-sm-1" style="margin-top: -18px">                                  
                                    <label class="radio-inline"><input type="radio" name="optUrbano" checked value="SIM"><b>Urbano</b></label>                                   
                                    <label class="radio-inline"><input type="radio" name="optUrbano" value="NAO">Rural</label>                       
                                </div> 
                                <label for="inputFone" class="col-sm-2 control-label">Fones</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript">
                                        $(function () {
                                            $("#inputFone").mask("99-99999-9999");
                                        });
                                    </script>
                                    <input id="inputFone" type="text" class="form-control" name="inputFone" placeholder="XX-XXXXX-XXXX" >
                                </div>
                                <div class="col-sm-2">   
                                    <script type="text/javascript">
                                        $(function () {
                                            $("#inputFone2").mask("99-99999-9999");
                                        });
                                    </script>                                
                                    <input id="inputFone2" type="text" class="form-control" name="inputFone2" placeholder="XX-XXXXX-XXXX" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="inputCidade" class="col-sm-2 control-label">Cidade</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputCidade" name="inputCidade" onkeyup="maiuscula(this)">
                                </div>
                                <label for="inputEstado_Cidade" class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputEstado_Cidade" name="inputEstado_Cidade" onkeyup="maiuscula(this)">
                                </div>    
                            </div>
                        </div>
                        <div class="row" id="sete">
                            <div class="form-group col-sm-12"> 
                                <label for="inputTransferencia" class="col-sm-2 control-label">Transferência/Declaração</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputTransferencia" id="inputTransferencia">
                                        <option value="----------">----------</option>
                                        <option value="DECLARAÇÃO">DECLARAÇÃO</option>
                                        <option value="TRANSFERÊNCIA">TRANSFERÊNCIA</option>
                                    </select>
                                </div>
                                <div id="DataTransferencia">
                                    <label for="inputDataTransferencia"  class="col-sm-2 control-label">Data</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" id="inputDataTransferencia" name="inputDataTransferencia" >
                                    </div>
                                </div>
                            </div>
                        </div>                  
                        <div class="row" id="Responsavel">
                            <div class="form-group col-sm-12">
                                <label for="inputResponsavel" class="col-sm-2 control-label">Responsável</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="inputResponsavel" name="inputResponsavel" onkeyup="maiuscula(this)">
                                </div>
                            </div>
                        </div>                    
                        <div class="row" id="sete">
                            <div class="form-group col-sm-12"> 
                                <label for="inputTransporte" class="col-sm-2 control-label">Transporte</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputTransporte" id="inputTransporte">
                                        <option value="NÃO">---</option>
                                        <option>SIM</option>
                                        <option>NÃO</option>
                                    </select>
                                </div>                                

                                <label for="inputCor" class="col-sm-2 control-label">Cor/Raça</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputCor" name="inputCor" onkeyup="maiuscula(this)" >
                                </div> 
                            </div> 
                        </div>
                        <div class="row" id="motoristas">
                            <div class="form-group col-sm-12">
                                <label for="inputMotorista" class="col-sm-2  control-label">Motorista</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputMotorista" id="inputMotorista" >
                                        <?php
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE funcao = 'MOTORISTA' ORDER BY nome");
                                        echo "<option disabled selected>SELECIONE O MOTORISTA ! </option>";
                                        echo "<option>--------</option>";
                                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                            $motorista = $Registro["nome"];
                                            echo "<option>$motorista</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputMotorista2" class="col-sm-2 control-label">Motorista II</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputMotorista2" id="inputMotorista2" >
                                        <?php
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE funcao = 'MOTORISTA' ORDER BY nome");
                                        echo "<option disabled selected>SELECIONE O MOTORISTA ! </option>";
                                        echo "<option>--------</option>";
                                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                            $motorista = $Registro["nome"];
                                            echo "<option>$motorista</option>";
                                        }
                                        ?>
                                    </select>
                                </div>  
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="inputPonto" class="col-sm-2 control-label">Pontos de Ônibus</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="" id="pontoOnibus" >
                                        <?php
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos_transporte`");
                                        echo "<option selected = '' value = ''>PONTOS DE ÔNIBUS CONHECIDOS</option>";
                                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                            $ponto_onibus = $Registro["ponto_onibus"];
                                            echo "<option>$ponto_onibus</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="" class="col-sm-2 control-label">O Aluno(a) Pega o Ônibus em:</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O LUGAR ESCOLHIDO OU OUTRO NOVO" class="form-control" id="inputPontoAluno" name="inputPontoAluno" onkeyup="maiuscula(this)">
                                </div>                             
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputTextArea" class=" control-label col-sm-2">Observações:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="4" id="inputTextArea" name="inputTextArea"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="oito">
                            <div class="form-group col-sm-12">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button type="submit" value="Enviar" class="btn btn-success btn-block" onclick="return confirmar()" >Matricular o Aluno(a) no Sistema</button>
                                </div>
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button type="reset" class="btn btn-danger btn-block">Limpar o Formulário</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        <script type="text/javascript">
            $(document).ready(function () {
                $('#pontoOnibus').change(function () {
                    var ponto = $('#pontoOnibus').val();
                    $('#inputPontoAluno').val(ponto);
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#DataTransferencia').hide();
                $('#Responsavel').hide();
                //
                $('#inputTransferencia').change(function () {
                    if ($('#inputTransferencia').val() !== '----------') {
                        $('#DataTransferencia').show();
                        $('#Responsavel').show();
                    } else {
                        $('#DataTransferencia').hide();
                        $('#Responsavel').hide();
                    }
                });
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
        <script>
            function idade() {
                var data = $('#inputNascimento').val();
                var turma = $('#inputTurma').val();
                if (data == "") {
                    alert('Esse Campo Não deve Ficar Em Branco, pois Causará Inconsistência no Relatório:)')
                } else {
                    $.ajax({
                        url: 'function_cadastrar_aluno.php',
                        type: 'POST',
                        data: {
                            'data': data,
                            'turma': turma
                        },
                        success: function (data)
                        {
                            $txt = JSON.parse(data);
                            var teste = $txt.msg;
                            alert(teste);
                        }
                    });
                }
            }
        </script>       
        <script type="text/javascript">
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
        </script>       
    </body>  
    <script type="text/javascript">
        function confirmar() {
            var u = "<?php echo $usuario_logado ?>";
            var r = confirm("Posso Enviar " + u + "? ");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <!--    <script type="text/javascript">
        function nome() {
            var x = document.getElementById("inputNome");
            if (x.value.length < 3) {
                alert("O campo Nome não pode ter menos de 3 letras");
            }
        }
    </script>    -->
    <script type="text/javascript">
        function validar() {
            var u = "<?php echo $usuario_logado ?>";
            if ($('#inputNome').val().length < 3) {
                alert(" " + u + " O Campo Nome Não Pode Ter menos de 3 letras !");
                return false;
            } else {
                return true;
            }
        }
    </script>
    <script type="text/javascript">
        $('input').on("input", function (e) {
            $(this).val($(this).val().replace('"', ""));
            $(this).val($(this).val().replace("'", ""));
            $(this).val($(this).val().replace(".", ""));
        });
    </script>
</html> 
