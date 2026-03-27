<?php

$temp = $_GET["temp"];

if (str_contains($temp, 'F')) {
    $temp = explode("F", $temp);
    $celsius = 5/9 * ($temp[0] - 32);
    $resultado = "a sua temperatura é : $celsius °C";
}
elseif (str_contains($temp, 'C')){
    $temp = explode("C", $temp);
    $fhrn = ($temp[0] * 1.8) + 32;
    $resultado = "a sua temperatura é : $fhrn °F";
}
else{
    $resultado = "Você deve especificar a medida de temperatura";
}

echo "<h1>Resultado: </h1>";
echo $resultado;
echo '<br> <br> <a href="index.php">Voltar</a>'
?>