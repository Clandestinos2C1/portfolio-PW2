<!--
Data: 13/03/2026
Autor: Luigi Pozzani de Souza; Nicolas Camargo Costa Ceccato
Objetivo:

Exercício 2 - Faça um programa que leia um caractere "F" ou "C", indicando se o valor informado está em Fahrenheit ou Celsius.
Depois, o programa deve converter para a outra unidade.
Fórmula: C = 5/9 × (F − 32)
--> 

<!DOCTYPE html>
<head>
    <meta charset= "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 2</title>
</head>
<body>
    <h1> Conversor de Temperatura </h1>
<form action="code.php" method="GET">
        <label for="temp">Digite a Temperatura:</label>
        <input type="text" name="temp" placeholder="00C / 00F" required>

        <button type="submit">Converter</button>
        </form>

</body>
</html>