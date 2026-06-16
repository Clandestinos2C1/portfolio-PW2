<?php
session_start();
require_once __DIR__ . '/../conexao.php';

$id = filter_input(INPUT_GET, 'id_disco', FILTER_VALIDATE_INT);

if (!$id) {
    die("Disco não encontrado.");
}

$mensagem_compra = '';
$erro_compra = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $cartao = trim($_POST['cartao'] ?? '');
    $validade = trim($_POST['validade'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $cep = trim($_POST['cep'] ?? '');

    if (!$nome || !$cartao || !$validade || !$cvv || !$endereco || !$cep) {
        $erro_compra = 'Por favor, preencha todos os campos antes de confirmar a compra.';
    } else {
        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare('SELECT estoque FROM discos WHERE id_disco = ? FOR UPDATE');
            $stmt->execute([$id]);
            $estoque_atual = $stmt->fetchColumn();

            if ($estoque_atual === false) {
                $pdo->rollBack();
                $erro_compra = 'Disco não encontrado.';
            } elseif ((int)$estoque_atual <= 0) {
                $pdo->rollBack();
                $erro_compra = 'Desculpe, este disco está sem estoque no momento.';
            } else {
                $stmt = $pdo->prepare('UPDATE discos SET estoque = estoque - 1 WHERE id_disco = ?');
                $stmt->execute([$id]);
                $pdo->commit();

                $_SESSION['compra_mensagem'] = 'Compra concluída com sucesso! Obrigado pela preferência. O estoque foi atualizado.';
                header('Location: disco.php?id=' . $id . '&compra=ok');
                exit;
            }
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $erro_compra = 'Erro ao processar a compra. Tente novamente.';
        }
    }
}

if (isset($_SESSION['compra_mensagem'])) {
    $mensagem_compra = $_SESSION['compra_mensagem'];
    unset($_SESSION['compra_mensagem']);
}

try {
    $sql = "SELECT discos.*, categorias.nome AS categoria
            FROM discos
            INNER JOIN categorias ON discos.categoria_id = categorias.id_categoria
            WHERE discos.id_disco = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $disco = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$disco) {
        die("Disco não encontrado.");
    }
} catch (PDOException $e) {
    die("Erro ao carregar disco.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($disco['titulo']) ?></title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <?php include __DIR__ . '/header.php'; ?>

    <main class="section discos-section">
        <div class="container">
            <div class="page-header">
                <a href="index.php" class="btn btn-ghost">← Voltar para a loja</a>
                <h1><?= htmlspecialchars($disco['titulo']) ?></h1>
            </div>

            <div class="disco-detail-grid">
                <div class="disco-detail-image">
                    <?php if (!empty($disco['imagem'])): ?>
                        <img src="<?= htmlspecialchars($disco['imagem']) ?>" alt="<?= htmlspecialchars($disco['titulo']) ?>">
                    <?php endif; ?>
                </div>

                <div class="disco-detail-info">
                    <p class="disco-genre"><?= htmlspecialchars($disco['categoria'] ?? '') ?></p>
                    <h2><?= htmlspecialchars($disco['titulo']) ?></h2>
                    <p class="disco-artist"><?= htmlspecialchars($disco['artista']) ?></p>
                    <p class="disco-description"><?= nl2br(htmlspecialchars($disco['descricao'])) ?></p>
                    <p class="disco-price-detail">Preço: <strong>R$ <?= number_format($disco['preco'], 2, ',', '.') ?></strong></p>
                    <p class="disco-stock">Estoque: <strong><?= isset($disco['estoque']) ? $disco['estoque'] : '0' ?></strong></p>

                    <?php if ($mensagem_compra): ?>
                        <div class="purchase-message success"><?= htmlspecialchars($mensagem_compra) ?></div>
                    <?php endif; ?>

                    <?php if ($erro_compra): ?>
                        <div class="purchase-message error"><?= htmlspecialchars($erro_compra) ?></div>
                    <?php endif; ?>

                    <?php if (!isset($disco['estoque']) || (int)$disco['estoque'] > 0): ?>
                        <section class="purchase-card">
                            <h2>Comprar este disco</h2>
                            <p class="purchase-note">Este é um exemplo de compra escolar. Não é um pagamento real.</p>

                            <form method="post" action="disco.php?id=<?= $id ?>" class="purchase-form">

                                <div class="input-group">
                                    <label for="nome">Nome completo</label>
                                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
                                </div>

                                <div class="input-group">
                                    <label for="cartao">Número do cartão</label>
                                    <input type="text" id="cartao" name="cartao" maxlength="19" value="<?= htmlspecialchars($_POST['cartao'] ?? '') ?>" required>
                                </div>

                                <div class="grid-2">
                                    <div class="input-group">
                                        <label for="validade">Validade</label>
                                        <input type="text" id="validade" name="validade" placeholder="MM/AA" value="<?= htmlspecialchars($_POST['validade'] ?? '') ?>" required>
                                    </div>
                                    <div class="input-group">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" maxlength="4" value="<?= htmlspecialchars($_POST['cvv'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <label for="endereco">Endereço de entrega</label>
                                    <textarea id="endereco" name="endereco" rows="3" required><?= htmlspecialchars($_POST['endereco'] ?? '') ?></textarea>
                                </div>

                                <div class="input-group">
                                    <label for="cep">CEP</label>
                                    <input type="text" id="cep" name="cep" maxlength="10" value="<?= htmlspecialchars($_POST['cep'] ?? '') ?>" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Confirmar compra</button>
                            </form>
                        </section>
                    <?php else: ?>
                        <div class="purchase-message error">Este disco está esgotado. Verifique outros títulos disponíveis.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html>