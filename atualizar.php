<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>

<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
$id_consulta = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$id_consulta_limpo = base64_decode($id_consulta);
$Consulta_aluno = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE id=" . $id_consulta_limpo . ";");
$Registro_aluno = mysqli_fetch_array($Consulta_aluno, MYSQLI_BOTH);
?>


<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Matrículas</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>   
        <div class="container">
            <div class="starter-template">
                <form action="matricular.php" method="post" class="form-horizontal" >
                    <div class="form-group">
                        <label for="inputTurma" class="col-sm-3 control-label">Turma</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inputTurma" id="inputTurma">
                                <?php
                                $Consulta = mysqli_query($Conexao, "SELECT * FROM `turmas`");
                                while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                    $turma = $Registro["turma"];
                                    $turno = $Registro["turno"];
                                    $txt_turma = "$turma ($turno)";
                                    if ($Registro_aluno['turma'] == ($txt_turma)) {
                                        echo "<option selected>$turma ($turno)</option>";
                                    } else {
                                        echo "<option>$turma ($turno)</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNome" class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputNome" name="inputNome" value="<?php echo $Registro_aluno['nome']; ?>">
                            <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $Registro_aluno['id']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNascimento" class="col-sm-3 control-label">Data de Nascimento</label>
                        <div class="col-sm-9">
                            <script type="text/javascript">
                                $(function () {
                                    $("#inputNascimento").mask("99/99/9999");
                                });
                            </script>
                            <input id="inputNascimento" type="date" class="form-control" id="inputNascimento" name="inputNascimento">
                        </div>
                    </div>     
                    <div class="form-group">
                        <label for="inputTiposCertidao" class="col-sm-3 control-label">Tipos de Certidão Civil</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inputTiposCertidao" id="inputSexo">
                                <option value="Nascimento">Nascimento</option>
                                <option value="Casamento">Casamento</option>
                            </select>
                        </div>
                    </div>         
                    <div class="form-group">
                        <label for="inputCertidao" class="col-sm-3 control-label">Dados da Certidão Civil</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputCertidao" name="inputCertidao"  value="<?php echo $Registro_aluno['certidao_civil']; ?>">
                        </div>
                    </div>        
                    <div class="form-group">
                        <label for="inputExpedicao" class="col-sm-3 control-label">Data de expedição da Certidão</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="inputExpedicao" name="inputExpedicao"  value="<?php echo $Registro_aluno['data_expedicao']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNaturalidade" class="col-sm-3 control-label">Naturalidade/Estado</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputNaturalidade" name="inputNaturalidade"  value="<?php echo $Registro_aluno['naturalidade']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNacionalidade" class="col-sm-3 control-label">Nacionalidade</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputNacionalidade" name="inputNacionalidade" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSexo" class="col-sm-3 control-label">Sexo</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inputSexo" id="inputSexo">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNIS" class="col-sm-3 control-label">NIS</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputNIS" name="inputNIS"  value="<?php echo $Registro_aluno['nis']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSUS" class="col-sm-3 control-label">SUS</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputSUS" name="inputSUS"  value="<?php echo $Registro_aluno['sus']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPai" class="col-sm-3 control-label">Nome do Pai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputPai" name="inputPai"  value="<?php echo $Registro_aluno['pai']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProfissaoPai" class="col-sm-3 control-label">Profissão do Pai</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputProfissaoPai" name="inputProfissaoPai"  value="<?php echo $Registro_aluno['profissao_pai']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMae" class="col-sm-3 control-label">Nome da Mãe</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputMae" name="inputMae" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProfissaoMae" class="col-sm-3 control-label">Profissão da Mãe</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputProfissaoMae" name="inputProfissaoMae" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEndereco" class="col-sm-3 control-label">Endereço</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEndereco" name="inputEndereco" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCidade" class="col-sm-3 control-label">Cidade/Estado</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputCidade" name="inputCidade" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTransporte" class="col-sm-3 control-label">Transporte</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inputTransporte" id="inputTransporte">
                                <option>SIM</option>
                                <option>NÃO</option>
                            </select>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary">Matricular</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="reset" class="btn btn-danger">Limpar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </body>
</html>
