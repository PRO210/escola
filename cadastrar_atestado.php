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
        <title>CADASTRAR ATESTADOS</title>  
        <script src="js/jquery_1_5_2.min.js" type="text/javascript"></script>
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
                    <h3 style=" text-align: center">Atestados</h3>
                    <form name="cadastrar" action="cadastrar_atestado_server.php" method="post" class="form-horizontal" onsubmit="return substituto()">
                        <div class="row" id="um">
                            <div class="form-group col-sm-12">
                                <label for="inputServidor" class="col-sm-2 control-label">Servidor(a)</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputServidor" id="inputServidor" required="">
                                        <?php
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `excluido` = 'N' ORDER BY nome");
                                        echo "<option disabled selected>SELECIONE O SERVIDOR ! </option>";
                                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                            $nome = $Registro["nome"];
                                            $id = $Registro["id"];
                                            echo "<option>$nome</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="inputSubstituto" class="col-sm-2 control-label">Substituto(a) Do Quadro</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputSubstituto" id="inputSubstituto">
                                        <?php
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `excluido` LIKE 'N' ORDER BY nome");
                                        echo "<option disabled = '' selected = ''>SELECIONE O SUBSTITUTO</option>";
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
                                    <input type="text" class="form-control" name="inputFuncao" id="inputFuncao">
                                </div> 
                                <label for="inputSubstituto2" class="col-sm-2 control-label ">Substituto(a) Externo</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O SUBSTITUTO SE NÃO FOR SEVIDOR" class="form-control" name="inputSubstituto2" id="inputSubstituto2" onkeyup="maiuscula(this)">
                                </div>
                            </div>
                        </div> 

                        <div class="row" id="hora_aula" style=" display: none;">
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
                                <label for="inputTipo" class="col-sm-2 control-label">Tipo</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputTipo" id="inputTipo" required="" >
                                        <?php
                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `atestados` ORDER BY tipo");
                                        echo "<option disabled selected>SELECIONE O TIPO ! </option>";
                                        while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                            $tipo = $Registro["tipo"];
                                            echo "<option>$tipo</option>";
                                        }
                                        ?>
                                    </select>
                                </div> 
                                <div id="TextArea">
                                    <label for="inputTextArea2" class="control-label col-sm-2">Outros:</label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" rows="1" id="inputTextArea2" name="inputTextArea2"></textarea>
                                    </div>
                                </div>
                            </div>                         
                        </div>                       
                        <div class="row" id="dois">
                            <div class="form-group col-sm-12">
                                <label for="InputRemunerado" class="col-sm-2 control-label">Remunerado</label>
                                <div class="col-sm-1">
                                    <select class="form-control" name="InputRemunerado" id="InputRemunerado">
                                        <option value="NÃO">NÃO</option>
                                        <option value="SIM">SIM</option>                                       
                                    </select>
                                </div>  
                                <label for="inputRecebido" class="col-sm-1 control-label">Recebido</label>
                                <div class="col-sm-2">                                    
                                    <input type="date" class="form-control" id="inputRecebido" name="inputRecebido" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="inputTurno" class="col-sm-2  control-label">Turno</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputTurno">
                                        <option value="-----" selected="" >CASO QUEIRA ESPECIFIQUE O TURNO CLICANDO AQUI!</option>
                                        <option value="M">MANHÃ</option>
                                        <option value="T">TARDE</option>
                                        <option value="N">NOITE</option>
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
                        <div class="row" id="dois">
                            <div class="form-group col-sm-12">
                                <label for="inputTempo" class="col-sm-2  control-label">Tempo</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="DIGITE O TEMPO COM NÚMEROS" class="form-control" id="inputTempo" name="inputTempo"  required="Digite um Número por Favor"  maxlength="3" pattern="[0-9]+$" >
                                </div>                            
                            </div>
                        </div>
                        <div class="row" id="">
                            <div class="form-group col-sm-12">                           
                                <label for="inputDataInicial" class="col-sm-2 control-label">Data Inicial</label>
                                <div class="col-sm-4">                                    
                                    <input type="date" class="form-control" id="inputDataInicial" name="inputDataInicial" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">                         
                                <label for="InputEnviado" class="col-sm-2 control-label">Enviado</label>
                                <div class="col-sm-1">
                                    <select class="form-control" name="InputEnviado" id="InputEnviado">
                                        <option value="NÃO">NÃO</option>
                                        <option value="SIM">SIM</option>                                   
                                    </select>
                                </div>   
                                <div id="data_envio">
                                    <label for="inputDataEnvio" class="col-sm-1  control-label">Data de Envio</label>
                                    <div class="col-sm-2">
                                        <script type="text/javascript" >
                                            $(function () {
                                                $("#").mask("99/99/9999");
                                            });
                                        </script>
                                        <input type="date" class="form-control" id="inputDataEnvio" name="inputDataEnvio" >
                                    </div>
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
                        <div class="row">
                            <div class="form-group col-sm-12"> 
                                <div class="col-sm-4 col-sm-offset-2 ">
                                    <button type="submit" value="Enviar" class="btn btn-success btn-block" onclick="return confirmarAtualizacao()">Salvar</button>
                                </div>
                                <div class="col-sm-4 col-sm-offset-2 ">
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
        $('#TextArea').hide();
        $(document).ready(function () {
            $('#inputTipo').change(function () {
                var tipo = $('#inputTipo').val();
                if (tipo == "OUTROS") {
                    $('#TextArea').show('slow');
                } else {
                    $('#TextArea').hide('slow');
                }
            });
        });
    </script>
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
            //
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
