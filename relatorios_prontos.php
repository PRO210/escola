<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
$ano = date('Y');
//
$Cursando = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `status_ext` NOT LIKE 'SIM' AND excluido = 'N' GROUP BY turmas.id ");
$ContCursando = 0;
while ($Linha = mysqli_fetch_array($Cursando)) {
    $ContCursando += $Linha['qtd'];
}
//
$Matriculados = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' GROUP BY turmas.id ");
$ContMatriculados = 0;
while ($LinhaMatriculados = mysqli_fetch_array($Matriculados)) {
    $ContMatriculados += $LinhaMatriculados["qtd"];
}
//
$Cadastrados = mysqli_query($Conexao, "SELECT COUNT(*) AS qtd FROM alunos GROUP BY id ");
$ContCadastrados = 0;
while ($LinhaCadastrados = mysqli_fetch_array($Cadastrados)) {
    $ContCadastrados += $LinhaCadastrados["qtd"];
}
//
$ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
$Novatos = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `Data_matricula` BETWEEN '$ano_passado-12-13 00:00:00.000000' AND '$ano-12-13 00:00:00.000000' ORDER BY `nome` ASC, `excluido` ASC  ");
$ContNovatos = mysqli_num_rows($Novatos);
//
$Transferidos = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE  data_solicitacao LIKE '%2019%' GROUP BY id_aluno_solicitacao");
$ContTransferidos = mysqli_num_rows($Transferidos);
//
$Desistentes = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND (alunos.status = 'DESISTENTES') AND `status_ext` NOT LIKE 'SIM' AND excluido = 'N' GROUP BY turmas.id ");
$ContDesistentes = mysqli_num_rows($Desistentes);
//TRANSPORTE
$CursandoTransporte = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `transporte` LIKE 'SIM' AND `urbano` LIKE 'SIM' AND `status_ext` NOT LIKE 'SIM' AND excluido = 'N' GROUP BY turmas.id ");
$ContTransSimUrbano = 0;
while ($LinhaCursandoTransporte = mysqli_fetch_array($CursandoTransporte)) {
    $ContTransSimUrbano += $LinhaCursandoTransporte["qtd"];
}
//
$CursandoTransporte = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `transporte` LIKE 'SIM' AND `urbano` LIKE 'NAO' AND `status_ext` NOT LIKE 'SIM' AND excluido = 'N' GROUP BY turmas.id ");
$ContTransSimRural = 0;
while ($LinhaCursandoTransporte = mysqli_fetch_array($CursandoTransporte)) {
    $ContTransSimRural += $LinhaCursandoTransporte["qtd"];
}
//Matutino Rural
$CursandoTransporte = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND turmas.turno LIKE 'MATUTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `transporte` LIKE 'SIM' AND `urbano` LIKE 'NAO' AND `status_ext` NOT LIKE 'SIM' AND excluido = 'N' GROUP BY turmas.id ");
$ContTransSimRuralMat = 0;
while ($LinhaCursandoTransporte = mysqli_fetch_array($CursandoTransporte)) {
    $ContTransSimRuralMat += $LinhaCursandoTransporte["qtd"];
}
//Vespertino Rural
$CursandoTransporte = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND turmas.turno LIKE 'VESPERTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `transporte` LIKE 'SIM' AND `urbano` LIKE 'NAO' AND `status_ext` NOT LIKE '%SIM%' AND excluido = 'N' GROUP BY turmas.id ");
$ContTransSimRuralVesp = 0;
while ($LinhaCursandoTransporte = mysqli_fetch_array($CursandoTransporte)) {
    $ContTransSimRuralVesp += $LinhaCursandoTransporte["qtd"];
}
//NOTURNO Rural
$CursandoTransporte = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND turmas.turno LIKE 'NOTURNO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `transporte` LIKE 'SIM' AND `urbano` LIKE 'NAO' AND `status_ext` NOT LIKE '%SIM%' AND excluido = 'N' GROUP BY turmas.id ");
$ContTransSimRuralNot = 0;
while ($LinhaCursandoTransporte = mysqli_fetch_array($CursandoTransporte)) {
    $ContTransSimRuralNot += $LinhaCursandoTransporte["qtd"];
}
//Transporte sim, matutino;
$CursandoTransporte = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND turmas.turno LIKE 'MATUTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `transporte` LIKE 'SIM' AND `urbano` LIKE 'SIM' AND `status_ext` NOT LIKE '%SIM%' AND excluido = 'N' GROUP BY turmas.id ");
$ContTransSimMat = 0;
while ($LinhaCursandoTransporte = mysqli_fetch_array($CursandoTransporte)) {
    $ContTransSimMat += $LinhaCursandoTransporte["qtd"];
}
//Transporte sim, vespertino;
$CursandoTransporte = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND turmas.turno LIKE 'VESPERTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `transporte` LIKE 'SIM' AND `urbano` LIKE 'SIM' AND `status_ext` NOT LIKE '%SIM%' AND excluido = 'N' GROUP BY turmas.id ");
$ContTransSimVesp = 0;
while ($LinhaCursandoTransporte = mysqli_fetch_array($CursandoTransporte)) {
    $ContTransSimVesp += $LinhaCursandoTransporte["qtd"];
}
//Transporte sim, noturno;
$CursandoTransporte = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND turmas.turno LIKE 'NOTURNO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND `transporte` LIKE 'SIM' AND `urbano` LIKE 'SIM' AND alunos.status_ext NOT LIKE '%SIM%' AND excluido = 'N' GROUP BY turmas.id ");
$ContTransSimNot = 0;
while ($LinhaCursandoTransporte = mysqli_fetch_array($CursandoTransporte)) {
    $ContTransSimNot += $LinhaCursandoTransporte["qtd"];
}
$ConsultaMatutino = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turno LIKE 'MATUTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N' GROUP BY turmas.id ORDER BY ano DESC,`turmas`.`turma` ASC");
$ConsultaVespertino = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turno LIKE 'VESPERTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N'  GROUP BY turmas.id ORDER BY ano DESC,`turmas`.`turma` ASC");
$ConsultaNoturno = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turno LIKE 'NOTURNO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N' GROUP BY turmas.id ORDER BY ano DESC,`turmas`.`turma` ASC");
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>RELATÓRIO PADRÃO</title>
    </head>
    <body>
        <div class="container-fluid">
            <?php
            include_once './menu.php';
            ?>  
            <script src="js/bootstrap.js" type="text/javascript"></script>
            <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
            <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <h3 style="text-align: center">Relatório</h3>
            <div class="row">
                <div class="col-sm-3">                       
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th colspan="">STATUS DOS ALUNOS</th>                            
                                <th>Quant.</th>
                            </tr>                                
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan=""> Matriculados</td>
                                <td style="color: black"><?php echo "$ContMatriculados"; ?></td>
                            </tr>
                            <tr>
                                <td colspan="" > Cursando</td>
                                <td style="color: green"><?php echo "$ContCursando"; ?></td>
                            </tr>
                            <tr>
                                <td colspan="" > Transferidos</td>
                                <td style="color: red"><?php echo "$ContTransferidos"; ?></td>
                            </tr>
                            <tr>
                                <td colspan="" > Desistentes</td>
                                <td><?php echo "$ContDesistentes"; ?></td>
                            </tr>
                            <tr>
                                <th colspan="2"></th>                          
                            </tr> 
                        <thead>
                            <tr>
                                <th colspan="">TRANSPORTE</th>                           
                                <th>Quant.</th>                           
                            </tr> 
                        </thead>
                        <tr>
                            <td colspan=""> URBANO</td>                              
                            <td colspan=""> <?php echo"$ContTransSimUrbano" ?></td>                              
                        </tr>
                        <tr>
                            <td colspan="" style="text-align: center">MATUTINO </td>                              
                            <td colspan=""> <?php echo "$ContTransSimMat"; ?></td>                              
                        </tr>
                        <tr>
                            <td colspan="" style="text-align: center">VESPERTINO </td>                              
                            <td colspan=""> <?php echo "$ContTransSimVesp"; ?></td>                              
                        </tr>
                        <tr>
                            <td colspan="" style="text-align: center">NOTURNO</td>                              
                            <td colspan=""> <?php echo "$ContTransSimNot"; ?></td>                              
                        </tr>
                        <tr>
                            <td colspan=""> RURAL</td>                              
                            <td colspan=""><?php echo "$ContTransSimRural"; ?> </td>                              
                        </tr>
                        <tr>
                            <td colspan="" style="text-align: center"> MATUTINO</td>                              
                            <td colspan=""><?php echo "$ContTransSimRuralMat"; ?> </td>                              
                        </tr>
                        <tr>
                            <td colspan="" style="text-align: center"> VESPERTINO</td>                              
                            <td colspan=""><?php echo "$ContTransSimRuralVesp"; ?> </td>                              
                        </tr>
                        <tr>
                            <td colspan="" style="text-align: center"> NOTURNO</td>                              
                            <td colspan=""><?php echo "$ContTransSimRuralNot"; ?> </td>                              
                        </tr>
                        </tbody>
                    </table>   
                    <!--Alunos Cursano Por Turno Matutino-->
                    <table class='table table-striped table-bordered' >
                        <thead>
                            <tr>
                                <th>MATUTINO</th>
                                <th>Quant.</th>
                            </tr>                                
                        </thead>                       
                        <?php
                        $contMatutino = 0;
                        $contPas = 0;
                        $ano = date('Y');
                        while ($linhaMatutino = mysqli_fetch_array($ConsultaMatutino)) {
                            //
                            $turmaf = $linhaMatutino['turma'];
                            $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma, MYSQLI_BOTH);
                            //
                            $nome_turma = $Linha_turma["turma"];
                            $ano_turma = substr($Linha_turma["ano"], 0, - 6);
                            if ($ano_turma == "2018") {
                                $ano_unico = "";
                            } else {
                                $ano_unico = $Linha_turma["unico"];
                            }
                            $ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
                            $ano_futuro = date('Y', strtotime('+362 days', strtotime($ano)));
                            if ($ano_turma == "$ano_passado") {
                                $contPas += $linhaMatutino['qtd'];
                                $red = "red;";
                            }
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $nome_turma . " " . $ano_unico . " - " . $ano_turma; ?></td>                            
                                    <td style="color:<?= $red ?> "><?php echo $linhaMatutino['qtd']; ?></td>
                                </tr>
                                <?php
                                $contMatutino += $linhaMatutino['qtd'];
                            }
                            ?>
                            <tr>
                                <td style="text-align: right; font-weight: bold;">SOMA</td>
                                <td><?php echo $contMatutino; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--Alunos da TArde-->
                    <table class='table table-striped table-bordered'>                        
                        <thead>                            
                            <tr>
                                <th>VESPERTINO</th>
                                <th>Quant.</th>
                            </tr>                                
                        </thead>   
                        <?php
                        $contVespertino = 0;
                        $contPas = 0;
                        $red = "";
                        while ($linhaVespertino = mysqli_fetch_array($ConsultaVespertino)) {
                            //
                            $turmaf = $linhaVespertino['turma'];
                            $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma);
                            //
                            $ano_turma = substr($Linha_turma["ano"], 0, - 6);
                            $nome_turma = $Linha_turma["turma"];
                            if ($ano_turma == "2018") {
                                $ano_unico = "";
                            } else {
                                $ano_unico = $Linha_turma["unico"];
                            }
                            $ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
                            $ano_futuro = date('Y', strtotime('+362 days', strtotime($ano)));
                            if ($ano_turma == "$ano_passado") {
                                $contPas += $linhaVespertino['qtd'];
                                $red = "red;";
                            }
                            ?>
                            <tr>                          
                                <td><?php echo $nome_turma . " " . "$ano_unico" . " - " . $ano_turma; ?></td> 
                                <td style="color:<?= $red ?> "><?php echo $linhaVespertino['qtd']; ?></td>
                            </tr>
                            <?php
                            $contVespertino += $linhaVespertino['qtd'];
                        }
                        ?>                        
                        <tr>
                            <td style="text-align: right; font-weight: bold;">SOMA</td>
                            <td><?php echo $contVespertino; ?></td>
                        </tr>
                    </table>
                    <!--Alunos da Noite-->
                    <table class='table table-striped table-bordered'>                        
                        <thead>                            
                            <tr>
                                <th>NOTURNO</th>
                                <th>Quant.</th>
                            </tr>                                
                        </thead>   
                        <?php
                        $contNoturno = 0;
                        $MarqNoturno = 0;
                        $red = "";
                        while ($linhaNoturno = mysqli_fetch_array($ConsultaNoturno)) {
                            //
                            $turmaf = $linhaNoturno['turma'];
                            $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma);
                            //                       
                            $ano_turma = substr($Linha_turma["ano"], 0, - 6);
                            $nome_turma = $Linha_turma["turma"];
                            if ($ano_turma == "2018") {
                                $ano_unico = "";
                            } else {
                                $ano_unico = $Linha_turma["unico"];
                            }
                            $ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
                            $ano_futuro = date('Y', strtotime('+362 days', strtotime($ano)));
                            if ($ano_turma == "$ano_passado") {
                                $MarqNoturno += $linhaNoturno['qtd'];
                                $red = "red;";
                            }
                            ?>
                            <tbody>
                                <tr>
                                    <td style=""><?php echo $nome_turma . " " . "$ano_unico" . " - " . $ano_turma; ?></td> 
                                    <td style="color:<?= $red ?> "><?php echo $linhaNoturno['qtd']; ?></td>
                                </tr>
                                <?php
                                $contNoturno += $linhaNoturno['qtd'];
                            }
                            ?>
                            <tr>
                                <td style="text-align: right; font-weight: bold; ">SOMA</td>
                                <td><?php echo $contNoturno ?></td>                        
                            </tr>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>      
    </body>
</html>
