<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
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
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?> 
        <?php
        if (isset($_POST['trocar'])) {

            $data_censo = filter_input(INPUT_POST, 'inputCenso', FILTER_DEFAULT);
            $data_convertida = substr($data_censo, 6, 4) . '-' . substr($data_censo, 3, 2) . '-' . substr($data_censo, 0, 2);

            foreach (($_POST['aluno_selecionado']) as $lista_id) {

                $SQL_matricular = "UPDATE alunos SET data_censo = '$data_convertida' WHERE id = '$lista_id'";
                $Consulta = mysqli_query($Conexao, $SQL_matricular);
                //Logar no sistema para gravar Log    
                $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                        . "VALUES ( '$usuario_logado', ' Alterou a data do Censo para $data_convertida','SIM',now() )";
                $Consulta1 = mysqli_query($Conexao, $SQL_logar);
            }
            if ($Consulta) {
                echo "Data Atualizada  com Sucesso";
            } else {
                echo "Ocorreu um erro por favor tente de novo ou comunique ao administrador";
            }
        } else {
            if (isset($_POST['trocar_matricula'])) {
                $data_valida_matricula = filter_input(INPUT_POST, 'inputMatricula', FILTER_DEFAULT);
                $data_valida_convertida = substr($data_valida_matricula, 6, 4) . '-' . substr($data_valida_matricula, 3, 2) . '-' . substr($data_valida_matricula, 0, 2);
                               // echo "$data_valida_matricula  <br>";
                //echo "$data_valida_convertida  <br>";
               
                foreach (($_POST['aluno_selecionado']) as $lista_id) {
                    //echo "$lista_id";
                   // exit();
                    $SQL_matricular = "UPDATE alunos SET data_valida_matricula = '$data_valida_convertida' WHERE id = '$lista_id'";
                    $Consulta = mysqli_query($Conexao, $SQL_matricular);

                    //Logar no sistema para gravar Log    
                    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                            . "VALUES ( '$usuario_logado', ' Alterou a data miníma para matricula para $data_valida_convertida','SIM',now() )";
                    $Consulta1 = mysqli_query($Conexao, $SQL_logar);
                }
                if ($Consulta) {
                    echo "Data Atualizada  com Sucesso";
                } else {
                    echo "Ocorreu um erro por favor tente de novo ou comunique ao administrador";
                }
            }
        }
        ?>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <a class="btn btn-primary" href="principal.php" role="button">Voltar para a Principal</a>
                <a class="btn btn-primary" href="datas_escola.php" role="button">Verificar as Alterações</a>
            </div>
        </div>
    </body>
</html>




