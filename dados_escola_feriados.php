<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($Recebe_id == "1") {
    //
    echo "<script type=\"text/javascript\">
		alert(\"Documentos Gravados com Sucesso! \");
                </script>
                ";
    //
} elseif ($Recebe_id == "2") {
    //
    echo "<script type='text/javascript'>
                alert('Falha na operação ');
          </script>";
    //
} elseif ($Recebe_id == "3") {
    //
    echo "<script type='text/javascript'>
                alert('A página Ações Passadas não gravou essas mudanças por favor, comunique à administração do Sistema');
          </script>";
}
?>
<html lang="pt-br">
    <head>        
        <?php
        include_once './head.php';
        ?>
        <title>CALENDÁRIO ESCOLAR</title>
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
        <h3 style="text-align: center "> CALENDÁRIO ESCOLAR</h3>
        <?php
        $ConsultaTransferidos = mysqli_query($Conexao, "SELECT * FROM `dia_mes_ano` ORDER BY `dia_mes_ano`.`d_m_a` DESC ");
        $Numero_alunos_transferidos = mysqli_num_rows($ConsultaTransferidos);
        ?>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>      
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>      
        <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script>
        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="dados_escola_feriados_server.php" name="form1">
                    <div class="container-fluid" >
                        <!-- Modal Turmas-->
                        <div class="modal fade" id="myModal" role="dialog" >
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content" style="">
                                    <div class="modal-header">
                                        <button type="button btn btn-lg" class="close" data-dismiss="modal">&times;</button>
                                        <h5 class="modal-title" style="text-align: center">Opções Referente aos Feriados</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-sm-12">                                                 
                                                <label for="" class="col-sm-4 control-label ">É Feriado ?</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="inputFeriado" id=""> 
                                                        <option value="NÃO">------</option>
                                                        <option>SIM</option>
                                                        <option>NÃO</option>
                                                    </select>
                                                </div>                          
                                            </div>
                                        </div>
                                        <div class="row" id="dois">
                                            <div class="form-group col-sm-12">
                                                <label for="" class="col-sm-4 control-label">Nome do Feriado</label>
                                                <div class="col-sm-8">
                                                    <input type="text" placeholder="DIGITE O NOME DO FERIADO" class="form-control"  name= "inputNomeFeriado" id= ""  onkeyup="maiuscula(this)">
                                                </div>                                              
                                            </div>
                                            <?php
                                            if ($Numero_alunos_transferidos > 0) {
                                                echo "<button  type='submit' name = 'botao' value='' class = 'btn-block btn btn-success' onclick= 'return validaCheckbox()'>Atualizar os Feriados</button>";
                                            } else {
                                                echo "<button disabled = '' style='margin-bottom: 6px;' type='submit' name = 'botao' value='' class = 'btn-block btn btn-success' onclick= 'return validaCheckbox()'>Atualizar os Feriados</button>";
                                            }
                                            ?>
                                        </div>
                                        <br>
                                        <br> 
                                        <div class="row" id="dois">
                                            <div class="form-group col-sm-12">
                                                <label for=""  class="col-sm-4 control-label">Escolha o Ano</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="inputInicial" id="inputInicial">
                                                        <option  selected="" value="" >Selecione o Ano  Que Deseja Cadastrar</option>
                                                        <option>2008</option>
                                                        <option>2009</option>
                                                        <option>2010</option>
                                                        <option>2011</option>
                                                        <option>2012</option>
                                                        <option>2013</option>
                                                        <option>2014</option>
                                                        <option>2015</option>
                                                        <option>2016</option>
                                                        <option>2017</option>
                                                        <option>2018</option>
                                                        <option>2019</option>
                                                        <option>2020</option>
                                                        <option>2021</option>
                                                        <option>2022</option>
                                                        <option>2023</option>
                                                        <option>2024</option>
                                                        <option>2025</option>
                                                        <option>2026</option>
                                                        <option>2027</option>
                                                        <option>2028</option> 
                                                    </select>
                                                </div>                                               
                                            </div>                                                                                   
                                            <button type="submit" name="botao2" disabled="" id = "botao2" class="btn btn-primary btn-block" title="Ecolha Um Ano Para Liberar Esse Botão!">Cadastrar Novo Ano!</button>
                                        </div>
                                        <br>
                                        <br>                                       
                                        <div class="row" id="tres">
                                            <div class="form-group col-sm-12">
                                                <label for=""  class="col-sm-4 control-label">Escolha o Ano</label>
                                                <div class="col-sm-8">
                                                    <select name="inputInicialExclui" class="form-control" id="exclui">
                                                        <option  selected="" value="" >Selecione o Ano  Que Desejas Excluir</option>
                                                        <?php
                                                        $sql = "SELECT * FROM `dia_mes_ano` GROUP BY ano";
                                                        $consulta = mysqli_query($Conexao, $sql);
                                                        while ($Registro = mysqli_fetch_array($consulta, MYSQLI_BOTH)) {
                                                            $ano = $Registro["ano"];
                                                            echo "<option>$ano</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>                                               
                                            </div>
                                            <button type="submit" name="botao3"  id="botao3"class="btn btn-block btn-warning" disabled="" title="Ecolha Um Ano Para Liberar Esse Botão!">Excluir Ano do Sistema</button>
                                        </div>
                                        <br> 
                                        <br>
                                        <div class="row" id="dois">
                                            <div class="form-group col-sm-12">
                                                <label for="" class="col-sm-4 control-label">Nome do Compromisso</label>
                                                <div class="col-sm-8">                                                   
                                                    <textarea class="form-control" rows="2" maxlength="70" id="" name="inputCompromisso" placeholder="DIGITE O NOME DO COMPROMISSO" onkeyup="maiuscula(this)"></textarea>
                                                </div>                                              
                                            </div>
                                            <button type="submit" name="botao4"  id = "botao4" class="btn btn-success btn-block" title="" onclick= 'return validaCheckbox()'>Atualizar Compromisso!</button>
                                        </div>
                                        <br>
                                        <br> 
                                        <div class="modal-footer"> 
                                            <button type="reset" name=""  id="reset" onclick="return reset()" class="btn btn-block btn-danger"  title= "Esse Botão Limpa os Campos Selecionados!" >Limpar os Campos</button>
                                        </div>                            
                                    </div>                       
                                </div>
                            </div>
                        </div>    
                        <table id="example" class="nowrap table table-striped table-bordered" width="100%" cellspacing="0">               
                            <thead>
                                <tr>                                  
                                    <th>
                                        <?php
                                        if ($Numero_alunos_transferidos > 0) {
                                            echo""
                                            . "<span class = 'spanChekbox'><input type='checkbox'  class = 'selecionar'/></span>";
                                        } else {
                                            echo""
                                            . "<span class = 'spanChekbox'><input type='checkbox'  class = 'selecionar' disabled = ''/></span>";
                                        }
                                        ?>
                                    </th>                                                                                            
                                    <th>DATA</th>                                    
                                    <th>FERIADO</th>                                    
                                    <th>NOME DO FERIADO</th>                                 
                                    <th>COMPROMISSOS</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($linhaTransferidos = mysqli_fetch_array($ConsultaTransferidos)) {
                                    //
                                    $id = $linhaTransferidos['id'];
                                    $d_m_a = date_format(new DateTime($linhaTransferidos['d_m_a']), 'd-m-Y');
                                    $feriado = $linhaTransferidos["feriados"];
                                    $feriado_nome = $linhaTransferidos["feriado_nome"];
                                    ?>
                                    <tr>       
                                        <td> </td>
                                        <td id="tdNome">
                                            <?php
//                                            echo""
//                                            . "<div class='dropdown'>"
//                                            . "<span class = 'spanChekbox'><input type='checkbox'  name = 'aluno_selecionado[]' class = 'checkbox' value='$id'></span>"
//                                            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
//                                            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
//                                            //  . "<li><button type='button' name = 'botao' data-toggle='modal' data-target='#myModal'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true'  >&nbsp;</span>Alterar os Dados</button</li>"
//                                            . "</ul>"
//                                            . "&nbsp;&nbsp;$d_m_a"
//                                            . "</div>"
//                                            ;
                                            echo""
                                            . "<span class = 'spanChekbox'><input type='checkbox'  name = 'aluno_selecionado[]' class = 'checkbox' value='$id'></span>"
                                            . "&nbsp;&nbsp;$d_m_a"
                                            . "</div>"
                                            ;
                                            ?> 
                                        </td>  
                                        <td>
                                            <?php if ($feriado == "SIM") { ?>
                                                <label class="radio-inline"><b>SIM</b></label>

                                            <?php } else { ?>
                                                <label class="radio-inline"><b>NÃO</b></label>
                                            <?php } ?>

                                        </td>                                  
                                        <td><?php echo $feriado_nome ?></td>                        
                                        <td><?php echo $linhaTransferidos["compromissos"]; ?></td>                             

                                    </tr>
                                <?php } ?>                                                                 
                            <tfoot>
                                <tr>     
                                    <td> </td>
                                    <th>DATA</th>
                                    <th>FERIADO</th>
                                    <th>NOME DO FERIADO</th>                                                                     
                                    <th>COMPROMISSOS</th>  
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>            
        <script type="text/javascript">
            $('#reset').click(function () {
                //
                $('#botao2').attr('disabled', 'disabled');
                $('#botao3').attr('disabled', 'disabled');
                //
            });
        </script> 
        <script type="text/javascript">
            $(document).ready(function () {
                $('#inputInicial').change(function () {
                    var textoOptionSelecionado = $('#inputInicial option:selected').text(); // armazendando em variavel
                    // alert("Texto do option selecionado: " + textoOptionSelecionado); // mostrando um alerta na tela
                    if (textoOptionSelecionado == "Selecione o Ano  Que Deseja Cadastrar") {
                        $('#botao2').attr('disabled', 'disabled');
                    } else {
                        $('#botao2').removeAttr('disabled');
                    }
                });
            });
        </script> 
        <script type="text/javascript">
            $(document).ready(function () {
                $('#exclui').change(function () {
                    var textoOptionSelecionado = $('#exclui option:selected').text(); // armazendando em variavel
                    // alert("Texto do option selecionado: " + textoOptionSelecionado); // mostrando um alerta na tela

                    if (textoOptionSelecionado == "Selecione o Ano  Que Desejas Excluir") {
                        $('#botao3').attr('disabled', 'disabled');
                    } else {
                        $('#botao3').removeAttr('disabled');

                    }
                });
            });

        </script> 
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
                    "lengthMenu": [[10, 20, 30, 40, 50, 100, 200, 400, -1], [10, 20, 30, 40, 50, 100, 200, 400, "All"]],
                    "language": {
                        "lengthMenu": "Dias por Página _MENU_ <?php
                                echo ""
                                . "<button type='button' data-toggle='modal' data-target='#myModal' class='btn btn-success' >Criar/Atualizar Dia(s)</button>"
                                ?> ",
                        "zeroRecords": "Nenhum Dia Encontrado",
                        "info": "Mostrando pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "Sem registros",
                        "search": "Busca:",
                        "infoFiltered": "(filtrado de _MAX_ total de Dias)",
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
                alert("Nenhuma Caixinha Foi Selecionada!");
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
