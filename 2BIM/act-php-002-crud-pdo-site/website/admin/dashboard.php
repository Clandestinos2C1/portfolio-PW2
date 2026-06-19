<?php
require_once '../conexao.php';
require_once '../includes/verificar_admin.php';

$discoCount = 0;
$categoriaCount = 0;
$usuarioCount = 0;
$recentDiscos = [];

try {
    $stmt = $pdo->query('SELECT COUNT(*) FROM discos');
    $discoCount = (int)$stmt->fetchColumn();

    $stmt = $pdo->query('SELECT COUNT(*) FROM categorias');
    $categoriaCount = (int)$stmt->fetchColumn();

    $stmt = $pdo->query('SELECT COUNT(*) FROM usuarios');
    $usuarioCount = (int)$stmt->fetchColumn();

    $stmt = $pdo->query('SELECT id_disco, titulo, artista, preco FROM discos ORDER BY id_disco DESC LIMIT 5');
    $recentDiscos = $stmt->fetchAll();
} catch (PDOException $e) {
    // Ignorar; se o banco estiver incompleto, a dashboard ainda abre.
}
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
    <div class="container">
      <header class="admin-header">
        <div>
          <span class="eyebrow">Painel Administrativo</span>
          <h1>Olá, <?= htmlspecialchars($_SESSION['nome']) ?></h1>
          <p class="admin-subtitle">Gerencie discos, categorias e conteúdo do site a partir deste painel.</p>
        </div>

        <div class="admin-actions">
          <a href="criar.php" class="btn btn-primary">Novo Disco</a>
          <a href="editar.php" class="btn btn-outline">Editar Disco</a>
          <a href="excluir.php" class="btn btn-outline">Excluir Disco</a>
          <a href="../logout.php" class="btn btn-secondary">Sair</a>
        </div>
      </header>

      <div class="admin-grid">
        <article class="admin-card">
          <span class="card-label">Discos cadastrados</span>
          <p class="card-value"><?= $discoCount ?></p>
        </article>
        <article class="admin-card">
          <span class="card-label">Categorias</span>
          <p class="card-value"><?= $categoriaCount ?></p>
        </article>
        <article class="admin-card">
          <span class="card-label">Usuários</span>
          <p class="card-value"><?= $usuarioCount ?></p>
        </article>
      </div>

      <?php if (!empty($recentDiscos)): ?>
        <section class="admin-section">
          <div class="section-header">
            <h2>Últimos discos adicionados</h2>
            <p>Confira rapidamente os lançamentos e atualize quando precisar.</p>
          </div>

          <table class="admin-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Artista</th>
                <th>Preço</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recentDiscos as $disco): ?>
                <tr>
                  <td><?= $disco['id_disco'] ?></td>
                  <td><?= htmlspecialchars($disco['titulo']) ?></td>
                  <td><?= htmlspecialchars($disco['artista']) ?></td>
                  <td>R$ <?= number_format($disco['preco'], 2, ',', '.') ?></td>
                  <td><a href="editar.php?id_disco=<?= $disco['id_disco'] ?>" class="btn btn-outline">Editar</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </section>
      <?php endif; ?>

      <p class="admin-footer"><a href="../index.php" class="btn btn-secondary">Voltar para o site</a></p>
    </div>
  </main>
</body>
</html>
