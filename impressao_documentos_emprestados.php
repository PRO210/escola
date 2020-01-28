<?php
include_once 'valida_cookies.inc';
?>
<?php
//include_once'./matricular.php';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");

//Recebe os valores da URL (Método GET)
$id = base64_decode(filter_input(INPUT_GET, 'id', FILTER_DEFAULT));
$SQL_consulta_id = "SELECT * FROM `documentos_emprestados` WHERE `id` = $id";
$Consulta = mysqli_query($Conexao, $SQL_consulta_id);
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$emprestado = new DateTime($Linha["emprestado"]);
$emprestado_convertida = date_format($emprestado, 'd/m/Y');
$devolucao = new DateTime($Linha["devolucao"]);
$devolucao_convertida = date_format($devolucao, 'd/m/Y');
 $hoje = date('d/m/Y');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>

        <link href="css/impressao_documentos_emprestados.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="header">
            <p><img id="brazao" src="img/Brazão Escola Luiz Celso Galindo.jpg"/></p>
            <p> <img id="unicef" src="img/Celo Unicef.jpg" align =" right" /></p> 
            <div>
                <h1>Escola Luis Celso Galindo</h1>
                <p>Criada pela Portaria N° 7658 de 08/10/1981.Publicada no Oficial de 09/10/1981.<br>Cadastro Escolar: 26049881</p>
            </div>
        </div>
        <div id="pos_header">
            <h1>Termo de Responsabilidade</h1>           
        </div>
        <div>
            <div id="declaracao">
                <p>Eu, <b><?php echo $Linha ["nome"]; ?>,RG:<?php echo $Linha ["certidao"]; ?> e CPF:<?php echo $Linha ["cpf"]; ?>,</b> declaro ter retirado 
                    no dia <b><?php echo $emprestado_convertida ?></b>, o(s) seguinte(s) documento(s) abaixo relacionado(s) e 
                    comprometo-me devolve-lo(s) no dia <b><?php echo $devolucao_convertida ?></b>, na Escola Municipal Luiz Celso Gallindo.
                </p>
            </div>
            <div id="documentos">
                <h4 style="margin: 12px;">DOCUMENTOS EMPRESTADOS:</h4><p><?php echo $Linha ["documentos"]; ?>.</p>
            </div>
            <h4 style="text-align: center">POVOADO SÃO JOSÉ DO ALVERNE,<?php echo "$hoje";?>.</h4>
            <div id="meio">
                <p>___________________________________________________________</p>
            </div>
            <div class="">
                <div id="meio2"><p>SECRETARIA</p></div>
            </div>
            <div id="fim">
                <p>___________________________________________________________</p>
            </div>
            <div id="fim2">
                <p>ASSINATURA DO RETIRANTE DO(S) DOCUMENTO(S)</p> 
            </div>
            <div class="footer">
                <div id="footer2"><p>Av. São José, S/N  – E-mail: escluizcelso@outlook.com</p></div>
                <div id="footer2"><p>Povoado de São José do Alverne – Alagoinha - Pernambuco</P></div>
            </div>
        </div>
    </body>
</html>
