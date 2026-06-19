<?php
require_once '../conexao.php';
require_once '../includes/verificar_admin.php';

$success = '';
$error = '';
$categorias = [];

try {
    $stmt = $pdo->query('SELECT id_categoria, nome FROM categorias ORDER BY nome');
    $categorias = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = 'Não foi possível carregar as categorias. Tente novamente mais tarde.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $artista = trim($_POST['artista'] ?? '');
    $preco = trim($_POST['preco'] ?? '');
    $categoriaId = (int) ($_POST['categoria_id'] ?? 0);
    $descricao = trim($_POST['descricao'] ?? '');
    $estoque = (int) ($_POST['estoque'] ?? 0);
    $imagem = trim($_POST['imagem'] ?? '');

    if ($titulo === '' || $artista === '' || $preco === '' || $categoriaId <= 0) {
        $error = 'Preencha título, artista, preço e categoria.';
    } elseif ($imagem !== '' && !filter_var($imagem, FILTER_VALIDATE_URL)) {
        $error = 'Informe um link de imagem válido ou deixe o campo em branco.';
    } else {
        $sql = "INSERT INTO discos (titulo, artista, preco, categoria_id, descricao, estoque, imagem)
                VALUES (:titulo, :artista, :preco, :categoria_id, :descricao, :estoque, :imagem)";
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
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Criar Disco | Painel Admin</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <main class="admin-page">
    <div class="container">
      <div class="page-header admin-header">
        <div>
          <span class="eyebrow">Novo Disco</span>
          <h1>Cadastrar disco</h1>
          <p class="admin-subtitle">Adicione um novo álbum ao catálogo com informações completas.</p>
        </div>
        <div class="admin-actions">
          <a href="dashboard.php" class="btn btn-secondary">Voltar ao painel</a>
        </div>
      </div>

      <section class="admin-form">
        <?php if ($success): ?>
          <div class="purchase-message success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
          <div class="purchase-message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="criar.php" class="purchase-form">
          <div class="grid-2">
            <div class="input-group">
              <label for="titulo">Título</label>
              <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>" required>
            </div>
            <div class="input-group">
              <label for="artista">Artista</label>
              <input type="text" id="artista" name="artista" value="<?= htmlspecialchars($_POST['artista'] ?? '') ?>" required>
            </div>
          </div>

          <div class="grid-2">
            <div class="input-group">
              <label for="preco">Preço</label>
              <input type="number" step="0.01" id="preco" name="preco" value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>" required>
            </div>
            <div class="input-group">
              <label for="categoria_id">Categoria</label>
              <select id="categoria_id" name="categoria_id" required>
                <option value="">Selecione uma categoria</option>
                <?php foreach ($categorias as $categoria): ?>
                  <option value="<?= $categoria['id_categoria'] ?>" <?= (int)($_POST['categoria_id'] ?? 0) === (int)$categoria['id_categoria'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categoria['nome']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="input-group">
            <label for="imagem">Link da capa (imagem)</label>
            <input type="url" id="imagem" name="imagem" value="<?= htmlspecialchars($_POST['imagem'] ?? '') ?>" placeholder="https://example.com/capa.jpg">
          </div>

          <div class="grid-2">
            <div class="input-group">
              <label for="estoque">Estoque</label>
              <input type="number" id="estoque" name="estoque" min="0" value="<?= htmlspecialchars($_POST['estoque'] ?? '0') ?>">
            </div>
            <div class="input-group">
              <label for="descricao">Descrição</label>
              <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($_POST['descricao'] ?? '') ?></textarea>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Salvar disco</button>
        </form>
      </section>
    </div>
  </main>
</body>
</html>
