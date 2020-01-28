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
    alert('Falha na operação');
    </script>";
} elseif ($Recebe_id == "3") {
    echo "<script type='text/javascript'>
    alert('Perfeito');
    </script>";
} else {
    $id_turma = base64_decode($Recebe_id);
}
?>
<html lang="pt-br">
    <head>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ALUNOS CURSANDO</title>        
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid" >    
            <h3 style="text-align: center;">ALUNOS CURSANDO OU QUE FORAM ADIMITIDOS DEPOIS</h3>
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
            <script>
                $(document).ready(function () {
                    $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
                });
            </script>
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
                .esc{
                    display: none;
                }
                #thNome{
                    white-space: nowrap;
                }
                @media (max-width: 400px) {#thNome{white-space: normal;}
                }

            </style>              
            <?php
            $Consultaf = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos WHERE turma = '$id_turma' AND (status = 'CURSANDO' OR status = 'ADIMITIDO DEPOIS') AND excluido = 'N' ORDER BY `alunos`.`nome` ASC ");
            $rowf = mysqli_num_rows($Consultaf);
            echo "<form method= 'post'  action='atualizar_varios.php' name = 'form1' >";
            ?>
            <!-- Modal Turmas-->
            <div class="modal fade" id="myModal_Turmas" role="dialog" >
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" style="">
                        <div class="modal-header">
                            <button type="button btn-lg" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title" style="text-align: center">Opções Referente aos Alunos</h5>
                        </div>
                        <div class="modal-body">
                            <?php
                            echo " <a><input style='margin-bottom: 6px;' type='submit' value='Editar em Bloco' class = 'form-control btn btn-primary' onclick= 'return validaCheckbox()'></a>";
                            echo " <a href='cadastrar_transferido.php' target='_self' class='form-control btn btn-success' style='margin-bottom: 6px;'>Cadastrar Aluno(a)</a>";
                           // echo " <a href='principal.php' target='_self' class = 'form-control btn btn-warning' >&nbsp;Home&nbsp;</a>";
                            ?>
                            <div class="modal-footer"></div>                            
                        </div>                       
                    </div>
                </div>
            </div>        
            <?php
            echo "<table class='nowrap table table-striped table-bordered ' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
            echo "<thead>";
            echo "<tr>";
            //echo "<th> ID </th>";
            echo "<th>"
            . "<div class='dropdown'>"
            . "<input type='checkbox'  class = 'selecionar' />"
            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success ch' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a><button type='submit' value='basica' name = 'basica' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
            . "<li><a><button type='submit' value='geral' name = 'geral' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
            . "</ul>"
            . "</div>"
            . "</th>";
            echo "<th style = ' white-space: normal;'> NOME </th>";
            echo "<th > TURMA </th>";
            echo "<th > INEP </th>";
            echo "<th > NIS </th>";
            echo "<th > SUS </th>";
            echo "<th > NASCIDO </th>";
            echo "<th > MÃE </th>";
           // echo "<th> PROFISSÃO MÃE </th>";
            echo "<th > PAI </th>";
            echo "<th> PROFISSÃO PAI </th>";
            echo "<th > NATURALIDADE </th>";
            echo "<th > ESTADO </th>";
            echo "<th> NACIONALIDADE </th>";
            echo "<th> MAT. CERTIDÃO </th>";
            echo "<th> SEXO </th>";
            echo "<th> ENDEREÇO </th>";
            echo "<th> CIDADE </th>";
            echo "<th> TRANSPORTE </th>";
            echo "<th> PONTO DE ÔNIBUS </th>";
            echo "<th> FONE N°1 </th>";
            echo "<th> FONE N°2 </th>";
            echo "<th> BOLSA FAMÍLIA </th>";
            echo "<th> DECLARAÇÃO </th>";
            echo "<th> RESPONSÁVEL DECLARAÇÃO </th>";
            echo "<th> TRANSFERÊNCIA </th>";
            echo "<th> RESPONSÁVEL TRANSFERÊNCIA </th>";
            echo "<th> COR/RAÇA </th>";
            echo "<th> NECESSIDADES </th>";
            echo "<th> OBS </th>";
            echo "<th> STATUS </th>";
            echo "</tr>";
            echo "</thead>";
//
            echo "<tfoot>";
            echo "<tr>";
            echo "<th>  </th>";
            echo "<th style = ' white-space: normal;'> NOME </th>";
            echo "<th > TURMA </th>";
            echo "<th > INEP </th>";
            echo "<th > NIS </th>";
            echo "<th > SUS </th>";
            echo "<th > NASCIDO </th>";
            echo "<th > MÃE </th>";
           // echo "<th > PROFISSÃO MÃE </th>";
            echo "<th > PAI </th>";
            echo "<th> PROFISSÃO PAI </th>";
            echo "<th > NATURALIDADE </th>";
            echo "<th > ESTADO </th>";
            echo "<th> NACIONALIDADE </th>";
            echo "<th> MAT. CERTIDÃO </th>";
            echo "<th> SEXO </th>";
            echo "<th> ENDEREÇO </th>";
            echo "<th> CIDADE </th>";
            echo "<th> TRANSPORTE </th>";
            echo "<th> PONTO DE ÔNIBUS </th>";
            echo "<th> FONE N°1 </th>";
            echo "<th> FONE N°2 </th>";
            echo "<th> BOLSA FAMÍLIA </th>";
            echo "<th> DECLARAÇÃO </th>";
            echo "<th> RESPONSÁVEL DECLARAÇÃO </th>";
            echo "<th> TRANSFERÊNCIA </th>";
            echo "<th> RESPONSÁVEL TRANSFERÊNCIA </th>";
            echo "<th> COR/RAÇA </th>";
            echo "<th> NECESSIDADES </th>";
            echo "<th> OBS </th>";
            echo "<th> STATUS </th>";
            echo "</tr>";
            echo "</tfoot>";
//
            echo "<tbody>";
//
            if ($rowf > 0) {
                //
                while ($linhaf = mysqli_fetch_array($Consultaf)) {
                    //
                    $inep = $linhaf['inep'];
                    $nisf = $linhaf['nis'];
                    $sus = $linhaf['sus'];
                    $nomef = $linhaf['nome'];
                    $data_nascimentof = new DateTime($linhaf["data_nascimento"]);
                    $nascimento = date_format($data_nascimentof, 'd/m/Y');
                    // $idade = $linhaf['idade'];
                    $maef = $linhaf['mae'];
                  //  $profissao_maef = $linhaf['profissao_mae'];
                    $paif = $linhaf['pai'];
                    $profissao_paif = $linhaf['profissao_pai'];
                    $pai = $linhaf['pai'];
                    $naturalidade = $linhaf['naturalidade'];
                    $estado = $linhaf['estado'];
                    $nacionalidade = $linhaf['nacionalidade'];
                    $matricula_certidao = $linhaf['matricula_certidao'];
                    $sexo = $linhaf['sexo'];
                    if ($sexo == "F") {
                        $sexo = "FEMININO";
                    } else {
                        $sexo = "MASCULINO";
                    }
                    $endereco = $linhaf['endereco'];
                    $cidade = $linhaf['cidade'];
                    $transporte = $linhaf['transporte'];
                    $ponto_onibus = $linhaf['ponto_onibus'];
                    $bolsa_familia = $linhaf['bolsa_familia'];
                    $declaracao = $linhaf['declaracao'];
                    $responsavel_declacao = $linhaf['responsavel_declaracao'];
                    $transferencia = $linhaf['transferencia'];
                    $responsavel_transferencia = $linhaf['responsavel_transferencia'];
                    $fone = $linhaf['fone'];
                    $fone2 = $linhaf['fone2'];
                    $turmaf = $linhaf['turma'];
                    //
                    $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                    $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                    $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
                    $ano_turma = substr($Linha_turma["ano"], 0, -6);
                    if ($ano_turma == "2018") {
                        $unico_turma = "";
                    } else {
                        $unico_turma = $Linha_turma["unico"];
                    }
                    $nome_turma = $Linha_turma["turma"];
                    $turno_turma = $Linha_turma["turno"];

                    $turmaf = "$nome_turma $unico_turma ($turno_turma) $ano_turma";
                    //
                    $cor = $linhaf['cor_raca'];
                    $necessidades = $linhaf['necessidades'];
                    $status = $linhaf['status'];
                    $status_ext = $linhaf['status_ext'];
                    //
                    if ($status_ext == "SIM") {
                        $status_ext = "ALUNO: OUVINTE";
                    } else {
                        $status_ext = "";
                    }

                    $idf = $linhaf['id'];
                    $obs = $linhaf['obs'];
                    echo "<td ></td>";
                    echo "<td id = 'thNome'>"
                    . "<div class='dropdown'>"
                    . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                    . "<li><a href='impressao.php?id=$idf' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                    . "<li><a href='folha_re_matricula.php?id=$idf' target='_blank' title='Imprimir Folha de Ré Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Ré Matricula</a></li>"
                    . "<li><a href='declaracoes_bolsa_familia.php?id=$idf' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>"
                    . "<li><a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>"
                    . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_Blanck' title='Mostrar'><span class='glyphicon glyphicon-user rosa' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>"
                    . "<li><a href='cadastrar_historico.php?id=" . base64_encode($idf) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>"
                    . "</ul>"
                    . "&nbsp;&nbsp;$nomef"
                    . "</div>"
                    . "</td>\n";
                    echo "<td >" . $turmaf . "</td>\n";
                    echo "<td >" . $inep . "</td>\n";
                    echo "<td >" . $nisf . "</td>\n";
                    echo "<td >" . $sus . "</td>\n";
                    echo "<td > " . $nascimento . " </td>\n";
                    echo "<td >" . $maef . "</td>\n";
                    //echo "<td >" . $profissao_maef . "</td>\n";
                    echo "<td >" . $paif . "</td>\n";
                    echo "<td >" . $profissao_paif . "</td>\n";
                    echo "<td >" . $naturalidade . "</td>\n";
                    echo "<td >" . $estado . "</td>\n";
                    echo "<td >" . $nacionalidade . "</td>\n";
                    echo "<td >" . $matricula_certidao . "</td>\n";
                    echo "<td >" . $sexo . "</td>\n";
                    echo "<td >" . $endereco . "</td>\n";
                    echo "<td >" . $cidade . "</td>\n";
                    echo "<td >" . $transporte . "</td>\n";
                    echo "<td >" . $ponto_onibus . "</td>\n";
                    echo "<td >" . $fone . "</td>\n";
                    echo "<td >" . $fone2 . "</td>\n";
                    echo "<td >" . $bolsa_familia . "</td>\n";
                    echo "<td >" . $declaracao . "</td>\n";
                    echo "<td >" . $responsavel_declacao . "</td>\n";
                    echo "<td >" . $transferencia . "</td>\n";
                    echo "<td >" . $responsavel_transferencia . "</td>\n";
                    echo "<td >" . $cor . "</td>\n";
                    echo "<td >" . $necessidades . "</td>\n";
                    echo "<td >" . $obs . "</td>\n";
                    echo "<td >" . $status . "<br>" . $status_ext . "</td>\n";


                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</form>";
            } else {
                echo "Nada enconrado.";
            }
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
                        "lengthMenu": [[8, 15, 20, 25, 30,35, 40, 50, 70, 100, -1], [8, 15, 20, 25, 30,35, 40, 50, 70, 100, "All"]],
                        "language": {
                            "lengthMenu": " _MENU_ <?php
//            echo "&nbsp;&nbsp;<a href='cadastrar.php' target='_self' class = 'btn btn-success' id = 'esconder_bt'>Novato</a></span>"
            echo "&nbsp;<a href='cadastrar_transferido.php' target='_self' class = 'btn btn-success' id = 'esconder_bt'>Cadastrar</a>"
            . "<button type='button' class='btn btn-link btn-lg verde glyphicon glyphicon-cog ' data-toggle='modal' data-target='#myModal_Turmas' id = 'esconder_list'></button>"
            . "&nbsp;<input type='submit' value='Editar em Bloco' class = 'btn btn-primary' id = 'esconder_bt' onclick= 'return validaCheckbox()'>"
           // . "&nbsp;<a href='principal.php' target='_self' class = 'btn btn-warning' id = 'esconder_bt'>&nbsp;Home&nbsp;</a>"
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
        </div>
    </body>
</html>
