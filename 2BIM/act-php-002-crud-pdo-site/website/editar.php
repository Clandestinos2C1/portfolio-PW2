<?php

require("conexao.php");

// Album that will be updated
$recordId = 1;

// New price value
$updatedPrice = 149.90;

// Update album price
$sql = "UPDATE discos
SET preco = :preco
WHERE id_disco = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    ':preco' => $updatedPrice,
    ':id' => $recordId

]);

echo "Preço atualizado!";
?>