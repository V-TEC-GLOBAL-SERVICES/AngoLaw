<!-- ===== MAIN ===== -->
<link rel="stylesheet" href="estilos/documentos.css" />

<!-- Stats -->
<div class="stats-strip">
  <div class="stat-item"><span class="stat-item__number">120+</span><span class="stat-item__label">Modelos disponíveis</span></div>
  <div class="stat-divider"></div>
  <div class="stat-item"><span class="stat-item__number">6</span><span class="stat-item__label">Categorias</span></div>
  <div class="stat-divider"></div>
  <div class="stat-item"><span class="stat-item__number">Gratuitos</span><span class="stat-item__label">Para utilizadores Pro</span></div>
  <div class="stat-divider"></div>
  <div class="stat-item"><span class="stat-item__number">Word</span><span class="stat-item__label">Formato editável</span></div>
</div>

<section class="section">
  <div class="section__header">
    <div>
      <h2 class="section__title">Modelos Jurídicos</h2>
      <p class="section__subtitle">Clique em "Usar Modelo" para personalizar e descarregar</p>
    </div>
  </div>

  <!-- Toolbar -->
  <div class="docs-toolbar">
    <div class="search-bar" style="max-width:300px">
      <i class="fa-solid fa-magnifying-glass" style="color:var(--text-muted);font-size:.85rem"></i>
      <input type="text" placeholder="Pesquisar documentos..." class="search-bar__input" />
    </div>
    <div class="filter-tabs">
      <button class="filter-tab filter-tab--active">Todos</button>
      <button class="filter-tab">Contratos</button>
      <button class="filter-tab">Empresarial</button>
      <button class="filter-tab">Imobiliário</button>
      <button class="filter-tab">Pessoal</button>
    </div>
  </div>

  <!-- Documents grid -->
  <div class="docs-grid">

    <!-- 1 -->
    <?php if (buscaTotal("SELECT * FROM `documentos` ORDER BY `id`", $connect)) {
      foreach (busca("SELECT * FROM `documentos` ORDER BY `id` DESC", $connect) as $dados) { ?>
        <div class="doc-card">
          <div class="doc-card__top doc-card__top--blue">
            <div class="doc-card__file-icon" style="overflow: hidden;height: 100%;width: 100%;">
              <img src="uploads/imagens/<?= htmlspecialchars($dados['imagem']) ?>" alt="Imagem">
            </div>
          </div>
          <div class="doc-card__body">
            <h3 class="doc-card__title"><?= htmlspecialchars($dados['tipo']) ?></h3>
            <p class="doc-card__desc"><?= htmlspecialchars($dados['titulo']) ?></p>
          </div>
          <div class="doc-card__footer">
            <span class="doc-card__meta"><i class="fa-regular fa-calendar" style="margin-right:4px"></i>Atualizado: <?= htmlspecialchars($dados['data']) ?></span>
            <a href="http://localhost/AngoLaw/uploads/documentos/<?= htmlspecialchars($dados['documento']) ?>" target="_top" rel="noreferrer" class="btn btn--navy btn--sm" download>
              <i class="fa-solid fa-download"></i>
              Baixar
            </a>
          </div>
        </div>
    <?php  }
    } else {
      echo "<strong>Nenhum documento encontrado!!!</strong>";
    } ?>

  </div>
</section>

<script src="scripts/main.js"></script>