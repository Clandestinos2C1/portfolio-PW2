<?php

function fatorial($n) {
    $fat = 1;

    for ($i = 1; $i <= $n; $i++) {
        $fat *= $i;
    }

    return $fat;
}

$n1 = $_GET["numb1"];
$n2 = $_GET["numb2"];
$n3 = $_GET["numb3"];
$n4 = $_GET["numb4"];
$n5 = $_GET["numb5"];

$f1 = fatorial($n1);
$f2 = fatorial($n2);
$f3 = fatorial($n3);
$f4 = fatorial($n4);
$f5 = fatorial($n5);

$soma = $f1 + $f2 + $f3 + $f4 + $f5;

// saída
echo "<h1>Resultado</h1>";

echo "Fatorial de $n1 = $f1<br>";
echo "Fatorial de $n2 = $f2<br>";
echo "Fatorial de $n3 = $f3<br>";
echo "Fatorial de $n4 = $f4<br>";
echo "Fatorial de $n5 = $f5<br>";

echo "<br>";

echo "<strong>Soma dos fatoriais: $soma</strong>";

echo '<br> <br> <a href="index.php">Voltar</a>';

?>