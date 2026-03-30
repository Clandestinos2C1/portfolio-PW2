<?php

function media($v) {
    return array_sum($v) / count($v);
}


$n1 = $_GET["n1"];
$n2 = $_GET["n2"];
$n3 = $_GET["n3"];
$n4 = $_GET["n4"];
$n5 = $_GET["n5"];


$valores = [$n1, $n2, $n3, $n4, $n5];

echo "<h1>Resultado: </h1>";
echo "<h3>Números: " . implode(", ", $valores) . "</h3>";
echo "<h3>Média: " . media($valores) . "</h3>";

echo '<a href = "index.php"> Voltar </a>';
?>

