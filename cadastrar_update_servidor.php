<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//<!Recebe o id de numero_de_servidors>
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
//echo base64_Decode($Recebe_id);
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM servidores WHERE id= '" . base64_Decode($Recebe_id) . "'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
//
$matricula = $Registro['matricula'];
$vinculo = $Registro['vinculo'];
$funcao = $Registro['funcao'];
$resumo_funcao = $Registro['resumo_funcao'];
$resumo_funcao2 = $Registro['resumo_funcao_2'];
$resumo_turmas_sim = $Registro['resumo_turmas_sim'];
$resumo_turmas = $Registro['resumo_turmas'];
$resumo_turmas2 = $Registro['resumo_turmas_2'];
$resumo_disciplinas = $Registro['resumo_disciplinas'];
$resumo_anos = $Registro['resumo_anos'];
$resumo_anos2 = $Registro['resumo_anos_2'];
$substituta = $Registro['substituta'];
$carga_horaria = $Registro['carga_horaria'];
$turno = $Registro["turno"];
$projeto = $Registro["projeto"];
$projeto_nome = $Registro["projeto_nome"];
$nome = $Registro["nome"];
$nascimento = new DateTime($Registro["nascimento"]);
$data_nascimento_convertida = date_format($nascimento, 'd/m/Y');
$pai = $Registro["pai"];
$mae = $Registro["mae"];
$cpf = $Registro["cpf"];
$certidao = $Registro["certidao"];
$certidao_dados_gerais = $Registro["certidao_dados_gerais"];
$certidao_data = $Registro["certidao_data"];
$certidao_estado = $Registro["certidao_estado"];
$modelo_certidao = $Registro["modelo_certidao"];
$matricula_certidao = $Registro["matricula_certidao"];
$tipos_de_certidao = $Registro["tipos_de_certidao"];
$dados_certidao = $Registro["dados_certidao"];
$orgao_expedidor = $Registro["orgao_expedidor"];
$estado_expedidor = $Registro["estado_expedidor"];
$data_expedicao = new DateTime($Registro["data_expedicao"]);
$data_expedicao_convertida = date_format($data_expedicao, 'd/m/Y');
$fone = $Registro["fone"];
$celular = $Registro["celular"];
$email = $Registro["email"];
$endereco = $Registro["endereco"];
$numero = $Registro["numero"];
$cep = $Registro["cep"];
$municipio = $Registro["municipio"];
$estado = $Registro["estado"];
$bairro = $Registro["bairro"];
$naturalidade = $Registro["naturalidade"];
$estado_naturalidade = $Registro["estado_naturalidade"];
$nacionalidade = $Registro["nacionalidade"];
$sexo = $Registro["sexo"];
$cor = $Registro["cor"];
$deficiente = $Registro["deficiente"];
$tipo_deficiencia = $Registro["tipo_deficiencia"];
$estado_civil = $Registro["estado_civil"];
$conjuge = $Registro["conjuge"];
$conjuge_cpf = $Registro["conjuge_cpf"];
$tipo_sangue = $Registro["tipo_sangue"];
//
$grau_intrucao = $Registro["grau_intrucao"];
$grau_intrucao_completo = $Registro["grau_intrucao_completo"];
$formado_em = $Registro["formado_em"];
//
$pos_graduacao = $Registro['pos_graduacao'];
$pos_graduacao_completo = $Registro["pos_graduacao_completo"];
$pos_graduacao_onde = $Registro["pos_graduacao_onde"];
//
$registro_classe = $Registro["registro_classe"];
$registro_numero = $Registro["registro_numero"];
$registro_data = $Registro["registro_data"];
//
$pis = $Registro["pis"];
//
$titulo = $Registro["titulo"];
$zona = $Registro["zona"];
$secao = $Registro["secao"];
$titulo_municipio = $Registro["titulo_municipio"];
$titulo_uf = $Registro["titulo_uf"];
//
$banco = $Registro["banco"];
$agencia = $Registro["agencia"];
$conta = $Registro["conta"];
//
$dependente = $Registro["dependente"];
//
$depen_nome_1 = $Registro["depen_nome_1"];
$depen_sexo_1 = $Registro["depen_sexo_1"];
$depen_cpf_1 = $Registro["depen_cpf_1"];
$depen_grau_1 = $Registro["depen_grau_1"];
$depen_data_1 = $Registro["depen_data_1"];
//
$depen_nome_2 = $Registro["depen_nome_2"];
$depen_sexo_2 = $Registro["depen_sexo_2"];
$depen_cpf_2 = $Registro["depen_cpf_2"];
$depen_grau_2 = $Registro["depen_grau_2"];
$depen_data_2 = $Registro["depen_data_2"];
//
$depen_nome_3 = $Registro["depen_nome_3"];
$depen_cpf_3 = $Registro["depen_cpf_3"];
$depen_grau_3 = $Registro["depen_grau_3"];
$depen_data_3 = $Registro["depen_data_3"];
$depen_sexo_3 = $Registro["depen_sexo_3"];
$comissionado = $Registro["comissionado"];
$admissao = $Registro["admissao"];
$unidade_escolar = $Registro["unidade_escolar"];
$lotacao = $Registro["lotacao"];
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>        
        <link href="css/cadastrar.css" rel="stylesheet" type="text/css"/>
        <title>Cadastros de Servidores</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <div class="container-fluid">
            <div class="row">
                <script src="js/bootstrap.js" type="text/javascript"></script>
                <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>                   
                <script src="js/cadastrar_validar.js" type="text/javascript"></script>        
                <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
                <h3>Cadastro de Atualizações dos Servidores</h3>
                <form name="cadastrar_servidores" action="cadastrar_update_servidor_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputTurno" class="col-sm-2 control-label" >Turno</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputTurno" id="inputTurno">
                                    <?php
                                    $Consulta_turno = mysqli_query($Conexao, "SELECT * FROM `turnos`");
                                    echo "<option>------</option>";
                                    while ($Registro_turno = mysqli_fetch_array($Consulta_turno, MYSQLI_BOTH)) {
                                        $turno_linha_turno = $Registro_turno['turno'];
                                        $turma_em_branco = "-------";
                                        if ($turno == $turno_linha_turno) {
                                            echo "<option selected>$turno_linha_turno</option>";
                                        } elseif ($turno == $turma_em_branco) {
                                            echo "<option selected>$turma_em_branco</option>";
                                        } else {
                                            echo "<option>$turno_linha_turno</option>";
                                        }
                                    }
                                    ?> 
                                </select>
                            </div>                                   
                            <label for="inputMatricula" class="col-sm-2 control-label">Matricula do Servidor</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $matricula; ?>" class="form-control" id="inputMatricula" name="inputMatricula" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputFuncao" class="col-sm-2 control-label">Função</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputFuncao" id="inputFuncao">
                                    <?php
                                    $Consulta_funcao = mysqli_query($Conexao, "SELECT * FROM `funcoes`");
                                    while ($Registro_funcao = mysqli_fetch_array($Consulta_funcao, MYSQLI_BOTH)) {
                                        $funcao_funcao = $Registro_funcao["funcao"];
                                        if ($funcao == $funcao_funcao) {
                                            echo "<option selected>$funcao_funcao</option>";
                                        } else {
                                            echo "<option>$funcao_funcao</option>";
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>                                 
                            <label for="inputVinculo" class="col-sm-2 control-label">Vínculo</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputVinculo" id="inputVinculo">
                                    <?php
                                    $Consulta_vinculo = mysqli_query($Conexao, "SELECT * FROM `vinculos`");
                                    while ($Registro_vinculo = mysqli_fetch_array($Consulta_vinculo, MYSQLI_BOTH)) {
                                        $linha_vinculo = $Registro_vinculo["vinculo"];
                                        if ($vinculo == $linha_vinculo) {
                                            echo "<option selected>$linha_vinculo</option>";
                                        } else {
                                            echo "<option>$linha_vinculo</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>     
                    </div>    
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Cargo Comissionado</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="comissionado" id="">
                                    <?php
                                    if ($comissionado == "SIM") {
                                        echo "<option selected = '' value = 'SIM'>SIM</option>";
                                        echo "<option>NAO</option>";
                                    } else {
                                        echo "<option selected = '' value = ''>NAO</option>";
                                        echo "<option>SIM</option>";
                                    }
                                    ?>  
                                </select>
                            </div>                                 
                            <label for="" class="col-sm-2 control-label">Data Admissão</label>
                            <div class="col-sm-4">
                                <input type="date" name="admissao" class="form-control" value="<?php echo "$admissao"; ?>">                                
                            </div>
                        </div>     
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Resumo da Função</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="1º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoFuncao" maxlength="11" value="<?php echo "$resumo_funcao" ?>">
                            </div>  
                            <div class="col-sm-2">
                                <input type="text" placeholder="2º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoFuncao2" maxlength="11" value="<?php echo "$resumo_funcao2" ?>">
                            </div>
                            <label for="" class="col-sm-2 control-label">Carga Horária</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="" class="form-control" id="" name="inputCarga_Horaria" value = "<?php echo "$carga_horaria" ?>" onkeyup="maiuscula(this)">
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2  control-label">Mais de Uma Turma</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputResumoSim" id="inputResumoSim">
                                    <?php
                                    $txt_turma = "SIM";
                                    $txt_turma2 = "NÃO";

                                    if ($resumo_turmas_sim == $txt_turma) {
                                        echo "<option selected = '' value = 'SIM'> $txt_turma </option>";
                                        echo "<option> $txt_turma2 </option>";
                                    } else {
                                        echo "<option selected>$txt_turma2</option>";
                                        echo "<option value = 'SIM'>$txt_turma</option>";
                                    }
                                    ?>
                                </select>
                            </div> 
                            <label for="" class="col-sm-2  control-label">Substituta</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="substituta" id="substituta">
                                    <?php
                                    if ($substituta == "SIM") {
                                        echo "<option selected = '' value = 'SIM'>SIM</option>";
                                        echo "<option value = 'NAO'>NAO</option>";
                                    } else {
                                        echo "<option selected value = 'NAO'>NAO</option>";
                                        echo "<option value = 'SIM'>SIM</option>";
                                    }
                                    ?>
                                </select>
                            </div> 
                            <div class="resumo">
                                <label for="" class="col-sm-2 control-label">Resumo das Anos</label>
                                <div class="col-sm-2">
                                    <input type="text" placeholder="1º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoAnos" maxlength="10" value="<?php echo "$resumo_anos" ?>">
                                </div>  
                                <div class="col-sm-2">
                                    <input type="text" placeholder="2º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoAnos2" maxlength="10" value="<?php echo "$resumo_anos2" ?>" >
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="resumo">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">Resumo de Disciplinas</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="1º Linha:Usada no Gerencial:)" class="form-control" id="" name="inputResumoDisciplinas" value = "<?php echo "$resumo_disciplinas" ?>" maxlength="15">
                                </div>                       
                                <label for="" class="col-sm-2 control-label">Resumo de Turmas</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="1º Linha:Usada no Gerencial:)" class="form-control"  name= "inputResumoTurmas" maxlength="10" value="<?php echo "$resumo_turmas" ?>" >
                                </div> 
                            </div>
                        </div>  
                    </div>                    
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Lotação</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder=""  value="<?php echo $lotacao ?>" class="form-control" id="" name="lotacao" onkeyup="maiuscula(this)">
                            </div>
                            <label for="" class="col-sm-2 control-label">Unidade Escolar</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder=""  value="<?php echo$unidade_escolar ?>" class="form-control" id="" name="unidade_escolar" onkeyup="maiuscula(this)">
                            </div>

                        </div>   
                    </div>                    
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2  control-label">Participante de Projeto</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="projeto" id="">
                                    <?php
                                    if ($projeto == "SIM") {
                                        echo "<option selected = '' value = 'SIM'>SIM</option>";
                                        echo "<option value = 'NAO'>NAO</option>";
                                    } else {
                                        echo "<option selected value = 'NAO'>NAO</option>";
                                        echo "<option value = 'SIM'>SIM</option>";
                                    }
                                    ?>
                                </select>
                            </div>                            
                            <label for="" class="col-sm-2 control-label">Nome do Projeto</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder=""  value="<?php echo $projeto_nome ?>" class="form-control" id="" name="projeto_nome" onkeyup="maiuscula(this)">
                            </div>                           
                        </div>   
                    </div>  
                    <div class="container ">
                        <table style = "border-bottom: solid #000 medium;"height =1% width="100%">
                            <tr>
                                <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp; </th>
                            </tr>
                        </table> 
                    </div>
                    <br> 
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputNome" class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="DIGITE O NOME DO SERVIDOR"  value="<?php echo$nome ?>" class="form-control" id="inputNome" name="inputNome" onkeyup="maiuscula(this)">
                            </div>
                            <label for="inputNascimento"  class="col-sm-2 control-label">Data de Nascimento</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputNascimento").mask("99/99/9999");
                                    });
                                </script>
                                <input id="inputNascimento" type="text" value=" <?php echo $data_nascimento_convertida ?> " class="form-control" name="inputNascimento">
                            </div>
                        </div>   
                    </div>                    
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputMae" class="col-sm-2 control-label">Mãe</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputMae" name="inputMae"  value="<?php echo "$mae"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="inputPai" class="col-sm-2 control-label">Pai</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputPai" name="inputPai" value="<?php echo "$pai"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                        </div>  
                    </div>                   
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="Endereço" class="col-sm-2 control-label">Endereço</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="" name="endereco"  value="<?php echo "$endereco"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="" class="col-sm-2 control-label">Número</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="" name="numero" value="<?php echo "$numero"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="" class="col-sm-1 control-label">CEP</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="" name="cep" value="<?php echo "$cep"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Munícipio</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="" name="municipio"  value="<?php echo "$municipio" ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="" class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="" name="estado" value="<?php echo "$estado"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="" class="col-sm-1 control-label">Bairro</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="" name="bairro" value="<?php echo "$bairro"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Naturalidade</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="" name="naturalidade"  value="<?php echo "$naturalidade" ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="" class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="" name="estado_naturalidade" value="<?php echo "$estado_naturalidade"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="" class="col-sm-1 control-label">Nacionalidade</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="" name="nacionalidade" value="<?php echo "$nacionalidade"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">                            
                            <label for="" class="col-sm-2  control-label">Cor</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="cor" id="">
                                    <?php
                                    $txt_option_sexo = "BRANCA";
                                    $txt_option_sexo2 = "PRETA";
                                    $txt_option_sexo3 = "AMARELA";
                                    $txt_option_sexo4 = "PARDA";
                                    $txt_option_sexo5 = "INDIGENA";
                                    $txt_option_sexo6 = "OUTROS";

                                    if ($cor == "$txt_option_sexo") {
                                        echo "<option selected>$txt_option_sexo</option>";
                                        echo "<option>$txt_option_sexo2</option>";
                                        echo "<option>$txt_option_sexo3</option>";
                                        echo "<option>$txt_option_sexo4</option>";
                                        echo "<option>$txt_option_sexo5</option>";
                                        echo "<option>$txt_option_sexo6</option>";
                                    } elseif ($cor == "$txt_option_sexo2") {
                                        echo "<option selected>$txt_option_sexo2</option>";
                                        echo "<option>$txt_option_sexo</option>";
                                        echo "<option>$txt_option_sexo3</option>";
                                        echo "<option>$txt_option_sexo4</option>";
                                        echo "<option>$txt_option_sexo5</option>";
                                        echo "<option>$txt_option_sexo6</option>";
                                    } elseif ($cor == "$txt_option_sexo3") {
                                        echo "<option selected>$txt_option_sexo3</option>";
                                        echo "<option>$txt_option_sexo</option>";
                                        echo "<option>$txt_option_sexo2</option>";
                                        echo "<option>$txt_option_sexo4</option>";
                                        echo "<option>$txt_option_sexo5</option>";
                                        echo "<option>$txt_option_sexo6</option>";
                                    } elseif ($cor == "$txt_option_sexo4") {
                                        echo "<option selected>$txt_option_sexo4</option>";
                                        echo "<option>$txt_option_sexo</option>";
                                        echo "<option>$txt_option_sexo2</option>";
                                        echo "<option>$txt_option_sexo3</option>";
                                        echo "<option>$txt_option_sexo5</option>";
                                        echo "<option>$txt_option_sexo6</option>";
                                    } elseif ($cor == "$txt_option_sexo5") {
                                        echo "<option selected>$txt_option_sexo5</option>";
                                        echo "<option>$txt_option_sexo</option>";
                                        echo "<option>$txt_option_sexo2</option>";
                                        echo "<option>$txt_option_sexo3</option>";
                                        echo "<option>$txt_option_sexo4</option>";
                                        echo "<option>$txt_option_sexo6</option>";
                                    } else {
                                        echo "<option selected>$txt_option_sexo6</option>";
                                        echo "<option>$txt_option_sexo</option>";
                                        echo "<option>$txt_option_sexo2</option>";
                                        echo "<option>$txt_option_sexo3</option>";
                                        echo "<option>$txt_option_sexo4</option>";
                                        echo "<option>$txt_option_sexo5</option>";
                                    }
                                    ?>     
                                </select>
                            </div>
                            <label for="" class="col-sm-2  control-label">Sexo</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="sexo" id="">
                                    <?php
                                    $txt_option_sexo = "MASCULINO";
                                    $txt_option_sexo2 = "FEMININO";

                                    if ($sexo == "MASCULINO") {
                                        echo "<option selected>$txt_option_sexo</option>";
                                        echo "<option>$txt_option_sexo2</option>";
                                    } else {
                                        echo "<option selected>$txt_option_sexo2</option>";
                                        echo "<option>$txt_option_sexo</option>";
                                    }
                                    ?>     
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">                            
                            <label for="" class="col-sm-2  control-label">Deficiente</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="deficiente" id="">
                                    <?php
                                    $txt_option_def = "SIM";
                                    $txt_option_def2 = "NAO";
                                    if ($deficiente == "$txt_option_def") {
                                        echo "<option selected>$txt_option_def</option>";
                                        echo "<option>$txt_option_def2</option>";
                                    } else {
                                        echo "<option selected>$txt_option_def2</option>";
                                        echo "<option>$txt_option_def</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Tipo Deficiencia</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"  name="tipo_deficiencia" value="<?php echo "$tipo_deficiencia"; ?>" onkeyup="maiuscula(this)" >
                            </div>         
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">                            
                            <label for="" class="col-sm-2  control-label">Estado Civil</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="estado_civil" id="">
                                    <?php
                                    $txt_option_civil = "SOLTEIRO(A)";
                                    $txt_option_civil2 = "CASADO(A)";
                                    $txt_option_civil3 = "DIVORCIADO(A)";
                                    $txt_option_civil4 = "VIÚVO(A)";
                                    $txt_option_civil5 = "OUTROS";
                                    if ($estado_civil == "$txt_option_civil") {
                                        echo "<option selected>$txt_option_civil</option>";
                                        echo "<option >$txt_option_civil2</option>";
                                        echo "<option >$txt_option_civil3</option>";
                                        echo "<option >$txt_option_civil4</option>";
                                        echo "<option >$txt_option_civil5</option>";
                                    } elseif ($estado_civil == "$txt_option_civil2") {
                                        echo "<option selected>$txt_option_civil2</option>";
                                        echo "<option >$txt_option_civil</option>";
                                        echo "<option >$txt_option_civil3</option>";
                                        echo "<option >$txt_option_civil4</option>";
                                        echo "<option >$txt_option_civil5</option>";
                                    } elseif ($estado_civil == "$txt_option_civil3") {
                                        echo "<option selected>$txt_option_civil3</option>";
                                        echo "<option >$txt_option_civil</option>";
                                        echo "<option >$txt_option_civil2</option>";
                                        echo "<option >$txt_option_civil4</option>";
                                        echo "<option >$txt_option_civil5</option>";
                                    } elseif ($estado_civil == "$txt_option_civil4") {
                                        echo "<option selected>$txt_option_civil4</option>";
                                        echo "<option >$txt_option_civil</option>";
                                        echo "<option >$txt_option_civil2</option>";
                                        echo "<option >$txt_option_civil3</option>";
                                        echo "<option >$txt_option_civil5</option>";
                                    } else {
                                        echo "<option selected>$txt_option_civil5</option>";
                                        echo "<option >$txt_option_civil</option>";
                                        echo "<option >$txt_option_civil2</option>";
                                        echo "<option >$txt_option_civil3</option>";
                                        echo "<option >$txt_option_civil4</option>";
                                    }
                                    ?>
                                </select>
                            </div>  
                            <label for="inputFone" class="col-sm-2 control-label">Fones</label>
                            <div class="col-sm-2">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputFone").mask("9999-9999");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputFone" name="inputFone" value="<?php echo $fone ?>">
                            </div>
                            <div class="col-sm-2">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputCel").mask("(99) 9-9999-9999");
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputCel" name="inputCel" value="<?php echo $celular ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">                            
                            <label for="" class="col-sm-2  control-label">Cônjuge</label>                           
                            <div class="col-sm-4">
                                <input type="text" class="form-control"  name="conjuge" value="<?php echo "$conjuge"; ?>" onkeyup="maiuscula(this)" >
                            </div> 
                            <label for="" class="col-sm-2 control-label">Cônjuge/CPF</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#conjuge_cpf").mask("999.999.999-99", {reverse: true});
                                    });
                                </script>
                                <input  class="form-control" id="conjuge_cpf" name="conjuge_cpf" value="<?php echo "$conjuge_cpf"; ?>">
                            </div> 
                        </div>
                    </div>
                    <div class="container ">
                        <table style = "border-bottom: solid #000 medium;"height =1% width="100%">
                            <tr>
                                <th style="text-align: center">DOCUMENTAÇÃO PESSOAL</th>
                            </tr>
                        </table> 
                    </div><br>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputModelo_Certidao" class="col-sm-2  control-label">Modelo da Certidão</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputModelo_Certidao" id="inputModelo_Certidao">
                                    <?php
                                    $txt_option = "NOVO";
                                    $txt_option2 = "VELHO";

                                    if ($modelo_certidao == $txt_option) {
                                        echo "<option selected> $txt_option </option>";
                                        echo "<option> $txt_option2 </option>";
                                    } else {
                                        echo "<option selected>$txt_option2</option>";
                                        echo "<option>$txt_option</option>";
                                    }
                                    ?>
                                </select>
                            </div>   
                            <div id = "matricula">
                                <label for="inputMatricula_Certidao" class="col-sm-2  control-label">Matricula da Certidão</label>
                                <div class="col-sm-4">                                
                                    <input type="text" class="form-control" id="inputMatricula_Certidao" name="inputMatricula_Certidao" value="<?php echo "$matricula_certidao"; ?>" placeholder="XXXXXXXXXX XXXX X XXXXX XXX XXXXXXX XX" >
                                </div>
                            </div>
                        </div>
                    </div> 	
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Tipo de Certidão Civil</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="certidao" >
                                    <?php
                                    if ($certidao == "CASAMENTO") {
                                        echo "<option selected = '' >CASAMENTO</option>";
                                        echo "<option>NASCIMENTO</option>";
                                    } else {
                                        echo "<option selected = ''>NASCIMENTO</option>";
                                        echo "<option>CASAMENTO</option>";
                                    }
                                    ?>   
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Dados da Certidão</label>
                            <div class="col-sm-4" id = "">
                                <input type="text" class="form-control" name="certidao_dados_gerais" value="<?= $certidao_dados_gerais ?>"onkeyup="maiuscula(this)" placeholder="Termo N° XXX,  FLS: xxx,  Livro: xx.">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="tres">
                        <div class="form-group col-sm-12">                                                     
                            <label for="" class="col-sm-2 control-label">Expedição da Certidão</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="certidao_data" value="<?= $certidao_data ?>">
                            </div>                             
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputTiposCertidao" class="col-sm-2 control-label">Dados do RG</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputTiposCertidao" id="inputTiposCertidao">
                                    <option value="RG">RG</option>
                                </select>
                            </div>             
                            <label for="inputCertidao" class="col-sm-2 control-label">Número do RG</label>
                            <div class="col-sm-4">
                                <input type="text" value="<?php echo $dados_certidao ?>" class="form-control" id="inputCertidao" name="inputCertidao" onkeyup="maiuscula(this)">
                            </div>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Orgão Expedidor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="" name="inputOxp"  value="<?php echo "$orgao_expedidor"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                            <label for="" class="col-sm-2 control-label">Estado Expedidor</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="" name="inputExpdd" value="<?php echo "$estado_expedidor"; ?>" onkeyup="maiuscula(this)" >
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputExpedicao" class="col-sm-2 control-label">Data de Expedição</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputExpedicao").mask("99/99/9999");
                                    });
                                </script>
                                <input type="text" value="<?php echo "$data_expedicao_convertida"; ?>"  class="form-control" id="inputExpedicao" name="inputExpedicao" >
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputCpf" class="col-sm-2 control-label">CPF</label>
                            <div class="col-sm-4">
                                <script type="text/javascript" >
                                    $(function () {
                                        $("#inputCpf").mask("999.999.999-99", {reverse: true});
                                    });
                                </script>
                                <input  class="form-control" id="inputCpf" name="inputCpf" value="<?php echo "$cpf"; ?>">
                            </div>                 
                            <label for="" class="col-sm-2 control-label">PIS/PASEP/NIS</label>
                            <div class="col-sm-4">                               
                                <input  class="form-control" id="" name="pis" value="<?php echo "$pis"; ?>">
                            </div> 
                        </div> 
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Título Eleitoral</label>
                            <div class="col-sm-3">                               
                                <input type="number" min="0" class="form-control" name="titulo" placeholder="Inscrição" value="<?php echo "$titulo"; ?>">
                            </div> 
                            <div class="col-sm-2">                               
                                <input  type="number" min="0" class="form-control" name="zona" placeholder="Zona" value="<?php echo "$zona"; ?>">
                            </div> 
                            <div class="col-sm-2">                               
                                <input  type="number" min="0" class="form-control" name="secao" placeholder="Seção" value="<?php echo "$secao"; ?>">
                            </div> 
                            <div class="col-sm-2">                               
                                <input  type="text" class="form-control" name="titulo_municipio" placeholder="Município" value="<?php echo "$titulo_municipio"; ?>" onkeyup="maiuscula(this)">
                            </div> 
                            <div class="col-sm-1">                               
                                <input  type="text" class="form-control" name="titulo_uf" placeholder="UF" value="<?php echo "$titulo_uf"; ?>" onkeyup="maiuscula(this)">
                            </div> 
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Dados Bancários</label>
                            <div class="col-sm-3">                               
                                <input type="text"  class="form-control" name="banco" placeholder="Nome do Banco" value="<?php echo "$banco"; ?>" onkeyup="maiuscula(this)">
                            </div> 
                            <label for="" class="col-sm-1 control-label"></label>
                            <div class="col-sm-3">                               
                                <input  type="number" min="0" class="form-control" name="agencia" placeholder="N° da Agência" value="<?php echo "$agencia"; ?>">
                            </div> 
                            <label for="" class="col-sm-1 control-label"></label>
                            <div class="col-sm-2">                               
                                <input  type="number" min="0" class="form-control" name="conta" placeholder="N° da Conta" value="<?php echo "$conta"; ?>">
                            </div>                             
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputCel" class="col-sm-2 control-label">Tipos Sanguíneos</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="A+, A-, B+, B-, O+, O-, AB+, AB-" class="form-control" id="" name="tipo_sangue" value="<?php echo $tipo_sangue ?>" onkeyup="maiuscula(this)">
                            </div>
                            <label for="inputEmail" class="col-sm-2 control-label">EMAIL</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="DIGITE O EMAIL" class="form-control" id="inputEmail" name="inputEmail" value="<?php echo $email ?>">
                            </div>
                        </div>   
                    </div>
                    <div class="container ">
                        <table style = "border-bottom: solid #000 medium;"height =1% width="100%">
                            <tr>
                                <th style="text-align: center">INSTRUÇÃO ACADÊMICA</th>                                
                            </tr>
                        </table>
                    </div>
                    <br>    
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Grau de Instrução</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="grau_intrucao">
                                    <?php
                                    $txt_option_instrucao = "1 GRAU";
                                    $txt_option_instrucao2 = "2 GRAU";
                                    $txt_option_instrucao3 = "3 GRAU";

                                    if ($grau_intrucao == "$txt_option_instrucao2") {
                                        echo "<option selected>$txt_option_instrucao2</option>";
                                        echo "<option>$txt_option_instrucao</option>";
                                        echo "<option>$txt_option_instrucao3</option>";
                                    } elseif ($grau_intrucao == "$txt_option_instrucao3") {
                                        echo "<option selected>$txt_option_instrucao3</option>";
                                        echo "<option>$txt_option_instrucao2</option>";
                                        echo "<option>$txt_option_instrucao</option>";
                                    } else {
                                        echo "<option selected>$txt_option_instrucao</option>";
                                        echo "<option>$txt_option_instrucao2</option>";
                                        echo "<option>$txt_option_instrucao3</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="inputEmail" class="col-sm-2 control-label">Completo</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="grau_intrucao_completo">
                                    <?php
                                    $txt_option_inst_completo = "SIM";
                                    $txt_option_inst_completo2 = "NAO";

                                    if ($grau_intrucao_completo == "$txt_option_inst_completo") {
                                        echo "<option selected>$txt_option_inst_completo</option>";
                                        echo "<option>$txt_option_inst_completo2</option>";
                                    } else {
                                        echo "<option selected>$txt_option_inst_completo2</option>";
                                        echo "<option>$txt_option_inst_completo</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="inputEmail" class="col-sm-2 control-label">Onde Cursou</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="Nome da Instituição" class="form-control" id="" name="formado_em" value="<?= $formado_em ?>" onkeyup="maiuscula(this)">
                            </div>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Pós-Graduação</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="pos_graduacao">
                                    <?php
                                    if ($pos_graduacao == "SIM") {
                                        echo "<option selected>SIM</option>";
                                        echo "<option>NAO</option>";
                                    } else {
                                        echo "<option selected>NAO</option>";
                                        echo "<option>SIM</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Completo</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="pos_graduacao_completo">
                                    <?php
                                    if ($pos_graduacao_completo == "SIM") {
                                        echo "<option selected>SIM</option>";
                                        echo "<option>NAO</option>";
                                    } else {
                                        echo "<option selected>NAO</option>";
                                        echo "<option>SIM</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="" class="col-sm-2 control-label">Onde Cursou</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="Nome da Instituição" class="form-control"  name="pos_graduacao_onde" value="<?= $pos_graduacao_onde ?>" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display: none" >
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-2 control-label">Orgão de Classe</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="" class="form-control" id="" name="registro_classe" value="<?php echo $registro_classe ?>" onkeyup="maiuscula(this)">
                            </div>
                            <label for="" class="col-sm-2 control-label">Regsitro N°</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="" class="form-control"  name="registro_numero" value="<?php echo $registro_numero ?>">
                            </div>
                            <label for="" class="col-sm-2 control-label">Data</label>
                            <div class="col-sm-2">
                                <input type="date" placeholder="" class="form-control"  name="registro_data" value="<?php echo $registro_data ?>">
                            </div>
                        </div>   
                    </div>
                    <br>    
                    <div class="container ">
                        <table style = "border-bottom: solid #000 medium;"height =1% width="100%">
                            <tr>
                                <th style="text-align: center">DEPENDENTES : &nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php
                                    if ($dependente == "SIM") {
                                        echo'<input type="radio" name="dependente" class="" id="radio_um" value= "SIM" checked> SIM &nbsp;&nbsp;';
                                        echo '<input type="radio" name="dependente" class="" id="radio_dois" value= "NAO"> NÃO';
                                    } else {
                                        echo '<input type="radio" name="dependente" class="" id="radio_dois" value= "NAO" checked> NÃO';
                                        echo'<input type="radio" name="dependente" class="" id="radio_um" value= "SIM" > SIM &nbsp;&nbsp;';
                                    }
                                    ?>
                                </th>
                            </tr>
                        </table> 
                        <input type="hidden" value="<?= $dependente ?>" id="depentente">
                    </div><br> 

                    <div id="dependentes">
                        <div class="row" >                       
                            <div class="form-group col-sm-12">                            
                                <label for="" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="" class="form-control" id="" name="depen_nome_1" value="<?php echo $depen_nome_1 ?>" onkeyup="maiuscula(this)">
                                </div>                            
                                <label for="" class="col-sm-2 control-label">Sexo</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="depen_sexo_1">
                                        <?php
                                        if ($depen_sexo_1 == "MASCULINO") {
                                            echo "<option selected>MASCULINO</option>";
                                            echo "<option>FEMININO</option>";
                                            echo "<option  value = ''>Informe o Sexo</option>";
                                        } elseif ($depen_sexo_1 == "FEMININO") {
                                            echo "<option selected>FEMININO</option>";
                                            echo "<option>MASCULINO</option>";
                                            echo "<option  value = ''>Informe o Sexo</option>";
                                        } else {
                                            echo "<option selected value = ''>Informe  o Sexo</option>";
                                            echo "<option >MASCULINO</option>";
                                            echo "<option>FEMININO</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">                         
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#depen_cpf_1").mask("999.999.999-99", {reverse: true});
                                        });
                                    </script>
                                    <input  class="form-control" id="depen_cpf_1" name="depen_cpf_1" value="<?php echo "$depen_cpf_1"; ?>">
                                </div>                             
                                <label for="" class="col-sm-2 control-label">Grau de Parestesco</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="depen_grau_1">
                                        <?php
                                        if ($depen_grau_1 == "1 GRAU") {
                                            echo "<option selected>1 GRAU</option>";
                                            echo "<option>2 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                        } elseif ($depen_grau_1 == "2 GRAU") {
                                            echo "<option selected>2 GRAU</option>";
                                            echo "<option>1 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                        } elseif ($depen_grau_1 == "3 GRAU") {
                                            echo "<option selected>3 GRAU</option>";
                                            echo "<option>1 GRAU</option>";
                                            echo "<option>2 GRAU'</option>";
                                        } else {
                                            echo "<option selected value = ''>Escolha o Grau Aqui!</option>";
                                            echo "<option>1 GRAU</option>";
                                            echo "<option>2 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="" class="col-sm-2 control-label">Nascimento</label>
                                <div class="col-sm-2">
                                    <input type="date" placeholder="" class="form-control"  name="depen_data_1" value="<?php echo $depen_data_1 ?>">
                                </div>                                                                           
                            </div>
                        </div>        

                        <div class="row" >                       
                            <div class="form-group col-sm-12">                            
                                <label for="" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="" class="form-control" id="" name="depen_nome_2" value="<?php echo $depen_nome_2 ?>" onkeyup="maiuscula(this)">
                                </div>                            
                                <label for="" class="col-sm-2 control-label">Sexo</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="depen_sexo_2">
                                        <?php
                                        if ($depen_sexo_2 == "MASCULINO") {
                                            echo "<option selected>MASCULINO</option>";
                                            echo "<option>FEMININO</option>";
                                            echo "<option  value = ''>Informe o Sexo</option>";
                                        } elseif ($depen_sexo_2 == "FEMININO") {
                                            echo "<option selected>FEMININO</option>";
                                            echo "<option>MASCULINO</option>";
                                            echo "<option  value = ''>Informe o Sexo</option>";
                                        } else {
                                            echo "<option selected value = ''>Informe  o Sexo</option>";
                                            echo "<option >MASCULINO</option>";
                                            echo "<option>FEMININO</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">                         
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#depen_cpf_2").mask("999.999.999-99", {reverse: true});
                                        });
                                    </script>
                                    <input  class="form-control" id="depen_cpf_2" name="depen_cpf_2" value="<?php echo "$depen_cpf_2"; ?>">
                                </div>                             
                                <label for="" class="col-sm-2 control-label">Grau de Parestesco</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="depen_grau_2">
                                        <?php
                                        if ($depen_grau_2 == "1 GRAU") {
                                            echo "<option selected>1 GRAU</option>";
                                            echo "<option>2 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                        } elseif ($depen_grau_2 == "2 GRAU") {
                                            echo "<option selected>2 GRAU</option>";
                                            echo "<option>1 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                        } elseif ($depen_grau_2 == "3 GRAU") {
                                            echo "<option selected>3 GRAU</option>";
                                            echo "<option>1 GRAU</option>";
                                            echo "<option>2 GRAU'</option>";
                                        } else {
                                            echo "<option selected = '' value = ''>Escolha o Grau Aqui!</option>";
                                            echo "<option >1 GRAU</option>";
                                            echo "<option>2 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="" class="col-sm-2 control-label">Nascimento</label>
                                <div class="col-sm-2">
                                    <input type="date" placeholder="" class="form-control"  name="depen_data_2" value="<?php echo $depen_data_2 ?>">
                                </div>                                                                           
                            </div>
                        </div>
                        <div class="row" >                       
                            <div class="form-group col-sm-12">                            
                                <label for="" class="col-sm-2 control-label">Nome</label>
                                <div class="col-sm-4">
                                    <input type="text" placeholder="" class="form-control" id="" name="depen_nome_3" value="<?php echo $depen_nome_3 ?>" onkeyup="maiuscula(this)">
                                </div>                            
                                <label for="" class="col-sm-2 control-label">Sexo</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="depen_sexo_3">
                                        <?php
                                        if ($depen_sexo_3 == "MASCULINO") {
                                            echo "<option selected>MASCULINO</option>";
                                            echo "<option>FEMININO</option>";
                                            echo "<option  value = ''>Informe o Sexo</option>";
                                        } elseif ($depen_sexo_3 == "FEMININO") {
                                            echo "<option selected>FEMININO</option>";
                                            echo "<option>MASCULINO</option>";
                                            echo "<option  value = ''>Informe o Sexo</option>";
                                        } else {
                                            echo "<option selected value = ''>Informe  o Sexo</option>";
                                            echo "<option >MASCULINO</option>";
                                            echo "<option>FEMININO</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">                         
                            <div class="form-group col-sm-12">
                                <label for="" class="col-sm-2 control-label">CPF</label>
                                <div class="col-sm-2">
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#depen_cpf_3").mask("999.999.999-99", {reverse: true});
                                        });
                                    </script>
                                    <input  class="form-control" id="depen_cpf_3" name="depen_cpf_3" value="<?php echo "$depen_cpf_3"; ?>">
                                </div>                             
                                <label for="" class="col-sm-2 control-label">Grau de Parestesco</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="depen_grau_3">
                                        <?php
                                        if ($depen_grau_3 == "1 GRAU") {
                                            echo "<option selected>1 GRAU</option>";
                                            echo "<option>2 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                            echo "<option value = ''>Escolha o Grau Aqui!</option>";
                                        } elseif ($depen_grau_3 == "2 GRAU") {
                                            echo "<option selected>2 GRAU</option>";
                                            echo "<option>1 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                            echo "<option value = ''>Escolha o Grau Aqui!</option>";
                                        } elseif ($depen_grau_3 == "3 GRAU") {
                                            echo "<option selected>3 GRAU</option>";
                                            echo "<option>2 GRAU</option>";
                                            echo "<option>1 GRAU</option>";
                                            echo "<option value = ''>Escolha o Grau Aqui!</option>";
                                        } else {
                                            echo "<option selected = '' value = ''>Escolha o Grau Aqui!</option>";
                                            echo "<option>1 GRAU</option>";
                                            echo "<option>2 GRAU</option>";
                                            echo "<option>3 GRAU'</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="" class="col-sm-2 control-label">Nascimento</label>
                                <div class="col-sm-2">
                                    <input type="date" placeholder="" class="form-control"  name="depen_data_3" value="<?php echo $depen_data_3 ?>">
                                </div>                                                                           
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  for="inputId" class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                            <input type="hidden" h class="form-control" id="inputId" name="inputId" value="<?php echo $Recebe_id ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                            <button type="submit" value="Enviar" class="btn btn-success btn-block" onclick=" return confirmarAtualizacao()" >Atualizar</button>
                        </div>
                        <div class=" col-sm-4">
                            <button type="reset" class="btn btn-danger btn-block">Limpar</button>                                
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
        </script>
        <script type="text/javascript">
            function confirmarAtualizacao() {
                var r = confirm("Realmente deseja atualizar o registro?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                var txt = $('#inputResumoSim').val();

                if (txt == "SIM") {
                    $('.resumo').show();
                } else {
                    $('.resumo').hide();
                }
                $('#inputResumoSim').change(function () {
                    var txt = $('#inputResumoSim').val();
                    if (txt == "SIM") {
                        $('.resumo').show('slow');
                    } else {
                        $('.resumo').hide('slow');
                    }

                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                var depentente = $('#depentente').val();
                if (depentente == "NAO") {

                    $('#dependentes').hide('slow');
                } else {
                    $('#dependentes').show('slow');
                }

                $('#radio_um').click(function () {
                    var txt = $('#radio_um').val();
                    if (txt == "SIM") {
                        $('#dependentes').show('slow');

                    }
                });
                $('#radio_dois').click(function () {
                    var txt = $('#radio_dois').val();
                    if (txt == "NAO") {
                        $('#dependentes').hide('slow');
                    }
                });
            });
        </script>

    </body>
</html>
