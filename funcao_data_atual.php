<?php
$meses = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho",
   "Julho","Agosto","Setembro","Outrubro","Novembro","Dezembro");
$dia = date("d", time());
$mes = date("m", time());
$ano = date("Y", time());
$semana = date("w", time());
$dmy =  $dia . " de " . $meses [$mes-1]. " de " . $ano;
$mes2 = $meses[$mes-1];
//
//$dia = date('d');
////$mes = date('m');
//$mes = date('m');
////$ano = date('Y');
//$ano = date('Y');
//$semana = date('w');
//
//switch ($mes) {
//    case 1: $mes = "Janeiro";
//        break;
//    case 2: $mes = "Fevereiro";
//        break;
//    case 3: $mes = "Março";
//        break;
//    case 4: $mes = "Abril";
//        break;
//    case 5: $mes = "Maio";
//        break;
//    case 6: $mes = "Junho";
//        break;
//    case 7: $mes = "Julho";
//        break;
//    case 8: $mes = "Agosto";
//        break;
//    case 9: $mes = "Setembro";
//        break;
//    case 10: $mes = "Outubro";
//        break;
//    case 11: $mes = "Novembro";
//        break;
//    case 12: $mes = "Dezembro";
//        break;
//}
//// configuração semana 
//switch ($semana) {
//
//    case 0: $semana = "Domingo";
//        break;
//    case 1: $semana = "Segunda Feira";
//        break;
//    case 2: $semana = "Terça Feira";
//        break;
//    case 3: $semana = "Quarta Feira";
//        break;
//    case 4: $semana = "Quinta Feira";
//        break;
//    case 5: $semana = "Sexta Feira";
//        break;
//    case 6: $semana = "Sábado";
//        break;
//}
