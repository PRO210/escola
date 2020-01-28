<?php
include_once 'valida_cookies.inc';
?>    
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php
$idcerto = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if ($idcerto == 1) {
    echo "<script type=\"text/javascript\">
		alert(\"Cadastro Realizado com Sucesso! \");
                </script>
                ";
} elseif ($idcerto == 2) {
    echo "<script type=\"text/javascript\">
		alert(\"Ops! Falha na Operação:) \");
                </script>
                ";
}
?>
<html lang = "pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DOCUMENTOS</title>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?> 
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            .verde{color: green;}.vermelho{color: red;}.amarelo{color: orange;}
        </style>   
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <div class="container-fluid" >
            <h3 style="text-align: center">DOCUMENTOS EMPRESTADOS</h3>
            <?php
            $buscarf_nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
            $Consultaf = mysqli_query($Conexao, "SELECT * FROM documentos_emprestados ORDER BY nome");
            $rowf = mysqli_num_rows($Consultaf);
//
            echo "<form method= 'post'  action='cadastrar_update_documentos.php' name = 'form1' >";
            echo "<table class='table table-striped table-bordered' id='example' width='100%' cellspacing='0' >";
            echo "<thead>";
            echo "<tr>";
            if($rowf > 0){
                 echo "<th>"
            . "<div class='dropdown'>"
            . "<input type='checkbox'  class = 'selecionar'/>"
            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true' ></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a><button type='submit' value='' name = 'documentos_emprestados' class='btn btn-link btn-lg verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Todos os Emprestimos</a></li>"
            . "</ul>"
            . "</div>"
            . "</th>";
            }else{
                 echo "<th>"
            . "<div class='dropdown'>"
            . "<input type='checkbox'  class = 'selecionar' disabled = ''/> "
            . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true' ></span>"
            . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
            . "<li><a><button type='submit' value='' name = 'documentos_emprestados' class='btn btn-link btn-lg verde' onclick= 'return validaCheckbox()' ><span class='glyphicon glyphicon-print ' aria-hidden='true'></span></button>Todos os Emprestimos</a></li>"
            . "</ul>"
            . "</div>"
            . "</th>";
            }
           
            echo "<th>EMPRESTADO (S) HÁ:</th>";
            //  echo "<th>NASCIDO</th>";
            // echo "<th>CPF</th>";
            // echo "<th>CELULAR</th>";
            echo "<th>DOCUMENTOS</th>";
            echo "<th>EMPRESTADO</th>";
            echo "<th>DEVOLVIDO</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            //
            if ($rowf > 0) {



                while ($linhaf = mysqli_fetch_array($Consultaf)) {
                    $nomef = $linhaf['nome'];
                    $data_nascimentof = new DateTime($linhaf["nascimento"]);
                    $nascimento = date_format($data_nascimentof, 'd/m/Y');
                    $cpf = $linhaf['cpf'];
                    $celular = $linhaf['celular'];
                    $documentos = $linhaf['documentos'];
                    $idf = $linhaf['id'];
                    $emprestado = new DateTime($linhaf['emprestado']);
                    $emprestado = date_format($emprestado, 'd/m/Y');
                    $devolvido_sim = ($linhaf['devolvidosim']);

                    if ($devolvido_sim == "") {
                        $devolvido = "NÃO";
                    } else {
                        $devolvido = "$devolvido_sim";
                    }
                    echo "<td>"
                    . "<div class='dropdown'>"
                    . "<input type='checkbox' name='pessoas_selecionadas[]' class = 'checkbox-inline' value='$idf'>"
                    . "&nbsp;&nbsp;<span class='glyphicon glyphicon-cog text-success' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'></span>"
                    . "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"
                    . "<li><a href='impressao_documentos_emprestados.php?id=" . base64_encode($idf) . "' target='_blank' title='Imprimir'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir</a></li>"
                    . "<li><a href='cadastrar_update_documentos.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo' aria-hidden='true' >&nbsp;</span>Alterar</a></li>"
                    . "</div>"
                    . "</u>"
                    . "</td>";
                    echo "<td>" . $nomef . "</td>\n";
                    //echo "<td>" . $nascimento . " </td>\n";
                    //echo "<td>" . $cpf . "</td>\n";
                    // echo "<td>" . $celular . "</td>\n";
                    echo "<td>" . $documentos . "</td>\n";
                    echo "<td>" . $emprestado . "</td>\n";
                    echo "<td>" . $devolvido . "</td>\n";
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
                    var table = $('#example').DataTable({
                        "columnDefs": [{
                                "targets": 0,
                                "orderable": false
                            }],
                        language: {
                            "lengthMenu": "Pessoas _MENU_ \n\
<?php
echo "&nbsp;<a href='cadastrar_documentos_emprestados.php' target='_self' class='btn btn-success' >Novo Documento</a>";
?>                                         \n\
",
                            "zeroRecords": "Nenhuma Pessoa Encontrada",
                            "info": "Mostrando pagina _PAGE_ de _PAGES_",
                            "infoEmpty": "Sem registros",
                            "search": "Busca:",
                            "infoFiltered": "(filtrado de _MAX_ total de Pessoas)",
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
                    alert("Nenhuma Pessoa foi selecionada !");
                    return false;
                }
            </script> 
            <script type="text/javascript">
                //Marcar ou Desmarcar todos os checkbox
                $(document).ready(function () {

                    $('.selecionar').click(function () {
                        if (this.checked) {
                            $('.checkbox-inline').each(function () {
                                this.checked = true;
                            });
                        } else {
                            $('.checkbox-inline').each(function () {
                                this.checked = false;
                            });
                        }
                    });
                });
            </script>
        </div>
    </body>
</html>
