<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe = "";
$Recebe = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$Msg = "";
$M = "";
$id_txt = "";
$txt = "";
//
if (!empty($Recebe)) {
    $id_txt = base64_decode($Recebe);
    $txt = " WHERE id_aluno_solicitacao LIKE '$id_txt'";
    session_start();
    if (!empty($_SESSION['msg'])) {
        if ($_SESSION['msg'] == "certo") {
            $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Documentos Gravados com Sucesso! </div>";
            $M = "1";
            session_destroy();
        } elseif ($_SESSION['msg'] == "retira") {
            $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Documentos Retirados com Sucesso! </div>";
            $M = "1";
            session_destroy();
        } elseif ($_SESSION['msg'] == "branco") {
            $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ocorreu Um Erro.O seu Formulário Foi Enviado em Branco! </div>";
            $M = "1";
            session_destroy();
        } else {
            $Msg = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ocorreu Um Erro Grave.Os Seus Dados Não Foram Atualizados! </div>";
            $M = "1";
            session_destroy();
        }
    }
}
$todos = "";
$todos = filter_input(INPUT_GET, 'todos', FILTER_DEFAULT);
if (!empty($todos)) {
    session_start();
    if (!empty($_SESSION['msg'])) {
        if ($_SESSION['msg'] == "certo") {
            $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Documentos Gravados com Sucesso! </div>";
            $M = "1";
            session_destroy();
        } elseif ($_SESSION['msg'] == "erro") {
            $Msg = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ocorreu Um Erro Grave.Os Seus Dados Não Foram Atualizados! </div>";
            $M = "1";
            session_destroy();
        }
    }
}
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>SOLICITAÇÃO DE TRANSFERÊNCIA</title>
        <style>
            .verde{color: green; padding-bottom: 12px; font-size: 16px;}
            .azul{ color: blue; padding-bottom: 12px;}
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;}
            #thNome{
                white-space: nowrap;
            }
            @media (max-width: 468px) {#thNome{white-space: normal;}
            }
            .checkbox{
                display: inline-block !important;
            }
        </style>        
    </head>
    <body onload="inicia()">  
        <?php
        include_once './menu.php';
        ?> 
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
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
                        <button type="button" class="btn btn-danger " data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div> 
        <?php
        echo "<form method= 'post'  action='solicitacao_transferencia_server.php' name = 'form1' class = 'form-horizontal'>";
        if ($M == "1") {
            echo"<script type='text/javascript'>
                $(document).ready(function () {
                   $('#exemplomodal').modal('show');
               });
                
            </script>";
        }
        ?>
        <script>
        $(document).ready(function () {
            $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
        });
        </script>
        <div class="container-fluid col-sm-12" >       
            <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <script src="js/bootstrap.min.js" type="text/javascript"></script>
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="js/cadastrar_validar.js" type="text/javascript"></script>
            <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
            <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script> 
            <h3 style="text-align: center;margin-top:6px;">Transferências Solicitadas</h3>
            <p style="text-align:center; margin-top:-12px; color:orange">(Obs: Essa Página se Refere aos Documentos Que A Escola Fornece ao Aluno(a):)</p>
            <div class = "row" style = "margin-bottom:12px">                
                <div class="col-sm-3">
                    <button type="submit" name ="botao" value="Mover_Para_Arquivo__Passivo" id="button7" class="btn bg-primary btn-block" title="Marque ao Menos uma Das Caixinhas Para Usar Esse Botão">Arquivar os Alunos</button>
                </div>
                <div class="col-sm-3">                
                    <button type="button" class="btn btn-success btn-block" id="button" data-toggle="modal" data-target="#myModal" onclick="json()" title="Marque ao Menos uma Das Caixinhas Para Usar Esse Botão">Atualizar Os Dados</button>
                </div>
                <div class="col-sm-2">
                    <button type="submit" name ="botao" value="retirar" id="button2" class="btn btn-danger btn-block" onclick="return confirmarExclusao()" title="Marque ao Menos uma Das Caixinhas Para Usar Esse Botão">Retirar Pedido</button>
                </div>
                <div class="col-sm-2">
                    <button type="button" name ="botao" value="" id="button6" class="btn bg-info btn-block" data-toggle="modal" data-target="#myModal_2" onclick="json()" title="Marque ao Menos uma Das Caixinhas Para Usar Esse Botão">Atualizar Os Dados em Bloco</button>
                </div>
                <div class="col-sm-2">
                    <button type="submit" name ="botao" value="declaracao" id="button5" class="btn btn-warning btn-block" onclick="return confirmarDeclaracao()" title="Marque ao Menos uma Das Caixinhas Para Usar Esse Botão">Declaração em Bloco</button>
                </div>
            </div>
            <?php
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` $txt ORDER BY `id_solicitacao` DESC");
            $linha = mysqli_num_rows($Consulta);
//
            if ($linha > 0) {
                //
                echo "<table class='nowrap table table-striped table-bordered ' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                //echo "<th> ID </th>";
                echo "<th>"
                . "<div class='dropdown'>"
                . "<span class = 'spanChekbox'><input type='checkbox'  class = 'selecionar'/></span>"
                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                . "<li><a><button type='submit' value='basica' name = 'botao' class='btn btn-link btn-sm ' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print verde' aria-hidden='true'></span></button>Básica</a></li>"
                . "</ul>"
                . "</div>"
                . "</th>";
                echo "<th style = ' white-space: normal;'> NOME </th>";
                echo "<th > TURMA </th>";
                echo "<th> STATUS ALUNO</th>";
                echo "<th> STATUS TRANSF. </th>";
                echo "<th> SOLICITANTE </th>";
                echo "<th> SOLICITAÇÃO</th>";
                echo "<th> ENTREGA/PRONTA </th>";
                echo "<th > NASCIDO </th>";
                echo "<th> ENDEREÇO </th>";
                echo "<th> CIDADE </th>";
                echo "<th> TRANSPORTE </th>";
                echo "<th> FONE N°1 </th>";
                echo "<th> FONE N°2 </th>";
                echo "<th> DECLARAÇÃO </th>";
                echo "<th> TRANSFERÊNCIA </th>";
                echo "<th> NECESSIDADES </th>";
                echo "<th>  ARQ. PASSIVO</th>";
                echo "<th> OBS </th>";
                echo "</tr>";
                echo "</thead>";
                //
                echo "<tfoot>";
                echo "<tr>";
                echo "<th></th>";
                echo "<th style = ' white-space: normal;'> NOME </th>";
                echo "<th > TURMA </th>";
                echo "<th> STATUS ALUNO</th>";
                echo "<th> STATUS TRANSF. </th>";
                echo "<th> SOLICITANTE </th>";
                echo "<th> DATA DA SOLICITAÇÃO</th>";
                echo "<th> ENTREGA/PRONTA </th>";
                echo "<th> NASCIDO </th>";
                echo "<th> ENDEREÇO </th>";
                echo "<th> CIDADE </th>";
                echo "<th> TRANSPORTE </th>";
                echo "<th> FONE N°1 </th>";
                echo "<th> FONE N°2 </th>";
                echo "<th> DECLARAÇÃO </th>";
                echo "<th> TRANSFERÊNCIA </th>";
                echo "<th> NECESSIDADES </th>";
                echo "<th >  ARQ. PASSIVO</th>";
                echo "<th> OBS </th>";
                echo "</tr>";
                echo "</tfoot>";
                //
                echo "<tbody>";
                echo "<tr>";
                // 
                while ($rowf = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                    //
                    $id_aluno = $rowf['id_aluno_solicitacao'];
                    $id_solicitacao = $rowf['id_solicitacao'];
                    $turmaf = $rowf['id_turma'];
                    $solicitante = $rowf['solicitante'];
                    $data = new DateTime($rowf['data_solicitacao']);
                    $data_solicitacao = date_format($data, 'd/m/Y');
                    $entregue = $rowf['entregue'];
                    $data2 = $rowf['data_entregue'];
                    if ($data2 == "0000-00-00") {
                        $data_entregue = "-- / -- / ----";
                    } else {
                        $data2 = new DateTime($rowf['data_entregue']);
                        $data_entregue = date_format($data2, 'd/m/Y');
                    }
                    $transferencia = $rowf['transferencia'];
                    $declaracao = $rowf['declaracao'];
                    //
//                    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
//                    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
//                    $Linha_turma = mysqli_fetch_array($Consulta_turma);
//                    //
//                    $ano_turma = substr($Linha_turma["ano"], 0, -6);
//                    $nome_turma = $Linha_turma["turma"];
//                    $turno_turma = $Linha_turma["turno"];
//                    $unico_turma = $Linha_turma["unico"];
//                    //
//                    if ($ano_turma == "2018") {
//                        $unico_turma = "";
//                    } else {
//                        $unico_turma = $Linha_turma["unico"];
//                    }
//                    $turmaf = "$nome_turma $unico_turma ($turno_turma) - $ano_turma ";
//                    //
                    //Nova consulta        //Nova consulta         //Nova consulta
                    $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$id_aluno' ");
                    $linhaf = mysqli_fetch_array($Consultaf);
                    //           
                    $inep = $linhaf['inep'];
                    $nomef = $linhaf['nome'];
                    $data_nascimentof = new DateTime($linhaf["data_nascimento"]);
                    $nascimento = date_format($data_nascimentof, 'd/m/Y');
                    $endereco = $linhaf['endereco'];
                    $cidade = $linhaf['cidade'];
                    $transporte = $linhaf['transporte'];
                    // $transferencia = $linhaf['transferencia'];
                    $fone = $linhaf['fone'];
                    $fone2 = $linhaf['fone2'];
                    $necessidades = $linhaf['necessidades'];
                    $excluido = $linhaf['excluido'];
                    //
                    $idf = $linhaf['id'];
                    $obs = $linhaf['obs'];
                    $ap = $linhaf['ap_pasta'];
                    $status = $linhaf['status'];

                    if ($status == "DESISTENTE" || $status == "TRANSFERIDO") {
                        $display = "bloco";
                        $display3 = "bloco";
                        $display2 = "none";
                    } else {
                        $display = "none";
                        $display2 = "bloco";
                        $display3 = "none";
                    }
                    if ($excluido == "S") {
                        $status = "ARQUIVADO";
                        $display3 = "none";
                    } else {
                        $ap = "-----";
                    }
                    //                   
                    echo "<td ></td>"; //                
                    echo "<td id = 'thNome'>"
                    . "<div class='dropdown'>"
                    . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$id_solicitacao'>"
                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                    . "<a><li style = 'display :" . $display . "'><a href='impressao_transferencia_provisoria_tratamento.php?id=$idf' target='_blank' title='Imprimir Declaração de Transferência'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Transferência</a></li>"
                    . "<a><li style = 'display :" . $display2 . "'><a href='' target='_blank' title=''><span class='glyphicon ' aria-hidden='true'>&nbsp;</span>O Aluno(a) ainda Não Foi Transferido :)</a></li>"
                    . "<li><a href='cadastrar_historico.php?id=" . base64_encode($idf) . "' target='_self' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>"
                    . "<li style = 'display :" . $display3 . "'><span style='margin-left: 20px;' class='glyphicon glyphicon-folder-open' aria-hidden='true'>&nbsp;<input type='submit' name = 'botao' value='Mover_Para_Arquivo__Passivo' style='background-color: white;border: none;margin-left: -8px;' onclick= 'return validaCheckbox()'></span></li>"
                    . "</ul>"
                    . "&nbsp;&nbsp;$nomef"
                    . "</div>"
                    . "</td>\n";
                    echo "<td >" . $turmaf . "</td>\n";
                    echo "<td >" . $status . "</td>\n";
                    if ($entregue == "N") {
                        $entregue = "PENDENTE";
                        echo "<td>$entregue</td>\n";
                    } elseif ($entregue == "S") {
                        $entregue = "ENTREGUE";
                        echo "<td>$entregue</td>\n";
                    } else {
                        $entregue = "PRONTA";
                        echo "<td>$entregue</td>\n";
                    }
                    echo "<td >" . $solicitante . "</td>\n";
                    echo "<td >" . $data_solicitacao . "</td>\n";
                    //<input type="submit" value="Arquivo Passivo" style="background-color: white;border: none;margin-left: -8px;">
                    echo "<td >" . $data_entregue . "</td>\n";
                    echo "<td > " . $nascimento . " </td>\n";
                    echo "<td >" . $endereco . "</td>\n";
                    echo "<td >" . $cidade . "</td>\n";
                    echo "<td >" . $transporte . "</td>\n";
                    echo "<td >" . $fone . "</td>\n";
                    echo "<td >" . $fone2 . "</td>\n";
                    echo "<td >" . $declaracao . "</td>\n";
                    echo "<td >" . $transferencia . "</td>\n";
                    echo "<td >" . $necessidades . "</td>\n";
                    echo "<td > " . $ap . "</td>\n";
                    echo "<td >" . $obs . "</td>\n";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<h1>Nenhum Registro Encontrado</h1>";
            }
            ?>    
        </div> 
        <!-- Modal -->          <!-- Modal -->   <!-- Modal -->          <!-- Modal -->
        <?php
        include_once 'solicitacoes_transferencias_modal.php';
        ?>

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
                    //
                    "lengthMenu": [[5, 10, 15, 20, 30, 40, 50, 70, 100, -1], [5, 10, 15, 20, 30, 40, 50, 70, 100, "All"]],
                    "ordering": true,
                    "language": {
                        "lengthMenu": " _MENU_ <?php
        echo"&nbsp;<input type='submit' value='Folha_de_Rosto' name ='botao' class = 'btn btn-success' id = 'button3'  onclick= 'return validaCheckbox()' title='Marque ao Menos uma Das Caixinhas Para Usar Esse Botão'>"
        . "&nbsp;&nbsp;<input type='submit'  value='Folha_Com_Notas' name ='botao' class = 'btn btn-primary' id = 'button4'  onclick= 'return validaCheckbox()' title='Marque ao Menos uma Das Caixinhas Para Usar Esse Botão'>"
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
        <?php
        echo "</form>";
        ?>            
    </body>
    <!-- // -->
    <script src="solicitacoes_transferencias.js" type="text/javascript"></script>
    <!-- // -->
    <style>
        .diminuir{
            min-width: 100%;
            height: 24px;
        }
    </style>
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
    <script type="text/javascript">
        function inicia() {
            $('#button').attr('disabled', 'disabled');
            $('#button2').attr('disabled', 'disabled');
            $('#button3').attr('disabled', 'disabled');
            $('#button4').attr('disabled', 'disabled');
            $('#button5').attr('disabled', 'disabled');
            $('#button6').attr('disabled', 'disabled');
            $('#button7').attr('disabled', 'disabled');
        }
        ;
    </script>
    <script type="text/javascript">
        $('input[type=checkbox]').on('change', function () {
            var total = $('input[type=checkbox]:checked').length;
            //   
            if (total < 1 || total > 1) {
                //               
                $('#button').attr('disabled', 'disabled');
            } else {
                //
                $('#button').removeAttr('disabled');
                $('#button3').removeAttr('disabled');
                $('#button4').removeAttr('disabled');
            }
            if (total > 1) {
                //  alert('Você Marcou  ' + total + ' Caixinhas! \n\n Lembre-se que Só Poderá Alterar Um Aluno(a) Por Vez:)');

            }
        });
    </script>   

    <script type="text/javascript">
        $('input[type=checkbox]').on('change', function () {
            var total = $('input[type=checkbox]:checked').length;
            if (total > 0) {
                //alert(total);
//                $('#button').removeAttr('disabled');
                $('#button2').removeAttr('disabled');
                $('#button3').removeAttr('disabled');
                $('#button4').removeAttr('disabled');
                $('#button5').removeAttr('disabled');
                $('#button6').removeAttr('disabled');
                $('#button7').removeAttr('disabled');
            } else {
                $('#button').attr('disabled', 'disabled');
                $('#button2').attr('disabled', 'disabled');
                $('#button3').attr('disabled', 'disabled');
                $('#button4').attr('disabled', 'disabled');
                $('#button5').attr('disabled', 'disabled');
                $('#button6').attr('disabled', 'disabled');
                $('#button7').attr('disabled', 'disabled');
            }
        });
    </script>
    <script type="text/javascript">
        // INICIO FUNÇÃO DE MASCARA MAIUSCULA
        function maiuscula(z) {
            v = z.value.toUpperCase();
            z.value = v;
        }
    </script>       
    <script type="text/javascript">
        function confirmarExclusao() {
            var r = confirm("Realmente deseja excluir?");
            if (r == true) {
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
                alert("Nenhum Aluno foi selecionado!");
                return false;
                //
                // return true;
            } else {
                return false;
            }
        }
    </script> 
    <script type="text/javascript">
        function confirmarDeclaracao() {
            var r = confirm("Montar Declaração?");
            if (r == true) {
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
                alert("Nenhum Aluno foi selecionado!");
                return false;
                //
                // return true;
            } else {
                return false;
            }
        }
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
            alert("Nenhum Aluno foi selecionado! Marque Uma Caixinha:)");
            return false;
        }
    </script> 

</html>
