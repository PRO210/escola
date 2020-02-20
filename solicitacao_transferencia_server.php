<?php

ob_start();

include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Consulta = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE  `usuario` = '$usuario_logado'");
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
//
$tipo = $Linha['tipo'];
$permissao = $Linha['permissao'];
$id_usuario = $Linha['id'];
$sistema = "none";
$visao_boleto = "none";
$visao_licensa = "none";
//
if ($tipo == "ROOT" || $tipo == "ADMIN") {
    $sistema = "block";
}
if ($tipo == "ROOT" || $tipo == "ADMIN" || $tipo == "FINANCEIRO") {
    $visao_boleto = "block";
}
if ($permissao == "TODAS") {
    $visao_licensa = "block";
}
//
$botao = filter_input(INPUT_POST, 'botao', FILTER_DEFAULT);
$solicitante = filter_input(INPUT_POST, 'inputSolicitante', FILTER_DEFAULT);
$solicitante_02 = filter_input(INPUT_POST, 'inputSolicitante_02', FILTER_DEFAULT);
$solicitante_02 = filter_input(INPUT_POST, 'inputSolicitante_02', FILTER_DEFAULT);
$entregue = filter_input(INPUT_POST, 'inputEntregue', FILTER_DEFAULT);
$entregue_02 = filter_input(INPUT_POST, 'inputEntregue_02', FILTER_DEFAULT);
$data_entregue = filter_input(INPUT_POST, 'inputDataEntregue', FILTER_DEFAULT);
$data_entregue_02 = filter_input(INPUT_POST, 'inputDataEntregue_02', FILTER_DEFAULT);
//
$inputDeclaracao = filter_input(INPUT_POST, 'inputDSN', FILTER_DEFAULT);
$inputDeclaracao_02 = filter_input(INPUT_POST, 'inputDSN_02', FILTER_DEFAULT);
$inputDataDeclaracao = filter_input(INPUT_POST, 'inputDatD', FILTER_DEFAULT);
$inputDataDeclaracao_02 = filter_input(INPUT_POST, 'inputDatD_02', FILTER_DEFAULT);
$responsavel_declacao = filter_input(INPUT_POST, 'inputRD', FILTER_DEFAULT);
$responsavel_declacao_02 = filter_input(INPUT_POST, 'inputRD_02', FILTER_DEFAULT);
//
$inputDataTransferencia = filter_input(INPUT_POST, 'inputDatT', FILTER_DEFAULT);
$inputDataTransferencia_02 = filter_input(INPUT_POST, 'inputDatT_02', FILTER_DEFAULT);
$inputTransferencia = filter_input(INPUT_POST, 'inputTSN', FILTER_DEFAULT);
$inputTransferencia_02 = filter_input(INPUT_POST, 'inputTSN_02', FILTER_DEFAULT);
$responsavel_transferencia = filter_input(INPUT_POST, 'inputRT', FILTER_DEFAULT);
$responsavel_transferencia_02 = filter_input(INPUT_POST, 'inputRT_02', FILTER_DEFAULT);
//
$inputstatus = filter_input(INPUT_POST, 'inputST', FILTER_DEFAULT);
$inputstatus_02 = filter_input(INPUT_POST, 'inputST_02', FILTER_DEFAULT);
//
if ($botao == "atualizar") {
    //    
    $cont = 0;
    $nome = "";
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        //Consulta para o LOG Solicitação
        $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM alunos_solicitacoes WHERE id_solicitacao= '$lista_id'");
        $Registro_backup = mysqli_fetch_array($Consulta_backup);
        //
        $sql = "UPDATE `alunos_solicitacoes` SET `id_status` = '$inputstatus', `solicitante` = '$solicitante', `entregue` = '$entregue', `data_entregue` = '$data_entregue' , declaracao = '$inputDeclaracao',"
                . "data_declaracao = '$inputDataDeclaracao' , responsavel_declaracao = '$responsavel_declacao', transferencia = '$inputTransferencia', data_transferencia = '$inputDataTransferencia', responsavel_transferencia = '$responsavel_transferencia' WHERE `id_solicitacao` = '$lista_id' ";
        $Consulta_sql = mysqli_query($Conexao, $sql);
        //Consulta para o LOG 2 Solicitações
        $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos_solicitacoes WHERE id_solicitacao= '$lista_id'");
        $Registro_backup2 = mysqli_fetch_array($Consulta_backup2);
        //
        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$lista_id' ");
        $rowf = mysqli_fetch_array($Consultaf);
        $idf_recebe = $rowf['id_aluno_solicitacao'];
        //
        $ConsultaA = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$idf_recebe' ");
        $rowfA = mysqli_fetch_array($ConsultaA);
        $nome .= $rowfA['nome'] . " / ";
        $status = $rowfA['status'];
        //      
        $result = array_diff_assoc($Registro_backup2, $Registro_backup);
        $campo = "";
        //
        foreach ($result as $nome_campo => $valor) {
            //echo "$nome_campo = $valor<br>";
            if (!is_numeric($nome_campo)) {
                // echo "$nome_campo = $valor<br>";
                if ($valor == "N") {
                    $valor = "PENDENTE";
                } elseif ($valor == "S") {
                    $valor = "ENTREGUE";
                } elseif ($valor == "P") {
                    $valor = "PRONTA";
                }
                $campo .= "$nome_campo = $valor / ";
                //echo "$campo";
            }
        }
        //
        $SQL_matricular = "UPDATE alunos SET status = '$inputstatus', data_matricula_update = now() WHERE id= '$idf_recebe' ";
        $Consulta_matricular = mysqli_query($Conexao, $SQL_matricular);
        $ConsultaA = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$idf_recebe' ");
        $rowfA = mysqli_fetch_array($ConsultaA);
        $status2 = $rowfA['status'];
        //
        if ($status == $status2) {
            $status3 = ".";
        } else {
            $status3 = "/ E o STATUS DO ALUNO(A) PARA $status2 ";
        }
        //  
        $cont++;
    }
    //
    if ($cont > 1) {
        if ($Consulta_sql) {
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Alterou o Pedido de Transferência do aluno(a) $nome em: $campo/Transferência = $inputTransferencia/Data da Transferência = $inputDataTransferencia/ Responsável pela Transferênica = $responsavel_transferencia"
                    . "/Declaração = $inputDeclaracao/ Data da Declaração = $inputDataDeclaracao/Responsavel pela Declaração = $responsavel_declacao " . $status3 . "', 'SIM',now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            //            
            session_start();
            $_SESSION['msg'] = "certo";
            header("LOCATION: solicitacao_transferencia.php?todos=1");
        } else {
            session_start();
            $_SESSION['msg'] = "erro";
            header("LOCATION: solicitacao_transferencia.php?todos=0");
        }
    } else {
        if ($Consulta_sql) {
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Alterou o Pedido de Transferência do aluno(a) $nome em: $campo/Transferência = $inputTransferencia/Data da Transferência = $inputDataTransferencia/ Responsável pela Transferênica = $responsavel_transferencia"
                    . "/Declaração = $inputDeclaracao/ Data da Declaração = $inputDataDeclaracao/Responsavel pela Declaração = $responsavel_declacao " . $status3 . "', 'SIM',now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            //            
            session_start();
            $_SESSION['msg'] = "certo";
            header("LOCATION: solicitacao_transferencia.php?id=" . base64_encode($idf_recebe) . "");
        } else {
            session_start();
            $_SESSION['msg'] = "erro";
            header("LOCATION: solicitacao_transferencia.php?id=" . base64_encode($idf_recebe) . "");
        }
    }
    //
} elseif ($botao == "retirar") {
    $nomes = "";
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        //
        if ($lista_id == "") {
            session_start();
            $_SESSION['msg'] = "branco";
            header("LOCATION: solicitacao_transferencia.php?id=" . base64_encode($idf_recebe) . "");
            //
        } else {
            $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$lista_id' ");
            $rowf = mysqli_fetch_array($Consultaf);
            $idf_recebe = $rowf['id_aluno_solicitacao'];
            //
            $ConsultaA = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$idf_recebe' ");
            $rowfA = mysqli_fetch_array($ConsultaA);
            //
            $nomebackup = $rowfA['nome'];
            $nomes .= $nomebackup . ",";
            //
            $sql = "DELETE FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$lista_id'";
            $Consulta = mysqli_query($Conexao, $sql);
        }
    }
    $nomes2 = substr($nomes, 0, -1);
    //
    if ($Consulta) {
        //
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
                . "VALUES ( '$usuario_logado', 'Excluiu o(s) Pedido(s) de Transferência do(s) aluno(s) $nomes2', 'SIM',now())";
        $Consulta2 = mysqli_query($Conexao, $SQL_logar);
        //
        session_start();
        $_SESSION['msg'] = "retira";
        header("LOCATION: solicitacao_transferencia.php?id=" . base64_encode($idf_recebe) . "");
    } else {
        session_start();
        $_SESSION['msg'] = "erro";
        header("LOCATION: solicitacao_transferencia.php?id=" . base64_encode($idf_recebe) . "");
    }
} elseif ($botao == "Folha_de_Rosto") {
    //
    if (count($_POST['aluno_selecionado']) > 1 && $permissao =="TODAS") {
        include_once 'montar_transferencias.php';
        exit();
    } else {
        foreach (($_POST['aluno_selecionado']) as $lista_id) {
//
            $id_envia = base64_encode($lista_id);
            header("LOCATION: montar_transferencia.php?id=$id_envia");
        }
    }
    //
    //Folhas com notas  //Folhas com notas
} elseif ($botao == "Folha_Com_Notas") {
    //   
    if (count($_POST['aluno_selecionado']) > 1 && $permissao =="TODAS") {
//        include_once 'montar_transferencias_notas.php';
        include'montar_transferencias_server_fpdf.php';
        exit();
    } else {
        foreach (($_POST['aluno_selecionado']) as $lista_id) {
            $id_envia = base64_encode($lista_id);
        }
        header("LOCATION: montar_transferencia_notas.php?id=$id_envia");
    }
    //
    //Imprimir Pedidos de Tranferencia     //Imprimir Pedidos de Tranferencia
//
} elseif ($botao == "basica") {
    //
    include_once './pesquisar_no_banco_impressao_1.php';
//
} elseif ($botao == "Mover_Para_Arquivo__Passivo") {
    //
    //
    include_once './cadastrar_copia_turma_server_2.php';
    //
    $id_recebes = "";
    foreach (($_POST['aluno_selecionado']) as $buscar_id) {
        //
        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$buscar_id' ");
        $rowf = mysqli_fetch_array($Consultaf);
        $id_recebes .= $rowf['id_aluno_solicitacao'] . ",";
    }
    $id_recebe = substr($id_recebes, 0, -1);
    include_once './mover_para_arquivo.php';
    exit();
    //
    //
} elseif ($botao == "declaracao") {
    //
    include_once './alunos_declaracoes_tratamento.php';
    //
} elseif ($botao == "transferencias") {
    //    
    $cont = 0;
    $nome = "";
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        //Consulta para o LOG Solicitação
        $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM alunos_solicitacoes WHERE id_solicitacao= '$lista_id'");
        $Registro_backup = mysqli_fetch_array($Consulta_backup);
        //
        $sql = "UPDATE `alunos_solicitacoes` SET `id_status` = '$inputstatus_02', `solicitante` = '$solicitante_02', `entregue` = '$entregue_02', `data_entregue` = '$data_entregue_02' , declaracao = '$inputDeclaracao_02',"
                . "data_declaracao = '$inputDataDeclaracao_02' , responsavel_declaracao = '$responsavel_declacao_02', transferencia = '$inputTransferencia_02', data_transferencia = '$inputDataTransferencia_02', responsavel_transferencia = '$responsavel_transferencia_02' WHERE `id_solicitacao` = '$lista_id' ";
        $Consulta_sql = mysqli_query($Conexao, $sql);
        //Consulta para o LOG 2 Solicitações
        $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos_solicitacoes WHERE id_solicitacao= '$lista_id'");
        $Registro_backup2 = mysqli_fetch_array($Consulta_backup2);
        //
        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$lista_id' ");
        $rowf = mysqli_fetch_array($Consultaf);
        $idf_recebe = $rowf['id_aluno_solicitacao'];
        //
        $ConsultaA = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$idf_recebe' ");
        $rowfA = mysqli_fetch_array($ConsultaA);
        $nome .= $rowfA['nome'] . " / ";
        $status = $rowfA['status'];
        //      
        $result = array_diff_assoc($Registro_backup2, $Registro_backup);
        $campo = "";
        //
        foreach ($result as $nome_campo => $valor) {
            //echo "$nome_campo = $valor<br>";
            if (!is_numeric($nome_campo)) {
                // echo "$nome_campo = $valor<br>";
                if ($valor == "N") {
                    $valor = "PENDENTE";
                } elseif ($valor == "S") {
                    $valor = "ENTREGUE";
                } elseif ($valor == "P") {
                    $valor = "PRONTA";
                }
                $campo .= "$nome_campo = $valor / ";
                //echo "$campo";
            }
        }
        //
        $SQL_matricular = "UPDATE alunos SET status = '$inputstatus_02', data_matricula_update = now() WHERE id= '$idf_recebe' ";
        $Consulta_matricular = mysqli_query($Conexao, $SQL_matricular);
        $ConsultaA = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$idf_recebe' ");
        $rowfA = mysqli_fetch_array($ConsultaA);
        $status2 = $rowfA['status'];
        //
        if ($status == $status2) {
            $status3 = ".";
        } else {
            $status3 = "/ E o STATUS DO ALUNO(A) PARA $status2 ";
        }
        //  
        $cont++;
    }
    //
    if ($cont > 1) {
        if ($Consulta_sql) {
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Alterou o Pedido de Transferência do aluno(a) $nome em: $campo/Transferência = $inputTransferencia/Data da Transferência = $inputDataTransferencia/ Responsável pela Transferênica = $responsavel_transferencia"
                    . "/Declaração = $inputDeclaracao/ Data da Declaração = $inputDataDeclaracao/Responsavel pela Declaração = $responsavel_declacao " . $status3 . "', 'SIM',now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            //            
            session_start();
            $_SESSION['msg'] = "certo";
            header("LOCATION: solicitacao_transferencia.php?todos=1");
        } else {
            session_start();
            $_SESSION['msg'] = "erro";
            header("LOCATION: solicitacao_transferencia.php?todos=0");
        }
        //
        //
    } else {
        if ($Consulta_sql) {
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Alterou o Pedido de Transferência do aluno(a) $nome em: $campo/Transferência = $inputTransferencia/Data da Transferência = $inputDataTransferencia/ Responsável pela Transferênica = $responsavel_transferencia"
                    . "/Declaração = $inputDeclaracao/ Data da Declaração = $inputDataDeclaracao/Responsavel pela Declaração = $responsavel_declacao " . $status3 . "', 'SIM',now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            //            
            session_start();
            $_SESSION['msg'] = "certo";
            header("LOCATION: solicitacao_transferencia.php?id=" . base64_encode($idf_recebe) . "");
        } else {
            session_start();
            $_SESSION['msg'] = "erro";
            header("LOCATION: solicitacao_transferencia.php?id=" . base64_encode($idf_recebe) . "");
        }
    }
    //
}
//  



    