<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_aluno = base64_decode($Recebe_id);
//
$Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$id_aluno' ");
$rowf = mysqli_fetch_array($Consultaf);
$id_aluno = $rowf['id_aluno_solicitacao'];
$id_solicitacao = $rowf['id_solicitacao'];
$t1 = $rowf['t1'];
$t2 = $rowf['t2'];
$t3 = $rowf['t3'];
$t4 = $rowf['t4'];
$t5 = $rowf['t5'];
$t6 = $rowf['t6'];
$t7 = $rowf['t7'];
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
$turmaf = $Linha['turma'];
//
$SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
$Consulta_turma = mysqli_query($Conexao, $SQL_turma);
$Linha_turma = mysqli_fetch_array($Consulta_turma);
//
$nome_turma = $Linha_turma["turma"];
$turno_turma = $Linha_turma["turno"];
$unico_turma = $Linha_turma["unico"];
$ano_turma = substr($Linha_turma["ano"],0,4);
$turma = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
//
$data = date("d-m-Y");
//
session_start();
if (empty($_SESSION['erro1'])) {
    session_destroy();
} elseif ($_SESSION['erro1'] == '1') {
    echo "<script type='text/javascript'>
    alert('Ops! Você Indicou um mesmo Histórico para dois Anos;Cada Histórico deve ser usado para um Único Ano.');
    </script>";
    session_destroy();
}
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
        <title>MONTAR TRANSFERÊNCIA</title>
    </head>
    <body>
        <div class="container">           
            <form name="" action="montar_transferencia_rosto_server.php" method="post" class="form-horizontal"  >
                <input type="hidden" name="inputId" value="<?php echo $id_aluno ?>">
                <input type="hidden" name="inputIdSolicitacao" value="<?php echo $id_solicitacao ?>">
                <h1 style=" text-align: center">Montar Folha de Rosto da  Transferência</h1>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" value="<?php echo $nome ?>">
                        </div>                      
                    </div>
                </div>
                <div class="row" >
                    <div class="form-group col-sm-12">                       
                        <label for="inputNome" class="col-sm-2 control-label">Turma</label>
                        <div class="col-sm-8">
                            <input type="text"  class="form-control" value="<?php echo $turma ?>">
                        </div>                           
                    </div>                      
                </div>               
<!--                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputNome" class="col-sm-2 control-label">Nascimento</label>
                        <div class="col-sm-8">
                            <input type="date"  class="form-control" value="<?php echo "$data_nascimento" ?>">
                        </div>                    
                    </div>                                    
                </div>-->
<!--                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputNome" class="col-sm-2 control-label">Cidade</label>
                        <div class="col-sm-8">
                            <input type="name"  class="form-control" value="<?php echo "$naturalidade" ?>">
                        </div>  
                    </div>                                    
                </div>
                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputUf" class="col-sm-2 control-label">UF/Nacionalidade</label>
                        <div class="col-sm-8">
                            <input type="name"  class="form-control" value="<?php echo "$estado/$nacionalidade" ?>">
                        </div>
                    </div> 
                </div>-->
                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputUf" class="col-sm-2 control-label">Mãe</label>
                        <div class="col-sm-8">
                            <input type="name"  class="form-control" value="<?php echo "$mae" ?>">
                        </div>                                     
                    </div>                                    
                </div>
<!--                <div class="row" >
                    <div class="form-group col-sm-12"> 
                        <label for="inputUf" class="col-sm-2 control-label">Pai</label>
                        <div class="col-sm-8">
                            <input type="name"  class="form-control" value="<?php echo "$pai" ?>">
                        </div>                        
                    </div>                                    
                </div>-->
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        <label for="inputConcluiu" class="col-sm-2 control-label">Concluíu o:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="inputConcluiu" id="inputTurma" >
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` ORDER BY ano DESC,turma ASC");
                                echo "<option  selected value = '' id = 'branco'>SELECIONE A TURMA DESEJADA AQUI ! </option>";
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $turma = $Registro["turma"];
                                    $turno = $Registro["turno"];
                                    $id_turma = $Registro["id"];
                                    $ano = date_format(new DateTime($Registro["ano"]), 'Y');
                                    echo "<option value = '$id_turma'>$turma ($turno) - $ano</option>";
                                }
                                ?>
                            </select> 
                        </div>  
                    </div>                                    
                </div>
                <br>
                <style>
                    #inputobs{
                        width: 100%;
                    }
                </style>
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        <label for="input1ano" class="col-sm-2 control-label">Observações</label>
                        <div class="col-sm-8">                              
                            <input type="text" id="inputobs" name="t1"  maxlength="85"  onkeyup="maiuscula(this)" value="<?php echo "$t1"; ?>">
                            <input type="text" id="inputobs" name="t2"  maxlength="85"  onkeyup="maiuscula(this)" value="<?php echo "$t2"; ?>">  
                            <input type="text" id="inputobs" name="t3"  maxlength="85"  onkeyup="maiuscula(this)" value="<?php echo "$t3"; ?>">
                            <input type="text" id="inputobs" name="t4"  maxlength="85"  onkeyup="maiuscula(this)" value="<?php echo "$t4"; ?>">
                            <input type="text" id="inputobs" name="t5"  maxlength="85"  onkeyup="maiuscula(this)" value="<?php echo "$t5"; ?>">
                            <input type="text" id="inputobs" name="t6"  maxlength="85"  onkeyup="maiuscula(this)" value="<?php echo "$t6"; ?>">   
                            <input type="text" id="inputobs" name="t7"  maxlength="85"  onkeyup="maiuscula(this)" value="<?php echo "$t7"; ?>">  
                        </div>
                    </div>                  
                </div>
                <!--Folha de Rosto-->
                <div class="row">
                    <div class="form-group col-sm-12"> 
                        <label for="input1ano" class="col-sm-2 control-label">Folha de Rosto</label> 
                        <div class="col-sm-3">                                                  
                            <button type="submit"  name = "folha_rosto" class="btn btn-success btn-block" id = "folha_rosto" disabled="" title = "Para Desbloquear Esse Botão Informe o Último Ano de Conclusão:) ">Montar</button>
                        </div>    
                        <div class="col-sm-2">                                                  
                            <a href="javascript:history.back()" class="btn btn-warning btn-block">Voltar</a>
                        </div>    
                        <div class="col-sm-3">                           
                            <button type="reset" class="btn btn-danger btn-block" id="reset" >Limpar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>           
    </body>   
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
