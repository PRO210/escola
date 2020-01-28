<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ALUNOS DESISTENTES</title>
        <link href="css/alunos_desistentes.css" rel="stylesheet" type="text/css"/>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <h3 style="text-align: center "> Alunos Desistentes </h3>
        <?php
        $ConsultaTransferidos = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE status = 'DESISTENTE' AND excluido = 'N' ORDER BY `turma` AND `nome`");
        $Numero_alunos_transferidos = mysqli_num_rows($ConsultaTransferidos);
        if ($Numero_alunos_transferidos > 0) {
            $disabled = "";
        } else {
            $disabled = "disabled";
        }
        ?>

        <div class="container-fluid" >
            <div class="row">
                <div class="col-sm-12">
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
                    <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <script src="js/cadastrar_validar.js" type="text/javascript"></script>
                    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>    
                    <form method="post" action="atualizar_varios.php" name="form1">
                        <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">               
                            <thead>
                                <tr>
                                   <!-- <th>Id</th>-->
                                    <th>
                                        <?php
                                        echo " <input type='text' hidden='' name='turma_desistentes' >";
                                        echo""
                                        . "<div class='dropdown'>"
                                        . "<input type= 'checkbox'  class = 'selecionar'/>"
                                        . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog  text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                        . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                        . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link btn-sm ' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print verde' aria-hidden='true'></span></button>Básica</a></li>"
                                        . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link ' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print verde' aria-hidden='true'></span></button>Geral</a></li>"
                                        . "</ul>"
                                        ;
                                        ?>
                                    </th>
                                    <th>ALUNO</th>
                                    <th>NASCIMENTO</th>
                                    <th>MÃE</th>

                                    <th>TURMA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$contTransferidos = 0;
                                while ($linhaTransferidos = mysqli_fetch_array($ConsultaTransferidos)) {
                                    $id = $linhaTransferidos['id'];
                                    $nascimento = new DateTime($linhaTransferidos["data_nascimento"]);
                                    $nascimento = date_format($nascimento, 'd/m/Y');
                                    $mae = $linhaTransferidos['mae'];
                                    $pai = $linhaTransferidos['pai'];
                                    $turmaf = $linhaTransferidos['turma'];
                                    //
                                    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                                    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                                    $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
                                    $nome_turma = $Linha_turma["turma"];
                                    $turno_turma = $Linha_turma["turno"];
                                    $ano_turma = substr($Linha_turma["ano"], 0, -6);
                                    $turmaf = "$nome_turma($turno_turma)";
                                    //
                                    ?>
                                    <tr>
                                        <!--<td><?php echo $linhaTransferidos['id']; ?></td>-->
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
                                        <td><?php echo $linhaTransferidos['nome']; ?></td>
                                        <td><?php echo $nascimento; ?></td>
                                        <td><?php echo $linhaTransferidos['mae']; ?></td>                     
                                        <td><?php echo $turmaf . " - " . $ano_turma; ?></td>
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
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body> 
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "language": {
                    "lengthMenu": "Alunos por Página _MENU_ <?php echo "<input $disabled type='submit' value='Arquivo Passivo' <a href='atualizar_varios.php' target='_blank' class='btn btn-danger' onclick= 'return validaCheckbox()'>"; ?> ",
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
