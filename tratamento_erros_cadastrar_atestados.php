<?php


$Recebe_id = "";
$Recebe_id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

if ($Recebe_id == "3") {
    echo "<script type=\"text/javascript\">
		    alert('Por favor indique se existe ou não Substituto');
                </script>
                ";
    
    header("Location: cadastrar_atestado.php");
}elseif ($Recebe_id == "5") {
     echo "<script type=\"text/javascript\">
		    alert('Por favor indique somente um Substituto');
                </script>
                ";
     
       header("Location: cadastrar_atestado.php");
   
}