<?php

require("conexao.php");

$titulo = "Midnight Echoes";
$artista = "Skyline Dreams";
$preco = 99.90;
$categoria = 2;

$sql = "INSERT INTO discos
(titulo, artista, preco, categoria_id)

VALUES
(:titulo, :artista, :preco, :categoria)";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    ':titulo' => $titulo,
    ':artista' => $artista,
    ':preco' => $preco,
    ':categoria' => $categoria

]);

echo "Disco cadastrado com sucesso!";
?>