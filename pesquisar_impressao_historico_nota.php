<!DOCTYPE html>
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
$id_aluno = base64_decode($Recebe_id);
//
session_start();
$ano = $_SESSION['inputAno'];
//
$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE id = '$id_aluno' ");
$Linha = mysqli_fetch_array($Consulta_backup, MYSQLI_BOTH);
$nome = $Linha['nome'];
$nascimento = $Linha['data_nascimento'];
$nascimento = substr($nascimento, 8, 2) . '/' . substr($nascimento, 5, 2) . '/' . substr($nascimento, 0, 4);
$endereço = $Linha['endereco'];
$cidade = $Linha['cidade'];
$estado = $Linha['estado_cidade'];
$mae = $Linha['mae'];
$pai = $Linha['pai'];
//
$Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` AND excluido = 'N' ORDER BY ficha_descritiva  ");
//      
while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
    $bimetre_turma = $linhaConsulta2['bimestre_turma'];
    $bimetre_turno = $linhaConsulta2['bimestre_turno'];
    $unica = $linhaConsulta2['bimestre_unico'];
}
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>HISTÓRICO&nbsp;&nbsp;<?php echo "$ano" ?></title>
        <link href="css/pesquisar_impressao_historico_nota.css" rel="stylesheet" type="text/css"/>
        <style>
            .inputObs{
                min-width: 100%;
                border: none;
                text-align: center !important;
            }
        </style>
    </head>
    <body>
        <?php
        echo "<div id = 'cabecalho'>";
        echo "<table  width = '100%' cellspacing='0'>";
        echo "<tbody>";
//
        echo "<tr>";
        echo "<td class = 'escola_ficha' COLSPAN = '2' >Escola Municipal Tabelião Raul Galindo Sobrinho</td>";
// echo "<td></td>";
        echo "<td class = 'escola_ficha' >Ficha individual – Ensino Fundamental do 1° ao 5°</td>";
        echo "</tr>";
//
        echo "<tr>";
        echo "<td COLSPAN = '2'>Rua Dr. Francisco Simões</td>";
// echo "<td></td>";
        echo "<td>Cadastro Escolar N°: M500028</td>";
        echo "</tr>";
//
        echo "<tr>";
        echo "<td>Aluno: " . $nome . " </td>";
        echo "<td>Endereço: " . $endereço . "</td>";
        echo "<td>Cidade/Estado: " . $cidade . "&nbsp;/&nbsp;" . $estado . "</td>";
        echo "</tr>";
//
        echo "<tr>";
        echo "<td>Nascimento: " . $nascimento . "</td>";
        echo "<td>Mãe: " . $mae . " </td>";
        echo "<td>Pai: " . $pai . "</td>";
        echo "</tr>";
//
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        ?>
        <!--Dados Gerais-->
        <?php
        echo "<div>";
        echo "<table class='' width = '100%'  cellspacing='0'>";
        echo "<tr>";
        echo "<td rowspan = '4' id='dados_gerais'>Dados Gerais</td>";
        echo "<td id='serie'>Série:-----------------</td>";
        echo "<td rowspan = '4' id='observacoes_texto'>Observações</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Ano: $bimetre_turma / $bimetre_turno</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Ano Letivo:&nbsp;&nbsp;$ano </td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Turma: $unica</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>";
        ?>
        <?php
        echo "<div id = 'corpo'>";
        //
        echo "<div id = 'tabela_notas'>";
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE excluido = 'N' ORDER BY ficha_descritiva");
        //
        echo "<table class='' width = '100%' id='' cellspacing='0'>";
        echo "<div>";
        echo "<thead>";
        //
        echo "<tr>";
        echo "<th colspan = '3'>"
        . "<div id = 'CC'>"
        . "<p>Componentes<br> Curriculares</p>"
        . "</div>"
        . "<div id = 'CC2'>Avaliação</div>"
        . "</th>";
        //echo "<th></th>";
        //echo "<th></th>";
        //
        while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {

            // $id = $linha['id'];
            $disciplina = $linha['disciplina'];
            $id = $linha['id'];
            // array_push($arrayDisciplinas, $linha['id']);

            echo "<th>"
            . "<div class = 'vertical'>"
            . "$disciplina"
            . "</div>"
            . "</th>";
        }
        echo "<th><div class = 'vertical'>Informática</div></th>";
        echo "<th><div class = 'vertical'>Direito da Cidadania</div></th>";
        echo "<th><div class = 'vertical'>FALTAS</div></th>";
        echo "</tr>";
        echo "</thead>";
        echo "</div>";
        echo "<tr>";
        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_i.*,disciplinas.disciplina FROM `bimestre_i`,`disciplinas` WHERE `id_bimestreI_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_I_disciplina` AND excluido = 'N' ORDER BY ficha_descritiva ");
        echo "<th rowspan = '8' id = ''><div id = 'vertical2'><p>Ano Letivo</p></div></th>";
        //echo "<th></th>";
        echo "<th COLSPAN = '2'>BIMESTRE I</th>";
        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
            $nota = str_replace(".", ",", $linhaConsulta2['nota']);
            //$nota = $linhaConsulta2['nota'];
            $faltas = $linhaConsulta2['faltas'];
            //
            if ($nota == "0") {
                $nota = "---";
            }
            if ($faltas == "0") {
                $faltas = "---";
            }

            echo "<th>" . "$nota" . "</th>";

            //            
        }
        echo "<th>---</th>";
        echo "<th>---</th>";
        echo "<th>" . "$faltas" . "</th>";
        echo "</tr>";
        //Bimestre II        
        echo "<tr>";
        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_ii.*,disciplinas.disciplina FROM `bimestre_ii`,`disciplinas` WHERE `id_bimestre_II_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_II_disciplina` AND excluido = 'N' ORDER BY ficha_descritiva  ");
        //
        //echo "<th></th>";
        echo "<th COLSPAN = '2'>BIMESTRE II</th>";
        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {

            $faltas = $linhaConsulta2['faltas'];
            //
            if ($nota == "0") {
                $nota = "---";
            }
            if ($faltas == "0") {
                $faltas = "---";
            }
            $nota = str_replace(".", ",", $linhaConsulta2['nota']);
            echo "<th>" . "$nota" . "</th>";
            //
        }
        echo "<th>---</th>";
        echo "<th>---</th>";
        echo "<th>" . "$faltas" . "</th>";
        echo "</tr>";
        //Bimestre III
        echo "<tr>";
        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_iii.*,disciplinas.disciplina FROM `bimestre_iii`,`disciplinas` WHERE `id_bimestre_III_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_III_disciplina` AND excluido = 'N' ORDER BY ficha_descritiva  ");
        //
        //echo "<th></th>";
        echo "<th COLSPAN = '2'>BIMESTRE III</th>";
        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {

            $faltas = $linhaConsulta2['faltas'];
            //
            if ($nota == "0") {
                $nota = "---";
            }
            if ($faltas == "0") {
                $faltas = "---";
            }
            $nota = str_replace(".", ",", $linhaConsulta2['nota']);
            echo "<th>" . "$nota" . "</th>";
            //
        }
        echo "<th>---</th>";
        echo "<th>---</th>";
        echo "<th>" . "$faltas" . "</th>";
        echo "</tr>";
        //Bimestre IV      
        echo "</tr>";
        echo "<tr>";
        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_iv.*,disciplinas.disciplina FROM `bimestre_iv`,`disciplinas` WHERE `id_bimestre_IV_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_IV_disciplina` AND excluido = 'N' ORDER BY ficha_descritiva ");
        //
        //echo "<th></th>";
        echo "<th COLSPAN = '2'>BIMESTRE IV</th>";
        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
            $nota = str_replace(".", ",", $linhaConsulta2['nota']);
            $faltas = $linhaConsulta2['faltas'];
            //
            if ($nota == "0") {
                $nota = "---";
            }
            echo "<th>" . "$nota" . "</th>";

            //
            if ($faltas == "0") {
                $faltas = "---";
            }
        }
        echo "<th>---</th>";
        echo "<th>---</th>";
        echo "<th>" . "$faltas" . "</th>";
        echo "</tr>";
        //Bimestre final         
        echo "<tr>";
        $Consulta2 = mysqli_query($Conexao, "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_bimestre_media_disciplina` AND excluido = 'N' ORDER BY ficha_descritiva  ");
        //
        // echo "<th></th>";
        echo "<th COLSPAN = '2'>MÉDIA ANUAL</th>";
        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {

            $nota = str_replace(".", ",", $linhaConsulta2['nota']);
            $escola = $linhaConsulta2['escola'];
            // $aluno = $linhaConsulta2['aluno'];
            $aluno_dias = $linhaConsulta2['aluno_dias'];
            $frequencia = $linhaConsulta2['frequencia'];
            $bimetre_turma = $linhaConsulta2['bimestre_turma'];
            $faltas = $linhaConsulta2['faltas'];
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
            if ($nota == "0") {
                $nota = "---";
            }
            echo "<th>" . "$nota" . "</th>";
        }
        if ($faltas == "0") {
            $faltas = "---";
        }
        if ($aluno_dias == "0") {
            $aluno_dias = "---";
        }
        if ($frequencia == "0") {
            $frequencia = "---";
        }
        if ($escola == "0") {
            $escola = "---";
        }
        echo "<th>---</th>";
        echo "<th>---</th>";
        echo "<th>" . "$faltas" . "</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<th rowspan = '3' id = 'dias_letivosI'>"
        . "<div id = 'dias_letivos' >"
        . "<p>Dias Letivos</p>"
        . "<div>"
        . "</th>";
        echo "<th id = 'dias_etc'>Da Escola</th>";
        echo "<th COLSPAN = '12'>$escola</th>";
        echo "</tr>";
        echo "<tr>";
        // echo "<th></th>";
        echo "<th>Do Aluno</th>";
        echo "<th COLSPAN = '12'>$aluno_dias</th>";
        echo "</tr>";
        echo "<tr>";
        //echo "<th></th>";
        echo "<th>% Frequência</th>";
        echo "<th COLSPAN = '12'> $frequencia</th>";
        echo "</tr>";
        //Recuperação final         
        echo "<tr>";
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_recuperacao_final_disciplina` AND excluido = 'N' ORDER BY ficha_descritiva ");
        //
        echo "<th rowspan = '2' > <div id = 'recuperacao_final'><p>Final<br>Recuperação</p></div></th>";
        //echo "<th></th>";
        echo "<th COLSPAN = '2'>Nota da Prova</th>";
        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
            // $nota = $linhaConsulta2['nota'];
            $nota = str_replace(".", ",", $linhaConsulta2['nota']);
            //
            if ($nota == "0") {
                $nota = "---";
            }
            echo "<th>" . "$nota" . "</th>";
        }
        echo "<th>---</th>";
        echo "<th>---</th>";
        echo "<th></th>";
        echo "</tr>";
        //Média Recuperação final         
        echo "<tr>";
        $Consulta2 = mysqli_query($Conexao, "SELECT recuperacao_final.*,disciplinas.disciplina FROM `recuperacao_final`,`disciplinas` WHERE `id_recuperacao_final_aluno` = '$id_aluno' AND `ano` = '$ano' AND disciplinas.id = `id_recuperacao_final_disciplina` AND excluido = 'N' ORDER BY ficha_descritiva  ");
        //
        //echo "<th></th>";
        echo "<th COLSPAN = '2'>Média</th>";
        while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
            $media = str_replace(".", ",", $linhaConsulta2['nota']);
            //  $media = $linhaConsulta2['media'];
            //
            if ($media == "0") {
                $media = "---";
            }
            echo "<th>" . "$media" . "</th>";
        }
        echo "<th>---</th>";
        echo "<th>---</th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        //
        echo "<div id = 'observacoes'>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs2' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs3' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs4' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs5' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs6' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs7' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs8' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";
        echo "<div>";
        echo "<p><input type='text' name = 'inputObs'  value= '$inputObs9' maxlength = '52' class = 'inputObs' ></p>";
        echo "</div>";

        echo "</div>";
        ?>         
        <?php
        echo "<div id = 'rodape'>";
        echo "<table width='100%' cellspacing='0'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th colspan = '3' style = 'height:0.5cm'> ";
        echo "</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        //
        echo "<tr>";
        echo "<td>Resultado Final</td>";
        echo "<td>Progressão Plena"
        . "&nbsp;&nbsp;<input type='checkbox'/>"
        . "</td>";
        echo "<td> Reprovado"
        . "&nbsp;&nbsp;<input type='checkbox'/>"
        . "</td>";
        echo "</tr>";
        //
        //
        echo "<tr>";
        echo "<td style = 'height:1cm;'>Secretária</td>";
        echo "<td>Responsável</td>";
        echo "<td>Diretor</td>";
        echo "</tr>";
        //
        echo "</tbody>";
        echo "</div>";
        ?>
    </body>
</html>
