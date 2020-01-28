<?php
include_once 'valida_cookies.inc';
?>
<?php
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");

//Recebe os valores do furmulário de matrícula (Método POST)


//Udate no Banco
$SQL_matricular = "UPDATE turmas SET turma = '$turma', turno = '$turno', categoria = '$categoria', status = '$status' WHERE id = $id ";
$Consulta = mysqli_query($Conexao, $SQL_matricular);

//Logar no sistema
$SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
        . "VALUES ( '$usuario_logado', 'Alterou os dados da turma $turma ' , now())";
$Consulta1 = mysqli_query($Conexao, $SQL_logar);
?>

<!DOCTYPE html>
<html>
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
        <div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <a class="btn btn-primary" href="pesquisar_turmas_server.php" role="button">Voltar</a>
                </div>
            </div>
        </div>
    </body>
</html>
