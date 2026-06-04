<div id="preloader">
    <div class="preloader-content">
        <svg width="80" height="80" viewBox="0 0 50 50" class="spinner-svg">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
        <h2 class="loader-text">AngoLaw</h2>
        <p class="loader-sub">Sincronizando seus dados...</p>
    </div>
</div>

<style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--navy-900);
        /* Fundo semi-transparente */
        backdrop-filter: blur(20px);
        /* Desfoque forte estilo Apple */
        -webkit-backdrop-filter: blur(20px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        /* Garante que fique acima de tudo */
        transition: opacity 0.6s ease, visibility 0.6s;
    }

    .preloader-content {
        text-align: center;
    }

    /* Estilo do SVG */
    .spinner-svg {
        animation: rotate 2s linear infinite;
        margin-bottom: 20px;
    }

    .spinner-svg .path {
        stroke: #0c3b89;
        /* Cor principal do seu sistema */
        stroke-linecap: round;
        animation: dash 1.5s ease-in-out infinite;
    }

    /* Textos do Loader */
    .loader-text {
        font-size: 1.2rem;
        font-weight: 800;
        color: #ffffff;
        margin: 0;
        letter-spacing: 1px;
    }

    .loader-sub {
        font-size: 0.8rem;
        color: #919db1;
        margin-top: 5px;
    }

    /* Animações Keyframes */
    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes dash {
        0% {
            stroke-dasharray: 1, 150;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 90, 150;
            stroke-dashoffset: -35;
        }

        100% {
            stroke-dasharray: 90, 150;
            stroke-dashoffset: -124;
        }
    }

    /* Classe para esconder o loader */
    .preloader-hidden {
        opacity: 0;
        visibility: hidden;
    }
</style>