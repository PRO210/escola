
        <?php
        foreach (($_POST['aluno_selecionado']) as $lista_id) {

            $SQL_matricular = "UPDATE alunos SET turma_extra = '$turma_extra_incluir', data_matricula_update = now() WHERE id= '$lista_id'";
            $Consulta = mysqli_query($Conexao, $SQL_matricular);

            //Logar no sistema para gravar Log           
            $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) "
                    . "VALUES ( '$usuario_logado', 'Alterou a turma do aluno(a) de id: $lista_id para $turma_extra_incluir', now())";
            $Consulta1 = mysqli_query($Conexao, $SQL_logar);
        }
        if ($Consulta) {
            echo "Alunos Atualizados com Sucesso";
        } else {
            echo "Ocorreu um erro por favor tente de novo ou comunique ao administrador";
        }
        ?>

       
