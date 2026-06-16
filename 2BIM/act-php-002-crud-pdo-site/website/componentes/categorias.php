<?php
// Build a query to get each category name and the number of records in that category.
// We use LEFT JOIN so categories without any albums still appear with a count of zero.
$sql = "SELECT categorias.nome AS categoria, COUNT(discos.id_disco) AS total
FROM categorias
LEFT JOIN discos ON discos.categoria_id = categorias.id_categoria
GROUP BY categorias.id_categoria, categorias.nome";

// Prepare and execute the database statement using the shared PDO connection.
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Fetch raw category counts from the database as an associative array.
$catCountsRaw = $stmt->fetchAll(PDO::FETCH_ASSOC);
$catCounts = [];

// Normalize category names to lowercase so lookups are case-insensitive.
foreach ($catCountsRaw as $row) {
    $key = mb_strtolower(trim($row['categoria']), 'UTF-8');
    $catCounts[$key] = (int) $row['total'];
}

// Helper function to get the count for a specific category name.
function getCategoryCount(string $name, array $counts): int
{
    $key = mb_strtolower(trim($name), 'UTF-8');
    return $counts[$key] ?? 0;
}
?>

<section class="section categorias-section" id="categorias">
    <div class="container">
      <div class="section-header">
        <p class="section-eyebrow">◈ explore por gênero</p>
        <h2 class="section-title">Categorias</h2>
      </div>
      <div class="categorias-grid">

        <div class="cat-card cat-rock">
          <div class="cat-icon">🎸</div>
          <h3>Rock</h3>
          <p>Clássicos e novos riffs que marcam épocas</p>
          <span class="cat-count"><?= getCategoryCount('Rock', $catCounts) ?> discos</span>
        </div>

        <div class="cat-card cat-pop">
          <div class="cat-icon">🎵</div>
          <h3>Pop</h3>
          <p>Hit parade e sucessos que marcam a cultura pop</p>
          <span class="cat-count"><?= getCategoryCount('Pop', $catCounts) ?> discos</span>
        </div>

        <div class="cat-card cat-mpb">
          <div class="cat-icon">🌿</div>
          <h3>MPB</h3>
          <p>A alma brasileira em cada compasso</p>
          <span class="cat-count"><?= getCategoryCount('MPB', $catCounts) ?> discos</span>
        </div>

        <div class="cat-card cat-indie">
          <div class="cat-icon">✦</div>
          <h3>Indie</h3>
          <p>Sons independentes que viram movimento</p>
          <span class="cat-count"><?= getCategoryCount('Indie', $catCounts) ?> discos</span>
        </div>

        <div class="cat-card cat-classico">
          <div class="cat-icon">🎻</div>
          <h3>Clássicos</h3>
          <p>Obras que o tempo consagrou como eternas</p>
          <span class="cat-count"><?= getCategoryCount('Clássicos', $catCounts) ?> discos</span>
        </div>

        <div class="cat-card cat-kpop">
          <div class="cat-icon">🎤</div>
          <h3>K-pop</h3>
          <p>População global em movimento</p>
          <span class="cat-count"><?= getCategoryCount('K-pop', $catCounts) ?> discos</span>
        </div>

      </div>
    </div>
  </section>