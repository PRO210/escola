<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$Msg = "";
$M = "";
//
if ($Recebe == "massa") {
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;"
          . "</strong>" . "Dados foram Gravados $usuario_logado! Click em Prosseguir e Bom Trabalho:)</div>";
    $M = "1";
} elseif ($Recebe == "erro") {
    $Msg = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Ops! Alguma coisa deu errado $usuario_logado. Contate o Administrador! </div>";
    $M = "2";
}
//
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
//
$inep = $Registro["inep"];
$nome = $Registro["nome"];
$cadastro = $Registro["cadastro"];
$cnpj = $Registro["cnpj"];
$ato = $Registro["ato"];
$do = $Registro["do"];
$endereco = $Registro["endereco"];
$cidade = $Registro["cidade"];
$estado = $Registro["estado"];
$cep = $Registro["cep"];
$email = $Registro["email"];
$data_censo = $Registro["data_censo"];
$data_matricula_valida = $Registro["data_matricula_valida"];

?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DADOS DA ESCOLA</title>   
        <style>
            @media (max-width: 720px) {.botoes{margin-bottom:12px;}
            </style>
        </head>    
        <body>
            <?php
            include_once 'menu.php';
            ?>
            <form class="form-horizontal" name="cadastrar" action="dados_escola_server.php" method="post">  
                <div class="container">
                    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
                    <script src="js/bootstrap.min.js" type="text/javascript"></script>          
                    <div class="container theme-showcase" role="main">		
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Atenção!</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo $Msg ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Prosseguir</button>
                                    </div>
                                </div>
                            </div>
                        </div>	
                    </div>
                </div>      

                <?php
                if ($M == "1") {
                    echo"<script>
                    $(document).ready(function () {
                        $('#myModal').modal('show');
                    });
                </script>";
                } elseif ($M == "2") {

                    echo"<script>
                    $(document).ready(function () {
                        $('#myModal').modal('show');
                    });
                </script>";
                }
                ?>
                <div class="container">
                    <h3 style="text-align: center">Dados da Escola</h3>
                    <input type="hidden" name="inputId" value="1">
                    <div class="container-fluid col-sm-12 col-sm-offset-1">                    
                        <div class="form-group  col-sm-12">
                            <label for="inputNome" class="col-sm-2 control-label">Nome da Escola</label>
                            <div class="col-sm-6">
                                <input type="text" placeholder="DIGITE O NOME DA ESCOLA " class="form-control" id="" name="inputNome" value="<?php echo $nome; ?>" >
                            </div>                        
                        </div> 
                        <div class="form-group col-sm-12">
                            <label for="inputInep" class="col-sm-2 control-label">Nº INEP</label>
                            <div class="col-sm-6">                            
                                <input id="inputInep" type="number" min= '0'  max = '999999999999' step= "1"  class="form-control" name="inputInep" placeholder="Use Somente Números" value="<?php echo $inep; ?>">
                            </div > 
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="inputCadastro" class="col-sm-2 control-label">Cadastro Escolar</label>
                            <div class="col-sm-6">
                                <input type="text" placeholder="" class="form-control" id="" name="inputCadastro"  value="<?php echo $cadastro; ?>" >
                            </div>                        
                        </div>  
                        <div class="form-group col-sm-12">
                            <label for="inputCnpj" class="col-sm-2 control-label">CNPJ</label>
                            <div class="col-sm-6">                            
                                <input id="" type="text"  class="form-control" name="inputCnpj" placeholder="" value="<?php echo $cnpj; ?>">
                            </div> 
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="inputAto" class="col-sm-2 control-label">Ato de Funcionamento</label>
                            <div class="col-sm-6">                            
                                <input id="" type="text"  class="form-control" name="inputAto" placeholder="N° XXXX em XX/XX/XX" value="<?php echo $ato; ?>">
                            </div> 
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="inputDo" class="col-sm-2 control-label">D.O</label>
                            <div class="col-sm-6">                            
                                <input id="" type="text"  class="form-control" name="inputDo" placeholder="" value="<?php echo $do; ?>">
                            </div> 
                        </div>
                        <div class="form-group col-sm-12">  
                            <label for="inputEndereco" class="col-sm-2 control-label">Endereço</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="" name="inputEndereco" value="<?php echo $endereco; ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">  
                            <label for="inputEstado" class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="inputEstado" name="inputEstado">
                                    <?php
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `tb_estados` ORDER BY `nome`");
                                    echo "<option selected value = ''>SELECIONE O ESTADO ! </option>";
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        $cidade_nome = strtoupper($Registro["nome"]);
                                        $estado_id = $Registro["id"];
                                        //
                                        if ($estado == "$estado_id") {
                                            echo "<option value = '$estado_id' selected = ''>$cidade_nome</option>";
                                        } else {
                                            echo "<option value = '$estado_id'>$cidade_nome</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>    
                        </div>
                        <div class="form-group col-sm-12">  
                            <label for="inputCidade" class="col-sm-2 control-label">Cidade</label>
                            <div class="col-sm-6">                              
                                <select class="form-control" id="inputCidade" name="inputCidade" >
                                    <?php
                                    $Consulta = mysqli_query($Conexao, "SELECT * FROM `tb_cidades` ORDER BY `nome`");
                                    while ($Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
                                        //
                                        $cidade_nome = strtoupper($Registro["nome"]);
                                        $id_cidade = $Registro["id"];
                                        $uf_cidade = $Registro["uf"];
                                        //
                                        if ($cidade == "$id_cidade") {
                                            echo "<option  id='' value = '$id_cidade' selected = ''>$cidade_nome ($uf_cidade)</option>";
                                        } else {
                                            echo "<option  id='' value = '$id_cidade'>$cidade_nome ($uf_cidade)</option>";
                                        }
                                    }
                                    ?>                              
                                </select>                               
                            </div>  
                        </div>
                        <div class="form-group col-sm-12">  
                            <label for="inputCep" class="col-sm-2 control-label">CEP</label>
                            <div class="col-sm-6">
                                <script src="js/jquery.mask.js" type="text/javascript"></script>                            
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        var $campo = $("#inputCep");
                                        $campo.mask('00000-000', {reverse: true});
                                    });
                                </script>
                                <input type="text" class="form-control" id="inputCep" name="inputCep" value="<?php echo $cep; ?>">
                            </div>
                        </div> 
                        <div class="form-group col-sm-12">  
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="" name="inputEmail" value="<?php echo $email; ?>">
                            </div>
                        </div>                    
                        <div class="form-group col-sm-12">  
                            <label for="inputDateCenso" class="col-sm-2 control-label">Data Do Censo</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="" name="inputDateCenso" value="<?php echo $data_censo; ?>">
                            </div>
                        </div>                    
                        <div class="form-group col-sm-12">  
                            <label for="inputDateMatriculaValida" class="col-sm-2 control-label">Data Para Calcular a Idade</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="" name="inputDateMatriculaValida" value="<?php echo $data_matricula_valida; ?>">
                            </div>
                        </div>                    
                        <div class="form-group col-sm-12">                                              
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-3 botoes" >
                                <button type="submit" class="btn btn-success btn-block" onclick="return confirmar()">Enviar</button>                        
                            </div>
                            <div class="col-sm-3">                        
                                <button type="reset"  class="btn btn-danger btn-block">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>  
<script type="text/javascript">
    function confirmar() {

        var u = "<?php echo $usuario_logado ?>";
        var r = confirm("Posso Enviar " + u + "? ");

        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
</script>
</html>
