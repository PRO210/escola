<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Número de Alunos</title>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <?php
        $ConsultaMatutino = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turno LIKE 'MATUTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N' GROUP BY turmas.id ORDER BY ano DESC,`turmas`.`turma` ASC");
        $ConsultaVespertino = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turno LIKE 'VESPERTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N'  GROUP BY turmas.id ORDER BY ano DESC,`turmas`.`turma` ASC");
        $ConsultaNoturno = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turno LIKE 'NOTURNO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND excluido = 'N' GROUP BY turmas.id ORDER BY ano DESC,`turmas`.`turma` ASC");
        ?>
        <div class="container-fluid">           
            <div class="col-sm-4">
                <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <script src="js/cadastrar_validar.js" type="text/javascript"></script>
                <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
                <h3>Manhã</h3>
                <table class='table table-striped table-bordered' id='tbl_alunos_lista'>
                    <tr>
                        <th>Turma</th>
                        <th>Qtd. Alunos</th>
                    </tr>
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
                        <tr>
                            <td><?php echo $nome_turma . " " . $ano_unico . " - " . $ano_turma; ?></td>                            
                            <td style="color:<?= $red ?> "><?php echo $linhaMatutino['qtd']; ?></td>
                        </tr>
                        <?php
                        $contMatutinonhaMatutino['qtd'];
                    }
                    ?>
                    <tr>
                        <td style="text-align: right; font-weight: bold;">SOMA</td>
                        <td><?php echo $contMatutino; ?></td>
                    </tr>
                </table>
            </div>
            <!-- Vespertino-->
            <div class="col-md-4">
                <h3>Tarde</h3>
                <table class='table table-striped table-bordered' id='tbl_alunos_lista'>
                    <tr>
                        <th>Turma</th>
                        <th>Qtd. Alunos</th>
                    </tr>
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
            </div>
            <!--Noturno-->
            <div class="col-md-4">
                <h3>Noite</h3>
                <table class='table table-striped table-bordered' id='tbl_alunos_lista'>
                    <tr>
                        <th>Turma</th>
                        <th>Qtd. Alunos</th>
                    </tr>
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
                        <tr>
                            <td><?php echo $nome_turma . " " . "$ano_unico" . " - " . $ano_turma; ?></td> 
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
                </table>
            </div>
        </div>  
    </body> 
</html>
