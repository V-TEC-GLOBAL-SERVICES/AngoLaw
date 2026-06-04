<!-- Pagina de gerenciamento de rotas -->
<link rel="stylesheet" href="estilos/imports.css">

<style>
    /* ════════════════════════════════════
       FLOATING AI BUTTON
    ════════════════════════════════════ */
    .fab-ai {
        position: fixed;
        bottom: 28px;
        right: 28px;
        z-index: 200;
        display: flex;
        align-items: center;
        gap: 0;
        background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-700, #1e3058) 100%);
        color: #fff;
        border-radius: 50px;
        box-shadow: 0 6px 24px rgba(15, 27, 53, .28), 0 2px 8px rgba(15, 27, 53, .15);
        text-decoration: none;
        overflow: hidden;
        transition: box-shadow var(--transition), transform var(--transition);
        max-width: 52px;
    }

    .fab-ai:hover {
        box-shadow: 0 10px 32px rgba(15, 27, 53, .35), 0 4px 12px rgba(15, 27, 53, .2);
        transform: translateY(-2px);
        max-width: 220px;
    }

    .fab-ai__icon {
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        color: var(--accent-gold, #c9a84c);
        font-size: 1.2rem;
    }

    .fab-ai__label {
        white-space: nowrap;
        font-size: .85rem;
        font-weight: 600;
        padding-right: 18px;
        opacity: 0;
        max-width: 0;
        overflow: hidden;
        transition: opacity .25s ease, max-width .35s ease, padding-right .35s ease;
    }

    .fab-ai:hover .fab-ai__label {
        opacity: 1;
        max-width: 160px;
        padding-right: 18px;
    }

    /* gold pulse ring */
    .fab-ai::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50px;
        border: 2px solid var(--accent-gold, #c9a84c);
        opacity: 0;
        animation: fabPulse 2.5s ease-in-out infinite;
    }

    @keyframes fabPulse {
        0% {
            transform: scale(1);
            opacity: .5;
        }

        70% {
            transform: scale(1.12);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 0;
        }
    }
</style>

<?php include_once 'layouts/aside.php' ?>

<!-- ===== MAIN ===== -->
<main class="main">
    <?php
    # importar o header
    include_once 'layouts/header.php';

    # verificar a url
    //$pagina = $_GET['page'] ?? 'advogado';
    $sub = $_GET['sub'] ?? 'home';

    # gerenciar rotas
    switch ($sub) {
        case 'assistente':
            include __DIR__ . "/{$sub}.php";
            break;
        case 'consultas':
            include __DIR__ . "/{$sub}.php";
            break;
        case 'documentos':
            include __DIR__ . "/{$sub}.php";
            break;
        case 'educacao':
            include __DIR__ . "/{$sub}.php";
            break;
        case 'regulador':
            include __DIR__ . "/{$sub}.php";
            break;
        case 'home':
            include __DIR__ . "/{$sub}.php";
            break;
        case 'sair':
            include __DIR__ . "/{$sub}.php";
            break;
        case 'administrador':
            // verificar acesso
            include __DIR__ . "/contas/{$sub}.php";
            break;
        case 'advogado':
            // verificar acesso
            include __DIR__ . "/contas/{$sub}.php";
            break;
        case 'cliente':
            // verificar acesso
            include __DIR__ . "/contas/{$sub}.php";
            break;
        default:
            echo '<h2>Página não encontrada</h2>';
    }
    ?>

    <!-- ════ FLOATING AI BUTTON ════ -->
    <a href="?pagina=<?= $_GET['pagina'] ?>&sub=assistente" class="fab-ai" aria-label="Abrir Assistente IA">
        <div class="fab-ai__icon"><i class="fa-solid fa-robot"></i></div>
        <span class="fab-ai__label">Assistente IA</span>
    </a>
</main>