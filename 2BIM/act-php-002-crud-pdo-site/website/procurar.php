<?php

require("conexao.php");

// Album to search for
$recordId = 1;

$sql = "SELECT * FROM discos WHERE id_disco = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([ ':id' => $recordId ]);

// Fetch the result as an associative array
$album = $stmt->fetch(PDO::FETCH_ASSOC);

if($album){

    echo $album['titulo'];
    echo "<br>";
    echo $album['artista'];

}else{

    echo "Disco não encontrado";

}

?>