<?php

include 'config/conexao.php';
include 'includes/header.php';

$sql = "SELECT * FROM produtos";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="card">

    <h2>Produtos Cadastrados</h2>

    <br>

    <a href="cadastro.php" class="btn btn-green">
        Novo Produto
    </a>

    <!--CARDS MOBILE-->

    <div class="cards-mobile">

        <?php foreach($produtos as $produto): ?>

        <div class="produto-card">

            <h3><?= $produto['nome'] ?></h3>

            <p>
                <strong>Fabricante:</strong>
                <?= $produto['fabricante'] ?>
            </p>

            <p>
                <strong>Preço:</strong>
                R$ <?= number_format($produto['preco'],2,',','.') ?>
            </p>

            <p>
                <strong>Estoque:</strong>
                <?= $produto['estoque'] ?>
            </p>

            <div class="card-buttons">

                <a
                    href="editar.php?id=<?= $produto['id'] ?>"
                    class="btn btn-blue"
                >
                    Editar
                </a>

                <a
                    href="excluir.php?id=<?= $produto['id'] ?>"
                    class="btn btn-red"
                >
                    Excluir
                </a>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

    <!-- TABELA DESKTOP-->

    <table class="tabela-desktop">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Fabricante</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>

        <?php foreach($produtos as $produto): ?>

        <tr>

            <td><?= $produto['id'] ?></td>

            <td><?= $produto['nome'] ?></td>

            <td><?= $produto['fabricante'] ?></td>

            <td>
                R$
                <?= number_format($produto['preco'],2,',','.') ?>
            </td>

            <td><?= $produto['estoque'] ?></td>

            <td>

                <a
                    href="editar.php?id=<?= $produto['id'] ?>"
                    class="btn btn-blue"
                >
                    Editar
                </a>

                <a
                    href="excluir.php?id=<?= $produto['id'] ?>"
                    class="btn btn-red"
                >
                    Excluir
                </a>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</div>

<?php include 'includes/footer.php'; ?>