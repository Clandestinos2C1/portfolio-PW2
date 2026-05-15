<?php
echo "<h1>Resultado: </h1>";
$ano = $_GET["ano"];

if (($ano % 400 == 0) || ($ano % 4 == 0 && $ano % 100 != 0)) {
    echo "<h3>O ano $ano é bissexto</h3>";
} else {
    echo "<h3>O ano $ano não é bissexto</h3>";
}

echo '<br><a href="index.php">Voltar</a>';

?>