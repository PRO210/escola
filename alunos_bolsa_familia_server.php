<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>    

<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>

<html>
    <head>
        <?php
        include_once './head.php';
        ?>
        <title></title>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <?php
        $buscar_aluno = filter_input(INPUT_GET, 'inputNome', FILTER_DEFAULT);
        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `nome` LIKE '". $buscar_aluno."' AND excluido = 'N' AND status LIKE 'cursando'");
        $rowf = mysqli_num_rows($Consultaf);
              
        
        if ($rowf > 0) {

            echo "<form method=post action='atualizar_varios.php'>";
            echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th> ID </th>";
            echo "<th> <input type='checkbox' class = 'selecionar'/></th>";
            echo "<th> NOME </th>";
            echo "<th> NACIMENTO </th>";
            echo "<th> IDADE </th>";
            echo "<th> MÃE </th>";
            echo "<th> PAI </th>";
            echo "<th> TURMA </th>";
            echo "<th> STATUS </th>";
            echo "<th> OPÇÕES </th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            echo "";
            while ($linhaf = mysqli_fetch_array($Consultaf)) {
                $nomef = $linhaf['nome'];
                $data_nascimentof = $linhaf['data_nascimento'];
                $idade = $linhaf['idade'];
                $maef = $linhaf['mae'];
                $paif = $linhaf['pai'];
                $idf = $linhaf['id'];
                $turmaf = $linhaf['turma'];
                $status = $linhaf['status'];
                echo "<tr>";
                echo "<td>" . $idf . "</td>\n";
                echo "<td><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'></td>\n";
                echo "<td>" . $nomef . "</td>\n";
                echo "<td>" . $data_nascimentof . "</td>\n";
                echo "<td>" . $idade . "</td>\n";
                echo "<td>" . $maef . "</td>\n";
                echo "<td>" . $paif . "</td>\n";
                echo "<td>" . $turmaf . "</td>\n";
                echo "<td>" . $status . "</td>\n";

                echo "<td><a href='impressao.php?id=$idf' target='_blank' title='Imprimir'><span class='glyphicon glyphicon-print' aria-hidden='true' ></span></a>"
                . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='excluir.php?id=" . base64_encode($idf) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span></a>"
                . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil' aria-hidden='true' ></span></a>"
                . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='pesquisar_no_banco_unitario.php?id=" . base64_encode($idf) . "' target='_self' title='Mostrar'><span class='glyphicon glyphicon-user' aria-hidden='true'></span></a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<input type='submit' value='Editar em Bloco' <a href='atualizar_varios.php' target='_blank' class='btn btn-success'>";
            echo "</form>";
        } else {
            echo "Nada enconrado.";
        }
        ?>
    </body> 
</html>
