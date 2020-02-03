<?php
$ano = date('Y');
//
$Cursando = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND alunos.status_ext NOT LIKE '%SIM%' AND excluido = 'N' GROUP BY turmas.id ");
$ContCursando = 0;
while ($Linha = mysqli_fetch_array($Cursando)) {
    $ContCursando += $Linha['qtd'];
}
//
$Matriculados = mysqli_query($Conexao, "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND alunos.status_ext NOT LIKE '%SIM%' GROUP BY turmas.id ");
$ContMatriculados = 0;
while ($LinhaMatriculados = mysqli_fetch_array($Matriculados)) {
    $ContMatriculados += $LinhaMatriculados["qtd"];
}
//
$Cadastrados = mysqli_query($Conexao, "SELECT COUNT(*) AS qtd FROM alunos GROUP BY id ");
$ContCadastrados = 0;
while ($LinhaCadastrados = mysqli_fetch_array($Cadastrados)) {
    $ContCadastrados += $LinhaCadastrados["qtd"];
}
//
$ano_passado = date('Y', strtotime('-362 days', strtotime($ano)));
$Novatos = mysqli_query($Conexao, "SELECT * FROM `alunos` WHERE `Data_matricula` BETWEEN '$ano-01-01 00:00:00.000000' AND '$ano-12-13 00:00:00.000000' AND status_ext NOT LIKE '%SIM%' ORDER BY `nome` ASC, `excluido` ASC ");
$ContNovatos = mysqli_num_rows($Novatos);
//
$Transferidos = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE  data_solicitacao LIKE '%2019%' GROUP BY id_aluno_solicitacao");
$ContTransferidos = mysqli_num_rows($Transferidos);
?>
<style>
    .chart {
        width: 99%; 
        min-height: 190px;

    }
</style>
<div class="col-sm-9">          
    <script src="Graficos/loader.js" type="text/javascript"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChart1);
        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Element', 'Quantidade', {role: 'style'}, {role: 'link'}],
                ['Matriculados',<?= $ContMatriculados ?>, '#FF6501', ''],
                ['Cursando', <?= $ContCursando ?>, 'green', '/escola/alunos.php'],
                ['Novatos', <?= $ContNovatos ?>, 'blue', ''],
                ['Transferidos', <?= $ContTransferidos ?>, 'red', '/escola/solicitacao_transferencia.php']
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                2]);

            var options = {
                title: "Alunos",
                bar: {groupWidth: "50%"},
                legend: {position: "none"}
            };

            var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
            chart.draw(view, options);
            //
            //Seta o callback no seu gráfico
            google.visualization.events.addListener(chart, 'select', selectHandler);
            //callback para evento de click
            function selectHandler(e) {
                //alerta com os dados da grid
                // alert(data.getValue(chart.getSelection()[0].row, 0));
                var link = data.getValue(chart.getSelection()[0].row, 0);
                // aqui você pode adicionar um window.location para funcionar como o link
                //window.open('http://www.google.com');
                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link = data.getValue(row, 3);
                    location.href = link;
                }
            }
            var chart = new google.visualization.BarChart(document.getElementsByName('chart_div1'));
            chart.draw(data, options);

        }
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Element', 'Quantidade', {role: 'style'}, {role: 'link'}],
                ['Cadastrados',<?= $ContCadastrados ?>, '#b87333', '/escola/alunos_geral.php']

            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                2]);

            var options = {
                bar: {groupWidth: "100%"},
                legend: {position: "none"}

            };
            var chart = new google.visualization.BarChart(document.getElementById("barchart"));
            chart.draw(view, options);
            //Seta o callback no seu gráfico
            google.visualization.events.addListener(chart, 'select', selectHandler);
            //callback para evento de click
            function selectHandler(e) {
                //alerta com os dados da grid
                // alert(data.getValue(chart.getSelection()[0].row, 0));
                var link = data.getValue(chart.getSelection()[0].row, 0);
                // aqui você pode adicionar um window.location para funcionar como o link
                // alert(link);
                //window.open('http://www.google.com');

                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link = data.getValue(row, 3);
                    location.href = link;
                }
            }
        }
    </script>
    <div class="row">   
        <div id="barchart_values" class="chart" name = "chart_div1" ></div>
    </div>
    <div class="row">   
        <div id="barchart" class="chart"  name = "chart" ></div>
    </div>
    <br>  
    <script>
        google.charts.load("visualization", "1", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart2);
        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}, {role: 'link'}],
<?php
$cor = array("silver", "red", "green", "Brown", "Purple", "Violet", "orange", "blue", "gold", "#4AFFCC");
$i = 0;
$sql = "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND turmas.turno LIKE 'MATUTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND status_ext NOT LIKE '%SIM%' AND excluido = 'N' GROUP BY turmas.id ORDER BY ano DESC,`turmas`.`turma` ASC";
$query = mysqli_query($Conexao, $sql);
$linhas = mysqli_num_rows($query);
if ($linhas > 0) {
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $Consulta_turma = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` = " . $result['turma'] . "");
        $Consulta_turma_Cont = mysqli_num_rows($Consulta_turma);
        $Linha_turma = mysqli_fetch_array($Consulta_turma, MYSQLI_BOTH);
        $nome_turma = $Linha_turma["turma"];
        $id_turma = base64_encode($Linha_turma["id"]);
        $ano_unico = $Linha_turma["unico"];
        $nome = "$nome_turma $ano_unico";
        //    echo "['" . $nome . "', " . $result['qtd'] . ",'silver'],";
        if (empty($cor[$i])) {
            $i = 0;
        }
        echo "['" . $nome . "', " . $result['qtd'] . ",'$cor[$i]','/escola/alunos_2.php?id=$id_turma'],";
        $i++;
        if ($i == $Consulta_turma_Cont) {
            
        }
    }
} else {
    $nome = "Nenhuma Turma";
    $result = 1;
    $cor = "red";
     echo "['" . $nome . "', " . $result . ",'$cor',''],";
}
?>
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                2]);
            var options = {
                title: "Turmas Da Manhã",
                //width: 600,
                // height: 300,
                bar: {groupWidth: "95%"},
                legend: {position: "none"},
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
            //Seta o callback no seu gráfico
            google.visualization.events.addListener(chart, 'select', selectHandler);
            //callback para evento de click
            function selectHandler(e) {
                //alerta com os dados da grid
                // alert(data.getValue(chart.getSelection()[0].row, 0));
                var link = data.getValue(chart.getSelection()[0].row, 0);
                // aqui você pode adicionar um window.location para funcionar como o link
                // alert(link);
                //window.open('http://www.google.com');

                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link = data.getValue(row, 3);
                    location.href = link;
                }
            }

        }
    </script>
    <div class="row">       
        <div id="columnchart_values" class="chart" name = ""></div>             
    </div>
    <br>   
    <script>
        google.charts.load("visualization", "1", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart3);
        function drawChart3() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {role: "style"}, {role: 'link'}],
<?php
$cor = array("silver", "red", "green", "Brown", "Purple", "Violet", "orange", "blue", "gold", "#4AFFCC");
$i = 0;
$sql = "SELECT turmas.*,alunos.*,COUNT(alunos.id) AS qtd FROM turmas,alunos WHERE alunos.turma = turmas.id AND turmas.ano LIKE '%$ano%' AND turmas.turno NOT LIKE 'MATUTINO' AND (alunos.status = 'CURSANDO' OR alunos.status = 'ADIMITIDO DEPOIS') AND status_ext NOT LIKE '%SIM%' AND excluido = 'N' GROUP BY turmas.id ORDER BY ano DESC,`turmas`.`turma` ASC";
$query = mysqli_query($Conexao, $sql);
$linhas = mysqli_num_rows($query);
if ($linhas > 0) {
    while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $Consulta_turma = mysqli_query($Conexao, "SELECT * FROM `turmas` WHERE `id` = " . $result['turma'] . "");
        $Linha_turma = mysqli_fetch_array($Consulta_turma, MYSQLI_BOTH);
        $nome_turma = $Linha_turma["turma"];
        $id_turma = base64_encode($Linha_turma["id"]);
        $ano_unico = $Linha_turma["unico"];
        $nome = "$nome_turma $ano_unico";
        //    echo "['" . $nome . "', " . $result['qtd'] . ",'silver'],";
        if (empty($cor[$i])) {
            $i = 0;
        }
        echo "['" . $nome . "', " . $result['qtd'] . ",'$cor[$i]','/escola/alunos_2.php?id=$id_turma'],";
        $i++;
    }
} else {
    $nome = "Nenhuma Turma";
    $result = 1;
    $cor = "red";
    echo "['" . $nome . "', " . $result . ",'$cor',''],";
}
?>
            ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                2]);
            var options = {
                title: "Turmas Da Tarde e do EJA II",
                //width: 600,
                // height: 300,
                bar: {groupWidth: "95%"},
                legend: {position: "none"}
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values3"));
            chart.draw(view, options);
            //Seta o callback no seu gráfico
            google.visualization.events.addListener(chart, 'select', selectHandler);
            //callback para evento de click
            function selectHandler(e) {
                //alerta com os dados da grid
                // alert(data.getValue(chart.getSelection()[0].row, 0));
                var link = data.getValue(chart.getSelection()[0].row, 0);
                // aqui você pode adicionar um window.location para funcionar como o link
                // alert(link);
                //window.open('http://www.google.com');

                var selection = chart.getSelection();
                if (selection.length) {
                    var row = selection[0].row;
                    let link = data.getValue(row, 3);
                    location.href = link;
                }
            }

        }
    </script>
    <div class="row">       
        <div id="columnchart_values3" class="chart" name = ""></div>             
    </div>
    <br>
</div> 
<script type="text/javascript">
    $(window).resize(function () {
        drawChart2();
        drawChart3();
        drawChart();
        drawChart1();
    });
</script>

