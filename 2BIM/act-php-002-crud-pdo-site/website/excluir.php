<?php

require("conexao.php");

$id = 1;

$sql = "DELETE FROM discos WHERE id_disco = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([ ':id' => $id ]);

echo "Disco removido!";
?>