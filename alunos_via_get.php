<?php

$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
//echo base64_Decode($Recebe_id);
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id= '" . base64_Decode($Recebe_id) . "'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
//
$inep = $Registro["inep"];
$turma = $Registro["turma"];
$ouvinte = $Registro["status_ext"];
$nome = $Registro["nome"];
$data_nascimento = new DateTime($Registro["data_nascimento"]);
$data_nascimento = date_format($data_nascimento, 'Y-m-d');
$fone = $Registro["fone"];
$fone2 = $Registro["fone2"];
$modelo_certidao = $Registro["modelo_certidao"];
$matricula = $Registro["matricula_certidao"];
$tipos_de_certidao = $Registro["tipos_de_certidao"];
$certidao = $Registro["certidao_civil"];
$expedicao = $Registro["data_expedicao"];
$naturalidade = $Registro["naturalidade"];
$estado = $Registro["estado"];
$nacionalidade = $Registro["nacionalidade"];
$sexo = $Registro["sexo"];
$nis = $Registro["nis"];
$bolsa_familia = $Registro["bolsa_familia"];
$sus = $Registro["sus"];
$necessidades = $Registro["necessidades"];
$pai = $Registro["pai"];
$profissao_pai = $Registro["profissao_pai"];
$mae = $Registro["mae"];
$profissao_mae = $Registro["profissao_mae"];
$endereco = $Registro["endereco"];
$cidade = $Registro["cidade"];
$estado_cidade = $Registro["estado_cidade"];
$transporte = $Registro["transporte"];
$ponto_onibus = $Registro["ponto_onibus"];
$urbano = $Registro["urbano"];
$cor = $Registro["cor_raca"];
$motorista = $Registro["motorista"];
$motorista2 = $Registro["motorista2"];
$declaracao = $Registro["declaracao"];
$data_declaracao = ($Registro["data_declaracao"]);
$data_declaracao_convertida = "";

if ($data_declaracao == "0000-00-00") {
    $data_declaracao_convertida = "- - - - - - - - ";
} else {
    $data_declaracao = new DateTime($Registro["data_declaracao"]);
    $data_declaracao_convertida = date_format($data_declaracao, 'd/m/Y');
}
$transferencia = $Registro["transferencia"];
$data_transferencia = new DateTime($Registro["data_transferencia"]);
$responsavel_declacao = $Registro["responsavel_declaracao"];
$responsavel_transferencia = $Registro["responsavel_transferencia"];
$inputTextArea = $Registro["obs"];
$inputMatricula = new DateTime($Registro["Data_matricula"]);
$data_renovacao_matricula = $Registro["data_renovacao_matricula"];
$status = $Registro["status"];
$excluido = $Registro["excluido"];