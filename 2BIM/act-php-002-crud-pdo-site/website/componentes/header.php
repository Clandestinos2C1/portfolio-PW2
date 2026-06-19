<header class="navbar" id="navbar">
    <div class="nav-inner">
      <a href="../website/index.php" class="logo">
            <img src="imagens/logo.png" alt="Logo T+AMQD, Tenho mais amigos que discos">
      </a>
      <nav class="nav-links" id="navLinks">
        <a href="#discos">Discos</a>
        <a href="#categorias">Categorias</a>
        <a href="#sobre">Sobre</a>
        <a href="#experiencia">Experiência</a>
        <a href="#contato" >Contato</a>
        <?php if(isset($_SESSION['id_usuario'])): ?>
          <?php if($_SESSION['tipo'] === 'admin'): ?>
            <a href="admin/dashboard.php">Painel</a>
          <?php endif; ?>
          <a href="logout.php" class="nav-cta">Sair</a>
        <?php else: ?>
          <a href="login.php" class="nav-cta">Entrar</a>
        <?php endif; ?>
      </nav>
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>