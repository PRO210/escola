<?php
include_once 'valida_cookies.inc';
$usuarioAdmin = $_COOKIE["nome_usuario"];
?>
<?php
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>        
        <title>Cadastros Atualizações de Alunos</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        //
        $id = base64_decode($_GET['id']);
        //echo "$id";
        $Consulta2 = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE id = '$id' ");
        $linha2 = mysqli_fetch_array($Consulta2);

        $usuario = $linha2['usuario'];
        $senha = $linha2['senha'];
        $nome_completo = $linha2['nome'];
        $tipo = $linha2['tipo'];
        ?>
        <div class="row">
            <div class="container">
                <div class="starter-template">
                    <h1 style="text-align: center">Cadastro de Usuário</h1>
                    <form name="cadastrar_usuario" action="cadastrar_usuario_server.php" method="post" class="form-horizontal" onsubmit="return validar()">
                        <div class="form-group">
                            <label for="inputUsuario" class="col-sm-3 control-label">Nome do Usuário</label>
                            <div class="col-sm-6">
                                <input type="text" name="inputUsuario" id="inputTurma" class="form-control" placeholder="NOME  PARA LOGAR" required=""  value="<?php echo "$usuario"; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNome" class="col-sm-3 control-label">Nome Completo do Usuário</label>
                            <div class="col-sm-6">
                                <input type="text" name="inputNome" id="inputTurma" class="form-control" placeholder="NOME COMPLETO" value="<?php echo $nome_completo ?>" onkeyup="maiuscula(this)">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="inputTipo" class="col-sm-3 control-label">Categoria</label>
                            <div class="col-sm-6" >
                                <select class="form-control" name = "inputTipo">
                                    <?php
                                    $txt_option = "ADMIN";
                                    $txt_option2 = "USUARIO";
                                    if ($tipo == 0) {
                                        echo "<option selected>$txt_option</option>";
                                        echo "<option>$txt_option2</option>";
                                    } else {
                                        echo "<option selected>$txt_option2</option>";
                                        echo "<option>$txt_option</option>";
                                    }
                                    ?>                                                                       
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSenha" class="col-sm-3 control-label">Senha</label>
                            <div class="col-sm-6">
                                <input type="password" name="inputSenha" id="inputSenha" class="form-control" placeholder=" SENHA" required="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputContraSenha" class="col-sm-3 control-label">Contra Senha</label>
                            <div class="col-sm-6">
                                <input type="password" name="inputContraSenha" id="inputContraSenha" class="form-control" placeholder="REPITA A SENHA" required="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputId" class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <input hidden="" name="inputId" value="<?php echo "$id"; ?>" >
                            </div>
                        </div>              
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" value="atualizar_usuario" class="btn btn-success" name="atualizar_usuario">Cadastrar</button>
                                <button type="reset" class="btn btn-danger">Limpar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function confirmarAtualizacao() {
                var r = confirm("Realmente deseja atualizar todos?");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
        <script type="text/javascript">
            function validar() {
                if (document.cadastrar_update_usuario.inputNome.value == "" || document.cadastrar_update_usuario.inputNome.value.length < 5)
                {
                    alert("O campo Nome não pode está vazio ou ter menos de 5 Caracteres");
                    document.cadastrar_update_usuario.inputNome.focus();
                    return false;
                }

            }
            function validar() {
                if (document.cadastrar_update_usuario.inputUsuario.value == "" || document.cadastrar_update_usuario.inputUsuario.value.length < 3)
                {
                    alert("O campo Nome não pode está vazio ou ter menos de 5 Caracteres");
                    document.cadastrar_update_usuario.inputUsuario.focus();
                    return false;
                }
        </script>
        <script type="text/javascript">
                // INICIO FUNÇÃO DE MASCARA MAIUSCULA
                function maiuscula(z) {
                    v = z.value.toUpperCase();
                    z.value = v;
                }
        </script>
        <script type="text/javascript">
                $('form').on('submit', function () {
                    if ($('#inputSenha').val() != $('#inputContraSenha').val()) {
                        alert('Senhas diferentes');
                        return false;
                    }
                }
                );
        </script>
    </body>
</html>
