<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Consultaf = mysqli_query($Conexao, "SELECT alunos_pagamentos.*,alunos.nome  FROM `alunos_pagamentos`,`alunos` WHERE alunos.id = alunos_pagamentos.aluno_id  ORDER BY alunos.nome ASC, `alunos_pagamentos`.`data_pagamento`  ASC ");
$rowf = mysqli_num_rows($Consultaf);
if ($rowf > 0) {
    $disabled = "";
} else {
    $disabled = "disabled";
}
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
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todos os Boletos</title>       
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>          
        <style>
            .verde{color: green; padding-bottom: 12px;}
            .vermelho{ color: red; padding-bottom: 12px;  }
            .amarelo{  color: orange;  padding-bottom: 12px;}
            .azul{ color: blue; padding-bottom: 12px;}
            .rosa{ color: pink; padding-bottom: 12px;}
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
            #esconder_list{display: none; }
            #esconder_bt{display: inline-block; }
            @media (max-width: 825px) { #esconder_list{ display: inline;}
            }  
            @media (max-width: 825px) {#esconder_bt{display: none;}
            }                
            @media (max-width: 825px) {#ocultar{display: none;}
            }  
            .vbt{
                background-color: transparent; border: none;
            }                
            .vbtv{
                background-color: transparent; border: none;                  
            }
            .esc{                display: none;            }
            #thNome{                white-space: nowrap;            }
            @media (max-width: 400px) {#thNome{white-space: normal;}
            }
            .dropdown-menu{font-size: 14px !important;}
            .mensalidade{width: 140px !important;}
            .desconto{width: 120px !important;}
            .multa{width: 80px !important;}
            .bolsista_valor{width: 150px !important;}
            table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                padding: 4px !important;
            }

        </style>    
        <div class="container-fluid" >    
            <h3 style="text-align: center;">TODOS OS BOLETOS</h3>
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
            <!--<script src="assets/js/jquery.min_maskMoney.js" type="text/javascript"></script>-->
            <script src="assets/js/jquery.maskMoney.min.js" type="text/javascript"></script>
            <!--Modal-->                <!--Modal-->            <!--Modal-->        
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
                var intervalo = window.setInterval(fechar, 4000);
                  function fechar() {
                     $('.modal').modal('hide');
                }
            </script>";
            }
            ?>
            <form name="form1" action="boleto_listar_opcoes.php" method="post" class="form-horizontal" > 
                <?php
                echo "<table class='nowrap table table-striped table-bordered ' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>"
                . "<div class='dropdown'>"
                . "<input type='checkbox'  class = 'selecionar' />"
                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success ch' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                . "<li><a><button $disabled type='submit' value='excel' name = 'botao' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Excel</a></li>"
                . "</ul>"
                . "</div>"
                . "</th>";
                echo "<th style = ' white-space: normal;'>NOME</th>";
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
                echo "<th style = ' white-space: normal;'>NOME</th>";
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
                if ($rowf > 0) {
                    //
                    while ($linhaf = mysqli_fetch_array($Consultaf)) {
                        //
                        $id = $linhaf['id'];
                        $aluno_id = $linhaf['aluno_id'];
                        $codigo = $linhaf['codigo'];
                        $pago = $linhaf['pago'];
                        $mensalidade = $linhaf['mensalidade'];
                        $pago_em = $linhaf['pago_em'];
                        $bolsista = $linhaf['bolsista'];
                        $bolsista_valor = $linhaf['bolsista_valor'];
                        $desconto = $linhaf['desconto'];
                        $multa = $linhaf['multa'];
                        $nome = $linhaf['nome'];
                        $data_pagamento = date_format(date_create($linhaf['data_pagamento']), 'm');
                        $mes = '';
                        $ano = date_format(date_create($linhaf['data_pagamento']), 'Y');
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
                        //
                        echo "<td ></td>";
                        echo "<td id = 'thNome' style = 'padding-right:0px;'>"
                        . "<div class='dropdown'>"
                        . "<input type='checkbox'  name='aluno_selecionado[]' id ='' class ='checkbox btmais' value='$id'>"
                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                        . "<li><a href='impressao.php?id=$aluno_id' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                        . "<li><a href='declaracoes_bolsa_familia.php?id=$aluno_id' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>"
                        . "<li><a href='cadastrar_update.php?id=" . base64_encode($aluno_id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>"
                        . "<li><a href='cadastrar_historico.php?id=" . base64_encode($aluno_id) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>"
                        . "<li><a href='boleto_cadastrar.php?id=" . base64_encode($aluno_id) . "' target='_blank' title='Boleto'><span class='glyphicon glyphicon-piggy-bank' aria-hidden='true'>&nbsp;</span>Boletos</a></li>"
                        . "</ul>"
                        . "&nbsp;&nbsp;$nome"
                        . "</div>";
                        if ($pago == "SIM") {
                            echo '<td> SIM</td>';
                            ?>
            <!--                            <td>
                                            <select name="pago[]" class="todos form-control" disabled="" id="<?= $id ?>">
                                                <option selected="">SIM</option>
                                                <option value="NAO">NÃO</option>
                                            </select>
                                        </td>-->
                        <?php
                        } else {
                            echo '<td> NÃO</td>';
                            ?>
            <!--                            <td>
                                            <select name="pago[]" class="todos form-control" disabled="" id="<?= $id ?>"  >
                                                <option selected="">SIM</option>
                                                <option value="NAO" selected="">NÃO</option>
                                            </select>
                                        </td> -->
                            <?php
                        }
                        echo "<td ><input type = 'text' value = '$mensalidade' name = 'mensalidade[]' disabled class ='mensalidade todos form-control mensalidade$id'></td>\n";
                        echo "<td>" . $mes . '/' . $ano . "</td>\n";
                        echo "<td><input type = 'date' value = '$pago_em' name = 'pago_em[]' disabled class ='todos form-control pago_em$id'></td>\n";
                        echo "<td><input type = 'text' value = '$desconto' name = 'desconto[]' disabled class ='desconto todos form-control desconto$id'></td>\n";
                        echo "<td><input type = 'text' value = '$multa' name = 'multa[]' disabled class ='multa todos form-control multa$id'></td>\n";
                        if ($bolsista == "SIM") {
                            echo '<td>SIM</td>';
                            ?>
            <!--                            <td>
                                            <select name="bolsista[]" class="todos form-control <?= 'bols' . $id ?>"   >
                                                <option selected="">SIM</option>
                                                <option value="NAO">NÃO</option>
                                            </select>
                                        </td>-->
                        <?php
                        } else {
                            echo '<td>NÃO</td>';
                            ?>
            <!--                            <td>
                                            <select name="bolsista[]" class="todos form-control <?= 'bols' . $id ?>"  >
                                                <option selected="">SIM</option>
                                                <option value="NAO" selected="">NÃO</option>
                                            </select>
                                        </td> -->
                            <?php
                        }
                        echo "<td><input type = 'text' value = '$bolsista_valor' name = 'bolsista_valor[]' disabled class ='bolsista_valor todos form-control pago_em$id'></td>\n";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    ?>
                    <h1>Nenhum Registro Encontrado :)</h1>
                    <?php
                }
                ?>       
            </form>  
        </div>        
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
                        "lengthMenu": [[12, 24, 36, 48, 60, 72, 100, -1], [12, 24, 36, 48, 60, 72, 100, "All"]],
                        "language": {
                            "lengthMenu": " _MENU_ <?php
//            echo "&nbsp;&nbsp;<a href='cadastrar.php' target='_self' class = 'btn btn-success' id = 'esconder_bt'>Novato</a></span>"
//                echo "&nbsp;<a href='cadastrar_transferido.php' target='_self' class = 'btn btn-success' id = 'esconder_bt'>Cadastrar</a>"
                echo "<button type='button' class='btn btn-link btn-lg verde glyphicon glyphicon-cog ' data-toggle='modal' data-target='#myModal_Turmas' id = 'esconder_list' ></button>"
                . "&nbsp;<input type='submit' value='Editar em Bloco' class = 'btn btn-primary' id = 'esconder_bt' onclick= 'return validaCheckbox()' $disabled>"
//  . "&nbsp;<a href='principal.php' target='_self' class = 'btn btn-warning' id = 'esconder_bt'>&nbsp;Home&nbsp;</a>"
                ;
                ?> ",
                            "zeroRecords": "Nenhum aluno encontrado",
                            "info": "Mostrando pagina _PAGE_ de _PAGES_",
                            "infoEmpty": "Sem registros",
                            "search": "Busca:",
                            "infoFiltered": "(filtrado de _MAX_ total de alunos)",
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
                });
        </script>                       
        <script language="javascript">
            function validaCheckbox() {
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
                alert("Nenhum Aluno foi selecionado!");
                return false;
            }
        </script> 

    </body>
</html>
