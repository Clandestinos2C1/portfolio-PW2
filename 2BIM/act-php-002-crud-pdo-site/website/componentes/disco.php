<?php
require_once __DIR__ . '/../conexao.php';

$id = filter_input(INPUT_GET, 'id_disco', FILTER_VALIDATE_INT);

if (!$id) {
    die("Disco não encontrado.");
}

$mensagem_compra = '';
$erro_compra = '';

try {

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

                $mensagem_compra = 'Compra concluída com sucesso! Obrigado pela preferência. O estoque foi atualizado.';
            }
        }
    }

    $sql = "SELECT * FROM discos WHERE id_disco = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $disco = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$disco) {
        die("Disco não encontrado.");
    }

} catch(PDOException $e) {
    die("Erro ao carregar disco.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($disco['titulo']) ?></title>
</head>
<body>

    <h1><?= htmlspecialchars($disco['titulo']) ?></h1>

    <?php if (!empty($disco['imagem'])): ?>
        <img
            src="<?= htmlspecialchars($disco['imagem']) ?>"
            alt="<?= htmlspecialchars($disco['titulo']) ?>"
            width="400">
    <?php endif; ?>

    <?php if (!empty($disco['descricao'])): ?>
        <p><?= htmlspecialchars($disco['descricao']) ?></p>
    <?php endif; ?>

    <p>
        <strong>Preço:</strong>
        R$ <?= number_format($disco['preco'], 2, ',', '.') ?>
    </p>

    <?php if (isset($disco['estoque'])): ?>
        <p>
            <strong>Estoque:</strong>
            <?= $disco['estoque'] ?>
        </p>
    <?php endif; ?>

    <?php if ($mensagem_compra): ?>
        <div class="purchase-message success">
            <?= htmlspecialchars($mensagem_compra) ?>
        </div>
    <?php endif; ?>

    <?php if ($erro_compra): ?>
        <div class="purchase-message error">
            <?= htmlspecialchars($erro_compra) ?>
        </div>
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
        <div class="purchase-message error">
            Este disco está esgotado. Verifique outros títulos disponíveis.</div>
    <?php endif; ?>

</body>
</html>