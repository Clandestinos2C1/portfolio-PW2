<?php

require("conexao.php");

$id = 1;

$sql = "SELECT * FROM discos WHERE id_disco = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([ ':id' => $id ]);

$disco = $stmt->fetch(PDO::FETCH_ASSOC);

if($disco){

    echo $disco['titulo'];
    echo "<br>";
    echo $disco['artista'];

}else{

    echo "Disco não encontrado";

}

?>