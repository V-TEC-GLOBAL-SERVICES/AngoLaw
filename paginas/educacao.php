<link rel="stylesheet" href="estilos/educacao.css" />

<!-- ── Featured Video + Playlist ── -->
<section class="section">
  <div class="section__header">
    <div>
      <h2 class="section__title"><i class="fa-solid fa-circle-play" style="color:var(--accent-gold);margin-right:8px;font-size:1.2rem"></i>Vídeo em Destaque</h2>
    </div>
  </div>

  <div class="video-featured">
    <!-- Player -->
    <div class="video-player">
      <?php if (isset($_GET['ref']) && is_string(base64_decode($_GET['ref']))) { ?>
        <iframe class="video-player__content" src="<?= base64_decode($_GET['ref']) ?>" frameborder="0" style="width: 100%;height: 100%;"></iframe>
      <?php } else { ?>
        <div class="video-player__bg"></div>
        <div class="video-player__content">
          <div class="video-player__play-btn">
            <i class="fa-solid fa-play" style="margin-left:3px;font-size:1.2rem"></i>
          </div>
          <h2 class="video-player__title">Conheça os seus Direitos como Consumidor</h2>
          <p class="video-player__desc">Aprenda sobre devoluções, garantias e reclamações de forma simples e prática.</p>
          <span class="video-player__duration"><i class="fa-regular fa-clock" style="margin-right:5px"></i>12:45</span>
        </div>
      <?php } ?>
    </div>

    <!-- Playlist -->
    <div class="playlist">
      <div class="playlist__header">Playlist</div>

      <?php if (buscaTotal("SELECT * FROM `playlists` ORDER BY `id`", $connect)) {
        $cont = 0;
        foreach (busca("SELECT * FROM `playlists` ORDER BY `id` DESC", $connect) as $dados) { ?>
          <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=<?= $_GET['sub'] ?>&ref=<?= base64_encode($dados['url']) ?>" class="playlist__item <?= (base64_decode($_GET['ref'] ?? '0')) == $dados['url'] ? 'playlist__item--active' : '' ?>">
            <div class="playlist__icon">
              <i class="fa-solid fa-play" style="font-size:.75rem"></i>
            </div>
            <div class="playlist__info">
              <div class="playlist__title"><?= htmlspecialchars($dados['titulo']) ?></div>
              <div class="playlist__meta">
                <span class="playlist__cat"><?= htmlspecialchars($dados['descricao']) ?></span>
                <span class="playlist__dur"><?= htmlspecialchars($dados['data']) ?></span>
              </div>
            </div>
          </a>
      <?php  }
      } else {
        echo "<strong>Nenhuma playlist encontrada!!!</strong>";
      } ?>


    </div>
  </div>
</section>

<!-- ── Themes ── -->
<section class="section">
  <div class="section__header">
    <div>
      <h2 class="section__title"><i class="fa-solid fa-book" style="color:var(--accent-gold);margin-right:8px;font-size:1.1rem"></i>Temas On-Demand</h2>
      <p class="section__subtitle">Explore por área jurídica</p>
    </div>
    <a href="#" class="section__link">Explorar por categoria →</a>
  </div>

  <div class="themes-grid">
    <div class="theme-card theme-card--blue">
      <div class="theme-card__icon">🛡️</div>
      <div class="theme-card__title">Direitos do Consumidor</div>
      <div class="theme-card__count">12 artigos</div>
    </div>
    <div class="theme-card theme-card--green">
      <div class="theme-card__icon">📝</div>
      <div class="theme-card__title">Contratos e Acordos</div>
      <div class="theme-card__count">8 artigos</div>
    </div>
    <div class="theme-card theme-card--amber">
      <div class="theme-card__icon">💰</div>
      <div class="theme-card__title">Fiscal e Tributário</div>
      <div class="theme-card__count">10 artigos</div>
    </div>
    <div class="theme-card theme-card--purple">
      <div class="theme-card__icon">⚖️</div>
      <div class="theme-card__title">Constituição e Direitos</div>
      <div class="theme-card__count">6 artigos</div>
    </div>
  </div>
</section>

<!-- ── Articles ── -->
<section class="section">
  <div class="section__header">
    <div>
      <h2 class="section__title">Artigos Jurídicos</h2>
      <p class="section__subtitle">Leituras essenciais para o seu dia a dia</p>
    </div>
  </div>

  <!-- Toolbar: search + filters -->
  <div class="articles-toolbar">
    <div class="search-bar" style="max-width:320px">
      <i class="fa-solid fa-magnifying-glass" style="color:var(--text-muted);font-size:.85rem"></i>
      <input type="text" placeholder="Pesquisar artigos..." class="search-bar__input" />
    </div>
    <div class="filter-tabs">
      <button class="filter-tab filter-tab--active">Todos</button>
      <button class="filter-tab">Direitos do Consumidor</button>
      <button class="filter-tab">Contratos</button>
      <button class="filter-tab">Fiscal e Tributário</button>
      <button class="filter-tab">Constituição</button>
      <button class="filter-tab">Compliance</button>
      <button class="filter-tab">Registo</button>
    </div>
  </div>

  <div class="articles-grid">
    <?php if (buscaTotal("SELECT * FROM `artigos` ORDER BY `id`", $connect)) {
      foreach (busca("SELECT * FROM `artigos` ORDER BY `id` DESC", $connect) as $dados) { ?>
        <article class="article-card">
          <div class="article-card__top">
            <span class="tag tag--contracts"><?= htmlspecialchars($dados['categoria']) ?></span>
            <span class="article-card__read"><i class="fa-regular fa-clock" style="font-size:.7rem"></i> <?= htmlspecialchars($dados['data']) ?></span>
          </div>
          <h3 class="article-card__title"><?= htmlspecialchars($dados['titulo']) ?></h3>
          <p class="article-card__desc"><?= htmlspecialchars($dados['descricao']) ?></p>
        </article>
    <?php  }
    } else {
      echo "<strong>Nenhum artigo encontrado!!!</strong>";
    } ?>
  </div>
</section>

<script src="scripts/main.js"></script>