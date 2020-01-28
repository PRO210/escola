<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<title>ATA DE ALUNOS DO FUNDAMENTAL </title>
<?php include_once 'head.php'; ?>
<link href="css/pesquisar_no_banco_impressao_relatorio_ata_html.css" rel="stylesheet" type="text/css"/>
<title>ATA DO 1° GRAU</title>
<style>
    @media print { 
        #div { display:none !important;} 
        body { background: #fff !important; }
    }
    .bt{
        width: 200px;      
        padding: 12px
    }
</style>
<div id="div" style="position: fixed;left: 0px;top: 0px; width: 600px">            
    <div class="bt">
        <a href="listar_copia_turma_server.php" class="btn btn-info" style="padding-right: 24px; width: 200px; ">Voltar</a>
    </div>
    <div class="bt">
        <button type="button" onclick=" document.getElementById('div');window.print();" class="btn btn-success" style=" padding-left: 24px;width: 200px">Imprimir</button>
        <!--<button type="button" onclick=" document.getElementById('div').style.display = 'none';window.print();" class="btn btn-success">Imprimir</button>-->
    </div>          
</div>

<!--        <div id="div" style="position: absolute;left: 0px;top: 0px;">
            <a href="listar_copia_turma_server.php" class="btn btn-info" style="padding-right: 24px">Voltar</a>
            <button type="button" onclick=" document.getElementById('div').style.display = 'none';window.print();" class="btn btn-success">Imprimir</button>
        </div>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
                $(document).ready(function () {
                    $(document).keyup(function (e) {
                        if (e.keyCode == 27) {
                            //alert('escape');
                            document.getElementById('div').style.display = 'block';
                        }
                    });

                });
        </script>-->
<?php
//Consulta O Nome da Escola
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
$inep = $Registro["inep"];
$escola_nome = $Registro["nome"];
$escola_cidade = $Registro["cidade"];
?>
<img src="img/timbre.jpg" alt=""  style="margin-left: 6.5cm"/>
<P style="text-align: center;margin-top: -42px;font-size: 24px;"><b>SECRETARIA MUNICIPAL DE EDUCAÇÃO</b></p>
<p style="display: inline-block"><?php echo "$escola_nome"; ?></p>
<p style="display: inline-block;margin-left: 12cm;">Ano de Referência &nbsp; : &nbsp;<?php echo "$ano"; ?></p>
<p style="margin-top: -0.2cm">Professor (a)&nbsp;: &nbsp;___________________________________________</p>
<?php
//Contagem dos Alunos
if (empty($_POST['aluno_selecionado'])) {
    header("LOCATION: listar_copia_turma_server.php");
}
$quant = 0;
foreach (($_POST['aluno_selecionado']) as $lista_id) {
    $SQL_Consulta = " SELECT * FROM alunos WHERE `id` = '$lista_id' ";
    $Consulta = mysqli_query($Conexao, $SQL_Consulta);
    $Linha2 = mysqli_fetch_array($Consulta);
    //$turmaf = $Linha2['turma'];
    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
    $Linha_turma = mysqli_fetch_array($Consulta_turma);
    //
    $turma = $Linha_turma["turma"];
    $turno = $Linha_turma["turno"];
    $unico = $Linha_turma["unico"];
    //
    $quant = $quant + 1;
    //
}
echo"<p style = 'display:inline-block;margin-top: -0.8cm;'>Ano de Estudo: $turma</p>";
echo"<p style = 'display:inline-block;margin-left:7.8cm; margin-top: -0.2cm;'>Turma:$unico</p>";
echo"<p style = 'display:inline-block;margin-left:9.7cm; margin-top: -0.2cm;'>Turno:$turno</p>";
echo"<p>Aos 31  dias do mês de Dezembro " . $ano . ", conclui-se o processo de apuração das notas finais dos alunos do " . $turma . " do Ensino Fundamental I .</p>";
//
echo "<table id = 'tableAta'>";
echo "<tr>";
//  echo "<th id = 'ordem'> Nº de <br>Ordem </th>";
echo "<th class = 'nome' id = 'thNome' style = 'font-size: 18px;'></b>DISCIPLINAS </b></th>";
//Monta as disciplinas
include 'ata_bimestre_disciplinas.php';
//
echo"<tr>";
echo "<td style = 'text-align:center;'><b> NOME DO ALUNO </b></td>";
echo "<td colspan = '12'> </td>";
echo"</tr>";
//      
//Selecionar todos os itens da tabela para dar inicío
$cont = 1;
foreach (($_POST['aluno_selecionado']) as $lista_id) {
    $Consulta3 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$lista_id' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` AND `arf` = 'S' ORDER BY arf_ord ");
    $ContLinhas3 = mysqli_num_rows($Consulta3);
    $linhaConsulta3 = mysqli_fetch_array($Consulta3, MYSQLI_BOTH);
    $recupera = $linhaConsulta3['bimestre_recupera'];
    //
    $Consulta = mysqli_query($Conexao, "SELECT nome FROM `alunos` WHERE `id` = '$lista_id' ");
    $linhaConsulta = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
    $nome = $linhaConsulta['nome'];
    //
    if ($ContLinhas3 > 0) {
        //
        if ($recupera == "N") {
            //No caso dos alunos passarem por média
            include 'ata_bimestre_media.php';
        } else {
            //No caso dos alunos irem para recuperação
            include 'ata_bimestre_media_final.php';
        }
        //
        echo '</tr>';
    } else {
        //No caso do aluno não ter histórico
        echo '<tr>';
        // echo "<td class = 'nome'> $cont</td>";
        echo "<td class = 'nome'> $nome </td>";
        //
        for ($i = 1; $i < 13; $i++) {
            echo "<th></th>";
        }
        echo '</tr>';
    }
    //Completa a Tabela da primeira folha caso de não ter o numero minimo de alunos
    if ($quant == $cont) {
        if ($cont < 14) {
            $cont4 = 13 - $cont;
            for ($i = 1; $i < $cont4; $i++) {
                //
                $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `arf` = 'S' ORDER BY arf_ord");
                //
                echo '<tr>';
                // echo "<td></td>";
                echo "<td></td>";
                //
                for ($i4 = 1; $i4 < 13; $i4++) {
                    echo "<th></th>";
                }
                //
            }
            echo '</tr>';
            break;
        } elseif ($cont == 11) {
            break;
        } elseif ($cont == 32) {
            break;
        }
    }
    //
    $ContLinhas2 = $cont++;
    //            
    if ($ContLinhas2 == 14) {
        //
        include 'ata_bimestre_cabecalho.php';
        //
        echo "<table id = 'tableAta2'>";
        echo "<tr>";
        // echo "<th id = 'ordem'> Nº de <br>Ordem </th>";
        echo "<th class = 'nome' id = 'thNome' style = 'font-size: 18px;'>DISCIPLINAS </th>";
        //
        //Monta as disciplinas                   //Monta as disciplinas
        include 'ata_bimestre_disciplinas.php';
        //
    } elseif ($ContLinhas2 == 32) {
        //               
        include 'ata_bimestre_cabecalho.php';
//                
        echo "<table id = 'tableAta2'>";
        echo "<tr>";
        // echo "<th id = 'ordem'> Nº de <br>Ordem </th>";
        echo "<th class = 'nome' id = 'thNome' style = 'font-size: 18px;'>DISCIPLINAS </th>";
        //
        //Monta as disciplinas                   //Monta as disciplinas
        include 'ata_bimestre_disciplinas.php';
    }
    //
    //Completa a Tabela para a segunda folha     //Completa a Tabela para a segunda folha 
    if ($ContLinhas2 == $quant) {
        ////Quando a segunda folha não tem alunos suficientente (18 aluno no total)
        if ($ContLinhas2 < 32) {
            $cont3 = 34 - $cont;
            //
            for ($i = 1; $i < $cont3; $i++) {
                $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `arf` = 'S' ORDER BY arf_ord");
                //
                echo '<tr>';
                // echo "<td></td>";
                echo "<td></td>";
                //
                for ($i3 = 1; $i3 < 13; $i3++) {
                    echo "<th></th>";
                }
            }
            echo '</tr>';
            break;
        }
        //Completa a terceira folha      //Completa a terceira folha
        if ($ContLinhas2 >= 32) {
            $cont3 = 53 - $cont;
            //
            for ($i = 1; $i < $cont3; $i++) {
                $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `arf` = 'S' ORDER BY arf_ord");
                //
                echo '<tr>';
                // echo "<td></td>";
                echo "<td></td>";
                //
                for ($i3 = 1; $i3 < 13; $i3++) {
                    echo "<th></th>";
                }
            }

            echo '</tr>';
        }
    }
}
echo '</table>';
//
include_once 'funcao_data_atual.php';
//
$Consulta = mysqli_query($Conexao, "SELECT * FROM `tb_cidades` where id = '$escola_cidade'");
while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    //
    $cidade_nome = strtoupper($Registro["nome"]);
    $id_cidade = $Registro["id"];
    $uf_cidade = $Registro["uf"];
    $ano = date('Y');
}
?>  
<p style="margin-left: 20cm"><?php echo $cidade_nome ?>, <?php echo $dia ?> de <?php echo "$mes2" ?> de <?php echo "$ano" ?>.</p>
<div style=" margin-top: 12px">
    <p style="width: 7cm; display: inline-block">____________________________________</p>
    <p style="width: 7cm; display: inline-block; margin-left: 2.5cm">____________________________________</p>
    <p style="width: 7cm; display: inline-block; margin-left: 2.5cm">____________________________________</p>
    <p style="width: 7cm; display: inline-block">Assinatura do Gestor</p>
    <p style="width: 7cm; display: inline-block; margin-left: 2.5cm">Assinatura do Coordenador Pedagógico</p>
    <p style="width: 7cm; display: inline-block; margin-left: 2.5cm">Assinatura do Professor(a)</p>
</div>
<!--<script type="text/javascript">
    (function (window) {
        'use strict';

        var noback = {
            //globals 
            version: '0.0.1',
            history_api: typeof history.pushState !== 'undefined',

            init: function () {
                window.location.hash = '#no-back';
                noback.configure();
            },

            hasChanged: function () {
                if (window.location.hash == '#no-back') {
                    window.location.hash = '#BLOQUEIO';
                    //mostra mensagem que não pode usar o btn volta do browser
                    if ($("#msgAviso").css('display') == 'none') {
                        $("#msgAviso").slideToggle("slow");
                    }
                }
            },

            checkCompat: function () {
                if (window.addEventListener) {
                    window.addEventListener("hashchange", noback.hasChanged, false);
                } else if (window.attachEvent) {
                    window.attachEvent("onhashchange", noback.hasChanged);
                } else {
                    window.onhashchange = noback.hasChanged;
                }
            },

            configure: function () {
                if (window.location.hash == '#no-back') {
                    if (this.history_api) {
                        history.pushState(null, '', '#BLOQUEIO');
                    } else {
                        window.location.hash = '#BLOQUEIO';
                        //mostra mensagem que não pode usar o btn volta do browser

                        if ($("#msgAviso").css('display') == 'none') {
                            $("#msgAviso").slideToggle("slow");
                        }
                    }
                }
                noback.checkCompat();
                noback.hasChanged();
            }

        };

        // AMD support 
        if (typeof define === 'function' && define.amd) {
            define(function () {
                return noback;
            });
        }
        // For CommonJS and CommonJS-like 
        else if (typeof module === 'object' && module.exports) {
            module.exports = noback;
        } else {
            window.noback = noback;
        }
        noback.init();
    }(window));
</script>-->