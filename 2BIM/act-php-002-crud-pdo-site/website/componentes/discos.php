<?php

$sql = "SELECT discos.*, categorias.nome AS categoria
FROM discos
INNER JOIN categorias
ON discos.categoria_id = categorias.id_categoria";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$discos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="section discos-section" id="discos">

    <div class="container">

        <div class="discos-grid">

            <?php foreach($discos as $disco): ?>

                <div class="disco-card">

                    <div class="disco-info">

                        <span class="disco-genre">

                            <?= $disco['categoria'] ?>

                        </span>

                        <h3>

                            <?= $disco['titulo'] ?>

                        </h3>

                        <p>

                            <?= $disco['artista'] ?>

                        </p>

                        <span>

                            R$ <?= $disco['preco'] ?>

                        </span>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>