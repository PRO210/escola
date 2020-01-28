<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_aluno = base64_decode($Recebe_id);

$Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$id_aluno' ");
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$nome = $Linha['nome'];
$turmaf = $Linha['turma'];
//
$SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
$Consulta_turma = mysqli_query($Conexao, $SQL_turma);
$Linha_turma = mysqli_fetch_array($Consulta_turma);
//
$ano_turma = substr($Linha_turma["ano"], 0, -6);
$nome_turma = $Linha_turma["turma"];
$turno_turma = $Linha_turma["turno"];
//
if ($ano_turma == "2018") {
    $unico_turma = "";
} else {
    $unico_turma = $Linha_turma["unico"];
}
$turma = "$nome_turma $unico_turma ($turno_turma)";
//
$status = $Linha['status'];
//
$Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_aluno_solicitacao` = '$id_aluno' ");
$rowf = mysqli_fetch_array($Consultaf);
$idf_recebe = $rowf['id_aluno_solicitacao'];
//
$Msg = "";
$M = "";
session_start();
if (empty($_SESSION['erro'])) {
    session_destroy();
} elseif ($_SESSION['erro'] == '1') {
    echo "<script type='text/javascript'>
                alert('Esse Histórico já foi Cadastrado!');
          </script>";
    session_destroy();
} elseif ($_SESSION['erro'] == '2') {
    echo "<script type='text/javascript'>
                alert('Ops! O Campo Ano foi enviado em Branco.');
          </script>";
    session_destroy();
    //
} elseif ($_SESSION['erro'] == '3') {
    echo "<script type='text/javascript'>
                alert('Operações Realizadas Com Sucesso!');
          </script>";
    session_destroy();
} elseif ($_SESSION['erro'] == '4') {
    echo "<script type='text/javascript'>
                alert('Falha na Operação. Contate o Administrador!');
          </script>";
    session_destroy();
} elseif ($_SESSION['erro'] == '5') {
    $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Existe pelo menos um pedido de Transferência Pendente! </div>";
    $M = "2";
    session_destroy();
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CADASTRAR HISTÓRICO</title>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/cadastrar_historico.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_historico.js" type="text/javascript"></script>
    </head>
    <body>       
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <!--Modal-->                <!--Modal-->            <!--Modal-->        
        <div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo $Msg;
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div> 
        <?php
        if ($M == "1") {
            echo"<script type='text/javascript'>
                $(document).ready(function () {
                   $('#exemplomodal').modal('show');
               });
                
            </script>";
        } elseif ($M == "2") {
            echo"<script type='text/javascript'>

                $(document).ready(function () {
                    $('#exemplomodal').modal('show');
                });
            </script>";
        }
        ?>
        <div class="container-fluid"> 
            <form class="form-inline" action="cadastrar_historico_server.php" method="post" name="form">
                <input type="hidden" class="form-control" id="" name="inputId" value="<?php echo($id_aluno) ?>" >
                <h4 style="text-align: center">HISTÓRICO DO(A) ALUNO(A)&nbsp;: &nbsp;<b><?php echo"$nome" ?>&nbsp;</b>Turma Atual &nbsp;: <b><?php echo"$turma" ?></b></h4>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-5">                   
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" colspan="2">NOVO HISTÓRICO</th>
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
                                                <option value="2016-3">2016 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2017">2017 - Primeiro Histórico</option>
                                                <option value="2017-2">2017 Segundo Histórico</option>
                                                <option value="2017-3">2017 Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2018">2018 - Primeiro Histórico</option>
                                                <option value="2018-2">2018 Segundo Histórico</option>
                                                <option value="2018-3">2018 Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2019">2019 - Primeiro Histórico</option>
                                                <option value="2019-2">2019 Segundo Histórico</option>
                                                <option value="2019-3">2019 Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2020">2020 - Primeiro Histórico</option>
                                                <option value="2020-2">2020 Segundo Histórico</option>
                                                <option value="2020-3">2020 Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2021">2021 - Primeiro Histórico</option>
                                                <option value="2021-2">2021 Segundo Histórico</option>
                                                <option value="2021-3">2021 Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2022">2022 - Primeiro Histórico</option>
                                                <option value="2022-2">2022 - Segundo Histórico</option>
                                                <option value="2022-3">2022 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2023">2023 - Primeiro Histórico</option>
                                                <option value="2023-2">2023 - Segundo Histórico</option>
                                                <option value="2023-3">2023 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2024">2024 - Primeiro Histórico</option>
                                                <option value="2024-2">2024 - Segundo Histórico</option>
                                                <option value="2024-3">2024 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2025">2025 - Primeiro Histórico</option>
                                                <option value="2025-2">2025 - Segundo Histórico</option>
                                                <option value="2025-3">2025 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2026">2026 - Primeiro Histórico</option>
                                                <option value="2026-2">2026 - Segundo Histórico</option>
                                                <option value="2026-3">2026 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2027">2027 - Primeiro Histórico</option>
                                                <option value="2027-2">2027 - Segundo Histórico</option>
                                                <option value="2027-3">2027 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2028">2028 - Primeiro Histórico</option>
                                                <option value="2028-2">2028 - Segundo Histórico</option>
                                                <option value="2028-3">2028 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2019">2019 - Primeiro Histórico</option>
                                                <option value="2029-2">2029 - Segundo Histórico</option>
                                                <option value="2029-3">2029 - Terceiro Histórico</option>
                                                <option disabled=""></option>
                                                <option value="2030">2030 - Primeiro Histórico</option>  
                                                <option value="2030-2">2030 - Segundo Histórico</option>
                                                <option value="2030-3">2030 - Terceiro Histórico</option>
                                            </select>
                                        </th>                                
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
                                        <td colspan="2"><input id = 'input_escola' type = 'text' name = 'inputTurma' placeholder = 'Turma' onkeyup='maiuscula(this)'></td>                             
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
                                        . "&nbsp;&nbsp;<button disabled = '' id = 'criar_historico' type='submit' value='criar' name = 'botao' class='btn btn-success  btn-block' onclick = 'return confirmarExclusao2()' >CRIAR NOVO HISTÓRICO</button>"
                                        . "</th>";
                                        ?>                       
                                        <?php
                                        echo "<th>"
                                        . "&nbsp;&nbsp;<button type='reset' value='' name ='botao' class='btn btn-danger  btn-block'>&nbsp;&nbsp;LIMPAR OS CAMPOS DIGITADOS</button>"
                                        . "</th>";
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>      
                        <!--Busca Por historicos//-->
                        <div class="col-sm-3">
                            <?php
                            $Consulta_historico = mysqli_query($Conexao, "SELECT * FROM `bimestre_i` WHERE `id_bimestreI_aluno` = '$id_aluno'  GROUP BY `ano`");
                            $Linha_historico = mysqli_num_rows($Consulta_historico);
                            if ($Linha_historico > 0) {
                                ?>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center" colspan="2">HISTÓRICO DAS NOTAS DO ALUNO POR ANO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <select class='form-control' name='inputAno1' style="width: 100% !important" id="inputAno1">   
                                                    <?php
                                                    echo "<option  selected = '' value = ''>Escolha o Ano Para Visualizar</option>";
                                                    while ($registro = mysqli_fetch_array($Consulta_historico, MYSQLI_BOTH)) {
                                                        $ano = $registro['ano'];
                                                        echo "<option>$ano</option>";
                                                    }
                                                    ?>
                                                </select>                                        
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                            if ($Linha_historico > 0) {
                                                echo "<td>&nbsp;&nbsp;<button type='submit' value='pesquisar' name ='botao' class='btn btn-success  btn-block'>Pesquisar</button></td>";
                                                echo "<td>&nbsp;&nbsp;<button  id = 'exclui_historico' type='submit' value='exclui_historico' name ='botao' class='btn btn-danger  btn-block' disabled = '' onclick = 'return confirmarExclusao()'>Excluir</button></td>";
                                            } else {
                                                echo "<td>&nbsp;&nbsp;<button type='submit' value='pesquisar' name ='botao' class='btn btn-success  btn-block' disabled = ''>Pesquiar</button></td>";
                                                echo "<td>&nbsp;&nbsp;<button  id = 'exclui_historico' type='submit' value='exclui_historico' name ='botao' class='btn btn-danger  btn-block' disabled = ''>Excluir</button></td>";
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                
                            }
                            ?>
                        </div>  
                        <div class="col-sm-4">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" class="text-success text-center" colspan="3">SOLICITAR TRANSFERÊNCIA</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th colspan="3">                                    
                                        <?php
                                        $Consulta_transferencia = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_aluno_solicitacao` = '$id_aluno' ");
                                        $Linha_Cont = mysqli_num_rows($Consulta_transferencia);
                                        //        
                                        if ($Linha_Cont > 0) {
                                            //
                                            $ano_atual = date('Y');
                                            $Consulta_transferencia2 = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_aluno_solicitacao` = '$id_aluno' AND entregue LIKE 'N'");
                                            $Linha_Cont2 = mysqli_num_rows($Consulta_transferencia2);
                                            $Linha_tranferencia2 = mysqli_fetch_array($Consulta_transferencia2);
                                            //
                                            if ($Linha_Cont2 > 0) {
                                                $none = "none";
                                                $ano = substr($Linha_tranferencia2['data_solicitacao'], 0, -6);
                                                if ($ano == "$ano_atual") {
                                                    $txt = "Já Existe Pedido(s) de Transferência para Ano: $ano_atual ! Por Favor Consulte:)";
                                                    echo "<p style = 'text-align:center;' class='text-danger'>$txt</p>";
                                                } else {
                                                    $txt = "Já Existe Pedido(s) de Transferência para Esse Aluno(a)! Por Favor Consulte:)";
                                                    echo "<p style = 'text-align:center;' class='text-danger'>$txt</p>";
                                                }
                                            } else {
                                                $txt = "Existe Transferência(s) Pronta(s) para Esse Aluno(a)! Por Favor Consulte:) Antes de Fazer Outro Pedido:)";
                                                echo "<p style = 'text-align:center;' class='text-warning'>$txt</p>";
                                            }
                                        } else {
                                            $none2 = "none";
                                            $txt = "Não Existe Pedidos de Transferência(s) para Esse Aluno(a)! Caso Precise Solicite:)";
                                            echo "<p style = 'text-align:center;' class='text-warning'>$txt</p>";
                                        }
                                        ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3">
                                        <input style="width: 100%" type="text" name="inputSolicitante" id="idSolicitante" placeholder="Nome do(a) Solicitante" onkeyup="maiuscula(this)">
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3">
                                        <input id="idData" type="date" name="inputData">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="display: <?php echo $none ?>">&nbsp;<button type='submit' value='pedir' name ='botao' class='btn btn-success  btn-block' onclick= 'return confirmarPedido()'>&nbsp;&nbsp;Solicitar&nbsp;&nbsp;</button></th>
                                    <th style= "display: <?php echo $none2 ?>">&nbsp;&nbsp;<button type='submit' value='consultar' name ='botao' class='btn btn-primary btn-block ' >&nbsp;&nbsp; Consultar &nbsp;&nbsp;</button> </th>
                                    <th>&nbsp;&nbsp;<button type='reset' value='' name ='botao' class='btn btn-danger btn-block '>&nbsp;&nbsp;Limprar&nbsp;&nbsp;</button></th>
                                </tr>
                            </table>
                        </div>                
                    </div> 
                </div>
                <div class="row">
                    <div class=" col-sm-4 col-sm-offset-2" >
                        <input type="button" value="Voltar Para a Página Anterior" class="btn btn-primary btn-block botoes" onClick=" window.history.back()">            
                    </div>              
                    <div class=" col-sm-4 " >
                        <a href="principal.php"><button type="button" value="" class="btn btn-success btn-block botoes">Menu Principal</button>      </a>      
                    </div>              
                </div>              
            </form>    
        </div> 
    </body>
    <script type="text/javascript">
        $('input').on("input", function (e) {
            $(this).val($(this).val().replace('"', ""));
            $(this).val($(this).val().replace("'", ""));
            $(this).val($(this).val().replace("º", ""));
            $(this).val($(this).val().replace("°", ""));
        });
    </script>
    <script type="text/javascript">
        //idSolicitante
        function confirmarPedido() {
            var valor = $('#idSolicitante').val();
            var valorData = $('#idData').val();
            if (valor == "" && valorData == "") {
                alert('Por Favor Especifique o nome do Solicitante ou a Data Solicitação');
                return false;
                //
            } else {
                //
                var r = confirm("Realmente deseja Pedir uma Transferência?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    </script>  
    <script type="text/javascript">
        function change() {
            var textoOptionSelecionado = $('#Ano option:selected').text(); // armazendando em variavel
            // alert("Texto do option selecionado: " + textoOptionSelecionado); // mostrando um alerta na tela
            if (textoOptionSelecionado == "Selecione o Ano") {
                alert("O Campo Ano não Pode ser Enviado em Branco!");
                return false;
            }
        }

    </script>
    <script>
        // INICIO FUNÇÃO DE MASCARA MAIUSCULA
        function maiuscula(z) {
            v = z.value.toUpperCase();
            z.value = v;
        }
    </script>   
    <script type="text/javascript">
        function confirmarExclusao() {
            var r = confirm("Realmente deseja excluir o Atestado <?php echo "$usuario_logado" ?>?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script>
        function confirmarExclusao2() {
            var r = confirm('Realmente deseja Criar esse Histórico <?php echo "$usuario_logado" ?>?');
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</html>