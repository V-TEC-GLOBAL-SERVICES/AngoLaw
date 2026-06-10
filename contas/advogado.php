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

<?php
# atualizar perfil
isset($_POST['updatePerfil']) ? updateAdvogado($user, $connect) : '';

# buscar dados
$usuario = buscaUnica("SELECT * FROM `usuarios` WHERE `id`='{$user['id']}'", $connect);
?>

<div class="section">
  <div class="section__header">
    <div>
      <h2 class="section__title">Perfil Profissional</h2>
      <p class="section__subtitle">
        Informações públicas visíveis aos clientes
      </p>
    </div>
  </div>

  <div class="profile-wrap">

    <section class="profile-main">
      <form method="post" class="profile-grid">

        <div class="field">
          <label for="nome" class="field-label">Nome</label>
          <input type="text" name="nome" id="nome" class="field-input" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
        </div>

        <div class="field">
          <label for="email" class="field-label">E-mail</label>
          <input type="email" name="email" id="email" class="field-input" value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>

        <div class="field">
          <label for="contacto" class="field-label">Telefone</label>
          <input type="tel" name="contacto" id="contacto" class="field-input" value="<?= htmlspecialchars($usuario['contacto']) ?>" required>
        </div>

        <div class="field">
          <label for="nascimento" class="field-label">Data de nascimento</label>
          <input type="date" name="nascimento" id="nascimento" class="field-input" value="<?= htmlspecialchars($usuario['nascimento']) ?>" required>
        </div>

        <div class="field">
          <label for="genero" class="field-label">Género</label>
          <select name="genero" id="genero" class="field-input" required>
            <option value="Masculino" <?= $usuario['genero'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
            <option value="Feminino" <?= $usuario['genero'] === 'Feminino' ? 'selected' : '' ?>>Feminino</option>
          </select>
        </div>

        <div class="field">
          <label for="profissao" class="field-label">Profissão / Área</label>
          <input type="text" name="profissao" id="profissao" class="field-input" value="<?= htmlspecialchars($usuario['profissao']) ?>" required>
        </div>

        <div class="field">
          <label for="localizacao" class="field-label">Localização</label>
          <input type="text" name="localizacao" id="localizacao" class="field-input" value="<?= htmlspecialchars($usuario['localizacao']) ?>" required>
        </div>

        <div class="field">
          <label for="idiomas" class="field-label">Idiomas</label>
          <input type="text" name="idiomas" id="idiomas" class="field-input" value="<?= htmlspecialchars($usuario['idiomas'] ?? '') ?>" required>
        </div>

        <div class="field">
          <label for="experiencia" class="field-label">Experiência</label>
          <input type="text" name="experiencia" id="experiencia" class="field-input" value="<?= htmlspecialchars($usuario['experiencia'] ?? '') ?>" required>
        </div>

        <div class="field">
          <label for="atividade_extra" class="field-label">Atividades Extra</label>
          <input type="text" name="atividade_extra" id="atividade_extra" class="field-input" value="<?= htmlspecialchars($usuario['atividade_extra'] ?? '') ?>" required>
        </div>

        <div class="field">
          <label for="modalidade" class="field-label">Modalidade</label>
          <input type="text" name="modalidade" id="modalidade" class="field-input" value="<?= htmlspecialchars($usuario['modalidade'] ?? '') ?>" required>
        </div>

        <div class="field">
          <label for="formacao" class="field-label">Formação</label>
          <input type="text" name="formacao" id="formacao" class="field-input" value="<?= htmlspecialchars($usuario['formacao'] ?? '') ?>" required>
        </div>

        <div class="field">
          <label for="valor_consulta" class="field-label">Valor da Consulta</label>
          <input type="text" name="valor_consulta" id="valor_consulta" class="field-input" value="<?= htmlspecialchars($usuario['valor_consulta'] ?? '') ?>" required>
        </div>

        <div class="field" title="Desconto da primeira consulta">
          <label for="desconto" class="field-label">Desconto</label>
          <input type="text" name="desconto" id="desconto" class="field-input" value="<?= htmlspecialchars($usuario['desconto'] ?? '') ?>" required>
        </div>

        <!-- Campo de largura total para textos longos -->
        <div class="field field--full-width">
          <label for="biografia" class="field-label">Biografia</label>
          <textarea name="biografia" id="biografia" class="field-input" rows="4" required><?= htmlspecialchars($usuario['biografia']) ?></textarea>
        </div>

        <div class="actions">
          <button type="submit" name="updatePerfil" value="update" id="edit-profile-btn" class="btn btn--primary" onclick="return confirm('Tem certeza que deseja atualizar seu perfil?');">
            Guardar Alterações
          </button>
        </div>
      </form>
    </section>
  </div>
</div>

<!-- senha -->
<div class="password-card">
  <div class="password-header">
    <h3 class="password-title">Alterar Senha</h3>
    <p class="password-subtitle">Escolha uma senha forte para garantir a segurança da sua conta.</p>
  </div>

  <form id="password-form" onsubmit="event.preventDefault();">
    <div class="form-group">
      <label for="current-password" class="form-label">Senha Atual</label>
      <input type="password" id="current-password" class="form-input" placeholder="Digite a senha atual" required>
    </div>

    <div class="form-group">
      <label for="new-password" class="form-label">Nova Senha</label>
      <input type="password" id="new-password" class="form-input" placeholder="Digite a nova senha" required>

      <div class="strength-wrapper">
        <div class="strength-meter">
          <div id="strength-bar" class="strength-bar"></div>
        </div>
        <span id="strength-text" class="strength-text">Muito fraca</span>
      </div>
    </div>

    <ul class="requirements-list">
      <li id="req-length" class="req-item">Mínimo de 8 caracteres</li>
      <li id="req-upper" class="req-item">Pelo menos uma letra maiúscula</li>
      <li id="req-number" class="req-item">Pelo menos um número</li>
      <li id="req-special" class="req-item">Pelo menos um caractere especial (!@#$%)</li>
    </ul>

    <div class="form-group">
      <label for="confirm-password" class="form-label">Confirmar Nova Senha</label>
      <input type="password" id="confirm-password" class="form-input" placeholder="Repita a nova senha" required>
      <span id="match-text" class="match-text"></span>
    </div>

    <div class="password-actions">
      <button type="submit" id="btn-save-password" class="btn btn--primary" disabled>
        Atualizar Senha
      </button>
    </div>
  </form>
</div>

<!-- areas -->
<div class="areas-card">
  <div class="areas-header">
    <h3 class="areas-title">Áreas de Atuação</h3>
    <p class="areas-subtitle">Selecione as especialidades que deseja associar ao seu perfil.</p>
  </div>

  <div class="field field--full-width">
    <label for="area">Adicionar nova Área de Atuação</label>
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 8px;">
      <input type="text" name="area" id="area" class="field-input" placeholder="Ex: Direito Ambiental">
      <button type="button" id="add-area-btn" class="btn btn--primary" style="margin-top: 0;">
        Adicionar Área
      </button>
    </div>
  </div>

  <div class="areas-grid">
    <!-- Direito Civil -->
    <label class="area-item">
      <input type="checkbox" name="areas[]" value="civil" class="area-checkbox" checked>
      <div class="area-card-inner">
        <div class="select-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="area-icon">🏛️</div>
        <span class="area-name">Direito Civil</span>
      </div>
    </label>

    <!-- Direito de Família -->
    <label class="area-item">
      <input type="checkbox" name="areas[]" value="familia" class="area-checkbox" checked>
      <div class="area-card-inner">
        <div class="select-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="area-icon">👨‍👩‍👧‍👦</div>
        <span class="area-name">Família e Sucessões</span>
      </div>
    </label>

    <!-- Direito do Trabalho -->
    <label class="area-item">
      <input type="checkbox" name="areas[]" value="trabalho" class="area-checkbox">
      <div class="area-card-inner">
        <div class="select-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="area-icon">💼</div>
        <span class="area-name">Direito do Trabalho</span>
      </div>
    </label>

    <!-- Direito Penal -->
    <label class="area-item">
      <input type="checkbox" name="areas[]" value="penal" class="area-checkbox">
      <div class="area-card-inner">
        <div class="select-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="area-icon">⚖️</div>
        <span class="area-name">Direito Penal</span>
      </div>
    </label>

    <!-- Direito Comercial -->
    <label class="area-item">
      <input type="checkbox" name="areas[]" value="comercial" class="area-checkbox">
      <div class="area-card-inner">
        <div class="select-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="area-icon">🏢</div>
        <span class="area-name">Empresarial</span>
      </div>
    </label>

    <!-- Direito Imobiliário -->
    <label class="area-item">
      <input type="checkbox" name="areas[]" value="imobiliario" class="area-checkbox">
      <div class="area-card-inner">
        <div class="select-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="area-icon">🏠</div>
        <span class="area-name">Imobiliário</span>
      </div>
    </label>

    <!-- Direito Digital -->
    <label class="area-item">
      <input type="checkbox" name="areas[]" value="digital" class="area-checkbox">
      <div class="area-card-inner">
        <div class="select-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="area-icon">💻</div>
        <span class="area-name">Direito Digital</span>
      </div>
    </label>

    <!-- Direito Fiscal -->
    <label class="area-item">
      <input type="checkbox" name="areas[]" value="fiscal" class="area-checkbox">
      <div class="area-card-inner">
        <div class="select-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <div class="area-icon">📈</div>
        <span class="area-name">Fiscal / Tributário</span>
      </div>
    </label>
  </div>
</div>

<!-- horario -->
<div class="schedule-card">
  <div class="schedule-header">
    <h3 class="schedule-title">Agenda e Horário Laboral</h3>
    <p class="schedule-subtitle">Selecione os dias de trabalho e defina as horas de início e fim.</p>
  </div>

  <div class="schedule-body">
    <!-- Segunda-feira -->
    <div class="schedule-row">
      <label class="day-label">
        <input type="checkbox" name="dias[segunda][ativo]" class="day-checkbox" checked>
        <span class="day-name">Segunda-feira</span>
      </label>
      <div class="time-picker-group">
        <input type="time" name="dias[segunda][inicio]" class="time-input" value="08:00">
        <span class="time-divider">às</span>
        <input type="time" name="dias[segunda][fim]" class="time-input" value="17:00">
      </div>
    </div>

    <!-- Terça-feira -->
    <div class="schedule-row">
      <label class="day-label">
        <input type="checkbox" name="dias[terca][ativo]" class="day-checkbox" checked>
        <span class="day-name">Terça-feira</span>
      </label>
      <div class="time-picker-group">
        <input type="time" name="dias[terca][inicio]" class="time-input" value="08:00">
        <span class="time-divider">às</span>
        <input type="time" name="dias[terca][fim]" class="time-input" value="17:00">
      </div>
    </div>

    <!-- Quarta-feira -->
    <div class="schedule-row">
      <label class="day-label">
        <input type="checkbox" name="dias[quarta][ativo]" class="day-checkbox" checked>
        <span class="day-name">Quarta-feira</span>
      </label>
      <div class="time-picker-group">
        <input type="time" name="dias[quarta][inicio]" class="time-input" value="08:00">
        <span class="time-divider">às</span>
        <input type="time" name="dias[quarta][fim]" class="time-input" value="17:00">
      </div>
    </div>

    <!-- Quinta-feira -->
    <div class="schedule-row">
      <label class="day-label">
        <input type="checkbox" name="dias[quinta][ativo]" class="day-checkbox" checked>
        <span class="day-name">Quinta-feira</span>
      </label>
      <div class="time-picker-group">
        <input type="time" name="dias[quinta][inicio]" class="time-input" value="08:00">
        <span class="time-divider">às</span>
        <input type="time" name="dias[quinta][fim]" class="time-input" value="17:00">
      </div>
    </div>

    <!-- Sexta-feira -->
    <div class="schedule-row">
      <label class="day-label">
        <input type="checkbox" name="dias[sexta][ativo]" class="day-checkbox" checked>
        <span class="day-name">Sexta-feira</span>
      </label>
      <div class="time-picker-group">
        <input type="time" name="dias[sexta][inicio]" class="time-input" value="08:00">
        <span class="time-divider">às</span>
        <input type="time" name="dias[sexta][fim]" class="time-input" value="17:00">
      </div>
    </div>

    <!-- Sábado -->
    <div class="schedule-row">
      <label class="day-label">
        <input type="checkbox" name="dias[sabado][ativo]" class="day-checkbox">
        <span class="day-name">Sábado</span>
      </label>
      <div class="time-picker-group">
        <input type="time" name="dias[sabado][inicio]" class="time-input" value="09:00">
        <span class="time-divider">às</span>
        <input type="time" name="dias[sabado][fim]" class="time-input" value="13:00">
      </div>
    </div>

    <!-- Domingo -->
    <div class="schedule-row">
      <label class="day-label">
        <input type="checkbox" name="dias[domingo][ativo]" class="day-checkbox">
        <span class="day-name">Domingo</span>
      </label>
      <div class="time-picker-group">
        <input type="time" name="dias[domingo][inicio]" class="time-input" value="09:00">
        <span class="time-divider">às</span>
        <input type="time" name="dias[domingo][fim]" class="time-input" value="13:00">
      </div>
    </div>
  </div>
</div>

<script src="scripts/main.js"></script>
<script>
  const newPasswordInput = document.getElementById("new-password");
  const confirmPasswordInput = document.getElementById("confirm-password");
  const strengthBar = document.getElementById("strength-bar");
  const strengthText = document.getElementById("strength-text");
  const matchText = document.getElementById("match-text");
  const btnSubmit = document.getElementById("btn-save-password");

  // Elementos dos Requisitos
  const reqs = {
    length: document.getElementById("req-length"),
    upper: document.getElementById("req-upper"),
    number: document.getElementById("req-number"),
    special: document.getElementById("req-special"),
  };

  // Monitoriza a digitação da Nova Senha
  newPasswordInput.addEventListener("input", () => {
    const value = newPasswordInput.value;
    let score = 0;

    // 1. Validar requisitos individualmente
    const checks = {
      length: value.length >= 8,
      upper: /[A-Z]/.test(value),
      number: /[0-9]/.test(value),
      special: /[^A-Za-z0-9]/.test(value),
    };

    // Atualiza as classes visuais do checklist
    for (const key in checks) {
      if (checks[key]) {
        reqs[key].classList.add("valid");
        score++;
      } else {
        reqs[key].classList.remove("valid");
      }
    }

    // 2. Atualizar o medidor de força (UI)
    if (value.length === 0) {
      strengthBar.style.width = "0%";
      strengthText.innerText = "Muito fraca";
      strengthBar.style.backgroundColor = "#cbd5e1";
    } else if (score <= 1) {
      strengthBar.style.width = "25%";
      strengthText.innerText = "Fraca ❌";
      strengthBar.style.backgroundColor = "#ef4444"; // Vermelho
    } else if (score <= 3) {
      strengthBar.style.width = "60%";
      strengthText.innerText = "Média ⚠️";
      strengthBar.style.backgroundColor = "#f97316"; // Laranja
    } else if (score === 4) {
      strengthBar.style.width = "100%";
      strengthText.innerText = "Forte ✨";
      strengthBar.style.backgroundColor = "#22c55e"; // Verde
    }

    validateForm(score, value, confirmPasswordInput.value);
  });

  // Monitoriza a confirmação da senha
  confirmPasswordInput.addEventListener("input", () => {
    validateForm(calculateCurrentScore(newPasswordInput.value), newPasswordInput.value, confirmPasswordInput.value);
  });

  // Função auxiliar para calcular o score atualizado
  function calculateCurrentScore(value) {
    let score = 0;
    if (value.length >= 8) score++;
    if (/[A-Z]/.test(value)) score++;
    if (/[0-9]/.test(value)) score++;
    if (/[^A-Za-z0-9]/.test(value)) score++;
    return score;
  }

  // Validação Geral do Formulário
  function validateForm(score, password, confirmPassword) {
    // Verificar se as senhas coincidem
    if (confirmPassword.length === 0) {
      matchText.innerText = "";
      matchText.className = "match-text";
    } else if (password === confirmPassword) {
      matchText.innerText = "As senhas coincidem.";
      matchText.className = "match-text success";
    } else {
      matchText.innerText = "As senhas não coincidem.";
      matchText.className = "match-text error";
    }

    // O botão só ativa se a senha for Forte (score 4) e as senhas forem iguais
    if (score === 4 && password === confirmPassword) {
      btnSubmit.removeAttribute("disabled");
    } else {
      btnSubmit.setAttribute("disabled", "true");
    }
  }
</script>

<style>
  /* Contentor principal do formulário */
  .profile-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
  }

  /* Estrutura de cada campo */
  .field {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  /* Campos de texto longo ocupam toda a largura em ecrãs maiores */
  .field--full-width {
    grid-column: 1 / -1;
  }

  /* Estilização das Labels */
  .field-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #4a5568;
  }

  /* Estilização dos Inputs, Selects e Textareas */
  .field-input {
    width: 100%;
    padding: 10px 12px;
    font-size: 1rem;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    background-color: #fff;
    color: #334155;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    box-sizing: border-box;
  }

  .field-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
  }

  /* Textarea específico */
  textarea.field-input {
    resize: vertical;
    font-family: inherit;
  }

  /* Secção de botões na parte inferior */
  .actions {
    grid-column: 1 / -1;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 16px;
    margin-top: 20px;
    flex-wrap: wrap;
    /* Garante que os botões quebram linha em telemóveis muito pequenos */
  }

  /* Estilos base para botões (ajusta conforme as tuas classes globais) */
  .btn {
    padding: 10px 20px;
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    border: none;
    text-decoration: none;
  }

  .btn--primary {
    background-color: #3b82f6;
    color: white;
  }

  .btn--primary:hover {
    background-color: #2563eb;
  }

  .btn--muted {
    color: #64748b;
    text-decoration: underline;
    font-size: 0.95rem;
  }

  .btn--muted:hover {
    color: #334155;
  }

  /* Card Principal */
  .schedule-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px;
    max-width: 650px;
    margin: 20px auto;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    font-family: system-ui, -apple-system, sans-serif;
  }

  /* Cabeçalho */
  .schedule-header {
    margin-bottom: 20px;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 16px;
  }

  .schedule-title {
    font-size: 1.25rem;
    color: #1e293b;
    margin: 0 0 6px 0;
    font-weight: 600;
  }

  .schedule-subtitle {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
  }

  /* Linha de cada dia */
  .schedule-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f8fafc;
    gap: 16px;
    transition: all 0.2s ease;
  }

  .schedule-row:last-child {
    border-bottom: none;
  }

  /* Label e Checkbox */
  .day-label {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    user-select: none;
    min-width: 140px;
  }

  .day-checkbox {
    width: 18px;
    height: 18px;
    accent-color: #3b82f6;
    /* Cor azul moderna para o check */
    cursor: pointer;
  }

  .day-name {
    font-size: 0.95rem;
    font-weight: 500;
    color: #334155;
  }

  /* Grupo de Inputs de Hora */
  .time-picker-group {
    display: flex;
    align-items: center;
    gap: 8px;
    transition: opacity 0.2s ease;
  }

  .time-input {
    padding: 6px 10px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 0.9rem;
    color: #334155;
    background-color: #ffffff;
    outline: none;
    transition: border-color 0.2s;
  }

  .time-input:focus {
    border-color: #3b82f6;
  }

  .time-divider {
    font-size: 0.85rem;
    color: #94a3b8;
  }

  /* --- MÁGICA DO CSS INTERATIVO --- */
  /* Se a checkbox NÃO estiver marcada, desativa visualmente os inputs de tempo */
  .schedule-row:not(:has(.day-checkbox:checked)) {
    background-color: #f8fafc;
    padding-left: 8px;
    padding-right: 8px;
    border-radius: 6px;
  }

  .schedule-row:not(:has(.day-checkbox:checked)) .time-picker-group {
    opacity: 0.4;
    pointer-events: none;
    /* Impede o clique/edição */
  }

  .schedule-row:not(:has(.day-checkbox:checked)) .day-name {
    color: #94a3b8;
  }

  /* Responsividade para telemóveis */
  @media (max-width: 500px) {
    .schedule-row {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
      padding: 16px 8px;
    }

    .time-picker-group {
      width: 100%;
      justify-content: flex-start;
    }

    .time-input {
      flex: 1;
      /* Ocupa o espaço disponível igualmente */
      max-width: 120px;
    }
  }

  /* Container do Bloco */
  .areas-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    max-width: 750px;
    margin: 20px auto;
    box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.03);
    font-family: system-ui, -apple-system, sans-serif;
  }

  /* Cabeçalho */
  .areas-header {
    margin-bottom: 24px;
  }

  .areas-title {
    font-size: 1.25rem;
    color: #0f172a;
    margin: 0 0 4px 0;
    font-weight: 600;
  }

  .areas-subtitle {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
  }

  /* Grid Inteligente de Mini Cards */
  .areas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 14px;
  }

  /* Item Base (Label) */
  .area-item {
    cursor: pointer;
    position: relative;
  }

  /* Input nativo completamente escondido */
  .area-checkbox {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* O Corpo do Mini Card */
  .area-card-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px 12px;
    background: #ffffff;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    min-height: 110px;
    position: relative;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-sizing: border-box;
  }

  /* Efeito de Hover */
  .area-item:hover .area-card-inner {
    border-color: #cbd5e1;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.04);
  }

  /* Ícones de Emoji ou Imagem */
  .area-icon {
    font-size: 1.75rem;
    margin-bottom: 10px;
    transition: transform 0.2s;
  }

  /* Nome da Categoria */
  .area-name {
    font-size: 0.875rem;
    font-weight: 550;
    color: #475569;
    line-height: 1.3;
  }

  /* O Badge/Ícone de Selecionado (Escondido por padrão) */
  .select-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 18px;
    height: 18px;
    background: #2563eb;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0.5);
    transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    padding: 3px;
    box-sizing: border-box;
  }

  /* --- ESTADO ATIVO / SELECIONADO --- */
  /* Quando a checkbox adjacente estiver marada (:checked) */
  .area-checkbox:checked+.area-card-inner {
    border-color: #2563eb;
    background-color: #f0f5ff;
  }

  .area-checkbox:checked+.area-card-inner .area-name {
    color: #1e3a8a;
  }

  .area-checkbox:checked+.area-card-inner .area-icon {
    transform: scale(1.05);
  }

  /* Mostra o Badge de Check com animação fluida */
  .area-checkbox:checked+.area-card-inner .select-badge {
    opacity: 1;
    transform: scale(1);
  }

  .password-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    max-width: 450px;
    margin: 20px auto;
    box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.03);
    font-family: system-ui, -apple-system, sans-serif;
    box-sizing: border-box;
  }

  .password-header {
    margin-bottom: 20px;
  }

  .password-title {
    font-size: 1.25rem;
    color: #0f172a;
    margin: 0 0 4px 0;
    font-weight: 600;
  }

  .password-subtitle {
    font-size: 0.875rem;
    color: #64748b;
    margin: 0;
    line-height: 1.4;
  }

  .form-group {
    margin-bottom: 18px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    position: relative;
  }

  .form-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #475569;
  }

  .form-input {
    width: 100%;
    padding: 10px 12px;
    font-size: 0.95rem;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background-color: #fff;
    color: #1e293b;
    transition: all 0.2s;
    box-sizing: border-box;
  }

  .form-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
  }

  /* Medidor de Força da Senha */
  .strength-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-top: 6px;
  }

  .strength-meter {
    flex: 1;
    height: 6px;
    background-color: #e2e8f0;
    border-radius: 4px;
    overflow: hidden;
  }

  .strength-bar {
    height: 100%;
    width: 0%;
    border-radius: 4px;
    transition: width 0.3s ease, background-color 0.3s ease;
  }

  .strength-text {
    font-size: 0.75rem;
    font-weight: 600;
    color: #64748b;
    min-width: 75px;
    text-align: right;
  }

  /* Lista de Requisitos */
  .requirements-list {
    list-style: none;
    padding: 0;
    margin: 0 0 18px 0;
    background: #f8fafc;
    border-radius: 8px;
    padding: 12px;
  }

  .req-item {
    font-size: 0.8rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
    transition: color 0.2s;
  }

  .req-item:last-child {
    margin-bottom: 0;
  }

  /* Elemento visual para os requisitos (antes de validar) */
  .req-item::before {
    content: "•";
    font-weight: bold;
    color: #94a3b8;
  }

  /* Estado Válido dos Requisitos */
  .req-item.valid {
    color: #16a34a;
  }

  .req-item.valid::before {
    content: "✓";
    color: #16a34a;
  }

  /* Texto de Senhas Iguais/Diferentes */
  .match-text {
    font-size: 0.75rem;
    font-weight: 500;
    margin-top: 4px;
  }

  .match-text.error {
    color: #dc2626;
  }

  .match-text.success {
    color: #16a34a;
  }

  /* Botão */
  .password-actions {
    margin-top: 24px;
  }

  .btn {
    width: 100%;
    padding: 11px;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
  }

  .btn--primary {
    background-color: #3b82f6;
    color: white;
  }

  .btn--primary:hover:not(:disabled) {
    background-color: #2563eb;
  }

  .btn--primary:disabled {
    background-color: #94a3b8;
    cursor: not-allowed;
    opacity: 0.6;
  }
</style>