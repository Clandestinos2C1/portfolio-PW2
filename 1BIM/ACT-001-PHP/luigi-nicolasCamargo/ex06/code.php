<?php 
echo "<h1>Resultado: </h1>";
    $count = $_GET["count"];
    $n1 = 1;
    $n2 = 0;

    for ($i =1 ;$i <= $count; $i++){
    echo "$n2 ";
    $armaz = $n1;
    $n1 = $n1 + $n2;
    $n2 = $armaz;
    }

    echo '<br> <br> <a href="index.php">Voltar</a>'
    ?>
