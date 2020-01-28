<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>    
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="css/alunos_admitidos_depois.css" rel="stylesheet" type="text/css"/>
        <title>ALUNOS ADMITIDOS DEPOIS</title>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <?php
        $ConsultaTransferidos = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `status` LIKE 'ADIMITIDO DEPOIS' ORDER BY nome ");
        $Numero_alunos_transferidos = mysqli_num_rows($ConsultaTransferidos);
        if ($Numero_alunos_transferidos > 0) {
            $disabled = "";
        } else {
            $disabled = "disabled";
        }
        ?>        
        <div class="container-fluid">
            <h4 style="text-align: center">Alunos Admitidos Depois</h4>
            <script src="js/bootstrap.js" type="text/javascript"></script>
            <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
            <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
            <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <form method="post" action="atualizar_varios.php" name="form1">
                <table class='table table-striped table-bordered' id='tbl_alunos_lista'>
                    <thead>
                        <tr>
                            <!--<th>Id</th>-->
                            <th>
                                <?php
                                echo "<input type='checkbox'  class = 'selecionar'/>";
                                ?>
                            </th>
                            <th>Turma</th>
                            <th>Aluno</th>
                            <th>Declar.</th>
                            <th>Data</th>
                            <th>Responsável</th>
                            <th>Transf.</th>
                            <th>Data</th>
                            <th>Responsável</th>
                        </tr>
                    </thead>
                    <?php
                    //$contTransferidos = 0;
                    while ($linhaTransferidos = mysqli_fetch_array($ConsultaTransferidos)) {
                        $id = $linhaTransferidos['id'];

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
                        //
                        $turmaf = $linhaTransferidos['turma'];
                        $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                        $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                        $Linha_turma = mysqli_fetch_array($Consulta_turma);
                        //
                        $nome_turma = $Linha_turma["turma"];
                        $turno_turma = $Linha_turma["turno"];
                        $unico_turma = $Linha_turma["unico"];
                        $turmaf = "$nome_turma $unico_turma ($turno_turma)";
                        //
                        ?>
                        <tr>
                           <!-- <td><?php echo $linhaTransferidos['id']; ?></td>-->
                            <td><?php
                                echo""
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$id'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='impressao.php?id=$id' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                                . "<li><a href='folha_re_matricula.php?id=$id' target='_blank' title='Imprimir Folha de Ré Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de ReMatrícula</a></li>"
                                . "<li><a href='cadastrar_update.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar Os Dados Cadastrais</a></li>"
                                . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($id) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar Os Dados Cadastrais</a></li>"
                                . "<li><a href='cadastrar_historico.php?id=" . base64_encode($id) . "' target='_self' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>"
                                ;
                                ?>
                            </td>
                            <td><?php echo $turmaf; ?></td>
                            <td><?php echo $linhaTransferidos['nome']; ?></td>
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
                </table>
            </form>
        </div>
    </body> 
    <script>
        $(document).ready(function () {
            $('#tbl_alunos_lista').DataTable({
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],
                "language": {
                    "lengthMenu": "Alunos por Página _MENU_ <?php
                    echo "&nbsp;<a href='cadastrar_transferido.php' target='_self' class = 'btn btn-success' id = 'esconder_bt'>Cadastrar</a>"
                    . "&nbsp;<input $disabled type='submit'  value='Editar em Bloco' <a href='atualizar_varios.php' target='_blank' class='btn btn-primary' onclick= 'return validaCheckbox()'>";
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
                }
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
