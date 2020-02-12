<?php
include_once 'valida_cookies.inc';
$usuarioAdmin = $_COOKIE["nome_usuario"];
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <?php
        include_once './head.php';
        ?>        
        <title>Cadastro de Usuários</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>         
        <div class="row">
            <div class="container">
                <div class="starter-template">
                    <h1 style="text-align: center">Cadastro de Usuário</h1>
                    <form name="cadastrar_usuario" action="cadastrar_usuario_server.php" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputNome" class="col-sm-3 control-label">Nome Completo do Usuário</label>
                            <div class="col-sm-6">
                                <input type="text" name="inputNome" id="inputNome" class="form-control" placeholder="NOME COMPLETO" onkeyup="maiuscula(this)" required="">
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="inputUsuario" class="col-sm-3 control-label">Usuário</label>
                            <div class="col-sm-6">
                                <input type="text" name="inputUsuario" id="inputUsuario" class="form-control" placeholder="NOME  PARA LOGAR" onkeyup="maiuscula(this)" required="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTipo" class="col-sm-3 control-label">Categoria</label>
                            <div class="col-sm-6" >
                                <select class="form-control" name = "inputTipo">
                                    <option value= "ADMIN" >ADMIN</option>
<<<<<<< HEAD
                                    <option value= "USUARIO" >USUÁRIO</option>
=======
                                    <option value= "SECRETARIA" >SECRETARIA</option>
>>>>>>> 988f9fde28ab1bedf650a85e5bb6829f80dfa770
                                    <option value= "FINANCEIRO" >FINANCEIRO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSenha" class="col-sm-3 control-label">Senha</label>
                            <div class="col-sm-6">
                                <input type="password" name="inputSenha" id="inputSenha" class="form-control" placeholder=" SENHA" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputContraSenha" class="col-sm-3 control-label">Contra Senha</label>
                            <div class="col-sm-6">
                                <input type="password" name="inputContraSenha" id="inputContraSenha" class="form-control" placeholder="REPITA A SENHA" required="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" value="Enviar" class="btn btn-success" name="cadastrar_Usuario">Cadastrar</button>
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
            $('form').on('submit', function () {
                if ($('#inputNome').val().length < 5) {
                    alert('O campo Nome não pode está vazio ou ter menos de 5 Caracteres');
                    document.cadastrar_usuario.inputNome.focus();
                    return false;
                }
                if ($('#inputUsuario').val().length < 3) {
                    alert('O campo Usuario não pode está vazio ou ter menos de 3 Caracteres');
                    document.cadastrar_usuario.inputUsuario.focus();
                    return false;
                }
            });
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
            });
        </script>
    </body>
</html>
