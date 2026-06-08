<?php
session_start();
require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tenho Mais Amigos Que Discos</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@1,400;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!-- NAVBAR -->
    <?php include("componentes/header.php"); ?>

  <!-- HERO -->
    <?php include("componentes/hero.php"); ?>

  <!-- DISCOS -->
    <?php include("componentes/discos.php"); ?>
  
  <!-- CATEGORIAS -->
    <?php include("componentes/categorias.php"); ?>

  <!-- SOBRE -->
    <?php include("componentes/sobre.php"); ?>

  <!-- EXPERIÊNCIA -->
    <?php include("componentes/experiencia.php"); ?>

  <!-- NEWSLETTER / CTA -->
    <?php include("componentes/newsletter.php"); ?>
    
  <!-- FOOTER -->
    <?php include("componentes/footer.php"); ?>

  <script src="script.js"></script>
</body>
</html>
