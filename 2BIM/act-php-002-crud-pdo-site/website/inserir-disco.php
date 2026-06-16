<?php
require_once 'conexao.php';

$success = '';
$error = '';
$categorias = [];
$categoriaId = (int) ($_POST['categoria_id'] ?? 0);

try {
    $stmt = $pdo->query('SELECT id_categoria, nome FROM categorias ORDER BY nome');
    $categorias = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = 'Não foi possível carregar as categorias. Tente novamente mais tarde.';
}

if (isset($_POST['salvar'])) {
    $titulo = trim($_POST['titulo'] ?? '');
    $artista = trim($_POST['artista'] ?? '');
    $preco = trim($_POST['preco'] ?? '');
    $categoriaId = (int) ($_POST['categoria_id'] ?? 0);
    $descricao = trim($_POST['descricao'] ?? '');
    $estoque = (int) ($_POST['estoque'] ?? 0);
    $imagem = trim($_POST['imagem'] ?? '');

    if ($titulo === '' || $artista === '' || $preco === '' || $categoriaId <= 0) {
        $error = 'Preencha título, artista, preço e categoria.';
    } elseif (!filter_var($imagem, FILTER_VALIDATE_URL) && $imagem !== '') {
        $error = 'Informe um link de imagem válido ou deixe o campo em branco.';
    } else {
        $sql = "INSERT INTO discos
            (titulo, artista, preco, categoria_id, descricao, estoque, imagem)
            VALUES
            (:titulo, :artista, :preco, :categoria_id, :descricao, :estoque, :imagem)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':artista' => $artista,
            ':preco' => $preco,
            ':categoria_id' => $categoriaId,
            ':descricao' => $descricao,
            ':estoque' => $estoque,
            ':imagem' => $imagem
        ]);

        $success = 'Disco cadastrado com sucesso!';
        $_POST = [];
        $categoriaId = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastrar Disco | Tenho Mais Amigos Que Discos</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <main class="form-page">
    <section class="form-container">
      <h1>Cadastrar Disco</h1>

      <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="inserir-disco.php">
        <label>
          Título
          <input type="text" name="titulo" value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>" required />
        </label>

        <label>
          Artista
          <input type="text" name="artista" value="<?= htmlspecialchars($_POST['artista'] ?? '') ?>" required />
        </label>

        <label>
          Preço
          <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>" required />
        </label>

        <label>
          Categoria
          <select name="categoria_id" required>
            <option value="">Selecione uma categoria</option>
            <?php foreach ($categorias as $categoria): ?>
              <option value="<?= $categoria['id_categoria'] ?>" <?= $categoriaId === (int) $categoria['id_categoria'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($categoria['nome']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </label>

        <label>
          Estoque
          <input type="number" name="estoque" value="<?= htmlspecialchars($_POST['estoque'] ?? '0') ?>" min="0" />
        </label>

        <label>
          Link da capa (imagem)
          <input type="url" name="imagem" value="<?= htmlspecialchars($_POST['imagem'] ?? '') ?>" placeholder="https://example.com/capa.jpg" />
        </label>

        <label>
          Descrição
          <textarea name="descricao"><?= htmlspecialchars($_POST['descricao'] ?? '') ?></textarea>
        </label>

        <button type="submit" name="salvar">Salvar Disco</button>
      </form>

      <p><a href="index.php">Voltar para o site</a></p>
    </section>
  </main>
</body>
</html>
