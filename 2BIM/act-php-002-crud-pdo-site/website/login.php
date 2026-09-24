<?php
session_start();
require_once 'conexao.php';

$error = '';

if (isset($_POST['entrar'])) {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $error = 'Informe email e senha para entrar.';
    } else {
        $sql = 'SELECT * FROM usuarios WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];

            if ($usuario['tipo'] === 'admin') {
                header('Location: admin/dashboard.php');
                exit;
            }

            header('Location: index.php');
            exit;
        }

        $error = 'Email ou senha inválidos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | Tenho Mais Amigos Que Discos</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body class="auth-body">
  <main class="login-page">
    <div class="login-glow login-glow-one"></div>
    <div class="login-glow login-glow-two"></div>

    <section class="login-container">
      <div class="login-brand">
        <span class="login-badge">Área administrativa</span>
        <h1>Entrar</h1>
      </div>

      <p class="login-subtitle">Acesse o painel para gerenciar discos, categorias e pedidos.</p>

      <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="login.php" class="login-form">
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Seu email" autocomplete="email" required />
        </div>

        <div class="input-group">
          <label for="senha">Senha</label>
          <input type="password" id="senha" name="senha" placeholder="Sua senha" autocomplete="current-password" required />
        </div>

        <button type="submit" name="entrar" class="btn btn-primary btn-block">Entrar</button>
      </form>

      <p class="login-back">
        <a href="index.php">Voltar para o site</a>
      </p>
    </section>
  </main>
</body>
</html>
