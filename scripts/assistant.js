/* ================================================
   assistant.js — IA Chat Simulation
   ================================================ */

(function () {
  'use strict';

  const RESPONSES = {
    consumidor: `**Direitos do Consumidor em Portugal**\n\nComo consumidor, tem os seguintes direitos fundamentais:\n\n• **Direito à informação** — O vendedor deve fornecer informação clara sobre o produto/serviço.\n• **Direito à devolução** — Em compras online tem 14 dias para devolver sem justificação (prazo de reflexão).\n• **Garantia legal** — 3 anos para bens novos (2 anos para usados), a contar da entrega.\n• **Reclamação** — Pode reclamar junto da empresa, do Livro de Reclamações ou da DECO.\n\nPrecisa de mais informação sobre algum destes pontos?`,

    contrato: `**O que é um Contrato?**\n\nUm contrato é um acordo legalmente vinculativo entre duas ou mais partes. Em Portugal, para ser válido necessita de:\n\n• **Capacidade** — As partes devem ter capacidade jurídica.\n• **Consentimento** — Acordo livre e esclarecido de todas as partes.\n• **Objeto lícito** — O objeto do contrato não pode ser contrário à lei.\n• **Forma** — Alguns contratos exigem forma escrita (ex: arrendamento).\n\nTipos comuns: arrendamento, prestação de serviços, compra e venda, trabalho.\n\nQuer saber mais sobre algum tipo específico de contrato?`,

    fiscal: `**Informação Fiscal Básica em Portugal**\n\nPrincipais impostos que deve conhecer:\n\n• **IRS** — Imposto sobre o Rendimento de Pessoas Singulares. Declaração anual (março/abril).\n• **IRC** — Imposto sobre o Rendimento de Pessoas Coletivas (empresas). Taxa geral: 21%.\n• **IVA** — Imposto sobre o Valor Acrescentado. Taxas: 23% (normal), 13% (intermédia), 6% (reduzida).\n• **IMI** — Imposto Municipal sobre Imóveis. Pago anualmente pelos proprietários.\n\n⚠️ Recomendamos sempre consultar um contabilista certificado para a sua situação específica.`,

    empresa: `**Como Criar uma Empresa em Portugal**\n\nPrincipais passos:\n\n1. **Escolha da forma jurídica** — Unipessoal Lda, Lda, SA ou ENI.\n2. **Reserva do nome** — No RNPC (Registo Nacional de Pessoas Coletivas).\n3. **Escritura ou constituição online** — Via "Empresa na Hora" (balcão ou online).\n4. **Registo no Ministério das Finanças** — Obtenção de NIPC e inscrição no IVA.\n5. **Segurança Social** — Inscrição dos trabalhadores e gerentes.\n6. **Alvará ou licenças** — Conforme a atividade exercida.\n\nCusto mínimo de capital: 1€ para Unipessoal Lda.\n\nPrecisa de ajuda com algum passo específico?`,

    arrendamento: `**Contrato de Arrendamento em Portugal**\n\nPontos essenciais da Lei do Arrendamento Urbano:\n\n• **Prazo mínimo** — 1 ano (salvo acordo em contrário).\n• **Renda** — Deve ser paga até ao 8.º dia do mês.\n• **Caução** — Máximo de 2 meses de renda.\n• **Obras** — Grandes obras dependem de acordo mútuo.\n• **Denúncia** — O inquilino pode sair com pré-aviso de 2 meses (contratos de 1 a 6 anos).\n• **Atualização da renda** — Sujeita a coeficiente anual publicado pelo governo.\n\nPosso ajudá-lo a encontrar um modelo de contrato na secção Documentos.`,

    rgpd: `**RGPD — Regulamento Geral de Proteção de Dados**\n\nOs seus direitos fundamentais:\n\n• **Direito de acesso** — Pode pedir os dados que uma empresa tem sobre si.\n• **Direito de retificação** — Corrigir dados incorretos.\n• **Direito ao apagamento** — "Direito a ser esquecido".\n• **Direito à portabilidade** — Receber os seus dados em formato legível.\n• **Direito de oposição** — Opor-se ao tratamento para fins de marketing.\n\nPara exercer estes direitos, contacte o encarregado de proteção de dados (DPO) da entidade.\n\nDenúncias podem ser feitas à **CNPD** (Comissão Nacional de Proteção de Dados).`,

    default: `**Olá! Sou o Assistente Jurídico da AngoLaw.**\n\nPosso ajudá-lo com questões sobre:\n\n• Direitos do consumidor\n• Contratos e acordos\n• Impostos e questões fiscais\n• Criação de empresas\n• Arrendamento\n• RGPD e proteção de dados\n\nTente escrever uma dessas palavras-chave ou descreva a sua situação. Para aconselhamento jurídico personalizado, recomendo agendar uma **Consulta** com um dos nossos advogados parceiros.\n\n⚠️ *Este assistente fornece informação geral e não substitui aconselhamento jurídico profissional.*`
  };

  function getResponse(message) {
    const msg = message.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    if (msg.includes('consumidor') || msg.includes('devolucao') || msg.includes('garantia') || msg.includes('reclamacao')) return RESPONSES.consumidor;
    if (msg.includes('contrato') || msg.includes('acordo') || msg.includes('clausula')) return RESPONSES.contrato;
    if (msg.includes('fiscal') || msg.includes('irs') || msg.includes('irc') || msg.includes('iva') || msg.includes('imposto') || msg.includes('taxa')) return RESPONSES.fiscal;
    if (msg.includes('empresa') || msg.includes('sociedade') || msg.includes('negocio') || msg.includes('lda') || msg.includes('unipessoal')) return RESPONSES.empresa;
    if (msg.includes('arrendamento') || msg.includes('inquilino') || msg.includes('senhorio') || msg.includes('renda') || msg.includes('aluguer')) return RESPONSES.arrendamento;
    if (msg.includes('rgpd') || msg.includes('dados') || msg.includes('privacidade') || msg.includes('gdpr')) return RESPONSES.rgpd;
    return RESPONSES.default;
  }

  function parseMarkdown(text) {
    return text
      .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
      .replace(/\*(.*?)\*/g, '<em>$1</em>')
      .replace(/^• /gm, '<span class="chat__bullet">•</span> ')
      .replace(/^\d+\. /gm, match => `<span class="chat__num">${match}</span>`)
      .replace(/\n\n/g, '</p><p>')
      .replace(/\n/g, '<br>');
  }

  function createBubble(text, role) {
    const wrap = document.createElement('div');
    wrap.className = `chat__message chat__message--${role}`;

    const bubble = document.createElement('div');
    bubble.className = 'chat__bubble';

    if (role === 'assistant') {
      bubble.innerHTML = `<p>${parseMarkdown(text)}</p>`;
    } else {
      bubble.textContent = text;
    }

    wrap.appendChild(bubble);
    return wrap;
  }

  function createTypingIndicator() {
    const wrap = document.createElement('div');
    wrap.className = 'chat__message chat__message--assistant chat__message--typing';
    wrap.innerHTML = `<div class="chat__bubble chat__typing"><span></span><span></span><span></span></div>`;
    return wrap;
  }

  function scrollToBottom(container) {
    container.scrollTop = container.scrollHeight;
  }

  function init() {
    const form      = document.getElementById('chat-form');
    const input     = document.getElementById('chat-input');
    const messages  = document.getElementById('chat-messages');
    const suggestions = document.querySelectorAll('[data-suggestion]');

    if (!form || !input || !messages) return;

    function sendMessage(text) {
      if (!text.trim()) return;

      // User bubble
      messages.appendChild(createBubble(text, 'user'));
      input.value = '';
      input.style.height = 'auto';
      scrollToBottom(messages);

      // Typing indicator
      const typing = createTypingIndicator();
      messages.appendChild(typing);
      scrollToBottom(messages);

      // Simulate delay
      setTimeout(() => {
        typing.remove();
        const response = getResponse(text);
        messages.appendChild(createBubble(response, 'assistant'));
        scrollToBottom(messages);
      }, 900 + Math.random() * 500);
    }

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      sendMessage(input.value);
    });

    suggestions.forEach(btn => {
      btn.addEventListener('click', function () {
        sendMessage(this.dataset.suggestion);
      });
    });

    // Auto-resize textarea
    input.addEventListener('input', function () {
      this.style.height = 'auto';
      this.style.height = Math.min(this.scrollHeight, 140) + 'px';
    });

    // Enter to send (Shift+Enter for newline)
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage(this.value);
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
