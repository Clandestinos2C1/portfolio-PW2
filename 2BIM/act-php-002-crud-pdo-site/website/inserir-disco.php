<?php

require("conexao.php");

// Sample album data
$albumTitle = "Midnight Echoes";
$artistName = "Skyline Dreams";
$albumPrice = 99.90;
$categoryId = 2;

// Insert a new album into the database
$sql = "INSERT INTO discos
(titulo, artista, preco, categoria_id)

VALUES
(:titulo, :artista, :preco, :categoria)";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    ':titulo' => $albumTitle,
    ':artista' => $artistName,
    ':preco' => $albumPrice,
    ':categoria' => $categoryId

]);

echo "Disco cadastrado com sucesso!";
?>