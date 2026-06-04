<style>
  .admin-panel {
    display: grid;
    gap: 28px;
  }

  .admin-row {
    display: grid;
    gap: 24px;
    grid-template-columns: 1fr 1fr;
  }

  .admin-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 24px;
    box-shadow: var(--shadow-sm);
  }

  .admin-card h3 {
    margin-top: 0;
  }

  .field-group {
    display: grid;
    gap: 14px;
  }

  .form-grid {
    display: grid;
    gap: 16px;
    grid-template-columns: 1fr 1fr;
  }

  .form-grid-3 {
    display: grid;
    gap: 16px;
    grid-template-columns: 1fr 1fr 1fr;
  }

  .form-grid-full {
    display: grid;
    gap: 16px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .form-group label {
    font-size: 0.92rem;
    color: var(--text-primary);
    font-weight: 600;
  }

  .form-group input,
  .form-group textarea,
  .form-group select {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--bg);
    color: var(--text-primary);
  }

  .admin-list {
    display: grid;
    gap: 14px;
    margin-top: 18px;
  }

  .list-item {
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 16px;
    display: grid;
    gap: 10px;
  }

  .item-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    font-size: 0.88rem;
    color: var(--text-muted);
  }

  .item-meta span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }

  .item-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: flex-end;
  }

  .item-actions button {
    padding: 8px 12px;
    border-radius: 10px;
    border: 1px solid var(--border);
    background: transparent;
    cursor: pointer;
  }

  .item-actions button.delete {
    color: var(--red-600);
    border-color: rgba(239, 68, 68, 0.2);
  }

  .item-actions button.view {
    color: var(--blue-600);
  }

  .admin-note {
    font-size: 0.9rem;
    color: var(--text-muted);
  }

  .section-subtitle {
    margin-top: 6px;
    color: var(--text-muted);
  }

  .toast {
    font-size: 0.95rem;
    margin-top: 14px;
  }

  .toast.success {
    color: var(--green-600);
  }

  .toast.error {
    color: var(--red-600);
  }

  .section-stack {
    display: grid;
    gap: 22px;
  }

  @media (max-width: 980px) {
    .admin-row {
      grid-template-columns: 1fr;
    }

    .form-grid,
    .form-grid-3 {
      grid-template-columns: 1fr;
    }
  }
</style>

<section class="section admin-panel">
  <div class="admin-card">
    <div class="section__header">
      <div>
        <h2 class="section__title">Perfil Administrativo</h2>
        <p class="section__subtitle">
          Atualize os dados do administrador e a descrição do painel.
        </p>
      </div>
    </div>
    <div class="field-group">
      <form id="profile-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="admin-name">Nome</label><input id="admin-name" name="name" required />
          </div>
          <div class="form-group">
            <label for="admin-role">Função</label><input id="admin-role" name="role" required />
          </div>
          <div class="form-group">
            <label for="admin-email">Email</label><input id="admin-email" name="email" type="email" required />
          </div>
          <div class="form-group">
            <label for="admin-location">Localização</label><input id="admin-location" name="location" />
          </div>
          <div class="form-group">
            <label for="admin-phone">Contacto</label><input id="admin-phone" name="phone" />
          </div>
        </div>
        <div class="form-group">
          <label for="admin-bio">Biografia</label><textarea id="admin-bio" name="bio" rows="3"></textarea>
        </div>
        <div class="item-actions" style="justify-content: flex-start">
          <button class="btn btn--primary" type="submit">Guardar Perfil</button>
        </div>
        <div id="profile-toast" class="toast"></div>
      </form>
    </div>
  </div>

  <div class="section-stack">
    <div class="admin-card">
      <div class="section__header">
        <div>
          <h2 class="section__title">Publicações</h2>
          <p class="section__subtitle">
            Criar e gerir vídeos publicados no portal.
          </p>
        </div>
      </div>
      <form id="publication-form">
        <input type="hidden" id="pub-id" name="id" />
        <div class="form-grid">
          <div class="form-group">
            <label for="pub-url">URL do vídeo</label><input id="pub-url" name="url" required />
          </div>
          <div class="form-group">
            <label for="pub-title">Título</label><input id="pub-title" name="title" required />
          </div>
          <div class="form-group">
            <label for="pub-type">Tipo</label><input id="pub-type" name="type" required />
          </div>
          <div class="form-group">
            <label for="pub-description">Descrição</label><textarea
              id="pub-description"
              name="description"
              rows="2"></textarea>
          </div>
        </div>
        <div class="item-actions">
          <button class="btn btn--primary" type="submit">
            Adicionar Publicação</button><button
            type="button"
            class="btn btn--muted cancel-btn"
            style="display: none">
            Cancelar
          </button>
        </div>
        <div id="publication-toast" class="toast"></div>
      </form>
      <div id="publication-list" class="admin-list">
        <div class="list-item">
          <div><strong>Como funciona um contrato de serviço</strong></div>
          <div class="item-meta"><span><i class="fa-solid fa-tag"></i> Vídeo Educativo</span></div>
          <div class="item-meta"><span><i class="fa-solid fa-link"></i> <a href="https://youtu.be/example1" target="_blank">Ver URL</a></span></div>
          <p>Explicação passo a passo sobre os principais termos contratuais.</p>
          <div class="item-actions"><button type="button" class="view">Editar</button><button type="button" class="delete">Eliminar</button></div>
        </div>
      </div>
    </div>

    <div class="admin-card">
      <div class="section__header">
        <div>
          <h2 class="section__title">Documentos</h2>
          <p class="section__subtitle">
            Criar contratos, modelos e imagens de documentos.
          </p>
        </div>
      </div>
      <form id="document-form">
        <input type="hidden" id="doc-id" name="id" />
        <div class="form-grid">
          <div class="form-group">
            <label for="doc-image">URL da imagem</label><input id="doc-image" name="image" />
          </div>
          <div class="form-group">
            <label for="doc-title">Título</label><input id="doc-title" name="title" required />
          </div>
          <div class="form-group">
            <label for="doc-type">Tipo</label><input id="doc-type" name="type" />
          </div>
          <div class="form-group">
            <label for="doc-description">Descrição</label><textarea
              id="doc-description"
              name="description"
              rows="2"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="doc-body">Corpo do contrato</label><textarea id="doc-body" name="body" rows="4"></textarea>
        </div>
        <div class="item-actions">
          <button class="btn btn--primary" type="submit">
            Adicionar Documento</button><button
            type="button"
            class="btn btn--muted cancel-btn"
            style="display: none">
            Cancelar
          </button>
        </div>
        <div id="document-toast" class="toast"></div>
      </form>
      <div id="document-list" class="admin-list">
        <div><strong>Contrato de Prestação de Serviços</strong></div>
        <div class="item-meta"><span><i class="fa-solid fa-tag"></i> Minuta</span></div>
        <p>Modelo de contrato que pode ser adaptado a diversas prestações de serviço.</p>
        <p>Cláusulas principais do contrato: objeto, prazos, responsabilidades e penalidades.</p>
        <div class="item-actions"><button type="button" class="view">Editar</button><button type="button" class="delete">Eliminar</button></div>
      </div>
    </div>

    <div class="admin-card">
      <div class="section__header">
        <div>
          <h2 class="section__title">Artigos</h2>
          <p class="section__subtitle">
            Gerir artigos e guias rápidos do site.
          </p>
        </div>
      </div>
      <form id="article-form">
        <input type="hidden" id="article-id" name="id" />
        <div class="form-grid-3">
          <div class="form-group">
            <label for="article-category">Categoria</label><input id="article-category" name="category" required />
          </div>
          <div class="form-group">
            <label for="article-title">Título</label><input id="article-title" name="title" required />
          </div>
          <div class="form-group">
            <label for="article-description">Descrição</label><textarea
              id="article-description"
              name="description"
              rows="2"></textarea>
          </div>
        </div>
        <div class="item-actions">
          <button class="btn btn--primary" type="submit">
            Adicionar Artigo</button><button
            type="button"
            class="btn btn--muted cancel-btn"
            style="display: none">
            Cancelar
          </button>
        </div>
        <div id="article-toast" class="toast"></div>
      </form>
      <div id="article-list" class="admin-list">
        <div><strong>Guia de Mediação Familiar</strong></div>
        <div class="item-meta"><span><i class="fa-solid fa-layer-group"></i> Direito Civil</span></div>
        <p>Orientações para gerir conflitos familiares de forma amigável e segura.</p>
        <div class="item-actions"><button type="button" class="view">Editar</button><button type="button" class="delete">Eliminar</button></div>
      </div>
    </div>

    <div class="admin-card">
      <div class="section__header">
        <div>
          <h2 class="section__title">Playlists</h2>
          <p class="section__subtitle">
            Organize playlists e coleções de vídeos.
          </p>
        </div>
      </div>
      <form id="playlist-form">
        <input type="hidden" id="playlist-id" name="id" />
        <div class="form-grid">
          <div class="form-group">
            <label for="playlist-url">URL do vídeo</label><input id="playlist-url" name="url" required />
          </div>
          <div class="form-group">
            <label for="playlist-title">Título</label><input id="playlist-title" name="title" required />
          </div>
          <div class="form-group">
            <label for="playlist-description">Descrição</label><textarea
              id="playlist-description"
              name="description"
              rows="2"></textarea>
          </div>
        </div>
        <div class="item-actions">
          <button class="btn btn--primary" type="submit">
            Adicionar Playlist</button><button
            type="button"
            class="btn btn--muted cancel-btn"
            style="display: none">
            Cancelar
          </button>
        </div>
        <div id="playlist-toast" class="toast"></div>
      </form>
      <div id="playlist-list" class="admin-list">
        <div><strong>Playlist de Direito Civil</strong></div>
        <div class="item-meta"><span><i class="fa-solid fa-link"></i> <a href="https://youtu.be/example22" target="_blank">Ver URL</a></span></div>
        <p>Coleção de vídeos com conteúdos sobre contratos, família e responsabilidade civil.</p>
        <div class="item-actions"><button type="button" class="view">Editar</button><button type="button" class="delete">Eliminar</button></div>
      </div>
    </div>
  </div>
</section>

<script src="scripts/main.js"></script>
<script>
  const apiUrl = "contas/admin_save.php";
  const dataUrl = "contas/admin_data.json";
  let adminData = null;
  const formMap = {
    publications: document.getElementById("publication-form"),
    documents: document.getElementById("document-form"),
    articles: document.getElementById("article-form"),
    playlists: document.getElementById("playlist-form"),
  };
  const toastMap = {
    publications: "publication-toast",
    documents: "document-toast",
    articles: "article-toast",
    playlists: "playlist-toast",
  };
  const entityFields = {
    publications: ["url", "title", "type", "description"],
    documents: ["image", "title", "type", "description", "body"],
    articles: ["category", "title", "description"],
    playlists: ["url", "title", "description"],
  };

  function showToast(id, message, type = "success") {
    const toast = document.getElementById(id);
    toast.textContent = message;
    toast.className = "toast " + (type === "success" ? "success" : "error");
    if (message)
      setTimeout(() => {
        toast.textContent = "";
        toast.className = "toast";
      }, 2800);
  }

  function setEditState(entity, item) {
    const form = formMap[entity];
    if (!form) return;
    form.dataset.editId = item.id;
    const idInput = form.querySelector('input[name="id"]');
    if (idInput) idInput.value = item.id;
    entityFields[entity].forEach((key) => {
      const input = form.querySelector(`[name="${key}"]`);
      if (input) input.value = item[key] || "";
    });
    const submit = form.querySelector('button[type="submit"]');
    if (submit) submit.textContent = "Atualizar";
    const cancelBtn = form.querySelector(".cancel-btn");
    if (cancelBtn) cancelBtn.style.display = "inline-flex";
    showToast(toastMap[entity], "Modo edição ativado.", "success");
  }

  function clearEditState(entity) {
    const form = formMap[entity];
    if (!form) return;
    form.dataset.editId = "";
    const idInput = form.querySelector('input[name="id"]');
    if (idInput) idInput.value = "";
    form.reset();
    const submit = form.querySelector('button[type="submit"]');
    if (submit) {
      if (entity === "publications")
        submit.textContent = "Adicionar Publicação";
      if (entity === "documents") submit.textContent = "Adicionar Documento";
      if (entity === "articles") submit.textContent = "Adicionar Artigo";
      if (entity === "playlists") submit.textContent = "Adicionar Playlist";
    }
    const cancelBtn = form.querySelector(".cancel-btn");
    if (cancelBtn) cancelBtn.style.display = "none";
  }
</script>