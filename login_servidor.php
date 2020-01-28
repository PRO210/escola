<?php
ob_start();
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //obtem os valores digitados
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        //echo "$nome" . "<br>";
        // echo "$senha" . "<br>";

        $Consulta = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE usuario = '$nome' AND senha = MD5('$senha')");
        $linha = mysqli_num_rows($Consulta);
        //echo "$linha" . "<br>";
        if ($linha == 0) {
            //echo "<html><body>";
            echo "
		<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://127.0.0.1/Escola/index.php'>
		<script type=\"text/javascript\">
		alert(\"Usuário ou Senha Incorretos !\");
		</script>
			";
            
        } else {
            setcookie("nome_usuario", $nome);
            setcookie("senha_usuario", $senha);
            header("Location: principal.php");
        }
        mysqli_close($Consulta);
        ?>
    </body>
</html>
