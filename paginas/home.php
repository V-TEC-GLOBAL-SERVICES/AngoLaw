 <!-- ===== MAIN ===== -->

 <style>
     /* ════════════════════════════════════
       VIDEO CAROUSEL
    ════════════════════════════════════ */
     .video-carousel {
         position: relative;
     }

     .video-carousel__track-wrap {
         overflow: hidden;
         border-radius: var(--radius-lg);
     }

     .video-grid {
         display: flex;
         gap: 22px;
         transition: transform .4s cubic-bezier(.4, 0, .2, 1);
         will-change: transform;
     }

     .video-grid .video-card {
         flex: 0 0 calc((100% - 44px) / 3);
         min-width: 0;
     }

     .video-card {
         background: var(--bg-card);
         border: 1px solid var(--border);
         border-radius: var(--radius-lg);
         overflow: hidden;
         box-shadow: var(--shadow-sm);
         transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
         cursor: pointer;
     }

     .video-card:hover {
         transform: translateY(-4px);
         box-shadow: var(--shadow-lg);
         border-color: var(--border-strong);
     }

     .video-card__thumb {
         position: relative;
         height: 185px;
         overflow: hidden;
     }

     .video-card__thumb--1 {
         background: linear-gradient(160deg, rgba(11, 19, 37, .55) 0%, rgba(11, 19, 37, .15) 100%), linear-gradient(135deg, #1a3a6e 0%, #2d5fa6 50%, #1e2d55 100%);
     }

     .video-card__thumb--2 {
         background: linear-gradient(160deg, rgba(11, 19, 37, .5) 0%, rgba(11, 19, 37, .1) 100%), linear-gradient(135deg, #1a5c3a 0%, #28855a 50%, #12412a 100%);
     }

     .video-card__thumb--3 {
         background: linear-gradient(160deg, rgba(11, 19, 37, .5) 0%, rgba(11, 19, 37, .1) 100%), linear-gradient(135deg, #4a1c6e 0%, #7c3aed 50%, #2d0d55 100%);
     }

     .video-card__thumb--4 {
         background: linear-gradient(160deg, rgba(11, 19, 37, .5) 0%, rgba(11, 19, 37, .1) 100%), linear-gradient(135deg, #5c1a1a 0%, #a63a2a 50%, #551e12 100%);
     }

     .video-card__thumb--5 {
         background: linear-gradient(160deg, rgba(11, 19, 37, .5) 0%, rgba(11, 19, 37, .1) 100%), linear-gradient(135deg, #0d4a4a 0%, #0d9488 50%, #084040 100%);
     }

     .video-card__thumb::after {
         content: '';
         position: absolute;
         inset: 0;
         background-image: repeating-linear-gradient(90deg, transparent, transparent 18px, rgba(255, 255, 255, .025) 18px, rgba(255, 255, 255, .025) 19px);
     }

     .video-card__overlay {
         position: absolute;
         inset: 0;
         display: grid;
         place-items: center;
         z-index: 2;
         opacity: 0;
         background: rgba(11, 19, 37, .3);
         transition: opacity var(--transition);
     }

     .video-card:hover .video-card__overlay {
         opacity: 1;
     }

     .video-card__play {
         width: 52px;
         height: 52px;
         background: rgba(255, 255, 255, .95);
         border-radius: 50%;
         display: grid;
         place-items: center;
         color: var(--navy-900);
         box-shadow: 0 4px 20px rgba(0, 0, 0, .3);
         transform: scale(.85);
         transition: transform var(--transition);
     }

     .video-card:hover .video-card__play {
         transform: scale(1);
     }

     .video-card__duration {
         position: absolute;
         bottom: 10px;
         right: 10px;
         background: rgba(11, 19, 37, .8);
         color: #fff;
         font-size: .72rem;
         font-weight: 500;
         padding: 3px 8px;
         border-radius: 5px;
         z-index: 3;
         backdrop-filter: blur(4px);
         -webkit-backdrop-filter: blur(4px);
     }

     .video-card__badge {
         position: absolute;
         top: 10px;
         left: 10px;
         background: var(--accent-gold);
         color: var(--navy-900);
         font-size: .65rem;
         font-weight: 700;
         letter-spacing: .05em;
         text-transform: uppercase;
         padding: 3px 8px;
         border-radius: 5px;
         z-index: 3;
     }

     .video-card__body {
         padding: 18px 20px 20px;
     }

     .video-card__title {
         font-size: .97rem;
         font-weight: 600;
         color: var(--text-primary);
         line-height: 1.4;
         margin: 10px 0 7px;
         transition: color var(--transition);
     }

     .video-card:hover .video-card__title {
         color: var(--blue-600);
     }

     .video-card__desc {
         font-size: .82rem;
         color: var(--text-secondary);
         line-height: 1.55;
         font-weight: 300;
         margin-bottom: 14px;
     }

     .video-card__meta {
         display: flex;
         align-items: center;
         justify-content: space-between;
         padding-top: 12px;
         border-top: 1px solid var(--border);
     }

     .video-card__views,
     .video-card__date {
         font-size: .75rem;
         color: var(--text-muted);
     }

     /* ── Shared carousel controls ── */
     .carousel-btn {
         position: absolute;
         top: 50%;
         transform: translateY(calc(-50% - 28px));
         width: 40px;
         height: 40px;
         border-radius: 50%;
         background: var(--bg-card);
         border: 1px solid var(--border);
         box-shadow: var(--shadow-md);
         display: grid;
         place-items: center;
         cursor: pointer;
         color: var(--text-primary);
         font-size: .9rem;
         transition: background var(--transition), color var(--transition), opacity var(--transition), box-shadow var(--transition);
         z-index: 10;
     }

     .carousel-btn:hover {
         background: var(--navy-900);
         color: #fff;
         box-shadow: var(--shadow-lg);
     }

     .carousel-btn:disabled {
         opacity: .25;
         cursor: default;
         pointer-events: none;
     }

     .carousel-btn--prev {
         left: -20px;
     }

     .carousel-btn--next {
         right: -20px;
     }

     .carousel-dots {
         display: flex;
         justify-content: center;
         gap: 7px;
         margin-top: 20px;
     }

     .carousel-dot {
         width: 7px;
         height: 7px;
         border-radius: 50%;
         background: var(--border-strong);
         border: none;
         cursor: pointer;
         padding: 0;
         transition: background var(--transition), transform var(--transition);
     }

     .carousel-dot--active {
         background: var(--accent-gold);
         transform: scale(1.35);
     }

     /* ════════════════════════════════════
       SERVICES CAROUSEL
    ════════════════════════════════════ */
     .services-carousel {
         position: relative;
     }

     .services-carousel__track-wrap {
         overflow: hidden;
         border-radius: var(--radius-lg);
     }

     .services-grid {
         display: flex;
         gap: 18px;
         transition: transform .4s cubic-bezier(.4, 0, .2, 1);
         will-change: transform;
     }

     .services-grid .service-card {
         flex: 0 0 calc((100% - 54px) / 4);
         min-width: 0;
     }

     .service-card {
         background: var(--bg-card);
         border: 1px solid var(--border);
         border-radius: var(--radius-lg);
         padding: 26px 22px;
         box-shadow: var(--shadow-sm);
         transition: transform var(--transition), box-shadow var(--transition);
         cursor: pointer;
         position: relative;
         overflow: hidden;
     }

     .service-card::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         height: 3px;
         border-radius: var(--radius-lg) var(--radius-lg) 0 0;
         opacity: 0;
         transition: opacity var(--transition);
     }

     .service-card--blue::before {
         background: var(--blue-500);
     }

     .service-card--green::before {
         background: var(--green-500);
     }

     .service-card--purple::before {
         background: var(--purple-500);
     }

     .service-card--amber::before {
         background: var(--amber-500);
     }

     .service-card--teal::before {
         background: var(--teal-500, #14b8a6);
     }

     .service-card--red::before {
         background: var(--red-500);
     }

     .service-card:hover {
         transform: translateY(-4px);
         box-shadow: var(--shadow-md);
     }

     .service-card:hover::before {
         opacity: 1;
     }

     .service-card__icon-wrap {
         width: 46px;
         height: 46px;
         border-radius: 12px;
         display: grid;
         place-items: center;
         margin-bottom: 16px;
         font-size: 1.1rem;
         transition: transform var(--transition);
     }

     .service-card:hover .service-card__icon-wrap {
         transform: scale(1.08);
     }

     .service-card--blue .service-card__icon-wrap {
         background: var(--blue-50);
         color: var(--blue-500);
     }

     .service-card--green .service-card__icon-wrap {
         background: var(--green-50);
         color: var(--green-500);
     }

     .service-card--purple .service-card__icon-wrap {
         background: var(--purple-50);
         color: var(--purple-500);
     }

     .service-card--amber .service-card__icon-wrap {
         background: var(--amber-50);
         color: var(--amber-500);
     }

     .service-card--teal .service-card__icon-wrap {
         background: #f0fdfa;
         color: #0d9488;
     }

     .service-card--red .service-card__icon-wrap {
         background: var(--red-50);
         color: var(--red-500);
     }

     .service-card__title {
         font-size: 1rem;
         font-weight: 600;
         color: var(--text-primary);
         margin-bottom: 7px;
     }

     .service-card__desc {
         font-size: .82rem;
         color: var(--text-secondary);
         line-height: 1.5;
         font-weight: 300;
         margin-bottom: 20px;
     }

     .service-card__cta {
         font-size: .8rem;
         font-weight: 600;
         transition: color var(--transition);
     }

     .service-card--blue .service-card__cta {
         color: var(--blue-500);
     }

     .service-card--green .service-card__cta {
         color: var(--green-600);
     }

     .service-card--purple .service-card__cta {
         color: var(--purple-500);
     }

     .service-card--amber .service-card__cta {
         color: var(--amber-600);
     }

     .service-card--teal .service-card__cta {
         color: #0d9488;
     }

     .service-card--red .service-card__cta {
         color: var(--red-600);
     }

     /* mobile: always show label */
     @media (max-width: 640px) {
         .fab-ai {
             max-width: 52px;
             bottom: 20px;
             right: 16px;
         }

         .fab-ai__label {
             display: none;
         }
     }

     /* ════════════════════════════════════
       RESPONSIVE
    ════════════════════════════════════ */
     @media (max-width:1100px) {
         .video-grid .video-card {
             flex: 0 0 calc((100% - 22px) / 2);
         }

         .services-grid .service-card {
             flex: 0 0 calc((100% - 18px) / 2);
         }

         .carousel-btn--prev {
             left: -14px;
         }

         .carousel-btn--next {
             right: -14px;
         }
     }

     @media (max-width:640px) {
         .video-grid .video-card {
             flex: 0 0 100%;
         }

         .services-grid .service-card {
             flex: 0 0 100%;
         }
     }
 </style>

 <!-- Stats Strip -->
 <div class="stats-strip">
     <div class="stat-item"><span class="stat-item__number">48</span><span class="stat-item__label">Vídeos disponíveis</span></div>
     <div class="stat-divider"></div>
     <div class="stat-item"><span class="stat-item__number">120+</span><span class="stat-item__label">Documentos prontos</span></div>
     <div class="stat-divider"></div>
     <div class="stat-item"><span class="stat-item__number">35</span><span class="stat-item__label">Advogados parceiros</span></div>
     <div class="stat-divider"></div>
     <div class="stat-item"><span class="stat-item__number">98%</span><span class="stat-item__label">Satisfação dos clientes</span></div>
 </div>

 <!-- ── VIDEO CAROUSEL ── -->
 <section class="section">
     <div class="section__header">
         <div>
             <h2 class="section__title">Vídeos Recém Lançados</h2>
             <p class="section__subtitle">Conteúdo jurídico atualizado para si</p>
         </div>
         <a href="educacao.html" class="section__link">Ver todos →</a>
     </div>

     <div class="video-carousel">
         <button class="carousel-btn carousel-btn--prev" id="vid-prev" aria-label="Anterior"><i class="fa-solid fa-chevron-left"></i></button>
         <div class="video-carousel__track-wrap">
             <div class="video-grid" id="vid-track">

                 <article class="video-card">
                     <div class="video-card__thumb video-card__thumb--1">
                         <div class="video-card__overlay">
                             <div class="video-card__play"><i class="fa-solid fa-play" style="margin-left:2px"></i></div>
                         </div>
                         <span class="video-card__duration">12:30</span>
                         <span class="video-card__badge">Novo</span>
                     </div>
                     <div class="video-card__body">
                         <span class="tag tag--consumer">Direitos do Consumidor</span>
                         <h3 class="video-card__title">Direitos do Consumidor em Compras Online</h3>
                         <p class="video-card__desc">Saiba o que fazer quando uma compra online corre mal e quais os seus direitos legais.</p>
                         <div class="video-card__meta"><span class="video-card__views">2.4k visualizações</span><span class="video-card__date">há 2 dias</span></div>
                     </div>
                 </article>

                 <article class="video-card">
                     <div class="video-card__thumb video-card__thumb--2">
                         <div class="video-card__overlay">
                             <div class="video-card__play"><i class="fa-solid fa-play" style="margin-left:2px"></i></div>
                         </div>
                         <span class="video-card__duration">18:45</span>
                     </div>
                     <div class="video-card__body">
                         <span class="tag tag--contracts">Contratos</span>
                         <h3 class="video-card__title">Como Funciona um Contrato de Arrendamento</h3>
                         <p class="video-card__desc">Cláusulas essenciais, direitos e deveres do inquilino e do senhorio explicados.</p>
                         <div class="video-card__meta"><span class="video-card__views">1.8k visualizações</span><span class="video-card__date">há 5 dias</span></div>
                     </div>
                 </article>

                 <article class="video-card">
                     <div class="video-card__thumb video-card__thumb--3">
                         <div class="video-card__overlay">
                             <div class="video-card__play"><i class="fa-solid fa-play" style="margin-left:2px"></i></div>
                         </div>
                         <span class="video-card__duration">15:10</span>
                     </div>
                     <div class="video-card__body">
                         <span class="tag tag--compliance">Compliance</span>
                         <h3 class="video-card__title">RGPD: Proteja os Seus Dados Pessoais</h3>
                         <p class="video-card__desc">Entenda o Regulamento Geral de Proteção de Dados e como exercer os seus direitos.</p>
                         <div class="video-card__meta"><span class="video-card__views">3.1k visualizações</span><span class="video-card__date">há 1 semana</span></div>
                     </div>
                 </article>

                 <article class="video-card">
                     <div class="video-card__thumb video-card__thumb--4">
                         <div class="video-card__overlay">
                             <div class="video-card__play"><i class="fa-solid fa-play" style="margin-left:2px"></i></div>
                         </div>
                         <span class="video-card__duration">10:55</span>
                     </div>
                     <div class="video-card__body">
                         <span class="tag tag--fiscal">Fiscal e Tributário</span>
                         <h3 class="video-card__title">IRS: Deduções Que Pode Estar a Perder</h3>
                         <p class="video-card__desc">Descubra todas as deduções fiscais disponíveis e como maximizar o seu reembolso.</p>
                         <div class="video-card__meta"><span class="video-card__views">4.7k visualizações</span><span class="video-card__date">há 2 semanas</span></div>
                     </div>
                 </article>

                 <article class="video-card">
                     <div class="video-card__thumb video-card__thumb--5">
                         <div class="video-card__overlay">
                             <div class="video-card__play"><i class="fa-solid fa-play" style="margin-left:2px"></i></div>
                         </div>
                         <span class="video-card__duration">22:00</span>
                     </div>
                     <div class="video-card__body">
                         <span class="tag tag--teal">Registo</span>
                         <h3 class="video-card__title">Como Criar uma Empresa em Portugal</h3>
                         <p class="video-card__desc">Guia completo: da escolha da forma jurídica ao registo comercial, passo a passo.</p>
                         <div class="video-card__meta"><span class="video-card__views">6.1k visualizações</span><span class="video-card__date">há 3 semanas</span></div>
                     </div>
                 </article>

             </div>
         </div>
         <button class="carousel-btn carousel-btn--next" id="vid-next" aria-label="Próximo"><i class="fa-solid fa-chevron-right"></i></button>
         <div class="carousel-dots" id="vid-dots"></div>
     </div>
 </section>

 <!-- ── SERVICES CAROUSEL ── -->
 <section class="section">
     <div class="section__header">
         <div>
             <h2 class="section__title">O que oferecemos</h2>
             <p class="section__subtitle">Ferramentas completas para a sua vida jurídica</p>
         </div>
     </div>

     <div class="services-carousel">
         <button class="carousel-btn carousel-btn--prev" id="svc-prev" aria-label="Anterior">
             <i class="fa-solid fa-chevron-left"></i>
         </button>
         <div class="services-carousel__track-wrap">
             <div class="services-grid" id="svc-track">

                 <article class="service-card service-card--blue">
                     <div class="service-card__icon-wrap"><i class="fa-solid fa-book-open"></i></div>
                     <h3 class="service-card__title">Educação Jurídica</h3>
                     <p class="service-card__desc">Artigos e vídeos sobre os seus direitos</p>
                     <a href="educacao.html" class="service-card__cta">Explorar →</a>
                 </article>

                 <article class="service-card service-card--green">
                     <div class="service-card__icon-wrap"><i class="fa-solid fa-file-lines"></i></div>
                     <h3 class="service-card__title">Documentos</h3>
                     <p class="service-card__desc">Minutas e modelos editáveis prontos a usar</p>
                     <a href="documentos.html" class="service-card__cta">Explorar →</a>
                 </article>

                 <article class="service-card service-card--purple">
                     <div class="service-card__icon-wrap"><i class="fa-solid fa-calendar-check"></i></div>
                     <h3 class="service-card__title">Consultas</h3>
                     <p class="service-card__desc">Agende com um advogado qualificado</p>
                     <a href="consultas.html" class="service-card__cta">Explorar →</a>
                 </article>

                 <article class="service-card service-card--amber">
                     <div class="service-card__icon-wrap"><i class="fa-solid fa-shield-halved"></i></div>
                     <h3 class="service-card__title">Regulador</h3>
                     <p class="service-card__desc">Conformidade legal e regulatória simplificada</p>
                     <a href="regulador.html" class="service-card__cta">Explorar →</a>
                 </article>

                 <article class="service-card service-card--teal">
                     <div class="service-card__icon-wrap"><i class="fa-solid fa-robot"></i></div>
                     <h3 class="service-card__title">Assistente IA</h3>
                     <p class="service-card__desc">Respostas jurídicas instantâneas disponíveis 24/7</p>
                     <a href="assistente.html" class="service-card__cta">Explorar →</a>
                 </article>

                 <article class="service-card service-card--red">
                     <div class="service-card__icon-wrap"><i class="fa-solid fa-gavel"></i></div>
                     <h3 class="service-card__title">Jurisprudência</h3>
                     <p class="service-card__desc">Pesquise acórdãos e decisões dos tribunais portugueses</p>
                     <a href="#" class="service-card__cta">Em breve →</a>
                 </article>

             </div>
         </div>
         <button class="carousel-btn carousel-btn--next" id="svc-next" aria-label="Próximo"><i class="fa-solid fa-chevron-right"></i></button>
         <div class="carousel-dots" id="svc-dots"></div>
     </div>
 </section>

 <script src="scripts/main.js"></script>

 <script>
     /* ── Generic carousel factory ── */
     function initCarousel({
         trackId,
         prevId,
         nextId,
         dotsId,
         visibleFn,
         gap
     }) {
         const track = document.getElementById(trackId);
         const btnPrev = document.getElementById(prevId);
         const btnNext = document.getElementById(nextId);
         const dotsWrap = document.getElementById(dotsId);
         const cards = track.querySelectorAll(':scope > *');
         const total = cards.length;
         let current = 0;

         function pageCount() {
             return Math.max(1, total - visibleFn() + 1);
         }

         function buildDots() {
             dotsWrap.innerHTML = '';
             for (let i = 0; i < pageCount(); i++) {
                 const dot = document.createElement('button');
                 dot.className = 'carousel-dot' + (i === current ? ' carousel-dot--active' : '');
                 dot.setAttribute('aria-label', 'Slide ' + (i + 1));
                 dot.addEventListener('click', () => goTo(i));
                 dotsWrap.appendChild(dot);
             }
         }

         function goTo(index) {
             current = Math.max(0, Math.min(index, pageCount() - 1));
             const cardW = cards[0].offsetWidth;
             track.style.transform = `translateX(-${current * (cardW + gap)}px)`;
             dotsWrap.querySelectorAll('.carousel-dot').forEach((d, i) => {
                 d.classList.toggle('carousel-dot--active', i === current);
             });
             btnPrev.disabled = current === 0;
             btnNext.disabled = current >= pageCount() - 1;
         }

         btnPrev.addEventListener('click', () => goTo(current - 1));
         btnNext.addEventListener('click', () => goTo(current + 1));

         /* Touch */
         let tx = 0;
         track.addEventListener('touchstart', e => {
             tx = e.touches[0].clientX;
         }, {
             passive: true
         });
         track.addEventListener('touchend', e => {
             const dx = tx - e.changedTouches[0].clientX;
             if (Math.abs(dx) > 40) goTo(dx > 0 ? current + 1 : current - 1);
         });

         let resizeTimer;
         window.addEventListener('resize', () => {
             clearTimeout(resizeTimer);
             resizeTimer = setTimeout(() => {
                 buildDots();
                 goTo(current);
             }, 120);
         });

         buildDots();
         goTo(0);
     }

     function vidVisible() {
         return window.innerWidth <= 640 ? 1 : window.innerWidth <= 1100 ? 2 : 3;
     }

     function svcVisible() {
         return window.innerWidth <= 640 ? 1 : window.innerWidth <= 1100 ? 2 : 4;
     }

     initCarousel({
         trackId: 'vid-track',
         prevId: 'vid-prev',
         nextId: 'vid-next',
         dotsId: 'vid-dots',
         visibleFn: vidVisible,
         gap: 22
     });
     initCarousel({
         trackId: 'svc-track',
         prevId: 'svc-prev',
         nextId: 'svc-next',
         dotsId: 'svc-dots',
         visibleFn: svcVisible,
         gap: 18
     });
 </script>