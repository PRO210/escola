<?php

ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
if (isset($_POST['atualizar'])) {
//
    $turma_update = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
    $status_update = filter_input(INPUT_POST, 'inputStatus', FILTER_DEFAULT);

    if ($status_update == "") {
        $status = "";
        $status_obs = "";
    } else {
        $status = ",status = '$status_update' ";
        $status_obs = " e o Status para $status_update ";
    }
    $todos = "";
    //
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
//
        $SQL = "SELECT * FROM `alunos` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
        //
        $SQL_matricular = "UPDATE alunos SET turma = '$turma_update' $status, data_matricula_update = now() WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        //
        $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turma_update'";
        $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
        $Linha_turma = mysqli_fetch_array($Consulta_turma);
        $nome_turma = $Linha_turma["turma"];
        $turno_turma = $Linha_turma["turno"];
        $unico_turma = $Linha_turma["unico"];
        $ano_turma = date_format(new DateTime($Linha_turma["ano"]), 'Y');
    }
//Logar no sistema para gravar Log   
    $alterar = "SIM";
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou a turma do(as) aluno(as) : $todos_nomes  para o $nome_turma $unico_turma ($turno_turma) - $ano_turma $status_obs ','$alterar', now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta) {
        header("Location: alunos.php?id=1");
    } else {
        header("Location: alunos.php?id=2");
    }
//
} elseif (isset($_POST['incluir'])) {
//
    $bolsa_familia_incluir = filter_input(INPUT_POST, 'incluir', FILTER_DEFAULT);
    $todos = "";
//
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
//
        $SQL = "SELECT * FROM `alunos` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
//
        $SQL_matricular = "UPDATE alunos SET data_matricula_update = now(), bolsa_familia = '$bolsa_familia_incluir' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
//        
    }
//Logar no sistema para gravar Log           
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou o Bolsa Família do(a) aluno(as) : $todos_nomes para $bolsa_familia_incluir', now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta) {
        header("Location: alunos.php?id=1");
    } else {
        header("Location: alunos.php?id=2");
    }
//
} elseif (isset($_POST['retirar'])) {
    $todos = "";
    $bolsa_familia_retirar = filter_input(INPUT_POST, 'retirar', FILTER_DEFAULT);

    foreach (($_POST['aluno_selecionado']) as $lista_id) {
//
        $SQL = "SELECT * FROM `alunos` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
//
        $SQL_matricular = "UPDATE alunos SET data_matricula_update = now(), bolsa_familia = '$bolsa_familia_retirar' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
//
    }
//Logar no sistema para gravar Log           
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou o Bolsa Família do(as) aluno(as): $todos_nomes para $bolsa_familia_retirar', now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta) {
        header("Location: alunos.php?id=1");
    } else {
        header("Location: alunos.php?id=2");
    }
//
//Imprimir Todos
} elseif (isset($_POST['basica'])) {
    //
    $txt_option = "1";
    include_once './pesquisar_no_banco_impressao.php';
} elseif (isset($_POST['geral'])) {
    $txt_option = "2";
    include_once './pesquisar_no_banco_impressao.php';
} elseif (isset($_POST['tudo'])) {
    $txt_option = "";
    include_once './pesquisar_no_banco_impressao.php';
//
//Arquivo Passivo Incluir //Arquivo Passivo Incluir
//
} elseif (isset($_POST['Arquivo_Passivo'])) {
    $nome = "";
    foreach (($_POST['aluno_selecionado']) as $lista_id) {

        $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$lista_id'");
        $Registro_backup = mysqli_fetch_array($Consulta_backup, MYSQLI_BOTH);
        $nomebackup = $Registro_backup['nome'];
        $nome .= "$nomebackup,";
        $nomes = substr($nome, 0, -1);
        //
        $pasta = filter_input(INPUT_POST, 'inputPasta', FILTER_DEFAULT);
        //
        $SQL_matricular = "UPDATE alunos SET data_matricula_update = now(), excluido = 'S', ap_pasta = '$pasta' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        //
    }if ($Consulta) {
        //
        include_once 'cadastrar_copia_turma_server_2.php';
        //Logar no sistema para gravar Log    
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', ' Moveu para a pasta $pasta do Arquivo Passivo o(s) aluno(as): $nomes ','SIM',now() )";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        header("location: alunos_arquivo_passivo.php?id=1");
    } else {
        header("location: alunos_arquivo_passivo.php?id=3");
    }
    //
    //Retirar do aruivo passivo
    //
} elseif (isset($_POST['Arquivo_Passivo_Retirar'])) {
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$lista_id'");
        $Registro_backup3 = mysqli_fetch_array($Consulta_backup2, MYSQLI_BOTH);
        $nomebackup = $Registro_backup3['nome'];
        $pastabackup = $Registro_backup3['ap_pasta'];
        $id_aluno = base64_encode($lista_id);
        //
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
        //A consulta para obter o nome não está funcionando
        $SQL_matricular = "UPDATE alunos SET data_matricula_update = now(), status = '$status', status_ext = '' , excluido = 'N' , `ap_pasta` = '' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        //Logar no sistema para gravar Log    
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', ' Retirou o(as) aluno(as):$nomebackup da Pasta $pastabackup do Arquivo Passivo','SIM',now() )";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    }
    if ($Consulta) {
        //Copia de Turmas para Colocar o Aluno
        include_once 'cadastrar_copia_turma_server_2.php';
        //
        session_start(); // Inicia a sessão
        $_SESSION['AP'] = 'Atualize os Dados Do Aluno(a) Caso Necessário! Exemplo: A Turma, o Turno, Endereço ou Telefone :)';
        header("location: cadastrar_update.php?id=$id_aluno");
    } else {
        header("location: alunos_arquivo_passivo.php?id=3");
    }
    //
} elseif (isset($_POST['Arquivo_Passivo_trocar'])) {
    //
    $todos = "";
    $trocar_pasta = filter_input(INPUT_POST, 'inputPasta', FILTER_DEFAULT);
    //
    if ($trocar_pasta == "") {
        header("location: alunos_arquivo_passivo.php?id=5");
        exit();
    }
    //
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        //
        $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$lista_id'");
        $Registro_backup2 = mysqli_fetch_array($Consulta_backup2);
        $nomebackup = $Registro_backup2["nome"];
        $todos .= "$nomebackup,";
        $todos_nomes = substr($todos, 0, -1);
        //       
        $SQL_matricular = "UPDATE alunos SET data_matricula_update = now(), `ap_pasta` = '$trocar_pasta' WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        //Logar no sistema para gravar Log    
    }
    if ($Consulta) {
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', ' Mudou o(as) aluno(as):$todos_nomes para a pasta $trocar_pasta ','SIM',now() )";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        header("location: alunos_arquivo_passivo.php?id=1");
    } else {
        header("location: alunos_arquivo_passivo.php?id=3");
    }
    //
//
} elseif (isset($_POST['Arquivo_Passivo_acrescentar_pasta'])) {
    //   
    $nova_pasta = filter_input(INPUT_POST, 'inputPastaNova', FILTER_DEFAULT);
    $SQL_matricular = "INSERT INTO `pastas_arquivo_passivo` (`id`, `pasta`) VALUES (NULL, '$nova_pasta') ";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);
    //Logar no sistema para gravar Log    

    if ($Consulta) {
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
                . "VALUES ( '$usuario_logado', ' Criou a Pasta:$nova_pasta para o Arquivo Passivo','SIM',now() )";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        header("location: alunos_arquivo_passivo.php?id=4");
    } else {
        header("location: alunos_arquivo_passivo.php?id=3");
    }
    //
//
} elseif (isset($_POST['Arquivo_Passivo_excluir_pasta'])) {
    //   
    $exclui_pasta = filter_input(INPUT_POST, 'inputPastaExclui', FILTER_DEFAULT);
    //
    $sql_backup = mysqli_query($Conexao, "SELECT * FROM `pastas_arquivo_passivo` WHERE `id` = '$exclui_pasta' ");
    $Registro_backup = mysqli_fetch_array($sql_backup, MYSQLI_BOTH);
    $nomebackup = $Registro_backup['pasta'];
    //       
    $SQL_matricular = "DELETE FROM `pastas_arquivo_passivo` WHERE `pastas_arquivo_passivo`.`id` = '$exclui_pasta' ";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);
    //Logar no sistema para gravar Log    

    if ($Consulta) {
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`, `excluir`,`data`) "
                . "VALUES ( '$usuario_logado', ' Excluiu a Pasta:$nomebackup do Arquivo Passivo','SIM' ,now() )";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        header("location: alunos_arquivo_passivo.php?id=4");
    } else {
        header("location: alunos_arquivo_passivo.php?id=3");
    }
    //
//
} elseif (isset($_POST['Transporteincluir'])) {
//    
    $todos = "";
    foreach (($_POST['aluno_selecionado']) as $lista_id) {//
        //
        $transporte = $_POST['Transporteincluir'];
        $ponto_onibus = filter_input(INPUT_POST, 'inputPontoAluno', FILTER_DEFAULT);
        $motorista = filter_input(INPUT_POST, 'inputMotorista', FILTER_DEFAULT);
        $motorista2 = filter_input(INPUT_POST, 'inputMotorista2', FILTER_DEFAULT);
//////       
        $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$lista_id'");
        $Registro_backup2 = mysqli_fetch_array($Consulta_backup2);
        $nomebackup = $Registro_backup2["nome"];
        $todos .= "$nomebackup,";
        $todos_nomes = substr($todos, 0, -1);
/////
        $SQL_matricular = "UPDATE alunos SET transporte  = '$transporte', ponto_onibus = '$ponto_onibus' ,motorista = '$motorista', motorista2 = '$motorista2', data_matricula_update = now() WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
//Logar no sistema para gravar Log    
    $alterar = "SIM";
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', ' Alterou o(as) aluno(as) $todos_nomes em: transporte  = $transporte/ Ponto de Ônibus = $ponto_onibus /motorista = $motorista / motorista2 = $motorista2' ,'$alterar',now() )";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    //
    if ($Consulta && $Consulta1) {
        header("Location: alunos.php?id=1");
    } else {
        header("Location: alunos.php?id=2");
    }
//
} elseif (isset($_POST['Transporteretirar'])) {//
    //
    $todos = "";
    foreach (($_POST['aluno_selecionado']) as $lista_id) {//
        $transporte = $_POST['Transporteretirar'];
        $motorista = "--------";
        $motorista2 = "--------";
////// 
        $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$lista_id'");
        $Registro_backup2 = mysqli_fetch_array($Consulta_backup2);
        $nomebackup = $Registro_backup2['nome'];
        $todos .= "$nomebackup,";
        $todos_nomes = substr($todos, 0, -1);
//////
        $SQL_matricular = "UPDATE alunos SET transporte  = '$transporte' ,ponto_onibus = '' ,motorista = '$motorista', motorista2 = '$motorista2', data_matricula_update = now() WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
//Logar no sistema para gravar Log   
    $alterar = "SIM";
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', ' Alterou o(as) aluno(as) $todos_nomes em: transporte  = $transporte/ Ponto de Ônibus = ----- /motorista = $motorista / motorista2 = $motorista2' ,'$alterar',now() )";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta && $Consulta2) {
        header("Location: alunos.php?id=1");
    } else {
        header("Location: alunos.php?id=2");
    }
} elseif (isset($_POST['coringa'])) {
    $todos = "";
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        $estado = "";
        $estado = filter_input(INPUT_POST, 'inputEstado', FILTER_DEFAULT);
        if ($estado == "") {
            $N_E = "";
        } else {
            $N_E = "estado  = '$estado',";
            $N_E_B = "estado  = $estado";
        }
        $naturalidade = "";
        $naturalidade = filter_input(INPUT_POST, 'inputNaturalidade', FILTER_DEFAULT);
        if ($naturalidade == "") {
            $N = "";
        } else {
            $N = "naturalidade = '$naturalidade',";
            $N_B = "naturalidade = $naturalidade";
        }
        $sexo = "";
        $sexo = filter_input(INPUT_POST, 'inputSexo', FILTER_DEFAULT);
        if ($sexo == "") {
            $S = "";
        } else {
            $S = "sexo = '$sexo',";
            $S_B = "sexo = $sexo";
        }
        $ouvinte = "";
        $ouvinte = filter_input(INPUT_POST, 'inputOuvinte', FILTER_DEFAULT);
        if ($ouvinte == "") {
            $O = "";
        } else {
            $O = "status_ext = '$ouvinte',";
            $O_B = "status_ext = $ouvinte";
        }
        $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$lista_id'");
        $Registro_backup2 = mysqli_fetch_array($Consulta_backup2, MYSQLI_BOTH);
        $nomebackup = $Registro_backup2['nome'];

        $todos .= "$nomebackup,";
        $todos_nomes = substr($todos, 0, -1);
//
        $SQL_matricular = "UPDATE alunos SET $N_E $N $S $O data_matricula_update = now() WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
//Logar no sistema para gravar Log         
    $alterar = "SIM";
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', ' Alterou o(as) aluno(as) $todos_nomes em: $N_E_B / $N_B / $S_B /$O_B ','$alterar',now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta) {
        header("Location: alunos.php?id=1");
    } else {
        header("Location: alunos.php?id=2");
    }
} elseif (isset($_POST['extra_incluir'])) {
//
    $turma_extra = filter_input(INPUT_POST, 'inputTurmaExtra', FILTER_DEFAULT);
    //
    $todos = "";
//
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
//
        $SQL = "SELECT * FROM `alunos` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
//
        $Cadastrar_turma_extra = "UPDATE alunos SET `turma_extra_aluno`= '$turma_extra', `status_extra_aluno`= 'CURSANDO', data_matricula_update= now()  WHERE `id`= '$lista_id' ";
        $Consulta_turma_extra = mysqli_query($Conexao, $Cadastrar_turma_extra);
    }
//Logar no sistema para gravar Log   
    $alterar = "SIM";
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', 'Inseriu o(as) aluno(as) : $todos_nomes no $turma_extra', '$alterar',now())";
    $Consulta_turma_extra_2 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta_turma_extra && $Consulta_turma_extra_2) {
        header("Location: alunos_turma_extra.php?id=1");
    } else {
        header("Location: alunos_turma_extra.php?id=2");
    }
} elseif (isset($_POST['extra_trocar'])) {
//
    $turma_extra = filter_input(INPUT_POST, 'inputTurmaExtra', FILTER_DEFAULT);
    //
    $todos = "";
//
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
//
        $SQL = "SELECT * FROM `alunos` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
//
        $Cadastrar_turma_extra = "UPDATE alunos SET `turma_extra_aluno`= '$turma_extra' , data_matricula_update= now()  WHERE `id`= '$lista_id' ";
        $Consulta_turma_extra = mysqli_query($Conexao, $Cadastrar_turma_extra);
    }
//Logar no sistema para gravar Log           
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Atualizou o(as) aluno(as) : $todos_nomes no $turma_extra', now())";
    $Consulta_turma_extra_2 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta_turma_extra && $Consulta_turma_extra_2) {
        header("Location: alunos_turma_extra.php?id=1");
    } else {
        header("Location: alunos_turma_extra.php?id=2");
    }
} elseif (isset($_POST['extra_retirar'])) {
//
    $turma_extra = filter_input(INPUT_POST, 'inputTurmaExtra', FILTER_DEFAULT);
    //
    $todos = "";
//
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
//
        $SQL = "SELECT * FROM `alunos` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
//
        $Cadastrar_turma_extra = "UPDATE alunos SET `status_extra_aluno`= 'NÃO', data_matricula_update= now()  WHERE `id`= '$lista_id' ";
        $Consulta_turma_extra = mysqli_query($Conexao, $Cadastrar_turma_extra);
    }

//Logar no sistema para gravar Log           
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Retirou o(as) aluno(as) : $todos_nomes da(s) turma(s) Extra(s) $turma_extra', now())";
    $Consulta_turma_extra_2 = mysqli_query($Conexao, $SQL_logar);
//
    if ($Consulta_turma_extra && $Consulta_turma_extra_2) {
        header("Location: alunos_turma_extra.php?id=1");
    } else {
        header("Location: alunos_turma_extra.php?id=2");
    }
} elseif (isset($_POST['transferir'])) {
    $todos = "";
//
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
//
        $SQL = "SELECT * FROM `alunos` WHERE `id` = '$lista_id'";
        $Consulta_nome = mysqli_query($Conexao, $SQL);
        $Linha = mysqli_fetch_array($Consulta_nome);
        $turma = $Linha["turma"];
        $nome = $Linha["nome"];
        $todos .= "$nome,";
        $todos_nomes = substr($todos, 0, -1);
//
        $Cadastrar_transferir = "UPDATE alunos SET `status`= 'TRANSFERIDO', data_matricula_update= now()  WHERE `id`= '$lista_id' ";
        $Consulta_transferir = mysqli_query($Conexao, $Cadastrar_transferir);
        //
        $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turma'";
        $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
        $Linha_turma = mysqli_fetch_array($Consulta_turma);
        //
        $ano_turma = substr($Linha_turma["ano"], 0, -6);
        $nome_turma = $Linha_turma["turma"];
        $turno_turma = $Linha_turma["turno"];
        $unico_turma = $Linha_turma["unico"];
        $turma = "$nome_turma $unico_turma ($turno_turma) - $ano_turma ";
        //
        $data = date('Y-m-d');
        $solicitante = filter_input(INPUT_POST, 'usuario_logado', FILTER_DEFAULT);
        //
        $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_aluno_solicitacao` = '$lista_id' AND (`entregue` = 'N' OR `entregue` = 'P')");
        $linha = mysqli_num_rows($Consulta);
        if ($linha == "0") {
            $SQL_logar = "INSERT INTO alunos_solicitacoes (`id_aluno_solicitacao`,`id_turma`,`id_status`,`solicitante`,`data_solicitacao`,`declaracao`,`data_entregue`,`transferencia`) "
                    . "VALUES ( '$lista_id', '$turma','TRANSFERIDO','$solicitante','$data','NÃO','$data','NÃO')";
            $Consulta = mysqli_query($Conexao, $SQL_logar);
        }

        //
    }
    //Logar no sistema para gravar Log  
    if ($Consulta_transferir) {
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', 'Transferiu o(as) aluno(as) : $todos_nomes','SIM',now())";
        $Consulta_transferir2 = mysqli_query($Conexao, $SQL_logar);
    }
    //
    if ($Consulta && $Consulta_transferir2) {
        echo "
		<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http:/Escola/solicitacao_transferencia.php'>
		<script type=\"text/javascript\">
		alert(\"Operações Realizadas Com Sucesso!\");
		</script>
			";
        // header("Location: solicitacao_transferencia.php");
        //
    } else {
        header("Location: alunos.php?id=2");
    }
    //ALterar a localidade Urbano ou Rural
} elseif (isset($_POST['urbano'])) {

    $todos = "";
    foreach (($_POST['aluno_selecionado']) as $lista_id) {//
        //       
        $urbano = filter_input(INPUT_POST, 'optUrbano', FILTER_DEFAULT);
        //
        $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$lista_id'");
        $Registro_backup2 = mysqli_fetch_array($Consulta_backup2);
        $nomebackup = $Registro_backup2["nome"];
        $todos .= "$nomebackup,";
        $todos_nomes = substr($todos, 0, -1);
/////
        $SQL_matricular = "UPDATE alunos SET urbano = '$urbano', data_matricula_update = now() WHERE id= '$lista_id'";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
    }
//Logar no sistema para gravar Log    
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', ' Alterou o(as) aluno(as) $todos_nomes em: Urbano = $urbano ','SIM',now() )";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    //
    if ($Consulta && $Consulta1) {
        header("Location: alunos.php?id=1");
    } else {
        header("Location: alunos.php?id=2");
    }
    //Arquivo Passivo Cheio     //Arquivo Passivo Cheio
//  
} elseif (isset($_POST['Arquivo_Passivo_cheio'])) {
    //   
    $pasta = filter_input(INPUT_POST, 'inputPastaCheia', FILTER_DEFAULT);
    $pasta_cheia = filter_input(INPUT_POST, 'inputPastaCheiaSim', FILTER_DEFAULT);
    //
    $sql_backup = mysqli_query($Conexao, "SELECT * FROM `pastas_arquivo_passivo` WHERE `id` = '$pasta' ");
    $Registro_backup = mysqli_fetch_array($sql_backup, MYSQLI_BOTH);
    $nomebackup = $Registro_backup['pasta'];
    //       
    $SQL_matricular = "UPDATE `pastas_arquivo_passivo` SET `cheio` = '$pasta_cheia' WHERE `pastas_arquivo_passivo`.`id` = $pasta; ";
    $Consulta0 = mysqli_query($Conexao, $SQL_matricular);
    //Logar no sistema para gravar Log    
    if ($Consulta0) {
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                . "VALUES ( '$usuario_logado', ' Marcou a Pasta:$nomebackup do Arquivo Passivo como Cheia = $pasta_cheia ','SIM',now() )";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        header("location: alunos_arquivo_passivo.php?id=4");
    } else {
        header("location: alunos_arquivo_passivo.php?id=3");
    }
//
} elseif (isset($_POST['historico'])) {

    $contPost = 0;
    $ContLinha = 0;
    $todos = "";
    //
    $ano = filter_input(INPUT_POST, 'inputAno', FILTER_DEFAULT);
    $ano_pesquisa = filter_input(INPUT_POST, 'inputAno1', FILTER_DEFAULT);
    $escola = filter_input(INPUT_POST, 'inputEscola', FILTER_DEFAULT);
    $cidade = filter_input(INPUT_POST, 'inputCidade', FILTER_DEFAULT);
    $uf = filter_input(INPUT_POST, 'inputUf', FILTER_DEFAULT);
    $turma = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
    $turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
    $unica = filter_input(INPUT_POST, 'inputUnica', FILTER_DEFAULT);
    //
    foreach (($_POST['aluno_selecionado']) as $lista_id) {
        $contPost++;
    }
    //
    foreach (($_POST['aluno_selecionado']) as $lista_id) {

        if ($ano == "") {
            //
            header("Location: alunos.php?id=2");
            //
        } else {
            //
            $ConsultaTeste = mysqli_query($Conexao, "SELECT * FROM `bimestre_i` WHERE `id_bimestreI_aluno` = '$lista_id' AND `ano` = '$ano'");
            $LinhaTeste = mysqli_num_rows($ConsultaTeste);
            $ContLinha++;
            //
            if ($LinhaTeste == "0") {
                //
                $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '$lista_id'");
                $Registro_backup2 = mysqli_fetch_array($Consulta_backup2);
                $nomebackup = $Registro_backup2["nome"];
                $todos .= "$nomebackup,";
                //
                $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` ORDER BY id");
                while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
//
                    $idD = $linha['id'];
                    $SQLConsulta = "INSERT INTO `bimestre_i`(`id_bimestre_I`, `ano`, `id_bimestreI_aluno`, `id_bimestre_I_disciplina`, `nota`,`faltas`,`id_bimestre_I_status_alunos`,`escola`,`cidade`,`uf`) "
                            . "VALUES (NULL, '$ano', '$lista_id', '$idD', '','','1','$escola','$cidade','$uf')";
                    $SQLExecuta1 = mysqli_query($Conexao, $SQLConsulta);

                    $SQLConsulta = "INSERT INTO `bimestre_ii` (`id_bimestre_II`, `ano`, `id_bimestre_II_aluno`, `id_bimestre_II_disciplina`, `nota`,`faltas`,`id_bimestre_II_status_alunos`,`escola`,`cidade`,`uf`) "
                            . "VALUES (NULL, '$ano', '$lista_id', '$idD', '','','1','$escola','$cidade','$uf')";
                    $SQLExecuta = mysqli_query($Conexao, $SQLConsulta);
//
                    $SQLConsulta = "INSERT INTO `bimestre_iii` (`id_bimestre_III`, `ano`, `id_bimestre_III_aluno`, `id_bimestre_III_disciplina`, `nota`,`faltas`,`id_bimestre_III_status_alunos`,`escola`,`cidade`,`uf`) "
                            . "VALUES (NULL, '$ano', '$lista_id', '$idD', '','','1','$escola','$cidade','$uf')";
                    $SQLExecuta = mysqli_query($Conexao, $SQLConsulta);
//
                    $SQLConsulta = "INSERT INTO `bimestre_iv` (`id_bimestre_IV`, `ano`, `id_bimestre_IV_aluno`, `id_bimestre_IV_disciplina`, `nota`,`faltas`,`id_bimestre_IV_status_alunos`,`escola`,`cidade`,`uf`) "
                            . "VALUES (NULL, '$ano', '$lista_id', '$idD', '','','1','$escola','$cidade','$uf')";
                    $SQLExecuta = mysqli_query($Conexao, $SQLConsulta);
//
                    $SQLConsulta = "INSERT INTO `bimestre_media` (`id_bimestre_media`, `ano`, `id_bimestre_media_aluno`, `id_bimestre_media_disciplina`, `nota`,`faltas`,`escola`,`aluno`,`aluno_dias`,`frequencia`,`status_bimestre_media`,`escola_media`,`cidade_media`,`uf`,`bimestre_turma`,`bimestre_turno`,`bimestre_unico`) "
                            . "VALUES (NULL, '$ano', '$lista_id', '$idD', '','','','','','','1','$escola','$cidade','$uf','$turma','$turno','$unica')";
                    $SQLExecuta = mysqli_query($Conexao, $SQLConsulta);
//
                    $SQLConsulta = "INSERT INTO `recuperacao_final` (`id_recuperacao_final`, `ano`, `id_recuperacao_final_aluno`, `id_recuperacao_final_disciplina`, `nota`,`media`,`id_recuperacao_final_status_alunos`,`escola`,`cidade`,`uf`) "
                            . "VALUES (NULL, '$ano', '$lista_id', '$idD','','','1','$escola','$cidade','$uf')";
                    $SQLExecuta_final = mysqli_query($Conexao, $SQLConsulta);
                    //
                }
            } else {
                //
                if ($ContLinha == "$contPost") {
                    header("Location: alunos.php?id=2");
                }
                //
            }
        }
    }
    $todos_nomes = substr($todos, 0, -1);
    if ($SQLExecuta_final == "1") {
        //Logar no sistema
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
                . "VALUES ( '$usuario_logado', 'Montou o Histórico aluno(a) $todos_nomes para o ano de $ano" . " ' , 'SIM',now())";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        //
        header("Location: alunos.php?id=1");
        //
    }
}





