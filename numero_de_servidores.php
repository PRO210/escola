<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
?>    

<?php
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
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <link href="media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/cadastrar_validar.js" type="text/javascript"></script>
    </head>   
    <body>
        <?php
        include_once './menu.php';
        ?>  

        <?php
        $ConsultaEfetivos = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `vinculo` LIKE 'EFETIVO(A)' ORDER BY nome ");
        $ConsultaEfetivosCont = mysqli_num_rows($ConsultaEfetivos);

        $ConsultaContratado = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `vinculo` LIKE 'CONTRATADO(A)' ORDER BY nome ");
        $ConsultaContratadoCont = mysqli_num_rows($ConsultaContratado);

        $ConsultaAmigos = mysqli_query($Conexao, "SELECT * FROM `servidores` WHERE `vinculo` LIKE 'AMIGOS DA ESCOLA' ORDER BY `nome`");
        $ConsultaAmigosCont = mysqli_num_rows($ConsultaAmigos);
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4" >
                    <h3>Efetivos</h3>
                    <form method="GET" action="mostrar_cadastro_servidor.php">
                        <table class='table table-striped table-bordered' id='tbl_alunos_lista'>
                            <tr>
                                <th hidden="">ID</th>
                                <th>NOME</th>
                                <th>FUNÇÃO</th>
                                <th>TURNO</th>

                            </tr>
                            <?php
                            while ($linhaEfetivos = mysqli_fetch_array($ConsultaEfetivos)) {
                                ?>
                                <form>
                                    <tr>
                                        <td hidden=""><?php echo $linhaEfetivos['id']; ?></td>
                                        <td><?php echo $linhaEfetivos['nome']; ?></td>
                                        <td><?php echo $linhaEfetivos['funcao']; ?></td>
                                        <td><?php echo $linhaEfetivos['turno']; ?></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td style="text-align: right; font-weight: bold;">SOMA</td>
                                    <td><?php echo $ConsultaEfetivosCont; ?></td>
                                </tr>
                        </table>
                    </form>
                </div>
                <div class="col-md-4">
                    <h3>Contratados</h3>
                    <table class='table table-striped table-bordered' id='tbl_alunos_lista'>
                        <tr>
                            <th hidden="">ID</th>
                            <th>NOME</th>
                            <th>FUNÇÃO</th>
                            <th>TURNO</th>

                        </tr>
                        <?php
                        while ($linhaContratado = mysqli_fetch_array($ConsultaContratado)) {
                            ?>
                            <tr>
                                <td hidden=""><?php echo $linhaContratado['id']; ?></td>
                                <td><?php echo $linhaContratado['nome']; ?></td>
                                <td><?php echo $linhaContratado['funcao']; ?></td>
                                <td><?php echo $linhaContratado['turno']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">SOMA</td>
                            <td><?php echo "$ConsultaContratadoCont"; ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-4">
                    <h3>Amigos da Escola</h3>
                    <table class='table table-striped table-bordered' id='tbl_alunos_lista'>
                        <tr>
                            <th hidden="">ID</th>
                            <th>NOME</th>
                            <th>FUNÇÃO</th>
                            <th>TURNO</th>
                        </tr>
                        <?php
                        while ($linhaAmigos = mysqli_fetch_array($ConsultaAmigos)) {
                            ?>
                            <tr>
                                <td hidden=""><?php echo $linhaAmigos['id']; ?></td>
                                <td><?php echo $linhaAmigos['nome']; ?></td>
                                <td><?php echo $linhaAmigos['funcao']; ?></td>
                                <td><?php echo $linhaAmigos['turno']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">SOMA</td>
                            <td><?php echo $ConsultaAmigosCont; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body> 
</html>
