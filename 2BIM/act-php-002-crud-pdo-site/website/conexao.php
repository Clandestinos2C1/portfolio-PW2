<?php

// Database connection configuration
$dsn = "mysql:host=localhost;dbname=tmaqd;charset=utf8";

$dbUser = "root";
$dbPassword = "";

try {

    // Create a reusable PDO connection
    $pdo = new PDO($dsn, $dbUser, $dbPassword);

} catch(PDOException $e){

    // Stop execution if the connection fails
    die("Erro: " . $e->getMessage());

}

?>