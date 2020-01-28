<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de matrícula (Método POST)
$inep = filter_input(INPUT_POST, 'inputInep', FILTER_DEFAULT);
$turma = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
$turma02 = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
$ouvinte = filter_input(INPUT_POST, 'optOuvinte', FILTER_DEFAULT);
$nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$nascimento = filter_input(INPUT_POST, 'inputNascimento', FILTER_DEFAULT);
$obs = "";
if ($nascimento == "") {
    $nascimento = date('Y-m-d');
    $obs = "O Usúario não informou a data de Nascimento Correta,por Favor retifique!";
}
$fone = filter_input(INPUT_POST, 'inputFone', FILTER_DEFAULT);
$fone2 = filter_input(INPUT_POST, 'inputFone2', FILTER_DEFAULT);
$modelo_certidao = filter_input(INPUT_POST, 'InputModelo_certidao', FILTER_DEFAULT);
$matricula = filter_input(INPUT_POST, 'inputMatricula', FILTER_DEFAULT);
$tipos_de_certidao = filter_input(INPUT_POST, 'inputTiposCertidao', FILTER_DEFAULT);
$certidao = filter_input(INPUT_POST, 'inputCertidao', FILTER_DEFAULT);
$expedicao = filter_input(INPUT_POST, 'inputExpedicao', FILTER_DEFAULT);
$expedicao = substr($expedicao, 8, 2) . '/' . substr($expedicao, 5, 2) . '/' . substr($expedicao, 0, 4);
$naturalidade = filter_input(INPUT_POST, 'inputNaturalidade', FILTER_DEFAULT);
$estado = filter_input(INPUT_POST, 'inputEstado', FILTER_DEFAULT);
$nacionalidade = filter_input(INPUT_POST, 'inputNacionalidade', FILTER_DEFAULT);
$sexo = filter_input(INPUT_POST, 'inputSexo', FILTER_DEFAULT);
$nis = filter_input(INPUT_POST, 'inputNIS', FILTER_DEFAULT);
$bolsa_familia = filter_input(INPUT_POST, 'inputBolsaFamilia', FILTER_DEFAULT);
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
$transferencia = filter_input(INPUT_POST, 'inputTransferencia', FILTER_DEFAULT);
$responsavel = filter_input(INPUT_POST, 'inputResponsavel', FILTER_DEFAULT);
$data_transferencia = filter_input(INPUT_POST, 'inputDataTransferencia', FILTER_DEFAULT);
//Tratamento dos dados de transferência
$teste_transferencia = "";
$teste_declaracao = "";
$teste_data_declaracao = "";
$teste_data_transferencia = "";
$teste_responsavel_declaracao = "";
$teste_responsavel_transferencia = "";
//
if ($transferencia == "TRANSFERÊNCIA") {
    $teste_transferencia = "SIM";
} elseif ($transferencia == "DECLARAÇÃO") {
    $teste_declaracao = "SIM";
} else {
    $teste_transferencia = "NÃO";
    $teste_declaracao = "NÃO";
}
//
if ($transferencia == "TRANSFERÊNCIA") {
    $teste_data_transferencia = "$data_transferencia";
} else {
    $teste_data_declaracao = "$data_transferencia";
}
//
if ($transferencia == "TRANSFERÊNCIA") {
    $teste_responsavel_transferencia = "$responsavel";
} else {
    $teste_responsavel_declaracao = "$responsavel";
}
$inputTextArea = filter_input(INPUT_POST, 'inputTextArea', FILTER_DEFAULT);
//
//Consulta a Data do Censo na Tabela Escola
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
//
$data_censo = $Registro["data_censo"];
$data = date('Y-m-d');
//
if ($data <= $data_censo) {
    $status = "CURSANDO";
} else {
    $status = "ADIMITIDO DEPOIS";
}
//
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
        </style>
    </head>
    <body>
        <?php
        //Cadastra no banco de dados e evita a duplicidade
        $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE nome = '$nome'");
        $Linha_backup = mysqli_fetch_array($Consulta_backup, MYSQLI_BOTH);
        $id = $Linha_backup['id'];
        //
        if (mysqli_num_rows($Consulta_backup) > 0) {
            //
            session_start();
            $_SESSION['id'] = "$id";
            header("Location:cadastrar_transferido.php?id=2");
            //
        } else {
            //
            $SQL_matricular = "INSERT INTO alunos (`inep`, `turma`, `status_ext`,`nome`, `data_nascimento`, `modelo_certidao` , `matricula_certidao` , `tipos_de_certidao` , `certidao_civil` , `data_expedicao` , `naturalidade` , `estado` , `nacionalidade` , `sexo` , `nis`, `bolsa_familia` , `sus`, `pai` , `profissao_pai` , `mae`, `profissao_mae`, `endereco`, `cidade`, `estado_cidade`, `transporte`, `urbano`,`ponto_onibus`,`motorista`,`motorista2`,`declaracao`,`data_declaracao`,`responsavel_declaracao`,`transferencia`,`data_transferencia` , `responsavel_transferencia` , `fone` , `fone2` , `status`, `obs`,`cor_raca`,`necessidades`,`especificidades` )"
                    . "VALUES ( '$inep','$turma','$ouvinte' ,'$nome' , '$nascimento' , '$modelo_certidao' , '$matricula' , '$tipos_de_certidao', '$certidao' , '$expedicao' , '$naturalidade' , '$estado' , '$nacionalidade' , '$sexo' , '$nis' , '$bolsa_familia' , '$sus' , '$pai', '$profissao_pai', '$mae', '$profissao_mae' , '$endereco' , '$cidade' , '$estado_cidade' , '$transporte' , '$urbano','$ponto_onibus','$motorista' , '$motorista2' , '$teste_declaracao' , '$teste_data_declaracao' , '$teste_responsavel_declaracao' , '$teste_transferencia' , '$teste_data_transferencia' , '$teste_responsavel_transferencia' , '$fone' , '$fone2' , '$status' , '$inputTextArea $obs','$cor','$necessidades','$especificidades' )";
            $Consulta = mysqli_query($Conexao, $SQL_matricular);
            $id_matricular = mysqli_insert_id($Conexao);
            //
            if ($Consulta) {
                include_once 'cadastrar_copia_turma_server_2.php';
                //
                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turma02'";
                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                //
                $nome_turma = $Linha_turma["turma"];
                $turno_turma = $Linha_turma["turno"];
                $unico_turma = $Linha_turma["unico"];
                //Logar no sistema             
                $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`)"
                        . " VALUES ( '$usuario_logado', 'Cadastrou o aluno $nome no $nome_turma $unico_turma ($turno_turma)','SIM',now())";
                $Consulta1 = mysqli_query($Conexao, $SQL_logar);
                if (!$Consulta1) {
                    header("Location:cadastrar_transferido.php?id=2");
                }
            } else {
                header("Location:cadastrar_transferido.php?id=2");
            }
        }
        ?>    
        <div class="container">
            <script src="js/bootstrap.js" type="text/javascript"></script>            
            <h3 style="text-align: center">
                <?php
                if ($Consulta) {
                    echo "O Aluno $nome foi cadastrado no $nome_turma $unico_turma com Sucesso !";
                }
                ?>
            </h3>
            <p> <a  href="impressao.php?id=<?php echo $id_matricular; ?> "target="blanc" role="button" id="link"> <button class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-print"></span>&nbsp;Imprimir Registro</button></a></p>
            <p> <a  href="folha_re_matricula.php?id=<?php echo $id_matricular; ?> "target="blanc" role="button" id="link"> <button class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-print"></span>&nbsp;Imprimir Folha de Ré Matricula</button></a></p>
            <p> <a  href="pesquisar_no_banco_unitario.php?id= <?php echo base64_encode($id_matricular); ?>" role="button" id="link"> <button class="btn btn-warning btn-lg btn-block"><span class="glyphicon glyphicon-ok"></span>&nbsp;Confirmar a Matricula</button></a></p>
            <p> <a  href="principal.php" role="button" id="link" ><button class="btn btn- btn-lg btn-block" ><span class="glyphicon glyphicon-home"></span>&nbsp;Home</button></a></p>
            <p> <a  href="cadastrar_transferido.php" role="button"  ><button class="btn btn-primary btn-lg btn-block" ><span class="glyphicon glyphicon-plus"></span>&nbsp;Matricular Outro Aluno</button></a></p>
            <p> <a  href="alunos_arquivo_passivo.php" role="button" ><button class="btn amarelo_sol btn-lg btn-block" ><span class=" glyphicon glyphicon-folder-open"></span>&nbsp;Arquivo Passivo</button></a></p>
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