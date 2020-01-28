<?php

ob_start();

$output = exec('C:\xampp\mysql\bin\Tarde.bat');
if ($output) {
    header("Location:importacao_exportacao.php?id=11");
} else {
    header("Location:importacao_exportacao.php?id=12");
}