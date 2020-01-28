<?php
include_once 'valida_cookies.inc';
include_once './inc.conf.php';
include_once 'funcao.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$Recebe = "";
$Recebe = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
$Msg = "";
$M = "";
if ($Recebe == "sucesso") {
    // echo "<script type=\"text/javascript\">
    // alert(\"Documentos Gravados com Sucesso! \");
    // </script>
    // ";
    $Msg = "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Alterações Gravadas com Sucesso! </div>";
    $M = "1";
}
?>
<html lang="pt-br">    
    <head>     
        <title>Home</title>   
        <?php
        include_once 'head.php';
        ?>              
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/principal.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.12.4.js" type="text/javascript"></script>        
        <style>
            #avisos{
                background-color:rgb(204,119,0); 
                min-height: 400px;
                padding-bottom: 6px;
                margin-bottom: 12px;            
            }
            @media only screen and (max-width: 768px){
                #avisos{
                    height: 128px; 
                    width: auto;   
                    margin-bottom: 12px;
                }
            }    
            .close{
                font-size: 24px;color: red;opacity: 1;
            }
        </style>        
        <!--        <link href="css/pace-theme-flash.css" rel="stylesheet" type="text/css"/>
                <script src="js/pace.min.js" type="text/javascript"></script>-->
    </head>
    <body id="body" onload="json();">      
        <?php
        //include_once 'mensagens_principal.php';       
        include_once 'mensagem_sucesso.php';
        include_once 'mensagens_principal_confirma.php';
        //
        include_once 'menu.php';
        ?>        
        <div class="container-fluid col-sm-12"><br>         
            <!--            <div class="col-sm-1">
                            <div class="row" id="alunos" >
                                <span><p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src="Ícones/icons8-Students.png" alt=""/></button><br>Alunos</p></span>
                                <span><p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Disciplinas"><img src="Ícones/icons8-estante-de-livros-50.png" alt=""/></button><br>Disciplinas</p></span>
                                <span><p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Declaracao"><img src="Ícones/icons8-currículo-96.png" alt=""/></button><br>Declarações</p></span>
                                <span><p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-adicionar-grupo-de-usuários-mulher-homem-96.png" alt=""/></button><br>Servidores</p></span>
                                <span><p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_DocumentosEmprestados"><img src="Ícones/icons8-tirar-do-cofre-64.png" alt=""/></button><br>Documentos <br>Emprestados</p></span>
                                <span><p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Turmas"><img src="Ícones/icons8-sala-de-aula-96.png" alt=""/></button><br>Turmas</p></span>
                            </div>
                             Modal 
                            <div class="modal fade" id="myModal_Alunos" role="dialog">
                                <div class="modal-dialog">
                                     Modal content
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente ao Alunado</h4>
                                        </div>
                                        <div class="modal-body">
                                            <span><a href="alunos.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src="Ícones/icons8-homem-estudante-64.png" alt=""/></button><br>Todos os Alunos</p></a></span>
                                            <span><a href="cadastrar_transferido.php"> <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src="Ícones/icons8-inscrição-de-estudante-50.png" alt=""/></button><br>Cadastrar</p></a></span>
                                            <span><a href="alunos_admitidos_depois.php"> <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src=Ícones/icons8-Students_Chegando_1.png alt=""/></button><br>Transferidos que <br>Entraram</p></a></span>
                                            <span><a href="solicitacao_transferencia.php"> <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src=Ícones/icons8-Students_Foram_1.png alt=""/></button><br>Pedidos de <br>Transferência</p></a></span>
                                            <span><a href="alunos_turma_extra.php"> <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src=Ícones/icons8-coworking-96.png alt=""/></button><br>Alunos Turma <br>Extra</p></a></span>
                                            <span><a href="numero_de_alunos.php"> <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src=Ícones/icons8-gráfico-de-barras-64.png alt=""/></button><br>Número de Alunos</p></a></span>
                                            <span><a href="alunos_procurar_excluir.php"> <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src=Ícones/icons8-procurar-usuário-masculino-96.png alt=""/></button><br>Procurar Por Aluno(a)</p></a></span>
                                            <span><a href="alunos_arquivo_passivo.php"> <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Alunos"><img src=Ícones/Procurar_Arquivo_passivo64.png alt=""/></button><br>Arquivo Passivo</p></a></span>
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                             Modal Disciplinas
                            <div class="modal fade" id="myModal_Disciplinas" role="dialog">
                                <div class="modal-dialog">
                                     Modal content
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente as Disciplinas</h4>
                                        </div>
                                        <div class="modal-body">
                                            <span><a href="cadastrar_disciplina.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Disciplinas"><img src="Ícones/icons8-cursos-64_1.png" alt=""/></button><br>Cadastrar Disciplina</p></a></span>
                                            <span><a href="pesquisar_disciplinas_server.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Disciplinas"><img src="Ícones/icons8-cursos-96.png" alt=""/></button><br>Listar Disciplinas</p></a></span>
                                            <span><a href="disciplinas_professor.php"> <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Disciplinas"><img src="Ícones/icons8-sala-de-aula-96.png" alt=""/></button><br>Disciplinas Professor</p></a></span>
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                             Modal Declaracao
                            <div class="modal fade" id="myModal_Declaracao" role="dialog">
                                <div class="modal-dialog">
                                     Modal content
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente aos Modelos de Declarações </h4>
                                        </div>
                                        <div class="modal-body">                              
                                            <span><a href="Declarações/Aponsentadoria.odt" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Declaracao"><img src="Ícones/icons8-documento-48.png" alt=""/></button><br>Aposentadoria</p></a></span>
                                            <span><a href="Declarações/Autorização para Eventos de Música.odt" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Declaracao"><img src="Ícones/icons8-documento-96_musica.png" alt=""/></button><br>Autorização para <br>Event. da Banda</p></a></span>
                                            <span><a href="Declarações/Leciona nesta U.D.E.odt" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Declaracao"><img src="Ícones/icons8-sala-de-aula-96.png" alt=""/></button><br>Leciona Neste U.D.E</p></a></span>
                                            <span><a href="Declarações/Participação em Eventos.odt" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Declaracao"><img src="Ícones/icons8-confete-96.png" alt=""/></button><br>Participação em Eventos</p></a></span>
                                            <span><a href="Declarações/Retirada de Documentos.odt" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Declaracao"><img src="Ícones/icons8-exportar-pdf-80.png" alt=""/></button><br>Retirada de Documentos</p></a></span>
            
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                             Modal Servidores
                            <div class="modal fade" id="myModal_Servidores" role="dialog">
                                <div class="modal-dialog">
                                     Modal content
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente aos Servidores</h4>
                                        </div>
                                        <div class="modal-body">
                                            <span><a href="cadastrar_servidores.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-adicionar-grupo-de-usuários-mulher-homem-96.png" alt=""/></button><br>Cadastrar Servidores</p></a></span>
                                            <span><a href="servidores.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-grupo-de-usuário-homem-mulher-48.png" alt=""/></button><br>Todos os Servidores</p></a></span>
                                            <span><a href="cadastrar_atestado.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-livro-de-saúde-80.png" alt=""/></button><br>Cadastrar Atestado</p></a></span>
                                            <span><a href="pesquisar_atestado.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/procurar_Atestados64.png" alt=""/></button><br>Listar Atestados</p></a></span>
                                            <span><a href="cadastrar_substituicoes.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-troca-de-jogador-80.png" alt=""/></button><br>Cadastrar Substituição</p></a></span>
            
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                             Modal Documentos Emprestados
                            <div class="modal fade" id="myModal_DocumentosEmprestados" role="dialog">
                                <div class="modal-dialog">
                                     Modal content
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente aos Documentos Emprestados</h4>
                                        </div>
                                        <div class="modal-body">
                                            <span><a href="cadastrar_documentos_emprestados.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-adicionar-pdf-80.png" alt=""/></button><br>Emprestar Novo<br>Documento</p></a></span>
                                            <span><a href="pesquisar_documentos.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-arquivo-de-fichas-64.png" alt=""/></button><br>Todos os Documentos</p></a></span>
            
            
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                             Modal Turmas
                            <div class="modal fade" id="myModal_Turmas" role="dialog">
                                <div class="modal-dialog">
                                     Modal content
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Opções Referente as Turmas</h4>
                                        </div>
                                        <div class="modal-body">
                                            <span><a href="cadastrar_turma.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-sala-de-aula-96_adicionar.png" alt=""/></button><br>Cadastrar Turma</p></a></span>
                                            <span><a href="pesquisar_turmas_server.php" > <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal_Servidores"><img src="Ícones/icons8-sala-de-aula-96.png" alt=""/></button><br>Todas as Turmas</p></a></span>
                                            <div class="modal-footer"></div>                            
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                        </div>-->
            <!--Busca por Alunos-->      <!--Busca por Alunos-->         <!--Busca por Alunos-->
            <script src="Graficos/loader.js" type="text/javascript"></script>
            <?php
            include_once 'graficos_alunos.php';
            ?>
            <!--
            <div class="row">
                
               <div class="col-sm-3 col-sm-offset-9" >
                   <h3 style="text-align: center">PENDENCIAS</h3>                    
            <?php
            $query_atestados = mysqli_query($Conexao, "SELECT servidor,inicio, tempo, fim FROM atestados_servidor");
            $hoje = date('d/m/Y');

            while ($linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH)) {

                $dataInicial = strtotime(str_replace('/', '-', $linha_atestados['inicio']));
                $segundoDiasAtestado = ((24 * 60) * 60) * $linha_atestados['tempo'];
                $dataFinalCalculada = $dataInicial + $segundoDiasAtestado;
                $dataPraTeste = calcularDataFinal($linha_atestados['inicio'], $linha_atestados['tempo']);
                //echo "Data para teste: " . $dataPraTeste . "<br>";
                //echo $linha_atestados['servidor'] . " Atestado iniciou na data " . $linha_atestados['inicio'] . " de " . $linha_atestados['tempo'] . " dias, terminando na data " . date("d/m/Y", $dataFinalCalculada) . "<BR>";
                $dataFinalFormatada = strtotime(str_replace('/', '-', $linha_atestados['fim']));
                //echo $linha_atestados['servidor'] . " DataFinal: " . date("d F, Y", $dataFinalFormatada)  . "<br>";
                if ($hoje == $linha_atestados['fim']) {
                    // echo $linha_atestados['servidor'] . " Esta encerrando seu atestado hoje.<br>";
                }
            }
            ?>
               </div>                 
           </div>   
               
           <div class="row">
              
               <div class="col-sm-3">
            <?php
            $query_atestados = mysqli_query($Conexao, "SELECT servidor,inicio, tempo, fim FROM atestados_servidor");
            $hoje = date('d/m/Y');
            $testeandre = "";

            while ($linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH)) {

                $servidor = ($linha_atestados['servidor']);

                $dataInicial = ($linha_atestados['inicio']);
                $dataInicialConvetida = date("d/m/Y", strtotime($dataInicial));

                $tempo = $linha_atestados['tempo'];
                $segundoDiasAtestado = $linha_atestados['tempo'] - 1;

                $dataFinalCalculada = strtotime($dataInicial . "+$segundoDiasAtestado days");

                echo $servidor . ", Iniciou o Atestado de " . $tempo . " dia(s) na data: " . $dataInicialConvetida . ", terminando na data: " . date("d/m/Y", $dataFinalCalculada) . "<BR>";
            }
            ?> 
               </div>
            -->
            <script src="js/bootstrap.min.js" type="text/javascript"></script>            
            <!-- <div class="row" style="margin-right:0px; margin-top: 12px; margin-left: 0px; margin-bottom: 12px"> --> 
            <!--Div Avisos-->
            <div class="col-sm-3"  id="avisos" >
                <h3 style="text-align: center">AVISOS</h3> 
                <?php
                $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(fim,now()) AS dias FROM atestados_servidor ");
                $hoje = date('d/m/Y');
                //echo "$hoje";
                $teste = "";
                $teste2 = "";
                //
                while ($linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH)) {
                    //
                    $servidor = ($linha_atestados['servidor']);
                    $dataInicial = ($linha_atestados['inicio']);
                    $dataInicialConvetida = date("d/m/Y", strtotime($dataInicial));
                    $tempo = $linha_atestados['tempo'];
                    $dias = intval($linha_atestados['dias']);
                    //echo "$dias<br>";
                    $dataFinal = $linha_atestados['fim'];
                    $dataFinal = date("d/m/Y", strtotime($dataFinal));
                    //echo "$dataFinal";
                    //echo $servidor . " dias " . $dias . "<br>";
                    if ($dias == 0) {
                        echo "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "O Atestado de $servidor termina hoje: $dataFinal. </div>";
                        $teste = TRUE;
                    }
                    if ($dias > 0 && $dias < 3) {
                        $teste2 = TRUE;
                        echo "<div class = 'alert alert-info' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "O Atestado de $servidor termina no dia: $dataFinal. </div>";
                    }
                }
                if ($teste == FALSE && $teste2 == FALSE) {
                    echo "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Não há atestados vencendo nesses próximos dois dias. </div>";
                }
                ?>   
                <?php
                $query_atestados = mysqli_query($Conexao, "SELECT *, datediff(devolucao,now()) AS dias FROM documentos_emprestados ");
                $hoje = date('d/m/Y');
                //echo "$hoje";
                $teste = "";
                $teste2 = "";
                $teste3 = "";
                //
                while ($linha_atestados = mysqli_fetch_array($query_atestados, MYSQLI_BOTH)) {
                    //
                    $nome = ($linha_atestados['nome']);
                    $emprestado = ($linha_atestados['emprestado']);
                    $emprestadoConvetida = date("d/m/Y", strtotime($emprestado));
                    $devolucao = $linha_atestados['devolucao'];
                    $devolucaoConvertida = date("d/m/Y", strtotime($devolucao));
                    //echo "$devolucaoConvertida";
                    //echo $nome . " dias " . $dias . "<br>";
                    $dias = intval($linha_atestados['dias']);
                    $devolvido_sim = ($linha_atestados['devolvidosim']);

                    if ($dias == 0 && $devolvido_sim == "NÃO") {
                        $teste = TRUE;
                        echo "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Os Documentos emprestados a  $nome devem retornar hoje: $devolucaoConvertida. </div>";
                    }
                    if ($dias > 0 && $dias < 3 && $devolvido_sim == "NÃO") {
                        $teste2 = TRUE;
                        echo "<div class = 'alert alert-info' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "O(s) Documento(s) emprestados a $nome devem  retornar em: $devolucaoConvertida. </div>";
                    }
                    if ($devolvido_sim == "NÃO" && $dias < 0) {
                        $teste3 = TRUE;
                        echo "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Os Documentos emprestados a  $nome expiraram: $devolucaoConvertida. </div>";
                    }
                }
                if ($teste == FALSE && $teste2 == FALSE && $teste3 == FALSE) {
                    echo "<div class = 'alert alert-success' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "Não há Documentos Emprestados para serem devolvidos. </div>";
                }
                //
                //Tranferencias Que a escola precisar fazer
                $query_transferencias = mysqli_query($Conexao, "SELECT *, datediff(now(),data_solicitacao) AS dias FROM alunos_solicitacoes ");
                $Cont_transfeencias = mysqli_num_rows($query_transferencias);
                //
                echo "<div class = 'alert alert-warning' fade in alert-dismissible'>";
                // echo "<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'><p>X</p></a>";
                echo "<span class='glyphicon glyphicon-plus-sign verde close ' aria-hidden='true' id ='dvDocumentosEscola' ></span>";
                echo " <strong><h4 style=' color: black; text-align:center'>Transferências que a Escola Precisa Confeccionar</h4></strong>";
                echo "<div id='dvFechaEscola' style = 'display:none'>";
                //
                if ($Cont_transfeencias > 0) {
                    while ($linha_transf = mysqli_fetch_array($query_transferencias, MYSQLI_BOTH)) {
                        //
                        $id_aluno_solicitacao = ($linha_transf['id_aluno_solicitacao']);
                        //
                        $Consultaf = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `id` = '$id_aluno_solicitacao' ");
                        $linhaf = mysqli_fetch_array($Consultaf);
                        $nomef = $linhaf['nome'];
                        //
                        $id_solicitacao = ($linha_transf['id_solicitacao']);
                        $entregue = ($linha_transf['entregue']);
                        //$data = $rowf['data_solicitacao'];
                        $data = new DateTime($linha_transf['data_solicitacao']);
                        $data_solicitacao = date_format($data, 'd-m-Y');
                        $teste = date('d/m/Y', strtotime('+15 days', strtotime($data_solicitacao)));
                        $dias = ($linha_transf['dias']);
                        //
                        //echo "$nomef";
                        if ($dias == 12 && $entregue == "N") {
                            $B = "<div class = 'alert alert-info' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "A Transferência de $nomef deve ser feita se possível até:$teste. </div>";
                            echo "$B";
                        }
                        if ($dias == 15 && $entregue == "N") {
                            $HJ = "<div class = 'alert alert-warning' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "A Transferência de $nomef deve ser feita se possível hoje:$teste. </div>";
                            echo $HJ;
                        }
                        if ($dias > 15 && $entregue == "N") {
                            //$ATS = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>" . "A Transferência de $nomef está Atrasada a previsão era:$teste. </div>";
                            $ATS = "A TRANSFERÊNCIA DE $nomef ESTÁ ATRASADA A PREVISÃO ERA : $teste .";
                            //  echo "$ATS" . "<br>";
                            echo "<a href ='solicitacao_transferencia.php?id=" . base64_encode($id_aluno_solicitacao) . "' target='_Blanck' title='Verificar' style = 'color:red'>" . $ATS . "</a><br><br>";
                        }
                    }
                } else {
                    $ATS = "<div class = 'alert alert-danger' role = 'alert'><strong>Atenção&nbsp;!&nbsp;&nbsp;</strong>Nenhuma  Transferência  está Atrasada:) </div>";
                    echo "$ATS";
                }
                echo "</div>";
                echo "</div>";
                ?>
                <div class="alert alert-warning fade in alert-dismissible">
                    <!--<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" id ="dvDocumentos"><p>X</p></a>-->
                    <span class='glyphicon glyphicon-plus-sign verde close ' aria-hidden='true'id ="dvDocumentos" ></span>
                    <strong><h4 style=" color: black;text-align:center">Aluno(s) Que Devem Documentos</h4></strong>
                    <div id="dvFecha" style = "display:none">
                        <?php
                        $Consulta = mysqli_query($Conexao, "SELECT turmas.*,alunos.* FROM turmas,`alunos` WHERE declaracao = 'SIM' AND transferencia NOT LIKE 'SIM' AND excluido = 'N' AND alunos.turma = turmas.id AND turmas.categoria NOT LIKE 'EDUCAÇÃO INFANTIL' ORDER BY alunos.nome");
                        $ContLinhas = mysqli_num_rows($Consulta);
                        if ($ContLinhas > 0) {
                            while ($Linha = mysqli_fetch_array($Consulta)) {
                                $id = $Linha["id"];
                                echo "<a href ='cadastrar_update.php?id=" . base64_encode($id) . "' target='_Blanck' title='Verificar'>" . $Linha['nome'] . " </a><br><br>";
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-warning fade in alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"><p>X</p></a>
                            <strong>Nenhum Aluno Deve Transferência</strong> 
                        </div> 
                        <?php
                    }
                    ?>
                    <style>
                        .verde{
                            color: green !important;
                            opacity: 1;                            
                        }
                        .vermelho{
                            color: red !important;
                            opacity: 1;   
                        }
                    </style>
                    <script type="text/javascript">
        $(document).ready(function () {
            $('#dvDocumentos').click(function () {
                var verde = $("#dvDocumentos").hasClass("verde");
                if (verde) {
                    $("#dvDocumentos").removeClass("verde");
                    $("#dvDocumentos").removeClass("glyphicon glyphicon-plus-sign");
                    $("#dvDocumentos").addClass("glyphicon glyphicon-minus-sign");
                    $("#dvDocumentos").addClass("vermelho");
                } else {
                    $("#dvDocumentos").removeClass("vermelho");
                    $("#dvDocumentos").removeClass("glyphicon glyphicon-minus-sign");
                    $("#dvDocumentos").addClass("glyphicon glyphicon-plus-sign");
                    $("#dvDocumentos").addClass("verde");
                }
                $('#dvFecha').toggle(2000);
            });
        });
                    </script>    
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#dvDocumentosEscola').click(function () {
                                var verde = $("#dvDocumentosEscola").hasClass("verde");
                                if (verde) {
                                    $("#dvDocumentosEscola").removeClass("verde");
                                    $("#dvDocumentosEscola").removeClass("glyphicon glyphicon-plus-sign");
                                    $("#dvDocumentosEscola").addClass("glyphicon glyphicon-minus-sign");
                                    $("#dvDocumentosEscola").addClass("vermelho");
                                } else {
                                    $("#dvDocumentosEscola").removeClass("vermelho");
                                    $("#dvDocumentosEscola").removeClass("glyphicon glyphicon-minus-sign");
                                    $("#dvDocumentosEscola").addClass("glyphicon glyphicon-plus-sign");
                                    $("#dvDocumentosEscola").addClass("verde");
                                }
                                $('#dvFechaEscola').toggle(2000);
                            });
                        });
                    </script>                     
                </div>
            </div>
        </div> 
        <script src="mensagens_principal.js" type="text/javascript"></script>


    </body>  
</html>
