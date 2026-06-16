<?php
session_start();
require_once 'conexao.php';

$q = trim($_GET['q'] ?? '');
$resultados = [];
$mensagem = '';

if ($q !== '') {
    $termo = '%' . $q . '%';

    $sql = "SELECT discos.*, categorias.nome AS categoria
            FROM discos
            INNER JOIN categorias ON discos.categoria_id = categorias.id_categoria
            WHERE discos.titulo LIKE :termo
               OR discos.artista LIKE :termo
               OR categorias.nome LIKE :termo
            ORDER BY discos.titulo ASC
            LIMIT 30";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':termo' => $termo]);
    $resultados = $stmt->fetchAll();

    if (empty($resultados)) {
        $mensagem = 'Nenhum disco encontrado para "' . htmlspecialchars($q) . '".';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buscar Discos | Tenho Mais Amigos Que Discos</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <?php include 'componentes/header.php'; ?>

  <main class="section discos-section">
    <div class="container">
      <div class="page-header">
        <a href="index.php" class="btn btn-ghost">← Voltar</a>
        <h1>Buscar Discos</h1>
        <p>Procure por título, artista ou gênero.</p>
      </div>

      <form class="search-form" method="get" action="procurar.php">
        <div class="input-group">
          <label for="q">Pesquisa</label>
          <input type="search" id="q" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Digite título, artista ou categoria" />
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
      </form>

      <?php if ($q !== ''): ?>
        <?php if ($mensagem): ?>
          <div class="purchase-message error"><?= $mensagem ?></div>
        <?php endif; ?>

        <?php if (!empty($resultados)): ?>
          <div class="discos-grid">
            <?php foreach ($resultados as $disco): ?>
              <div class="disco-card">
                <a href="disco.php?id=<?= $disco['id_disco'] ?>" class="disco-link">
                  <div class="disco-img-wrap">
                    <?php if (!empty($disco['imagem'])): ?>
                      <div class="disco-cover">
                        <img src="<?= htmlspecialchars($disco['imagem']) ?>" alt="Capa de <?= htmlspecialchars($disco['titulo']) ?>">
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="disco-info">
                    <span class="disco-genre"><?= htmlspecialchars($disco['categoria']) ?></span>
                    <h3 class="disco-album"><?= htmlspecialchars($disco['titulo']) ?></h3>
                    <p class="disco-artist"><?= htmlspecialchars($disco['artista']) ?></p>
                    <div class="disco-footer">
                      <span class="disco-price">R$ <?= number_format($disco['preco'], 2, ',', '.') ?></span>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </main>

  <?php include 'componentes/footer.php'; ?>
  <script src="js/main.js"></script>
</body>
</html>
