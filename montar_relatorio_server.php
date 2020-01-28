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
        <title>RELATÓRIOS ALUNOS</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <div class="container-fluid" >     
            <form method= 'post'  action='montar_relatorio_server_2.php' name = 'form1'>
                <h3 style="text-align: center">Relatório</h3>
                <script src="js/bootstrap.js" type="text/javascript"></script>
                <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
                <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>             
                <style type="text/css">
                    .verde{ color: green; }
                    .vermelho{ color: red; }   
                    .amarelo{ color: orange; }

                    tfoot input {
                        width: 100%;
                        padding: 3px;
                        box-sizing: border-box;

                    }                    
                </style>
                <script>
                    $(document).ready(function () {
                        //$(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 4px;  padding:8px'>");
                    });
                </script>

                <style>
                    .personalizada{
                        transform: scale(1.5);                      
                    }
                    .span_personalizada{
                        background-color: rgb(204, 119, 0); padding: 6px; padding-top: 8px;border-radius: 4px;

                    }
                </style>
                <link href="Tabela_Responsiva/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
                <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
                <link href="Tabela_Responsiva/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css"/>
                <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script>
                <script src="Tabela_Responsiva/dataTables.rowReorder.min.js" type="text/javascript"></script>
                <script src="Tabela_Responsiva/jquery-3.3.1.js" type="text/javascript"></script>
                <script src="Tabela_Responsiva/jquery.dataTables.min.js" type="text/javascript"></script>
                <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script>
                <script src="Tabela_Responsiva/dataTables.rowReorder.min.js" type="text/javascript"></script> 
                <h5 style=" margin-bottom: -24px">PERSONALIZE OS CAMPOS DO RELATÓRIO</h5>
                <table class='display nowrap' id='personalizada' style="width: 100%; margin-bottom: 36px;" >
                    <thead>
                        <tr>                          
                            <?PHP for ($i = 0; $i <= 47; $i++) { ?>                            
                                <th> </th>
                            <?php } ?>                            
                        </tr>                       
                    </thead>
                    <tbody>                         
                    <td></td>
                    <td></td>
                    <td><span class="span_personalizada"><input type="checkbox" value="inep" id="titulos" name="titulos[]" class="personalizada"></span><label for="inep" id="titulos">&nbsp;INEP</label></td>
                    <td><span class="span_personalizada"><input type="checkbox" value="mae" id="titulos" name="titulos[]" class="personalizada"></span><label for="titulos" id="titulos">&nbsp;MÃE</label></td>
                    <td><span class="span_personalizada"><input type="checkbox" value="profissao_mae" name="titulos[]"></span>&nbsp;PROFISSÃO DA MÃE</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="pai"           name="titulos[]"></span>PAI</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="profissao_pai" name="titulos[]"></span>&nbsp;PROFISSÃO DO PAI</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="fone" name="titulos[]"></span>&nbsp;FONE</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="fone2" name="titulos[]"></span>&nbsp;FONE Nº 2</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="nis" name="titulos[]"></span>&nbsp;NIS </td>
                    <td><span class="span_personalizada"><input type="checkbox" value="bolsa_familia" name="titulos[]"></span>&nbsp;BOLSA FAMPILIA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="sus" name="titulos[]"></span>&nbsp;SUS</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="modelo_certidao" name="titulos[]"></span>&nbsp;MODELO DE CERTIDÃO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="matricula_certidao" name="titulos[]"></span>&nbsp;MATRICULA DA CERTIDÃO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="tipos_de_certidao" name="titulos[]"></span>&nbsp;TIPOS DE CERTIDÃO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="certidao_civil" name="titulos[]"></span>&nbsp;CERTIDÃO CIVIL</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="data_expedicao" name="titulos[]"></span>&nbsp;EXPEDIÇÃO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="naturalidade" name="titulos[]"></span>&nbsp;NATURALIDADE</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="estado" name="titulos[]"></span>&nbsp;ESTADO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="nacionalidade" name="titulos[]"></span>&nbsp;NACIONALIDADE</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="sexo" name="titulos[]"></span>&nbsp;SEXO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="endereco" name="titulos[]"></span>&nbsp;ENDEREÇO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="cidade" name="titulos[]"></span>&nbsp;CIDADE <br> ONDE MORA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="estado_cidade" name="titulos[]"></span>&nbsp;ESTADO <br> ONDE MORA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="necessidades" name="titulos[]"></span>&nbsp;NECESSIDADES <BR> ESPECIAIS</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="especificidades" name="titulos[]"></span>&nbsp;ESPECIFICIDADES</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="transporte" name="titulos[]"></span>&nbsp;TRANSPORTE</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="urbano" name="titulos[]"></span>&nbsp;URBANO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="ponto_onibus" name="titulos[]"></span>&nbsp;PONTO DE ÔNIBUS</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="motorista" name="titulos[]"></span>&nbsp;MOTORISTA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="motorista2" name="titulos[]"></span>&nbsp;MOTORISTA 2</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="Data_matricula" name="titulos[]"></span>&nbsp;DATA MATRICULA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="data_renovacao_matricula" name="titulos[]"></span>&nbsp;RENOVAÇÃO <br>DATA MATRICULA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="declaracao" name="titulos[]"></span>&nbsp;DECLARAÇÃO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="data_declaracao" name="titulos[]"></span>&nbsp;DATA DECLARAÇÃO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="responsavel_declaracao" name="titulos[]"></span>&nbsp;RESPONSÁVEL DECLARAÇÃO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="transferencia" name="titulos[]"></span>&nbsp;TRANSFERÊNCIA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="data_transferencia" name="titulos[]"></span>&nbsp;DATA TRANSFERÊNCIA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="responsavel_transferencia" name="titulos[]"></span>&nbsp;RESPONSÁVEL TRANSFERÊNCIA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="obs" name="titulos[]"></span>&nbsp; OBS</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="status" name="titulos[]"></span>&nbsp;STATUS</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="status_ext" name="titulos[]"></span>&nbsp;OUVINTE</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="resultado" name="titulos[]"></span>&nbsp;RESULTADO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="professor" name="titulos[]"></span>&nbsp;PROFESSOR(A)</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="professor_aux" name="titulos[]"></span>&nbsp;PROFESSOR(A)/AUX.</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="turma" name="titulos[]"></span>&nbsp;TURMA</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="unico" name="titulos[]"></span>&nbsp;ÚNICO</td>
                    <td><span class="span_personalizada"><input type="checkbox" value="turno" name="titulos[]"></span>&nbsp;TURNO</td>
                    </tbody>
                                   
                 </tbody>
                </table>
                <h3 style=" height: 24px"></h3>
                <?php
                $inputOuvinte = filter_input(INPUT_POST, 'inputOuvinte', FILTER_DEFAULT);
                //
                if ($inputOuvinte == 'SIM') {
                    $Ouvinte = "AND `status_ext` = 'SIM' ";
                } elseif ($inputOuvinte == 'NAO') {
                    $Ouvinte = "AND `status_ext` = 'NAO' ";
                } else {
                    $Ouvinte = "";
                }
                //
                $inputUrbano = filter_input(INPUT_POST, 'inputUrbano', FILTER_DEFAULT);
                //
                if ($inputUrbano == 'SIM') {
                    $urbano = "AND `urbano` = 'SIM' ";
                } elseif ($inputUrbano == 'NAO') {//              
                    $urbano = "AND `urbano` = 'NAO' ";
                } else {
                    $urbano = "";
                }
                //
                $inputtransporte = filter_input(INPUT_POST, 'transporte_selecionado', FILTER_DEFAULT);
                //
                if ($inputtransporte == 'SIM') {
                    $transporte = "AND `transporte` = 'SIM' ";
                } elseif ($inputtransporte == 'NÃO') {
                    $transporte = "AND `transporte` = 'NÃO' ";
                } else {
//                $transporte = "AND (`transporte` = 'SIM' OR `transporte` = 'NÃO' OR `transporte` = '')";
                    $transporte = "";
                }
                //
                $sexo = "";
                $inputSexo = filter_input(INPUT_POST, 'sexo_selecionado', FILTER_DEFAULT);
                if ($inputSexo == 'M') {
                    $sexo = "AND `sexo` = 'M' ";
                } elseif ($inputSexo == 'F') {
                    $sexo = "AND `sexo` = 'F' ";
                } else {
                    $sexo = "";
                }
                //
                $inputIDadeInicial = "";
                $inputIDadeFinal = "";
                $inputIDadeInicial = filter_input(INPUT_POST, 'inputIdadeInicial', FILTER_DEFAULT);
                $inputIDadeFinal = filter_input(INPUT_POST, 'inputIdadeFinal', FILTER_DEFAULT);
                if ($inputIDadeInicial == "") {
                    $inputIDadeInicial = "2";
                } else {
                    $inputIDadeInicial = filter_input(INPUT_POST, 'inputIdadeInicial', FILTER_DEFAULT);
                }
                if ($inputIDadeFinal == "") {
                    $inputIDadeFinal = "100";
                } else {
                    $inputIDadeFinal = filter_input(INPUT_POST, 'inputIdadeFinal', FILTER_DEFAULT);
                }
                //
                $bolsa_familia = "";
                $bolsa_familia = filter_input(INPUT_POST, 'inputBolsaFamilia', FILTER_DEFAULT);

                if ($bolsa_familia == "TODOS") {
                    $bolsa_familia = "";
                } elseif ($bolsa_familia == "SIM") {
                    $bolsa_familia = "`bolsa_familia` = 'SIM' AND";
                } elseif ($bolsa_familia == "NÃO") {
                    $bolsa_familia = "`bolsa_familia` != 'SIM' AND";
                }
                //NECESSIDASDS ESPECIAIS
                $necessidades = "";
                $necessidades = filter_input(INPUT_POST, 'necessidades_selecionado', FILTER_DEFAULT);

                if ($necessidades == "") {
                    $necessidades = "";
                } elseif ($necessidades == "SIM") {
                    $necessidades = "`necessidades` LIKE '%SIM%' AND";
                } elseif ($necessidades == "NÃO") {
                    $necessidades = "`necessidades` LIKE '%NÃO%' AND";
                }
                ?>
                <?php
                echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista' whidth = '100%'  cellspacing = '0'> ";
                echo "<thead>";
                echo "<tr>";
                echo "<th>"
                . "<div class='dropdown'>"
                . "<input type='checkbox'  class = 'selecionar'/>"
                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                . "<li><a><button type='submit' value='basica' name = 'tudo' onclick= 'return validaCheckbox()' class='btn btn-link btn-lg verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão Básica</a></li>"
                . "<li><a><button type='submit' value='tudo' name = 'tudo' onclick= 'return validaCheckbox()' class='btn btn-link btn-lg verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão Completa</a></li>"
                . "<li><a><button type='submit' value='personalizada' name = 'tudo' onclick= 'return validaCheckbox()' class='btn btn-link btn-lg verde'><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Impressão Personalizada</a></li>"
                . "</ul>"
                . "&nbsp;&nbsp;INEP"
                . "</div>"
                . "</th>";
                echo "<th> NOME </th>";
                //  echo "<th> NASCIDO </th>";
                echo "<th> IDADE </th>";
                echo "<th> TURMA </th>";
                echo "<th> STATUS </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tfoot>";
                echo "<tr>";
                echo "<th>  </th>";
                echo "<th> NOME </th>";
                //echo "<th> NASCIDO </th>";
                echo "<th> IDADE </th>";
                echo "<th> TURMA </th>";
                echo "<th> STATUS </th>";

                echo "</tr>";
                echo "</tfoot>";
                echo "<tbody>";

                $turma = "";
                if (empty($_POST['turma'])) {
                    //$turma = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60";
                    $Consulta_turma = mysqli_query($Conexao, "SELECT * FROM `turmas` ORDER BY turmas.ano, turmas.turma ");
                    $vetorturmas[] = "";
                    while ($linha_turma = mysqli_fetch_array($Consulta_turma, MYSQLI_BOTH)) {
                        $turma2 = $linha_turma["turma"];
                        $turno = $linha_turma["turno"];
                        $id_turma = $linha_turma["id"];

                        $vetorturmas[] .= $id_turma;
                    }
                    array_shift($vetorturmas);
                    // print_r($vetorturmas);
                } else {
                    foreach (($_POST['turma']) as $buscar_turma) {
                        $turma .= $buscar_turma . ",";
                        //echo "$turma";
                    }
                    $turma = substr($turma, 0, -1);
                    // echo "$turma";  
                    $Consulta_turma = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` IN($turma) ORDER BY turma asc");
                    $vetorturmas[] = "";
                    while ($linha_turma = mysqli_fetch_array($Consulta_turma, MYSQLI_BOTH)) {
                        $turma2 = $linha_turma["turma"];
                        $turno = $linha_turma["turno"];
                        $id_turma = $linha_turma["id"];

                        $vetorturmas[] .= $id_turma;
                    }
                    array_shift($vetorturmas);
                    // print_r($vetorturmas);
                }

                //Começo do input status
                $status = "";
                if (empty($_POST['status_selecionado'])) {
                    $status = "1,2,3,4";
                    // echo "$status";
                } else {
                    foreach (($_POST['status_selecionado']) as $buscar_status) {
                        $status .= "$buscar_status" . ",";
                    }
                    $status = substr($status, 0, -1);
                }
                //echo "$status";
                $Consulta_status = mysqli_query($Conexao, "SELECT * FROM `status_alunos` WHERE id IN($status) ORDER BY status_aluno");
                $vetorStatus[] = "";
                //
                while ($linha_status = mysqli_fetch_array($Consulta_status, MYSQLI_BOTH)) {
                    //
                    $status_aluno = $linha_status["status_aluno"];
                    $vetorStatus[] .= "$status_aluno";
                }
                array_shift($vetorStatus);
//            print_r($vetorStatus);
//            print_r($vetorturmas);
//            Fim do input status
                $quant2 = 0;

                foreach ($vetorturmas as $id_vetor) {
                    foreach ($vetorStatus as $id_status) {
                        $Consultaf = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,NOW()) AS idade FROM alunos "
                                . "WHERE `turma` LIKE '$id_vetor' AND $bolsa_familia `status` = '$id_status' " . $sexo . " AND " . $necessidades . " `excluido` = 'N' $transporte $Ouvinte $urbano order by `nome` ASC");

                        while ($linhaf = mysqli_fetch_array($Consultaf)) {

                            $quant = 1;
                            $idade = $linhaf['idade'];
                            if ($idade >= $inputIDadeInicial && $idade <= $inputIDadeFinal) {
                                //                             
                                $inep = $linhaf['inep'];
                                $nomef = $linhaf['nome'];
                                $turmaf = $linhaf['turma'];
                                $status = $linhaf['status'];
                                //
                                $SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
                                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                                $Linha_turma = mysqli_fetch_array($Consulta_turma);
//
                                $ano_turma = substr($Linha_turma["ano"], 0, -6);
                                $unico_turma = $Linha_turma["unico"];
                                $nome_turma = $Linha_turma["turma"];
                                $turno_turma = $Linha_turma["turno"];
                                if ($ano_turma == "2018") {
                                    $unico_turma = "";
                                }
                                $turmaf = "$nome_turma $unico_turma ($turno_turma) - $ano_turma";
                                //
                                $idf = $linhaf['id'];
                                //
//                                $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `bimestre_media` WHERE `id_bimestre_media_aluno` = '$idf' AND `ano` = '$ano_turma'");
//                                $linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH);
//                                $linhaTeste = mysqli_num_rows($Consulta2);
//                                if ($linhaTeste > 0) {
//                                    $bimetre_status = $linhaConsulta2['status_bimestre_media'];
//
//                                    switch ($bimetre_status) {
//                                        case 1: $txt_bimetre_status = "CURSANDO";
//                                            break;
//                                        case 3: $txt_bimetre_status = "TRANSFERIDO";
//                                            break;
//                                        case 4: $txt_bimetre_status = "DESISTENTE";
//                                            break;
//                                        case 5: $txt_bimetre_status = "APROVADO";
//                                            break;
//                                        case 6: $txt_bimetre_status = "REPROVADO";
//                                            break;
//                                    }
//                                } else {
//                                    $txt_bimetre_status = "EM BRANCO";
//                                }
                                //
                                //
                                $statusf = $linhaf['status'];
                                //   $transporte2 = $linhaf['transporte'];
                                //
                                // $idade = $linhaf['idade'];
                                $nascimento = $linhaf['data_nascimento'];
                                $nascimentoConvertida = date_format(new DateTime($nascimento), 'd/m/Y');
                                $nascimentoStr = strtotime($nascimento);

                                echo "<td>"
                                . "<div class='dropdown'>"
                                . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'>"
                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'>&nbsp;</span>Mostrar</a></li>"
                                . "</ul>"
                                . " " . $inep . " "
                                . "</div>"
                                . "</td>";

                                echo "<td>" . $nomef . "</td>\n";
                                //   echo "<td> " . $nascimentoConvertida . " </td>\n";
                                echo "<td>" . $idade . "</td>\n";
                                // echo "<td>" . $maef . "</td>\n";
                                echo "<td>" . $turmaf . "</td>\n";
                                echo "<td>" . $status . "</td>\n";
                                // echo "<td>" . $txt_bimetre_status . "</td>\n";
                                //  echo "<td>" . $transporte2 . "</td>\n";
                                echo "</tr>";
                                $quant2 += $quant;
                            }
                        }
                    }
                }
                echo "</tbody>";
                echo "</table>";
                ?>
            </form>
        </div>
    </body>   
    <script type="text/javascript">
                    $(document).ready(function () {

                        // Setup - add a text input to each footer cell
                        $('#tbl_alunos_lista tfoot th').each(function () {
                            var title = $(this).text();
                            $(this).html('<input type="text" placeholder="' + title + '" />');
                        });
                        //Data Table
                        var table = $('#tbl_alunos_lista').DataTable({

                            "columnDefs": [{
                                    "targets": 0,
                                    "orderable": false
                                }],
                            "lengthMenu": [[8, 15, 20, 25, 30, 35, 40, 45, 50, 70, 100, -1], [8, 15, 20, 25, 30, 35, 40, 45, 50, 70, 100, "All"]],
                            "language": {
                                "lengthMenu": "Alunos por Página _MENU_ ",
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
    <script type="text/javascript">
        //Marcar ou Desmarcar todos os checkbox
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
    <script>
        function verificar() {

            $('input[type="checkbox"][name="titulos[]"]:checked').each(function () {
                // alert($(this).val());
                var teste = $(this).val();

                //

            });
        }
    </script>

    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
//            $('#tbl_alunos_lista tfoot th').each(function () {
//                var title = $(this).text();
//                $(this).html('<input type="text" placeholder="' + title + '" />');
//            });
            // Data Table
            var table = $('#personalizada').DataTable({
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": false,

                //
//                "columnDefs": [{
//                        "targets": 0,
//                        "orderable": false
//
//                    }],
//                "lengthMenu": [[5, 20, 30, 40, 50, 70, 100, -1], [5, 20, 30, 40, 50, 70, 100, "All"]],
//                "language": {
//                    "lengthMenu": " _MENU_ ",
//                    "zeroRecords": "Nenhum aluno encontrado",
//                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
//                    "infoEmpty": "Sem registros",
//                   // "search": "Busca:",
//                    "infoFiltered": "(filtrado de _MAX_ total de alunos)",
//                    "paginate": {
//                        "first": "Primeira",
//                        "last": "Ultima",
//                        "next": "Proxima",
//                        "previous": "Anterior"
//                    },
//                    "aria": {
//                        "sortAscending": ": ative a ordenação cressente",
//                        "sortDescending": ": ative a ordenação decressente"
//                    }
//
//                },
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            });
            // Apply the search
//            table.columns().every(function () {
//                var that = this;
//                $('input', this.footer()).on('keyup change', function () {
//                    if (that.search() !== this.value) {
//                        that
//                                .search(this.value)
//                                .draw();
//                    }
//                });
//            });
        });
    </script>            
</html>
