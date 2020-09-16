<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
//Impressão
if (isset($_POST['basica'])) {
    $txt_option = "1";
    include_once './pesquisar_no_banco_impressao.php';
} elseif (isset($_POST['geral'])) {
    $txt_option = "2";
    include_once './pesquisar_no_banco_impressao.php';
} elseif (isset($_POST['tudo'])) {
    $txt_option = "";
    include_once './pesquisar_no_banco_impressao.php';
} elseif (isset($_POST['acoes'])) {
    $txt_option = "1";
    include_once './pesquisar_no_banco_impressao_usuarios_acoes.php';
} elseif (isset($_POST['acoes_tudo'])) {
    $txt_option = "2";
    include_once './pesquisar_no_banco_impressao_usuarios_acoes.php';
}
?>
<html lang="pt-br" style="background-color:white;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ATUALIZAR VÁRIOS</title>
        <style>
            @media (max-width: 768px) {.botoes{width: -moz-available; margin-bottom: 6px;}
            } 
            @media (max-width: 384px) {#ocultar_2{display: none;}
            }     
            @media (max-width: 768px) {#ocultar{display: none;}
            } 
            input{
                width: 100%;
            }
            #btnMostrarEsconderBtnHistorico:hover  {
                background-color:black;
                border-radius: 4px;
                border-color: whitesmoke;
                color: white;
                font-size: 14px;
            }
            .radio{            
                transform: scale(1.5);
                width: 24px !important;               
            }  
        </style>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>      
        <link href="assets/css/bootstrap-grid.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap-reboot.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>      
        <h3 style=" text-align: center;">Atualizar Vários</h3>
        <div class="container-fluid">                          
            <p>
                <button id="btnMostrarEsconderBtnTurmas" class="btn btn-warning botoes" autofocus="">Mostrar Turmas</button>
                <button id="btnMostrarEsconderBtnBolsa" class="btn btn-primary botoes" >Bolsa Família</button>                  
                <button id="btnMostrarEsconderBtnTransporte" class="btn btn-success botoes" >Transporte</button>
                <button id="btnMostrarEsconderBtnCoringa" class="btn btn-info botoes" >Outros</button>
                <button id="btnMostrarEsconderBtnHistorico" class="btn btn-inverse botoes" >Histórico</button>
                <button id="btnMostrarEsconderBtnboletos" class="btn btn-outline-secondary botoes" >Boletos</button>
                <?php
                if (isset($_POST['turma_transferidos'])) {
                    echo"<button id='btnMostrarEsconderBtnArquivo' class='btn btn-secundary'>Arquivo Passivo</button>";
                } elseif (isset($_POST['turma_desistentes'])) {
                    echo"<button id='btnMostrarEsconderBtnArquivo' class='btn btn-secundary'>Arquivo Passivo</button>";
                }
                ?>  
                <button id='btnMostrarEsconderBtnTurmaExtra' class='btn btn-danger botoes'>Turmas Extra</button>
                <button id="btnMostrarEsconderBtnTransferir" class="btn btn-marron botoes" >Transferir</button>
            </p>       
            <script src="assets/js/jquery.maskMoney.min.js" type="text/javascript"></script>

            <form name="cadastrar" action="atualizar_varios_server.php" method="post" class="form-horizontal" >  
                <input type="hidden" name="usuario_logado" value="<?php echo $usuario_logado ?>">
                <div class="row" id="boletos">
                    <div class="col-md-12">                   
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>   
                                    <th>
                                        <input class="radio"  type="radio" name="inlineRadioOptions" checked="" id="inlineRadio1" value="option1">
                                        <label class="" for="inlineRadio1">Gerar Boletos</label>
                                    </th>
                                    <th>
                                        <input class="radio" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">                                       
                                        <label class="" for="inlineRadio2"> Atualizar Boletos</label>
                                    </th>
                                    <th>
                                        <input class="radio" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                        <label class="" for="inlineRadio3"> Deletar Boletos</label>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>                                
                                <tr>                                
                                    <th colspan = '3'>
                                        Mês e Ano do Boleto: <input type="date" name="previsao_pagamento" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr class="pago_em" style="display:none">                                
                                    <th colspan = '3'>
                                        Pago em: <input type="date" name="pago_em" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr class="mensalidade">                                
                                    <th colspan = '3'>
                                        Mensalidade:<input class="form-control dinheiro" type="text" name="mensalidade" id="mensalidade" value="0.00" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr style="display: none" class="desconto">                                
                                    <th colspan = '3'>
                                        desconto:<input class="form-control dinheiro" type="text" name="desconto" id="desconto" value="0.00" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr style="display: none" class="multa">                                
                                    <th colspan = '3'>
                                        multa:<input class="form-control dinheiro" type="text" name="multa" id="multa" value="0.00" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr class="bolsista">                                
                                    <th colspan = '3'>
                                        Aluno Bolsista: 
                                        <select class="form-control" name="bolsista" style="width: 100% !important">
                                            <option>SIM</option>
                                            <option value="NAO" selected="">NÃO</option>
                                        </select>
                                    </th>                                    
                                </tr>
                                <tr class="bolsista_valor">                                
                                    <th colspan = '3'>
                                        Valor da Bolsa:<input class="form-control dinheiro" type="text" name="bolsista_valor" id="bolsista_valor" value="0.00" style="width: 100% !important">
                                    </th>                                    
                                </tr>   
                                <tr>                                
                                    <th>
                                        <button  id ='boletos_criar'  type='submit' value='boletos' name = 'boletos_criar' class='btn btn-primary  btn-block' onclick = 'return confirmar()' >Criar Novo Boleto</button>
                                    </th>                                    
                                    <th>
                                        <button  id ='boletos_atualizar' disabled="" type='submit' value='boletos' name = 'boletos_atualizar' class='btn btn-success  btn-block' onclick = 'return confirmar()' >Atualizar Boleto</button>
                                    </th>                                    
                                    <th>
                                        <button  id ='boletos_excluir' disabled="" type='submit' value='boletos' name = 'boletos_excluir' class='btn btn-danger  btn-block' onclick = 'return confirmar()' >Excluir Boleto</button>
                                    </th>                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>                                           
                </div>
                <!--Div historico-->                <!--Div historico-->                <!--Div historico-->                <!--Div historico-->
                <div class="row" id="historico">
                    <div class="container ">
                        <div class="col-sm-12">
                            <div class="col-sm-10">                   
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center" colspan="2">NOVO(S) HISTÓRICO(S)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                                
                                            <th colspan="2">
                                                <select class="form-control" name="inputAno" id="inputAno"  style="width: 100% !important">
                                                    <option  selected="" value="">Selecione o Ano </option>
                                                    <option>2008</option>
                                                    <option>2009</option>
                                                    <option>2010</option>
                                                    <option>2011</option>
                                                    <option>2012</option>
                                                    <option>2013</option>
                                                    <option>2014</option>
                                                    <option>2015</option>
                                                    <option disabled=""></option>
                                                    <option value="2016">2016 - Primeiro Histórico</option>
                                                    <option value="2016-2">2016 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2017">2017 - Primeiro Histórico</option>
                                                    <option value="2017-2">2017 Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2018">2018 - Primeiro Histórico</option>
                                                    <option value="2018-2">2018 Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2019">2019 - Primeiro Histórico</option>
                                                    <option value="2019-2">2019 Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2020">2020 - Primeiro Histórico</option>
                                                    <option value="2020-2">2020 Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2021">2021 - Primeiro Histórico</option>
                                                    <option value="2021-2">2021 Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2022">2022 - Primeiro Histórico</option>
                                                    <option value="2022-2">2022 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2023">2023 - Primeiro Histórico</option>
                                                    <option value="2023-2">2023 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2024">2024 - Primeiro Histórico</option>
                                                    <option value="2024-2">2024 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2025">2025 - Primeiro Histórico</option>
                                                    <option value="2025-2">2025 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2026">2026 - Primeiro Histórico</option>
                                                    <option value="2026-2">2026 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2027">2027 - Primeiro Histórico</option>
                                                    <option value="2027-2">2027 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2028">2028 - Primeiro Histórico</option>
                                                    <option value="2028-2">2028 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2019">2019 - Primeiro Histórico</option>
                                                    <option value="2029-2">2029 - Segundo Histórico</option>
                                                    <option disabled=""></option>
                                                    <option value="2030">2030 - Primeiro Histórico</option>  
                                                    <option value="2030-2">2030 - Segundo Histórico</option>
                                                </select>
                                            </th>                                
                                        </tr> 
                                        <tr>                                
                                            <th colspan="2">
                                                <select class="form-control" name="ano_turma" id="ano_turma"  style="width: 100% !important">
                                                    <option  selected="" value="">Selecione a Turma para Esse Ano</option>
                                                    <option value="INFANTIL">CRECHE ou PRE-ESCOLAR</option>
                                                    <option>1 ANO</option>
                                                    <option>2 ANO</option>
                                                    <option>3 ANO</option>
                                                    <option>4 ANO</option>
                                                    <option>5 ANO</option>
                                                    <option>EJA I</option>
                                                    <option>EJA II</option>                                                                                              
                                                </select>
                                            </th>                                
                                        </tr>   
                                        <tr>
                                            <td colspan="2">
                                                <select class="form-control" name="status_bimestre_media" id="status_bimestre_media" >
                                                    <option  selected="" value="1">Selecione o Resultado </option>
                                                    <?php
                                                    $query = mysqli_query($Conexao, "SELECT * FROM `status_alunos`");
                                                    $row = mysqli_num_rows($query);
                                                    if ($row > 0) {
                                                        while ($result = mysqli_fetch_array($query)) {
                                                            $status_aluno = $result['status_aluno'];
                                                            $status_id = $result['id'];
                                                            echo "<option value = '$status_id'>$status_aluno</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id = 'thNome' colspan="2"><input id = 'input_escola' type = 'text' name = 'inputEscola' placeholder = 'Nome da Escola' onkeyup='maiuscula(this)'></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputCidade' placeholder = 'Cidade' onkeyup='maiuscula(this)'></td>                              
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputUf' placeholder = 'Estado' onkeyup='maiuscula(this)'></td>                            
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputTurmaHistorico' placeholder = 'Turma' onkeyup='maiuscula(this)'></td>                             
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputTurno' placeholder = 'Turno' onkeyup='maiuscula(this)'></td>                             
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputUnica' placeholder = 'Única' onkeyup='maiuscula(this)'></td>                            
                                        </tr>
                                        <tr>                                
                                            <?php
                                            echo "<th>"
                                            . "&nbsp;&nbsp;<button disabled = '' id = 'criar_historico' type='submit' value='historico' name = 'historico' class='btn btn-success  btn-block' onclick = 'return confirmarExclusao2()' >CRIAR NOVO HISTÓRICO</button>"
                                            . "</th>";
                                            echo "<th>"
                                            . "&nbsp;&nbsp;<button type='reset' value='' name ='botao' class='btn btn-danger  btn-block'>&nbsp;&nbsp;LIMPAR OS CAMPOS DIGITADOS</button>"
                                            . "</th>";
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>   
                        </div> 
                    </div>
                </div>
                <!--Fim da Div Historico-->                <!--Fim da Div Historico-->

                <div id="divConteudoBtnTurmas" style="background-color: #cc7700; "><br>
                    <div class="form-group">
                        <label for="inputTurma" class="col-sm-3 control-label">Turma</label>
                        <div class="col-sm-6" >
                            <select class="form-control" name="inputTurma" id="inputTurma" >
                                <?php
                                $ano = date('Y');
                                $ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
                                $ano_futuro = date('Y', strtotime('+362 days', strtotime($ano)));
                                //
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma_extra` = 'NÃO' AND `status` = 'OCUPADA' ORDER BY `turmas`.`ano` DESC, `turmas`.`turma` ASC ");
//                              //
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $turma = $Registro["turma"];
                                    $turno = $Registro["turno"];
                                    $id_turma = $Registro["id"];
                                    $ano_turma = substr($Registro["ano"], 0, -6);
                                    //
                                    if ($ano_turma == "2018") {
                                        $ano_unico = "";
                                    } else {
                                        $ano_unico = $Registro["unico"];
                                    }
                                    //
                                    if ($ano_turma == "$ano_futuro") {
                                        echo "<option value = '$id_turma'>$turma $ano_unico ($turno) $ano_futuro - Futuro</option>";
                                    } elseif ($ano_turma == "$ano") {
                                        echo "<option value = '$id_turma'>$turma $ano_unico ($turno) $ano - Atual</option>";
                                    } else {
                                        echo "<option value = '$id_turma'>$turma $ano_unico ($turno) $ano_passado - Passado</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>                      
                    </div> 
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-6" >
                            <select class="form-control" name="inputStatus" id="" >
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `status_alunos` WHERE `relatorio` = 'S' ORDER BY status_aluno");
                                echo "<option selected = '' value = ''>Caso Deseje Altere Também o Status do Aluno!</option>";
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $status_aluno = $Registro["status_aluno"];
                                    echo "<option>$status_aluno</option>";
                                }
                                ?>
                            </select>
                        </div>  
                    </div>
                    <div class="form-group" >
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" name="atualizar" value="" class="btn btn-success" onclick='return confirmarAtualizacao()' >Atualizar Todos</button>
                        </div>
                    </div><br>
                </div>
                <!--Turma Extra-->
                <div id="divConteudoTurma_Extra" style="background-color: #C9302C; "><br>
                    <div class="form-group">
                        <label for="inputTurma_Extra" class="col-sm-3 control-label">Turma Extra</label>
                        <div class="col-sm-6" >
                            <select class="form-control" name="inputTurmaExtra" id="inputTurmaExtra">
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma_extra` = 'SIM' ORDER BY turma");
                                echo "<option disabled selected>SELECIONE A TURMA DESEJADA AQUI ! </option>";
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $turma = $Registro["turma"];
                                    $turno = $Registro["turno"];
                                    echo "<option>$turma ($turno)</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>                         
                    <div class="form-group" >
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" name="extra_incluir" value="" class="btn btn-success" onclick='return confirmarAtualizacao()' >Colocar na Turma</button>
                            <button type="submit" name="extra_trocar" value="" class="btn btn-secundary" onclick='return confirmarAtualizacao()' >Trocar de Turma</button>
                            <button type="submit" name="extra_retirar"  value="" class="btn btn-preto" onclick='return confirmarAtualizacao()' >Retirar da Turma</button>

                        </div>
                    </div><br>
                </div>
                <!-- Div Bolsa Família-->
                <div id="divBolsa_Familia">
                    <div  style=" background-color: #286090;"><br>
                        <div class="form-group" >
                            <label for="" class="col-sm-3 control-label">Bolsa Família</label>
                            <div class= "col-sm-offset-3 col-sm-9" >
                                <button type="submit"  name="incluir" value="SIM"class="btn btn-success" onclick='return confirmarAtualizacao()'>Incluir Todos</button>
                                <button type="submit"  name="retirar" value="NÃO"class="btn btn-danger" onclick='return confirmarExclusao()'>Retirar Todos</button>
                            </div>
                        </div><br>
                    </div>
                </div>
                <!-- Div Excluir-->
                <div id="divConteudoArquivo" style="background-color: #D9DBDA; "><br>
                    <div class="form-group">
                        <label for="inputPasta" class="col-sm-3 control-label">Escolha a Pasta</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="inputPasta" id="inputPasta">
                                <option disabled= "" selected="">A,B,C, .....etc.  Por Favor Verifique se Ainda Existe Espaço na Pasta:)</option>
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `pastas_arquivo_passivo` ORDER BY `PASTA`");
                                while ($linha = mysqli_fetch_array($Consulta)) {
                                    $id = $linha['id'];
                                    $pasta = $linha['pasta'];
                                    $cheio = $linha['cheio'];
                                    if ($cheio == "SIM") {
                                        $cheio = "Arquivo Físico Cheio! Por Favor Verifique.";
                                    } else {
                                        $cheio = "";
                                    }
                                    //
                                    $sql = mysqli_query($Conexao, "SELECT *,COUNT(*) AS cont FROM `alunos` WHERE `excluido` LIKE 'S' AND ap_pasta LIKE '$pasta'");
                                    while ($result = mysqli_fetch_array($sql)) {
                                        $cont = $result['cont'];
                                        $txt = "Aluno(s)";
                                        //
                                    }
                                    //
                                    echo "<option value = '$pasta'>$pasta - $cont  $txt - $cheio</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9" >
                            <button type="submit"  name="Arquivo_Passivo" value="Arquivo_Passivo" class="btn btn-danger" onclick='return confirmarMover()' >Mover para a Pasta</button>
                        </div>
                    </div><br>                                
                </div>
                <!--Coringa Início-->        <!--Coringa Início-->       <!--Coringa Início-->
                <div id="coringa" style="background-color: #31B0D5; "><br>
                    <div class="container">
                        <div class="form-group col-sm-12">                                
                            <label for="inputEstado" class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputEstado" name="inputEstado" onkeyup="maiuscula(this)">
                            </div>    
                        </div>
                        <div class="form-group col-sm-12"> 
                            <label for="inputNaturalidade" class="col-sm-2 control-label">Naturalidade</label>
                            <div class="col-sm-4">                              
                                <input type="text" class="form-control" id="inputNaturalidade" name="inputNaturalidade" onkeyup="maiuscula(this)">
                            </div> 
                        </div>                           
                        <div class="form-group col-sm-12">
                            <label for="inputSexo" class="col-sm-2 control-label">Sexo</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputSexo" id="inputSexo">
                                    <option value="">INDIQUE O SEXO DO ESTUDANTE</option>
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMININO</option>
                                </select>
                            </div>            
                        </div>  
                        <div class="form-group col-sm-12">
                            <label for="inputOuvinte" class="col-sm-2 control-label">Ouvinte</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputOuvinte" id="inputOuvinte">
                                    <option value="">INDIQUE SE É OUVINTE OU NÃO</option>
                                    <option value="SIM">SIM</option>
                                    <option value="NÃO">NÃO</option>
                                </select>
                            </div>            
                        </div>  
                        <div class="form-group col-sm-12">                                
                            <label for="inputEstado" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">                         
                                <button type="submit"  name="coringa" value=""class="btn btn-success" onclick='return confirmarAtualizacao()'>Alterar</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!--Coringa Fim-->
                <!--Transpoprte-->            
                <div id="divConteudoTransporte" style="background-color: #449D44;"><br>
                    <div class="row">
                        <div class="container">   
                            <label for="" class="col-sm-2 control-label">Escolha Entre:</label>
                            <div class="col-sm-4 ">                                  
                                <label class="radio-inline"><input type="radio" name="optUrbano" checked value="SIM" style=" margin-left: -40px !important">&nbsp;&nbsp;Urbano</label>
                                <label class="radio-inline">ou &nbsp;&nbsp;</label>
                                <label class="radio-inline"><input type="radio" name="optUrbano" value="NAO" style=" margin-left: -40px !important">&nbsp;&nbsp;Rural</label>                       
                            </div>                               
                        </div>
                    </div>
                    <br>
                    <div class="row">                       
                        <div class="container"> 
                            <label for="" class="col-sm-3 control-label"></label>
                            <div class="col-sm-8">                            
                                <button type="submit"  name="urbano" value="urbano"class="btn btn-primary btn-block" onclick='return confirmarAtualizacao()'>Atualizar os Dados da Localidade</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="container">                               
                            <label for="inputMotorista" class="col-sm-2 control-label">Motorista</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputMotorista" id="inputMotorista" >
                                    <?php
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE funcao = 'MOTORISTA' ORDER BY nome");
                                    echo "<option  value = '--------'>SELECIONE O MOTORISTA ! </option>";
                                    echo "<option  value = '--------'>--------</option>";
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $motorista = $Registro["nome"];
                                        echo "<option>$motorista</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="inputMotorista2" class="col-sm-2 control-label">Motorista II</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputMotorista2" id="inputMotorista2" >
                                    <?php
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE funcao = 'MOTORISTA' ORDER BY nome");
                                    echo "<option value = '--------'>SELECIONE O MOTORISTA ! </option>";
                                    echo "<option value = '--------'>--------</option>";
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $motorista = $Registro["nome"];
                                        echo "<option>$motorista</option>";
                                    }
                                    ?>
                                </select>
                            </div>                           
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="container">
                            <label for="inputPonto" class="col-sm-2 control-label">Pontos de Ônibus</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="" id="" >
                                    <?php
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos_transporte`");
                                    echo "<option selected = '' value = ''>PONTOS DE ÔNIBUS CONHECIDOS</option>";
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $ponto_onibus = $Registro["ponto_onibus"];
                                        echo "<option>$ponto_onibus</option>";
                                    }
//                                    
                                    ?>
                                </select>
                            </div>
                            <label for="inputPontoAluno" class="col-sm-2 control-label">O Aluno(a) Pega o Ônibus em:</label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="DIGITE O LUGAR ESCOLHIDO OU OUTRO NOVO" class="form-control" id="" name="inputPontoAluno" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <div class="container">  
                            <label for="inputMotorista2" class="col-sm-3 control-label"></label>
                            <div class="col-sm-4">
                                <button type="submit"  name="Transporteincluir" value="SIM"class="btn btn-success btn-block" onclick='return confirmarAtualizacao()'>Incluir Todos No Transporte</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit"  name="Transporteretirar" value="NÃO"class="btn btn-danger btn-block" onclick='return confirmarExclusao()'>Retirar Todos Do Transporte</button>
                            </div>

                        </div>
                    </div>
                    <br>
                </div>
                <!--Transferir-->                       <!--Transferir-->
                <div id="transferir" style="background-color: #9F6635;"><br>
                    <div class="form-group">
                        <label for="inputTranfeir" class="col-sm-3 control-label">Transferir Todos</label> 
                        <button type="submit" name="transferir" value="" class="btn btn-success" onclick='return confirmarTransferencia()' >Transferir</button>
                    </div>  
                    <br>
                </div>
                <!--Transferir Fim-->
                <?php
                echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> SELEÇÃO</th>";
                echo "<th> NOME </th>";
                echo "<th> NASCIMENTO </th>";
                echo "<th id = 'ocultar_2'> MÃE </th>";
                echo "<th id = 'ocultar'> NIS </th>";
                echo "<th id = 'ocultar'> SUS </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach (($_POST['aluno_selecionado']) as $buscar_id) {

                    $Consultaf = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id = '$buscar_id' AND excluido = 'N' ORDER BY nome");
                    $rowf = mysqli_num_rows($Consultaf);

                    if ($rowf > 0) {

                        while ($linhaf = mysqli_fetch_array($Consultaf)) {
                            $nomef = $linhaf['nome'];
                            $data_nascimentof = new DateTime($linhaf['data_nascimento']);
                            $data_nascimentof = date_format($data_nascimentof, 'd/m/Y');
                            $maef = $linhaf['mae'];
                            $nis = $linhaf['nis'];
                            $idf = $linhaf['id'];
                            $susf = $linhaf['sus'];

                            echo "<tr>";
                            echo "<td><input type='checkbox' name='aluno_selecionado[]' class='marcar' value='$idf' checked ></td>\n";
                            echo "<td>" . $nomef . "</td>\n";
                            echo "<td>" . $data_nascimentof . "</td>\n";
                            echo "<td id = 'ocultar_2'>" . $maef . "</td>\n";
                            echo "<td id = 'ocultar'>" . $nis . "</td>\n";
                            echo "<td id = 'ocultar'>" . $susf . "</td>\n";
                            echo "</tr>";
                        }
                    }
                }
                echo "</tbody>";
                echo "</table>";
                ?>                  
            </form>           
        </div>    
        <script>
            function confirmar() {
                var r = confirm('Realmente deseja Salvar as Alterações <?php echo "$usuario_logado" ?>?');
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <script>
            //Cuida do botões dos boletos e de alguns campos da tabela
            $(document).ready(function () {
                $('.radio').change(function () {
                    var radio = $(this).val();
                    if (radio == "option1") {
                        $('#boletos_criar').removeAttr('disabled');
                        $('#boletos_atualizar').attr('disabled', 'disabled');
                        $('#boletos_excluir').attr('disabled', 'disabled');
                        $('.desconto').hide(2000);
                        $('.multa').hide(2000);
                        $('.pago_em').hide(2000);
                        $('.mensalidade').show(2000);
                        $('.bolsista').show(2000);
                        $('.bolsista_valor').show(2000);

                    } else if (radio == "option2") {
                        $('#boletos_atualizar').removeAttr('disabled');
                        $('#boletos_criar').attr('disabled', 'disabled');
                        $('#boletos_excluir').attr('disabled', 'disabled');
                        $('.desconto').show(2000);
                        $('.multa').show(2000);
                        $('.pago_em').show(2000);
                        $('.mensalidade').show(2000);
                        $('.bolsista').show(2000);
                        $('.bolsista_valor').show(2000);
                    } else {
                        $('#boletos_excluir').removeAttr('disabled');
                        $('#boletos_atualizar').attr('disabled', 'disabled');
                        $('#boletos_criar').attr('disabled', 'disabled');
                        $('.desconto').hide(2000);
                        $('.multa').hide(2000);
                        $('.pago_em').hide(2000);
                        $('.mensalidade').hide(2000);
                        $('.bolsista').hide(2000);
                        $('.bolsista_valor').hide(2000);
                    }
                });
            });
        </script>
        <!--Div Turmas-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoBtnTurmas").hide();
                $("#btnMostrarEsconderBtnTurmas").click(function () {
                    $("#divConteudoBtnTurmas").toggle(2000);
                });
            });
        </script>
        <!--Div Turmas Extra-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoTurma_Extra").hide();
                $("#btnMostrarEsconderBtnTurmaExtra").click(function () {
                    $("#divConteudoTurma_Extra").toggle(2000);
                });
            });
        </script>        
        <!--Div Turmas Bolsa Família-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divBolsa_Familia").hide();
                $("#btnMostrarEsconderBtnBolsa").click(function () {
                    $("#divBolsa_Familia").toggle(2000);
                });
            });
        </script>
        <!--Div Arquivo Passivo-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoArquivo").hide();
                $("#btnMostrarEsconderBtnArquivo").click(function () {
                    $("#divConteudoArquivo").toggle(2000);
                });
            });
        </script>
        <!--Div Transporte-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#divConteudoTransporte").hide();
                $("#btnMostrarEsconderBtnTransporte").click(function () {
                    $("#divConteudoTransporte").toggle(2000);
                });
            });
        </script>
        <!--Div Coringa-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#coringa").hide();
                $("#btnMostrarEsconderBtnCoringa").click(function () {
                    $("#coringa").toggle(2000);
                });
            });
        </script>
        <!--Div Transferir-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#transferir").hide();
                $("#btnMostrarEsconderBtnTransferir").click(function () {
                    $("#transferir").toggle(2000);
                });
            });
        </script>
        <!--Div Histórico-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#historico").hide();
                $("#btnMostrarEsconderBtnHistorico").click(function () {
                    $("#historico").toggle(2000);
                });
            });
        </script>
        <!--Div Boletos-->
        <script type="text/javascript">
            $(document).ready(function () {
                $("#boletos").hide();
                $("#btnMostrarEsconderBtnboletos").click(function () {
                    $("#boletos").toggle(2000);
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                var maxLength = '-0.000,00'.length;
                $(".dinheiro").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
            });
        </script>
        <script>
            function confirmarExclusao2() {
                var r = confirm('Realmente deseja Criar esse(s) Histórico(s) <?php echo " $usuario_logado" ?> ? ');
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <script>
            //Cuida do botão de excluir históricos
            $(document).ready(function () {

                $('#inputAno1').change(function () {
                    if ($('#inputAno1').val() !== '') {
                        $('#exclui_historico').removeAttr('disabled');
                    } else {

                        $('#exclui_historico').attr('disabled', 'disabled');
                    }
                });
            });

            //Fim do excluir historicos
            //Cuida do botão criar hisóricos
            $(document).ready(function () {
                $('#inputAno').change(function () {
                    if ($('#inputAno').val() !== '' && $('#ano_turma').val() !== '') {
                        $('#criar_historico').removeAttr('disabled');
                    } else {
                        $('#criar_historico').attr('disabled', 'disabled');
                    }
                });
            });
            $(document).ready(function () {
                $('#ano_turma').change(function () {
                    if ($('#inputAno').val() !== '' && $('#ano_turma').val() !== '') {
                        $('#criar_historico').removeAttr('disabled');
                    } else {
                        $('#criar_historico').attr('disabled', 'disabled');
                    }
                });
            });
        </script>
        <script type="text/javascript">
            function confirmarMover() {
                var r = confirm("Realmente deseja Mover esse Aluno");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <script type="text/javascript">
            function confirmarTransferencia() {
                var r = confirm("Realmente deseja Transferir esse(s) Aluno(s) <?php echo "$usuario_logado"; ?> ?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <script type="text/javascript">
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }

        </script>
    </body> 
</html>

