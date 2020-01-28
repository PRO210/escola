<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <title>ALUNOS DO BOLSA FAMÍLIA</title>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?> 
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="css/tabela_atestado.css" rel="stylesheet" type="text/css"/>
        <link href="css/alunos_bolsa_familia_relatorio.css" rel="stylesheet" type="text/css"/>
        <div class="container-fluid">
            <h3>Alunos Cadastros no Bolsa Família</h3>
            <?php
            $Consultaf_nis = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos WHERE `bolsa_familia` = 'SIM' AND excluido = 'N' AND (`status` = 'CURSANDO' OR `status`= 'ADIMITIDO DEPOIS') ORDER BY nome");
            $rowf_nis = mysqli_num_rows($Consultaf_nis);
//
            echo "<form method= 'post'  action='atualizar_varios.php' name = 'form1' >";
            echo " <input type='text' hidden='' name='pesquisar_no_banco' >";
            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
            echo "<thead>";
            echo "<tr>";
            // echo "<th> ID </th>";
            //echo "<th> <input type='checkbox' class = 'selecionar'/></th>";
            echo "<th>"
            . "<div class='dropdown'>"
            . "<input type= 'checkbox'  class = 'selecionar'/>"
            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog  text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link btn-sm verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
            . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
            . "</ul>"
            . "</th>"
            ;
            echo "<th> NOME </th>";
            echo "<th> NACIMENTO </th>";
            //echo "<th> IDADE </th>";
            echo "<th> MÃE </th>";
            echo "<th> NIS </th>";
            echo "<th> TURMA </th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tfoot>";
            echo "<th> Nada </th>";
            echo "<th> NOME </th>";
            echo "<th> NACIMENTO </th>";
            //echo "<th> IDADE </th>";
            echo "<th> MÃE </th>";
            echo "<th> NIS </th>";
            echo "<th> TURMA </th>";
            echo "</tfoot>";
            echo "<tbody>";
            //
            if ($rowf_nis > 0) {
                //
                while ($linhaf_nis = mysqli_fetch_array($Consultaf_nis)) {

                    $idf = $linhaf_nis['id'];
                    $nomef_nis = $linhaf_nis['nome'];
                    $data_nascimentof = new DateTime($linhaf_nis['data_nascimento']);
                    $data_nascimentof_nis = date_format($data_nascimentof, 'd/m/Y');
                    $idade_nis = $linhaf_nis['idade'];
                    $maef_nis = $linhaf_nis['mae'];
                    $nisf_nis = $linhaf_nis['nis'];
                    $idf_nis = $linhaf_nis['id'];
                    $turmaf = $linhaf_nis['turma'];
                    //
                    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                    $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
                    $nome_turma = $Linha_turma["turma"];
                    $turno_turma = $Linha_turma["turno"];
                    $unico_turma = $Linha_turma["unico"];                  
                    $turmaf = "$nome_turma $unico_turma ($turno_turma)";

                    $disabled = "";
                    if ($rowf_nis > 0) {
                       
                    } else {
                        $disabled = "disabled = ''";
                      
                    }
                    echo "<tr>";
                    //echo "<td>" . $idf . "</td>\n";
                    echo "<td>"
                    . "<div class='dropdown'>"
                    . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox'  $disabled value='$idf_nis'>"
                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                    . "<li><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title=''><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                    . "<li><a href='alunos_bolsa_familia_relatorio_server.php?id=" . base64_encode($idf) . "' onclick='return confirmarExclusao()' target='_self' title=''><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true' >&nbsp;</span>Retirar</a></li>"
                    . "</td>";
                    echo "<td>" . $nomef_nis . "</td>\n";
                    echo "<td>" . $data_nascimentof_nis . "</td>\n";
                    // echo "<td>" . $idade_nis . "</td>\n";
                    echo "<td>" . $maef_nis . "</td>\n";
                    echo "<td>" . $nisf_nis . "</td>\n";
                    echo "<td>" . $turmaf . "</td>\n";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</form>";
            } else {
                echo "Nada enconrado.";
            }
            ?>                      
        </div>
    </body>
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#tbl_alunos_lista tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder=" ' + title + '" />');
            });

            //Data Table
            var table = $('#tbl_alunos_lista').DataTable({

                "lengthMenu": [[10, 15, 20, 25, 35, 70, 100, -1], [10, 15, 20, 25, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": "Alunos por Página _MENU_ <?php
            echo "<input type='submit' value='Editar em Bloco' <a href='atualizar_varios.php' target='_blank' class='btn btn-primary' onclick= 'return validaCheckbox()'>";
            ?>",
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
            //
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
</html>
