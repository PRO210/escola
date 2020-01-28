<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
session_start();
if (empty($_SESSION['erro1'])) {
    $Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    $id_aluno = base64_decode($Recebe_id);
//echo "$id_aluno";
    $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$id_aluno' ");
    $rowf = mysqli_fetch_array($Consultaf);
    $id_aluno = $rowf['id_aluno_solicitacao'];
    session_destroy();
} elseif ($_SESSION['erro1'] == '1') {
    $Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
    $id_aluno = base64_decode($Recebe_id);
    echo "<script type='text/javascript'>
    alert('Ops! Você Indicou um mesmo Histórico para dois Anos;Cada Histórico deve ser usado para um Único Ano.');
    </script>";
    session_destroy();
}
//
$Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$id_aluno' ");
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$nome = $Linha['nome'];
$data_nascimento = new DateTime($Linha["data_nascimento"]);
$data_nascimento = date_format($data_nascimento, 'Y-m-d');
$naturalidade = $Linha['naturalidade'];
$estado = $Linha['estado'];
$nacionalidade = $Linha['nacionalidade'];

$pai = $Linha['pai'];
$mae = $Linha['mae'];

$turma = $Linha['turma'];
$SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turma'";
$Consulta_turma = mysqli_query($Conexao, $SQL_turma);
$Linha_turma = mysqli_fetch_array($Consulta_turma);
//
$nome_turma = $Linha_turma["turma"];
$ano_turma = substr($Linha_turma["ano"], 0, -6);
$turno_turma = $Linha_turma["turno"];
$turma = "$nome_turma($turno_turma) - $ano_turma";
//
$data = date("d-m-Y");
$hoje = date('Y');
//
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script> 
        <title>MONTAR TRANSFERÊNCIA NOTAS</title>
        <style>
            .DivP{
                padding-left: 24px;
            }
            .h3{
                text-align: center;
            }
            .radio-inline{
                margin-left: 12px !important;
            }
        </style>
    </head>
    <body>
        <div class="container">            
            <form name="" action="montar_transferencia_server.php" method="post" class="form-horizontal"  >
                <input type="hidden" name="inputId" value="<?php echo $id_aluno ?>">
                <div class="row">
                    <div class="form-group col-sm-12" style="text-align: center;">
                        <h3>Montar Notas da Transferência</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputNome" class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" value="<?php echo $nome ?>">
                        </div>                      
                    </div>
                </div>
                <div class="row" >
                    <div class="form-group col-sm-12">                       
                        <label for="inputNome" class="col-sm-3 control-label">Turma Atual</label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" value="<?php echo $turma ?>">
                        </div>                           
                    </div>                      
                </div>        
                <!-- <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputNome" class="col-sm-3 control-label">Ano Atual</label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" value="<?php echo $hoje; ?>">
                        </div>                    
                    </div>                                    
                </div>                  -->
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        <label for="inputNome" class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">                          
                            <h3 class="h3">Históricos</h3>
                        </div>                        
                    </div>
                </div>
                <div class="row">                   
                    <div class="col-sm-6 col-lg-offset-3">
                        <?php
                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `bimestre_i` WHERE `id_bimestreI_aluno` = '$id_aluno'  GROUP BY `ano`");
                        $Linha = mysqli_num_rows($Consulta);
                        if ($Linha > 0) {
                            $ano3 = "none";
                        } else {
                            $ano3 = "block";
                        }
                        ?> 
                        <p style="text-align: center; font-size: 24px; color: red; display: <?php echo"$ano3" ?>">Atenção: O Aluno(a) Ainda Não Tem Histórico!</p>
                        <p style="text-align: center; margin-top: -12px ;display: <?php echo $ano3 ?>"><a href="cadastrar_historico.php?id=<?php echo base64_encode($id_aluno) ?>" >Deseja Criar Um Histórico? Click Aqui!</a></p>          
                    </div>                   
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">                                                 
                        <label for="inputAno1" class="col-sm-3 control-label">1º Ano</label>
                        <div class="col-sm-3">
                            <select class='form-control' name='inputAno1' id="inputAno1" onchange="change()">   
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno' GROUP BY `ano`");
                                $Linha = mysqli_num_rows($Consulta);
                                if ($Linha > 0) {
                                    echo "<option disabled = '' selected = '' value = '0'>Escolha o Histórico</option>";
                                    while ($registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $ano = $registro['ano'];
                                        $bimestre_turma = $registro['bimestre_turma'];
                                        if ($registro['status_bimestre_media'] == "5") {
                                            $aprovado = "Aprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "6") {
                                            $aprovado = "Reprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "4") {
                                            $aprovado = "Desistente";
                                        } elseif ($registro['status_bimestre_media'] == "3") {
                                            $aprovado = "Transferido(a)";
                                        } else {
                                            $aprovado = "Sem Resultado";
                                        }
                                        echo "<option value = '$ano'>$bimestre_turma - $ano / $aprovado </option>";
                                    }
                                } else {
                                    echo "<option disabled = '' selected = '' value = '0'>O Aluno(a) Não Tem Histórico:)</option>";
                                }
                                ?>
                            </select>                                                       
                        </div>
                        <div class="col-sm-6">                           
                            <label class="radio-inline"><input type="radio" name="optradio1" value="sim">Ainda Cursando</label>
                            <label class="radio-inline"><input type="radio" name="optradio1" checked="" value="nao">Ano Completo</label>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="form-group col-sm-12">                      
                        <label for="inputAno1" class="col-sm-3 control-label">2º Ano</label>
                        <div class="col-sm-3">
                            <select class='form-control' name='inputAno2' id="inputAno2" onchange="change()">
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno'  GROUP BY `ano`");
                                $Linha = mysqli_num_rows($Consulta);
                                if ($Linha > 0) {
                                    echo "<option disabled = '' selected = '' value = '0'>Escolha o Histórico</option>";
                                    while ($registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $ano = $registro['ano'];
                                        $bimestre_turma = $registro['bimestre_turma'];
                                        //
                                        if ($registro['status_bimestre_media'] == "5") {
                                            $aprovado = "Aprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "6") {
                                            $aprovado = "Reprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "4") {
                                            $aprovado = "Desistente";
                                        } elseif ($registro['status_bimestre_media'] == "3") {
                                            $aprovado = "Transferido(a)";
                                        }else {
                                            $aprovado = "Sem Resultado";
                                        }
                                        //
                                        echo "<option value = '$ano'>$bimestre_turma - $ano / $aprovado </option>";
                                    }
                                } else {
                                    echo "<option disabled = '' selected = '' value = '0'>O Aluno(a) Não Tem Histórico:)</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">                           
                            <label class="radio-inline"><input type="radio" name="optradio2" value="sim">Ainda Cursando</label>
                            <label class="radio-inline"><input type="radio" name="optradio2" checked="" value="nao">Ano Completo</label>
                        </div>
                    </div>                      
                </div> 
                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputAno3" class="col-sm-3 control-label">3º Ano</label>
                        <div class="col-sm-3">
                            <select class='form-control' name='inputAno3' id="inputAno3" onchange="change()">   
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno'  GROUP BY `ano`");
                                $Linha = mysqli_num_rows($Consulta);
                                if ($Linha > 0) {
                                    echo "<option disabled = '' selected = '' value = '0'>Escolha o Histórico</option>";
                                    while ($registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $ano = $registro['ano'];
                                        $bimestre_turma = $registro['bimestre_turma'];
//
                                        if ($registro['status_bimestre_media'] == "5") {
                                            $aprovado = "Aprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "6") {
                                            $aprovado = "Reprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "4") {
                                            $aprovado = "Desistente";
                                        } elseif ($registro['status_bimestre_media'] == "3") {
                                            $aprovado = "Transferido(a)";
                                        }else {
                                            $aprovado = "Sem Resultado";
                                        }
                                        //
                                        echo "<option value = '$ano'>$bimestre_turma - $ano / $aprovado </option>";
                                    }
                                } else {
                                    echo "<option disabled = '' selected = '' value = '0'>O Aluno(a) Não Tem Histórico:)</option>";
                                }
                                ?> 
                            </select>
                        </div>
                        <div class="col-sm-6">                           
                            <label class="radio-inline"><input type="radio" name="optradio3" value="sim">Ainda Cursando</label>
                            <label class="radio-inline"><input type="radio" name="optradio3" checked="" value="nao">Ano Completo</label>
                        </div>
                    </div>                                    
                </div>                                 
                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputAno4" class="col-sm-3 control-label">4º Ano</label>
                        <div class="col-sm-3">
                            <select class='form-control' name='inputAno4' id="inputAno4" onchange="change()">   
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno'  GROUP BY `ano`");
                                $Linha = mysqli_num_rows($Consulta);
                                if ($Linha > 0) {
                                    echo "<option disabled = '' selected = '' value = '0'>Escolha o Histórico</option>";
                                    while ($registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $ano = $registro['ano'];
                                        $bimestre_turma = $registro['bimestre_turma'];
//
                                        if ($registro['status_bimestre_media'] == "5") {
                                            $aprovado = "Aprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "6") {
                                            $aprovado = "Reprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "4") {
                                            $aprovado = "Desistente";
                                        } elseif ($registro['status_bimestre_media'] == "3") {
                                            $aprovado = "Transferido(a)";
                                        }else {
                                            $aprovado = "Sem Resultado";
                                        }
                                        //
                                        echo "<option value = '$ano'>$bimestre_turma - $ano / $aprovado </option>";
                                    }
                                } else {
                                    echo "<option disabled = '' selected = '' value = '0'>O Aluno(a) Não Tem Histórico:)</option>";
                                }
                                ?>
                            </select>
                        </div>   
                        <div class="col-sm-6">                           
                            <label class="radio-inline"><input type="radio" name="optradio4" value="sim">Ainda Cursando</label>
                            <label class="radio-inline"><input type="radio" name="optradio4" checked="" value="nao">Ano Completo</label>
                        </div>
                    </div>                                    
                </div>                              
                <div class="row">
                    <div class="form-group col-sm-12">                         
                        <label for="inputAno5" class="col-sm-3 control-label">5º Ano</label>
                        <div class="col-sm-3">
                            <select class='form-control' name='inputAno5' id="inputAno5" onchange="change()">   
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno'  GROUP BY `ano`");
                                $Linha = mysqli_num_rows($Consulta);
                                if ($Linha > 0) {
                                    echo "<option disabled = '' selected = '' value = '0'>Escolha o Histórico</option>";
                                    while ($registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $ano = $registro['ano'];
                                        $bimestre_turma = $registro['bimestre_turma'];
//
                                        if ($registro['status_bimestre_media'] == "5") {
                                            $aprovado = "Aprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "6") {
                                            $aprovado = "Reprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "4") {
                                            $aprovado = "Desistente";
                                        } elseif ($registro['status_bimestre_media'] == "3") {
                                            $aprovado = "Transferido(a)";
                                        }else {
                                            $aprovado = "Sem Resultado";
                                        }
                                        //
                                        echo "<option value = '$ano'>$bimestre_turma - $ano / $aprovado </option>";
                                    }
                                } else {
                                    echo "<option disabled = '' selected = '' value = '0'>O Aluno(a) Não Tem Histórico:)</option>";
                                }
                                ?>
                            </select>
                        </div>                                        

                        <div class="col-sm-6">                           
                            <label class="radio-inline"><input type="radio" name="optradio5" value="sim">Ainda Cursando</label>
                            <label class="radio-inline"><input type="radio" name="optradio5" checked="" value="nao">Ano Completo</label>
                        </div>
                    </div> 
                </div><br>              
                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputEja1" class="col-sm-3 control-label">Eja I</label>
                        <div class="col-sm-3">
                            <select class='form-control' name='inputEja1' id="inputeja1" onchange="change()">   
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno'  GROUP BY `ano`");
                                $Linha = mysqli_num_rows($Consulta);
                                if ($Linha > 0) {
                                    echo "<option disabled = '' selected = '' value = '0'>Escolha o Histórico</option>";
                                    while ($registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $ano = $registro['ano'];
                                        $bimestre_turma = $registro['bimestre_turma'];
//
                                        if ($registro['status_bimestre_media'] == "5") {
                                            $aprovado = "Aprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "6") {
                                            $aprovado = "Reprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "4") {
                                            $aprovado = "Desistente";
                                        } elseif ($registro['status_bimestre_media'] == "3") {
                                            $aprovado = "Transferido(a)";
                                        }else {
                                            $aprovado = "Sem Resultado";
                                        }
                                        //
                                        echo "<option value = '$ano'>$bimestre_turma - $ano / $aprovado </option>";
                                    }
                                } else {
                                    echo "<option disabled = '' selected = '' value = '0'>O Aluno(a) Não Tem Histórico :)</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">                           
                            <label class="radio-inline"><input type="radio" name="optradioEja1" value="sim">Ainda Cursando</label>
                            <label class="radio-inline"><input type="radio" name="optradioEja1" checked="" value="nao">Ano Completo</label>
                        </div>
                    </div>                                    
                </div>
                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputEja2" class="col-sm-3 control-label">Eja II</label>
                        <div class="col-sm-3">
                            <select class='form-control' name='inputEja2'id="inputeja2" onchange="change()">   
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$id_aluno'  GROUP BY `ano`");
                                $Linha = mysqli_num_rows($Consulta);
                                if ($Linha > 0) {
                                    echo "<option disabled = '' selected = '' value = '0'>Escolha o Histórico</option>";
                                    while ($registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $ano = $registro['ano'];
                                        $bimestre_turma = $registro['bimestre_turma'];
//
                                        if ($registro['status_bimestre_media'] == "5") {
                                            $aprovado = "Aprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "6") {
                                            $aprovado = "Reprovado(a)";
                                        } elseif ($registro['status_bimestre_media'] == "4") {
                                            $aprovado = "Desistente";
                                        } elseif ($registro['status_bimestre_media'] == "3") {
                                            $aprovado = "Transferido(a)";
                                        }else {
                                            $aprovado = "Sem Resultado";
                                        }
                                        //
                                        echo "<option value = '$ano'>$bimestre_turma - $ano / $aprovado </option>";
                                    }
                                } else {
                                    echo "<option disabled = '' selected = '' value = '0'>O Aluno(a) Não Tem Histórico :)</option>";
                                }
                                ?>
                            </select>
                        </div>  
                        <div class="col-sm-6">                           
                            <label class="radio-inline"><input type="radio" name="optradioEja2" value="sim">Ainda Cursando</label>
                            <label class="radio-inline"><input type="radio" name="optradioEja2" checked="" value="nao">Ano Completo</label>
                        </div>
                    </div>                                    
                </div><br>  
                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="input1ano" class="col-sm-3 control-label"> Ações</label>
                        <div class="col-sm-2">
                            <button type="submit" name="botao" value="montar" class="btn btn-success btn-block" >Montar </button>                           
                        </div>
                        <div class="col-sm-2">                                                  
                            <button type="submit" name="botao"  value="pdf" class="btn btn-primary btn-block" >PDF </button>                
                        </div> 
                        <!--                        <div class="col-sm-1">                                                  
                                                    <a href="javascript:history.back()" class="btn btn-warning btn-block">Voltar</a>
                                                </div> -->
                        <div class="col-sm-2">                           
                            <button type="reset" class="btn btn-danger btn-block">Limpar</button>
                        </div>
                    </div>                                    
                </div>
                <br>
                <style>
                    #inputobs{
                        width: 85%;
                    }
                </style>                             
            </form>
        </div>         
    </body>
    <script type="text/javascript">
        function change() {
            var texto = $('#inputAno1 option:selected').text(); // armazendando em variavel
            var texto2 = $('#inputAno2 option:selected').text(); // armazendando em variavel
            var texto3 = $('#inputAno3 option:selected').text(); // armazendando em variavel
            var texto4 = $('#inputAno4 option:selected').text(); // armazendando em variavel
            var texto5 = $('#inputAno5 option:selected').text(); // armazendando em variavel
            var textoeja1 = $('#inputeja1 option:selected').text(); // armazendando em variavel
            var textoeja2 = $('#inputeja2 option:selected').text(); // armazendando em variavel
            //
            if (texto == texto2 || texto == texto3 || texto == texto4 || texto == texto5 || texto == textoeja1 || texto == textoeja2) {
                alert("O Campo Ano não Deve ser Repetido! Ou Ficar em Branco.");
            }
        }
    </script>   
    <script type="text/javascript">
        function () {
            window.open("/Escola/montar_transferencia_rosto_server.php?id=<?php echo $Recebe_id ?>", "_blank");
        }
    </script>
    <script type="text/javascript">
        function maiuscula(z) {
            v = z.value.toUpperCase();
            z.value = v;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#inputTurma').change(function () {
                if ($('#inputTurma').val() !== 'branco') {
                    $('#folha_rosto').removeAttr('disabled');
                }
            });
        });
    </script>    
</html>
