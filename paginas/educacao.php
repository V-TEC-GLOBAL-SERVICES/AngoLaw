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
      <div class="video-player__bg"></div>
      <div class="video-player__content">
        <div class="video-player__play-btn">
          <i class="fa-solid fa-play" style="margin-left:3px;font-size:1.2rem"></i>
        </div>
        <h2 class="video-player__title">Conheça os seus Direitos como Consumidor</h2>
        <p class="video-player__desc">Aprenda sobre devoluções, garantias e reclamações de forma simples e prática.</p>
        <span class="video-player__duration"><i class="fa-regular fa-clock" style="margin-right:5px"></i>12:45</span>
      </div>
    </div>

    <!-- Playlist -->
    <div class="playlist">
      <div class="playlist__header">Playlist · 3 vídeos</div>

      <div class="playlist__item playlist__item--active">
        <div class="playlist__icon">
          <i class="fa-solid fa-play" style="font-size:.75rem"></i>
        </div>
        <div class="playlist__info">
          <div class="playlist__title">Conheça os seus Direitos como Consumidor</div>
          <div class="playlist__meta">
            <span class="playlist__cat">Direitos do Consumidor</span>
            <span class="playlist__dur">· 12:45</span>
          </div>
        </div>
      </div>

      <div class="playlist__item">
        <div class="playlist__icon">
          <i class="fa-solid fa-play" style="font-size:.75rem"></i>
        </div>
        <div class="playlist__info">
          <div class="playlist__title">Como Ler e Entender um Contrato</div>
          <div class="playlist__meta">
            <span class="playlist__cat">Contratos</span>
            <span class="playlist__dur">· 18:30</span>
          </div>
        </div>
      </div>

      <div class="playlist__item">
        <div class="playlist__icon">
          <i class="fa-solid fa-play" style="font-size:.75rem"></i>
        </div>
        <div class="playlist__info">
          <div class="playlist__title">IRS e IRC: O Básico que Deve Saber</div>
          <div class="playlist__meta">
            <span class="playlist__cat">Fiscal e Tributário</span>
            <span class="playlist__dur">· 15:20</span>
          </div>
        </div>
      </div>
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

    <article class="article-card">
      <div class="article-card__top">
        <span class="tag tag--consumer">Direitos do Consumidor</span>
        <span class="article-card__read"><i class="fa-regular fa-clock" style="font-size:.7rem"></i> 5 min</span>
      </div>
      <h3 class="article-card__title">Direito de Devolução: O Que Precisa Saber</h3>
      <p class="article-card__desc">Conheça os seus direitos ao devolver produtos comprados online ou em loja física. Prazos, exceções e como reclamar.</p>
    </article>

    <article class="article-card">
      <div class="article-card__top">
        <span class="tag tag--contracts">Contratos</span>
        <span class="article-card__read"><i class="fa-regular fa-clock" style="font-size:.7rem"></i> 8 min</span>
      </div>
      <h3 class="article-card__title">Contratos de Arrendamento: Guia Essencial</h3>
      <p class="article-card__desc">Tudo sobre contratos de arrendamento: tipos, duração, direitos e deveres do senhorio e inquilino.</p>
    </article>

    <article class="article-card">
      <div class="article-card__top">
        <span class="tag tag--fiscal">Fiscal e Tributário</span>
        <span class="article-card__read"><i class="fa-regular fa-clock" style="font-size:.7rem"></i> 6 min</span>
      </div>
      <h3 class="article-card__title">IRS: Deduções Que Pode Estar a Perder</h3>
      <p class="article-card__desc">Descubra todas as deduções fiscais disponíveis no IRS e como maximizar o seu reembolso.</p>
    </article>

    <article class="article-card">
      <div class="article-card__top">
        <span class="tag tag--blue">Constituição</span>
        <span class="article-card__read"><i class="fa-regular fa-clock" style="font-size:.7rem"></i> 7 min</span>
      </div>
      <h3 class="article-card__title">Direitos Fundamentais: O Que a Constituição Garante</h3>
      <p class="article-card__desc">Os direitos fundamentais previstos na Constituição e como podem ser exercidos no dia a dia.</p>
    </article>

    <article class="article-card">
      <div class="article-card__top">
        <span class="tag tag--compliance">Compliance</span>
        <span class="article-card__read"><i class="fa-regular fa-clock" style="font-size:.7rem"></i> 9 min</span>
      </div>
      <h3 class="article-card__title">RGPD: Obrigações Essenciais Para Empresas</h3>
      <p class="article-card__desc">O que a sua empresa precisa fazer para cumprir o RGPD. Guia prático com as obrigações principais.</p>
    </article>

    <article class="article-card">
      <div class="article-card__top">
        <span class="tag tag--teal">Registo</span>
        <span class="article-card__read"><i class="fa-regular fa-clock" style="font-size:.7rem"></i> 10 min</span>
      </div>
      <h3 class="article-card__title">Como Registar Uma Empresa: Passo a Passo</h3>
      <p class="article-card__desc">Guia completo para criar e registar uma empresa. Da escolha da forma jurídica ao registo comercial.</p>
    </article>

  </div>
</section>

<script src="scripts/main.js"></script>