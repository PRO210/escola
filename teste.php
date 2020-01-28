<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);

//        //
//        $inicio = '2020-01-01';
//        $fim = '2020-01-16';
//        //
//        $inicio_str = strtotime("$inicio");
//        $fim_str = strtotime("$fim");
//        $resultado = $fim_str - $inicio_str;
//        //
//        $dias_dif = (int) floor($resultado / (60 * 60 * 24)); //Em Dias
//        //echo "$dias_dif" . '<br>';
//        $meses = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outrubro", "Novembro", "Dezembro");
//        $dias = array("domingo", "seg", "ter", "qua", "qui", "sex", "sabado", "domingo");
//        //
//        $i = 0;
//        while ($i <= $dias_dif) {
//            //
//            $dataFinalCalculada = date("Y-m-d", strtotime("$inicio" . "+$i days"));
//            // echo $dataFinalCalculada . '<br>';
//            //
//            $dia = date("d", strtotime("$inicio" . "+$i days"));
//            $mes = date("m", strtotime("$inicio" . "+$i days"));
//            $ano = date("Y", strtotime("$inicio" . "+$i days"));
//            $semana = date("w", strtotime("$inicio" . "+$i days"));
//            $dmy = $dias[$semana] . " " . $dia . " de " . $meses [$mes - 1] . " de " . $ano;
//            echo"$dmy" . "<br>";
//            $i++;
//             $sql = "INSERT INTO `dia_mes_ano` (`id`, `d_m_a`, `dias_nome`, `feriados`, `feriado_nome`) VALUES (NULL, '$dataFinalCalculada', '$dias[$semana]', 'NÃO', '')";
//            //$consulta = mysqli_query($conexao, $sql);
//            //echo "$sql".'<br>';
//        }
//
//        $date1 = date_create("2017-08-30");
//        $date2 = date_create("2016-08-01");
//        $diff = date_diff($date1, $date2);
//       // echo $diff->format("%a") . '<br>';
////
//      //  echo $diff->format("%Y");
////$dataFinalCalculada = date("Y-m-d", strtotime($data_inicial . "+$tempo2 days"));
?>
<html>
    <head>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>    
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>   
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <?php
        include_once './head.php';
        ?>
    </head>
    <body>
        <!--        <form method="post" action="dados_escola_feriados_server.php" name="form1">
                    <style>
                        /*Regra para a animacao*/
                        @keyframes spin {
                            0% { transform: rotate(0deg); }
                            100% { transform: rotate(360deg); }
                        }
                        /*Mudando o tamanho do icone de resposta*/
                        div.glyphicon {
                            color:#6B8E23;
                            font-size: 38px;
                        }
                        /*Classe que mostra a animacao 'spin'*/
                        .loader {
                            border: 16px solid #f3f3f3;
                            border-radius: 50%;
                            border-top: 16px solid #3498db;
                            width: 80px;
                            height: 80px;
                            -webkit-animation: spin 2s linear infinite;
                            animation: spin 2s linear infinite;
                        }
                    </style>     
                     loadingModal
                    <div class="modal fade" data-backdrop="static" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal_label">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loadingModal_label">
                                        <span class="glyphicon glyphicon-refresh"></span>
                                        Aguarde...
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <div class='alert' role='alert'>
                                        <center>
                                            <div class="loader" id="loader"></div><br>
                                            <h4><b id="loadingModal_content"></b></h4>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        
                    <nav class="navbar"></nav>
                    <div class="container">
                        <button type="button" class="btn btn-primary" id="btn-getResponse">   getResponse     </button>         
                    </div>
                    <script>
                        //Comportamento do botao de disparo
                        $(function () {
                            //Comportamento do botao de disparo
                            $('#btn-getResponse').click(function () {
                                getResponse();
                            });
                        });
                        //
                        function getResponse() {
                            //Preenche e mostra o modal           
                            $('#loadingModal_content').html('Carregando...');
                            $('#loadingModal').modal('show');
                            //Envia a requisicao e espera a resposta
                            $.post("dados_escola_feriados_server.php")
                                    .done(function () {
                                        //Se nao houver falha na resposta, preenche o modal
                                        $('#loader').removeClass('loader');
                                        $('#loader').addClass('glyphicon glyphicon-ok');
                                        $('#loadingModal_label').html('Sucesso!');
                                        $('#loadingModal_content').html('<br>Query executada com sucesso!');
                                        resetModal();
                                    })
                                    .fail(function () {
                                        //Se houver falha na resposta, mostra o alert
                                        $('#loader').removeClass('loader');
                                        $('#loader').addClass('glyphicon glyphicon-remove');
                                        $('#loadingModal_label').html('Falha!');
                                        $('#loadingModal_content').html('<br>Query nao executada!');
                                        resetModal();
                                    });
                        }
                        function resetModal() {
                            //Aguarda 2 segundos ata restaurar e fechar o modal
                            setTimeout(function () {
                                $('#loader').removeClass();
                                $('#loader').addClass('loader');
                                $('#loadingModal_label').html('<span class="glyphicon glyphicon-refresh"></span>Aguarde...');
                                $('#loadingModal').modal('hide');
                            }, 2000);
                        }
                    </script>
                </form>-->
        <style>
            #teste{
                margin: 0 auto;
                border: solid black thin;
                width: 19cm;
                height: 27.5cm;
                margin-top: 0.5cm;
            }
        </style>
        <?php
        //
        for ($i = 0; $i < 2; $i++) {
            ?>
            <div id="teste">
                <h1></h1>
            </div>
            <DIV style="margin: 0 auto; width: 19cm; height: 0.9cm"></DIV>
            <div id="teste">
                <h1></h1>
            </div>
            <DIV style="margin: 0 auto; width: 19cm; height: 0.9cm"></DIV>
            <div id="teste">
                <h1></h1>
            </div>

            <DIV style="margin: 0 auto; width: 19cm; height: 0.8cm"></DIV>
            <?php } ?>
    </body>
</html>