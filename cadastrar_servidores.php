<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>   
        <title>CADASTRO DE SERVIDORES</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <link href="css/cadastrar.css" rel="stylesheet" type="text/css"/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">             
                    <h3 style="text-align: center">CADASTRO DE SERVIDORES</h3>
                    <form name="cadastrar_servidores" action="cadastrar_servidores_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">Função</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputFuncao" id="inputFuncao">
                                        <?php
                                        $Consulta_funcao = mysqli_query($Conexao, "SELECT * FROM `funcoes` ");
                                        while ($Registro_funcao = mysqli_fetch_array($Consulta_funcao, MYSQLI_BOTH)) {
                                            $funcao_turno = $Registro_funcao["funcao"];
                                            echo "<option value = '$funcao_turno'>$funcao_turno</option>";
                                        }
                                        ?>                                     
                                    </select>
                                </div>
                                <label for="inputTurno" class="col-sm-2 control-label">Turno</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputTurno" id="inputTurno">
                                        <?php
                                        $Consulta_turno = mysqli_query($Conexao, "SELECT * FROM `turnos`");
                                        while ($Registro_turno = mysqli_fetch_array($Consulta_turno, MYSQLI_BOTH)) {
                                            $turno_turno = $Registro_turno["turno"];
                                            echo "<option>$turno_turno</option>";
                                        }
                                        ?>                          
                                    </select>
                                </div>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">Resumo da Função</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="1º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoFuncao" maxlength="11" >
                                </div>  
                                <div class="col-sm-2">
                                    <input type="text" placeholder="2º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoFuncao2" maxlength="11" >
                                </div>
                                <label for="" class="col-sm-2 control-label">Carga Horária</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="" class="form-control" id="" name="inputCarga_Horaria"  onkeyup="maiuscula(this)">
                                </div> 
                            </div>
                        </div>
                        <div class="row" id="turmas">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2  control-label">Mais de Uma Turma</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputResumoSim" id="inputResumoSim">
                                        <?php
                                        $txt_turma = "SIM";
                                        $txt_turma2 = "NÃO";

                                        if ($resumo_turmas_sim == $txt_turma) {
                                            echo "<option selected = '' value = 'SIM'> $txt_turma </option>";
                                            echo "<option> $txt_turma2 </option>";
                                        } else {
                                            echo "<option selected>$txt_turma2</option>";
                                            echo "<option value = 'SIM'>$txt_turma</option>";
                                        }
                                        ?>
                                    </select>
                                </div> 
                                <div class="resumo">
                                    <label for="" class="col-sm-2 control-label">Resumo das Anos</label>
                                    <div class="col-sm-2">
                                        <input type="text" placeholder="1º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoAnos" maxlength="10" >
                                    </div>  
                                    <div class="col-sm-2">
                                        <input type="text" placeholder="2º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoAnos2" maxlength="10" >
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="resumo">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="" class="col-sm-2 control-label">Resumo de Disciplinas</label>
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="1º Linha:Usada no Gerencial:)" class="form-control" id="" name="inputResumoDisciplinas" maxlength="15">
                                    </div>                       
                                    <label for="" class="col-sm-2 control-label">Resumo de Turmas</label>
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="1º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoTurmas" maxlength="10" >
                                    </div> 
                                </div>
                            </div>  
                        </div>   
                        <div class="row">
                            <div class="form-group col-sm-12">                                                                           
                                <label for="inputVinculo" class="col-sm-2 control-label">Vínculo</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputVinculo" id="inputVinculo">
                                        <?php
                                        $Consulta_turno = mysqli_query($Conexao, "SELECT * FROM `vinculos`");
                                        while ($Registro_turno = mysqli_fetch_array($Consulta_turno, MYSQLI_BOTH)) {
                                            $turno_turno = $Registro_turno["vinculo"];
                                            echo "<option>$turno_turno</option>";
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
                                    <input type="text" placeholder="DIGITE O NOME DO SERVIDOR" class="form-control" id="inputNome" name="inputNome" onkeyup="maiuscula(this)">
                                </div>
                                <label for="inputNascimento"  class="col-sm-2 control-label">Nascimento</label>
                                <div class="col-sm-2">                                   
                                    <input id="inputNascimento" type="date" class="form-control" name="inputNascimento">
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputModelo_Certidao" class="col-sm-2  control-label">Modelo da Certidão</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="inputModelo_Certidao" id="InputModelo_certidao">
                                        <option value="VELHO">VELHO</option>
                                        <option value="NOVO">NOVO</option>
                                    </select>
                                    <select class="form-control" name="inputModelo_Certidao" id="InputModelo_certidao_2">
                                        <option value="VELHO"  >VELHO</option>
                                    </select>
                                </div>
                                <div id="matricula">
                                    <!--                                    <label for="inputMatricula_Certidao" class="col-sm-1 col-sm-offset-3 control-label">Matricula</label>
                                                                        <div class="col-sm-4"> 
                                                                            <input type="text" class="form-control" id="inputMatricula_Certidao" name="inputMatricula_Certidao"  >
                                                                        </div>
                                                                    </div>
                                                                    <div id="dados">                                   
                                                                        <label for="inputCertidao" class="col-sm-1  col-sm-offset-3 control-label">Número da Certidão</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" class="form-control" id="dados_nao_Rg" name="inputCertidao" onkeyup="maiuscula(this)">
                                                                        </div>                                   
                                                                    </div>-->
                                    <div id = "dados_Rg">
                                        <label for="inputCertidao" class="col-sm-1 control-label col-sm-offset-3">Número do RG</label>
                                        <div class="col-sm-4" >
                                            <input type="text" class="form-control" id="dados_Rg2" name="inputCertidao" onkeyup="maiuscula(this)" placeholder="">
                                        </div>                                    
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputTiposCertidao" class="col-sm-2 control-label">RG</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="inputTiposCertidao" id="inputTiposCertidao">
                                        <option value="RG" >RG</option>

                                    </select>
                                </div> 
                                <label for="inputExpedicao" class="col-sm-2 col-sm-offset-2 control-label">Data de Expedição</label>
                                <div class="col-sm-2">                                    
                                    <input type="date" class="form-control" id="inputExpedicao" name="inputExpedicao" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">Orgão Expedidor</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="" name="inputOxp"   onkeyup="maiuscula(this)" >
                                </div>
                                <label for="" class="col-sm-2 control-label">Estado da Expedidor</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="" name="inputExpdd" placeholder="Exemplo: PE" onkeyup="maiuscula(this)" >
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputMae" class="col-sm-2 control-label">Mãe</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O MÃE DO SERVIDOR" class="form-control" id="inputMae" name="inputMae" onkeyup="maiuscula(this)">
                                </div>
                                <label for="inputPai" class="col-sm-2 control-label">Pai</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O PAI DO SERVIDOR" class="form-control" id="inputPai" name="inputPai" onkeyup="maiuscula(this)">
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
                                    <input  class="form-control" id="inputCpf" name="inputCpf">
                                </div>                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputFone" class="col-sm-2 control-label">Fone</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputFone").mask("9999-9999");
                                        });
                                    </script>
                                    <input type="text" class="form-control" id="inputFone" name="inputFone" >
                                </div>                   
                                <label for="inputCel" class="col-sm-2 col-sm-offset-2 control-label">CELULAR</label>
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
                                <label for="inputEmail" class="col-sm-2 control-label">EMAIL</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O EMAIL" class="form-control" id="inputEmail" name="inputEmail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" value="Enviar" class="btn btn-success btn-block">Matricular</button>
                                </div>
                                <div class="col-sm-offset-2 col-sm-4">                                   
                                    <button type="reset" class="btn btn-danger btn-block">Limpar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
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
        function limpa() {
            $('#InputModelo_certidao').val('NOVO');

        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dados_Rg').hide();
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
    <script type="text/javascript">
        $(document).ready(function () {
            var txt = $('#turmas').hide();
            $('#inputFuncao').change(function () {
                var txt = $('#inputFuncao').val();
                if (txt == "PROFESSOR(A)" || txt == "PROFESSOR(A)/AUXILIAR") {
                    $('#turmas').show('slow');
                } else {
                    var txt = $('#inputResumoSim').val();
                    if (txt == "SIM") {
                        $('.resumo').show('slow');
                    } else {
                        $('.resumo').hide('slow');
                    }
                    $('#turmas').hide('slow');
                }

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var txt = $('#inputResumoSim').val();
            if (txt == "SIM") {
                $('.resumo').show();
            } else {
                $('.resumo').hide();
            }
            $('#inputResumoSim').change(function () {
                var txt = $('#inputResumoSim').val();
                if (txt == "SIM") {
                    $('.resumo').show('slow');
                } else {
                    $('.resumo').hide('slow');
                }

            });
        });
    </script>
</html>
