<?php
include_once 'valida_cookies.inc';
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>        
        <title>CADASTRAR SUBSTIUIÇÕES</title>
        <style>
            .semana{
                width: 100% !important;
            }
        </style>
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
                    <h1 style=" text-align: center">Substituições</h1>
                    <form name="cadastrar" action="cadastrar_substituicoes_server.php" method="post" class="form-horizontal" onsubmit="return substituto()">
                        <div class="row" id="um">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">Servidor(a)</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputServidor" id="inputServidor" required="">
                                        <?php
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `excluido` LIKE 'N' ORDER BY nome");
                                        echo "<option disabled selected>SELECIONE O SERVIDOR ! </option>";
                                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                            $nome = $Registro["nome"];
                                            echo "<option>$nome</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputSubstituto" class="col-sm-2 control-label">Substituto(a) I</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputSubstituto" id="inputSubstituto">
                                        <?php
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `excluido` LIKE 'N' ORDER BY nome");
                                        echo "<option selected disabled>SELECIONE O SUBSTITUTO</option>";
                                        echo "<option>SEM SUBSTITUTO</option>";
                                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                            $nome = $Registro["nome"];
                                            echo "<option>$nome</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputFuncao" class="col-sm-2 control-label">Função</label>                                                              
                                <div class="col-sm-4">                                      
                                    <input type="text" class="form-control" name="inputFuncao" id="inputFuncao" required="">
                                </div>                                    
                                <label for="inputSubstituto2" class="col-sm-2 control-label ">Substituto(a) II</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O SUBSTITUTO SE NÃO FOR SEVIDOR" class="form-control" name="inputSubstituto2" id="inputSubstituto2" onkeyup="maiuscula(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row" id="hora_aula" style=" display:none ">
                            <div class="form-group col-sm-12">
                                <label for="inputAulasSim" class="col-sm-2 control-label">Hora/Aula</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputAulasSim" id="inputAulasSim">
                                        <option value="NÃO">NÃO</option>
                                        <option value="SIM">SIM</option>                                       
                                    </select>
                                </div>                                
                            </div>
                        </div>
                        <div class="row" id="dias" style=" display: none">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">Aulas/Dia</label>
                                <div class="col-sm-4">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Seg</th>
                                                <th>Ter</th>                                               
                                                <th>Quat</th>
                                                <th>Quint</th>
                                                <th>Sex</th>
                                            </tr>
                                        </thead>
                                        <td><input class="semana" type="number" name="seg" step="1" min="0" max="15" value="0"></td>
                                        <td><input class="semana" type="number" name="ter" step="1" min="0" max="15" value="0"></td>
                                        <td><input class="semana" type="number" name="qua" step="1" min="0" max="15" value="0"></td>
                                        <td><input class="semana" type="number" name="qui" step="1" min="0" max="15" value="0"></td>
                                        <td><input class="semana" type="number" name="sex" step="1" min="0" max="15" value="0"></td>                                        
                                    </table>
                                </div>                                
                            </div>
                        </div>
                        <div class="row" id="dois">
                            <div class="form-group col-sm-12">                                   
                                <label for="InputRemunerado" class="col-sm-2 control-label">Remunerado</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="InputRemunerado" id="InputRemunerado">
                                        <option value="NÃO">NÃO</option>
                                        <option value="SIM">SIM</option>                                       
                                    </select>
                                </div>                                
                            </div>                         
                        </div>
                        <div class="row" id="dois">
                            <div class="form-group col-sm-12">
                                <label for="inputTempo" class="col-sm-2  control-label">Tempo</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O TEMPO COM NÚMEROS" class="form-control" id="inputTempo" name="inputTempo"  required="Digite um Número por Favor"  maxlength="3" pattern="[0-9]+$" >
                                </div>
                                <label for="inputDataInicial" class="col-sm-2 control-label">Data Inicial</label>
                                <div class="col-sm-2">                                    
                                    <input type="date" class="form-control" id="inputDataInicial" name="inputDataInicial" required="">
                                </div>                                   
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">                         
                                <label for="InputEnviado" class="col-sm-2 control-label">Enviado</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="InputEnviado" id="InputEnviado">
                                        <option value="NÃO">NÃO</option>
                                        <option value="SIM">SIM</option>                                   
                                    </select>
                                </div>   
                                <div id="data_envio">
                                    <label for="inputDataEnvio" class="col-sm-2  control-label col-sm-offset-2">Data de Envio</label>
                                    <div class="col-sm-2">
                                        <script type="text/javascript" >
                                            $(function () {
                                                $("#").mask("99/99/9999");
                                            });
                                        </script>
                                        <input type="date" class="form-control" id="inputDataEnvio" name="inputDataEnvio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12"> 
                                <div class="col-sm-6 col-sm-offset-2 ">
                                    <button type="submit" value="Enviar" onclick= 'return confirmarAtualizacao()' class="btn btn-success">Enviar</button>
                                    <button type="reset" class="btn btn-danger">Limpar</button>
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
            $('#data_envio').hide();
            $('#InputEnviado').change(function () {
                if ($('#InputEnviado').val() !== 'SIM') {
                    $('#data_envio').hide();
                } else {
                    $('#data_envio').show();
                }
            });
        });
    </script>  
    <script type="text/javascript">
        function confirmarAtualizacao() {
            var r = confirm("Posso Enviar?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script type="text/javascript">
        function substituto() {
            var textoOptionSelecionado = $('#inputSubstituto option:selected').text(); // armazendando em variavel
            //alert("Texto do option selecionado: " + textoOptionSelecionado); // mostrando um alerta na tela
            if (textoOptionSelecionado == "SELECIONE O SUBSTITUTO") {
                if ($('#inputSubstituto2').val() == "") {
                    alert('Por favor! Indique se houve ou não um Substituto! ');
                    return false;
                } else {
                    return true;
                }
            } else if (textoOptionSelecionado !== "SELECIONE O SUBSTITUTO") {
                if ($('#inputSubstituto2').val() !== "") {
                    alert('Por favor! Somente pode haver um Substituto! ');
                    return false;
                } else {
                    return true;
                }
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#inputServidor').change(function () {

                var $inputServidor = $('#inputServidor option:selected').text();//PEgar o texto do selecionado
                var $inputFuncao = $("input[name='inputFuncao']");
                //alert($inputServidor);
                $.getJSON('function_atestado.php', {
                    inputServidor: $(this).val()
                }, function (json) {
                    $inputFuncao.val(json.inputFuncao);
                    //
                    var texto = (json.inputFuncao);
                    //
                    if (texto == "PROFESSOR(A)/AUXILIAR" || texto == "PROFESSOR(A)") {
                        $('#dias').show(2500);
                        $('#hora_aula').show(2500);
                    } else {
                        $('#dias').hide(2500);
                        $('#hora_aula').hide(2500);
                    }

                });
            });
        });
    </script> 
</html>
