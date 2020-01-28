<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        $botao = filter_input(INPUT_POST, 'botao', FILTER_DEFAULT);
        if ($botao == "timbre") {            
            $nome_final = substr($_FILES['arquivo']['name'],0,-4 );
            $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
            $arquivo_size = $_FILES['arquivo']['size'];
            $arquivo_size = $_FILES['arquivo']['size'];
            //
            $fp = fopen($arquivo_tmp, "rb");
            $conteudo = fread($fp, $arquivo_size);
            $conteudo = addslashes($conteudo);
            fclose($fp);
            //
            //Pasta onde o arquivo vai ser salvo
            // $_UP['pasta'] = '\xampp\htdocs\Escola\img/';
            //Tamanho máximo do arquivo em Bytes
            $_UP['tamanho'] = 1024 * 1024 * 100; //5mb
            //Array com a extensões permitidas
            $_UP['extensoes'] = array('jpg',);
            //Renomeiar
            $_UP['renomeia'] = false;
            //Array com os tipos de erros de upload do PHP
            $_UP['erros'][0] = 'Não houve erro';
            $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
            $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
            $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
            $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

            //Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
            if ($_FILES['arquivo']['error'] != 0) {
                //die("Não foi possivel fazer o upload, erro: <br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
                header("Location:cadastrar_imagem.php?id=1");
                exit; //Para a execução do script
            }
            //Faz a verificação da extensao do arquivo
            $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
            if (array_search($extensao, $_UP['extensoes']) === false) {
                header("Location:cadastrar_imagem.php?id=12");
                exit();
            }
            //
            $query = mysqli_query($Conexao, "INSERT INTO imagens (`nome_imagem`,`tipo`,`blob_imagem`,`create_update`) VALUES('$nome_final','jpg','$conteudo',NOW())");
            //
            if ($query) {
                //Logar no sistema
                $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) VALUES ( '$usuario_logado', 'Salvou a Imagem $nome_final No Banco de Dados' , now())";
                $Consulta1 = mysqli_query($Conexao, $SQL_logar);
                //
                if ($Consulta1) {
                    header("Location:cadastrar_imagem.php?id=2");
                } else {
                    header("Location:cadastrar_transferido.php?id=16");
                }
            } else {
                header("Location:cadastrar_transferido.php?id=15");
            }
            //
            //Retirar as Imagens do Banco                   //Retirar as Imagens do Banco
        } elseif ($botao == "timbre_retirar") {
            //
            foreach ($_POST['imagens_selecionadas'] as $id) {
                //                
                $querySelecionaPorCodigo = "SELECT * FROM `imagens` WHERE `id` = $id";
                $resultado = mysqli_query($Conexao, $querySelecionaPorCodigo);
                $imagem = mysqli_fetch_array($resultado);
                $nome_imagem = $imagem['nome_imagem'];
                $todos .= "$nome_imagem,";
                $todos_nomes = substr($todos, 0, -1);
                //
                //
                $query = mysqli_query($Conexao, "DELETE FROM `imagens` WHERE `imagens`.`id` = $id");
            }
            if ($query) {
                //Logar no sistema
                $SQL_logar = "INSERT INTO log (`usuario`, `acao`,`data`) VALUES ( '$usuario_logado', ' Excluiu a(s) Images $todos_nomes No Banco de Dados' , now())";
                $Consulta1 = mysqli_query($Conexao, $SQL_logar);
                //
                if ($Consulta1) {
                    header("Location:cadastrar_imagem.php?id=3");
                } else {
                    header("Location:cadastrar_transferido.php?id=16");
                }
            } else {
                header("Location:cadastrar_transferido.php?id=15");
            }
        }
        ?>
    </body>  
</html>


