<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
echo "<h1>$buscar_turmas</h1>";
$buscarf_nome = filter_input(INPUT_POST, 'inputbuscarf', FILTER_DEFAULT);
$Consultaf_nome = mysqli_query($Conexao, "SELECT *, TIMESTAMPDIFF(YEAR,data_nascimento,data_valida_matricula) AS idade FROM alunos WHERE `nome` LIKE '%" . $buscarf_nome . "%' AND `turma` LIKE '%" . $buscar_turmas_extra . "%' AND excluido = 'N' AND `status` = 'cursando' ORDER BY nome");
$rowf = mysqli_num_rows($Consultaf_nome);

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
    echo "<th> NIS </th>";
    echo "<th> TURMA </th>";
    // echo "<th> STATUS </th>";
    echo "<th> OPÇÕES </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "";
    while ($linhaf = mysqli_fetch_array($Consultaf_nome)) {
        $nomef = $linhaf['nome'];
        $data_nascimentof = new DateTime($linhaf['data_nascimento']);
        $nascimentof = date_format($data_nascimentof, 'd/m/y');
        $idade = $linhaf['idade'];
        $maef = $linhaf['mae'];
        $nisf = $linhaf['nis'];
        $idf = $linhaf['id'];
        $turmaf = $linhaf['turma'];
        // $status = $linhaf['status'];
        echo "<tr>";
        echo "<td>" . $idf . "</td>\n";
        echo "<td><input type='checkbox' name='aluno_selecionado[]' class = 'checkbox' value='$idf'></td>\n";
        echo "<td>" . $nomef . "</td>\n";
        echo "<td>" . $nascimentof . "</td>\n";
        echo "<td>" . $idade . "</td>\n";
        echo "<td>" . $maef . "</td>\n";
        echo "<td>" . $nisf . "</td>\n";
        echo "<td>" . $turmaf . "</td>\n";
        // echo "<td>" . $status . "</td>\n";

        echo "<td><a  href='impressao.php?id=$idf' target='_blank' title='Imprimir'><span class='glyphicon glyphicon-print verde ' aria-hidden='true'></span></a>"
        . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='excluir.php?id=" . base64_encode($idf) . "' onclick='return confirmarExclusao()' target='_self' title='Excluir'><span class='glyphicon glyphicon-remove vermelho ' aria-hidden='true' ></span></a>"
        . "&nbsp;&nbsp;&nbsp;&nbsp;<a href='cadastrar_update.php?id=" . base64_encode($idf) . "' target='_self' title='Alterar'><span class='glyphicon glyphicon-pencil amarelo ' aria-hidden='true' ></span></a>"
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