<?php
require_once '../conexao.php';
require_once '../includes/verificar_admin.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin | Tenho Mais Amigos Que Discos</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <main class="admin-dashboard">
    <h1>Painel Administrativo</h1>
    <p>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?></p>

    <ul class="admin-menu">
      <li><a href="criar.php">Novo Disco</a></li>
      <li><a href="editar.php">Editar Disco</a></li>
      <li><a href="excluir.php">Excluir Disco</a></li>
      <li><a href="../logout.php">Sair</a></li>
    </ul>

    <p>
      Voltar para <a href="../index.php">o site</a>.
    </p>
  </main>
</body>
</html>
