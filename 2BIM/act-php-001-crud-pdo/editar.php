<?php

include 'config/conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM produtos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $fabricante = $_POST['fabricante'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $estoque = $_POST['estoque'] ?? '';

    $sql = "UPDATE produtos SET nome = :nome, fabricante = :fabricante, preco = :preco, estoque = :estoque WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':fabricante', $fabricante);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: index.php');
    exit;
}

include 'includes/header.php';
?>

<div class="card">

    <h2>Editar Produto</h2>

    <form action="" method="POST">

        <div class="form-group">

            <label>Nome</label>

            <input
                type="text"
                name="nome"
                value="<?= htmlspecialchars($produto['nome'], ENT_QUOTES) ?>"
                required
            >

        </div>

        <div class="form-group">

            <label>Fabricante</label>

            <input
                type="text"
                name="fabricante"
                value="<?= htmlspecialchars($produto['fabricante'], ENT_QUOTES) ?>"
                required
            >

        </div>

        <div class="form-group">

            <label>Preço</label>

            <input
                type="number"
                step="0.01"
                name="preco"
                value="<?= htmlspecialchars($produto['preco'], ENT_QUOTES) ?>"
                required
            >

        </div>

        <div class="form-group">

            <label>Estoque</label>

            <input
                type="number"
                name="estoque"
                value="<?= htmlspecialchars($produto['estoque'], ENT_QUOTES) ?>"
                required
            >

        </div>

        <button class="btn btn-blue">
            Salvar Alterações
        </button>

        <a href="index.php" class="btn btn-red">
            Cancelar
        </a>

    </form>

</div>

<?php include 'includes/footer.php'; ?>
