<?php

$dsn = "mysql:host=localhost;dbname=clandestinafarmacia;charset=utf8";
$usuario = "root";
$senha = "";

    try {
         $pdo = new PDO($dsn, $usuario, $senha);
        
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
          }


         catch (PDOException $erro) {
        die("Erro na conexão com o banco de dados: " . $erro->getMessage());
    
                                    }

?>
