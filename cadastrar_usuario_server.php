<?php

include_once 'valida_cookies.inc';
?>
<?php

//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<?php

if (isset($_POST['atualizar_usuario'])) {
    //Recebe os valores do furmulário de matrícula (Método POST)
    $id = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);
    $usuario = filter_input(INPUT_POST, 'inputUsuario', FILTER_DEFAULT);
    $nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
    $tipo = filter_input(INPUT_POST, 'inputTipo', FILTER_DEFAULT);
    $senha = md5(filter_input(INPUT_POST, 'inputSenha', FILTER_DEFAULT));

    //Arquivos capturados para o LOG
    $Consuta_backup = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE id = $id ");
    $row_backup = mysqli_fetch_array($Consuta_backup);
    //
    $Consulta_backup2 = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE id = $id ");
    $Registro_backup2 = mysqli_fetch_array($Consulta_backup2, MYSQLI_BOTH);
    $nomebackup = $Registro_backup2['nome'];
   
        $admin = "";
        if ($tipo == "ADMIN") {
            $admin = "0";
        } else {
            $admin = "1";
        }

        $SQL_matricular = "UPDATE usuarios SET usuario = '$usuario', nome = '$nome', tipo = '$admin', senha = '$senha' WHERE id = $id ";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);
        //     
        if ($Consulta) {            
            $Consulta_final = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE id = $id ");
            $row_final = mysqli_fetch_array($Consulta_final);
            $result = array_diff_assoc($row_final, $row_backup);
            $campo = "";

            foreach ($result as $nome_campo => $valor) {
                //echo "$nome_campo = $valor<br>";
                if (!is_numeric($nome_campo)) {
                    // echo "$nome_campo = $valor<br>";
                    $campo .= "$nome_campo = $valor / ";
                    //echo "$campo";
                }
            }
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Atualizou o Usuário $nomebackup em :$campo' , now())";
            $Consulta1 = mysqli_query($Conexao, $SQL_logar);


            echo "
		<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Escola/pesquisar_usuario_server.php'>
		<script type=\"text/javascript\">
		alert(\"O Usuario $nome foi Alterado com Sucesso!\");
		</script>
			";
        } else {
            echo mysqli_error($Conexao);
        }
    
} else {
    //Recebe os valores do furmulário de matrícula (Método POST)
    $usuario = filter_input(INPUT_POST, 'inputUsuario', FILTER_DEFAULT);
    $nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
    $tipo = filter_input(INPUT_POST, 'inputTipo', FILTER_DEFAULT);
    $senha = md5(filter_input(INPUT_POST, 'inputSenha', FILTER_DEFAULT));

//Arquivos capturados para o LOG
    $Consuta_backup = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE usuario = '$usuario' AND nome LIKE '$nome' AND tipo LIKE '$tipo' ");
    $row_backup = mysqli_num_rows($Consuta_backup);

    if ($row_backup > 0) {
        echo "Ops! Esse usuário já existe.";
    } else {
        $admin = "";
        if ($tipo == "ADMIN") {
            $admin = "0";
        } else {
            $admin = "1";
        }
        $SQL_matricular = "INSERT INTO usuarios (`usuario`,`nome`,`tipo`,`senha`) "
                . "VALUES ( '$usuario','$nome', '$admin', '$senha')";
        $Consulta = mysqli_query($Conexao, $SQL_matricular);

        if ($Consulta) {
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Cadastrou o Usuário $nome' , now())";
            $Consulta1 = mysqli_query($Conexao, $SQL_logar);

            $id_matricular = mysqli_insert_id($Conexao);
            echo "
		<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Escola/pesquisar_usuario_server.php'>
		<script type=\"text/javascript\">
		alert(\"O Usuario $nome foi Cadastrato com Sucesso!\");
		</script>
			";
            echo "Usuário cadastrado com sucesso";
            // echo "<a href='impressao.php?id=$id_matricular' target='_blank'>Imprimir Matricula</a>";
        } else {
            echo mysqli_error($Conexao);
        }
    }
}
