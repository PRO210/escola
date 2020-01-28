<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($Recebe_id == "1") {
    echo "<script type=\"text/javascript\">
		alert(\"Documentos Gravados com Sucesso! \");
                </script>
                ";
} elseif ($Recebe_id == "2") {
    echo "<script type='text/javascript'>
                alert('A página Ações Passadas não gravou essas mudanças por favor, comunique à administração do Sistema');
          </script>";
} elseif ($Recebe_id == "3") {
    echo "<script type='text/javascript'>
                alert('Falha na operação ');
          </script>";
}
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>
        <title>ALUNOS TRANSFERIDOS</title>
        <style>
            .verde{color: green; padding-bottom: 12px;}
            .vermelho{ color: red; padding-bottom: 12px;  }
            .amarelo{  color: orange;  padding-bottom: 12px;}
            .azul{ color: blue; padding-bottom: 12px;}
            .rosa{ color: pink; padding-bottom: 12px;}
            #tdNome{
                white-space: nowrap;
            }
            @media (max-width: 850px) {#tdNome{white-space: normal;}
            }
            .spanChekbox{
                background-color:  rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px;
            }
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 
        </style>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>
        <h3 style="text-align: center "> ALUNOS TRANSFERIDOS</h3>
        <?php
        $ConsultaTransferidos = mysqli_query($Conexao, "SELECT alunos_solicitacoes.*,alunos.* FROM `alunos_solicitacoes`,`alunos` WHERE status = 'transferido' AND excluido = 'N' AND id_aluno_solicitacao = alunos.id ORDER BY `nome` ");
        $Numero_alunos_transferidos = mysqli_num_rows($ConsultaTransferidos);
        ?>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>      
        <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script> 
        <div class="container-fluid" >
            <div class="row">
                <div class="col-sm-12">
                    <form method="post" action="atualizar_varios.php" name="form1">
                        <table id="example" class="nowrap table table-striped table-bordered" width="100%" cellspacing="0">               
                            <thead>
                                <tr>
                                   <!-- <th>Id</th>-->
                                    <th>
                                        <?php
                                        echo "";
                                        echo""
                                        . "<div class='dropdown'>"
                                        . "<span class = 'spanChekbox'><input type='checkbox'  class = 'selecionar'/></span>"
                                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                        . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link btn-sm ' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print verde' aria-hidden='true'></span></button>Básica</a></li>"
                                        . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link ' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print verde' aria-hidden='true'></span></button>Geral</a></li>"
                                        . "</ul>"
                                        . "</div>"
                                        ;
                                        ?>
                                    </th>
                                    <th>Aluno</th>
                                    <th>Turma</th>                                    
                                    <th>Solicitante</th>                                    
                                    <th>Data Solicitação</th>                                    
                                    <th>Status Transferência</th>                                    
                                    <th>Data do Status </th>                                    
                                    <th>Declar.</th>
                                    <th>Data</th>
                                    <th>Responsável</th>
                                    <th>Transf.</th>
                                    <th>Data</th>
                                    <th>Responsável</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$contTransferidos = 0;
                                while ($linhaTransferidos = mysqli_fetch_array($ConsultaTransferidos)) {
                                    $id = $linhaTransferidos['id'];
                                    $nome = $linhaTransferidos['nome'];

                                    $data_declaracao = $linhaTransferidos["data_declaracao"];
                                    $data_declaracao_convertida = "";

                                    if ($data_declaracao == "0000-00-00") {
                                        $data_declaracao_convertida = "- - - - - - - - ";
                                    } else {
                                        $data_declaracao = new DateTime($linhaTransferidos["data_declaracao"]);
                                        $data_declaracao_convertida = date_format($data_declaracao, 'd/m/Y');
                                    }

                                    $data_transferencia = $linhaTransferidos["data_transferencia"];
                                    $data_transferencia_convertida = "";

                                    if ($data_transferencia == "0000-00-00") {
                                        $data_transferencia_convertida = "- - - - - - - - ";
                                    } else {
                                        $data_transferencia = new DateTime($linhaTransferidos["data_transferencia"]);
                                        $data_transferencia_convertida = date_format($data_transferencia, 'd/m/Y');
                                    }
                                    $data = new DateTime($linhaTransferidos['data_solicitacao']);
                                    $data_solicitacao = date_format($data, 'd/m/Y');
                                    $entregue = $linhaTransferidos['entregue'];
                                    //
                                    if ($entregue == "N") {
                                        $entregue = "PENDENTE";
                                    } elseif ($entregue == "S") {
                                        $entregue = "ENTREGUE";
                                    } else {
                                        $entregue = "PRONTA";
                                    }
                                    //
                                    $data2 = $linhaTransferidos['data_entregue'];
                                    if ($data2 == "0000-00-00") {
                                        $data_entregue = "-- / -- / ----";
                                    } else {
                                        $data2 = new DateTime($linhaTransferidos['data_entregue']);
                                        $data_entregue = date_format($data2, 'd/m/Y');
                                    }
                                    //
                                    $turmaf = $linhaTransferidos['turma'];
                                    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                                    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                                    $Linha_turma = mysqli_fetch_array($Consulta_turma);
                                    //
                                    $nome_turma = $Linha_turma["turma"];
                                    $turno_turma = $Linha_turma["turno"];
                                    $turmaf = "$nome_turma ($turno_turma)";
                                    //                                    
                                    ?>
                                    <tr>
                                        <!--<td><?php echo $linhaTransferidos['id']; ?></td>-->
                                        <td> </td>
                                        <td id="tdNome">
                                            <?php
                                            echo""
                                            . "<div class='dropdown'>"
                                            . "<span class = 'spanChekbox'><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$id'></span>"
                                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                            . "<li><a href='impressao.php?id=$id' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                                            . "<li><a href='folha_re_matricula.php?id=$id' target='_blank' title='Imprimir Folha de Ré Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Ré Matricula</a></li>"
                                            . "<li><a href='impressao_transferencia_provisoria_tratamento.php?id=$id' target='_blank' title='Imprimir Declaração de Transferência'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Transferência</a></li>"
                                            . "<li><a href='cadastrar_update.php?id=" . base64_encode($id) . "'  target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                                            . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($id) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user rosa' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                                            . "<li><a href='cadastrar_historico.php?id=" . base64_encode($id) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferência/Solicitaões</a></li>"
                                            . "</ul>"
                                            . "&nbsp;&nbsp;$nome"
                                            . "</div>"
                                            ;
                                            ?> 
                                        </td>
                                           <td><?php echo $turmaf; ?></td>                                  
                                        <td><?php echo $linhaTransferidos['solicitante']; ?></td>                                       
                                        <td><?php echo $data_solicitacao; ?></td>                                       
                                        <td><?php echo $entregue; ?></td>                                       
                                        <td><?php echo $data_entregue; ?></td>                                       
                                        <td><?php echo $linhaTransferidos['declaracao']; ?></td>
                                        <td><?php echo $data_declaracao_convertida; ?></td>
                                        <td><?php echo $linhaTransferidos['responsavel_declaracao']; ?></td>
                                        <td><?php echo $linhaTransferidos['transferencia']; ?></td>
                                        <td><?php echo $data_transferencia_convertida; ?></td>
                                        <td><?php echo $linhaTransferidos['responsavel_transferencia']; ?> </td>

                                    </tr>
                                    <?php
                                    //$contTransferidos += $Transferidos['qtd'];
                                }
                                ?>
                                <!--
                            <tr>
                                <td style="text-align: right; font-weight: bold;">SOMA</td>
                                <td><?php echo "$Numero_alunos_transferidos"; ?> </td>
                            </tr>
                                -->
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Aluno</th>
                                    <th>Turma</th>                                    
                                    <th>Solicitante</th>                                    
                                    <th>Data Solicitação</th>                                    
                                    <th>Status Transferência</th>                                    
                                    <th>Data do Status </th>                                    
                                    <th>Declar.</th>
                                    <th>Data</th>
                                    <th>Responsável</th>
                                    <th>Transf.</th>
                                    <th>Data</th>
                                    <th>Responsável</th>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body> 
    <script>
        $(document).ready(function () {
            //Setup - add a text input to each footer cell
            $('#example tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');

            });
            var table = $('#example').DataTable({
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],
                "language": {
                    "lengthMenu": "Alunos por Página _MENU_ <?php echo "<input type='submit' value='Arquivo Passivo' <a href='atualizar_varios.php?' target='_blank' class='btn btn-danger' onclick= 'return validaCheckbox()'>"; ?> ",
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
    <!-- Marcar ou Desmarcar todos os checkbox-->
    <script type="text/javascript">
        $(document).ready(function () {
            $('.selecionar').click(function () {
                if (this.checked) {
                    $('.checkbox').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox').each(function () {
                        this.checked = false;
                    });
                }
            });

        });
    </script>
</html>
