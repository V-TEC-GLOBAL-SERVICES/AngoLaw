<div class="sidebar-overlay"></div>

<!-- ===== SIDEBAR ===== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar__logo">
        <div class="sidebar__logo-icon">
            <img src="Imagens/IMG_4735.PNG" width="70" alt="">
        </div>
        <span class="sidebar__logo-text">AngoLaw</span>
    </div>
    <nav class="sidebar__nav">
        <p class="sidebar__nav-label">Menu</p>
        <ul class="sidebar__menu">
            <li class="sidebar__menu-item sidebar__menu-item--active">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=home" id="home" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-house"></i></span>
                    <span class="sidebar__menu-text">Início</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=educacao" id="educacao" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-book-open"></i></span>
                    <span class="sidebar__menu-text">Educação Jurídica</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=documentos" id="documentos" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-file-lines"></i></span>
                    <span class="sidebar__menu-text">Documentos</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=assistente" id="assistente" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-robot"></i></span>
                    <span class="sidebar__menu-text">Assistente IA</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=consultas" id="consultas" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-calendar-check"></i></span>
                    <span class="sidebar__menu-text">Consultas</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=regulador" id="regulador" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-shield-halved"></i></span>
                    <span class="sidebar__menu-text">Regulador</span>
                </a>
            </li>
            <?php if (isset($user['acesso']) && $user['acesso'] === 'Advogado') { ?>
            <li class="sidebar__menu-item">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=advogado" id="advogado" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-user-tie"></i></span>
                    <span class="sidebar__menu-text">Conta</span>
                </a>
            </li>
            <?php } else if (isset($user['acesso']) && $user['acesso'] === 'Administrador') { ?>
            <li class="sidebar__menu-item">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=administrador" id="administrador" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-user-shield"></i></span>
                    <span class="sidebar__menu-text">Administração</span>
                </a>
            </li>
            <?php } ?>
            <li class="sidebar__menu-item">
                <a href="index.php?pagina=<?= $_GET['pagina'] ?>&sub=inicio" id="inicio" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-shield-halved"></i></span>
                    <span class="sidebar__menu-text">Inicio</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <div onclick="logout('index.php?pagina=<?= $_GET['pagina'] ?>&sub=sair')" id="sair" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-close"></i></span>
                    <span class="sidebar__menu-text">sair</span>
                </div>
            </li>
        </ul>
    </nav>
    <div class="sidebar__footer">
        <div class="sidebar__user">
            <div class="sidebar__user-avatar"><?= str_split($user['nome'])['0']??'' ?></div>
            <div class="sidebar__user-info">
                <span class="sidebar__user-name"><?= $user['nome']??'' ?></span>
                <span class="sidebar__user-role"><?= $user['acesso']??'' ?></span>
            </div>
        </div>
    </div>
</aside>