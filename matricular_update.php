<?php
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de matrícula (Método POST)
$inep = filter_input(INPUT_POST, 'inputInep', FILTER_DEFAULT);
$turma = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
$ouvinte = filter_input(INPUT_POST, 'optOuvinte', FILTER_DEFAULT);
$nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$nascimento = filter_input(INPUT_POST, 'inputNascimento', FILTER_DEFAULT);
$fone = filter_input(INPUT_POST, 'inputFone', FILTER_DEFAULT);
$fone2 = filter_input(INPUT_POST, 'inputFone2', FILTER_DEFAULT);
$modelo_certidao = filter_input(INPUT_POST, 'inputModelo_certidao', FILTER_DEFAULT);
$matricula = filter_input(INPUT_POST, 'inputMatricula', FILTER_DEFAULT);
$tipos_de_certidao = filter_input(INPUT_POST, 'inputTiposCertidao', FILTER_DEFAULT);
$certidao = filter_input(INPUT_POST, 'inputCertidao', FILTER_DEFAULT);
$expedicao = filter_input(INPUT_POST, 'inputExpedicao', FILTER_DEFAULT);
$naturalidade = filter_input(INPUT_POST, 'inputNaturalidade', FILTER_DEFAULT);
$estado = filter_input(INPUT_POST, 'inputEstado', FILTER_DEFAULT);
$nacionalidade = filter_input(INPUT_POST, 'inputNacionalidade', FILTER_DEFAULT);
$sexo = filter_input(INPUT_POST, 'inputSexo', FILTER_DEFAULT);
$nis = filter_input(INPUT_POST, 'inputNIS', FILTER_DEFAULT);
$bolsa_familia = filter_input(INPUT_POST, 'inputBolsa_familia', FILTER_DEFAULT);
$sus = filter_input(INPUT_POST, 'inputSUS', FILTER_DEFAULT);
$necessidades = filter_input(INPUT_POST, 'inputNecessidades', FILTER_DEFAULT);
$especificidades = filter_input(INPUT_POST, 'especificidades', FILTER_DEFAULT);
$pai = filter_input(INPUT_POST, 'inputPai', FILTER_DEFAULT);
$profissao_pai = filter_input(INPUT_POST, 'inputProfissaoPai', FILTER_DEFAULT);
$mae = filter_input(INPUT_POST, 'inputMae', FILTER_DEFAULT);
$profissao_mae = filter_input(INPUT_POST, 'inputProfissaoMae', FILTER_DEFAULT);
$endereco = filter_input(INPUT_POST, 'inputEndereco', FILTER_DEFAULT);
$cidade = filter_input(INPUT_POST, 'inputCidade', FILTER_DEFAULT);
$estado_cidade = filter_input(INPUT_POST, 'inputEstado_Cidade', FILTER_DEFAULT);
$cor = filter_input(INPUT_POST, 'inputCor', FILTER_DEFAULT);
$transporte = filter_input(INPUT_POST, 'inputTransporte', FILTER_DEFAULT);
$urbano = filter_input(INPUT_POST, 'optUrbano', FILTER_DEFAULT);
$motorista = "";
$motorista2 = "";
if ($transporte == "SIM") {
    $ponto_onibus = filter_input(INPUT_POST, 'inputPontoAluno', FILTER_DEFAULT);
    $motorista = filter_input(INPUT_POST, 'inputMotorista', FILTER_DEFAULT);
    $motorista2 = filter_input(INPUT_POST, 'inputMotorista2', FILTER_DEFAULT);
} else {
    $ponto_onibus = "--------";
    $motorista = "--------";
    $motorista2 = "--------";
}
//$nascimento = substr($nascimento, 6, 4) . '-' . substr($nascimento, 3, 2) . '-' . substr($nascimento, 0, 2);
$idUpdate = filter_input(INPUT_POST, 'inputIdUpdate', FILTER_DEFAULT);
$inputDeclaracao = filter_input(INPUT_POST, 'inputDeclaracao', FILTER_DEFAULT);
$inputDataDeclaracao = filter_input(INPUT_POST, 'inputDataDeclaracao', FILTER_DEFAULT);
$inputDataDeclaracao = substr($inputDataDeclaracao, 6, 4) . '-' . substr($inputDataDeclaracao, 3, 2) . '-' . substr($inputDataDeclaracao, 0, 2);
$inputDataTransferencia = filter_input(INPUT_POST, 'inputDataTransferencia', FILTER_DEFAULT);
$inputDataTransferencia = substr($inputDataTransferencia, 6, 4) . '-' . substr($inputDataTransferencia, 3, 2) . '-' . substr($inputDataTransferencia, 0, 2);
$inputTransferencia = filter_input(INPUT_POST, 'inputTransferencia', FILTER_DEFAULT);
$data_renovacao_matricula = filter_input(INPUT_POST, 'inputDataRenovacaoMatricula', FILTER_DEFAULT);
$inputstatus = filter_input(INPUT_POST, 'inputstatus', FILTER_DEFAULT);
$responsavel_declacao = filter_input(INPUT_POST, 'inputResponsavelDeclaracao', FILTER_DEFAULT);
$responsavel_transferencia = filter_input(INPUT_POST, 'inputResponsavelTransferencia', FILTER_DEFAULT);
$inputTextArea = filter_input(INPUT_POST, 'inputTextArea', FILTER_DEFAULT);
$inputexcluido = filter_input(INPUT_POST, 'inputArquivado', FILTER_DEFAULT);
$inputMatricula = filter_input(INPUT_POST, 'inputDataMatricula', FILTER_DEFAULT);
$Matricula_convertida = substr($inputMatricula, 6, 4) . '-' . substr($inputMatricula, 3, 2) . '-' . substr($inputMatricula, 0, 2);
//Arquivos capturados para o LOG
$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$idUpdate'");
$Registro_backup = mysqli_fetch_array($Consulta_backup);
//
$Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$idUpdate'");
$Registro_backup2 = mysqli_fetch_array($Consulta_backup2, MYSQLI_BOTH);
$nomebackup = $Registro_backup2["nome"];
$turmabackup = $Registro_backup2["turma"];

$SQL_matricular = "UPDATE alunos SET Data_matricula = '$Matricula_convertida' ,inep = '$inep', turma = '$turma', `status_ext` = '$ouvinte', nome = '$nome', data_nascimento = '$nascimento',modelo_certidao = '$modelo_certidao', matricula_certidao = '$matricula', tipos_de_certidao = '$tipos_de_certidao',certidao_civil = '$certidao',data_expedicao = '$expedicao',naturalidade =  '$naturalidade', estado = '$estado', nacionalidade = '$nacionalidade', sexo = '$sexo', nis = '$nis', bolsa_familia = '$bolsa_familia',sus = '$sus', pai = '$pai', profissao_pai = '$profissao_pai', mae = '$mae', profissao_mae = '$profissao_mae', endereco = '$endereco', cidade = '$cidade', transporte = '$transporte', "
        . " estado_cidade = '$estado_cidade',urbano = '$urbano' ,ponto_onibus = '$ponto_onibus',motorista = '$motorista', motorista2 = '$motorista2', data_matricula_update = now(), declaracao = '$inputDeclaracao',data_declaracao = '$inputDataDeclaracao' ,responsavel_declaracao = '$responsavel_declacao',transferencia = '$inputTransferencia', data_transferencia = '$inputDataTransferencia',responsavel_transferencia = '$responsavel_transferencia' , data_renovacao_matricula = '$data_renovacao_matricula', status = '$inputstatus', fone = '$fone', fone2 = '$fone2', obs = '$inputTextArea', cor_raca = '$cor', necessidades = '$necessidades', especificidades = '$especificidades' WHERE id= '$idUpdate' ";
$Consulta = mysqli_query($Conexao, $SQL_matricular);

if ($Consulta) {
    //
    $alterar = "SIM";
    $Consulta_final = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id`= $idUpdate ");
    $row_final = mysqli_fetch_array($Consulta_final);
    $result = array_diff_assoc($row_final, $Registro_backup);
    $campo = "";
    //
    foreach ($result as $nome_campo => $valor) {
        //echo "$nome_campo = $valor<br>";
        if (!is_numeric($nome_campo)) {
            // echo "$nome_campo = $valor<br>";
            //
            if ($nome_campo == "turma") {
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$valor'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
                $nome_turma = $Linha_turma["turma"];
                $turno_turma = $Linha_turma["turno"];
                $unico_turma = $Linha_turma["unico"];
                $valor = "$nome_turma $unico_turma ($turno_turma)";

                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$Registro_backup[$nome_campo]'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
                $nome_turma = $Linha_turma["turma"];
                $turno_turma = $Linha_turma["turno"];
                $unico_turma = $Linha_turma["unico"];
                $ano_turma = substr($Linha_turma["ano"],0,-6);
                $tudo = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
                $Registro_backup[$nome_campo] = $tudo;
            }
            //  echo "$nome_campo = $valor<br>";
            if ($Registro_backup[$nome_campo] == "") {
                $Registro_backup[$nome_campo] = "Vazio";
            }
            if ($valor == "") {
                $valor = "Vazio";
            }
            //
            $campo .= "$nome_campo = De $Registro_backup[$nome_campo] para $valor / ";
        }
    }
    //
    include_once 'cadastrar_copia_turma_server_2.php';
    //
//Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou o(s) campo(s) do aluno(a) em: $campo','$alterar',now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar);
//Logar na Tabela alunos_log
    $SQL_logar = "INSERT INTO alunos_log (`usuario`, `aluno_id`,`acao`,`acao_resumo`,`data`) "
            . "VALUES ( '$usuario_logado','$idUpdate','Alterou o(s) campo(s) em: $campo','ALTERAR',now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar);
    //echo "Alterou os campos do aluno(a) $nomebackup em: $campo'";
    //
} else {
    echo "falha na atualização";
    echo mysqli_error($Conexao);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <link href="css/cadastrar_transferido_server.css" rel="stylesheet" type="text/css"/>
        <title></title>
        <style type="text/css">
            .amarelo_sol{             
                background-color: #FFFF00;
            }
            .preto{             
                background-color: #000000;
            }
        </style>
    </head>
    <body>
        <div class="container" >
            <script src="js/bootstrap.js" type="text/javascript"></script>           
            <h3 >
                <?php
                if ($Consulta) {
                    echo "<h4>O Registro do aluno(a) $nome foi atualizado com sucesso!!</h4>";
                }
                ?>
            </h3>
            <p> <a  href="impressao.php?id=<?php echo $idUpdate; ?>"          target="blanc" role="button" id="link"  > <button class="btn btn-success btn-lg btn-block " ><span class="glyphicon glyphicon-print"></span>&nbsp;Imprimir Folha de Rosto da Matricula</button></a>
            </p>
            <p><a  href="folha_re_matricula.php?id=<?php echo $idUpdate; ?>" target="blanc" role="button" id="link"  > <button class="btn btn-success btn-lg btn-block" ><span class="glyphicon glyphicon-print"></span>&nbsp;Imprimir Folha de Rematricula</button></a>
            </p>
            <p> <a  href="impressao_transferencia_provisoria_tratamento.php?id=<?php echo $idUpdate; ?>" target="blanc" role="button" id="link"> <button class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-print"></span>&nbsp;Declaração de Transferência</button></a></p>
            <p> <a  href="pesquisar_no_banco_unitario.php?id= <?php echo base64_encode($idUpdate); ?>" role="button" > <button class="btn btn-warning btn-lg btn-block"><span class="glyphicon glyphicon-ok"></span>&nbsp;Confirmar a Matricula</button></a></p>
            <p> <a  href="principal.php" role="button" ><button class="btn btn- btn-lg btn-block" ><span class="glyphicon glyphicon-home"></span>&nbsp;Home</button></a></p>
            <p> <a  href="cadastrar_transferido.php" role="button"  ><button class="btn btn-primary btn-lg btn-block" ><span class="glyphicon glyphicon-plus"></span>&nbsp;Matricular De Novo</button></a></p>
            <p> <a  href="alunos_arquivo_passivo.php" role="button" ><button class="btn amarelo_sol btn-lg btn-block" ><span class=" glyphicon glyphicon-folder-open"></span>&nbsp;Arquivo Passivo dos Alunos</button></a></p>
            <p> <a  href="solicitacao_transferencia.php" role="button" ><button class="btn btn-danger btn-lg btn-block" ><span class=""></span>&nbsp;Solicitações de Transferências</button></a></p>
            <p> <a  href="alunos_desistentes.php" role="button" ><button class="btn preto btn-lg btn-block" ><span class=""></span>&nbsp;Alunos Desistentes</button></a></p>

        </div>
    </body>
    <script type="text/javascript">
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
    </script>
</html>

