<?php

require("conexao.php");

$id = 1;

$novoPreco = 149.90;

$sql = "UPDATE discos
SET preco = :preco
WHERE id_disco = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    ':preco' => $novoPreco,
    ':id' => $id

]);

echo "Preço atualizado!";
?>