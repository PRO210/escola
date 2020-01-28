<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id_solicitacao = filter_input(INPUT_POST, 'inputIdSolicitacao', FILTER_DEFAULT);
$id_aluno = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);
$inputConcluiu = filter_input(INPUT_POST, 'inputConcluiu', FILTER_DEFAULT);
$inputbs1 = filter_input(INPUT_POST, 't1', FILTER_DEFAULT);
$inputbs2 = filter_input(INPUT_POST, 't2', FILTER_DEFAULT);
$inputbs3 = filter_input(INPUT_POST, 't3', FILTER_DEFAULT);
$inputbs4 = filter_input(INPUT_POST, 't4', FILTER_DEFAULT);
$inputbs5 = filter_input(INPUT_POST, 't5', FILTER_DEFAULT);
$inputbs6 = filter_input(INPUT_POST, 't6', FILTER_DEFAULT);
$inputbs7 = filter_input(INPUT_POST, 't7', FILTER_DEFAULT);
//
$sql = "UPDATE `alunos_solicitacoes` SET `t1` = '$inputbs1', `t2` = '$inputbs2', `t3` = '$inputbs3', `t4` = '$inputbs4',`t5` = '$inputbs5',`t6` = '$inputbs6', `t7` = '$inputbs7'  WHERE `id_solicitacao` = '$id_solicitacao'";
$Consulta_sql = mysqli_query($Conexao, $sql);
//
$Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$id_solicitacao' ");
$rowf = mysqli_fetch_array($Consultaf);
$t1 = $rowf['t1'];
$t2 = $rowf['t2'];
$t3 = $rowf['t3'];
$t4 = $rowf['t4'];
$t5 = $rowf['t5'];
$t6 = $rowf['t6'];
$t7 = $rowf['t7'];
//

$ano = "";
$ano_fase = "";
$ano_fase_xs = "";
$ano_fase_xn = "";
$ano_edui = "";
//
$Consulta3 = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE id = '$inputConcluiu'");
$Linha = mysqli_fetch_array($Consulta3, MYSQLI_BOTH);
//
if ($Linha['categoria'] == "EDUCAÇÃO INFANTIL") {
    $ano_edui = "PRE ESCOLAR II ";
    //
} elseif ($Linha['categoria'] == "FASE") {
    $ano_fase = $Linha['turma'];
    $ano_fase_xs = "checked";
    //
} elseif ($Linha['turma'] == "3 ANO") {
//    $ano = substr($inputConcluiu, 0, -1);
    $ano = $Linha['turma'];
    $ano_fase_xn = "checked";
    //
} else {
    $ano_letivo_turma = substr($Linha['ano'], 0, -6);
    //
    if ($ano_letivo_turma == "2018") {
        $ano = substr($Linha['turma'], 0, -1);
        $ano_fase_xn = "checked";
    } else {
        $ano = $Linha['turma'];
        $ano_fase_xn = "checked";
    }
}
//
$Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$id_aluno' ");
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$nome = $Linha['nome'];
$data_nascimento = new DateTime($Linha["data_nascimento"]);
$data_nascimento = date_format($data_nascimento, 'd-m-Y');
$naturalidade = $Linha['naturalidade'];
$estado = $Linha['estado'];
$nacionalidade = $Linha['nacionalidade'];

$pai = $Linha['pai'];
if ($pai == "") {
    $pai_e = " ";
} else {
    $pai_e = " e ";
}
$mae = $Linha['mae'];
$turma = $Linha['turma'];
//
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
$Consulta_up2 = mysqli_query($Conexao, "SELECT  * FROM `tb_cidades` WHERE id = '$escola_cidade'");
$Registro_up2 = mysqli_fetch_array($Consulta_up2, MYSQLI_BOTH);
$escola_cidade = strtoupper($Registro_up2["nome"]);
//
$Consulta_up3 = mysqli_query($Conexao, "SELECT  * FROM `tb_estados` WHERE id = '$escola_estado' ");
$Registro_up3 = mysqli_fetch_array($Consulta_up3, MYSQLI_BOTH);
$escola_estado = strtoupper($Registro_up3["uf"]);
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TRANSFERÊNCIA FOLHA DE ROSTO</title>  
        <link href="css/montar_transferencia_rosto.css" rel="stylesheet" type="text/css"/> 
        <style>
            @media print { 
                #div { display:none !important;} 
                body { background: #fff !important; }
            }
            .bt{
                padding: 12px;
                color: #fff;
                background-color: #5bc0de;
                border-color: #46b8da;  
                max-width: 114px;       
            }
        </style>
    </head>
    <body>
        <div id="div" style="position: fixed;left: 0px;top: 0px; width: 600px">            
            <div class="" style="margin-top: 12px ">
                <a href="montar_transferencia_notas.php?id=<?= base64_encode($id_solicitacao) ?>" class="btn btn-info " >Montar as Notas</a>
            </div> <br>                    
            <div class="" style="margin-top: 12px ">
                <a href="montar_transferencia_notas_fpdf.php?id=<?php echo "$id_solicitacao" . "/" . " $id_aluno" . "/" . "$inputConcluiu" ?>" class="btn btn-primary" >Salvar o PDF</a>                
            </div>                     
        </div>  
        <div id="inicio">
            <h3><?php echo "$escola_nome" ?></h3>
            <P>Nome do Estabelecimento de Ensino</P>
        </div>
        <div id="esquerda"><p><?php echo "$escola_endereco" ?></p></div>
        <div id="direita">
            <p>Cidade: <?php echo "$escola_cidade" ?></p>
            <p id="direita_P">UF:<?php echo "$escola_estado" ?></p>
        </div>

        <div id="esquerda2"><p>Ato de Funcionamento: N° 7658 em 08/10/81</p></div>
        <div id="centro"><p>D.O. de: 09/10/81</p></div>
        <div id="direita2"><p>Cadastro Escolar:<?php echo "$cadastro" ?></p></div>

        <div id="centro2">CERTIFICADO E HISTÓRICO ESCOLAR DO ENSINO FUNDAMENTAL</div>

        <div id="centro3">            
            <p>Pelo presente Histórico certifico que,____________________________________________________________________<span id="linha1"><?php echo "$nome"; ?></span></p>
            <p>Filho (a) de:________________________________________________________________________________________<span id="linha2"><?php echo "$mae" . "&nbsp;&nbsp;" . $pai_e . "&nbsp;&nbsp;" . "$pai"; ?></span></p>
            <p>Nascido(a) em: &nbsp;&nbsp;<?php echo "$data_nascimento"; ?>&nbsp;&nbsp;&nbsp;&nbsp;Cidade: <?php echo "$naturalidade"; ?>&nbsp;&nbsp;&nbsp;&nbsp;UF: <?php echo "$estado"; ?></p>
            <p>Nacionalidade:&nbsp;&nbsp;<?php echo "$nacionalidade"; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RG:_______________ Órgão Expeditor:_______________</p>
            <p>Concluiu o:&nbsp;&nbsp; <?php echo "$ano_edui $ano $ano_fase"; ?>&nbsp;&nbsp; série / ano, / fase, ou ciclo do Ensino Fundamental, nos termos da Lei Federal 9.394/96,</p>
            <p> modificada pela Lei Federal n° 11.274/2006 DOU de 06/02/2006</p>
            <br>
        </div>

        <div id="centro4">
            <div id="dentro"><P>INFORMAÇÕES COMPLEMENTARES</P></div>
            <div style=" padding-top: 8px; margin-left: 24px;"><p>Forma de Acesso:</p>
                <div style="display: inline-block;margin-top: -50px;margin-left: 35px;"><p><b>CLASSIFICAÇÃO: _______________</b></p></div> 
                <div style="display: inline-block;margin-top: -50px;margin-left: 35px;"><p><b>RECLASSIFICAÇÃO: _______________</b></p></div> 
            </div>
            <div style="display: inline-block; margin-left: 6cm;">SÉRIE &nbsp;<input type="checkbox"></div>
            <div style="display: inline-block;margin-left: 1cm;">ANO &nbsp;<input type="checkbox" <?php echo $ano_fase_xn; ?>></div>
            <div style="display: inline-block;margin-left: 1cm;">FASE &nbsp;<input type="checkbox" <?php echo $ano_fase_xs; ?> ></div>

            <ol>              
<!--                <li>Modalidade de Ensino: Educação de Jovens e Adultos:<span id="input">SIM<input type="checkbox" <?php echo $ano_fase_xs; ?> >&nbsp;&nbsp;&nbsp;&nbsp;NÃO<input type="checkbox" <?php echo $ano_fase_xn; ?> ></span></li>-->
                <li>O mínimo exigido para promoção é:6,0 e 75% de frequência do total de horas letivas.</li>
                <li>Em caso de Progressão Parcial informamos que o(a) aluno(a) nas(s)_______________ série(s) obteve Progressão Parcial na(s) disciplinas(s)
                    _________________________________________________________________________________
                    de acordo com o Regimento desta Escola que admite o regime de Progressão Parcial em até 02 disciplinas  por série.
                </li>
                <!--<li>Ciclo de Aceleração:<span id="input">SIM<input type="checkbox" >&nbsp;&nbsp;&nbsp;&nbsp;NÃO<input type="checkbox" ></span></li>-->
<!--                <li>Progressão Parcial:<span id="input">SIM<input type="checkbox" >&nbsp;&nbsp;&nbsp;&nbsp;NÃO<input type="checkbox" >&nbsp;&nbsp;&nbsp;&nbsp;N° de Disciplinas<input type="checkbox" ></span></li>-->
                <li>Participante em Seminários de Ensino Religioso:<span id="input">SIM &nbsp;<input type="checkbox"  checked="">&nbsp;&nbsp;&nbsp;NÃO&nbsp;<input type="checkbox" ></span>
                    <p><b>Base Legal:</b>Art.33 da Lei 9.394/96 modificado pela Lei 9.475 de 22/07/1996 DOU.</p>
                </li>
                <li>Dispensa de Educação Física:<span id="input">SIM &nbsp;<input type="checkbox" >&nbsp;&nbsp;&nbsp;NÃO&nbsp;<input type="checkbox" checked=""></span>
                    <p><b>Base Legal:</b>Lei 10.793 de 01/12/2003 DOU.</p>
                </li>
            </ol>  
        </div>
        <div id="centro5">
            <div id="dentro2"><P>OBSERVAÇÕES</P></div>     
            <input type="text" class="inputobs" name="t1" value="<?php echo "$t1"; ?>" maxlength="100">
            <input type="text" class="inputobs" name="t2" value="<?php echo "$t2"; ?>" maxlength="100">
            <input type="text" class="inputobs" name="t3" value="<?php echo "$t3"; ?>" maxlength="100">
            <input type="text" class="inputobs" name="t4" value="<?php echo "$t4"; ?>" maxlength="100">
            <input type="text" class="inputobs" name="t5" value="<?php echo "$t5"; ?>" maxlength="100">   
            <input type="text" class="inputobs" name="t6" value="<?php echo "$t6"; ?>" maxlength="100">   
            <input type="text" class="inputobs" name="t7" value="<?php echo "$t7"; ?>" maxlength="100">  
        </div>        
    </body>
</html>