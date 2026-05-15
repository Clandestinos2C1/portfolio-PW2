<?php

    $calc = $_GET["calc"];

    if(str_contains ($calc, '+')){
        $calc = explode ('+', $calc);
        $result = $calc[0] +  $calc[1];
        $resecho = "O resultado é: $result";
    }
    elseif(str_contains ($calc, '-')){
        $calc = explode ('-', $calc);
        $result = $calc[0] -  $calc[1];
        $resecho = "O resultado é: $result";
    }
    elseif(str_contains ($calc, '*')){
        $calc = explode ('*', $calc);
        $result = $calc[0] *  $calc[1];
        $resecho = "O resultado é: $result";
    }
    elseif(str_contains ($calc, '/')){
        $calc = explode ('/', $calc);
        $result = $calc[0] /  $calc[1];
        $resecho = "O resultado é: $result";
    }
    else{
        $resecho = "Insira um cálculo válido";
    }

echo "<h1>Resultado: </h1>";
echo $resecho;
echo '<br> <br> <a href="index.php">Voltar</a>'
?>