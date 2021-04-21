<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
//$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
$Conexao = mysqli_connect($conexao_tipo, $Usuario, $Senha, $Base);

mysqli_set_charset($Conexao, "utf8");
$querySelecionaPorCodigo = "SELECT * FROM `imagens` where id = 7";
//$querySelecionaPorCodigo = "SELECT * FROM `imagens` ORDER BY `id` DESC LIMIT 1";
$resultado = mysqli_query($Conexao, $querySelecionaPorCodigo);
$imagem = mysqli_fetch_object($resultado);
$timbre = base64_encode($imagem->blob_imagem);
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>GERENCIAL</title>
        <style>
            .vertical{
                writing-mode: vertical-lr; transform: rotate(180deg);min-width: 6mm; min-height: 35mm;
            }
            table, th, td{
                border: thin solid black; border-collapse: collapse;
            }
            td{
                font-size: 11px;    padding-left: 4px;
            }
            body{
                margin: 0 auto;width: 28cm;
            }
            img{
                width: 15cm;   height: 4.5cm;margin-left: 6.5cm;
            }
            @media print {
                body{
                    margin-bottom:-1cm !important;                  
                }
                /*            @media print { #pula {page-break-before: always } }*/
                @media print {
                    body,
                    page {
                        margin: 0;
                        box-shadow: 0;
                    }
                }
            </style>
        </head>
        <body>
            <!--<img src="data:image/jpg;base64,<?php echo$timbre ?>" />-->
            <img src='img/timbre.jpg' />
            <P style="text-align: center;margin-top: -42px;font-size: 24px;">SECRETARIA MUNICIPAL DE EDUCAÇÃO</p>
            <h3 style="    text-align: center; margin-bottom: 0px; margin-top: -6px;">INFORMATIVO GERENCIAL - ANO <?php echo date('Y'); ?></h3>
            <table style="border: solid black thin; width: 27.7cm ">
                <tbody>
                    <tr>
                        <th rowspan="2" style="width: 60mm; " >NOME</th>
                        <th rowspan="2" style="width: 20mm;">CPF</th>
                        <th rowspan="2" style="width: 17mm;">RG</th>
                        <th rowspan="2"><div class="vertical" style="font-size: 16px;">Órgão Expedidor</div></th>
                        <th rowspan="2"><div class="vertical">Matrícula</div></th>
                        <th rowspan="2" style="width: 40mm;">Email</th>
                        <th rowspan="2"><div class="vertical">Função</div></th>
                        <th rowspan="2"><div class="vertical">Ano de Estudo</div></th>
                        <th rowspan="2"><div class="vertical">Turma</div></th>
                        <th rowspan="2"><div class="vertical">Disciplina</div></th>
                        <th>C/H</th>
                        <th colspan="3">Turno</th>
                        <!--<th>13</th>-->
                        <!--<th>14</th>-->
                        <th rowspan="2"><div class="vertical">Efetivo</div></th>
                        <th rowspan="2"><div class="vertical">Contratado</div></th>
                        <th rowspan="2"><div class="vertical" style="font-size: 16px;">Amigos da Escola</div></th>
                    </tr>
                    <tr>
                        <!--<th></th>-->
    <!--                    <th >CPF</th>
                        <th >RG</th>-->
                        <!--<th ><div class="vertical">Órgão Expedidor</div></th>-->
                        <!--<th><div class="vertical">Matrícula</div></th>-->
                        <!--<th>Email</th>-->
                        <!--<th>Função</th>-->
                        <!--<th>Ano de Estudo</th>-->
                        <!--<th><div class="vertical">Turma</div></th>-->
                        <!--<th><div class="vertical">Disciplina</div></th>-->
                        <th><div class="vertical">Total</div></th>
                        <th>M</th>
                        <th>T</th>
                        <th>N</th>
                        <!--<th><div class="vertical">Efetivo</div></th>-->
                        <!--<th><div class="vertical">Contratado</div></th>-->
                        <!--<th><div class="vertical">Amigos da Escola</div></th>-->
                    </tr>
                    <?php
//                Traz os Dados da Escola
                    $Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
                    $Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
                    $inep = $Registro["inep"];
                    $escola_nome = $Registro["nome"];
                    $cadastro = $Registro["cadastro"];
                    $cnpj = $Registro["cnpj"];
                    $escola_endereco = $Registro["endereco"];
                    $escola_cidade = $Registro["cidade"];
                    $escola_estado = $Registro["estado"];
                    $cep = $Registro["cep"];
                    $email = $Registro["email"];
//                
                    $qtd = 0;
                    foreach ($_POST['servidor_selecionado'] as $id) {
                        $SQL_Consulta = "SELECT * FROM `servidores` WHERE `id` = '$id' AND `funcao` NOT LIKE '%professor(a)%' AND `funcao` NOT LIKE '%MOTORISTA%' AND `vinculo` NOT LIKE '%PRESTADOR DE SERVIÇOS%' AND excluido = 'N'  ORDER BY nome ASC ";
                        $Consulta = mysqli_query($Conexao, $SQL_Consulta);
                        $Linha = mysqli_num_rows($Consulta);
                        if ($Linha > 0) {
                            $qtd++;
                        }
                    }
                    //
                    $cont = 0;
                    $id_servidores = "";
                    foreach ($_POST['servidor_selecionado'] as $id) {
                        //
                        //Selecionar todos os itens da tabela      
                        $SQL_Consulta = "SELECT * FROM `servidores` WHERE `id` = '$id' AND `funcao` NOT LIKE '%professor(a)%' AND `funcao` NOT LIKE '%MOTORISTA%' AND `vinculo` NOT LIKE '%PRESTADOR DE SERVIÇOS%' AND excluido = 'N'  ORDER BY nome ASC ";
                        $Consulta = mysqli_query($Conexao, $SQL_Consulta);
                        $Linha = mysqli_num_rows($Consulta);
                        //   
                        if ($Linha > 0) {
                            //
                            while ($row_Consulta = mysqli_fetch_assoc($Consulta)) {
                                //
                                $cont++;
                                $m = "";
                                $t = "";
                                $n = "";
                                $e = "";
                                $c = "";
                                $ae = "";
                                //
                                if ($row_Consulta["turno"] == "MATUTINO") {
                                    $m = "X";
                                } elseif ($row_Consulta["turno"] == "VESPERTINO") {
                                    $t = "X";
                                } elseif ($row_Consulta["turno"] == "NOTURNO") {
                                    $n = "X";
                                } elseif ($row_Consulta["turno"] == "MATUTINO/VESPERTINO") {
                                    $m = "X";
                                    $t = "X";
                                } elseif ($row_Consulta["turno"] == "MATUTINO/NOTURNO") {
                                    $m = "X";
                                    $n = "X";
                                } elseif ($row_Consulta["turno"] == "MATUTINO/VESPERTINO/NOTURNO") {
                                    $m = "X";
                                    $t = "X";
                                    $n = "X";
                                } elseif ($row_Consulta["turno"] == "VESPERTINO/NOTURNO") {
                                    $t = "X";
                                    $n = "X";
                                }
                                //
                                if ($row_Consulta["vinculo"] == "EFETIVO(A)") {
                                    $e = "X";
                                } elseif ($row_Consulta["vinculo"] == "CONTRATADO(A)") {
                                    $c = "X";
                                } elseif ($row_Consulta["vinculo"] == "AMIGOS DA ESCOLA") {
                                    $ae = "X";
                                }
                                echo '<tr>';
                                $nome = $row_Consulta["nome"];
                                $result = strlen('' . $nome . '');
                                $css = "";
                                if ($result > 31) {
                                    // $css = "font-size:12px !important";
                                }

                                echo '<td style="white-space: nowrap;' . $css . '">' . $row_Consulta["nome"] . '</td>';
                                echo '<td>' . $row_Consulta["cpf"] . '</td>';
                                echo '<td>' . $row_Consulta["dados_certidao"] . '</td>';
                                echo '<td>' . $row_Consulta["orgao_expedidor"] . '</td>';
                                echo '<td>' . $row_Consulta["matricula"] . '</td>';
                                echo '<td>' . $row_Consulta["email"] . ' </td>';
                                echo '<td>' . $row_Consulta["resumo_funcao"] . ' ' . $row_Consulta["resumo_funcao_2"] . '</td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td>' . $row_Consulta["carga_horaria"] . '</td>';
                                echo '<td>' . $m . '</td>';
                                echo '<td>' . $t . '</td>';
                                echo '<td>' . $n . '</td>';
                                echo '<td>' . $e . '</td>';
                                echo '<td>' . $c . '</td>';
                                echo '<td>' . $ae . '</td>';
                                echo '</tr>';
                            }
                            //
                            if ($cont == 20) {
                                //
                                echo '<tr>';
                                echo '<td colspan = "17" style = "text-align: center; ">'
                                . '<div>'
                                . '<p style = " margin-top: 15px;">' . $escola_endereco . '<p>'
                                . '<p style = " margin-top: -8px;">' . 'CNPJ:' . $cnpj . '<p>'
                                . '<p style = " margin-top: -8px; margin-bottom: 4px;">' . 'E-mail.:' . $email . '<p>'
                                . '</div>'
                                . ' </td>';
                                echo '</tr>';
                                //
                                echo '<tr>';
                                //echo '<td colspan = "17" style = "height: 1.5cm;border-bottom-color: white;border-left-color: white;border-right-color: white;"></td>';
                                echo '</tr>';
                                //
                                echo '<tr>';
                                echo '<td colspan = "17"  style = "border-left-color: white;border-right-color: white;">'
                                . '<div>'
                                . " <img src='img/timbre.jpg' />"
                                . ' <P style="    text-align: center;margin-top: -42px;margin-bottom: 14px;font-size: 24px;">SECRETARIA MUNICIPAL DE EDUCAÇÃO</p>'
                                . '</div>'
                                . ' </td>';
                                echo '</tr>';                               
                            }
                        }
                        //
                    }
                    //
                    //Professores       //Professores   //Professores 
                    $qtd2 = 0;
                    //
                    $ano = date('Y');
                    foreach ($_POST['servidor_selecionado'] as $id) {
                        $SQL_Consulta2 = "SELECT servidores.*,turmas_professor2.id_turma,turmas_professor2.id_professor,turmas.* FROM `servidores`,`turmas_professor2`,`turmas`"
                                . " WHERE `funcao` LIKE '%professor(a)%' AND servidores.substituta LIKE 'NAO' AND servidores.id = turmas_professor2.id_professor AND servidores.id = '$id' AND turmas.id = turmas_professor2.id_turma AND servidores.excluido = 'N'  AND turmas.ano LIKE '%$ano%' AND servidores.substituta LIKE 'NAO'"
                                . "GROUP BY servidores.id ORDER BY nome ASC";
                        $Consulta2 = mysqli_query($Conexao, $SQL_Consulta2);
                        $LinTotal = mysqli_num_rows($Consulta2);
                        if ($LinTotal > 0) {
                            $qtd2++;
                        }
                    }
                    //                                 
                    //Consulta os professores //              //Consulta os professores
                    $cont2 = 0;
                    foreach ($_POST['servidor_selecionado'] as $id) {
                        $SQL_Consulta22 = "SELECT servidores.*,turmas_professor2.id_turma,turmas_professor2.id_professor,turmas.* FROM `servidores`,`turmas_professor2`,`turmas`"
                                . " WHERE `funcao` LIKE '%professor(a)%' AND servidores.substituta LIKE 'NAO' AND servidores.id = turmas_professor2.id_professor AND servidores.id = '$id' AND turmas.id = turmas_professor2.id_turma AND servidores.excluido = 'N' AND turmas.ano LIKE '%$ano%' AND servidores.substituta LIKE 'NAO' "
                                . "GROUP BY servidores.id ORDER BY nome ASC";
                        $Consulta22 = mysqli_query($Conexao, $SQL_Consulta22);
                        $LinTotal = mysqli_num_rows($Consulta22);
                        //
                        if ($LinTotal > 0) {
                            $cont2++;
                            while ($Linha2 = mysqli_fetch_array($Consulta22)) {
                                //
                                $id_professor = $Linha2['id_professor'];
                                //
                                $m2 = "";
                                $t2 = "";
                                $n2 = "";
                                $e2 = "";
                                $c2 = "";
                                $ae2 = "";
                                //
                                $SQL_Consulta3 = "SELECT servidores.turno FROM `servidores` WHERE id = '$id_professor'";
                                $Consulta3 = mysqli_query($Conexao, $SQL_Consulta3);
                                $Linha3 = mysqli_fetch_array($Consulta3);
                                if ($Linha3["turno"] == "MATUTINO") {
                                    $m2 = "X";
                                } elseif ($Linha3["turno"] == "VESPERTINO") {
                                    $t2 = "X";
                                } elseif ($Linha3["turno"] == "NOTURNO") {
                                    $n2 = "X";
                                } elseif ($Linha3["turno"] == "MATUTINO/VESPERTINO") {
                                    $m2 = "X";
                                    $t2 = "X";
                                } elseif ($Linha3["turno"] == "MATUTINO/VESPERTINO/NOTURNO") {
                                    $m2 = "X";
                                    $t2 = "X";
                                    $n2 = "X";
                                } elseif ($Linha3["turno"] == "MATUTINO/NOTURNO") {
                                    $m2 = "X";
                                    $n2 = "X";
                                } elseif ($Linha3["turno"] == "VESPERTINO/NOTURNO") {
                                    $t2 = "X";
                                    $n2 = "X";
                                }
                                //
                                //                           
                                if ($Linha2["vinculo"] == "EFETIVO(A)") {
                                    $e2 = "X";
                                } elseif ($Linha2["vinculo"] == "CONTRATADO(A)") {
                                    $c2 = "X";
                                } elseif ($Linha2["vinculo"] == "AMIGOS DA ESCOLA") {
                                    $ae2 = "X";
                                }
                                //   
                                $css = "";
                                $Email = $Linha2["email"];
                                $result = strlen('' . $Email . '');
                                if ($result > 32) {
                                    $css = "font-size:10px !important";
                                }
                                //
                                echo '<tr>';
                                $nome = $Linha2["nome"];
                                $result = strlen('' . $nome . '');
                                $css = "";
                                if ($result > 31) {
                                    // $css = "font-size:12px !important";
                                }
                                echo '<td style="white-space: nowrap;' . $css . '">' . $Linha2["nome"] . '</td>';
                                echo '<td>' . $Linha2["cpf"] . '</td>';
                                echo '<td>' . $Linha2["dados_certidao"] . '</td>';
                                echo '<td>' . $Linha2["orgao_expedidor"] . '</td>';
                                echo '<td>' . $Linha2["matricula"] . '</td>';
                                echo '<td style = ' . $css . '>' . $Linha2["email"] . '</td>';
                                echo '<td>' . $Linha2["resumo_funcao"] . '<br>' . $Linha2["resumo_funcao_2"] . '</td>';
                                //
                                if ($Linha2["resumo_turmas_sim"] == "SIM") {
                                    echo '<td style = "font-size:8px;">' . $Linha2["resumo_anos"] . '<br>' . $Linha2["resumo_anos_2"] . '</td>';
                                } else {
                                    echo '<td style = "font-size:8px;">' . $Linha2["turma"] . '</td>';
                                }
                                //
                                if ($Linha2["resumo_turmas_sim"] == "SIM") {
                                    echo '<td style = "font-size:8px;">' . $Linha2["resumo_turmas"] . '<br>' . $Linha2["resumo_turmas_2"] . '</td>';
                                } else {
                                    echo '<td style = "font-size:8px;">' . $Linha2["unico"] . '</td>';
                                }
                                //
                                if ($Linha2["resumo_turmas_sim"] == "SIM") {
                                    echo '<td style = "font-size:8px;">' . $Linha2["resumo_disciplinas"] . '</td>';
                                } else {
                                    echo '<td style = "font-size:8px;">POLIVALENTE</td>';
                                }
                                echo '<td>' . $Linha2["carga_horaria"] . '</td>';
                                echo '<td>' . $m2 . '</td>';
                                echo '<td>' . $t2 . '</td>';
                                echo '<td>' . $n2 . '</td>';
                                echo '<td>' . $e2 . '</td>';
                                echo '<td>' . $c2 . '</td>';
                                echo '<td>' . $ae2 . '</td>';
                                echo '</tr>';
                                //Complete a 1 Página
                                if ($cont + $cont2 == $qtd + $qtd2) {
                                    if ($cont + $cont2 < 20) {
                                        for ($i3 = $cont + $cont2; $i3 < 20; $i3++) {
                                            echo '<tr>';
                                            for ($i4 = 1; $i4 < 18; $i4++) {
                                                echo "<th style = 'height:12px'></th>";
                                            }
                                            echo '</tr>';
                                        }
                                        echo '<tr>';
                                        echo '<td colspan = "17" style = "text-align: center; ">'
                                        . '<div>'
                                        . '<p style = " margin-top: 20px;">' . $escola_endereco . '<p>'
                                        . '<p style = " margin-top: -8px;">' . 'CNPJ:' . $cnpj . '<p>'
                                        . '<p style = " margin-top: -8px;">' . 'E-mail.:' . $email . '<p>'
                                        . '</div>'
                                        . ' </td>';
                                        echo '</tr>';
                                        break;
                                    } elseif ($cont + $cont2 == 20) {
                                        echo '<td colspan = "17" style = "text-align: center; ">'
                                        . '<div>'
                                        . '<p style = " margin-top: 20px;">' . $escola_endereco . '<p>'
                                        . '<p style = " margin-top: -8px;">' . 'CNPJ:' . $cnpj . '<p>'
                                        . '<p style = " margin-top: -8px; margin-bottom: 4px;">' . 'E-mail.:' . $email . '<p>'
                                        . '</div>'
                                        . ' </td>';
                                        echo '</tr>';
                                        //
                                        echo '<tr>';
                                        //echo '<td colspan = "17" style = "height: 1.5cm;border-bottom-color: white;border-left-color: white;border-right-color: white;"></td>';
                                        echo '</tr>';
                                        //
                                    }
                                }
                                //Contina pois a primeira folha é maior que 20
                                if ($cont + $cont2 == 20) {
                                    //
                                    echo '<tr>';
                                    echo '<td colspan = "17" style = "text-align: center; ">'
                                    . '<div>'
                                    . '<p style = " margin-top: 15px;">' . $escola_endereco . '<p>'
                                    . '<p style = " margin-top: -8px;">' . 'CNPJ:' . $cnpj . '<p>'
                                    . '<p style = " margin-top: -8px; margin-bottom: 4px;">' . 'E-mail.:' . $email . '<p>'
                                    . '</div>'
                                    . ' </td>';
                                    echo '</tr>';
                                    //
                                    echo '<tr>';
                                    // echo '<td colspan = "17" style = "height: 1.5cm;border-bottom-color: white;border-left-color: white;border-right-color: white;"></td>';
                                    echo '</tr>';
                                    //
                                    echo '<tr>';
                                    echo '<td colspan = "17"  style = "border-left-color: white;border-right-color: white;">'
                                    . '<div>'
                                    . " <img src='img/timbre.jpg' />"
                                    . ' <P style="    text-align: center;margin-top: -42px;margin-bottom: 14px;font-size: 24px;">SECRETARIA MUNICIPAL DE EDUCAÇÃO</p>'
                                    . '</div>'
                                    . ' </td>';
                                    echo '</tr>';
                                }

                                //   //Completa a 2 Folha //Completa a 2 Folha
                                if ($cont + $cont2 == $qtd + $qtd2) {
                                    if ($cont + $cont2 < 50) {
                                        for ($i3 = $cont + $cont2; $i3 < 52; $i3++) {
                                            echo '<tr>';
                                            for ($i4 = 1; $i4 < 18; $i4++) {
                                                echo "<th style = 'height:12px'></th>";
                                            }
                                            echo '</tr>';
                                        }
                                        echo '<tr>';
                                        echo '<td colspan = "17" style = "text-align: center; ">'
                                        . '<div>'
                                        . '<p style = " margin-top: 20px;">' . $escola_endereco . '<p>'
                                        . '<p style = " margin-top: -8px;">' . 'CNPJ:' . $cnpj . '<p>'
                                        . '<p style = " margin-top: -8px;">' . 'E-mail.:' . $email . '<p>'
                                        . '</div>'
                                        . ' </td>';
                                        echo '</tr>';
                                        break;
                                    } elseif ($cont + $cont2 == 50) {
                                        for ($i3 = $cont + $cont2; $i3 < 52; $i3++) {
                                            echo '<tr>';
                                            for ($i4 = 1; $i4 < 18; $i4++) {
                                                echo "<th style = 'height:12px'></th>";
                                            }
                                            echo '</tr>';
                                        }
                                        echo '<tr>';
                                        echo '<td colspan = "17" style = "text-align: center; ">'
                                        . '<div>'
                                        . '<p style = " margin-top: 20px;">' . $escola_endereco . '<p>'
                                        . '<p style = " margin-top: -8px;">' . 'CNPJ:' . $cnpj . '<p>'
                                        . '<p style = " margin-top: -8px; margin-bottom: 4px;">' . 'E-mail.:' . $email . '<p>'
                                        . '</div>'
                                        . ' </td>';
                                        echo '</tr>';
                                        break;
                                    }
                                }
                                //
                                // //Contina pois a Segunda Folha é maior que 50
                                if ($cont2 + $cont == 50) {
                                    echo '<tr>';
                                    echo '<td colspan = "17" style = "text-align: center; ">'
                                    . '<div>'
                                    . '<p style = " margin-top: 20px;">' . $escola_endereco . '<p>'
                                    . '<p style = " margin-top: -8px;">' . 'CNPJ:' . $cnpj . '<p>'
                                    . '<p style = " margin-top: -8px;">' . 'E-mail.:' . $email . '<p>'
                                    . '</div>'
                                    . ' </td>';
                                    echo '</tr>';
                                    //
                                    echo '<tr>';
                                    // echo '<td colspan = "17" style = "height: 1.5cm;border-bottom-color: white;border-left-color: white;border-right-color: white;"></td>';
                                    echo '</tr>';
                                    //
                                    echo '<td colspan = "17" style = "white;border-left-color: white;border-right-color: white;" >'
                                    . '<div>'
                                    . " <img src='img/timbre.jpg' />"
                                    . ' <P style = "text-align: center;margin-top: -42px;margin-bottom: 14px;font-size: 24px;">SECRETARIA MUNICIPAL DE EDUCAÇÃO</p>'
                                    . '</div>'
                                    . ' </td>';
                                    echo '</tr>';
                                }
                                //Completa a Última Página da Tabela
                                if ($cont + $qtd2 == $qtd + $cont2) {
                                    for ($i = $cont + $cont2; $i < 80; $i++) {
                                        echo '<tr>';
                                        for ($i2 = 1; $i2 < 18; $i2++) {
                                            echo "<th style = 'height:15px'></th>";
                                        }
                                        echo '</tr>';
                                    }

                                    echo '<tr>';
                                    echo '<td colspan = "17" style = "text-align: center; ">'
                                    . '<div>'
                                    . '<p style = " margin-top: 20px;">' . $escola_endereco . '<p>'
                                    . '<p style = " margin-top: -8px;">' . 'CNPJ:' . $cnpj . '<p>'
                                    . '<p style = " margin-top: -8px; margin-bottom: 4px;">' . 'E-mail.:' . $email . '<p>'
                                    . '</div>'
                                    . ' </td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>    
            <?php
            // echo "($qtd + $qtd2 == $cont + $cont2)";
            ?>
        </body>
    </html>
