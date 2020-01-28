<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$idcerto = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($idcerto == 1) {
    echo "<script type=\"text/javascript\">
		alert(\"Cadastro Alterado com Sucesso! \");
                </script>
                ";
} elseif ($idcerto == 2) {
    echo "<script type=\"text/javascript\">
		alert(\"Ops! Falha na Operação:) \");
                </script>
                ";
}
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PROFESSORES POR TURMA</title>  
        <style>
            td{font-size: 14px !important;
            }
        </style>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <script src="js/bootstrap.min.js" type="text/javascript"></script>
                    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <link href="css/alunos_transferidos.css" rel="stylesheet" type="text/css"/>
                    <form method="post" action="atualizar_varios.php" name="form1" >
                        <table id="" class="table table-striped table-bordered">
                            <thead>
                            <h3 style="text-align: center">Manhã</h3>
                            <tr>
                                <?php
                                $ano = date('Y');
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'MATUTINO' AND `status` LIKE 'OCUPADA' AND `ano` LIKE '$ano%' ORDER BY turma");
                                $numeroDeLinhas = mysqli_num_rows($Consulta);
                                $conadorLinhas = 1;
                                $arrayTurmas[] = "";

                                while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $turma = $ColConsulta['turma'];
                                    $unico = $ColConsulta['unico'];
                                    array_push($arrayTurmas, $ColConsulta['id']);
                                    // echo $ColConsulta['id'];
                                    $idM = $ColConsulta['id'];
                                    echo "<th> "
                                    . "<div class='dropdown'>"
                                    . " $turma  $unico"
                                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                    . "<li><a href='cadastrar_update_turma.php?id=" . base64_encode($idM) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                    . "</ul>"
                                    . "</div>"
                                    . "</th>";
                                    if ($conadorLinhas == 5) {
                                        break;
                                    }
                                    $conadorLinhas++;
                                }
                                // echo "$conadorLinhas";  
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                echo "<tr>";

                                array_shift($arrayTurmas);

                                foreach ($arrayTurmas as $idturma) {

                                    $Consulta2 = mysqli_query($Conexao, "SELECT s.nome FROM `turmas_professor2` tr, servidores s WHERE id_turma = $idturma  AND tr.id_professor = s.id");
                                    echo "<td>";
                                    $nomeProfessores = "";
                                    //
                                    while ($linhaConsulta = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {

                                        $teste_folga = "";
                                        $teste_nome = $linhaConsulta['nome'];
                                        $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                                        $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                                        $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                                        if ($ContLinhasAtestados > 0) {
                                            $dias = intval($linha_atestados['dias']);
                                            if ($dias >= 0) {
                                                $teste_folga = " /Está de Atestado; ";
                                            }
                                        }

                                        $nomeProfessores .= $linhaConsulta['nome'] . $teste_folga . '<br>';
                                    }
                                    echo $nomeProfessores;
                                    echo "</td>";
                                }
                                echo "</tr>";
                                ?>
                            </tbody>
                        </table>

                        <?php
                        if ($numeroDeLinhas > 5) {
                            ?>
                            <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>                              
                                    <tr>
                                        <?php
                                        $conadorLinhas = 1;
                                        $arrayTurmas[] = "";

                                        while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                                            $turma = $ColConsulta['turma'];
                                            $unico = $ColConsulta['unico'];
                                            $idM = $ColConsulta['id'];
                                            array_push($arrayTurmas, $ColConsulta['id']);
                                            echo "<th> "
                                            . "<div class='dropdown'>"
                                            . " $turma $unico"
                                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                            . "<li><a href='cadastrar_update_turma.php?id=" . base64_encode($idM) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                            . "</ul>"
                                            . "</div>"
                                            . "</th>";

                                            if ($conadorLinhas == 5) {
                                                break;
                                            }
                                            $conadorLinhas++;
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo "<tr>";
                                    // print_r($arrayTurmas);
                                    array_shift($arrayTurmas);
                                    array_shift($arrayTurmas);
                                    array_shift($arrayTurmas);
                                    array_shift($arrayTurmas);
                                    array_shift($arrayTurmas);
                                    array_shift($arrayTurmas);
                                    //print_r($arrayTurmas);

                                    foreach ($arrayTurmas as $idturma) {

                                        $Consulta2 = mysqli_query($Conexao, "SELECT s.nome FROM `turmas_professor2` tr, servidores s WHERE id_turma = $idturma  AND tr.id_professor = s.id");
                                        echo "<td>";
                                        $nomeProfessores = "";

                                        while ($linhaConsulta = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {

                                            $teste_folga = "";
                                            $teste_nome = $linhaConsulta['nome'];
                                            $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                                            $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                                            $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                                            if ($ContLinhasAtestados > 0) {
                                                $dias = intval($linha_atestados['dias']);
                                                if ($dias >= 0) {
                                                    $teste_folga = " /Está de Atestado; ";
                                                }
                                            }

                                            $nomeProfessores .= $linhaConsulta['nome'] . $teste_folga . '<br>';
                                        }

                                        echo $nomeProfessores;
                                        echo "</td>";
                                    }
                                    echo "</tr>";
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
                        <!--TARDE-->
                        <?php
                        echo "<h3 style='text-align: center'>Tarde</h3>";
                        echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                        echo "<thead>";
                        echo "<tr>";
                        //
                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'VESPERTINO' AND `status` LIKE 'OCUPADA' AND `ano` LIKE '$ano%' ORDER BY turma");
                        $numeroDeLinhas = mysqli_num_rows($Consulta);
                        $conadorLinhas = 1;
                        $arrayTurmasT[] = "";

                        while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                            //
                            $turma = $ColConsulta['turma'];
                            $idT = $ColConsulta['id'];
                            $unico = $ColConsulta['unico'];
                            array_push($arrayTurmasT, $ColConsulta['id']);
                            //
                            echo "<th> "
                            . "<div class='dropdown'>"
                            . "$turma $unico"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><a href='cadastrar_update_turma.php?id=" . base64_encode($idT) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                            . "</ul>"
                            . "</div>"
                            . "</th>";
                            //
                            if ($conadorLinhas == 5) {
                                break;
                            }
                            $conadorLinhas++;
                        }
                        //
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<tr>";

                        array_shift($arrayTurmasT);

                        foreach ($arrayTurmasT as $idturma) {

                            $Consulta2 = mysqli_query($Conexao, "SELECT s.nome FROM `turmas_professor2` tr, servidores s WHERE id_turma = '" . $idturma . "' AND tr.id_professor = s.id");
                            echo "<td>";
                            $nomeProfessores = "";
                            while ($linhaConsulta = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {


                                $teste_folga = "";
                                $teste_nome = $linhaConsulta['nome'];
                                $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                                // echo "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1" . "<br>";
                                $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                                $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                                if ($ContLinhasAtestados > 0) {
                                    $dias = intval($linha_atestados['dias']);
                                    if ($dias >= 0) {
                                        $teste_folga = " /Está de Atestado; ";
                                    }
                                }

                                $nomeProfessores .= $linhaConsulta['nome'] . $teste_folga . '<br>';
                            }
                            echo $nomeProfessores;
                            echo "</td>";
                        }
                        //
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table";
                        //
                        echo "<br>";
                        if ($numeroDeLinhas > 5) {
                            echo "<table class='table table-striped table-bordered' id='' cellspacing='0' width='100%'>";
                            echo "<thead>";
                            echo "<tr>";
                            $conadorLinhas = 1;
                            $arrayTurmasT[] = "";


                            while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                                $turma = $ColConsulta['turma'];
                                $idT = $ColConsulta['id'];
                                $unico = $ColConsulta['unico'];
                                array_push($arrayTurmasT, $ColConsulta['id']);
                                echo "<th> "
                                . "<div class='dropdown'>"
                                . "$turma $unico"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='cadastrar_update_turma.php?id=" . base64_encode($idT) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "</ul>"
                                . "</div>"
                                . "</th>";

                                if ($conadorLinhas == 5) {
                                    break;
                                }
                                $conadorLinhas++;
                            }

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            echo "<tr>";
                            array_shift($arrayTurmasT);
                            array_shift($arrayTurmasT);
                            array_shift($arrayTurmasT);
                            array_shift($arrayTurmasT);
                            array_shift($arrayTurmasT);
                            array_shift($arrayTurmasT);

                            foreach ($arrayTurmasT as $idturma) {

                                $Consulta2 = mysqli_query($Conexao, "SELECT s.nome FROM `turmas_professor2` tr, servidores s WHERE id_turma = $idturma  AND tr.id_professor = s.id");
                                echo "<td>";
                                $nomeProfessores = "";

                                while ($linhaConsulta = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {

                                    $teste_folga = "";
                                    $teste_nome = $linhaConsulta['nome'];
                                    $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                                    $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                                    $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                                    if ($ContLinhasAtestados > 0) {
                                        $dias = intval($linha_atestados['dias']);
                                        if ($dias >= 0) {
                                            $teste_folga = " /Está de Atestado; ";
                                        }
                                    }

                                    $nomeProfessores .= $linhaConsulta['nome'] . $teste_folga . '<br>';
                                }
                                echo $nomeProfessores;
                                echo "</td>";
                            }
                            echo "</tr>";
                            echo"</tbody>";
                            echo"</table>";
                            //                            
                        }
                        ?>
                        <!--NOITE-->
                        <?php
                        echo "<h3 style='text-align: center'>Noite</h3>";
                        echo "<table class='table table-striped table-bordered' id=''>";
                        echo "<thead>";
                        echo "<tr>";
                        //
                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turno` LIKE 'NOTURNO' AND `status` LIKE 'OCUPADA' AND `ano` LIKE '$ano%' ORDER BY turma");
                        $numeroDeLinhas = mysqli_num_rows($Consulta);
                        $conadorLinhas = 1;
                        $arrayTurmasN[] = "";

                        while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                            $turma = $ColConsulta['turma'];
                            $unico = $ColConsulta['unico'];
                            array_push($arrayTurmasN, $ColConsulta['id']);
                            $idN = $ColConsulta['id'];
                            //
                            echo "<th> "
                            . "<div class='dropdown'>"
                            . "$turma $unico"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><a href='cadastrar_update_turma.php?id=" . base64_encode($idN) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                            . "</ul>"
                            . "</div>"
                            . "</th>";
                            //
                            if ($conadorLinhas == 5) {
                                break;
                            }
                            $conadorLinhas++;
                        }

                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<tr>";

                        array_shift($arrayTurmasN);

                        foreach ($arrayTurmasN as $idturma) {

                            $Consulta2 = mysqli_query($Conexao, "SELECT s.nome FROM `turmas_professor2` tp, servidores s WHERE id_turma = '" . $idturma . "' AND tp.id_professor = s.id");
                            echo "<td>";
                            $nomeProfessores = "";
                            while ($linhaConsulta = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {

                                $teste_folga = "";
                                $teste_nome = $linhaConsulta['nome'];
                                $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                                $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                                $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                                if ($ContLinhasAtestados > 0) {
                                    $dias = intval($linha_atestados['dias']);
                                    if ($dias >= 0) {
                                        $teste_folga = " /Está de Atestado; ";
                                    }
                                }

                                $nomeProfessores .= $linhaConsulta['nome'] . $teste_folga . '<br>';
                            }
                            echo $nomeProfessores;
                            echo "</td>";
                        }
                        //
                        echo "</tr>";
                        echo"</tbody>";
                        echo"</table";
                        //
                        if ($numeroDeLinhas > 5) {
                            echo "<table class='table table-striped table-bordered' id='' cellspacing='0' width='100%'>";
                            echo "<thead>";
                            echo "<tr>";
                            $conadorLinhas = 1;
                            $arrayTurmasN[] = "";

                            while ($ColConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

                                $idN = $ColConsulta['id'];
                                $turma = $ColConsulta['turma'];
                                $unico = $ColConsulta['unico'];
                                array_push($arrayTurmasN, $ColConsulta['id']);
                                echo "<th> "
                                . "<div class='dropdown'>"
                                . "$turma $unico"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='cadastrar_update_turma.php?id=" . base64_encode($idN) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                . "</ul>"
                                . "</div>"
                                . "</th>";

                                if ($conadorLinhas == 5) {
                                    break;
                                }
                                $conadorLinhas++;
                            }

                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            echo "<tr>";
                            array_shift($arrayTurmasN);
                            array_shift($arrayTurmasN);
                            array_shift($arrayTurmasN);
                            array_shift($arrayTurmasN);
                            array_shift($arrayTurmasN);
                            array_shift($arrayTurmasN);

                            foreach ($arrayTurmasN as $idturma) {

                                $Consulta2 = mysqli_query($Conexao, "SELECT s.nome FROM `turmas_professor2` tp, servidores s WHERE id_turma = $idturma  AND tp.id_professor = s.id");
                                echo "<td>";
                                $nomeProfessores = "";

                                while ($linhaConsulta = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {

                                    $teste_folga = "";
                                    $teste_nome = $linhaConsulta['nome'];
                                    $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor WHERE `servidor` like '$teste_nome' ORDER BY `atestados_servidor`.`fim` DESC LIMIT 1");
                                    $linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH);
                                    $ContLinhasAtestados = mysqli_num_rows($query_atestados);
                                    if ($ContLinhasAtestados > 0) {
                                        $dias = intval($linha_atestados['dias']);
                                        if ($dias >= 0) {
                                            $teste_folga = " /Está de Atestado; ";
                                        }
                                    }

                                    $nomeProfessores .= $linhaConsulta['nome'] . $teste_folga . '<br>';
                                }

                                echo $nomeProfessores;
                                echo "</td>";
                            }
                            echo "</tr>";

                            echo"</tbody>";
                            echo"</table>";
                            //
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </body>   
</html>
