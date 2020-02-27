<?php


if (!IsSet($_COOKIE["nome_usuario"])) {
    header("Location: index.php");
} else {
    $usuario_logado = $_COOKIE["nome_usuario"];
    $ip_usuario = $_SERVER['REMOTE_ADDR'];
//    
}
        