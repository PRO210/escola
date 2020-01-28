<html lang="pt-br">
    <head>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>   
        <?php
        include_once './head.php';
        ?>
    </head>
    <body>
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
        <!-- loadingModal-->
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
        <!-- loadingModal-->
        <!--<nav class="navbar"></nav>
        <div class="container">
            <button type="button" class="btn btn-primary" id="btn-getResponse">   getResponse     </button>
         
        </div>-->
<!--        <script>
            //Comportamento do botao de disparo
            $(function () {
                //Comportamento do botao de disparo
                $('.getResponse').click(function () {
                    getResponse();
                });
            });
            /**
             * Dispara o modal e espera a resposta do script 'testing.resp.php'
             * @returns {void}
             */
            function getResponse() {
                //Preenche e mostra o modal           
                $('#loadingModal_content').html('Carregando...');
                $('#loadingModal').modal('show');

                //Envia a requisicao e espera a resposta
                $.post("teste_server.php")
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
        </script>-->
    </body>
</html>