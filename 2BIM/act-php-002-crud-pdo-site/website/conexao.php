<?php

$dsn = "mysql:host=localhost;dbname=tmaqd;charset=utf8";

$usuario = "root";
$senha = "";

try {

    $pdo = new PDO($dsn, $usuario, $senha);

} catch(PDOException $e){

    die("Erro: " . $e->getMessage());

}

?>