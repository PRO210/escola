<?php
include_once 'valida_cookies.inc';
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
$hoje = date('d/m/Y');
?>
<?php
$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($Recebe_id == "2") {
    echo "<script type='text/javascript'>
                alert('A Pesquisa Retornou em Branco! Logo não há o que Listar.');
          </script>";
}
?>
<html lang="pt-br">
    <head>      
        <?php
        include_once './head.php';
        ?>     
        <title>MONTAR RELAT. ATESTADOS</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>     
        <div class="container-fluid"><br>            
            <div class="row">
                <div class="col-sm-12" >
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
                    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <form method="post" action="montar_relatorio_atestados_etc_server.php" name="">
                        <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ENVIADOS</th>
                                    <th>REMUNERADO</th>
                                    <th>ENVIADO/DATA</th>
                                    <th>ENCERRADO</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <tr>
                                    <td><input type="radio" class="envio" name="inputEnviado" value= "SIM" >&nbsp;&nbsp;SIM</td>
                                    <td><input type="radio" class="" name="inputRemunerado" value= "SIM">&nbsp;&nbsp;SIM</td>
                                    <td><input type="date" name="inputDataFIM" disabled="" id="inputDataFIM" required="">&nbsp;&nbsp;FIM</td>
                                    <td><input type="radio" class="" name="inputEncerrado" value= "SIM" >&nbsp;&nbsp;SIM</td>

                                </tr>
                                <tr>
                                    <td><input type="radio" class="enviado_nao" name="inputEnviado" value= "NÃO" >&nbsp;&nbsp;NÃO</td>                                    
                                    <td><input type="radio" class="" name="inputRemunerado" value= "NÃO" >&nbsp;&nbsp;NÃO</td>
                                    <td><input type="date" name="inputDataInicio" disabled="" id="inputDataInicio" required="">&nbsp;&nbsp;INÍCIO</td>
                                    <td><input type="radio" class="" name="inputEncerrado" value= "NÃO">&nbsp;&nbsp;NÃO</td>

                                </tr>
                                <tr>
                                    <td><input type="radio" class="enviado_todos" name="inputEnviado" value= "TODOS_ENVIADOS" id="" checked="">&nbsp;&nbsp;TODOS</td> 
                                    <td><input type="radio" class="selecionarTodas" name="inputRemunerado" value= "" id="" checked="">&nbsp;&nbsp;TODOS</td>  
                                    <td></td>  
                                    <td><input type="radio" class="" name="inputEncerrado" value= "" checked="">&nbsp;&nbsp;TODOS</td>

                                </tr>
                            </tbody>
                        </table> 

                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" value="inputNome" class="btn btn-success" id="inputNome" onclick="return confirmarAtualizacao()" >Gerar</button>              
                                    <button type="reset" class="btn btn-danger">Limpar</button>
                                </div>
                            </div>
                        </div>
                    </form>          
                </div>
            </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable({
                "lengthMenu": [[10, 35, 70, 100, -1], [10, 35, 70, 100, "All"]],
                "language": {
                    "lengthMenu": "Por Página _MENU_",
                    "zeroRecords": "Nada encontrado",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Sem registros",
                    "search": "Busca:",
                    "infoFiltered": "(filtrado de _MAX_ total de )",
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
    <script type="text/javascript">
        function confirmarAtualizacao() {
            var r = confirm("Posso Enviar?");
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.envio').click(function () {
                $('#inputDataInicio').removeAttr('disabled');
                $('#inputDataFIM').removeAttr('disabled');
            });
            $('.enviado_nao').click(function () {
                $('#inputDataInicio').attr('disabled', 'disabled');
                $('#inputDataFIM').attr('disabled', 'disabled');
            });
            $('.enviado_todos').click(function () {
                $('#inputDataInicio').attr('disabled', 'disabled');
                $('#inputDataFIM').attr('disabled', 'disabled');
            });

        });
    </script>  
</html>
