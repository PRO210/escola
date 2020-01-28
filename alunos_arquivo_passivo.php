<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id = base64_decode($Recebe_id);
$txt = "";
//
if ($Recebe_id == "1") {
    echo "<script type=\"text/javascript\">
    alert(\"Aluno(s) Removido(s) com Sucesso! \");
    </script>
    ";
} elseif ($Recebe_id == "2") {
    echo "<script type=\"text/javascript\">
    alert(\"Esse Aluno já Consta no Arquivo \");
    </script>
    ";
} elseif ($Recebe_id == "3") {
    echo "<script type='text/javascript'>
    alert('Houve um problema na operação');
    </script>
    ";
} elseif ($Recebe_id == "4") {
    echo "<script type=\"text/javascript\">
    alert(\"Operação Realizada com Sucesso! \");
    </script>
    ";
} elseif ($Recebe_id == "5") {
    echo "<script type=\"text/javascript\">
    alert(\"Houve um problema na operação. Você não Indicou uma pasta para o Aluno! \");
    </script>
    ";
} elseif ($id) {
    $txt = " AND id = $id";
    echo " <script type='text/javascript'>
            function onload() {
//                var c = document.getElementById('check')
//                c.checked = true;
                $('.checkbox').each(function () {
                    this.checked = true;
                    $('#inputRetirar').removeAttr('disabled');   
                    $('#trocar_pasta').removeAttr('disabled');
                  });
            }
        </script>";
} else {
    
}
?>
<html lang="pt-br">
    <head>
        <title>ARQUIVO PASSIVO</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .verde{color: green; padding-bottom: 12px;}
            .vermelho{ color: red; padding-bottom: 12px;  }
            .amarelo{  color: orange;  padding-bottom: 12px;}
            .azul{ color: blue; padding-bottom: 12px;}
            .rosa{ color: pink; padding-bottom: 12px;}

            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;} 

            #esconder_list{display: none; }
            @media (max-width: 1200px) { #esconder_list{ display: inline;}
            }           
            @media (max-width: 1200px) {#inputRetirar,#editar_pasta,#cadastrar,#trocar_pasta{display: none;}
            }
            @media (max-width: 825px) {#ocultar{display: none;
                                       }
                                       .checkbox{
                                           display: inline-block !important;
                                       }
            </style>
        </head>   
        <body onload="onload()">
            <?php
            include_once './menu.php';
            ?>         
            <?php
            $ConsultaArquivo = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE excluido = 'S' $txt ORDER BY `nome`");
            $rowf = mysqli_num_rows($ConsultaArquivo);
            ?>
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-sm-12">
                        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
                        <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                        <script src="js/bootstrap.min.js" type="text/javascript"></script>
                        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>     
                        <link href="css/pesquisar_turmas_server.css" rel="stylesheet" type="text/css"/>
                        <script>
            $(document).ready(function () {
                $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
            });
                        </script>
                        <h3 style="text-align: center "> Arquivo Passivo </h3>
                        <form method="post" action="atualizar_varios_server.php" name="form1" onsubmit= " return confirmarAtualizacao()">
                            <!-- Modal Turmas-->
                            <div class="modal fade" id="myModal_Opcoes" role="dialog" >
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content" style="">
                                        <div class="modal-header">
                                            <button type="button btn-lg" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente aos Alunos</h4>
                                        </div>
                                        <div class="modal-body">
                                            <a href="cadastrar_no_arquivo_passivo.php" target="_self" class="btn btn-danger">Colocar no Arquivo</a>
                                            <button type="button" id="" data-toggle = "modal" data-target = "#myModal2" class="btn btn-warning"> Editar Pastas</button>
                                            <button type="button" id="editar_pasta2"  data-toggle = "modal" data-target = "#myModal" class="btn btn-primary" onclick="return validaCheckbox()" >Trocar de Pasta</button>
                                            <button type="submit" id="" data-toggle = "modal"  data-target = "" class="btn btn-success"   onclick="return validaCheckbox()" name="Arquivo_Passivo_Retirar">Retirar do Arquivo</button>

                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 " style=" margin-bottom: 12px">
                                    <?php
                                    echo"<button type='submit' name = 'Arquivo_Passivo_Retirar' id='inputRetirar' disabled = '' class='btn btn-success' onclick= 'return validaCheckbox()' title = 'Você precisa Marcar Somente Uma Caixinha para Usar Esse Botão:)'>Retirar do Arquivo</button>"
                                    . "&nbsp;&nbsp;<a href='cadastrar_no_arquivo_passivo.php' target='_self' class='btn btn-danger' id = 'cadastrar' >Colocar no Arquivo</a>"
                                    . "&nbsp;&nbsp;<button type='button' id='editar_pasta' data-toggle= 'modal' data-target='#myModal2' class='btn btn-warning' >Editar Pasta</button>"
                                    . "&nbsp;&nbsp;<button type='button' id='trocar_pasta' disabled = '' data-toggle= 'modal' data-target='#myModal' class='btn btn-primary' onclick= 'return validaCheckbox()'>Trocar de Pasta</button>"
                                    . "<button type='button' class='btn btn-link btn-lg verde glyphicon glyphicon-cog ' data-toggle='modal' data-target='#myModal_Opcoes' id = 'esconder_list'></button>"
                                    ?>
                                </div>  
                            </div>
                            <table id="tbl_alunos_lista" class="table table-striped table-bordered" width="100%" cellspacing="0">               
                                <thead>
                                    <tr>
                                    <!-- <th>Id</th>-->
                                        <th>
                                            <?php
                                            if ($rowf > 0) {
                                                echo "<div class='dropdown'>"
                                                . "<input type='checkbox'  class = 'selecionar' id = 'check'/>"
                                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                                . "<li><a><button type='submit' value='1' name = 'basica' class='btn btn-link btn-sm verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
                                                . "<li><a><button type='submit' value='2' name = 'basica' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
                                                . "</ul>"
                                                . "&nbsp;&nbsp;INEP" .
                                                "</div>";
                                            } else {
                                                echo "<div class='dropdown'>"
                                                . "<input type='checkbox'  class = 'selecionar' disabled = ''/>"
                                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                                . "<li><a><button type='submit' value='1' name = 'basica' class='btn btn-link btn-sm verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Básica</a></li>"
                                                . "<li><a><button type='submit' value='2' name = 'basica' class='btn btn-link verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Geral</a></li>"
                                                . "</ul>"
                                                . "&nbsp;&nbsp;INEP" .
                                                "</div>";
                                            }
                                            ?>
                                        </th>
                                        <th>NOME</th>
                                        <th id="ocultar">DATA</th>
                                        <th id="ocultar">MÃE</th>                                    
                                        <!--                                    <th id="ocultar">PAI</th>-->
                                        <th>PASTA</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>INEP</th>
                                        <th>NOME</th>
                                        <th id="ocultar">DATA</th>
                                        <th id="ocultar">MÃE</th>                                    
                                        <!--                                    <th id="ocultar">PAI</th>-->
                                        <th>PASTA</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
//$contTransferidos = 0;
                                    while ($linhaArquivoPassivo = mysqli_fetch_array($ConsultaArquivo)) {
                                        $id = $linhaArquivoPassivo['id'];
                                        $nascimento = new DateTime($linhaArquivoPassivo["data_nascimento"]);
                                        $nascimento = date_format($nascimento, 'd/m/Y');
                                        $pasta = $linhaArquivoPassivo['ap_pasta'];
                                        $excluido = $linhaArquivoPassivo['excluido'];
                                        $status = $linhaArquivoPassivo['status'];
                                        $status_ext = $linhaArquivoPassivo['status_ext'];
                                        $display2 = "";
                                        $display3 = "";
                                        ?>
                                        <tr>
                                        <!--<td><?php echo $linhaArquivoPassivo['id']; ?></td>-->
                                            <td>
                                                <?php
                                                if ($excluido == "S") {
                                                    $status = "ARQUIVADO";
                                                    $ap = $linhaArquivoPassivo['ap_pasta'];
                                                    $display = "bloco";
                                                    $display2 = "none";
                                                    $display4 = "none";
                                                } else {
                                                    $status = $linhaArquivoPassivo['status'];
                                                    $ap = "-----";
                                                    $display3 = "none";
                                                }
                                                //                                                if ($status == "TRANSFERIDO") {
                                                //                                                    $display = "bloco";
                                                //                                                } else {
                                                //                                                    $display = "none";
                                                //                                                }
                                                if ($status_ext == "") {
                                                    
                                                } else {
                                                    $status_ext = "ALUNO: OUVINTE";
                                                }
                                                echo""
                                                . "<div class='dropdown'>"
                                                . "<input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$id' id = 'ch'>"
                                                . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                                                . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                                                . "<li><a href='impressao.php?id=$id' target='_blank' title='Imprimir Folha de Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Matricula</a></li>"
                                                . "<li><a href='folha_re_matricula.php?id=$id' target='_blank' title='Imprimir Folha de Ré Matricula'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir Folha de Ré Matricula</a></li>"
                                                . "<li style = 'display :" . $display4 . "'><a href='declaracoes_bolsa_familia.php?id=$id' target='_blank' title='Declaração de Frequência Escolar'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Frequência Escolar</a></li>"
                                                . "<li style = 'display :" . $display . "'><a href='impressao_transferencia_provisoria_tratamento.php?id=$id' target='_blank' title='Imprimir Declaração de Transferência'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Declaração de Transferência</a></li>"
                                                . "<li style = 'display :'><a href='cadastrar_update.php?id=" . base64_encode($id) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar os Dados Cadastrais</a></li>"
                                                . "<li><a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($id) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user rosa' aria-hidden='true'>&nbsp;</span>Mostrar os Dados Cadastrais</a></li>"
                                                . "<li><a href='cadastrar_historico.php?id=" . base64_encode($id) . "' target='_blank' title='Histórico'><span class='glyphicon glyphicon-book azul' aria-hidden='true'>&nbsp;</span>Históricos/Transferências/Solicitações</a></li>"
                                                //  . "<li style = 'display :" . $display3 . "'><a href='alunos_arquivo_passivo.php?id=" . base64_encode($id) . "' target='_self' title='Arquivo Passivo'><span class='glyphicon glyphicon-folder-open ' aria-hidden='true' >&nbsp;</span>Retirar do Arquivo Passivo</a></li>"
                                                . "<li><a href='pesquisar_no_banco.php?id=" . base64_encode($id) . "' target='_self' title='Possível Caso de Duplicidade'><span class='glyphicon glyphicon-remove vermelho' aria-hidden='true'>&nbsp;</span>Possível Caso de Duplicidade</a></li>"
                                                . "</ul>"
                                                ;
                                                ?>
                                            </td>
                                            <td><?php echo $linhaArquivoPassivo['nome']; ?></td>
                                            <td id="ocultar"><?php echo $nascimento; ?></td>    
                                            <td id="ocultar"><?php echo $linhaArquivoPassivo['mae']; ?></td>
                                            <!--                                        <td id="ocultar"><?php echo $linhaArquivoPassivo['pai']; ?></td>-->
                                            <td ><?php echo "$pasta"; ?> </td>
                                        </tr>
                                        <?php
                                        //$contTransferidos += $Transferidos['qtd'];
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                                            <button type="button" class="close" data-dismiss="modal">Fechar</button>
                                            <h4 class="modal-title">Escolha a Pasta</h4>
                                        </div>
                                        <div class="modal-body">
                                            <br>
                                            <div class="">                                           
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="inputPasta" id="inputPasta">
                                                        <option disabled= "" selected="">A,B,C, ......</option>
                                                        <?php
                                                        $Consulta = mysqli_query($Conexao, "SELECT * FROM `pastas_arquivo_passivo` ORDER BY `PASTA`");
                                                        while ($linha = mysqli_fetch_array($Consulta)) {
                                                            $id = $linha['id'];
                                                            $pasta = $linha['pasta'];
                                                            $sql = mysqli_query($Conexao, "SELECT *,COUNT(*) AS cont FROM `alunos` WHERE `excluido` LIKE 'S' AND ap_pasta LIKE '$pasta'");
                                                            while ($result = mysqli_fetch_array($sql)) {
                                                                $cont = $result['cont'];
                                                                $txt = "Aluno(s)";
                                                            }
                                                            $cheio = $linha['cheio'];
                                                            if ($cheio == "SIM") {
                                                                $cheio = "Arquivo Físico Cheio! Na Dúvida Por Favor Verifique:)";
                                                            } else {
                                                                $cheio = "";
                                                            }
                                                            echo "<option value = '$pasta'>$pasta - $cont  $txt $cheio</option>";
                                                        }
                                                        ?>
                                                    </select>                                                 
                                                </div> 
                                                <button type="submit" name = "Arquivo_Passivo_trocar" value="Arquivo_Passivo_trocar" id ="Arquivo_Passivo_trocar" disabled="" class="btn btn-success" >Trocar</button>
                                            </div>
                                            <div class="modal-footer">                                         
                                                <!-- <button type="submit" name = "Arquivo_Passivo_trocar" value="Arquivo_Passivo_trocar"  class="btn btn-success" >Trocar</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal2 -->                        
                            <div id="myModal2" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header"> 
                                            <div class="col-sm-8">
                                                <h3 style="text-align: center;">Pastas Cadastradas</h3>
                                                <?php
                                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `pastas_arquivo_passivo` ORDER BY `PASTA`");
                                                while ($linha = mysqli_fetch_array($Consulta)) {
                                                    $pasta = $linha['pasta'];
                                                    echo "<div class = 'col-sm-1'>"
                                                    . "<input value = '$pasta'>"
                                                    . "</div>"
                                                    ;
                                                }
                                                ?>
                                            </div>

                                        </div>
                                        <div class="modal-body"> 
                                            <h4 class="modal-title">Nome da Pasta Nova</h4>
                                            <input type="text" name="inputPastaNova" onkeyup="maiuscula(this)"><br><br>
                                            <button type="submit" name = "Arquivo_Passivo_acrescentar_pasta" value="Arquivo_Passivo_acrescentar_pasta"  class="btn btn-success" >Acrescentar</button>
                                            <br><br><br>
                                            <!--Marcar como Cheia-->                          <!--Marcar como Cheia-->
                                            <h4 class="modal-title">Marcar Pasta Como Cheia</h4>
                                            <select class="form-control" name="inputPastaCheia" id="">
                                                <option disabled= "" selected="">A,B,C, .....etc.</option>
                                                <?php
                                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `pastas_arquivo_passivo` ORDER BY `PASTA`");
                                                while ($linha = mysqli_fetch_array($Consulta)) {
                                                    $id = $linha['id'];
                                                    $pasta = $linha['pasta'];
                                                    $cheio = $linha['cheio'];
                                                    if ($cheio == "SIM") {
                                                        $cheio = "Arquivo Físico Cheio! Na Dúvida Por Favor Verifique:)";
                                                    } else {
                                                        $cheio = "";
                                                    }
                                                    echo "<option value = '$id'>$pasta - $cheio</option>";
                                                }
                                                ?>
                                            </select>
                                            <br>
                                            <label class="radio-inline"><input type="radio" name="inputPastaCheiaSim" value="SIM">SIM</label>
                                            <label class="radio-inline"><input type="radio" name="inputPastaCheiaSim" value="NAO">NAO</label>
                                            <br>
                                            <br>
                                            <button type="submit" name = "Arquivo_Passivo_cheio" value="Arquivo_Passivo_cheio"  class="btn btn-primary" >Salvar Como Cheia</button>
                                            <br><br>
                                            <br>
                                            <!--Marcar como Cheia FIM--> 
                                            <h4 class="modal-title">Excluir Pasta</h4>
                                            <select class="form-control" name="inputPastaExclui" id="">
                                                <option disabled= "" selected="">A,B,C, .....etc.</option>
                                                <?php
                                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `pastas_arquivo_passivo` ORDER BY `PASTA`");
                                                while ($linha = mysqli_fetch_array($Consulta)) {
                                                    $id = $linha['id'];
                                                    $pasta = $linha['pasta'];
                                                    echo "<option value = '$id'>$pasta</option>";
                                                }
                                                ?>
                                            </select>
                                            <br><br>
                                            <button type="submit" name = "Arquivo_Passivo_excluir_pasta" value="Arquivo_Passivo_excluir_pasta"  class="btn btn-danger" >Remover</button>

                                            <div class="modal-footer"> 
                                                <button type="button" class="close" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>        
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
                    "lengthMenu": [[7, 10, 15, 20, 25, 35, 70, 100, -1], [7, 10, 15, 20, 25, 35, 70, 100, "All"]],
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

                    },
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
        <!--Valida Pastas-->
        <script type="text/javascript">
            $('.checkbox').click(function () {
                if (this.checked) {
                    $('#trocar_pasta').removeAttr('disabled');
                    $('#Arquivo_Passivo_trocar').removeAttr('disabled');
                } else {
                    var frm = document.form1;
                    //Percorre os elementos do for    mulário
                    for (i = 0; i < frm.length; i++) {
                        //Verifica se o elemento do formulário corresponde a um checkbox 
                        if (frm.elements[i].type == "checkbox") {
                            //Verifica se o checkbox foi sele cionado
                            if (frm.elements[i].checked) {
                                //alert("Exite ao menos um checkbox selecionado!");
                                return true;
                            }

                        }

                    }
                    //
                    $('#trocar_pasta').attr('disabled', 'disabled');
                    $('#Arquivo_Passivo_trocar').attr('disabled', 'disabled');
                }
            });
        </script>
        <script type="text/javascript">
            $('input[type=checkbox]').on('change', function () {
                var total = $('input[type=checkbox]:checked').length;
                //                 
                if (total > 1) {
                    $('#inputRetirar').attr('disabled', 'disabled');
                    alert('Você Marcou  ' + total + ' Caixinhas! \n\n Lembre-se que Só Poderá Retirar Um Aluno(a) Por Vez:)');
                } else if (total == "1") {
                    $('#inputRetirar').removeAttr('disabled');
                } else if (total == "0") {
                    $('#inputRetirar').attr('disabled', 'disabled');
                }
            });
        </script>   
        <!--Valida Pastas-->
        <script type="text/javascript">
            $(document).ready(function () {
                $('.selecionar').click(function () {
                    if (this.checked) {
                        $('#trocar_pasta').removeAttr('disabled');
                        $('#Arquivo_Passivo_trocar').removeAttr('disabled');
                    } else {
                        $('#trocar_pasta').attr('disabled', 'disabled');
                        $('#Arquivo_Passivo_trocar').attr('disabled', 'disabled');
                    }
                });
            });
        </script>
        <script type = "text/javascript">
            function validaCheckbox() {
                var frm = document.form1;
                        //Percorre os     elementos do formulário
                        for (i = 0; i < frm.length; i++) {
                    //Verifica se o elemento do formulário cor responde a um checkbox 
                    if (frm.elements[i].type == "checkbox") {
                        //Verifica se o c  heckbox foi selecionado
                        if (frm.elements[i].checked) {
                            // alert("Exite ao menos um c     heckbox selecionado!");
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

        <script type="text/javascript">
            function confirmarAtualizacao() {
                var r = confirm("Realmente deseja Alterar esse(s) Registro(s)");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>

        <script type="text/javascript">
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
            }
        </script>
    </html>
