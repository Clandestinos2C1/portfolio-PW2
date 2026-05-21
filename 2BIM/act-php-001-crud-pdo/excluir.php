<?php
include 'config/conexao.php';

$id = filter_input(INPUT_GET, 'id');

if (!$id) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = 'DELETE FROM produtos WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: index.php');
    exit;
}

include 'includes/header.php';
?>

<div class="card">

    <h2>Excluir Produto</h2>

    <p>
        Tem certeza que deseja excluir este produto?
    </p>

    <br>

    <div class="card-buttons">

        <form action="?id=<?= $id ?>" method="POST">

            <button class="btn btn-red">
                Confirmar Exclusão
            </button>

        </form>

        <a href="index.php" class="btn btn-blue">
            Cancelar
        </a>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
