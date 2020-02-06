<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
//foreach (($_POST['aluno_selecionado']) as $buscar_id) {
//    $Consultaf = mysqli_query($Conexao, "SELECT alunos_pagamentos.*,alunos .*  FROM `alunos_pagamentos`,`alunos` WHERE alunos_pagamentos.id = '$buscar_id' AND alunos_pagamentos.aluno_id = alunos.id");
//    $rowf = mysqli_num_rows($Consultaf);
//    if ($rowf > 0) {
//        $data_pagamento = date_format(date_create($linhaf['data_pagamento']), 'm');
//        $mes = '';
//        switch (date($data_pagamento)) {
//            case 1: $mes = "Janeiro";
//                break;
//            case 2: $mes = "Fevereiro";
//                break;
//            case 3: $mes = "Março";
//                break;
//            case 4: $mes = "Abril";
//                break;
//            case 5: $mes = "Maio";
//                break;
//            case 6: $mes = "Junho";
//                break;
//            case 7: $mes = "Julho";
//                break;
//            case 8: $mes = "Agosto";
//                break;
//            case 9: $mes = "Setembro";
//                break;
//            case 10: $mes = "Outubro";
//                break;
//            case 11: $mes = "Novembro";
//                break;
//            case 12: $mes = "Dezembro";
//                break;
//        }
//    }
?>
<html lang="pt-br" style="background-color:white;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atualizar Boeltos</title>
        <style>
            .dropdown-menu{font-size: 14px !important;}
            .mensalidade{width: 120px !important;}
            .desconto{width: 120px !important;}
            .multa{width: 80px !important;}
            .bolsista_valor{width: 150px !important;}
        </style>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?> 
        <div class="container-fluid"> 
            <?php
            ?>
            <link href="assets/css/bootstrap-grid.css" rel="stylesheet" type="text/css"/>
            <link href="assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css"/>
            <link href="assets/css/bootstrap-reboot.css" rel="stylesheet" type="text/css"/>
            <link href="assets/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css"/>
            <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
            <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/> 
            <script src="assets/js/jquery.maskMoney.min.js" type="text/javascript"></script>
            <form name="cadastrar" action="boleto_listar_server.php" method="post" class="form-horizontal" >  
                <input type="hidden" name="usuario_logado" value="<?php echo $usuario_logado ?>">
                <div class="row" id="boletos">
                    <div class="col-md-12">                   
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>   
<!--                                    <th>
                                        <input class="radio"  type="radio" name="inlineRadioOptions" checked="" id="inlineRadio1" value="option1">
                                        <label class="" for="inlineRadio1">Gerar Boletos</label>
                                    </th>-->
                                    <th>
                                        <input class="radio" type="radio" name="inlineRadioOptions" id="inlineRadio2" checked="" value="option2">                                       
                                        <label class="" for="inlineRadio2"> Atualizar Boletos</label>
                                    </th>
                                    <th>
                                        <input class="radio" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                        <label class="" for="inlineRadio3"> Deletar Boletos</label>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>                                
<!--                                <tr>                                
                                    <th colspan = '3'>
                                        Mês e Ano do Boleto: <input type="date" name="previsao_pagamento" style="width: 100% !important">
                                    </th>                                    
                                </tr>-->
                                <tr class="pago_em" style="display:">                                
                                    <th colspan = '3'>
                                        Pago em: <input type="date" name="pago_em" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr class="mensalidade">                                
                                    <th colspan = '3'>
                                        Mensalidade:<input class="form-control dinheiro" type="text" name="mensalidade" id="mensalidade" value="0.00" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr style="display: " class="desconto">                                
                                    <th colspan = '3'>
                                        desconto:<input class="form-control dinheiro" type="text" name="desconto" id="desconto" value="0.00" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr style="display: " class="multa">                                
                                    <th colspan = '3'>
                                        multa:<input class="form-control dinheiro" type="text" name="multa" id="multa" value="0.00" style="width: 100% !important">
                                    </th>                                    
                                </tr>
                                <tr class="bolsista">                                
                                    <th colspan = '3'>
                                        Aluno Bolsista: 
                                        <select class="form-control" name="bolsista" style="width: 100% !important">
                                            <option>SIM</option>
                                            <option value="NAO" selected="">NÃO</option>
                                        </select>
                                    </th>                                    
                                </tr>
                                <tr class="bolsista_valor">                                
                                    <th colspan = '3'>
                                        Valor da Bolsa:<input class="form-control dinheiro" type="text" name="bolsista_valor" id="bolsista_valor" value="0.00" style="width: 100% !important">
                                    </th>                                    
                                </tr>   
                                <tr>                                
<!--                                    <th>
                                        <button  id ='boletos_criar'  type='submit' value='boletos' name = 'boletos_criar' class='btn btn-primary  btn-block' onclick = 'return confirmar()' >Criar Novo Boleto</button>
                                    </th>                                    -->
                                    <th>
                                        <button  id ='boletos_atualizar' type='submit' value='boletos' name = 'boletos_atualizar' class='btn btn-success  btn-block' onclick = 'return confirmar()' >Atualizar Boleto</button>
                                    </th>                                    
                                    <th>
                                        <button  id ='boletos_excluir' disabled="" type='submit' value='boletos' name = 'boletos_excluir' class='btn btn-danger  btn-block' onclick = 'return confirmar()' >Excluir Boleto</button>
                                    </th>                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>                                           
                </div>
                <?php
                echo "<table class='table table-striped table-bordered' id='tbl_alunos_lista' width='100%' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th> SELEÇÃO</th>";
                echo "<th> NOME </th>";
                echo "<th> NASCIMENTO </th>";
                echo "<th> PREVISÃO DE <BR> PAGAMENTO </th>";
                echo "<th id = 'ocultar_2'> MÃE </th>";
//                echo "<th id = 'ocultar'> NIS </th>";
//                echo "<th id = 'ocultar'> SUS </th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach (($_POST['aluno_selecionado']) as $buscar_id) {

                    $Consultaf = mysqli_query($Conexao, "SELECT alunos_pagamentos.*,alunos.nome,alunos.mae,alunos.data_nascimento  FROM `alunos_pagamentos`,`alunos` WHERE alunos_pagamentos.id = '$buscar_id' AND alunos_pagamentos.aluno_id = alunos.id");
                    $rowf = mysqli_num_rows($Consultaf);

                    if ($rowf > 0) {

                        while ($linhaf = mysqli_fetch_array($Consultaf)) {
                            $nomef = $linhaf['nome'];
                            $aluno_id = $linhaf['aluno_id'];
                            $data_nascimentof = new DateTime($linhaf['data_nascimento']);
                            $data_nascimentof = date_format($data_nascimentof, 'd/m/Y');
                            $maef = $linhaf['mae'];
                            $idf = $linhaf['id'];
                            $data_pagamento = date_format(date_create($linhaf['data_pagamento']), 'm');
                            $mes = '';
                            $ano = date_format(date_create($linhaf['data_pagamento']), 'Y');
                            switch (date($data_pagamento)) {
                                case 1: $mes = "Janeiro";
                                    break;
                                case 2: $mes = "Fevereiro";
                                    break;
                                case 3: $mes = "Março";
                                    break;
                                case 4: $mes = "Abril";
                                    break;
                                case 5: $mes = "Maio";
                                    break;
                                case 6: $mes = "Junho";
                                    break;
                                case 7: $mes = "Julho";
                                    break;
                                case 8: $mes = "Agosto";
                                    break;
                                case 9: $mes = "Setembro";
                                    break;
                                case 10: $mes = "Outubro";
                                    break;
                                case 11: $mes = "Novembro";
                                    break;
                                case 12: $mes = "Dezembro";
                                    break;
                            }

                            echo "<tr>";
                            echo "<td><input type='checkbox' name='aluno_selecionado[]' class='marcar' value='$idf' checked ></td>\n";
                            echo "<td>" . $nomef . "</td>\n";
                            echo "<td>" . $data_nascimentof . "</td>\n";
                            echo "<td>" . $mes . '/' . $ano . "</td>\n";                          
                            echo "<td id = 'ocultar_2'>" . $maef . "</td>\n";
//                            echo "<td id = 'ocultar'>" . $nis . "</td>\n";
//                            echo "<td id = 'ocultar'>" . $susf . "</td>\n";
                            echo "</tr>";
                        }
                    }
                }
                echo "</tbody>";
                echo "</table>";
                ?>        


            </form>
        </div>
        <script>
                $(document).ready(function () {
                    var maxLength = '-0.000,00'.length;
                    $("#desconto").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
                    $("#multa").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
                    $("#mensalidade").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');
                    $("#bolsista_valor").maskMoney({thousands: ".", decimal: ",", symbol: "R$", showSymbol: true, symbolStay: true}).attr('maxlength', maxLength).trigger('mask.maskMoney');

                });
            </script>           
            <script>
                function confirmar() {
                    var r = confirm('Realmente deseja Salvar as Alterações <?php echo "$usuario_logado" ?>?');
                    if (r == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>
        <script>
            //Cuida do botões dos boletos e de alguns campos da tabela
            $(document).ready(function () {
                $('.radio').change(function () {
                    var radio = $(this).val();
                    if (radio == "option1") {
                        $('#boletos_criar').removeAttr('disabled');
                        $('#boletos_atualizar').attr('disabled', 'disabled');
                        $('#boletos_excluir').attr('disabled', 'disabled');
                        $('.desconto').hide(2000);
                        $('.multa').hide(2000);
                        $('.pago_em').hide(2000);
                        $('.mensalidade').show(2000);
                        $('.bolsista').show(2000);
                        $('.bolsista_valor').show(2000);

                    } else if (radio == "option2") {
                        $('#boletos_atualizar').removeAttr('disabled');
                        $('#boletos_criar').attr('disabled', 'disabled');
                        $('#boletos_excluir').attr('disabled', 'disabled');
                        $('.desconto').show(2000);
                        $('.multa').show(2000);
                        $('.pago_em').show(2000);
                        $('.mensalidade').show(2000);
                        $('.bolsista').show(2000);
                        $('.bolsista_valor').show(2000);
                    } else {
                        $('#boletos_excluir').removeAttr('disabled');
                        $('#boletos_atualizar').attr('disabled', 'disabled');
                        $('#boletos_criar').attr('disabled', 'disabled');
                        $('.desconto').hide(2000);
                        $('.multa').hide(2000);
                        $('.pago_em').hide(2000);
                        $('.mensalidade').hide(2000);
                        $('.bolsista').hide(2000);
                        $('.bolsista_valor').hide(2000);
                    }
                });
            });
        </script>
    </body>
</html>
