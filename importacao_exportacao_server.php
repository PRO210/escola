<?php

ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$botao = filter_input(INPUT_POST, 'botao', FILTER_DEFAULT);
if ($botao == "alunos_up") {
    //
    $arquivo = $_FILES["arquivo_alunos"]["tmp_name"];
    $nome = $_FILES["arquivo_alunos"]["name"];
    $ext = explode(".", $nome);
    $extensao = end($ext);
    //
    if ($extensao != "csv") {
        echo 'erro';
        header("Location:importacao_exportacao.php?id=2");
        exit();
    } else {
        $objeto = fopen($arquivo, 'r');
        while (($dados = fgetcsv($objeto, 1000)) !== FALSE) {
            $inep = ($dados[0]);
            $turma = ($dados[1]);
            $turma_extra = ($dados[2]);
            $turma_status_extra = ($dados[3]);
            $nome = ($dados[4]);
            $data_nascimento = ($dados[5]);
            $modelo_certidao = ($dados[6]);
            $matricula_certidao = ($dados[7]);
            $tipos_de_certidao = ($dados[8]);
            $certidao_civil = ($dados[9]);
            $data_expedicao = ($dados[10]);
            $naturalidade = ($dados[11]);
            $estado = ($dados[12]);
            $nacionalidade = ($dados[13]);
            $sexo = ($dados[14]);
            $cor = ($dados[15]);
            $nis = ($dados[16]);
            $bolsa_familia = ($dados[17]);
            $sus = ($dados[18]);
            $pai = ($dados[19]);
            $profissao_pai = ($dados[20]);
            $mae = ($dados[21]);
            $profissao_mae = ($dados[22]);
            $endereco = ($dados[23]);
            $cidade = ($dados[24]);
            $escola_cidade = ($dados[25]);
            $transporte = ($dados[26]);
            $urbano = ($dados[27]);
            $ponto_onibus = ($dados[28]);
            $motorista = ($dados[29]);
            $motorista2 = ($dados[30]);
            $data_matricula = ($dados[31]);
            $data_renovacao_matricula = ($dados[32]);
            $data_matricula_update = ($dados[33]);
            $teste_declaracao = ($dados[34]);
            $teste_data_declaracao = ($dados[35]);
            $teste_responsavel_declaracao = ($dados[36]);
            $teste_transferencia = ($dados[37]);
            $teste_data_transferencia = ($dados[38]);
            $teste_responsavel_transferencia = ($dados[39]);
            $data_censo = ($dados[40]);
            $data_valida_matricula = ($dados[41]);
            $status = ($dados[42]);
            $status_ext = ($dados[43]);
            $excluido = ($dados[44]);
            $ap_pasta = ($dados[45]);
            $fone = ($dados[46]);
            $fone2 = ($dados[47]);
            $obs = ($dados[48]);
            $necessidades = ($dados[49]);
            //
            $nomeBackup = "$nome";
            $todos .= "$nomeBackup,";
            $todos_nomes = substr($todos, 0, -1);
            //
            $sql = "INSERT INTO alunos (`inep`, `turma`,`turma_extra_aluno`,`status_extra_aluno`,`nome`,`data_nascimento`,`modelo_certidao`,`matricula_certidao`, `tipos_de_certidao` , `certidao_civil` , `data_expedicao` , `naturalidade` , `estado` , `nacionalidade`,`sexo`,`cor_raca`,`nis`,`bolsa_familia`,`sus`,`pai`,`profissao_pai`,`mae`,`profissao_mae`,`endereco`,`cidade`,`estado_cidade`,`transporte`,`urbano`,`ponto_onibus`,`motorista`,`motorista2`,`Data_matricula`,`data_renovacao_matricula`,`data_matricula_update`,`declaracao`,`data_declaracao`,`responsavel_declaracao`,`transferencia`,`data_transferencia`,`responsavel_transferencia`,`data_censo`,`data_valida_matricula`,`status`,`status_ext`,`excluido`,`ap_pasta`,`fone`,`fone2`, `obs`,`necessidades` )"
                    . "VALUES ( '$inep','$turma','$turma_extra','$turma_status_extra','$nome','$data_nascimento','$modelo_certidao','$matricula_certidao' , '$tipos_de_certidao', '$certidao_civil' , '$data_expedicao','$naturalidade' , '$estado' , '$nacionalidade','$sexo','$cor','$nis','$bolsa_familia','$sus','$pai','$profissao_pai','$mae','$profissao_mae','$endereco','$cidade','$escola_cidade','$transporte','$urbano','$ponto_onibus','$motorista','$motorista2','$data_matricula','$data_renovacao_matricula','$data_matricula_update','$teste_declaracao','$teste_data_declaracao','$teste_responsavel_declaracao','$teste_transferencia','$teste_data_transferencia','$teste_responsavel_transferencia','$data_censo','$data_valida_matricula','$status','$status_ext','$excluido','$ap_pasta','$fone','$fone2','$obs','$necessidades' )";
            $Consulta = mysqli_query($Conexao, $sql);
        }
        if ($Consulta) {
            //Logar no sistema para gravar Log
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Matriculou o(s) Aluno(a)(s) Em Bloco Via Arquivo csv : $todos_nomes', now())";
            $Consulta1 = mysqli_query($Conexao, $SQL_logar);
            //
            $Consulta2 = mysqli_query($Conexao, " DELETE FROM `alunos` WHERE `inep` = 'inep'");
            header("Location:importacao_exportacao.php?id=1");
        } else {
            header("Location:importacao_exportacao.php?id=3");
        }
    }
} elseif ($botao == "banco_up") {
    $arquivo = $_FILES["arquivo_banco"]["tmp_name"];
    $nome = $_FILES["arquivo_banco"]["name"];
    $ext = explode(".", $nome);
    $extensao = end($ext);
    $dados = file_get_contents($arquivo);
    //
    if ($extensao != "sql") {
        echo 'erro';
        header("Location:importacao_exportacao.php?id=32");
        exit();
    } else {
        //Executar as query do backup
        $Consulta = mysqli_multi_query($Conexao, $dados);

        if ($Consulta) {
            do {
                
            } while (mysqli_next_result($Conexao));
        }



        if ($Consulta) {
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Atualizou Toda a Base de Dados', now())";
            $Consulta2 = mysqli_query($Conexao, $SQL_logar);
            //
            mysqli_close($Conexao);
            header("Location:importacao_exportacao.php?id=31");
        } else {
            header("Location:importacao_exportacao.php?id=3");
        }
    }
}
 
