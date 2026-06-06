<!-- Pagina de login e cadastro -->

<?php

# validar TOKEN
isset($_POST['login']) ? login($connect) : '';
isset($_POST['register']) ? setterUser($connect) : '';

$validate = $_SESSION[session_id()]['csrf_token'] ?? null;

?>

<link rel="stylesheet" href="estilos/auth.css" />

<!-- Back to landing -->
<a href="?page=inicio" class="back-link">
  <i class="fa-solid fa-arrow-left"></i> Voltar
</a>

<div class="auth-card">
  <!-- Logo -->
  <div class="auth-card__logo">
    <div class="auth-card__logo-icon">
      <i class="fa-solid fa-scale-balanced"></i>
    </div>
    <span class="auth-card__brand">AngoLaw</span>
    <span class="auth-card__tagline">Aceda à sua plataforma jurídica</span>
  </div>

  <!-- Tab switcher -->
  <div class="auth-tabs" role="tablist">
    <button class="auth-tab <?= ($_GET['sub'] ?? '') == 'Entrar' ? 'auth-tab--active' : '' ?>" id="tab-login" role="tab" aria-selected="false" onclick="switchTab('login')"> Entrar </button>
    <button class="auth-tab <?= ($_GET['sub'] ?? '') != 'Entrar' ? 'auth-tab--active' : '' ?>" id="tab-register" role="tab" aria-selected="true" onclick="switchTab('register')"> Registar </button>
  </div>

  <!-- ===== LOGIN PANEL ===== -->
  <form method="post" class="auth-panel <?= (($_GET['sub'] ?? '') == 'Entrar') ? 'auth-panel auth-panel--active' : '' ?>" id="panel-login" role="tabpanel">
    <div class="error-msg" id="login-error">
      <i class="fa-solid fa-circle-exclamation"></i>
      <span>Email ou palavra-passe incorretos. Tente novamente.</span>
    </div>

    <div class="form-group">
      <label for="login-email">Email</label>
      <div class="input-wrap">
        <i class="fa-solid fa-envelope input-wrap__icon"></i>
        <input type="email" name="email" id="login-email" placeholder="seu@vconnect.com" autocomplete="email" required/>
      </div>
    </div>

    <div class="form-group">
      <label for="login-pwd">Palavra-passe</label>
      <div class="input-wrap">
        <i class="fa-solid fa-lock input-wrap__icon"></i>
        <input type="password" name="passe" id="login-pwd" placeholder="A sua palavra-passe" autocomplete="current-password" required/>
        <button class="pwd-toggle" type="button" onclick="togglePwd('login-pwd', this)" aria-label="Mostrar palavra-passe"> <i class="fa-solid fa-eye"></i> </button>
      </div>
    </div>

    <div class="form-options">
      <a href="#" class="forgot-link">Esqueceu a palavra-passe?</a>
    </div>

    <button type="submit" class="btn-submit" name="login" value="<?= $validate ?>" onclick="handleLogin()">
      <i class="fa-solid fa-right-to-bracket"></i> Entrar na conta
    </button>

    <div class="divider">ou continue com</div>

    <div class="social-btns">
      <button class="btn-social">
        <i class="fa-brands fa-google" style="color: #4285f4"></i> V-CONNECT
      </button>
    </div>
  </form>

  <!-- ===== REGISTER PANEL ===== -->
  <form method="post" class="auth-panel <?= (($_GET['sub'] ?? '') != 'Entrar') ? 'auth-panel auth-panel--active' : '' ?>" id="panel-register" role="tabpanel">
    <div class="success-msg" id="register-success">
      <i class="fa-solid fa-circle-check"></i>
      <span>Conta criada com sucesso!</span>
    </div>

    <div class="error-msg" id="register-error">
      <i class="fa-solid fa-circle-exclamation"></i>
      <span id="register-error-text">Por favor preencha todos os campos corretamente.</span>
    </div>

    <!-- Nome completo -->
    <div class="form-group">
      <label for="reg-name">Nome completo</label>
      <div class="input-wrap">
        <i class="fa-solid fa-user input-wrap__icon"></i>
        <input type="text" name="nome" id="reg-name" placeholder="O seu nome" autocomplete="name" oninput="validateName(this)" required/>
      </div>
    </div>

    <!-- Email -->
    <div class="form-group">
      <label for="reg-email">Email</label>
      <div class="input-wrap">
        <i class="fa-solid fa-envelope input-wrap__icon"></i>
        <input type="email" name="email" id="reg-email" placeholder="seu@email.com" autocomplete="email" oninput="validateEmail(this)" required/>
        <i class="fa-solid fa-circle-check input-wrap__suffix" id="email-check" style="display: none; color: var(--green-500)"></i>
      </div>
    </div>

    <!-- Palavra-passe -->
    <div class="form-group">
      <label for="reg-pwd">Palavra-passe</label>
      <div class="input-wrap">
        <i class="fa-solid fa-lock input-wrap__icon"></i>
        <input type="password" name="senha" id="reg-pwd" placeholder="Mín. 6 caracteres" autocomplete="new-password" oninput="checkStrength(this)" required/>
        <button class="pwd-toggle" type="button" onclick="togglePwd('reg-pwd', this)" aria-label="Mostrar palavra-passe"> <i class="fa-solid fa-eye"></i>
        </button>
      </div>
      <!-- Password strength bars -->
      <div class="pwd-strength" id="pwd-strength-bars">
        <div class="pwd-strength__bar" id="bar-1"></div>
        <div class="pwd-strength__bar" id="bar-2"></div>
        <div class="pwd-strength__bar" id="bar-3"></div>
        <div class="pwd-strength__bar" id="bar-4"></div>
      </div>
      <p class="pwd-strength__label" id="pwd-strength-label"></p>
    </div>

    <!-- Termos -->
    <div class="check-row">
      <input type="checkbox" id="reg-terms" name="termos" value="sim" required/>
      <label for="reg-terms">
        Aceito os <a href="#">Termos de Serviço</a> e a
        <a href="#">Política de Privacidade</a> da AngoLaw.
      </label>
    </div>

    <button class="btn-submit" name="register" type="submit" value="1">
      <i class="fa-solid fa-user-plus"></i> Criar conta
    </button>

    <div class="divider">ou registe-se com</div>

    <div class="social-btns">
      <button class="btn-social">
        <i class="fa-brands fa-google" style="color: #ea4335"></i> V-CONNECT
      </button>
    </div>
  </form>

  <!-- Footer note -->
  <p class="auth-card__footer-note" id="auth-footer-note">
    Já tem conta?
    <a href="#" onclick="switchTab('login');return false;">Entrar</a>
  </p>
</div>

<!-- ===== SCRIPT ===== -->
<script>
  /* ── Tab switching ── */
  function switchTab(tab) {
    const panels = {
      login: "panel-login",
      register: "panel-register"
    };
    const tabs = {
      login: "tab-login",
      register: "tab-register"
    };

    Object.keys(panels).forEach((k) => {
      document
        .getElementById(panels[k])
        .classList.toggle("auth-panel--active", k === tab);
      document
        .getElementById(tabs[k])
        .classList.toggle("auth-tab--active", k === tab);
    });

    const note = document.getElementById("auth-footer-note");
    if (tab === "login") {
      note.innerHTML = `Não tem conta? <a href="#" onclick="switchTab('register');return false;">Criar conta grátis</a>`;
    } else {
      note.innerHTML = `Já tem conta? <a href="#" onclick="switchTab('login');return false;">Entrar</a>`;
    }

    // auto-activate register tab if URL has #register
    hideMessages();
  }

  /* ── Hide all messages ── */
  function hideMessages() {
    ["login-error", "register-error", "register-success"].forEach((id) => {
      const el = document.getElementById(id);
      if (el) el.classList.remove("show");
    });
  }

  /* ── Toggle password visibility ── */
  function togglePwd(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector("i");
    const isText = input.type === "text";
    input.type = isText ? "password" : "text";
    icon.className = isText ? "fa-solid fa-eye" : "fa-solid fa-eye-slash";
  }

  /* ── Email validation ── */
  function validateEmail(input) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const check = document.getElementById("email-check");
    if (re.test(input.value)) {
      input.classList.add("valid");
      input.classList.remove("invalid");
      if (check) check.style.display = "block";
    } else {
      input.classList.remove("valid");
      if (input.value.length > 3) input.classList.add("invalid");
      if (check) check.style.display = "none";
    }
  }

  /* ── Name validation ── */
  function validateName(input) {
    const valid =
      input.value.trim().split(" ").length >= 2 &&
      input.value.trim().length >= 4;
    input.classList.toggle("valid", valid);
    input.classList.toggle("invalid", !valid && input.value.length > 2);
  }

  /* ── Password strength ── */
  function checkStrength(input) {
    const val = input.value;
    const bars = [1, 2, 3, 4].map((i) => document.getElementById("bar-" + i));
    const label = document.getElementById("pwd-strength-label");

    let score = 0;
    if (val.length >= 6) score++;
    if (val.length >= 10) score++;
    if (/[A-Z]/.test(val) && /[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    bars.forEach((b, i) => {
      b.className = "pwd-strength__bar";
      if (i < score) {
        if (score <= 1) b.classList.add("pwd-strength__bar--weak");
        else if (score <= 2) b.classList.add("pwd-strength__bar--medium");
        else b.classList.add("pwd-strength__bar--strong");
      }
    });

    //alert(score);

    const labels = ["Facíl", "Fraca", "Razoável", "Boa", "Forte"];
    label.textContent = val.length > 0 ? labels[score] || "Forte" : "";
    label.style.color =
      score <= 1 ?
      "var(--red-500)" :
      score <= 2 ?
      "var(--accent-gold)" :
      "var(--green-500)";
  }

  /* ── LOGIN handler ── */
  function handleLogin() {
    const email = document.getElementById("login-email").value.trim();
    const pwd = document.getElementById("login-pwd").value;
    const errEl = document.getElementById("login-error");

    errEl.classList.remove("show");

    if (!email || !pwd) {
      errEl.querySelector("span").textContent =
        "Por favor preencha todos os campos.";
      errEl.classList.add("show");
      return;
    }

    // Simulate auth — in production, this calls your API
    const btn = document.querySelector("#panel-login .btn-submit");
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> A entrar…';

    setTimeout(() => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fa-solid fa-right-to-bracket"></i> Entrar na conta';
    }, 1000);
  }

  /* ── REGISTER handler ── */
  function handleRegister() {
    const name = document.getElementById("reg-name").value.trim();
    const email = document.getElementById("reg-email").value.trim();
    const pwd = document.getElementById("reg-pwd").value;
    const terms = document.getElementById("reg-terms").checked;

    const successEl = document.getElementById("register-success");
    const errEl = document.getElementById("register-error");
    const errText = document.getElementById("register-error-text");

    successEl.classList.remove("show");
    errEl.classList.remove("show");

    // Validations
    if (!name || name.split(" ").length < 2) {
      errText.textContent = "Introduza o seu nome completo (nome e apelido).";
      errEl.classList.add("show");
      return;
    }
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!re.test(email)) {
      errText.textContent = "Introduza um endereço de email válido.";
      errEl.classList.add("show");
      return;
    }
    if (pwd.length < 6) {
      errText.textContent = "A palavra-passe deve ter pelo menos 6 caracteres.";
      errEl.classList.add("show");
      return;
    }
    if (!terms) {
      errText.textContent = "Deve aceitar os Termos de Serviço para continuar.";
      errEl.classList.add("show");
      return;
    }

    // Simulate API call
    const btn = document.querySelector("#panel-register .btn-submit");
    btn.disabled = true;
    btn.innerHTML =
      '<i class="fa-solid fa-spinner fa-spin"></i> A criar conta…';

    setTimeout(() => {
      btn.disabled = false;
      btn.innerHTML = '<i class="fa-solid fa-user-plus"></i> Criar conta';
      successEl.classList.add("show");
      // setTimeout(() => {
      //   window.location.href = "index.html";
      // }, 1800);
    }, 1200);
  }

  /* ── Init: check URL hash ── */
  //if (window.location.hash === "sub=Entrar") switchTab("login");
</script>