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

<?php
# criar var de usuario
$user = $_SESSION[$sessao];

# importar o aside
include_once 'layouts/aside.php';
# importar o preloader
include_once 'layouts/preloader.php';
?>

<!-- ===== MAIN ===== -->
<main class="main content-area">
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
            logout($sessao);
            break;
        case 'administrador':
            // verificar acesso
            $user['acesso'] !== 'Administrador' ? logout($sessao) : '';
            include "contas/{$sub}.php";
            break;
        case 'advogado':
            // verificar acesso
            $user['acesso'] !== 'Advogado' ? logout($sessao) : '';
            include "contas/{$sub}.php";
            break;
        case 'cliente':
            // verificar acesso
            $user['acesso'] !== 'Cliente' ? logout($sessao) : '';
            include "contas/{$sub}.php";
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

<!-- Ajax -->
<script>
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');

        // Adicionamos um pequeno delay de 500ms para a animação não ser "rápida demais" 
        // caso o site carregue instantaneamente, mantendo a elegância.
        setTimeout(() => {
            preloader.classList.add('preloader-hidden');

            // Opcional: Remove do DOM após a transição para economizar memória
            setTimeout(() => {
                preloader.style.display = 'none';
                preloader.remove();
            }, 1000);
        }, 2000); // :)
        // ativar menu
        updateActive();
    });

    // Substitua o seu querySelectorAll por isso:
    document.addEventListener('click', function(e) {
        // Procura se o clique foi em um link (<a>) ou dentro de um
        const link = e.target.closest('a');

        // Se não for um link, ou se for um link de logout/externo, deixa o navegador seguir o padrão
        if (!link) return;

        const href = link.getAttribute('href');
        if (!href || href.startsWith('http')) {
            return;
        }

        // Agora sim, paramos o recarregamento
        e.preventDefault();
        console.log('Link capturado via delegação:', href);

        // Lógica de extração de parâmetros
        const urlParts = href.split('?');
        const params = new URLSearchParams(urlParts.length > 1 ? urlParts[1] : "");
        const section = params.get('section') || 'home';

        // Atualiza histórico e interface
        history.pushState({
            path: href,
            section: section
        }, "", href);
        atualizarInterface(section, link);
        carregarConteudo(href);
    });

    function carregarConteudo(urlCompleta) {
        // Adicionamos &ajax=true para o PHP saber que NÃO deve enviar o Header/Footer
        const sep = urlCompleta.includes('?') ? '&' : '?';
        const urlFetch = `${urlCompleta}${sep}ajax=true`;

        fetch(urlFetch)
            .then(response => response.text())
            .then(html => {
                // 1. Transforma a string de texto em um documento HTML navegável
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // 2. Busca a div específica dentro desse novo "documento"
                const novoConteudo = doc.querySelector('.content-area');
                const areaAtual = document.querySelector('.content-area');

                if (novoConteudo && areaAtual) {


                    const scriptsAntigos = novoConteudo.querySelectorAll('script');
                    scriptsAntigos.forEach(s => s.remove());

                    // 3. Atualiza apenas o conteúdo interno (innerHTML) 
                    // ou o elemento todo (replaceWith)
                    areaAtual.replaceWith(novoConteudo);
                    //areaAtual.innerHTML = novoConteudo.innerHTML;

                    // atualizar scripts
                    atualizarScripts(html);

                    // ativar menu
                    updateActive();

                    // Dica: Se quiser atualizar o título da página também:
                    const novoTitulo = doc.querySelector('title');
                    if (novoTitulo) document.title = novoTitulo.innerText;
                }
            })
            .catch(err => console.error('Erro ao carregar conteúdo:', err));
    }

    function logout(href) {

        var sessao = confirm("Desejas terminar a tua sessão?");

        if (!sessao) return;

        sessionStorage.removeItem('active');
        sessionStorage.clear();
        console.log(sessionStorage);

        // Lógica de extração de parâmetros
        const urlParts = href.split('?');
        const params = new URLSearchParams(urlParts.length > 1 ? urlParts[1] : "");
        const section = params.get('section') || 'home';

        // Atualiza histórico e interface
        history.pushState({
            path: href,
            section: section
        }, "", href);

        carregarConteudo(href);
    }

    function atualizarInterface(section, elementoClicado) {

        // Controle da classe Active (se o clique foi no menu inferior)
        const element = elementoClicado.closest('nav a') ?? null;
        if (element && element.id) {
            // Salvar dados no nevegador de forma temporaria
            sessionStorage.setItem("active", element.id);
        }
    }

    // atualizar o botao clicado
    function updateActive() {
        // Controle da classe Active (se o clique foi no menu inferior)
        const element = document.getElementById(sessionStorage.getItem('active') ?? null); //.closest('li')??null;
        if (element) {
            document.querySelectorAll('nav a').forEach(item => item.classList.remove('active'));
            element.classList.add('active');
        }
    }

    // Lida com o botão "Voltar/Avançar" do navegador
    window.onpopstate = function(event) {
        if (event.state && event.state.path) {
            carregarConteudo(event.state.path);
            atualizarInterface(event.state.section, null);
        }
    };

    function atualizarScripts(htmlRecebido) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(htmlRecebido, 'text/html');

        const novoConteudo = doc.querySelector('.content-area');
        const areaAtual = document.querySelector('.content-area');

        if (novoConteudo && areaAtual) {
            // 1. LIMPEZA SEGURA DO CONTAINER
            // Antes de injetar o novo HTML, removemos manualmente os scripts antigos
            // que ainda podem estar pendentes no DOM do container atual.
            // const scriptsAntigos = areaAtual.querySelectorAll('script');
            // scriptsAntigos.forEach(s => s.remove());

            // 2. ATUALIZAÇÃO DO HTML VISUAL
            // Injetamos o conteúdo (isso não executará os scripts automaticamente)
            //areaAtual.replaceWith(novoConteudo);

            // 3. REINJEÇÃO DOS SCRIPTS (Ativação Automática)
            // Buscamos os scripts que vieram no 'novoConteudo' (parseado)
            const scriptsParaExecutar = novoConteudo.querySelectorAll('script');

            scriptsParaExecutar.forEach(oldScript => {
                // Criamos um novo elemento do zero para "burlar" o bloqueio de XSS
                const newScript = document.createElement('script');

                // Copiamos todos os atributos (src, type, data-*, etc.)
                Array.from(oldScript.attributes).forEach(attr => {
                    newScript.setAttribute(attr.name, attr.value);
                });

                // Se o script tiver código interno (inline), copiamos o texto
                if (oldScript.innerHTML) {
                    newScript.textContent = oldScript.innerHTML;
                }

                // 4. INSERÇÃO NO CONTAINER
                // Ao inserir no 'areaAtual', o navegador executa o script imediatamente
                // sem afetar os scripts que já existem no <body> ou <head>.
                areaAtual.appendChild(newScript);
                // if(confirm("Desejas inserir o script: \n"+newScript.innerHTML)){
                //     areaAtual.appendChild(newScript);
                //     console.log("Script inserido");
                // }

                // Opcional: Se for um script inline (como o seu setTimeout de limpeza), 
                // você pode removê-lo da estrutura HTML após a execução para manter o DOM limpo.
                if (!newScript.src) {
                    //newScript.remove();
                }
            });

            console.log("Scripts do container sincronizados com sucesso.");
        } else {
            console.error("Erro: Container .content-area não encontrado na resposta AJAX.");
        }
    }

    document.addEventListener('submit', function(e) {
        const form = e.target;

        // Intercepta apenas se estiver na área dinâmica
        if (form.closest('.content-area')) {
            e.preventDefault();

            // 1. Criamos o FormData com os campos normais
            const formData = new FormData(form);

            // 2. CAPTURA O BOTÃO QUE DISPAROU O ENVIO
            // O e.submitter retorna o elemento <button> ou <input type="submit"> clicado
            const botaoClicado = e.submitter;

            if (botaoClicado && botaoClicado.name) {
                // Adicionamos o nome e o valor do botão ao FormData
                formData.append(botaoClicado.name, botaoClicado.value);

                // Log para debug: veja no console se o botão está subindo
                console.log(`Botão capturado: ${botaoClicado.name} = ${botaoClicado.value}`);
            }

            const url = form.getAttribute('action') || window.location.href;
            const sep = url.includes('?') ? '&' : '?';
            const urlFetch = `${url}${sep}ajax=true`;

            enviarFormulario(urlFetch, formData, botaoClicado.id);
        }
    });

    function enviarFormulario(url, data, botao) {
        // Exibe um feedback visual opcional (Ex: Spinner no botão)
        const btnSubmit = document.getElementById(botao);
        //alert(btnSubmit);
        const originalText = btnSubmit ? btnSubmit.innerHTML : '';
        if (btnSubmit) btnSubmit.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Enviando...';

        fetch(url, {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const novoConteudo = doc.querySelector('.content-area');
                const areaAtual = document.querySelector('.content-area');

                if (novoConteudo && areaAtual) {
                    areaAtual.replaceWith(novoConteudo);

                    // atualizar scripts
                    atualizarScripts(html);

                    // Se houver uma mensagem de sucesso no novo conteúdo, podemos disparar um alerta
                    console.log('Formulário processado com sucesso via AJAX');
                }
            })
            .catch(err => {
                console.error('Erro no envio POST:', err);
                alert('Erro ao conectar com o servidor.');
            })
            .finally(() => {
                // Restaura o botão se a página não tiver sido totalmente substituída
                if (btnSubmit && document.body.contains(btnSubmit)) {
                    btnSubmit.innerHTML = originalText;
                }
            });
    }

    /**
     * Atualiza o componente de notificações sem depender da URL da página atual.
     * Foca apenas no arquivo de processamento 'notificacao.php'.
     */
    function atualizarFuncoesSilencioso() {
        // Caminho fixo para o processador de notificações
        const url = window.location.href;

        // Adicionamos um marcador para o PHP saber que é uma requisição AJAX POST
        const sep = url.includes('?') ? '&' : '?';
        const urlFetch = `${url}${sep}ajax=true`;

        fetch(urlFetch, {
                method: 'GET',
                cache: 'no-store' // Garante que traga dados novos do servidor
            })
            .then(response => {
                if (!response.ok) throw new Error('Falha na requisição');
                return response.text();
            })
            .then(html => {
                // 1. Converte o texto recebido em elementos DOM
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // 2. Busca o novo conteúdo (vido do PHP) e o alvo atual na sua página
                const novoConteudo = doc.getElementById('updateFunctionPHP');
                const areaAtual = document.getElementById('updateFunctionPHP');

                // 3. Atualiza apenas se ambos existirem, evitando erros de console
                if (novoConteudo && areaAtual) {
                    // Usamos innerHTML para manter os event listeners da div pai ou 
                    // replaceWith se quisermos substituir o container inteiro.
                    areaAtual.innerHTML = novoConteudo.innerHTML;
                    //areaAtual.replaceWith(novoConteudo);

                    // Log opcional para debug (pode remover depois)
                    //console.log('Funcoes atualizadas às ' + new Date().toLocaleTimeString());
                }
            })
            .catch(err => console.warn('Aviso: Não foi possível atualizar funcoes.', err));
    }

    // atualizar notificacoes
    function notificationUpdate() {
        // Após atualizar o innerHTML
        const toastData = document.querySelectorAll('#pending-toast') || null;
        //alert(toastData);
        if (toastData) {
            toastData.forEach(element => {
                const type = element.getAttribute('data-type');
                const title = element.getAttribute('data-title');
                const msg = element.getAttribute('data-msg');

                // Chama a sua função que já existe no escopo global
                createToast(type, title, msg);

                // Remove o elemento para não disparar duplicado
                //toastData.remove();
                console.log("Notificacao enviada");
            });
        }
    }

    // Execução automática a cada 5 segundos
    // setInterval(() => {
    //     // updateActive();
    //     //notificationUpdate();
    //     atualizarFuncoesSilencioso();
    // }, 5000);
</script>