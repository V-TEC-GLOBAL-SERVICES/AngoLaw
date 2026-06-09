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

  /* Estilo para a área de pré-visualização */
  #preview-container {
    margin-top: 15px;
    text-align: center;
    display: none;
    /* Escondido até que uma imagem seja selecionada */
  }

  #preview-image {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    border: 1px solid #ddd;
  }
</style>

<?php
//var_dump($_SESSION[session_id()]);
# atualizar dados
isset($_POST['admin-perfil']) ? updateUsuario($user, $connect) : '';
isset($_POST['admin-publicar']) ? setterPublicacao($user, $connect) : '';
isset($_POST['admin-documento']) ? setterDocumento($user, $connect) : '';

$dados = buscaUnica("SELECT * FROM `usuarios` WHERE `id`='{$user['id']}'", $connect);
?>

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
      <form method="post" id="profile-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="admin-name">Nome</label>
            <input id="admin-name" name="nome" value="<?= $dados['nome'] ?? '' ?>" required />
          </div>
          <div class="form-group">
            <label for="admin-genero">Função</label>
            <select name="genero" id="admin-genero" required>
              <option value="Masculino" <?= ($dados['genero'] ?? '') == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
              <option value="Feminino" <?= ($dados['genero'] ?? '') == 'Feminino' ? 'selected' : '' ?>>Feminino</option>
            </select>
          </div>
          <div class="form-group">
            <label for="admin-email">Email</label>
            <input id="admin-email" name="email" type="email" value="<?= $dados['email'] ?? '' ?>" required />
          </div>
          <div class="form-group">
            <label for="admin-location">Localização</label>
            <input id="admin-location" type="text" name="localizacao" value="<?= $dados['localizacao'] ?? '' ?>" />
          </div>
          <div class="form-group">
            <label for="admin-phone">Contacto</label>
            <input id="admin-phone" type="tel" name="contacto" value="<?= $dados['contacto'] ?? '' ?>" />
          </div>
          <div class="form-group">
            <label for="admin-phone">Nascimento</label>
            <input id="admin-phone" type="date" name="nascimento" value="<?= $dados['nascimento'] ?? '' ?>" />
          </div>
        </div>
        <div class="form-group">
          <label for="admin-bio">Biografia</label>
          <textarea id="admin-bio" name="biografia" rows="3"><?= $dados['biografia'] ?? '' ?></textarea>
        </div>
        <div class="item-actions" style="justify-content: flex-start; margin-top: 1.5rem;">
          <button class="btn btn--primary" type="submit" name="admin-perfil" id="admin-perfil" value="1">Guardar Perfil</button>
        </div>
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
      <form method="post" id="publication-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="pub-url">URL do vídeo</label>
            <input id="pub-url" name="url" required />
          </div>
          <div class="form-group">
            <label for="pub-title">Título</label>
            <input id="pub-title" name="titulo" required />
          </div>
          <div class="form-group">
            <label for="pub-type">Tipo</label>
            <input id="pub-type" name="tipo" required />
          </div>
          <div class="form-group">
            <label for="pub-description">Descrição</label>
            <textarea id="pub-description" name="descricao" rows="2"></textarea>
          </div>
        </div>
        <div class="item-actions">
          <button class="btn btn--primary" type="submit" name="admin-publicar" value="1">Adicionar Publicação</button>
          <button type="reset" class="btn btn--muted cancel-btn">Cancelar</button>
        </div>
      </form>
      <div id="publication-list" class="admin-list">
        <div class="list-item">
          <div>
            <strong>Como funciona um contrato de serviço</strong>
          </div>
          <div class="item-meta">
            <span><i class="fa-solid fa-tag"></i> Vídeo Educativo</span>
          </div>
          <div class="item-meta">
            <span><i class="fa-solid fa-link"></i>
              <a href="https://youtu.be/example1" target="_blank">Ver URL</a></span>
          </div>
          <p>Explicação passo a passo sobre os principais termos contratuais.</p>
          <div class="item-actions">
            <button type="button" class="view">Editar</button><button type="button" class="delete">Eliminar</button>
          </div>
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
      <form id="document-form" method="post" enctype="multipart/form-data">
        <div id="preview-container">
          <p>Pré-visualização:</p>
          <img id="preview-image" src="" alt="Pré-visualização da imagem">
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label for="doc-image">imagem</label>
            <input name="imagem" id="imagem" type="file" accept=".jpg, .jpeg, .png, .gif, .webp, .svg, image/jpeg, image/png, image/gif, image/webp, image/svg+xml" required />
          </div>
          <div class="form-group">
            <label for="doc-title">Título</label>
            <input id="doc-title" name="titulo" required />
          </div>
          <div class="form-group">
            <label for="doc-type">Tipo</label>
            <input id="doc-type" name="tipo" required />
          </div>
          <div class="form-group">
            <label for="doc-description">Descrição</label>
            <textarea id="doc-description" name="descricao" rows="2" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="doc-body">Documento</label>
          <input type="file" name="documento" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt" required>
        </div>
        <div class="item-actions">
          <button class="btn btn--primary" type="submit" name="admin-documento" value="1" id="admin-documento">Adicionar Documento</button>
          <button type="button" class="btn btn--muted cancel-btn">Cancelar</button>
        </div>
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
        <div class="form-grid-3">
          <div class="form-group">
            <label for="article-category">Categoria</label>
            <input id="article-category" name="categoria" required />
          </div>
          <div class="form-group">
            <label for="article-title">Título</label>
            <input id="article-title" name="titulo" required />
          </div>
          <div class="form-group">
            <label for="article-description">Descrição</label>
            <textarea id="article-description" name="descricao" rows="2"></textarea>
          </div>
        </div>
        <div class="item-actions">
          <button class="btn btn--primary" type="submit" id="admin-artigo" name="admin-artigo" value="1">Adicionar Artigo</button>
          <button type="reset" class="btn btn--muted cancel-btn" style="margin-top: 1.5rem;">Cancelar</button>
        </div>
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
        <div class="form-grid">
          <div class="form-group">
            <label for="playlist-url">URL do vídeo</label>
            <input id="playlist-url" name="url" required />
          </div>
          <div class="form-group">
            <label for="playlist-title">Título</label>
            <input id="playlist-title" name="titulo" required />
          </div>
          <div class="form-group">
            <label for="playlist-description">Descrição</label>
            <textarea id="playlist-description" name="description" rows="2"></textarea>
          </div>
        </div>
        <div class="item-actions">
          <button class="btn btn--primary" type="submit" name="admin-playlist" id="admin-playlist" value="1">Adicionar Playlist</button>
          <button type="reset" class="btn btn--muted cancel-btn" style="margin-top: 1.5rem;">Cancelar</button>
        </div>
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
  // Script para criar a pré-visualização da imagem selecionada
  var inputImagem = document.getElementById('imagem');
  var previewContainer = document.getElementById('preview-container');
  var previewImage = document.getElementById('preview-image');

  inputImagem.addEventListener('change', function(event) {
    var arquivo = event.target.files[0];

    if (arquivo) {
      // Cria um URL temporário para o arquivo selecionado
      var objectURL = URL.createObjectURL(arquivo);

      // Define a fonte da imagem para o URL gerado e mostra o container
      previewImage.src = objectURL;
      previewContainer.style.display = 'block';

      // Libera a memória quando a imagem terminar de carregar
      previewImage.onload = function() {
        URL.revokeObjectURL(previewImage.src);
      }
    } else {
      // Esconde a pré-visualização se nenhum arquivo for selecionado
      previewContainer.style.display = 'none';
      previewImage.src = '';
    }
  });
</script>