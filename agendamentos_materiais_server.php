<?php
ob_start();
session_start();
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
        $start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
        $end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);
        $servidor = filter_input(INPUT_POST, 'inputServidor', FILTER_SANITIZE_STRING);
        $material = filter_input(INPUT_POST, 'inputMaterial', FILTER_SANITIZE_STRING);
        $quantidade11 = filter_input(INPUT_POST, 'inputQuantidade11', FILTER_SANITIZE_STRING);
        $inputTextArea = filter_input(INPUT_POST, 'inputTextArea', FILTER_DEFAULT);
        include_once 'agendamentos_function_disponivel_cria_1.php';
        //
        $material22 = filter_input(INPUT_POST, 'inputMateria22', FILTER_SANITIZE_STRING);
        $quantidade22 = filter_input(INPUT_POST, 'inputQuantidade22', FILTER_SANITIZE_STRING);
        include_once 'agendamentos_function_disponivel_cria_2.php';
        //
        $material33 = filter_input(INPUT_POST, 'inputMateria33', FILTER_SANITIZE_STRING);
        $quantidade33 = filter_input(INPUT_POST, 'inputQuantidade33', FILTER_SANITIZE_STRING);
        include_once 'agendamentos_function_disponivel_cria_3.php';
        $data = explode(" ", $start);
        list($date, $hora) = $data;
        $data_sem_barra = array_reverse(explode("/", $date));
        $data_sem_barra = implode("-", $data_sem_barra);


        $dateS1 = new \DateTime($start_sem_barra);
        $dateS2 = new \DateTime($end_sem_barra);

        $dateDiff = $dateS1->diff($dateS2);
        $result = $dateDiff->h . ' horas e ' . $dateDiff->i . ' minutos';
        $result = $dateDiff->h * 60 + $dateDiff->i;

        $echo = "";
        $dateTime = new \DateTime($start_sem_barra);
        $dateTime->modify('-1 minutes');
        for ($i = -1; $i < $result; $i++) {
            $dateTime->modify('+1 minutes');
            $echo .= $dateTime->format('Y-m-d H:i:s') . ",";
        }
        $string = explode(',', substr($echo, 0, -1));
        $array_pedido = array();
        foreach ($string as $value) {
            $array_pedido[] = $value;
        }


        echo "$start_sem_barra" . "<br>";
        echo "$end_sem_barra" . "<br>";
        
        $entrada = strtotime($start_sem_barra);
        $saida = strtotime($end_sem_barra);
        $diferenca = $saida - $entrada;

        echo $diferenca . "<br>";
        // echo $diferenca/3600 . "<br>";
        echo ceil($diferenca / 60) . "<br>";
        for ($i = 0; $i <= $diferenca / 60; $i++) {
            $hora_conv = date('Y-m-d H:i:s', strtotime('+' . $i . ' minute', strtotime($start_sem_barra))) . "<br>";
            echo "SELECT * FROM `agendamentos` WHERE `start` LIKE '%$hora_conv%' OR `end` LIKE '%$hora_conv%' ORDER BY `start` ASC";
            echo "<br>";
        }
        echo"<br>";
        exit();
        $consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `start` LIKE '%$data_sem_barra%' ORDER BY `start` ASC");
        $linhas = mysqli_num_rows($consulta);
        echo "SELECT * FROM `agendamentos` WHERE `start` LIKE '%$data_sem_barra%' ORDER BY `start` ASC " . "<br>";

        if ($linhas > 0) {

            while ($linha = mysqli_fetch_array($consulta)) {

                $dateS1 = new \DateTime($linha['start']);
                $dateS2 = new \DateTime($linha['end']);

                $dateDiff = $dateS1->diff($dateS2);
                $result = $dateDiff->h . ' horas e ' . $dateDiff->i . ' minutos';
                $result = $dateDiff->h * 60 + $dateDiff->i;

                $echo = "";
                $dateTime = new \DateTime($linha['start']);
                $dateTime->modify('-1 minutes');
                for ($i = -1; $i < $result; $i++) {
                    $dateTime->modify('+1 minutes');
                    $echo .= $dateTime->format('Y-m-d H:i:s') . ",";
                }
                echo "<br>";
                $string = explode(',', substr($echo, 0, -1));
                $array = array();
                foreach ($string as $value) {
                    $array[] = $value;
                }
                $result = array_intersect($array_pedido, $array);

                if (!empty($result)) {
                    $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-danger fechar' role='alert'>Já Existe Evento Cadastrado para Esse Horário! <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: agendamentos_materiais.php");
                    exit();
                }
            }
        }
        //$newtimestamp = strtotime('2011-11-17 05:05 + 16 minute');

        if ($_POST['botao'] == "cadastrar") {

            if (!empty($title) && !empty($start) && !empty($end) && !empty($material) && !empty($servidor) && !empty($quantidade11)) {
                //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
                $data = explode(" ", $start);
                list($date, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $date));
                $data_sem_barra = implode("-", $data_sem_barra);
                $start_sem_barra = $data_sem_barra . " " . $hora;

                $data = explode(" ", $end);
                list($date, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $date));
                $data_sem_barra = implode("-", $data_sem_barra);
                $end_sem_barra = $data_sem_barra . " " . $hora;
                //
                $msg = "";
                $msg = "$msg1 $msg2  $msg3";

                $result_events = "INSERT INTO agendamentos (title, color, start, end, id_servidor, id_material, quantidade, id_material2, quantidade2, id_material3, quantidade3,obs) VALUES ('$title', '$color', '$start_sem_barra', '$end_sem_barra' ,'$servidor' ,'$material' ,'$quantidade11' , '$material22' , '$quantidade22', '$material33' , '$quantidade33','$inputTextArea')";
                // echo "INSERT INTO agendamentos (title, color, start, end, id_servidor, id_material, quantidade, id_material2, quantidade2, id_material3, quantidade3) VALUES ('$title', '$color', '$start_sem_barra', '$end_sem_barra' ,'$servidor' ,'$material' ,'$quantidade11' , '$material22' , '$quantidade22', '$material33' , '$quantidade33')";
                //exit();
                $resultado_events = mysqli_query($Conexao, $result_events);
                //Verificar se salvou no banco de dados através "mysqli_insert_id" o qual verifica se existe o ID do último dado inserido
                if (mysqli_insert_id($Conexao)) {
                    //Logar no sistema             
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE id = '$servidor'");
                    $linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
                    $nome = $linha['nome'];
                    //
                    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`cadastrar`,`data`)"
                            . " VALUES ( '$usuario_logado', 'Cadastrou o Emprestimo de:$qdt_material:  $quantidade11,$qdt_material2:  $quantidade22,$qdt_material3: $quantidade33 para o Servidor(a) $nome','SIM',now())";
                    $Consulta = mysqli_query($Conexao, $SQL_logar);
                    //
                    $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-success fechar' role='alert'>O Evento Foi Cadastrado com Sucesso <br> $msg<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

                    header("Location: agendamentos_materiais.php");
                } else {
                    $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-danger fechar' role='alert'>Erro ao cadastrar o eventon preencha corretamente os campos <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: agendamentos_materiais.php");
                }
            } else {
                $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-danger fechar' role='alert'>Erro ao cadastrar o evento;Verifique por vafor se você escolheu o servidor,objeto e a quantidade corretamente! <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: agendamentos_materiais.php");
            }
            //
            //  Excluir o Evento
        } elseif ($_POST['botao'] == "excluir") {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            //            
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE id = '$id'");
            $linha = mysqli_fetch_array($Consulta);
            $title = $linha['title'];
            $id_servidor = $linha['id_servidor'];
            //
            $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE id = '$id_servidor'");
            $linha = mysqli_fetch_array($Consulta);
            $nome = $linha['nome'];
            //Apaga o Agendamento
            $SQL_DELETE = mysqli_query($Conexao, "DELETE FROM `agendamentos` WHERE `id` = '$id'");
            //
            if ($SQL_DELETE) {
                //Logar no sistema
                $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`excluir`,`data`) "
                        . "VALUES ( '$usuario_logado', 'Excluiu o Emprestimo do Servidor(a): $nome','SIM',now())";
                $Consulta = mysqli_query($Conexao, $SQL_logar);
                //
                $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-success fechar' role='alert'>O Evento foi Excluído com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: agendamentos_materiais.php");
            } else {
                $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-danger fechar' role='alert'>Erro ao Excluir o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: agendamentos_materiais.php");
            }
            //
            //  Atualizar Evento
            //
        } else {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $Edittitle = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_STRING);
            $Editcolor = filter_input(INPUT_POST, 'Color', FILTER_SANITIZE_STRING);
            $Editstart = filter_input(INPUT_POST, 'Start', FILTER_SANITIZE_STRING);
            $Editend = filter_input(INPUT_POST, 'End', FILTER_SANITIZE_STRING);
            $Editservidor = filter_input(INPUT_POST, 'Servidor', FILTER_SANITIZE_STRING);
            $inputTextArea2 = filter_input(INPUT_POST, 'inputTextArea2', FILTER_DEFAULT);
            //
            $Editmaterial = filter_input(INPUT_POST, 'Material', FILTER_SANITIZE_STRING);
            $Editquantidade = filter_input(INPUT_POST, 'Quantidade', FILTER_SANITIZE_STRING);
            include_once 'agendamentos_function_disponivel_1.php';
            //
            $Editmaterial99 = filter_input(INPUT_POST, 'Material99', FILTER_SANITIZE_STRING);
            $Editquantidade99 = filter_input(INPUT_POST, 'Quantidade99', FILTER_SANITIZE_STRING);
            include_once 'agendamentos_function_disponivel_3.php';
            //
            $Editmaterial88 = filter_input(INPUT_POST, 'Material88', FILTER_SANITIZE_STRING);
            $Editquantidade88 = filter_input(INPUT_POST, 'Quantidade88', FILTER_SANITIZE_STRING);
            include_once 'agendamentos_function_disponivel_2.php';
            //
            $msg = "";
            $msg = "$msg1 $msg2 $msg3";
            //
            if (!empty($id)) {
                //           
                $Consulta_backup = mysqli_query($Conexao, "SELECT * FROM agendamentos WHERE id= '$id'");
                $Registro_backup = mysqli_fetch_array($Consulta_backup);
                //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
                $data = explode(" ", $Editstart);
                list($date, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $date));
                $data_sem_barra = implode("-", $data_sem_barra);
                $start_sem_barra = $data_sem_barra . " " . $hora;

                $data = explode(" ", $Editend);
                list($date, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $date));
                $data_sem_barra = implode("-", $data_sem_barra);
                $end_sem_barra = $data_sem_barra . " " . $hora;
                //
                $result_events = "UPDATE agendamentos SET title='$Edittitle', color='$Editcolor', start='$start_sem_barra', end='$end_sem_barra' , id_servidor = '$Editservidor' , id_material = '$Editmaterial' , quantidade = '$Editquantidade' , id_material2 = '$Editmaterial88' , quantidade2 = '$Editquantidade88', id_material3 = '$Editmaterial99' , quantidade3 = '$Editquantidade99', obs = '$inputTextArea2' WHERE id='$id'";
                // echo "UPDATE agendamentos SET title='$Edittitle', color='$Editcolor', start='$start_sem_barra', end='$end_sem_barra' , id_servidor = '$Editservidor' , id_material = '$Editmaterial' , quantidade = '$Editquantidade' , id_material2 = '$Editmaterial88' , quantidade2 = '$Editquantidade88', id_material3 = '$Editmaterial99' , quantidade3 = '$Editquantidade99', obs = '$inputTextArea2' WHERE id='$id'";
                //exit();
                $resultado_events = mysqli_query($Conexao, $result_events);
                //
                $Consulta_final = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE `id`= $id");
                $row_final = mysqli_fetch_array($Consulta_final);
                $result = array_diff_assoc($row_final, $Registro_backup);
                $campo = "";

                foreach ($result as $nome_campo => $valor) {
                    //echo "$nome_campo = $valor<br>";
                    if (!is_numeric($nome_campo)) {
                        //  echo "$nome_campo = $valor<br>";
                        if ($nome_campo == "title") {
                            $nome_campo = "Título";
                        }
                        if ($nome_campo == "create_update") {
                            // $nome_campo = "Criação ou Atualização";
                            $data = new DateTime($valor);
                            $data = date_format($data, 'd-m-Y  H:i');
                            $valor = "$data";
                        }
                        if ($nome_campo == "start") {
                            // $nome_campo = "Início:";
                            $data = new DateTime($valor);
                            $data = date_format($data, 'd-m-Y  H:i');
                            $valor = "$data";
                        }
                        if ($nome_campo == "end") {
                            // $nome_campo = "Fim:";
                            $data = new DateTime($valor);
                            $data = date_format($data, 'd-m-Y  H:i');
                            $valor = "$data";
                        }
                        if ($nome_campo == "id_servidor") {
                            $SQL_turma = "SELECT * FROM `servidores` WHERE `id` = '$Editservidor'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma);
                            $nome_servidor = $Linha_turma["nome"];
                            $valor = "$nome_servidor";
                        }
                        //
                        if ($nome_campo == "id_material") {
                            $SQL_turma = "SELECT * FROM `materiais` WHERE `id` = '$Editmaterial'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma);
                            $nome_servidor = $Linha_turma["nome"];
                            $valor = "$Editquantidade";
                            $nome_campo = "$nome_servidor";
                            $txt = "quantidade";
                        } else {
                            $sim = "n";
                        }
                        if ($nome_campo == "$txt") {
                            $nome_campo = "";
                            $valor = "";
                        }
                        if ($sim == "n") {
                            if ($nome_campo == "quantidade") {
                                $SQL_turma = "SELECT * FROM `materiais` WHERE `id` = '$Editmaterial'";
                                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                                $nome_servidor = $Linha_turma["nome"];
                                $nome_campo = "$nome_servidor";
                                $valor = $Editquantidade;
                            }
                        }
                        //
                        if ($nome_campo == "id_material2") {
                            $SQL_turma = "SELECT * FROM `materiais` WHERE `id` = '$Editmaterial88'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma);
                            $nome_servidor = $Linha_turma["nome"];
                            $valor = "$Editquantidade88";
                            $nome_campo = "$nome_servidor";
                            $txt2 = "quantidade2";
                        } else {
                            $sim2 = "n";
                        }
                        if ($nome_campo == "$txt2") {
                            $nome_campo = "";
                            $valor = "";
                        }
                        if ($sim2 == "n") {
                            if ($nome_campo == "quantidade2") {
                                $SQL_turma = "SELECT * FROM `materiais` WHERE `id` = '$Editmaterial88'";
                                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                                $nome_servidor = $Linha_turma["nome"];
                                $nome_campo = "$nome_servidor";
                                $valor = $Editquantidade88;
                            }
                        }
                        //
                        if ($nome_campo == "id_material3") {
                            $SQL_turma = "SELECT * FROM `materiais` WHERE `id` = '$Editmaterial99'";
                            $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                            $Linha_turma = mysqli_fetch_array($Consulta_turma);
                            $nome_servidor = $Linha_turma["nome"];
                            $nome_campo = "$nome_servidor";
                            $valor = $Editquantidade99;
                            $txt3 = "quantidade3";
                        } else {
                            $sim3 = "n";
                        }
                        if ($nome_campo == "$txt3") {
                            $nome_campo = "";
                            $valor = "";
                        }
                        if ($sim3 == "n") {
                            if ($nome_campo == "quantidade3") {
                                $SQL_turma = "SELECT * FROM `materiais` WHERE `id` = '$Editmaterial99'";
                                $Consulta_turma = mysqli_query($Conexao, $SQL_turma);
                                $Linha_turma = mysqli_fetch_array($Consulta_turma);
                                $nome_servidor = $Linha_turma["nome"];
                                $nome_campo = "$nome_servidor";
                                $valor = $Editquantidade99;
                            }
                        }
                        if ($Registro_backup[$nome_campo] == "") {
                            $Registro_backup[$nome_campo] = "Vazio";
                        }
                        if ($valor == "") {
                            $valor = "Vazio";
                        }

                        $campo .= "$nome_campo = De $Registro_backup[$nome_campo] para $valor /  ";
                    }
                }
//                echo "$campo";
//                exit();
                //Verificar se alterou no banco de dados através "mysqli_affected_rows"
                if (mysqli_affected_rows($Conexao)) {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `agendamentos` WHERE id = '$id'");
                    $linha = mysqli_fetch_array($Consulta);
                    $title = $linha['title'];
                    $id_servidor = $linha['id_servidor'];
                    //
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE id = '$id_servidor'");
                    $linha = mysqli_fetch_array($Consulta);
                    $nome = $linha['nome'];
                    //Logar no sistema
                    $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`alterar`,`data`) "
                            . "VALUES ( '$usuario_logado', 'Alterou o(s) campo(s) do Emprestimo de $nome em: $campo','SIM',now())";
                    $Consulta = mysqli_query($Conexao, $SQL_logar);
                    //
                    $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-success fechar' role='alert'>O Evento editado com Sucesso <br> $msg<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: agendamentos_materiais.php");
                } else {
                    $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-danger fechar' role='alert'>Erro ao editar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    header("Location: agendamentos_materiais.php");
                }
            } else {
                $_SESSION['msg'] = "<div id = 'fechar' class='alert alert-danger fechar' role='alert'>Erro ao cadastrar o evento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                header("Location: agendamentos_materiais.php");
            }
        }
        ?>
    </body>
</html>
