<!-- ===== MODALS ===== -->



<!-- 2 -->
<div class="doc-card">
    <div class="doc-card__top doc-card__top--green">
        <div class="doc-card__file-icon">
            <i class="fa-solid fa-file-alt" style="font-size:2.2rem;color:var(--green-500)"></i>
            <span class="doc-card__file-ext" style="color:var(--green-600)">.docx</span>
        </div>
    </div>
    <div class="doc-card__body">
        <h3 class="doc-card__title">Memorando Interno</h3>
        <p class="doc-card__desc">Modelo de comunicação interna para transmitir decisões, avisos ou informações relevantes dentro de uma organização.</p>
    </div>
    <div class="doc-card__footer">
        <span class="doc-card__meta"><i class="fa-regular fa-calendar" style="margin-right:4px"></i>Atualizado: Dez 2024</span>
        <button class="btn btn--navy btn--sm" data-modal-open="modal-memorando">Usar Modelo</button>
    </div>
</div>

<!-- 3 -->
<div class="doc-card">
    <div class="doc-card__top doc-card__top--purple">
        <div class="doc-card__file-icon">
            <i class="fa-solid fa-file-shield" style="font-size:2.2rem;color:var(--purple-500)"></i>
            <span class="doc-card__file-ext" style="color:var(--purple-600)">.docx</span>
        </div>
    </div>
    <div class="doc-card__body">
        <h3 class="doc-card__title">Acordo de Confidencialidade (NDA)</h3>
        <p class="doc-card__desc">Non-Disclosure Agreement para proteger informações confidenciais partilhadas entre partes em negociações ou parcerias.</p>
    </div>
    <div class="doc-card__footer">
        <span class="doc-card__meta"><i class="fa-regular fa-calendar" style="margin-right:4px"></i>Atualizado: Fev 2025</span>
        <button class="btn btn--navy btn--sm" data-modal-open="modal-nda">Usar Modelo</button>
    </div>
</div>

<!-- 4 -->
<div class="doc-card">
    <div class="doc-card__top doc-card__top--amber">
        <div class="doc-card__file-icon">
            <i class="fa-solid fa-stamp" style="font-size:2.2rem;color:var(--amber-500)"></i>
            <span class="doc-card__file-ext" style="color:var(--amber-600)">.docx</span>
        </div>
    </div>
    <div class="doc-card__body">
        <h3 class="doc-card__title">Procuração</h3>
        <p class="doc-card__desc">Documento legal para delegar poderes a outra pessoa para agir em seu nome. Disponível em versão geral, especial e irrevogável.</p>
    </div>
    <div class="doc-card__footer">
        <span class="doc-card__meta"><i class="fa-regular fa-calendar" style="margin-right:4px"></i>Atualizado: Mar 2025</span>
        <button class="btn btn--navy btn--sm" data-modal-open="modal-procuracao">Usar Modelo</button>
    </div>
</div>

<!-- 5 -->
<div class="doc-card">
    <div class="doc-card__top doc-card__top--red">
        <div class="doc-card__file-icon">
            <i class="fa-solid fa-house-chimney" style="font-size:2.2rem;color:var(--red-500)"></i>
            <span class="doc-card__file-ext" style="color:var(--red-600)">.docx</span>
        </div>
    </div>
    <div class="doc-card__body">
        <h3 class="doc-card__title">Contrato de Arrendamento</h3>
        <p class="doc-card__desc">Modelo atualizado conforme a Lei do Arrendamento Urbano. Cláusulas de renda, caução, obras e rescisão incluídas.</p>
    </div>
    <div class="doc-card__footer">
        <span class="doc-card__meta"><i class="fa-regular fa-calendar" style="margin-right:4px"></i>Atualizado: Jan 2025</span>
        <button class="btn btn--navy btn--sm" data-modal-open="modal-arrendamento">Usar Modelo</button>
    </div>
</div>

<!-- 6 -->
<div class="doc-card">
    <div class="doc-card__top doc-card__top--teal">
        <div class="doc-card__file-icon">
            <i class="fa-solid fa-file-signature" style="font-size:2.2rem;color:var(--teal-500)"></i>
            <span class="doc-card__file-ext" style="color:var(--teal-600)">.docx</span>
        </div>
    </div>
    <div class="doc-card__body">
        <h3 class="doc-card__title">Termo de Responsabilidade</h3>
        <p class="doc-card__desc">Declaração formal pela qual uma parte assume responsabilidade por ações, bens ou compromissos perante outra entidade.</p>
    </div>
    <div class="doc-card__footer">
        <span class="doc-card__meta"><i class="fa-regular fa-calendar" style="margin-right:4px"></i>Atualizado: Abr 2025</span>
        <button class="btn btn--navy btn--sm" data-modal-open="modal-termo">Usar Modelo</button>
    </div>
</div>

<!-- Modal: Prestação de Serviços -->
<div class="modal-overlay" id="modal-prestacao">
    <div class="modal">
        <div class="modal__header">
            <h2 class="modal__title">Contrato de Prestação de Serviços</h2>
            <button class="modal__close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal__body">
            <div class="doc-modal-preview">
                <p><strong>CONTRATO DE PRESTAÇÃO DE SERVIÇOS</strong></p>
                <p>Entre o(a) <strong>[PRESTADOR]</strong>, doravante designado "Prestador", e o(a) <strong>[CLIENTE]</strong>, doravante designado "Cliente"...</p>
                <p>O presente contrato rege-se pelas condições acordadas entre as partes e pela legislação portuguesa aplicável.</p>
            </div>
            <div class="doc-modal-fields">
                <div class="form-field">
                    <label>Nome do Prestador</label>
                    <input type="text" placeholder="Ex: João Silva, Lda." />
                </div>
                <div class="form-field">
                    <label>Nome do Cliente</label>
                    <input type="text" placeholder="Ex: Maria Santos" />
                </div>
                <div class="form-field">
                    <label>Valor do Serviço (€)</label>
                    <input type="number" placeholder="Ex: 1500" />
                </div>
                <div class="form-field">
                    <label>Prazo de Entrega</label>
                    <input type="date" />
                </div>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline" data-modal-close>Cancelar</button>
            <button class="btn btn--primary"><i class="fa-solid fa-download" style="margin-right:6px"></i>Descarregar Modelo</button>
        </div>
    </div>
</div>

<!-- Modal: NDA -->
<div class="modal-overlay" id="modal-nda">
    <div class="modal">
        <div class="modal__header">
            <h2 class="modal__title">Acordo de Confidencialidade (NDA)</h2>
            <button class="modal__close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal__body">
            <div class="doc-modal-preview">
                <p><strong>ACORDO DE CONFIDENCIALIDADE E NÃO DIVULGAÇÃO</strong></p>
                <p>As partes comprometem-se a manter em sigilo absoluto todas as informações confidenciais partilhadas no âmbito desta relação...</p>
            </div>
            <div class="doc-modal-fields">
                <div class="form-field">
                    <label>Parte Divulgante</label>
                    <input type="text" placeholder="Nome da empresa ou pessoa" />
                </div>
                <div class="form-field">
                    <label>Parte Receptora</label>
                    <input type="text" placeholder="Nome da empresa ou pessoa" />
                </div>
                <div class="form-field">
                    <label>Duração do acordo</label>
                    <select>
                        <option>1 ano</option>
                        <option>2 anos</option>
                        <option>3 anos</option>
                        <option>Indefinido</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal__footer">
            <button class="btn btn--outline" data-modal-close>Cancelar</button>
            <button class="btn btn--primary"><i class="fa-solid fa-download" style="margin-right:6px"></i>Descarregar Modelo</button>
        </div>
    </div>
</div>

<!-- Generic modal for other docs -->
<div class="modal-overlay" id="modal-memorando">
    <div class="modal">
        <div class="modal__header">
            <h2 class="modal__title">Memorando Interno</h2><button class="modal__close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal__body">
            <div class="doc-modal-preview">
                <p><strong>MEMORANDO INTERNO</strong></p>
                <p>Para: <strong>[DESTINATÁRIO]</strong> · De: <strong>[REMETENTE]</strong> · Data: <strong>[DATA]</strong></p>
                <p>Assunto: [ASSUNTO DO MEMORANDO]</p>
            </div>
            <div class="doc-modal-fields">
                <div class="form-field"><label>Para (Destinatário)</label><input type="text" placeholder="Ex: Departamento Jurídico" /></div>
                <div class="form-field"><label>Assunto</label><input type="text" placeholder="Ex: Atualização de Política Interna" /></div>
            </div>
        </div>
        <div class="modal__footer"><button class="btn btn--outline" data-modal-close>Cancelar</button><button class="btn btn--primary"><i class="fa-solid fa-download" style="margin-right:6px"></i>Descarregar Modelo</button></div>
    </div>
</div>

<div class="modal-overlay" id="modal-procuracao">
    <div class="modal">
        <div class="modal__header">
            <h2 class="modal__title">Procuração</h2><button class="modal__close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal__body">
            <div class="doc-modal-preview">
                <p><strong>PROCURAÇÃO</strong></p>
                <p>Eu, <strong>[MANDANTE]</strong>, pelo presente instrumento, constituo meu(minha) bastante procurador(a) <strong>[MANDATÁRIO]</strong>...</p>
            </div>
            <div class="doc-modal-fields">
                <div class="form-field"><label>Nome do Mandante</label><input type="text" placeholder="Quem delega os poderes" /></div>
                <div class="form-field"><label>Nome do Mandatário</label><input type="text" placeholder="Quem recebe os poderes" /></div>
                <div class="form-field"><label>Tipo de Procuração</label><select>
                        <option>Geral</option>
                        <option>Especial</option>
                        <option>Irrevogável</option>
                    </select></div>
            </div>
        </div>
        <div class="modal__footer"><button class="btn btn--outline" data-modal-close>Cancelar</button><button class="btn btn--primary"><i class="fa-solid fa-download" style="margin-right:6px"></i>Descarregar Modelo</button></div>
    </div>
</div>

<div class="modal-overlay" id="modal-arrendamento">
    <div class="modal">
        <div class="modal__header">
            <h2 class="modal__title">Contrato de Arrendamento</h2><button class="modal__close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal__body">
            <div class="doc-modal-preview">
                <p><strong>CONTRATO DE ARRENDAMENTO URBANO</strong></p>
                <p>O(A) <strong>[SENHORIO]</strong> dá de arrendamento ao(à) <strong>[INQUILINO]</strong> o imóvel sito em <strong>[MORADA]</strong>, pelo prazo de <strong>[PRAZO]</strong>...</p>
            </div>
            <div class="doc-modal-fields">
                <div class="form-field"><label>Nome do Senhorio</label><input type="text" placeholder="Nome completo" /></div>
                <div class="form-field"><label>Nome do Inquilino</label><input type="text" placeholder="Nome completo" /></div>
                <div class="form-field"><label>Valor da Renda (€/mês)</label><input type="number" placeholder="Ex: 750" /></div>
                <div class="form-field"><label>Início do Arrendamento</label><input type="date" /></div>
            </div>
        </div>
        <div class="modal__footer"><button class="btn btn--outline" data-modal-close>Cancelar</button><button class="btn btn--primary"><i class="fa-solid fa-download" style="margin-right:6px"></i>Descarregar Modelo</button></div>
    </div>
</div>

<div class="modal-overlay" id="modal-termo">
    <div class="modal">
        <div class="modal__header">
            <h2 class="modal__title">Termo de Responsabilidade</h2><button class="modal__close" data-modal-close><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal__body">
            <div class="doc-modal-preview">
                <p><strong>TERMO DE RESPONSABILIDADE</strong></p>
                <p>Eu, <strong>[NOME]</strong>, portador(a) do CC nº <strong>[CC]</strong>, declaro assumir total responsabilidade por <strong>[OBJETO]</strong>...</p>
            </div>
            <div class="doc-modal-fields">
                <div class="form-field"><label>Nome do Declarante</label><input type="text" placeholder="Nome completo" /></div>
                <div class="form-field"><label>Objeto da Responsabilidade</label><input type="text" placeholder="Ex: utilização do veículo X" /></div>
            </div>
        </div>
        <div class="modal__footer"><button class="btn btn--outline" data-modal-close>Cancelar</button><button class="btn btn--primary"><i class="fa-solid fa-download" style="margin-right:6px"></i>Descarregar Modelo</button></div>
    </div>
</div>
<script src="scripts/modal.js"></script>