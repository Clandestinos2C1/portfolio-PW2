<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tenho Mais Amigos Que Discos</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@1,400;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <!-- NAVBAR -->
  <header class="navbar" id="navbar">
    <div class="nav-inner">
      <a href="#" class="logo">
            <img src="imagens/logo.png" alt="Logo T+AMQD, Tenho mais amigos que discos">
      </a>
      <nav class="nav-links" id="navLinks">
        <a href="#discos">Discos</a>
        <a href="#categorias">Categorias</a>
        <a href="#sobre">Sobre</a>
        <a href="#experiencia">Experiência</a>
        <a href="#contato" class="nav-cta">Contato</a>
      </nav>
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero" id="hero">
    <div class="hero-noise"></div>
    <div class="hero-vinyl vinyl-bg-1"></div>
    <div class="hero-vinyl vinyl-bg-2"></div>
    <div class="hero-content">
      <p class="hero-eyebrow">✦ desde sempre, para sempre ✦</p>
      <h1 class="hero-title">
        Redescubra o prazer<br />
        <em>de ouvir música</em><br />
        sem pressa.
      </h1>
      <p class="hero-sub">Discos de vinil selecionados com amor. Cada sulco, uma história.<br />Cada lado B, uma surpresa.</p>
      <div class="hero-actions">
        <a href="#discos" class="btn btn-primary">Explorar Discos</a>
        <a href="#sobre" class="btn btn-ghost">Nossa História</a>
      </div>
      <div class="hero-stats">
        <div class="stat"><span class="stat-num">2.400+</span><span class="stat-label">Discos</span></div>
        <div class="stat-divider"></div>
        <div class="stat"><span class="stat-num">180+</span><span class="stat-label">Artistas</span></div>
        <div class="stat-divider"></div>
        <div class="stat"><span class="stat-num">12</span><span class="stat-label">Gêneros</span></div>
      </div>
    </div>
  </section>

  <!-- DISCOS -->
  <section class="section discos-section" id="discos">
    <div class="container">
      <div class="section-header">
        <p class="section-eyebrow">◈ coleção curada</p>
        <h2 class="section-title">Discos em Destaque</h2>
        <p class="section-sub">Cada álbum é uma janela para outro tempo, outro lugar.</p>
      </div>
      <div class="discos-grid">

        <div class="disco-card" data-delay="0">
          <div class="disco-img-wrap">
            <div class="disco-cover" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 40%, #0f3460 100%);">
              <div class="cover-art cover-1">
                <div class="cover-circles"></div>
                <span class="cover-letter">TB</span>
              </div>
            </div>
            <div class="disco-hover-vinyl">
              <div class="mini-vinyl"></div>
            </div>
          </div>
          <div class="disco-info">
            <span class="disco-genre">Indie Rock</span>
            <h3 class="disco-album">The Dark Side of the Room</h3>
            <p class="disco-artist">Echo Chambers</p>
            <div class="disco-footer">
              <span class="disco-price">R$ 89,90</span>
              <button class="disco-btn">+ Detalhes</button>
            </div>
          </div>
        </div>

        <div class="disco-card" data-delay="1">
          <div class="disco-img-wrap">
            <div class="disco-cover" style="background: linear-gradient(135deg, #3d0c02 0%, #8b1a1a 50%, #c0392b 100%);">
              <div class="cover-art cover-2">
                <span class="cover-letter">VS</span>
              </div>
            </div>
            <div class="disco-hover-vinyl">
              <div class="mini-vinyl"></div>
            </div>
          </div>
          <div class="disco-info">
            <span class="disco-genre">Jazz</span>
            <h3 class="disco-album">Velvet Sessions Vol. 3</h3>
            <p class="disco-artist">Miles & The Quartet</p>
            <div class="disco-footer">
              <span class="disco-price">R$ 112,00</span>
              <button class="disco-btn">+ Detalhes</button>
            </div>
          </div>
        </div>

        <div class="disco-card featured" data-delay="2">
          <div class="disco-img-wrap">
            <div class="disco-cover" style="background: linear-gradient(135deg, #2c003e 0%, #7B2CBF 60%, #DCC9FF 100%);">
              <div class="cover-art cover-3">
                <div class="cover-rings"></div>
                <span class="cover-letter">NB</span>
              </div>
            </div>
            <div class="disco-hover-vinyl">
              <div class="mini-vinyl"></div>
            </div>
            <div class="disco-badge">✦ Destaque</div>
          </div>
          <div class="disco-info">
            <span class="disco-genre">MPB</span>
            <h3 class="disco-album">Noites de Bossa</h3>
            <p class="disco-artist">Clara Mendes</p>
            <div class="disco-footer">
              <span class="disco-price">R$ 97,50</span>
              <button class="disco-btn">+ Detalhes</button>
            </div>
          </div>
        </div>

        <div class="disco-card" data-delay="3">
          <div class="disco-img-wrap">
            <div class="disco-cover" style="background: linear-gradient(135deg, #0d2b1d 0%, #1a5c3a 50%, #27ae60 100%);">
              <div class="cover-art cover-4">
                <span class="cover-letter">GW</span>
              </div>
            </div>
            <div class="disco-hover-vinyl">
              <div class="mini-vinyl"></div>
            </div>
          </div>
          <div class="disco-info">
            <span class="disco-genre">Lo-fi</span>
            <h3 class="disco-album">Green Window Tapes</h3>
            <p class="disco-artist">Sunday Mornings</p>
            <div class="disco-footer">
              <span class="disco-price">R$ 74,00</span>
              <button class="disco-btn">+ Detalhes</button>
            </div>
          </div>
        </div>

        <div class="disco-card" data-delay="4">
          <div class="disco-img-wrap">
            <div class="disco-cover" style="background: linear-gradient(135deg, #1c1c1c 0%, #444 50%, #888 100%);">
              <div class="cover-art cover-5">
                <span class="cover-letter">CF</span>
              </div>
            </div>
            <div class="disco-hover-vinyl">
              <div class="mini-vinyl"></div>
            </div>
          </div>
          <div class="disco-info">
            <span class="disco-genre">Clássico</span>
            <h3 class="disco-album">Chuva de Flores</h3>
            <p class="disco-artist">Orquestra Paulista</p>
            <div class="disco-footer">
              <span class="disco-price">R$ 135,00</span>
              <button class="disco-btn">+ Detalhes</button>
            </div>
          </div>
        </div>

        <div class="disco-card" data-delay="5">
          <div class="disco-img-wrap">
            <div class="disco-cover" style="background: linear-gradient(135deg, #4a0030 0%, #c2185b 50%, #FF6BB5 100%);">
              <div class="cover-art cover-6">
                <span class="cover-letter">RN</span>
              </div>
            </div>
            <div class="disco-hover-vinyl">
              <div class="mini-vinyl"></div>
            </div>
          </div>
          <div class="disco-info">
            <span class="disco-genre">Rock</span>
            <h3 class="disco-album">Radio Nowhere</h3>
            <p class="disco-artist">The Static Fields</p>
            <div class="disco-footer">
              <span class="disco-price">R$ 88,00</span>
              <button class="disco-btn">+ Detalhes</button>
            </div>
          </div>
        </div>

      </div>
      <div class="ver-mais-wrap">
        <a href="#" class="btn btn-outline">Ver toda a coleção →</a>
      </div>
    </div>
  </section>

  <!-- CATEGORIAS -->
  <section class="section categorias-section" id="categorias">
    <div class="container">
      <div class="section-header">
        <p class="section-eyebrow">◈ explore por gênero</p>
        <h2 class="section-title">Categorias</h2>
      </div>
      <div class="categorias-grid">

        <div class="cat-card cat-rock">
          <div class="cat-icon">🎸</div>
          <h3>Rock</h3>
          <p>Clássicos e novos riffs que marcam épocas</p>
          <span class="cat-count">340 discos</span>
        </div>

        <div class="cat-card cat-jazz">
          <div class="cat-icon">🎷</div>
          <h3>Jazz</h3>
          <p>Improvisação, alma e a madrugada em nota</p>
          <span class="cat-count">210 discos</span>
        </div>

        <div class="cat-card cat-mpb">
          <div class="cat-icon">🌿</div>
          <h3>MPB</h3>
          <p>A alma brasileira em cada compasso</p>
          <span class="cat-count">280 discos</span>
        </div>

        <div class="cat-card cat-indie">
          <div class="cat-icon">✦</div>
          <h3>Indie</h3>
          <p>Sons independentes que viram movimento</p>
          <span class="cat-count">195 discos</span>
        </div>

        <div class="cat-card cat-classico">
          <div class="cat-icon">🎻</div>
          <h3>Clássicos</h3>
          <p>Obras que o tempo consagrou como eternas</p>
          <span class="cat-count">160 discos</span>
        </div>

        <div class="cat-card cat-lofi">
          <div class="cat-icon">🌙</div>
          <h3>Lo-fi</h3>
          <p>Texturas suaves para noites de contemplação</p>
          <span class="cat-count">175 discos</span>
        </div>

      </div>
    </div>
  </section>

  <!-- SOBRE -->
  <section class="section sobre-section" id="sobre">
    <div class="container sobre-inner">
      <div class="sobre-visual">
        <div class="sobre-img-frame">
          <div class="sobre-img-placeholder">
            <div class="sobre-vinyl-deco">
              <div class="sv-outer"></div>
              <div class="sv-mid"></div>
              <div class="sv-inner"></div>
              <div class="sv-label"></div>
            </div>
          </div>
          <div class="sobre-deco-tag">Est. 2019</div>
        </div>
        <div class="sobre-float-stat">
          <span class="float-num">98%</span>
          <span class="float-txt">de clientes que voltam</span>
        </div>
      </div>
      <div class="sobre-text">
        <p class="section-eyebrow">◈ nossa história</p>
        <h2 class="section-title left">Mais do que uma loja.<br /><em>Um lugar para pertencer.</em></h2>
        <p class="sobre-p">Nascemos de uma simples obsessão: a crença de que a música merece ser sentida, não apenas consumida. Num mundo de playlists infinitas e skip compulsivo, abrimos nossas portas para quem ainda acredita que virar o disco é um ritual sagrado.</p>
        <p class="sobre-p">Cada disco que chega aqui passa por nossas mãos, nossas orelhas, nosso coração. Não vendemos catálogo. Vendemos descobertas.</p>
        <div class="sobre-features">
          <div class="sf-item">
            <span class="sf-icon">◉</span>
            <div>
              <strong>Discos verificados</strong>
              <p>Todos testados em toca-discos antes de ir para a vitrine</p>
            </div>
          </div>
          <div class="sf-item">
            <span class="sf-icon">◈</span>
            <div>
              <strong>Curadoria afetiva</strong>
              <p>Nossa seleção vem de anos ouvindo, sentindo e colecionando</p>
            </div>
          </div>
          <div class="sf-item">
            <span class="sf-icon">✦</span>
            <div>
              <strong>Entrega com cuidado</strong>
              <p>Embalagem especial para que o disco chegue intacto e feliz</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- EXPERIÊNCIA -->
  <section class="section experiencia-section" id="experiencia">
    <div class="exp-noise"></div>
    <div class="container">
      <div class="section-header light">
        <p class="section-eyebrow light">◈ o ritual do vinil</p>
        <h2 class="section-title light">A Experiência de<br /><em>Ouvir de Verdade</em></h2>
      </div>
      <div class="exp-grid">

        <div class="exp-card exp-big">
          <div class="exp-card-bg exp-bg-1"></div>
          <div class="exp-card-content">
            <div class="exp-icon">♫</div>
            <blockquote class="exp-quote">"Existe um silêncio especial antes da agulha pousar no sulco. É o mundo segurando o fôlego."</blockquote>
            <p class="exp-author">— um colecionador anônimo</p>
          </div>
        </div>

        <div class="exp-card">
          <div class="exp-card-bg exp-bg-2"></div>
          <div class="exp-card-content">
            <div class="exp-icon">◯</div>
            <h3>O Ritual</h3>
            <p>Tirar o disco da capa. Sentir o peso. Limpar suavemente. Pousar a agulha. Esperar. Esse é o protocolo de quem sabe ouvir.</p>
          </div>
        </div>

        <div class="exp-card">
          <div class="exp-card-bg exp-bg-3"></div>
          <div class="exp-card-content">
            <div class="exp-icon">◎</div>
            <h3>A Imperfeição</h3>
            <p>O crepitar do vinil não é defeito. É a assinatura do tempo. É a prova de que aquela música já foi amada antes de você.</p>
          </div>
        </div>

        <div class="exp-card exp-wide">
          <div class="exp-card-bg exp-bg-4"></div>
          <div class="exp-card-content horizontal">
            <div>
              <div class="exp-icon">∿</div>
              <h3>Ondas que Ficam</h3>
            </div>
            <p>Streaming é água que escorre. Vinil é a água que você guarda numa garrafa e abre quando quer sentir aquele dia de novo.</p>
          </div>
        </div>

      </div>

      <div class="exp-soundwave">
            <img src="imagens/logo.png" alt="Logo T+AMQD, Tenho mais amigos que discos">
      </div>
    </div>
  </section>

  <!-- NEWSLETTER / CTA -->
  <section class="section cta-section">
    <div class="container cta-inner">
      <div class="cta-vinyl-deco">◉</div>
      <h2 class="cta-title">Quer saber quando chegam<br /><em>novos discos?</em></h2>
      <p class="cta-sub">Junte-se à nossa lista e seja o primeiro a saber quando aquele álbum que você procura aparece na vitrine.</p>
      <div class="cta-form">
        <input type="email" class="cta-input" placeholder="seu@email.com" />
        <button class="btn btn-primary">Me avisa ✦</button>
      </div>
      <p class="cta-fine">Sem spam. Só música. Prometemos.</p>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer" id="contato">
    <div class="footer-top-wave">
      <svg viewBox="0 0 1440 60" preserveAspectRatio="none">
        <path d="M0,30 C480,60 960,0 1440,30 L1440,0 L0,0 Z" fill="#F8F5FF"/>
      </svg>
    </div>
    <div class="container footer-inner">

      <div class="footer-brand">
        <div class="footer-logo">
          <span class="logo-icon">◉</span>
          <span>Tenho Mais Amigos<br />Que Discos</span>
        </div>
        <p class="footer-tagline">Porque música em vinil não é nostalgia. É resistência.</p>
        <div class="footer-socials">
          <a href="#" class="social-link" aria-label="Instagram">IG</a>
          <a href="#" class="social-link" aria-label="Spotify">SP</a>
          <a href="#" class="social-link" aria-label="YouTube">YT</a>
          <a href="#" class="social-link" aria-label="TikTok">TK</a>
        </div>
      </div>

      <div class="footer-nav">
        <h4>Explore</h4>
        <ul>
          <li><a href="#discos">Discos em Destaque</a></li>
          <li><a href="#categorias">Categorias</a></li>
          <li><a href="#sobre">Nossa História</a></li>
          <li><a href="#experiencia">A Experiência</a></li>
        </ul>
      </div>

      <div class="footer-nav">
        <h4>Gêneros</h4>
        <ul>
          <li><a href="#">Rock &amp; Blues</a></li>
          <li><a href="#">Jazz &amp; Soul</a></li>
          <li><a href="#">MPB &amp; Bossa</a></li>
          <li><a href="#">Indie &amp; Lo-fi</a></li>
          <li><a href="#">Clássicos</a></li>
        </ul>
      </div>

      <div class="footer-contact">
        <h4>Fale Conosco</h4>
        <div class="contact-item">
          <span class="ci-icon">☎</span>
          <a href="tel:+5511945671984">(11) 94567-1984</a>
        </div>
        <div class="contact-item">
          <span class="ci-icon">✉</span>
          <a href="mailto:contato@tenhomaisamigosquediscos.com">contato@tenhomaisamigosquediscos.com</a>
        </div>
        <div class="contact-item">
          <span class="ci-icon">◎</span>
          <address>
            Rua Marechal Zhukov, 1917<br />
            Bairro Leningrado<br />
            Distrito Operário Vladimir Ilyich<br />
            Jundiaí – SP | CEP: 13313-CCCP
          </address>
        </div>
      </div>

    </div>
    <div class="footer-bottom">
      <div class="container">
        <p>© 2024 Tenho Mais Amigos Que Discos. Feito com amor e muito vinil.</p>
        <p class="footer-fine">Todos os direitos reservados ao lado A e ao lado B.</p>
      </div>
    </div>
  </footer>

  <div class="scroll-top" id="scrollTop" aria-label="Voltar ao topo">◉</div>

  <script src="script.js"></script>
</body>
</html>