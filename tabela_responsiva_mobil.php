<?php
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
?>
<html lang="pt-br">
    <head>
        <title>
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            .verde{
                color: green;
            }
            .vermelho{
                color: red;
            }
            .amarelo{
                color: orange;
            }
        </style>   
    </head>
    <body>
        <?php
        include_once 'menu.php';
        ?>
        <link href="Tabela_Responsiva/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="Tabela_Responsiva/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="Tabela_Responsiva/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="Tabela_Responsiva/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="Tabela_Responsiva/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="Tabela_Responsiva/dataTables.responsive.min.js" type="text/javascript"></script>
        <script src="Tabela_Responsiva/dataTables.rowReorder.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <div class="container-fluid">          
            <h3></h3>
            <table id="example" class="display nowrap" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Seq.</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Start date</th>
                        <th>Salary</th>                        
                    </tr>
                </thead>
                <!--
                <tfoot>
                    <tr>
                        <th>Seq.</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
                -->
                <tbody>
                    <tr>
                        <td>teste</td>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="dropdown">
                                <input type="checkbox" class="checkbox-inline">
                                &nbsp;&nbsp;<span class=" glyphicon glyphicon-cog text-success" id="dropdownMenu1" data-toggle="dropdown" ></span>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#"><span class='glyphicon glyphicon-print verde ' aria-hidden='true'>&nbsp;</span>Imprimir</a></li>
                                    <li><a href="#">Another action</a></li>                               
                                </ul>
                            </div>
                        </td>
                        <td>Ándre</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>ándre</td>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>
                    <tr>
                        <td>andré</td>
                        <td>Gloria Little</td>
                        <td>Systems Administrator</td>
                        <td>New York</td>
                        <td>2009/04/10</td>
                        <td>$237,500</td>
                    </tr>
                    <tr>
                        <td>ándre</td>
                        <td>Timothy Mooney</td>
                        <td>Office Manager</td>
                        <td>London</td>
                        <td>2008/12/11</td>
                        <td>$136,200</td>
                    </tr>
                    <tr>
                        <td>34</td>
                        <td>Jackson Bradshaw</td>
                        <td>Director</td>
                        <td>New York</td>
                        <td>2008/09/26</td>
                        <td>$645,750</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Olivia Liang</td>
                        <td>Support Engineer</td>
                        <td>Singapore</td>
                        <td>2011/02/03</td>
                        <td>$234,500</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Bruno Nash</td>
                        <td>Software Engineer</td>
                        <td>London</td>
                        <td>2011/05/03</td>
                        <td>$163,500</td>
                    </tr>
                    <tr>
                        <td>31</td>
                        <td>Sakura Yamamoto</td>
                        <td>Support Engineer</td>
                        <td>Tokyo</td>
                        <td>2009/08/19</td>
                        <td>$139,575</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Thor Walton</td>
                        <td>Developer</td>
                        <td>New York</td>
                        <td>2013/08/11</td>
                        <td>$98,540</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Finn Camacho</td>
                        <td>Support Engineer</td>
                        <td>San Francisco</td>
                        <td>2009/07/07</td>
                        <td>$87,500</td>
                    </tr>
                    <tr>
                        <td>44</td>
                        <td>Serge Baldwin</td>
                        <td>Data Coordinator</td>
                        <td>Singapore</td>
                        <td>2012/04/09</td>
                        <td>$138,575</td>
                    </tr>
                    <tr>
                        <td>42</td>
                        <td>Zenaida Frank</td>
                        <td>Software Engineer</td>
                        <td>New York</td>
                        <td>2010/01/04</td>
                        <td>$125,250</td>
                    </tr>
                    <tr>
                        <td>27</td>
                        <td>Zorita Serrano</td>
                        <td>Software Engineer</td>
                        <td>San Francisco</td>
                        <td>2012/06/01</td>
                        <td>$115,000</td>
                    </tr>                    
                </tbody>
            </table> 
            <script>
                function clearString(str) {
                    return str.toLowerCase()
                            .replace(/[áãà]/g, 'a')
                            .replace(/[ÁÀÃ]/g, 'A')
                            .replace(/é/g, 'e')
                            .replace(/É/g, 'e')
                            .replace(/í/g, 'i')
                            .replace(/[óõô]/g, 'o')
                            .replace(/[úü]/g, 'u')
                            .replace(/ç/g, 'c');
                }
                $(document).ready(function () {
                    var table = $('#example').DataTable({
                        'aoColumns': [
                            null,
                            {'sType': 'clear-string'},
                            null,
                            null,
                            null,
                            null
                        ],
                        rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                        responsive: true,
                        "aria": {
                            "sortAscending": ": ative a ordenação cressente",
                            "sortDescending": ": ative a ordenação decressente"
                        }
                    });
                });
            </script>
        </div>
    </body>
</html>
