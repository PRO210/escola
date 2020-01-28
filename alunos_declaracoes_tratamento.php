<?php
include_once 'valida_cookies.inc';
//include_once'./matricular.php';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
//$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
//$SQL_consulta_id = "SELECT * FROM `alunos` WHERE `id` = $id";
//$Consulta = mysqli_query($Conexao, $SQL_consulta_id);
//$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
//$nome = $Linha["nome"];
//$turmaf = $Linha["turma"];
////
//$SQL_turma = "SELECT * FROM `turmas` WHERE `id` = '$turmaf'";
//$Consulta_turma = mysqli_query($Conexao, $SQL_turma);
//$Linha_turma = mysqli_fetch_array($Consulta_turma);
////
//$nome_turma = $Linha_turma["turma"];
//$turno_turma = $Linha_turma["turno"];
//$categoria_turma = $Linha_turma["categoria"];
//$turma = "$nome_turma";
////
//$txt_option = "$turma";
?>
<html>
    <head>       
        <title>TRANSFERÊNCIA PROVISÓRIA</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>
    </head>
    <body style="width: 1400px; margin: 12px auto;">
        <form action="alunos_declaracoes_pdf.php" method="post" name="form1">
            <div style=" background-color: #cc7700;" class="container-fluid">
                <div class="col-sm-12 col-sm-offset-2 " >
                    <div class="row">
                        <div class=" form-group col-sm-12">    
                            <h3></h3>
                            <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputaprovacao" value="CURSANDO">CURSANDO</label>
                            <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputaprovacao" value="SIM">APROVADO</label>
                            <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputaprovacao" value="NÃO">REPROVADO</label>
                            <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputaprovacao" value="DESISTENTE">DESISTENTE</label>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-8 col-sm-offset-1">
                            <label for="inputTurma" class="col-sm-3 control-label">Tem Direito a Matricular-se em:</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="inputTurma" id="inputTurma" required="">                                   
                                    <?php
                                    $ano = date('Y');
                                    $ano_passado = date('Y', strtotime('-361 days', strtotime($ano)));
                                    $ano_futuro = date('Y', strtotime('+362 days', strtotime($ano)));
//
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas` ORDER BY `turmas`.`ano` DESC, `turmas`.`turma` ASC");
                                    echo "<option disabled selected>SELECIONE A TURMA DESEJADA AQUI ! </option>";
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $turma = $Registro["turma"];
                                        $turno = $Registro["turno"];
                                        $id_turma = $Registro["id"];
                                        $ano_turma = substr($Registro["ano"], 0, -6);
                                        //
                                        if ($ano_turma == "2018") {
                                            $unico_turma = "";
                                        } else {
                                            $unico_turma = $Registro["unico"];
                                        }
                                        //
                                        if ($ano_turma == "$ano_futuro") {
                                            echo "<option value = '$id_turma'>$turma $unico_turma ($turno) $ano_futuro - Futuro</option>";
                                        } elseif ($ano_turma == "$ano") {
                                            echo "<option value = '$id_turma'>$turma $unico_turma ($turno) $ano - Atual</option>";
                                        } else {
                                            echo "<option value = '$id_turma'>$turma $unico_turma ($turno) $ano_passado - Passado</option>";
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="form-group col-sm-8 col-sm-offset-1">
                            <label for="inputTransferencia" class="col-sm-3 control-label">Precisa da Transferência?</label>
                            <div class="col-sm-6">
                                <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputTransferencia" value="SIM">SIM</label>
                                <label class="radio-inline btn-lg col-sm-2 control-label"><input type="radio" name="inputTransferencia" value="NÃO">NÃO</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="col-sm-6 col-sm-offset-1" style="margin-bottom: 12px">
                            <button type="submit" value="Enviar" class="btn btn-success btn-block" onclick="return validaRadio()">Enviar</button>
                        </div>
                    </div>                  
                </div>
                <?php
                echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> SELEÇÃO</th>";
                echo "<th> NOME </th>";
                echo "<th> TURMA </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach (($_POST['aluno_selecionado']) as $lista_id) {
                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao`= '$lista_id' ORDER BY `id_solicitacao` DESC");
                    $row = mysqli_num_rows($Consulta);
                    if ($row > 0) {
                        while ($linha = mysqli_fetch_array($Consulta)) {
                            //
                            $Consultaf = mysqli_query($Conexao, "SELECT * FROM alunos WHERE id = '" . $linha['id_aluno_solicitacao'] . "' ");
                            $rowf = mysqli_num_rows($Consultaf);
                            if ($rowf > 0) {

                                while ($linhaf = mysqli_fetch_array($Consultaf)) {
                                    $nomef = $linhaf['nome'];
                                    //
                                    echo "<tr>";
                                    echo "<td><input type='checkbox' name='aluno_selecionado[]' class='marcar' value=" . $linhaf['id'] . " checked ></td>\n";
                                    echo "<td>" . $linhaf['nome'] . "</td>\n";
                                    echo "<td>" . $linha['id_turma'] . "</td>\n";
                                    echo "</tr>";
                                }
                            }
                        }
                    }
                }
                echo "</tbody>";
                echo "</table>";
                ?>
            </div>
        </form>
    </body>
    <script language="javascript">
        function validaRadio() {
            var frm = document.form1;
            //Percorre os elementos do formulário
            for (i = 0; i < frm.length; i++) {
                //Verifica se o elemento do formulário corresponde a um checkbox 
                if (frm.elements[i].type == "radio") {
                    //Verifica se o checkbox foi selecionado
                    if (frm.elements[i].checked) {
                        //alert("Exite ao menos um checkbox selecionado!");
                        return true;
                    }
                }
            }
            alert("Indique se o Aluno foi Aprovado,Reprovado ou algo do Genero.");
            return false;
        }
    </script> 
</html>
