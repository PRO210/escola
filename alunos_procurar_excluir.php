<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?> 
        <title></title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?> 
        <div class="container-fluid">
            <div class="row">
                <div class="starter-template" >
                    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script> 
                    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
                    <h3 style="text-align: center">Procurar Cadastros:</h3>
                    <form name="pesquisar" class="form-horizontal" method="post" action= "pesquisar_no_banco.php" >
                        <div class="form-group">
                            <label for="inputStatus" class="col-sm-4 control-label">Status</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputStatus" id="inputStatus">
                                    <?php
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `status_alunos` WHERE `relatorio` = 'S' ORDER BY id");
                                    //
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        //                                     
                                        echo "<option>" . $Registro['status_aluno'] . "</option>";
                                    }
                                    echo "<option selected value = 'cursando'>CURSANDO OU ADIMITIDO DEPOIS</option>";
                                    echo "<option  value = 'fora'> TRANSFERIDO OU DESISTENTE </option>";
                                    echo "<option  value = 'branco'>QUALQUER STATUS</option>";
                                    ?>    
                                </select>                   
                            </div> 
                        </div>                 
                        <div class="form-group">
                            <label for="inputTurma" class="col-sm-4 control-label">Turma/NIS</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="inputturmaf" id="inputturmaf" >
                                    <option value = ""> TODAS AS TURMAS</option>
                                    <option value="2"> NÚMERO DO NIS</option>
                                    <?php
                                    $ano = date('Y');
                                    $ano_passado = date('Y', strtotime('-361 days', strtotime($ano)));
                                    $ano_futuro = date('Y', strtotime('+362 days', strtotime($ano)));
                                    //
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma_extra` = 'NÃO' AND `STATUS` = 'OCUPADA' ORDER BY `ano` DESC, turma ASC");
//                                  
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $turma = $Registro["turma"];
                                        $turno = $Registro["turno"];
                                        $id_turma = $Registro["id"];
                                        $ano_turma = substr($Registro["ano"], 0, -6);

                                        //                                        
                                        if ($ano_turma == "2018") {
                                            $unico_turma = "";
                                        } else {
                                            $unico_turma = $Registro["unico"];
                                        }
                                        //
                                        if ($ano_turma == "$ano_futuro") {
                                            echo "<option value = '$id_turma'>$turma $unico_turma ($turno) $ano_futuro - Futuro</option>";
                                        } elseif ($ano_turma == "$ano") {
                                            echo "<option value = '$id_turma'>$turma $unico_turma ($turno) $ano - Atual</option>";
                                        } else {
                                            echo "<option value = '$id_turma'>$turma $unico_turma ($turno) $ano_passado - Passado</option>";
                                        }
                                    }
                                    ?>
                                </select>                                
                            </div>
                        </div>
                        <!--Turmas-->
                        <div id="turmas" >
                            <div class="form-group">
                                <label for="inputNome"  class="col-sm-4 control-label">Nome do Aluno</label>                             
                                <div class="col-sm-4">
                                    <input type="text" name="inputNome" class="form-control" placeholder="NOME DO ALUNO"  id="inputNome" />
                                </div>
                            </div>
                        </div>
                        <!--NIS-->
                        <div id="nis">
                            <div class="form-group">
                                <label for="inputNis"  class="col-sm-4 control-label">Número do NIS</label>
                                <div class="col-sm-4">                                    
                                    <script type="text/javascript" >
                                        $(function () {
                                            $("#inputNis").mask("999.9999.9999", {reverse: true});
                                        });
                                    </script>
                                    <input type="text" name="inputNis" class="form-control" placeholder="Digiteo Número do NIS" id="inputNis"  />
                                </div>
                            </div>
                        </div>                      

                        <div class="form-group">                               
                            <label for="inputEstado" class="col-sm-4 control-label">Estado</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="inputEstado" name="inputEstado"  onkeyup="maiuscula(this)">
                                    <?php
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `tb_estados` ORDER BY `nome`");
                                    echo "<option selected value = ''>SELECIONE O ESTADO DA NASCIMENTO ! </option>";
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $cidade_nome = strtoupper($Registro["nome"]);
                                        $estado_id = $Registro["id"];
                                        echo "<option value = '$estado_id'>$cidade_nome</option>";
                                    }
                                    ?>
                                </select>
                            </div>                               
                        </div>  
                        <div class="form-group">  
                            <label for="inputNaturalidade" class="col-sm-4 control-label">Naturalidade</label>
                            <div class="col-sm-4">                              
                                <select class="form-control" id="inputNaturalidade" name="inputNaturalidade" >
                                    <option id="txtnaturalidade" disabled="" selected="">SELECIONE UM ESTADO ANTES</option>

                                </select>                               
                            </div>  
                        </div> 
                        <div class="form-group"> 
                            <label for="" class="col-sm-4 control-label"></label>
                            <div class="col-sm-2">                         
                                <button type="submit" value="" class="btn btn-success btn-block" id="" >Pesquisar</button>  
                            </div>    
                            <div class="col-sm-2">                         
                                <button type="reset" class="btn btn-danger btn-block" id="reset">Limpar</button>
                            </div> 
                        </div> 
                    </form>
                </div>
            </div>
        </div>  
    </body>
    <script>//                         
        $("#inputEstado").on("change", function () {
            //
//            $('#inputNaturalidade2 option:selected').text();
//            var $uf = $("#inputNaturalidade2").val();
//            var $texto = $('#inputNaturalidade2 option:selected').text();
//            var $uf2 = $texto.replace("/" + $uf, "");
//            $("#inputNaturalidade").val($uf2);
//                                alert($texto);//                                
//                                alert($uf2);

            $.ajax({
                url: 'pega_cidades.php',
                type: 'POST',
                data: {id: $("#inputEstado").val()},
                //
                beforeSend: function (data) {

                    $("#txtnaturalidade").css({'display': 'none'});
                    $("#inputNaturalidade").html("Carregando...");
                },
                success: function (data)
                {
                    //$("#cidades").css({'display': 'block'});
                    $("#inputNaturalidade").html(data);
                },
                error: function (data)
                {
                    // $("#inputEstado").css({'display': 'block'});
                    $("#inputNaturalidade").html("Houve um erro ao carregar");
                }
            });

        });//                           
    </script>
    <script type="text/javascript">
        $("#reset").on('click', function () {
            location.reload();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#nis').hide();
            $('#inputturmaf').change(function () {

                if ($('#inputturmaf').val() == '') {
                    $('#nis').hide();
                    $('#turmas').show();

                } else if ($('#inputturmaf').val() == '2') {
                    $('#turmas').hide();
                    $('#nis').show();

                } else {
                    $('#turmas').show();
                    $('#nis').hide();

                }
            });
        });
    </script>  
</html>