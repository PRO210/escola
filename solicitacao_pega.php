<?php
include_once 'valida_cookies.inc';
//
include_once './inc.conf.php';
//
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$id_recebido = $_POST['id'];
//
foreach ($id_recebido as $id) {
    //
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$id' ");
    $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
    $id_aluno = $Registro['id_aluno_solicitacao'];
//    //
    $Consulta = mysqli_query($Conexao, "SELECT alunos_solicitacoes.*,alunos.status FROM `alunos_solicitacoes`,`alunos` WHERE `id_solicitacao` = $id AND `id` = $id_aluno ");
    $Registro = mysqli_fetch_array($Consulta, MYSQLI_BOTH);
//    
//  
    $html['sol'] = $Registro['solicitante'];
    $html['dte'] = "";
    $html['kk'] = $id;
    $html['k'] = $id_aluno;
    $html['kkk'] = "SELECT * FROM `alunos_solicitacoes` WHERE `id_solicitacao` = '$id'" ;
    //
    $html['dte'] = $Registro['data_entregue'];
    if ($html['dte'] == "0000-00-00") {
        $html['dte'] = "-- / -- / ----";
    } else {
        $html['dte'] = new DateTime($Registro['data_entregue']);
        $html['dte'] = date_format($html['dte'], 'Y-m-d');
    }
     $html['ent'] = $Registro['entregue'];
     $html['declaracao'] = $Registro['declaracao'];
     $html['dec_rp'] = $Registro['responsavel_declaracao'];
     $html['dat_d'] = $Registro['data_declaracao'];
     $html['transferencia'] = $Registro['transferencia'];
     $html['tf_rt'] = $Registro['responsavel_transferencia'];
     
     $html['dat_tf'] = $Registro['data_transferencia'];
     $html['st'] = $Registro['status'];
    
    //
//    $html['ent'] = "";
//    if ($html['ent'] == "N") {
//        //
//        $html['ent'] = "PENDENTE";
//        //
//    } elseif ($html['ent'] == "S") {
//        //
//        $html['ent'] = "ENTREGUE";
//        //
//    } else {
//        //
//        $html['ent'] = "PRONTA";
//        //
//    }
    //
   
}
print_r(json_encode($html));



