<?php
function calcularDataFinal($dataInicial, $tempo){
    echo "Data Inicial:" . $dataInicial . '<br>';
    echo "Tempo:" . $tempo . '<br>';
    $dataInicialFormatada = strtotime(str_replace('/', '-', $dataInicial));
    $segundoDiasAtestado = ((24*60)*60)*$tempo;
    $diasTimestamp = $dataInicialFormatada + $segundoDiasAtestado;
    $dataFinalCalculada = date("d/m/Y", $diasTimestamp);
    return $dataFinalCalculada;
}
function iniciarNovaTabela(){
    echo "";
}