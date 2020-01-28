<?php
include_once 'valida_cookies.inc';
?>
<?php
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
        $id_recebido = filter_input(INPUT_POST, 'inputId', FILTER_DEFAULT);
        $id = base64_decode($id_recebido);
        $nome = filter_input(INPUT_POST, 'inputNome', FILTER_DEFAULT);
        //echo "$id";
        $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM disciplinas WHERE id= '$id' ");
        $Registro_backup = mysqli_fetch_array($Consulta_backup);
        //
        $Consulta = mysqli_query($Conexao, "SELECT * FROM disciplinas WHERE id= '$id'");
        $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
        $nomebackup = $Registro['disciplina'];
        //
        //UPDATE DE DISCIPLINA
        $SQL_Turma = "UPDATE disciplinas SET `disciplina` = '$nome' WHERE id = $id ";
        $Consulta_Turma = mysqli_query($Conexao, $SQL_Turma);
        //
        //BACKUP PARA LOG E PARA OS PROFESSORES
        $nomes = "";
        $turma = "";
        foreach ($_POST['id_remove'] as $lista_id_remove) {
            $Sql = "SELECT servidores.id,servidores.nome,turmas.id,turmas.turma,disciplina_professor2.* FROM servidores, turmas,`disciplina_professor2` WHERE disciplina_professor2.id ='$lista_id_remove' AND servidores.id = id_professor AND turmas.id = id_turma ORDER BY `servidores`.`nome` ASC,turmas.turma ASC ";
            $Consulta2 = mysqli_query($Conexao, $Sql);
            $Linha_remove = mysqli_fetch_array($Consulta2);
            $Cont_Linha_remove = mysqli_num_rows($Consulta2);
            //
            $nome = $Linha_remove['nome'];
            $turma = $Linha_remove['turma'];
            $nomes_turmas .= " $nome do $turma / ";
        }
        if ($Cont_Linha_remove > 0) {
            $SQL_logar_remove = "INSERT INTO log (`usuario`, `acao`,`data`) VALUES ( '$usuario_logado', 'Removeu  da Disciplina $nomebackup : $nomes_turmas' , now())";
            $Consulta_remove = mysqli_query($Conexao, $SQL_logar_remove);
        }
        //
        //LIMPAR CADASTROS ANTIGOS EM DISCIPLINA_PROFESSOR 
        //
        foreach ($_POST['id_remove'] as $lista_id_remove) {
            $SQL_DELETA = mysqli_query($Conexao, "DELETE FROM `disciplina_professor2` WHERE id = '$lista_id_remove' ");
        }
        //
        //INSERE A TURMA,DISCIPLINA E PROFESSOR EM DISCIPLINA_PROFESSOR2
        foreach (($_POST['turma']) as $lista_id_turma) {
            //
            foreach (($_POST['servidor_selecionado']) as $lista_id) {
                //
                $Registrar = "INSERT INTO disciplina_professor2 (`id_disciplina`, `id_professor`,`id_turma` )"
                        . "VALUES ( '$id', '$lista_id','$lista_id_turma' )";
                $Consulta_Registrar = mysqli_query($Conexao, $Registrar);
                //     
            }
        }
        //BACKUP PARA LOG E PARA OS PROFESSORES
        //$Consulta2 = mysqli_query($Conexao, "SELECT * FROM `disciplina_professor2` WHERE `id_disciplina` = '$id' ");
        $Sql = "SELECT servidores.id,servidores.nome,turmas.id,turmas.turma,disciplina_professor2.* FROM servidores, turmas,`disciplina_professor2` WHERE `id_disciplina` ='$id' AND servidores.id = id_professor AND turmas.id = id_turma ORDER BY `servidores`.`nome` ASC,turmas.turma ASC ";
        $Consulta2 = mysqli_query($Conexao, $Sql);
        $IdsProfessores = "";
        $nomes = "";
        $id_turma = "";
        while ($row2 = mysqli_fetch_array($Consulta2)) {

            $nome = $row2['nome'];
            $turma = $row2['turma'];
            $nomes_turmas .= " $nome no $turma / ";
            $IdsProfessores_final = substr($nomes_turmas, 0, -1);
        }
        $Consulta_backup_final = mysqli_query($Conexao, "SELECT * FROM disciplinas WHERE id = '$id' ");
        $linha_backup_final = mysqli_fetch_array($Consulta_backup_final);
        $result = array_diff_assoc($linha_backup_final, $Registro_backup);
        $campo = "";

        foreach ($result as $nome_campo => $valor) {
            //echo "$nome_campo = $valor<br>";
            if (!is_numeric($nome_campo)) {
                // echo "$nome_campo = $valor<br>";
                $campo .= "$nome_campo = $valor / ";
                //echo "$campo";
            }
        }
        //
        $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) VALUES ( '$usuario_logado', 'Alterou a Disciplina $nomebackup em: $campo e vinculou $IdsProfessores_final a ela' , now())";
        $Consulta1 = mysqli_query($Conexao, $SQL_logar);

        if ($Consulta1) {
            header("Location:disciplinas_professor.php?id=1");
        } else {
            header("Location:disciplinas_professor.php?id=2");
        }
        ?>
    </body>
</html>
