<?php
include_once 'valida_cookies.inc';
?>
<?php
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link href="css/matricular.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>  
        <?php
        $turma = filter_input(INPUT_POST, 'inputTurma', FILTER_DEFAULT);
        $turno = filter_input(INPUT_POST, 'inputTurno', FILTER_DEFAULT);
        $categoria = filter_input(INPUT_POST, 'inputCategoria', FILTER_DEFAULT);

        $Consuta_duplicidade = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `turma` LIKE '$turma' AND `turno` LIKE '$turno'");
        $rowDuplicidade = mysqli_num_rows($Consuta_duplicidade);

        if ($rowDuplicidade > 0) {
            echo "Essa Turma já existe ";
        } else {

            $Cadastrar_turma = "INSERT INTO turmas (`turma`, `categoria`,`turno`) VALUES ( '$turma', '$categoria ' , '$turno')";
            $Consulta_turma = mysqli_query($Conexao, $Cadastrar_turma);

            if ($Consulta_turma) {
                $Cadastrar_turma1 = "ALTER TABLE `turmas_professor` ADD `$turma ($turno)` VARCHAR(255) NOT NULL AFTER `id`";
                $Consulta_turma1 = mysqli_query($Conexao, $Cadastrar_turma1);
                $P1 = filter_input(INPUT_POST, 'P1', FILTER_DEFAULT);
                $P2 = filter_input(INPUT_POST, 'P2', FILTER_DEFAULT);
                $P3 = filter_input(INPUT_POST, 'P3', FILTER_DEFAULT);

                $AlterarP1 = "UPDATE `turmas_professor` SET `$turma ($turno)` = '$P1' WHERE `turmas_professor`.`id` = 1   ";
                $ConsultaP1 = mysqli_query($Conexao, $AlterarP1);
                $AlterarP2 = "UPDATE `turmas_professor` SET `$turma ($turno)` = '$P2' WHERE `turmas_professor`.`id` = 2   ";
                $ConsultaP2 = mysqli_query($Conexao, $AlterarP2);
                $AlterarP3 = "UPDATE `turmas_professor` SET `$turma ($turno)` = '$P3' WHERE `turmas_professor`.`id` = 3   ";
                $ConsultaP3 = mysqli_query($Conexao, $AlterarP3);
                //Logar no sistema
                $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                        . "VALUES ( '$usuario_logado', 'Criou a turma do $turma ' , now())";
                $Consulta = mysqli_query($Conexao, $SQL_logar);
            } else {
                echo mysqli_error($Consulta_turma);
            }
        }
        ?>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <a class="btn btn-success" href="pesquisar_turmas_server.php" role="button">Confirmar a Turma</a>
                <a class="btn btn-primary" href="cadastrar_turma.php" role="button">Continuar Criando</a>
            </div>
        </div>
    </body>
</html>
