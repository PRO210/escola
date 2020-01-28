<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
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
        $nome = filter_input(INPUT_POST, 'inputDisciplina', FILTER_DEFAULT);

        //Evita a duplicidade
        $Consulta_duplicidade = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `disciplina` LIKE '" . $nome . "' AND excluido = 'N' ");
        $Testa_duplicidade = mysqli_num_rows($Consulta_duplicidade);

        if ($Testa_duplicidade > 0) {
            header("LOCATION:pesquisar_disciplinas_server.php?id=3");
        } else {

            //Cadastra a Disciplina            
            $Cadastra_disciplina = mysqli_query($Conexao, "INSERT INTO `disciplinas` (`disciplina` ) VALUES ('$nome')");
            $Consulta_id = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE `disciplina` LIKE '" . $nome . "'  ");
            $Recebe_id = mysqli_fetch_array($Consulta_id, MYSQLI_BOTH);
            $turmaNova = $Recebe_id['id'];

            $Nomes_professores = "";
            foreach (($_POST['servidor_selecionado']) as $lista_id) {

                $Cadastra_disciplina_professor = mysqli_query($Conexao, "INSERT INTO `disciplina_professor2` (`id_disciplina`, `id_professor` ) "
                        . "VALUES ('$turmaNova', '$lista_id')");

                $Consulta_professor = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `id` = '$lista_id' ");
                $row_professor = mysqli_fetch_array($Consulta_professor);
                $professores = $row_professor['nome'];
                $Nomes_professores .= "$professores,";
            }

            //Log para o sistema
            $Nomes_professores_pronto = substr($Nomes_professores, 0, -1);
            //Logar no sistema
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Criou a Disciplina $nome e vínculou esse(s) professor(es): $Nomes_professores_pronto' , 'SIM',now())";
            $Consulta = mysqli_query($Conexao, $SQL_logar);

            if ($Cadastra_disciplina) {
                header("LOCATION:pesquisar_disciplinas_server.php?id=1");
            } else {
                header("LOCATION:pesquisar_disciplinas_server.php?id=2");
            }
        }
        ?>
    </body>
</html>
