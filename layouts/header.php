<header class="topbar">
    <div class="topbar__left">
        <button class="topbar__toggle" data-sidebar-toggle><i class="fa-solid fa-bars"></i></button>
        <div class="topbar__breadcrumb">
            <h1 class="topbar__title">Bem-vindo à AngoLaw</h1>
            <p class="topbar__subtitle">Aceda à ferramentas e soluções júridicas de forma simples, rápida e segura!</p>
        </div>
    </div>
    <div class="topbar__right">
        <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass" style="color:var(--text-muted);font-size:.85rem"></i>
            <input type="text" placeholder="Pesquisar modelos..." class="search-bar__input" />
        </div>
        <div class="user-btn">
            <div class="user-btn__avatar"><?= str_split($user['nome'])['0'] ?></div>
            <span class="user-btn__name"><?= $user['nome'] ?></span>
        </div>
    </div>
</header>