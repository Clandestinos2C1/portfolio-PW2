<?php

require("conexao.php");

// Album to be removed
$recordId = 1;

// Delete the selected album
$sql = "DELETE FROM discos WHERE id_disco = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([ ':id' => $recordId ]);

echo "Disco removido!";
?>