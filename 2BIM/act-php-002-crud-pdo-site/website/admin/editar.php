<?php
require_once '../conexao.php';
require_once '../includes/verificar_admin.php';

$error = '';
$success = '';
$categorias = [];
$disco = null;
$id_disco = filter_input(INPUT_GET, 'id_disco', FILTER_VALIDATE_INT);

try {
    $stmt = $pdo->query('SELECT id_categoria, nome FROM categorias ORDER BY nome');
    $categorias = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = 'Não foi possível carregar as categorias.';
}

if ($id_disco && $_SERVER['REQUEST_METHOD'] === 'POST') {
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
        try {
            $sql = "UPDATE discos SET titulo = :titulo, artista = :artista, preco = :preco,
                    categoria_id = :categoria_id, descricao = :descricao, estoque = :estoque, imagem = :imagem
                    WHERE id_disco = :id_disco";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titulo' => $titulo,
                ':artista' => $artista,
                ':preco' => $preco,
                ':categoria_id' => $categoriaId,
                ':descricao' => $descricao,
                ':estoque' => $estoque,
                ':imagem' => $imagem,
                ':id_disco' => $id_disco
            ]);
            $success = 'Disco atualizado com sucesso!';
        } catch (PDOException $e) {
            $error = 'Erro ao atualizar o disco. Tente novamente.';
        }
    }
}

if ($id_disco) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM discos WHERE id_disco = ?');
        $stmt->execute([$id_disco]);
        $disco = $stmt->fetch();

        if (!$disco) {
            $error = 'Disco não encontrado.';
        }
    } catch (PDOException $e) {
        $error = 'Erro ao carregar o disco.';
    }
}

if (!$id_disco && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    try {
        $stmt = $pdo->query('SELECT id_disco, titulo, artista FROM discos ORDER BY id_disco DESC');
        $discos = $stmt->fetchAll();
    } catch (PDOException $e) {
        $discos = [];
        $error = 'Erro ao carregar a lista de discos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Disco | Painel Admin</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <main class="admin-page">
    <div class="container">
      <div class="page-header admin-header">
        <div>
          <span class="eyebrow">Editar Disco</span>
          <h1>Atualizar catálogo</h1>
          <p class="admin-subtitle">Selecione um disco e altere seus dados diretamente.</p>
        </div>
        <div class="admin-actions">
          <a href="dashboard.php" class="btn btn-secondary">Voltar ao painel</a>
        </div>
      </div>

      <?php if ($error): ?>
        <div class="purchase-message error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <?php if ($success): ?>
        <div class="purchase-message success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <?php if (!$id_disco): ?>
        <section class="admin-section">
          <p>Escolha o disco que deseja editar:</p>
          <?php if (!empty($discos)): ?>
            <table class="admin-table">
              <thead>
                <tr><th>ID</th><th>Título</th><th>Artista</th><th>Ação</th></tr>
              </thead>
              <tbody>
                <?php foreach ($discos as $item): ?>
                  <tr>
                    <td><?= $item['id_disco'] ?></td>
                    <td><?= htmlspecialchars($item['titulo']) ?></td>
                    <td><?= htmlspecialchars($item['artista']) ?></td>
                    <td><a href="editar.php?id_disco=<?= $item['id_disco'] ?>" class="btn btn-outline">Editar</a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php else: ?>
            <p>Nenhum disco encontrado.</p>
          <?php endif; ?>
        </section>
      <?php else: ?>
        <?php if ($disco): ?>
          <section class="admin-form">
            <form method="POST" action="editar.php?id_disco=<?= $id_disco ?>" class="purchase-form">
              <div class="grid-2">
                <div class="input-group">
                  <label for="titulo">Título</label>
                  <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($_POST['titulo'] ?? $disco['titulo']) ?>" required>
                </div>
                <div class="input-group">
                  <label for="artista">Artista</label>
                  <input type="text" id="artista" name="artista" value="<?= htmlspecialchars($_POST['artista'] ?? $disco['artista']) ?>" required>
                </div>
              </div>

              <div class="grid-2">
                <div class="input-group">
                  <label for="preco">Preço</label>
                  <input type="number" step="0.01" id="preco" name="preco" value="<?= htmlspecialchars($_POST['preco'] ?? $disco['preco']) ?>" required>
                </div>
                <div class="input-group">
                  <label for="categoria_id">Categoria</label>
                  <select id="categoria_id" name="categoria_id" required>
                    <option value="">Selecione uma categoria</option>
                    <?php foreach ($categorias as $categoria): ?>
                      <option value="<?= $categoria['id_categoria'] ?>" <?= ((int)($_POST['categoria_id'] ?? $disco['categoria_id']) === (int)$categoria['id_categoria']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoria['nome']) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="input-group">
                <label for="imagem">Link da capa (imagem)</label>
                <input type="url" id="imagem" name="imagem" value="<?= htmlspecialchars($_POST['imagem'] ?? $disco['imagem']) ?>" placeholder="https://example.com/capa.jpg">
              </div>

              <div class="grid-2">
                <div class="input-group">
                  <label for="estoque">Estoque</label>
                  <input type="number" id="estoque" name="estoque" min="0" value="<?= htmlspecialchars($_POST['estoque'] ?? $disco['estoque']) ?>">
                </div>
                <div class="input-group">
                  <label for="descricao">Descrição</label>
                  <textarea id="descricao" name="descricao" rows="4"><?= htmlspecialchars($_POST['descricao'] ?? $disco['descricao']) ?></textarea>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Atualizar disco</button>
            </form>
          </section>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>
