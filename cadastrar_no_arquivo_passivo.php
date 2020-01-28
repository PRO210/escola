<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($Recebe_id == "2") {
    echo "<script type=\"text/javascript\">
		alert(\"Operação Não Realizada. Talvez Esse Aluno já conste no Banco de Dados! \");
                </script>
                ";
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>     
        <title>CADASTRO DE ALUNOS NO ARQUIVO</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>     
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style=" text-align: center">Cadastro de Aluno no Arquivo Passivo</h3>
                    <form name="cadastrar" id="cadastrar" action="cadastrar_no_arquivo_passivo_server.php" method="post" class="form-horizontal"  onsubmit="return validar()">
                        <div class="row" id="dois">
                            <div class="form-group col-sm-12">
                                <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O NOME DO ESTUDANTE" class="form-control" id="inputNome" name="inputNome" required="" onkeyup="maiuscula(this)" >
                                </div>
                                <label for="inputNascimento"  class="col-sm-2  control-label">Nascimento</label>
                                <div class="col-sm-4">                                    
                                    <input id="inputNascimento" type="date" class="form-control" name="inputNascimento" >
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputTiposCertidao" class="col-sm-2 control-label">Tipos de Certidão Civil</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputTiposCertidao" id="inputTiposCertidao">
                                        <option value="NASCIMENTO">NASCIMENTO</option>
                                        <option value="CASAMENTO">CASAMENTO</option>
                                        <option value="RG">RG</option>
                                    </select>
                                </div>
                                <div id = "matricula">
                                    <label for="inputMatricula" class="col-sm-2 control-label">Matricula</label>
                                    <div class="col-sm-4" id = "inputMatricula">
                                        <input type="text" class="form-control" name="inputMatricula" placeholder="XXXXXXXXXX XXXX X XXXXX XXX XXXXXXX XX" >
                                    </div>
                                </div>
                                <div id = "dados">
                                    <label for="inputCertidao" class="col-sm-2 control-label">Dados da Certidão</label>
                                    <div class="col-sm-4" id = "">
                                        <input type="text" class="form-control" id="dados_nao_Rg" name="inputCertidao" onkeyup="maiuscula(this)" placeholder="Termo N°XXX, FLS:xxx, Livro: xx.">
                                    </div>                                    
                                </div>
                                <div id = "dados_Rg">
                                    <label for="inputCertidao" class="col-sm-2 control-label">Dados do RG</label>
                                    <div class="col-sm-4" >
                                        <input type="text" class="form-control" id="dados_Rg2" name="inputCertidao" onkeyup="maiuscula(this)" placeholder="N°/Órgão Emissor/UF">
                                    </div>                                    
                                </div>
                            </div>
                        </div>                   
                        <div class="row" id="dois">
                            <div class="form-group col-sm-12">
                                <label for="InputModelo_certidao" class="col-sm-2 control-label">Modelo da Certidão</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="InputModelo_certidao" id="InputModelo_certidao">
                                        <option value="NOVO"  >NOVO</option>
                                        <option value="VELHO"  >VELHO</option>
                                    </select>
                                    <select class="form-control" name="InputModelo_certidao" id="InputModelo_certidao_2">
                                        <option value="VELHO"  >VELHO</option>
                                    </select>
                                </div>                                 


                                <label for="inputExpedicao" class="col-sm-2 control-label">Expedição</label>
                                <div class="col-sm-4">                                   
                                    <input type="date" class="form-control" id="inputExpedicao" name="inputExpedicao" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">  
                                <label for="inputNaturalidade" class="col-sm-2 control-label">Naturalidade</label>
                                <div class="col-sm-4">                              
                                    <input type="text" class="form-control" id="inputNaturalidade" name="inputNaturalidade" onkeyup="maiuscula(this)">
                                </div>   
                                <label for="inputEstado" class="col-sm-2  control-label">Estado</label>
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
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                </div>            
                            </div>
                        </div>
                        <div class="row" >
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
                        <div class="row" >
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
                        <div class="row" >
                            <div class="form-group col-sm-12">  
                                <label for="inputEndereco" class="col-sm-2 control-label">Endereço</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputEndereco" name="inputEndereco" onkeyup="maiuscula(this)" >
                                </div>
                                <label for="inputFone" class="col-sm-2  control-label">Fone</label>
                                <div class="col-sm-4">
                                    <script type="text/javascript">
                                        $(function () {
                                            $("#inputFone").mask("99-99999-9999");
                                        });
                                    </script>
                                    <input id="inputFone" type="text" class="form-control" name="inputFone" placeholder="XX-XXXXX-XXXX" >
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
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="inputPasta" class="col-sm-2 control-label">Escolha a Pasta</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputPasta" id="inputPasta" required="required">
                                        <option disabled="" selected="" value="branco">Confira se Realmente Existe Lugar na Pasta. </option>                                                                    
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" value="Enviar" class="btn btn-success" id="Enviar" onclick="return confirmarAtualizacao()">Matricular</button>
                                <button type="reset" class="btn btn-danger" id="reset">Limpar</button>
                            </div>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </body>    
    <script type="text/javascript">
        $("#reset").on('click', function () {
            location.reload();
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
    <script>
        $(document).ready(function () {
            $("#inputNome").blur(function () {
                var $inputNome = $('#inputNome').val();
               // alert($inputNome);
                $.ajax({
                    url: 'function_arquivo_passivo.php',
                    type: 'POST',
                    data: {id: $("#inputNome").val()},
                    beforeSend: function () {
//                      $("#cidades").css({'display': 'block'});
                        $("#inputPasta").html("Carregando...");
                    },
                    success: function (data)
                    {
//                      $("#cidades").css({'display': 'block'});
                        $("#inputPasta").html(data);
                    },
                    error: function (data)
                    {
//                       $("#cidades").css({'display': 'block'});
                        $("#inputPasta").html("Houve um erro ao carregar");
                    }
                });
            });
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
        function confirmarAtualizacao() {
            var inputNome = $('#inputNome').val();
            var inputPasta = $('#inputPasta').val();
            var texto = "Realmente deseja Cadastrar";
            var r = confirm(texto + " " + inputNome + " Na Pasta " + inputPasta + "?");

            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>    
</html>
