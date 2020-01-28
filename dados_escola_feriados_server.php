<?php

ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$feriado_nome = filter_input(INPUT_POST, 'inputNomeFeriado', FILTER_DEFAULT);
$feriado = filter_input(INPUT_POST, 'inputFeriado', FILTER_DEFAULT);
$inicial = filter_input(INPUT_POST, 'inputInicial', FILTER_DEFAULT);
$inicial_exclui = filter_input(INPUT_POST, 'inputInicialExclui', FILTER_DEFAULT);
$compromisso = filter_input(INPUT_POST, 'inputCompromisso', FILTER_DEFAULT);
$idAgendamento = filter_input(INPUT_POST, 'idAgendamento', FILTER_DEFAULT);
$title = filter_input(INPUT_POST, 'title', FILTER_DEFAULT);
$start = filter_input(INPUT_POST, 'start', FILTER_DEFAULT);
$end = filter_input(INPUT_POST, 'end', FILTER_DEFAULT);
$color = filter_input(INPUT_POST, 'color', FILTER_DEFAULT);
//
include 'dados_escola_feriados_function.php';
//
if (isset($_POST['botao'])) {
    //
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        // 
        $SQL = "SELECT * FROM `dia_mes_ano` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $d_m_a = date_format(new DateTime($Linha["d_m_a"]), 'd-m-Y');
        $todos .= "$d_m_a,";
        $todos_nomes = substr($todos, 0, -1);
        //
        $sql = "UPDATE `dia_mes_ano` SET `feriado_nome` = '$feriado_nome', `feriados` = '$feriado' WHERE `id` = $lista_id";
        $consulta = mysqli_query($Conexao, $sql);
    }
//
    if ($consulta) {
        //Logar no sistema para gravar Log           
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', 'Alterou as data(s) $todos_nomes: em feriado_nome = $feriado_nome / feriado = $feriado ','SIM',now())";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        //
        if ($Consulta1) {
            header("Location: dados_escola_feriados.php?id=1");
        } else {
            header("Location: dados_escola_feriados.php?id=2");
        }
    } else {
        header("Location: dados_escola_feriados.php?id3");
    }
} elseif (isset($_POST['botao2'])) {

    $sql = "SELECT * FROM `dia_mes_ano` WHERE `ano` LIKE '%$inicial%'";
    $consulta = mysqli_query($Conexao, $sql);
    $linha = mysqli_num_rows($consulta);
    //
    if ($linha > 0) {
        //
        header("Location: dados_escola_feriados.php?id4");
        //
    } else {
//        echo"<script type='text/javascript'>
//                $(document).ready(function () {
//                   //Preenche e mostra o modal           
//                $('#loadingModal_content').html('Carregando...');
//                $('#loadingModal').modal('show');
//                         //Envia a requisicao e espera a resposta
//                $.post('dados_escola_feriados_server')
//                        .done(function () {
//                            //Se nao houver falha na resposta, preenche o modal
//                            $('#loader').removeClass('loader');
//                            $('#loader').addClass('glyphicon glyphicon-ok');
//                            $('#loadingModal_label').html('Sucesso!');
//                            $('#loadingModal_content').html('<br>Query executada com sucesso!');
//                            resetModal();                          
//                        })                                
//               });                
//            </script>";
        echo"<script type='text/javascript'>
                $(document).ready(function () {
                 setTimeout(function () {
                    $('#loader').removeClass();
                    $('#loader').addClass('loader');
                    $('#loadingModal_label').html('<span class='glyphicon glyphicon-refresh'></span>Aguarde...');
                    $('#loadingModal').modal('hide');
                }, 1000);
            });                
            </script>";
        //

        $inicio = '' . $inicial . '-01-01';
        $fim = '' . $inicial . '-12-31';
        //
        $inicio_str = strtotime("$inicio");
        $fim_str = strtotime("$fim");
        $resultado = $fim_str - $inicio_str;
        //
        $dias_dif = (int) floor($resultado / (60 * 60 * 24)); //Em Dias
        //echo "$dias_dif" . '<br>';
        $meses = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outrubro", "Novembro", "Dezembro");
        $dias = array("domingo", "seg", "ter", "qua", "qui", "sex", "sabado", "domingo");
        //
        $i = 0;
        while ($i <= $dias_dif) {
            //
            $dataFinalCalculada = date("Y-m-d", strtotime("$inicio" . "+$i days"));

            $dia = date("d", strtotime("$inicio" . "+$i days"));
            $mes = date("m", strtotime("$inicio" . "+$i days"));
            //$ano = date("Y", strtotime("$inicio" . "+$i days"));
            $semana = date("w", strtotime("$inicio" . "+$i days"));
            //$dmy = $dias[$semana] . " " . $dia . " de " . $meses [$mes - 1] . " de " . $ano;
            //echo"$dmy" . "<br>";
            $i++;
            $sql = "INSERT INTO `dia_mes_ano` (`id`, `d_m_a`, `dias_nome`, `ano`, `feriados`, `feriado_nome`,`compromissos`) VALUES (NULL, '$dataFinalCalculada', '$dias[$semana]', '$inicial','NÃO','','')";
            $consulta = mysqli_query($Conexao, $sql);
        }
        //
        if ($consulta) {
            //Logar no sistema para gravar Log           
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Cadastrou o Ano $inicial  no Sistema da Escola', now())";
            $Consulta1 = mysqli_query($Conexao, $SQL_logar);
            //
            if ($Consulta1) {
                header("Location: dados_escola_feriados.php?id=1");
            } else {
                header("Location: dados_escola_feriados.php?id=2");
            }
//    $date1 = date_create("2017-08-30");
//    $date2 = date_create("2016-08-01");
//    $diff = date_diff($date1, $date2);
            // echo $diff->format("%a") . '<br>';
//
            //  echo $diff->format("%Y");
        }
    }
} elseif (isset($_POST['botao3'])) {
    //    
    if (empty($inicial_exclui)) {
        header("Location: dados_escola_feriados.php?id=2");
    } else {
        //
        $sql = "DELETE FROM `dia_mes_ano` WHERE `ano` LIKE '%$inicial_exclui%'";
        $consulta = mysqli_query($Conexao, $sql);
        //
        if ($consulta) {
            //Logar no sistema para gravar Log           
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Excluiu o Ano $inicial_exclui  do Sistema da Escola','SIM',now())";
            $Consulta1 = mysqli_query($Conexao, $SQL_logar);
            //
            if ($Consulta1) {
                header("Location: dados_escola_feriados.php?id=1");
            } else {
                header("Location: dados_escola_feriados.php?id=2");
            }
        } else {
            header("Location: dados_escola_feriados.php?id=2");
        }
    }
} elseif (isset($_POST['botao4'])) {
    //
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        // 
        $SQL = "SELECT * FROM `dia_mes_ano` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $d_m_a = date_format(new DateTime($Linha["d_m_a"]), 'd-m-Y');
        $todos .= "$d_m_a,";
        $todos_nomes = substr($todos, 0, -1);
        //
        $sql = "UPDATE `dia_mes_ano` SET `compromissos` = '$compromisso' WHERE `id` = $lista_id";
        $consulta = mysqli_query($Conexao, $sql);
    }
//
    if ($consulta) {
        //Logar no sistema para gravar Log           
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', 'Alterou as data(s) $todos_nomes: em Compromisso = $compromisso /','SIM',now())";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        //
        if ($Consulta1) {
            header("Location: dados_escola_feriados.php?id=1");
        } else {
            header("Location: dados_escola_feriados.php?id=2");
        }
    } else {
        header("Location: dados_escola_feriados.php?id3");
    }
    //Agendamentos via FullCalender//
} 