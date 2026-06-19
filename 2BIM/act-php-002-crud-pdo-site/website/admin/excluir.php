<?php
require_once '../conexao.php';
require_once '../includes/verificar_admin.php';

$error = '';
$success = '';
$discos = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletar_id'])) {
    $deletarId = (int) $_POST['deletar_id'];

    if ($deletarId > 0) {
        try {
            $stmt = $pdo->prepare('DELETE FROM discos WHERE id_disco = ?');
            $stmt->execute([$deletarId]);
            if ($stmt->rowCount() > 0) {
                $success = 'Disco excluído com sucesso.';
            } else {
                $error = 'Disco não encontrado.';
            }
        } catch (PDOException $e) {
            $error = 'Erro ao excluir o disco. Tente novamente.';
        }
    }
}

try {
    $stmt = $pdo->query('SELECT id_disco, titulo, artista FROM discos ORDER BY id_disco DESC');
    $discos = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = 'Erro ao carregar a lista de discos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Excluir Disco | Painel Admin</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <main class="admin-page">
    <div class="container">
      <div class="page-header admin-header">
        <div>
          <span class="eyebrow">Excluir Disco</span>
          <h1>Remover álbum</h1>
          <p class="admin-subtitle">Use com cuidado: a exclusão é permanente.</p>
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

      <section class="admin-section">
        <?php if (!empty($discos)): ?>
          <table class="admin-table">
            <thead>
              <tr><th>ID</th><th>Título</th><th>Artista</th><th>Ação</th></tr>
            </thead>
            <tbody>
              <?php foreach ($discos as $disco): ?>
                <tr>
                  <td><?= $disco['id_disco'] ?></td>
                  <td><?= htmlspecialchars($disco['titulo']) ?></td>
                  <td><?= htmlspecialchars($disco['artista']) ?></td>
                  <td>
                    <form method="post" action="excluir.php" onsubmit="return confirm('Confirma exclusão deste disco?');">
                      <input type="hidden" name="deletar_id" value="<?= $disco['id_disco'] ?>">
                      <button type="submit" class="btn btn-outline">Excluir</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p>Nenhum disco encontrado para excluir.</p>
        <?php endif; ?>
      </section>
    </div>
  </main>
</body>
</html>
