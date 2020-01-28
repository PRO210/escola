<?php
session_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos`");
$Linhas = mysqli_num_rows($Consulta);
//
?>
<html lang="pt-br">
    <head>
        <meta charset='utf-8' />
        <title>AGENDAMENTOS</title>
        <link href="Calendario/fullcalendar.min.css" rel="stylesheet" type="text/css"/>       
        <link href="Calendario/fullcalendar.print.min.css" rel="stylesheet" type="text/css" media="print"/>
        <script src="Calendario/bootstrap.min.js" type="text/javascript"></script>
        <script src="Calendario/moment.min.js" type="text/javascript"></script>        
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="Calendario/fullcalendar.min.js" type="text/javascript"></script>
        <script src="Calendario/pt-br.js" type="text/javascript"></script>

        <style>
            body {
                margin: 40px 10px;
                padding: 0;
                font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
                font-size: 14px;
            }
            h2{
                font-size: 24px !important;
            }
            #calendar {
                max-width: 1000px;
                margin: 0 auto;
            }
            .close{
                color: red !important;
                opacity: 1 !important;
                margin-top: -22px !important;
                font-size: 28px !important;
            }            
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <h1 class="text-center"> AGENDAMENTOS </h1>
            <script>
                $(document).ready(function () {
                    $('#calendar').fullCalendar({
                        customButtons: {
                            myCustomButton: {
                                text: 'Menu Principal',
                                click: function () {
                                    location.href = '/Escola/principal.php';
                                }
                            }
                        },
                        //
                        header: {
                            left: 'prev,next today,myCustomButton',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay,listWeek'
                        },
                        //
                        defaultDate: Date(),
                        navLinks: true, // can click day/week names to navigate views
                        editable: true,
                        eventLimit: true, // allow "more" link when too many events
                        //
                        selectable: true,
                        selectHelper: true,
                        select: function (start, end) {
                            $('#cadastrar #start2').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
                            $('#cadastrar #end2').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
                            //
                            $('#cadastrar').modal('show');
                            return false;
                        },
                        //
                        events: [
<?php
while ($row_events = mysqli_fetch_array($Consulta)) {
    ?>
                                {
                                    id: '<?php echo $row_events['id']; ?>',
                                    title: '<?php echo $row_events['title']; ?>',
                                    start: '<?php echo $row_events['start']; ?>',
                                    end: '<?php echo $row_events['end']; ?>',
                                    color: '<?php echo $row_events['color']; ?>'
                                },<?php
}
?>
                        ],
                        //
                        eventClick: function (event) {

                            // change the border color just for fun
                            $(this).css('border-color', 'red');
                            //
                            $('#visualizar #id').text(event.id);
                            $('#visualizar #id').val(event.id);
                            $('#visualizar #id_json').val(event.id);
                            $('#visualizar #title').text(event.title);
                            $('#visualizar #title').val(event.title);
                            $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
                            $('#visualizar #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
                            $('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
                            $('#visualizar #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));
                            //
                            json();
                            //
                            $('#visualizar').modal('show');
                            return false;
                        },
                    });
                });
                //Mascara para o campo data e hora
                function DataHora(evento, objeto) {
                    var keypress = (window.event) ? event.keyCode : evento.which;
                    campo = eval(objeto);
                    if (campo.value == '00/00/0000 00:00:00') {
                        campo.value = ""
                    }
                    caracteres = '0123456789';
                    separacao1 = '/';
                    separacao2 = ' ';
                    separacao3 = ':';
                    conjunto1 = 2;
                    conjunto2 = 5;
                    conjunto3 = 10;
                    conjunto4 = 13;
                    conjunto5 = 16;
                    if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
                        if (campo.value.length == conjunto1)
                            campo.value = campo.value + separacao1;
                        else if (campo.value.length == conjunto2)
                            campo.value = campo.value + separacao1;
                        else if (campo.value.length == conjunto3)
                            campo.value = campo.value + separacao2;
                        else if (campo.value.length == conjunto4)
                            campo.value = campo.value + separacao3;
                        else if (campo.value.length == conjunto5)
                            campo.value = campo.value + separacao3;
                    } else {
                        event.returnValue = false;
                    }
                }
            </script> 
            <script type="text/javascript">
                var teste = $("#fechar").hasClass("fechar");
                var intervalo = window.setInterval(lerolero, 50000);
                //
                function lerolero() {
                    if (teste) {
                        $('.fechar').hide('10000');
                    }

                }
            </script>

            <div id='calendar'></div>

            <!--Modal Visualizar os Eventos-->  <!--Modal Visualizar os Eventos-->  <!--Modal Visualizar os Eventos-->
            <link href="Calendario/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <script src="Calendario/bootstrap.min.js" type="text/javascript"></script>           
            <form method="post" action="agendamentos_materiais_server.php" name="form1" class="form-horizontal">
                <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop = "static">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 36px"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center" >Eventos do Dia</h4>
                            </div>                       
                            <div class="modal-body">
                                <div class="visualizar">
                                    <dl class="dl-horizontal">
                                        <input type="hidden" class="form-control" name="id" id="id_json">
                                        <dt>ID do Evento</dt>
                                        <dd id="id"></dd>
                                        <dt>Titulo do Evento</dt>
                                        <dd id="title"></dd>                                       
                                        <dt>Inicio do Evento</dt>
                                        <dd id="start"></dd>
                                        <dt>Fim do Evento</dt>
                                        <dd id="end"></dd>

                                        <dt>Servidor</dt>
                                        <dd id="servidor_json"></dd>

                                        <dt>Material</dt>
                                        <dd id="material_json"></dd>

                                        <dt>Quantidade</dt>
                                        <dd id="quantidade_json"></dd>

                                        <dt>Observações:</dt>
                                        <dd id="obs_json"></dd>
                                    </dl> 
                                    <button type="button" class="btn btn btn-warning btn-block" id="editar" onclick="json()">Editar</button><br>
                                    <button type="submit" class="btn btn btn-danger btn-block" name="botao" value="excluir" id="excluir" >Excluir</button>
                                </div>
                                <!--Editar Evento   Editar Evento-->
                                <!--Editar Evento   Editar Evento-->    <!--Editar Evento   Editar Evento-->  <!--Editar Evento   Editar Evento-->
                                <!--Editar Evento   Editar Evento-->
                                <div id="divEditar" style="display: none ">
                                    <input type="hidden" class="form-control" name="id" id="id">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="Title" id="title" placeholder="Titulo do Evento" onkeyup="maiuscula(this)">
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
                                        <div class="col-sm-10">
                                            <select name="Color" class="form-control" id="color_json">
                                                <option value="">Selecione</option>			
                                                <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                                <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                                <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                                <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                                                <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                                <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                                <option style="color:#FF69b4;" value="#FF69b4">Rosa</option>
                                                <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                                <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>										
                                                <option style="color:#228B22;" value="#228B22">Verde</option>
                                                <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Data Inicial</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="Start" id="start" onKeyPress="DataHora(event, this)" onblur="teste()">
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        function teste() {
                                            alert("ok");
                                        }

                                    </script>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Data Final</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="End" id="end" onKeyPress="DataHora(event, this)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Servidores</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="Servidor" id="servidor_json2" >
                                                <option  value="0" selected="">Escolha Um Servidor</option>
                                                <?php
                                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `excluido` = 'N' ORDER BY nome");
                                                echo "<option disabled selected>SELECIONE O SERVIDOR ! </option>";
                                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                    $nome = $Registro["nome"];
                                                    $id = $Registro["id"];
                                                    echo "<option value = '$id'>$nome</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Evento Um-->     <!--Evento Um-->    <!--Evento Um-->
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Materiais</label>
                                        <div class="col-sm-4">
                                            <select class="form-control"  name="Material" id="material_json2">
                                                <option  value="0" selected="">Escolha Algum Material</option>
                                                <?php
                                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` ORDER BY `nome` ASC");
                                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                    echo "</tr>";
                                                    $id = $Registro["id"];
                                                    $nome = $Registro["nome"];
                                                    //
                                                    echo "<option value = '$id'>$nome</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <label for="" class="col-sm-1 control-label">Disp.</label>
                                        <div class="col-sm-2">
                                            <input type="number" step="1" class="form-control" name="" id="disp11">
                                        </div>
                                        <label for="" class="col-sm-1 control-label">Req.</label>
                                        <div class="col-sm-2">
                                            <input type="number" min= "1" step="1" class="form-control" name="Quantidade" id="quantidade_json2">
                                        </div>
                                    </div>
                                    <!--Fim do Evento Um-->
                                    <!--Material Dois-->
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Materiais</label>
                                        <div class="col-sm-4">
                                            <select class="form-control"  name="Material88" id="material_json22">
                                                <option  value="0" selected="">Escolha Algum Material</option>
                                                <?php
                                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` ORDER BY `nome` ASC");
                                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                    $id = $Registro["id"];
                                                    $nome = $Registro["nome"];
                                                    //
                                                    echo "<option value = '$id'>$nome</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <label for="" class="col-sm-1 control-label">Disp.</label>
                                        <div class="col-sm-2">
                                            <input type="number" step="1" class="form-control" name="" id="disp22">
                                        </div>
                                        <label for="" class="col-sm-1 control-label">Req.</label>
                                        <div class="col-sm-2">
                                            <input type="number" min= "0" step="1" class="form-control" name="Quantidade88" id="quantidade_json22">
                                        </div>
                                    </div>
                                    <!--Evento três-->
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Materiais</label>
                                        <div class="col-sm-4">
                                            <select class="form-control"  name="Material99" id="material_json33">
                                                <option  value="0" selected="">Escolha Algum Material</option>
                                                <?php
                                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` ORDER BY `nome` ASC");
                                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                    $id = $Registro["id"];
                                                    $nome = $Registro["nome"];
                                                    //
                                                    echo "<option value = '$id'>$nome</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <label for="" class="col-sm-1 control-label">Disp.</label>
                                        <div class="col-sm-2">
                                            <input type="number" step="1" class="form-control" name="" id="disp33">
                                        </div>
                                        <label for="" class="col-sm-1 control-label">Req.</label>
                                        <div class="col-sm-2">
                                            <input type="number" min= "0" step="1" class="form-control" name="Quantidade99" id="quantidade_json33">
                                        </div>
                                    </div>
                                    <div class="form-group">                                  
                                        <label for="inputTextArea" class=" control-label col-sm-2">Observações:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="4" id="inputTextArea2" name="inputTextArea2"></textarea>
                                        </div>
                                    </div>
                                    <!--Fim do Evento três-->
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-4">
                                            <button type="submit" class="btn btn-success btn-block" name="botao" id="Atualizar" onclick="return confirmar_atualizar()" value="atualizar">Salvar Alterações</button>
                                        </div>
                                        <div class="col-sm-offset-2 col-sm-4">
                                            <button  type="button" class="btn btn btn-warning btn-block" id="cancelar">Cancelar</button>
                                        </div>
                                    </div>                                  
                                </div>                                
                                <!--Fim do Editar Evento    Fim do Editar Evento-->  
                            </div>
                        </div>
                    </div>
                    <script src="agendamentos_materiais.js" type="text/javascript"></script> 
                    <script src="agendamentos_materiais_disponivel_edit.js" type="text/javascript"></script>
                    <script src="agendamentos_materiais_disponivel_edit_1.js" type="text/javascript"></script>                                 
                </div>
                <!--Cadastrar novo Evento-->                     <!--Cadastrar novo Evento-->
                <!--Cadastrar novo Evento-->                     <!--Cadastrar novo Evento-->
                <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 36px"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center">Cadastrar Evento</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" placeholder="Titulo do Evento" onkeyup="maiuscula(this)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Servidores</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="inputServidor" id="inputServidor" required="">
                                            <?php
                                            $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `excluido` = 'N' ORDER BY nome");
                                            echo "<option value = '0' selected>SELECIONE O SERVIDOR ! </option>";
                                            while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                $nome = $Registro["nome"];
                                                $id = $Registro["id"];
                                                echo "<option value = '$id'>$nome</option>";
                                            }
                                            ?>                                           
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Data Inicial/Hora</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="start" id="start2" onKeyPress="DataHora(event, this)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Data Final/Hora</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="end" id="end2" onKeyPress="DataHora(event, this)">
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Material 1</label>
                                    <div class="col-sm-4">
                                        <select class="form-control"  name="inputMaterial" id="material_disp1">
                                            <option disabled="" value="0" selected="">Escolha Algum Material</option>
                                            <?php
                                            $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` ORDER BY `nome` ASC");
                                            while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                echo "</tr>";
                                                $id = $Registro["id"];
                                                $nome = $Registro["nome"];
                                                //
                                                echo "<option value = '$id'>$nome</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>                                   
                                    <label for="" class="col-sm-1 control-label">Disp.</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="1" class="form-control" name="" id="disp1">
                                    </div>
                                    <label for="" class="col-sm-1 control-label">Requer.</label>
                                    <div class="col-sm-2">
                                        <input type="number" min= "1" step="1" class="form-control" name="inputQuantidade11" id="qtd1">
                                    </div>
                                </div>
                                <!--                                                            
                                <!--Material Dois-->
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Material 2</label>
                                    <div class="col-sm-4">
                                        <select class="form-control"  name="inputMateria22" id="material_disp2">
                                            <option  value="0" selected="">Escolha Algum Material</option>
                                            <?php
                                            $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` ORDER BY `nome` ASC");
                                            while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                $id = $Registro["id"];
                                                $nome = $Registro["nome"];
                                                //
                                                echo "<option value = '$id'>$nome</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>                                   
                                    <label for="" class="col-sm-1 control-label">Disp.</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="1" class="form-control" name="" id="disp2">
                                    </div>
                                    <label for="" class="col-sm-1 control-label">Requer.</label>
                                    <div class="col-sm-2">
                                        <input type="number" min= "1" step="1" class="form-control" name="inputQuantidade22" id="qtd2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Material 3</label>
                                    <div class="col-sm-4">
                                        <select class="form-control"  name="inputMateria33" id="material_disp3">
                                            <option  value="0" selected="">Escolha Algum Material</option>
                                            <?php
                                            $Consulta = mysqli_query($Conexao, "SELECT * FROM `materiais` ORDER BY `nome` ASC");
                                            while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                                $id = $Registro["id"];
                                                $nome = $Registro["nome"];
                                                //
                                                echo "<option value = '$id'>$nome</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>                                    
                                    <label for="" class="col-sm-1 control-label">Disp.</label>
                                    <div class="col-sm-2">
                                        <input type="number" step="1" class="form-control" name="" id="disp3">
                                    </div>
                                    <label for="" class="col-sm-1 control-label">Requer.</label>
                                    <div class="col-sm-2">
                                        <input type="number" min= "1" step="1" class="form-control" name="inputQuantidade33" id="qtd3">
                                    </div>
                                </div>                          
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Cor</label>
                                    <div class="col-sm-10">
                                        <select name="color" class="form-control" id="color" >
                                            <option value="#0071c5">Selecione</option>			
                                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                            <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                                            <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                            <option style="color:#FF69b4;" value="#FF69b4">Rosa</option>
                                            <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>										
                                            <option style="color:#228B22;" value="#228B22">Verde</option>
                                            <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group">                                  
                                    <label for="inputTextArea" class=" control-label col-sm-2">Observações:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="4" id="inputTextArea" name="inputTextArea"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">                                       
                                        <button type="submit" class="btn btn-success btn-block" name="botao"  id="cadastrar_teste" onclick="return confirmar()" value="cadastrar">Cadastrar</button>                                       
                                    </div>
                                </div>
                                <!--Botão Cadastrar-->  <!--Botão Cadastrar-->  <!--Botão Cadastrar-->
                                <script type="text/javascript">
                                    function confirmar() {
                                        var u = "<?php echo $usuario_logado ?>";
                                        var r = confirm("Posso Enviar " + u + "? ");
                                        //var r = confirm("Posso Enviar ? ");
                                        var d1 = $("#disp1").val();
                                        var r1 = $("#qtd1").val();
                                        var d2 = $("#disp2").val();
                                        var r2 = $("#qtd2").val();
                                        var d3 = $("#disp3").val();
                                        var r3 = $("#qtd3").val();

                                        if (r == true) {
                                            return true;
                                        } else {
                                            return false;
                                        }
                                    }
                                </script>
                                <!--Bordar no Evento Cadastrar-->
                                <script>
                                    $(document).ready(function () {
                                        $("#qtd1").blur(function () {
                                            var d1 = $("#disp1").val();
                                            var r1 = $("#qtd1").val();
                                            if (r1 <= d1) {
                                                $("#qtd1").css('border-color', '#ccc');
                                            } else {
                                                $("#qtd1").css('border-color', 'red');
                                            }
                                        });
                                    });
                                </script>
                                <!--Bordar no Evento Cadastrar-->
                                <script>
                                    $(document).ready(function () {
                                        $("#qtd2").blur(function () {
                                            var d2 = $("#disp2").val();
                                            var r2 = $("#qtd2").val();
                                            if (r2 <= d2) {
                                                $("#qtd2").css('border-color', '#ccc');
                                            } else {
                                                $("#qtd2").css('border-color', 'red');
                                            }
                                        });
                                    });
                                </script>
                                <!--Bordar no Evento Cadastrar-->
                                <script>
                                    $(document).ready(function () {
                                        $("#qtd3").blur(function () {
                                            var d3 = $("#disp3").val();
                                            var r3 = $("#qtd3").val();
                                            if (r3 <= d3) {
                                                $("#qtd3").css('border-color', '#ccc');
                                            } else {
                                                $("#qtd3").css('border-color', 'red');
                                            }
                                        });
                                    });
                                </script>                               
                                <!--Botão Atualizar-->  <!--Botão Atualizar-->  <!--Botão Atualizar-->
                                <script type="text/javascript">
                                    function confirmar_atualizar() {
                                        var u = "<?php echo $usuario_logado ?>";
                                        var r = confirm("Posso Enviar " + u + "? ");
                                        if (r == true) {
                                            return true;
                                        } else {
                                            return false;
                                        }
                                    }
                                </script>
                                <script type="text/javascript">
                                    $('#editar').on("click", function () {
                                        $('#divEditar').slideToggle();
                                        $('.visualizar').slideToggle();
                                    });
                                    $('#cancelar').on("click", function () {
                                        $('.visualizar').slideToggle();
                                        $('#divEditar').slideToggle();
                                    });
                                </script>   
                                <script>
                                    // INICIO FUNÇÃO DE MASCARA MAIUSCULA
                                    function maiuscula(z) {
                                        v = z.value.toUpperCase();
                                        z.value = v;
                                    }
                                </script>                               
                            </div>
                        </div>
                    </div>
                </div>
                <script src="agendamentos_materiais_disponivel.js" type="text/javascript"></script>
            </form>
        </div>       
    </body>
</html>
