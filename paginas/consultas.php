<link rel="stylesheet" href="estilos/consultas.css" />
<style>
  /* ══ Improved Lawyer Modal ══════════════════════════ */
  .lmodal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(11, 19, 37, .55);
    z-index: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(5px);
    opacity: 0;
    pointer-events: none;
    transition: opacity .25s ease;
  }

  .lmodal-overlay.active {
    opacity: 1;
    pointer-events: all;
  }

  .lmodal {
    background: var(--bg-card);
    border-radius: 20px;
    box-shadow: 0 24px 60px rgba(11, 19, 37, .22), 0 8px 20px rgba(11, 19, 37, .12);
    width: 100%;
    max-width: 580px;
    max-height: 90vh;
    overflow-y: auto;
    transform: translateY(22px) scale(.97);
    transition: transform .28s cubic-bezier(.34, 1.2, .64, 1);
  }

  .lmodal-overlay.active .lmodal {
    transform: translateY(0) scale(1);
  }

  /* Banner top */
  .lmodal__banner {
    height: 110px;
    position: relative;
    border-radius: 20px 20px 0 0;
    overflow: hidden;
  }

  .lmodal__banner--blue {
    background: linear-gradient(135deg, #1a3a6e 0%, #2d5fa6 100%);
  }

  .lmodal__banner--green {
    background: linear-gradient(135deg, #1a5c3a 0%, #28855a 100%);
  }

  .lmodal__banner--purple {
    background: linear-gradient(135deg, #4a1c6e 0%, #7c3aed 100%);
  }

  .lmodal__banner--amber {
    background: linear-gradient(135deg, #7c3a00 0%, #c47a1e 100%);
  }

  .lmodal__banner--teal {
    background: linear-gradient(135deg, #0d4a4a 0%, #0d9488 100%);
  }

  .lmodal__banner--navy {
    background: linear-gradient(135deg, #0f1b35 0%, #243b6e 100%);
  }

  /* pattern overlay */
  .lmodal__banner::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(255, 255, 255, .04) 20px, rgba(255, 255, 255, .04) 21px);
  }

  .lmodal__close {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 10;
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: rgba(255, 255, 255, .15);
    border: 1px solid rgba(255, 255, 255, .2);
    cursor: pointer;
    color: #fff;
    font-size: .8rem;
    display: grid;
    place-items: center;
    transition: background .2s;
  }

  .lmodal__close:hover {
    background: rgba(255, 255, 255, .28);
  }

  /* Avatar floated on banner */
  .lmodal__avatar {
    position: absolute;
    bottom: -30px;
    left: 28px;
    z-index: 2;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    border: 4px solid var(--bg-card);
    background: linear-gradient(135deg, var(--accent-gold) 0%, #e8c97a 100%);
    display: grid;
    place-items: center;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--navy-900);
    box-shadow: 0 4px 14px rgba(11, 19, 37, .18);
  }

  /* Verified badge */
  .lmodal__verified {
    position: absolute;
    bottom: -30px;
    left: 74px;
    z-index: 3;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--green-500, #22c55e);
    border: 3px solid var(--bg-card);
    display: grid;
    place-items: center;
    color: #fff;
    font-size: .55rem;
  }

  /* Body */
  .lmodal__body {
    padding: 44px 28px 24px;
  }

  .lmodal__name {
    font-family: 'DM Serif Display', serif;
    font-size: 1.4rem;
    color: var(--text-primary);
    letter-spacing: -.01em;
    margin-bottom: 3px;
  }

  .lmodal__spec {
    font-size: .88rem;
    color: var(--text-muted);
    margin-bottom: 12px;
  }

  .lmodal__rating-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
    flex-wrap: wrap;
  }

  .lmodal__stars {
    color: var(--accent-gold);
    font-size: .95rem;
    letter-spacing: 1px;
  }

  .lmodal__rating-val {
    font-size: .88rem;
    font-weight: 700;
    color: var(--text-primary);
  }

  .lmodal__rating-count {
    font-size: .8rem;
    color: var(--text-muted);
  }

  .lmodal__tags {
    display: flex;
    gap: 7px;
    flex-wrap: wrap;
    margin-bottom: 18px;
  }

  .lmodal__tag {
    padding: 4px 11px;
    border-radius: 20px;
    font-size: .74rem;
    font-weight: 600;
    background: var(--bg-page);
    border: 1px solid var(--border);
    color: var(--text-secondary);
  }

  /* Info grid */
  .lmodal__info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 22px;
  }

  .lmodal__info-item {
    display: flex;
    align-items: center;
    gap: 9px;
    background: var(--bg-page);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 11px 13px;
  }

  .lmodal__info-item i {
    color: var(--text-muted);
    font-size: .85rem;
    flex-shrink: 0;
  }

  .lmodal__info-text {
    display: flex;
    flex-direction: column;
  }

  .lmodal__info-label {
    font-size: .68rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: .05em;
  }

  .lmodal__info-val {
    font-size: .85rem;
    font-weight: 600;
    color: var(--text-primary);
  }

  /* Bio */
  .lmodal__section-title {
    font-size: .75rem;
    font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-bottom: 9px;
  }

  .lmodal__bio {
    font-size: .88rem;
    color: var(--text-secondary);
    line-height: 1.65;
    margin-bottom: 22px;
  }

  /* Time slots */
  .lmodal__slots {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-bottom: 24px;
  }

  .lmodal__slot {
    padding: 9px 6px;
    text-align: center;
    border: 1.5px solid var(--border);
    border-radius: 9px;
    font-size: .8rem;
    font-weight: 500;
    color: var(--text-secondary);
    cursor: pointer;
    background: var(--bg-card);
    transition: all .18s;
  }

  .lmodal__slot:hover,
  .lmodal__slot.selected {
    background: var(--navy-900);
    color: #fff;
    border-color: var(--navy-900);
    transform: translateY(-1px);
  }

  /* Price strip */
  .lmodal__price-strip {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--bg-page);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 14px 18px;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
  }

  .lmodal__price-label {
    font-size: .8rem;
    color: var(--text-muted);
  }

  .lmodal__price-val {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--navy-900);
  }

  .lmodal__price-note {
    font-size: .75rem;
    color: var(--text-muted);
  }

  /* Footer */
  .lmodal__footer {
    display: flex;
    gap: 10px;
    padding: 16px 28px 24px;
    border-top: 1px solid var(--border);
  }

  @media (max-width: 580px) {
    .lmodal__info-grid {
      grid-template-columns: 1fr;
    }

    .lmodal__slots {
      grid-template-columns: repeat(2, 1fr);
    }

    .lmodal__body {
      padding: 44px 20px 20px;
    }

    .lmodal__footer {
      padding: 14px 20px 20px;
      flex-direction: column;
    }
  }
</style>

<div class="stats-strip">
  <div class="stat-item"><span class="stat-item__number">35</span><span class="stat-item__label">Advogados parceiros</span></div>
  <div class="stat-divider"></div>
  <div class="stat-item"><span class="stat-item__number">4.8★</span><span class="stat-item__label">Avaliação média</span></div>
  <div class="stat-divider"></div>
  <div class="stat-item"><span class="stat-item__number">48h</span><span class="stat-item__label">Resposta garantida</span></div>
  <div class="stat-divider"></div>
  <div class="stat-item"><span class="stat-item__number">Online</span><span class="stat-item__label">Consultas por videochamada</span></div>
</div>

<div style="margin-bottom:28px">
  <div class="filter-tabs">
    <button class="filter-tab filter-tab--active">Todos</button>
    <button class="filter-tab">Direito Civil</button>
    <button class="filter-tab">Direito do Trabalho</button>
    <button class="filter-tab">Direito Fiscal</button>
    <button class="filter-tab">Direito Imobiliário</button>
    <button class="filter-tab">Direito Empresarial</button>
    <button class="filter-tab">Direito de Família</button>
  </div>
</div>

<section class="section">
  <div class="section__header">
    <div>
      <h2 class="section__title">Advogados Disponíveis</h2>
      <p class="section__subtitle">Selecione um advogado para ver o perfil e agendar</p>
    </div>
  </div>

  <div class="lawyers-grid">
    <?php if (buscaTotal("SELECT * FROM `usuarios` WHERE `acesso`='Advogado' ORDER BY `id`", $connect)) {
      foreach (busca("SELECT * FROM `usuarios` WHERE `acesso`='Advogado' ORDER BY `id` DESC", $connect) as $dados) { ?>
        <div class="lawyer-card">
          <div class="lawyer-card__banner lawyer-card__banner--blue">
            <div class="lawyer-card__avatar"><?= htmlspecialchars(str_split($dados['nome'])['0']) ?></div>
          </div>
          <div class="lawyer-card__body">
            <div class="lawyer-card__name"><?= htmlspecialchars($dados['nome']) ?></div>
            <div class="lawyer-card__spec"><?= htmlspecialchars($dados['profissao']) ?></div>
            <!-- <div class="lawyer-card__rating">
              <div class="stars">★★★★★</div><span class="lawyer-card__rating-value">4.9</span><span class="lawyer-card__rating-count">(127 avaliações)</span>
            </div> -->
            <div class="lawyer-card__details">
              <div class="lawyer-card__detail"><i class="fa-solid fa-location-dot"></i><?= htmlspecialchars($dados['localizacao']) ?></div>
              <div class="lawyer-card__detail"><i class="fa-solid fa-graduation-cap"></i><?= htmlspecialchars($dados['experiencia']) ?></div>
              <div class="lawyer-card__detail"><i class="fa-solid fa-video"></i><?= htmlspecialchars($dados['modalidade']) ?></div>
            </div>
          </div>
          <div class="lawyer-card__footer">
            <div class="lawyer-card__price">a partir de <strong><?= htmlspecialchars(formatarMoeda($dados['valor_consulta'])) ?></strong></div>
            <button class="btn btn--primary btn--sm" onclick="openModal('m1')">Ver Perfil</button>
          </div>
        </div>
    <?php  }
    } else {
      echo "<strong>Nenhum advogado encontrado!!!</strong>";
    } ?>
  </div>
</section>

<!-- ═══════════════ IMPROVED MODALS ═══════════════ -->

<!-- Modal 1 – Mariana Silva -->
<?php
if (isset($_POST['verPerfil'])) {
?>
<div class="lmodal-overlay" id="m1">
  <div class="lmodal">
    <div class="lmodal__banner lmodal__banner--blue">
      <button class="lmodal__close" onclick="closeModal('m1')"><i class="fa-solid fa-xmark"></i></button>
      <div class="lmodal__avatar">MS</div>
      <div class="lmodal__verified"><i class="fa-solid fa-check"></i></div>
    </div>
    <div class="lmodal__body">
      <h2 class="lmodal__name">Dra. Mariana Silva</h2>
      <p class="lmodal__spec">Advogada — Direito Civil · Contratos · Arrendamento</p>
      <div class="lmodal__rating-row">
        <span class="lmodal__stars">★★★★★</span>
        <span class="lmodal__rating-val">4.9</span>
        <span class="lmodal__rating-count">· 127 avaliações verificadas</span>
        <span class="tag tag--green" style="font-size:.7rem">Verificada</span>
      </div>
      <div class="lmodal__tags">
        <span class="lmodal__tag">Contratos</span>
        <span class="lmodal__tag">Arrendamento</span>
        <span class="lmodal__tag">Direito Civil</span>
        <span class="lmodal__tag">Vizinhança</span>
      </div>
      <div class="lmodal__info-grid">
        <div class="lmodal__info-item"><i class="fa-solid fa-location-dot"></i>
          <div class="lmodal__info-text"><span class="lmodal__info-label">Localização</span><span class="lmodal__info-val">Lisboa, Portugal</span></div>
        </div>
        <div class="lmodal__info-item"><i class="fa-solid fa-graduation-cap"></i>
          <div class="lmodal__info-text"><span class="lmodal__info-label">Experiência</span><span class="lmodal__info-val">12 anos</span></div>
        </div>
        <div class="lmodal__info-item"><i class="fa-solid fa-university"></i>
          <div class="lmodal__info-text"><span class="lmodal__info-label">Formação</span><span class="lmodal__info-val">FD — Univ. Lisboa</span></div>
        </div>
        <div class="lmodal__info-item"><i class="fa-solid fa-video"></i>
          <div class="lmodal__info-text"><span class="lmodal__info-label">Modalidade</span><span class="lmodal__info-val">Online e Presencial</span></div>
        </div>
      </div>
      <div class="lmodal__section-title">Sobre a advogada</div>
      <p class="lmodal__bio">Especializada em Direito Civil com foco em contratos, arrendamento urbano e relações de vizinhança. Licenciada pela Faculdade de Direito da Universidade de Lisboa, membro da Ordem dos Advogados desde 2013. Autora de vários artigos sobre arrendamento urbano em publicações jurídicas nacionais.</p>
      <div class="lmodal__price-strip">
        <div>
          <div class="lmodal__price-label">Valor da consulta</div>
          <div class="lmodal__price-val"><?= htmlspecialchars(formatarMoeda($dados['valor_consulta'])) ?> <small style="font-size:.75rem;font-weight:400;color:var(--text-muted)">/hora</small></div>
        </div>
        <div style="text-align:right">
          <div class="lmodal__price-note">Primeira consulta</div>
          <div style="font-size:.88rem;font-weight:700;color:var(--green-600,#16a34a)"><?= htmlspecialchars(formatarMoeda($dados['desconto'])) ?></div>
        </div>
      </div>
      <div class="lmodal__section-title">Horários disponíveis esta semana</div>
      <div class="lmodal__slots">
        <div class="lmodal__slot" onclick="selectSlot(this)">Seg 10:00</div>
        <div class="lmodal__slot" onclick="selectSlot(this)">Seg 14:30</div>
        <div class="lmodal__slot" onclick="selectSlot(this)">Ter 09:30</div>
        <div class="lmodal__slot" onclick="selectSlot(this)">Qua 11:00</div>
        <div class="lmodal__slot" onclick="selectSlot(this)">Qui 15:00</div>
        <div class="lmodal__slot" onclick="selectSlot(this)">Sex 10:30</div>
      </div>
    </div>
    <div class="lmodal__footer">
      <button class="btn btn--outline" onclick="closeModal('m1')" style="flex:1">Fechar</button>
      <button class="btn btn--primary" style="flex:2"><i class="fa-solid fa-calendar-plus" style="margin-right:6px"></i>Agendar Consulta</button>
    </div>
  </div>
</div>
<?php
}
?>

<script src="scripts/main.js"></script>
<script>
  function openModal(id) {
    document.getElementById(id).classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(id) {
    document.getElementById(id).classList.remove('active');
    document.body.style.overflow = '';
  }
  // Close on backdrop click
  document.querySelectorAll('.lmodal-overlay').forEach(el => {
    el.addEventListener('click', e => {
      if (e.target === el) closeModal(el.id);
    });
  });
  // Escape key
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.querySelectorAll('.lmodal-overlay.active').forEach(el => closeModal(el.id));
  });
  // Time slot selection (one at a time per modal)
  function selectSlot(el) {
    const modal = el.closest('.lmodal');
    modal.querySelectorAll('.lmodal__slot').forEach(s => s.classList.remove('selected'));
    el.classList.add('selected');
  }
  // Filter tabs
  document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', function() {
      document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('filter-tab--active'));
      this.classList.add('filter-tab--active');
    });
  });
</script>