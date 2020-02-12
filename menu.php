<link href="Menu/responsive-menu.css" rel="stylesheet" type="text/css"/>
<link href="Menu/styles.css" rel="stylesheet" type="text/css"/>
<script src="Menu/modernizr.min.js" type="text/javascript"></script>
<script>window.modernizr || document.write('<script src="Menu/modernizr-custom.js"><\/script>')</script>
<script src="Menu/html5shiv.js" type="text/javascript"></script>
<script src="Menu/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="Menu/jquery.js"><\/script>')</script>
<script src="Menu/responsive-menu.js" type="text/javascript"></script>
<script>
    jQuery(function ($) {
        var menu = $('.rm-nav').rMenu({

            // Optional Settings

            /**
             * Minimum width for expanded layout in pixels - String
             * The media query in css file should be changed to match this
             * Must be in pixels and include px units if not using Modernizr.
             * @default '769px'
             */
            minWidth: '960px'
                    /**
                     * The opening and closing speed of the menus in milliseconds
                     * @default 400
                     */
                    //transitionSpeed: 400,

                    /**
                     * The jQuery easing function - used with jQuery transitions
                     * @default 'swing'
                     * @options 'swing', 'linear'
                     */
                    //jqueryEasing: 'swing',

                    /**
                     * The CSS3 transitions easing function - used with CSS3 transitions
                     * @default 'ease'
                     */
                    //css3Easing: 'ease',

                    /**
                     * Use button as toggle link - instead of text
                     * @default true
                     */
                    //toggleBtnBool: true,

                    /**
                     * The Toggle Link selector
                     * @default '.rm-toggle'
                     */
                    //toggleSel: '.rm-toggle',


                    /**
                     * The menu/sub-menu selector
                     * @default 'ul'
                     */
                    //menuSel: 'ul',

                    /**
                     * The menu items selector
                     * @default 'li'
                     */
                    //menuItemsSel: 'li',

                    /**
                     * Use CSS3 animation/transitions Boolean
                     * @default true
                     * Do not use animation/transitions: false
                     */
                    //animateBool: false,

                    /**
                     * Force GPU Acceleration Boolean
                     * @default false
                     * Do not force: false
                     */
                    //accelerateBool: true,

                    /**
                     * the setup complete callback function
                     * @default 'false'
                     */
                    //setupCallback: false,

                    /**
                     * the tabindex start value - integer
                     * @default 1
                     */
                    //tabindexStart: 5,

                    /**
                     * Use development mode - outputs information to console
                     * @default false
                     */
                    //developmentMode: false

        });
    });
</script>    
<?php
$Consulta_up = mysqli_query($Conexao, "SELECT * FROM escola WHERE id= '1'");
$Registro = mysqli_fetch_array($Consulta_up, MYSQLI_BOTH);
//
$nome_menu = $Registro["nome"];
preg_match_all('/\b\w/u', $nome_menu, $m);
//echo implode('',$m[0]);
$Consulta = mysqli_query($Conexao, "SELECT * FROM `usuarios` WHERE  `usuario` = '$usuario_logado'");
$Linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
//
$tipo = $Linha['tipo'];
$id_usuario = $Linha['id'];
$sistema = "none";
$visao_boleto = "none";
//
if ($tipo == "ROOT" || $tipo == "ADMIN") {
    $sistema = "block";
}
if ($tipo == "ROOT" || $tipo == "ADMIN" || $tipo == "FINANCEIRO") {
    $visao_boleto = "block";
}

?>
<style>
    .rm-nav li a, .rm-menu-item a{
        font-weight: bold;
    }
</style>
<header>    
    <div class="wrapper">
        <div class="brand">
            <p><a href="principal.php" class="logo" >
                    <img src="img/logo.jpg" width="45" height="45" class="d-inline-block align-top" alt="">
                    <?= implode('', $m[0]) ?>
                </a>
            </p>
        </div>
        <!-- START Responsive Menu HTML -->
        <div class="rm-container">
            <a class="rm-toggle rm-button rm-nojs" href="#">Menu</a>
            <nav class="rm-nav rm-nojs rm-lighten">
                <ul>                   
                    <li><a href="#">ALUNOS</a>
                        <ul>
                            <li><a href="alunos_geral.php">Todos os Alunos</a></li>
                            <li><a href="alunos.php">Alunos Cursando</a></li>
                            <!--<li><a href="alunos_admitidos_depois.php">Admitidos Depois</a></li>-->
                            <li><a href="cadastrar_transferido.php">Cadastrar Novato</a></li>                           
                            <li><a href="alunos_desistentes.php">Desistentes</a></li>
                            <li><a href="alunos_bolsa_familia_relatorio.php">Bolsa Família</a></li>
                            <li><a href="solicitacao_transferencia.php">Transferências Solicitadas</a></li>     
                            <li><a href="alunos_arquivo_passivo.php">Arquivo Passivo</a></li>			
                            <li><a href="alunos_turma_extra.php">Turmas Extra</a></li>                         
                            <li><a href="alunos_procurar_excluir.php">Procurar Por Aluno(s)</a></li>                         
                            <li><a href="numero_de_alunos.php"  >Quant. de Alunos Cursando</a></li>                          
                            <li style="display: <?= $visao_boleto ?> " ><a  href="boleto_listar.php">Boletos</a></li>                          
                        </ul>
                    </li>                    
                    <li><a href="#">DISCIPLINAS</a>
                        <ul>                    
                            <li><a href="pesquisar_disciplinas_arquivo.php">Disciplinas Desativadas</a></li>
                            <li><a href="pesquisar_disciplinas_server.php">Criar/Listar/Editar</a></li>
                            <li><a href="disciplinas_professor.php">Disciplina/Professor</a></li>
                        </ul>
                    </li>                   
                    <li><a href="#">DOCUMENT.EMPRESTADOS</a>
                        <ul>                           
                            <li><a href="pesquisar_documentos.php">Criar/Pesquisar/Editar</a></li>
                        </ul>
                    </li>
                    <li><a href="#">SERVIDORES</a>
                        <ul>
                            <li><a href="servidores_arquivo_passivo.php">Arquivo Passivo</a></li>
                            <li><a href="pesquisar_atestado.php">Atestado /Licença /Declarão /Férias</a></li>                   
                            <li><a href="servidores_procurar.php">Pesquisar</a></li>
                            <li><a href="servidores.php">Cadastrar/Pesquisar/Editar</a></li>
                            <li><a href="turmas_professor.php">Professor/Turma</a></li>
                            <li><a href="pesquisar_substituicoes.php">Substituições</a></li>
                            <li><a href="Declaracoes/Declaracao de trabalho.docx">Declaração que Trabalhou</a></li>
                            <li><a href="agendamentos_materiais.php">Agendamentos de Materiais</a></li>
                        </ul>
                    </li>                   
                    <li><a href="#">TURMA</a>
                        <ul>
                            <li><a href="pesquisar_turmas_server.php">Listar/Editar/Criar</a></li>
                            <li><a href="numero_de_alunos.php"  >Quant. de Alunos Cursando</a></li>
                            <li><a href="turmas_professor.php">Turmas/Professor</a></li>
                            <li><a href="listar_copia_turma_server.php">Tabela das Atas</a></li>
                        </ul>
                    </li>
                    <li><a href="#">RELATÓRIOS</a>
                        <ul>
                            <li><a href="montar_relatorio_atestados_etc.php">Montar Relatório de Atestados</a></li>
                            <li><a href="relatorios_prontos.php">Relatório de Alunos Pronto</a></li>
                            <li><a href="montar_relatorio.php">Montar Relatório de Alunos</a></li>
                        </ul>                       
                        <input type="hidden" id="id_usuario" value="<?php echo "$id_usuario"; ?>">
                    <li style="display: <?php echo $sistema; ?> "><a href="#">SISTEMA</a>
                        <ul>
                            <li> <a  href="cadastrar_usuario.php">Cadastrar Usuário </a></li>
                            <li> <a  href="pesquisar_usuario_server.php">Listar/Editar Usuário</a></li>                          
                            <li> <a  href="">Configurações</a>
                                <ul>
                                    <li><a href="#">Alunos</a>
                                        <ul>
                                            <li><a href="alunos_configuracoes.php?id=transporte">Transporte</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Escola</a>
                                        <ul>
                                            <li><a href="alunos_configuracoes.php?id=escola">Dados da Escola</a></li>
                                            <li><a href="dados_escola_feriados.php">Calendário Escolar</a></li>
                                            <li><a href="cadastrar_imagem.php">Cadastrar Imagens</a></li>                                          
                                        </ul>
                                    </li>
                                    <li><a href="importacao_exportacao.php">Base De Dados</a>                                        
                                    </li>
                                </ul>                                
                            </li> 
                        </ul>
                    </li>                   
                    <li class=""><a><span class="glyphicon glyphicon-user" style=""></span><?php echo "$usuario_logado"; ?></a>
                        <ul>
                            <li><a href="usuarios_acoes.php">Ações passadas</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Sair</a></li>
                        </ul>
                    </li>                      
                </ul>
            </nav>
        </div><!-- .rm-container -->
        <!-- End Responsive Menu HTML -->
    </div>
</header>


