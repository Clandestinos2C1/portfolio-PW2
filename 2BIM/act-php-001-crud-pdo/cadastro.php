<?php 
include 'includes/header.php';
include 'config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = "INSERT INTO produtos
    (nome, fabricante, preco, estoque)
    VALUES
    (:nome, :fabricante, :preco, :estoque)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':fabricante', $fabricante);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque);

    $stmt->execute();

    echo "<script>
            alert('Produto cadastrado!');
            window.location.href='index.php';
          </script>";
}
?>

<div class="card">

    <h2>Cadastrar Produto</h2>

    <form action="" method="POST">

        <div class="form-group">
            <label>Nome</label>

            <input type="text" name="nome" required>
        </div>

        <div class="form-group">
            <label>Fabricante</label>

            <input type="text" name="fabricante" required>
        </div>

        <div class="form-group">
            <label>Preço</label>

            <input type="number" step="0.01" name="preco" required>
        </div>

        <div class="form-group">
            <label>Estoque</label>

            <input type="number" name="estoque" required>
        </div>

        <button type="submit" class="btn btn-green">
            Salvar Produto
        </button>

    </form>

</div>

<?php include 'includes/footer.php'; ?>
