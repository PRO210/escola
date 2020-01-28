<?php
ob_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$rota = "";
$titulo = "";
$Msg = "";
$M = "";
//
if ($Recebe_id == "escola") {
    header("Location:dados_escola.php");
} elseif ($Recebe_id == "transporte") {
    $rota = "alunos_configuracoes_server.php";
    $titulo = "Opçoes Extras Referente aos Alunos";
} elseif ($Recebe_id == "sucesso") {
    $rota = "alunos_configuracoes_server.php";
    $titulo = "Opçoes Extras Referente aos Alunos";
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Alterações Realizadas com Sucesso! </div>";
    $M = "1";
} elseif ($Recebe_id == "erro") {
    $rota = "alunos_configuracoes_server.php";
    $titulo = "Opçoes Extras Referente aos Alunos";
    $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Alguma Coisa Deu errado Tente de Novo ou Entre em Contato com o Administrador </div>";
    $M = "2";
}
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
       <title></title> 
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
        <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script>       
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>   
        <style>      
            .verde{color: green; padding-bottom: 12px; font-size: 16px;}
            .vermelho{ color: red !important; padding-bottom: 12px !important;  }
            tfoot input {width: 100%;padding: 3px;box-sizing: border-box;}            
            #TdNome{
                white-space: normal;
            }
        </style>
        <div class="container">           
            <!--MODAL MSG-->
            <div class="modal fade" id="exemplomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="gridSystemModalLabel">Avisos</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            echo $Msg;
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($M == "1") {
                echo"<script type='text/javascript'>

                $(document).ready(function () {
                    $('#exemplomodal').modal('show');
                });
            </script>";
            } elseif ($M == "2") {
                echo"<script type='text/javascript'>

                $(document).ready(function () {
                    $('#exemplomodal').modal('show');
                });
            </script>";
            }
            ?>
            <h4 style="text-align: center"><?php echo "$titulo"; ?></h4>           
            <?php
            //
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos_transporte`");
            echo "<form method = 'post' action = '$rota' name = 'form1'>";
            echo "<table class='nowrap table table-striped table-bordered ' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th style = 'width:10%'>"
            . "<div class='dropdown'>"
            . "<input type='checkbox'  class = 'selecionar' />"
            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a><button type='submit' value='excluir_turmas' name = 'botao' class='btn btn-link vermelho' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-remove ' aria-hidden='true'></span></button>Excluir o(s) Ponto(s) de Ônibus</a></li>"
            . "<li><a><button type='button' value=''  name = 'botao' class='btn btn-link verde' data-toggle='modal' data-target='#myModal_2' ><span class='glyphicon glyphicon-plus ' aria-hidden='true'></span></button>Cadastrar Novo Ponto de Ônibus</a></li>"
            . "</ul>"
            . "</div>"
            . "</th>";
            echo "<th> NOME </th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tfoot>";
            echo "<tr>";
            echo "<th></th>";
            echo "<th> NOME </th>";
            echo "</tr>";
            echo "</tfoot>";
            echo "<tbody>";

            while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                $ponto_onibus = $Registro["ponto_onibus"];
                $id = $Registro["id"];
                echo "<tr>";
                echo "<td><input type='checkbox' name='selecionado[]' class='checkbox' value='$id' ></td>\n";
                echo "<td id = 'TdNome'>" . $ponto_onibus . "</td>\n";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</form>";
            ?>
            <script type="text/javascript">

            </script>
            <!--Modal CADASTRAR NOVOS LUGARES-->        
            <form action="<?php echo "$rota"; ?>" method="post" >
                <div class="modal fade" id="myModal_2" role="dialog" >
                    <div class="modal-dialog">                       
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button btn-lg" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title" style="text-align: center">Cadastrar um Novo Ponto de Ônibus</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="inputSolicitante" class="col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="DIGITE O LUGAR ONDE O(S) ALUNO(S) PEGAM O ÔNIBUS" class="form-control" id="" name="inputPontoAluno" required="" onkeyup="maiuscula(this)">
                                        </div>                               
                                    </div>  
                                </div> 
                                <button type="submit" name ="botao" value="cadastrar_ponto"  class="btn btn-success btn-block" onclick="return confirmarAtualizacao()">Enviar</button> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>                         
                        </div>                       
                    </div>
                </div> 
            </form>
        </div>
    </body>    
    <script>
        $(document).ready(function () {
            $(":checkbox").wrap("<span style='background-color: rgb(204, 119, 0); border-radius: 3px; padding-top: 2px;padding-bottom: 2px; padding:3px'>");
        });
    </script>
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#tbl_alunos_lista tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="' + title + '" />');
            });
            // Data Table
            var table = $('#tbl_alunos_lista').DataTable({
                //
                "columnDefs": [{
                        "targets": 0,
                        "orderable": false
                    }],
                "lengthMenu": [[10, 20, 30, 40, 50, 70, 100, -1], [10, 20, 30, 40, 50, 70, 100, "All"]],
                "language": {
                    "lengthMenu": " _MENU_ ",
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
    <script type="text/javascript">
        function validaCheckbox() {
            var r = confirm("Realmente deseja excluir?");
            if (r == true) {
                //
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
                alert("Nenhuma Caixinha foi selecionada!");
                return false;
                //
                // return true;
            } else {
                return false;
            }
        }
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
</html>