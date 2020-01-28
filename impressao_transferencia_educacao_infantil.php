<?php
include_once 'valida_cookies.inc';
?>
<?php
//include_once'./matricular.php';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//Recebe os valores da URL (Método GET)
$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$SQL_consulta_id = "SELECT * FROM `alunos` WHERE `id` = $id";
$Consulta = mysqli_query($Conexao, $SQL_consulta_id);
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
$nascimento = new DateTime($Linha["data_nascimento"]);
$nome = $Linha["nome"];
$turma = $Linha["turma"];
$mae = $Linha["mae"];
$pai = $Linha["pai"];
$naturalidade = $Linha["naturalidade"];
$estado = $Linha["estado"];
$hoje = date('d/m/Y');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DECLARAÇÃO DE TRANSFERÊNCIA INFANTIL<?php echo date_format($data_nascimento, 'd/m/Y'); ?></title>
        <link href="css/impressao_transferencia_educacao_infantil.css" rel="stylesheet" type="text/css"/>    
    </head>
    <body>
        <div class="header">
            <p><img id="brazao" src="img/Brazão Escola Luiz Celso Galindo.jpg"/></p>
            <p><img id="unicef" src="img/Celo Unicef.jpg" align =" right" /></p> 
            <div>
                <h1>ESCOLA LUIZ CELSO GALINDO</h1>
                <p>Criada pela Portaria N° 7658 de 08/10/1981.Publicada no Oficial de 09/10/1981.<br>Cadastro Escolar: 26049881</p>
            </div>
        </div>
        <div id="pos_header">
            <h2>DECLARAÇÃO</h2>           
        </div>
        <div>
            <div id="declaracao">
                <p>
                    Declaramos para os devidos fins que,<?php echo "$nome"; ?>, filha(o) <?php echo "$mae"; ?> e <?php echo "$pai"; ?>, 
                    nascida(o) no dia <?php echo date_format($nascimento, 'd/m/Y'); ?>, na cidade de <?php echo "$naturalidade-$estado"; ?>, esteve regularmente matriculado(a) nesta Unidade 
                    de Ensino cursando a série: <?php echo "$turma"; ?> (Educação Infantil) até o dia <?php echo "$hoje"; ?>, e o mesmo(a) tem direito de 
                    matricula-se no  <?php echo "$turma"; ?> este ano de 2017. 
                </p>
            </div>            
            <div id="pos_declaracao">
                <h4 style="text-align: center">POVOADO SÃO JOSÉ DO ALVERNE,<?php echo "$hoje"; ?>.</h4>
            </div>
            <div id="meio">
                <p>___________________________________________________________</p>
            </div>          
            <div id="meio_3">
                <p>SECRETARIA</p>
            </div>                      
            <div class="footer">
                <div id="footer2"><p>Av. São José, S/N  – E-mail: escluizcelso@outlook.com</p></div>
                <div id="footer2"><p>Povoado de São José do Alverne – Alagoinha - Pernambuco</P></div>
            </div>
        </div>
    </body>
</html>
