<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Assistente IA · AngoLaw</title>
  <link rel="stylesheet" href="estilos/imports.css" />
  <link rel="stylesheet" href="estilos/assistente.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <div class="sidebar-overlay"></div>

  <!-- ===== SIDEBAR ===== -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar__logo">
      <div class="sidebar__logo-icon"><i class="fa-solid fa-scale-balanced"></i></div>
      <span class="sidebar__logo-text">AngoLaw</span>
    </div>
    <nav class="sidebar__nav">
      <p class="sidebar__nav-label">Menu</p>
      <ul class="sidebar__menu">
        <li class="sidebar__menu-item"><a href="index.html" class="sidebar__menu-link"><span class="sidebar__menu-icon"><i class="fa-solid fa-house"></i></span><span class="sidebar__menu-text">Início</span></a></li>
        <li class="sidebar__menu-item"><a href="educacao.html" class="sidebar__menu-link"><span class="sidebar__menu-icon"><i class="fa-solid fa-book-open"></i></span><span class="sidebar__menu-text">Educação Jurídica</span></a></li>
        <li class="sidebar__menu-item"><a href="documentos.html" class="sidebar__menu-link"><span class="sidebar__menu-icon"><i class="fa-solid fa-file-lines"></i></span><span class="sidebar__menu-text">Documentos</span></a></li>
        <li class="sidebar__menu-item sidebar__menu-item--active"><a href="assistente.html" class="sidebar__menu-link"><span class="sidebar__menu-icon"><i class="fa-solid fa-robot"></i></span><span class="sidebar__menu-text">Assistente IA</span></a></li>
        <li class="sidebar__menu-item"><a href="consultas.html" class="sidebar__menu-link"><span class="sidebar__menu-icon"><i class="fa-solid fa-calendar-check"></i></span><span class="sidebar__menu-text">Consultas</span></a></li>
        <li class="sidebar__menu-item"><a href="regulador.html" class="sidebar__menu-link"><span class="sidebar__menu-icon"><i class="fa-solid fa-shield-halved"></i></span><span class="sidebar__menu-text">Regulador</span></a></li>
      </ul>
    </nav>
    <div class="sidebar__footer">
      <div class="sidebar__user">
        <div class="sidebar__user-avatar">JA</div>
        <div class="sidebar__user-info">
          <span class="sidebar__user-name">João Antunes</span>
          <span class="sidebar__user-role">Plano Pro</span>
        </div>
      </div>
    </div>
  </aside>

  <!-- ===== MAIN ===== -->
  <main class="main">

    <header class="topbar">
      <div class="topbar__left">
        <button class="topbar__toggle" data-sidebar-toggle><i class="fa-solid fa-bars"></i></button>
        <div class="topbar__breadcrumb">
          <h1 class="topbar__title">Assistente IA</h1>
          <p class="topbar__subtitle">Consultor jurídico inteligente disponível 24/7</p>
        </div>
      </div>
      <div class="topbar__right">
        <div class="user-btn">
          <div class="user-btn__avatar">JA</div>
          <span class="user-btn__name">João Antunes</span>
        </div>
      </div>
    </header>

    <!-- Chat Layout -->
    <div class="chat-layout">

      <!-- Chat Main -->
      <div class="chat-main">

        <!-- Chat header -->
        <div class="chat-header">
          <div class="chat-header__avatar">
            <i class="fa-solid fa-robot" style="font-size:1.1rem"></i>
          </div>
          <div class="chat-header__info">
            <div class="chat-header__name">JurisBot · Assistente Jurídico</div>
            <div class="chat-header__status">Online · Disponível</div>
          </div>
          <button class="btn btn--ghost btn--sm"><i class="fa-solid fa-rotate-right" style="margin-right:5px"></i>Nova conversa</button>
        </div>

        <!-- Messages -->
        <div id="chat-messages">

          <!-- Initial assistant message -->
          <div class="chat__message chat__message--assistant">
            <div class="chat__bubble">
              <p><strong>Olá! Sou o JurisBot, o seu assistente jurídico inteligente.</strong></p>
              <p>Estou aqui para responder às suas dúvidas sobre direito português de forma simples e acessível. Pode perguntar-me sobre:</p>
              <p><span class="chat__bullet">•</span> Direitos do consumidor<br><span class="chat__bullet">•</span> Contratos e acordos<br><span class="chat__bullet">•</span> Impostos e questões fiscais<br><span class="chat__bullet">•</span> Criação de empresas<br><span class="chat__bullet">•</span> Arrendamento e imóveis<br><span class="chat__bullet">•</span> RGPD e proteção de dados</p>
              <p>⚠️ <em>Lembre-se: as minhas respostas são informativas e não substituem aconselhamento jurídico profissional.</em></p>
            </div>
          </div>

        </div>

        <!-- Input area -->
        <div class="chat-input-area">
          <form id="chat-form">
            <textarea
              id="chat-input"
              placeholder="Escreva a sua dúvida jurídica aqui... (Enter para enviar)"
              rows="1"
            ></textarea>
            <button type="submit" class="chat-send-btn" aria-label="Enviar">
              <i class="fa-solid fa-paper-plane" style="font-size:.85rem"></i>
            </button>
          </form>
        </div>

      </div>

      <!-- Chat sidebar -->
      <div class="chat-sidebar">

        <div class="chat-info-card">
          <div class="chat-info-card__title">Sugestões rápidas</div>
          <div class="suggestions-list">
            <button class="suggestion-chip" data-suggestion="Quais são os meus direitos como consumidor?">
              🛒 Direitos do consumidor
            </button>
            <button class="suggestion-chip" data-suggestion="Como funciona um contrato de arrendamento?">
              🏠 Contrato de arrendamento
            </button>
            <button class="suggestion-chip" data-suggestion="Como declarar o IRS? Quais deduções posso usar?">
              💰 Impostos e IRS
            </button>
            <button class="suggestion-chip" data-suggestion="Como criar uma empresa em Portugal?">
              🏢 Criar uma empresa
            </button>
            <button class="suggestion-chip" data-suggestion="O que é o RGPD e quais os meus direitos?">
              🔒 RGPD e privacidade
            </button>
          </div>
        </div>

        <div class="chat-info-card">
          <div class="chat-info-card__title">Tópicos populares</div>
          <div style="display:flex;flex-direction:column;gap:6px">
            <div style="display:flex;align-items:center;gap:8px;font-size:.82rem;color:var(--text-secondary)">
              <i class="fa-solid fa-fire" style="color:var(--red-500);font-size:.75rem"></i> Rescisão de contrato de trabalho
            </div>
            <div style="display:flex;align-items:center;gap:8px;font-size:.82rem;color:var(--text-secondary)">
              <i class="fa-solid fa-fire" style="color:var(--red-500);font-size:.75rem"></i> Prazo de garantia de produtos
            </div>
            <div style="display:flex;align-items:center;gap:8px;font-size:.82rem;color:var(--text-secondary)">
              <i class="fa-solid fa-arrow-trend-up" style="color:var(--green-500);font-size:.75rem"></i> Direito ao esquecimento RGPD
            </div>
            <div style="display:flex;align-items:center;gap:8px;font-size:.82rem;color:var(--text-secondary)">
              <i class="fa-solid fa-arrow-trend-up" style="color:var(--green-500);font-size:.75rem"></i> IRS jovem 2025
            </div>
          </div>
        </div>

        <div class="disclaimer">
          <strong>⚠️ Aviso Legal</strong><br>
          O JurisBot fornece informação geral de carácter educativo. Para casos específicos, consulte sempre um advogado qualificado através da secção <strong>Consultas</strong>.
        </div>

        <a href="consultas.html" class="btn btn--primary btn--full">
          <i class="fa-solid fa-calendar-check"></i> Agendar Consulta Real
        </a>

      </div>

    </div>

  </main>

  <script src="scripts/main.js"></script>
  <script src="scripts/assistant.js"></script>
</body>
</html>
