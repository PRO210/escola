<?php

ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores do furmulário de matrícula (Método POST)
$nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
$nascimento = filter_input(INPUT_POST, 'inputNascimento', FILTER_DEFAULT);
$fone = filter_input(INPUT_POST, 'inputFone', FILTER_DEFAULT);
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
$pai = filter_input(INPUT_POST, 'inputPai', FILTER_DEFAULT);
$profissao_pai = filter_input(INPUT_POST, 'inputProfissaoPai', FILTER_DEFAULT);
$mae = filter_input(INPUT_POST, 'inputMae', FILTER_DEFAULT);
$profissao_mae = filter_input(INPUT_POST, 'inputProfissaoMae', FILTER_DEFAULT);
$endereco = filter_input(INPUT_POST, 'inputEndereco', FILTER_DEFAULT);
$cidade = filter_input(INPUT_POST, 'inputCidade', FILTER_DEFAULT);
$estado_cidade = filter_input(INPUT_POST, 'inputEstado_Cidade', FILTER_DEFAULT);
$pasta = filter_input(INPUT_POST, 'inputPasta', FILTER_DEFAULT);
//$nascimento = substr($nascimento, 6, 4) . '-' . substr($nascimento, 3, 2) . '-' . substr($nascimento, 0, 2);
//Cadastra no banco de dados e evita a duplicidade
$Consulta_backup = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE nome = '$nome'  ");

if (mysqli_num_rows($Consulta_backup) > 0) {
    header("LOCATION: cadastrar_no_arquivo_passivo.php?id=2");
} else {
    $SQL_matricular = "INSERT INTO alunos (`nome`,`data_nascimento`,`modelo_certidao`,`matricula_certidao`, `tipos_de_certidao`,`certidao_civil`, `data_expedicao`, `naturalidade`,`estado`,`nacionalidade`, `sexo`, `nis`, `bolsa_familia`,`sus`, `pai`, `profissao_pai`, `mae`, `profissao_mae`, `endereco`, `cidade`, `estado_cidade` , `fone`, `excluido`, `ap_pasta`) "
            . "VALUES ('$nome', '$nascimento', '$modelo_certidao', '$matricula', '$tipos_de_certidao','$certidao', '$expedicao', '$naturalidade','$estado','$nacionalidade', '$sexo', '$nis','$bolsa_familia', '$sus', '$pai', '$profissao_pai', '$mae', '$profissao_mae', '$endereco', '$cidade', '$estado_cidade' , '$fone', 'S' , '$pasta')";
    $Consulta = mysqli_query($Conexao, $SQL_matricular);
    //Logar no sistema
    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
            . "VALUES ( '$usuario_logado', 'Moveu o aluno $nome para a pasta $pasta do Arquivo Passivo' , 'SIM' , now())";
    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
    header("LOCATION: alunos_arquivo_passivo.php?id=1");
}