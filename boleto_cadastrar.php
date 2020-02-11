<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_aluno = base64_decode($Recebe_id);
//
$result = mysqli_query($Conexao, "SELECT * FROM `alunos_pagamentos` WHERE `aluno_id` = '$id_aluno' ");
$row = mysqli_fetch_object($result);
$ContRow = mysqli_num_rows($result);
//
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
$unico_turma = $Linha_turma["unico"];
$turma = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
//
$Msg = "";
$M = "";
session_start();
if (empty($_SESSION['msg'])) {
    session_destroy();
} elseif ($_SESSION['msg'] == '1') {
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Operações salvas com sucesso! </div>";
    $M = "1";
    session_destroy();
} elseif ($_SESSION['msg'] == '2') {
    $Msg = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ops! Os seus dados não foram salvos com sucesso! </div>";
    $M = "1";
    session_destroy();
}
?>
<html>
    <head>  
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Boletos</title>
        <style>             
            .verde{color: green; padding-bottom: 12px;}
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;
            }
            #esconder_list{display: none; }
            #esconder_bt{display: inline-block; }
            @media (max-width: 1000px) { #esconder_list{ display: inline;}
            }  
            @media (max-width: 1000px) {#esconder_bt{display: none;}
            }                 
            @media (max-width: 1000px) {#ocultar{display: none;}
            }  
            .vbt{ background-color: transparent; border: none;        }                
            .vbtv{ background-color: transparent; border: none;                 
            }
            .esc{ display: none;  }
            #thNome{
                white-space: nowrap;
            }
            @media (max-width: 850px) {#thNome{white-space: normal;}
            }
            .desconto{width: 100px !important}
            .pago{width: 100px !important}
            .mensalidade{width: 120px !important;}           
            .multa{width: 80px !important;}
            .bolsista_valor{width: 150px !important;}

        </style>    

    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid" >  
            <script>
                $(document).ready(function () {
                    $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
                });
            </script>  
            <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <script src="js/jquery-1.12.4.js" type="text/javascript"></script>

            <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="js/cadastrar_validar.js" type="text/javascript"></script>

            <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
            <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script>
            <script src="js/bootstrap.js" type="text/javascript"></script>

            <!--Modal-->                <!--Modal-->            <!--Modal-->        
            <div class="modal fade modal_msg" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
            <!--Fim do Modal-->             <!--Fim do Modal-->

            <?php
            if ($M == "1") {
                echo"<script type='text/javascript'>
                $(document).ready(function () {
                   $('#exemplomodal').modal('show');
               });
                
            </script>";
            }
            ?>
            <!--<script src="assets/js/jquery.min_maskMoney.js" type="text/javascript"></script>-->
            <script src="assets/js/jquery.maskMoney.min.js" type="text/javascript"></script>

            <form name="form1" action="boleto_cadastrar_server.php" method="post" class="form-horizontal" > 
                <!--Modal-->                <!--Modal-->            <!--Modal-->        
                <div class="modal fade" id="exemplomodal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel">Cadastro de Boletos</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">                   
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center" colspan="2">Novo Boleto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>                                
                                                    <th colspan="2">
                                                        <select class="form-control" name="ano" id="ano" onchange="change()" style="width: 100% !important">
                                                            <option  selected="" value="">Selecione o Ano</option>                                           
                                                            <option>2020</option>
                                                            <option>2021</option>
                                                            <option>2022</option>
                                                            <option>2023</option>
                                                            <option>2024</option>
                                                            <option>2025</option>
                                                            <option>2026</option>
                                                            <option>2027</option>
                                                            <option>2028</option>
                                                            <option>2029</option>
                                                            <option>2030</option>
                                                        </select>
                                                    </th>
                                                </tr>
                                                <tr>                                
                                                    <th>
                                                        Data para o Pagamento: <input type="date" name="previsao_pagamento" style="width: 100% !important">
                                                    </th>                                    
                                                </tr>
                                                <tr>                                
                                                    <th>
                                                        Mensalidade:<input class="form-control" type="text" name="mensalidade" id="mensalidade" value="0.00" style="width: 100% !important">
                                                    </th>                                    
                                                </tr>
                                                <tr>                                
                                                    <th>
                                                        Aluno Bolsista: 
                                                        <select class="form-control" name="bolsista" style="width: 100% !important">
                                                            <option>SIM</option>
                                                            <option value="NAO" selected="">NÃO</option>
                                                        </select>
                                                    </th>                                    
                                                </tr>
                                                <tr>                                
                                                    <th>
                                                        Valor da Bolsa:<input class="form-control" type="text" name="bolsista_valor" id="bolsista_valor" value="0.00" style="width: 100% !important">

                                                    </th>                                    
                                                </tr>   
                                                <tr>                                
                                                    <th>
                                                        <button  id ='criar_boleto' disabled=""  type='submit' value='criar' name = 'botao' class='btn btn-success  btn-block' onclick = 'return confirmar()' >Criar Novo Boleto</button>
                                                    </th>                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                                           
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--Fim do Modal-->             <!--Fim do Modal-->
                <div class="container-fluid"> 
                    <input type="hidden" class="form-control"  name="aluno_id" value="<?= $Recebe_id ?>" >
                    <input type="hidden" class="form-control"  name="turma_id" value="<?= $turmaf ?>" >
                    <div class="row">
                        <div class="container-fluid" >  
                            <h4 style="margin: 12px; margin-left: 18px">Boletos de : &nbsp;<b><?php echo"$nome" ?>&nbsp;</b>Turma Atual &nbsp;: <b><?php echo"$turma" ?></b></h4>
                            <?php
                            $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos_pagamentos` WHERE aluno_id = '$id_aluno' ORDER BY `data_pagamento` ASC,`alunos_pagamentos`.`created` DESC ");
                            $rowf = mysqli_num_rows($Consultaf);
                            //
                            echo "<table class='nowrap table table-striped table-bordered ' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>"
                            . "<div class='dropdown'>"
                            . "<input type='checkbox'  class = 'selecionar' />"
                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success ch' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                            . "<li><a><button type='submit' value='excel' name = 'botao' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Excel</a></li>"
                            . "</ul>"
                            . "</div>"
                            . "</th>";
                            echo "<th style = ' white-space: normal;'>ATIVO</th>";
                            echo "<th class = 'pago'>PAGO</th>";
                            echo "<th>MENSALIDADE </th>";
                            echo "<th>PAGAMENTO </th>";
                            echo "<th>PAGO EM </th>";
                            echo "<th>DESCONTO </th>";
                            echo "<th>MULTA</th>";
                            echo "<th>BOLSISTA</th>";
                            echo "<th>VALOR DA BOLSA</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tfoot>";
                            echo "<tr>";
                            echo "<th></th>";
                            echo "<th style = ' white-space: normal;'>ATIVO</th>";
                            echo "<th class = 'pago'>PAGO</th>";
                            echo "<th>MENSALIDADE</th>";
                            echo "<th>PAGAMENTO</th>";
                            echo "<th>PAGO EM</th>";
                            echo "<th class = 'desconto'>DESCONTO</th>";
                            echo "<th>MULTA</th>";
                            echo "<th>BOLSISTA</th>";
                            echo "<th>VALOR DA BOLSA</th>";
                            echo "</tfoot>";
                            echo "<tbody>";
                            //
                            //
                            while ($linhaf = mysqli_fetch_array($Consultaf)) {
                                //
                                $id = $linhaf['id'];
                                $codigo = $linhaf['codigo'];
                                $ativo = $linhaf['ativo'];
                                $pago = $linhaf['pago'];
                                $mensalidade = $linhaf['mensalidade'];
                                $data_pagamento = $linhaf['data_pagamento'];
                                $pago_em = $linhaf['pago_em'];
                                $bolsista = $linhaf['bolsista'];
                                $bolsista_valor = $linhaf['bolsista_valor'];
                                $desconto = $linhaf['desconto'];
                                $multa = $linhaf['multa'];


                                echo "<td ></td>";
                                if ($ativo == "SIM") {
                                    echo "<td id = 'thNome' style = 'padding-right:0px;'>"
                                    . "<div class='dropdown'>"
                                    . "<input type='checkbox' name='aluno_selecionado[]' id ='' class ='checkbox btmais' value='$id'>"
//                                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
//                                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
//                                    //                                . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
//                                    //                                . "<li $display4><a><button type ='submit' onclick= 'validaCheckbox2();return validaCheckbox()' name = 'turma_transferidos' value = '$idf' class='btn btn-link arquivo' title = 'Mover para Arquivo Passivo' style='text-decoration: none;color: black;margin-left: -12px;'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></button>Mover para o Arquivo Passivo</a></li>"
//                                    . "</ul>"
                                    . "&nbsp;&nbsp;"
                                    . "<select name='ativo[]' class='todos form-control' disabled='' id='$id' >"
                                    . "<option selected= ''>SIM</option>"
                                    . "<option  value='NAO' >NÃO</option>"
                                    . "</select>"
                                    . "</div>"
                                    . "</td>";

                                } else {
                                    echo "<td id = 'thNome' style = 'padding-right:0px;'>"
                                    . "<div class='dropdown'>"
                                    . "<input type='checkbox' name='aluno_selecionado[]' id ='' class ='checkbox btmais' value='$id'>"
//                                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
//                                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
//                                    //                                . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
//                                    //                                . "<li $display4><a><button type ='submit' onclick= 'validaCheckbox2();return validaCheckbox()' name = 'turma_transferidos' value = '$idf' class='btn btn-link arquivo' title = 'Mover para Arquivo Passivo' style='text-decoration: none;color: black;margin-left: -12px;'><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span></button>Mover para o Arquivo Passivo</a></li>"
//                                    . "</ul>"
                                    . "&nbsp;&nbsp;"
                                    . "<select name='ativo[]' class='todos form-control' disabled='' id='$id' >"
                                    . "<option >SIM</option>"
                                    . "<option selected= '' value='NAO' >NÃO</option>"
                                    . "</select>"
                                    . "</div>"
                                    . "</td>";
                                }

                                if ($pago == "SIM") {
                                    ?>
                                    <td>
                                        <select name="pago[]" class="todos form-control <?= 'pag' . $id ?>" disabled="" id="<?= $id ?>">
                                            <option selected="">SIM</option>
                                            <option value="NAO">NÃO</option>
                                        </select>
                                    </td>
                                <?php } else {
                                    ?>
                                    <td>
                                        <select name="pago[]" class="todos form-control <?= 'pag' . $id ?>" disabled="" id="<?= $id ?>"  >
                                            <option selected="">SIM</option>
                                            <option value="NAO" selected="">NÃO</option>
                                        </select>
                                    </td> 
                                    <?php
                                }
                                $data_pagamento = date_format(date_create($linhaf['data_pagamento']), 'm');
                                $mes = '';
                                switch (date($data_pagamento)) {
                                    case 1: $mes = "Janeiro";
                                        break;
                                    case 2: $mes = "Fevereiro";
                                        break;
                                    case 3: $mes = "Março";
                                        break;
                                    case 4: $mes = "Abril";
                                        break;
                                    case 5: $mes = "Maio";
                                        break;
                                    case 6: $mes = "Junho";
                                        break;
                                    case 7: $mes = "Julho";
                                        break;
                                    case 8: $mes = "Agosto";
                                        break;
                                    case 9: $mes = "Setembro";
                                        break;
                                    case 10: $mes = "Outubro";
                                        break;
                                    case 11: $mes = "Novembro";
                                        break;
                                    case 12: $mes = "Dezembro";
                                        break;
                                }
                                echo "<td><input type = 'text' value = '$mensalidade' name = 'mensalidade[]' disabled class ='mensalidade todos form-control mensalidade$id'></td>\n";
                                echo "<td>" . $mes . "</td>\n";
                                echo "<td><input type = 'date' value = '$pago_em' name = 'pago_em[]' disabled class ='todos form-control pago_em$id'></td>\n";
                                echo "<td><input type = 'text' value = '$desconto' name = 'desconto[]' disabled class ='desconto todos form-control desconto$id'></td>\n";
                                echo "<td><input type = 'text' value = '$multa' name = 'multa[]' disabled class ='multa todos form-control multa$id'></td>\n";
                                if ($bolsista == "SIM") {
                                    ?>
                                    <td>
                                        <select name="bolsista[]" class="todos form-control <?= 'bols' . $id ?>" disabled=""  >
                                            <option selected="">SIM</option>
                                            <option value="NAO">NÃO</option>
                                        </select>
                                    </td>
                                <?php } else {
                                    ?>
                                    <td>
                                        <select name="bolsista[]" class="todos form-control <?= 'bols' . $id ?>" disabled="" >
                                            <option selected="">SIM</option>
                                            <option value="NAO" selected="">NÃO</option>
                                        </select>
                                    </td> 
                                    <?php
                                }
                                echo "<td><input type = 'text' value = '$bolsista_valor' name = 'bolsista_valor[]' disabled class ='bolsista_valor todos form-control pago_em$id'></td>\n";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            ?>         

                        </div>
                    </div>
                </div>
            </form>  
            <script>
                $(document).ready(function () {
                    // Setup - add a text input to each footer cell
                    $('#tbl_alunos_lista tfoot th').each(function () {
                        var title = $(this).text();
                        $(this).html('<input type="text" placeholder="' + title + '" />');
                    });
                    //Data Table
                    var table = $('#tbl_alunos_lista').DataTable({
                        //
                        "columnDefs": [{
                                "targets": 0,
                                "orderable": false
                            }],
                        "lengthMenu": [[12, 24, 36, 48, 25, 30, 40, 50, 70, 100, -1], [12, 24, 36, 48, 25, 30, 40, 50, 70, 100, "All"]],
                        "language": {
                            "lengthMenu": "Meses por Página _MENU_ <?php
                            echo "<input type='submit' name = 'botao' disabled = '' value='Atualizar' id ='atualizar' class = 'btn btn-primary' onclick= 'return validaCheckbox()'>"
                            . "&nbsp;&nbsp;<input type='submit' disabled = '' name = 'botao' value='Deletar' id ='retirar' class = 'btn btn-danger' onclick= 'return validaCheckbox()'>"
                            . "&nbsp;&nbsp;<input type='button' name = 'botao' value='Criar' data-toggle= 'modal' data-target='#exemplomodal2' class = 'btn btn-success' onclick= ''>";
                            ?> ",
                            "zeroRecords": "Nenhum Boleto encontrado",
                            "info": "Mostrando pagina _PAGE_ de _PAGES_",
                            "infoEmpty": "Sem registros",
                            "search": "Busca:",
                            "infoFiltered": "(filtrado de _MAX_ total de Boletos)",
                            "paginate": {
                                "first": "Primeira",
                                "last": "Ultima",
                                "next": "Proxima",
                                "previous": "Anterior"
                            },
                            "aria": {
                                "sortAscending": ": ative a ordenação cressente",
                                "sortDescending": ": ative a ordenação decressente"
                            }

                        },
                        responsive: true
                    });
                    // Apply the search
                    table.columns().every(function () {
                        var that = this;
                        $('input', this.footer()).on('keyup change', function () {
                            if (that.search() !== this.value) {
                                that
                                        .search(this.value)
                                        .draw();
                            }
                        });
                    });
                }
                );
            </script> 
            <script language="javascript">
                function validaCheckbox() {
                    //
                    var frm = document.form1;
                    //Percorre os elementos do formulário
                    for (i = 0; i < frm.length; i++) {
                        //Verifica se o elemento do formulário corresponde a um checkbox 
                        if (frm.elements[i].type == "checkbox") {
                            //Verifica se o checkbox foi selecionado
                            if (frm.elements[i].checked) {
                                //alert("Exite ao menos um checkbox selecionado!");
                                return true;
                            }
                        }
                    }
                    alert("Nenhum Boleto foi selecionado!");
                    return false;
                }
            </script>      
            <script>
                $(document).ready(function () {
                    var maxLength = '-0.000,00'.length;
                    $(".desconto").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
                    $(".multa").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
                    $("#mensalidade").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
                    $(".mensalidade").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
                    $(".bolsista_valor").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
                    $("#bolsista_valor").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');

                });
            </script>
            <script type="text/javascript">
                function change() {
                    var texto = $('#ano option:selected').text();
                    if (texto == 'Selecione o Ano') {
                        $('#criar_boleto').attr('disabled', 'disabled');
                    } else {
                        $('#criar_boleto').removeAttr('disabled');
                    }
                }
            </script>
            <script>
                function confirmar() {
                    var r = confirm('Realmente deseja Criar esse Boleto <?php echo "$usuario_logado" ?>?');
                    if (r == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>
            <script type="text/javascript">
                //Marcar ou Desmarcar todos os checkbox
                $(document).ready(function () {
                    $('.selecionar').click(function () {
                        if (this.checked) {
                            $('.checkbox').each(function () {
                                this.checked = true;
                            });
                            $('#atualizar').removeAttr('disabled');
                            $('#retirar').removeAttr('disabled');
                            $(".todos").removeAttr('disabled');
//                            
                        } else {
                            $('.checkbox').each(function () {
                                this.checked = false;
                            });
                            $('#atualizar').attr('disabled', 'disabled');
                            $('#retirar').attr('disabled', 'disabled');

                            $(".todos").attr('disabled', 'disabled');//                           
                        }
                    });
                });
            </script>
            <script type="text/javascript">
                //
                $(document).ready(function () {
                    $('.btmais').click(function () {
                        var valor = $(this).val();
                        if (this.checked) {
                            $("#" + valor + "").removeAttr('disabled');
                            $(".mensalidade" + valor + "").removeAttr('disabled');
                            $(".desconto" + valor + "").removeAttr('disabled');
                            $(".pag" + valor + "").removeAttr('disabled');
                            $(".pago_em" + valor + "").removeAttr('disabled');
                            $(".bols" + valor + "").removeAttr('disabled');
                            $(".bolsista_valor" + valor + "").removeAttr('disabled');
                            $(".multa" + valor + "").removeAttr('disabled');
                        } else {
                            $("#" + valor + "").attr('disabled', 'disabled');
                            $(".mensalidade" + valor + "").attr('disabled', 'disabled');
                            $(".desconto" + valor + "").attr('disabled', 'disabled');
                            $(".pag" + valor + "").attr('disabled', 'disabled');
                            $(".pago_em" + valor + "").attr('disabled', 'disabled');
                            $(".bols" + valor + "").attr('disabled', 'disabled');
                            $(".bolsista_valor" + valor + "").attr('disabled', 'disabled');
                            $(".multa" + valor + "").attr('disabled', 'disabled');

                        }
                    });
                });
            </script>
            <script type="text/javascript">
                $('input[type="checkbox"][name="aluno_selecionado[]"]').on('change', function () {
                    //                       
                    var total = $('input[type="checkbox"][name="aluno_selecionado[]"]:checked').length;
                    //alert($(this).val());                                                         
                    if (total > 0) {
                        $('#atualizar').removeAttr('disabled');
                        $('#retirar').removeAttr('disabled');
                    } else {
                        $('#atualizar').attr('disabled', 'disabled');
                        $('#retirar').attr('disabled', 'disabled');
                    }

                });
            </script>
            <script type='text/javascript'>
                var intervalo = window.setInterval(fechar, 4000);
                function fechar() {
                    $('.modal_msg').modal('hide');
                }
            </script> 
    </body>
</html>



