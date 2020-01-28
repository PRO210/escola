<!DOCTYPE html>
<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
$inep = $Registro["inep"];
$escola_nome = $Registro["nome"];
$cadastro = $Registro["cadastro"];
$cnpj = $Registro["cnpj"];
$escola_endereco = $Registro["endereco"];
$escola_cidade = $Registro["cidade"];
$escola_estado = $Registro["estado"];
$cep = $Registro["cep"];
$email = $Registro["email"];
//
$Consulta_up2 = mysqli_query($Conexao, "SELECT  * FROM `tb_cidades` WHERE id = '$escola_cidade'");
$Registro_up2 = mysqli_fetch_array($Consulta_up2, MYSQLI_BOTH);
$escola_cidade = strtoupper($Registro_up2["nome"]);
//
$Consulta_up3 = mysqli_query($Conexao, "SELECT  * FROM `tb_estados` WHERE id = '$escola_estado' ");
$Registro_up3 = mysqli_fetch_array($Consulta_up3, MYSQLI_BOTH);
$escola_estado = strtoupper($Registro_up3["uf"]);
//
$querySelecionaPorCodigo = "SELECT * FROM `imagens` ORDER BY `id`  DESC  LIMIT 1";
$resultado = mysqli_query($Conexao, $querySelecionaPorCodigo);
$imagem = mysqli_fetch_object($resultado);
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Folha de Ré Matricula</title>
        <link href="css/folha_re_matricula.css" rel="stylesheet" type="text/css"/>        
    </head>
    <body>
        <div id="timbre" style="margin-top: -5mm">             
            <img src="data:image/jpg;base64,<?php echo base64_encode($imagem->blob_imagem) ?>" />
        </div>
        <div id="pos_timbre">
            <h3>RENOVAÇÃO DE MATRICULA</h3>
        </div>
        <div id="folha_de_matricula">
            <img src="img/folha_re_matricula.jpeg" alt=""/>
        </div>
        <div id="pos_img2">   
            <p style = "font-size:8px; " >C.N.P.J.:<?php echo "$cnpj" ?></p>
            <p style="margin-top: -6px; font-size:8px ">End.:<?php echo "$escola_endereco" ?> - <?php echo "$escola_cidade" ?> - <?php echo "$escola_estado" ?>, CEP.:55.2600.000, 
                - email.:<?php echo "$email" ?></p>
        </div>
    </body>
</html>