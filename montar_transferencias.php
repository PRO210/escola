<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id_alunos = "";
$id_solicitacao = "";
foreach (($_POST['aluno_selecionado']) as $lista_id) {
    $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$lista_id' ");
    $rowf = mysqli_fetch_array($Consultaf);
    $id_alunos .= $rowf['id_aluno_solicitacao'] . ",";
    $id_solicitacao .= $rowf['id_solicitacao'] . ",";
}
//
$nome = "";
$result = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id`IN(" . substr($id_alunos, 0, -1) . ")");
$rows = mysqli_num_rows($result);


if ($rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $nome .= $row['nome'] . ", ";
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script> 
        <title>Montar Transferências</title>
    </head>
    <body>       
        <form name="" action="montar_transferencias_rostos_fpdf.php" method="post" class="form-horizontal">
            <input type="hidden" name="id_solicitacao" value="<?= substr($id_solicitacao, 0, -1) ?>">
            <div class="row">
                <div class="form-group col-sm-12"> 
                    <h4 class="text-center" style="margin: 24px!important "><?php echo substr($nome, 0, -1) ?></h4>
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
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="religiao" class="col-sm-2 control-label">Dispenda de Religião</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="religiao" id="" >
                            <option value="">NÃO SEI</option>
                            <option value="NAO">NÃO</option>
                            <option value="SIM">SIM</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="religiao" class="col-sm-2 control-label">Dispenda de Educação Física</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="fisica" id="" >
                            <option value="">NÃO SEI</option>
                            <option value="NAO">NÃO</option>
                            <option value="SIM">SIM</option>
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
                        <input type="text" id="inputobs" name="t1"  maxlength="85"  onkeyup="maiuscula(this)" value="">
                        <input type="text" id="inputobs" name="t2"  maxlength="85"  onkeyup="maiuscula(this)" value="">  
                        <input type="text" id="inputobs" name="t3"  maxlength="85"  onkeyup="maiuscula(this)" value="">
                        <input type="text" id="inputobs" name="t4"  maxlength="85"  onkeyup="maiuscula(this)" value="">
                        <input type="text" id="inputobs" name="t5"  maxlength="85"  onkeyup="maiuscula(this)" value="">
                        <input type="text" id="inputobs" name="t6"  maxlength="85"  onkeyup="maiuscula(this)" value="">   
                        <input type="text" id="inputobs" name="t7"  maxlength="85"  onkeyup="maiuscula(this)" value="">  
                    </div>
                </div>                  
            </div>
            <!--Folha de Rosto-->
            <div class="row">
                <div class="form-group col-sm-12"> 
                    <label for="input1ano" class="col-sm-2 control-label">Folha de Rosto</label> 
                    <div class="col-sm-4">                                                  
                        <button type="submit"  name = "folha_rosto" class="btn btn-success btn-block" id = "folha_rosto" disabled="" title = "Para Desbloquear Esse Botão Informe o Último Ano de Conclusão:) ">Montar</button>
                    </div>    
                    <div class="col-sm-4">                                                  
                        <a href="javascript:history.back()" class="btn btn-warning btn-block">Voltar</a>
                    </div>   
                </div>
            </div>












        </form>
    </body>
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
