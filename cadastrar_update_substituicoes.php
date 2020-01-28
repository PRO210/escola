<?php
include_once 'valida_cookies.inc';
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id = base64_Decode($Recebe_id);
//echo base64_Decode($Recebe_id);

$Consulta = mysqli_query($Conexao, "SELECT * FROM substituicoes WHERE id= '$id'");
$Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$servidor = $Registro['servidor'];
$substituto = "";
$substituto2 = "";
$substituto = $Registro['substituto'];
$funcao = $Registro['funcao'];
$hora_aula = $Registro['hora_aula'];
$seg = $Registro['seg'];
$ter = $Registro['ter'];
$qua = $Registro['qua'];
$qui = $Registro['qui'];
$sex = $Registro['sex'];
$tempo = $Registro['tempo'];
$inicio = new DateTime($Registro["inicio"]);
$inicio_convertida = date_format($inicio, 'Y-m-d');
$remuneracao = $Registro['remuneracao'];
$enviado = $Registro['enviado'];
$data_envio = new DateTime($Registro['data_envio']);
$data_envio_convertida = date_format($data_envio, 'Y-m-d');
session_start();
if (empty($_SESSION['erro'])) {
    session_destroy();
} else {
    echo "<script type='text/javascript'>
                alert('Por favor indique se existe ou não Substituto');
          </script>
     ";
    session_destroy();
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>        
        <title>ATUALIZAR SUBSTITUIÇÃO</title>
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
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="css/cadastrar.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <div class="container-fluid">
            <div class="row">
                <h3 style=" text-align: center">Substituições</h3>
                <div class="col-sm-12 col-lg-offset-2">                   
                    <form name="cadastrar" action="cadastrar_update_substituicoes_server.php" method="post" class="form-horizontal"  onsubmit="return validar()">
                        <div class="row" id="um">
                            <div class="form-group col-sm-12">
                                <label for="inputServidor" class="col-sm-2 control-label">Servidor</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputServidor" id="inputServidor" >
                                        <?php echo "<option selected>$servidor</option>"; ?>
                                    </select>
                                </div>                               
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12"> 
                                <label for="" class="col-sm-2 control-label">Tipos de Substituto</label> 
                                <div class="col-sm-4">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>                                               
                                                <th><input type='radio' name='substituto' class = 'atual' checked >&nbsp;&nbsp;Substituto Atual</th>
                                                <th><input type='radio' name='substituto' class = 'Substituto_I'  >&nbsp;&nbsp;Substituto da Escola</th>
                                                <th><input type='radio' name='substituto' class = 'Substituto_II'  >&nbsp;&nbsp;Substituto Convidado</th>
                                            </tr>                                  
                                        </tbody>
                                    </table>
                                </div>      
                            </div>
                        </div>                       
                        <div class="row" id="atual">
                            <div class="form-group col-sm-12"> 
                                <label for="" class="col-sm-2 control-label">Substituto Atual</label> 
                                <div class="col-sm-4">
                                    <table class="table table-striped table-bordered" id="">
                                        <tbody>
                                            <tr>                                               
                                                <th id="atual_2"><input type='checkbox' name='inputSubstitutoAtual' class = 'atual'  value="<?php echo "$substituto"; ?>" checked ></th>
                                                <th><?php echo "$substituto"; ?></th>
                                            </tr>                                  
                                        </tbody>
                                    </table>
                                </div>      
                            </div>
                        </div>
                        <div class="row" id="Substituto_I">
                            <div class="form-group col-sm-12">                                
                                <label for="inputSubstituto_I" class="col-sm-2 control-label">Substituto da Escola</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputSubstituto_I" id="inputSubstituto_I" required="" >
                                        <?php
                                        $Consulta_2 = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `excluido` = 'N' ORDER BY nome");
                                        echo "<option disabled selected>ESCOLHA O SUBSTITUTO SE ELE FOR SERVIDOR DA ESCOLA</option>";
                                        echo "<option>SEM SUBSTITUTO</option>";
                                        while ($Registro_2 = mysqli_fetch_array($Consulta_2, MYSQLI_BOTH)) {
                                            $nome = $Registro_2["nome"];
                                            echo "<option>$nome</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                                
                            </div>
                        </div> 
                        <div class="row" id="Substituto_II">
                            <div class="form-group col-sm-12">                                
                                <label for="inputSubstituto_II" class="col-sm-2 control-label">Substituto Convidado</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="NO CASO DO SUBSTITUTO NÃO SER DO QUADRO" class="form-control" id= "inputSubstituto_II" name= "inputSubstituto_II" onkeyup="maiuscula(this)" required="">
                                </div>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">Função</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputFuncao" id="inputFuncao" required="">
                                        <?php
                                        $Consulta_funcao = mysqli_query($Conexao, "SELECT * FROM `funcoes` WHERE funcao = '$funcao'");
                                        $Registro_funcao = mysqli_fetch_array($Consulta_funcao, MYSQLI_BOTH);
                                        echo "<option selected = '' >" . $Registro_funcao['funcao'] . "</option>";
                                        ?>                                 
                                    </select>
                                </div>                                
                            </div>
                        </div>
                        <div class="row" id="hora_aula">
                            <div class="form-group col-sm-12">
                                <label for="inputAulasSim" class="col-sm-2 control-label">Hora/Aula</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="inputAulasSim" id="inputAulasSim">
                                        <?php if ($hora_aula == "NÃO") { ?>
                                            <option value="NÃO" selected="">NÃO</option>
                                            <option value="SIM">SIM</option>   
                                        <?php } else { ?>
                                            <option value="SIM" selected="">SIM</option> 
                                            <option value="NÃO" >NÃO</option>
                                        <?php } ?>
                                    </select>
                                </div>                                
                            </div>
                        </div>
                        <div class="row" id="dias">
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
                                        <td><input class="semana" type="number" name="seg" step="1" min="0" max="15" value="<?php echo"$seg" ?>"></td>
                                        <td><input class="semana" type="number" name="ter" step="1" min="0" max="15" value="<?php echo"$ter" ?>"></td>
                                        <td><input class="semana" type="number" name="qua" step="1" min="0" max="15" value="<?php echo"$qua" ?>"></td>
                                        <td><input class="semana" type="number" name="qui" step="1" min="0" max="15" value="<?php echo"$qui" ?>"></td>
                                        <td><input class="semana" type="number" name="sex" step="1" min="0" max="15" value="<?php echo"$sex" ?>"></td>                                        
                                    </table>
                                </div>                                
                            </div>
                        </div>                        
                        <div class="row" id="dois">
                            <div class="form-group col-sm-12">  

                                <label for="inputTempo" class="col-sm-2  control-label">Tempo</label>
                                <div class="col-sm-1">
                                    <input type="text" placeholder="DIGITE O TEMPO COM NÚMEROS" class="form-control" id="inputTempo" name="inputTempo"  value="<?php echo $tempo ?>" required="">
                                </div> 

                                <label for="inputDataInicial" class="col-sm-1 control-label">Data Inicial</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#").mask("99/99/9999");
                                        });
                                    </script>
                                    <input type="date" class="form-control" id="inputDataInicial" name="inputDataInicial" value="<?php echo $inicio_convertida ?>">
                                </div> 
                            </div>       
                        </div>                       
                        <div class="row" id="quatro">
                            <div class="form-group col-sm-12">                            
                                <label for="InputRemunerado" class="col-sm-2 control-label">Remunerado</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="InputRemunerado" id="InputRemunerado">
                                        <?php
                                        $txt_option = "SIM";
                                        $txt_option2 = "NÃO";

                                        if ($remuneracao == "$txt_option") {
                                            echo "<option selected>$txt_option</option>";
                                            echo "<option>$txt_option2</option>";
                                        } elseif ($remuneracao == "$txt_option2") {
                                            echo "<option selected>$txt_option2</option>";
                                            echo "<option>$txt_option</option>";
                                        }
                                        ?>
                                    </select>
                                </div> 
                            </div>
                        </div>
                        <div class="row" id="">
                            <div class="form-group col-sm-12">                          
                                <label for="InputEnviado" class="col-sm-2 control-label">Enviado</label>
                                <div class="col-sm-1">
                                    <select class="form-control" name="InputEnviado" id="InputEnviado">
                                        <?php
                                        $txt_option = "SIM";
                                        $txt_option2 = "NÃO";
                                        $txt_option3 = "NÃO PRECISA";

                                        if ($enviado == "$txt_option") {
                                            echo "<option selected>$txt_option</option>";
                                            echo "<option>$txt_option2</option>";
                                        } elseif ($enviado == "$txt_option2") {
                                            echo "<option selected>$txt_option2</option>";
                                            echo "<option>$txt_option</option>";
                                        }
                                        ?>
                                    </select>                                    
                                </div>
                                <div id="data_envio">
                                    <label for="inputDataEnvio" class="col-sm-1 control-label">Data de Envio</label>
                                    <div class="col-sm-2">
                                        <script type="text/javascript" >
                                            $(function () {
                                                $("#").mask("99/99/9999");
                                            });
                                        </script>
                                        <input type="date" class="form-control" id="inputDataEnvio" name="inputDataEnvio" value="<?php echo $data_envio_convertida ?>">
                                    </div>
                                    <input type="hidden"  name="inputId" value="<?php echo $id ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="row" id="">
                            <div class="form-group col-sm-12"> 
                                <div class="col-sm-2 col-lg-offset-2">
                                    <button type="submit" value="Enviar" class="btn btn-success btn-block">Enviar</button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="reset" class="btn btn-danger btn-block">Limpar</button>
                                </div>
                            </div>
                        </div>
                    </form>               
                </div>
            </div>
        </div>
    </body>
    <!--Controla o input Subtituto Atual-->
    <script type="text/javascript">
        $(document).ready(function () {

            $('.atual').click(function () {
                if (this.checked) {
                    $('.atual').each(function () {
                        this.checked = true;
                    });
                    $('#inputSubstituto_I').attr('disabled', 'disabled');
                    $('#inputSubstituto_II').attr('disabled', 'disabled');

                    $('#atual').show(2500);
                    $('#Substituto_I').hide(2500);
                    $('#Substituto_II').hide(2500);

                }
            });

        });
    </script>
    <script type="text/javascript">
        //Controla os inputs do substituto I II
        $(document).ready(function () {

            $('#Substituto_I').hide();
            $('#Substituto_II').hide();
            $('#atual_2').hide();
            $('#inputSubstituto_I').attr('disabled', 'disabled');
            $('#inputSubstituto_II').attr('disabled', 'disabled');

            $('.Substituto_I').click(function () {
                if (this.checked) {
                    $('#inputSubstituto_I').removeAttr('disabled');
                    $('#inputSubstituto_II').attr('disabled', 'disabled');


                    $('.atual').each(function () {
                        this.checked = false;
                    });
                    $('#atual').hide(2500);
                    $('#Substituto_I').show(2500);
                    $('#Substituto_II').hide(2500);

                }
            });

        });
    </script>
    <!--Controla o input do Substituto II-->
    <script type="text/javascript">
        $(document).ready(function () {

            $('.Substituto_II').click(function () {

                if (this.checked) {

                    $('.atual').each(function () {
                        this.checked = false;
                    });
                    $('#inputSubstituto_I').attr('disabled', 'disabled');
                    $('#inputSubstituto_II').removeAttr('disabled');

                    $('#atual').hide(2500);
                    $('#Substituto_I').hide(2500);
                    $('#Substituto_II').show(2500);

                }
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var texto = $('#inputFuncao option:selected').text();//PEgar o texto do selecionado                                   
            //  alert(texto);                                
            if (texto == "PROFESSOR(A)/AUXILIAR" || texto == "PROFESSOR(A)") {
                $('#dias').show(2500);
                $('#hora_aula').show(2500);
            } else {
                $('#dias').hide();
                $('#hora_aula').hide();
            }

        });
    </script>     
    <script type="text/javascript">
        $(document).ready(function () {
            if ($('#InputEnviado').val() !== 'SIM') {
                $('#data_envio').hide();
            } else {
                $('#data_envio').show();
            }
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#InputEnviado').change(function () {
                if ($('#InputEnviado').val() !== 'SIM') {
                    $('#data_envio').hide();
                } else {
                    $('#data_envio').show();
                }
            });
        });
    </script>
</html>
