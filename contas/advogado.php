<link rel="stylesheet" href="estilos/imports.css" />
<style>
  .profile-wrap {
    display: flex;
    gap: 28px;
    align-items: flex-start;
  }

  .profile-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 22px;
    width: 320px;
    box-shadow: var(--shadow-sm);
  }

  .profile-avatar {
    width: 96px;
    height: 96px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    font-weight: 700;
    font-size: 28px;
    color: #fff;
    background: var(--navy-900);
    margin-bottom: 14px;
  }

  .profile-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-primary);
  }

  .profile-role {
    font-size: 0.9rem;
    color: var(--text-muted);
    margin-bottom: 12px;
  }

  .profile-details {
    margin-top: 8px;
    font-size: 0.95rem;
    color: var(--text-secondary);
  }

  .profile-main {
    flex: 1;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 22px;
    box-shadow: var(--shadow-sm);
  }

  .field {
    display: flex;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px dashed var(--border);
    align-items: flex-start;
  }

  .field:last-child {
    border-bottom: none;
  }

  .field-label {
    width: 160px;
    font-weight: 600;
    color: var(--text-primary);
  }

  .field-value {
    color: var(--text-secondary);
    white-space: pre-wrap;
  }

  .actions {
    display: flex;
    gap: 12px;
    margin-top: 16px;
  }

  .btn--muted {
    background: transparent;
    border: 1px solid var(--border);
    padding: 8px 12px;
    border-radius: 8px;
  }
</style>

<div class="section">
  <div class="section__header">
    <div>
      <h2 class="section__title">Perfil Profissional</h2>
      <p class="section__subtitle">
        Informações públicas visíveis aos clientes
      </p>
    </div>
    <a href="../documentos.html" class="section__link">Editar perfil →</a>
  </div>

  <div class="profile-wrap">
    <aside class="profile-card">
      <div class="profile-avatar">JA</div>
      <div class="profile-name">Dr. João Antunes</div>
      <div class="profile-role">Advogado · Direito Civil</div>
      <div class="profile-details">
        <div><strong>Localização:</strong> Luanda, Angola</div>
        <div><strong>Contacto:</strong> +244 9xx xxx xxx</div>
        <div style="margin-top: 8px">
          <a class="btn btn--primary" href="#">Agendar Consulta</a>
        </div>
      </div>
    </aside>

    <section class="profile-main">
      <div class="field">
        <div class="field-label">Nome</div>
        <div class="field-value">Dr. João Antunes</div>
      </div>

      <div class="field">
        <div class="field-label">Idade</div>
        <div class="field-value">38 anos</div>
      </div>

      <div class="field">
        <div class="field-label">Género</div>
        <div class="field-value">Masculino</div>
      </div>

      <div class="field">
        <div class="field-label">Profissão / Área</div>
        <div class="field-value">Advogado · Direito Civil e Familiar</div>
      </div>

      <div class="field">
        <div class="field-label">Biografia</div>
        <div class="field-value">
          Advogado com 12 anos de experiência em litígios civis, mediação
          familiar e elaboração de contratos. Assistência a clientes nacionais e
          internacionais.
        </div>
      </div>

      <div class="field">
        <div class="field-label">Localização</div>
        <div class="field-value">Luanda, Distrito Urbano</div>
      </div>

      <div class="field">
        <div class="field-label">Idiomas</div>
        <div class="field-value">Português, Inglês</div>
      </div>

      <div class="actions">
        <button id="edit-profile-btn" class="btn btn--primary">
          Editar Perfil
        </button>
        <a class="btn--muted" href="#">Ver Perfil Público</a>
      </div>
    </section>
  </div>
</div>

<!-- Modal Editar Perfil -->
<div id="profile-modal" class="modal" style="display: none; position: fixed; z-index: 300;right: 25vw;top: 0;">
  <div
    style=" max-width: 720px; margin: 6% auto; background: var(--bg-card); border-radius: 12px; padding: 20px;
    ">
    <h3 style="margin: 0 0 10px">Editar Perfil</h3>
    <form id="profile-form">
      <div style="display: grid; gap: 10px; grid-template-columns: 1fr 1fr">
        <input name="name" placeholder="Nome" required style="padding: 10px; border: 1px solid var(--border); border-radius: 8px;"/>
        <input
          name="age"
          placeholder="Idade"
          type="number"
          min="18"
          style="
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
          " />
        <input
          name="gender"
          placeholder="Género"
          style="
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
          " />
        <input
          name="profession"
          placeholder="Profissão / Área"
          style="
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
          " />
        <input
          name="location"
          placeholder="Localização"
          style="
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
          " />
        <input
          name="contact"
          placeholder="Contacto"
          style="
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
          " />
      </div>
      <div style="margin-top: 10px">
        <textarea
          name="bio"
          placeholder="Biografia"
          rows="4"
          style="
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
          "></textarea>
      </div>
      <div
        style="
          display: flex;
          gap: 10px;
          justify-content: flex-end;
          margin-top: 12px;
        ">
        <button type="button" id="cancel-save" class="btn--muted">
          Cancelar
        </button>
        <button type="submit" class="btn btn--primary">Guardar</button>
      </div>
      <div
        id="profile-msg"
        style="margin-top: 8px; color: var(--text-muted)"></div>
    </form>
  </div>
</div>

<script src="scripts/main.js"></script>
<script>
  (function() {
    const modal = document.getElementById("profile-modal");
    const btn = document.getElementById("edit-profile-btn");
    const form = document.getElementById("profile-form");
    const msg = document.getElementById("profile-msg");

    function openModal() {
      modal.style.display = "block";
      msg.textContent = "";
    }

    function closeModal() {
      modal.style.display = "none";
    }

    btn.addEventListener("click", async () => {
      openModal();
      // carregar dados existentes
      try {
        const res = await fetch("profile.json", {
          cache: "no-store"
        });
        if (res.ok) {
          const data = await res.json();
          form.name.value = data.name || "";
          form.age.value = data.age || "";
          form.gender.value = data.gender || "";
          form.profession.value = data.profession || "";
          form.location.value = data.location || "";
          form.contact.value = data.contact || "";
          form.bio.value = data.bio || "";
        }
      } catch (e) {
        console.error(e);
      }
    });

    document.getElementById("cancel-save").addEventListener("click", () => {
      closeModal();
    });

    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      msg.textContent = "A guardar...";
      const data = new FormData(form);
      try {
        const res = await fetch("save_profile.php", {
          method: "POST",
          body: data,
        });
        const json = await res.json();
        if (json.success) {
          msg.textContent = "Perfil guardado com sucesso.";
          // atualizar vista
          document.querySelector(".profile-name").textContent =
            data.get("name");
          document.querySelector(".profile-role").textContent =
            data.get("profession");
          document.querySelector(".profile-details").children[0].innerHTML =
            "<strong>Localização:</strong> " + data.get("location");
          document.querySelector(".profile-details").children[1].innerHTML =
            "<strong>Contacto:</strong> " + data.get("contact");
          setTimeout(() => {
            closeModal();
          }, 900);
        } else {
          msg.textContent = json.error || "Erro ao guardar";
        }
      } catch (err) {
        console.error(err);
        msg.textContent = "Erro de rede.";
      }
    });
  })();
</script>