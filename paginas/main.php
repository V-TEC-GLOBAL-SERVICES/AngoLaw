<!-- Pagina de gerenciamento de rotas -->

<?php include_once 'layouts/aside.php' ?>

<!-- ===== MAIN ===== -->
<main class="main">
    <?php
    # verificar a url
    //$pagina = $_GET['page'] ?? 'advogado';
    $sub = $_GET['sub'] ?? 'home';

    # gerenciar rotas
    switch($sub){
        case 'assistente':
            include __DIR__ . "/contas/{$sub}.php";
            break;
        case 'consultas':
            include __DIR__ . "/contas/{$sub}.php";
            break;
        case 'documentos':
            include __DIR__ . "/contas/{$sub}.php";
            break;
        case 'educacao':
            include __DIR__ . "/contas/{$sub}.php";
            break;
        case 'regulador':
            include __DIR__ . "/contas/{$sub}.php";
            break;
        case 'home':
            include __DIR__ . "/contas/{$sub}.php";
            break;
        case 'sair':
            include __DIR__ . "/contas/{$sub}.php";
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
</main>