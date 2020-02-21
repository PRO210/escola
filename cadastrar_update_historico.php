<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_aluno = base64_decode($Recebe_id);
//
session_start();
$ano = $_SESSION['inputAno'];

if (empty($_SESSION['msg'])) {
    
} elseif ($_SESSION['msg'] == "certo") {
    echo "<script type='text/javascript'>
                alert('Alterações Realizadas com Sucesso');
          </script>";
    unset($_SESSION['msg']);
} elseif ($_SESSION['msg'] == "erro") {
    echo "<script type='text/javascript'>
                alert('Ops! Ocorreu algum Erro. Verifique os Dados e se possível comunique ao Admistrador. ');
          </script>";
    unset($_SESSION['msg']);
}
//
$Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$id_aluno' ");
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$nome = $Linha['nome'];
$turmaf = $Linha['turma'];
$status = $Linha['status'];
//
$SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
$Consulta_turma = mysqli_query($Conexao, $SQL_turma);
$Linha_turma = mysqli_fetch_array($Consulta_turma);
//
$ano_turma = substr($Linha_turma["ano"], 0, -6);
$nome_turma = $Linha_turma["turma"];
$turno_turma = $Linha_turma["turno"];
$ano_turma = substr($Linha_turma["ano"], 0, -6);
if ($ano_turma == "2018") {
    $unico_turma = "";
} else {
    $unico_turma = $Linha_turma["unico"];
}
$turma = "$nome_turma $unico_turma ($turno_turma)";
//
$dataAtual = date('Y');
//
$ConsultaTeste = mysqli_query($Conexao, "SELECT * FROM `bimestre_i` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' ");
$LinhaTeste = mysqli_num_rows($ConsultaTeste);
//
if ($LinhaTeste == "0") {
    header("LOCATION: cadastrar_historico.php?id=$Recebe_id");
}
//
$Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` ORDER BY disciplina ");
$linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);

$escola = $linhaConsulta2['escola'];
$ano_turma = $linhaConsulta2['ano_turma'];
$escola_horas = $linhaConsulta2['aluno'];
$aluno_dias = $linhaConsulta2['aluno_dias'];
$frequencia = $linhaConsulta2['frequencia'];
$escola_media = $linhaConsulta2['escola_media'];
$cidade = $linhaConsulta2['cidade_media'];
$uf = $linhaConsulta2['uf'];
$bimetre_turma = $linhaConsulta2['bimestre_turma'];
$bimetre_turno = $linhaConsulta2['bimestre_turno'];
$bimetre_unico = $linhaConsulta2['bimestre_unico'];
$bimetre_status = $linhaConsulta2['status_bimestre_media'];
$bimetre_recupera = $linhaConsulta2['bimestre_recupera'];
//
$inputObs = $linhaConsulta2['obs_bimestre_media'];
$inputObs2 = $linhaConsulta2['obs_bimestre_media_ii'];
$inputObs3 = $linhaConsulta2['obs_bimestre_media_iii'];
$inputObs4 = $linhaConsulta2['obs_bimestre_media_iv'];
$inputObs5 = $linhaConsulta2['obs_bimestre_media_v'];
$inputObs6 = $linhaConsulta2['obs_bimestre_media_vi'];
$inputObs7 = $linhaConsulta2['obs_bimestre_media_vii'];
$inputObs8 = $linhaConsulta2['obs_bimestre_media_viii'];
$inputObs9 = $linhaConsulta2['obs_bimestre_media_ix'];
//
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CADASTRAR ALTERAÇÕES NO HISTÓRICO</title>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/cadastrar_update_historico.css" rel="stylesheet" type="text/css"/>   
        <script src="js/cadastrar_update_historico.js" type="text/javascript"></script>
    </head>
    <body>       
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <div class="container-fluid"> 
            <form class="form-inline" action="cadastrar_update_historico_server.php" method="post" name="form" id="form" onsubmit="return confirmarAtualizacao()" >
                <input type="hidden" class="form-control" id="" name="inputNome" value="<?php echo $Recebe_id ?>" >
                <input type="hidden" class="form-control" id="" name="inputAno" value="<?php echo $ano ?>" >
                <div class="row">
                    <div class="col-sm-12">
                        <h4 style="text-align: center">HISTÓRICO DO(A) ALUNO(A)&nbsp;: &nbsp;<b><?php echo"$nome" ?>,&nbsp;</b>Turma Atual &nbsp;: <?php echo"$turma" ?></h4>

                        <div class="col-sm-3 DivSm4">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <div class='dropdown'>
                                                <span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>
                                                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                                    <li><a href='pesquisar_impressao_historico_nota.php?id=<?php echo"$Recebe_id" ?>' target='_blank' title='Histórico'><span class='glyphicon glyphicon-print  btn-lg verde ' aria-hidden='true'>&nbsp;</span>Histórico Atual</a></li>
                                                    <li><a href='pesquisar_impressao_historico_notas.php?id=<?php echo"$Recebe_id" ?>' target='_blank' title='Históricos'><span class='glyphicon glyphicon-print  btn-lg verde ' aria-hidden='true'>&nbsp;</span>Todos os Históricos</a></li>
                                                </ul>
                                                &nbsp; <input type = 'checkbox' name = 'inputBimestre' value = 'Bmedia2' class= 'b0' id = 'Bmedia'>
                                                &nbsp;&nbsp; DADOS DO ALUNO(A) <br>

                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
<!--                                    <tr>                                
                                        <td>TURMA ATUAL:</td>
                                        <td><?php echo $turma ?></td>
                                    </tr>  -->
                                    <tr>                               
                                        <td>DIAS LETIVOS:</td>
                                        <td><input class="borda" type='number'step="1" min="0" name='inputAlunoD' value = "<?php echo $aluno_dias ?>"></td>
                                    </tr>  
                                    <tr>
                                        <td>FREQUENCIA % </td>
                                        <td><input class="borda" type='number' step="0.1" min="0" max="100" name='inputFrequencia' value = "<?php echo $frequencia ?>"></td>
                                    </tr>
                                    <tr>                                
                                        <td>TURMA:</td>
                                        <td><input  class= "borda" type='text' name='inputBimestreTurma' value = "<?php echo $bimetre_turma ?>" onkeyup='maiuscula(this)'></td>
                                    </tr>
                                    <tr>
                                        <td>TURNO:</td>
                                        <td><input  class="borda" type='text' name='inputBimestreTurno' value = "<?php echo $bimetre_turno ?>" onkeyup='maiuscula(this)'></td>
                                    </tr>
                                    <tr>                               
                                        <td>ÚNICO:</td>
                                        <td><input  class="borda" type='text' name='inputBimestreUnico' value = "<?php echo $bimetre_unico ?>" onkeyup='maiuscula(this)'></td>
                                    </tr>
                                    <tr>      
                                        <td>RECUPERAÇÃO:</td>
                                        <td>
                                            <?php
                                            if ($bimetre_recupera == "S") {
                                                ?>
                                                <label class="checkbox-inline"><input type="radio" name="inputBimestreRecupera" value="N" class="radioNao" >NÃO</label>
                                                <label class="checkbox-inline"><input type="radio" name="inputBimestreRecupera" value="S" checked="" class="radioSim">SIM</label>
                                            <?php } else { ?>
                                                <label class="checkbox-inline"><input type="radio" name="inputBimestreRecupera" value="N" checked="" class="radioNao">NÃO</label>
                                                <label class="checkbox-inline"><input type="radio" name="inputBimestreRecupera" value="S" class="radioSim">SIM</label>
                                            <?php } ?>
                                        </td>
                                    </tr>                                
                                    <tr>                               
                                        <td>RESULTADO FINAL:</td>
                                        <td>                                            
                                            <select class="form-control borda" name="inputBimestreStatus" id="">
                                                <?php
                                                $txt_option_status6 = "REPROVADO";
                                                $txt_option_status3 = "TRANSFERIDO";
                                                $txt_option_status2 = "ADIMITIDO DEPOIS";
                                                $txt_option_status4 = "DESISTENTE";
                                                $txt_option_status5 = "APROVADO";
                                                //
                                                if ($bimetre_status == "3") {
                                                    echo "<option selected = '3' value = '3'>$txt_option_status3</option>";
                                                    echo "<option value = '1'>CURSANDO</option>";
                                                    echo "<option  value = '4'>$txt_option_status4</option>";
                                                    echo "<option  value = '5'>$txt_option_status5</option>";
                                                    echo "<option value = '6' >$txt_option_status6</option>";
                                                    //
                                                } elseif ($bimetre_status == "6") {
                                                    echo "<option selected = '' value = '6' >$txt_option_status6</option>";
                                                    echo "<option value = '3'>$txt_option_status3</option>";
                                                    echo "<option value = '4'>$txt_option_status4</option>";
                                                    echo "<option value = '5'>$txt_option_status5</option>";
                                                    echo "<option value = '1'>CURSANDO</option>";
                                                    //
                                                } elseif ($bimetre_status == "4") {
                                                    echo "<option selected = '' value = '4'>$txt_option_status4</option>";
                                                    echo "<option value = '1'>CURSANDO</option>";
                                                    echo "<option value = '3'>$txt_option_status3</option>";
                                                    echo "<option value = '5'>$txt_option_status5</option>";
                                                    echo "<option value = '6'>$txt_option_status6</option>";
                                                    //
                                                } elseif ($bimetre_status == "5") {
                                                    echo "<option selected = ''  value = '5'>$txt_option_status5</option>";
                                                    echo "<option value = '1'>CURSANDO</option>";
                                                    echo "<option value = '3'>$txt_option_status3</option>";
                                                    echo "<option value = '4'>$txt_option_status4</option>";
                                                    echo "<option value = '6'>$txt_option_status6</option>";
                                                    //
                                                } elseif ($bimetre_status == "2") {
                                                    echo "<option selected = ''  value = '2'>$txt_option_status2</option>";
                                                    echo "<option value = '1'>CURSANDO</option>";
                                                    echo "<option value = '3'>$txt_option_status3</option>";
                                                    echo "<option value = '4'>$txt_option_status4</option>";
                                                    echo "<option value = '6'>$txt_option_status6</option>";
                                                } else {
                                                    echo "<option selected = '' value = '1'>ESCOLHA AQUI</option>";
                                                    echo "<option value = '3'>$txt_option_status3</option>";
                                                    echo "<option value = '4'>$txt_option_status4</option>";
                                                    echo "<option value = '5'>$txt_option_status5</option>";
                                                    echo "<option value = '6'>$txt_option_status6</option>";
                                                }
                                                ?>    
                                            </select> 
                                        </td>
                                    </tr>
                                    <tr>                               
                                        <td>STATUS ATUAL DO ALUNO:</td>
                                        <td>                                            
                                            <select class="form-control borda" name="status" id="">
                                                <?php
                                                $status1 = "CURSANDO";
                                                $status3 = "TRANSFERIDO";
                                                $status2 = "ADIMITIDO DEPOIS";
                                                $status4 = "DESISTENTE";
                                                $status5 = "NÃO RENOVADO";
                                                //
                                                if ($status == "TRANSFERIDO") {
                                                    echo "<option selected = '3' >$status3</option>";
                                                    echo "<option >CURSANDO</option>";
                                                    echo "<option >$status2</option>";
                                                    echo "<option >$status4</option>";
                                                    echo "<option >$status5</option>";
                                                } elseif ($status == "DESISTENTE") {
                                                    echo "<option selected = '' >$status4</option>";
                                                    echo "<option >$status1</option>";
                                                    echo "<option >$status2</option>";
                                                    //  echo "<option >$status3</option>";                                                   
                                                    echo "<option >$status5</option>";
                                                } elseif ($status == "ADIMITIDO DEPOIS") {
                                                    echo "<option selected = '' >$status2</option>";
                                                    echo "<option >CURSANDO</option>";
                                                    // echo "<option >$status3</option>";
                                                    echo "<option >$status4</option>";
                                                    echo "<option >$status5</option>";
                                                } elseif ($status == "NÃO RENOVADO") {
                                                    echo "<option selected = '' >$status5</option>";
                                                    echo "<option >CURSANDO</option>";
                                                    // echo "<option >$status3</option>";
                                                    echo "<option >$status4</option>";
                                                } else {
                                                    echo "<option selected = '' >$status1</option>";
                                                    echo "<option >$status2</option>";
                                                    //   echo "<option >$status3</option>";
                                                    echo "<option >$status4</option>";
                                                    echo "<option >$status5</option>";
                                                }
                                                ?>    
                                            </select> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-5 DivSm4">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2"> <input type = 'checkbox' name = 'inputBimestre' value = 'Bmedia2' class= 'b0' id = 'Bmedia'> &nbsp; &nbsp;DADOS DA ESCOLA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>                              
                                        <td style="width: 20%;">NOME DA ESCOLA:</td>
                                        <td><input class="borda" type='text' name='inputEscola_media' value = "<?php echo $escola_media ?>" onkeyup='maiuscula(this)'></td>
                                    </tr>
                                    <tr>                              
                                        <td>CIDADE:</td>
                                        <td><input class="borda" type='text' name='inputCidade' value = "<?php echo $cidade ?>" onkeyup='maiuscula(this)'></td>
                                    </tr>
                                    <tr>                              
                                        <td>ESTADO:</td>
                                        <td><input class="borda" type='text' name='inputUf' value = "<?php echo $uf ?>" onkeyup='maiuscula(this)'></td>
                                    </tr>
                                    <tr>                              
                                        <td colspan = '2'>DIAS LETIVOS:&nbsp;&nbsp;
                                            <input class="" type='number' step="1" min="0" name='inputEscola' value = "<?php echo $escola ?>">
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan = '2'> HORAS LETIVAS:&nbsp;&nbsp;
                                            <input class="" type='number' step="1" min="0" name='inputEscolaH' value = "<?php echo $escola_horas ?>">
                                        </td>

                                    </tr>
                                    <tr >                                
                                        <td colspan = '2'>ANO DO HISTÓRICO:&nbsp;&nbsp;
                                            <input  class= "" type='text' name='inputAno' value = "<?php echo $ano ?>" readonly="" onkeyup='maiuscula(this)'>
                                        </td>
                                        <!--<td><input  class= "borda" type='text' name='inputAno' value = "<?php echo $ano ?>" disabled="" onkeyup='maiuscula(this)'></td>-->
                                        <!--<td><input  class= "borda" type='hidden' name='inputAnoAtual' value = "<?php echo $ano ?>" onkeyup='maiuscula(this)'></td>-->
                                    </tr>  
                                    <tr>
                                        <td colspan = '2'> Turma_Ano:&nbsp;&nbsp;
                                            <select name="ano_turma" class="form-control">
                                                <?php
                                                $turma = ['INFANTIL','1 ANO', '2 ANO', '3 ANO', '4 ANO', '5 ANO', 'EJA I', 'EJA II'];
                                                for ($index = 0; $index < count($turma); $index++) {

                                                    if ($turma[$index] == "$ano_turma") {
                                                        echo "<option value = '$turma[$index]' selected = ''>" . $turma[$index] . "</option>";
                                                    } else {
                                                        echo "<option value = '$turma[$index]'>" . $turma[$index] . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4"> 
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2"><input type = 'checkbox' name = 'inputBimestre' value = 'Bmedia2' class= 'b0' id = 'Bmedia'> &nbsp; &nbsp;OBSERVAÇÕES:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type='text' name = 'inputObs' value= '<?php echo"$inputObs" ?>' maxlength = '52' class = 'inputObs' placeholder="COMECE A ESCREVER AQUI !" onkeyup='maiuscula(this)'></td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' name = 'inputObs2' value= '<?php echo"$inputObs2" ?>' maxlength = '52' class = 'inputObs'onkeyup='maiuscula(this)' ></td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' name = 'inputObs3' value= '<?php echo"$inputObs3" ?>' maxlength = '52' class = 'inputObs' onkeyup='maiuscula(this)'></td> 
                                    </tr>
                                    <tr>
                                        <td><input type='text' name = 'inputObs4' value= '<?php echo"$inputObs4" ?>' maxlength = '52' class = 'inputObs' onkeyup='maiuscula(this)'></td>    
                                    </tr>
                                    <tr>
                                        <td><input type='text' name = 'inputObs5' value= '<?php echo"$inputObs5" ?>' maxlength = '52' class = 'inputObs' onkeyup='maiuscula(this)'></td> 
                                    </tr>
                                    <tr>
                                        <td><input type='text' name = 'inputObs6' value= '<?php echo"$inputObs6" ?>' maxlength = '52' class = 'inputObs' onkeyup='maiuscula(this)'></td> 
                                    </tr>
                                    <tr>
                                        <td><input type='text' name = 'inputObs7' value= '<?php echo"$inputObs7" ?>' maxlength = '52' class = 'inputObs' onkeyup='maiuscula(this)'></td> 
                                    </tr>
                                    <tr>
                                        <td><input type='text' name = 'inputObs8' value= '<?php echo"$inputObs8" ?>' maxlength = '52' class = 'inputObs' onkeyup='maiuscula(this)'></td> 
                                    </tr>
<!--                                    <tr>
                                        <td><input type='text' name = 'inputObs9' value= '<?php echo"$inputObs9" ?>' maxlength = '52' class = 'inputObs' onkeyup='maiuscula(this)'></td> 
                                    </tr>-->
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div><br>              
                <div class="row">
                    <div class=" col-sm-3" >
                        <a href="cadastrar_historico.php?id=<?php echo "$Recebe_id"; ?>"> <button type="button" value="" title="" class="btn btn-primary btn-block" >Cadastrar Um Novo Histórico</button></a>                  
                    </div>
                    <div class=" col-sm-3" >
                        <button type="submit" value="Enviar" title="Marque Alguma Caixinha Para Usar Esse Botão!" class="btn btn-success btn-block" onclick="return validaCheckbox()" disabled="" id="button">Atualizar Esse Histórico</button>                       
                    </div>
                    <div class=" col-sm-3" >
                        <a href="solicitacao_transferencia.php?id=<?php echo "$Recebe_id"; ?>"> <button type="button" value="" title="" class="btn btn-warning btn-block" >Ir Para Solicitações de Transferências</button></a>                  
                    </div>
                    <div class=" col-sm-3" >
                        <a href="principal.php"><button type="button" value="" title="Fechar a Página" class="btn btn-danger btn-block" onclick=""  id="button">Menu Principal</button></a>                     
                    </div>
                </div>                
                <div class="row">
                    <div class="col-sm-12">                         
                        <?php
                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE excluido = 'N' ORDER BY ficha_descritiva");
                        echo "<br>";
                        echo "<table class='table table-striped table-bordered' id=''>";
                        echo "<th class = 'inputnotas '>BIMESTRES</th>";
                        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                            // $id = $linha['id'];
                            $disciplina = $linha['disciplina'];
                            $id = $linha['id'];
                            // array_push($arrayDisciplinas, $linha['id']);

                            echo "<th class = 'disciplinas'>" . $disciplina . "</th>";
                            echo "<input type='hidden' name='dd[]' value = '$id'>";
                            echo "<input type='hidden' name='disciplina[]' value = '$disciplina'>";
                        }
                        echo "<th>FALTAS</th>";
                        echo "</tr>";

                        echo "<tr id = 'trum'>";
                        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_I_disciplina` AND `excluido` = 'N' ORDER BY ficha_descritiva ");

                        echo "<th><input type = 'checkbox' name = 'inputBimestre' value= 'B1' class='b1' id = 'um' >&nbsp;&nbsp;B - I</th>";
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $nota = $linhaConsulta2['nota'];
                            $faltas = $linhaConsulta2['faltas'];
                            $id_bimestre_I_disciplina = $linhaConsulta2['id_bimestre_I_disciplina'];

                            //
                            echo "<th><input type='number' name='nn[]' value = '$nota' step='0.01' min='0' max='10'  class = 'inputnotas'></th>";

                            //
                        }
                        echo "<th><input type='text' name='inputFalta1' value = '$faltas' class = 'inputnotas '></th>";
                        echo "</tr>";
//Bimestre II              
                        echo "<tr>";
                        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                            // $id = $linha['id'];
                            $disciplina = $linha['disciplina'];
                            $id = $linha['id'];
                            // array_push($arrayDisciplinas, $linha['id']);

                            echo "<th>" . $disciplina . "</th>";
                        }
                        echo "</tr>";
                        echo "<tr  id = 'dois'>";
                        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_II_disciplina` AND `excluido` = 'N' ORDER BY ficha_descritiva ");
//
                        echo "<th><input type = 'checkbox' name = 'inputBimestre' value = 'B2' class= 'b1' id = 'chdois'>&nbsp;&nbsp;B - II</th>";
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $nota = $linhaConsulta2['nota'];
                            $faltas = $linhaConsulta2['faltas'];

                            //
                            // echo "<th>" . "$nota" . "</th>";
                            echo "<th><input type='number' name='nn2[]' value = '$nota' step='0.01' min='0' max='10'  class = 'inputnotas'></th>";

                            //
                        }
                        echo "<th><input type='text' name='inputFalta2' value = '$faltas' class = 'inputnotas'></th>";
                        echo "</tr>";
//Bimestre III                    
                        echo "<tr>";
                        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                            // $id = $linha['id'];
                            $disciplina = $linha['disciplina'];
                            $id = $linha['id'];
                            // array_push($arrayDisciplinas, $linha['id']);

                            echo "<th>" . $disciplina . "</th>";
                        }
                        echo "</tr>";
                        echo "<tr id = 'tres'>";
                        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_III_disciplina` AND `excluido` = 'N' ORDER BY ficha_descritiva ");
//
                        echo "<th><input type = 'checkbox' name = 'inputBimestre' value = 'B3' class= 'b1' id = 'chtres'>&nbsp;&nbsp;B - III</th>";
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $nota = $linhaConsulta2['nota'];
                            $faltas = $linhaConsulta2['faltas'];
                            //                            
                            echo "<th><input type='number' name='nn3[]' value = '$nota' step='0.01' min='0' max='10'  class = 'inputnotas'></th>";
                            //
                        }
                        echo "<th><input type='text' name='inputFalta3' value = '$faltas' class = 'inputnotas'></th>";

                        echo "</tr>";
//Bimestre IV               //Bimestre IV
                        echo "</tr>";
                        echo "<tr>";
                        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                            // $id = $linha['id'];
                            $disciplina = $linha['disciplina'];
                            $id = $linha['id'];
                            // array_push($arrayDisciplinas, $linha['id']);

                            echo "<th>" . $disciplina . "</th>";
                        }
// 
                        echo "</tr>";
                        echo "<tr id = 'quatro'>";
                        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_IV_disciplina` AND `excluido` = 'N' ORDER BY ficha_descritiva ");
//
                        echo "<th><input type = 'checkbox' name = 'inputBimestre' value = 'B4' class= 'b1' id = 'chquatro' >&nbsp;&nbsp;B - IV</th>";
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $nota = $linhaConsulta2['nota'];
                            $faltas = $linhaConsulta2['faltas'];

                            //
                            echo "<th><input type='number' name='nn4[]' value = '$nota' step='0.01' min='0' max='10'  class = 'inputnotas'></th>";

                            //
                        }
                        echo "<th><input type='text' name='inputFalta4' value = '$faltas' class = 'inputnotas'></th>";

                        echo "</tr>";
//
//Bimestre final                                        //Bimestre final
                        echo "<tr>";
                        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                            // $id = $linha['id'];
                            $disciplina = $linha['disciplina'];
                            $id = $linha['id'];
                            // array_push($arrayDisciplinas, $linha['id']);

                            echo "<th>" . $disciplina . "</th>";
                        }
//  
                        echo "</tr>";
                        echo "<tr id = 'media'>";
                        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` AND `excluido` = 'N'  ORDER BY ficha_descritiva ");
//
                        echo "<th><input type = 'checkbox' name = 'inputBimestre' value = 'Bmedia' class= 'b1' id = 'chmedia' >&nbsp;&nbsp;MÉDIA FINAL</th>";
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $nota = $linhaConsulta2['nota'];
                            $faltas = $linhaConsulta2['faltas'];
                            $id_disciplina = $linhaConsulta2['id_bimestre_media_disciplina'];
                            //
                            echo "<th><input type='number' name='nnmedia[]' value = '$nota' step='0.01' min='0' max='10'  class = 'inputnotas'></th>";
                            //
                        }
                        echo "<th><input type='text' name='inputFaltaM' value = '$faltas' class = 'inputnotas'></th>";

                        echo "</tr>";
//
//Recuperação Final Nota                                   //Recuperação Final Nota                  
                        echo "<tr>";
                        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                            // $id = $linha['id'];
                            $disciplina = $linha['disciplina'];
                            $id = $linha['id'];
                            // array_push($arrayDisciplinas, $linha['id']);

                            echo "<th>" . $disciplina . "</th>";
                        }
                        echo "</tr>";
                        echo "<tr id = 'recuperacao_nota'>";
                        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_recuperacao_final_disciplina` AND `excluido` = 'N' ORDER BY ficha_descritiva ");
//
                        echo "<th><input type = 'checkbox' name = 'inputBimestre' value = 'recuperacao' class= 'b1' id = 'chRecuperaNota' >&nbsp;&nbsp;RECUPERAÇÃO FINAL</th>";
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $nota = $linhaConsulta2['nota'];
                            //
                            echo "<th><input type='number' name='recuperacao_nota[]' value = '$nota' step='0.01' min='0' max='10'  class = 'inputnotas'></th>";
                            //
                        }
                        echo "</tr>";
//Recuperação Final Média                       
                        echo "<tr>";

                        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                            // $id = $linha['id'];
                            $disciplina = $linha['disciplina'];
                            $id = $linha['id'];
                            // array_push($arrayDisciplinas, $linha['id']);

                            echo "<th>" . $disciplina . "</th>";
                        }
                        echo "</tr>";
                        echo "<tr id='recuperacao_media'>";
                        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_recuperacao_final_disciplina` AND `excluido` = 'N' ORDER BY ficha_descritiva ");
//
                        echo "<th><input type = 'checkbox' name = 'inputBimestre' value = 'recuperacao_media' class= 'b1' id = 'chRecuperaMedia'>&nbsp;&nbsp;MÉDIA DA<br>RECUPERAÇÃO FINAL</th>";
                        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
                            $media = $linhaConsulta2['media'];
                            echo "<th><input type='number' name='recuperacao_media[]' value = '$media' step='0.01' min='0' max='10'  class = 'inputnotas'></th>";
                        }
                        echo "</tr>";

                        echo "</tbody>";
                        echo "</table>";
                        echo"</div>";
                        ?>                    
                    </div>
                </div>
            </form>
        </div>
        <style>
            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                padding: 6px !important;
            }
        </style>
    </body>      
    <script type="text/javascript">
        $('input').on("input", function (e) {
            $(this).val($(this).val().replace('"', ""));
            $(this).val($(this).val().replace("'", ""));

        });
    </script>
<!--    <script type="text/javascript">
        $(document).ready(function () {
            $('#um').click(function () {
                if ($('#um').is(':checked')) {
//                    $('#dois').hide(2000);
//                    $('#tres').hide(2000);
//                    $('#quatro').hide(2000);
//                    $('#media').hide(2000);
//                    $('#recuperacao_nota').hide(2000);
//                    $('#recuperacao_media').hide(2000);
                } else {
                    $('#dois').show(2000);
                    $('#tres').show(2000);
                    $('#quatro').show(2000);
                    $('#media').show(2000);
                    $('#recuperacao_nota').show(2000);
                    $('#recuperacao_media').show(2000);
                }
            });
        });
    </script>-->    


    <script type="text/javascript">
        $(document).ready(function () {
            $('.radioSim').click(function () {
                if ($('.radioSim').is(':checked')) {

                    $('#trum').hide(2000);
                    $('#dois').hide(2000);
                    $('#tres').hide(2000);
                    $('#quatro').hide(2000);
                    //$('#media').hide(2000);
                    $('#recuperacao_nota').show(2000);
                    $('#recuperacao_media').show(2000);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.radioNao').click(function () {
                if ($('.radioNao').is(':checked')) {

                    $('#trum').show(2000);
                    $('#dois').show(2000);
                    $('#tres').show(2000);
                    $('#quatro').show(2000);
                    // $('#media').show(2000);
                    $('#recuperacao_nota').hide(2000);
                    $('#recuperacao_media').hide(2000);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            if ($('.radioNao').is(':checked')) {
                $('#recuperacao_nota').hide();
                $('#recuperacao_media').hide();
            }
        });
    </script>
</html>
