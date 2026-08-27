<?php
$categoriaId = filter_input(INPUT_GET, 'categoria', FILTER_VALIDATE_INT);
$categoriaId = $categoriaId !== false && $categoriaId !== null && $categoriaId > 0 ? $categoriaId : null;

$sql = "SELECT discos.*, categorias.nome AS categoria
FROM discos
INNER JOIN categorias
ON discos.categoria_id = categorias.id_categoria";

if ($categoriaId !== null) {
    $sql .= " WHERE discos.categoria_id = :categoria_id";
}

try {
    $stmt = $pdo->prepare($sql);
    if ($categoriaId !== null) {
        $stmt->bindValue(':categoria_id', $categoriaId, PDO::PARAM_INT);
    }
    $stmt->execute();
    $discos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $discos = array();
    $erro_discos = "Erro ao buscar discos: " . $e->getMessage();
}
?>

<section class="section discos-section" id="discos">
    <div class="container">

        <?php if (isset($erro_discos)): ?>
            <div style="color:red;padding:20px;background:#ffe0e0;border-radius:5px;">
                <strong>Erro:</strong> <?= $erro_discos ?>
            </div>

        <?php elseif (empty($discos)): ?>
            <div style="color:orange;padding:20px;background:#fff3e0;border-radius:5px;">
                <strong>Aviso:</strong> Nenhum disco encontrado.
            </div>

        <?php else: ?>

            <div class="discos-grid">

                <?php foreach($discos as $disco): ?>

                    <div class="disco-card">

                        <a href="disco.php?id=<?= $disco['id_disco'] ?>" class="disco-link">

                            <div class="disco-img-wrap">

                                <?php if (!empty($disco['imagem'])): ?>
                                    <div class="disco-cover">
                                        <img
                                            src="<?= htmlspecialchars($disco['imagem']) ?>"
                                            alt="Capa de <?= htmlspecialchars($disco['titulo']) ?>">
                                    </div>
                                <?php endif; ?>

                            </div>

                            <div class="disco-info">

                                <span class="disco-genre">
                                    <?= htmlspecialchars($disco['categoria']) ?>
                                </span>

                                <h3 class="disco-album">
                                    <?= htmlspecialchars($disco['titulo']) ?>
                                </h3>

                                <p class="disco-artist">
                                    <?= htmlspecialchars($disco['artista']) ?>
                                </p>

                                <div class="disco-footer">
                                    <span class="disco-price">
                                        R$ <?= number_format($disco['preco'], 2, ',', '.') ?>
                                    </span>
                                </div>

                            </div>

                        </a>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>
</section>

