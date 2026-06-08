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
<body>
  <main class="login-page">
    <section class="login-container">
      <h1>Entrar</h1>
      <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="login.php">
        <label>
          Email
          <input type="email" name="email" placeholder="Seu email" required />
        </label>

        <label>
          Senha
          <input type="password" name="senha" placeholder="Sua senha" required />
        </label>

        <button type="submit" name="entrar">Entrar</button>
      </form>

      <p>
        Voltar para <a href="index.php">o site</a>.
      </p>
    </section>
  </main>
</body>
</html>
