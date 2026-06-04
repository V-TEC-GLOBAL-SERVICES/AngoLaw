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
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=home" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-house"></i></span>
                    <span class="sidebar__menu-text">Início</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=educacao" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-book-open"></i></span>
                    <span class="sidebar__menu-text">Educação Jurídica</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=documentos" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-file-lines"></i></span>
                    <span class="sidebar__menu-text">Documentos</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=assistente" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-robot"></i></span>
                    <span class="sidebar__menu-text">Assistente IA</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=consultas" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-calendar-check"></i></span>
                    <span class="sidebar__menu-text">Consultas</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=regulador" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-shield-halved"></i></span>
                    <span class="sidebar__menu-text">Regulador</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=advogado" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-user-tie"></i></span>
                    <span class="sidebar__menu-text">Conta</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=administrador" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-user-shield"></i></span>
                    <span class="sidebar__menu-text">Administração</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=inicio" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-shield-halved"></i></span>
                    <span class="sidebar__menu-text">Inicio</span>
                </a>
            </li>
            <li class="sidebar__menu-item">
                <a href="?pagina=<?= $_GET['pagina'] ?>&sub=sair" class="sidebar__menu-link">
                    <span class="sidebar__menu-icon"><i class="fa-solid fa-close"></i></span>
                    <span class="sidebar__menu-text">sair</span>
                </a>
            </li>
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