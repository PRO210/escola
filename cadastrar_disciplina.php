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
        <?php
        include_once './head.php';
        ?>        
        <title>CRIANDO DISCIPLINAS</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <div class="container-fluid">
            <div class="row">
                <div class="starter-template">
                    <h3 style="text-align: center">CRIAÇÃO DE DISCIPLINA</h3>
                    <script src="js/bootstrap.js" type="text/javascript"></script>
                    <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
                    <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
                    <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
                    <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
                    <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <form name="cadastrar_disciplina" action="cadastrar_disciplina_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                        <div class="form-group">
                            <label for="inputDisciplina" class="col-sm-3 control-label">Nome</label>
                            <div class="col-sm-6">
                                <input type="text" name="inputDisciplina" id="inputDisciplina" class="form-control" placeholder="DIGITE O NOME DA TURMA" onkeyup="maiuscula(this)" required="">
                            </div>
                        </div> 
                                                <script src="js/bootstrap.js" type="text/javascript"></script>
                        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
                        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>

                        <div class="form-group"> 
                            <h4 style="text-align: center">PROFESSORES(A)</h4>
                            <div class="col-sm-6 col-sm-offset-3 ">
                                <?php
                                $Consultaf = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `funcao` LIKE 'professor(a)%' ORDER BY nome");
                                $rowf = mysqli_num_rows($Consultaf);

                                if ($rowf > 0) {

                                    echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    // echo "<th> ID </th>";
                                    echo "<th>"
                                    . "<div class='dropdown'>"
                                    . "<input type='checkbox' name='servidor_selecionado[]' class = 'selecionar'/>"
                                    . "</th>";
                                    echo "<th> NOME </th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    
                                    while ($Registro = mysqli_fetch_array($Consultaf)) {

                                        $id = $Registro["id"];
                                        $nome = $Registro["nome"];

                                        echo "<tr>";
                                        echo "<td>"
                                        . "<div class='dropdown'>"
                                        . "<input type='checkbox' name='servidor_selecionado[]' class = 'checkbox' value='$id'>"
                                        . "</td>";

                                        echo "<td>" . $nome . "</td>\n";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "Nada enconrado.";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" value="cadastrar_disciplina" class="btn btn-success" name="cadastrar_disciplina" onclick= "return validaCheckbox()" >Cadastrar</button>
                                <button type="reset" class="btn btn-danger">Limpar</button>
                            </div>
                        </div> 

                    </form>                
                </div>
            </div>
        </div>
        <script language="javascript">
            function validaCheckbox() {
                var frm = document.cadastrar_disciplina;
                //Percorre os elementos do formulário
                for (i = 0; i < frm.length; i++) {
                    //Verifica se o elemento do formulário corresponde a um checkbox e se é o checkbox desejado
                    if (frm.elements[i].type == "checkbox") {
                        //Verifica se o checkbox foi selecionado
                        if (frm.elements[i].checked) {
                            //alert("Exite ao menos um checkbox selecionado!");
                            return true;

                        }
                    }
                }
                alert("Nenhum Servidor foi selecionado!");
                return true;
            }
        </script>
        <script type="text/javascript">
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z) {
                v = z.value.toUpperCase();
                z.value = v;
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
        <script>
            $(document).ready(function () {
                $('#tbl_alunos_lista').DataTable({
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
            });
        </script>                 
    </body> 
</html>
