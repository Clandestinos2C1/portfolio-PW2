<?php

// Database connection configuration
$dsn = "mysql:host=localhost;dbname=tmaqd;charset=utf8";
$dbUser = "root";
$dbPassword = "";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

?>