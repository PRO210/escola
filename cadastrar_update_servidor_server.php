<?php

include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores de cadastrar_update_servidor (Método POST)
$id = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);
$idUpdate = base64_decode($id);
$matricula = filter_input(INPUT_POST, 'inputMatricula', FILTER_DEFAULT);
$vinculo = filter_input(INPUT_POST, 'inputVinculo', FILTER_DEFAULT);
$funcao = filter_input(INPUT_POST, 'inputFuncao', FILTER_DEFAULT);
$resumo_funcao = filter_input(INPUT_POST, 'inputResumoFuncao', FILTER_DEFAULT);
$resumo_funcao2 = filter_input(INPUT_POST, 'inputResumoFuncao2', FILTER_DEFAULT);
$resumo_turmas = filter_input(INPUT_POST, 'inputResumoTurmas', FILTER_DEFAULT);
$resumo_turmas2 = filter_input(INPUT_POST, 'inputResumoTurma2', FILTER_DEFAULT);
$resumo_turmas_sim = filter_input(INPUT_POST, 'inputResumoSim', FILTER_DEFAULT);
$resumo_disciplinas = filter_input(INPUT_POST, 'inputResumoDisciplinas', FILTER_DEFAULT);
$resumo_anos = filter_input(INPUT_POST, 'inputResumoAnos', FILTER_DEFAULT);
$resumo_anos2 = filter_input(INPUT_POST, 'inputResumoAnos2', FILTER_DEFAULT);
$substituta = filter_input(INPUT_POST, 'substituta', FILTER_DEFAULT);

$carga_horaria = filter_input(INPUT_POST, 'inputCarga_Horaria', FILTER_DEFAULT);
$turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);

$projeto = filter_input(INPUT_POST, 'projeto', FILTER_DEFAULT);
$projeto_nome = filter_input(INPUT_POST, 'projeto_nome', FILTER_DEFAULT);

$nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$nascimento = filter_input(INPUT_POST, 'inputNascimento', FILTER_DEFAULT);
$data_nascimento = substr($nascimento, 6, 4) . '-' . substr($nascimento, 3, 2) . '-' . substr($nascimento, 0, 2);
//
$certidao = filter_input(INPUT_POST, 'certidao', FILTER_DEFAULT);
$certidao_dados_gerais = filter_input(INPUT_POST, 'certidao_dados_gerais', FILTER_DEFAULT);
$certidao_data = filter_input(INPUT_POST, 'certidao_data', FILTER_DEFAULT);
$modelo_certidao = filter_input(INPUT_POST, 'inputModelo_Certidao', FILTER_DEFAULT);
$matricula_certidao = filter_input(INPUT_POST, 'inputMatricula_Certidao', FILTER_DEFAULT);
//
$tipos_de_certidao = filter_input(INPUT_POST, 'inputTiposCertidao', FILTER_DEFAULT);
$dados_certidao = filter_input(INPUT_POST, 'inputCertidao', FILTER_DEFAULT);
$estado_expedidor = filter_input(INPUT_POST, 'inputExpdd', FILTER_DEFAULT);
$orgao_expedidor = filter_input(INPUT_POST, 'inputOxp', FILTER_DEFAULT);
$expedicao = filter_input(INPUT_POST, 'inputExpedicao', FILTER_DEFAULT);
$data_expedicao = substr($expedicao, 6, 4) . '-' . substr($expedicao, 3, 2) . '-' . substr($expedicao, 0, 2);
$mae = filter_input(INPUT_POST, 'inputMae', FILTER_DEFAULT);
$pai = filter_input(INPUT_POST, 'inputPai', FILTER_DEFAULT);
$cpf = filter_input(INPUT_POST, 'inputCpf', FILTER_DEFAULT);
$fone = filter_input(INPUT_POST, 'inputFone', FILTER_DEFAULT);
$celular = filter_input(INPUT_POST, 'inputCel', FILTER_DEFAULT);
$email = filter_input(INPUT_POST, 'inputEmail', FILTER_DEFAULT);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_DEFAULT);
$numero = filter_input(INPUT_POST, 'numero', FILTER_DEFAULT);
$cep = filter_input(INPUT_POST, 'cep', FILTER_DEFAULT);
$municipio = filter_input(INPUT_POST, 'municipio', FILTER_DEFAULT);
$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_DEFAULT);
$naturalidade = filter_input(INPUT_POST, 'naturalidade', FILTER_DEFAULT);
$estado_naturalidade = filter_input(INPUT_POST, 'estado_naturalidade', FILTER_DEFAULT);
$nacionalidade = filter_input(INPUT_POST, 'nacionalidade', FILTER_DEFAULT);
$sexo = filter_input(INPUT_POST, 'sexo', FILTER_DEFAULT);
$cor = filter_input(INPUT_POST, 'cor', FILTER_DEFAULT);
$deficiente = filter_input(INPUT_POST, 'deficiente', FILTER_DEFAULT);
$tipo_deficiencia = filter_input(INPUT_POST, 'tipo_deficiencia', FILTER_DEFAULT);
$estado_civil = filter_input(INPUT_POST, 'estado_civil', FILTER_DEFAULT);
$conjuge = filter_input(INPUT_POST, 'conjuge', FILTER_DEFAULT);
$conjuge_cpf = filter_input(INPUT_POST, 'conjuge_cpf', FILTER_DEFAULT);
$tipo_sangue = filter_input(INPUT_POST, 'tipo_sangue', FILTER_DEFAULT);
$grau_intrucao = filter_input(INPUT_POST, 'grau_intrucao', FILTER_DEFAULT);
$grau_intrucao_completo = filter_input(INPUT_POST, 'grau_intrucao_completo', FILTER_DEFAULT);
$formado_em = filter_input(INPUT_POST, 'formado_em', FILTER_DEFAULT);
//
$pos_graduacao = filter_input(INPUT_POST, 'pos_graduacao', FILTER_DEFAULT);
$pos_graduacao_completo = filter_input(INPUT_POST, 'pos_graduacao_completo', FILTER_DEFAULT);
$pos_graduacao_onde = filter_input(INPUT_POST, 'pos_graduacao_onde', FILTER_DEFAULT);
//
$registro_classe = filter_input(INPUT_POST, 'registro_classe', FILTER_DEFAULT);
$registro_numero = filter_input(INPUT_POST, 'registro_numero', FILTER_DEFAULT);
$registro_data = filter_input(INPUT_POST, 'registro_data', FILTER_DEFAULT);
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
$zona = filter_input(INPUT_POST, 'zona', FILTER_DEFAULT);
$secao = filter_input(INPUT_POST, 'secao', FILTER_DEFAULT);
$titulo_municipio = filter_input(INPUT_POST, 'titulo_municipio', FILTER_DEFAULT);
$titulo_uf = filter_input(INPUT_POST, 'titulo_uf', FILTER_DEFAULT);
$pis = filter_input(INPUT_POST, 'pis', FILTER_DEFAULT);
$banco = filter_input(INPUT_POST, 'banco', FILTER_DEFAULT);
$agencia = filter_input(INPUT_POST, 'agencia', FILTER_DEFAULT);
$conta = filter_input(INPUT_POST, 'conta', FILTER_DEFAULT);
//
$dependente = filter_input(INPUT_POST, 'dependente', FILTER_DEFAULT);
//
$depen_nome_1 = filter_input(INPUT_POST, 'depen_nome_1', FILTER_DEFAULT);
$depen_sexo_1 = filter_input(INPUT_POST, 'depen_sexo_1', FILTER_DEFAULT);
$depen_cpf_1 = filter_input(INPUT_POST, 'depen_cpf_1', FILTER_DEFAULT);
$depen_data_1 = filter_input(INPUT_POST, 'depen_data_1', FILTER_DEFAULT);
$depen_grau_1 = filter_input(INPUT_POST, 'depen_grau_1', FILTER_DEFAULT);
//

$depen_nome_2 = filter_input(INPUT_POST, 'depen_nome_2', FILTER_DEFAULT);
$depen_sexo_2 = filter_input(INPUT_POST, 'depen_sexo_2', FILTER_DEFAULT);
$depen_cpf_2 = filter_input(INPUT_POST, 'depen_cpf_2', FILTER_DEFAULT);
$depen_data_2 = filter_input(INPUT_POST, 'depen_data_2', FILTER_DEFAULT);
$depen_grau_2 = filter_input(INPUT_POST, 'depen_grau_2', FILTER_DEFAULT);
//
$depen_nome_3 = filter_input(INPUT_POST, 'depen_nome_3', FILTER_DEFAULT);
$depen_sexo_3 = filter_input(INPUT_POST, 'depen_sexo_3', FILTER_DEFAULT);
$depen_cpf_3 = filter_input(INPUT_POST, 'depen_cpf_3', FILTER_DEFAULT);
$depen_data_3 = filter_input(INPUT_POST, 'depen_data_3', FILTER_DEFAULT);
$depen_grau_3 = filter_input(INPUT_POST, 'depen_grau_3', FILTER_DEFAULT);
//
$admissao = filter_input(INPUT_POST, 'admissao', FILTER_DEFAULT);
$comissionado = filter_input(INPUT_POST, 'comissionado', FILTER_DEFAULT);
$unidade_escolar = filter_input(INPUT_POST, 'unidade_escolar', FILTER_DEFAULT);
$lotacao = filter_input(INPUT_POST, 'lotacao', FILTER_DEFAULT);


//Arquivos capturados para o LOG
$Consuta3 = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE id = '$idUpdate' ");
$row = mysqli_fetch_array($Consuta3);
$nome3 = $row['nome'];
/////////////////////
$Consuta_backup = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE id = '$idUpdate' ");
$row_backup = mysqli_fetch_array($Consuta_backup);

$SQL_matricular = "UPDATE servidores SET  matricula = '$matricula', vinculo = '$vinculo', funcao = '$funcao', resumo_funcao = '$resumo_funcao' , resumo_funcao_2 = '$resumo_funcao2', resumo_turmas = '$resumo_turmas' , resumo_turmas_2 = '$resumo_turmas2' ,carga_horaria = '$carga_horaria' ,turno = '$turno', nome = '$nome', nascimento = '$data_nascimento',modelo_certidao = '$modelo_certidao' , matricula_certidao = '$matricula_certidao' ,tipos_de_certidao = '$tipos_de_certidao', dados_certidao = '$dados_certidao', data_expedicao = '$data_expedicao', "
        . "resumo_anos = '$resumo_anos',resumo_anos_2 = '$resumo_anos2' ,resumo_disciplinas = '$resumo_disciplinas',resumo_turmas_sim = '$resumo_turmas_sim', mae = '$mae' , pai = '$pai', cpf = '$cpf', fone = '$fone', celular = '$celular', email = '$email', orgao_expedidor = '$orgao_expedidor', estado_expedidor = '$estado_expedidor', endereco = '$endereco', cep = '$cep', numero = '$numero', municipio = '$municipio', estado = '$estado', bairro = '$bairro', naturalidade = '$naturalidade', estado_naturalidade = '$estado_naturalidade',"
        . "nacionalidade = '$nacionalidade' , sexo = '$sexo',cor = '$cor' ,deficiente = '$deficiente',tipo_deficiencia = '$tipo_deficiencia', estado_civil = '$estado_civil' ,conjuge = '$conjuge' ,conjuge_cpf = '$conjuge_cpf' , tipo_sangue = '$tipo_sangue' , grau_intrucao = '$grau_intrucao' , grau_intrucao_completo = '$grau_intrucao_completo' , registro_classe = '$registro_classe' , registro_numero = '$registro_numero' , registro_data = '$registro_data' , pis = '$pis' , titulo = '$titulo' , zona = '$zona' , secao = '$secao' , titulo_municipio = '$titulo_municipio' ,"
        . "titulo_uf = '$titulo_uf' , banco = '$banco' , agencia = '$agencia' ,conta = '$conta' ,depen_nome_1 = '$depen_nome_1' ,depen_sexo_1 = '$depen_sexo_1' ,depen_cpf_1 = '$depen_cpf_1' ,depen_data_1 = '$depen_data_1' ,depen_grau_1 = '$depen_grau_1' , depen_nome_2 = '$depen_nome_2' ,depen_sexo_2 = '$depen_sexo_2' ,depen_cpf_2 = '$depen_cpf_2' ,depen_data_2 = '$depen_data_2' ,depen_grau_2 = '$depen_grau_2' , depen_nome_3 = '$depen_nome_3' ,depen_sexo_3 = '$depen_sexo_3' ,depen_cpf_3 = '$depen_cpf_3' ,depen_data_3 = '$depen_data_3' ,depen_grau_3 = '$depen_grau_3' ,"
        . "admissao = '$admissao' , comissionado = '$comissionado', lotacao = '$lotacao', unidade_escolar = '$unidade_escolar', certidao = '$certidao', certidao_dados_gerais = '$certidao_dados_gerais', certidao_data = '$certidao_data', substituta = '$substituta',projeto = '$projeto' ,projeto_nome = '$projeto_nome' ,formado_em = '$formado_em', pos_graduacao = '$pos_graduacao', pos_graduacao_completo = '$pos_graduacao_completo', pos_graduacao_onde = '$pos_graduacao_onde', dependente  = '$dependente',data_matricula_update = now() WHERE id= '$idUpdate' ";

$Consulta = mysqli_query($Conexao, $SQL_matricular);

if ($Consulta) {
    $Consulta_final = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE id = '$idUpdate' ");
    $row_final = mysqli_fetch_array($Consulta_final);
    $result = array_diff_assoc($row_final, $row_backup);
    $campo = "";

    foreach ($result as $nome_campo => $valor) {
        //echo "$nome_campo = $valor<br>";
        if (!is_numeric($nome_campo)) {
            // echo "$nome_campo = $valor<br>";
            $campo .= "$nome_campo = $valor / ";
            //echo "$campo";
        }
    }
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
            . "VALUES ( '$usuario_logado', 'Alterou os campos do servidor(a) $nome3 em: $campo', 'SIM', now())";
    $Consulta2 = mysqli_query($Conexao, $SQL_logar);
    //echo "$SQL_logar";

    header("Location: servidores.php?id=1");
} else {
    header("Location: servidores.php?id=2");
}
