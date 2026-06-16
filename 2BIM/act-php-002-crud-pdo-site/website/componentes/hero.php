<?php
$hero_discs = 0;
$hero_artists = 0;
$hero_genres = 0;

if (isset($pdo)) {
    try {
        $stmt = $pdo->query('SELECT COUNT(*) FROM discos');
        $hero_discs = (int) $stmt->fetchColumn();

        $stmt = $pdo->query('SELECT COUNT(DISTINCT artista) FROM discos');
        $hero_artists = (int) $stmt->fetchColumn();

        $stmt = $pdo->query('SELECT COUNT(DISTINCT categoria_id) FROM discos');
        $hero_genres = (int) $stmt->fetchColumn();
    } catch (PDOException $e) {
        // mantém valores padrões se houver erro na query.
    }
}
?>

<section class="hero" id="hero">
    <div class="hero-noise"></div>
    <div class="hero-vinyl vinyl-bg-1"></div>
    <div class="hero-vinyl vinyl-bg-2"></div>
    <div class="hero-content">
      <p class="hero-eyebrow">✦ desde sempre, para sempre ✦</p>
      <h1 class="hero-title">
        Redescubra o prazer<br />
        <em>de ouvir música</em><br />
        sem pressa.
      </h1>
      <p class="hero-sub">Discos de vinil selecionados com amor. Cada sulco, uma história.<br />Cada lado B, uma surpresa.</p>
      <div class="hero-actions">
        <a href="#discos" class="btn btn-primary">Explorar Discos</a>
        <a href="#sobre" class="btn btn-ghost">Nossa História</a>
      </div>
      <div class="hero-stats">
        <div class="stat"><span class="stat-num"><?= $hero_discs ?></span><span class="stat-label">Discos</span></div>
        <div class="stat-divider"></div>
        <div class="stat"><span class="stat-num"><?= $hero_artists ?></span><span class="stat-label">Artistas</span></div>
        <div class="stat-divider"></div>
        <div class="stat"><span class="stat-num"><?= $hero_genres ?></span><span class="stat-label">Gêneros</span></div>
      </div>
    </div>
  </section>